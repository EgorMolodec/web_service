<?php

/**
 * Контроллер CourseController
 * Управление курсами 
 */
class CourseController extends AdminBase
{

    /**
     * Action для страницы "Добавить курс"
     */
    public function actionCreate()
    {        echo 'kuku';
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];

            // Флаг ошибок в форме
            $errors = false;
            
            $nameDir = '';
            if(preg_match('@[A-z]@u', $options['name'])) {
                
                $nameDir = str_replace(" ", "_", $options['name']);
            }
            else {
                $nameDir = Course::latinize($options['name']);
            }
            
            mkdir(ROOT . "/upload/" . $nameDir);
            
            $options['latName'] = $nameDir;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый курс
                $id = Course::createCourse($options);
                
                Course::setLatName($id, $nameDir);
                
                // Перенаправляем пользователя на главную страницу
                header("Location: /admin/");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/course/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать курс"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном курсе
        $course = Course::getCourseById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];

            // Сохраняем изменения
            Course::updateCourseById($id, $options);

            // Перенаправляем пользователя на страницу отредактированного курса
            header("Location: /course/" . $course['intCourseID']);
        }

        // Подключаем вид
        require_once(ROOT . '/views/course/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить курс"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();
        
        $course = Course::getCourseById($id);
        $tasksList = Task::getTasksListByCourse($course['intCourseID']);
        
        $path = ROOT . "/upload/" . $course['txtCourseLatName'];

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем курс
            Course::deleteCourseById($id);
            Course::deleteDirByPath($path);
            
            foreach ($tasksList as $task) {
                Task::deleteTaskById($task['intTaskID']);
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/");
        }

        // Подключаем вид
        require_once(ROOT . '/views/course/delete.php');
        return true;
    }

    /**
     * Action для просмотра курса
     */
    
    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();
//
         // Получаем данные о конкретном курсе
          $course = Course::getCourseById($id);
          
          $tasksList = Task::getTasksList();

        // Подключаем вид
        require_once(ROOT . '/views/course/view.php');
        return true;
    }
}
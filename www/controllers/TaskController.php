<?php

/**
 * Контроллер TaskController
 * Управление заданиями
 */
class TaskController extends AdminBase
{

    /**
     * Action для страницы "Добавить задание"
     */
    public function actionCreate($courseID)
    {        echo 'kuku';
        // Проверка доступа
        self::checkAdmin();

    // Получаем информацию о курсе, к которому относится задание
        $course = Course::getCourseById($courseID);
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];
            $options['example'] = $_FILES["example"]["name"];
            $options['courseID'] = $courseID;
            echo 'you here?';

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }
            
            $nameDir = '';
            
            if ($errors == false) {
                
                if(preg_match('@[A-z]@u', $options['name'])) {
                
                    $nameDir = str_replace(" ", "_", $options['name']);
                }
                else {
                    $nameDir = Course::latinize($options['name']);
                }
            
                $options['latName'] = $nameDir;
            
                // Создаём папку для загрузки файлов в данное задание
            
                $path = ROOT . "/upload/" . $course['txtCourseLatName'] . "/" . $nameDir;
                mkdir($path);
             
            
                $id = Task::createTask($options);
                
                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["example"]["tmp_name"])) {
                        mkdir($path . "/example");
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        //$_SERVER['DOCUMENT_ROOT']
                        move_uploaded_file($_FILES["example"]["tmp_name"],  $path . "/example/" . $_FILES["example"]["name"]);
                    }
                };
            }

            // Получаем название курса латиницей и заменяем пробелы на "_"
            

            
            header("Location: /course/view/" . $courseID);
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать задание"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();
        
        // Получаем информацию о задании
        $task = Task::getTaskById($id);
        
        // Получаем информацию о курсе, к которому относится задание
        $course = Course::getCourseById($task['intCourseID']);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['id'] = $id;
            $options['name'] = $_POST['name'];
            $options['description'] = $_POST['description'];
            
            $nameDir = '';
            
            if ($errors == false) {
                
                if(preg_match('@[A-z]@u', $options['name'])) {
                
                    $nameDir = str_replace(" ", "_", $options['name']);
                }
                else {
                    $nameDir = Course::latinize($options['name']);
                }
            
                $options['latName'] = $nameDir;
            
                // Создаём папку для загрузки файлов в данное задание
            
                $path = ROOT . "/upload/" . $course['txtCourseLatName'] .  "/";
                rename($path . $task['txtTaskLatName'],  $path . $nameDir);

                // Сохраняем изменения
                if (Task::updateTaskById($options)) {

                    // Если запись добавлена
                    if ($id) {
                        // Проверим, загружалось ли через форму изображение
                        if (is_uploaded_file($_FILES["example"]["tmp_name"])) {
                            
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["example"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/" 
                                    . $course['txtCourseLatName'] . "/" . $nameDir . "/" . $_FILES["example"]["name"]);
                        }
                    };
                }

            }
            // Перенаправляем пользователя на главную страницу
            header("Location: /admin");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить задание"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        $task = Task::getTaskByID($id);
        $course = Course::getCourseById($task['intCourseID']);
        
        $path = ROOT . "/upload/" . $course['txtCourseLatName'] . "/" . $task['txtTaskLatName'];

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем задание
            Task::deleteTaskById($id);
            Task::deleteDirByPath($path);

            // Перенаправляем пользователя на страницу курса
            header("Location: /course/view/" . $task['intCourseID']);
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/delete.php');
        return true;
    }

    
    public function actionView($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем информацию о задании
         $task = Task::getTaskById($id);
        
         // Получаем данные о конкретном курсе
          $course = Course::getCourseById($task['intCourseID']);
          
          $tasksList = Task::getTasksList();

        // Подключаем вид
        require_once(ROOT . '/views/task/view.php');
        return true;
    }
}
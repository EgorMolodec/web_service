<?php

class CabinetController
{

    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        $coursesList = Course::getCoursesList();
        $reportsList = Report::getReportsListByUserId($userId);
        
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['intCourseID'] = $_POST['get_course'];
            $options['intTaskID'] = $_POST['get_task'];
            $options['intUserID'] = $userId;
            
            echo 'ok1';

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if ($options['intCourseID'] == null) {
                //$errors[] = 'Заполните поле курса';
                $errors = true;
                echo 'Заполните поле курса';
            }

            if ($options['intTaskID'] == null) {
                //$errors[] = 'Заполните полe задания';
                $errors = true;
                echo 'Заполните полe задания';

            }
            
            
            if ($errors == false) {
                // Если ошибок нет
                echo 'ok2';
                // Получаем курс и задание по идентификатору
                $course = Course::getCourseById($options['intCourseID']);
                $task = Task::getTaskById($options['intTaskID']);
          
                // Путь к месту хранения файлов
                $path = ROOT . "/upload/" . $course['txtCourseLatName'] . "/" . $course['txtTaskLatName'] . "/";

                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                    mkdir($path . "/example");
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    //$_SERVER['DOCUMENT_ROOT']
                    move_uploaded_file($_FILES["file"]["tmp_name"],  $path . $_FILES["file"]["name"]);
                    
                }

                // Запускаем обработку файла
                
                $options['txtResult'] = Report::checkWork($path . $_FILES["file"]["name"]);

                // Создаём новый отчёт
                Report::createReport($options);

                // Перенаправляем пользователя на главную страницу
                header("Location: /cabinet/");
            }

        }
        
        require_once(ROOT . '/views/cabinet/index.php');

        return true;
    }  
    
    
    public static function chooseTask()
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $tasksList = Task::getTasksListByCourse($_POST['course']);

            echo"<option value=''>выберите task</option>";

            while ($row = mysql_fetch_array($result))
            {
               echo "<option value='".$row["id"]."'>".$row["name"]."</option>";
            }

        }

    }

}
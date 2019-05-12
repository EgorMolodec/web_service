<?php

class UserController
{

    public function actionLogin()
    {
        $email = '';
        $password = '';
                $coursesList = Course::getCoursesList();

        
        if (isset($_POST['submit'])) {
            $email = $_POST['login'];
            $password = $_POST['password'];
            
            $errors = false;
                        
            // Валидация полей
/*            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            */
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);
                
            $user = User::getUserById($userId);
            
        // Если роль текущего пользователя "admin", отправляем на страницу преподавателя
        if ($user['boolRoot'] == '1') {
            //require_once(ROOT . '/views/admin/index.php');
            header("Location: /admin/");
        }
                    
        else {
            // Перенаправляем пользователя на страницу студента
            header("Location: /cabinet/");  
        }
                
            }

        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }
    
    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION["user"]);
        header("Location: /");
    }
    
    public static function uploadFile()
    {
        $coursesList = Course::getCoursesList();
        
        //$path = ROOT . "/upload/" . $course['txtCourseLatName'] . "/" . $task['txtTaskLatName'];

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            $course = $_POST['course'];
            $task = $_POST['task'];
            
            $task = Task::getTaskByID($task['id']);
            $course = Course::getCourseById($course['id']);
            // Удаляем задание
            Task::deleteTaskById($id);
            Task::deleteDirByPath($path);

            // Перенаправляем пользователя на страницу курса
            header("Location: /course/view/" . $task['intCourseID']);
        }
    }
}

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
                User::connectionLdap($email, $password);
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
    
    public static function actionUploadFile($one, $two, $three)
    {
       
        // Путь к файлу
        $path = '/upload/' . $one . '/' . $two . '/' . $three;

        // Возвращаем путь изображения
        return $path;
    }
}

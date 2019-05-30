<?php

class User
{

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : ingeger user id or false
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM tblUser WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['intUserID'];
        }

        return false;
    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        else {
            header("Location: /user/login");
        }

        header("Location: /user/login");
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Returns user by id
     * @param integer $id
     */
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM tblUser WHERE intUserID = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }
    
        /**
     * Возвращает список пользователей
     * @return array <p>Массив с пользователями</p>
     */
    public static function getUsersList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT intUserID, email FROM tblUser ORDER BY intUserID ASC');
        $usersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $usersList[$i]['intUserID'] = $row['intUserID'];
            $usersList[$i]['email'] = $row['email'];
            $i++;
        }
        return $usersList;
    }
    
    /**
     * Возвращает список студентов
     * @return array <p>Массив сo студентами</p>
     */
        public static function getStudentsList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        $rules = 0;
        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM tblUser ORDER BY intUserID ASC');       //  WHERE boolRoot = :rules
        $usersList = array();
        
        // Выполнение комaнды
        $result->execute();
        
        $i = 0;
        while ($row = $result->fetch()) {
            if ($row['boolRoot'] == 0) {
                $usersList[$i]['intUserID'] = $row['intUserID'];
                $usersList[$i]['email'] = $row['email'];
                $i++;
            }

        }
        return $usersList;
    }
    
    public function connectionLdap($login, $password) {
        //Начинаем сессию
        //session_start();
        //ip адрес или название сервера ldap(AD)
        $ldaphost = "ldaps://ldap.cs.prv";
        //Порт подключения
        $ldapport = "636";
        //Полный путь к группе которой должен принадлежать человек, что бы пройти аутентификацию.
        $memberof = "ou=people,dc=cs,dc=karelia,dc=ru";
        //Откуда начинаем искать
        $base = "dc=cs,dc=karelia,dc=ru";

        //подсоединяемся к LDAP серверу
        $ldap = ldap_connect($ldaphost,$ldapport) or die("Cant connect to LDAP Server");
        //Включаем LDAP протокол версии 3
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        if ($ldap)
        {
            // Пытаемся войти в LDAP
            $bind = ldap_bind($ldap);
            if (!$bind)
            {
                die('Невозможно войти на сервер LDAP. Попробуйте позднее.<br /> <a href="/studies/kurs/topics.php.ru">Вернуться назад</a>');
            }
        }
        else
        {
            die('Невозможно подключится к серверу LDAP. Попробуйте позднее.<br /> <a href="/studies/kurs/topics.php.ru">Вернуться назад</a>');
        }

        //Если пользователь не аутентифицирован, то проверить его используя LDAP
        /*if (isset($login) && isset($password))
        {
            $login = $_POST['login'];
            $password = $_POST['password'];*/

            // Ищем пользователя.
            $result = ldap_search($ldap,$base,"(uid=".$login.")");
            $result_ent = ldap_get_entries($ldap,$result);
            if ($result_ent['count'] != 0)
            {
                $dn=$result_ent[0]['dn'];

                // Пытаемся войти в LDAP при помощи указанного пароля
                $rebind = ldap_bind($ldap,$dn,$password);
                if ($rebind)
                {
                    // Успершная авторизация   
                    $_SESSION['user_id'] = $login;
                }
                else
                {
                    //Неверный пароль
                    die('Вы ввели неправильный логин или пароль. попробуйте еще раз<br /> <a href="/studies/kurs/topics.php.ru">Вернуться назад</a>');
                }
            }
            else
            {
                // Пользователь не найден
                die('Вы ввели неправильный логин или пароль. попробуйте еще раз<br /> <a href="/studies/kurs/topics.php.ru">Вернуться назад</a>');
            }

        
        
        echo '<head> .
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>Регистрация тем курсовых работ</title>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        </head>';
        
            if(isset($_SESSION['user_id']))
            {  
                echo 'Вы авторизованы!';
            }
            else
            {
                // Форма для ввода пароля и логина
                echo '
                <h3>Авторизация преподавателя</h3>
                <form id="login_form" action="" method="POST" style="display:inline" title="После авторизации доступно: регистрация тем работ">
                        <input placeholder="Имя пользователя" type="text" name="login" id="inp_login" class="inp txt_inp" maxlength="15" title="Вход доступен с помощью логина и пароля в сервисах кафедры ИМО (только для сотрудников кафедры *ou=faculty)">
                        <input placeholder="Пароль" type="password" name="password" id="inp_password" class="inp txt_inp" maxlength="15" title="Вход доступен с помощью логина и пароля в сервисах кафедры ИМО (только для сотрудников кафедры *ou=faculty)">
                        <input type="submit" id="btn_login" value="Войти" class="inp">
                        <div id="login_response"></div>
                    </form>
                ';


            }
    }

}

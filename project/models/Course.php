<?php

/**
 * Класс Course - модель для работы с курсами
 */
class Course
{
    /**
     * Возвращает курс с указанным id
     * @param integer $id <p>id товара</p>
     * @return array <p>Массив с информацией о курсе</p>
     */
    public static function getCourseById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tblCourse WHERE intCourseID = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }


    /**
     * Возвращает список курсов с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком курсов</p>
     */
    public static function getCoursesByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM tblCourse WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }


    /**
     * Возвращает список курсов
     * @return array <p>Массив с курсами</p>
     */
    public static function getCoursesList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT intCourseID, txtCourseName, txtCourseInfo FROM tblCourse ORDER BY intCourseID ASC');
        $coursesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $coursesList[$i]['intCourseID'] = $row['intCourseID'];
            $coursesList[$i]['txtCourseName'] = $row['txtCourseName'];
            $coursesList[$i]['txtCourseInfo'] = $row['txtCourseInfo'];            
            $i++;
        }
        return $coursesList;
    }

    /**
     * Удаляет курс с указанным id
     * @param integer $id <p>id курса</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteCourseById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        
        $course = Course::getCourseById($id);

        // Текст запроса к БД
        $sql = 'DELETE FROM tblCourse WHERE intCourseID = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }

    /**
     * Редактирует курс с заданным id
     * @param integer $id <p>id курса</p>
     * @param array $options <p>Массив с информацей о курсе</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateCourseById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        echo 'ok';
        // Текст запроса к БД
        $sql = "UPDATE tblCourse
            SET 
                txtCourseName = :name,  
                txtCourseInfo = :description 
            WHERE intCourseID = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Добавляет новый курс
     * @param array $options <p>Массив с информацией о курсе</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createCourse($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tblCourse '
                . '(txtCourseName, txtCourseInfo, txtCourseLatName)'
                . 'VALUES '
                . '(:name, :description, :latName)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':latName', $options['latName'], PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    

    /**
     * Возвращает путь к файлу
     * @param integer $id
     * @return string <p>Путь к файлу</p>
     */
    public static function getImage($id)
    {

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    /**
    * Выполняет латинизацию строки $str и преобразует пробел в "_"
    */

    public static function latinize($str)  
    {

        /* Массив соответствий символов*/
        $alpha = array (
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "i",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "kh",
            "ц" => "c",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "sch",
            "ь" => "",
            "ы" => "y",
            "ъ" => "",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            " " => "_"
            );

            $r = "";


            /* Посимвольная замена  русских символов. 
             * Используются функции для мультибайтовых строк  */
            for($i = 0; $i < mb_strlen($str, "UTF-8"); $i++)
            {
                $x = mb_substr($str, $i, 1, "UTF-8");
                $r .= $alpha[$x];
            }
            return $r;
    }

    /**
     * В БД добавляет каждому курсу его название латиницей
     * @param type $id
     * @param type $latName
     * @return int
     */
    
    public static function setLatName($id, $latName)
    
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tblCourse txtCourseLatName VALUES :latName)';
        
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':latName', $latName, PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    
    /**
     * deleteDir - Функция удаления директории при удалении курса
     * @param type $path - Путь к удаляемой директории
     */

    public static function deleteDirByPath($path)
    {
        // если путь существует и это папка
         if ( file_exists( $path ) AND is_dir( $path ) ) {
           // открываем папку
            $dir = opendir($path);
            while ( false !== ( $element = readdir( $dir ) ) ) {
              // удаляем только содержимое папки
                if ( $element != '.' AND $element != '..' )  {
                    $tmp = $path . '/' . $element;
                    chmod( $tmp, 0777 );
                    
                    // если элемент является папкой, то
                    // удаляем его используя нашу функцию deleteDir
                    if ( is_dir( $tmp ) ) {
                        self::deleteDirByPath( $tmp );
                    // если элемент является файлом, то удаляем файл
                    } else {
                        unlink( $tmp );
                    }
                }
            }
           // закрываем папку
            closedir($dir);
            
            // удаляем саму папку
            if ( file_exists( $path ) ) {
                rmdir( $path );
            }
         }
    }

}

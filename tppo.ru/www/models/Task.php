<?php
/**
 * Класс Task - модель для работы с заданиями
 */
class Task
{
    /**
     * Возвращает список заданий в указанном курсе
     * @param type $courseId <p>id курса</p>
     * @return type <p>Массив с заданиями</p>
     */
    public static function getTasksListByCourse($intCourseID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tblTask WHERE intCourseID = :intCourseID ';
        
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':intCourseID', $intCourseID, PDO::PARAM_INT);
        
        // Выполнение комaнды
        $result->execute();
        
        $tasksList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tasksList[$i]['intTaskID'] = $row['intTaskID'];
            $tasksList[$i]['txtTaskName'] = $row['txtTaskName'];
            $tasksList[$i]['txtTaskLatName'] = $row['txtTaskLatName'];
            $tasksList[$i]['txtTaskExample'] = $row['txtTaskExample'];
            $tasksList[$i]['txtTaskInfo'] = $row['txtTaskInfo'];            
            $i++;
        }
        return $tasksList;
    }

    /**
     * Возвращает задание с указанным id
     * @param integer $id <p>id задания</p>
     * @return array <p>Массив с информацией о задании</p>
     */
    public static function getTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tblTask WHERE intTaskID = :id';

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
     * Возвращает список заданий с указанными индентификторами
     * @param array $idsArray <p>Массив с идентификаторами</p>
     * @return array <p>Массив со списком заданий</p>
     */
    public static function getTasksByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM tblTask WHERE status='1' AND id IN ($idsString)";
        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $tasks = array();
        while ($row = $result->fetch()) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['code'] = $row['code'];
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['price'] = $row['price'];
            $i++;
        }
        return $tasks;
    }

    /**
     * Возвращает список заданий
     * @return array <p>Массив с заданиями</p>
     */
    public static function getTasksList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT intTaskID, intCourseID, txtTaskName, txtTaskExample, txtTaskInfo FROM tblTask ORDER BY intTaskID ASC');
        $tasksList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tasksList[$i]['intTaskID'] = $row['intTaskID'];
            $tasksList[$i]['intCourseID'] = $row['intCourseID'];
            $tasksList[$i]['txtTaskName'] = $row['txtTaskName'];
            $tasksList[$i]['txtTaskExample'] = $row['txtTaskExample'];
            $tasksList[$i]['txtTaskInfo'] = $row['txtTaskInfo'];            
            $i++;
        }
        return $tasksList;
    }

    /**
     * Удаляет задание с указанным id
     * @param integer $id <p>id задания</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM tblTask WHERE intTaskID = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует задание с заданным id
     * @param integer $id <p>id задания</p>
     * @param array $options <p>Массив с информацей о задании</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateTaskById($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE tblTask
            SET 
                txtTaskName = :name, 
                txtTaskInfo = :description, 
                txtTaskExample = :example
            WHERE intTaskID = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $options['id'], PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':example', $options['example'], PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Добавляет новое задание
     * @param array $options <p>Массив с информацией о задании</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createTask($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tblTask '
                . '(txtTaskName, txtTaskInfo, txtTaskExample, intCourseID, txtTaskLatName)'
                . 'VALUES '
                . '(:name, :description, :example, :courseID, :latName)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':example', $options['example'], PDO::PARAM_INT);
        $result->bindParam(':courseID', $options['courseID'], PDO::PARAM_INT);
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
    public static function getFile($id)
    {
        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductFile = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductFile)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductFile;
        }
    }
    
    /**
     * deleteDir - Функция удаления директории при удалении задания
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
                        deleteDirByPath( $tmp );
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
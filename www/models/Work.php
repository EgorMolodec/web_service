<?php

/**
 * Класс Work - модель для работы с отчётами
 */
class Work
{
    /**
     * Возвращает отчёт с указанным id
     * @param integer $id <p>id отчёта</p>
     * @return array <p>Массив с информацией об отчёте</p>
     */
    public static function getReportById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM tblWork WHERE intWorkID = :id';

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
     * Возвращает список отчётов с указанным индентификтором студента
     * @param array $userID <p>Идентификатор студента</p>
     * @return array <p>Массив со списком отчётов</p>
     */
    
        public static function getWorksListByUserId($userID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД

        if (empty($courseID)) {
            $sql = "SELECT * FROM tblReport WHERE intUserID = :userID";
        }
         else {
             if (empty($taskID)) {
                 $sql = "SELECT * FROM tblReport WHERE intUserID = :userID AND intCourseID = :courseID";
             }
             else {
                 $sql = "SELECT * FROM tblReport WHERE intUserID = :userID AND intCourseID = :courseID AND intTaskID = :taskID";
             }
         }

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $reports = array();
        while ($row = $result->fetch()) {
            $reports[$i]['intReportID'] = $row['intReportID'];
            $reports[$i]['intWorkID'] = $row['intWorkID'];
            $reports[$i]['txtResult'] = $row['txtResult'];
            $reports[$i]['intDate'] = $row['intDate'];

            $i++;
        }
        return $reports;
    }

    
     /**
     * Добавляет новое задание
     * @param array $options <p>Массив с информацией о задании</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createWork($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tblReport '
                . '(intCourseID, intTaskID, intWorkID, intUserID, txtResult, intDate)'
                . 'VALUES '
                . '(:intCourseID, :intTaskID, :intWorkID, :intUserID, :txtResult, :intDate)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':intCourseID', $options['intCourseID'], PDO::PARAM_INT);
        $result->bindParam(':intTaskID', $options['intTaskID'], PDO::PARAM_INT);
        $result->bindParam(':intWorkID', $options['intWorkID'], PDO::PARAM_INT);
        $result->bindParam(':intUserID', $options['intUserID'], PDO::PARAM_INT);
        $result->bindParam(':txtResult', $options['txtResult'], PDO::PARAM_STR);
        $result->bindParam(':intDate', $options['intDate'], PDO::PARAM_INT);

        
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
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }


}
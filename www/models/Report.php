<?php

/**
 * Класс Report - модель для работы с отчётами
 */
class Report
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
        $sql = 'SELECT * FROM tblReport WHERE intReportID = :id';

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
     * Возвращает список отчётов с указанным индентификтором курса
     * @param array $courseID <p>Идентификатор курса</p>
     * @return array <p>Массив со списком отчётов</p>
     */
    public static function getReportsListByCourseId($courseID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT * FROM tblReport WHERE intCourseID = :courseID";

        $result = $db->prepare($sql);
        $result->bindParam(':intReportID', $intReportID, PDO::PARAM_INT);
        
        // Выполнение комaнды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $reports = array();
        while ($row = $result->fetch()) {
            $reports[$i]['intReportID'] = $row['intReportID'];
            $reports[$i]['intTaskID'] = $row['intTaskID'];
            $reports[$i]['intUserID'] = $row['intUserID'];
            $reports[$i]['txtWorkPath'] = $row['txtWorkPath'];
            $reports[$i]['txtResult'] = $row['txtResult'];
            $reports[$i]['intDate'] = $row['intDate'];

            $i++;
        }
        return $reports;
    }
    
    /**
     * Возвращает список отчётов с указанным индентификтором задания
     * @param array $taskID <p>Идентификатор задания</p>
     * @return array <p>Массив со списком отчётов</p>
     */

    public static function getReportsListByTaskId($courseID, $taskID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT * FROM tblReport WHERE intCourseID = :courseID AND intTaskID = :taskID";

        $result = $db->prepare($sql);
        $result->bindParam(':intReportID', $intReportID, PDO::PARAM_INT);
        
        // Выполнение комaнды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $reports = array();
        while ($row = $result->fetch()) {
            $reports[$i]['intReportID'] = $row['intReportID'];
            $reports[$i]['intUserID'] = $row['intUserID'];
            $reports[$i]['txtWorkPath'] = $row['txtWorkPath'];
            $reports[$i]['txtResult'] = $row['txtResult'];
            $reports[$i]['intDate'] = $row['intDate'];

            $i++;
        }
        return $reports;
    }
    
    /**
     * Возвращает список отчётов с указанным индентификтором студента
     * @param array $userID <p>Идентификатор студента</p>
     * @return array <p>Массив со списком отчётов</p>
     */
    
        public static function getReportsListByUserId($userID)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД

        $sql = "SELECT * FROM tblReport WHERE intUserID = :userID";

        // Используется подготовленный запрос

        $result = $db->prepare($sql);
        $result->bindParam(':userID', $userID, PDO::PARAM_INT);
        
        // Выполнение комaнды
        $result->execute();
        
        $reportsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $reportsList[$i]['intReportID'] = $row['intReportID'];
            $reportsList[$i]['intTaskID'] = $row['intTaskID'];
            $reportsList[$i]['intCourseID'] = $row['intCourseID'];
            $reportsList[$i]['txtWorkPath'] = $row['txtWorkPath'];
            $reportsList[$i]['intUserID'] = $row['intUserID'];
            $reportsList[$i]['txtResult'] = $row['txtResult'];
            $reportsList[$i]['intDate'] = $row['intDate'];            
            $i++;
        }
        return $reportsList;
    }

    
     /**
     * Добавляет новое задание
     * @param array $options <p>Массив с информацией о задании</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createReport($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO tblReport '
                . '(intCourseID, intTaskID, txtWorkPath, intUserID, txtResult, intDate)'
                . 'VALUES '
                . '(:intCourseID, :intTaskID, :txtWorkPath, :intUserID, :txtResult, :intDate)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':intCourseID', $options['intCourseID'], PDO::PARAM_INT);
        $result->bindParam(':intTaskID', $options['intTaskID'], PDO::PARAM_INT);
        $result->bindParam(':txtWorkPath', $options['txtWorkPath'], PDO::PARAM_STR);
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

    
    public static function checkWork($path)
    {
        $result = 'ok result';
        
        return $result;
    }
}

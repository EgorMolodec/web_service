<?php

/**
 * Контроллер ReportController
 * Управление отчётами 
 */
class ReportController extends AdminBase
{

    /**
     * Action для страницы "Управление курсами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    /**
     * Action для страницы "Отчёт по курсу"
     */
    public function actionCourse($courseId)
    {       
        // Проверка доступа
        self::checkAdmin();
        
        $coursesList = Course::getCoursesList();
        
        /*if ($courseId != null) {
            $reportsList = Report::getReportsListByCourseId($intCourseID);
                //var_dump($reportsList) ;

                if ($reportsList != NULL) {
                    
                    foreach ($reportsList as $report) {
                     $task = Task::getTaskById($report['intTaskID']);
                        echo "<tr>
                            <td>" . $report['intDate'] . "</td>" ;
                        echo "<td>
                                <a href='/report/task/" . $report['intTaskID'] . "'>" .
                                     $task['txtTaskName'] .
                                "</a>
                            </td>";
                        echo "<td>
                                <a href='/report/student/" . $report['intUserID'] . "'>" .
                                    $report['intUserID'] .
                                "</a>
                            </td>";
                        echo "<td>" . $report['txtWorkPath'] . "</td>
                            <td>" . $report['txtResult'] . "</td>
                        </tr>";

                    }
                }
                else {

                    echo '<tr><td></td>'
                                . '<td></td>'
                                . '<td></td>'
                                . '<td></td>'
                                . '<td></td>'
                            . '</tr>';
                    //header("Location: /report/course");
                }
        }*/

        /*if ($courseId != null) {
            $reportsList = Report::getReportsListByCourseId($courseId);
            
         }
         if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $courseId = $_POST['courseName'];

            // Флаг ошибок в форме
            $errors = false;
            
            // При необходимости можно валидировать значения нужным образом
            if (!isset($courseId) || empty($courseId)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый курс
                //$reportsList = Report::getReportsListByCourseId($courseId);
                
                //Report::showTable($reportsList, $courseId);            
                // Перенаправляем пользователя на главную страницу
                header("Location: /report/course/");
            }
        }*/
        // Обработка формы
        /*if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $courseId = $_POST['courseName'];

            // Флаг ошибок в форме
            $errors = false;
            
            // При необходимости можно валидировать значения нужным образом
            if (!isset($courseId) || empty($courseId)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый курс
                $reportsList = Report::getReportsListByCourseId($courseId);
                //Report::showTable($reportsList, $courseId);            
                // Перенаправляем пользователя на главную страницу
                header("Location: /report/course/" . $courseId);
            }
        } */
        

        // Подключаем вид
        require_once(ROOT . '/views/report/course.php');
        return true;
    }

    /**
     * Action для страницы "Отчёт по заданию"
     */
    public function actionTask()
    {       
        // Проверка доступа
        self::checkAdmin();
        
        $coursesList = Course::getCoursesList();

//        if ($task != NULL) {
//            $reportIDs = Report::getReportsListByTaskId($task);
//        }
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $courseId = $_POST['courseName'];
            $taskId = $_POST['taskName'];

            // Флаг ошибок в форме
            $errors = false;
            
            // При необходимости можно валидировать значения нужным образом
            if (!isset($courseId) || empty($courseId)) {
                $errors[] = 'Заполните поля';
            }
            
            if (!isset($taskId) || empty($taskId)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый курс
                $reportIDs = Report::getReportsListByTaskId($courseId, $taskId);
                                
                // Перенаправляем пользователя на главную страницу
                //header("Location: /admin/");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/report/task.php');
        return true;
    }
    
        /**
     * Action для страницы "Отчёт по заданию"
     */
    public function actionStudent($studentID = null)
    {       
        // Проверка доступа
        self::checkAdmin();
        
        $studentsList = User::getUsersList();
        //$reportIDs = Report::getReportsListByUserId($studentId, $courseId, $taskId);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $courseId = $_POST['courseName'];
            $taskId = $_POST['taskName'];
            $studentId = $_POST['student'];

            // Флаг ошибок в форме
            $errors = false;
            
            // При необходимости можно валидировать значения нужным образом
            if (!isset($studentId) || empty($studentId)) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый курс
                $reportIDs = Report::getReportsListByUserId($studentId, $courseId, $taskId);
                                
                // Перенаправляем пользователя на главную страницу
                //header("Location: /admin/");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/report/student.php');
        return true;
    }
    
    public static function actionShowTable($intCourseID){
 
        $reportsList = Report::getReportsListByCourseId($intCourseID);
                var_dump($reportsList) ;

        if ($reportsList != NULL) {
            echo 'here';
            foreach ($reportsList as $report) {
             $task = Task::getTaskById($report['intTaskID']);
                echo "<tr>
                    <td>" . $report['intDate'] . "</td>" ;
                echo "<td>
                        <a href='/report/task/" . $report['intTaskID'] . "'>" .
                             $task['txtTaskName'] .
                        "</a>
                    </td>";
                echo "<td>
                        <a href='/report/student/" . $report['intUserID'] . "'>" .
                            $report['intUserID'] .
                        "</a>
                    </td>";
                echo "<td>" . $report['txtWorkPath'] . "</td>
                    <td>" . $report['txtResult'] . "</td>
                </tr>";
        
            }
        }
        else {
            
            echo '<tr><td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                        . '<td></td>'
                    . '</tr>';
            //header("Location: /report/course");
        }
         

    }
    
    public static function actionShowCourseTable($intCourseID){
        $reportsList = Report::getReportsListByCourseId($intCourseID);
        
        foreach ($reportsList as $report) {
             $task = Task::getTaskById($report['intTaskID']);
                echo "<tr>
                    <td>" . $report['intDate'] . "</td>" ;
                echo "<td>
                        <a href='/report/task/" . $report['intTaskID'] . "'>" .
                             $task['txtTaskName'] .
                        "</a>
                    </td>";
                echo "<td>
                        <a href='/report/student/" . $report['intUserID'] . "'>" .
                            $report['intUserID'] .
                        "</a>
                    </td>";
                echo "<td>" . $report['txtWorkPath'] . "</td>
                    <td>" . $report['txtResult'] . "</td>
                </tr>";
        }
    }
}
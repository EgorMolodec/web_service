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
    public function actionCourse()
    {       
        // Проверка доступа
        self::checkAdmin();
        
        $coursesList = Course::getCoursesList();
        
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
        /*if (isset($_POST['submit'])) {
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
        }*/

        // Подключаем вид
        require_once(ROOT . '/views/report/task.php');
        return true;
    }
    
        /**
     * Action для страницы "Отчёт по заданию"
     */
    public function actionStudent()
    {       
        // Проверка доступа
        self::checkAdmin();
        
        $studentsList = User::getStudentsList();
        //$reportIDs = Report::getReportsListByUserId($studentId, $courseId, $taskId);
        
        // Обработка формы
        /*if (isset($_POST['submit'])) {
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
        }*/

        // Подключаем вид
        require_once(ROOT . '/views/report/student.php');
        return true;
    }
    
    
    public function actionShowCourseTable($intCourseID){
        $reportsList = Report::getReportsListByCourseId($intCourseID);
        
        if ($reportsList == null) {
            $msg = "По данному курсу нет отчётов";
            echo $msg;
        }
        
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
                        <a href='/report/showStudentTable/" . $report['intUserID'] . "'>" .
                            $report['intUserID'] .
                        "</a>
                    </td>";
                echo "<td>"
                        . "<a href=" . $report['txtWorkPath'] . "'>" .
                            $report['txtWorkName'] 
                        . "</a>"
                    . "</td>";
                echo    "<td>" . $report['txtResult'] . "</td>
                    
                </tr>";
        }
        
        
        return true;
    }
    
    public function actionShowStudentTable($intStudentID){
        $reportsList = Report::getReportsListByStudentId($intStudentID);
        
        if ($reportsList == null) {
            $msg = "У данного студента нет загруженных отчётов";
            echo $msg;
        }
        
        foreach ($reportsList as $report) {
            $course = Course::getCourseById($report['intCourseID']);
             $task = Task::getTaskById($report['intTaskID']);
                echo "<tr>
                    <td>" . $report['intDate'] . "</td>" ;
                echo "<td>
                        <a href='/report/course/" . $report['intCourseID'] . "'>" .
                             $course['txtCourseName'] .
                        "</a>
                    </td>";
                echo "<td>
                        <a href='/report/task/" . $report['intTaskID'] . "'>" .
                             $task['txtTaskName'] .
                        "</a>
                    </td>";
//                echo "<td>
//                        <a href='/report/student/" . $report['intUserID'] . "'>" .
//                            $report['intUserID'] .
//                        "</a>
//                    </td>";
                echo "<td>" . $report['txtWorkPath'] . "</td>
                    <td>" . $report['txtResult'] . "</td>
                </tr>";
        }
        
        echo '<script type="text/javascript">$("#studentName").</script>';
        require_once(ROOT . '/views/report/student.php');
        return true;
    }

        
}

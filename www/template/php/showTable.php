<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('../../models/Report.php');
include_once('../../components/Db.php');


        $reportsList = Report::getReportsListByCourseId($_POST[$intCourseID]);

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


?>

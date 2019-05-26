<?php 
    echo 'hello';
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        
        
        $tasksList = Task::getTasksListByCourse($_POST['course']);

        echo"<option value=''>выберите task</option>";

        while ($row = mysql_fetch_array($result))  // mysql_fetch_array
        {
           echo "<option value='".$row["intTaskID"]."'>".$row["txtTaskName"]."</option>";
        }
        
        return $tasksList;
    }   
?>

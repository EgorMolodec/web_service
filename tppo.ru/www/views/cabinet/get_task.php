<?php 
    echo"<option value=''>Выберите задание</option>";
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) 
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
		$tasksList = Task::getTasksListByCourse($_POST['intCourseID']);
		echo"<option value=''>Выберите задание</option>";
		while ($row = mysql_fetch_array($result))  // mysql_fetch_array
		{
			echo "<option value='".$row["intTaskID"]."'>".$row["txtTaskName"]."</option>";
		}
	}else {
        echo "error";
    }
?>


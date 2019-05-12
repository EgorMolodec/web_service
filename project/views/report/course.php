<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<script type="text/javascript" src="../../template/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sub_report').css('display', 'none');
    
    $("#courseName").change(function() {
		clearlist();
		var coursevalue = $("#courseName option:selected").val();
		//if (countryvalue === '') {clearlist(); }
		if (coursevalue === '') {clearlist(); $('#get_task').css('display', 'none');  }
		showReports();
	})
    
    function showReports(){
        var course_value = $("#courseName option:selected").val();
	//var p_id = $("#page_id").val();
	var task = $("#get_task");
	var gettask_value = task.val();
	if (course_value === "") {
		task.attr("disabled",true);
	} else {
		task.attr("disabled",false);
		task.load('get_task.php', {course : course_value});      //, page_id : p_id
		$('#sub_task').css('display', 'block');
	}

    }
       
    function clearlist() {
	$("#get_task").empty();

    }
});  

</script>

<section>
    <div class="container">
        <div class="row">

            <br/>



            <h4>Посмотреть отчёты по курсу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label for="courseName">Курс: </label>
                        <select name="courseName" id="courseName">
                            <?php 
                            echo '<option value="">Выберете курс</option>';

                            foreach ($coursesList as $course) {
                                unset($id, $name);
                                $id = $course['intCourseID'];
                                $name = $course['txtCourseName']; 
                                echo '<option value="'.$id.'">'.$name.'</option>';

                            } 
                            ?>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Показать">

                        <br/><br/>

                    </form>
                    
                    <table id="sub_report">
                        <thead>
                            <tr>
                                <th>Дата загрузки</th>
                                <th>Задание</th>
                                <th>Студент</th>
                                <th>Работа</th>
                                <th>Результат</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportIDs as $report): ?>
                                <tr>
                                    <td><?php echo $report['intDate']; ?></td>
                                    <td>
                                        <a href="/report/task/<?php echo $report['intTaskID']; ?>">
                                            <?php echo $report['txtTaskName']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/report/student/<?php echo $report['intUserID']; ?>">
                                            <?php echo $report['intUserID']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $report['intWorkID']; ?></td>
                                    <td><?php echo $report['txtResult']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


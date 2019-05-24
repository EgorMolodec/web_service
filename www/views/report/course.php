<?php include '/views/layouts/header_admin.php'; ?>

<script type="text/javascript" src="../../template/js/jquery.js"></script>
<!--script type="text/javascript">
$(document).ready(function() {
    //$('#sub_report').css('display', 'none');
    
   $("#btn").click(function() {
		var report = $('#sub_sub_report');
		var course_value = $("#courseName option:selected").val();
		//if (countryvalue === '') {clearlist(); }
		if (coursevalue === '') {
                    clearlist(); 
                    //report.css('display', 'none');  
                }
		else { 
                    report.attr('disabled', false);
                    report.load('../../template/php/showTable.php', {$intCourseID : course_value});
                }
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
		      //, page_id : p_id
		$('#sub_task').css('display', 'block');
	}

    }
       
    function clearlist() {
	$("#get_task").empty();

    }
});  

</script-->

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
                    
                    <table id="sub_report" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Дата загрузки</th>
                                <th>Задание</th>
                                <th>Студент</th>
                                <th>Работа</th>
                                <th>Результат</th>
                            </tr>
                        </thead>
                        <tbody id="sub_sub_report">
                            <?php //if ($courseId != null): ?>
                                <?php foreach ($reportsList as $report): $task = Task::getTaskById($report['intTaskID']); ?>
                                    <tr>
                                        <td><?php $report['intDate']; ?></td>
                                        <td>
                                            <a href='/report/task/<?php $report['intTaskID']; ?>'>
                                                <?php $task['txtTaskName']; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='/report/student/<?php $report['intUserID']; ?>'>
                                                <?php $report['intUserID']; ?>
                                            </a>
                                        </td>
                                        <td><?php $report['txtWorkPath']; ?></td>
                                        <td><?php $report['txtResult']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php //endif; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


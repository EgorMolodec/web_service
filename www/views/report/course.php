<?php include '/views/layouts/header_admin.php'; ?>

<script type="text/javascript" src="/template/js/jquery.js"></script>
<!--script type="text/javascript" src="/template/js/getReportsForCourse.js"></script-->
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#send").click(function(){
                var course_value = $("#courseName option:selected").val();

                if (course_value !== "") {
                    $.post("/template/php/showTable.php", { intCourseID: course_value },           //"/report/showCourseTable/"+course_value
                                function(data) {
                                     alert(data) ; 
                                     $("#sub_sub_report").html(data); 
                                })
                }
                else {
                    alert("No reports"); 
                }
        });
    })
    
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
                    <!--form action="#" method="post" enctype="multipart/form-data">

                        <label for="courseName">Курс: </label>
                        <select name="courseName" id="courseName">
                    
                            <?php 
//                            echo '<option value="">Выберете курс</option>';
//
//                            foreach ($coursesList as $course) {
//                                unset($id, $name);
//                                $id = $course['intCourseID'];
//                                $name = $course['txtCourseName']; 
//                                echo '<option value="'.$id.'">'.$name.'</option>';
//
//                            } 
                            ?>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Показать">

                        <br/><br/>

                    </form-->
                    
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
                    <button id="send">Показать</button>
                    
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
                            <?php 
//                                foreach ($reportsList as $report) {
//                                    $task = Task::getTaskById($report['intTaskID']);
//                                    echo "<tr>
//                                            <td>" . $report['intDate'] . "</td>
//                                            <td>
//                                                <a href='/report/task/" . $report['intTaskID'] . "'>"
//                                                    . $task['txtTaskName'] .
//                                                "</a>
//                                            </td>
//                                            <td>
//                                                <a href='/report/student/" . $report['intUserID'] . "'>"
//                                                    . $report['intUserID'] .
//                                                "</a>
//                                            </td>
//                                            <td>" . $report['txtWorkPath'] . "</td>
//                                            <td>" . $report['txtResult'] . "</td>
//                                        </tr>";
//                                }
//                                
//                                
//             
                            ?>

                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


<?php include ROOT . '/views/layouts/header_stud.php'; ?>

<!--script type="text/javascript" src="../../template/js/chooseTask.js"></script-->
<!--script type="text/javascript">
    $(document).ready(function(){
        $(get_course).change(function(){
            var course_val = $("#get_course option:selected").val();
//            $(get_task).load("/cabinet/get_task/" + course_val, {});
//            $.post("get_task.php", { course: course_val }, function (data) {
//                $("#get_task").html(data);
//            })
            var data1 = $.ajax({
                    type: "POST",
                    url: "get_task.php",
                    data: { course: course_val},
                    async: false,
                     dataType: "html"

                        });
            data1.done(function(msg) { $(get_task).html(msg); });
        })
    })
</script-->

<script type="text/javascript"> 
$(document).ready(function () { 

//$('#sub_task').css('display', 'none'); 

$("#get_course").change(function() { 
clearlist(); 
var course_value = $("#get_course option:selected").val(); 

if (course_value === '') {clearlist(); $('#sub_task').css('display', 'none'); } 
getTask(); 
}) 
//getarea(); 
//getcity(); 

function getTask() { 
var course_value = $("#get_course option:selected").val(); 
var p_id = $("#page_id").val(); 
var task = $("#get_task"); 
var getTask_value = task.val(); 
if (course_value === "") { 
task.attr("disabled",true); 
} else { 
task.attr("disabled",false); 
$('#sub_task').css('display', 'block'); 
task.load('get_task.php',{intCourseID : course_value, page_id : p_id}); 

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
            <div style="margin-left:20px">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="get_course">Курс: </label>
                        <select id="get_course" name="get_course">
                            <?php 
                                echo '<option value="">Выберите курс</option>';
                                foreach ($coursesList as $course) {
                                    unset($id, $name);
                                    $id = $course['intCourseID'];
                                    $name = $course['txtCourseName']; 
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                } 
                            ?>
                        </select>
                    </div> 
<p>&nbsp;</p>					
                    <div id="sub_task">
                        <label for="get_task">Задание: </label>
                        <select name="get_task" id="get_task">
                            <?php
                                echo '<option value="">Выберите курс</option>';                                    
                            ?>
                            <option value="14">Выбрать задание</option>
                        </select>
                    </div>
					<p>&nbsp;</p>
                    <input type="file" name="file" placeholder="Выбор файла"/>
                    <p>&nbsp;</p>
					<input type="submit" name="submit" style="color:white" class="btn btn-new" value="Загрузить и проверить" />
                </form>            
            </div>
        </div>
        <p>&nbsp;</p>
		<table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Курс</th>
                    <th scope="col">Задание</th>
                    <th scope="col">Название файла</th>
                    <th scope="col">Дата загрузки</th>
                    <th scope="col">% схожести</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                    foreach ($reportsList as $report): ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                        <?php   $course = Course::getCourseById($report['intCourseID']);
                            echo $course['txtCourseName']; ?>
                    </td>
                    <td>
                        <?php   $task = Task::getTaskById($report['intTaskID']);
                            echo $task['txtTaskName']; ?>   
                    </td>
                    <td>
                        <a href="<?php echo $report['txtWorkPath']; ?>">
                            <?php echo $report['txtWorkName']; ?>
                        </a>
                    </td>
                    <td><?php echo $report['intDate']; ?></td>
                    <td><?php echo $report['txtResult']; ?></td>
                </tr>
                <?php $i++ ; endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include ROOT .'/views/layouts/footer.php'; ?>
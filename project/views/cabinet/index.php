<?php include ROOT . '/views/layouts/header.php'; ?>

<script type="text/javascript" src="../../template/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sub_task').css('display', 'none');
    
    $("#get_course").change(function() {
		clearlist();
		var coursevalue = $("#get_course option:selected").val();
		//if (countryvalue === '') {clearlist(); }
		if (coursevalue === '') {clearlist(); $('#get_task').css('display', 'none');  }
		chooseTask();
	})
    
    function chooseTask(){
        var course_value = $("#get_course option:selected").val();
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
            <h1>Кабинет студента</h1>
            
            <br><br>
            
            <h3>Привет, <?php echo $user['email'];?>!</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <input type="text" name="courseName" placeholder="Выбор курса"/>
                <input type="text" name="taskName" placeholder="Выбор задания"/>

                <div>
                    <label for="get_course">Курс: </label>
                    <select name="get_course" id="get_course">
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
                </div>   
                    
                <div id="sub_task">
                    <label for="get_task">Задание: </label>
                    <select name="get_task" id="get_task">
                    </select>
                </div>
                
                <input type="file" name="file" placeholder="Выбор файла"/>
                <input type="submit" name="submit" class="btn btn-default" value="Загрузить и проверить" />
            </form>
            
        </div>
        
                <table class="table table-striped">
                <thead>
                        <tr>
                            <th scope="col">#</th>
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
                            <td>$i</td>
                            <td>
                                <a href="/upload/.../">
                                    <?php echo $course['txtCourseName']; ?>
                                </a>
                            </td>
                            <td><?php echo $report['intDate']; ?></td>
                            <td><?php echo $report['txtResult']; $i++; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
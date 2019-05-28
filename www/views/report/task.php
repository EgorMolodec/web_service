<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="/template/js/chooseTask.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#send").click(function(){

                var course_value = $("#get_course option:selected").val();
                var task_value = $("#get_task option:selected").val();

                if (course_value !== "" && task_value !== "") {
                    $.post("/report/showTaskTable/"+course_value+"/"+task_value, {  },     
                                function(data) {
                                     //alert(data) ; 
                                     $("#sub_sub_report").html(data); 
                                })
                }
                else {
                    $("#sub_sub_report").empty();
                    alert("Нужно выбрать курс"); 
                }
        });
    })
    
</script>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <h4>Посмотреть отчёты по заданию</h4>

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

                    <div>
                        <label for="get_course">Курс: </label>
                        <select name="get_course" id="get_course">
                            <?php 
                            echo '<option value="">Выберете курс</option>';

                            foreach ($coursesList as $course) {
                                unset($id, $name);
                                $id = $course['intCourseID'];
                                $name = $course['txtCourseName']; 
                                
                                if($intCourseID == $id) {
                                    echo '<option value="'.$id.'" selected="true">'.$name.'</option>';
                                    echo '';
                                }
                                else 
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                            } 
                            ?>
                        </select>
                    </div>   

                    <div id="sub_task">
                    
                        <label for="get_task">Задание</label>
                        <select id="get_task" name="get_task">
                        </select>
                    </div>
                    
                    <button id="send">Показать</button>
                    
                    <table id="sub_report" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Дата загрузки</th>
                                <th>Студент</th>
                                <th>Работа</th>
                                <th>Результат</th>
                            </tr>
                        </thead>
                        <tbody id="sub_sub_report">

                        </tbody>
                        
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
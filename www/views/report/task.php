<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<script type="text/javascript">
    $(document).ready(function(){
        //$("#sub_task").css('display', 'none');
        
        $("#send").click(function(){
            $("#taskName").empty();
            
            var course_value = $("#courseName option:selected").val();
            
            if (course_value !== ''){
                $("#sub_task").css('display', 'block');
                $("#taskName").css('disabled', false);
                $("#taskName").load('/template/php/get_task.php',{ intCourseID: course_value} );
            }
            else {
                $("#taskName").empty();
                $("#taskName").css('disabled', true);
                $("#sub_task").css('display', 'none');
            }
        })
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
                    
                    <label>Курс</label>
                    <select id="courseName" name="courseName">
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
                    
                    <div id="sub_task">
                        <label for="taskName">Задание</label>
                        <select id="taskName" name="taskName">
                            
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
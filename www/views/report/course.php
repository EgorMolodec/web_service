<?php include '/views/layouts/header_admin.php'; ?>

<script type="text/javascript" src="/template/js/jquery.js"></script>
<!--script type="text/javascript" src="/template/js/getReportsForCourse.js"></script-->

<script type="text/javascript">
    $(document).ready(function () {
        $("#send").click(function(){

                var course_value = $("#courseName option:selected").val();

                if (course_value !== "") {
                    $.post("/report/showCourseTable/"+course_value, {  },     
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

                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


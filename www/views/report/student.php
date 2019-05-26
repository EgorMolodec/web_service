<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<script type="text/javascript">
    $(document).ready(function (){
        $("#send").click(function(){
            var student_id = $("#StudentName option:selected").val();
            
            if (student_id !== ""){
                $.post("/report/showStudentTable/"+student_id, {  }, 
                            function(data){
                                $("#sub_sub_report").html(data)
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


            <h4>Посмотреть отчёты по студенту</h4>

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
                    
                    <label for="studentName">Студент: </label>
                                <select name="studentName" id="studentName">
                                    <?php 
                                    echo '<option value="">Выберете студента</option>';

                                    foreach ($studentsList as $student) {
                                        unset($id, $name);
                                        $id = $student['intUserID'];
                                        $name = $student['email']; 
                                        echo '<option value="'.$id.'">'.$name.'</option>';

                                    } 
                                    ?>
                                </select>
                    <button id="send">Показать</button>
                    
                    <table id="sub_report" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Дата загрузки</th>
                                <th>Курс</th>
                                <th>Задание</th>
                                <!--th>Студент</th-->
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
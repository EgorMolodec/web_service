<?php include ROOT . '/views/layouts/header.php'; ?>

<!--script type="text/javascript" src="../../template/js/chooseTask.js"></script-->
<script type="text/javascript">
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
</script>
<section>
    <div class="container">
        
        <div class="row">
            <div  class="container">
                <h1>Кабинет студента</h1>
                <p id="pika"></p>
                <br><br>

                <h3 style="font-variant: small-caps;font-size: 40px; color: #1E90FF"><?php echo $user['email'];?></h3>
            </div>

            <div style="margin-left:20px">
                <form action="#" method="post" enctype="multipart/form-data">

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
                                    <?php
                                        echo '<option value="">Выберете курс</option>';                                    
                                    ?>
                                    <option value="14">xnj-nj</option>
                                </select>
                            </div>

                            <input type="file" name="file" placeholder="Выбор файла"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Загрузить и проверить" />
                        </form>            
            </div>
            
            
        </div>
        
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

<?php include ROOT . '/views/layouts/footer.php'; ?>
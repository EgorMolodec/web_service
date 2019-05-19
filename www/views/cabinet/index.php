<?php include ROOT . '/views/layouts/header.php'; ?>

<script type="text/javascript" src="../../template/js/jquery.js"></script>

<section>
    <div class="container">
        
        <div class="row">
            <div  class="container">
                <h1>Кабинет студента</h1>

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
                                <a href="/upload/.../">
                                    <?php   $course = Course::getCourseById($report['intCourseID']);
                                            echo $course['txtCourseName']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="/upload/.../">
                                    <?php   $task = Task::getTaskById($report['intTaskID']);
                                            echo $task['txtTaskName']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $report['txtWorkPath']; ?>">
                                    <?php echo $report['txtWorkPath']; ?>
                                </a>
                            </td>
                            <td><?php echo $report['intDate']; ?></td>
                            <td><?php echo $report['txtResult']; $i++; ?></td>
                        </tr>
                    <?php $i++ ; endforeach; ?>
                </tbody>
        </table>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
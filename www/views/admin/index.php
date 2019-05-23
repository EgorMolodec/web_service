<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<link rel="stylesheet" href="/template/css/main_teacher.css">

<section>
    <div class="wrapper">
        <div class="row">
            
            <br/>
            
            <!--p>Добрый день!</p>
            
            <br/>
            
            <p>Вам доступны такие возможности:</p-->
            <p>         </p>
            <br/>
            
            
                <ul>
                <li class="btn btn-primary"><a href="/course/create/" style="color: white">Добавить курс</a></li>
                <li class="btn btn-primary dropdown-toggle" >
                    <ul>
                        <?php foreach ($coursesList as $course): ?>
                        <li>
                            <a href="/course/view/<?php echo $course['intCourseID']; ?>" style="color: white">
                                <?php echo $course['txtCourseName']; ?>
                            </a>
                        </li>
                            <?php endforeach; ?>
                    </ul>
                </li>
                <li class="btn btn-primary"><a href="/report/course" style="color: white">Отчёт по курсу</a></li>
                <li class="btn btn-primary"><a href="/report/task" style="color: white">Отчёт по заданию</a></li>
                <li class="btn btn-primary"><a href="/report/student" style="color: white">Отчёт по студенту</a></li>

                <li class="btn btn-primary"><a href="/admin/settings" style="color: white">Настройки</a></li>
                
                
                </ul>            
            

            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
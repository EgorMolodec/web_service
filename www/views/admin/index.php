<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="wrapper">
        <div class="row">
            
            <br/>
            
            <p>Добрый день!</p>
            
            <br/>
            
            <p>Вам доступны такие возможности:</p>
            
            <br/>
            
            
                <ul>
                <li class="btn btn-primary"><a href="/course/create/" >Добавить курс</a></li>
                <li class="btn btn-primary dropdown-toggle" >
                    <ul>
                        <?php foreach ($coursesList as $course): ?>
                        <li>
                            <a href="/course/view/<?php echo $course['intCourseID']; ?>">
                                <?php echo $course['txtCourseName']; ?>
                            </a>
                        </li>
                            <?php endforeach; ?>
                    </ul>
                </li>
                <li class="btn btn-primary"><a href="/report/course">Отчёт по курсу</a></li>
                <li class="btn btn-primary"><a href="/report/task">Отчёт по заданию</a></li>
                <li class="btn btn-primary"><a href="/report/student">Отчёт по студенту</a></li>

                <li class="btn btn-primary"><a href="/admin/settings">Настройки</a></li>
                
                
                </ul>            
            

            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
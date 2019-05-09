<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            
            <br/>
            
            <h4>Добрый день!</h4>
            
            <br/>
            
            <p>Вам доступны такие возможности:</p>
            
            <br/>
            
            <ul>
                <li><a href="/course/create/">Добавить курс</a></li>
                <li>
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
                <li><a href="/">Настройки</a></li>
                
                
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
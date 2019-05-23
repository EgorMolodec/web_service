<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">


            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">

                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2><?php echo $course['txtCourseName'];?></h2>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание курса</h5>
                            <?php echo $course['txtCourseInfo'];?>
                        </div>
                        
                        <ul>
                            <?php foreach ($tasksList as $task): ?>
                                <?php if ($task['intCourseID'] == $course['intCourseID']) : ?>
    
                            <li>
                                <a href="/task/view/<?php echo $task['intTaskID']; ?>" style="color: black">
                                    <?php echo $task['txtTaskName']; ?>
                                </a>
                            </li> 
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    
                    
                    <a href="/task/create/<?php echo $course['intCourseID']; ?>" style="color: black">Добавить задание</a>
                    
                    <a href="/course/update/<?php echo $course['intCourseID']; ?>" style="color: black">Редактировать курс</a>

                    <a href="/course/delete/<?php echo $course['intCourseID']; ?>" style="color: black">Удалить курс</a>


                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
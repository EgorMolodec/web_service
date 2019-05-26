<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h3><?php echo $course['txtCourseName'];?></h2>
                            </div><!--/product-information-->
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h4><?php echo $task['txtTaskName'];?></h2>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание курса</h5>
                            <?php echo $task['txtTaskInfo'];?>
                        </div>
						<p>&nbsp;</p>
                         <div class="col-sm-12">
                            <h5>Пример</h5>
                            <a href="/upload/<?php echo $course['txtCourseLatName'];?>/"></a>
                        </div>
                    </div>
					<p>&nbsp;</p>
                    <a href="/task/update/<?php echo $task['intTaskID']; ?>" style="color: green">Редактировать задание</a>
                    &ensp; 	&ensp; 
					<a href="/task/delete/<?php echo $task['intTaskID']; ?>" style="color: red">Удалить задание</a>
                </div><!--/product-details-->
			</div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
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
                            <h5>Описание курса:</h5>
                            <?php echo $course['txtCourseInfo'];?>
							<p>&nbsp;</p>
                        </div>	
						<div class="col-sm-12">
							<a href="/task/create/<?php echo $course['intCourseID']; ?>" style="color:blue">Добавить задание</a>
							&ensp;				
							<a href="/course/update/<?php echo $course['intCourseID']; ?>" style="color: green">Редактировать курс</a>
                    		&ensp;		
							<a href="/course/delete/<?php echo $course['intCourseID']; ?>" style="color: red">Удалить курс</a>
							<p>&nbsp;</p>
					   </div>	
                        <ul>
                            <?php foreach ($tasksList as $task): ?>
                                <?php if ($task['intCourseID'] == $course['intCourseID']) : ?>
									<li>
										<a style="color:black; font-size:20px" href="/task/view/<?php echo $task['intTaskID']; ?>" >
											<?php echo $task['txtTaskName']; ?>
										</a>
									</li> 
									<br>
								<?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div> 
                </div><!--/product-details-->
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h3><?php echo $course['txtCourseName'];?></h3>
                            </div><!--/product-information-->
                        </div>
                        
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h4><?php echo $task['txtTaskName'];?></h4>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <h5>Описание курса</h5>
                            <?php echo $task['txtTaskInfo'];?>
                        </div>
                        
                         <div class="col-sm-12">
                           
                            <?php 
                                   $path =  "/upload/" . $course['txtCourseLatName'] . "/" . $task['txtTaskLatName'] . "/example";
                                   $result = array(); 

                                   if (file_exists(ROOT . $path)) {
                                       $cdir = scandir(ROOT . $path); 
                                       foreach ($cdir as $key => $value) 
                                       { 
                                          if (!in_array($value,array(".",".."))) 
                                          { 
                                             if (is_dir(ROOT . $path . DIRECTORY_SEPARATOR . $value)) 
                                             { 
                                                $result[$value] = dirToArray(ROOT . $path . DIRECTORY_SEPARATOR . $value); 
                                             } 
                                             else 
                                             { 
                                                $result[] = $value; 
                                             } 
                                          } 
                                       }

                                       echo ' <h5>Пример</h5>';
                                       foreach ($result as $file){
                                           echo "<a href='" . $path . "/" . $file . "' style='color:blue' download>" . $file . "</a>";
                                       }
                                   }
                                   
                            ?>
                            
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
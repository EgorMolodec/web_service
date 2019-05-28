<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
	<p>&nbsp;</p>
        <div class="row">
            <br/>
            <h4>Редактировать задание</h4>
            <br/>
            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>Название задания</p>
                        <input type="text" name="name" placeholder="" value="<?php echo $task['txtTaskName']; ?>">
                        <p>&nbsp;</p>
						<p>Описание</p>
                        <input type="text" name="description" placeholder="" value="<?php echo $task['txtTaskInfo']; ?>">
                        <p>&nbsp;</p>
						<p>Пример</p>
                        <br/><br/>                       
                        <input type="submit" name="submit" class="btn btn-new" value="Сохранить">                        
                        <br/><br/>                  
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
	<p>&nbsp;</p>
        <div class="row">
            <br/>
            <h4>Добавить новое задание</h4>
            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>Название задания</p>
                        <input type="text" name="name" placeholder="" value="">
						<p> </p>
                        <p>Описание</p>
                        <input type="text" name="description" placeholder="" value="">
						<p> </p>
                        <p>Файл примера</p>
                        <input type="file" name="example" placeholder="" value="">
                        <p>&nbsp;</p>
                        <input type="submit" name="submit" class="btn  btn-new" style="color:white" value="Сохранить">
                        <br/><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<section>
    <div class="container">
		<p>&nbsp;</p>
        <div class="row">
            <br/>
		    <h4>Добавить новый курс</h4>
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
                    <form action="#" method="post">
                        <p>Название:</p>
                        <input type="text" name="name" placeholder="" value="">
						<p>&nbsp;</p>
                        <p>Описание:</p>
                        <input type="text" name="description" placeholder="" value="">
                        <br><br>
                        <input type="submit" name="submit" class="btn btn-new" style="color:white" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


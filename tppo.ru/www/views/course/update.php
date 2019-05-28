<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
	<p>&nbsp;</p>
        <div class="row">
            <br/>
            <div>
				<h4>Редактировать курс "<?php echo $course['txtCourseName']; ?>"</h4>
				<br/>
				<div class="col-lg-4">
					<div class="login-form">
						<form action="#" method="post">
							<p>Название</p>
							<input type="text" name="name" placeholder="" value="<?php echo $course['txtCourseName']; ?>">
							<p> </p>
							<p>Описание</p>
							<input type="text" name="description" placeholder="" value="<?php echo $course['txtCourseInfo']; ?>">
							<br><br>
							<input type="submit" name="submit" class="btn btn-new" value="Сохранить">
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


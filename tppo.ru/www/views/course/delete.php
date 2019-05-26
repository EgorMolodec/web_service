<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
	<p>&nbsp;</p>
        <div class="row">
            <br/>
            <div>
				<h4>Удалить курс <?php echo $course['txtCourseName']; ?></h4>
				<p>Вы действительно хотите удалить этот курс?</p>
				<p> </p>
				<form method="post">
					<input class="btn btn-otch" style="color:white" type="submit" name="submit" value="Удалить" />
				</form>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


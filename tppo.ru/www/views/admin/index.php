<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<link rel="stylesheet" href="/template/css/main_style.css">
<section>
	<div class="wrapper">
		<div class="content"> 
			<div>
				<p>&nbsp;</p>
				<a class="btn btn-primary prep-btn btn-new" href="/course/create/" style="color: white">Добавить курс</a>
				<p>&nbsp;</p>
				
				<div class="dropdown prep-btn">
					<button class="btn btn-primary dropdown-toggle btn-new" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Выбрать курс
					</button>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">			
						<?php foreach ($coursesList as $course): ?>
							<a class="dropdown-item" href="/course/view/<?php echo $course['intCourseID']; ?>" >
								<?php echo $course['txtCourseName']; ?>
							</a>
						<?php endforeach; ?>
					</div>		
				</div>
				<p>&nbsp;</p>

				<a class="btn btn-primary prep-btn btn-otch" href="/report/course">Отчёт по курсу</a></li>
				<p>&nbsp;</p>

				<a class="btn btn-primary prep-btn btn-otch" href="/report/task">Отчёт по заданию</a></li>
				<p>&nbsp;</p>

				<a class="btn btn-primary prep-btn btn-otch" href="/report/student">Отчёт по студенту</a></li>
				<p>&nbsp;</p>

				<a class="btn btn-primary prep-btn btn-set" style="color:black;" href="/admin/settings">Настройки</a></li>
				<p>&nbsp;</p>                                   
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
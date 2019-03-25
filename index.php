<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
	<title>Document</title>
</head>
<body>
	<?php
		require('connect.php');

		if (isset($_POST['username']) && isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];

			$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
			$result = mysqli_query($connection, $query);

			if ($result){
				$smsg = "Регистрация прошла успешно.";
			} else {
				$flmsg = "Ошибка регистрации!";
			}
		}
	?>
	<div class="container">
		<form class="form-signin" method="POST">
			<h2>Registration</h2>
			<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php }?> 
			<?php if(isset($flmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $flmsg; ?> </div><?php }?> 
			<input type="text" name="username" class="form-control" placeholder="Username" required>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
		</form>
	</div>
</body>
</html>
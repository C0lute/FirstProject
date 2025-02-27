<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Страница регистрации</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <style>

body {
	font-family: "Open Sans",sans-serif;
	background-color: #f4f7f9;;
}

</style>
</head>
<body>
  <div class="header">
  	<h2>Вход</h2>
  </div>
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Логин</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Пароль</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Авторизация</button>
  	</div>
  	<p>
  		У вас нет аккаунта? <a href="register.php">Регистрация</a>
  	</p>
  </form>
</body>
</html>
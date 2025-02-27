<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Регистрация</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
  <style>

body {
	background-color: #f4f7f9;;
 	font-family: "Open Sans",sans-serif;



}

</style>
</head>
<body>
  <div class="header">
  	<h2>Регистрация</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Логин</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Пароль</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Подтвердите пароль</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <label>ФИО</label>
  	  <input type="text" name="fio" value="<?php echo $fio; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
    <div class="input-group">
  	  <label>Номер телефона (11 символов)</label>
  	  <input type="text" name="phone" value="<?php echo $phone; ?>">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Зарегистрировать</button>
  	</div>
  	<p>
  		Если вы зарегистрированы, тогда нажмите <a href="login.php">здесь</a>
  	</p>
  </form>
</body>
</html>
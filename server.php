<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$phone    = "";
$errors = array(); 

// Подсоединение к бд
$db = mysqli_connect('localhost', 'root', '', 'registration');

// Регистрация пользователя
if (isset($_POST['reg_user'])) {
  // получаем все входные значения из формы
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $fio = mysqli_real_escape_string($db, $_POST['fio']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


  // Проверка формы, убедиться что она заполнена ...
  // путем добавления (array_push()) соответствующей ошибки в массив $errors 

  if (empty($username)) { array_push($errors, "Введите имя пользователя"); }
  if (empty($password_1)) { array_push($errors, "Введите пароль"); }
  if (empty($fio)) { array_push($errors, "Введите ФИО"); }
  if (empty($email)) { array_push($errors, "Введите Email"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Пароли не совпадают");
  }
  if ((empty($phone)) || (strlen($phone) != 11)) { array_push($errors, "Введите номер телефона с учетом префикса"); }

  // Проверяем бд, чтобы убедиться что пользователей с таким логином или почтой нет
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' OR phone='$phone' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Имя пользователя занято");
    }
    if ($user['email'] === $email) {
      array_push($errors, "Данная электронная почта уже зарегистрирована");
    }
    if ($user['phone'] === $phone) {
      array_push($errors, "Данный номер телефона уже зарегистрирован");
    }
  }
  
  // Регистрируем пользователя, если в форме нет ошибок
  if (count($errors) == 0) {
  	$password = md5($password_1);//шифровка пароля перед сохранением в бд

  	$query = "INSERT INTO users (username, password, fio, email, phone, root) 
  			  VALUES('$username', '$password', '$fio', '$email', '$phone', '0')";
  	mysqli_query($db, $query);
        if(mysqli_query($db, $query)){?>
          <script>
          alert('Регистрация завершена');
          window.location.href = '/login.php';
          </script>
        <?}
  }
}
// ... 

// Вход пользователя
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Введите имя пользователя");
  }
  if (empty($password)) {
  	array_push($errors, "Введите пароль");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $admin = "SELECT * FROM users WHERE username='$username' AND password='$password' AND root='1'";

  	$results = mysqli_query($db, $query);
    $results01 = mysqli_query($db, $admin);
  	if (mysqli_num_rows($results) == 1 ) {
      if (mysqli_num_rows($results01) == 1 ){
        $_SESSION['admin'] = "$username";
        header('location: index.php');
      }
      else{
              
        $_SESSION['username'] = $username;
        header('location: index.php');
      }



        
    } 
     
    else {
  		array_push($errors, "Неправильный логин или пароль");
  	}
  }

}

?>

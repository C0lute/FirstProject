<?php include('server.php');
  session_start(); 


  if (!isset($_SESSION['username']) && !isset($_SESSION['admin']))  {

  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }





  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['admin']);
  	header("location: login.php");
  }
  if (isset($_POST['reg_user1'])) {
  $T1 = mysqli_real_escape_string($db, $_POST['T1']);
  $T2 = mysqli_real_escape_string($db, $_POST['T2']);
  $T3 = mysqli_real_escape_string($db, $_POST['T3']);
  $T4 = mysqli_real_escape_string($db, $_POST['T4']);
  $T5 = mysqli_real_escape_string($db, $_POST['T5']);
  $T6 = mysqli_real_escape_string($db, $_POST['filename']);


  if (empty($T1)) { array_push($errors, "Введите название проекта"); }
  if (empty($T2)) { array_push($errors, "Введите название корпорации"); }
  if (empty($T3)) { array_push($errors, "Выберите город"); }
  if (empty($T4)) { array_push($errors, "Введите краткое описание"); }
  if (empty($T5)) { array_push($errors, "Введите полное описание"); }
  if (empty($T6)) { array_push($errors, "Выберите файл с расширением .doc"); }

  

    $uploaddir = 'temp/';
    $uploadfile = $uploaddir . basename($_FILES['filename']['name']);
    $file_name_parts = explode('.', $_FILES['filename']['name']);
    $ext = $file_name_parts[count($file_name_parts) - 1];
    $ext = mb_strtolower($ext);
    //потом проверяем окончание файла
    

    if (move_uploaded_file($_FILES['filename']['tmp_name'], $uploadfile)) {
        if(in_array($ext, ['doc'], true)){
        
    
            $download = "temp/".basename($_FILES['filename']['name']);
            if ($_POST){
	        $T1name = $_POST['T1'];
	        $T2name = $_POST['T2'];
	        $T3name = $_POST['T3'];
	        $T4name = $_POST['T4'];
	        $T5name = $_POST['T5'];
            $T6name = $_POST['filename'];
	            $query = "INSERT INTO `project` (`id`,`название_проекта`, `название_корпорации`, `город`, `краткое_описание`, `полное_описание`, `download`) 
					VALUES(NULL, '$T1name', '$T2name', '$T3name', '$T4name', '$T5name', '$download')";
	
	            $q=mysqli_query($db,$query);
	
	            if($q){?>
	                <script>
	                window.location.href = '/index.php';
	                </script>
	            <?}
            }
        }
    }
  }

 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Регистрация проекта</title>
  <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>
<body>
<style>

body {
 background: url("image/bg.jpg");
 background-repeat: repeat;

 font-family: Arial;


}

</style>
  <div class="header">
  	<h2>Регистрация проекта</h2>
  </div>
	
  <form method="post" action="reg.php" enctype="multipart/form-data">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Название проекта</label>
  	  <input type="text" name="T1">
  	</div>
  	<div class="input-group">
  	  <label>Название корпорации</label>
  	  <input type="text" name="T2">
  	</div>
  	<div class="input-group">
  	  <label>Город</label>
		<?php
		@$db_select = mysqli_select_db ($db, $db_base_ref);


		$sql = "SELECT * FROM `city`";
		  $result_select = mysqli_query($db, $sql);
		
		  echo "<select name = 'T3'>";
		  echo "<option value='0'>Выбор</option>";
			while($object = mysqli_fetch_object($result_select)){
		echo "<option value = '$object->id_города' > $object->название </option>";}
		  echo "</select>";
		  ?>
  	
  	</div>
  	<div class="input-group">
  	  <label>Краткое описание</label>
  	  <input type="text" name="T4">
  	</div>
  	<div class="input-group">
  	  <label>Полное описание</label>
  	  <input type="text" name="T5">
  	</div>
    <div>
  	  <input type="file" name="filename">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user1">Зарегистрировать</button>
  	</div>
  	<p>
  	</p>
  	<div class="input-group">
  	  <a href="/index.php">Вернуться</a>
  	</div>
  	<p>
  	</p>
  </form>
</body>
</html>
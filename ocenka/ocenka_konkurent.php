<?php include "../server.php";
  session_start(); 



  if (!isset($_SESSION['admin'])) {

  	$_SESSION['msg'] = "You must log in first";
    session_destroy();
  	header('location: login.php');
  }


  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['admin']);
  	header("location: login.php");
  }

 
 
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../styles/ocenka.css">
  
  <script src="../libs/jq/jquery-3.6.2.min.js"></script>



  <div class="header">
  	<h2>Оценка проекта по конкурентоспособности</h2>
  </div>
  <form method="post" action = "" id = "forma1" name = "form_main" enctype="multipart/form-data"> 
  	<?php include('../errors.php'); ?>
     <input type = "hidden" name = "Kk">  
     <div class="form_1">
          	  <label>Выберите проект</label>
		<?php
		@$db_select = mysqli_select_db ($db, $db_base_ref);


		$sql = "SELECT * FROM `project`";
		  $result_select = mysqli_query($db, $sql);
		
		  echo "<select name = 'T3'>";
		  echo "<option value='0'>Выбор</option>";
			while($object = mysqli_fetch_object($result_select)){
		echo "<option value = '$object->id' > $object->название_проекта </option>";}
		  echo "</select>";
		  ?>
  <label type="text" id = "text">Системные требования (%)</label>
  <input type="text" id = "param_0" name="Model_name_0"> 
  <label type="text" id = "text1">Надежность системы от сбоев (%)</label>
  <input type="text" class = "number" id = "param_1" name="MTBF_0">
  <label type="text" id = "text2">Защита от несанкционированного доступа (%)</label>
  <input type="text" id = "param_2" name="Count_0">
  <label type="text" id = "text2">Удобство представления информации (%)</label>
  <input type="text" id = "param_3" name="Count_1">
  <label type="text" id = "text2">Пользовательский интерфейс (%)</label>
  <input type="text" id = "param_4" name="Count_2">
  <label type="text" id = "text2">Адаптация к потребностям пользователя (%)</label>
  <input type="text" id = "param_5" name="Count_3">
  <label type="text" id = "text2">Простота освоения (%)</label>
  <input type="text" id = "param_6" name="Count_4">



</div>


  	<div class="input-group">
  	  <input type="submit" class="btn" id = "registr" name="ocenka" value="Посчитать" data-number="1">
        
  	</div>
  	<p>
  	</p>
      
  	<div class="input-group">
  	  <a href="/index.php">Вернуться</a>
  	</div>
  	<p>
  	</p>
  </form>

 


<script>

$( document ).ready(function() {
    $(document.forms.form_main).on('submit', function(){
         var parametrs = ["0.189", "0.154", "0.069", "0.09", "0.253", "0.201", "0.043"];
         var Kk = '0';
         var a = 0;
         for (var i = 0; i < 7; i++){     


            var a = parametrs[i];

            par = $('#param_'+i).val();

            Kk = parseFloat(Kk) + (parseFloat(a) * (par / 100));
            console.log(Kk);

            
         }
         $('input[name = "Kk"]').attr('value', Kk); // запись в input значения из перемемнно
         var Formdata=new FormData(document.forms.form_main);
         $.ajax({
            type: "POST",
            url: '/update_konkurent.php',
            data: Formdata,
            processData: false,
            contentType: false,
            success: function (data) {
                 console.log(data);
                 if(data=="Y"){
            	    alert('Проект успешно оценен');
	                //window.location.href = '/index.php';
                    return false;
                 }
                 else{
                    alert("Ошибка");
                    return false;
                 }
            },
         });
         return false;
    });
});
</script> 






</head>
<body>


<style>

body {
 background: url("../image/bg.jpg");
 background-repeat: repeat;

 font-family: Arial;

}

</style>




	
  
</body>
</html>
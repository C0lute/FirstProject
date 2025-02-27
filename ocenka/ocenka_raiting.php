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
  	<h2>Оценка проекта по рейтингу</h2>
  </div>
  <form method="post" action = "" id = "forma1" name = "form_main" enctype="multipart/form-data"> 
  	<?php include('../errors.php'); ?>
     <input type = "hidden" name = "summa">  
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
  <label type="text" id = "text">Колв-во баллов за оценку надежности</label>
  <input type="text" id = "param_0" name="Model_name_0"> 
  <label type="text" id = "text1">Колв-во баллов за оценку стоимость проекта</label>
  <input type="text" class = "number" id = "param_1" name="MTBF_0">
  <label type="text" id = "text2">Колв-во баллов за оценку окупаемости проекта</label>
  <input type="text" id = "param_2" name="Count_0">
  <label type="text" id = "text2">Колв-во баллов за оценку конкурентоспособности</label>
  <input type="text" id = "param_3" name="Count_1">



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
    var summa = 0;
         for (var i = 0; i < 4; i++){     




            par = $('#param_'+i).val();

            summa = parseInt(summa) + parseInt(par);
            console.log(summa);

            
         }
         alert(summa);
         $('input[name = "summa"]').attr('value', summa); // запись в input значения из перемемнно
         var Formdata=new FormData(document.forms.form_main);
         $.ajax({
            type: "POST",
            url: '/update_raiting.php',
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
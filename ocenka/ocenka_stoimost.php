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
  	<h2>Оценка проекта по критерию стоимости</h2>
  </div>
  <form method="post" action = "" id = "forma1" name = "form_main" enctype="multipart/form-data"> 
  	<?php include('../errors.php'); ?>
     <input type = "hidden" name = "schet_all">  
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
      <div class="ocenka_stoimost">
        <div class = ocenka_div>
          <label type="text" id = "text0">Стадия развития</label>
          <input type="text" id = "Stoimost_id_0" name="Razvitie_name">
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text1">Конфликт с законодательством</label>
          <input type="text" class = "number" id = "Stoimost_id_1" name="Konflikt_name">
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text2">Производство и логистика</label>
          <input type="text" id = "Stoimost_id_2" name="Proizvodstvo_name">  
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text3">Продажи и маркетинг</label>
          <input type="text" id = "Stoimost_id_3" name="Sell_name">  
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text4">Конкуренция</label>
          <input type="text" id = "Stoimost_id_4" name="Konkurencia_name">  
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text5">Технологии</label>
          <input type="text" id = "Stoimost_id_5" name="Texnologii_name"> 
        </div>
        <div class = ocenka_div>
          <label type="text" id = "text_6">Репутация</label>
          <input type="text" id = "Stoimost_id_6" name="Rep_name">  
        </div>
      </div>

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
         let schet = 0;
         let schet_all = 0;
         console.log(schet);
         for (let i = 0; i < 7; i++){     
            schet = $('#Stoimost_id_'+i).val();
            console.log(schet); 
            schet_all = parseInt(schet_all) + parseInt(schet);
            console.log(schet_all); 
         }
         schet_all = schet_all * 250000;
         $('input[name = "schet_all"]').attr('value', schet_all); // запись в input значения из перемемнно
         var Formdata=new FormData(document.forms.form_main);
         $.ajax({
            type: "POST",
            url: '/update_stoimost.php',
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
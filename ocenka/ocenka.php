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
  	<h2>Оценка проекта по критерию надежности</h2>
  </div>
  <form method="post" action = "" id = "forma1" name = "form_main" enctype="multipart/form-data"> 
  	<?php include('../errors.php'); ?>
     <input type = "hidden" name = "otkaz_all">  
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
      <div class="ocenka">
        <div class = input-group>
          <label type="text" id = "text">Название компонента</label>
          <input type="text" id = "Model_id_0" name="Model_name_0">
        </div>
        <div class = input-group>
          <label type="text" id = "text1">MTBF (лет)</label>
          <input type="text" class = "number" id = "MTBF_id_0" name="MTBF_0">
        </div>
        <div class = input-group>
          <label type="text" id = "text2">Количество элементов</label>
          <input type="text" id = "Count_id_0" name="Count_0">
        </div>
      </div>
  <span class="add" id = "plus" data-number="0">+</span>
  

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
    
    $('.add').click(function(){

        var number = parseInt($(this).attr('data-number'))+ parseInt(1);
        $(this).attr('data-number', number);
        var text='  <div class="ocenka"><label name="Название компонента оборудования системы'+number+'">Название компонента</label><input type="text" id = "Model_id_'+number+'" name="Model_name_'+number+'"/><label name="MTBF'+number+'">MTBF (лет)</label><input type="text" class = "number" id = "MTBF_id_'+number+'" name="MTBF_name_'+number+'"/><label name="Количество элементов'+number+'">Количество элементов</label><input type="text" id = "Count_id_'+number+'" name="Count_name_'+number+'"/></div>';
        $(this).before(text);
    });

    $(document.forms.form_main).on('submit', function(){
         var number = $('#plus').attr('data-number');
         let otkaz = 0;
         let otkaz_all = 0;
         console.log(number);
         for (let i = 0; i <= number; i++){           
                var MTBF = $('#MTBF_id_'+i).val();

                var Count = $('#Count_id_'+i).val();

                if (Count == 1){
                otkaz = 1 / MTBF;  
                }
                else{
                otkaz = (Math.pow((1 / MTBF), 2)) / 365 * Count;
                }
                console.log(otkaz);
                otkaz_all = parseFloat(otkaz_all) + parseFloat(otkaz);
                console.log("Суммарный отказ системы = "+otkaz_all);
         }
         console.log(otkaz_all);
         console.log("Вероятность отказа оборудования системы в течении года = "+otkaz_all);//вероятность отказа оборудования системы в течение года
         var b = otkaz_all * Math.PI;
         console.log("после умножения на Пи = "+b);
         console.log(b);
         otzal_all = 1 / b;
         d = otzal_all;
         console.log("после деления получили = "+otzal_all);
         b = d + parseFloat(24);
         console.log("b = "+b);
         var c = d / b;
         console.log("c = "+c);
         otkaz_all = 100 * c; //коэффициент готовности оборудования системы
         console.log("В итоге получили = "+otkaz_all);
         $('input[name = "otkaz_all"]').attr('value', otkaz_all); // запись в input значения из перемемнно
         var Formdata=new FormData(document.forms.form_main);
         $.ajax({
            type: "POST",
            url: '/update_nadej.php',
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
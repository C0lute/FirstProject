<!DOCTYPE html>
<html>
<head>
	<title>Поиск проекта</title>
    <script src="../libs/jq/jquery-3.6.2.min.js"></script>
  <style>
   body {
    background: repeat url("../image/bg.jpg");
	font-family: Arial;
	font-size: 14px;
	color: #FFE9A8;
	line-height: 18px;
   }
  </style>
	<link rel="stylesheet" type="text/css" href="../styles/style_index.css">
  <link rel="stylesheet" type="text/css" href="../styles/resolution.css">

</head>
<body>




 <? if($_SESSION['username']) {

  echo
  '<nav>
  <ul class="topmenu">
    <li value="1"><a href="/index.php">На главную</a></li>
    <li id = "li_id_2"value="2"><a href="/reg.php" class="down">Добавить проект</a></li>
    <li><a href="index.php?logout="1"">Выйти</a></li>
  </ul>
</nav>';

}
else{
  echo
            '<nav>
            <ul class="topmenu">
                <li value="1"><a href="/index.php">На главную</a></li>
                <li id = "li_id_2"value="2"><a href="/reg.php" class="down">Добавить проект</a></li>
                <li value="3"><a href="" class="down">Оценить проект</a>
                <ul class="submenu">
                    <li><a href="../ocenka/ocenka.php">Оценка надежности</a></li>
                    <li><a href="../ocenka/ocenka_stoimost.php">Оценка стоимости</a></li>
                    <li><a href="../ocenka/ocenka_okupaemost.php">Оценка окупаемости</a></li>
                    <li><a href="../ocenka/ocenka_konkurent.php">Оценка конкурентоспособности</a></li>
                    <li><a href="../ocenka/ocenka_raiting.php">Рейтинговая оценка</a></li>
                </ul>
                </li>
                <li><a href="" class="down">Поиск проекта по</a>
                <ul class="submenu">
                    <li><a href="./show_project_nazv.php">названию</a>
                    <li><a href="./show_project_corp.php">названию корпорации</a></li>
                    <li><a href="./show_project.php">городу</a></li>
                    <li><a href="./show_project_Kopis.php">краткому описанию</a></li>
                </ul>
                </li>
                     <li class="right"><a href="../logout.php">Выйти</a></li>
            </ul>
            </nav>';
}
?>
<p>
<p>
  <script>
            $('.menu-btn').on('click', function() {
                $('.menu').toggleClass('menu_active');
            })
        </script>







		
</body>
</html>

<?php include "../server.php";
session_start(); 

if (!isset($_SESSION['username']) && !isset($_SESSION['admin'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  unset($_SESSION['admin']);
  header("location: login.php");
}


echo '<form method="POST" action="show_project_corp.php">'; 
echo '<label>Корпорация</label>'; 
echo '<input type="text" name="Corp"></input>'; 
echo '<button type="submit">Найти</button>'; 

$nameCorp=$_POST['Corp']; 
echo '<br>Вы ввели:'; 
echo $nameCorp; 
$seld=mysqli_select_db($db,'project');
if(isset($_POST)) // не пустота
{echo '<table border="2">';
echo '<tr>';//строка 1 
echo '<th>Название корпорации</th>';
echo '<th>Название проекта</th>';
echo '<th>Город</th>';
echo '<th>Краткое описание</th>';
echo '<th>Полное описание</th>';
echo '<th>Надежность системы</th>';
echo '<th>Стоимость проекта</th>';
echo '<th>Окупаемость проекта</th>';
echo '<th>Конкуренция</th>';
echo '<th>Рейтинг</th>';
echo '</tr>'; 
echo '</form>'; 


$query = "Select *  FROM `project`, `city` WHERE `город` = `id_города` and `название_корпорации` LIKE '".$nameCorp."%'"; 

$q=mysqli_query($db,$query);

while($mas = @mysqli_fetch_array($q)) 
{ 
echo '<tr>'; 
echo '<td>'.$mas['название_корпорации'].'</td>';
echo '<td>'.$mas['название_проекта'].'</td>'; 
echo '<td>'.$mas['название'].'</td>';
echo '<td>'.$mas['краткое_описание'].'</td>';
echo '<td>'.$mas['полное_описание'].'</td>'; 
echo '<td>'.$mas['Оценка_надежности'].'</td>'; 
echo '<td>'.$mas['стоимость_проекта'].'</td>'; 
echo '<td>'.$mas['окупаемость_проекта'].'</td>'; 
echo '<td>'.$mas['Оценка_конкурентоспособности'].'</td>'; 
echo '<td>'.$mas['оценка_рейтинга'].'</td>'; 

echo '</tr>'; 
}
echo '</table>'; 
if ($q === false) { 
echo 'Поиск не дал результатов'; 
} 
}



?>


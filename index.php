<?php include('server.php');
  session_start(); 


 
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
  $years;
  function number($n, $titles) {
    $cases = array(2, 0, 1, 1, 1, 2);
    return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
  }

?>

<!DOCTYPE html>
<html>
    <head>
       <script src="libs/jq/jquery-3.6.2.min.js"></script>
       <title>Домашняя страница</title>
       <style>
        body {
        font-family: "Open Sans",sans-serif;
        background-color: #f4f7f9;
        }
       </style>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="./styles/style_index.css">
        <link rel="stylesheet" type="text/css" href="./styles/resolution.css">
       
    </head>
    <body>
    <? 
            if (!isset($_SESSION['username']) && !isset($_SESSION['admin'])) {
            echo
            '<nav>
                <ul class="topmenu">
                       <li value="1"><a href="/index.php">На главную</a></li>
                       <li id = "li_id_2"value="2"><a href="/reg.php" >Добавить проект</a></li>
                       <li class="right"><a href="register.php">Регистрация</a></li>
                       <li class="right"><a href="login.php">Войти</a></li>
                </ul>
            </nav>';

            }
            else {
                if($_SESSION['username']) { //панель обычного пользователя

                    echo
                    '<nav>
                        <ul class="topmenu">
                            <li value="1"><a href="/index.php">На главную</a></li>
                            <li id = "li_id_2"value="2"><a href="/reg.php" >Добавить проект</a></li>
                            <li class="right"><a href="logout.php">Выйти</a></li>
                        </ul>
                    </nav>';
                }
                else{ //панель админа
                    echo
                    '<nav>
                    <ul class="topmenu">
                        <li value="1"><a href="/index.php">На главную</a></li>
                        <li id = "li_id_2"value="2"><a href="/reg.php" class="down">Добавить проект</a></li>
                        <li value="3"><a href="" class="down">Оценить проект</a>
                            <ul class="submenu">
                                <li><a href="./ocenka/ocenka.php">Оценка надежности</a></li>
                                <li><a href="./ocenka/ocenka_stoimost.php">Оценка стоимости</a></li>
                                <li><a href="./ocenka/ocenka_okupaemost.php">Оценка окупаемости</a></li>
                                <li><a href="./ocenka/ocenka_konkurent.php">Оценка конкурентоспособности</a></li>
                                <li><a href="./ocenka/ocenka_raiting.php">Рейтинговая оценка</a></li>
                            </ul>
                        </li>
                        <li value="4"><a href="" class="down">Поиск проекта по</a>
                            <ul class="submenu">
                                <li><a href="search_projects/show_project_nazv.php">названию</a>
                                <li><a href="search_projects/show_project_corp.php">названию корпорации</a></li>
                                <li><a href="search_projects/show_project.php">городу</a></li>
                                <li><a href="search_projects/show_project_Kopis.php">краткому описанию</a></li>
                            </ul>
                        </li>
                        <li value="5" class="right"><a href="logout.php">Выйти</a></li>
                    </ul>
                    </nav>';
                }
            }
       ?>
        <script>
            $('.menu-btn').on('click', function() {
                $('.menu').toggleClass('menu_active');
            })
        </script>
        <h1 style="text-align: center; margin: 3% 0;"> Доступные для просмотра проекты: <br></h1>
        <?php
            $sql = mysqli_query($db, 'SELECT `ID`, `название_проекта`, `Оценка_надежности`, `стоимость_проекта`, `окупаемость_проекта`, `Оценка_конкурентоспособности`, `оценка_рейтинга`, `download` FROM `project`');
            $sql1 = " Select *  FROM `project`, `city` WHERE `город` = `id_города` ORDER BY `оценка_рейтинга` DESC";
            $poisk = "Select `название`  FROM `project`, `city` WHERE `город` = `id_города`";
            $q_1=mysqli_query($db,$sql1);
            $q_2=mysqli_query($db,$poisk);
        ?>
        
        <?php 
            echo "<div class='main_container'>";
            while ($result = mysqli_fetch_array($q_1)){
                  number($n, $titles);
                    echo "
                        <div class='all_news'>
                            <div class='news_h2'><h2>{$result['название_проекта']}</h3></div>
                            <div class='tables'>
                                <div class='table1'>
                                    <p>Название корпорации: ". $result['название_корпорации'] ."</p>
                                        <p>Надежность системы: ". round($result['Оценка_надежности'], 2) ."%</p>
                                        <p>Город: ". $result['название'] ."</p>
                                </div>
                                <div class='table1'>
                                        <p>Сумма инвестиций: ". $result['стоимость_проекта'] ."$</p>
                                        <p>Срок окупаемости: ".$result['окупаемость_проекта']." ".number($result['окупаемость_проекта'], array('год', 'года', 'лет'))."</p>
                                        <p>Рейтинговая оценка: ". $result['оценка_рейтинга'] ." ".number($result['оценка_рейтинга'], array('балл', 'балла', 'баллов'))."</p>

                                </div>
                            </div>
                            <div class='date'><h3 ><a href = '/".$result['download']. "'  download'>Скачать</a></h3></div>
                        </div>";

            }
            echo"</div>";
        ?>
        
    </body>
</html>



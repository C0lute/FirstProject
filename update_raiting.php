<?php include('server.php');
  if ($_POST['summa'] && $_POST['T3']) {

   
	$zapis_summa = "UPDATE `project` SET `оценка_рейтинга` = '".$_POST['summa']."' WHERE `id` = '".$_POST['T3']."'";

    $q=mysqli_query($db,$zapis_summa);
	if ($q){ 
		echo "Y";
	}
	else{
		echo "N";
	}
}
	else{
		echo "N";	
	}





?>

<?php include('server.php');
  if ($_POST['otkaz_all'] && $_POST['T3']) {

   
	$zapis_otkaz = "UPDATE `project` SET `Оценка_надежности` = '".$_POST['otkaz_all']."' WHERE `id` = '".$_POST['T3']."'";

    $q=mysqli_query($db,$zapis_otkaz);
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

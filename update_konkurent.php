<?php include('server.php');
  if ($_POST['Kk'] && $_POST['T3']) {

   
	$zapis_konkurent = "UPDATE `project` SET `Оценка_конкурентоспособности` = '".$_POST['Kk']."' WHERE `id` = '".$_POST['T3']."'";

    $q=mysqli_query($db,$zapis_konkurent);
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

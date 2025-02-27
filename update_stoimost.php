<?php include('server.php');
  if ($_POST['schet_all'] && $_POST['T3']) {

   
	$zapis_schet = "UPDATE `project` SET `стоимость_проекта` = '".$_POST['schet_all']."' WHERE `id` = '".$_POST['T3']."'";

    $q=mysqli_query($db,$zapis_schet);
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

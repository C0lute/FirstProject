<?php include('server.php');
  if ($_POST['i'] && $_POST['T3']) {

   
	$zapis_okupaemost = "UPDATE `project` SET `окупаемость_проекта` = '".$_POST['i']."' WHERE `id` = '".$_POST['T3']."'";

    $q=mysqli_query($db,$zapis_okupaemost);
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

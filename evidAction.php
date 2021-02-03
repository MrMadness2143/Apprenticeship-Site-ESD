<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   

   // check logged in
   if (!isset($_SESSION['id'])) {
      header("Location: index.php");
   }
   
   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");
	
	if(isset($_GET['btnSubmit'])){
		$current = $_GET['btnSubmit'];
	}
	$action = substr($current, 1);
	$eID = substr($current,0,-1);
	
	$sql = "select evidFileP, evidFeed from evidence where evidID = " . $eID;
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$result = mysqli_fetch_array($result);

if($action == 'd'){
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($result['evidFileP']).'"');
	header('Content-Length: ' . filesize($result['evidFileP']));
	header('Pragma: public');
	flush();
	readfile($result['evidFileP'],true);
}else if ($action == 'D'){
	$sql = "DELETE FROM evidID where evidID = ".$eID;
	Mysqli_query();
}else{
	header($result['evidFileP']);
}

echo template("templates/default.php", $data);
?>
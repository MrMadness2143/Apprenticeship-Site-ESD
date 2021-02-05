<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (!isset($_SESSION['id'])) {
      header("Location: index.php");
   }
   
   echo template("templates/partials/header.php");
    $sql = "SELECT adminLV FROM users WHERE userID = ". $_SESSION['id'];
	$admin = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$admin = mysqli_fetch_array($admin);

    if ($admin['adminLV'] = 1){
        echo template("templates/partials/navUser.php");
    }else if($admin['adminLV'] = 2){
        echo template("templates/partials/navTeach.php");
    }else{
        echo template("templates/partials/navAdmin.php");
    }

	
	if(isset($_GET['btnSubmit'])){
		$current = $_GET['btnSubmit'];
	}else{
        header("location: evidTable.php");
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

    
}else{
	header($result['evidFileP']);
}

echo template("templates/default.php", $data);
?>
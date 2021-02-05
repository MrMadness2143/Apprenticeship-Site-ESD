<?php
	include ("_includes/config.inc");
	include ("_includes/dbconnect.inc");
	include ("_includes/functions.inc");

	echo template("templates/partials/header.php");
	
   if (isset($_SESSION['id'])) {
      $data['content'] = "<p>Welcome to your dashboard.";
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
       
      echo template("templates/default.php", $data);
   } else {
      echo template("templates/login.php", $data);
   }
?>
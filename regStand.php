<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

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
    
   
   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details
      $sql = " ";

      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your standard has been registered. You may move to the Standards Page to add evidence</p>"; 

       
   }else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from standtempls;";
      $result = mysqli_query($conn,$sql);

       $data['content'] .= '<table border=' . '3' . ' class="table table-striped">';
       $data['content'] .= '<thead><tr><th colspan=' . '4' . '>Standards</th></tr>';
       $data['content'] .= '<tr align=' . 'left' .'><th>Standard name</th><th>creator</th><th>description</th><th></th></tr></thead><tbody>';
        
        while($row = mysqli_fetch_array($result)){
            $sql = "SELECT userFName, userLName FROM users WHERE userID = " . $row['userID'];
            $templUser = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            $templUser = mysqli_fetch_array($templUser);
            $templUser = $templUser['userFName'] . " " . $templUser['userLName'];
            $data['content'] .= '<tr><td>' . $row['templName'] .'</td><td>' . $templUser . '</td><td>';
            $data['content'] .= $row['templExpl'] . '</td><td><button class="btn-success" type="submit" name="btnSubmit" value ="';
            $data['content'] .= $row['templID'] . '>Reg.</button></td></tr>';
        }
       
       
       

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>

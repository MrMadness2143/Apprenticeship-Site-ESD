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
      $sql = "update users set userFName ='" . mysqli_real_escape_string($conn,$_POST['txtfirstname']) . "',";
      $sql .= "userLName ='" . mysqli_real_escape_string($conn,$_POST['txtlastname'])  . "',";
      $sql .= "userAge ='" . mysqli_real_escape_string($conn,$_POST['txtage'])  . "',";
      $sql .= "userBirth ='" . mysqli_real_escape_string($conn,$_POST['txtbirth'])  . "',";
      $sql .= "userGender ='" . mysqli_real_escape_string($conn,$_POST['txtgender'])  . "',";
      $sql .= "userExpl ='" . mysqli_real_escape_string($conn,$_POST['txtexpl'])  . "',";
      $sql .= "disability ='" . mysqli_real_escape_string($conn,$_POST['txtdisability'])  . "' ";
	  $sql .= "where userID = '" . mysqli_real_escape_string($conn,$_SESSION['id']);
      $sql .= "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>"; 

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from users where userID='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2 class=ml-2>My Details</h2>
   <form  class="form-group ml-4" name="frmdetails" action="" method="post">
   <div class="align-middle form-inline" >
      <label>&nbsp;First Name :&nbsp;</label>
      <input name="txtfirstname" type="text" value="{$row['userFName']}" /><br/>
      <label>&nbsp;Surname :&nbsp;</label>
      <input name="txtlastname" type="text"  value="{$row['userLName']}" /><br/>
   </div>

   <label>&nbsp;Age :&nbsp;</label>
   <input name="txtage" type="text"  value="{$row['userAge']}" /><br/>
   <label>&nbsp;birthday :&nbsp;</label>
   <input name="txtbirth" type="text"  value="{$row['userBirth']}" /><br/>
   <label>&nbsp;Gender :&nbsp;</label>
   <input name="txtgender" type="text"  value="{$row['userGender']}" /><br/>
   <label>&nbsp;About :&nbsp;</label>
   <input name="txtexpl" type="text"  value="{$row['userExpl']}" /><br/>
   <label>&nbsp;Disabilitiy notes :&nbsp;</label>
   <input name="txtdisability" type="text"  value="{$row['disability']}" /><br/>
   <input class="btn-success" type="submit" value="Save" name="submit"/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>

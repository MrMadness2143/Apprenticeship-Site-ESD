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

      // Build SQL statment that selects a student's modules -->
   $sql = "select * from standards where userID = '" . $_SESSION['id'] ."';";

   $result = mysqli_query($conn,$sql);
?>

   <div class ="col-md-8">
   <!-- prepare page content -->
   <table border='1'>
   <tr><th colspan='5' align='center'>Standards</th></tr>
   <tr><th>Title</th><th>creator</th><th>template ID</th><th>description</th><th>view</th></tr>
	<form method="post" action="_includes/apprenticeship-view.inc.php">
      // Display the modules within the html table -->
      while($row = mysqli_fetch_array($result)) {

		 $data['content'] .= "<tr><td></td><td></td>";
         $data['content'] .= "<td> $row[templID] </td><td>$row[standExpl]</td>
		 <td><input type='submit' name='btnView' value='$row[standID]' ></td></tr>";
      }
	  </form>
      $data['content'] .= "</table>";

      // render the template -->
      echo template("templates/default.php", $data);
   ?>
   </div>

<?php
   echo template("templates/partials/footer.php");
?>

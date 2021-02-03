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

	echo $_SESSION['id'];
	
      // Build SQL statment that selects a student's modules -->
   $sql = "select st.templName, s.standID, s.standExpl, u.userFName, u.userLName FROM standards s, standtempls st, users u  WHERE 
		  s.userID = " . $_SESSION['id'] . " and s.templID = st.templID and s.teachID = u.userID;";
   $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

?>
	<style>
		th,td{
			padding: 3px;
		}
	</style>
   <div>
	<form action = "apprenticeship-view.inc.php" method = "GET">
	<table border='3'>
	<tr><th colspan='5' align='center'>Standards</th></tr>
	<tr align='left'><th>Standard name</th><th>teacher</th><th>description</th><th>view</th></tr>
   	  <?php
      // Display the modules within the html table -->

      while($row = mysqli_fetch_array($result)) {
		    $teachName = $row['userFName'] . " " . $row['userLName'];
			$data['content'] .= '<tr><td> ' . $row['templName'] . '</td><td>' . $teachName . '</td>';
			$data['content'] .= '<td>' . $row['standExpl'] . '</td><td><button type="submit" name="btnView" value="' . $row['standID'] . 
			'">View</button></td></tr>';
      }
      $data['content'] .= '</table>';	  
	  
      // render the template -->
      echo template('templates/default.php', $data);
	  ?>
	 </div>
	 <?php
   echo template("templates/partials/footer.php");
?>
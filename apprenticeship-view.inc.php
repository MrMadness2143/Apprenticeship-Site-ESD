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
	
	if(isset($_GET['btnView'])){
		$current = $_GET['btnView'];
	}
	$sql = "SELECT u.userFName, u.userLName, s.standExpl, st.templName FROM users u, standards s, standtempls st WHERE s.standID= "
	. $current . " and s.userID=u.userID and s.templID = st.templID";
	$info =  mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$info = mysqli_fetch_array($info);
	$userName = $info['userFName'] . " " . $info['userLName'];
	$sql = "SELECT k.ksbID, k.standID, k.ksbTitle, k.ksbRequire, k.ksbDesc, k.ksbOrder, k.ksbStatus FROM ksbs k WHERE k.ksbID =" .
	 $current ." ORDER BY k.ksbOrder";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

?>


	<style>
		th,td{
			padding: 3px;
		}
	</style>
   <div>
	<form action = 'evidTable.php' method = "GET">
	<table border='3'>
	
   	  <?php
      // Display the modules within the html table -->
	  $data['content'] .= '<tr><th colspan=' . '5' . "align='center'> " . $info['templName'] . '</th></tr> ';
	  $data['content'] .= '<tr align=' . 'left' . '><th>Title</th><th>Evidence Requirement</th><th>Description</th><th>Status</th><th>Evidence count</th></tr>';
      while($row = mysqli_fetch_array($result)) {
		  $sql = "SELECT count(*) from evidence where ksbId = ". $row['ksbID'];
		  $evidcount = mysqli_query($conn,$sql) or die(mysqli_error($conn));
		  $evidcount = mysqli_fetch_array($evidcount);
			if($row['ksbStatus'] = '0'){
				$status = "Evidence pending";
			}
			else if($row['ksbStatus'] = '1'){
				$status = "Under Review";
			}
			else{
				$status = "Complete";
			}
			$data['content'] .= '<tr><td> ' . $row['ksbTitle'] . '</td><td>' . $row['ksbRequire'] . '</td>';
			$data['content'] .= '<td>' . $row['ksbDesc'] . '</td><td>' . $status . '</td><td><button type="submit" name="btnView" text="';
			$data['content'] .=  '" value="' . $row['ksbID'] . '">' . $evidcount['count(*)'] .'</button></td></tr>';
      }
      $data['content'] .= '</table>';	  
	  
      // render the template -->
      echo template('templates/default.php', $data);
	  ?>
	 </div>
	 <?php
   echo template("templates/partials/footer.php");
?>
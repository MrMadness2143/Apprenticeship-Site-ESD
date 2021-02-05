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

	
	if(isset($_GET['btnView'])){
		$current = $_GET['btnView'];
	}
	$sql = "select evidID, evidDate, evidTime, evidFileP, evidFeed 
	FROM evidence  where ksbId = " . $current . " order BY evidDate";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	
	$sql = "select ksbTitle, ksbRequire, ksbDesc, ksbStatus from ksbs where ksbID = " . $current;
	$ksbInfo = mysqli_query($conn,$sql) or die(mysqli_error($conn));
	$ksbInfo = mysqli_fetch_array($ksbInfo);
	?>

	
	<style>
	
	</style>
	<div>
		<form action = "evidAction.php" method = "GET">
		<table border='2' class='table table-striped'>
		<?php
            
            if($row['ksbStatus'] = '0'){$status = "Evidence pending";}
            else if($row['ksbStatus'] = '1'){$status = "Under Review";}
            else{$status = "Complete";}
			$data['content'] .= '<thead><tr><th colspan =' . '5' . '>' . $ksbInfo['ksbTitle']	. '</th></tr>';
			$data['content'] .= '<tr><th>status</th><th colspan =' . '2' .'>Requirement</th><th colspan ='. '2' . '>Description</th></tr>';
			$data['content'] .= '<tr><td>' . $status . '</td><td colspan =' . '2' .'>'. $ksbInfo['ksbRequire'] .'</td>';
			$data['content'] .= '<td colspan =' . '2' .'>'. $ksbInfo['ksbDesc'] .'</td></tr>';
            $data['content'] .= '</table>';
                
			$data['content'] .= '<table class="table table-striped"><tr></tr><tr><th>Posted</th><th>Filename</th><th colspan =' . '3' . '>Review</th></tr></thead><tbody>';
			
			while($row = mysqli_fetch_array($result)){
				$fileName = substr($row['evidFileP'], 9);
                $actionView = $row['evidID'] . "V";
                $actionDown	= $row['evidID'] . "d";
                $actionDel = $row['evidID'] . "D";

				$data['content'] .= '<tr><td>'. $row['evidDate'] .'</td><td>' . $fileName;
				$data['content'] .= '</td><td colspan =' . '3' . '>' . $row['evidFeed'];
				$data['content'] .= '</td><td><button class="btn-primary" type="submit" name="btnSubmit" value ="';
				$data['content'] .= $actionView . '">View</button></td>';
				$data['content'] .= '<td><button class="btn-success" type="submit" name="btnSubmit" value ="';
				$data['content'] .= $actionDown . '">download</button></td>';
				$data['content'] .= '<td><button class="btn-danger" type="submit" name="btnSubmit" value ="';
				$data['content'] .= $actionDel . '">Delete</button></td></tr>';
			}
 			$data['content'] .='</tbody></table>';
		
		echo template('templates/default.php', $data);
		?>
        
           <a href="evidUpload.php"><button>Upload</button></a>
	</div>
<?php
	echo template("templates/partials/footer.php");
?>
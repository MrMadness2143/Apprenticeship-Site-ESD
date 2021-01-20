<?php
include("dbconnect.inc");
include("functions.inc");
	
    //stores results and negates strings that contain special characters
    $first = mysqli_real_escape_string($conn,$_POST['txtfirstname']);
    $last = mysqli_real_escape_string($conn,$_POST['txtlastname']);
    $pass = mysqli_real_escape_string($conn,$_POST['txtpassword']);
	$email = mysqli_real_escape_string($conn,$_POST['txtemail']);

    //builds query
    $sql = "INSERT INTO `user` (`userID`, `userEmail`, `userPassword`,
	`orgID`, `TeachID`, `adminLV`, `userRole`, `userFName`,
	`userLName`, `userAge`, `userBirth`, `userGender`, `userExpl`, 
	`disability`) VALUES (NULL, '$email', '$pass', NULL, NULL, 
	'1', NULL, '$first', '$last', NULL, NULL, NULL, 
	NULL, NULL);";

    //sends query
    mysqli_query($conn, $sql);
?>

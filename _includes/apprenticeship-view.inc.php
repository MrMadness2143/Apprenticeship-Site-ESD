<?php
	include("dbconnect.inc");
	
	if(isset($_GET['btnView'])){
		$current = $_GET('btnView');
		echo $current;
	}

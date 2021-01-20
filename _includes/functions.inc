<?php

include "passwordLib.php";

/**
 * Validate Login function
 *
 * @param $id        - user ID
 * @param $password  - plaintext password
 * @return boolean   - returns true or false depending on successful authentication of user.
 */
function validatelogin($email,$password) {
   global $conn;
   // Build an SQL statment that will return a record with a matching id
   $sql = "select * from user where userEmail='$email';";
	//echo $sql;
   $loginresult = mysqli_query($conn, $sql);
   $userdetails = mysqli_fetch_assoc($loginresult);
	//print_r($userdetails);

	if ($password = $userdetails['userPassword']) {
		$id = $userdetails['userID'];
		$_SESSION['id'] = $id;
		return true;
	}
	else {
		$_SESSION['id'] = '';
		return false;
	}
}


/**
 * Simple Templating function
 *
 * @param $file   - Path to the PHP file that acts as a template.
 * @param $args   - (optional) Associative array of variables to pass to the template file.
 * @return string - Output of the template file. Likely HTML.
 *
 * Source: http://www.daggerhart.com/create-simple-php-templating-function/
 */
function template( $file, $args=array() ){
   // ensure the file exists
   if ( !file_exists( $file ) ) {
      return '';
   }

   // Make values in the associative array easier to access by extracting them
   if ( is_array( $args ) ){
      extract( $args );
   }

   // buffer the output (including the file is "output")
   ob_start();
   include $file;
   return ob_get_clean();
}

function registerUser(){
	
}
?>

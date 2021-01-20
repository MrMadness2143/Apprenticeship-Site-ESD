
<?php echo $message; ?>

<form name="frmLogin" action="authenticate.php" method="post">
   Email:
   <input name="txtemail" type="text" />
   <br/>
   Password:
   <input name="txtpwd" type="password" />
   <br/>
   <input type="submit" value="Login" name="btnlogin" />
</form>
<form action="adduser.php">
	<input type="submit" value="Register">
</form>
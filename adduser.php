<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

    echo template("templates/partials/header.php");
?>

<!-- writes the forms -->
    <h2 class=ml-2>Register</h2>     
    <form class="form-group ml-4" name="frmdetails" action="_includes/adduser.inc.php" method="POST">
        <div class="align-middle form-inline" >
            <label>First Name : &nbsp;</label>
            <input name="txtfirstname" id=txtfname type="text" placeholder="Firstname"/><br/>
            <label>&nbsp;Surname :&nbsp;</label>
            <input name="txtlastname" id=txtlname type="text" placeholder ="Lastname" autocomplete="off"/><br/>
			<label>email : &nbsp;</label>
			<input name="txtemail" id=txtemail type="text" placeholder = "email here"/><br/>
        </div>
        <label>&nbsp;Password :&nbsp;</label>
        <input name="txtpassword" id=txtpword type="password" placeholder="Password" autocomplete="off"/><br/>
        </div>
        <input class= "btn-warning" type="submit" value="Add" name="submit"/>
    </form>
<?php
echo template("templates/partials/footer.php");
?>

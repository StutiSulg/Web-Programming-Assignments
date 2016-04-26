<?php
/*
Stuti Sulgaonkar
Date: 10/29 	Session: AK 
CSE 154, Homework 5: Remeber the Cow 
This is the start log-in page of the website Remeber the Cow. It asks the user
to log or create a new account. 
*/


	include("common.php"); 
	if(isset($_COOKIE["time"])) { 
		$time = $_COOKIE["time"]; 
	} else { 
		$time = "None"; 
	}
?>


<?php
	top(); 
?>
<div id="main">
	<p>
		The best way to manage your tasks. <br />
		Never forget the cow (or anything else) again!
	</p>

	<p>
		Log in now to manage your to-do list. <br />
		If you do not have an account, one will be created for you.
	</p>

	<form id="loginform" action="login.php" method="post">
		<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
		<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
		<div><input type="submit" value="Log in" /></div>
	</form>

	<p>
		<em>(last login from this computer was <?= $time ?>)</em>
	</p>
</div>

<?php
	bottom(); 
?>
	
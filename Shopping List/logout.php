<?php
/*
Stuti Sulgaonkar	Date: 10/29 	Session: AK 
CSE 154, Homework 5: Remeber the Cow 
This page logs the user out.  
*/
	session_destroy();
	session_regenerate_id(TRUE);
	header("Location: start.php"); 	
?>
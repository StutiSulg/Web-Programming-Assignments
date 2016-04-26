<?php
/*
Stuti Sulgaonkar	Date: 11/5 	Session: AK 
CSE 154, Homework 6: Kevin Bacon 
This page is the front page of mymdb and contains a form for the users to start their search. 
*/ 
	include("common.php"); 
	top(); 
?>
	<div id="main">
		<h1>The One Degree of Kevin Bacon</h1>
		<p>Type in an actor's name to see if he/she was ever in a movie with Kevin Bacon!</p>
		<p><img src="https://webster.cs.washington.edu/images/kevinbacon/kevin_bacon.jpg" alt="Kevin Bacon" /></p>

		<?php
		form();
		?> 
	</div> <!-- end of #main div -->
		
<?php
	bottom(); 
?>

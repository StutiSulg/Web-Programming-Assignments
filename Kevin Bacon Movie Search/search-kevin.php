<?php 
/*
Stuti Sulgaonkar	Date: 11/5 	Session: AK 
CSE 154, Homework 6: Kevin Bacon
This page produces all of the movies the actor/actoress has filmed in 
*/ 
	include("common.php"); 
	$first = $_GET["firstname"]; 
	$last = $_GET["lastname"];

	$db = new PDO("mysql:dbname=imdb", "stutis", "LYbUMuxJR4"); 
	$first_n = $db->quote($first); 
	$last_n = $db->quote($last); 
	$repeatfirst = $db->quote($first." %");	

	// finds the ID of Kevin Bacon
	$bacon_repeat = $db->quote("Kevin %"); 
	$bacon_first = $db->quote("Kevin"); 
	$bacon_last = $db->quote("Bacon"); 
	$baconinfo = query_findID($db, $bacon_repeat, $bacon_first, $bacon_last);
	$KEVIN_ID = $baconinfo["id"]; 

	//finds the person the user wants to compare's ID 
	$correctname = query_findID($db, $repeatfirst, $first_n, $last_n); 
	
	// Prints the content 
	if(is_null($correctname["id"])) { 
		top(); 
		?>
			<p>Actor <?= $first . " " . $last?> in no way in shape and form related to Kevin Bacon</p>

		<?php
		form();
		bottom(); 
	} else { 

		$actorsid = $correctname["id"];
		# Query to retrieve all the movies both Kevin Bacon and the other actor have proformed in.  
		$rows = $db->query("SELECT name, year 
							FROM movies 
							JOIN roles r1 ON id = r1.movie_id
							JOIN roles r2 ON id = r2.movie_id
							WHERE r1.actor_id = $actorsid AND r2.actor_id = $KEVIN_ID 
							ORDER BY year DESC, name ASC"); 		
	 	top(); 
	 	//Function that creates the table
	 	createtable($rows, $first, $last); 
	 	form(); 
	 	bottom(); 
	 	
	}	

?>

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

	//Gets the correct ID of the actor or actress 
	$correctname = query_findID($db, $repeatfirst, $first_n, $last_n);

	//Prints the table or error message on the website
	if(is_null($correctname["id"])) { 
		top(); 
		?>
			<p>Actor <?= $first . " " . $last?> was not found</p>

		<?php
		form(); 
		bottom(); 
	} else { 
		$actorsid = $correctname["id"];
		# query to retrieve the names of all the movies the actor has preformed in
		$rows = $db->query("SELECT DISTINCT name, year FROM movies 
							JOIN roles ON id = movie_id JOIN actors a ON actor_id = a.id
							WHERE a.id = $actorsid
							ORDER BY year DESC, name ASC"); 	 	
	 	top(); 
	 	createtable($rows, $first, $last);
	 	form(); 
	 	bottom();  
	}

?>



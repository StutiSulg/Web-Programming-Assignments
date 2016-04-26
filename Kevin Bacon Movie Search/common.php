<?php
/*
Stuti Sulgaonkar	Date: 11/5 	Session: AK 
CSE 154, Homework 6: Kevin Bacon
Common PHP & HTML contained in all pages 
*/ 
function top() { 
?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>My Movie Database (MyMDb)</title>
			<meta charset="utf-8" />
			<link href="https://webster.cs.washington.edu/images/kevinbacon/favicon.png" type="image/png" rel="shortcut icon" />

			<!-- Link to your CSS file that you should edit -->
			<link href="bacon.css" type="text/css" rel="stylesheet" />
		</head>

		<body>
			<div id="frame">
				<div id="banner">
					<a href="mymdb.php"><img src="https://webster.cs.washington.edu/images/kevinbacon/mymdb.png" alt="banner logo" /></a>
					My Movie Database
				</div>	
<?php 
} 

function form() { 
?>
	<!-- form to search for every movie by a given actor -->
	<form action="search-all.php" method="get">
		<fieldset>
			<legend>All movies</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>

	<!-- form to search for movies where a given actor was with Kevin Bacon -->
	<form action="search-kevin.php" method="get">
		<fieldset>
			<legend>Movies with Kevin Bacon</legend>
			<div>
				<input name="firstname" type="text" size="12" placeholder="first name" /> 
				<input name="lastname" type="text" size="12" placeholder="last name" /> 
				<input type="submit" value="go" />
			</div>
		</fieldset>
	</form>
<?php
}

function bottom() {
?> 
			<div id="w3c">
				<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a>
				<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
			</div>
		</div> <!-- end of #frame div -->
	</body>
</html>

<?php
}

# Prints out the table used in both search-kevin and search-all
function createtable($rows, $first, $last) { 
	$count = 1; 
?>
	<div id= "main">
		<h1> Results for <?= $first . " " . $last ?></h1>	 	
		<table>
			<caption> All Films <?= $first . " " . $last ?> played in with Kevin Bacon </caption>
			<tr><th>#</th><th>Title</th><th>Year</th></tr>

			<?php
			foreach ($rows as $row) {
			?>		

				<tr><td><?= $count?></td><td><?= htmlspecialchars($row["name"])?></td><td><?= $row["year"]?></td></tr>

			<?php
				$count++; 
			}
			?>
		</table>
	</div>

<?php
}

# finds the correct ID for a given actor/actress
function query_findID($db, $repeatfirst, $first_n, $last_n) { 

	$repeats = $db->query("SELECT MAX(film_count) AS Topstar, id
							FROM actors 
							WHERE (first_name LIKE $repeatfirst OR first_name = $first_n) 
							AND last_name = $last_n
							ORDER BY film_count DESC");
	$correctname = $repeats->fetch();
	return $correctname; 
}
?>

<!-- 
	Stuti Sulgaonkar, CSE 154. 10/22
	CSE 154 Section AK
	A dynamic HTML & PHP code for when the user submits the sign up information for the Nerdluv website.   
	This displays the conformation page that the user has submited the sign up.  
--> 
<?php
	$name = $_POST["name"];
	$gender = $_POST["gender"]; 
	$age = $_POST["age"];
	$personality = $_POST["personality"]; 
	$os = $_POST["favorite"]; 
	$minage = $_POST["minage"]; 
	$maxage = $_POST["maxage"]; 
	# Puts the information given by the user into a textfile 
	$info = $name .", ". $age .", ". $gender .", ". $personality .", ". $os .", ". $minage .", ". $maxage ."\n"; 
	$file = 'singles.txt'; 
	$current = file_get_contents($file); 
	$current .= $info; 
	file_put_contents($file, $current);	
?>

<!DOCTYPE html>
<html>

	<?php
		include("common.php"); 
		head();  
	?>

	<body>
		<?php
			top(); 
		?>
		
		<h1>Thank you!</h1>

		<p>
			Welcome to NerdLuv, <?= $_POST["name"] ?>! 
		</p>

		<p>
			Now <a href="matches.php">log in to see your matches!</a>
		</p>

		<?php
			details(); 
		?>
	</body>
</html>
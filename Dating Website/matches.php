<!-- 
	Stuti Sulgaonkar, CSE 154. 10/22
	CSE 154 Section AK
	A dynamic HTML & PHP code to allow the user to log in using their name and find     
	the number of matches available. This page can be accessed through the NerdLuv page clicking match.  
--> 
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

		<form action = "matches-submit.php" method = "get"> 
			<fieldset>
				<legend>Returning User:</legend>
				<strong>Name:</strong>
				<input type="type" name="name" size="16" /><br />
				<input type="submit" value= "View My Matches" /> 				
			</fieldset>
		</form> 

		<?php
			details(); 
		?>

	</body>

</html>



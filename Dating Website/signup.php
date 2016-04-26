<!-- 
	Stuti Sulgaonkar, CSE 154. 10/22
	CSE 154 Section AK
	A dynamic HTML & PHP code for the sign up page used for the NerdLuv website.   
	This is a form that asks the users to fill out and submit to signup-submit.   
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

		<form action = "signup-submit.php" method = "post"> 
			<fieldset>				
				<legend>New User Signup:</legend>
				
				<div>
					<strong>Name:</strong>
					<input type="text" name="name" size="16" /> 
				</div>

				<div>
					<strong>Gender:</strong>
					<label><input type="radio" name="gender" value="M" /> Male</label>
					<label><input type="radio" name="gender" value="F" checked="checked" /> Female</label> 
				</div>

				<div>
					<strong>Age:</strong>
					<input type="text" name="age" size="6" maxlength="2" /> 
				</div>

				<div>
					<strong>Personality type:</strong>
					<input type="text" name="personality"	size="6" maxlength="4" />
					<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">(Don't know your type?)</a> 
				</div>

				<div>
					<strong>Favorite OS:</strong>
					<select name="favorite">
						<option selected="selected">Windows</option>
						<option>Mac OS X</option>
						<option>Linux</option>
					</select> 
				</div>

				<div>					
					<strong>Seeking age:</strong> 
					<input type="text" name="minage" size="6" maxlength="2" value="min" /> to
					<input type="text" name="maxage" size="6" maxlength="2" value="max" />
				</div>	

				<div>
					<input type="submit" value="Sign Up"> 
				</div>
			</fieldset>
		</form> 

		<?php
			details(); 
		?>

	</body>

</html>



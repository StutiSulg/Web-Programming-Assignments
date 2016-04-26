<!-- 
	Stuti Sulgaonkar, CSE 154. 10/22
	CSE 154 Section AK
	A dynamic HTML & PHP code used to display the matches found for a certain user after the user has     
	logged in by giving his/her name. 
--> 
<?php
	$name = $_GET["name"];	
	$singles = file("singles.txt");

	# This function finds the users information by using the user's name
	function userinfo($name, $singles){ 	 	
	 	foreach ($singles as $single) {
	 		if(strncmp($single, $name, strlen($name)) == 0){ 
	 			return $single;		 			
	 		}
	 	}
	}

	# This function finds the people who match the users profile
	function match( $single) { 
		global $id, $sex, $age, $personality, $os, $min, $max; 	 	
 	 	list($m_id, $m_sex, $m_age, $m_personality, $m_os, $m_min, $m_max) = explode(",", $single);
 	 	
 	 	if(strcasecmp($sex, $m_sex) != 0){
 	 		if($m_age >= $min && $m_age <= $max && $age >= $m_min && $age <= $m_max){  	 			
 				if(strcasecmp($os, $m_os) == 0){
 					if (similar_text($m_personality, $personality) > 0) {
 						return true; 
 					} 
 				}  	 			 
 	 		} 
 	 	}

 	 	return false; 
	} 
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
		 
		 <h1>Matches for <?= $name ?></h1>

		 <?php
		 	$user = userinfo($name, $singles); 
		 	list($id, $sex, $age, $personality, $os, $min, $max) = explode(",", $user);
		 	
		 	foreach ($singles as $single) {		 		
		 	 	if(match($single)) { 
		 	 		list($m_id, $m_sex, $m_age, $m_personality, $m_os, $m_min, $m_max) = explode(",", $single);
         ?> 

					<div class = "match">
						<p><img src="https://webster.cs.washington.edu/images/nerdluv/user.jpg" alt="profile pic" /> <?= $m_id ?> </p> 
						<ul>

							<li><strong>gender:</strong> <?= $m_sex ?> </li>
							<li><strong>age:</strong> <?= $m_age ?></li>
							<li><strong>type:</strong> <?= $m_personality ?> </li>
							<li><strong>OS:</strong> <?= $m_os ?> </li>
						</ul>
					</div>

		 <?php
				}
		 	 } 
		  
		 	details(); 
		  ?>
	</body>
</html>
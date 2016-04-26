<?php 
	# Stuti Sulgaonkar, CSE 154. 10/15
	# CSE 154 Section AK
	# A dynamic HTML & PHP code for Rancid Tomatoes which gives reviews for many different movies. 
	# Extra features included are the Changing page title, and Error message when movie is not passed
	
	$movie = $_GET["film"]; 
	
	#This if statement checks if the movie exists in the directory else it sends an error img. 	
	if(!file_exists($movie)){
		print "<div> <img class =". "\"image\"" . "src=" . "\"https://webster.cs.washington.edu/students/stutis/hw3/error.png\""
				. "alt=" . "\"Error\"" . "/> </div>"; 
				
	} else { 		
		list($name, $year, $percentage) = file($movie . '/info.txt');
		$overview = file($movie . '/overview.txt'); 	
?>
		
		<!DOCTYPE html>
		<html>
			<head>				
				<title>Rancid Tomatoes - <?= $name ?></title>

				<meta charset="utf-8" />
				<link href="movie.css" type="text/css" rel="stylesheet" />
			</head>

			<body>	
				<?php 
					top_banner();
				?>
				
				<h1><?= $name . '(' . trim($year) . ')' ?></h1>
				
				<div id = "overall">
				
					<?php
						banner($percentage); 
					?>
					
					<div id = "general">			
						<div>
							<img src="<?= $movie . '/overview.png'?>" alt="general overview" /> 
						</div>
						
						<div id = "sidebar">
							<dl>
							
								<?php 
									for($i=0; $i < count($overview); $i++) {
										list($word, $definition) = explode(":", $overview[$i]); 						
										?> 
										
										<dt><?= $word ?></dt>
										<dd><?= $definition ?></dd>
										
								<?php } ?>
								
							</dl>
						</div>
					</div>
					
					<div id = "review-content"> 					
						
						<div id = "column1">
						
							<?php 
								
								$review = glob($movie . "/review*.txt*");
								$halflength = round(count($review)/2); 
								
								comment_author(0, $halflength, $review);
							?>		
							
						</div>
						
						<div id = "column2">
						
							<?php 
								comment_author($halflength, count($review), $review); 								
							?>	
							
						</div>								
					</div>
					
					<?php 
						$amount = count($review); 
					?>
					
					<p>(1-<?= $amount ?>) of <?= $amount ?></p>
					
					<?php
						banner($percentage); 
					?>	
					
				</div>
				
				<div id = "validation">
					<a href="https://webster.cs.washington.edu/validate-html.php"><img 
					src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
					<a href="https://webster.cs.washington.edu/validate-css.php"><img 
					src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
				</div>
				
				<?php 
					top_banner();
				?>
				
			</body>
		</html> 
<?php 
	} 
?>

<?php

# This function comment_ author takes in the parameters of where to start and end in the reading 
# of the review files which is also a parameter. This function is used to print out the comment 
# and author part of review section. 

	function comment_author($start, $end, $review) {
		
		for($i = $start; $i  < $end; $i++){
			$text = file($review[$i]); 			
?>	
			<p class = "comment" >
				<?php 			 
				if (strlen($text[1]) == 6) {					
				?>				
					<img class = "image" src="https://webster.cs.washington.edu/images/fresh.gif" alt="Fresh" />
					
				<?php
				} else { 
				?>
					
					<img class = "image" src="https://webster.cs.washington.edu/images/rotten.gif" alt="Rotten" />
					
				<?php 
				} 
				?>
				
				<q><?= trim($text[0])?></q>	
			</p>
			
			<p class = "author">
				<img class = "image" src="https://webster.cs.washington.edu/images/critic.gif" alt="Critic" />
				<?= $text[2] ?> <br />
				<span class = "publication"> <?= $text[3] ?> </span>
			</p>		
<?php
		}
	}
?>

<?php 

# banner is a function that prints out the top and bottom banner that represents the rotten or fresh 
# rating of the movie, as well as the rating in percentage the movie received. This function takes in 
# the parameter that gives the rating of the movie.  

	function banner($info) { 
?>
		<div class = "percentage">
			<?php 
				$percentage = (int) $info; 
				if($percentage >= 60 ){ 		
			?>
			
					<img src="https://webster.cs.washington.edu/images/freshlarge.png" alt="Fresh" />
			
			<?php
				} else { 						
			?>
			
				<img src="https://webster.cs.washington.edu/images/rottenlarge.png" alt="Rotten" />
			
			<?php
				} 						
			?>					
			<?= $percentage . "%" ?> 
			
		</div>		

<?php
	}
?>

<?php 

# top_banner is just a function that dispalys the Rancid tomato symbol on the top and bottom of the page. 

	function top_banner() { 
?>
		<div class = "image-banner">
			<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="Rancid Tomatoes" />
		</div>	

<?php
	}
?>





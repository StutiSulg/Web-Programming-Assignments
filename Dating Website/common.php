<!-- 
	Stuti Sulgaonkar, CSE 154. 10/22
	CSE 154 Section AK
	Common code that is used in all of the pages 
-->

<?php 
#A fuction that produces the head part of the html in each page. 
function head()  { 
?>
	<head>	
		<title>NerdLuv</title>
		
		<meta charset="utf-8" />
		
		<!-- instructor-provided CSS and JavaScript links; do not modify -->
		<link href="https://webster.cs.washington.edu/images/nerdluv/heart.gif" type="image/gif" rel="shortcut icon" />
		<link href="https://webster.cs.washington.edu/css/nerdluv.css" type="text/css" rel="stylesheet" />
	</head>
<?php
}
 
#This function produces the lego and title of Nerdluv used on every page. 
function top() { 
?>
	<title>NerdLuv</title>
	
	<div id="bannerarea">
		<img src="https://webster.cs.washington.edu/images/nerdluv/nerdluv.png" alt="banner logo" /> <br />
		where meek geeks meet
	</div>

<?php
}

#This fuction produces the desciption of what NerdLuv is on everypage and also includes the code check links. 
function details() { 
?>
	<div>
		<p>
			This page is for single nerds to meet and date each other!  Type in your personal 
			information and wait for the nerdly luv to begin!  Thank you for using our site.
		</p>
		
		<p>
			Results and page (C) Copyright NerdLuv Inc.
		</p>
		
		<ul>
			<li>
				<a href="nerdluv.php">
					<img src="https://webster.cs.washington.edu/images/nerdluv/back.gif" alt="icon" />
					Back to front page
				</a>
			</li>
		</ul>
	</div>

	<div id="w3c">
		<a href="https://webster.cs.washington.edu/validate-html.php">
		<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
		<a href="https://webster.cs.washington.edu/validate-css.php">
		<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
	</div>

<?php
}
?>

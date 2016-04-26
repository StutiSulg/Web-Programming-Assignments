

<!DOCTYPE html>
<html>
	<head>
		<title>Learning On Your Own Time</title>
		<link href="level3.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="wrapper">
		<div id="navMenu">
		
			<ul>
			
				<li class = "mainClass"><a href="#">Math</a>
					
					<ul>
					
					<li><a href="#">Algebra</a></li>
					<li><a href="#">Statistics</a></li>
					<li><a href="#">Calculus 1</a></li>
					<li><a href="#">Calculus 2</a></li>
					<li><a href="#">Calculus 3</a></li>
				
					</ul> <!-- end inner UL -->
					
				</li> <!-- end main LI -->
				
			</ul> <!-- end main UL-->
			
						<ul>
			
				<li class = "mainClass"><a href="#">English</a>
					
					<ul>
					
					<li><a href="#">English Comp.</a></li>
					<li><a href="#">Technical Writing</a></li>
					<li><a href="#">ESL</a></li>
					<li><a href="#">Reading Lit</a></li>
					<li><a href="#">English 101</a></li>
				
					</ul> <!-- end inner UL -->
					
				</li> <!-- end main LI -->
				
			</ul> <!-- end main UL-->
			
						<ul>
			
				<li class = "mainClass"><a href="#">Computer Science</a>
					
					<ul>
					
					<li><a href="#">Intro Programming</a></li>
					<li><a href="#">C++ 1</a></li>
					<li><a href="#">C++ 2</a></li>
					<li><a href="#">Data Struct&Al 1</a></li>
					<li><a href="#">Dara Struct&Al 2</a></li>
				
					</ul> <!-- end inner UL -->
					
				</li> <!-- end main LI -->
				
			</ul> <!-- end main UL-->
		
		<br class="clearFloat"/>
		</div> <!-- end navMenu -->
		</div> <!-- end wrapper div -->
		
		<div id="level2C">
			<form name="course" action= "/GetCourses" method = "post">
				<input class="classes" type="submit" value = "Algebra 101"/>
				<input class="classes" type="submit" value = "Algebra 200"/>
				<input class="classes" type="submit" value = "Algebra 300"/>
			</form>
		</div>
		
		<div id = "links">
		
			<h3> $courseTitle </h2>
		
			<table id="results">
				$for Index in resultsTable:
					<tr>
						<td>
							$Index
						</td>
					</tr>
			</table>
		</div>
	</body>
</html>
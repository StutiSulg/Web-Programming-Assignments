<?php
/*
Stuti Sulgaonkar	Date: 10/29 	Session: AK 
CSE 154, Homework 5: Remeber the Cow 
This page displays the todo list where the user can add or delete from a 
perviously saved list or start a new list. 
*/

	session_start();
	include("common.php"); 
	
	if(!isset($_SESSION["name"])) { 	
		header("Location: start.php");
		die(); 
	}

	$name = $_SESSION["name"];
?>

<?php
	top(); 
?>

<div id="main">			
	<h2><?=  $name ?>'s To-Do List</h2>

	<ul id="todolist">
		<?php
			$users_todo = "todo_".$name.".txt"; 
			if(file_exists($users_todo)) { 
				$bullets = file($users_todo); 
				$index = 0; 
				foreach ($bullets as $bullet) {
		?>

					<li>
						<form action="submit.php" method="post">
							<input type="hidden" name="action" value="delete" />
							<input type="hidden" name="index" value=<?= $index ?> />
							<input type="submit" value="Delete" />
						</form>
						<?= $bullet ?>
					</li>

		<?php	
					$index++; 													
				}
			}
		?>

		<li>
			<form action="submit.php" method="post">
				<input type="hidden" name="action" value="add" />
				<input name="item" type="text" size="25" autofocus="autofocus" />
				<input type="submit" value="Add" />
			</form>
		</li>		
	</ul>

	<div>
		<a href="logout.php"><strong>Log Out</strong></a>
		<em>(logged in since <?= $_COOKIE["time"] ?>)</em>
	</div>

</div>

<?php
	bottom(); 
?>

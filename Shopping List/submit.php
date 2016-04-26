<?php
/*
Stuti Sulgaonkar	Date: 10/29 	Session: AK 
CSE 154, Homework 5: Remeber the Cow 
This page process when the user adds or deletes an item from their list.  
*/ 
	session_start(); 	
	$name = $_SESSION["name"]; 
	$action = $_POST["action"]; 	
	$file = "todo_".$name.".txt";

	if($action === "add") { 
		$item = checkparm(); 
		add_item($file, $item);
	}

	if($action === "delete") {
		$index = $_POST["index"]; 
		$current_file = file($file); 
		if(count($current_file) < $index || $index < 0) { 
			die("Wrong index paramter was passed"); 
		}
		
		delete_item($current_file, $index, $file); 

	}

	header("Location: todolist.php");

#Checks if all the correct parameters were sent to the todolist
function checkparm() { 
	if(isset($_POST["item"])) { 
		$item = htmlspecialchars($_POST["item"]);
	} else { 
		die("Need to pass an item to add."); 
	}

	return $item; 
}

# Adds the time to the todo list
function add_item($file, $item) { 
	if(file_exists($file)) { 
		$current = file_get_contents($file); 
		$new_list = $current  . $item . "\n" ; 
		file_put_contents($file, $new_list);			 
	} else { 
		file_put_contents($file, $item); 
	}
}

# Deletes the time from the todo list 
function delete_item($current_file, $index, $file) { 
	$string_list = ""; 
	for ($i=0; $i < count($current_file) ; $i++) { 
		if($i != $index) { 
			$string_list .= $current_file[$i]; 
		}
	}

	file_put_contents($file, $string_list); 
}

?>
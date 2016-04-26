<?php
/*
Stuti Sulgaonkar	Date: 10/29 	Session: AK 
CSE 154, Homework 5: Remeber the Cow 
When users submit from start.php this page takes the login information and finds 
the right user information or creates a new acount for the ueser. 
*/

	# Checks if all the parameters are filled in 
	if(!empty($_POST["name"]) && !empty($_POST["password"])){ 		
		$name = $_POST["name"];		
		$password = $_POST["password"]; 		 
	} else { 
		die("Error you have not submited the proper information"); 
	}

	$users_txt = "users.txt";	
	
	if(file_exists($users_txt)){ 
		$users = file($users_txt);					
		account_exist($users, $name, $password);

	} 

	# If it is a new user a account is created but the right user name and password needs to be set
	# or else the user is sent back to the starting page. 
	$name_reqex = "/^[a-z][0-9a-z]{3,8}/"; 
	$pass_reqex = "/^[0-9].{4,11}(\W)$/"; 
	if(preg_match($name_reqex, $name) && preg_match($pass_reqex, $password)) { 
		$newuser =  $name . ":" . $password . "\n" ;
		set_new_acct($newuser, $users_txt);
		setdatecookie(); 		
		setsessions($name); 
	} else { 
		header("Location: start.php"); 
		}	
	
	

# account_exist checks if the user already has an account, or if a returing user has 
# put in the wrong password. 
function account_exist($users, $name, $password) { 
	foreach ($users as $user) {
		list($user_name, $user_pass) = explode(":", $user);				
		if($user_name === $name) { 
			if(trim($user_pass) === $password){
				setdatecookie(); 				
				setsessions($name);	
			} else { 
				header("Location: start.php");
				
			}
		} 		
	}
	
	
}

# set_new_acct adds the new user onto a text sheet with all the users. 
function set_new_acct($newuser, $users_txt) { 
	if(!file_exists($users_txt)) { 
		file_put_contents($users_txt, $newuser);
	} else if(!isset($_SESSION["name"])) { 
		$current = file_get_contents($users_txt); 
		$current .=  $newuser; 
		file_put_contents($users_txt, $current);
	}
}

# setdatecookie sets a cookie that gives the time when the first person to log in succesful was
function setdatecookie() {
	if(!isset($_COOKIE["time"])) { 
		$expire = time() + 60 * 60 * 24 * 7; 
		$datestr = date("D y M d, g:i:s a"); 
		setcookie("time", $datestr, $expire); 
	}
	
}

# setsession($name) sets a session for the user
function setsessions($name) {
	session_start(); 
	$_SESSION["name"] = $name;
	header("Location: todolist.php");	 
}

?>
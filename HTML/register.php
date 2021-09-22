<?php

//if both username and password are blank then ask them to enter one
if(empty($_POST["uname"]) or empty($_POST["pword"])){
	$error = 'Please enter a username and password';
}

//some validation to ensure it only contains alphanumeric characters
elseif (ctype_alnum($_POST["uname"]) == FALSE and !empty($_POST["uname"])){
	$error = 'Your username may only contain alphanumeric characters';
}

//validation so that password is not too long/short, matches
elseif (ctype_graph($_POST["uname"]) == FALSE and !empty($_POST["uname"])){
	$error = 'Your username does not consist of all (visibly) printable characters';
}

//validation for if username is too long
elseif (strlen($_POST["uname"]) > 25){
	$error = 'Your username is too long';
}

//validation for if passwords do not match
elseif($_POST["pword"] != $_POST["repword"]) {
	$error = 'Your passwords do not match'; 
}

elseif(strlen($_POST["pword"]) <=6 and !empty($_POST["pword"])){
	$error = 'Your password is not long enough';
}

elseif(strlen($_POST["pword"]) >50 and !empty($_POST["pword"])){
	$error = 'Your password is too long';
}

elseif(!empty($_POST["uname"]) and !empty($_POST["pword"]) and $_POST["pword"] == $_POST["repword"] and strlen($_POST["pword"])>6 and strlen($_POST["pword"]) <= 50) {
	$user = $_POST["uname"];
	$pword = $_POST["pword"];

	//getting rid of special characters in password like <p> -> &quot;</p> along with charcters like " become &quot;
	$pword = htmlentities($pword, ENT_QUOTES);
	$pword = addslashes($pword);
	
	//Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
	//Inserting new data into the database after checking the account doesn't exist
	$exists = mysqli_query($connection, "SELECT COUNT(*) FROM users WHERE username = '$user';")
	or die ("Invalid query: ".mysqli_error($connection));
	$exists = mysqli_fetch_assoc($exists);
	
	if ($exists["COUNT(*)"] == 0){
		$account = mysqli_query($connection, "INSERT INTO users(username,pword) VALUES('$user','$pword');") 
		or die ("Invalid query: ".mysqli_error($connection));

		setcookie("user", $user, time() + 86400, "/", "127.0.0.1");
		header("Location: http://127.0.0.1/index.html");

	}
	
	else{
		$error = 'That username already exists';
	}
	
	//Closing the connection
	mysqli_close($connection);
	
}

?>

<!DOCTYPE html>

<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="website.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body onload = "openNav()">
<!-- Registration Form -->
<script src = "script.js">
</script>

<div id="mySidenav" class="sidenav">
		<h1> Sign up to WorldTree</h1>
		<br><img src = "./profile_i/avatar.png" alt = "user profile picture" height="25%"><br><br>
		<form action = "register.php" method = "POST">
			<input type = "text" name = "uname" placeholder = "Username" value = "<?php echo $_POST["uname"]; ?>" >
			<input type = "password" name = "pword" placeholder = "Password">
			<input type = "password" name = "repword" placeholder = "Re-enter Password">
			<div class = "lrbuttons">
				<button type = "submit">Sign Up</button>
			</div>
		</form>
		<br>
		
		<?php echo $error; ?>
		
	</div>

</body>

</html>


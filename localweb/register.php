<?php

//if both username and password are blank and the username string is not equal to the string 0 then ask them to enter one
if(empty($_POST["uname"]) or empty($_POST["pword"]) and (string)$_POST["uname"] != "0"){
	$error = 'Please enter a username and password';
}

//some validation to ensure it only contains alphanumeric characters
elseif (ctype_alnum($_POST["uname"]) == FALSE and !empty($_POST["uname"])){
	$error = 'Your username may only contain alphanumeric characters';
}

//validation for if username is too long
elseif (strlen($_POST["uname"]) > 25){
	$error = 'Your username is too long';
}

//validation for if passwords do not match
elseif($_POST["pword"] != $_POST["repword"]) {
	$error = 'Your passwords do not match'; 
}

//if the password is too short send an error msg and if its not empty
elseif(strlen($_POST["pword"]) <=6 and !empty($_POST["pword"])){
	$error = 'Your password is not long enough';
}

//if the password is too long and password is not empty send error msg
elseif(strlen($_POST["pword"]) >50){
	$error = 'Your password is too long';
}

//if the username is not empty and the password is not empty and the password is the same as the reentered password
elseif(!empty($_POST["uname"]) and !empty($_POST["pword"]) and $_POST["pword"] == $_POST["repword"]) {
	$user = $_POST["uname"];//set the posted username and password to username and password
	$pword = $_POST["pword"];
	$bio = "Hello! My name is " . $user . ". I joined WorldTree on " . date("d/m/Y") . "!";//setting the bio to a string containing the current users username and the date the account was created

	//getting rid of special characters in password like <p> -> &quot;</p> along with charcters like " become &quot;
	$pword = htmlentities($pword, ENT_QUOTES);
	$pword = addslashes($pword);
	
	//Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
	//Inserting new data into the database after checking the account doesn't exist
	$exists = mysqli_query($connection, "SELECT COUNT(*) FROM users WHERE username = '$user';")
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	$exists = mysqli_fetch_assoc($exists);
	
	//if the number of users with the username  is 0 then insert into the users table for the fields username, pword and bio the variables user, pword and bio
	if ($exists["COUNT(*)"] == 0){
		$account = mysqli_query($connection, "INSERT INTO users(username,pword,bio) VALUES('$user','$pword','$bio');") 
		or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured

		header("Location: http://127.0.0.1/index.html");//change the current webpage to the login page

	}
	
	else{//else set the error variable to say that that username already exists
		$error = 'That username already exists';
	}
	
	//Closing the connection and freeing memory used by the query
	mysqli_free_result($exists);
	mysqli_close($connection);
	
}

?>

<!DOCTYPE html>

<head>
	<title>Sign Up</title>
<link rel = "icon" href = "./profile_i/WorldTree.png"><!-- Set the title to sign up and get the css stylesheet -->
	<link rel="stylesheet" type="text/css" href="website.css">
</head>

<body onload = "openNav()"><!-- When the page loads call openNav js function -->
<!-- Registration Form -->
<script src = "script.js">
</script>

<div id="mySidenav" class="sidenav">
		<h1> Sign up to WorldTree</h1>
		<br><img src = "./profile_i/avatar.png" alt = "user profile picture" height="25%"><br><br><!-- User image -->
		<form action = "register.php" method = "POST"><!-- form sent through post --><!-- sign up form -->
			<input type = "text" name = "uname" placeholder = "Username" value = "<?php echo $_POST["uname"]; ?>" ><!-- echo the posted username as the value of the username text input -->
			<input type = "password" name = "pword" placeholder = "Password"><!-- inputs for uesrname password and the re entered password -->
			<input type = "password" name = "repword" placeholder = "Re-enter Password">
			<div class = "lrbuttons">
				<button type = "submit">Sign Up</button><!-- sign up button -->
			</div>
		</form>
		<br>
		
		<?php echo $error; ?><!-- echoes the error -->
		
	</div>

</body>

</html>


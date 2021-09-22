<?php

//if both username and password are blank then ask them to enter one
if(empty($_POST["uname"]) or empty($_POST["pword"])){
	$error = 'Please enter a username and password';
}

//some validation to ensure it only contains alphanumeric characters
elseif (ctype_alnum($_POST["uname"]) == FALSE and !empty($_POST["uname"])){
	$error = 'Your username may only contain alphanumeric characters';
}

else{
	//receiving inputted username and password from post
	$user = $_POST["uname"];
	$pword = $_POST["pword"];

	//getting rid of special characters in password like <p> -> &quot;</p> along with charcters like " become &quot;
	$pword = htmlentities($pword, ENT_QUOTES);
	$pword = addslashes($pword);
	
	//Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
	//Checking if login credentials are correct
	$cred = mysqli_query($connection, "SELECT COUNT(*) FROM users WHERE username = '$user' AND pword = '$pword';" )
	//select the number of users who have x username and y password
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	$cred = mysqli_fetch_assoc($cred);//turn the fetched results into an array
	
	if ($cred["COUNT(*)"] == 1){//if 1 result is returned, that would mean that the user has got the correct credentials as they match someone, then if statement executed
		setcookie("user", $user, time() + 86400, "/", "127.0.0.1");//set cookies for website to function
		setcookie("pageno", 0, time() + 86400, "/", "127.0.0.1");
		setcookie("sortmethod", "New", time() + 86400, "/", "127.0.0.1");
		setcookie("probepage", $user, time() + 86400, "/", "127.0.0.1");
		header("Location: http://127.0.0.1/home.php");//send user to the home page
	}
	
	else{//if there were no results returned that would mean they would have the wrong credentials and such an error statement would be returned
		$error = 'Please enter a username and password';
	}
	
	//free the memory associated with computedString
	mysqli_free_result($cred);
	//Closing the connection
	mysqli_close($connection);
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
<link rel = "icon" href = "./profile_i/WorldTree.png">
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
	
<body onload = "openNav()">

<!-- Javascript -->
<script src = "script.js">
</script>

<!-- Login Form -->
<div id="mySidenav" class="sidenav">
	<h1>Login to WorldTree</h1>
	<br><img src = "./profile_i/WorldTree.png" alt = "World Tree Logo" height="25%"><br><br><!-- Website Logo -->
	<form action = "login.php" method = "POST" name = "login">
		<input type = "text" name = "uname" placeholder = "Username" value = "<?php echo $_POST["uname"]; ?>"><!-- Echoes the sent username from what the user entered -->
		<input type = "password" name = "pword" placeholder = "Password">
	</form>
	<div class = "lrbuttons"><!-- Buttons to login or sign up-->
		<button onclick = "document.login.submit();">Login</button>
		<button onclick = "register()">Sign Up</button>
	</div>		
	<?php echo '<br>'.$error;?><!-- Echoes the error msg, if there is no error msg then it echoes nothing-->
</div>
	
</body>

	
</html>
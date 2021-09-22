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
	or die ("Invalid query: ".mysqli_error($connection));
	$cred = mysqli_fetch_assoc($cred);
	
	if ($cred["COUNT(*)"] == 1){
		setcookie("user", $user, time() + 86400, "/", "127.0.0.1");
		setcookie("direction", "none", time() + 86400, "/", "127.0.0.1");
		header("Location: http://127.0.0.1/home.php");
	}
	
	else{
		$error = 'Please enter a username and password';
	}
	
	//Closing the connection
	mysqli_close($connection);
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>
	
<body onload = "openNav()">

<!-- Javascript -->
<script src = "script.js">
</script>

<!-- Login Form -->
<div id="mySidenav" class="sidenav">
	<h1>Login to WorldTree</h1>
	<br><img src = "./profile_i/avatar.png" alt = "user profile picture" height="25%"><br><br>
	<form action = "login.php" method = "POST" name = "login">
		<input type = "text" name = "uname" placeholder = "Username" value = "<?php echo $_POST["uname"]; ?>">
		<input type = "password" name = "pword" placeholder = "Password">
	</form>
	<div class = "lrbuttons">
		<button onclick = "document.login.submit();">Login</button>
		<button onclick = "register()">Sign Up</button>
	</div>		
	<?php echo '<br>'.$error;?>
</div>
	
</body>

	
</html>
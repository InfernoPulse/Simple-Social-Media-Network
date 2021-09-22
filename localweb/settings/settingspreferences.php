<?php
//if the bio variable has been posted then
if (isset($_POST['bio'])){
	if (strlen($_POST['bio']) <= 50000){
		$bio = sanitize($_POST['bio']);//call the sanitize variable on the posted bio and then set the variable bio to it
		$user = $_COOKIE['user'];//set the variable user to the contents of the user cookie

		//Create a database connection
		$connection = mysqli_connect ("127.0.0.1","root");
		
		//Selecting the database
		mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
		
		//Updating password for the user account
		$query = mysqli_query($connection, "UPDATE users SET bio = '$bio' WHERE username = '$user';")
		//update users table and set the bio field to the bio variable where the username is the username variable
		or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
		
		$error = "Bio updated";//set the error variable to say that the bio has been updated
		
		mysqli_close($connection);//close the connection to the server
	}
	else{
		$error = "That bio is too long";
	}
	
	
}

//create sanitize function where the variable text is passed through it
function sanitize($text){
	$text = htmlentities($text, ENT_QUOTES);//replace all html entities, double and single quotes with friendly characters
	$text = addslashes($text);//add slashes to predefined chars
	return $text;//return the text var
}

?>

<!DOCTYPE html>

<head>
	<title>Settings</title>
<link rel = "icon" href = "./profile_i/WorldTree.png"><!-- page title -->
	<link rel="stylesheet" type="text/css" href="../website.css"><!-- getting the css stylesheet -->
</head>

<body>

	<!--Creating general grid container-->
	<div class = "grid-container" id = "gen">
		<div class = "header">


			<!--Side Navigation bar for User Profile-->
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><!-- close button for side bar, when clicked call the js function closeNav() -->
				<!-- link which contains the username and when clicked calls the reset function -->
				<h1><a href = "http://127.0.0.1/profile.php" class = "title" onclick = "reset()"><?php echo $_COOKIE['user']; ?></a></h1><!--Echoes the current user-->
				<!-- the user image -->
				<br><img src = "../profile_i/avatar.png" alt = "user profile picture"><br>
				<!-- link to the users profile page, also calls the reset function -->
				<a href = "http://127.0.0.1/profile.php" onclick = "reset()">Your Profile</a>
				<!-- link to the settings page -->
				<a href = "">Settings</a>
				<!-- link to logout of the website, calls the logout function -->
				<a href = "http://127.0.0.1/" class = "logout" onclick = "logout()">Log Out</a>

			</div>


			<!--Navigation bar-->
			<div class = "navbar">
				<nav>
					<!--Navbar links-->
					<!-- home page, which is current page, indicated by the active class; notifications page -->
					<a href = "http://127.0.0.1/home.php">Home</a
					
					><a href = "http://127.0.0.1/notifications.php">Notifications</a
					><form action = "../searchpage.php" method = "POST"><!--search bar, action is to post to searchpage.php, method is post-->
						<input type = "text" name = "search" placeholder="Search WorldTree">
					</form>
				</nav>
			</div>
			<!--User profile button on top right of the website, when clicked calls the openNav js function-->
			<div class = "uprofile">
					<img src = "../profile_i/avatar.png" alt = "user profile picture" onclick="openNav()">
			</div>	
		</div>
		

		<!--Feed-->
		<div class = "posts">
				<form action = "settingspreferences.php" method = "POST">
				<br><br><strong>About You</strong><br><br>
					&nbsp&nbsp&nbsp&nbsp<textarea name = "bio" rows="10" cols="60">
						<?php
						if (isset($_POST['bio'])){
							echo $_POST['bio'];//if the bio var is sent by post then echo it here
						} 						
						?>
					</textarea>
					<br> <input type = "submit" value = "Submit Changes">
				</form>
				<?php 
				if (isset($_POST['bio'])){
					echo $error;//if the bio var has been sent then echo the error var here
				}	
				?>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href = "" class = "active">Preferences</a><!-- current page, hence the active class -->
            <a href = "settingsaccount.php">Account</a><!-- link to account page in settings -->
            <a href = "settingsdelete.php">Delete Account</a><!-- link to delete page in settings -->
		</div>
	</div>


	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


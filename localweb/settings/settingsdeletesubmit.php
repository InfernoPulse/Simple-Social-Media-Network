<?php
//set the error var to blank
$error = "";
if (isset($_POST['deletea']) and isset($_POST['deleteb'])){// if both deletea and deleteb have been sent by post then
	//set the user var to the contents of the user cookie
	$user = $_COOKIE['user'];
	
    //Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
	//delete from postst records where the username field is equal to that of the user variable
    mysqli_query($connection,"DELETE FROM postsT WHERE username = '$user';")
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	//delete from users where the username field is equal to that of the user variable
    mysqli_query($connection,"DELETE FROM users WHERE username = '$user';")
    or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	
	//closing connection
	mysqli_close($connection);
	//change the page to the login page
    header("Location: http://127.0.0.1/");
    // unset cookies. from php manual http://www.php.net/manual/en/function.setcookie.php#73484
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
}
else{//else set the error var so that both checboxes should be checked for the account to be delted
    $error = "<br><br>Please check both boxes to delete your account";
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
				<h1><a href = "http://127.0.0.1/profile.php" class = "title"><?php echo $_COOKIE['user']; ?></a></h1><!--Echoes the current user-->
				<!-- the user image -->
				<br><img src = "../profile_i/avatar.png" alt = "user profile picture"><br>
				<!-- link to the users profile page, also calls the reset function -->
				<a href = "http://127.0.0.1/profile.php">Your Profile</a>
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
            <form action = "settingsdeletesubmit.php" method = "POST"><!--action is to post to settingsdeletesubmit.php where the method is by post-->
                <br><br><strong>Delete Your Account</strong><br><br>
                    &nbsp&nbsp&nbsp&nbsp<input type = "checkbox" name = "deletea">Confirm<br><!--checkbox to confirm deletion of your account-->
                    &nbsp&nbsp&nbsp&nbsp<input type = "checkbox" name = "deleteb">Re-Confirm<br><!--checkbox to reconfirm whether or not you want to delete your account-->
                <br><br>
                <input type = "submit" value = "Delete Account"><!--submit button to delete your account-->
				<?php 
					echo $error;//echo the error var
				?>
            </form>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href = "settingspreferences.php">Preferences</a><!-- link to preferences page in settings -->
            <a href = "settingsaccount.php" >Account</a><!-- link to account page in settings -->
            <a href = "" class = "active">Delete Account</a><!-- current page, hence the active class -->
		</div>
	</div>


	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


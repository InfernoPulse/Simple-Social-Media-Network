<?php



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
				<a href = "http://127.0.0.1/notifications.php">Settings</a>
				<!-- link to logout of the website, calls the logout function -->
				<a href = "http://127.0.0.1/" class = "logout" onclick = "logout()">Log Out</a>

			</div>


			<!--Navigation bar-->
			<div class = "navbar">
				<nav>
					<!--Navbar links-->
					<!-- home page, which is current page, indicated by the active class; notifications page -->
					<a href = "http://127.0.0.1/home.php">Home</a
					
					><a href = "">Notifications</a
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
            <form action = "settingsaccountsubmit.php" method = "POST">
			<br><br><strong>Change Your Password</strong><br><br>
                &nbsp&nbsp&nbsp&nbsp<input type = "password" name = "pword" placeholder = "Password">
                <br>&nbsp&nbsp&nbsp&nbsp<input type = "password" name = "repword" placeholder = "Re-enter Password"><br>
                <br>
                    <input type = "submit" value = "Submit Changes">
            </form>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href = "settingspreferences.php">Preferences</a><!-- link to preferences page in settings -->
            <a href = "" class = "active">Account</a><!-- current page, hence the active class -->
            <a href = "settingsdelete.php">Delete Account</a><!-- link to delete page in settings -->

		</div>
	</div>


	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


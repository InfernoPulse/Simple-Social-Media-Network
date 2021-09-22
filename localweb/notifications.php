<?php

?>

<!DOCTYPE html>

<head>
	<title>Home</title>
<link rel = "icon" href = "./profile_i/WorldTree.png"><!-- page title -->
	<link rel="stylesheet" type="text/css" href="website.css"><!-- getting the css stylesheet -->
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
				<br><img src = "./profile_i/avatar.png" alt = "user profile picture"><br>
				<!-- link to the users profile page, also calls the reset function -->
				<a href = "http://127.0.0.1/profile.php" onclick = "reset()">Your Profile</a>
				<!-- link to the settings page -->
				<a href = "./settings/settingspreferences.php">Settings</a>
				<!-- link to logout of the website, calls the logout function -->
				<a href = "http://127.0.0.1/" class = "logout" onclick = "logout()">Log Out</a>

			</div>


			<!--Navigation bar-->
			<div class = "navbar">
				<nav>
					<!--Navbar links-->
					<!-- home page, which is current page, indicated by the active class ; notifications page -->
					<a href = "http://127.0.0.1/home.php" >Home</a
					><a href = "" class = "active">Notifications</a
					><form action = "searchpage.php" method = "POST"><!--search bar-->
						<input type = "text" name = "search" placeholder="Search WorldTree">
					</form>
				</nav>
			</div>
			<!--User profile button on top right of the website, when clicked calls the openNav js function-->
			<div class = "uprofile">
					<img src = "./profile_i/avatar.png" alt = "user profile picture" onclick="openNav()">
			</div>	
		</div>
		

		<!--Feed-->
		<div class = "posts" id = "posts"><!-- create posts dive -->
			<div id ="post" class = "post"><!-- put a post inside the post div -->
				<!-- creating the divs for the post div -->
				<div class="vote"> </div>
				<!-- setting the title of the post to be welcome to world tree -->
				<div class = "title">Welcome to WorldTree</div>
				<!-- contents of the post -->
                <div class = "content">
                    Welcome to WorldTree! Here are some tips for navigating the site.
                    Pressing the home button on your navbar will send you to a mega feed containing the posts of everybody on this site!
                    If you click your user image on the top right of the screen it will open a navbar that you can use to go to your home page or to edit your settings.
                    <br><br>
                    We hope you enjoy your stay.
				</div>
				<!-- creator of the post in the subbar -->
                <div class = "subbar">Created by WorldTree</div>
			</div>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br><br><br><br><br>
			
		</div>
	</div>


	<!--JavaScript-->
	<script src = "script.js"></script>

</body>

</html>


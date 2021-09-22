<?php



?>

<!DOCTYPE html>

<head>
	<title><?php echo $_COOKIE['probepage'] . "'s page";?></title>
<link rel = "icon" href = "./profile_i/WorldTree.png"><!-- set the title of the page to be the name of the searched users page -->
	<link rel="stylesheet" type="text/css" href="website.css"><!-- getting the css stylesheet -->
</head>

<body onload = "profile(); feed();"><!-- when body loads call profile function and the feed function -->

	<!--Creating general grid container-->
	<div class = "grid-container" id = "grid-container">
		<div class = "header">


			<!--Side Navigation bar for User Profile-->
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><!-- close button for side bar, when clicked call the js function closeNav() -->
				<!-- link which contains the username and when clicked calls the reset function -->
				<h1><a href = "" class = "title" onclick = "reset()"><?php echo $_COOKIE['user']; ?></a></h1><!--Echoes the current user-->
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
					<!-- home page, notifications page -->
					<a href = "http://127.0.0.1/home.php">Home</a
					
					><a href = "http://127.0.0.1/notifications.php">Notifications</a
					><form action = "searchpage.php" method = "POST"><!--search bar, action is to post to searchpage.php, method is post-->
						<input type = "text" name = "search" placeholder="Search WorldTree">
					</form>
				</nav>
			</div>
			<!--User profile button on top right of the website, when clicked calls the openNav js function-->
			<div class = "uprofile">
					<img src = "./profile_i/avatar.png" alt = "user profile picture" onclick="openNav()">
			</div>	
		</div>
		
        <div class = "profile">
        	<!-- banner of the user -->
			<img src = "./banners/banner.png" alt = "banner">
			<!-- user image -->
            <img src = "./profile_i/avatar.png" class = "uimage" alt = "user image">

			<!-- user nav bar -->
            <div class = "userinfo">
                <div>
					<button onclick = "feed();" class = "pnav">Posts</button><!-- posts button which when clicked calls the feed function -->
                </div>
                <div>
					<button onclick = "follows();" class = "pnav">Follows</button><!-- follows function called when follows button clicked -->
                </div>
                <div></div><!-- div for spacing -->
                <div>
					<button class = "pnav" onclick = "followers();">Followers</button><!-- followers function claled when followers button clicked -->
                </div>
                <div>
					<button onclick = "about();" class = "pnav">About</button><!-- about function called when about button clicked -->
                </div>
                <div></div>
                <div></div>
                <div class = "uname">
					<?php echo $_COOKIE['probepage']; ?><!-- username of the current users page, not to be confused with the logged in users page, unless the logged in
				user clicked a link to their own page -->
                </div>
            </div>
            
        </div>
        
		<!--Feed-->
		<div class = "posts" id = "posts">
		
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
			<a href="./createpost/createpost.php">Make a Post</a><!--link to make a post page-->

			<div class = "dropdown"><!--sort buttons-->
				<button onclick = "dropdown()" class = "dropbtn">Sort</button><!-- dropdown button which when clicked calls the dropdown function creating a dropdown menu -->
				<div id = "dropcontent" class = "dropdown-content">
					<button onclick = "sortnew()" class = "sort">New</button><br><!-- sort by new button, calls the sortnew function -->
					<button onclick = "sortold()" class = "sort">Old</button><!-- sort by old, sorts the feed by oldest first -->
				</div>
			</div>
		</div>
	</div>


	<!--JavaScript-->
	<script src = "script.js"></script>

</body>

</html>
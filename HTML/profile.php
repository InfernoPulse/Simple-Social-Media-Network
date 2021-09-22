<?php



?>

<!DOCTYPE html>

<head>
	<title><?php echo $_COOKIE['user'];?></title>
	<link rel="stylesheet" type="text/css" href="website.css">
</head>

<body onload = "profile(); feed();">

	<!--Creating general grid container-->
	<div class = "grid-container" id = "grid-container">
		<div class = "header">


			<!--Side Navigation bar for User Profile-->
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				<h1><a href = "" class = "title"><?php echo $_COOKIE['user']; ?></a></h1>
				<br><img src = "./profile_i/avatar.png" alt = "user profile picture"><br>
				<a href = "">Your Profile</a>
				<a href = "">Friends</a>
				<a href = "">Saved</a>
				<a href = "./settings/settings.php">Settings</a>
				<a href = "http://127.0.0.1/home.html" class = "logout" onclick = "logout()">Log Out</a>

			</div>


			<!--Navigation bar-->
			<div class = "navbar">
				<nav>
					<!--Navbar links-->
					<a href = "http://127.0.0.1/home.php">Home</a
					><a href = "">Messages</a
					><a href = "">Notifications</a
					><form action = "search.php"><!--search bar-->
						<input type = "text" name = "search" placeholder="Search WorldTree">
					</form>
				</nav>
			</div>
			<!--User profile button-->
			<div class = "uprofile">
					<img src = "./profile_i/avatar.png" alt = "user profile picture" onclick="openNav()">
			</div>	
		</div>
		
        <div class = "profile">
        
            <img src = "./banners/banner.png" alt = "banner">
            <img src = "./profile_i/avatar.png" class = "uimage" alt = "user image">

            <div class = "userinfo">
                <div>
                    <a href = "profile.php">Posts</a>
                </div>
                <div>
                    <a href = "">Friends</a>
                </div>
                <div></div>
                <div>
                    <a href = "">Votes</a>
                </div>
                <div>
                    <a href = "">About</a>
                </div>
                <div></div>
                <div></div>
                <div class = "uname">
                    <?php echo $_COOKIE['user']; ?>
                </div>
            </div>
            
        </div>
        
		<!--Feed-->
		<div class = "posts" id = "posts">
		
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
			<a href="./createpost/createpost.php">Make a Post</a>

			<div class = "dropdown">
				<button onclick = "dropdown()" class = "dropbtn">Sort</button>
				<div id = "dropcontent" class = "dropdown-content">
					<form action = "sort.php" method = "GET">
						<input type = "button" name = "top" value = "top"><br>
						<input type = "button" name = "new" value = "new"><br>
						<input type = "button" name = "old" value = "old">
					</form>
				</div>
			</div>
		</div>
	</div>


	<!--JavaScript-->
	<script src = "script.js"></script>

</body>

</html>
<?php



?>

<!DOCTYPE html>

<head>
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="../website.css">
</head>

<body>

	<!--Creating general grid container-->
	<div class = "grid-container" id = "gen">
		<div class = "header">


			<!--Side Navigation bar for User Profile-->
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
				<h1><a href = "http://127.0.0.1/profile.php" class = "title"><?php echo $_COOKIE['user']; ?></a></h1>
				<br><img src = "../profile_i/avatar.png" alt = "user profile picture"><br>
				<a href = "http://127.0.0.1/profile.php">Your Profile</a>
				<a href = "">Friends</a>
				<a href = "">Saved</a>
				<a href = "">Settings</a>
				<a href = "http://127.0.0.1/home.html" class = "logout" onclick = "logout()">Log Out</a>

			</div>


			<!--Navigation bar-->
			<div class = "navbar">
				<nav>
					<!--Navbar links-->
					<a href = "http://127.0.0.1/home.php" class = "active">Home</a
					><a href = "">Messages</a
					><a href = "">Notifications</a
					><form action = "search.php"><!--search bar-->
						<input type = "text" name = "search" placeholder="Search WorldTree">
					</form>
				</nav>
			</div>
			<!--User profile button-->
			<div class = "uprofile">
					<img src = "../profile_i/avatar.png" alt = "user profile picture" onclick="openNav()">
			</div>	
		</div>
		

		<!--Feed-->
		<div class = "posts"><br>
            <form action = "settingchangea.php" method = "POST">
                <br><strong>Block a User</strong><br><br>
                    &nbsp&nbsp&nbsp&nbsp<textarea name = "uname" rows="2" cols="60"></textarea>
                <br><br>
                <input type = "submit" value = "Submit Changes">
                <br><br><strong>Blocked Users</strong><br><br>
                
            </form>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href = "settings.php">Themes</a>
            <a href = "settingsa.php" >Account</a>
            <a href = "" class = "active">Blocked Accounts</a>
            <a href = "settingsd.php">Delete Account</a>
		</div>
	</div>


	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


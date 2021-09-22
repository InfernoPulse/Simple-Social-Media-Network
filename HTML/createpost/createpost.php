<?php

?>

<!DOCTYPE html>

<head>
	<title>Create a Post</title>
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
				<a href = "../settings/settings.php">Settings</a>
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
		<div class = "posts">
            <form action = "postprocessing.php" method = "POST">
                <br><strong>Title</strong><br>
                    <textarea name = "title" rows="2" cols="60"></textarea>
                <br>
                <br><strong>Content</strong><br>
                    <textarea name = "content" rows="10" cols="60"></textarea>
                <br><br>
                    <input type = "submit" value = "Create Post">
            </form>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href="createpost.php" class = "active">Text</a>
            <a href="createpostI.php">Image</a>
		</div>
	</div>

	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


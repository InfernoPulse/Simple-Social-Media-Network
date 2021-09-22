<?php

$title = $_POST['title'];
$content = $_POST['content'];
$error = "";
$user = $_COOKIE['user'];

if (strlen($title) > 144){
    $error = "Your title must be shorter than 144 characters";
}

elseif (strlen($content) > 50000){
    $error = "Your post must be under 50,000 characters in length";
}

elseif (!empty($title) and !empty($content)){

	$title = sanitize($title);
	$content = sanitize($content);

    //Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
    //inserting new posts into the database
    mysqli_query($connection, " INSERT INTO postsT (dateCreated,
                                                    votes,
                                                    title,
                                                    content,
                                                    username) 

                                VALUES (            CURRENT_TIMESTAMP, 
                                                    0, 
                                                    '$title', 
                                                    '$content', 
                                                    '$user'
                                                    )
                                                    ;")
	or die ("Invalid query: ".mysqli_error($connection));
	
	//Closing the connection
	mysqli_close($connection);

	//Loading home page
	header("Location: http://127.0.0.1/home.php");
}

function sanitize($text){
	$text = htmlentities($text, ENT_QUOTES);
	$text = addslashes($text);
	return $text;
}
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
                    <textarea name = "title" rows="2" cols="60" ><?php echo $title; ?></textarea>
                <br>
                <br><strong>Content</strong><br>
                    <textarea name = "content" rows="10" cols="60" ><?php echo $content;?></textarea>
                <br><?php echo $error; ?><br>
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


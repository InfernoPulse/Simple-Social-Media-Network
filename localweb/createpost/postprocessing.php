<?php
//receiving posted form contents, setting the error var to blank, setting the user var to the user cookies contents
$title = (string)$_POST['title'];
$content = (string)$_POST['content'];
$error = "";
$user = $_COOKIE['user'];

//if the title is longer than 144 characters in length then
if (strlen($title) > 144){
    $error = "Your title must be shorter than or equal to 144 characters in length";//set error var to an error msg which says it must be shorter than or equal to 144 chars in length
}

//else if the content of the post is greater than 50,000 characters in length then
elseif (strlen($content) > 50000){
    $error = "Your post must be shorter than or equal to 50,000 characters in length";//set error var to an error msg which says it must be shorter than or equal to 50,000 chars in length
}

//else if the title is not empty or the title is equal to the string "0", as the empty function seems to include 0 as a integer as being empty then
else if (!empty($title) or $title == "0"){

	$title = sanitize($title);//execute the sanitize variable on the title
	$content = sanitize($content);//execute the santize variable on the content

    //Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");
	
    //inserting new posts into the database into their respective fields
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
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	
	//Closing the connection
	mysqli_close($connection);

	//Loading home page
	header("Location: http://127.0.0.1/home.php");
	
}

//else if the title is empty and not equal to the string "0" then
else if (empty($title) and $title != "0"){
	$error = "Please enter a value for your title";//set error var to please enter a value for your title
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
	<title>Create a Post</title>
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
				<a href = "../settings/settingspreferences.php">Settings</a>
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
			<!--form for creating a post-->
            <form action = "postprocessing.php" method = "POST"><!-- method is post and the action is to send to postprocessing.php -->
                <br><strong>Title</strong><br>
					<textarea name = "title" rows="2" cols="60" ><?php echo $title; ?></textarea><!-- Create a textbox 2 rows in height and 60 columns in length -->
					<!-- echo into the title textbox the contents of the posted title -->
                <br>
                <br><strong>Content</strong><br>
					<textarea name = "content" rows="10" cols="60" ><?php echo $content;?></textarea><!-- create a textbox 10 rows in height and 60 columns in length -->
					<!-- echo into the contents textbox the contents of the posted contents -->
                <br><?php echo $error; ?><br>
                    <input type = "submit" value = "Create Post"><!-- submit button for the post -->
            </form>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			<br><br><br><br><br>
            <a href="createpost.php" class = "active">Text</a><!-- link to create a post page, which is current page, indicated by the active class -->
            <a href="createpostI.php">Image</a><!-- link to create an image post page -->
		</div>
	</div>

	<!--JavaScript-->
	<script src = "../script.js"></script>

</body>

</html>


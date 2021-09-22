<?php

//getting posted input for search along with setting the error cookie to none and the error variable to blank
$search = $_POST["search"];
setcookie("error", "none");
$error = "";

//if the entered search value is blank then set the error var to ask the user to enter a search value and set the error cookie to the current error
if (empty($search) and (string)$search != "0"){
	$error = "Please enter a search value <br>";
	setcookie("error", $error);
}

//if the entered input is not alphanumeric, only containing letters from the alphabet and numbers then set the error var to tell the user they can only enter alphanumeric values
//along with setting the cookie to the error
else if(ctype_alnum($search) == FALSE){
	$error = "You may only search alphanumeric values <br>";
	setcookie("error", $error);
}

//else do the search
else{
	//Create a database connection
	$connection = mysqli_connect ("127.0.0.1","root");
	
	//Selecting the database
	mysqli_select_db ($connection, "website") or die ("Connection with database failed!");

	//in mysql set the user session variable named rownum to 0
	$output = mysqli_query($connection, "SET @rownum = 0;")
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured

	//select rownum, with it incrementing by one on each repitition, username and bio from the uesrs table where the username is contains in its first few characters
	//the contents of the search variable
	$output = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, username, bio FROM users WHERE username LIKE '$search%';")
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
}
?>

<!DOCTYPE html>

<head>
	<title>Search</title>
<link rel = "icon" href = "./profile_i/WorldTree.png"><!-- page title -->
	<link rel="stylesheet" type="text/css" href="website.css"><!-- getting the css stylesheet -->
</head>

<body onload = "search()"><!-- when body loads call the search js function -->

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
					<!-- home page, notifications page -->
					<a href = "http://127.0.0.1/home.php">Home</a
					
					><a href = "">Notifications</a
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
		

		<!--Feed-->
		<div class = "posts" id = "posts">
			<?php
				if (isset($output)){//if the output var is set then
					if (mysqli_num_rows($output)>0){//if the number of records in the output variable is greater than 0 then
						while ($row = mysqli_fetch_assoc($output)){//for the number of elements in the array created from the output variable
							$bio =  $row['bio'];//bio is = to the bio field for the current row
							$bio = str_replace(" ","_955f_",$row['bio']);//replace each occurence of the space with the strings _955f_ in the current rows bio field
							echo $row['rownum'] . " " . $row['username'] . " " . $bio . "<br>";//echo the current rownum, the current rows username along with the bio var
						}
					}

					else{//else then
						$error = 'No results were found for your input';//set the error var to say there were no results found for your input
						setcookie("error", $error);//set the error cookie to the error var
					}
					
					mysqli_free_result($output);//free memory used by the query
					mysqli_close($connection);//close the connection to the server
				}
				
				
				echo $error;//echo the error var
			?>
		</div>
		

		<!--utility buttons-->
		<div class = "util">
			
		</div>
	</div>


	<!--JavaScript-->
	<script src = "script.js"></script>

</body>

</html>


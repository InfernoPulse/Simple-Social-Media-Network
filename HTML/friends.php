<?php

$user = $_COOKIE['user'];

$connection = mysqli_connect("127.0.0.1","root");
mysqli_select_db ($connection, "website") or die ("Connection with database failed!");

$flist = mysqli_query("SELECT *, COUNT(*) FROM friends WHERE request = '$user' AND accepted = 1 OR addresse = '$user' AND accepted = 1;");

//Closing the connection
mysqli_close($connection);
?>

<!DOCTYPE html>

<html>

	<head>
	
		<title>
		
		</title>
		
	</head>
	
	<body>

    <?php 
    if ($flist["COUNT(*)"] == 0){
        $echo = "<h1> You have no friends <h1>";
    
    }
    
    else{
        while($row = mysqli_fetch_assoc($flist))
            echo ;  //need to figure out how to echo all the divs and images in the right location
    }
    ?>

	</body>
	
</html>
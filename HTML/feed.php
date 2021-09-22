<?php

//note, i'm not using * as fetch_assoc() does not like it

//receiving cookies
$user = $_COOKIE['user'];
$page = $_COOKIE['page'];
$direction = $_COOKIE['direction'];
$newpost = $_COOKIE['newPost'];
$oldpost = $_COOKIE['oldPost'];

//decoding post cookies
$newpost = urldecode($newpost);
$oldpost = urldecode($oldpost);


//connecting to server and testing connection
$connection = mysqli_connect ("127.0.0.1","root");
mysqli_select_db ($connection, "website") or die ("Connection with database failed!")
or die ("Invalid query: ".mysqli_error($connection));

//beginning of sql query for feed function
$computedString = mysqli_query($connection, "SET @rownum = 0;")
or die ("Invalid query: ".mysqli_error($connection));

//this is essentially for the first page only as all other pages will have this file called only after having pressed the forward or back button, therefore setting the cookie to be
//forward and back 
if ($direction == "none"){
	$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated DESC LIMIT 50;")
	or die ("Invalid query: ".mysqli_error($connection));

	while ($row = mysqli_fetch_assoc($computedString)){
		$title = str_replace(" ","_955f_",$row['title']);
		$title = html_entity_decode($title, ENT_QUOTES);

		$content = str_replace(" ","_955f_",$row['content']);
		$content = html_entity_decode($content, ENT_QUOTES);

		$dateCreated = str_replace(" ","_955f_",$row['dateCreated']);

		echo $row['rownum'] . " " . $dateCreated . " " . $row['votes'] . " " . $title . " " . $content . " " . $row['username'] . "<br>";
	}
}

//if user presses the forward button then get the next 50 posts ordered by desc on datecreated
if ($direction == "forward"){
	$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated DESC WHERE dateCreated < $oldpost LIMIT 50;")
	or die ("Invalid query: ".mysqli_error($connection));

	while ($row = mysqli_fetch_assoc($computedString)){
		$title = str_replace(" ","_955f_",$row['title']);
		$title = html_entity_decode($title, ENT_QUOTES);

		$content = str_replace(" ","_955f_",$row['content']);
		$content = html_entity_decode($content, ENT_QUOTES);

		$dateCreated = str_replace(" ","_955f_",$row['dateCreated']);

		echo $row['rownum'] . " " . $dateCreated . " " . $row['votes'] . " " . $title . " " . $content . " " . $row['username'] . "<br>";
	}
}

//if user presses the back button then get the 50 posts before the current posts displayed on your screen ordered by desc on date created
else if ($direction =="back"){
	$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username 
	FROM (title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated ASC WHERE dateCreated < $newpost LIMIT 50) 
	ORDER BY dateCreated DESC;")
	or die ("Invalid query: ".mysqli_error($connection));

	while ($row = mysqli_fetch_assoc($computedString)){
		$title = str_replace(" ","_955f_",$row['title']);
		$title = html_entity_decode($title, ENT_QUOTES);

		$content = str_replace(" ","_955f_",$row['content']);
		$content = html_entity_decode($content, ENT_QUOTES);

		$dateCreated = str_replace(" ","_955f_",$row['dateCreated']);

		echo $row['rownum'] . " " . $dateCreated . " " . $row['votes'] . " " . $title . " " . $content . " " . $row['username'] . "<br>";
	}
}
 



mysqli_free_result($computedString);
mysqli_close($connection);

?>
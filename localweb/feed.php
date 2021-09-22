<?php

//note, i'm not using * as fetch_assoc() does not like it

//receiving cookies contents
$package = $_POST['package'];	
$user = $_COOKIE['user'];
$probepage = $_COOKIE['probepage'];

//opening package
$package = explode(",",$package);//split package on each comma
$pageno = $package[0];//setting the 0th element to $pageno
$sortmethod = $package[1];//set the 1st element to $sortmethod
$page = $package[2];//set the 2nd element to $page

//connecting to server and testing connection, if connection to the database fails echo an error
$connection = mysqli_connect ("127.0.0.1","root");
mysqli_select_db ($connection, "website") or die ("Connection with database failed!")
or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured

//beginning of sql query for feed function
$computedString = mysqli_query($connection, "SET @rownum = $pageno;")//in mysql set pageno to a user session variable named rownum
or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured

if ($page == "home"){//if user is on the home page
	if ($sortmethod == "New"){//if the sortmethod is new
	$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated DESC LIMIT $pageno,50;")
	//select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by newest posts, only outputting the first 50 newest
	or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	}
	//else if sortmethod is old
	else if ($sortmethod == "Old"){
		$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated ASC LIMIT $pageno,50;")
		//select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by oldest posts, only outputting the first 50 newest
		or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
	}
}

else if ($page == "profile"){//else if user is on the profile page
	if ($sortmethod == "New"){//if the sortmethod is new
		$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT WHERE username = '$probepage' ORDER BY dateCreated DESC  LIMIT $pageno,50;")
		//select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by newest posts, only outputting the first 50 newest and only outputting the posts from the user that has been searched
		or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
		}
		else if ($sortmethod == "Old"){//else if sortmethod is old
			$computedString = mysqli_query($connection, "SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT WHERE username = '$probepage' ORDER BY dateCreated ASC LIMIT $pageno,50;")
			//select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by oldest posts, only outputting the first 50 newest and only outputting the posts from the user that has been searched
			or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured
		}
}

//while loop to echo each record 
while ($row = mysqli_fetch_assoc($computedString)){
	$title = str_replace(" ","_955f_",$row['title']);//replace the current records title fields spaces with _955f_
	$title = html_entity_decode($title, ENT_QUOTES);//decode all html entities in the title

	$content = str_replace(" ","_955f_",$row['content']);//replace the current records content fields spaces with _955f_
	$content = html_entity_decode($content, ENT_QUOTES);//decode all html entities in the content

	$dateCreated = str_replace(" ","_955f_",$row['dateCreated']);//replace the current records dateCreated fields spaces with _955f_
	//echo each field
	echo $row['rownum'] . " " . $dateCreated . " " . $row['votes'] . " " . $title . " " . $content . " " . $row['username'] . "<br>";
}


//free the memory associated with computedString
mysqli_free_result($computedString);
//close the connection
mysqli_close($connection);

?>
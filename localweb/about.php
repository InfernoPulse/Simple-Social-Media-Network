<?php
//get the cookie probepages's contents and set it to the variable user
$user = $_COOKIE['probepage'];

//Create a database connection
$connection = mysqli_connect ("127.0.0.1","root");

//Selecting the database
mysqli_select_db ($connection, "website") or die ("Connection with database failed!");

//execute a query where it selects bio from users where the username is that of the contents of probepage
$output = mysqli_query($connection, "SELECT bio FROM users WHERE username LIKE '$user';")
or die ("Invalid query: ".mysqli_error($connection));//echo an error has occured and why it has occured

//echo the bio, need a while loop as you can't echo an array normally
while ($row = mysqli_fetch_assoc($output)){
    echo $row['bio'];
}

//free the memory associated with computedString
mysqli_free_result($output);
//close the connection
mysqli_close($connection);
?>
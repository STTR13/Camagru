<?php
	//Sample Database Connection Script
	//Setup connection variables, such as database username and password
	$hostname="localhost";
	$username="your_dbusername";
	$password="your_dbpassword";
	$dbname="your_dbusername";
	$usertable="your_tablename";
	$yourfield = "your_field";
	//Connect to the database
	$connection = mysql_connect($hostname, $username, $password);
	mysql_select_db($dbname, $connection);
	//Setup our query
	$query = "SELECT * FROM $usertable";
	//Run the Query
	$result = mysql_query($query);
	//If the query returned results, loop through each result
	if($result) {
		while($row = mysql_fetch_array($result))
		{
			$name = $row["$yourfield"];
			echo "Name: " . $name;
		}
	}
?>

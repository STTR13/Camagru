<?php
	console.log("Setting up server...");

	/*
	** --- Database ---
	*/
	console.log("Setting up database...");


	$hostname="localhost";
	$username="root";
	$password="password";
	$dbname="camagru";


	console.log("Connect to the database...");
	if (!$connection = mysql_connect($hostname, $username, $password)) {
		console.log("Could not connect to mysql.");
		exit;
	}
	console.log("Connection established succesfuly.");


	console.log("Selecting database...");
	if (mysql_select_db($dbname, $connection)) {
		console.log("Database selected succesfuly.");
	} else {
		console.log("Could not select database. Creating a new one...");
		if (mysql_create_db($dbname, $connection) === true) {
			if (!mysql_select_db($dbname, $connection)) {
				console.log("New database created but could not select it.");
				exit;
			}
			console.log("New database created and selected. Setting-it-up...");

		} else {
			console.log("Could not create a new database.");
			exit;
		}
	}


	//Making sure the database is up to date and apply changes if not
	//ni
?>

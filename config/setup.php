<?php
	include 'database.php';

	console.log("Connecting to the database..."); //ni: write
	try {
	    $db = new PDO($dsn, $username, $password);
	} catch(PDOException $e) {
		//ni: pop a neeter error page
		//ni: try to setup a new db by copying one on an other server
		//ni: send report to main log
	    exit('Could not connect to mysql: '.$e);
	}
	console.log("Connection established succesfuly.");

	//ni: make sure the db is up-to-date
	$db->exec(file_get_contents($setup_file));
?>

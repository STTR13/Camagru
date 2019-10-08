<?php
	require_once '../classes/Database.class.php';

	$hostname = "127.0.0.1";
	$username = "root";
	$password = "password";
	$dsn = 'mysql:host='.$hostname.';port=3306;charset=utf8';
	$setup_file = '../../config/database.sql';
	$dumb_data_file = 'dumb_data.sql';

	$verbose = TRUE;

	$db = new Database($dsn, $username, $password);
	$db->exec("CREATE DATABASE IF NOT EXISTS `test`; USE `test`;");
	$db->exec(file_get_contents($setup_file));
	$db->exec(file_get_contents($dumb_data_file)); //run only on first testing

	// valid query 1
	$query = 'SELECT email FROM `user` WHERE `pseudo` = :p';
	$db->query($query, array(':p' => 'admin'));
	$f = $db->fetch();
	if (!empty(array_diff(array('email' => 'admin@insto.com'), $f))) {
		echo "Valid query 1 FAILED\n";
	}

	// valid query 2
	$query = 'SELECT email FROM `user` WHERE `pseudo` = :p';
	$db->query($query, array(':p' => 'non existant'));
	$f = $db->fetch();
	if ($f !== false) {
		echo "Valid query 2 FAILED\n";
	}

	// invalid query 1
	$query = 'email FROM `user` WHERE `pseudo` = :p';
	$exception = false;
	try {
		$db->query($query, array(':p' => 'admin'));
	}
	catch (PDOException $e) {
		//echo $e;
		$exception = true;
	}
	if ($exception !== true) {
		echo "Invalid query 1 FAILED\n";
	}

	// invalid query 2
	$query = 'SELECT email FROM `user` WHERE `pseudo` = :p';
	$exception = false;
	try {
		$db->query($query, array(/*':p' => 'admin', */'shity key' => 'shity value'));
	}
	catch (PDOException $e) {
		//echo $e;
		$exception = true;
	}
	if ($exception !== true) {
		echo "Invalid query 2 FAILED\n";
	}

	$db->exec("DROP DATABASE `test`;");
?>

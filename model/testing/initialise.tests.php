<?php
	require_once "../../model/functions/verbose.php";
	require_once '../../model/classes/Database.class.php';

	$hostname = "127.0.0.1";
	$username = "root";
	$password = "password";
	$dsn = 'mysql:host='.$hostname.';port=3306;charset=utf8';
	$setup_file = '../../config/database.sql';
	$dumb_data_file = '../../model/testing/dumb_data.sql';

	$verbose = TRUE;

	$db = new Database($dsn, $username, $password);

	$db->exec("DROP DATABASE IF EXISTS `test`;");

	$db->exec("CREATE DATABASE IF NOT EXISTS `test`; USE `test`;");
	$db->exec(file_get_contents($setup_file));
	$db->exec(file_get_contents($dumb_data_file));
?>

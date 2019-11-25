<?php
	require $_SERVER["DOCUMENT_ROOT"] . '/config/database.php';
	require $_SERVER["DOCUMENT_ROOT"] . '/config/variables.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/id_cookie.php';
	session_start();

	// connect to db
	try
	{
		$db = new Database($dsn . ";dbname=" . $dbname, $username, $password);
		// var_dump($db);
	}
	catch(PDOException $e) {
	    echo ('Error while connecting to mysql server: ' . $e . '<br>');
		exit;
	}

	// test wether the cookie is recognised, login if yes and initialise a new cookie if not
	if (!User::is_logged($_SESSION)) {
		try {
			$usr = new User($_COOKIE[$id_cookie_name], $db);
			$_SESSION['user'] = serialize($usr);
		} catch (Exception $e) {
			new_id_cookie($db, $id_cookie_name);
		}
	}

	$_SESSION['db'] = serialize($db);

?>

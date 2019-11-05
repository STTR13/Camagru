<?php

	require_once '../../model/testing/initialise.tests.php';
	require_once '../../model/classes/User.class.php';
	require_once '../../model/functions/id_cookie.php';
	session_start();

	try {
		$usr = new User($_COOKIE[$id_cookie_name], $db);
		$_SESSION['user'] = serialize($usr);
	} catch (Exception $e) {
		new_id_cookie($db, $id_cookie_name);
	}

	$_SESSION['db'] = serialize($db);
	var_dump($_SESSION);

	header('Location: ../../view/layout/home.php');

?>

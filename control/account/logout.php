<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/hash_password.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/id_cookie.php';

	$id_cookie_name = 'id_cookie';

	$_SESSION['user'] = null;
	//unlink_cookie(unserialize($_SESSION['db']), $_COOKIE[$id_cookie_name]);
	header('Location: ../../view/layout/index.php');
?>

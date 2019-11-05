<?php
	session_start();
	require_once '../../model/classes/User.class.php';
	require_once '../../model/functions/hash_password.php';
	require_once '../../model/classes/Database.class.php';

	$_SESSION['user'] = null;
	header('Location: ../../view/layout/index.php');
?>

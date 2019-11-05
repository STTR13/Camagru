<?php
	session_start();
	require_once '../../model/classes/User.class.php';
	require_once '../../model/functions/hash_password.php';
	require_once '../../model/classes/Database.class.php';
	require_once '../../model/functions/id_cookie.php';

	$id_cookie_name = 'id_cookie';

	$_SESSION['user'] = null;
	del_id_cookie($db, $_COOKIE[$id_cookie_name]);
	header('Location: ../../view/layout/index.php');
?>

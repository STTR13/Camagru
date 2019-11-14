<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';

	if (!(!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null)) {
		try {
			$p = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
			$p->like(unserialize($_SESSION['user']));
		} catch (Exception $e) {
			echo $e;
		}
	}

	echo $p->get_likes();

?>

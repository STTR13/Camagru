<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';


	try {
		$p = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
		$p->get_comments();
	} catch (Exception $e) {
		echo $e;
	}

?>

<?php

	// echo $_POST['picture_id'];

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';

	try {
		$p = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
		$p->set_public();
	} catch (Exception $e) {
		echo $e;
	}

?>

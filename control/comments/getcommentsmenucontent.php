<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/comments.php';

	try {
		$p = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
		html_comments($p);
	} catch (Exception $e) {
		echo $e;
	}

?>

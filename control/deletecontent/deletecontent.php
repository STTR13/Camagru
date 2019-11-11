<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';

	foreach ($_POST as $key => $value) {
		if ($value == 'on') {
			$p = new Picture($key, unserialize($_SESSION['db']));
			unlink($_SERVER["DOCUMENT_ROOT"] . '/data/content/' . $p->get_path());
			$p->delete(unserialize($_SESSION['user']));
		}
	}

	header('Location: ../../view/layout/pictures.php');
?>

<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	try {
		$usr = User::receive_account_verification_request($_GET['a'], $_GET['b'], unserialize($_SESSION['db']));
		$_SESSION['user'] = serialize($usr);

		header('Location: ../../view/layout/home.php');
	} catch (Exception $e) {

		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../index.php';
		</script><?php

	}
?>

<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	try {
		User::send_account_retrieval($_POST['email'], unserialize($_SESSION['db']), "http://localhost:8080/control/account/receiveaccountretrieval.php");
		header('Location: ../../view/layout/home.php');
	} catch (Exception $e) {

		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../index.php';
		</script><?php

	}
?>

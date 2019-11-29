<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/hash_password.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	// var_dump($_SESSION['user']);
	$usr = unserialize($_SESSION['user']);
	// var_dump($usr);
	$b = false;

	try {
		if (!$usr->is_correct_password(hash_password($_POST['old']))) {
			throw new InvalidParamException("Failed setting password. Wrong old password.");
		}
		if ($_POST['new'] != $_POST['conf']) {
			throw new InvalidParamException("Failed setting password. The confirmation password is different to the new one.");
		}
		if (!User::is_valid_password($_POST['new'])) {
			throw new InvalidParamException("Failed setting password. Your new password is probably not secure enough. It has to be between 12 and 64 characters long.");
		}
		$usr->set_password(hash_password($_POST['new']));
	} catch (Exception $e) {
		$b = true;

		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../view/layout/settings.php';
		</script><?php

	} finally {
		$_SESSION['user'] = serialize($usr);
	}

	if (!$b) {
		header('Location: ../../view/layout/settings.php');
	}

?>

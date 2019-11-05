<?php
	session_start();
	require_once '../../model/classes/User.class.php';
	require_once '../../model/functions/hash_password.php';
	require_once '../../model/classes/Database.class.php';

	try {
		$usr = new User($_POST['email'], hash_password($_POST['password']), unserialize($_SESSION['db']));
		$_SESSION['user'] = serialize($usr);
		header('Location: ../../view/layout/index.php');
	} catch (Exception $e) {

		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../view/layout/index.php';
		</script><?php

	}
?>

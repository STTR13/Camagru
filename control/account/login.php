<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/hash_password.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	try {
		$usr = new User($_POST['pseudo'], hash_password($_POST['password']), unserialize($_SESSION['db']));
		if ($usr->is_validated_account()) {
			$_SESSION['user'] = serialize($usr);
			header('Location: ../../view/layout/home.php');
		} else {

			?><script type='text/javascript'>
				alert("You need to confirm your account by clicking on the link we've sent you by mail");
				window.location.href='../../index.php';
			</script><?php

		}

	} catch (Exception $e) {

		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../index.php';
		</script><?php

	}
?>

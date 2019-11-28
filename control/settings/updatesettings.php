<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/hash_password.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	// var_dump($_SESSION['user']);
	$usr = unserialize($_SESSION['user']);
	// var_dump($usr);
	$b = false;

	if ($usr->get_pseudo() !== $_POST['pseudo']) {
		// echo "came here 1";
		try {
			$usr->set_pseudo($_POST['pseudo']);
		} catch (Exception $e) {
			$b = true;

			?><script type='text/javascript'>
				alert('<?= $e ?>');
				window.location.href='../../view/layout/settings.php';
			</script><?php

		} finally {
			$_SESSION['user'] = serialize($usr);
		}
	}

	if ($usr->get_email() !== $_POST['email']) {
		// echo "came here 2";
		try {
			$usr->set_email($_POST['email']);
		} catch (Exception $e) {
			$b = true;

			?><script type='text/javascript'>
				alert('<?= $e ?>');
				window.location.href='../../view/layout/settings.php';
			</script><?php

		} finally {
			$_SESSION['user'] = serialize($usr);
		}
	}

	if ($usr->get_pref_mail_notifications() !== array_key_exists('emailpref', $_POST)) {
		//echo "came here";
		try {
			$usr->set_pref_mail_notifications();
		} catch (Exception $e) {
			$b = true;

			?><script type='text/javascript'>
				alert('<?= $e ?>');
				window.location.href='../../view/layout/settings.php';
			</script><?php

		} finally {
			$_SESSION['user'] = serialize($usr);
		}
	}

	if ($_POST['oldpw'] != '' && $_POST['newpw'] != '') {
		// echo "came here 3";
		try {
			if (!$usr->is_correct_password(hash_password($_POST['oldpw']))) {
				throw new InvalidParamException("Fail setting password. Wrong old password.");
			}
			$usr->set_password(hash_password($_POST['newpw']));
		} catch (Exception $e) {
			$b = true;

			?><script type='text/javascript'>
				alert('<?= $e ?>');
				window.location.href='../../view/layout/settings.php';
			</script><?php

		} finally {
			$_SESSION['user'] = serialize($usr);
		}
	}

	if (!$b) {
		header('Location: ../../view/layout/settings.php');
	}

?>

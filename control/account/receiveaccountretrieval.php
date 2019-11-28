<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/hash_password.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Database.class.php';

	try {
		$usr = User::receive_account_retrieval($_GET['a'], $_GET['b'], unserialize($_SESSION['db']));
	} catch (Exception $e) {
		?><script type='text/javascript'>
			alert('<?= $e ?>');
			window.location.href='../../index.php';
		</script><?php
	}

	$b = false;

	if ($_POST['newpw'] != '' && $_POST['confirmpw'] != '' && $_POST['newpw'] == $_POST['confirmpw']) {
		try {
			$usr->set_password(hash_password($_POST['newpw']));
		} catch (Exception $e) {
			$b = true;

			?><script type='text/javascript'>
				alert('<?= $e ?>');
				window.location.href='../../view/layout/accountretrieval.php?a=' . $_GET['a'] . '&b=' . $_GET['b'];
			</script><?php

		} finally {
			$_SESSION['user'] = serialize($usr);
		}
	}

	if (!$b) {
		header('Location: ../../index.php');
	}

?>

<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/comment.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/send_mail.php';

	try {
		$picture = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
		$picture->add_comment(unserialize($_SESSION['user']), $_POST['content']);

		send_mail(
			$picture->get_user_id(),
			unserialize($_SESSION['db']),
			"INSTO: " . unserialize($_SESSION['user'])->get_pseudo() . " commented one of your pictures.",
			$_POST['content']
		);
	} catch (Exception $e) {

	} finally {
		// return updated comments
		$comments = $picture->get_comments();
		foreach ($comments as $comment) {
			html_comment($comment);
		}
	}

?>

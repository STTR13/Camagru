<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/comment.php';

	try {
		$picture = new Picture($_POST['picture_id'], unserialize($_SESSION['db']));
	

		// return updated comments
		$comments = $picture->get_comments();
		foreach ($comments as $comment) {
			html_comment($comment);
		}
	} catch (Exception $e) {
		echo $e;
	}

?>

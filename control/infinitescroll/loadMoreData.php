<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/galery/post.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	$picture = unserialize($_SESSION['picture']);
	//var_dump($picture);
	if ($picture != false) {
		try {
			post($picture);
			$_SESSION['picture'] = serialize($picture->get_next_public());
		}
		catch (Exception $e) {
			echo "exeption thrown : $e\n";
		}
	}
?>

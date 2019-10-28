<?php
	session_start();
	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
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

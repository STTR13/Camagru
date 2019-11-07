<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/merge.php';

	$img = $_POST['img'];

	if (strpos($img, 'data:image/png;base64,') === 0) {
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$tmp_file = '../../data/content/tmp.png';

		if (file_put_contents($tmp_file, $data)) {
			try {
				$picture = new Picture('tmp.png', unserialize($_SESSION['user']), unserialize($_SESSION['db']));
				$picture->set_path($picture->get_id() . ".png");
			} catch (Exception $e) {
				echo $e;
			}

			merge($tmp_file, "../../data/filters/1.png", '../../data/content/' . $picture->get_path());
			unlink($tmp_file);

			echo '../../data/content/' . $picture->get_id() . '.png';
	 	}
	}

?>

<?php

	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/functions/merge.php';

	$filter = $_POST['filter'];
	$tmp_file = $_SERVER["DOCUMENT_ROOT"] . '/data/content/tmp.png';

	if(array_key_exists('img', $_POST)) {
		$img = $_POST['img'];
		if (strpos($img, 'data:image/png;base64,') === 0) {
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);

			if (!file_put_contents($tmp_file, $data)) {
				die;
		 	}
		}
	}
	else {
		$fileExtensions = ['png'];

	    $fileName = $_FILES['file']['name'];
	    $fileSize = $_FILES['file']['size'];
	    $fileTmpName  = $_FILES['file']['tmp_name'];
	    $fileType = $_FILES['file']['type'];
	    $fileExtension = strtolower(end(explode('.',$fileName)));

		if (in_array($fileExtension,$fileExtensions) && $fileSize < 2000000) {
			$didUpload = move_uploaded_file($fileTmpName, $tmp_file);
		} else {
			die;
		}
	}

	try {
		$picture = new Picture('tmp.png', unserialize($_SESSION['user']), unserialize($_SESSION['db']));
		$picture->set_path($picture->get_id() . ".png");
	} catch (Exception $e) {
		echo $e;
	}

	merge($tmp_file, "../../data/filters/" . $filter, '../../data/content/' . $picture->get_path());
	unlink($tmp_file);

	echo '../../data/content/' . $picture->get_id() . '.png';

?>

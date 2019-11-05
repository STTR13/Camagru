<?php

	@ob_start();
	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
	require_once '../../model/testing/initialise.tests.php';
	session_start();

	$_SESSION['db'] = serialize($db);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body onscroll="scroll()">
		<?php

			require_once 'stylesheets.php';
			stylesheets();

			require_once 'header.php';
			vheader();

			require_once 'galery.php';
			galery($db);
			
		?>
	</body>
</html>

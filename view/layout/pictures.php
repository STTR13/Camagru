<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	session_start();

	if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
		header('Location: ../../view/layout/home.php');
	}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body onscroll="scroll()">
		<?php

			require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
			html_stylesheets();

			require_once $_SERVER["DOCUMENT_ROOT"] . '/view/header/header.php';
			html_header();

		?>
		<div id="galery" class="main container">
			<div class="row">
				<div class="col-sm-8" id="camera">
					<?php

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/camera/camera.php';
						html_camera(unserialize($_SESSION['db']));

					?>
				</div>
				<div class="col-sm-4" id="camera">
					<?php

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/account/logout.php';
						html_logout();

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/personalcontent/personalcontentlist.php';
						personalcontentlist(unserialize($_SESSION['user']), unserialize($_SESSION['db']));

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/deletecontent/deletecontentform.php';
						deletecontentform(unserialize($_SESSION['user']), unserialize($_SESSION['db']))

					?>
				</div>
			</div>
		</div>
	</body>
</html>

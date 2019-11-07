<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	session_start();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body onscroll="scroll()">
		<?php

			require_once '../../view/stylesheets/stylesheets.php';
			html_stylesheets();

			require_once '../../view/header/header.php';
			html_header();

		?>
		<div id="galery" class="main container">
			<div class="row">
				<?php

					require_once '../../view/camera/camera.php';
					html_camera(unserialize($_SESSION['db']));

				?>
			</div>
		</div>
	</body>
</html>

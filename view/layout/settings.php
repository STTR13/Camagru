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

			require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
			html_stylesheets();

			require_once $_SERVER["DOCUMENT_ROOT"] . '/view/header/header.php';
			html_header();

		?>
		<div id="galery" class="main container">
			<div class="row">
				<?php

					require_once $_SERVER["DOCUMENT_ROOT"] . '/view/settings/settings.php';
					html_settings(unserialize($_SESSION['user']));

				?>
			</div>
		</div>
	</body>
</html>

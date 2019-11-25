<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/layout/init.php';

	if (!User::is_logged($_SESSION)) {
		header('Location: /view/layout/home.php');
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
		<div class="main container">
			<div class="row">
				<div class="col-sm-8" id="settings">
					<?php

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/settings/settings.php';
						html_settings(unserialize($_SESSION['user']));

					?>
				</div>
				<div class="col-sm-4" id="camera">
					<?php

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/account/logout.php';
						html_logout();

					?>
				</div>
			</div>
		</div>
	</body>
</html>

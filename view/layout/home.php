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

					require_once $_SERVER["DOCUMENT_ROOT"] . '/view/galery/galery.php';
					html_galery(unserialize($_SESSION['db']));

				?>

				<div class="col-sm-4">
						<?php

							if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
								require_once $_SERVER["DOCUMENT_ROOT"] . '/view/account/login.php';
								html_login();
							} else {
								require_once $_SERVER["DOCUMENT_ROOT"] . '/view/account/logout.php';
								html_logout();
							}

						?>
				</div>
			</div>
		</div>
	</body>
</html>

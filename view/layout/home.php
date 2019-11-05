<?php

	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
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

			require_once 'stylesheets.php';
			html_stylesheets();

			require_once 'header.php';
			html_header();

		?>
		<div id="galery" class="main container">
			<div class="row">
				<?php

					require_once 'galery.php';
					html_galery(unserialize($_SESSION['db']));

					if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
						require_once 'login.php';
						html_login();
					} else {
						require_once 'logout.php';
						html_logout();
					}

				?>
			</div>
		</div>
	</body>
</html>

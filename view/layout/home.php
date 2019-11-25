<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/layout/init.php';

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
					html_galery($db);

				?>

				<div class="col-sm-4">
						<?php

							if (!User::is_logged($_SESSION)) {
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
		<?php

			require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/commentsoverlaymenu.php';
			html_commentsoverlaymenu();

		?>
	</body>
</html>

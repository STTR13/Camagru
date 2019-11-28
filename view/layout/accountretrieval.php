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
		<div class="main container">
			<div class="row">
				<div class="col-sm" id="settings">
					<?php

						require_once $_SERVER["DOCUMENT_ROOT"] . '/view/account/accountretrieval.php';
						html_accountretrieval(unserialize($_SESSION['user']));

					?>
				</div>
			</div>
		</div>
	</body>
</html>

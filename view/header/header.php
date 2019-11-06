<?php
	function html_header() {

?>
<div class="mynavbar">
<?php

	if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
	} else {

		?>
	<a class="fleft" href="home.php">Galery</a>
	<a class="fright" href="settings.php">Settings</a>
	<a class="fright" href="pictures.php">Pictures</a>
		<?php

	}

?>
	<h1 class="logo">Inst<img class="logo-img" src="/data/images/logo.png"></h1>
</div>
<?php

	}
?>

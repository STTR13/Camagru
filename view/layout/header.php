<?php
	function vheader() {

?>
<div class="mynavbar">
<?php

	if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
	} else {

		?>
	<a class="fleft" href="#home">Galery</a>
	<a class="fright" href="#settings">Settings</a>
	<a class="fright" href="#pictures">Pictures</a>
		<?php

	}

?>
	<h1 class="logo">Inst<img class="logo-img" src="/data/images/logo.png"></h1>
</div>
<?php

	}
?>

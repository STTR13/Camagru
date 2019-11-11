<?php
	function html_logout() {
		$usr = unserialize($_SESSION['user']);

		?>
<div id="login" class="post" style="display: block;">
	<form action="../../control/account/logout.php" class="head-info" method="post">
		<h3 style="color: black; display: inline;"><?= $usr->get_pseudo() ?></h3>
		<input type="submit" value="logout" style="display: inline; font-size: 0.7em; color: black; cursor: pointer; border: none; background: none; color: red;">
	</form>
</div>
		<?php

	}
?>

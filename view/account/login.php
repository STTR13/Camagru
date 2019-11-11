<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/User.class.php';

	function html_login() {

		?>
<div id="login" class="post" style="display: block;">
	<form action="../../control/account/login.php" class="head-info" method="post">
		<h3 style="text-align: center; color: black;">Log-in</h3>
		Email:<br>
		<input type="text" name="email" value="" style="border: none; width: 100%;">
		<br>
		Password:<br>
		<input type="password" name="password" value="" style="border: none; width: 100%;">
		<br><br>
		<div style="text-align: center;">
			<input type="submit" value="Submit" class="insto-button">
			<br>
			<a onclick="to_account_creation()" style="font-size: 0.7em; color: black; cursor: pointer;">I dont have any account</a>
		</div>
	</form>
</div>
<div id="account-creation" class="post" style="display: none;">
	<form action="../../control/account/create.php" class="head-info" method="post">
		<h3 style="text-align: center; color: black;">Create an account</h3>
		Pseudo:<br>
		<input type="text" name="pseudo" value="" style="border: none; width: 100%;">
		Email:<br>
		<input type="text" name="email" value="" style="border: none; width: 100%;">
		<br>
		Password:<br>
		<input type="password" name="password" value="" style="border: none; width: 100%;">
		<br>
		Confirm password:<br>
		<input type="password" name="confirm_password" value="" style="border: none; width: 100%;">
		<br><br>
		<div style="text-align: center;">
			<input type="submit" value="Submit" class="insto-button">
			<br>
			<a onclick="to_login()" style="font-size: 0.7em; color: black; cursor: pointer;">I alredy have an account</a>
		</div>
	</form>
</div>
<script type="text/javascript">
	function to_account_creation() {
		document.getElementById("login").style.display = "none";
		document.getElementById("account-creation").style.display = "block";

	}
	function to_login() {
		document.getElementById("account-creation").style.display = "none";
		document.getElementById("login").style.display = "block";
	}
</script>
		<?php

	}

?>

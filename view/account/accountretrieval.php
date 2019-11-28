<?php

	function html_accountretrieval() {

?>
<div class="post">
	<div class="head-info" style="padding-bottom: 0px;">
		<h3 style="text-align: center; color: black;">Retrieve your password</h3>
	</div>
	<form class="container" action="../../control/account/receiveaccountretrieval.php?a=<?= $_GET['a'] ?>&b=<?= $_GET['b'] ?>" method="post">

		<div class="row head-info" style="padding-bottom: 0px;">
			<div class="col-sm-2" style="text-align: right;">
				<div>New password:</div>
			</div>
			<div class="col-sm">
				<input type="password" name="newpw" value="" style="border: none; width: 100%;">
			</div>
		</div>

		<div class="row head-info" style="padding-bottom: 0px;">
			<div class="col-sm-2" style="text-align: right;">
				<div>Confirm:</div>
			</div>
			<div class="col-sm">
				<input type="password" name="confirmpw" value="" style="border: none; width: 100%;">
			</div>
		</div>

		<div style="text-align: center;" class="head-info">
			<input type="submit" value="save changes" class="insto-button">
		</div>
	</form>
</div>

<?php
	}
?>

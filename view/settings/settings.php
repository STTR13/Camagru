<?php

	function html_settings($usr) {
		if (!User::is_valid($usr)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid user.\n", 1);
		}

?>
<div class="post">
	<div class="head-info" style="padding-bottom: 0px;">
		<h3 style="text-align: center; color: black;">Settings</h3>
	</div>
	<form class="container" action="../../control/settings/updatesettings.php" method="post">

		<div class="row head-info" style="padding-bottom: 0px;">
			<div class="col-sm-2" style="text-align: right;">
				<div>Pseudo:</div>
			</div>
			<div class="col-sm">
				<input type="text" name="pseudo" value="<?= $usr->get_pseudo() ?>" style="border: none; width: 100%;">
			</div>
		</div>

		<div class="row head-info" style="padding-bottom: 0px;">
			<div class="col-sm-2" style="text-align: right;">
				<div>Email:</div>
			</div>
			<div class="col-sm">
				<input type="text" name="email" value="<?= $usr->get_email() ?>" style="border: none; width: 100%;">
			</div>
		</div>

		<div class="row head-info" style="padding-bottom: 0px; padding-top: 3px;">
			<div class="col-sm-2" style="text-align: right;"></div>
			<div class="col-sm" style="text-align: left;">
				<input type="checkbox" name="emailpref" <?php if ($usr->get_pref_mail_notifications()) { ?>checked<?php } ?> style="display: inline;">
				<div style="display: inline; font-size: 0.7em; color: #b5b6b6;">Receive news by email</div>
			</div>
		</div>

		<div class="row head-info" style="padding-bottom: 0px;">
			<div class="col-sm-2" style="text-align: right;">
				<div>Password:</div>
			</div>
			<div class="col-sm" style="text-align: right;">
				<div style="padding-bottom: 16px;">
					old: <input type="password" name="oldpw" value="" style="border: none; width: 80%">
				</div>
				<div>
					new: <input type="password" name="newpw" value="" style="border: none; width: 80%">
				</div>
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

<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/personalcontent/personalcontentelem.php';

	function personalcontentlist($usr, $db) {
		if (!User::is_valid($usr)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid user.\n", 1);
		}
		if (!Database::is_valid($db)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid db object.", 2);
		}

?>
<div class="col-sm-4">
	<div class="post">
		<?php

			$picture = Picture::get_most_recent_from_user($usr, $db);
			var_dump($picture);
			while ($picture) {
				personalcontentelem($picture);
				$picture = $picture->get_next_from_user();
			}

		?>
	</div>
</div>
<?php

	}

?>

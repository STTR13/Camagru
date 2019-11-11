<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';

	function deletecontentelem($p) {
		// if (!Picture::is_valid($p)) {
		// 	throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid picture.\n", 1);
		// }

?>
<div class="filter" style="display: inline;">
	<input type="checkbox" name="<?= $p->get_id() ?>" value="on">
	<img src="<?= '/data/content/' . $p->get_path() ?>" height="100px">
</div>
<?php

	}

	// try {
	// 	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/Picture.class.test.php';
	// 	personalcontentelem($p1);
	// } catch (Exception $e) {
	// 	echo $e;
	// }

?>

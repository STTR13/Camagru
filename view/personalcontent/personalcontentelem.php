<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';

	function personalcontentelem($p) {
		if (!Picture::is_valid($p)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid picture.\n", 1);
		}

?>
<div class="filter" style="float: left;">
	<input id="content<?= $p->get_id() ?>" type="checkbox">
	<img src="<?= '/data/content/' . $p->get_content() ?>" height="100px">
</div>
<?php

	}

try {
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/Picture.class.test.php';
	personalcontentelem($p2);
} catch (Exception $e) {
	echo $e;
}



?>

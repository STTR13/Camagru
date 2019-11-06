<?php
	require_once "../../view/galery/post.php";

	function html_galery($db) {
		if (!Database::is_valid($db)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid db object.", 1);
		}
?>
<div class="col-sm" id="feed">
	<?php

		$picture = Picture::get_most_recent_public($db);
		for ($i=0; $i < 3 && $picture != false; $i++) {
			post($picture);
			$picture = $picture->get_next_public();
		}
		$_SESSION['picture'] = serialize($picture);

	?>
</div>
<script type="text/javascript" src="../../view/galery/galery.js"></script>

<?php
	}
?>

<?php
	require_once "../../view/galery/post.php";

	function feed($db) {
		if (!Database::is_valid($db)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid database.\n", 1);
		}

		$picture = Picture::get_most_recent_public($db);

?><link href="../../view/galery/post.css" rel="stylesheet">
<link href="../../view/galery/feed.css" rel="stylesheet">
<div class="">
	<?php

		for ($i=0; $i < 3 && $picture != false; $i++) {
			post($picture);
			$picture = $picture->get_next_public();
		}

	?>
</div>
<?php
	}

	require_once '../../model/testing/initialise.tests.php';
	feed($db);
?>

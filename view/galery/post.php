<?php
	require_once "../../model/classes/Picture.class.php";

	function post($p) {
		if (!Picture::is_valid($p)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid picture.\n", 1);
		}

?><div class="post">
	<div class="head-info">
		<user><?=$p->get_user_pseudo()?></user>
		<date><?=$p->get_date()?></date>
	</div>
	<img class="picture" src="<?='/data/content/' . $p->get_path()?>">
	<div class="foot-info">
		<div class="like">
			<button class="button" type="button" name="like">
				<img class="like-img" src="/data/images/white-heart.png">
			</button>
			<div class="like-amount">13 likes</div>
		</div>
	</div>
</div><?php //ni: put the right amount of likes and add comments bellow
	}

	// require_once '../../model/testing/initialise.tests.php';
	// $p = new Picture(2, $db); //t
	// post($p);
?>

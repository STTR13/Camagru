<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/classes/Picture.class.php';

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
			<button class="button" type="button" onclick="like(<?= $p->get_id() ?>)">
				<img class="like-img" src="/data/images/white-heart.png">
			</button>
			<div id="like-amount<?= $p->get_id() ?>" class="like-amount"><?= $p->get_likes() ?> likes</div>
		</div>
		<div class="comment">
			<img class="comment-img" src="/data/images/comment.png">
			<div id="comment-amount<?= $p->get_id() ?>" class="like-amount"><?= $p->get_comment_amount() ?> comments</div>
		</div>
	</div>
</div><?php //ni: put the right amount of likes and add comments bellow
	}

	// require_once '../../model/testing/initialise.tests.php';
	// $p = new Picture(2, $db); //t
	// post($p);
?>

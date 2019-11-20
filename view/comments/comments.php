<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/comment.php';

	function html_comments($picture) {
		if (!Picture::is_valid($picture)) {
			throw new InvalidParamException("Failed running " . __FUNCTION__ . ". Invalid picture.\n", 1);
		}
		$comments = $picture->get_comments();

?>
<div class="col-sm">
	<?php

		require_once $_SERVER["DOCUMENT_ROOT"] . '/view/galery/post.php';
		post($picture);

	?>
	<div class="post">
		<div class="head-info" style="padding-bottom: 0px;">
			<h3 style="text-align: center; color: black;">Comments</h3>
		</div>
		<div class="">
			<?php

				foreach ($comments as $comment) {
					comment($comment);
				}

			?>
		</div>
		<div class="row head-info">
			<div class="col-sm-10">
				<input type="text" name="comment" style="border: none; width: 100%">
			</div>
			<div class="col-sm-2" style="text-align: center;">
				<input type="submit" value="send" class="insto-button">
			</div>
		</div>
	</div>
</div>
<?php

	}

	// require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
	// html_stylesheets();
	// require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/Picture.class.test.php';
	// html_comments($p1);
?>

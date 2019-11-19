<?php

	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/comments/comment.php';

	function html_comments($picture) {
		$comments = $picture->get_comments();

?>
<div id="myCom" class="overlay">

	<div class="overlay-content container">
		<div style="text-align: center;">
			<a href="javascript:void(0)" class="closebtn" onclick="closeComments()">&times;</a>
		</div>
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
				<div class="">

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function openComments() {
		document.getElementById("myCom").style.height = "100%";
	}
	function closeComments() {
		document.getElementById("myCom").style.height = "0%";
	}
</script>
<?php

	}

	require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
	html_stylesheets();
	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/Picture.class.test.php';
	html_comments($p1);
?>
<button onclick="openComments()" type="button" name="button">my button</button>
<?php

?>

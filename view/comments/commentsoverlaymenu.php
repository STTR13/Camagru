<?php

	function html_commentsoverlaymenu() {

?>
<div id="myCom" class="overlay">
	<div class="overlay-content container">
		<div style="text-align: center;">
			<a href="javascript:void(0)" class="closebtn" onclick="closeComments()">&times;</a>
		</div>
		<div id="comments-menu-content">

		</div>
	</div>
</div>

<script type="text/javascript" src="../../view/comments/commentsoverlaymenu.js"></script>
<script type="text/javascript" src="../../view/comments/addcomment.js"></script>
<?php

	}

	// require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
	// html_stylesheets();
	// require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/Picture.class.test.php';
	// html_commentsoverlaymenu();
	// <button onclick="openComments(4)" type="button" name="button">my button</button>

?>

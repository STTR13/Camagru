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
<div class="post">
	<div class="head-info" style="padding-bottom: 0px;">
		<h3 style="text-align: center; color: black;">Public</h3>
	</div>
	<div class="head-info" style="padding-bottom: 0px;">
		<div id="filters" style="white-space: nowrap; overflow-x: auto; background-color: white;">
			<?php

				$picture = Picture::get_most_recent_from_user($usr, $db);
				//var_dump($picture);
				while ($picture) {
					personalcontentelem($picture);
					$picture = $picture->get_next_from_user($usr);
				}

			?>
		</div>
		<div class="head-info" style="text-align: center;">
			<button id="save-public" class="insto-button">Save</button>
		</div>
	</div>
</div>
<?php

	}

	// try {
	//
	// 	require_once '../../view/stylesheets/stylesheets.php';
	// 	html_stylesheets();
	//
	// 	require_once $_SERVER["DOCUMENT_ROOT"] . '/model/testing/User.class.testing.php';
	// 	personalcontentlist($u1, $db);
	// } catch (Exception $e) {
	// 	echo $e;
	// }

?>

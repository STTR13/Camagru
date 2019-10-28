<!DOCTYPE html>
<?php
	@ob_start();
	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
	require_once '../../model/testing/initialise.tests.php';
	session_start();
?>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body onscroll="scroll()">
		<link href="../../view/galery/post.css" rel="stylesheet">
		<script type="text/javascript">
			function scroll() {
				var body = document.body;
				var html = document.documentElement;
				var docheight = Math.max( body.scrollHeight, body.offsetHeight,
                       html.clientHeight, html.scrollHeight, html.offsetHeight );
				var scroll = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;

				// console.log(scroll + " + " + window.innerHeight + " >= " + docheight);

				if (scroll + window.innerHeight >= docheight) {
					loadMoreData();
				}
			}

			function loadMoreData() {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					//console.log(this.readyState + " : " + this.status);
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById('feed').insertAdjacentHTML('beforeend', this.responseText);
					}
				};
				xhttp.open("GET", "../../view/galery/loadMoreData.php", true);
				xhttp.send();
			}
		</script>
		<div id="feed">
			<?php
				$picture = Picture::get_most_recent_public($db);
				for ($i=0; $i < 3 && $picture != false; $i++) {
					post($picture);
					$picture = $picture->get_next_public();
				}
				$_SESSION['picture'] = serialize($picture);
				//var_dump($_SESSION['picture']);
			?>
		</div>
	</body>
</html>

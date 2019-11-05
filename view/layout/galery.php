<?php
	require_once 'account.php';

	function galery($db) {
?>

<div id="galery" class="main container">
	<div class="row">
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
		<?php

			if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] == null) {
				login();
			} else {
				logout();
			}

		?>
	</div>
</div>

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

<?php
	}
?>

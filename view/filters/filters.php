<?php

	$amount_of_filters = 6;

?>
<form id="filters" action="index.html" method="post" style="white-space: nowrap; overflow-x: auto; background-color: white;">
	<?php

		for ($i=0; $i < $amount_of_filters; $i++) {

			?>
	<div class="filter" style="display: inline;">
		<input onchange="uncheckOthers(<?= $i ?>)" id="filter<?= $i ?>" type="checkbox" value="<?= $i . '.png' ?>">
		<img src="<?= '/data/filters/' . $i . '.png' ?>" height="100px">
	</div>
			<?php

		}

	?>
</form>
<script type="text/javascript">
	function uncheckOthers(clicked_id) {
		for (var i = 0; i < <?= $amount_of_filters ?>; i++) {
			if (clicked_id == i) {
				continue;
			}
			document.getElementById('filter' + i).checked = false;
		}
	}
</script>
<style media="screen">
	.filter {
		padding: 0px;
		margin: 16px;
	}
	.filter input {
		margin: 0;
		-ms-transform: translateY(-40px);
		transform: translateY(-40px);
	}
</style>

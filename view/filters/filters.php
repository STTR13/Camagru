<?php

	function filters() {
		$amount_of_filters = 6;

		?>
<form id="filters" action="index.html" method="post" style="white-space: nowrap; overflow-x: auto; background-color: white;">
		<?php

		for ($i=0; $i < $amount_of_filters; $i++) {

		?>
	<div class="filter" style="display: inline;">
		<input onchange="uncheckOthers(<?= $i ?>, <?= $amount_of_filters ?>)" id="filter<?= $i ?>" type="checkbox" value="<?= $i . '.png' ?>">
		<img src="<?= '/data/filters/' . $i . '.png' ?>" height="100px">
	</div>
		<?php

		}

		?>
</form>

<script type="text/javascript" src="../../view/filters/filters.js"></script>
		<?php

	}

?>

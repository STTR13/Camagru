<?php

	// $c = array('id' => ..., 'content' => ..., 'pseudo' => ..., 'date' => ...)
	function html_comment($c) {

?>
<div class="row head-info" id="comment<?=$c['id']?>" style="padding-bottom: 0px;">
	<div class="col-sm-3" style="text-align: left;">
		<user><?=$c['pseudo']?></user>
		<date><?=$c['date']?></date>
	</div>
	<div class="col-sm-8" style="text-align: justify;">
		<?=$c['content']?>
	</div>
</div>
<?php

	}

	// require_once $_SERVER["DOCUMENT_ROOT"] . '/view/stylesheets/stylesheets.php';
	// html_stylesheets();
	// comment(array('id' => '12', 'content' => 'Hey bro!!!', 'pseudo' => 'fedy', 'date' => 'someday'));
	// comment(array('id' => '14', 'content' => 'Oui du coup je me demandais si jamais par le plus grand des hasard vous poouriez éventuellement m\'aider dans ma somptueuse, que dis-je, suprisime quête pour le saint graal?', 'pseudo' => 'Papelote', 'date' => 'once again'));
	// comment(array('id' => '13', 'content' => 'LEEEEROOOOYYY JENNKIIINSS!!!!', 'pseudo' => 'Leroy', 'date' => 'an other day'));

?>

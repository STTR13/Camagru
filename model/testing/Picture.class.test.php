<?php
	require_once 'initialise.tests.php';
	require_once '../classes/Picture.class.php';

	// construct based on id_picture
	$p1 = new Picture(2, $db);
	//echo $p1->_id . "\n";
	//echo $p1->_user_id . "\n";
	//echo $p1->_user_pseudo . "\n";
	//echo $p1->_path . "\n";
	//echo $p1->_public . "\n";
	//echo $p1->_date . "\n";
	//echo "---\n";

	// construct on loging in
	$u = new User(2, $db);
	$p2 = new Picture("p1.jpg", $u, $db);
	//echo $p2->_id . "\n";
	//echo $p2->_user_id . "\n";
	//echo $p2->_user_pseudo . "\n";
	//echo $p2->_path . "\n";
	//echo $p2->_public . "\n";
	//echo $p2->_date . "\n";


	// set
	if ($p1->is_public()) {
		echo "set_public FAILED. 0\n";
	}
	$p1->set_public();
	if (!$p1->is_public()) {
		echo "set_public FAILED. 1\n";
	}
	$db->query("SELECT public FROM picture WHERE id_picture = :idp;", array(':idp' => $p1->get_id()));
	$row = $db->fetch();
	if ($row['public'] != "1") {
		echo "set_pseudo FAILED: ";
		var_dump($row['public']);
		echo "\n";
	}
?>

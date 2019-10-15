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

	
?>

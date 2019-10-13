<?php
	require_once 'initialise.tests.php';
	require_once '../classes/User.class.php';
	require_once '../functions/hash_password.php';


	/*
	** --- valid construct ---
	*/

	// construct based on id_cookie
	$u1 = new User(2, $db);

	// construct on loging in
	$u2 = new User("john@mail.com", hash_password("johnpw"), $db);

	// construct on account creation
	$u3 = new User("Jonney", "charlie.bit@my.finger.us", hash_password("LEEEROY_JENKINS!"), $db);
?>

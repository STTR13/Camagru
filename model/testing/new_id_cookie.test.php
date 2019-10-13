<?php
	require_once 'initialise.tests.php';
	require_once '../functions/new_id_cookie.php';

	new_id_cookie($db, "my_test_id_cookie", "localhost:8080");
	echo $_COOKIE["my_test_id_cookie"];
?>

<?php
	@ob_start();
	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
	require_once '../../model/testing/initialise.tests.php';
	session_start();

	$_SESSION['db'] = serialize($db);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body onscroll="scroll()">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
		<link href="../../view/galery/post.css" rel="stylesheet">

		<div class="mynavbar">
			<a class="fleft" href="#home">Galery</a>
			<a class="fright" href="#contact">Settings</a>
			<a class="fright" href="#news">Pictures</a>
			<h1 class="logo">Inst<img class="logo-img" src="/data/images/logo.png"></h1>
		</div>

		<?php
			require_once 'galery.php';
			galery($db);
		?>

		<style>
			/* The navigation bar */
			.mynavbar {
				overflow: hidden;
				background: rgb(0,15,61);
				background: linear-gradient(146deg, rgba(0,15,61,1) 0%, rgba(5,70,79,1) 39%, rgba(9,96,96,1) 76%, rgba(0,143,90,1) 100%);
				position: fixed;
				left: 0px;
				top: 0;
				width: 100%;
				z-index: 100;
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			}

			/* Links inside the navbar */
			.mynavbar a {
				display: block;
				color: #f2f2f2;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				cursor: pointer;
			}
			.mynavbar a:hover {
				background: rgb(0,0,0);
			}
			.mynavbar .fleft {
				float: left;
			}
			.mynavbar .fright {
				float: right;
			}
			.mynavbar .logo {
				display: block;
				text-align: center;
				color: black;
			}
			.mynavbar .logo .logo-img {
				display: inline;
				width: 33px;
			}

			/* Change background on mouse-over */
			.navbar a:hover {
				background: #ddd;
				color: black;
			}

			/* Main content */
			@media screen and (max-width: 222px) {
				.main {
					margin-top: 107px;
				}
			}
			@media screen and (min-width: 222px) {
				.main {
					margin-top: 70px;
				}
			}
		</style>
	</body>
</html>

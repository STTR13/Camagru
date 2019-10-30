<?php
	@ob_start();
	require_once "../../view/galery/post.php";
	require_once "../../model/classes/Picture.class.php";
	require_once '../../model/testing/initialise.tests.php';
	session_start();
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
						//var_dump($_SESSION['picture']);
					?>
				</div>
				<div class="col-sm-4">
					<div id="login" class="post" style="display: block;">
						<form action="/action_page.php" class="head-info">
							<h3 style="text-align: center; color: black;">Log-in</h3>
							Email:<br>
							<input type="text" name="email" value="" style="border: none; width: 100%;">
							<br>
							Password:<br>
							<input type="password" name="password" value="" style="border: none; width: 100%;">
							<br><br>
							<div style="text-align: center;">
								<input type="submit" value="Submit" style="cursor: pointer; font-size: 1.2em; border: none; background: red; color: white; border-radius: 10%; background: rgb(0,15,61); background: linear-gradient(146deg, rgba(0,15,61,1) 0%, rgba(5,70,79,1) 39%, rgba(9,96,96,1) 76%, rgba(0,143,90,1) 100%);">
								<br>
								<a onclick="to_account_creation()" style="font-size: 0.7em; color: black; cursor: pointer;">I dont have any account</a>
							</div>
						</form>
					</div>
					<div id="account-creation" class="post" style="display: none;">
						<form action="/action_page.php" class="head-info">
							<h3 style="text-align: center; color: black;">Create an account</h3>
							Pseudo:<br>
							<input type="text" name="pseudo" value="" style="border: none; width: 100%;">
							Email:<br>
							<input type="text" name="email" value="" style="border: none; width: 100%;">
							<br>
							Password:<br>
							<input type="password" name="password" value="" style="border: none; width: 100%;">
							<br>
							Confirm password:<br>
							<input type="password" name="confirm_password" value="" style="border: none; width: 100%;">
							<br><br>
							<div style="text-align: center;">
								<input type="submit" value="Submit" style="cursor: pointer; font-size: 1.2em; border: none; background: red; color: white; border-radius: 10%; background: rgb(0,15,61); background: linear-gradient(146deg, rgba(0,15,61,1) 0%, rgba(5,70,79,1) 39%, rgba(9,96,96,1) 76%, rgba(0,143,90,1) 100%);">
								<br>
								<a onclick="to_login()" style="font-size: 0.7em; color: black; cursor: pointer;">I alredy have an account</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			function to_account_creation() {
				document.getElementById("login").style.display = "none";
				document.getElementById("account-creation").style.display = "block";

			}
			function to_login() {
				document.getElementById("account-creation").style.display = "none";
				document.getElementById("login").style.display = "block";
			}

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

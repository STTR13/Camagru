
<?php
	function html_camera() {

?>
<div class="col-sm" id="camera">
	<div class="post">
		<div class="head-info">
			<h3 style="text-align: center; color: black;">Picture</h3>
		</div>
		<!--
		Ideally these elements aren't created until it's confirmed that the
		client supports video/camera, but for the sake of illustrating the
		elements involved, they are created with markup (not JavaScript)
		-->
		<video id="video" style="width: 100%; height: auto;" width="640" height="480" autoplay></video>
		<div class="head-info">
			<button id="snap" style="cursor: pointer; font-size: 1.2em; border: none; background: red; color: white; border-radius: 10%; background: rgb(0,15,61); background: linear-gradient(146deg, rgba(0,15,61,1) 0%, rgba(5,70,79,1) 39%, rgba(9,96,96,1) 76%, rgba(0,143,90,1) 100%);">Snap Photo</button>
		</div>
		<canvas id="canvas" style="width: 100%; height: auto;" width="640" height="480"></canvas>
		<div class="foot-info">
		</div>
	</div>

	<script type="text/javascript" src="../../view/camera/camera.js"></script>
</div>
<?php

	}
	// https://davidwalsh.name/browser-camera
	// https://www.askingbox.com/tutorial/jquery-send-html5-canvas-to-server-via-ajax
?>

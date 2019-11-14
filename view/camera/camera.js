// Grab elements, create settings, etc.
var video = document.getElementById('video');

// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	navigator.mediaDevices.getUserMedia({ video: true })
	.then(function(stream) {
		//video.src = window.URL.createObjectURL(stream);
		video.srcObject = stream;
		video.play();
	})
	.catch(function(err) {
	  video.style.display = 'none';
	});
}

// Elements for taking the snapshot
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
	context.drawImage(video, 0, 0, 640, 480);

	var filter = getFilter();
	if (filter == "") {
		return;
	}

	if (document.getElementById('file').files['length'] == 0) {
		uploadCanvas(filter)
	} else {
		uploadFile(filter);
	}
});

// Send img to server
function uploadFile(filter) {
	var file = document.getElementById('file').files[0];
	const formData = new FormData();

	formData.append('file', file, file.name);
	formData.append('filter', filter);

	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "../../control/imageprocessing/uploadReceiver.php", true);
	xhttp.onload  = function() {
		if (this.status === 200) {
			document.getElementById("output-img").src = this.responseText;
		}
	};
	xhttp.send(formData);

	document.getElementById("result-post").style.display = "block";
}

function uploadCanvas(filter) {

	var dataURL = canvas.toDataURL();
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("output-img").src = this.responseText;
		}
	};
	xhttp.open("POST", "../../control/imageprocessing/uploadReceiver.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("img=" + dataURL + "&filter=" + filter);

	document.getElementById("result-post").style.display = "block";
}

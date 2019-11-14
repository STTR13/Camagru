function setpublic(clicked_id) {
	var dataURL = canvas.toDataURL();
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
		}
	};
	xhttp.open("POST", "../../control/personalcontent/setpublic.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("picture_id=" + clicked_id);
}

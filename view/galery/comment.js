function comment(clicked_id) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//document.getElementById('like-amount' + clicked_id).innerHTML = this.responseText + " likes";
			console.log(this.responseText);
		}
	};

	xhttp.open("POST", "../../control/comment/comment.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("picture_id=" + clicked_id);
}

function like(clicked_id) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('like-amount' + clicked_id).innerHTML = this.responseText + " likes";
		}
	};

	xhttp.open("POST", "../../control/like/like.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("picture_id=" + clicked_id);
}

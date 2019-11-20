function openComments(clicked_id) {
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function() {
		//console.log(this.readyState + " : " + this.status);
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("comments-menu-content").innerHTML = this.responseText;
			document.getElementById("myCom").style.height = "100%";
		}
	};
	xhttp.open("POST", "../../control/comments/getcommentsmenucontent.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("picture_id=" + clicked_id);
}

function closeComments() {
	document.getElementById("myCom").style.height = "0%";
}

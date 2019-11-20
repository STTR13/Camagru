function addComment(clicked_id) {
	var xhttp = new XMLHttpRequest();
	var content = document.getElementById('content-new-comment').value;
	//console.log(content);

	xhttp.onreadystatechange = function() {
		//console.log(this.readyState + " : " + this.status);
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('comments-space').innerHTML = this.responseText;
			document.getElementById('content-new-comment').value = "";
		}
	};
	xhttp.open("POST", "../../control/comments/addcomment.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("picture_id=" + clicked_id + "&content=" + content);
}

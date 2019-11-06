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
	xhttp.open("GET", "/control/infinitescroll/loadMoreData.php", true);
	xhttp.send();
}

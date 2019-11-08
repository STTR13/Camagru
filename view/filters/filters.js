function uncheckOthers(clicked_id, filters_amount) {
	for (var i = 0; i < filters_amount; i++) {
		if (clicked_id == i) {
			continue;
		}
		document.getElementById('filter' + i).checked = false;
	}
}

function getFilter() {
	for (var i = 0; i < 6; i++) {
		if (document.getElementById('filter' + i).checked) {
			return i + '.png';
		}
	}
	return "";
}

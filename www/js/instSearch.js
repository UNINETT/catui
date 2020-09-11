
function instSearch() {
	let needles = document.getElementById('cat-inst-search').value.trim().split(/[\s,]+/);
	// If empty string, make needles that will never match
	if (document.getElementById('cat-institution-list').getAttribute('data-yield-empty') === 'false'
		&& needles.length == 1 && needles[0] == "") needles = ['123456789123456789123456789'];
	let shown = 0, hidden = 0;
	const limit = +document.getElementById('cat-institution-list').getAttribute('data-current-limit');
	for(let elem of document.getElementById('cat-institution-list').getElementsByTagName('li'))
	{
		if (!elem.classList.contains('cat-institution')) continue;
		let match = needles.reduce(function(carry, item){
			const text = elem.getElementsByClassName('title')[0].textContent;
			return (carry && (text.toLowerCase().indexOf(item.toLowerCase()) > -1))
		}, true);
		if (match) {
			shown += 1;
		} else {
			hidden += 1;
		}
		if (match && (isNaN(limit) || limit < 1 || limit > shown)) {
			elem.classList.add('show');
		} else {
			elem.classList.remove('show');
		}

		if (limit > 0 && limit < shown) {
			document.getElementById('cat-institution-more').classList.add('show');
		} else {
			document.getElementById('cat-institution-more').classList.remove('show');
		}
	}
	if (shown == 1) {
		document.getElementById('cat-institution-list').classList.remove('filtered');
		document.getElementById('cat-institution-list').classList.add('match');
		//document.getElementById('cat-welcome').classList.remove('show');
	} else if (hidden == 0) {
		document.getElementById('cat-institution-list').classList.remove('filtered');
		document.getElementById('cat-institution-list').classList.remove('match');
	} else {
		document.getElementById('cat-institution-list').classList.add('filtered');
		document.getElementById('cat-institution-list').classList.remove('match');
		//document.getElementById('cat-welcome').classList.remove('show');
	}

};

function resetSearch() {
	document.getElementById('cat-institution-list').setAttribute('data-current-limit',
		document.getElementById('cat-institution-list').getAttribute('data-limit'));
	instSearch();
}

function showMore() {
	document.getElementById('cat-institution-list').setAttribute('data-current-limit', 0);
	instSearch();
}

document.getElementById('cat-inst-search').onkeyup = resetSearch;
document.getElementById('cat-inst-search').onchange = resetSearch;
resetSearch();

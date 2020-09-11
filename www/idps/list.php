<?php
$title = 'eduroam providers';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<main class="container">
<div class="row">
<div class="cat-institution-search col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h1 class="h4">Koble til eduroam</h1>
	<form method="GET" action="./">
	<?php foreach($_GET as $key => $value) if ($key !== 'inst_search') {
		echo '<input type="hidden" name="' . o($key) . '" value="' . o($value) . '">';
	} ?>
	<p><input type="search" class="form-control form-control-lg" name="inst_search" id="cat-inst-search" value="<?= o($_GET['inst_search'] ?? '') ?>" placeholder="Finn din institusjon" autofocus style="border:1px solid #1B4176;box-shadow:none"></p>
	</form>

<?php if (!isset($_GET['geo'])) { ?>
<p id="cat-inst-geo" class="collapse small mb-4">
	<span class="glyphicon glyphicon-map-marker"></span>
	<a href="javascript:cat_geolocate()" class="<?= isset($_GET['geo']) ? 'disabled ' : '' ?>link-dark text-reset">
	Institusjoner i nærheten</a>
</p>
<?php } ?>
</div>

<div class="col-sm-12 col-md-12 col-lg-12">
	<ul id="cat-institution-list" class="list-unstyled <?= isset($_GET['inst_search']) ? ' filtered' : '' ?>">
		<?php
		foreach($idps as $idp) {
		?>
		<li class="collapse<?= !isset($_GET['inst_search']) || $idp->hasSearchMatch($_GET['inst_search']) ? ' show' : '' ?>"><a href="../profiles/?idp=<?= o($idp->getEntityID()) ?>" class="text-decoration-none btn btn-link btn-block <?= $idp->size ?>">
			<span class="title"><?= o($idp->getTitle()) ?></span>
			<?php if(isset($geo) && $idp->getGeo()) { ?>
			<small><small class="cat-distance"><?= round(min($idp->getDistanceFrom($lat, $lon))) ?>&nbsp;km</small></small>
			<?php } ?>
			</a></li>
		<?php } ?>
	</ul>
</div>

<p class="mt-5 mb-5">
	<a href="https://cat.eduroam.org/" class="link-dark text-reset">
	Se alle institusjoner hvor eduroam er tilgjengelig
	</a>
</p>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="cat-welcome">
<p>Linken laster ned en eduroam-profil på din enhet. Slik får du eduroam installert:</p>

<ul>
	<li class="mb-3">Velg din institusjon</li>
	<li class="mb-3">Last ned riktig eduroam-profil for din institusjon</li>
	<li class="mb-3">Fyll inn brukernavn og passord</li>
</ul>

<?php require __DIR__ . DIRECTORY_SEPARATOR . 'info.php'; ?>

</div>

</main>

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

<script type="application/javascript">
<?php if (!isset($_GET['geo'])) { ?>
if (navigator.geolocation) {
	document.getElementById('cat-inst-geo').classList.add('show');
};
for(let item of document.getElementById('cat-institution-list').getElementsByTagName('li')) {
	item.classList.add('collapse');
}
<?php } ?>

function inst_search() {
	var needles = document.getElementById('cat-inst-search').value.trim().split(/[\s,]+/);
	// If empty string, make needles that will never match
	if (needles.length == 1 && needles[0] == "") needles = ['123456789123456789123456789'];
	var shown = 0, hidden = 0;
	for(let elem of document.getElementById('cat-institution-list').getElementsByTagName('li'))
	{
		if (needles.reduce(function(carry, item){
			var text = elem.getElementsByClassName('title')[0].textContent;
			return (carry && (text.toLowerCase().indexOf(item.toLowerCase()) > -1))
		}, true)) {
			elem.classList.add('show');
			shown += 1;
		} else {
			elem.classList.remove('show');
			hidden += 1;
		}
	}
	if (shown == 1) {
		document.getElementById('cat-institution-list').classList.remove('filtered');
		document.getElementById('cat-institution-list').classList.add('match');
		document.getElementById('cat-welcome').classList.remove('show');
	} else if (hidden == 0) {
		document.getElementById('cat-institution-list').classList.remove('filtered');
		document.getElementById('cat-institution-list').classList.remove('match');
	} else {
		document.getElementById('cat-institution-list').classList.add('filtered');
		document.getElementById('cat-institution-list').classList.remove('match');
		document.getElementById('cat-welcome').classList.remove('show');
	}

};

function cat_geolocate() {
	navigator.geolocation.getCurrentPosition(function(position){
		geo = position.coords.latitude + ',' + position.coords.longitude;
		window.location = <?= json_encode($geoQueryString, JSON_HEX_TAG) ?> + geo;
	});
};


document.getElementById('cat-inst-search').onkeyup = inst_search;
document.getElementById('cat-inst-search').onchange = inst_search;
inst_search();
</script>

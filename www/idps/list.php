<?php
$title = 'eduroam providers';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>
<script async src="/js/instSearch.js"></script>

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

function cat_geolocate() {
	navigator.geolocation.getCurrentPosition(function(position){
		geo = position.coords.latitude + ',' + position.coords.longitude;
		window.location = <?= json_encode($geoQueryString, JSON_HEX_TAG) ?> + geo;
	});
};
</script>

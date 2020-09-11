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

	<ul class="cat-inst-action list-unstyled text-right">
		<li class="float-left text-left collapse" id="cat-inst-geo">
<?php if (isset($_GET['geo'])): ?>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
			</svg>
<?php else: ?>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
				<path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
			</svg>
<?php endif; ?>
			<a href="javascript:cat_geolocate('cat-geo-link')" id="cat-geo-link" class="text-reset link-dark" data-error-1="Disabled. Go to settings to enable" data-error-2="Geolocation currently unavailable">
			<span class="hidden-xs">Institusjoner</span>
			i nærheten</a>
			<span class="error" style="display:block;color:var(--bs-red);font-size:.8em"></span>
		</li>
		<li>
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-link-45deg" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
				<path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z"/>
			</svg>
			<a href="https://cat.eduroam.org/" class="link-dark text-reset">
			<span class="hidden-xs">Konto fra</span>
			ikke-norsk institusjon</a>
		</li>
	</ul>
</div>

<div class="col-sm-12 col-md-12 col-lg-12">
	<ul id="cat-institution-list" data-limit="8" data-yield-empty="<?= isset($_GET['geo']) ? 'true' : 'false' ?>" class="list-unstyled <?= isset($_GET['inst_search']) ? ' filtered' : '' ?>">
		<?php foreach($idps as $idp): ?>
		<li class="cat-institution collapse<?= !isset($_GET['inst_search']) || $idp->hasSearchMatch($_GET['inst_search']) ? ' show' : '' ?>"><a href="../profiles/?idp=<?= o($idp->getEntityID()) ?>" class="text-decoration-none btn btn-link btn-block <?= $idp->size ?>">
			<span class="title"><?= o($idp->getTitle()) ?></span>
			<?php if(isset($geo) && $idp->getGeo()): ?>
				<small><small class="cat-distance"><?= round(min($idp->getDistanceFrom($lat, $lon))) ?>&nbsp;km</small></small>
			<?php endif; ?>
			</a></li>
		<?php endforeach; ?>
		<li class="collapse" id="cat-institution-more">
			<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
				<path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
			</svg>
			<a href="javascript:showMore()" class="link-dark text-reset">Vis alle…</a>
		</li>
	</ul>
</div>

</main>

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

<script type="application/javascript">
if (navigator.geolocation) {
	document.getElementById('cat-inst-geo').classList.add('show');
};
for(let item of document.getElementById('cat-institution-list').getElementsByTagName('li')) {
	item.classList.add('collapse');
}

function cat_geolocate() {
	navigator.geolocation.getCurrentPosition(function(position){
		const geo = position.coords.latitude + ',' + position.coords.longitude;
		window.location = <?= json_encode($geoQueryString, JSON_HEX_TAG) ?> + geo;
	}, function(error){
		const node = document.getElementById('cat-geo-link');
		node.classList.remove('text-reset');
		node.classList.add('text-muted');
		const parentNode = node.parentNode;
		console.log(parentNode);
		const errorNodes = parentNode.getElementsByClassName('error');
		console.log(node.getAttribute('data-error-' + error.code));
		console.log('data-error-' + error.code);
		for(let errorNode of errorNodes) {
			errorNode.textContent = node.getAttribute('data-error-' + error.code);
		}
	}, {enableHighAccuracy: false});
};
</script>

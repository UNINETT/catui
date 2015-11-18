<?php
$title = 'eduroam providers';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']);
?>

<ol class="breadcrumb">
	<li class="active">eduroam</li>
</ol>

<main class="container">
<div class="row">
<div class="cat-institution-search col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h1>Search eduroam provider</h1>
	<form method="GET" action="./">
	<?php foreach($_GET as $key => $value) if ($key !== 'inst_search') {
		echo '<input type="hidden" name="' . o($key) . '" value="' . o($value) . '">';
	} ?>
	<p><input type="search" class="form-control input-lg" name="inst_search" id="cat-inst-search" value="<?= o($_GET['inst_search']) ?>" placeholder="Start typing to find your eduroam provider" autofocus></p>
	</form>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="cat-inst-action" style="text-align: right">
		<?php if (!isset($_GET['geo'])) { ?>
		<li class="pull-left" style="display:none">
			<span class="glyphicon glyphicon-map-marker"></span>
			<a href="javascript:cat_geolocate()"<?= isset($_GET['geo']) ? ' class="disabled"' : '' ?>>Show institutions close to my current location</a>
		</li>
		<?php } ?>
		<li>
			<span class="glyphicon glyphicon-globe"></span>
			<a href="https://cat.eduroam.org/">List all institutions worldwide</a>
		</li>
	</ul>
	<hr>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cat-institution-select">
	<?php if (isset($_GET['inst_search'])) { ?>
	<ul class="insts">
		<?php
		foreach($idps as $idp) {
		?>
		<li><a href="/profiles/?idp=<?= o($idp->getEntityID()) ?>" class="btn <?= $idp->size ?>">
			<span class="title"><?= o($idp->getTitle()) ?></span>
			<?php if($geo && $idp->getGeo()) { ?>
			<small><small><?= round(min($idp->getDistanceFrom($lat, $lon))) ?>&nbsp;km</small></small>
			<?php } ?>
			</a></li>
		<?php } ?>
	</ul>
	<?php } ?>
</div>
</div>

</main>

<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']); ?>

<script type="application/javascript">
<?php if (!isset($_GET['geo'])) { ?>
if (navigator.geolocation) {
	$('.cat-inst-action li').show();
};
<?php } ?>

function inst_search() {
	var needle = $('#cat-inst-search').val();
	$('ul.insts li').each(function(index){
		if (needle.length == 0 || $(this, '.title').text().toLowerCase().indexOf(needle.toLowerCase()) > -1) {
			$(this).show();
		} else {
			$(this).hide();
		}
	})
};

function cat_geolocate() {
	function replaceQueryParam(param, newval, search) {
		var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
		var query = search.replace(regex, "$1").replace(/&$/, '');

		return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
	}
	function redirect_position(position) {
		geo = position.coords.latitude + ',' + position.coords.longitude;
		window.location = <?= json_encode($geoQueryString) ?> + geo;
	}
	navigator.geolocation.getCurrentPosition(redirect_position);
};

$('#cat-inst-search').keyup(inst_search);
$('#cat-inst-search').change(inst_search);
</script>

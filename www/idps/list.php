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
	<h1 class="h2"><span class="hidden-xs">Search</span> eduroam provider</h1>
	<form method="GET" action="./">
	<?php foreach($_GET as $key => $value) if ($key !== 'inst_search') {
		echo '<input type="hidden" name="' . o($key) . '" value="' . o($value) . '">';
	} ?>
	<p><input type="search" class="form-control input-lg" name="inst_search" id="cat-inst-search" value="<?= o($_GET['inst_search'] ?? '') ?>" placeholder="institution name" autofocus></p>
	</form>
</div>
</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<ul class="cat-inst-action" style="text-align: right">
		<?php if (!isset($_GET['geo'])) { ?>
		<li class="pull-left" style="display:none">
			<span class="glyphicon glyphicon-map-marker"></span>
			<a href="javascript:cat_geolocate()"<?= isset($_GET['geo']) ? ' class="disabled"' : '' ?>>
			<span class="hidden-xs">Find institutions</span>
			nearby</a>
		</li>
		<?php } ?>
		<li>
			<span class="glyphicon glyphicon-globe"></span>
			<a href="https://cat.eduroam.org/">
			<span class="hidden-xs">Show all institutions</span>
			worldwide</a>
		</li>
	</ul>
</div>
</div>
<div class="row">
<?php if (!isset($_GET['inst_search']) || !$_GET['inst_search']) { ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-info text-center" id="cat-welcome">
Welcome to the eduroam configurator.
<strong>Easy eduroam configuration for your mobile or PC</strong>.
Enter the name of your institution in the box to get started.
</div>
<?php } ?>
</div>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-12 cat-institution-select">
	<ul class="insts<?= isset($_GET['inst_search']) ? ' filtered' : '' ?>">
		<?php
		foreach($idps as $idp) {
		?>
		<li<?= !isset($_GET['inst_search']) || $idp->hasSearchMatch($_GET['inst_search']) ? '' : ' style="display:none"' ?>><a href="../profiles/?idp=<?= o($idp->getEntityID()) ?>" class="btn <?= $idp->size ?>">
			<span class="title"><?= o($idp->getTitle()) ?></span>
			<?php if(isset($geo) && $idp->getGeo()) { ?>
			<small><small class="cat-distance"><?= round(min($idp->getDistanceFrom($lat, $lon))) ?>&nbsp;km</small></small>
			<?php } ?>
			</a></li>
		<?php } ?>
	</ul>
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
	var needles = $('#cat-inst-search').val().trim().split(/[\s,]+/);
	var shown = 0, hidden = 0;
	$('ul.insts li').each(function(index){
		var elem = this;
		if (needles.reduce(function(carry, item){
			return (carry && (item.length == 0 || $(elem, '.title').text().toLowerCase().indexOf(item.toLowerCase()) > -1))
		}, true)) {
			$(this).show();
			shown += 1;
		} else {
			$(this).hide();
			hidden += 1;
		}
	});
	if (shown == 1) {
		$('ul.insts').removeClass('filtered');
		$('ul.insts').addClass('match');
		$('#cat-welcome').hide();
	} else if (hidden == 0) {
		$('ul.insts').removeClass('filtered');
		$('ul.insts').removeClass('match');
	} else {
		$('ul.insts').addClass('filtered');
		$('ul.insts').removeClass('match');
		$('#cat-welcome').hide();
	}

};

function cat_geolocate() {
	navigator.geolocation.getCurrentPosition(function(position){
		geo = position.coords.latitude + ',' + position.coords.longitude;
		window.location = <?= json_encode($geoQueryString, JSON_HEX_TAG) ?> + geo;
	});
};

$('#cat-inst-search').keyup(inst_search);
$('#cat-inst-search').change(inst_search);
inst_search();
</script>

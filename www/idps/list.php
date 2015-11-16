<?php
$title = 'Eduroam connect utility';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']);
?>

<ol class="breadcrumb">
	<li class="active">Eduroam</li>
</ol>

<main class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="cat-institution-search">
	<h1>Select your institution to get started:</h1>
	<form method="GET" action="./">
	<?php foreach($_GET as $key => $value) if ($key !== 'inst_search') {
		echo '<input type="hidden" name="' . o($key) . '" value="' . o($value) . '">';
	} ?>
	<p><input type="text" name="inst_search" id="inst_search" value="<?= o($_GET['inst_search']) ?>" placeholder="Institute of …" autofocus></p>
	</form>
</div>
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
	<hr>
	<p><a href="https://cat.eduroam.org/">List all institutions worldwide</a></p>
</div>
</div>

</main>

<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']); ?>

<script type="application/javascript">
var inst_search = function() {
	var needle = $('#inst_search').val();
	$('ul.insts li').each(function(index){
		if (needle.length == 0 || $(this, '.title').text().toLowerCase().indexOf(needle.toLowerCase()) > -1) {
			$(this).show();
		} else {
			$(this).hide();
		}
	})
}
$('#inst_search').keyup(inst_search);
$('#inst_search').change(inst_search);
</script>

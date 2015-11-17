<?php
$title = 'Eduroam ' . $idp->getDisplay();
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']);
?>

<ol class="breadcrumb">
	<li><a href="../idps/?c=<?= o($idp->getCountry()) ?>">Eduroam</a></li>
	<li class="active"><?= o($idp->getDisplay()) ?></li>
</ol>

<!-- <pre><?= o(json_encode($idp->getRaw(), JSON_PRETTY_PRINT)); ?></pre> -->

<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-push-8 col-sm-4 col-md-push-9 col-md-3 col-lg-push-9 col-lg-3">
<?php include 'support.php'; ?>
</div>

<main class="col-xs-12 col-sm-pull-4 col-sm-8 col-md-pull-3 col-md-9 col-lg-pull-3 col-lg-9">
<h2>Profiles at <?= o($idp->getDisplay()) ?></h2>
<p>Select the user group</p>
<ul class="cat-profiles">
<?php foreach($profiles as $profile) { ?>
<!-- <li><pre><?= o(json_encode($profile->getRawAttributes(), JSON_PRETTY_PRINT)); ?></pre> -->
<li>
<a href="<?= o('/download/?' . build_download_query($profile)) ?>" class="btn btn-primary">
<?= $profile->getDisplay() ?>
</a>
</li>
<?php } ?>
</ul>
</main>
</div>
</div>

<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']); ?>

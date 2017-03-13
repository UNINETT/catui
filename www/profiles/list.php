<?php
$title = 'eduroam ' . $idp->getDisplay();
require (getenv('EC_HEADER') ? dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . getenv('EC_HEADER') : dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']));
?>

<div class="container"><div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<ol class="breadcrumb">
	<li><a href="../idps/?c=<?= o($idp->getCountry()) ?>">eduroam</a></li>
	<li class="active"><?= o($idp->getDisplay()) ?></li>
</ol></div></div></div>

<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-push-8 col-sm-4 col-md-push-9 col-md-3 col-lg-push-9 col-lg-3 support">
<?php include 'support.php'; ?>
</div>

<main class="col-xs-12 col-sm-pull-4 col-sm-8 col-md-pull-3 col-md-9 col-lg-pull-3 col-lg-9">
<h2>Profiles at <?= o($idp->getDisplay()) ?></h2>
<p>Select the user group</p>
<ul class="cat-profiles">
<?php foreach($profiles as $profile) { ?>
<li>
<a href="<?= o(dirname($_SERVER['REQUEST_URI'], 2) . '/download/?' . build_download_query($profile)) ?>" class="btn btn-primary">
<?= $profile->getDisplay() ?>
</a>
</li>
<?php } ?>
</ul>
</main>
</div>
</div>

<?php require (getenv('EC_FOOTER') ? dirname(__DIR__, 4) . DIRECTORY_SEPARATOR . getenv('EC_FOOTER') : dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']));

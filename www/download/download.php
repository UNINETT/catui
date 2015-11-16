<?php
$bootstrapStyle = $device->isRedirect() ? 'btn btn-warning' : 'btn btn-success';
$catStyle = $device->isRedirect() ? 'cat-btn-redirect' : 'cat-btn-download';

$title = 'Eduroam connect utility';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']);
?>

<ol class="breadcrumb">
	<li><a href="../idps/?c=<?= o($idp->getCountry()) ?>">Eduroam</a></li>
<?php if ($canListProfiles) { ?>
	<li><a href="../profiles/?idp=<?= o($idp->getEntityID()) ?>"><?= o($idp->getDisplay()) ?></a></li>
<?php } else { ?>
	<li><?= o($idp->getDisplay()) ?></li>
<?php } ?>
	<li><a href="<?= o(makeQueryString(['os' => ''])) ?>"><?= o($profile->getDisplay()) ?></a></li>
	<li class="active"><?= o($device->getDisplay()) ?></li>
</ol>

<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-push-8 col-sm-4 col-md-push-9 col-md-3 col-lg-push-9 col-lg-3">
<?php include 'support.php'; ?>
</div>

<main class="col-xs-12 col-sm-pull-4 col-sm-8 col-md-pull-3 col-md-9 col-lg-pull-3 col-lg-9">
<h2><?= o($profile->getDisplay()) ?>
<?php if ($profile->getDisplay() != $idp->getDisplay()) { ?>

<small><?= o($idp->getDisplay()) ?></small>
<?php } ?>
</h2>
<?php if ($device->getEapCustomText()) { ?>
<p class="alert bg-info cat-eap-custom-text"><?= o($device->getEapCustomText()); ?></p>
<?php } ?>
<?php if ($device->getMessage()) { ?>
<p class="alert bg-warning cat-message"><?= $device->getMessage(); ?></p>
<?php } ?>

<p class="cat-download">Download your eduroam profile<br>
<a class="<?= o($bootstrapStyle) ?> <?= o($catStyle) ?>" href="<?= o($device->getDownloadLink()) ?>"><big><big>
<strong><?= o($profile->getDisplay()) ?></strong><br>
<small><small class="cat-device-id"><?= o($device->getDisplay()) ?></small></small>
</big></big></a>
</p>
<?php if ($device->isRedirect()) { ?>
<p class="alert bg-warning cat-redirect-text">
You will be redirected to <a href="<?= o($device->getRedirect()) ?>"><?= o($device->getRedirect()) ?></a>
</p>
<?php } ?>

<?php if ($device->getDeviceCustomtext()) { ?>
<p><?= o($device->getDeviceCustomtext()); ?></p>
<?php } ?>

<p><small>
<a href="<?= o(makeQueryString(['os' => ''])) ?>">Other operating system</a>
</small>
</p>
</main>
</div>
</div>

<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']); ?>

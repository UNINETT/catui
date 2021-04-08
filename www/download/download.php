<?php
if (in_array($device->getDeviceID(), ['w10', 'android_8_10', 'android_recent'], true)) {
	if (!$device->isRedirect() || substr($device->getRedirect(), -9) !== '#letswifi') {
		require 'download-app.php';
		return;
	}
}

$bootstrapStyle = $device->isRedirect() ? 'btn btn-warning' : 'btn btn-success';
$catStyle = $device->isRedirect() ? 'cat-btn-redirect' : 'cat-btn-download';

$title = 'eduroam ' . $idp->getDisplay();
if ($canListProfiles || $profile->getDisplay() != $idp->getDisplay()) {
	$title .= ' ' . $profile->getDisplay();
}
$title .= ' for ' . $device->getDisplay();
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row">

<main class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
<?php if (in_array($profile->getDisplay(), ['eduroam', '0'])): ?>
	<h2 class="h4"><?= o($idp->getDisplay()) ?></h2>
<?php else: ?>
	<h2 class="h4"><?= o($profile->getDisplay()) ?>
	<?php if ($profile->getDisplay() != $idp->getDisplay()) { ?>

	– <?= o($idp->getDisplay()) ?>
	<?php } ?>
	</h2>
<?php endif; ?>

<?php if ($canListProfiles) { ?>
<p><a class="link-dark small text-reset" href="../profiles/?idp=<?= o($idp->getEntityID()) ?>">Velg en annen profil</a></p>
<?php } ?>

<?php if ($device->getEapCustomText()) { ?>
<p class="alert alert-info cat-eap-custom-text"><?= o($device->getEapCustomText()); ?></p>
<?php } ?>
<?php if ($device->getMessage()) { ?>
<p class="alert alert-warning cat-message"><?= $device->getMessage(); ?></p>
<?php } ?>

<?php
if ($device->isRedirect()) {
	$downloadInclude = 'download-redirect.php';
} else {
	$downloadInclude = 'download-' . strtolower($device->getGroup()) . '.php';
}
if (!file_exists($downloadInclude)) {
	$downloadInclude = 'download-' . strtolower($device->getDeviceID()) . '.php';
}
if (!file_exists($downloadInclude)) {
	$downloadInclude = 'download-any.php';
}
require $downloadInclude;
?>

<?php if ($device->getDeviceCustomtext()) { ?>
<p><?= $device->getDeviceCustomtext(); ?></p>
<?php } ?>

<?php if (!$profile->isRedirect()) { ?>
<p><a class="link-dark small text-reset" href="<?= o(makeQueryString(['os' => ''])) ?>">Velg et annet operativsystem</a></p>
<?php } ?>

<?php if (!$profile->isRedirect() && !$device->isRedirect() && $device->getDeviceInfo()) { ?>
<hr>
<h3 class="h5">Instrukser for <?= o($device->getDisplay()) ?></h3>
<?php if ($device->getDeviceInfo()) { ?>
<?= $device->getDeviceInfo(); ?>
<?php } ?>
<?php } ?>
</main>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="support">
<?php include 'support.php'; ?>
</div>

</div>
</div>

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

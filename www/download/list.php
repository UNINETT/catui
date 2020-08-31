<?php
$title = 'eduroam ' . $idp->getDisplay();
if ($canListProfiles || $profile->getDisplay() != $idp->getDisplay()) {
	$title .= ' ' . $profile->getDisplay();
}
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row">

<main class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
<h1 class="h4"><?= o($profile->getDisplay()) ?>
<?php if ($profile->getDisplay() != $idp->getDisplay()) { ?>

– <?= o($idp->getDisplay()) ?>
<?php } ?>
</h1>
<p>Velg operativsystem for nedlasting</p>

<?php foreach(\eduroam\CAT\Device::groupDevices($profile->getDevices()) as $group => $devices) { ?>
<h2 class="h5"><?= o($group) ?></h2>
<ul>
<?php foreach($devices as $device) { ?>
<li>
<a href="<?= o(makeQueryString(['os' => $device->getDeviceID()])) ?>">
<?= o($device->getDisplay()); ?>
</a>
<?php if ($device->getDeviceCustomText()) { ?>
<small><?= $device->getDeviceCustomText() ?></small>
<?php } ?>
</li>
<?php } ?>
</ul>
<?php } ?>
</main>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 support">
<?php include 'support.php'; ?>
</div>
</div>
</div>

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

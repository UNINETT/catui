<?php
$title = 'eduroam ' . $idp->getDisplay();
if ($canListProfiles || $profile->getDisplay() != $idp->getDisplay()) {
	$title .= ' ' . $profile->getDisplay();
}
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'header.php']);
?>

<ol class="breadcrumb">
	<li><a href="../idps/?c=<?= o($idp->getCountry()) ?>">eduroam</a></li>
<?php if ($canListProfiles) { ?>
	<li><a href="../profiles/?idp=<?= o($idp->getEntityID()) ?>"><?= o($idp->getDisplay()) ?></a></li>
<?php } elseif ($idp->getDisplay() != $profile->getDisplay()) { ?>
	<li><?= o($idp->getDisplay()) ?></li>
<?php } ?>
	<li class="active"><?= o($profile->getDisplay()) ?></li>
</ol>

<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-push-9 col-md-3 col-lg-push-9 col-lg-3 support">
<?php include 'support.php'; ?>
</div>

<main class="col-xs-12 col-sm-12 col-md-pull-3 col-md-9 col-lg-pull-3 col-lg-9">
<h1><?= o($profile->getDisplay()) ?>
<?php if ($profile->getDisplay() != $idp->getDisplay()) { ?>

<small><?= o($idp->getDisplay()) ?></small>
<?php } ?>
</h1>
<h2 class="h5">Choose an installer to download</h2>

<?php foreach(\Eduroam\Connect\Device::groupDevices($profile->getDevices()) as $group => $devices) { ?>
<h3><?= o($group) ?></h3>
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
</div>
</div>

<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'style', 'footer.php']); ?>

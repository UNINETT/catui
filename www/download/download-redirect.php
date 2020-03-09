<p class="cat-download">Download your eduroam profile<br>
<a class="btn btn-warning cat-btn-redirect" href="<?= o($device->getDownloadLink()) ?>"><big><big>
<strong><?= o($profile->getDisplay()) ?></strong><br>
<small><small><small class="cat-device-id"><?= o($device->getDisplay()) ?></small></small></small>
</big></big></a>
</p>
<p class="alert bg-warning cat-redirect-text">
Your profile is available on <a href="<?= o($device->getRedirect()) ?>"><?= o($device->getRedirect()) ?></a>
</p>
<?= $device->getMessage() ?>

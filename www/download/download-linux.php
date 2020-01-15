<p class="cat-download">Download your eduroam profile<br>
<a class="btn btn-success cat-btn-download" href="<?= o($device->getDownloadLink()) ?>"><big><big>
<strong><?= o($profile->getDisplay()) ?></strong><br>
<small><small><small class="cat-device-id"><?= o($device->getDisplay()) ?></small></small></small>
</big></big></a>
</p>
<p>Or use the following one-line to install from the command-line</p>
<pre>curl <?= o(escapeshellarg($device->getDownloadLink())) ?> | env python</pre>

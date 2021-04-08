<?php
if (!isset($legal)) $legal = '';
$legal .= '<br>Google Play og Google Play-logoen er varemerker tilhørende Google LLC.';
$link = $device->getDeviceID() === 'android_4_7'
	? 'https://play.google.com/store/apps/details?id=uk.ac.swansea.eduroamcat'
	: 'https://play.google.com/store/apps/details?id=app.eduroam.geteduroam'
	;
?><a href="<?= o($link) ?>">
<img alt='Tilgjengelig på Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/no_badge_web_generic.png' class="img-fluid" style="max-width:180px"></a>

<?php require dirname(dirname(__DIR__)) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

function makeQueryString($args) {
	$args = array_merge($_GET, $args);
	reset($args);
	foreach($args as $key => $value) {
		if (is_null($value)) {
			unset($args[$key]);
		}
	}
	return '?' . http_build_query($args);
}

$cat = new \Eduroam\CAT\CAT();
$idp = new \Eduroam\Connect\IdentityProvider($cat, $_GET['idp']);
$profile = new \Eduroam\Connect\Profile($cat, $_GET['idp'], $_GET['profile']);
$profiles = \Eduroam\Connect\Profile::getProfilesByIdPEntityID($cat, $_GET['idp']);

$canListProfiles = count($profiles) > 1;

$devices = $profile->getDevices();
$os = null;
if (isset($_GET['os'])) {
	$os = $_GET['os'];
} else {
	if (isset($_SERVER['HTTP_SEC_CH_PLATFORM'])) {
		$os = \Eduroam\Connect\Device::guessDeviceID($_SERVER['HTTP_SEC_CH_PLATFORM'], array_keys($devices));
	} else {
		header('Accept-CH: Platform');
		$os = \Eduroam\Connect\Device::guessDeviceID($_SERVER['HTTP_USER_AGENT'], array_keys($devices));
	}
}

if (null !== $os && array_key_exists($os, $devices)) {
	$device = $profile->getDevices()[$os];
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'download.php';
} else {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'list.php';
}
include $file;

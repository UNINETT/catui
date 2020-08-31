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

$cat = new \eduroam\CAT\CAT('nb');
$idp = new \eduroam\CAT\IdentityProvider($cat, $_GET['idp']);
$profile = new \eduroam\CAT\Profile($cat, $_GET['idp'], $_GET['profile']);
$profiles = \eduroam\CAT\Profile::getProfilesByIdPEntityID($cat, $_GET['idp']);

$canListProfiles = count($profiles) > 1;

$devices = $profile->getDevices();
$os = null;
if (isset($_GET['os'])) {
	$os = $_GET['os'];
} else {
	if (array_key_exists('HTTP_SEC_CH_PLATFORM', $_SERVER)) {
		$os = \eduroam\CAT\Device::guessDeviceID($_SERVER['HTTP_SEC_CH_PLATFORM'], array_keys($devices));
	} else {
		header('Accept-CH: Platform');
		if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
			$os = \eduroam\CAT\Device::guessDeviceID($_SERVER['HTTP_USER_AGENT'], array_keys($devices));
		}
	}
}

$device = null !== $os && array_key_exists($os, $devices)
	? $profile->getDevices()[$os]
	: null;
	;
if (null === $device && $profile->isRedirect()) {
	$device = $profile->getDevices()[0];
}

if (null === $device) {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'list.php';
} else {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'download.php';
}
include $file;

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
if (!isset($_GET['os'])) {
	$_GET['os'] = \Eduroam\Connect\Device::guessDeviceID($_SERVER['HTTP_USER_AGENT'], array_keys($devices));
}

if (isset($_GET['os']) && array_key_exists($_GET['os'], $devices)) {
	$os = $_GET['os'];
	$device = $profile->getDevices()[$_GET['os']];
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'download.php';
} else {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'list.php';
}
include $file;

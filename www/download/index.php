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

$oses = [
	'vista' => ['/Windows NT 6[._]0/'],
	'w7' => ['/Windows NT 6[._]1/'],
	'w8' => ['/Windows NT 6[._][23]/'],
	'w10' => ['/Windows NT 10[._]0+/'],
	'mobileconfig-56' => ['/\((iPad|iPhone|iPod);.*OS [56]_/'],
	'apple_lion' => ['/Mac OS X 10[._]7/'],
	'apple_m_lion' => ['/Mac OS X 10[._]8/'],
	'apple_mav' => ['/Mac OS X 10[._]9/'],
	'apple_yos' => ['/Mac OS X 10[._]10/'],
	'apple_el_cap' => ['/Mac OS X 10[._]11/', '/Mac OS X/'],
	'mobileconfig' => ['/\((iPad|iPhone|iPod);.*OS [7-9]_/'],
	'linux' => ['/Linux(?!.*Android)/'],
	'chromeos' => ['/CrOS/'],
	'android43' => ['/Android 4[._]3/'],
	'android_kitkat' => ['/Android 4[._][4-9]/'],
	'android_lollipop' => ['/Android 5[._][0-9]/'],
	'android_marshmallow' => ['/Android 6[._][0-9]/', '/Android/'],
	0 => ['//'],
];

$devices = $profile->getDevices();
if (!isset($_GET['os'])) {
	foreach($devices as $device) {
		if ($device->getStatus() != 0) continue;
		$os = $device->getDeviceID();
		if (isset($oses[$os])) {
			foreach($oses[$os] as $regexp) {
				if (preg_match($regexp, $_SERVER['HTTP_USER_AGENT'])) {
					$_GET['os'] = $os;
					break 2;
				}
			}
		}
	}
}

if (isset($_GET['os']) && array_key_exists($_GET['os'], $devices)) {
	$os = $_GET['os'];
	$device = $profile->getDevices()[$_GET['os']];
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'download.php';
} else {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'list.php';
}
include $file;

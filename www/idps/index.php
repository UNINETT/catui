<?php require dirname(dirname(__DIR__)) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

if (!isset($_GET['c'])) {
	$_GET['c'] = 'NO';
}

$lat = null;
$lon = null;
$geo = null;

if (isset($_GET['geo'])) {
	$latlon = explode(',', $_GET['geo']);
	if (sizeof($latlon) === 2) {
		$lat = (float) $latlon[0];
		$lon = (float) $latlon[1];
	}
	$geo = (object)['lat' => $lat, 'lon' => $lon];
} elseif (function_exists('geoip_record_by_name')) {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (substr($ip, 0, 7) === '::ffff:') {
		$ip = substr($ip, 7);
	}
	$geo = geoip_record_by_name($ip);

	if ($geo) {
		$lat = $geo['latitude'];
		$lon = $geo['longitude'];
	} else {
		unset($geo);
	}
}

$cat = new \Eduroam\CAT\CAT();

$idps = \Eduroam\Connect\IdentityProvider::getIdentityProvidersByCountry($cat, $_GET['c']);
if (isset($_GET['inst_search']) && $_GET['inst_search']) {
	$filterIdps = array_filter($idps, function($idp){
		return $idp->hasSearchMatch($_GET['inst_search']);
	});
	if (count($filterIdps) === 1) {
		header('Location: ' . dirname($_SERVER['REQUEST_URI'] . 'x', 2) . '/profiles/?idp=' . rawurlencode(reset($filterIdps)->getEntityID()));
		exit;
	}
}
$maxDistance = 0;
$minDistance = INF;
foreach($idps as $idp) {
	$idp->size = '';
}
if (!is_null($lat) && !is_null($lon)) {
	foreach($idps as $idp) {
		if ($idp->getGeo()) {
			$maxDistance = max($maxDistance, min($idp->getDistanceFrom($lat, $lon)));
			$minDistance = min($minDistance, min($idp->getDistanceFrom($lat, $lon)));
		}
	}
	$sizes = ['btn-xs', 'btn-sm', '', 'btn-lg'];
	foreach($idps as $idp) {
		if($maxDistance === $minDistance) {
			$idp->size = $sizes[3];
		} elseif($idp->getGeo()) {
			$idp->size = $sizes[round(3-3*((min($idp->getDistanceFrom($lat, $lon)) - $minDistance) / ($maxDistance - $minDistance)))];
		} else {
			$idp->size = $sizes[0];
		}
	}
}
if (isset($_GET['geo'])) {
	usort($idps, function($a, $b) use ($lat, $lon){return (min($a->getDistanceFrom($lat, $lon)) < min($b->getDistanceFrom($lat, $lon))) ? -1 : 1;});
} else {
	usort($idps, function($a, $b){return ($a->getTitle() < $b->getTitle()) ? -1 : 1;});
}

$getMinusGeo = $_GET;
unset($getMinusGeo['geo']); // remove so next will have it at the end
$getMinusGeo['geo'] = '';
$geoQueryString = '?' . http_build_query($getMinusGeo);

require 'list.php';

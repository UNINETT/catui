<?php require dirname(dirname(__DIR__)) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

if (!isset($_GET['c'])) {
	$_GET['c'] = 'NO';
}
if (!isset($_GET['inst_search'])) {
	$_GET['inst_search'] = '';
}

$lat = null;
$lon = null;

if (function_exists('geoip_record_by_name')) {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (substr($ip, 0, 7) === '::ffff:') {
		$ip = substr($ip, 7);
	}
	$geo = geoip_record_by_name($ip);

	if ($geo) {
		$lat = $geo['latitude'];
		$lon = $geo['longitude'];
	}
}

$cat = new \Eduroam\CAT\CAT();
function getIdps($cat, $c, $lat, $lon) {
	$idps = \Eduroam\Connect\IdentityProvider::getIdentityProvidersByCountry($cat, $c);
	if (isset($_GET['inst_search']) && $_GET['inst_search']) {
		$idps = array_filter($idps, function($idp){return strpos(strtolower($idp->getTitle()), strtolower($_GET['inst_search'])) !== false;});
	}
	usort($idps, function($a, $b) use ($lat, $lon){return ($a->getDistanceFrom($lat, $lon) < $b->getDistanceFrom($lat, $lon)) ? -1 : 1;});
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
	usort($idps, function($a, $b){return ($a->getTitle() < $b->getTitle()) ? -1 : 1;});
	return $idps;
}

$idps = getIdps($cat, $_GET['c'], $lat, $lon);

if (count($idps) === 1) {
	header('Location: /profiles/?idp=' . rawurlencode(reset($idps)->getEntityID()));
}

require 'list.php';

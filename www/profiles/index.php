<?php require dirname(dirname(__DIR__)) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$cat = new \eduroam\CAT\CAT('nb');
$profiles = \eduroam\CAT\Profile::getProfilesByIdPEntityID($cat, $_GET['idp']);

function build_download_query($profile) {
	return http_build_query([
			'idp' => $profile->getIdpID(),
			'profile' => $profile->getProfileID()]);
}
if (count($profiles) === 1) {
	header('Location: /download/?' . build_download_query(reset($profiles)), true, 302);
	exit;
}

$idp = new \eduroam\CAT\IdentityProvider($cat, $_GET['idp']);

require 'list.php';

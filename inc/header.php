<?php
function o($s) {
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
$legal = 'This web page is licensed under the terms of the GNU Affero General Public License.<br>
Configuration profiles are provided under the GÉANT CAT terms of service.';
function menuLink($href, $text) {
	$out = ($href === $_SERVER['REQUEST_URI'])
		? '<a class="nav-link active" aria-current="page">'
		: '<a href="' . htmlspecialchars($href, ENT_HTML5 | ENT_COMPAT) . '" class="nav-link">'
		;
	return $out . htmlspecialchars($text, ENT_HTML5 | ENT_NOQUOTES) . '</a>';
}
?><!doctype html>
<html lang="en">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/dist/css/uninett.css" type="text/css">

<title>Uninett eduroam</title>

<nav class="navbar navbar-light bg-light navbar-eduroam fixed-top">
	<div class="container-sm">
		<a class="navbar-brand" href="https://www.uninett.no/" aria-hidden="true" role="presentation">Uninett</a>
		<a class="navbar-brand navbar-brand-eduroam" href="/">eduroam</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<?= menuLink("/idps/", 'Last ned og koble til eduroam'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink("/docs/", 'Teknisk info'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink("/admin/", 'Administrer og konfigurer'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink("/join/", 'Tilby eduroam til din institusjon'); ?>
				</li>
			</ul>
		</div>
	</div>
</nav>

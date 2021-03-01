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
<html lang="nb">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/dist/css/uninett.css" type="text/css">
<style type="text/css">
/* todo implement in uninett theme */
html, nav {
	min-width:22rem;
}
.nav-item {
	white-space: nowrap;
	line-height: 1.0;
}
.nav-item .nav-link {
	border-top: .3rem solid rgba(0,0,0,0);
	border-bottom: .3rem solid rgba(0,0,0,0);
}
.nav-item .nav-link.active,
.nav-item .nav-link:hover {
	border-bottom: .3rem solid var(--bs-primary);
}
.navbar-collapse.show .nav-item .nav-link.active,
.navbar-collapse.show .nav-item .nav-link:hover {
	border-bottom: .3rem solid rgba(0,0,0,0);
}

.navbar-eduroam .navbar-nav {
	max-width: 45em;
}

nav.navbar-eduroam {
	box-shadow: none;
}

@media (max-width: 991.98px) {
	/* move list to the end so it appears under the rest of all items */
	#navbarSupportedContent {
		order: 3;
	}
}
</style>

<title>Uninett eduroam</title>

<nav class="navbar navbar-light navbar-expand-lg bg-light navbar-eduroam fixed-top">
	<div class="container-sm">
		<a class="navbar-brand" href="https://www.uninett.no/" aria-hidden="true" role="presentation">Uninett</a>
		<a class="navbar-brand navbar-brand-eduroam" href="/">eduroam</a>
		<div class="navbar-nav" style="order:1;margin-right:0;margin-left:auto">
			<a class="nav-link">EN</a>
		</div>
		<button style="margin-left:1em;order:2" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mb-lg-0" style="width:inherit;justify-content: space-around">
				<li class="nav-item">
					<?= menuLink('/idps/', 'Koble til eduroam'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink('/join/', 'Tilby eduroam'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink('/admin/', 'Administrator'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink('/info/', 'Om eduroam'); ?>
				</li>
				<li class="nav-item">
					<?= menuLink('/kontakt/', 'Kontakt'); ?>
				</li>
			</ul>
		</div>
	</div>
</nav>

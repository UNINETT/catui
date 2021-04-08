<?php
function o($s) {
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
$legal = 'This web page is licensed under the terms of the GNU Affero General Public License.<br>
Configuration profiles are provided under the GÉANT CAT terms of service.';
function menuLink($href, $text) {
	$out = ($href === (strstr($_SERVER['REQUEST_URI'], '?', true) ?: $_SERVER['REQUEST_URI']))
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
html, nav.navbar {
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

main#jumbotron {
	width: calc(17rem + 17vw);
	margin-left: 9vw;
	margin-top: 8vh;
	padding: 4vh 4vw;
	font-size: calc(.7em + .4vw);
	background-color: rgba(255,255,255,.8);
	-webkit-backdrop-filter: blur(5px);
	backdrop-filter: blur(5px);
}
main#jumbotron h1, main#jumbotron .h1 {
	font-size: calc(2.75rem + 1.5vw); /* modified from h1, .h1 */
	font-family: "Colfax", "colfaxBold", "colfaxRegular", var(--bs-font-sans-serif);
	line-height: .85;
	margin-bottom: .4em;
}
main#jumbotron h1 strong, main#jumbotron .h1 strong {
	font-weight: inherit;
	color: var(--bs-primary);
}
main#jumbotron .btn {
	padding: .8rem 1rem;
	text-align: left;
	min-width: calc(8rem + 4vw);
}
.btn-primary,
.btn-outline-primary {
	font-family: "Colfax", "colfaxBold", "colfaxRegular", var(--bs-font-sans-serif);
	text-transform: inherit;
	box-shadow: rgba(0,0,0,.3) 0 .2rem .2rem;
}
.btn-primary::after,
.btn-outline-primary::after {
	display: inline-block;
	content: '⌃';
	transform: rotate(90deg);
	float:right;
	left: 0;
}

details {
	border-bottom: .1em solid #ccc;
	padding: .5em;
	transition: .05s ease-in-out;
}
details p {
	margin-top: 1em;
	margin-bottom: 0;
}
details > summary {
	list-style: none;
	outline: none;
	display: block;
}
details > summary::focus-visible,
details::focus-visible > summary {
	outline: .3em solid var(--bs-primary);
}
details > summary::-webkit-details-marker {
	display: none;
}
details > summary::before {
	content: '⌃';
	transition: .2s ease-in-out;
	transform: rotate(180deg);
	float: right;
	font-weight: bold;
	color: var(--bs-primary);
}
details[open] {
	background-color: rgba(0,0,0,.05);
}
details[open] > summary::before {
	transform: rotate(.001deg) translate(0,.2em);
}
details[open]:nth-child(2n) > summary::before {
	transform: rotate(0deg) translate(0,.2em);
}

details + h1,
details + h2,
details + h3,
details + h4,
details + h5,
details + h6,
details + p {
	margin-top: 1.5em !important;
}

nav.sidebar {
	margin-top: 3rem;
}
nav.sidebar ul {
	list-style: none;
	text-align: right;
	padding: 0;
}
nav.sidebar li {
	margin-bottom: 2em;
	font-family: "Colfax", "colfaxBold", "colfaxRegular", var(--bs-font-sans-serif);
}
nav.sidebar li a {
	text-decoration: none;
	color: black;
}
nav.sidebar li.active {
	color: var(--bs-primary);
}
nav.sidebar li:before {
	content: '⌃';
	color: rgba(0,0,0,0);
	transform: rotate(90deg) translate(-.2em,0);
	float:right;
	font-weight: bold;
	font-size: 1.3em;
}
nav.sidebar li.active:before, nav.sidebar li a:hover {
	color: var(--bs-primary);
}

footer {
	color: black;
	font-size: .9em;
	font-family: "Colfax", "colfaxBold", "colfaxRegular", var(--bs-font-sans-serif);
	padding: .5em;
}
code {
	white-space: nowrap;
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
					<?= menuLink('/download/', 'Koble til eduroam'); ?>
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

<?php
function o($s) {
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
?><!DOCTYPE html>
<title><?= o($title); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<link rel="stylesheet" href="../style/eduroam.css" type="text/css">
<link rel="stylesheet" href="../style/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

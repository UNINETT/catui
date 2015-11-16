<?php
$geo['country_code'] = 'NO';
if (isset($geo['country_code'])) {
	header('Location: /idps/?c=' . $geo['country_code']);
} else {
	header('Location: /idps/');
}

<?php
function href($url) {
	$result = '';
	$parsed = parse_url($url);
	if (!$parsed) {
		return 'javascript:void(0)';
	}
	if (isset($parsed['scheme'])) {
		$result .= $parsed['scheme'] . '://';
	} else {
		return href('http://' . $url);
	}
	if (isset($parsed['host'])) {
		$result .= $parsed['host'];
	}
	if (isset($parsed['port'])) {
		$result .= ':' . $parsed['port'];
	}
	if (isset($parsed['path'])) {
		$result .= $parsed['path'];
	}
	if (isset($parsed['query'])) {
		$result .= '?' . $parsed['query'];
	}
	if (isset($parsed['fragment'])) {
		$result .= '#' . $parsed['fragment'];
	}
	return $result;
}
function url($url) {
	$result = '';
	$parsed = parse_url($url);
	if (!$parsed) {
		return $url;
	}
	if (!isset($parsed['scheme'])) {
		return url('http://' . $url);
	}
	if (isset($parsed['host'])) {
		$result .= substr($parsed['host'], 0, 4) === 'www.' ? substr($parsed['host'], 4) : $parsed['host'];
	}
	if (isset($parsed['port'])) {
		$result .= ':' . $parsed['port'];
	}
	if (isset($parsed['path'])) {
		$result .= $parsed['path'];
	}
	if (isset($parsed['query'])) {
		$result .= '?' . $parsed['query'];
	}
	if (isset($parsed['fragment'])) {
		$result .= '#' . $parsed['fragment'];
	}
	return $result;
}
?>
<?php if (!is_null($idp->getIconID())): ?>
<p><img src="<?= o($idp->getIconUrl()) ?>" alt="<?= o($idp->getDisplay()) ?> logo" class="img-fluid cat-idp-logo">
<?php endif; ?>
<?php if ($profile->getDescription() && !in_array($profile->getDescription(), ['eduroam', '0'])) { ?>
<p><?= o($profile->getDescription()) ?>

<hr>

<?php } if ($profile->hasSupport()) { ?>
<p>Ta kontakt med din institusjon dersom du trenger hjelp</p>
<address class="cat-support-contact">
<?php if (!in_array($profile->getDescription(), ['eduroam', '0'])): ?>
<span><strong><?= o($profile->getDisplay()) ?></strong></span>
<?php else: ?>
<span><strong><?= o($idp->getDisplay()) ?></strong></span>
<?php endif; ?>
<ul>
<?php if($profile->getLocalEmail()) { ?>
<li><span class="glyphicon glyphicon-envelope"></span>
<a href="<?= o($profile->getLocalEmail()) ?>"><?= o($profile->getLocalEmail()) ?></a>
</li>
<?php } ?>

<?php if($profile->getLocalPhone()) { ?>
<li><span class="glyphicon glyphicon-earphone"></span>
<a href="tel:<?= o($profile->getLocalPhone()) ?>"><?= o($profile->getLocalPhone()) ?></a>
</li>
<?php } ?>

<?php if($profile->getLocalUrl()) { ?>
<li><span class="glyphicon glyphicon-globe"></span>
<a href="<?= o(href($profile->getLocalUrl())) ?>"><?= o(url($profile->getLocalUrl())) ?></a>
</li>
<?php } ?>
</ul>
</address>
<?php } else { ?>
<p>If you encounter problems you should ask for help at your home institution.</p>
<?php } ?>

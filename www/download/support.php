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
<h1 class="h3"><?= o($idp->getDisplay()) ?></h1>
<?php if (!is_null($idp->getIconID())) { ?>
<p><img src="<?= o($idp->getIconUrl()) ?>" alt="<?= o($idp->getDisplay()) ?> logo" class="cat-idp-logo">
<?php } ?>
<p><?= o($profile->getDescription()) ?>

<hr>

<?php if ($profile->hasSupport()) { ?>
<p>If you encounter problems, then you can obtain direct assistance from you home organisation at:</p>
<address class="cat-support-contact">
<span><strong><?= o($profile->getDisplay()) ?></strong></span>
<?php if($profile->getLocalEmail()) { ?>
<span><?= o($profile->getLocalEmail()) ?></span>
<?php } ?>

<?php if($profile->getLocalPhone()) { ?>
<span><?= o($profile->getLocalPhone()) ?></span>
<?php } ?>

<?php if($profile->getLocalUrl()) { ?>
<span><a href="<?= o(href($profile->getLocalUrl())) ?>"><?= o(url($profile->getLocalUrl())) ?></a></span>
<?php } ?>
</address>
<?php } else { ?>
<p>If you encounter problems you should ask for help at your home institution.</p>
<?php } ?>

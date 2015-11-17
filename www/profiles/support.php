<h1><?= o($idp->getDisplay()) ?></h1>
<?php if (!is_null($idp->getIconID())) { ?>
<p><img src="<?= o($idp->getIconUrl()) ?>" alt="<?= o($idp->getDisplay()) ?> logo" class="cat-idp-logo">
<?php } ?>

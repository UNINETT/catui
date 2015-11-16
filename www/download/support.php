<h1><?= o($idp->getDisplay()) ?></h1>
<?php if (!is_null($idp->getIconID())) { ?>
<p><img src="<?= o($idp->getIconUrl()) ?>" alt="<?= o($idp->getDisplay()) ?> logo" style="max-width:100%">
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
<span><a href="<?= o($profile->getLocalUrl()) ?>"><?= o($profile->getLocalUrl()) ?></a></span>
<?php } ?>
</address>
<?php } else { ?>
<p>If you encounter problems you should ask for help at your home institution.</p>
<?php } ?>

<?php
$title = 'eduroam ' . $idp->getDisplay();
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row narrow-section">

<main class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h2 class="h4"><?= o($idp->getDisplay()) ?></h2>
<p>Select the user group</p>
<ul class="cat-profiles list-unstyled">
<?php foreach($profiles as $profile) { ?>
<li>
<a href="<?= o('/download/?' . build_download_query($profile)) ?>" class="btn btn-link btn-block">
<?= $profile->getDisplay() ?>
</a>
</li>
<?php } ?>
</ul>
</main>

<?php /*
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 support">
<?php include 'support.php'; ?>
</div>
*/ ?>

</div>
</div>

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

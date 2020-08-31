<?php
$title = 'Uninett eduroam for Android';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<h1 class="collapse" aria-hidden="true">geteduroam for Android</h1>

<div class="container">
	<div class="row narrow-section">
		<div class="col">
			<h2 class="collapse">Tilkobling</h2>
			<p class="text-center">
				<a href='https://play.google.com/store/apps/details?id=app.eduroam.geteduroam&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img alt='Tilgjengelig på Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/no_badge_web_generic.png' class="img-fluid" style="max-width:180px"></a>
			</p>
			<p>Linken åpner geteduroam i AppStore. Slik får du eduroam installert på din enhet:</p>
			<ul>
				<li class="mb-3">Last ned geteduroam-appen</li>
				<li class="mb-3">Velg din institusjon</li>
				<li class="mb-3">Fyll inn brukernavn og passord</li>
			</ul>
			<p><a class="link-dark small text-reset" href="?os=">Klikk her for gamle flow</a></p>
<?php require __DIR__ . DIRECTORY_SEPARATOR . 'info.php'; ?>
		</div>
	</div>
</div>

<?php
$legal .= '<br>Google Play og Google Play-logoen er varemerker tilhørende Google LLC.';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']);
?>

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
				<a href="https://apps.apple.com/no/app/geteduroam/id1504076137?mt=8"><img src="https://linkmaker.itunes.apple.com/no-no/badge-lrg.svg?releaseDate=2020-06-15&kind=iossoftware&bubble=ios_apps) no-repeat;width:135px;height:40px;" alt="Apple App Store badge" title="Last ned fra App Store" width="160"></a>
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
$legal .= '<br>App Store button, including the Apple logo, is provided under the App Store Marketing Artwork License Agreement';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']);
?>

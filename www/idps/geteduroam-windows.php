<?php
$title = 'Uninett eduroam';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<h1 class="collapse" aria-hidden="true">geteduroam for Windows</h1>

<div class="container">
	<div class="row narrow-section">
		<div class="col">
			<h2 class="collapse">Tilkobling</h2>
			<p class="text-center">
				<a class="btn btn-primary btn-jumbo cat-btn-download" href="/app/geteduroam.exe">Last ned appen<br><small>Windows 10</small></a>
			</p>
			<p>Linken laster ned en eduroam-app på din enhet. Slik får du eduroam installert:</p>
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

<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

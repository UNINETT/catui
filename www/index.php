<?php
$title = 'Uninett eduroam';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<h1 class="collapse" aria-hidden="true">eduroam Norge</h1>

<div class="container">
	<div class="row narrow-section">
		<div class="col">
			<h2 class="collapse">Tilkobling</h2>
			<p class="text-center">
				<a class="btn btn-primary btn-jumbo cat-btn-download" href="/idps/">Koble til eduroam</a>
			</p>
			<p class="text-center"><small class="text-muted">eduroam er et internasjonalt og sikkert system for trådløs nettilgang, basert på samme brukernavn og passord uavhengig av hvor brukeren befinner seg.</small></p>
		</div>
	</div>
	<div class="row narrow-section">
		<div class="col">
			<h2 class="collapse">Administrasjon</h2>
			<p>Er du administrator, eller ønsker du å bestille eduroam til din institusjon?</p>
			<p><a class="btn story-block-btn" href="/admin/">Administrer og konfigurer <small>Gå til verktøy</small></a></p>
			<p><a class="btn story-block-btn" href="/join/">Tilby eduroam <small>Bli Service- eller Identity Provider</small></a></p>
		</div>
	</div>
</div>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

<?php
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<nav class="sidebar">
		<ul>
			<li class="active">Support for elever, studenter og ansatte
			<li><a href="faq/">Ofte stilte spørsmål</a>
			<li><a href="support/">Support for IT-avdelinger</a>
		</ul>
	</nav>
</div>
<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
	<main class="">
		<h1 class="h2">Brukersupport</h1>

		<h2 class="h5">Finn kontaktinfo til din lokale brukerstøtte</h2>

		<p><input autofocus class="form-control form-control-lg" type="text" placeholder="Søk etter din vertsorganisasjon, f. eks. NTNU">

		<p>Ofte stilte spørsmål om eduroam, <a href="faq/">klikk her</a>
		<p>Hvis du ikke finner svar, ta kontakt med din lokale brukerstøtte.
		<p>Kontaktpunktet finner du ved hjelp av søkefeltet over.

		<h2 class="h5">Hva skal jeg søke etter?</h2>

		<ul>
			<li>Er du elev ved en offentlig grunnskole eller videregående skole, må du søke etter henholdvis kommunen eller fylkeskommunen som skolen din ligger i.

			<li>Er du student i høyere utdanning må du søke etter universitetet eller høyskolen du tilhører.
		</ul>
	</main>
</div>
</div>
</div>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

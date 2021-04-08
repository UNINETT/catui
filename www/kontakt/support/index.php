<?php
require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row">
<turbo-frame id="nav" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<nav class=" sidebar">
		<ul>
			<li><a href="../">Support for elever, studenter og ansatte</a>
			<li><a href="../faq/">Ofte stilte spørsmål</a>
			<li class="active">Support for IT-avdelinger
		</ul>
	</nav>
</turbo-frame>
<turbo-frame id="content" class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
	<main class="">
		<h1 class="h2">Support for IT-avdelinger</h1>

		<h2 class="h5">Uninett Servicesenter</h2>

		<p>E-post: <code>kontakt@uninett.no</code></p>

		<p>Telefon: <code>+47 73 55 79 00</code></p>

		<p>NB! Kritiske feil kan meldes 24/7. Utenfor ordinær åpningstid: Ring <code>+47 73 55 79 00</code> og tast <code>1</code></p>

	</main>
</turbo-frame>
</div>
</div>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

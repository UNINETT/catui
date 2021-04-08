<?php
$title = 'Uninett eduroam';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>


<main id="jumbotron">
<h1>Rett på<br><strong>trådløst nett</strong></h1>
<p>eduroam er en sikker Wi-Fi-tjeneste utviklet for det internasjonale forskning- og utdanningsmiljøet.</p>
<p style="display:flex;justify-content:space-between;">
	<a class="btn btn-primary cat-btn-download" href="/download/" style="display:block">Koble til</a>
	<a class="btn btn-outline-primary cat-btn-download" href="/info/" style="display:block">Les mer</a>
</p>
</main>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

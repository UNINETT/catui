<?php
require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<div class="container">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
	<nav class="container sidebar">
		<ul>
			<li><a href="../">Support for elever, studenter og ansatte</a>
			<li class="active">Ofte stilte spørsmål
			<li><a href="../support/">Support for IT-avdelinger</a>
		</ul>
	</nav>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<main class="container">
		<h1 class="h2">Ofte stilte spørsmål</h1>
		<h2 class="h5">Generelt</h2>

		<details>
		<summary>Hva er eduroam?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hvem er eduroam ment for?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hvem er Uninett?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hva skiller eduroam fra andre Wi-Fi-nettverk?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Er det trygt å bruke eduroam?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hvilke personopplysninger samles om meg?</summary>
		<p><code>FIXME</code>
		</details>

		<h2 class="h5">geteduroam</h2>

		<details>
		<summary>Hva er geteduroam.exe?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Er det trygt å kjøre geteduroam.exe?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hvorfor trenger jeg et program for å koble til Wi-Fi?</summary>
		<p><code>FIXME</code>
		</details>

		<details>
		<summary>Hvilke personopplysninger samles om meg?</summary>
		<p><code>FIXME</code>
		</details>

	</main>
</div>
</div>
</div>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 3) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

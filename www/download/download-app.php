<?php
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$userAgent = new \eduroam\device\UserAgent( $_GET['os'] );

$title = 'Uninett geteduroam app';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<style>
	h1 {
		font-family: "Colfax", "colfaxLight", "colfaxRegular", var(--bs-font-sans-serif);
	}
	h1 strong {
		font-family: "Colfax", "colfaxRegular", var(--bs-font-sans-serif);
	}

	.eduroam-btn-app-download::after {
		content: none;
	}
	.eduroam-btn-app-download {
		border-radius: .6em;
		padding-left: 6em;
		padding-right: 3em;
	}
	.eduroam-btn-app-windows {
		background-image: url('windows.svg');
		background-repeat: no-repeat;
		background-size: 2.5em;
		background-position: 2em 50%;
	}

	#os-image {
		max-height: min(20rem, 50vh);
	}
</style>

<main style="max-width:34em;margin:auto;text-align:center">
<h1>Last ned <strong>geteduroam</strong>-appen for å koble til eduroam</h1>

<?php if ( 'stationary' === $userAgent->getType() ): ?>
<p><img id="os-image" src="stationary.svg" alt="" role="presentation" aria-hidden="true">
<?php elseif ( 'ios' === $userAgent->getOS() || 'ios_legacy' === $userAgent->getOS() ): ?>
<p><img id="os-image" src="ios.png" alt="" role="presentation" aria-hidden="true">
<?php elseif ( 'android' === $userAgent->getOS() || 'android_legacy' === $userAgent->getOS() ): ?>
<p><img id="os-image" src="android.png" alt="" role="presentation" aria-hidden="true">
<?php else: ?>
<p><img id="os-image" src="unknown.jpg" alt="" role="presentation" aria-hidden="true">
<?php endif; ?>

<?php if ( 'windows' === $userAgent->getOS() ): ?>
<p><a class="btn btn-primary eduroam-btn-app-download eduroam-btn-app-windows" href="geteduroam.exe"><small>Last ned for</small><br><big>Windows</big></a>
<?php elseif( 'ios' === $userAgent->getOS() ): ?>
<p><a href="https://apps.apple.com/no/app/geteduroam/id1504076137"><img src="https://www.geteduroam.app/download/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" alt="iOS" style="height:3.6rem"></a>
<?php elseif( 'android' === $userAgent->getOS() ): ?>
<p><a href="https://play.google.com/store/apps/details?id=app.eduroam.geteduroam"><img src="https://www.geteduroam.app/download/google-play-badge-2.png" alt="Android" style="height:5rem"></a>
<?php else: ?>
<p><a class="btn btn-primary eduroam-btn-app-download" href="/idps/">Find institution</a>
<?php endif; ?>
<p><a href="../idps/">Velg et annet operativsystem</a>

<h2>Ofte stilte spørsmål</h2>

<div style="text-align:left;">
<?php if ( in_array( $userAgent->getOS(), ['windows', 'ios', 'android'] ) ): ?>
<details>
<summary>Hva er geteduroam?</summary>
<p>geteduroam er en trygg måte å koble til eduroam-nettet <code>FIXME</code>
</details>
<?php endif; ?>

<?php if ( $userAgent->getOS() === 'windows' ): ?>
<details>
<summary>Er det trygt å kjøre geteduroam.exe?</summary>
<p>Ja, geteduroam er utviklet av de samme mennesker som har laget eduroam-nettverket,
og programmet er laget slik at den kan avinnstalleres uten at noen rester blir igjen i datamaskinen din <code>FIXME</code>
</details>
<?php endif; ?>

<?php if ( $userAgent->getOS() === 'macos' ): ?>
<details>
<summary>Er det trygt å installere en konfigurasjonsprofil?</summary>
<p>geteduroam er utviklet av de samme mennesker som har laget eduroam-nettverket,
så ja det er trygg å installere en konfigurasjonsprofil som du har lastet ned fra denne siden.
Men konfigurasjonsprofiler kan konfigurere mye på enheten din, så det er alltid lurt å sjekke under installasjonsprosessen at profilen bare installerer sertifikat og Wi-Fi nettverk (også kalt "Passpoint")<code>FIXME</code>
</details>
<?php endif; ?>

<?php if ( $userAgent->getType() === 'mobile' ): ?>
<details>
<summary>Hvorfor trenger jeg en app?</summary>
<p>For å få høyest mulig sikkerhet når du bruker eduroam, må Wi-Fi nettverket konfigureres med sertifikater fra din institusjon.
	Dette er svært krevende å gjøre manuelt, men appen gjør dette automatisk for deg.
<p>Når du konfigurerer eduroam uten sertifikater vil det fungere, men enheten din kan ha <code>FIXME</code>
</details>
<?php endif; ?>

<details>
<summary>Hvorfor trenger jeg et program for å koble til Wi-Fi?</summary>
<p>Når du logger inn med eduroam bruker du ditt eget brukernavn og passord.
Hvis du logget inn på feil nettverk, kan passordet komme på avveie.
geteduroam sikrer at passordet ditt blir kryptert, slik at det er bare synlig for de som står for din eduroam-tilgang <code>FIXME</code>
</details>

<details>
<summary>Hvilke personopplysninger samles om meg?</summary>
<p>Selve geteduroam-applikasjonen lagrer innloggingsdetaljer på enheten din, som er nødvendig for å logge inn på eduroam-nettet. Dermed blir noe data delt med de stedene der du logger inn, og hjemmeorganisasjonen din.
<p>Når du bruker eduroam-nettet, vil tilbyderen kunne se oppkoblingstidspunkt, din MAC-adresse og hvilken organisasjon du er knyttet til. Avhengig hvordan din organisasjon har satt opp eduroam, vil tilbyderen også kunne se brukernavnet ditt. Samtidig vil din organisasjon kunne se hos hvilken tilbyder du bruker eduroam og når, og hvilken MAC-adresse du brukte.
<p>Innlogginger utenfor hjemmeorganisasjonen men innenfor Norge går via Uninett AS, som ser og logger samme informasjon som tilbyderen. Innlogginger i utlandet går først via den lokale eduroam-ansvarlig, og så via Uninett AS.
<p>Alle disse parter har lov å lagre data opp til 3 måneder, men kan bare bruke dette for feilsøking, sporing av misbruk og generell bruksstatistikk (men ikke målrettet statistikk).
<p>Nyere telefoner og tablets har en funksjon der MAC-adressen endres hver døgn, som beskytter deg mot sporing. Denne funksjonen er standard på.
<p>Alt informasjon om deg blir slettet fra enheten når du sletter appen via den standard avinstalleringsfunksjonen på enheten din.
<p><code>FIXME</code>
</details>

</div>
</main>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

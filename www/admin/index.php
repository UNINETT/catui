<?php
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<main class="container">

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-darkBlue uninett-fontColor-white">
		<h2>Utilities and debugging</h2>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3>CAT — Configuration Assistance Tool</h3>
				<p class="text-justify">
					CAT provides an easy way for users to configure their devices.
					IdPs are encouraged to join CAT, so that their users can configure their devices easily.
					The <a href="/download/">connect</a> page on eduroam.no uses CAT as its backend.
					CAT can be accessed through Feide, but must be enabled per institution.
					Contact <a href="https://www.feide.no/kontakt-oss">Feide support</a> to enable logins at CAT.
					Alternatively, social login can be used.
				</p>
				<p>
					<span><a href="//cat.eduroam.org/" class="btn btn-primary">Open CAT »</a></span>
				</p>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3>Realmstatus</h3>
				<p class="text-justify">
					Realmstatus helps identifying configuration problems with RADIUS servers.
					Once per night we try to contact your server, and check if it answers in the expected way.
					The results of this test are displayed on the realmstatus page.
				</p>
				<p>
					<span><a href="/realmstatus/" class="btn btn-primary">Open realmstatus »</a></span>
				</p>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3>Edudbg</h3>
				<p class="text-justify">
					We keep logs of users roaming via eduroam.
					Edudbg allows administrators of an identity provider to search these logs,
					in order to identify connection problems.
					Edudbg can only be used by institutions using Feide.
				</p>
				<p>
					<span><a href="/edudbg/" class="btn btn-primary">Open edudbg »</a></span>
				</p>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3>Edumanage</h3>
				<p class="text-justify">
					Service providers are required to provide Uninett (eduroam.no) with an up to date list of all
					service locations where eduroam is available.
					Edumanage makes this easy by providing service providers with a do-it-yourself interface
					for updating their service locations.
					Changes made in this system are immediately reflected on the eduroam websites.
					Edumanage can only be used by institutions using Feide.
					Institutions not using Feide can send updates via <a href="mailto:eduroam@uninett.no">eduroam@uninett.no</a>.
				</p>
				<p>
					<span><a href="/edumanage/" class="btn btn-primary">Open edumanage »</a></span>
				</p>
			</div>
		</div>
	</div>
</div>
</div>

</main>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

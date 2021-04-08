<?php
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<main class="container">

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-white">
		<h1>Join the eduroam hierarchy</h1>
		<p class="alert alert-info text-justify">
			This page is for system administrators and explains how an institution can offer eduroam services to its users.
			If you are a user and your institution is already offering eduroam, refer to the <a class="alert-link" href="/download/">connect</a> page to start using eduroam.
		</p>

		<p class="text-justify">
			There are two types of providers for <b>eduroam</b>.  These are
			<b class="label label-success">Service Provider</b> and
			<b class="label label-info">Identity Provider</b>.
			Institutions typically are both, businesses are typically only
			<b>Service Provider</b>
			As a <b>Service Provider</b>,
			you offer eduroam on-premises.  This allows students to automatically
			connect to the network and start using the internet.
			As an <b>Identity Provider</b>,
			you can maintain eduroam accounts that can be used among all
			<b>Service Providers</b>.
		</p>
		<p class="text-justify">
			To join eduroam please read the rest of this page and the apropriate links. 
			If you have any questions or would like to join, <a href="/contact/">please contact us</a>.
		</p>
	</div>
</div>
</div>

<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-green uninett-fontColor-white">
		<h2>Becoming a service provider</h2>
		<p class="text-justify">
			Virtually anyone can become a service provider.
			Educational institutions are urged to do so,
			in order to give students and employees the full benefits of eduroam on-premises.
			Other parties are also encouraged to become service providers;
			having eduroam available is considered an advantage by students.
		</p>
		<p class="text-justify">
			Becoming a service provider requires a registration in the national
			eduroam RADIUS server, which is subject to the national <a href="/policy/">eduroam policy</a>.
			Additionally, service providers are required to provide Uninett with an up-to-date list
			of service locations where the service provider offers eduroam.
			This can be done through <a href="/edumanage/"><b>edumanage</b></a> for service providers that use Feide,
			or through <a href="mailto:eduroam@uninett.no">eduroam@uninett.no</a> for other service providers.
			The service provider carries the sole responsibility for its infrastructure providing eduroam,
			Uninett can provide limited assistance, when resources to do so are available.
		</p>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-lightBlue uninett-fontColor-white">
		<h2>Becoming an identity provider</h2>
		<p class="text-justify">
			Only Norwegian institutions that are a member of Uninett AS can become identity provider in the Norwegian eduroam realm.
			Each identity provider is required to pay its share of the costs for external SP.
			This share is calculated based on the amount of potential users.
		</p>
		<p class="text-justify">
			Becoming a service provider requires a registration in the national
			eduroam RADIUS server, which is subject to the national <a href="/policy/">eduroam policy</a>.
			All identity providers must provide Uninett with the following information:
		</p>
		<ul>
			<li>Amount of students and employees</li>
			<li>DNS-name and IPv4+IPv6 addresses of RADIUS servers</li>
			<li>Shared secret (sent via SMS)</li>
			<li>Contact details of technical personnell</li>
		</ul>
		<p class="text-justify">
			The identity provider carries the sole responsibility for its infrastructure providing eduroam,
			UNINETT can provide limited assistance, when resources to do so are available.
		</p>
	</div>
</div>
</div>

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-purple uninett-fontColor-white">
		<h2>Configuring eduroam infrastructure</h2>
		<p class="text-justify">
			In order to connect to the national infrastructure,
			your RADIUS server needs to be able to contact our RADIUS server.
			Make sure you have provided Uninett with the correct hostnames and IP addresses,
			both IPv4 and IPv6.
			Also ensure that you are allowing traffic to and from our RADIUS servers,
			<code>ntlr1.eduroam.no</code>, <code>ntlr2.eduroam.no</code> and <code>ntlr3.eduroam.no</code> (UDP 1812 and 1813).
			For detailed technical information and examples, we refer you to 
			<a href="https://www.uninett.no/ferdige-ufs">best practice documents</a>
			and <a href="https://wiki.terena.org/display/H2eduroam/How+to+deploy+eduroam+on-site+or+on+campus" 
			>Terena confluence pages</a>
		</p>
	</div>
</div>
</div>

</main>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

<?php
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'src', '_autoload.php']);

$title = 'Tilby Uninett eduroam';
require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>

<main class="container">

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="uninett-padded gutter uninett-color-white">
		<h2>Technical background</h2>
		<p class="text-justify">
			Access to an <b>eduroam</b> network can be offered through an ethernet connection or wireless. All
			sites in Norway use IEEE 802.1X authentication and wireless networks are AES encrypted.
			IEEE 802.1X authentication with AES encryption conforms to the IEEE 802.11i standard (and WPA2).
		</p>
		<p class="text-justify">
			IEEE 802.1X is able to use various authentication protocols through the Extensible Authentication
			Protocol (EAP).  The protocols in use in our networks provide mutual authentication, checking 
			the identity of both the authentication server and user. These protocols are TLS, TTLS or PEAP. 
		</p>
		<p class="text-justify">
			All of these methods require the public certificate of the Certificate Authority (CA) that has issued
			the certificate of the authentication server. The client will use the CA public certificate to check if 
			the authentication server's certificate is valid.
		</p>
		<p class="text-justify">
			TLS requires the user to have a personal digital certificate issued. The authentication server will check
			if the user's certificate is valid.
		</p>
		<p class="text-justify">
			TTLS and PEAP are similar methods that both utilize the authentication server's certificates to create
			an encrypted tunnel using TLS. This makes it possible for the user to safely transmit a username and
			password. The username and password is transmitted using MS-CHAPv2.
		</p>
		<p class="text-center">
			<img src="enctunnel.png" alt="Illustration of an encrypted tunnel using TLS between client and authentication server" style="max-width:100%">
		</p>
		<p class="text-justify">
			At your home institution your local RADIUS server checks if you have the correct authentication. 
			When you connect to another <b>eduroam</b> site, that RADIUS server will forward your authentication
			request to the next level RADIUS server in a hierarchy of servers. Every national top-level RADIUS
			knows where to forward authentication requests from users within its nation. Requests from users
			from other countries are forwarded to an international top-level RADIUS server which in turn forwards
			it to the correct country. To have all this forwarding work each user must be uniquely identified.
			The user name must be followed by '@', organization and country. I.e. if your user name is "brukernavn"
			 and you work at UNINETT in Norway, your full identity/user name should be "brukernavn@uninett.no". 
			If you neglect to use your full identity/username you might still be able to log on at your home 
			institution but other institutions will not be able to check your identity and you will be denied 
			access.
		</p>
		<p class="text-center">
			<img src="hierachy.png" alt="Diagram showing eduroam hierarchy from institution level to international top-level" style="max-width:100%">
		</p>
		<p class="text-justify">
			You must have installed a client on your computer that is able to authenticate using IEEE 802.1X, the
			correct EAP protocol and employ the required encryption method.
			There are many such clients available with support
			for Linux, Windows and OS X. For Linux there is
			<a href="http://hostap.epitest.fi/wpa_supplicant/">wpa_supplicant</a>,
			or <a href="http://open1x.sourceforge.net/">Xsupplicant</a> for a wired connection.
			Windows and OS X have built in support for a while now.
		</p>
	</div>
</div>
</div>

</main>

<?php $legal = ''; /* not a CAT page */ ?>
<?php require dirname(__DIR__, 2) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'footer.php']); ?>

<?php
$title = 'Uninett eduroam';
require dirname(__DIR__) . implode(DIRECTORY_SEPARATOR, ['', 'inc', 'header.php']);
?>
<style type="text/css">
	body, html {
		height: 100%;
	}

	footer {
		border-top: .05rem solid black;
		background: #fff;
		position: absolute;
		bottom: 0;
		width: min(max(120vh, 95vw), 100%);
		right: 0;
		z-index: 11;
		transition: width 1s linear;
	}
	footer.full {
		width: 100%;
	}
	#map {
		position: absolute;
		left: 0;
		right: 0;
		top: 2.7128rem;
		bottom: 0;
		z-index: 10;
	}
	#jumbotron {
		position: absolute;
		z-index: 11;
		border-radius: .2rem;
		transition: background-color .5s linear, opacity .5s linear, box-shadow .5s linear;
	}
	#jumbotron.solid {
		background: #fff;
		box-shadow: rgba(0,0,0,.2) 0 .1rem .2rem
	}
	#jumbotron[hidden] {
		display: inherit !important;
		opacity: 0;
		pointer-events: none;
	}

	.leaflet-tile {
		filter: brightness(50%) invert(100%) !important;
	}
	#map.leaflet-container {
		background: #fff;
	}

	.marker-cluster {
		background: url('img/wifi.png');
		background-size: contain;
		background-repeat: no-repeat;
		color: rgba(0,0,0,0);
		background-clip: padding-box;
		border-radius: 20px;
	}
	.marker-cluster div {
		width: 30px;
		height: 30px;
		margin-left: 5px;
		margin-top: 5px;

		text-align: center;
		border-radius: 15px;
		font: 12px "Helvetica Neue", Arial, Helvetica, sans-serif;
	}
	.marker-cluster span {
		line-height: 30px;
	}
</style>

<div id="map" class="hidden-xs" aria-hidden="true" role="presentation"></div>

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
<link rel="stylesheet" href="js/leaflet/leaflet.css">
<link rel="stylesheet" href="js/leaflet.markercluster/MarkerCluster.css" type="text/css">

<script src="js/leaflet/leaflet-src.js"></script>
<script src="js/leaflet.markercluster/leaflet.markercluster.js"></script>
<script type="application/javascript">
function onZoom() {
	if (map.getZoom() > 6) {
		document.getElementById('jumbotron').hidden = 'hidden';
		document.getElementsByTagName('footer')[0].classList.add('full');
	} else {
		document.getElementById('jumbotron').hidden = undefined;
		document.getElementsByTagName('footer')[0].classList.remove('full');
	}
	if (map.getZoom() == 4) {
		document.getElementById('jumbotron').classList.add('solid');
	} else {
		document.getElementById('jumbotron').classList.remove('solid');
	}
}

const wifi = L.icon({
	iconUrl: '/img/marker-icon-2x.png',
	iconRetinaUrl: '/img/marker-icon-2x.png',

	iconSize:     [25, 41], // size of the icon
	iconAnchor:   [12, 41], // point of the icon which will correspond to marker's location
	popupAnchor:  [0, -12] // point from which the popup should open relative to the iconAnchor
});

const map = L.map(
		'map',
		{zoomSnap: 1, minZoom: 4, maxZoom: 17, zoomControl: false, maxBounds: [[55, -25], [81, 40]]}
	).fitBounds(
		[[58, 5], [70, 20]], // bounds for Norway
		{paddingTopLeft: [200, 0]} // padding left (brute forced sensible value)
	).addControl(L.control.zoom({position:"topright"}));

map.on('zoom', onZoom);

L.tileLayer(
		'https://maps.eduroam.no/tiles/stamen_toner-background/{z}/{x}/{y}.png',
		{detectRetina: true}
	).addTo(map);

const xhr = new XMLHttpRequest();
xhr.addEventListener('load', (e) => {
	const group = new L.MarkerClusterGroup({
		disableClusteringAtZoom: 15,
		maxClusterRadius: 20
	});
	const eduroamPoints = L.geoJSON(
			JSON.parse(e.target.response), 
			{'pointToLayer': function (feature, latlng) {
					return L.marker(latlng, { 'icon': wifi });
				},
			}
		);
	group.addLayer(eduroamPoints);
	map.addLayer(group);
});
xhr.open('GET', 'https://eduroam.no/general/geojson.json');
xhr.send();

onZoom();
</script>

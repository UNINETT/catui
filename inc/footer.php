
<footer>

<svg xmlns="http://www.w3.org/2000/svg" height="1em" width="1em" version="1.1" viewBox="-51 -1 402 402">
	<linearGradient id="a" y2="3e2" gradientUnits="userSpaceOnUse" x2="2e2" y1="2e2" x1="1e2">
		<stop stop-color="#0d0435" offset="0"/>
		<stop stop-color="#0e0c3b" offset=".061"/>
		<stop stop-color="#083360" offset=".40"/>
		<stop stop-color="#004f85" offset=".67"/>
		<stop stop-color="#0065a8" offset=".88"/>
		<stop stop-color="#0072bc" offset="1"/>
	</linearGradient>
	<polygon points="2e2 3e2 3e2 2e2 2e2 1e2" fill="#90CFF1"/>
	<polygon points="1e2 2e2 0 1e2 1e2 0" fill="#90CFF1"/>
	<polygon points="1e2 2e2 2e2 1e2 1e2 0" fill="#083F88"/>
	<polygon points="1e2 4e2 0 3e2 1e2 2e2" fill="#C7EAFC"/>
	<polygon points="2e2 3e2 2e2 3e2 2e2 1e2 1e2 2e2 1e2 2e2 1e2 4e2" fill="url(#a)"/>
</svg>

Uninett AS <?= date('Y') ?>
</footer>
<?php if ($legal !== ''): ?>
<footer class="legal" style="">
<?= $legal ?>
</footer>
<?php endif; ?>

<!-- Optional JavaScript -->
<!-- Popper.js is only required if using popup effects on hover -->
<!-- but if you use it, load it before bootstrap.min.js -->
<script src="/dist/js/bootstrap.min.js"></script>

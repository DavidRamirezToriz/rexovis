
<?php
$header_title       = 'REXOVIS';
$header_description = 'En REXOVIS - transformamos la forma en que se mueve el dinero en el mundo. Nuestra plataforma integra pagos cross-border, stablecoins y tokenización de activos para ofrecer transacciones más rápidas, seguras y accesibles, sin fronteras ni 
intermediarios innecesarios';
?>
<?php include('includes/head.php'); ?>

<div itemscope itemtype="http://schema.org/WebPage" style="display:none">
	<span itemprop="description"><?php echo $header_description; ?></span>
	<span itemprop="image"><?php echo $base_url;?>assets/images/brand-rexovi.png</span>
	<span itemprop="name"><?php echo $header_title; ?></span>
	<span itemprop="url"><?php echo $base_url;?></span>
	<div itemprop="author" itemscope itemtype="http://schema.org/Corporation">
		<span itemprop="description"><?php echo $header_description; ?></span>
		<span itemprop="image"><?php echo $base_url;?>assets/images/brand-rexovi.png</span>
		<span itemprop="name"><?php echo $header_title; ?></span>
		<span itemprop="url"><?php echo $base_url;?></span>
		<div itemprop="contactPoint" itemscope itemtype="http://schema.org/ContactPoint">
			<span itemprop="telephone">+52 559 613 0201</span>
			<span itemprop="contactType">sales</span>
		</div>
		<div itemprop="Brand" itemscope itemtype="http://www.schema.org/Brand">
			<span itemprop="name"><?php echo $header_title; ?></span>
			<span itemprop="url"><?php echo $base_url;?></span>
			<span itemprop="logo"><?php echo $base_url;?>assets/images/brand-rexovi.png</span>
		</div>
		<div itemprop="location" itemscope itemtype="http://schema.org/Place">
			<span itemprop="description"><?php echo $header_description; ?></span>
			<span itemprop="image"><?php echo $base_url;?>assets/images/brand-rexovi.png</span>
			<span itemprop="name"><?php echo $header_title; ?></span>
			<span itemprop="url"><?php echo $base_url;?></span>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress"></span>
				<span itemprop="addressLocality"></span>
				<span itemprop="addressRegion">México</span>
				<span itemprop="postalCode"></span>
			</div>
			<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="latitude" content="" />
				<meta itemprop="longitude" content="" />
			</div>
		</div> 
	</div>
</div>

<!-- scripts -->
<?php include('includes/header.php'); ?>

<!-- Main -->
<main>
	
	<?php
		$hero_type='three';
	?>
	<section class="hero-hex-v2">
		<div class="hero-hex-v2__content">
			<h1 class="title-level-1">Your Memories Shouldn't Belong to a Single Tech Giant.</h1>
			<p class="title-paragraph">
				Own your digital legacy. <strong>REXOVI®</strong> combines zero-knowledge, end-to-end encryption with decentralized storage to build an unbreakable vault for your photos and videos. Truly private. Highly affordable.
			</p>
			<!-- <p class="title-paragraph">
				Nuestra plataforma integra pagos cross-border, stablecoins y tokenización de activos para ofrecer transacciones más rápidas, seguras y accesibles, sin fronteras ni intermediarios innecesarios
			</p> -->
		</div>
		<div class="hero-hex-v2__visual">
			<svg class="hex-mask-svg" viewBox="0 0 522 611"><defs><clipPath id="hexClip"> <path class="st0" d="M503.8,232.8c-.7-10.6-6.2-20.3-15-26.4L279.7,60.1c-.3-.3-.6-.5-.9-.7-5.1-3.4-11.2-5.3-17.7-5.3s-12.8,2-18,5.5L33.1,206.4c-5,3.5-9,8.2-11.6,13.6-.2.3-.3.6-.4.9-1.4,3.1-2.4,6.4-2.8,9.9l-.3,2.8v1.7c0,0,0,142.1,0,142.1.7,10.7,6.1,20.6,15,26.7l195.7,137.1,14.1,9.9c.1,0,.2.1.2.2,5.1,3.4,11.3,5.4,17.8,5.4h.1c6.4,0,12.3-1.9,17.3-5.1l1.9-1.3,208.7-146.2,3.6-2.9,2.8-2.8s0,0,0,0c.9-1,1.7-2.1,2.5-3.3.4-.6.8-1.2,1.2-1.8,2.5-4.2,4.1-8.9,4.7-13.8l.2-2.2v-2c0,0,0,0,0,0v-142.5ZM261,402h0l-12.8-9.1-123.3-87.6,136.2-96.4h0l12.1,8.6,124,88.2-136.2,96.3Z"/></clipPath></defs></svg>
			<div class="hex-surface" clip-path="url(#hexClip)">
				<canvas id="hexTexture"></canvas>
				<div class="logo-mask-movile">
					<img src="assets/images/footer-rexovi.png">
				</div>
				<div class="logo-mask-layer">
					<svg
						class="logo-svg-mask"
						viewBox="0 0 522 611.6">
						<defs>
							<clipPath id="livingrockClip">
								 <path d="M503.8,232.8c-.7-10.6-6.2-20.3-15-26.4L279.7,60.1c-.3-.3-.6-.5-.9-.7-5.1-3.4-11.2-5.3-17.7-5.3s-12.8,2-18,5.5L33.1,206.4c-5,3.5-9,8.2-11.6,13.6-.2.3-.3.6-.4.9-1.4,3.1-2.4,6.4-2.8,9.9l-.3,2.8v1.7c0,0,0,142.1,0,142.1.7,10.7,6.1,20.6,15,26.7l195.7,137.1,14.1,9.9c.1,0,.2.1.2.2,5.1,3.4,11.3,5.4,17.8,5.4h.1c6.4,0,12.3-1.9,17.3-5.1l1.9-1.3,208.7-146.2,3.6-2.9,2.8-2.8s0,0,0,0c.9-1,1.7-2.1,2.5-3.3.4-.6.8-1.2,1.2-1.8,2.5-4.2,4.1-8.9,4.7-13.8l.2-2.2v-2c0,0,0,0,0,0v-142.5ZM261,402h0l-12.8-9.1-123.3-87.6,136.2-96.4h0l12.1,8.6,124,88.2-136.2,96.3Z"/>
							</clipPath>
						</defs>
						<foreignObject
							width="522"
							height="611.6"
							clip-path="url(#livingrockClip)">
							<div xmlns="http://www.w3.org/1999/xhtml" class="logo-canvas-wrapper">
								<canvas id="logoTexture"></canvas>
							</div>
						</foreignObject>
					</svg>
				</div>
			</div>
			<div class="floating-card card-main">
				<h4 class="title-card">Enterprise and Research Sandbox Access Available Now for Q4 2026 Models.</h4>
				<div class="svg__transferencias">
					<?php include 'assets/images/services/svg-transferencia.svg'; ?>
				</div>
				<a class="btn-primary">Schedule an Engineering Briefing</a>
				<!-- <div class="metric">1,740.34</div>
				<p class="flag-trans">transfiriendo</p> -->
			</div>
			<div class="floating-card card-small">
				<!-- <h5 class="flag-trans">Utilizalo para</h5> -->
				<p>
					Limited to <strong>500</strong> slots for Phase 1. No crypto knowledge required 
				</p>
				<a class="btn-primary">Join the Private Beta </a>
				<!-- <ul class="benefits-list">
					<li>
						Préstamos
					</li>
					<li>
 						Pago de tu nómina
					</li>
					<li>
 						Pago de facturas a proveedores
					</li>
				</ul> -->
				<div class="progress"></div>
			</div>
		</div>
	</section>
	<!-- <?php include('includes/trust-metrics.php'); ?> -->	
	<?php include('includes/solutions-cards.php'); ?>	
	<?php include('includes/showcase.php'); ?>	
	<?php include('includes/industries.php'); ?>	
	<section class="cta-banner">
		<div class="cta-banner__content">
			<h2 class="title-level-1">Secure Your Computational Edge</h2>
			<p class="title-paragraph">Stop scraping under legal risk. Start training with cryptographically verified, fully compliant visual infrastructure. Talk directly to our data licensing team to build your customized visual data stream today.</p>
			<!-- <p class="title-paragraph">Integra tus sistemas empresariales y ejecuta pagos de forma ágil mediante SPEI hacia el centro de costo CLABE, tarjetas de débito o SPEI Móvil. Centraliza la operación desde un solo centro de costos y mantén el control de cada movimiento financiero.</p> -->
			<!-- <ul class="benefits-list">
				<li>
					Préstamos
				</li>
				<li>
					Pago de tu nómina
				</li>
				<li>
					Pago de facturas a proveedores
				</li>
				<li>
					Reembolsos y devoluciones a clientes
				</li>
			</ul> -->
		</div>
	</section>	
   
</main>
<?php include('includes/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script src="js/livingrock-core-network-v2.js"></script>
<script src="js/ro-three-fixed.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="js/lenis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/gridCanvas.js"></script>
<script src="js/animations.js"></script>
<script src="js/showcase.js"></script>
<script src="js/hero.js"></script>
</body>
</html>
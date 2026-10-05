<!-- scripts -->
<?php include('includes/header.php'); ?>

<!-- Main -->

	<?php
		$hero_type = 'slider'; // image | video | slider
	?>
	<section class="hero hero--<?php echo $hero_type; ?>">
		<div class="hero__media">
			<?php if($hero_type==='image'): ?>
				<img src="assets/images/bg-05.png" alt="Hero">
			<?php endif; ?>
			<?php if($hero_type==='video'): ?>
				<video autoplay muted loop playsinline>
					<source src="assets/video/wallet-empresarial.mp4" type="video/mp4">
				</video>
			<?php endif; ?>
			<?php if($hero_type==='slider'): ?>
				<div class="swiper hero-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide" data-title="ELECTRONIC MUSIC PRODUCER" data-subtitle="50% de descuento en inscripción" data-text="IInscripciones abiertas todo el año" data-button="Empieza ahora"><img src="assets/images/bg-05.png"></div>
						<div class="swiper-slide" data-title="ABLETON LIVE" data-subtitle="Formación profesional" data-text="Cursos presenciales" data-button="Conocer cursos"><img src="assets/images/bg-06.png"></div>
						<div class="swiper-slide" data-title="PRODUCCIÓN" data-subtitle="Nivel profesional" data-text="Aprende con proyectos reales" data-button="Inscribirme"><img src="assets/images/bg-05.png"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="hero__overlay"></div>
		<div class="container-full hero__layout">
			<div class="hero__content">
				<h1 class="hero-title">ELECTRONIC MUSIC PRODUCER</h1>
				<p class="hero-subtitle">50% de descuento en inscripción</p>
				<span class="hero-description">Inscripciones abiertas todo el año</span>
				<a href="#contacto" class="hero__cta">Empieza ahora</a>
			</div>
			<div class="hero__dj">
				<div class="hero__dj--wrapper">
					<p class="hero__dj--legend">Cursos impartidos por Dj Producer</p>
					<p class="hero__dj--tutor">Daniel Muñoz García / SAE Institute Barcelona</p>FOn
				</div>
			</div>
			<div class="hero__progress"><span></span></div>
			<div class="hero__counter">01</div>
		</div>
	</section>
  <div class="container-full hero__layout">
		<div class="hero__content">
		<h1 class="hero-title">Infraestructura financiera moderna</h1>
		<p class="hero-subtitle">Conexiones seguras que mueven valor</p>
		<span class="hero-description">Pagos, cumplimiento y dispersión</span>
		<a href="#contacto" class="hero__cta">Solicitar demo</a>
		</div>
	</div>
	</section>
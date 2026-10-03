<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
	<?php
	// Obtener el protocolo (HTTP o HTTPS)
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

	// Obtener el nombre del dominio (por ejemplo: KubitPay.mx)
	$domain = $_SERVER['HTTP_HOST'];

	// Obtener la URI del script actual (por ejemplo: /demo/)
	$uri = $_SERVER['REQUEST_URI'];

	// Unir todo para obtener la URL completa
	$base_url = $protocol . $domain . $uri; 
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js";></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
	<meta charset="UTF-8">
	<title><?php echo !empty($header_title) ? $header_title : 'Proyecto';?></title>
	<meta name="description" content="<?php echo  $header_description ?>">
	<meta name="robots" content="index,follow">
    <meta name="robots" content="noodp,noydir">
    <meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $header_title; ?>" />
	<meta property="og:description" content="<?php echo $header_description; ?>" />
	<meta property="og:url" content="<?php echo $base_url;?>" />
	<meta property="og:image" content="<?php echo $base_url;?>assets/images/brand-rexovi.png" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5">
	<meta name="format-detection" content="telephone=no">
	<meta name="skype_toolbar" content="skype_toolbar_parser_compatible">
	<meta name="theme-color" content="#1ae91a">


	<base href="<?php echo $base_url;?>">
	<link rel="canonical" href="<?php echo $base_url;?>">
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

	<!-- Styles -->
	<link href="assets/css/custom.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Sora:wght@100..800&display=swap" rel="stylesheet">
	
	<!-- BOOTSTRAP ICONS (Añadido para que funcionen las redes sociales) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<!-- Slick Slider CSS -->
	<!-- Slick Slider CSS -->
	<link rel="stylesheet" href="css-js/slick.min.css">
	<link rel="stylesheet" href="css-js/slick-theme.min.css">
	<!-- echo time(); genera los segundos exactos actuales. Al agregarlo al final el navegador siempre cree que es un archivo nuevo y te carga los últimos cambios de CSS al instante. -->
	<link rel="stylesheet" href="scss/styles.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- Slick JS -->
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
</head>
<body>


<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css?family=Asap:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<a href="#" class="smooth-scroll bck-top-btn">
		<i class="fa fa-angle-double-up"></i>
	</a>

	<header id="header">
		<nav class="navbar fixed-top navbar-expand-lg navbar-light">
			<div class="container">

				<a class="navbar-brand" href="<?php echo home_url(); ?>">
					<?php bloginfo('name') ?>
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="ml-auto">
					<?php dezo_nav(); ?>
				</div>

			</div>
		</nav>
		<?php if ( get_header_image() ) : ?>
			<div id="header-image">
				<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
			</div>
		<?php endif; ?>
	</header>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-sm">

<?php
$blog_name = get_bloginfo('name');
$blog_description = get_bloginfo('description');

if (has_custom_logo()){
	$GLOBALS['addBodyClass'][] = 'header-logo';
}
?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php echo $blog_name; ?><?php wp_title('-'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">

	<link href="https://fonts.googleapis.com/css?family=Asap:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<?php wp_head(); ?>

	<style media="screen">
		@media screen and (max-width: 782px) {
			html { margin-top: 0 !important; }
		}
	</style>

</head>
<body <?php body_class(); ?>>
	<a href="#" class="smooth-scroll" id="bck-top-btn">
		<i class="fa fa-angle-double-up"></i>
	</a>

	<header id="header">
		<nav class="navbar fixed-top navbar-expand-lg navbar-light">
			<div class="container">

				<a class="navbar-brand mr-auto <?php if(has_custom_logo()) echo 'navbar-brand-logo' ?>" href="<?php echo home_url(); ?>">
					<?php
						if (has_custom_logo()){
							$custom_logo_id = get_theme_mod( 'custom_logo' );
							$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
							echo '<img src="'. esc_url( $logo[0] ) .'" alt="'. $blog_name .' - '. $blog_description .'">';
						} else {
							echo $blog_name;
						}
					?>
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<?php dezo_nav(); ?>

			</div>
		</nav>
		<?php if ( get_header_image() ) : ?>
			<div id="header-image" style="background-image: url(<?php header_image(); ?>);">
			</div>
		<?php endif; ?>
	</header>

	<div class="container" id="main-container">
		<div class="row">
			<div id="primary" class="col-sm">

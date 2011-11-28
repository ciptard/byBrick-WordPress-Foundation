<!doctype html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?>><!--<![endif]-->

<head>

	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	
	wp_title( '|', true, 'right' );
	
	// Add the blog name.
	bloginfo( 'name' );
	
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
		
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		
	?></title>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	
	<!-- We'll want to use Chrome Frame if available -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />	
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />			
	
	<!-- Favicon and apple-touch-icon (that's for iPhone *and* Andoroid folks) -->
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon.png">
		
	<!-- Theme hook -->
	<?php wp_head(); ?>
	
	<!-- This is for all IE specfific style less than IE9. We hate IE. -->
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie.css">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Our style.css file with custom CSS to override any Foundation defaults -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />	
	
</head>

<body <?php body_class(); ?>>

	<!--
	
		Information on how to work Foundation from ZURB
		can be found here: foundation.zurb.com/docs/
	
	-->
	
	<div class="container">
		<div class="row">
			<header id="site-header" class="twelve columns">
				<hgroup>
					<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 id="site-description"><?php bloginfo( 'description' ) ?></h2>
				</hgroup>
    			<nav id="top-navigation" role="navigation" class="hide-on-phones">
    				<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary' ) ); ?>
    			</nav>
    			<div class="show-on-phones">
    				<?php wp_nav_menu( array( 'menu' => 'huvudmeny', 'container' => '', 'menu_id' => 'selectnav' )); ?>
    			</div>
			</header>
		</div>
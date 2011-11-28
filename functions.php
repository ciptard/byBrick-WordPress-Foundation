<?php

/* =Text domain
-------------------------------------------------------------- */

load_theme_textdomain( 'custom', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

/* =Enables menus
-------------------------------------------------------------- */

function bb_register_menu() {
	register_nav_menu('primary', __('Primary menu'));
}
add_action('init', 'bb_register_menu');

/* =Register widgets/sidebars
-------------------------------------------------------------- */

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name'=> 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
//
//	Need more sidebars?
//
//	register_sidebar(array(
//		'name'=> 'First footer widget',
//		'id' => 'first_footer_widget',
//		'before_widget' => '<div class="widget">',
//		'after_widget' => '</div>',
//		'before_title' => '<p><strong>',
//		'after_title' => '</strong></p>',
//	));
}

/* =Check browser (and stuff it into our body class)
-------------------------------------------------------------- */

add_filter('body_class','bb_browser_body_class');
function bb_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}

/* =Load Javascript
-------------------------------------------------------------- */

function bb_load_scripts() {
	if (!is_admin()) {
	
		// Remove default jQuery, it comes with packed with Foundation
		wp_deregister_script('jquery');
		
		// Register our Javascript
		wp_register_script('selectivizr', 'http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js'); // Emulates CSS3 pseudo-classes and attribute selectors in Internet Explorer 6-8
		wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js'); // A fast & lightweight polyfill for min/max-width CSS3 Media Queries (for IE 6-8, and more)
		wp_register_script('foundation', get_template_directory_uri() . '/js/foundation.js');
		wp_register_script('app', get_template_directory_uri() . '/js/app.js', 'jquery', '1.0', TRUE);
		wp_register_script('iosfix', get_template_directory_uri() . '/js/ios-viewport-scaling-bug-fix.js');
		
		// Load our Javascript
		wp_enqueue_script('foundation');
		wp_enqueue_script('app');
	}
}
add_action('init', 'bb_load_scripts');

/* Load IE specific script only for IE */
function bb_load_ie_scripts() {
	global $is_IE;
	if($is_IE) wp_enqueue_script('selectivizr');
	if($is_IE) wp_enqueue_script('respond');
}
add_action('wp_print_scripts', 'bb_load_ie_scripts');

/* Load IE specific script only for iPhone */
function bb_load_ios_scripts() {
	global $is_iphone;
	if($is_iphone) wp_enqueue_script('iosfix');
}
add_action('wp_print_scripts', 'bb_load_ios_scripts');

/* =Load stylesheets
-------------------------------------------------------------- */

function bb_load_styles() {
	if (!is_admin()) {
		
		// Register our styles
		wp_register_style('foundation_style', get_template_directory_uri() . '/css/foundation.css');
	
		// Load our styles
		wp_enqueue_style( 'foundation_style');
	}
}
add_action('wp_print_styles', 'bb_load_styles');

/* =Custom login logo
-------------------------------------------------------------- */

function bb_custom_login_logo() {
	echo '<style type="text/css">h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; }</style>';
}
add_action('login_head', 'bb_custom_login_logo');

function bb_wp_login_url() {
	echo home_url();
}
add_filter('login_headerurl', 'bb_wp_login_url');

function bb_wp_login_title() {
	echo get_option('blogname');
}
add_filter('login_headertitle', 'bb_wp_login_title');

/* =Remove WordPress "junk" from the header file (remove lines if it's something here that you want to use)
-------------------------------------------------------------- */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/* =Add Google Analytics code in your footer, change UA-XXXXX-X to your own tracking code
-------------------------------------------------------------- */

function bb_google_analytics() {
	echo '<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>';
	echo '<script type="text/javascript">';
	echo 'var pageTracker = _gat._getTracker("UA-XXXXX-X");';
	echo 'pageTracker._trackPageview();';
	echo '</script>';
}
add_action('wp_footer', 'bb_google_analytics');

/* =Custom Foundation page navigation
-------------------------------------------------------------- */

function bb_pagenavi( $p = 2 ) { // pages will be show before and after current page
	if ( is_singular() ) return; // don't show in single page
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return; // don't show when only one page
	if ( empty( $paged ) ) $paged = 1;
	//echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // pages
	if ( $paged > $p + 1 ) p_link( 1, 'First' );
	if ( $paged > $p + 2 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // Middle pages
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class='current'><a href='#'>{$i}</a></li> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<li class="unavailable"><a href="#">&hellip;</a></li>';
	if ( $paged < $max_page - $p ) p_link( $max_page, 'Last' );
}
function p_link( $i, $title = '' ) {
	if ( $title == '' ) $title = "Page {$i}";
	echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a></li> ";
}

/* =Alert boxes
-------------------------------------------------------------- */

function bb_alert_box( $atts, $content = null ) {
   return '<div class="alert-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert_box', 'bb_alert_box');

function bb_alert_box_success( $atts, $content = null ) {
   return '<div class="alert-box success">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert_box_success', 'bb_alert_box_success');

function bb_alert_box_warning( $atts, $content = null ) {
   return '<div class="alert-box warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert_box_warning', 'bb_alert_box_warning');

function bb_alert_box_error( $atts, $content = null ) {
   return '<div class="alert-box error">' . do_shortcode($content) . '</div>';
}
add_shortcode('alert_box_error', 'bb_alert_box_error');

?>
<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
//include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'The Outlets Lipa' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Raleway:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css', array(), CHILD_THEME_VERSION );
    
//    if(!is_page(12)) {
        
	   wp_enqueue_style( 'modal-css', get_stylesheet_directory_uri() . "/css/modal.css", array(), CHILD_THEME_VERSION );
	   wp_enqueue_script( 'modaljs', get_stylesheet_directory_uri() . "/js/modal.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
//    }
	wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . "/css/main.css", array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'swiper-js', "https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'centerimage', get_stylesheet_directory_uri() . "/js/jquery.blImageCenter.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'mainjs', get_stylesheet_directory_uri() . "/js/main.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);
    
    
}

function wpdocs_dequeue_script() {
//    if(!is_page(12)) {
        wp_dequeue_script( 'wpdevelop-bootstrap' );
//    }
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( '', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Remove Footer
 remove_action('genesis_footer', 'genesis_do_footer');
 remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
 remove_action('genesis_footer', 'genesis_footer_markup_close', 15);


// Register Widgets
include_once( get_stylesheet_directory() . '/lib/widgets/widgets.php' );

// Remove Primary Menu's wrap.
add_theme_support( 'genesis-structural-wraps', array(
    'header',
    // 'menu-primary',
//    'menu-secondary',
    'footer-widgets'
) );


// Remove .site-inner
add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
add_filter( 'genesis_markup_content', '__return_null' );

// Add Title Banner
add_action( 'get_header', 'remove_titles_single_posts' );
function remove_titles_single_posts() {
    if ( !is_front_page() && !is_archive() ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
        remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
        remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
    }
}

add_action( 'genesis_before_content_sidebar_wrap', 'add_banner' );
function add_banner() {
    if ( !is_front_page() && !is_archive()  ) {
        get_template_part('template/section', 'innerbanner'); 
    }
}

//* Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
    if ( !is_front_page() ) {
        $classes[] = 'inner-page';
    } 
        return $classes;
	
}

genesis_register_sidebar( array(
    'id' => 'search-widget',
    'name' => __( 'Search Widget', 'genesis' ),
    'description' => __( 'Search', 'theoutlestlipa' ),
) );

add_action( 'genesis_after_footer', 'add_genesis_widget_area' );
function add_genesis_widget_area() {
    genesis_widget_area( 'search-widget', array(
		'before' => '<div id="searchModal" class="modal fade search-widget widget-area"><div class="search-wrap">',
		'after'  => '</div></div>',
    ) );

}

// Remove the header right widget area.
unregister_sidebar( 'header-right' );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );

add_action('genesis_header', 'search_function');
function search_function() {
    ?>
    <div class="search-button menu-item menu-item-type-custom menu-item-object-custom menu-item-186"><a href="#searchModal" itemprop="url" data-toggle="modal"><span itemprop="name"><i class="fas fa-search"></i></span></a></div>
    <?php
}
add_action( 'genesis_header', 'genesis_do_nav' );

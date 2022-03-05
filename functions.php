<?php
/**
 * Webflix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Webflix
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function webflix_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Webflix, use a find and replace
		* to change 'webflix' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'webflix', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'webflix' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'webflix_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'webflix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function webflix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'webflix_content_width', 640 );
}
add_action( 'after_setup_theme', 'webflix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function webflix_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'webflix' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'webflix' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'webflix_widgets_init' );

add_filter('get_the_archive_title_prefix','__return_false');

/**
 * Enqueue scripts and styles.
 */
function webflix_scripts() {
	wp_enqueue_style( 'webflix-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'webflix-style', 'rtl', 'replace' );

	wp_enqueue_style( 'webflix-ui-kit', get_template_directory_uri() . '/assets/css/uikit.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'webflix-simplebar-css', get_template_directory_uri() . '/assets/css/simplebar.css', array(), _S_VERSION );
	wp_enqueue_style( 'webflix-main-css', get_template_directory_uri() . '/assets/css/theme.css', array(), _S_VERSION );

	
	wp_enqueue_script( 'webflix-jquery', get_template_directory_uri() . '/assets/js/jquery.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-simplebar-js', get_template_directory_uri() . '/assets/js/simplebar.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-uikit-js', get_template_directory_uri() . '/assets/js/uikit.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-grid', get_template_directory_uri() . '/assets/js/components/grid.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-nav', get_template_directory_uri() . '/assets/js/components/nav.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'webflix-slideset', get_template_directory_uri() . '/assets/js/components/slideset.min.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'webflix_scripts' );

add_action('wp_ajax_nopriv_wpa56343_search', 'wpa56343_search'); // for not logged in users
add_action('wp_ajax_wpa56343_search', 'wpa56343_search');
function wpa56343_search()
{
	header('Content-Type: application/json');
    
	$query_args = array( 's' => $_POST['search_string'], 'post_type' => 'pelicula' );
	$query = new WP_Query( $query_args );

	$result = array();

	foreach( $query->posts as $resultPost ) {

		array_push( $result, array(
			"title" => $resultPost->post_title,
			"link" => $resultPost->post_name
		) );

	};

	echo json_encode( $result );

	// echo json_encode(array(
	// 	array(
	// 		"title" => 'scary',
	// 		'link' => 'https://madmonkeystudio.com.co/webflix/pelicula/scary-movie/'
	// 	),
	// 	array(
	// 		"title" => 'scary movie',
	// 		'link' => 'https://madmonkeystudio.com.co/webflix/pelicula/scary-movie/'
	// 	)
	// ));
	die();
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


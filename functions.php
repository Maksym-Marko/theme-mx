<?php
/**
 * theme-mx functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme-mx
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'theme_mx_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function theme_mx_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on theme-mx, use a find and replace
		 * to change 'theme-mx' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'theme-mx', get_template_directory() . '/languages' );

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
				'menu-1' 		=> esc_html__( 'Primary', 'theme-mx' ),
				'footer-menu-1' => esc_html__( 'Footer menu', 'theme-mx' )
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
				'theme_mx_custom_background_args',
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
endif;
add_action( 'after_setup_theme', 'theme_mx_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_mx_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'theme_mx_content_width', 640 );
}
add_action( 'after_setup_theme', 'theme_mx_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function theme_mx_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'theme-mx' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'theme-mx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// footer sidebar 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1 Widgets', 'theme-mx' ),
			'id'            => 'footer-sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'theme-mx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// footer sidebar 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2 Widgets', 'theme-mx' ),
			'id'            => 'footer-sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'theme-mx' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'theme_mx_widgets_init' );

/**
 * Add global variable for Vue.js.
 */
// function mx_global_javascript_vars() {

// 	echo '<script>';

// 		echo 'window.theme_mx_data = {';

// 			echo '"post_type":"' 	. get_post_type() . '",';

// 			echo '"post_id":"' 	. get_the_ID() . '",';

// 			echo '"ajax_url":"' 	. admin_url( "admin-ajax.php" ) . '"';

// 		echo '};';

// 	echo '</script>';

// }
// add_action ( 'wp_head', 'mx_global_javascript_vars' );

/**
 * Enqueue scripts and styles.
 */
function theme_mx_scripts() {

	
	// include bootstrap 4 css
	wp_enqueue_style( 'bootstrapcdn-4.0.0-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', [], _S_VERSION );

	wp_enqueue_style( 'theme-mx-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'theme-mx-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'theme-mx-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	// theme-x engine chunk-vendors
	wp_enqueue_script( 'theme-mx-engine-chunk-vendors', get_template_directory_uri() . '/theme-x-engine/dist/js/chunk-vendors.js', [], _S_VERSION, true );

	// theme-x engine app
	wp_enqueue_script( 'theme-mx-engine-app', get_template_directory_uri() . '/theme-x-engine/dist/js/app.js', ['theme-mx-engine-chunk-vendors'], _S_VERSION, true );

	// include bootstrap 4 js
	wp_enqueue_script( 'bootstrapcdn-4.0.0-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', ['jquery'], _S_VERSION, true );
	
	wp_enqueue_script( 'bootstrapcdn-4.0.0-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['jquery'], _S_VERSION, true );

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'theme_mx_scripts' );

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

/**
 * REST API registration.
 */
require get_template_directory() . '/theme-mx-engine/rest.php';

/**
 * MX Theme Helpers.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-helpers.php';

/**
 * MX Theme Main Class.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-engine.php';

// debug data
function mx_debug_to_file( $content ) {

	$content = mx_content_to_string( $content );

	$path = dirname(__FILE__) . '/mx-debug' ;

	if( ! file_exists( $path ) ) :

		mkdir( $path, 0777, true );

		file_put_contents( $path . '/mx-debug.txt', $content );

	else :

		file_put_contents( $path . '/mx-debug.txt', $content );

	endif;

}

function mx_content_to_string( $content ) {

	ob_start();

	var_dump( $content );

	return ob_get_clean();

}
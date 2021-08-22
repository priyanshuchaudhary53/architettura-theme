<?php
/**
 * Theme functions and definitions.
 * 
 * Sets up the theme.
 * 
 * @package Architettura WordPress theme
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants.
define( 'ARCHITETTURA_THEME_DIR', get_template_directory() );
define( 'ARCHITETTURA_THEME_URI', get_template_directory_uri() );

/**
 * ARCHITETTURA theme class
 * 
 */
final class ARCHITETTURA_Theme_Class {

    /**
     * Main Theme Class Constructor
     * 
     */
    public function __construct() {

        // Define theme constants.
		$this->architettura_constants();

		// Load required files.
		$this->architettura_setup();

        // Load framework classes.
		add_action( 'after_setup_theme', array( 'ARCHITETTURA_Theme_Class', 'classes' ), 4 );

        // Setup theme
        add_action( 'after_setup_theme', array( 'ARCHITETTURA_Theme_Class', 'theme_setup' ) );
    
        // Register sidebar widget area.
        add_action( 'widgets_init', array( 'ARCHITETTURA_Theme_Class', 'register_sidebar' ) );

        // Load theme js.
        add_action( 'wp_enqueue_scripts', array( 'ARCHITETTURA_Theme_Class', 'theme_js' ) );

        // Load theme CSS.
        add_action( 'wp_enqueue_scripts', array( 'ARCHITETTURA_Theme_Class', 'theme_css' ) );

        // Outputs custom CSS to the head.
		add_action( 'wp_head', array( 'ARCHITETTURA_Theme_Class', 'custom_css' ), 9999 );
		add_action( 'wp_head', array( 'ARCHITETTURA_Theme_Class', 'root_css' ), 1 );


    }

    /**
     * Define Constants
     * 
     */
    public static function architettura_constants() {

        $version = self::theme_version();

        // Theme version.
		define( 'ARCHITETTURA_THEME_VERSION', $version );

        // Javascript and CSS Paths.
		define( 'ARCHITETTURA_JS_DIR_URI', ARCHITETTURA_THEME_URI . '/assets/js/' );
		define( 'ARCHITETTURA_CSS_DIR_URI', ARCHITETTURA_THEME_URI . '/assets/css/' );

		// Include Paths.
		define( 'ARCHITETTURA_INC_DIR', ARCHITETTURA_THEME_DIR . '/inc/' );
		define( 'ARCHITETTURA_INC_DIR_URI', ARCHITETTURA_THEME_URI . '/inc/' );
    }

    /**
     * Load all core theme function files
     * 
     */
    public static function architettura_setup() {

        $dir = ARCHITETTURA_INC_DIR;

        require_once $dir . 'helpers.php';
        require_once $dir . 'walker/menu-walker.php';
    }

    /**
	 * Load theme classes
	 *
	 * @since   1.0.0
	 */
    public static function classes() {

        // Front-end classes.
        if ( ! is_admin() ) {

            // Breadcrumbs class.
            require_once ARCHITETTURA_INC_DIR . 'breadcrumbs.php';
        }

        // Customizer class.
		require_once ARCHITETTURA_INC_DIR . 'customizer/customizer.php';
    }

    /**
	 * Returns current theme version
	 *
	 */
	public static function theme_version() {

		// Get theme data.
		$theme = wp_get_theme();

		// Return theme version.
		return $theme->get( 'Version' );

	}

    /**
     * Theme Setup
     * 
     */
    public static function theme_setup() {

        // Register navigation menus.
        register_nav_menus(
            array(
                'main_menu'     => 'Main',
                'topbar_menu'   => 'Top Bar (only display on modern header)',
            )
        );

        // Enable support for <title> tag.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

        // Enable support for Widgets
        add_theme_support( 'widgets' );
    }

    /**
     * Load Theme CSS
     * 
     */
    public static function theme_css() {

        // Define dir.
		$dir           = ARCHITETTURA_CSS_DIR_URI;
		$theme_version = ARCHITETTURA_THEME_VERSION;

        wp_enqueue_style( 'bootstap', $dir . 'bootstrap.css', false, '4.1.1' );
        wp_enqueue_style( 'stylesheet', $dir . 'style.css', false, $theme_version );
        wp_enqueue_style( 'responsive', $dir . 'responsive.css', false, $theme_version );

        // Main Style.css File.
        wp_enqueue_style( 'architettura-main', ARCHITETTURA_THEME_URI . 'style.css', false, $theme_version );
    }

    /**
     * Load Theme JS
     * 
     */
    public static function theme_js() {

        // Define dir.
		$dir = ARCHITETTURA_JS_DIR_URI;
		$theme_version = ARCHITETTURA_THEME_VERSION;

        wp_enqueue_script( 'jquery', $dir . 'jquery.js', array(), '1.12.4', true );
        wp_enqueue_script( 'popper', $dir . 'popper.min.js', array(), false, true );
        wp_enqueue_script( 'jquery-ui', $dir . 'jquery-ui.js', array(), '1.12.1', true );
        wp_enqueue_script( 'bootstap-min', $dir . 'bootstrap.min.js', array(), '4.1.1', true );
        wp_enqueue_script( 'jquery-fancybox', $dir . 'jquery.fancybox.js', array(), '3.2.10', true );
        wp_enqueue_script( 'isotope', $dir . 'isotope.js', array(), '2.1.1', true );
        wp_enqueue_script( 'owl', $dir . 'owl.js', array(), '2.2.0', true );
        wp_enqueue_script( 'wow', $dir . 'wow.js', array(), '1.0.1', true );
        wp_enqueue_script( 'appear', $dir . 'appear.js', array(), false, true );
        wp_enqueue_script( 'scrollbar', $dir . 'scrollbar.js', array(), '3.1.12', true );
        wp_enqueue_script( 'script', $dir . 'script.js', array(), $theme_version, true );
    }

    /**
     * Register Sidebar
     * 
     */
    public static function register_sidebar() {
        
        // Primary Sidebar.
        register_sidebar( array(
            'name'          => 'Primary Sidebar',
            'id'            => 'primary-sidebar',
            'before_widget' => '<div class="sidebar-widget %2s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="sidebar-title"><h2>',
            'after_title'   => '</h2></div>',
        ) );

        // Footer 1
        register_sidebar( array(
            'name'          => 'Footer 1',
            'id'            => 'footer-1',
            'before_widget' => '<div class="footer-widget %2s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        ) );

        // Footer 2
        register_sidebar( array(
            'name'          => 'Footer 2',
            'id'            => 'footer-2',
            'before_widget' => '<div class="footer-widget %2s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        ) );

        // Footer 3
        register_sidebar( array(
            'name'          => 'Footer 3',
            'id'            => 'footer-3',
            'before_widget' => '<div class="footer-widget %2s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        ) );

        // Footer 4
        register_sidebar( array(
            'name'          => 'Footer 4',
            'id'            => 'footer-4',
            'before_widget' => '<div class="footer-widget %2s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        ) );
    }

    /**
	 * All theme functions hook into the architettura_head_css filter for this function.
	 *
	 * @since 1.0.0
	 */
	public static function custom_css( $output = null ) {

		// Add filter for adding custom css via other functions.
		$output = apply_filters( 'architettura_head_css', $output );
		
        // Minify and output CSS in the wp_head.
        if ( ! empty( $output ) ) {
            echo "<!-- Architettura CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( architettura_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
	
	}

    /**
	 * Root css.
	 *
	 * @since 1.0.0
	 */
	public static function root_css( $output = null ) {

		// Add filter for adding custom css via other functions.
		$output = apply_filters( 'architettura_root_css', $output );
		
        // Minify and output CSS in the wp_head.
        if ( ! empty( $output ) ) {
            echo "<!-- Root CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( architettura_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
	
	}

}

new ARCHITETTURA_Theme_Class();
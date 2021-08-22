<?php
/**
 * Architettura Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_Customizer' ) ) :

    /**
	 * The Architettura Customizer class
	 */
    class Architettura_Customizer {

        /**
		 * Setup class.
		 *
		 * @since 1.0
		 */
        public function __construct() {

			add_action( 'customize_register', array( $this, 'custom_controls' ) );
			add_action( 'customize_register', array( $this, 'controls_helpers' ) );
            add_action( 'after_setup_theme', array( $this, 'register_options' ) );
        }

		/**
		 * Adds custom controls
		 *
		 * @since 1.0.0
		 */
		public function custom_controls( $wp_customize ) {

			// Path
			$dir = ARCHITETTURA_INC_DIR . 'customizer/controls/';

			// Load customize control classes
			require_once( $dir . 'heading/heading-control.php' );

			// Register JS control types
			$wp_customize->register_control_type( 'Architettura_Customizer_Heading_Control' );
		}

		/**
		 * Adds customizer helpers
		 *
		 * @since 1.0.0
		 */
		public function controls_helpers() {

			require_once( ARCHITETTURA_INC_DIR .'customizer/sanitization-callbacks.php' );
		}

        /**
		 * Adds customizer options
		 *
		 * @since 1.0.0
		 */
		public function register_options() {
			
			// Var
			$dir = ARCHITETTURA_INC_DIR .'customizer/settings/';

			// Customizer files array
			$files = array(
				'general',
				'header',
				'blog',
				'sidebar',
				'footer',
			);

            foreach ( $files as $key ) {

                require_once( $dir . $key . '.php' );
            }
        }
    }

endif;

return new Architettura_Customizer();
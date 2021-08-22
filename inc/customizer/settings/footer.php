<?php
/**
 * Architettura Footer Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_Footer_Customizer' ) ) :

    /**
	 * Settings for footer
	 */
    class Architettura_Footer_Customizer {

        /**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
        public function __construct() {

            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            add_filter( 'architettura_head_css', array( $this, 'head_css' ) );
        }

        /**
		 * Customizer options
		 *
         * @since 1.0.0
		 */
        public function customizer_options( $wp_customize ) {

            /**
			 * Panel
			 */
            $panel = 'architettura_footer';
            $wp_customize->add_panel(
                $panel,
                array(
                    'title'     => 'Footer',
                    'priority' => 195,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_footer_widgets',
                array(
                    'title'     => 'Footer Widgets',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Footer widgets
             */
            $wp_customize->add_setting(
                'architettura_footer_widgets_enable',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_footer_widgets_enable',
                array(
                    'label'     => 'ENABLE FOOTER WIDGETS',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_footer_widgets',
                    'settings'  => 'architettura_footer_widgets_enable',
                    'priority'  => 10,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_footer_bottom',
                array(
                    'title'     => 'Footer Bottom',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Footer widgets
             */
            $wp_customize->add_setting(
                'architettura_footer_bottom_enable',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_footer_bottom_enable',
                array(
                    'label'     => 'ENABLE FOOTER BOTTOM',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_footer_bottom',
                    'settings'  => 'architettura_footer_bottom_enable',
                    'priority'  => 10,
                )
            );

            $wp_customize->add_setting(
                'architettura_footer_copyright',
                array(
                    'default'           => 'Architettura Theme by Priyanshu',
                    'sanitize_callback' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_footer_copyright',
                array(
                    'label'     => 'Copyright',
                    'type'      => 'textarea',
                    'section'   => 'architettura_footer_bottom',
                    'settings'  => 'architettura_footer_copyright',
                    'priority'  => 10,
                )
            );

        }

        /**
         * Get CSS
         *
         * @param obj $output    css output.
         * @since 1.0.0
         */
        public static function head_css( $output ) {

            // Define css var
            $css = '';



            // Return CSS.
            if ( ! empty( $css ) ) {
                $output .= '/* Blog CSS */' . $css;
            }

            // Return output css.
            return $output;
        }
    }

endif;

return new Architettura_Footer_Customizer();
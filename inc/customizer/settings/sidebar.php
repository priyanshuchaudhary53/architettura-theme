<?php
/**
 * Architettura Sidebar Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_Sidebar_Customizer' ) ) :

    /**
	 * Settings for blog
	 */
    class Architettura_Sidebar_Customizer {

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
            $panel = 'architettura_sidebar';
            $wp_customize->add_panel(
                $panel,
                array(
                    'title'     => 'Sidebar',
                    'priority' => 195,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_sidebar_widgets',
                array(
                    'title'     => 'Widgets',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Margin Bottom
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_margin_bottom',
                array(
                    'default'           => 40,
                    'sanitize_callback' => 'absint',
                )
            );

            $wp_customize->add_control(
                'architettura_sidebar_widgets_margin_bottom',
                array(
                    'label'     => 'Margin Bottom (px)',
                    'type'      => 'number',
                    'section'   => 'architettura_sidebar_widgets',
                    'settings'  => 'architettura_sidebar_widgets_margin_bottom',
                    'priority'  => 10,
                )
            );

            /**
             * Title Color
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_title_color',
                array(
                    'default'           => '#242424',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_sidebar_widgets_title_color',
                    array(
                        'label'     => 'Title Color',
                        'section'   => 'architettura_sidebar_widgets',
                        'settings'  => 'architettura_sidebar_widgets_title_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Title Border Color
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_title_border_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_sidebar_widgets_title_border_color',
                    array(
                        'label'     => 'Title Border Color',
                        'section'   => 'architettura_sidebar_widgets',
                        'settings'  => 'architettura_sidebar_widgets_title_border_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Title Margin Bottom
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_title_margin_bottom',
                array(
                    'default'           => 25,
                    'sanitize_callback' => 'absint',
                )
            );

            $wp_customize->add_control(
                'architettura_sidebar_widgets_title_margin_bottom',
                array(
                    'label'     => 'Title Margin Bottom (px)',
                    'type'      => 'number',
                    'section'   => 'architettura_sidebar_widgets',
                    'settings'  => 'architettura_sidebar_widgets_title_margin_bottom',
                    'priority'  => 10,
                )
            );

            /**
             * Link Color
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_link_color',
                array(
                    'default'           => '#797979',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_sidebar_widgets_link_color',
                    array(
                        'label'     => 'Link Color',
                        'section'   => 'architettura_sidebar_widgets',
                        'settings'  => 'architettura_sidebar_widgets_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Link Hover Color
             */
            $wp_customize->add_setting(
                'architettura_sidebar_widgets_link_hover_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_sidebar_widgets_link_hover_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_sidebar_widgets',
                        'settings'  => 'architettura_sidebar_widgets_link_hover_color',
                        'priority'  => 10,
                    )
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

            if ( 40 !== get_theme_mod( 'architettura_sidebar_widgets_margin_bottom', 40 ) ) {
                $css .= '.sidebar-widget{margin-bottom:' . get_theme_mod( 'architettura_sidebar_widgets_margin_bottom' ) . 'px;}';
            }

            if ( '#242424' !== get_theme_mod( 'architettura_sidebar_widgets_title_color', '#242424' ) ) {
                $css .= '.sidebar-title h2{color:' . get_theme_mod( 'architettura_sidebar_widgets_title_color' ) . ';}
                .sidebar h1, .sidebar h2, .sidebar h3, .sidebar h4, .sidebar h5, .sidebar h6{color:' . get_theme_mod( 'architettura_sidebar_widgets_title_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_sidebar_widgets_title_border_color', '#dfb162' ) ) {
                $css .= '.sidebar-title h2:after{background-color:' . get_theme_mod( 'architettura_sidebar_widgets_title_border_color' ) . ';}
                .sidebar h1:after, .sidebar h2:after, .sidebar h3:after, .sidebar h4:after, .sidebar h5:after, .sidebar h6:after{background-color:' . get_theme_mod( 'architettura_sidebar_widgets_title_border_color' ) . ';}';
            }

            if ( 25 !== get_theme_mod( 'architettura_sidebar_widgets_title_margin_bottom', 25 ) ) {
                $css .= '.sidebar-title{margin-bottom:' . get_theme_mod( 'architettura_sidebar_widgets_title_margin_bottom' ) . 'px;}';
            }

            if ( '#797979' !== get_theme_mod( 'architettura_sidebar_widgets_link_color', '#797979' ) ) {
                $css .= '.sidebar-widget ul li a{color:' . get_theme_mod( 'architettura_sidebar_widgets_link_color' ) . ';}
                .sidebar a{color:' . get_theme_mod( 'architettura_sidebar_widgets_link_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_sidebar_widgets_link_hover_color', '#dfb162' ) ) {
                $css .= '.sidebar-widget ul li a:hover{color:' . get_theme_mod( 'architettura_sidebar_widgets_link_hover_color' ) . ';}
                .sidebar a:hover{color:' . get_theme_mod( 'architettura_sidebar_widgets_link_hover_color' ) . ';}';
            }

            // Return CSS.
            if ( ! empty( $css ) ) {
                $output .= '/* Sidebar CSS */' . $css;
            }

            // Return output css.
            return $output;
        }
    }

endif;

return new Architettura_Sidebar_Customizer();
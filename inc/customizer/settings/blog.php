<?php
/**
 * Architettura Blog Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_Blog_Customizer' ) ) :

    /**
	 * Settings for blog
	 */
    class Architettura_Blog_Customizer {

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
            $panel = 'architettura_blog';
            $wp_customize->add_panel(
                $panel,
                array(
                    'title'     => 'Blog',
                    'priority' => 195,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_blog_archive',
                array(
                    'title'     => 'Blog Archive',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
			 * Archives Layout
			 */
            $wp_customize->add_setting(
                'architettura_blog_archive_layout',
                array(
                    'default'           => 'with-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_radio',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_archive_layout',
                array(
                    'label'     => 'Archives Layout',
                    'type'      => 'radio',
                    'section'   => 'architettura_blog_archive',
                    'settings'  => 'architettura_blog_archive_layout',
                    'priority'  => 10,
                    'choices'   => array(
                        'with-sidebar'  => 'With Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                )
            );

            /**
             * Sidebar Order
             * 
             */
            $wp_customize->add_setting(
                'architettura_blog_sidebar_order',
                array(
                    'default'           => 'right-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_sidebar_order',
                array(
                    'label'     => 'Sidebar Order',
                    'type'      => 'select',
                    'section'   => 'architettura_blog_archive',
                    'settings'  => 'architettura_blog_sidebar_order',
                    'priority'  => 10,
                    'choices'   => array(
                        'right-sidebar' => 'Content | Sidebar',
                        'left-sidebar'  => 'Sidebar | Content',
                    ),
                    'active_callback' => function ( $control ) {
                        return ( 'with-sidebar' == $control->manager->get_setting( 'architettura_blog_archive_layout' )->value() );
                    },
                )
            );

            /**
             * Image Overlay
             */
            $wp_customize->add_setting(
                'architettura_blog_image_hover',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_image_hover',
                array(
                    'label'     => 'ADD OVERLAY ON IMAGE HOVER',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_blog_archive',
                    'settings'  => 'architettura_blog_image_hover',
                    'priority'  => 10,
                )
            );

            /**
             * Blog Style
             */
            $wp_customize->add_setting(
                'architettura_blog_style',
                array(
                    'default'           => 'large-image',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_style',
                array(
                    'label'     => 'Blog Style',
                    'type'      => 'select',
                    'section'   => 'architettura_blog_archive',
                    'settings'  => 'architettura_blog_style',
                    'priority'  => 10,
                    'choices'   => array(
                        'large-image'   => 'Large Image',
                        'grid'          => 'Grid',
                    ),
                )
            );

            /**
			 * Section
			 */
			$wp_customize->add_section(
				'architettura_blog_single',
				array(
					'title'    => 'Single Post',
					'priority' => 10,
					'panel'    => $panel,
				)
			);

            /**
			 * Single Post Layout
			 */
            $wp_customize->add_setting(
                'architettura_blog_single_layout',
                array(
                    'default'           => 'with-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_radio',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_single_layout',
                array(
                    'label'     => 'Layout',
                    'type'      => 'radio',
                    'section'   => 'architettura_blog_single',
                    'settings'  => 'architettura_blog_single_layout',
                    'priority'  => 10,
                    'choices'   => array(
                        'with-sidebar'  => 'With Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                )
            );

            /**
             * Sidebar Order
             * 
             */
            $wp_customize->add_setting(
                'architettura_blog_single_sidebar_order',
                array(
                    'default'           => 'right-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_single_sidebar_order',
                array(
                    'label'     => 'Sidebar Order',
                    'type'      => 'select',
                    'section'   => 'architettura_blog_single',
                    'settings'  => 'architettura_blog_single_sidebar_order',
                    'priority'  => 10,
                    'choices'   => array(
                        'right-sidebar' => 'Content | Sidebar',
                        'left-sidebar'  => 'Sidebar | Content',
                    ),
                    'active_callback' => function ( $control ) {
                        return ( 'with-sidebar' == $control->manager->get_setting( 'architettura_blog_single_layout' )->value() );
                    },
                )
            );

            /**
             * Page Header Title
             * 
             */
            $wp_customize->add_setting(
                'architettura_blog_single_page_header_title',
                array(
                    'default'           => 'blog',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_blog_single_page_header_title',
                array(
                    'label'     => 'Page Header Title',
                    'type'      => 'select',
                    'section'   => 'architettura_blog_single',
                    'settings'  => 'architettura_blog_single_page_header_title',
                    'priority'  => 10,
                    'choices'   => array(
                        'blog'          => 'Blog',
                        'post-title'    => 'Post Title',    
                    ),
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

            if ( get_theme_mod( 'architettura_blog_image_hover', true ) ) {
                $css .= '.news-block-three .inner-box:hover .image a img{
                    opacity: .80;
                    -webkit-transform: scale(1.05);
                    -moz-transform: scale(1.05);
                    -ms-transform: scale(1.05);
                    -o-transform: scale(1.05);
                    transform: scale(1.05);
                }';

                $css .= '.news-block-two .inner-box:hover .image img{
                    opacity:0.5;
                    -webkit-transform:scale(1.07);
                    -ms-transform:scale(1.07);
                    transform:scale(1.07);
                }';
            }

            // Return CSS.
            if ( ! empty( $css ) ) {
                $output .= '/* Blog CSS */' . $css;
            }

            // Return output css.
            return $output;
        }
    }

endif;

return new Architettura_Blog_Customizer();
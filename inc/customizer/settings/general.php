<?php
/**
 * Architettura General Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_General_Customizer' ) ) :

    /**
	 * Settings for general options
	 */
    class Architettura_General_Customizer {

        /**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
        public function __construct() {

            add_action( 'customize_register', array( $this, 'customizer_options' ) );
            add_filter( 'architettura_head_css', array( $this, 'head_css' ) );
            add_filter( 'architettura_root_css', array( $this, 'root_css' ) );
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
            $panel = 'architettura_general_options';
            $wp_customize->add_panel(
                $panel,
                array(
                    'title'     => 'General Options',
                    'priority' => 195,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_general_style',
                array(
                    'title'     => 'General Styling',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Primary Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_general_style_primary_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_general_style_primary_color',
                    array(
                        'label'     => 'Primary Color',
                        'section'   => 'architettura_general_style',
                        'settings'  => 'architettura_general_style_primary_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Primary Link Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_general_style_primary_link_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_general_style_primary_link_color',
                    array(
                        'label'     => 'Primary Link Color',
                        'section'   => 'architettura_general_style',
                        'settings'  => 'architettura_general_style_primary_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Primary Link Hover Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_general_style_primary_link_hover_color',
                array(
                    'default'           => '#333333',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_general_style_primary_link_hover_color',
                    array(
                        'label'     => 'Primary Link Hover Color',
                        'section'   => 'architettura_general_style',
                        'settings'  => 'architettura_general_style_primary_link_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Background Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_general_style_background_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_general_style_background_color',
                    array(
                        'label'         => 'Site Background Color',
                        'section'       => 'architettura_general_style',
                        'settings'      => 'architettura_general_style_background_color',
                        'priority'      => 10,
                    )
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_general_settings',
                array(
                    'title'     => 'General Settings',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Main Container Width
             * 
             */
            $wp_customize->add_setting(
                'architettura_main_container_width',
                array(
                    'default'           => 1210,
                    'sanitize_callback' => 'absint',
                )
            );

            $wp_customize->add_control(
                'architettura_main_container_width',
                array(
                    'label'     => 'Main Container Width (px)',
                    'type'      => 'number',
                    'section'   => 'architettura_general_settings',
                    'settings'  => 'architettura_main_container_width',
                    'priority'  => 10,
                )
            );

            /**
             * Pages heading
             * 
             */
            $wp_customize->add_setting(
				'architettura_general_settings_pages_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Architettura_Customizer_Heading_Control(
					$wp_customize,
					'architettura_general_settings_pages_heading',
					array(
						'label'    => 'Pages',
						'section'  => 'architettura_general_settings',
						'priority' => 10,
					)
				)
			);

            /**
			 * Pages Layout
			 */
            $wp_customize->add_setting(
                'architettura_page_layout',
                array(
                    'default'           => 'with-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_radio',
                )
            );

            $wp_customize->add_control(
                'architettura_page_layout',
                array(
                    'label'     => 'Layout',
                    'type'      => 'radio',
                    'section'   => 'architettura_general_settings',
                    'settings'  => 'architettura_page_layout',
                    'priority'  => 10,
                    'choices'   => array(
                        'with-sidebar'  => 'With Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                )
            );

            /**
             * Page Sidebar Order
             * 
             */
            $wp_customize->add_setting(
                'architettura_page_sidebar_order',
                array(
                    'default'           => 'right-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_page_sidebar_order',
                array(
                    'label'     => 'Sidebar Order',
                    'type'      => 'select',
                    'section'   => 'architettura_general_settings',
                    'settings'  => 'architettura_page_sidebar_order',
                    'priority'  => 10,
                    'choices'   => array(
                        'right-sidebar' => 'Content | Sidebar',
                        'left-sidebar'  => 'Sidebar | Content',
                    ),
                    'active_callback' => function ( $control ) {
                        return ( 'with-sidebar' == $control->manager->get_setting( 'architettura_page_layout' )->value() );
                    },
                )
            );

            /**
             * Pages heading
             * 
             */
            $wp_customize->add_setting(
				'architettura_general_settings_search_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Architettura_Customizer_Heading_Control(
					$wp_customize,
					'architettura_general_settings_search_heading',
					array(
						'label'    => 'Search Result Page',
						'section'  => 'architettura_general_settings',
						'priority' => 10,
					)
				)
			);

            /**
			 * Search Layout
			 */
            $wp_customize->add_setting(
                'architettura_search_layout',
                array(
                    'default'           => 'with-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_radio',
                )
            );

            $wp_customize->add_control(
                'architettura_search_layout',
                array(
                    'label'     => 'Layout',
                    'type'      => 'radio',
                    'section'   => 'architettura_general_settings',
                    'settings'  => 'architettura_search_layout',
                    'priority'  => 10,
                    'choices'   => array(
                        'with-sidebar'  => 'With Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                )
            );

            /**
             * Page Sidebar Order
             * 
             */
            $wp_customize->add_setting(
                'architettura_search_sidebar_order',
                array(
                    'default'           => 'right-sidebar',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_search_sidebar_order',
                array(
                    'label'     => 'Sidebar Order',
                    'type'      => 'select',
                    'section'   => 'architettura_general_settings',
                    'settings'  => 'architettura_search_sidebar_order',
                    'priority'  => 10,
                    'choices'   => array(
                        'right-sidebar' => 'Content | Sidebar',
                        'left-sidebar'  => 'Sidebar | Content',
                    ),
                    'active_callback' => function ( $control ) {
                        return ( 'with-sidebar' == $control->manager->get_setting( 'architettura_search_layout' )->value() );
                    },
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_general_page_title',
                array(
                    'title'     => 'Page Title',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Visibility
             * 
             */
            $wp_customize->add_setting(
                'architettura_page_title_visibility',
                array(
                    'default'           => 'show',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_page_title_visibility',
                array(
                    'label'     => 'Visibility',
                    'type'      => 'select',
                    'section'   => 'architettura_general_page_title',
                    'settings'  => 'architettura_page_title_visibility',
                    'priority'  => 10,
                    'choices'   => array(
                        'show'      => 'Show',
                        'hidden'    => 'Hidden',
                    ),
                )
            );

            /**
             * Background Image
             * 
             */
            $wp_customize->add_setting(
                'architettura_page_title_background_image',
                array()
            );

            $wp_customize->add_control(
                new WP_Customize_Image_Control(
                    $wp_customize,
                    'architettura_page_title_background_image',
                    array(
                        'label'     => 'Backround Image',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_page_title_background_image',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Overlay
             * 
             */
            $wp_customize->add_setting(
                'architettura_page_title_overlay',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )        
            );

            $wp_customize->add_control(
                'architettura_page_title_overlay',
                array(
                    'label'     => 'ADD OVERLAY ON PAGE TITLE',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_general_page_title',
                    'settings'  => 'architettura_page_title_overlay',
                    'priority'  => 10,
                )
            );

            /**
             * Heading text color
             * 
             */
            $wp_customize->add_setting(
                'architettura_page_title_heading_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_page_title_heading_color',
                    array(
                        'label'     => 'Heading Color',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_page_title_heading_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Breadcrumbs heading
             * 
             */
            $wp_customize->add_setting(
				'architettura_breadcrumbs_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Architettura_Customizer_Heading_Control(
					$wp_customize,
					'architettura_breadcrumbs_heading',
					array(
						'label'    => 'Breadcrumbs',
						'section'  => 'architettura_general_page_title',
						'priority' => 10,
					)
				)
			);

            /**
             * Breadcrumbs
             * 
             */
            $wp_customize->add_setting(
                'architettura_breadcrumbs',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_breadcrumbs',
                array(
                    'label'     => 'ENABLE BREADCRUMS',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_general_page_title',
                    'settings'  => 'architettura_breadcrumbs',
                    'priority'  => 10,
                )
            );

            /**
             * Breadcrumbs text color
             * 
             */
            $wp_customize->add_setting(
                'architettura_breadcrumbs_text_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_breadcrumbs_text_color',
                    array(
                        'label'     => 'Text Color',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_breadcrumbs_text_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Breadcrumbs separater color
             * 
             */
            $wp_customize->add_setting(
                'architettura_breadcrumbs_separater_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_breadcrumbs_separater_color',
                    array(
                        'label'     => 'Separater Color',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_breadcrumbs_separater_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Breadcrumbs link color
             * 
             */
            $wp_customize->add_setting(
                'architettura_breadcrumbs_link_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_breadcrumbs_link_color',
                    array(
                        'label'     => 'Link Color',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_breadcrumbs_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Breadcrumbs link hover color
             * 
             */
            $wp_customize->add_setting(
                'architettura_breadcrumbs_link_hover_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_breadcrumbs_link_hover_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_general_page_title',
                        'settings'  => 'architettura_breadcrumbs_link_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_general_scroll_to_top',
                array(
                    'title'     => 'Scroll To Top',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Scroll to top
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )        
            );

            $wp_customize->add_control(
                'architettura_scroll_to_top',
                array(
                    'label'     => 'SCROLL UP BUTTON',
                    'type'      => 'checkbox',
                    'section'   => 'architettura_general_scroll_to_top',
                    'settings'  => 'architettura_scroll_to_top',
                    'priority'  => 10,
                )
            );

            /**
             * Scroll to top icon
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_icon',
                array(
                    'default'           => 'angle-up',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_scroll_to_top_icon',
                array(
                    'label'     => 'Arrow Icon',
                    'type'      => 'select',
                    'section'   => 'architettura_general_scroll_to_top',
                    'settings'  => 'architettura_scroll_to_top_icon',
                    'priority'  => 10,
                    'choices'   => array(
                        'angle-up'          => 'Angle Up',
                        'angle-double-up'   => 'Angle Double Up',
                        'sort-up'           => 'Sort Up',
                        'long-arrow-alt-up' => 'Long Arrow Up',
                        'level-up-alt'      => 'Level Up',
                    )
                )
            );

            /**
             * Scroll to top position
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_position',
                array(
                    'default'           => 'right',
                    'sanitize_callback' => 'architettura_sanitize_radio',
                )
            );

            $wp_customize->add_control(
                'architettura_scroll_to_top_position',
                array(
                    'label'     => 'Position',
                    'type'      => 'radio',
                    'section'   => 'architettura_general_scroll_to_top',
                    'settings'  => 'architettura_scroll_to_top_position',
                    'priority'  => 10,
                    'choices'   => array(
                        'right'     => 'Right',
                        'left'      => 'Left',
                    )
                )
            );

            /**
             * Scroll to top background color
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_background_color',
                array(
                    'default'           => '#1b1a1c',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_scroll_to_top_background_color',
                    array(
                        'label'     => 'Background Color',
                        'section'   => 'architettura_general_scroll_to_top',
                        'settings'  => 'architettura_scroll_to_top_background_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Scroll to top background hover color
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_background_hover_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_scroll_to_top_background_hover_color',
                    array(
                        'label'     => 'Background Hover Color',
                        'section'   => 'architettura_general_scroll_to_top',
                        'settings'  => 'architettura_scroll_to_top_background_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Scroll to top color
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_scroll_to_top_color',
                    array(
                        'label'     => 'Color',
                        'section'   => 'architettura_general_scroll_to_top',
                        'settings'  => 'architettura_scroll_to_top_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Scroll to top hover color
             * 
             */
            $wp_customize->add_setting(
                'architettura_scroll_to_top_hover_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_scroll_to_top_hover_color',
                    array(
                        'label'     => 'Hover Color',
                        'section'   => 'architettura_general_scroll_to_top',
                        'settings'  => 'architettura_scroll_to_top_hover_color',
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

            if ( '#ffffff' !== get_theme_mod( 'architettura_general_style_background_color', '#ffffff' ) ) {
                $css .=  'body{background-color:' . get_theme_mod( 'architettura_general_style_background_color' ) . ';}';
            }

            if ( 1210 !== get_theme_mod( 'architettura_main_container_width', 1210 ) ) {
                $css .= '.auto-container{max-width:' . get_theme_mod( 'architettura_main_container_width' ) . 'px;}';
            }

            if ( get_theme_mod( 'architettura_page_title_background_image' ) ) {
                $css .= '.page-wrapper .page-title{background-image:url(' . get_theme_mod( 'architettura_page_title_background_image' ) . ')}';
            }

            if ( get_theme_mod( 'architettura_page_title_overlay', true ) ) {
                $css .= '.page-title:before{
                    background-image: -ms-linear-gradient(left, rgba(0,0,0,0) 0%, #000000 100%);
                    background-image: -moz-linear-gradient(left, rgba(0,0,0,0) 0%, #000000 100%);
                    background-image: -o-linear-gradient(left, rgba(0,0,0,0) 0%, #000000 100%);
                    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(0,0,0,0)), color-stop(100, #000000));
                    background-image: -webkit-linear-gradient(left, rgba(0,0,0,0) 0%, #000000 100%);
                    background-image: linear-gradient(to left, rgba(0,0,0,0) 0%, #000000 100%);
                }';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_page_title_heading_color' ) ) {
                $css .= '.page-title h2{color:' . get_theme_mod( 'architettura_page_title_heading_color' ) . '}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_breadcrumbs_text_color', '#ffffff' ) ) {
                $css .= '.page-title .trail-items li{color:' . get_theme_mod( 'architettura_breadcrumbs_text_color' ) . ';}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_breadcrumbs_separater_color', '#ffffff' ) ) {
                $css .= '.page-title .trail-items li:after{color:' . get_theme_mod( 'architettura_breadcrumbs_separater_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_breadcrumbs_link_color', '#dfb162' ) ) {
                $css .= '.page-title .trail-items li a{color:' . get_theme_mod( 'architettura_breadcrumbs_link_color' ) . ';}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_breadcrumbs_link_hover_color', '#ffffff' ) ) {
                $css .= '.page-title .trail-items li a:hover{color:' . get_theme_mod( 'architettura_breadcrumbs_link_hover_color' ) . ';}';
            }

            if ( 'right' !== get_theme_mod( 'architettura_scroll_to_top_position', 'right' ) ) {
                $css .= '.scroll-to-top{
                    right:auto;
                    left:20px;
                }';
            }

            if ( '#1b1a1c' !== get_theme_mod( 'architettura_scroll_to_top_background_color', '#1b1a1c' ) ) {
                $css .= '.scroll-to-top{background-color:' . get_theme_mod( 'architettura_scroll_to_top_background_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_scroll_to_top_background_hover_color', '#dfb162' ) ) {
                $css .= '.scroll-to-top:hover{background-color:' . get_theme_mod( 'architettura_scroll_to_top_background_hover_color' ) . ';}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_scroll_to_top_color', '#ffffff' ) ) {
                $css .= '.scroll-to-top{color:' . get_theme_mod( 'architettura_scroll_to_top_color' ) . ';}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_scroll_to_top_hover_color', '#ffffff' ) ) {
                $css .= '.scroll-to-top:hover{color:' . get_theme_mod( 'architettura_scroll_to_top_hover_color' ) . ';}';
            }

            // Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* General CSS */' . $css;
			}

			// Return output css.
			return $output;
        }

        /**
		 * Get Root CSS
		 *
		 * @param obj $output    css output.
		 * @since 1.0.0
		 */
        public static function root_css( $output ) {

            // Define css var
            $css = ':root{';

            if ( '#dfb162' == get_theme_mod( 'architettura_general_style_primary_color', '#dfb162' ) ) {
                $css .= '--primary-color:#dfb162;';
            } else {
                $css .= '--primary-color:' . get_theme_mod( 'architettura_general_style_primary_color' ) . ';';
            }

            if ( '#dfb162' == get_theme_mod( 'architettura_general_style_primary_link_color', '#dfb162' ) ) {
                $css .= '--primary-link-color:#dfb162;';
            } else {
                $css .= '--primary-link-color:' . get_theme_mod( 'architettura_general_style_primary_link_color' ) . ';';
            }

            if ( '#333333' == get_theme_mod( 'architettura_general_style_primary_link_hover_color', '#333333' ) ) {
                $css .= '--primary-link-hover-color:#333333;';
            } else {
                $css .= '--primary-link-hover-color:' . get_theme_mod( 'architettura_general_style_primary_link_hover_color' ) . ';';
            }

            $css .= '}';

            // Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* Primary Colors CSS */' . $css;
			}

			// Return output css.
			return $output;
        }
    }

endif;

return new Architettura_General_Customizer();
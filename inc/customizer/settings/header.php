<?php
/**
 * Architettura Header Customizer Class
 *
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Architettura_Header_Customizer' ) ) :

     /**
	 * Settings for Header
	 */
    class Architettura_Header_Customizer {

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
            $panel = 'architettura_header';
            $wp_customize->add_panel(
                $panel,
                array(
                    'title'     => 'Header',
                    'priority' => 195,
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_general',
                array(
                    'title'     => 'General',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Header style
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_style',
                array(
                    'default'           => 'modern',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_header_style',
                array(
                    'label'     => 'Style',
                    'type'      => 'select',
                    'section'   => 'architettura_header_general',
                    'settings'  => 'architettura_header_style',
                    'priority'  => 10,
                    'choices'   => array(
                        'modern' => 'Modern',
                        'classic'  => 'Classic',
                    ),
                )
            );

            /**
             * Enable Topbar
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_topbar',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_header_topbar',
                array(
                    'label'             => 'Enable Top Bar',
                    'type'              => 'checkbox',
                    'section'           => 'architettura_header_general',
                    'settings'          => 'architettura_header_topbar',
                    'pripority'         => 10,
                    'active_callback'   => 'architettura_modern_header_selected',
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_topbar',
                array(
                    'title'     => 'Top Bar',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Topbar Content
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_topbar_content',
                array(
                    'default'           => 'Place your content here',
                    'sanitize_callback' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_header_topbar_content',
                array(
                    'label'             => 'Top Bar Content',
                    'type'              => 'textarea',
                    'section'           => 'architettura_header_topbar',
                    'settings'          => 'architettura_header_topbar_content',
                    'pripority'         => 10,
                )
            );

            /**
             * Topbar Icon
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_topbar_icon',
                array(
                    'default'           => 'no-icon',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_header_topbar_icon',
                array(
                    'label'             => 'Top Bar Icon',
                    'description'       => 'Icon before top bar content.',
                    'type'              => 'select',
                    'section'           => 'architettura_header_topbar',
                    'settings'          => 'architettura_header_topbar_icon',
                    'priority'          => 10,
                    'choices'           => array(
                        'no-icon'           => 'No Icon',
                        'call-answer'       => 'Phone',
                        'mail'              => 'Envelope',
                        'map'               => 'Map',
                    ),
                )
            );

            /**
             * Search Icon
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_search_icon',
                array(
                    'default'           => 'show',
                    'sanitize_callback' => 'architettura_sanitize_select',
                )
            );

            $wp_customize->add_control(
                'architettura_header_search_icon',
                array(
                    'label'     => 'Search Icon',
                    'type'      => 'select',
                    'section'   => 'architettura_header_general',
                    'settings'  => 'architettura_header_search_icon',
                    'priority'  => 10,
                    'choices'   => array(
                        'show'      => 'Show',
                        'hidden'    => 'Hidden',
                    ),
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_logo',
                array(
                    'title'     => 'Logo',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Header Logo
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_logo_image',
                array()
            );

            $wp_customize->add_control(
                new WP_Customize_Cropped_Image_Control(
                    $wp_customize,
                    'architettura_header_logo_image',
                    array(
                        'label'     => 'Logo',
                        'section'   => 'architettura_header_logo',
                        'settings'  => 'architettura_header_logo_image',
                        'priority'  => 10,
                        'width'     => '180',
                        'height'    => '70',
                    )
                )
            );

            /**
             * Header Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_logo_title_color',
                array(
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_logo_title_color',
                    array(
                        'label'             => 'Color',
                        'section'           => 'architettura_header_logo',
                        'settings'          => 'architettura_header_logo_title_color',
                        'priority'          => 10,
                        'active_callback'   => function ( $control ) {
                            return ( ! $control->manager->get_setting( 'architettura_header_logo_image' )->value() );
                        },
                    )
                )
            );

            /**
             * Header Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_logo_title_hover_color',
                array(
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_logo_title_hover_color',
                    array(
                        'label'     => 'Hover Color',
                        'section'   => 'architettura_header_logo',
                        'settings'  => 'architettura_header_logo_title_hover_color',
                        'priority'  => 10,
                        'active_callback'   => function ( $control ) {
                            return ( ! $control->manager->get_setting( 'architettura_header_logo_image' )->value() );
                        },
                    )
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_modern_menu',
                array(
                    'title'     => 'Menu',
                    'priority'  => 10,
                    'panel'     => $panel,
                    'active_callback'   => 'architettura_modern_header_selected',
                )
            );

            /**
             * Header Menu Link Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_modern_menu_link_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_modern_menu_link_color',
                    array(
                        'label'     => 'Link Color',
                        'section'   => 'architettura_header_modern_menu',
                        'settings'  => 'architettura_header_modern_menu_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Header Menu Link Hover Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_modern_menu_link_hover_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_modern_menu_link_hover_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_header_modern_menu',
                        'settings'  => 'architettura_header_modern_menu_link_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Header Menu Link Current Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_modern_menu_link_current_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_modern_menu_link_current_color',
                    array(
                        'label'     => 'Link Current Color',
                        'section'   => 'architettura_header_modern_menu',
                        'settings'  => 'architettura_header_modern_menu_link_current_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Header Menu Search Icon Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_modern_menu_search_icon_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_modern_menu_search_icon_color',
                    array(
                        'label'     => 'Search Icon Color',
                        'section'   => 'architettura_header_modern_menu',
                        'settings'  => 'architettura_header_modern_menu_search_icon_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_classic_menu',
                array(
                    'title'     => 'Menu',
                    'priority'  => 10,
                    'panel'     => $panel,
                    'active_callback'   => 'architettura_classic_header_selected',
                )
            );

            /**
             * Header Menu Link Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_menu_link_color',
                array(
                    'default'           => '#242424',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_menu_link_color',
                    array(
                        'label'     => 'Link Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_menu_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Header Menu Link Hover Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_menu_link_hover_color',
                array(
                    'default'           => '#242424',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_menu_link_hover_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_menu_link_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Header Menu Link Current Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_menu_link_current_color',
                array(
                    'default'           => '#242424',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_menu_link_current_color',
                    array(
                        'label'     => 'Link Current Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_menu_link_current_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Menu Background Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_menu_background_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_menu_background_color',
                    array(
                        'label'     => 'Menu Background Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_menu_background_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Menu Item Separater Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_menu_separater_color',
                array(
                    'default'           => '#D69B03',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_menu_separater_color',
                    array(
                        'label'     => 'Menu Item Separater Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_menu_separater_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Search Icon Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_classic_search_icon_color',
                array(
                    'default'           => '#242424',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_classic_search_icon_color',
                    array(
                        'label'     => 'Search Icon Color',
                        'section'   => 'architettura_header_classic_menu',
                        'settings'  => 'architettura_header_classic_search_icon_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
			 * Section
			 */
            $wp_customize->add_section(
                'architettura_header_mobile_menu',
                array(
                    'title'     => 'Mobile Menu',
                    'priority'  => 10,
                    'panel'     => $panel,
                )
            );

            /**
             * Link Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_menu_link_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_mobile_menu_link_color',
                    array(
                        'label'     => 'Link Color',
                        'section'   => 'architettura_header_mobile_menu',
                        'settings'  => 'architettura_header_mobile_menu_link_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Link Hover Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_menu_link_hover_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_mobile_menu_link_hover_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_header_mobile_menu',
                        'settings'  => 'architettura_header_mobile_menu_link_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Link Current Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_menu_link_current_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_mobile_menu_link_current_color',
                    array(
                        'label'     => 'Link Hover Color',
                        'section'   => 'architettura_header_mobile_menu',
                        'settings'  => 'architettura_header_mobile_menu_link_current_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Social menu heading
             * 
             */
            $wp_customize->add_setting(
				'architettura_header_mobile_social_menu_heading',
				array(
					'sanitize_callback' => 'wp_kses',
				)
			);

			$wp_customize->add_control(
				new Architettura_Customizer_Heading_Control(
					$wp_customize,
					'architettura_header_mobile_social_menu_heading',
					array(
						'label'    => 'Social Menu',
						'section'  => 'architettura_header_mobile_menu',
						'priority' => 10,
					)
				)
			);

            /**
             * Enable Social Menu
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_social_menu',
                array(
                    'default'           => true,
                    'sanitize_callback' => 'architettura_sanitize_checkbox',
                )
            );

            $wp_customize->add_control(
                'architettura_header_mobile_social_menu',
                array(
                    'label'             => 'Enable Social Menu',
                    'type'              => 'checkbox',
                    'section'           => 'architettura_header_mobile_menu',
                    'settings'          => 'architettura_header_mobile_social_menu',
                    'pripority'         => 10,
                )
            );

            /**
             * Icon Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_social_menu_icon_color',
                array(
                    'default'           => '#ffffff',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_mobile_social_menu_icon_color',
                    array(
                        'label'     => 'Icon Color',
                        'section'   => 'architettura_header_mobile_menu',
                        'settings'  => 'architettura_header_mobile_social_menu_icon_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Icon Color
             * 
             */
            $wp_customize->add_setting(
                'architettura_header_mobile_social_menu_icon_hover_color',
                array(
                    'default'           => '#dfb162',
                    'sanitize_callback' => 'sanitize_hex_color',
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'architettura_header_mobile_social_menu_icon_hover_color',
                    array(
                        'label'     => 'Icon Hover Color',
                        'section'   => 'architettura_header_mobile_menu',
                        'settings'  => 'architettura_header_mobile_social_menu_icon_hover_color',
                        'priority'  => 10,
                    )
                )
            );

            /**
             * Twitter
             * 
             */
            $wp_customize->add_setting(
                'architettura_social_twitter',
                array(
                    'sanitize_callabck' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_social_twitter',
                array(
                    'label'     => 'Twitter',
                    'type'      => 'text',
                    'section'   => 'architettura_header_mobile_menu',
                    'settings'  => 'architettura_social_twitter',
                    'priority'  => 10
                )
            );

            /**
             * Facebook
             * 
             */
            $wp_customize->add_setting(
                'architettura_social_facebook',
                array(
                    'sanitize_callabck' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_social_facebook',
                array(
                    'label'     => 'Facebook',
                    'type'      => 'text',
                    'section'   => 'architettura_header_mobile_menu',
                    'settings'  => 'architettura_social_facebook',
                    'priority'  => 10
                )
            );

            /**
             * Pinterest
             * 
             */
            $wp_customize->add_setting(
                'architettura_social_pinterest',
                array(
                    'sanitize_callabck' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_social_pinterest',
                array(
                    'label'     => 'Pinterest',
                    'type'      => 'text',
                    'section'   => 'architettura_header_mobile_menu',
                    'settings'  => 'architettura_social_pinterest',
                    'priority'  => 10
                )
            );

            /**
             * Instagram
             * 
             */
            $wp_customize->add_setting(
                'architettura_social_instagram',
                array(
                    'sanitize_callabck' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_social_instagram',
                array(
                    'label'     => 'Instagram',
                    'type'      => 'text',
                    'section'   => 'architettura_header_mobile_menu',
                    'settings'  => 'architettura_social_instagram',
                    'priority'  => 10
                )
            );

            /**
             * YouTube
             * 
             */
            $wp_customize->add_setting(
                'architettura_social_youtube',
                array(
                    'sanitize_callabck' => 'wp_filter_nohtml_kses',
                )
            );

            $wp_customize->add_control(
                'architettura_social_youtube',
                array(
                    'label'     => 'YouTube',
                    'type'      => 'text',
                    'section'   => 'architettura_header_mobile_menu',
                    'settings'  => 'architettura_social_youtube',
                    'priority'  => 10
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

            if ( 'classic' == get_theme_mod( 'architettura_header_style', 'modern' ) ) {
                $css .= '.page-title{padding:133px 0 70px;}
                .no-page-header{height:63px;}
                .header-style-five .header-upper{min-height:100px}';
            }

            if ( ! get_theme_mod( 'architettura_header_topbar', true ) ) {
                $css .= '.header-style-one .header-upper{
                    top: 0;
                }';
            }

            if ( ! get_theme_mod( 'architettura_header_logo_image' ) ) {
                $css .= '.main-header .header-upper .logo-outer{
                    position: absolute;
                    display: inline-block;
                    top: 50%;
                    transform: translateY(-50%);
                }
                @media only screen and (max-width: 767px){
                    .main-header .header-upper .nav-outer{
                        padding: 15px 0;
                    }
                }';
            }

            if ( get_theme_mod( 'architettura_header_logo_title_color' ) ) {
                $css .= '.main-header .header-upper .logo-outer .logo a{
                    color: ' . get_theme_mod( 'architettura_header_logo_title_color' ) . ';
                }';
            }

            if ( get_theme_mod( 'architettura_header_logo_title_hover_color' ) ) {
                $css .= '.main-header .header-upper .logo-outer .logo a:hover{
                    color: ' . get_theme_mod( 'architettura_header_logo_title_hover_color' ) . ';
                }';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_header_modern_menu_link_color', '#ffffff' ) ) {
                $css .= '.main-menu .navigation > li > a{
                    color: ' . get_theme_mod( 'architettura_header_modern_menu_link_color' ) . ';
                }';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_modern_menu_link_hover_color', '#dfb162' ) ) {
                $css .= '.main-menu .navigation > li > a:hover{
                    color: ' . get_theme_mod( 'architettura_header_modern_menu_link_hover_color' ) . ';
                }';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_modern_menu_link_current_color', '#dfb162' ) ) {
                $css .= '.main-menu .navigation > li.current > a{
                    color: ' . get_theme_mod( 'architettura_header_modern_menu_link_current_color' ) . ';
                }';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_header_modern_menu_search_icon_color', '#ffffff' ) ) {
                $css .= '.main-header .outer-box .search-box-btn span{
                    color: ' . get_theme_mod( 'architettura_header_modern_menu_search_icon_color' ) . ';
                }';
            }

            if ( '#242424' !== get_theme_mod( 'architettura_header_classic_menu_link_color', '#242424' ) ) {
                $css .= '.header-style-five .main-menu .navigation > li > a{
                    color: ' . get_theme_mod( 'architettura_header_classic_menu_link_color' ) . ';
                }';
            }

            if ( '#242424' !== get_theme_mod( 'architettura_header_classic_menu_link_hover_color', '#242424' ) ) {
                $css .= '.header-style-five .main-menu .navigation > li > a:hover{
                    color: ' . get_theme_mod( 'architettura_header_classic_menu_link_hover_color' ) . ';
                }';
            }

            if ( '#242424' !== get_theme_mod( 'architettura_header_classic_menu_link_current_color', '#242424' ) ) {
                $css .= '.header-style-five .main-menu .navigation > li.current > a{
                    color: ' . get_theme_mod( 'architettura_header_classic_menu_link_current_color' ) . ';
                }';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_classic_menu_background_color', '#dfb162' ) ) {
                $css .= '.header-style-five .header-lower .nav-outer{
                    background-color: ' . get_theme_mod( 'architettura_header_classic_menu_background_color' ) . ';
                }';
            }

            if ( '#D69B03' !== get_theme_mod( 'architettura_header_classic_menu_separater_color', '#D69B03' ) ) {
                $css .= '.header-style-five .main-menu .navigation > li:before{
                    background-color: ' . get_theme_mod( 'architettura_header_classic_menu_separater_color' ) . ';
                }';
            }

            if ( '#242424' !== get_theme_mod( 'architettura_header_classic_search_icon_color', '#242424' ) ) {
                $css .= '.header-style-five .outer-box .search-box-btn{
                    color: ' . get_theme_mod( 'architettura_header_classic_search_icon_color' ) . ';
                }';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_header_mobile_menu_link_color', '#ffffff' ) ) {
                $css .= '.mobile-menu .navigation li > a{color:' . get_theme_mod( 'architettura_header_mobile_menu_link_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_mobile_menu_link_hover_color', '#dfb162' ) ) {
                $css .= '.mobile-menu .navigation li > a:hover{color:' . get_theme_mod( 'architettura_header_mobile_menu_link_hover_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_mobile_menu_link_current_color', '#dfb162' ) ) {
                $css .= '.mobile-menu .navigation li.current > a{color:' . get_theme_mod( 'architettura_header_mobile_menu_link_current_color' ) . ';}
                .mobile-menu .navigation li > a:before{border-left:5px solid ' . get_theme_mod( 'architettura_header_mobile_menu_link_current_color' ). ';}
                .mobile-menu .navigation li.dropdown .dropdown-btn.open{background:' . get_theme_mod( 'architettura_header_mobile_menu_link_current_color' ) . ';}';
            }

            if ( '#ffffff' !== get_theme_mod( 'architettura_header_mobile_social_menu_icon_color', '#ffffff' ) ) {
                $css .= '.mobile-menu .social-links li a{color:' . get_theme_mod( 'architettura_header_mobile_social_menu_icon_color' ) . ';}';
            }

            if ( '#dfb162' !== get_theme_mod( 'architettura_header_mobile_social_menu_icon_hover_color', '#dfb162' ) ) {
                $css .= '.mobile-menu .social-links li a:hover{color:' . get_theme_mod( 'architettura_header_mobile_social_menu_icon_hover_color' ) . ';}';
            }

            // Return CSS.
            if ( ! empty( $css ) ) {
                $output .= '/* Header CSS */' . $css;
            }

            // Return output css.
            return $output;
        }
    }

endif;

return new Architettura_Header_Customizer();
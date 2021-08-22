<?php 
/**
 * The Header for the theme.
 * 
 * @package Architettura WordPress theme
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<?php wp_head(); ?>
<meta charset="<?php bloginfo('charset'); ?>">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">
<!-- Preloader -->
<div class="preloader"></div>

<header class="main-header header-style-<?php if ( 'modern' == get_theme_mod( 'architettura_header_style', 'modern' ) ) : echo 'one'; else : echo 'five'; endif; ?>">

    <?php if ( 'modern' == get_theme_mod( 'architettura_header_style', 'modern' ) ) : ?>
    
        <?php if ( get_theme_mod( 'architettura_header_topbar', true ) ) : ?>

            <div class="header-top">
                <div class="auto-container clearfix topbar">
                    
                    <div class="top-left clearfix">
                        <div class="text">
                            <?php do_action( 'architettura_topbar_icon' ); ?>
                            <?php echo get_theme_mod( 'architettura_header_topbar_content', 'Place you content here' ); ?>
                        </div>
                    </div>
                    <div class="top-right clearfix">
                        <?php wp_nav_menu(
                            array(
                                'theme_location'    => 'topbar_menu',
                                'depth'             => 1,
                                'items_wrap'        => '<ul class="info-list">%3$s</ul>',
                                'fallback_cb'       => false,
                            )
                        ); ?>
                    </div>

                </div>
            </div>

        <?php endif; ?>
    <!-- End Header Top -->

    <!-- Header Upper -->
    <div class="header-upper">
        <div class="inner-container">
            <div class="auto-container clearfix">
                
                <?php do_action( 'architettura_header_logo' ); ?>

                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="navbar-header">
                            <!-- Togg le Button -->      
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon flaticon-menu-1"></span>
                            </button>
                        </div>
                    
                        <?php do_action( 'architettura_main_menu' ); ?>

                    </nav>
                    <!-- Main Menu End-->
                    
                    <?php do_action( 'architettura_header_search' ); ?>

                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <?php else: ?>

    <div class="header-upper">
        <div class="inner-container">
            <div class="auto-container clearfix">
                
                <!--Logo-->
                <?php do_action( 'architettura_header_logo' ); ?>
                
                <!--Info-->
                <div class="info-outer clearfix">
                
                    <!--Info Box-->
                    <div class="info-box">
                        <div class="icon"><?php do_action( 'architettura_topbar_icon' ); ?></div>
                        <div class="text">
                           <?php echo get_theme_mod( 'architettura_header_topbar_content', 'Place you content here' ); ?>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
    <!--End Header Upper-->
		
    <div class="header-lower">
        <div class="fixed-outer">
            
            <div class="auto-container">
                <!--Nav Box-->
                <div class="nav-outer clearfix">
                    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="navbar-header">
                            <!-- Toggle Button -->      
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon flaticon-menu-1"></span>
                            </button>
                        </div>

                        <?php do_action( 'architettura_main_menu' ); ?>

                    </nav>
                    <!-- Main Menu End-->

                    <?php do_action( 'architettura_header_search' ); ?>
                    
                </div>
            </div>
            
        </div>
    </div>

    <?php endif; ?>

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-cancel"></span></div>
        
        <nav class="menu-box">
            <div class="nav-logo">
            <?php if ( get_theme_mod( 'architettura_header_logo_image' ) ) : ?>
                <a href="<?php echo get_site_url(); ?>"><img src="<?php echo wp_get_attachment_url( get_theme_mod('architettura_header_logo_image') ); ?>" alt="" title=""></a>
            <?php endif; ?>
            </div>
            <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
            <?php do_action( 'architettura_mobile_social_link' ); ?>
        </nav>
    </div><!-- End Mobile Menu -->

</header>
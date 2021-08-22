<?php
/**
 * The template for displaying 404 pages.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

<?php do_action( 'architettura_page_header' ); ?>

<?php do_action( 'architettura_before_container' ); ?>
    
    <div class="auto-container">

        <div class="row clearfix">

            <?php do_action( 'architettura_before_container_inner' ); ?>

                <div class="error-404">
                    <img src="<?php echo get_theme_file_uri( '/assets/images/404image.png' ); ?>" alt="404-image">
                    <h2 class="error-title">This page could not be found!</h2>
                    <p class="error-text">We are sorry. But the page you are looking for is not available.</p>
					<a class="error-btn button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back To Homepage</a>
                </div>

            <?php do_action( 'architettura_after_container_inner' ); ?>
            
        </div>

    </div>

<?php do_action( 'architettura_after_container' ); ?>

<?php get_footer(); ?>
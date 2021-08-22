<?php
/**
 * Post single content
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'architettura_before_singular_content' );
?>        
    <h2><?php the_title(); ?></h2>

    <?php
    the_content();

do_action( 'architettura_after_singular_content' ); 


 wp_link_pages(); ?>
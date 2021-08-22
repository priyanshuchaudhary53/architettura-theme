<?php
/**
 * Outputs page article
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="lower-content">

    <?php
    do_action( 'architettura_before_singular_content' );
        
        the_content();

    do_action( 'architettura_after_singular_content' ); 
    ?>

</div>
<?php wp_link_pages(); ?>
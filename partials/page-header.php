<?php 
/**
 * The template for displaying the page header.
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if page header is disabled.
if ( ! architettura_has_page_header() ) {
	echo '<div class="no-page-header"></div>';
} else {
?>

    <section class="page-title">
        <div class="auto-container">
            <h2><?php echo wp_kses_post( architettura_has_page_title() ); ?></h2>
            <?php if ( function_exists( 'breadcrumb_trail' ) && get_theme_mod( 'architettura_breadcrumbs', true ) ) $bread = breadcrumb_trail(array(
                'show_on_front' => false,
                'show_browse' => false,
            ));?>
        </div>
    </section>

<?php } ?>
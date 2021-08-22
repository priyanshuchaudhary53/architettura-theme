<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Architettura WordPress theme
 */

if ( ! architettura_has_sidebar() ) {
    return;
}?>

<?php do_action( 'architettura_before_sidebar' ); ?>
    
    <aside class="sidebar">

        <?php dynamic_sidebar('primary-sidebar'); ?>
        
    </aside>

<?php do_action( 'architettura_after_sidebar' ); ?>
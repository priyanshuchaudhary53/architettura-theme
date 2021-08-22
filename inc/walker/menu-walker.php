<?php
/**
 * Custom wp_nav_menu walker.
 *
 * @package Architettura WordPress theme
 */

if ( ! class_exists( 'Architettura_Custom_Menu_Walker' ) ) {

    class Architettura_Custom_Menu_Walker extends Walker_Nav_Menu {

        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= "\n" . '<ul>' . "\n";
        }

        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            
            global $wp_query;
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
            $class_names .= in_array( 'current_page_item', $item->classes ) ? ' current' : '';
            $class_names .= in_array( 'menu-item-has-children', $item->classes ) ? ' dropdown' : '';
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            
        }

        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= '</ul>' . "\n";
        }
    }

}
<?php
/**
 * Sanitization Callbacks
 * 
 * @package Architettura WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Radio box sanitization callback
 * 
 * @since 1.0.0
 */
function architettura_sanitize_radio( $input, $setting ) {

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
  
    //get the list of possible radio box options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default ); 
}

/**
 * Select sanitization callback
 * 
 * @since 1.0.0
 */
function architettura_sanitize_select( $input, $setting ){
          
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options 
    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
      
}

/**
 * Checkbox sanitization callabck
 * 
 * @since 1.0.0
 */
function architettura_sanitize_checkbox( $input ){
              
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}


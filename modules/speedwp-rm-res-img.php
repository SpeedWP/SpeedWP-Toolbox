<?php
/*
Module Name: Responsive Images deaktivieren
Module URI: Hilfe Link
Description: Responsive Images deaktivieren [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Responsive Images deaktivieren */

add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );
    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );
    return $attr;
 }, PHP_INT_MAX );
// Override the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );
// Override the calculated image sources
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );
// Remove the reponsive stuff from the content
remove_filter( 'the_content', 'wp_make_content_images_responsive' );
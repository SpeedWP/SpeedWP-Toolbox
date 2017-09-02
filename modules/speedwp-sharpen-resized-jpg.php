<?php
/*
Module Name: Alle JPG Grafiken nach der Grössenanpassung schärfen 
Module URI: Hilfe Link
Description: Alle JPG Grafiken nach der Grössenanpassung schärfen [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Alle JPG Grafiken nach der Grössenanpassung schärfen */

function speedwp_sharpen_resized_jpg( $resized_file ) {
    $image = wp_load_image( $resized_file );
    if ( !is_resource( $image ) )
        return new WP_Error( 'error_loading_image', $image, $file );
    $size = @getimagesize( $resized_file );
    if ( !$size )
        return new WP_Error('invalid_image', __('Could not read image size'), $file);
    list($orig_w, $orig_h, $orig_type) = $size;
    switch ( $orig_type ) {
        case IMAGETYPE_JPEG:
            $matrix = array(
                array(-1, -1, -1),
                array(-1, 16, -1),
                array(-1, -1, -1),
            );
            $divisor = array_sum(array_map('array_sum', $matrix));
            $offset   = 0;
            imageconvolution($image, $matrix, $divisor, $offset);
            imagejpeg($image, $resized_file,apply_filters( 'jpeg_quality', 90, 'edit_image' ));
            break;
        case IMAGETYPE_PNG:
            return $resized_file;
        case IMAGETYPE_GIF:
            return $resized_file;
    }
    return $resized_file;
}
add_filter('image_make_intermediate_size', 'speedwp_sharpen_resized_jpg',900);
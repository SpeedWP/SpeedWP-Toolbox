<?php
/*
Module Name: Post, Seiten und Medien ID anzeigen
Module URI: Hilfe Link
Description: Post, Seiten und Medien ID anzeigen lassen bei der Post oder Seiten Übersicht [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Anzeigen von Page und Post ID */

add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}


/** Anzeige der Medien ID */

function column_id($columns) {
    $columns['colID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'column_id' );
function column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'column_id_row', 10, 2 );

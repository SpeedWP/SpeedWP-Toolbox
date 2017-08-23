<?php
/*
Module Name: WordPress Suche deaktivieren 
Module URI: Hilfe Link
Description: WordPress Suche deaktivieren [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* WordPress Suche deaktivieren */

function ah_filter_query( $query, $error = true ) {

if ( is_search() ) {
$query->is_search = false;
$query->query_vars[s] = false;
$query->query[s] = false;

// to error
if ( $error == true )
$query->is_404 = true;
}
}

add_action( 'parse_query', 'ah_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );
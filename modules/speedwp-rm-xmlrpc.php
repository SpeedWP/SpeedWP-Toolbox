<?php
/*
Module Name: Die XML-RPC-Schnittstelle komplett abschalten
Module URI: Hilfe Link
Description: Die XML-RPC-Schnittstelle komplett abschalten [Frontend & Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Die XMLRPC-Schnittstelle komplett abschalten */

add_filter( 'xmlrpc_enabled', '__return_false' );

/* Den HTTP-Header vom XMLRPC-Eintrag bereinigen */

add_filter( 'wp_headers', 'speedwp_rm_x_pingback' );
 function speedwp_rm_x_pingback( $headers )
 {
 unset( $headers['X-Pingback'] );
 return $headers;
 }
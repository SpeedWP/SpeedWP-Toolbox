<?php
/*
Module Name: Lokales jQuery ersetzen mit jQuery vom Google CDN und aus dem Footer laden
Module URI: Hilfe Link
Description: Lokales jQuery ersetzen mit jQuery vom Google CDN und aus dem Footer laden. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Lokales jQuery ersetzen mit jQuery vom Google CDN und aus dem Footer laden */

add_action('wp_enqueue_scripts', 'speedwp_replace_jquery_google');
function speedwp_replace_jquery_google() {
      wp_deregister_script( 'jquery' );
}
 
add_action('wp_footer', 'speedwp_add_jquery_body');
function speedwp_add_jquery_body() {
      wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null);
      wp_enqueue_script( 'jquery');
}
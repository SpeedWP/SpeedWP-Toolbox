﻿<?php
/*
Module Name: WordPress Login Logo ändern
Module URI: Hilfe Link
Description: WordPress Login Logo ändern. Einfach aktivieren und im Plugin Verzeichnis /wp-content/plugins/speedwp-toolbox/img/login-logo.png 80x80px austauschen. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* WordPress Login Logo ändern */

add_action('wp_enqueue_scripts', 'speedwp_replace_jquery_google');
function speedwp_replace_jquery_google() {
      wp_deregister_script( 'jquery' );
}
 
add_action('wp_footer', 'speedwp_add_jquery_body');
function speedwp_add_jquery_body() {
      wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null);
      wp_enqueue_script( 'jquery');
}
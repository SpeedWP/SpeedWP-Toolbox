<?php
/*
Module Name: WordPress Atom/RSS Feed deaktivieren
Module URI: Hilfe Link
Description: WordPress Atom/RSS Feed deaktivieren [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* WordPress Atom/RSS Feed deaktivieren */

function speedwp_rm_feed() {
wp_die( __('Kein Feed verfügbar. Bitte besuchen Sie unsere <a href="'. get_bloginfo('url') .'">Startseite</a>!') );
}
 
add_action('do_feed', 'speedwp_rm_feed', 1);
add_action('do_feed_rdf', 'speedwp_rm_feed', 1);
add_action('do_feed_rss', 'speedwp_rm_feed', 1);
add_action('do_feed_rss2', 'speedwp_rm_feed', 1);
add_action('do_feed_atom', 'speedwp_rm_feed', 1);
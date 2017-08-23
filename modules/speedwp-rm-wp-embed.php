<?php
/*
Module Name: WordPress Embeds entfernen
Module URI: https://speedword.press/wissen/db/wp-embeds-blocken/
Description: WordPress Embeds, ergibt weniger Quellcode [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Remove WordPress Embeds */

function speedwp_rm_wp_embed() {
    wp_deregister_script('wp-embed'); }
add_action('init', 'speedwp_rm_wp_embed');

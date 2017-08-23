<?php
/*
Module Name: Hearbeat API komplett deaktivieren
Module URI: Hilfe Link
Description: Weniger Ajax Aktionen Sparen Leistung [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Hearbeat API komplett deaktivieren */

add_action('init', 'speedwp_rm_heartbeat', 1); function speedwp_rm_heartbeat() 	{ 	wp_deregister_script('heartbeat'); 	}






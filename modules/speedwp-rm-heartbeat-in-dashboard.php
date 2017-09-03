<?php
/*
Module Name: WordPress Heartbeat API nur im Dashboard deaktivieren
Module URI: Hilfe Link
Description: WordPress Heartbeat API nur im Dashboard deaktivieren [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* WordPress Heartbeat API nur im Dashboard deaktivieren */

add_action('init', 'stop_heartbeat', 1);
function stop_heartbeat()
	{
	global $pagenow;
	if ($pagenow == 'index.php') wp_deregister_script('heartbeat');
	}

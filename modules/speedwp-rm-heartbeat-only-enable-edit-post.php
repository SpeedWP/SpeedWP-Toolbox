<?php
/*
Module Name: Deaktivert die WordPress Heartbeat API überall, ausser beim bearbeiten eines Posts
Module URI: Hilfe Link
Description: Deaktivert die WordPress Heartbeat API überall, ausser beim bearbeiten eines Posts [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Deaktivert die WordPress Heartbeat API überall, ausser beim bearbeiten eines Posts */

add_action('init', 'speedwp_remove_heartbeat_only_post', 1);
function speedwp_remove_heartbeat_only_post()
	{
	global $pagenow;
	if ($pagenow != 'post.php' && $pagenow != 'post-new.php') wp_deregister_script('heartbeat');
	}







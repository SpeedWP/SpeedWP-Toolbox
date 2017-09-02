<?php
/*
Module Name: Blog Posts via Mail deaktivieren
Module URI: Hilfe Link
Description: Blog Posts via Mail deaktivieren [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Post via Mail deaktivieren */

add_filter('enable_post_by_email_configuration', '__return_false');

<?php
/*
Module Name: Länge des Anreissertext festlegen
Module URI: Hilfe Link
Description: Länge des Anreissertext auf Zeile 20 festlegen. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Länge des Anreissertext festlegen */

function new_excerpt_length($length) {
    return 300;
}
 
add_filter('excerpt_length', 'new_excerpt_length');
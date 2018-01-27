<?php
/*
Module Name: JavaScript in Footer
Description: Verfrachtet alles JavaScript in den Footer von WordPress [Frontend]
Author: Andreas Hecht
Author URI: https://gist.github.com/HechtMediaArts/7136323
*/

/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
  die();
}

/* Ab hier kann's los gehen */
function evolution_clean_head() {
  
	remove_action('wp_head', 'wp_print_scripts'); 
	remove_action('wp_head', 'wp_print_head_scripts', 9); 
	remove_action('wp_head', 'wp_enqueue_scripts', 1); 
}

add_action( 'wp_enqueue_scripts', 'evolution_clean_head' );
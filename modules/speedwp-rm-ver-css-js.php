<?php
/*
Module Name: Query String von CSS und JavaScript entfernen
Module URI: https://speedwp.tk/wissen/knowledge-base/290/
Description: Query String von CSS und JavaScript entfernen damit alle Caching Systeme die Dateiendungen interpretieren können. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Remove Query Strings */

function speedwp_rm_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'speedwp_rm_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'speedwp_rm_ver_css_js', 9999 );

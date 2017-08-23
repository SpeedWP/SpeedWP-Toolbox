<?php
/*
Module Name: WordPress Login Logo ändern
Module URI: Hilfe Link
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* WordPress Login Logo ändern */

function speedwp_replace_login_logo() { ?>
    <style>#login h1 a,.login h1 a{background-image:url('/wp-content/plugins/speedwp-toolbox/img/login-logo.png');padding-bottom:30px}</style>
<?php }
add_action( 'login_enqueue_scripts', 'speedwp_replace_login_logo' );
function speedwp_replace_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'speedwp_replace_login_url' );
function speedwp_replace_login_url_title() {
    return 'SpeedWord.Press - Performence Webdesign';
}
add_filter( 'login_headertitle', 'speedwp_replace_login_url_title' );

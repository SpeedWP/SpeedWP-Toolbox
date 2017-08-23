<?php
/*
Module Name: Zeigt ein Dashboard-Widget mit einer Liste der letzten Posts
Module URI: Hilfe Link
Description: Zeigt ein Dashboard-Widget mit einer Liste der letzten Posts [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Recent Post Dashboard */

function wps_recent_posts_dw() {
?>
   <ol>
     <?php
          global $post;
          $args = array( 'numberposts' => 5 );
          $myposts = get_posts( $args );
                foreach( $myposts as $post ) :  setup_postdata($post); ?>
                    <li> (<? the_date('Y / n / d'); ?>) <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endforeach; ?>
   </ol>
<?php
}
function add_wps_recent_posts_dw() {
       wp_add_dashboard_widget( 'wps_recent_posts_dw', __( 'Recent Posts' ), 'wps_recent_posts_dw' );
}
add_action('wp_dashboard_setup', 'add_wps_recent_posts_dw' );

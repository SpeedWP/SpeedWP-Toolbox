<?php
/*
Module Name: Google Analytics
Description: Hinzufügen vom Google-Analytics Code zum WordPress Theme. [Frontend]
Author: Andreas Hecht
Author URI: https://gist.github.com/HechtMediaArts/6257112
*/

/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
  die();
}

/* Ab hier kann's los gehen */
function ah_analytics_code() {
	?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXX-X']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php }

add_action( 'wp_footer', 'ah_analytics_code' );
<?php
/*
Module Name: Multifile Gist-Snippets
Module URI: https://dominikschilling.de/schnipsel/gist-wordpress-einbinden/
Description: Multifile Gist-Snippets [Frontend]
Author: Dominik Schilling
Author URI: http://ebiene.de
*/


/* Sicherheitsabfrage */
if ( !class_exists(Toolbox) ) {
	die();
}


/* Multifile Gist-Snippets */
function sm_related_posts() {
	/* Keine Kategorien */
	if ( ! $cat = get_the_category() ) {
		return;
	}

	/* IDs */
	$ids = implode(
		,,
		array_reduce(
			$cat,
			function($v, $w) {
				$v[] = $w->term_id;
				return $v;
			}
		)
	);

	/* Query starten */
	$query = new WP_Query(
		array(
			cat => $ids,
			orderby => rand,
			post__not_in => array(get_the_ID()),
			posts_per_page => 2
		)
	);

	/* Keine Ergebnisse */
	if ( ! $query->have_posts() ) {
		return;
	}

	/* Ausgabe */
	echo <ul id="related">;

	while ( $query->have_posts() ) {
		$query->the_post();

		echo sprintf(
			<li class="item"><a href="%s">%s%s</a></li>,
			get_permalink(),
			( function_exists(has_post_thumbnail) && has_post_thumbnail() ? get_the_post_thumbnail() : ),
			get_the_title()
		);
	}

	/* Reset */
	wp_reset_postdata();

	echo </ul>;
}

/* Funktionsaufruf */
add_action(
	related_posts,
	sm_related_posts
);

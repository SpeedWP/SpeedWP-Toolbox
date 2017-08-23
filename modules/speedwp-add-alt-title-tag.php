<?php
/*
Module Name: Alt- und Title-Tag für Bilder
Module URI: Hilfe Link
Description: Alt- und Title-Tag für Bilder werden automatisch anhand des Post Titels gesetzt. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** Alt- und Title-Tag für Bilder */

function add_alt_tags($content)
	{
	global $post;
	preg_match_all('/<img (.*?)\/>/', $content, $images);
	if (!is_null($images))
		{
		foreach($images[1] as $index => $value)
			{
			$new_img = str_replace('<img', '<img title="' . $post->post_title . '" alt="' . $post->post_title . '"', $images[0][$index]);
			$content = str_replace($images[0][$index], $new_img, $content);
			}
		}
	return $content;
	}
add_filter('post_thumbnail_html', 'add_alt_tags', 99999);	
add_filter('the_content', 'add_alt_tags', 99999);
add_filter(
	'jpeg_quality',
	'adjust_jpeg_quality'
);
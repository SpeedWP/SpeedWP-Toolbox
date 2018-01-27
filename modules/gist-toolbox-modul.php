<?php
/*
Module Name: Einbindung der Gist-Snippets
Module URI: http://playground.ebiene.de/gist-toolbox-modul/
Description: Abfrage und Darstellung der Gist-Snippets via [gist id=xxxx] Shortcode. [Frontend]
Author: Sergej Müller
Author URI: http://ebiene.de
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Gist */
class Gist
{


	/**
	* Initiator der Klasse
	*/

	public static function init()
	{
		add_action(
			'wp_enqueue_scripts',
			array(
				__CLASS__,
				'register_style'
			)
		);

		add_shortcode(
			'gist',
			array(
				__CLASS__,
				'handle_shortcode'
			)
		);
	}


	/**
	* Registrierung des CSS
	*/

	public static function register_style()
	{
		wp_register_style(
			'gist_css',
			'https://gist.github.com/stylesheets/gist/embed.css'
		);
	}


	/**
	* Verarbeitung des Shortcodes
	*
	* @param   array   $atts    Array mit Attributen
	* @param   string  $txt     Text zwischen den Tags [optional]
	* @return  string  $output  Ermittelter Gist-Quelltext
	*/

	public static function handle_shortcode($atts, $txt = null)
	{
		/* Leer? */
		if ( empty($atts['id']) ) {
			return 'No Gist ID.';
		}

		/* Init */
		$id = (int) $atts['id'];
		$transient = 'sm_gist_' .$id;

		/* Einbinden */
		wp_enqueue_style('gist_css');

		/* Im Cache */
		if ( $gist = get_transient($transient) ) {
			return $gist;
		}

		/* Abrufen */
		$response = wp_remote_get(
			'https://gist.github.com/' .$id. '.json',
			array('sslverify' => false)
		);

		/* Fehler? */
		if ( is_wp_error($response) ) {
			return $response->get_error_message();
		}

		/* Holen und parsen */
		$json = json_decode(
			wp_remote_retrieve_body($response)
		);

		/* Leer? */
		if ( empty($json->div) ) {
			return 'Empty Data.';
		}

		/* Zuweisen */
		$output = (string) $json->div;

		/* Cachen */
		set_transient(
			$transient,
			$output,
			60 * 60 * 24
		);

		return $output;
	}
}


/* Fire */
add_action(
	'init',
	array(
		'Gist',
		'init'
	)
);
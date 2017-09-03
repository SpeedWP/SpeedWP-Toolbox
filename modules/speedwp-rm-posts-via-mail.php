<?php
/*
Module Name: Prism Syntax Highlighter
Module URI: Hilfe Link
Description: Prism Syntax Highlighter - <p>Beispiel: <strong>&lt;pre&gt;&lt;code class="language-php"&gt;Dein Code&lt;/code&gt;&lt;/pre&gt;</strong></p> [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Prism Syntax Highlighter */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses	is_admin()
 * @uses	is_singular()
 * @uses	wp_enqueue_script()
 * @uses	plugins_url()
 *
 * @since 1.0.0
 */
if ( ! function_exists('ah_add_prism') ) {
// Make function pluggable    
function ah_add_prism() {
		if ( is_single() || is_page() ) {
			wp_enqueue_script( 'prism-js', plugins_url( 'js/prism.js', __FILE__ ), '', '', false );
			wp_enqueue_style( 'prism-css', plugins_url( 'css/prism.css', __FILE__ ) );
		}
    }
}
add_action( 'wp_enqueue_scripts', 'ah_add_prism' );



/**
 * We provide a small user guide for the Prism Highlighter under the Help button
 * @author Andreas Hecht
 */
function tb_contextual_help_prism( $contextual_help, $screen_id, $screen ) {

if ( 'post' == $screen->id ) {

$screen->add_help_tab( array(
'id' => 'syntax_highlighter',
'title' => __('Prism Highlighter'),
'content' => '<h2>How to use the Prism Highlighter</h2>
<h3>DE: Möglichkeit Nummer 1:</h3>
<p>Du hast den Code von einem <a href="https://gist.github.com/" target="_blank">Gist bei Github</a> bekommen. Dann kannst Du den Code direkt in den Visuellen Editor einfügen, WordPress umschließt den Code automatisch mit dem &lt;pre&gt; Element. Gehe im Anschluss daran in die Textansicht und füge dort hinter dem &lt;pre&gt; Element ein &lt;code class="language-xxx"&gt; hinzu. XXX steht für den Code, den es zu highlighten gilt. Unterstützt werden <strong>markup (html), css, php und javascript</strong>. Vergiss nicht, dass vor dem schließenden &lt;/pre&gt; ebenfalls ein schließendes &lt;/code&gt; gehört. Ist dies erledigt, kannst Du bereits wieder in die visuelle Ansicht des Editors wechseln.</p><p>Beispiel: <strong>&lt;pre&gt;&lt;code class="language-php"&gt;Dein Code&lt;/code&gt;&lt;/pre&gt;</strong></p>
<h3>DE: Möglichkeit Nummer 2:</h3>
<p>Dein Code stammt aus Deinem HTML-Editor (wie z.B. Brackets, Atom, Dreamweaver). Dann klicke in der visuellen Ansicht zuerst auf »Vorvormatiert« und füge den Code dann ein. Wechsle im Anschluss daran dann in die Textansicht und ergänze dort wie bei Möglichkeit eins das Code-Element mit der Language-Klasse.</p><p>Beispiel: <strong>&lt;pre&gt;&lt;code class="language-php"&gt;Dein Code&lt;/code&gt;&lt;/pre&gt;</strong></p>',
        ));     
    }
}
add_action( 'contextual_help', 'tb_contextual_help_prism', 10, 3 );
   

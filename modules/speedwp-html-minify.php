<?php
/*
Module Name: HTML Minify, Inline CSS Minify und Inline JavaScript Minify
Module URI: https://speedwp.tk/wissen/knowledge-base/290/
Description: HTML Minify, Inline CSS Minify und Inline JavaScript Minify. Bitte Info Link beachten. [Frontend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/** HTML Minify, Inline CSS Minify und Inline JavaScript Minify  */

class WP_HTML_Compression {
    protected $compress_css = true;
    protected $compress_js = false;
    protected $info_comment = true;
    protected $remove_comments = true;
 
    protected $html;
    public function __construct($html) {
      if (!empty($html)) {
		    $this->parseHTML($html);
	    }
    }
    public function __toString() {
	    return $this->html;
    }
    protected function bottomComment($raw, $compressed) {
	    $raw = strlen($raw);
	    $compressed = strlen($compressed);		
	    $savings = ($raw-$compressed) / $raw * 100;		
	    $savings = round($savings, 2);		
	    return '<!-- HTML Minify | Größe reduziert um '.$savings.'% | Von '.$raw.' Bytes, auf '.$compressed.' Bytes -->';
    }
    protected function minifyHTML($html) {
	    $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
	    preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
	    $overriding = false;
	    $raw_tag = false;
	    $html = '';
	    foreach ($matches as $token) {
		    $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
		    $content = $token[0];
		    if (is_null($tag)) {
			    if ( !empty($token['script']) ) {
				    $strip = $this->compress_js;
			    }
			    else if ( !empty($token['style']) ) {
				    $strip = $this->compress_css;
			    }
			    else if ($content == '<!--wp-html-compression no compression-->') {
				    $overriding = !$overriding;
				    continue;
			    }
			    else if ($this->remove_comments) {
				    if (!$overriding && $raw_tag != 'textarea') {
					    $content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
				    }
			    }
		    }
		    else {
			    if ($tag == 'pre' || $tag == 'textarea') {
				    $raw_tag = $tag;
			    }
			    else if ($tag == '/pre' || $tag == '/textarea') {
				    $raw_tag = false;
			    }
			    else {
				    if ($raw_tag || $overriding) {
					    $strip = false;
				    }
				    else {
					    $strip = true;
					    $content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
					    $content = str_replace(' />', '/>', $content);
				    }
			    }
		    }
		    if ($strip) {
			    $content = $this->removeWhiteSpace($content);
		    }
		    $html .= $content;
	    }
	    return $html;
    }
    public function parseHTML($html) {
	    $this->html = $this->minifyHTML($html);
	    if ($this->info_comment) {
		    $this->html .= "\n" . $this->bottomComment($html, $this->html);
	    }
    }
    protected function removeWhiteSpace($str) {
	    $str = str_replace("\t", ' ', $str);
	    $str = str_replace("\n",  '', $str);
	    $str = str_replace("\r",  '', $str);
	    while (stristr($str, '  ')) {
		    $str = str_replace('  ', ' ', $str);
	    }
	    return $str;
    }
}
function wp_html_compression_finish($html) {
    return new WP_HTML_Compression($html);
}
function wp_html_compression_start() {
    ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');

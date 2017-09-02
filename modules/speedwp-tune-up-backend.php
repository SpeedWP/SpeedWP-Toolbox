<?php
/*
Module Name: Post, Seiten und Medien ID anzeigen
Module URI: Hilfe Link
Description: Post, Seiten und Medien ID anzeigen lassen bei der Post oder Seiten Übersicht [Backend]
Author: Daniel Bieli
Author URI: https://speedword.press
*/


/* Sicherheitsabfrage */
if ( !class_exists('Toolbox') ) {
	die();
}


/* Anzeigen von Page und Post ID */

add_filter('manage_posts_columns', 'posts_columns_id', 5);
add_action('manage_posts_custom_column', 'posts_custom_id_columns', 5, 2);
add_filter('manage_pages_columns', 'posts_columns_id', 5);
add_action('manage_pages_custom_column', 'posts_custom_id_columns', 5, 2);
function posts_columns_id($defaults){
    $defaults['wps_post_id'] = __('ID');
    return $defaults;
}
function posts_custom_id_columns($column_name, $id){
        if($column_name === 'wps_post_id'){
                echo $id;
    }
}


/* Anzeige der Medien ID */

function column_id($columns) {
    $columns['colID'] = __('ID');
    return $columns;
}
add_filter( 'manage_media_columns', 'column_id' );
function column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'column_id_row', 10, 2 );


/* Anzeige aller Custom Fields */

add_action( 'all_admin_notices', 'speedwp_show_all_custom_fields' );
function speedwp_show_all_custom_fields() {
    if ( isset( $_GET['post'] ) ) {
        $post_id = absint( $_GET['post'] );
        ?>
        <div id="message" class="updated">
            <h3>Alle Post Meta Daten:</h3>
            <xmp><?php print_r( get_post_meta( $post_id ) ); ?></xmp>
        </div>
        <?php
    }
}


/* Anzeigen der Anzahl Medienanhänge per Post */

add_filter('manage_posts_columns', 'posts_columns_attachment_count', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns_attachment_count', 5, 2);
function posts_columns_attachment_count($defaults){
    $defaults['speedwp_count_post_attachments'] = __('Medien');
    return $defaults;
}
function posts_custom_columns_attachment_count($column_name, $id){
        if($column_name === 'speedwp_count_post_attachments'){
        $attachments = get_children(array('post_parent'=>$id));
        $count = count($attachments);
        if($count !=0){echo $count;}
    }
}


/* Füge eine rel="nofollow" Checkbox zum Link Editor hinzu */

add_action( 'after_wp_tiny_mce', function(){
	?>
	<script>
		var originalWpLink;
		// Ensure both TinyMCE, underscores and wpLink are initialized
		if ( typeof tinymce !== 'undefined' && typeof _ !== 'undefined' && typeof wpLink !== 'undefined' ) {
			// Ensure the #link-options div is present, because it's where we're appending our checkbox.
			if ( tinymce.$('#link-options').length ) {
				// Append our checkbox HTML to the #link-options div, which is already present in the DOM.
				tinymce.$('#link-options').append(<?php echo json_encode( '<div class="link-nofollow"><label><span></span><input type="checkbox" id="wp-link-nofollow" /> Add rel="nofollow" to link</label></div>' ); ?>);
				// Clone the original wpLink object so we retain access to some functions.
				originalWpLink = _.clone( wpLink );
				wpLink.addRelNofollow = tinymce.$('#wp-link-nofollow');
				// Override the original wpLink object to include our custom functions.
				wpLink = _.extend( wpLink, {
					/**
					 * Fetch attributes for the generated link based on
					 * the link editor form properties.
					 *
					 * In this case, we're calling the original getAttrs()
					 * function, and then including our own behavior.
					 */
					getAttrs: function() {
						var attrs = originalWpLink.getAttrs();
						attrs.rel = wpLink.addRelNofollow.prop( 'checked' ) ? 'nofollow' : false;
						return attrs;
					},
					/**
					 * Build the link's HTML based on attrs when inserting
					 * into the text editor.
					 *
					 * In this case, we're completely overriding the existing
					 * function.
					 */
					buildHtml: function( attrs ) {
						var html = '<a href="' + attrs.href + '"';

						if ( attrs.target ) {
							html += ' target="' + attrs.target + '"';
						}
						if ( attrs.rel ) {
							html += ' rel="' + attrs.rel + '"';
						}
						return html + '>';
					},
					/**
					 * Set the value of our checkbox based on the presence
					 * of the rel='nofollow' link attribute.
					 *
					 * In this case, we're calling the original mceRefresh()
					 * function, then including our own behavior
					 */
					mceRefresh: function( searchStr, text ) {
						originalWpLink.mceRefresh( searchStr, text );
						var editor = window.tinymce.get( window.wpActiveEditor )
						if ( typeof editor !== 'undefined' && ! editor.isHidden() ) {
							var linkNode = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );
							if ( linkNode ) {
								wpLink.addRelNofollow.prop( 'checked', 'nofollow' === editor.dom.getAttrib( linkNode, 'rel' ) );
							}
						}
					}
				});
			}
		}
	</script>
	<style>
	#wp-link #link-options .link-nofollow {
		padding: 3px 0 0;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	#wp-link #link-options .link-nofollow label span {
		width: 83px;
	}

	.has-text-field #wp-link .query-results {
		top: 223px;
	}
	</style>
	<?php
});

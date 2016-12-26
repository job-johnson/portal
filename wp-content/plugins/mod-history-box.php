<?php
/*
 * Plugin Name: Mod History
 * Description: Metabox to display modification history
 * Version: 1.0
 * Author: Afreen Khwaja
 */

/**
 * Adds a meta box to the post editing screen
 */
function history_custom_meta($post) {
	add_meta_box ( 'history_meta', __ ( 'Modification history', 'history-textdomain' ), 'history_meta_callback', 'article' );
}
/**
 * Outputs the content of the meta box
 */
function history_meta_callback($post) {
	$history = wp_get_post_revisions ( $post );

	echo "<table class='widefat'><thead><tr><th style='width:20%'>Modified by</th>
            <th>Date</th></tr></thead><tfoot><tr><th style='width:20%'>Modified by</th>
             <th>Date</th></tr></tfoot><tbody>";
	foreach ( $history as $rkey => $revision ) {

		$author = get_the_author_meta ( "display_name", $revision->post_author );

		echo "<tr><td>" . $author . "</td><td>" . $revision->post_date . "</td></tr>";
	}
	echo "</tbody></table>";
}
add_action ( 'add_meta_boxes', 'history_custom_meta' );
function remove_revision_box() {
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		remove_meta_box('revisionsdiv', $post_type, 'normal');
	}
}
add_action ( 'admin_menu', 'remove_revision_box' );
add_action('add_meta_boxes', 'change_meta_box_titles');
function change_meta_box_titles() {
	global $wp_meta_boxes; // array of defined meta boxes
	// cycle through the array, change the titles you want
	$post_types = get_post_types();
	foreach ( $post_types as $post_type ) {
		$wp_meta_boxes[$post_type]['normal']['core']['authordiv']['title']= 'Editing Author';
	}

}
?>

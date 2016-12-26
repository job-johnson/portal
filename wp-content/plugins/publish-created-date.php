<?php
/*
 * Plugin Name: Publish Created Date
 * Description: Store and display post created date
 * Version: 1.0
 * Author: Afreen Khwaja
 * Plugin URI: https://trepmal.com/2011/03/28/add-post-options-to-publish-meta-box/
 */
add_action ( 'post_submitbox_misc_actions', 'created_date_cust' );
add_action ( 'save_post', 'save_created_date' );
function created_date_cust() {
	$postTypes = array('article');

	global $post;
	if (in_array(get_post_type ( $post ), $postTypes)) {
		date_default_timezone_set ( 'Asia/Dubai' );
		wp_nonce_field ( plugin_basename ( __FILE__ ), 'created_date_cust_nonce' );
		$currval = get_post_meta ( $post->ID, 'wpcf-created-date', true ) ? get_post_meta ( $post->ID, 'wpcf-created-date', true ) : '';
		$created = $currval ? date ( "M j, Y @ g:i", $currval ) : date ( 'M j, Y @ g:i' );
		echo '<div class="misc-pub-section curtime misc-pub-curtime"><span id="timestamp">Created on:<input type="text" name="created_date_cust" id="create-date-cust-meta" value="' . $created . '" readonly></span></div>';
	}
}
function save_created_date($post_id) {
	$postTypes = array('article');

	// print_r ( '<pre>' );
	// print_r ( $_POST ['created_date_cust'] . "<br/>");
	if (! isset ( $_POST ['post_type'] ))
		return $post_id;

	if (! wp_verify_nonce ( $_POST ['created_date_cust_nonce'], plugin_basename ( __FILE__ ) ))
		return $post_id;

	if (defined ( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
		return $post_id;

	if (in_array($_POST ['post_type'], $postTypes) && !current_user_can ( 'edit_post', $post_id ))
		return $post_id;

	if (! isset ( $_POST ['created_date_cust'] ))
		return $post_id;
	else {

		$bool = get_post_meta ( $post_id, 'wpcf-created-date', true );

		if ($bool == "") {
			// die('in update');
			date_default_timezone_set ( 'Asia/Dubai' );
			$val = str_replace ( "@", "", $_POST ['created_date_cust'] );
			$mydata = strtotime ( $val );
			update_post_meta ( $post_id, 'wpcf-created-date', $mydata, $bool );
		}
		// die ( 'fhvjhfvb' );
	}
}

?>

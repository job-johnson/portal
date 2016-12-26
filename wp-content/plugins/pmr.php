<?php
/*
 * Plugin Name: Post Meta Revisions
 * Description: Revisions for the 'foo' post meta field
 * Version: 1.0
 * Author: John Blackbourn
 * Plugin URI: http://lud.icro.us/post-meta-revisions-wordpress
 */
function pmr_fields($fields) {
	$fields ['wpcf-short-title'] = 'Short title';
	$fields ['wpcf-slug'] = 'Slug';
	$fields ['wpcf-is-featured'] = 'Is featured';
	$fields ['wpcf-is-sponsored'] = 'Is Sponsored';
	$fields ['wpcf-author'] = 'Author';
	$fields ['wpcf-short-descrip'] = 'Short Description';
	$fields ['wpcf-long-descrip'] = 'Long Description';
	$fields ['wpcf-has-external-url'] = 'Has External URL';
	$fields ['wpcf-external-url'] = 'External URL';
	$fields ['wpcf-media-type'] = 'Media type';
	$fields ['wpcf-image'] = 'Image';
	$fields ['wpcf-video'] = 'Video';
	$fields ['wpcf-embed'] = 'Embed';
	$fields ['wpcf-media-title'] = 'Media title';
	$fields ['wpcf-media-descrip'] = 'Media Description';
	$fields ['wpcf-media-alt-text'] = 'Media Alt Text';
	$fields ['_expiration-date'] = 'Short title';
	$fields ['_yoast_wpseo_focuskw'] = 'Seo focus keyword';
	$fields ['_yoast_wpseo_metadesc'] = 'Seo meta description ';	
	return $fields;
}
function pmr_restore_revision($post_id, $revision_id) {
	$post = get_post ( $post_id );
	$revision = get_post ( $revision_id );
	$meta = get_metadata ( 'post', $revision->ID, 'foo', true );
	
	if (false === $meta)
		delete_post_meta ( $post_id, 'foo' );
	else
		update_post_meta ( $post_id, 'foo', $meta );
}
function pmr_field($value, $field) {
	global $revision;
	return get_metadata ( 'env-pollution', $revision->ID, $field, true );
}
function pmr_save_post($post_id, $post) {
	if ($parent_id = wp_is_post_revision ( $post_id )) {
		$parent = get_post ( $parent_id );
		$meta = get_post_meta ( $parent->ID, 'foo', true );
		if (false !== $meta)
			add_metadata ( 'post', $post_id, 'foo', $meta );
	}
}
// add_filter ( '_wp_post_revision_fields', 'pmr_fields' );
// add_action ( 'save_post', 'pmr_save_post' );
// add_action( 'wp_restore_post_revision', 'pmr_restore_revision', 10, 2 );
// add_filter( '_wp_post_revision_fields', 'pmr_fields' );
?>
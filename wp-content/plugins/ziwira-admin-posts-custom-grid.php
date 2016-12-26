<?php
/*
 * Plugin Name: Admin posts grid custom
 * Description: Display author filter
 * Version: 1.0
 * Author: Ziwira
 */

/** add action hook and add filter hooks for is feed on all post type **/
//global $post;
add_action( 'manage_posts_custom_column' , 'custom_fields_column',5, 2);
add_filter('manage_posts_columns','is_feed_posts_columns');

function custom_fields_column($column_name, $post_id) {
	
	//print_r($column_name);
	//$column_name['wpcf-is-feed'] = "----";
	//$postFeed = get_post_meta( $post_id, 'wpcf-is-feed', true );
	//$feed = ($postFeed == 1) ? "Yes" : "No";
	//return array_merge($column_name,
		//	array('wpcf-is-feed' => 'ISBN'));
	
	switch($column_name)
	{
		case 'wpcf-is-feed':
			$postMedia = get_post_meta( $post_id, 'wpcf-is-feed', true );
			//print_r($postMedia);
			if($postMedia)
			{
				echo "Yes";
			}
			else{
				echo "No";
			}
			break;
	}
}

function is_feed_posts_columns($columns){
	$columns['wpcf-is-feed'] = esc_html__('Is Feed');
	return $columns;
}

//defining the filter that will be used so we can select posts by 'author'
function add_author_filter_to_posts_administration(){

    //execute only on the 'post' content type
    global $post_type;
    //print_r($post_type);die();
    if($post_type != 'post' && $post_type != 'page'){

        //get a listing of all users that are 'author' or above
        $user_args = array(
            'show_option_all'   => 'All Users',
            'orderby'           => 'display_name',
            'order'             => 'ASC',
            'name'              => 'aurthor_admin_filter',
            'who'               => 'authors',
            'include_selected'  => true
        );

        //determine if we have selected a user to be filtered by already
        if(isset($_GET['aurthor_admin_filter'])){
            //set the selected value to the value of the author
            $user_args['selected'] = (int)sanitize_text_field($_GET['aurthor_admin_filter']);
        }

        //display the users as a drop down
        wp_dropdown_users($user_args);
        //print_r(wp_dropdown_users($user_args));die();
    }

}
add_action('restrict_manage_posts','add_author_filter_to_posts_administration');

//restrict the posts by an additional author filter
function add_author_filter_to_posts_query($query){
	
    global $post_type, $pagenow; 

    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php'){
    	//print_r($query);
        if(isset($_GET['aurthor_admin_filter'])){

            //set the query variable for 'author' to the desired value
            $author_id = sanitize_text_field($_GET['aurthor_admin_filter']);

            //if the author is not 0 (meaning all)
            //print_r($author_id);die();
            if($author_id != 0){
                $query->query_vars['author'] = $author_id;
            }

        }
    }
}

add_action('pre_get_posts','add_author_filter_to_posts_query');


//FEED filter

add_action( 'restrict_manage_posts', 'wp_admin_posts_filter_restrict_manage_posts' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 *
 * @author Ohad Raz
 *
 * @return void
 */
function wp_admin_posts_filter_restrict_manage_posts(){
	$type = 'post';
	if (isset($_GET['post_type'])) {
		$type = $_GET['post_type'];
	}

	//only add filter to post type you want
	if ('post' != $type && 'page' != $type){
		//unset($_GET['admin_filter_field_feed']);
		//change this to the list of values you want to show
		//in 'label' => 'value' format
		
		if (trim($_GET['admin_filter_field_feed']) == "all") {
			$current_v1 = 'All data types';
		}elseif ($_GET['admin_filter_field_feed'] == 1) {
			$current_v1 = (int)1;
		}elseif ($_GET['admin_filter_field_feed'] == 0) {
			$current_v1 = (int)0;
		}
		 
		$typevalues = array(
				'All data types'=> 'all',
				'Feed data' => (int)1,
				'Other data' => (int)0,
		);
		
		/*
		print_r('<pre>');
		print_r('current v'.$current_v1);
		print_r($typevalues);
		*/
			
        echo '<select name="admin_filter_field_feed">';
       
            foreach ($typevalues as $label => $value) {
                printf('<option value="%s"%s>%s</option>', $value,($value === $current_v1 ? ' selected="selected"':''),$label);
            }
        
        echo "</select>";
        
    }
}


add_filter( 'parse_query', 'wp_posts_filter' );
/*
 * if submitted filter by post meta
 * 
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 * 
 * @return Void
 */
function wp_posts_filter( $query ){
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    if ( 'post' != $type && 'page' != $type  && $pagenow=='edit.php' && isset($_GET['admin_filter_field_feed']) && $_GET['admin_filter_field_feed'] != 'all') {
        $query->query_vars['meta_key'] = 'wpcf-is-feed';
        $query->query_vars['meta_value'] = $_GET['admin_filter_field_feed'];
    }
}



/****************Feed name filter**********/

add_action( 'restrict_manage_posts', 'wp_admin_posts_filter_restrict_posts_feedname' );
/**
 * First create the dropdown
 * make sure to change POST_TYPE to the name of your custom post type
 *
 * @author Ohad Raz
 *
 * @return void
 */
function wp_admin_posts_filter_restrict_posts_feedname(){
	global $wpdb;
	$type = 'post';
	if (isset($_GET['post_type'])) {
		$type = $_GET['post_type'];
	}

	//only add filter to post type you want
	if ('post' != $type && 'page' != $type){
		//unset($_GET['admin_filter_field_feed']);
		//change this to the list of values you want to show
		//in 'label' => 'value' format
		$pt = $wpdb->get_results( $wpdb->prepare ("SELECT DISTINCT meta_value FROM $wpdb->postmeta pm
				JOIN $wpdb->posts p ON p.ID = pm.post_id
				WHERE pm.meta_key = 'wpcf-feed-name' AND p.post_type = %s", $type));
		
		$options["All Feeds"] = '0';
		foreach($pt as $key => $val) {
			$options[$val->meta_value] = $val->meta_value;
		}
		
		if (trim($_GET['admin_filter_field_feedname']) == '0') {
			$current_v = 'All Feeds';
			//print_r('in alllll');
		}
		else {
			$current_v = $_GET['admin_filter_field_feedname'];
		}
		$values = $options;
		/*
		 print_r('<pre>');
		 print_r($options);
		 print_r('current v'.$current_v);*/
        echo '<select name="admin_filter_field_feedname">';
            foreach ($values as $label => $value) {
                printf('<option value="%s"%s>%s</option>', $value,($value == $current_v ? ' selected="selected"':''),$label);
            }
       echo  "</select>"; 
    }
}


add_filter( 'parse_query', 'wp_posts_filter_feedname' );
/*
 * if submitted filter by post meta
 * 
 * make sure to change META_KEY to the actual meta key
 * and POST_TYPE to the name of your custom post type
 * @author Ohad Raz
 * @param  (wp_query object) $query
 * 
 * @return Void
 */
function wp_posts_filter_feedname( $query ){
	
	//print_r('<pre>');
    global $pagenow;
    $type = 'post';
    if (isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
    }
    //print_r($_GET['admin_filter_field_feedname']);die();
    
    if ( 'post' != $type && 'page' != $type && $pagenow=='edit.php' &&
    		isset($_GET['admin_filter_field_feedname']) && $_GET['admin_filter_field_feedname'] != "0") {
    	$query->query_vars['meta_key'] = 'wpcf-feed-name';
        $query->query_vars['meta_value'] = $_GET['admin_filter_field_feedname'];
        //print_r($query);die();
    }else {
    	//unset($_GET['admin_filter_field_feedname']);
    	//print_r($query->query_vars);die();
    }
}
<?php

/**
 * Plugin Name: Ziwira Guardian News Feed
 * Plugin URI: http://ziwira.com
 * Description: Import articles from Guardian to Wordpress in posts
 * Author: Syed
 * Version: 1.0
 * Author URI: 
 */
add_action('admin_menu', 'ziwira_feed_admin_menu');

function ziwira_feed_admin_menu() {
    add_menu_page('Config', 'Ziwira Feeds', 'manage_options', 'ziwira-guardian-news-import/admin/feed-menu-page.php', 'feed_admin_page', plugins_url('ziwira-guardian-news-import/images/ziwira.ico'), 6);
    //add_submenu_page( 'syed-continents-based-regions/admin/syed-menu-page.php', 'Continents', 'Continents', 'manage_options', 'myplugin/myplugin-admin-sub-page.php', 'syed_admin_sub_page' );
    add_submenu_page("post.php", __("Ziwira Guardian News Feed"), __("Ziwira Guardian News Feed"), 3, __FILE__, "guradian_post_type_settings");

    $postTypes = get_option('ziwira_guradian_enabled_post_types');
    if ($postTypes !== false) {
        $json_decode = json_decode($postTypes);
        foreach ($json_decode as $postType) {
            add_submenu_page("edit.php?post_type=$postType", __("Ziwira Guardian News Feed"), __("Ziwira Guardian News Feed"), 'edit_posts', basename(__FILE__), 'guradian_post_type_settings');
        }
    }
}

function guradian_post_type_settings() {

    include('templates/feed-post-type-settings.php');
   //echo strtotime(date( 'Y-m-d H:i',current_time( 'timestamp', 0)));
   // echo "asdas"; wp_die();
    if (!empty($_POST)) {
        $keyWords = (isset($_POST['guardian_serachable_keywords']) ? $_POST['guardian_serachable_keywords'] : '');
        if ($screen->id == 'posts_page_ziwira-guardian-news-import/ziwira-guardian-news-import')
            $savedPostTypesC['post'] = $keyWords;
        else
            $savedPostTypesC[$postType] = $keyWords;

       //     echo "<pre>"; print_r(get_post());wp_die();
        syncGuardian($savedPostTypesC);wp_die();
        setOption($postTypeOption, $savedPostTypesC);


        echo '<script>location.reload();</script>';
        //syncGuardian($savedPostTypesC);
    }
}

function feed_admin_page() {
    include('templates/feed-admin-menu-page.php');

    if (!empty($_POST)) {
        $posttypes = (isset($_POST['posttypes']) ? $_POST['posttypes'] : '');
        $apiKey = (isset($_POST['guardian_api_key']) ? $_POST['guardian_api_key'] : '');
        $cronScheduler = (isset($_POST['cronschedcule']) ? $_POST['cronschedcule'] : '');
        $json_postTypes = json_encode($posttypes);
        setOption('ziwira_guradian_enabled_post_types', $json_postTypes);
        setOption('ziwira_guardian_api_key', $apiKey);
        setOption('ziwira_guardian_cron_scheduler', $cronScheduler);
        echo '<script>location.reload();</script>';
    }
}

function setOption($optionName, $optionValue) {
    if (!get_option($optionName)) {
        $deprecated = null;
        $autoload = 'no';
        add_option($optionName, $optionValue, $deprecated, $autoload);
    } else {
        update_option($optionName, $optionValue);
    }
}

function syncGuardian($searchpostTypeArray) {

    foreach ($searchpostTypeArray as $postType => $searchterm) {
        $removeSpace = str_replace(" ", '%20', $searchterm);
        $AddOr = str_replace(",", '%20OR%20', $removeSpace);

        //  wp_die();
        // $original_url = 'http://content.guardianapis.com/search?q="Fresh%20Water"%20OR%20Rivers%20OR%20Lakes%20OR%20"Ground%20Water"%20OR%20Irrigation%20OR%20Drinking%20OR%20parched%20OR%20drought&show-fields=all&api-key=wy9rdm87btmckmkucdz2byvq';
        $original_url = 'http://content.guardianapis.com/search?q=' . $AddOr . '&show-fields=all&order-by=newest&api-key=' . get_option('ziwira_guardian_api_key');

        //$original_url =  'http://content.guardianapis.com/search?&api-key=wy9rdm87btmckmkucdz2byvq&format=json&show-fields=headline,standfirst,trail-text,thumbnail,byline&show-tags=keyword&order-by=newest&page=2';

        $data = wp_remote_retrieve_body(wp_remote_get($original_url));
        $json = json_decode($data);
        $data = $json->response->results;
        
        foreach ($data as $result) {


            $image = strip_tags($result->fields->main, '<img>');
            preg_match('/(src=["\'](.*?)["\'])/', $image, $match);  //find src="X" or src='X'
            $split = preg_split('/["\']/', $match[0]); // split by quotes

            $src = $split[1]; // X between quotes
            $title = $result->webTitle;
            $body = $result->fields->body;
            $thumbnail = $result->fields->thumbnail;
            $imageSrc = $src;
            $author = $result->fields->byline;
            $lastModified = $result->fields->lastModified;
            insertPost($title, $body, $postType, $author, $lastModified, $imageSrc);
        }
    }
}

function insertPost($title, $content, $postType, $author, $lastModified, $imageSrc) {

    $currentTimeUnix = strtotime(date( 'Y-m-d H:i',current_time( 'timestamp', 0)));
    $page = get_page_by_title($title, OBJECT, $postType);
    if ($page == null) {

        global $user_ID;
        $new_post = array(
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'draft',
            'post_date' => $lastModified,
            'post_author' => $user_ID,
            'post_type' => $postType,
            'comment_status' => 'closed'
        );
        $post_id = wp_insert_post($new_post);
        update_post_meta($post_id, 'wpcf-author', $author);
        update_post_meta($post_id, 'wpcf-image', $imageSrc);
        add_post_meta($post_id,'guardian_post_date',$currentTimeUnix);
        add_post_meta($post_id,'is_guardian_feed',1);

        setOption('ziwira_'.$postType.'_synced_date',$currentTimeUnix);
    }
    return $post_id;
}

register_activation_hook(__FILE__, 'ziwira_guardian_news_activation');

function ziwira_guardian_news_activation() {

    $customArgs = array(
        'public' => true,
        'exclude_from_search' => false,
        '_builtin' => false
    );
    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    $CustomPost_types = get_post_types($customArgs, $output, $operator);
    $bothPostTypes = array_merge(array('post' => 'post'), $CustomPost_types);
    foreach ($bothPostTypes as $key => $postTypes) {
        $fileteredPostTypes[$key] = 'none';
    }
    if (!get_option('ziwira_guardian_post_type_search')) {
        add_option('ziwira_guardian_post_type_search', $fileteredPostTypes, null, 'no');
    }
    wp_schedule_event(time(), 'everyminute', 'ziwira_guardian_daily_event');
}

add_action('ziwira_guardian_daily_event', 'sync_guardian_news_hourly');

function sync_guardian_news_hourly() {
     $savedPostTypesC = get_option('ziwira_guardian_post_type_search');
    // syncGuardian($savedPostTypesC);
    //update_post_meta(143, 'wpcf-author', 'azhar quazi');
}

register_deactivation_hook(__FILE__, 'ziwira_guardian_news_deactivation');

function ziwira_guardian_news_deactivation() {
    wp_clear_scheduled_hook('ziwira_guardian_daily_event');
}

// add custom interval
function cron_add_minute($schedules) {
    // Adds once every minute to the existing schedules.
    $schedules['everyminute'] = array(
        'interval' => 60,
        'display' => __('Once Every Minute')
    );
    return $schedules;
}

add_filter('cron_schedules', 'cron_add_minute');
?>
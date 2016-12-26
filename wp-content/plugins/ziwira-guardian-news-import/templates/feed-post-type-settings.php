<?php
$postType = $_GET['post_type'];
//echo "<pre>"; print_r($_GET);
 $screen = get_current_screen();
$postTypeOption = 'ziwira_guardian_post_type_search';
$savedPostTypesC = get_option($postTypeOption);

$args = array(
	'posts_per_page'   => 10,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => 'is_guardian_feed',
	'meta_value'       => 1,
        'meta_key'         => 'guardian_post_date',
	'meta_value'       => get_option('ziwira_'.$postType.'_synced_date'),
	'post_type'        => 'test-post-type',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'post_status'      => 'draft | publish',
	'suppress_filters' => true
);
$posts_array = get_posts( $args );

//echo "<pre>"; print_r($posts_array);
?>

<div class="wrap">
    <h1>Ziwira Feeds Post Type Configuration</h1>

    <form name="form" action="<?php admin_url('?page=ziwira-guardian-news-import%2Fadmin%2Ffeed-admin-menu-page.php') ?>" method="post">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="496c4a6128892"><input type="hidden" name="_wp_http_referer" value="/wordpress/wp-admin/options-permalink.php">
        <p>Guardian Feeds Configuration</p>

        <h3 class="title"></h3>
        <table class="form-table">
            <tbody><tr>
                    <th><label for="api_key">Guardian Feeds Key Words</label></th>
                    <td> <input name="guardian_serachable_keywords" id="keywords" type="text" value="<?php
if ($screen->id == 'posts_page_ziwira-guardian-news-import/ziwira-guardian-news-import'){
    echo $savedPostTypesC['post'];
} else {
    echo $savedPostTypesC[$postType];
} ?>" class="regular-text code"></td>
            <span style="color:red">Please add feeds keywords with comma seprated for current post type. Ex(Fresh Water, Ground Water,Green)</span>
            </tr>
           
            
            </tbody></table>

        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>  </form>
   
    
    <h2><label for="api_key">Last synced on: <b><?php $date = get_option('ziwira_'.$postType.'_synced_date'); echo date( 'Y-m-d',$date);?></b</label></h2>
                    
           
        <table class="wp-list-table widefat fixed striped posts">
	<thead>
	<tr>
    <th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><a href=""><span>Title</span><span class="sorting-indicator"></span></a></th>
    <th scope="col" id="date" class="manage-column column-date sortable asc"><a href=""><span>Image</span><span class="sorting-indicator"></span></a></th>
    <th scope="col" id="date" class="manage-column column-date sortable asc"><a href=""><span>Date</span><span class="sorting-indicator"></span></a></th>

        </tr>
	</thead>

	<tbody id="the-list">
            <?php            foreach ($posts_array as $postsObject):?>

       <tr id="<?php echo "post-".$postsObject->ID;?>" class="iedit author-self level-0 type-test-post-type status-draft hentry">
			<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
                            <strong>
                                <a class="row-title" href="<?php echo get_edit_post_link($postsObject->ID);?>" title=" <?php echo $postsObject->post_title;?>">
                                    <?php echo $postsObject->post_title;?> </a> -
                                    <span class="post-state"><?php echo ucfirst($postsObject->post_status);?></span>
                            </strong>
<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
</td>
<td class="date column-date"><img width="100" height="100"src="<?php echo get_post_meta($postsObject->ID,'wpcf-image',true); ?>"></td>
<td class="date column-date" data-colname="Date">
    <abbr title=""><?php echo date('Y-m-d H:i',get_post_meta($postsObject->ID,'guardian_post_date',true)); ?></abbr><br>Last Synced</td></tr><?php endforeach; ?>

</table>
</div>
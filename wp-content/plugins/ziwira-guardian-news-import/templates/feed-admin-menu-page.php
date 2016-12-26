<?php
global $wp_post_types;
//$removePostTypes = array("attachment", "revision", "nav_menu_item", "wpuf_subscription", "wpuf_forms", "wpuf_profile", "wpuf_input");


 $DefaultArgs=array(
        'public'                => true,
        'exclude_from_search'   => false,
        '_builtin'              => true
    );

  $customArgs=array(
        'public'                => true,
        'exclude_from_search'   => false,
        '_builtin'              => false
    );
    $output = 'objects'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    $DefaultPost_types = get_post_types($DefaultArgs,$output,$operator);
    $CustomPost_types = get_post_types($customArgs,$output,$operator);
    $bothPostTpes = array_merge(array('post'=>$DefaultPost_types['post']),$CustomPost_types);
   

$savedPostTypes =json_decode(get_option('ziwira_guradian_enabled_post_types'));
$combinedSaved = array_combine($savedPostTypes, $savedPostTypes);

// if($arrayKeys !in_array($needle, $haystackarray))
?>

<div class="wrap">
    <h1>Ziwira Feed Settings</h1>

    <form name="form" action="<?php admin_url('?page=ziwira-guardian-news-import%2Fadmin%2Ffeed-admin-menu-page.php')?>" method="post">
        <input type="hidden" id="_wpnonce" name="_wpnonce" value="496c4a6122"><input type="hidden" name="_wp_http_referer" value="/wordpress/wp-admin/options-permalink.php">
        <p>Please provide Api Key and schedule cron</p>

        <h3 class="title">Api Settings</h3>
        <table class="form-table">
            <tbody><tr>
                    <th><label for="api_key">Api key</label></th>
                    <td> <input name="guardian_api_key" id="category_base" type="text" value="<?php echo get_option('ziwira_guardian_api_key'); ?>" class="regular-text code"></td>
                </tr>
                <tr>
                    <th><label for="tag_base">Cron Scheduler</label></th>
                    <td>
                        <select name="cronschedcule">
                            <option value="1">Every Day</option>
                            <option value="2">Every Week</option>
                            <option value="3">Every Month</option>
                        </select>
                    </td>
                </tr>
            </tbody></table>


        <h3 class="title">Select Post Types</h3>
        <p>Please select post type to un sync feed data from guardian.</p>

        <table class="form-table">
            <tbody><tr>
                    <th><label for="postTypes">Post Types</label></th>
                    <td>  <select multiple="multiple" name="posttypes[]">
                            <?php
                            foreach ($bothPostTpes as $key =>$postData) {
                               
                            ?>
                                    <option value="<?php echo $key; ?>" <?php echo ($combinedSaved[$key]==$key ? 'selected':'')?>><?php echo $postData->label;?></option>
                            <?php
                               
                            } ?>

                        </select></td>
                </tr>
            </tbody></table>


        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>  </form>

</div>
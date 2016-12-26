<?php
/**
 * Template Name: Search
 * Author : Firasath
 * Author URI: http://firasath.com/
 * @package ziwira
 * @since ziwira 1.0
 */
get_header();
?>
<div id="maincontent">
        <div class="custom_search_box">
            <form action="" onsubmit="if(document.getElementById('onpage_q').value == '') return false;" >
                <div class="four-column clearfix form-group" style="display: none;">
                    <div class="search-box pull-left">
                        <input type="text" name="q" value="" class="form-control" id="onpage_q" placeholder="Search">
                    </div>
                    <div class="search-container pull-right" style="display: none;">
                        <button class="search-btn"><span class="icon-search"></span><span>search</span></button>
                    </div></div>
            </form>
        </div>
        <div class="row margin_bottom">
            <gcse:searchresults-only></gcse:searchresults-only>
        </div>
    </div>
<?php get_footer();?>
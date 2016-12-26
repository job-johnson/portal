<?php
/**
 * Template Name: Trending Now
 *
 * @package ziwira
 * @since ziwira 5.0
 */
get_header(); ?>


<div id="maincontent">
<div class="ad-wrapper ad-center-align top-ad">

<!-- /100058245/TrendingNow_D_ATF_LB -->
<div id='div-gpt-ad-1470624706773-3' style='height:90px; width:728px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-3'); });
</script>
</div>

<span class="ad_close"></span>
  </div>
   <div id="two-column" class="clearfix">
    <div class="new-title">
      <span class="title_inner clearfix">
                    <span class="title_text">Ziwira<i class="icon-right-arrow"></i>Trending Now</span>
                </span>
                <span class="clearfix">
                  <span class="title_text"><span class="icon_comm"><i class="icon-news"></i></span>Trending Now</span>
                </span>
    </div>
    
   </div>
  <div id="two-column" class="clearfix">
    <div id="left-block" class="pull-left bg-color top-left">
            <div class="top-ar-container">
            <?php echo do_shortcode('[wpv-view name="landing-first"]'); ?>

            </div>
    </div>
    <div id="right-block" class="pull-right sidebar top-right">
      <div class="ad-wrapper" >

<!-- /100058245/Global_L_ATF_LR1 -->
<div id='div-gpt-ad-1470624706773-7' style='height:280px; width:336px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-7'); });
</script>
</div>

</div>
      <div class=" clearfix right-mar blog-roll-container">
<?php
$args = array(
	 'posts_per_page' => 1,
	 'orderby' => 'date',
	 'order'=> 'ASC',
	 'post_type' => 'blog-roll',
	 'post_status' => 'publish'
);
$blogRollPosts = get_posts( $args );
$blogRollId = $blogRollPosts[0]->ID;
?>

        <ul>
          <li>blog roll</li>
          <li><a style="color:#2e383a"target="_blank" href="<?php echo get_post_meta($blogRollId,'wpcf-link-1',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-1',true); ?></a></li>
          <li><a style="color:#2e383a" target="_blank" href="<?php echo get_post_meta($blogRollId,'wpcf-link-2',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-2',true); ?></a></li>
          <li><a style="color:#2e383a"target="_blank"href="<?php echo get_post_meta($blogRollId,'wpcf-link-3',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-3',true); ?></a></li>
          <li><a style="color:#2e383a"target="_blank"href="<?php echo get_post_meta($blogRollId,'wpcf-link-4',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-4',true); ?></a></li>
          <li><a style="color:#2e383a"target="_blank"href="<?php echo get_post_meta($blogRollId,'wpcf-link-5',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-5',true); ?></a></li>
          <li><a style="color:#2e383a"target="_blank"href="<?php echo get_post_meta($blogRollId,'wpcf-link-6',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-6',true); ?></a></li>
          <li><a style="color:#2e383a"target="_blank"href="<?php echo get_post_meta($blogRollId,'wpcf-link-7',true); ?>"><?php echo get_post_meta($blogRollId,'wpcf-title-7',true); ?></a></li>
        </ul>
      </div>

    </div>
  </div>

  <div id="two-column" class="clearfix">
    <?php echo do_shortcode('[wpv-view name="landing-all"]'); ?>
  </div>

  <div id="two-column" class="clearfix">
    <div class="ad-wrapper ad-center-align top-ad">

<!-- /100058245/Global_L_BTF_LB -->
<div id='div-gpt-ad-1470624706773-8' style='height:90px; width:728px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-8'); });
</script>
</div>

    <span class="ad_close"></span>
  </div>
  </div>

</div>

<?php get_footer();?>
<!-- <div class="home_overlay_full"></div> -->
<?php
/**
 * Template Name: Home Page
 *
 * @package ziwira
 * @since ziwira 5.0
 */
get_header();
?>
<script type="text/javascript">
jQuery(document).ajaxStop(function(){
  jQuery('.home_overlay_full').hide();
});
</script>
<div id="maincontent">
  <div class="ad-wrapper ad-center-align top-ad">
      
<!-- /100058245/Home_ATF_LB_728x90 -->
<div id='div-gpt-ad-1470624706773-0' style='height:90px; width:728px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-0'); });
</script>
</div>


      <span class="ad_close"></span>
    </div>
    <div id="two-column" class="clearfix">
      <div id="left-block" class="pull-left bg-color top-left">
        <h3 class="trend"><span class="icon_comm news-bg"><i class="icon-news"></i></span><span class="header-title">Trending now</span></h3>
<?php echo do_shortcode('[wpv-view name="trend-slider"]'); ?>

<?php echo do_shortcode('[wpv-view name="trend-carousel"]'); ?>
        <div>
          <div class='blocks home_blocks food_block'>
          <h3><span class="icon_comm food-bg"><i class="icon-food"></i></span><span class="header-title">Food</span></h3>
          <ul class="article_listing_block">

          </ul>
          </div>
        </div>
        <div class='col-md-12 col-sm-6 col-xs-12 blocks home_blocks env_block'>
          <h3><span class="icon_comm environment-bg"><i class="icon-environment"></i></span><span class="header-title">environment</span></h3>

           <div class='col-md-7 blocks home_blocks env_block_right'>
           <div id="envslider" class="flexslider">
             <ul class="slides">
             </ul>
           </div>
           </div>
        </div>
      </div>
      <div id="right-block" class="pull-right sidebar top-right">
        <div class="ad-wrapper" style="margin-bottom:22px;">
        
 <!-- /100058245/Home_ATF_LR1_336x280 -->
<div id='div-gpt-ad-1470624706773-1' style='height:280px; width:336px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-1'); });
</script>
</div>
        
        </div>

        <div class='col-md-5 col-sm-6 col-xs-12 small_block blocks home_blocks life lifestyle_block'>
        <h3><span class="icon_comm lifestyle-bg"><i class="icon-lifestyle"></i></span><span class="header-title">Lifestyle</span></h3>
          <ul class="article_listing_block">

          </ul>
        </div>

        <div class="photo">
          <h3 class="pc" style="margin-bottom:14px"><span class=""><img src="<?php bloginfo('template_directory'); ?>/assets/images/pc-icon.png"/></span><span class="header-title">photo contest</span></h3>
          <a href=""><img src="<?php bloginfo('template_directory'); ?>/assets/images/pc.jpg"/></a>
        </div>

        <div class='col-md-5 col-sm-6 col-xs-12 small_block blocks home_blocks fas fas_block'>
        <h3><span class="icon_comm fashion-bg"><i class="icon-fashion"></i></span><span class="header-title">Fashion</span></h3>
          <ul class="article_listing_block">

          </ul>
        </div>
      </div>
    </div>

    <div id="two-column" class="clearfix">
      <div class="ad-wrapper ad-center-align top-ad">

<!-- /100058245/Home_BTF_LB_728x90 -->
<div id='div-gpt-ad-1470624706773-2' style='height:90px; width:728px;'>
<script>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1470624706773-2'); });
</script>
</div>

    <span class="ad_close"></span>
  </div>
    </div>

    <div id="two-column" class="clearfix" style="margin-bottom: 30px;">
      <div class="col-md-6" style="width: 49%;float: left;margin-right: 25px;">
        <div class="col-md-12 col-sm-12 col-xs-12 small_block blocks home_blocks ecotech_block">
          <h3><span class="icon_comm eco-tech-bg"><i class="icon-eco-tech"></i></span><span class="header-title">Eco Tech</span></h3>
            <ul class="article_listing_block">

            </ul>
        </div>
      </div>
      <div class="col-md-6" style="width:49%;float:left;">
        <div class="col-md-12 col-sm-12 col-xs-12 small_block blocks home_blocks auto_block">
          <h3><span class="icon_comm auto-bg"><i class="icon-auto"></i></span><span class="header-title">Auto</span></h3>
            <ul class="article_listing_block">

            </ul>
        </div>
      </div>
    </div>

    <div id="two-column" class="clearfix">
      <div class="bot-new" style="margin-right: 20px;">
        <div class="col-md-5 col-sm-6 col-xs-12 small_block blocks home_blocks travel_block">
          <h3><span class="icon_comm travel-bg"><i class="icon-travel"></i></span><span class="header-title">travel</span></h3>
            <ul class="article_listing_block">

            </ul>
        </div>
      </div>
      <div class="bot-new" style="margin-right: 20px;">
        <div class="col-md-5 col-sm-6 col-xs-12 small_block blocks home_blocks realestate_block">
          <h3><span class="icon_comm realestate-bg"><i class="icon-realestate"></i></span><span class="header-title">realestate</span></h3>
            <ul class="article_listing_block">

            </ul>
        </div>
      </div>
      <div class="bot-new" style="">
        <div class="col-md-5 col-sm-6 col-xs-12 small_block blocks home_blocks finance_block">
          <h3><span class="icon_comm finance-bg"><i class="icon-finance"></i></span><span class="header-title">finance</span></h3>
            <ul class="article_listing_block">

            </ul>
        </div>
      </div>
    </div>

</div>
<?php get_footer(); ?>

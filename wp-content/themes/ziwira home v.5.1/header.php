<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<?php
$home = 'http://ziwira.com';
$globalnews = get_page_link(2086);//'#';
$environment = get_page_link(2655);//'http://environment.ziwira.com/';
$lifestyle = get_page_link(2678);//'http://lifestyle.ziwira.com/';
$food = get_page_link(2676);//'http://food.ziwira.com/';
$fashion = 'http://fashion.ziwira.com/';
$travel = 'http://travel.ziwira.com/';
$realestate = 'http://realestate.ziwira.com/';
$finance = 'http://finance.ziwira.com/';
$ecotech = 'http://ecotech.ziwira.com/';
$auto = 'http://auto.ziwira.com/';
$magazine = 'http://magazine.ziwira.com/';
$jobs = 'http://jobs.ziwira.com/';


?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/assets/images/favicon.ico" type="image/x-icon"/>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,500' rel='stylesheet' type='text/css'>
    <link href='<?php bloginfo('template_directory'); ?>/assets/css/flexslider.css' rel='stylesheet' type='text/css'>
	<script src="<?php bloginfo('template_directory'); ?>/assets/scripts/ad/dfp.js"></script>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/scripts/share.js"></script>
	<script type="text/javascript">stLight.options({publisher: "83c293a9-a5e6-4fac-ae88-0a34021dbd46", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
  googletag.cmd.push(function() {
    googletag.defineSlot('/100058245/Home_ATF_LB_728x90', [728, 90], 'div-gpt-ad-1470624706773-0').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Home_ATF_LR1_336x280', [336, 280], 'div-gpt-ad-1470624706773-1').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Home_BTF_LB_728x90', [728, 90], 'div-gpt-ad-1470624706773-2').addService(googletag.pubads());
    googletag.defineSlot('/100058245/TrendingNow_D_ATF_LB', [728, 90], 'div-gpt-ad-1470624706773-3').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Global_D_ATF_LR', [336, 280], 'div-gpt-ad-1470624706773-4').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Global_D_BTF_LB', [728, 90], 'div-gpt-ad-1470624706773-5').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Global_L_ATF_LB', [728, 90], 'div-gpt-ad-1470624706773-6').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Global_L_ATF_LR1', [336, 280], 'div-gpt-ad-1470624706773-7').addService(googletag.pubads());
    googletag.defineSlot('/100058245/Global_L_BTF_LB', [728, 90], 'div-gpt-ad-1470624706773-8').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
//google custom search scripts
(function() {
	var cx = '009140408899044177584:nfwsifqhxum';
	var gcse = document.createElement('script');
	gcse.type = 'text/javascript';
	gcse.async = true;
	gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	'//cse.google.com/cse.js?cx=' + cx;
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(gcse, s);
})();
</script>
</head>

<body <?php body_class(); ?>>
	<div id="header" class="clearfix">
		<div id="header-top" class="clearfix">
      <div id="maincontent" class="clearfix">
            <div id="header-left"><a href="<?php echo $home; ?>" class="logo"><img src="<?php bloginfo('template_directory'); ?>/assets/images/logo.svg" alt="Ziwira" ></a></div>
            <div id="header-right">
              <div class="menu_sec_top "> <!-- header menu top starts here  -->
                        <div class="menu_sec_container">
                              <div class="menu_sec_top_inner">
                                  <div class="lang_box btn-group dropdown pull-left">
                                      <!--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="lang_drop">-->
                                    <button type="button" class="btn-default" id="lang_drop" style="cursor: default !important;">
                                        <span data-bind="label" class="lang_name">
                                            <span id="flagIcon" class="flag flag-icon flag-icon-ae"></span>
                                            <span class="lang_name_inner">English</span>
                                            <!--<span class="icon icon-down-arrow"></span>-->
                                        </span>
                                    </button>
                                  </div>

                                  <div class="about_box box-left pull-left">
                                      <ul>
                                          <li><a href="http://ziwira.com/about-us/">About Us</a></li>
                                          <li><a href="http://ziwira.com/contact-us/">Contact Us</a></li>
                                          <li><a href="https://ziwira.leadpages.co/investor/">Investor</a></li>
					  <li><a href="http://ziwira.com/ad-rates/">Ad Rates</a></li>
                                      </ul>
                                  </div>
                                  <div class="login_box box-left pull-left" style="visibility:hidden">
                                  <ul><li><a id="overlayTrigger2" href="#myOverlay2" data-overlay-trigger ng-click="subscribeVar='visible'">Subscribe</a></li></ul>
                                  </div>


                                  <div class="login_box pull-left register">
                                  <ul>
<li><a href="http://ziwira.com/join-bba/" style="margin-right:10px;">Join BBA</a></li>
<li><a href="http://ziwira.com/article-submission/" style="margin-left:10px;">Article Submission</a></li>
																	</ul>
                                  </div>

                   <div class="about_box pull-right menu-top-right" style="margin-left: 21px;color: white;">
                          <ul class="main_menu pull-right mright">

                                <!--<li><i class="icon icon-magazine"></i></li>-->
<li><i class="icon-market"></i><a href="https://ziwirastore.com/" style="border-right: 0px solid #fff;border-radius:0;">Marketplace</a></li>
<li><i class="icon-jobs"></i><a href="http://ziwira.com/green-businesses/" style="border-right: 0px solid #fff;border-radius:0;">Green Businesses</a></li>
                          </ul>
                    </div>
                  </div>
                          </div>
                </div>

            <div id="header-bottom" class="nav_bottom clearfix"><!-- header bottom start -->
              <div class="category_menu effects pull-left" style="opacity: 1;"><!-- category_menu start -->
								<ul>
	               <li><a href="<?php echo $globalnews ?>"><span class="icon_comm news-bg"><i class="icon-news"></i></span><span class="menu_text">Trending Now</span></a></li>
	               <li><a href="<?php echo $environment ?>"><span class="icon_comm environment-bg"><i class="icon-environment"></i></span><span class="menu_text">Environment</span></a></li>
	               <li><a href="<?php echo $lifestyle ?>"><span class="icon_comm lifestyle-bg"><i class="icon-lifestyle"></i></span><span class="menu_text">Lifestyle</span></a></li>
	               <li><a href="<?php echo $food ?>"><span class="icon_comm food-bg"><i class="icon-food"></i></span><span class="menu_text">Food</span></a></li>
	               <?php /**<li><a href="<?php echo $fashion ?>"><span class="icon_comm fashion-bg"><i class="icon-fashion"></i></span><span class="menu_text">Fashion</span></a></li>
	               <li><a href="<?php echo $travel ?>"><span class="icon_comm travel-bg"><i class="icon-travel"></i></span><span class="menu_text">Travel</span></a></li>
	               <li><a href="<?php echo $realestate ?>"><span class="icon_comm real-estate-bg"><i class="icon-real-estate"></i></span><span class="menu_text">Real Estate</span></a></li>
	               <li><a href="<?php echo $finance ?>"><span class="icon_comm finance-bg"><i class="icon-finance"></i></span><span class="menu_text">Finance</span></a></li>
	               <li><a href="<?php echo $ecotech ?>"><span class="icon_comm eco-tech-bg"><i class="icon-eco-tech"></i></span><span class="menu_text">Eco Tech</span></a></li>
	               <li><a href="<?php echo $auto ?>"><span class="icon_comm auto-bg"><i class="icon-auto"></i></span><span class="menu_text">Auto</span></a></li>**/?>
	             </ul>
              </div><!-- category_menu end -->
          </div>

             <div class="menu_sec_bottom clearfix">  <!-- header menu bottom starts here  -->
              <div class="search_box"><!-- search_box start -->

<form action="<?php echo $home ?>/search" onsubmit="if(document.getElementById('q').value == '') return false;">
                  <div class="input-group">
                      <input type="text" name="q" id="q" class="form-control" autocomplete="off" placeholder="Search on Ziwira">
                      <span class="input-group-btn">
                          <button class="btn btn-default" type="submit">
                              <i class="icon-search"></i>
                              <span class="i-name">Search</span>
                          </button>
                      </span>
                  </div> <!-- input-group  end -->
                  </form>

              </div><!-- search_box end -->

                       </div>
            </div>
          </div>
					<div id="header-right-bg"></div><!--  header right green bg -->
      </div>
			<div class="sub_menu environment-bg"></div>
  </div>



		<div id="maincontent">

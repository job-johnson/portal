<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<?php
$home = 'http://ziwira.com';
$globalnews = '#';
$environment = 'http://environment.ziwira.com/';
$lifestyle = 'http://lifestyle.ziwira.com/';
$food = 'http://food.ziwira.com/';
$fashion = 'http://fashion.ziwira.com/';
$travel = 'http://travel.ziwira.com/';
$realestate = 'http://realestate.ziwira.com/';
$finance = 'http://finance.ziwira.com/';
$ecotech = 'http://ecotech.ziwira.com/';
$auto = 'http://auto.ziwira.com/';
$magazine = 'http://magazine.ziwira.com/';
$jobs = 'http://jobs.ziwira.com/';

?>
</div>
<div id="footer" class="footer clearfix"><!-- footer start -->
  <div class="footer_sec"><!-- footer_sec start -->
      <div class="footer_top"><!-- footer_top start -->
          <div id="maincontent" class="clearfix">
              <div class="links_div footer_logo pull-left">
                  <a href="<?php echo $home; ?>"><img src="<?php bloginfo('template_directory'); ?>/assets/images/foot.svg" alt="Explore Ziwira"></a>
              </div>
              <div class="links_div footer_about pull-left">
                  <ul>
                        <li><a href="<?php echo $home ?>/about-us">About Us</a></li>
                        <!-- <li><a href="blog">Blog</a></li>
                      <li><a href="in-the-media">In the Media</a></li> -->
                        <li><a href="<?php echo $home ?>/ziwira-partners">Ziwira Partners</a></li>
                        <li><a href="<?php echo $home ?>/ziwira-sponsorship">Ziwira Sponsorship</a></li>
                        <li><a href="<?php echo $home ?>/investor-relations">Investor Relations</a></li>
          </ul>
              </div>
              <div class="links_div footer_idea pull-left">
                   <ul>
                        <li><a href="<?php echo $home ?>/privacy-policy">Privacy Policy</a></li>
                        <li style="display:none"><a href="advertisements">Advertisements</a></li>
                        <li><a href="<?php echo $home ?>/ziwira-advertising">Ziwira Advertising</a></li>
                    </ul>
              </div>
              <div class="links_div social_link pull-right">
                  <div class="social_link_inner">
                      <ul>
                              <li><a target="_blank" href="https://www.facebook.com/Ziwira"><span class="social_comm facebook"><i class="icon-facebook"></i></span></a></li>
                              <li><a target="_blank" href="https://twitter.com/ZiwiraEco"><span class="social_comm twitter"><i class="icon-twitter"></i></span></a></li>
                              <li><a target="_blank" href="https://www.youtube.com/channel/UCxtVFXDq1pOfPC2DpMHHuZw"><span class="social_comm youtube"><i class="icon-youtube"></i></span></a></li>
                              <li><a target="_blank" href="https://plus.google.com/+ZiwiraEco"><span class="social_comm gplus"><i class="icon-gplus"></i></span></a></li>
                              <li><a target="_blank" href="https://www.linkedin.com/company/ziwira"><span class="social_comm linkedin"><i class="icon-linkedin"></i></span></a></li>
                              <li><a target="_blank" href="https://instagram.com/ziwira"><span class="social_comm instagram"><i class="icon-instagram"></i></span></a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div><!-- footer_top end -->
      <div class="footer_bottom"><!-- footer_bottom start -->
          <div id="maincontent">
              <div class="footer_bottom_inner clearfix">
                  <div class="category-links">
                          <ul>
                              <li><a href="<?php echo $magazine ?>"><span class="icon_comm magazine-bg"><i class="icon-magazine"></i></span><span class="menu_text">magazine</span></a></li>
                              <li><a href="<?php echo $globalnews ?>"><span class="icon_comm news-bg"><i class="icon-news"></i></span><span class="menu_text">trending now</span></a></li>
                              <li><a href="<?php echo $environment ?>"><span class="icon_comm environment-bg"><i class="icon-environment"></i></span><span class="menu_text">environment</span></a></li>
                              <li><a href="<?php echo $lifestyle ?>"><span class="icon_comm lifestyle-bg"><i class="icon-lifestyle"></i></span><span class="menu_text">lifestyle</span></a></li>
                              <li><a href="<?php echo $food ?>"><span class="icon_comm food-bg"><i class="icon-food"></i></span><span class="menu_text">food</span></a></li>
                              <li><a href="<?php echo $fashion ?>"><span class="icon_comm fashion-bg"><i class="icon-fashion"></i></span><span class="menu_text">fashion</span></a></li>
                              <li><a href="<?php echo $travel ?>"><span class="icon_comm travel-bg"><i class="icon-travel"></i></span><span class="menu_text">travel</span></a></li>
                              <li><a href="<?php echo $realestate ?>"><span class="icon_comm real-estate-bg"><i class="icon-real-estate"></i></span><span class="menu_text">real estate</span></a></li>
                              <li><a href="<?php echo $finance ?>"><span class="icon_comm finance-bg"><i class="icon-finance"></i></span><span class="menu_text">finance</span></a></li>
                              <li><a href="<?php echo $ecotech ?>"><span class="icon_comm eco-tech-bg"><i class="icon-eco-tech"></i></span><span class="menu_text">eco tech</span></a></li>
                              <li><a href="<?php echo $auto ?>"><span class="icon_comm auto-bg"><i class="icon-auto"></i></span><span class="menu_text">auto</span></a></li>
                              <!--<li style="display:none"><a href="<?php echo $jobs ?>"><span class="icon_comm jobs-bg"><i class="icon-jobs"></i></span><span class="menu_text">Green Jobs</span></a></li>-->

                          </ul>
                  </div>
              </div>
          </div>
      </div><!-- footer_bottom end -->
  </div><!-- footer_sec end -->
  <div class="footer_copyrights"><!-- footer_copyrights start -->
      <div id="maincontent">
          <ul>
              <li><a href="<?php echo $home ?>/contact-us">Contact Us</a></li>
                <!-- <li><a href="purchase-policy">Purchase Policy</a></li>
                <li><a href="payment-policy">Payment Policy</a></li>
                <li><a href="refund-policy">Refund Policy</a></li>
                <li><a href="shipping-policy">Shipping Policy</a></li> -->
                <li><a href="<?php echo $home ?>/terms-conditions">Terms &amp; Conditions</a></li>
                <li><a href="<?php echo $home ?>/disclaimer">Disclaimer</a></li>
                <li><a href="<?php echo $home ?>/sitemap">Sitemap</a></li>
          </ul>
          <p>
              <span class="copy_right">&copy; <?php echo date("Y"); ?>, Ziwira - all rights reserved</span>

          </p>
      </div>
  </div><!-- footer_copyrights end -->
</div>


<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory'); ?>/app.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/assets/scripts/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/assets/scripts/html5gallery.js"></script>
</body>
</html>

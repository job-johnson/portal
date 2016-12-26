<?php
/**
 * Template Name: Ad Rates
 * Author : Firasath
 * Author URI: http://firasath.com/
 * @package ziwira
 * @since ziwira 1.0
 */


get_header();
/**$args = array('cmd' => '_notify-synch',
            'tx' => '4L4725157A995035T',
            'at' => 'HJ4xaruNnr8GnIaLgyX3qfPD8epzoWaofqSXiIsD702Yy_eRJrzSj3bsCTu',
        );
        $response = wp_remote_post( 'https://www.sandbox.paypal.com/cgi-bin/webscr', array(
	'method' => 'POST',
	'timeout' => 45,
	'redirection' => 5,
	'httpversion' => '1.0',
	'blocking' => true,
	'headers' => array(),
	'body' => $args,
	'cookies' => array()
    )
);
$body = wp_remote_retrieve_body($response);

$lines = explode("\n", $body);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
$keyarray[urldecode($key)] = urldecode($val);
}
}
echo "<pre>"; print_r($keyarray);
wp_die();**/
$session = $_SESSION["zebutech_checkout_cart"]['currency'];
//unset($_SESSION["zebutech_checkout_cart"]);

//echo "<pre>"; print_r($_SESSION["zebutech_checkout_cart"]);
//array_pop($_SESSION["zebutech_checkout_cart"]);

//echo "<pre>"; print_r($_SESSION["zebutech_checkout_cart"]);
?>

<div class="row homepage_blocks rates_page">

<div class="col-md-12">
	<div class="rates_container">
		<h2 class="rates_title">ads starting from only $99/month!</h2>
		<div class="curr_selector clearfix">
			<div class="curr_text pull-left">select currency</div>
			<div class="curr_flag pull-left clearfix">
				<a id="currency-cad"href="#" class="pull-left can_flag  <?php echo (empty($session[0]) || $session[0] == 'CAD' ? 'flag_active':'' )   ?>"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/ca.png"/></a>
				<a  id="currency-usd"href="#" class="pull-left us_flag <?php echo ($session[0] == 'USD' ? 'flag_active':'' )   ?>"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/us.png"/></a>
			</div>
		</div>
		<div class="clearfix">
			<form id="rates_form" action="" method="" name="">
				<div class="rates_left pull-left" id="rates_left_content">
					<div class="web_rates">
						<li class="list_first">
						<div class="pull-left rates_col1"><h4 class="web_title color_gr">website ads</h4></div>
						<div class="pull-left rates_col2 web_col_bg"><h4>1 Month</h4></div>
						<div class="pull-left rates_col2 web_col_bg"><h4>2 Months</h4><span class="color_gr">12% savings</span></div>
						<div class="pull-left rates_col2 web_col_bg mar-zero"><h4>3 Months</h4><span class="color_gr">20% savings</span></div>
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">home page banner</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="299" month="1 Month" label="Home Page Banner" unique_id="webiste-ads_home-page-banner_1_299"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="565" month="2 Months" label="Home Page Banner" unique_id="webiste-ads_home-page-banner_2_565"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="800" month="3 Months" label="Home Page Banner" unique_id="webiste-ads_home-page-banner_3_800"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">top page banner</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="199" month="1 Month" label="Top Page Banner" unique_id="webiste-ads_top-page-banner_1_199"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="375" month="2 Months" label="Top Page Banner" unique_id="webiste-ads_top-page-banner_2_375"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="535" month="3 Months" label="Top Page Banner" unique_id="webiste-ads_top-page-banner_3_535"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">all other ads</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="99" month="1 Month" label="All Other Ads" unique_id="webiste-ads_all-other-ads_1_99"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="185" month="2 Months" label="All Other Ads" unique_id="webiste-ads_all-other-ads_2_185"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="265" month="3 Months" label="All Other Ads" unique_id="webiste-ads_all-other-ads_3_265"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">sectional takeover</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="3500" month="1 Month" label="Sectional Takeover" unique_id="webiste-ads_sectional-takeover_1_3500"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="6580" month="2 Months" label="Sectional Takeover" unique_id="webiste-ads_sectional-takeover_2_6580"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="9380" month="3 Months" label="Sectional Takeover" unique_id="webiste-ads_sectional-takeover_3_9380"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40 web_gr_light ">
							<div class="pull-left rates_col1 web_col_bg minh-40"></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 pad-top">1Day</div>
							<div class="pull-left rates_col2 web_col_bg minh-40 pad-top">2Day<span class="color_gr">12% savings</span></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero pad-top">3Day<span class="color_gr">12% savings</span></div>
							
						</li>
						<li class="clearfix list-row minh-40 web_gr_dark">
							<div class="pull-left rates_col1 web_col_bg minh-40">home page takeover</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="1000" month="1 Day" label="Home Page Takeover" unique_id="webiste-ads_home-page-takeover_1_1000"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="1880" month="2 Day" label="Home Page Takeover" unique_id="webiste-ads_home-page-takeover_2_1880"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="2680" month="3 Day" label="Home Page Takeover" unique_id="webiste-ads_home-page-takeover_3_2680"]' );?></div>
							
						</li>
					</div>
					<div class="mag_rates">
						<li class="list_first">
						<div class="pull-left rates_col1"><h4 class="web_title color_gr">magazine ads</h4></div>
						<div class="pull-left rates_col2 web_col_bg"><h4>1 Issue</h4></div>
						<div class="pull-left rates_col2 web_col_bg"><h4>2 Issues</h4><span class="color_gr">12% savings</span></div>
						<div class="pull-left rates_col2 web_col_bg mar-zero"><h4>3 Issues</h4><span class="color_gr">20% savings</span></div>
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">half page</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="99" month="1 Issue" label="Half Page" unique_id="magazine-ads_half-page_1_99"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="185" month="2 Issues" label="Half Page" unique_id="magazine-ads_half-page_2_185"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="265" month="3 Issues" label="Half Page" unique_id="magazine-ads_half-page_3_265"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">full page</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="199" month="1 Issue" label="Full Page" unique_id="magazine-ads_full-page_1_199"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="375" month="2 Issues" label="Full Page" unique_id="magazine-ads_full-page_2_375"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="535" month="3 Issues" label="Full Page" unique_id="magazine-ads_full-page_3_535"]' );?></div>
							
						</li>
						<li class="clearfix list-row minh-12 no-bg">
							<div class="pull-left rates_col1 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12"></div>
							<div class="pull-left rates_col2 web_col_bg minh-12 mar-zero"></div>
							
						</li>
						<li class="clearfix list-row minh-40">
							<div class="pull-left rates_col1 web_col_bg minh-40">full spread</div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="299" month="1 Issue" label="Full Spread" unique_id="magazine-ads_full-spread_1_299"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40"><?php echo do_shortcode( '[zebutech_sop_cart price="565" month="2 Issues" label="Full Spread" unique_id="magazine-ads_full-spread_2_565"]' );?></div>
							<div class="pull-left rates_col2 web_col_bg minh-40 mar-zero"><?php echo do_shortcode( '[zebutech_sop_cart price="800" month="3 Issues" label="Full Spread" unique_id="magazine-ads_full-spread_3_800"]' );?></div>
							
						</li>
					</div>
					<div class="specs">
						<h2 class="rates_title">ad specs</h2>
						<h4>All ads must be 72ppi.</h4>
						<div class="spec-col pull-left web_spec_color">website ads</div>
						<div class="spec-col pull-left mar-zero mag_spec_color">magazine ads</div>
						<div class="spec_img"><img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/specs.png"/></div>
					</div>
					
				</div>
				<div class="rates_right pull-left">
					<h3 class="rates_title">your order summary</h3>
					<div class="summary_container">
						<div class="preview_block">
							<h4>website ads - order preview</h4>
                                                        <div id="website-preview-block">
							
							<div class="order_total clearfix">
								<div class="total pull-right"><span>$</span><span class="wtotal_price">0,000</span></div>
								<div class="total_text pull-right">subtotal</div>
								
							</div></div>
						</div>
						<div class="preview_block">
							<h4>magazine ads - order preview</h4>
                                                        <div id="magazine-preview-block">
							
							<div class="order_total clearfix">
								<div class="total pull-right"><span>$</span><span class="wtotal_price">0,000</span></div>
								<div class="total_text pull-right">subtotal</div>
								
							</div></div>
						</div>
						<div class="preview_block clearfix pad-zero">
							<div class="preview_bg" id="sub_total_blck">
								<div class="preview_left pull-left">
									<li class="sub_total" >subtotal</li>
									<li class="app_taxes">Applicable Taxes<br/>Please select your location</li>
									<li class="sub_total">taxes</li>

								</div>
								<div class="preview_right pull-left">
                                                             	<li id="subtotal_prview22" class="preview_right_row total"><span>$</span><span class="sub_total_price">0,000</span></li>
									<li class="app_tax_val">
										 <div class="form-group">
                  							<select id="basic" class="selectpicker show-tick form-control" data-live-search="true">
                    							<option value="">State/Province</option>
                    							<?php
                                                                        if(empty($session) || $session[0] == 'CAD'){
                                                                        echo '<optgroup label="Canada">
                    							<option value="canada-1">Yukon 5%</option>
                    							<option value="canada-2">North West Territories 5%</option>
                    							<option value="canada-3">Nunavut 5%</option>
                    							<option value="canada-4">BC 5%</option>
                    							<option value="canada-5">Alberta 5%</option>
                    							<option value="canada-6">Saskatchewan 5%</option>
                    							<option value="canada-7">Manitoba 5%</option>
                    							<option value="canada-8">Ontario 13%</option>
                    							<option value="canada-9">Quebec 5%</option>
                    							<option value="canada-10">New Burnswick 13%</option>
                    							<option value="canada-11">Nova Scotia 15%</option>
                    							<option value="canada-12">PEI 15%</option>
                    							<option value="canada-13">Newfoundland 13%</option>

                    							</optgroup>';}
                                                                        elseif($session[0] == 'USD'){
                    							echo '<optgroup label="United States" style="display:none;">
                    							<option value="us-1">New York 4%</option>
                    							<option value="us-2">All other states 0%</option>
                    							</optgroup>';}
                                                                        ?>
                                                                        </select>
                    					</div>
									</li>
									<li id="tax_total"class="preview_right_row total"><span>$</span><span class="taxes">0,000</span></li>

								</div>
							</div>
							<div class="preview_bg total_bg">
								<div class="preview_left pull-left">
									<li class="main_total">total</li>
								</div>
								<div class="preview_right pull-left">
									<li id="grand_total_preview"class="preview_right_row total"><span>$</span><span class="sub_total_price">0,000</span></li>
								</div>
							</div>

						</div>
						<div class="payment_block">
								<p>Pay with PayPal</p>
								<img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/paypal.png"/>
								<a href="#" id="checkout-btn"class="checkout_btn"></a>
							</div>
                                            <div id="paypal_form"></div>
					</div>
				</div>	
			</form>
		</div>
		
	</div>
</div>

</div>
<script type="text/javascript">
(function($){
	$(document).ready(function(){
			$('.adrates a').addClass('rates_active');
			$('.header_links_block ul li.adrates').addClass('rates_acitve_icon');
		});
 })(jQuery);
</script>
<?php get_footer();
 $html = '<script type="text/javascript">';
        $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
    $html .= '</script>';

    echo $html;

   unset($_SESSION["zebutech_checkout_cart"]);
?>
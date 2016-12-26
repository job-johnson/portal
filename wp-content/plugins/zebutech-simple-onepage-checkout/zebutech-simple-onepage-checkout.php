<?php

/**
 * Plugin Name: Zebutech Simple One Page checkout
 * Plugin URI: syedazharuddin.com/Syeds's Guardian News Import.
 * Description: Import articles from Guardian to Wordpress in post types based on configuration
 * Author: Syed Azharuddin
 * Version: 1.0
 * Author URI: http://syedazharuddin.co.in
 */
require_once 'admin/admin-config.php';

class Zebutech_Main extends Zebutech_Admin_Config {

    public function __construct() {
        // add_action('http_api_curl', array($this,'my_http_api_curl'));
        //$this->zebutech_cart_ajax();
        register_activation_hook(__FILE__, array($this, 'zebutech_checkout_install'));
         add_action('zebutech_sop_get_currency', array($this, 'sync_currency_from_google'));
        add_action('template_include', array($this, 'checkpayment_process'));
        add_action('admin_menu', array($this, 'zebutech_admin_menu_config'));
        add_action('init', array($this, 'zebutech_sop_cart_session'), 1);
        add_action('wp_enqueue_scripts', array($this, 'zebutech_sop_scripts'), 20);

        add_action('wp_ajax_nopriv_sop_checkout_action', array($this, 'sop_checkout_action_callback'));
        add_action('wp_ajax_sop_checkout_action', array($this, 'sop_checkout_action_callback'));

        add_action('wp_ajax_nopriv_sop_checkout_paypal_action', array($this, 'sop_checkout_paypal_action_callback'));
        add_action('wp_ajax_sop_checkout_paypal_action', array($this, 'sop_checkout_paypal_action_callback'));


        add_action('wp_ajax_nopriv_sop_currency_convert', array($this, 'sop_currency_convert_callback'));
        add_action('wp_ajax_sop_currency_convert', array($this, 'sop_currency_convert_callback'));
        

        //add_action('wp_ajax_nopriv_stravyfuncajax22', 'testfunc11');

        add_shortcode('zebutech_sop_cart', array($this, 'zebutech_sop_cart_data'));
    }

    public function checkpayment_process($template) {
        global $wpdb;
        global $wp_query;
        $query = $wp_query->query;
	$queryVars = $wp_query->query_vars;
	//echo "<pre>"; print_r($queryVars['name']);wp_die();
        if ($queryVars['name'] == 'checkpayment_process') {
	//echo "<pre>"; print_r($wp_query->is_404);wp_die();
            $wp_query->is_404 = false;
             $token = (isset($_GET['tx']) ? $_GET['tx']:'0');
            if($token ==0 || $token !=''){
            $args = array('cmd' => '_notify-synch',
                'tx' => $token,
                'at' => 'X-SW3uvq-NWOMBbDFWoYqxwANUfok0HIOsW_RFoAr3TjZESBLHKrgsk9GKS',
            );
            $response = wp_remote_post('https://www.paypal.com/cgi-bin/webscr', array(
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
            if (strcmp($lines[0], "SUCCESS") == 0) {
                for ($i = 1; $i < count($lines); $i++) {
                    list($key, $val) = explode("=", $lines[$i]);
                    $keyarray[urldecode($key)] = urldecode($val);
                }
            }

           foreach($keyarray as $key => $value)
{
             //  echo $key;
           
   if(preg_match('/^item_name/', $key))
   {
       //echo "asdas";
       $items .= $value.",";
        // You can access $value or create a new array based off these values
   }
}
            if(!empty($keyarray)){
            $resultSet = $wpdb->get_results("SELECT id FROM wp_rates_checkout_sales_order WHERE txn_id = '$token'");
            if (empty($resultSet)) {
                $insert = $wpdb->insert("wp_rates_checkout_sales_order", array(
                            "paypal_payer_id" => (isset($keyarray['payer_id']) ? $keyarray['payer_id'] : 0),
                            "txn_id" => (isset($keyarray['txn_id']) ? $keyarray['txn_id'] : 0),
                            "first_name" => (isset($keyarray['first_name']) ? $keyarray['first_name'] : ''),
                            "last_name" => (isset($keyarray['last_name']) ? $keyarray['last_name'] : ''),
                            "email" => (isset($keyarray['payer_email']) ? $keyarray['payer_email'] : ''),
                            "product_name" => $items,
                            "currency" => (isset($keyarray['mc_currency']) ? $keyarray['mc_currency'] : ''),
                            "sub_total" => (isset($keyarray['mc_gross']) ? $keyarray['mc_gross']-$keyarray['tax'] : 0),
                            "tax_amount" => (isset($keyarray['tax']) ? $keyarray['tax'] : 0),
                            "grand_total" => (isset($keyarray['mc_gross']) ? $keyarray['mc_gross'] : 0),
                            "payment_status" => (isset($keyarray['payment_status']) ? $keyarray['payment_status'] : 'none'),
                            "payer_status" => (isset($keyarray['payer_status']) ? $keyarray['payer_status'] : 'none'),
                            "time" => date("Y-m-d H:i:s")
                        ));
            }

            $successMessage = '  '.ucfirst($keyarray["address_name"]).', You have successfully made the payment of <b>'.$keyarray['mc_currency'].' '.number_format($keyarray['mc_gross'] * 100, 2 ).'</b> for Ad Rates <b>'.$items.'</b> through paypal.<br/>
      Your transaction id is: <b>'.$keyarray['txn_id']."</b>";
            get_header();
            echo '<div class="row">
                <div class="col-md-12 rates_container" style="min-height:400px;padding: 15px 91px 12px 80px;">
                    <h2 class="rates_title" style="text-transform: initial;">Let&#39;s get started with your ad!</h2>
                    <p style="font-size: 16px;margin-top: 20px;margin-bottom: 15px;">If you would like us to create an ad for your business, please submit your ad copy and photos to the address listed below. If your ad is already complete, you can simply send us the JPEG in 72 ppi. Please note ad sizing on our ad rate page.</p>
<p style="font-size: 15px;margin-bottom: 16px;">Questions and concerns can be directed to Natalia Canals at the same address.</p>
<p style="font-size: 15px;margin-bottom: 16px;">natalia.canals@ziwira.com</p>
<p style="font-size: 15px;margin-bottom: 16px;">Thank you!</p>
                </div>
            </div>';

$body = '<html>
<body>

<table align="center" width="630" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td width="30" height="34" border="0" bgcolor="#e4e4e4">&nbsp;</td>
	<td width="570" height="34" border="0" bgcolor="#e4e4e4">&nbsp;</td>
	<td width="30" height="34" border="0" border="0" bgcolor="#e4e4e4">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="34" bgcolor="#e4e4e4" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="34" bgcolor="#efefef" style="border-top:1px solid #7f7f7f">&nbsp;</td>
	<td width="30" height="34" bgcolor="#e4e4e4" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="30" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="30" bgcolor="#01daad" border="0">&nbsp;</td>
	<td width="30" height="30" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="40" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="40" bgcolor="#01daad" border="0" align="center"><a href="http://ziwira.com" target="_blank"><img src="http://ziwira.com/wp-content/uploads/2016/05/logo.png"/></td>
	<td width="30" height="40" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="100" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="100" bgcolor="#01daad" border="0" align="center" valign="top"><p style="font-size:36px;font-family:HelveticaNeue-UltraLight, Helvetica Neue UltraLight, Helvetica Neue, Arial, Helvetica, sans-serif;letter-spacing: 1px;">Thanks you!</p></td>
	<td width="30" height="100" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="100" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="100" bgcolor="#01daad" border="0" align="center" valign="top"><p style="font-size:30px;font-family:HelveticaNeue-UltraLight, Helvetica Neue UltraLight, Helvetica Neue, Arial, Helvetica, sans-serif;letter-spacing: 1px;">We will contact you within 24 Hrs.<br/>Regarding your Ad purchase!</p></td>
	<td width="30" height="100" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="67" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="67" bgcolor="#01daad" border="0" align="center" valign="top"><p style="color:#fff;font-size:19px;font-family:HelveticaNeue-UltraLight, Helvetica Neue UltraLight, Helvetica Neue, Arial, Helvetica, sans-serif;letter-spacing: 1px;">For Inquires please contact
<br/><a style="color:#fff;">Natalia.Canals@ziwira.com</a></p></td>
	<td width="30" height="67" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="67" bgcolor="#00c69d" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="67" bgcolor="#01daad" border="0" align="center" valign="top"><img src="http://ziwira.com/wp-content/uploads/2016/05/email.jpg"/></td>
	<td width="30" height="67" bgcolor="#00c69d" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="34" bgcolor="#e4e4e4" style="border-right:1px solid #7f7f7f">&nbsp;</td>
	<td width="570" height="34" bgcolor="#efefef" style="border-bottom:1px solid #7f7f7f">&nbsp;</td>
	<td width="30" height="34" bgcolor="#e4e4e4" style="border-left:1px solid #7f7f7f">&nbsp;</td>
</tr>
<tr>
	<td width="30" height="34" border="0" bgcolor="#e4e4e4">&nbsp;</td>
	<td width="570" height="34" border="0" bgcolor="#e4e4e4">&nbsp;</td>
	<td width="30" height="34" border="0" border="0" bgcolor="#e4e4e4">&nbsp;</td>
</tr>
</table>
</body></html>';
           $headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=".get_bloginfo('charset')."" . "\r\n";
$headers .= "From: Ziwira <no-reply@ziwira.com>" . "\r\n";
            $mailStatus =  wp_mail( $keyarray['payer_email'],' Ad Purchase Confirmation ', $body,$headers);
            
            
            get_footer();
            }
            else{
                wp_redirect( home_url() ); exit;
            }
        }else{
           // wp_die('asdsa sdasd');
          wp_redirect( home_url() ); exit;
        }
        }else{
        return $template;
        }
    }

    public function zebutech_checkout_install() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'rates_checkout_sales_order';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
                paypal_payer_id varchar(55)  NOT NULL,
                txn_id varchar(55)  NOT NULL,
		first_name tinytext NOT NULL,
                last_name tinytext NOT NULL,
                email varchar(55) DEFAULT '' NOT NULL,
		product_name varchar(255) NOT NULL,
                currency varchar(55) DEFAULT '' NOT NULL,
                sub_total Decimal(8, 2) NOT NULL,
                tax_amount Decimal(8, 2) NOT NULL,
                grand_total Decimal(8, 2) NOT NULL,
                payment_status varchar(55) DEFAULT '' NOT NULL,
                payer_status varchar(55) DEFAULT '' NOT NULL,
                time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);

        add_option('zebutech_sop_checkout_order', 1.0);
        wp_schedule_event(strtotime("07:00:00"), 'daily', 'zebutech_sop_get_currency');

    }

    public function sop_checkout_paypal_action_callback() {
        $htmlForm = '';
        $error = '';
        check_ajax_referer('zebutech-sop--string', 'security');
        if (empty($_SESSION['zebutech_checkout_cart']['subtotal'])) {
            $error = 'Please select atleast one product';
        } elseif (empty($_SESSION['zebutech_checkout_cart']['tax'])) {
            $error = 'Tax is mandatory field';
        } elseif (!empty($_SESSION['zebutech_checkout_cart']['subtotal']) && !empty($_SESSION['zebutech_checkout_cart']['tax'])) {
            $websiteids = $_SESSION['zebutech_checkout_cart']['items'];
            $taxArray = $_SESSION['zebutech_checkout_cart']['tax'];
            if (!empty($websiteids)) {
                /** $count =1;
                  foreach($websiteids as $key=>$websiteproducts){
                  if(!empty($websiteproducts)){
                  $itemName = $websiteproducts[0]['label'].'/'.$websiteproducts[0]['month'];

                  $webisteAdsHtml .= '<input type="hidden" name="item_name_'.$count.'" value="'.$itemName.'">';
                  $webisteAdsHtml .= '<input type="hidden" name="amount_'.$count.'" value="'.$websiteproducts[0]['price'].'">';
                  //$webisteAdsHtml .= '<input type="hidden" name="'.$websiteproducts[0]['unique_id'].'" value="'.$websiteproducts[0]['price'].'">';
                  $count++;
                  }

                  }* */
                $count = 1;
                $items = $_SESSION['zebutech_checkout_cart']['items'];

                foreach ($items as $item) {
                    foreach ($item as $websiteproducts) {
                        if (!empty($websiteproducts)) {
                            $itemName = $websiteproducts[0]['label'] . '/' . $websiteproducts[0]['month'];

                            $webisteAdsHtml .= '<input type="hidden" name="item_name_' . $count . '" value="' . $itemName . '">';
                            $webisteAdsHtml .= '<input type="hidden" name="amount_' . $count . '" value="' . $websiteproducts[0]['price'] . '">';
                            $currency = $websiteproducts[0]['currency'];
                            //$webisteAdsHtml .= '<input type="hidden" name="'.$websiteproducts[0]['unique_id'].'" value="'.$websiteproducts[0]['price'].'">';
                            $count++;
                        }
                    }
                }
              
               // echo "<pre>"; print_r($currency);wp_die();
                $currencyHtml = '<input type="hidden" name="currency_code" value="' . ($currency == 'USD' ? 'USD':'CAD') . '">';
                $taxHtml = '<input type="hidden" name="tax_cart" value="' . round($taxArray[0]['taxpriced']) . '">';
                $htmlForm = '<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="accounts@ziwira.com">' . $webisteAdsHtml . $taxHtml.$currencyHtml;
                // echo "<pre>"; print_r($response);wp_die();
            }




            //   print_r($response); wp_die();
            // echo "<pre>"; print_r($webisteAdsHtml);wp_die();

            /** $htmlForm = '<input type="hidden" name="cmd" value="_cart">
              <input type="hidden" name="upload" value="1">
              <input type="hidden" name="business" value="syed.azharuddin-facilitator@ziwira.com">
              <input type="hidden" name="item_name_1" value="Item Name 1">
              <input type="hidden" name="amount_1" value="1.00">
              <input type="hidden" name="item_name_2" value="Item Name 2">
              <input type="hidden" name="amount_2" value="2.00">';* */
        }
        echo json_encode(array('html' => $htmlForm, 'error' => $error));
        wp_die();
        // echo $htmlForm;wp_die();
    }

    public function sop_checkout_action_callback() {
        check_ajax_referer('zebutech-sop--string', 'security');
        if ($_POST['request_from'] == 'product_view') {
            $productname = $_POST['productname'];
            $cartselectedId = $_POST['cartpriceid'];
	//$_SESSION['test_session'] = array('asdasdas');
	//echo "<pre>"; print_r($_SESSION);wp_die();
            //echo "ids".$cartselectedId;
            $array = (!empty($_SESSION[$cartselectedId]) ? $_SESSION[$cartselectedId] : array());
		
            if (!empty($array)) {
                // $items =  $_SESSION["zebutech_checkout_cart"]['items'];
                $explodeId = explode("_", $cartselectedId);
                array_pop($_SESSION["zebutech_checkout_cart"]['items'][$explodeId[0]][$explodeId[1]]);
                array_push($_SESSION["zebutech_checkout_cart"]['items'][$explodeId[0]][$explodeId[1]], $array);
                $response = $this->ajaxData($explodeId[0]);
                echo $response;
                wp_die();
            }
        } elseif ($_POST['request_from'] == 'tax_on_change') {
            if ($_POST['taxId'] != '') {
                $taxPercent = $this->checkTaxValue($_POST['taxId']);
                if ($taxPercent !=400) {
                    $subtotoal = $_SESSION["zebutech_checkout_cart"]['subtotal'][0];

                    $taxedPercent = $subtotoal / $taxPercent;
                    $taxedPercent = $this->getPercentOfNumber($subtotoal, $taxPercent);
                    // $taxedPercent = number_format( $taxedPercent * 100, 2 );
                    array_pop($_SESSION["zebutech_checkout_cart"]['tax']);
                    array_push($_SESSION["zebutech_checkout_cart"]['tax'], array('taxid' => $_POST['taxId'], 'tax_percent' => $taxPercent, 'taxpriced' => $taxedPercent));

                    array_pop($_SESSION["zebutech_checkout_cart"]['grand_totoal']);
                    array_push($_SESSION["zebutech_checkout_cart"]['grand_totoal'], ($grandTotalTaxed + $taxedPercent));


                    $taxedPrice = '<span>$</span><span class="taxes total">' . number_format((float)$taxedPercent) . '</span>';
                    $grandTotal = '<span>$</span><span class="sub_total_price">' . number_format((float)$subtotoal + $taxedPercent) . '</span>';
                }
                echo json_encode(array('tax' => $taxedPrice, 'grandtotal_taxed' => $grandTotal));
                wp_die();
            }
            //echo print_r();
        } elseif ($_POST['request_from'] == 'remove_action') {

            $id = $_POST['remove_id'];
            $explodedData = explode("_", $id);
            array_pop($_SESSION["zebutech_checkout_cart"]['items'][$explodedData[0]][$explodedData[1]]);
            $webisteAds = $_SESSION["zebutech_checkout_cart"]['items']['webiste-ads'];
            $magzinegeAds = $_SESSION["zebutech_checkout_cart"]['items']['magazine-ads'];


            $response = $this->ajaxData($explodedData[0]);
            echo $response;
            wp_die();
        }
   
    }

    public function checkTaxValue($taxId) {


        $taxregions = array('canada-1' => 5, 'canada-2' => 5, 'canada-3' => 5, 'canada-4' => 5, 'canada-5' => 5, 'canada-6' => 5, 'canada-7' => 5
            , 'canada-8' => 13, 'canada-9' => 5, 'canada-10' => 13, 'canada-11' => 15, 'canada-12' => 15, 'canada-13' => 13, 'us-1' => 4, 'us-2' => 0
        );

        $arrayKeyExists = array_key_exists($taxId, $taxregions);
        return ($arrayKeyExists == 1 ? $taxregions[$taxId] : 400);
    }

    public function zebutech_sop_cart_session() {
        // echo "<prE>"; print_r($_SESSION["zebutech_checkout_cart"]);wp_die();
        // echo 'asdasdas';
        //session_destroy('zebutech_checkout_cart');
        session_start();
        if (!$_SESSION["zebutech_checkout_cart"]) {
            $_SESSION["zebutech_checkout_cart"] = array('items' => array("webiste-ads" => array(
                        'home-page-banner' => array(),
                        'top-page-banner' => array(),
                        'all-other-ads' => array(),
                        'sectional-takeover' => array(),
                        'home-page-takeover' => array()
                    ),
                    "magazine-ads" => array(
                        'half-page' => array(),
                        'full-page' => array(),
                        'full-spread' => array(),
                    ),
                ),
                'website_toal' => array(),
                'magazine_total' => array(),
                'currency' => array(),
                'subtotal' => array(),
                'tax' => array(),
                'grand_totoal' => array()
            );
        } else {
            // session_destroy();
        }

        // session_destroy();
    }

    public function zebutech_sop_scripts($hook) {
         $Path = $_SERVER['REQUEST_URI'];
         //print_r($Path);exit;
        if ($Path == '/rates/') {
            wp_enqueue_script('onepage_checout_zebutech', content_url('plugins/zebutech-simple-onepage-checkout/js/zebutech-sop-checkout.js'));
            wp_localize_script('onepage_checout_zebutech', 'zebutech', array('ajaxurl' => admin_url('admin-ajax.php'), 'security' => wp_create_nonce('zebutech-sop--string')));
        }
    }



    public function getPercentOfNumber($number, $percent) {
        return ($percent / 100) * $number;
    }

    public function ajaxData($adsParams) {
        $webisteAds = $_SESSION["zebutech_checkout_cart"]['items']['webiste-ads'];
        $magzinegeAds = $_SESSION["zebutech_checkout_cart"]['items']['magazine-ads'];
        $count = 1;
        $websitetotal = 0;
        $magazineTotal = 0;
        switch ($adsParams) {
            case 'webiste-ads':

                foreach ($webisteAds as $key => $value) {
                    if (!empty($value)) {
                        $websitetotal += $value[0]['price'];
                        $website_ads .= "<li class='clearfix'><div class='prod_name pull-left'>" . $count . ' - ' . $value[0]['label'] . "/<span>" . $value[0]['month'] . "</span></div>
            <div class='prod_price pull-left'><span>$</span><span class='price'>" . number_format((float) $value[0]['price']) . "</span></div>
                <div class='prod_remove pull-left'><a id=" . $value[0]['unique_id'] . " href='#'>remove</a></div></li>";
                        $count++;
                    }
                }
                $website_Html = $website_ads . '<div class="order_total clearfix">
								<div class="total pull-right"><span>$</span><span class="wtotal_price">' . number_format((float) $websitetotal) . '</span></div>
								<div class="total_text pull-right">subtotal</div>

							</div>';
                array_pop($_SESSION["zebutech_checkout_cart"]['website_toal']);
                array_push($_SESSION["zebutech_checkout_cart"]['website_toal'], $websitetotal);
                break;
            case 'magazine-ads':
                foreach ($magzinegeAds as $key => $value) {
                    //echo "--a--";
                    if (!empty($value)) {
                        $magazineTotal += $value[0]['price'];
                        $magazine_ads .= "<li class='clearfix'><div class='prod_name pull-left'>" . $count . ' - ' . $value[0]['label'] . "/<span>" . $value[0]['month'] . "</span></div>
            <div class='prod_price pull-left'><span>$</span><span class='price'>" . number_format((float)$value[0]['price']) . "</span></div>
                <div class='prod_remove pull-left'><a id=" . $value[0]['unique_id'] . " href='#'>remove</a></div></li>";
                        $count++;
                    }
                }
                $magazine_html = $magazine_ads . '<div class="order_total clearfix">
								<div class="total pull-right"><span>$</span><span class="wtotal_price">' . number_format((float)$magazineTotal) . '</span></div>
								<div class="total_text pull-right">subtotal</div>

							</div>';
                array_pop($_SESSION["zebutech_checkout_cart"]['magazine_total']);
                array_push($_SESSION["zebutech_checkout_cart"]['magazine_total'], $magazineTotal);
                break;
        }

        // array_push();
        $websiteTotal = $_SESSION["zebutech_checkout_cart"]['website_toal'][0];
        $magazineToatl = $_SESSION["zebutech_checkout_cart"]['magazine_total'][0];


        $percent = 0;
        $subtotal1 = $websiteTotal + $magazineToatl;
        array_pop($_SESSION["zebutech_checkout_cart"]['subtotal']);
        array_push($_SESSION["zebutech_checkout_cart"]['subtotal'], $subtotal1);
        $subtotal = '<span>$</span><span class="sub_total_price">' . number_format((float)$subtotal1) . '</span>';
        $grandTotal = '<span>$</span><span class="sub_total_price">' . number_format((float)$subtotal1) . '</span>';
        $taxed = '<span>$</span><span class="sub_total_price">' . $percent . '</span>';
        $sessionTax = $_SESSION["zebutech_checkout_cart"]['tax'];
        if (!empty($sessionTax)) {
            $percent = $sessionTax[0]['tax_percent'];
            $taxed = $this->getPercentOfNumber($subtotal1, $percent);
            array_pop($_SESSION["zebutech_checkout_cart"]['tax']);
            array_push($_SESSION["zebutech_checkout_cart"]['tax'], array('taxid' => $sessionTax[0]['taxid'], 'tax_percent' => $sessionTax[0]['tax_percent'], 'taxpriced' => $taxed));
            array_pop($_SESSION["zebutech_checkout_cart"]['grand_totoal']);
            array_push($_SESSION["zebutech_checkout_cart"]['grand_totoal'], ($subtotal1 + $taxed));

            $grandTotal = '<span>$</span class="sub_total_price"><span >' . number_format((float)$subtotal1 + $taxed) . '</span>';
            $taxed = '<span>$</span><span class="taxes">' . number_format((float) $taxed) . '</span>';
        }

        return json_encode(array("website_ads" => $website_Html, 'magazine_ads' => $magazine_html, 'subtotal' => $subtotal, 'grandtotal' => $grandTotal, 'tax' => $taxed));
    }

  
public function sop_currency_convert_callback(){
     $session = $_SESSION['zebutech_checkout_cart'];
     $currencyId = $_POST['currency_id'];
     $currencies = array("currency-usd"=>'USD','currency-cad'=>'CAD');
     if(array_key_exists($currencyId, $currencies)){
         array_pop($session['currency']);
         array_push($_SESSION['zebutech_checkout_cart']['currency'], $currencies[$currencyId]);
         echo "success";
     }
     else{
         echo "error No currency Found";
     }
wp_die();
     //array_push($session['currency'], '');
   //echo "<pre>"; print_r($_SESSION);wp_die();
}



public function sync_currency_from_google(){
$exchangeRateUSD = $this->convertCurrency(1,'CAD','USD');
$array = array('USD'=>$exchangeRateUSD);
$this->setOption('zebutech_sop_currency',$array);
}
}
new Zebutech_Main();
add_filter('https_local_ssl_verify', '__return_false');
?>
<?php
class Zebutech_Base{

 public $pluginName = 'Zebutech SOP Checkout';
 public static $header= array();
 public static $method= 'POST';
 public static $APIURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';


 public function setOption($optionName, $optionValue) {
        if (!get_option($optionName)) {
            $deprecated = null;
            $autoload = 'no';
            $optionUpdated = add_option($optionName, $optionValue, $deprecated, $autoload);
        } else {
            $optionUpdated = update_option($optionName, $optionValue);
        }

        return $optionName;
    }

    public function zebutech_sop_cart_data($atts, $content = null) {
        $session = $_SESSION['zebutech_checkout_cart'];
        $currency = $session['currency'];
        $price = $this->calculateCurrency($atts['price']);
        $uniqueId = $atts['unique_id'];
        $month = $atts['month'];
        $explode = explode("_",$uniqueId);
	//session_start();
        $_SESSION[$uniqueId]= array('price'=>$price,'label'=>$atts['label'],'month'=>$atts['month'],'unique_id'=>$uniqueId,'currency'=>$currency[0]);
        $html = "<input type='radio' name='$explode[1]'  value='$uniqueId'/>";
        $html .= '<span class="rtext">$</span><span class="rtext price">' . number_format((float) $price) . '</span>';
       
       return $html;
    }

    public function getOptions($optionId = '') {
        return (!get_option($optionId) ? array() : get_option($optionId));
    }


    public  function sop_encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'ziwira_string_data';
    $secret_iv = 'ziwira_string_data_iv';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}


        /**
     * @desc: Get raw api data from based on config
     * @author: Syed Azharuddin
     * @since: 1.0
     * @param: <type> string
     * @return: <type> object
     */
    public static function getAPi() {
        $response = null;
        if (self::$APIURL != '') {
            $response = wp_remote_request(self::$APIURL, self::getHeader());
        }
        return $response;
    }

    /**
     * @desc: set and get Header for api
     * @author: Syed Azharuddin
     * @since: 1.0
     * @param: string
     * @return: <type> object
     */
    public static function getHeader() {
        $args = array();
        if (!empty(self::$header)) {

            $args = array('headers' => self::$header, 'response' => array(
                    'code' => int,
                    'message' => string
                ), 'timeout' => 500,
                'method' => self::$method
            );
            
        }
        return $args;
    }

    public function convertCurrency($amount, $from, $to) {
        $url = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
        $data = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return round($converted, 3);
    }

    public function calculateCurrency($price) {
        $getCurrency = get_option('zebutech_sop_currency', true);

        $currency = $_SESSION['zebutech_checkout_cart']['currency'];
        $excnahgeRate = $getCurrency[$currency[0]];

        //echo "<pre>"; print_r($excnahgeRate);
        if (is_array($getCurrency) && !empty($currency) && $excnahgeRate != '') {
            $PriceExchange = round($excnahgeRate * $price);
            $returnPrice = $PriceExchange;
        } else {
            $returnPrice = $price;
        }

        return $returnPrice;
    }


    

}
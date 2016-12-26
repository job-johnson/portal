<?php
require_once WP_PLUGIN_DIR . '/zebutech-simple-onepage-checkout/includes/Base.php';

class Zebutech_Admin_Config extends Zebutech_Base{

    public function zebutech_admin_menu_config(){
    //add_menu_page('Config', $this->pluginName, 'manage_options', 'zebutech-simple-onepage-checkout/admin/config-zebutech-page.php', array($this, 'zebutech_onepage_admin_config'), 'dashicons-feedback', 10);

$user_ID = get_current_user_id();
 $user = new WP_User( $user_ID ); // the user id you want to have that capability
$user->add_cap( 'ziwira_ad_rates' );
     // wp_die();
        if(current_user_can('administrator') || current_user_can('editor')){
        add_menu_page('Config', 'Ziwira Ad Rates', 'ziwira_ad_rates', 'zebutech-simple-onepage-checkout/admin/config-zebutech-page.php', array($this, 'zebutech_onepage_admin_config'), 'dashicons-feedback', 10);
      }

    }


    public function zebutech_onepage_admin_config(){
       // echo "<pre>"; print_r($_SESSION);
       // session_destroy();
      $this->loadConfigTemplate();
      if(isset($_POST) && $_POST['sop-submitted'] == 1){
       $this->setOption('zebutech_sop_cart_admin_config',$_POST);
      }
       
    }

    public function zebutech_sop_scripts(){
        wp_enqueue_style('zebutech-sop-admin-css', content_url('plugins/zebutech-simple-onepage-checkout/css/admin.css'));
               
    }

    public function loadConfigTemplate(){ 
        
        
        

     global $wpdb;
$fetchOrders =  $wpdb->get_results("SELECT * FROM wp_rates_checkout_sales_order");
        require_once WP_PLUGIN_DIR . '/zebutech-simple-onepage-checkout/templates/admin/sop-admin-config-template.php';
        template($fetchOrders);


    }


 
    
}

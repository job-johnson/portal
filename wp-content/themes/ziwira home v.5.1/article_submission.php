<!-- <div class="home_overlay_full"></div> -->
<?php
/**
 * Template Name: Article Submission
 *
 * @package ziwira
 * @since ziwira 5.0
 */

get_header();
include_once ABSPATH . 'wp-admin/includes/media.php';
include_once ABSPATH . 'wp-admin/includes/file.php';
include_once ABSPATH . 'wp-admin/includes/image.php';
$message = submit_article_submission();
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/app.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.formstyler.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js?ver=1'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/validation.js?ver=1'></script>
<link href="<?php echo get_template_directory_uri();?>/css/jquery.formstyler.min.css?ver=1.1>" rel="stylesheet" />

<div class="article_submission_wrapper">
<?php

if($message !=''){
echo $message;
}
else{?>

    <form id="article_submission_form"  method="post" action="" enctype="multipart/form-data" >
      <div class="article_submission"><h3>ARTICLE SUBMISSION</h3></div>
    <div class="content_article_wrap">

      <div class="content_article_wrapper content_article_bg addition"><p><span>*</span><strong>Article Title:</strong></p></div>
      <p class="input_content_article content_article_bg">
        <input  required type="text" name="article-title" maxlength="120" placeholder="Write Text Here" class="shadow maxlength-req-120"></p>
      <div class="text_limit content_article_bg"><p class="margT10">120 characters</p></div>
      <div class="content_article_wrapper content_article_bg"><p><span>*</span><strong>Body:</strong></p></div>
      <div class="content_article_bg">
        <p><textarea maxlength="400" required class="textarea_article shadow maxlength-req-120" rows="20" cols="45" name="body-text" placeholder="Write Text Here"></textarea></p>
      </div>
      <div class="text_limit content_article_bg"><p class="margT10">400 characters</p></div>
      <div class="row_">
        <div class="category_wrap">
          <div class="content_article_wrapper content_article_bg"><p><span>*</span><strong>Category:</strong></p></div>
            <p class="input_content_article content_article_bg">
              <select  required name="category" class="shdow">
      				<option value="">Select</option>
      		
          <optgroup label="Environment"></optgroup>
          <optgroup label="_________">
              <option value="environment-magazines">Magazines</option>
              <option value="environment-organizations">Organizations</option>
      				<option value="environment-supporters">Supporters</option>
          </optgroup>

          <optgroup label="Lifestyle"></optgroup>
          <optgroup label="_________">
              <option value="lifestyle-cleaning-products">Cleaning Products</option>
              <option value="lifestyle-cosmetics">Cosmetics</option>
      				<option value="lifestyle-fitness">Fitness</option>
      				<option value="lifestyle-health-suppliments">Health Supplements</option>
      				<option value="lifestyle-personal-cares">Personal Care</option>
          </optgroup>

          <optgroup label="Food"></optgroup>
          <optgroup label="_________">
              <option  value="food-agriculture">Agriculture</option>
              <option  value="food-farming">Farming</option>
      				<option  value="food-food-beverages">Food/Beverages</option>
      				<option  value="food-packaging">Packaging</option>
          </optgroup>

          <optgroup label="Fashion"></optgroup>
          <optgroup label="_________">
              <option value="fashion-apparel">Apparel</option>
              <option value="fashion-fashion-accessories">Fashion Accessories</option>
      				<option value="fashion-footwear">Footwear</option>
      				<option value="fashion-textile">Textile</option>
          </optgroup>

      		<optgroup label="Travel"></optgroup>
          <optgroup label="_________">
              <option value="travel-airlines">Airlines</option>
              <option value="travel-autocare">Autocare</option>
      				<option value="travel-hotels">Automobile</option>
      				<option value="travel-tourisim-officies">Tourism Offices</option>
          </optgroup>

      		<optgroup label="Real Estate"></optgroup>
          <optgroup label="_________">
              <option value="realestate-estate-agents">Estate Agents</option>
              <option value="realestate-gardening">Gardening</option>
          </optgroup>

      		<optgroup label="Finance"></optgroup>
          <optgroup label="_________">
              <option value="finance-enterprenurship">Entrepreneurship</option>
              <option value="finance-innovations">Innovations</option>
      				<option value="finance-portfolio-careers">Portfolio Careers</option>
          </optgroup>

      		<optgroup label="Eco Tech"></optgroup>
          <optgroup label="_________">
              <option value="ecotech-electronics">Electronics</option>
              <option value="ecotech-solar-technology">Solar Technology</option>
      				<option value="ecotech-technology">Technology</option>
      				<option value="ecotech-tourisim-officies">Tourism Offices</option>
          </optgroup>

      		<optgroup label="Auto"></optgroup>
          <optgroup label="_________">
              <option value="auto-hybrid">Hybrid</option>
              <option value="ecotech-electric">Electric</option>
          </optgroup>

      </select></p>
        </div>
        <div class="category_wrap">
          <div class="content_article_wrapper content_article_bg"><p><span>*</span><strong>Author Name:</strong></p></div>
          <p class="input_content_article content_article_bg">
            <input maxlength="120" required type="text" name="article-author" maxlength="120" placeholder="Write Text Here" class="shadow"></p>
        </div>
      </div>

    </div>
    <div class="submit_batton"><input name="submit"type="submit"  class="submit_button_" value="Submit"></div>
        </form>
        <?php }?>
  </div>
<?php get_footer(); ?>

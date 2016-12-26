<!-- <div class="home_overlay_full"></div> -->
<?php
/**
 * Template Name: GB Registration
 *
 * @package ziwira
 * @since ziwira 5.0
 */

get_header();
include_once ABSPATH . 'wp-admin/includes/media.php';
include_once ABSPATH . 'wp-admin/includes/file.php';
include_once ABSPATH . 'wp-admin/includes/image.php';
$message = submit_green_registration_form();
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js?ver=1'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/validation.js?ver=1'></script>
<div class="article_submission"><h3>business blogger association- registration form</h3>
<p>Serious note: This will take less than 4 minutes of your time to complete :)</p></div>
<?php if($message !=''){
 echo $message;

}else{
	?>
<div class="cont">
<form id="gb_reg__form" method="post" action="" enctype="multipart/form-data">
	<div class="colfull border padhead">
		<div class="checkitems">
			<div class="col3 colheading">
				<span><span class="red_">*</span>My company is a:</span>
			</div>

			<div class="col2 formcontrol">
				<input required name="my-company-is-a" value="retailer"type="radio" id="ret">
				<label for="ret">Retailer</label>
			</div>

			<div class="col2 formcontrol">
				<input required name="my-company-is-a" value="service-provider" type="radio" id="ser">
				<label for="ser">Service Provider</label>
			</div>

			<div class="col2 formcontrol">

				<input required name="my-company-is-a" value="blogger" type="radio" id="bl">
				<label for="bl">Blogger</label>
			</div>

			<div class="col2 formcontrol">

				<input required name="my-company-is-a" value="wholesaler" type="radio" id="wh">
				<label for="wh">Wholesaler</label>
			</div>
			<div class="col2 formcontrol">

				<input required name="my-company-is-a" value="manufactured" type="radio" id="man">
				<label for="man">Manufactured</label>
			</div>
			<div class="col2 formcontrol">

				<input required name="my-company-is-a" value="destributor" type="radio" id="distr">
				<label for="distr">Destributor</label>
			</div>
		</div>


		<div class="checkitems">
			<div class="col3">
				<span><span class="red_">*</span>My company Identifies with:</span>

				<p class="smalltext">Tick all that applies</p>
			</div>

			<div class="checkwidth">
				<div class="col2 formcontrol">
					<input required name="my-company-identifies-with[]" value="consious" type="checkbox" id="cons">
					<label for="cons">Consious</label>

				</div>

				<div class="col2 formcontrol">
					<input required name="my-company-identifies-with[]" value="green" type="checkbox" id="gr">
					<label for="gr">Green</label>

				</div>

				<div class="col2 formcontrol">

					<input required name="my-company-identifies-with[]" value="organic" type="checkbox" id="org">
					<label for="org">Organic</label>
				</div>

				<div class="col2 formcontrol">

					<input required name="my-company-identifies-with[]" value="natural" type="checkbox" id="nat">
					<label for="nat">Natural</label>
				</div>

				<div class="col2 formcontrol">

					<input required name="my-company-identifies-with[]" value="non-toxic" type="checkbox" id="nt">
					<label for="nt">Non-Toxic</label>
				</div>

				<div class="col2 formcontrol">

					<input required name="my-company-identifies-with[]" value="recycled" type="checkbox" id="rec">
					<label for="rec">Recycled</label>
				</div>

				<div class="col2 formcontrol">

					<input required name="my-company-identifies-with[]" value="sustainable" type="checkbox" id="sust">
					<label for="sust">Sustainable</label>
				</div>

				<div class="col2 formcontrol">
					<input required name="my-company-identifies-with[]" value="conservation" type="checkbox" id="conv">
					<label for="conv">Conservation</label>
				</div>
			</div>
		</div>


		<div class="colhalf">
			<h4 class="left"><span class="red_">*</span>Which category should we place you in?</h4>

			<select  required name="category">
				<option value="">Select</option>
    <optgroup label="Food"></optgroup>
    <optgroup label="_________">
        <option  value="food-agriculture">Agriculture</option>
        <option  value="food-farming">Farming</option>
				<option  value="food-food-beverages">Food/Beverages</option>
				<option  value="food-packaging">Packaging</option>
    </optgroup>

		<optgroup label="Finance"></optgroup>
    <optgroup label="_________">
        <option value="finance-enterprenurship">Enterprenurship</option>
        <option value="finance-innovations">Innovations</option>
				<option value="finance-portfolio-careers">Portfolio Careers</option>
    </optgroup>

		<optgroup label="Environment"></optgroup>
    <optgroup label="_________">
        <option value="environment-magazines">Magazines</option>
        <option value="environment-organizations">Organizations</option>
				<option value="environment-supporters">Supporters</option>
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
				<option value="travel-tourisim-officies">Tourisim Officies</option>
    </optgroup>

		<optgroup label="Eco Tech"></optgroup>
    <optgroup label="_________">
        <option value="ecotech-electronics">Electronics</option>
        <option value="ecotech-solar-technology">Solar Technology</option>
				<option value="ecotech-technology">Technology</option>
				<option value="ecotech-tourisim-officies">Tourisim Officies</option>
    </optgroup>

		<optgroup label="Life Style"></optgroup>
    <optgroup label="_________">
        <option value="lifestyle-cleaning-products">Cleaning Products</option>
        <option value="lifestyle-cosmetics">Cosmetics</option>
				<option value="lifestyle-fitness">Fitness</option>
				<option value="lifestyle-health-suppliments">Health Suppliments</option>
				<option value="lifestyle-personal-cares">Personal Care</option>
    </optgroup>

		<optgroup label="Real Estate"></optgroup>
    <optgroup label="_________">
        <option value="realestate-estate-agents">Estate Agents</option>
        <option value="realestate-gardening">Gardening</option>
    </optgroup>
</select>
		</div>

		<div class="colhalf">
			<h4 class="left"><span class="red_">*</span>Where do you Ship to?</h4>

			<input required type="text" name="country-name" placeholder="Enter country name" class="countname shadow">
		</div>
	</div>




	<div class="colfull border">
		<div class="row">
			<div class="colhalf">
				<h4>What products can we help you promote?</h4>

				<div class="prodphot">

					<ul>
						<li><span>Product Name</span></li>

						<li><span class="prph">Product Photo:<br>
						<span class="prphlittle">(if available)</span></span></li>
					<ul>
						<li><input name="product-name-1" type="text"  placeholder="1 - Product name" class="shadow"></li>
						<li><input  name="product-photo-1" type="file" class="styler" id="prod1" class="shadow"></li>

						<li><input name="product-name-2"type="text"  placeholder="2 - Product name" class="shadow"></li>
						<li><input name="product-photo-2" type="file" class="styler" id="prod2" class="shadow"></li>

						<li><input name="product-name-3" type="text"  placeholder="3 - Product name" class="shadow"></li>
						<li><input  name="product-photo-3" type="file" class="styler" id="prod2" class="shadow"></li>

				</div>
			</div>


			<div class="colhalf">
				<h4 class="width70">Describe the problem your business solves so we can be better
at talking you up :)</h4>

				<textarea name="describe-business" rows="8" class="shadow"></textarea>
			</div>
		</div>
	</div>


	<div class="colfull border aboutyou_">
		<div class="row">
			<h4>All about you:</h4>
			<div class="colhalf">


				<p class="forredinput"><span class="red_">*</span><input required name="brand-name" type="text" class="shadow" placeholder="Brand Name"></p>

				<p class="forredinput"><span class="red_">*</span><input required  class="check_only_url"name="website-address" type="text" class="shadow" placeholder="Website Address"></p>

				<p class="forredinput"><span class="red_">*</span><input required name="first-last-name" type="text" class="shadow" placeholder="First and Last Name"></p>

				<p class="forredinput"><span class="red_">*</span><input id="email"class="email" name="email" type="text" class="shadow" placeholder="Email"></p>

				<p class="forredinput"><span class="red_">*</span><input  id="c_email" class="c_email" emailTo= "email" type="text" class="shadow" placeholder="Confirm Email"></p>

				<input class="validate_number" name="phone" type="text" class="shadow" placeholder="Phone">
			</div>


			<div class="colhalf">

				<p class="forredinput"><span class="red_">*</span><input required name="country-city"type="text" class="shadow" placeholder="Country/City"></p>

				<p class="forredinput"><span class="red_">*</span><input required class="check_only_url"name="facebook" type="text" class="shadow" placeholder="Facebook"></p>

				<input type="text" class="check_only_url" name="twitter" class="shadow" placeholder="Twitter">

				<input type="text" class="check_only_url" name="instagram" class="shadow" placeholder="Instagram">

				<input type="text" class="check_only_url" name="linkedin" placeholder="LinkedIn">

				<input type="text" class="check_only_url" name="youtube" class="shadow" placeholder="Youtube">
			</div>


			<div class="colhalf">
				<h4 class="widthfix"><span class="red_">*</span>This will show as your business description on our directory:</h4>

				<textarea required name="business-description" rows="8" class="shadow"></textarea>
			</div>
			<div class="colhalf">
				<h4 class="widthfix"><span class="red_">*</span>This is your author profile bio that will appear on the articles you share:</h4>

				<textarea required name="author-profile" rows="8" class="shadow"></textarea>
			</div>
		</div>
	</div>


	<div class="colfull border">
		<div class="row">
			<div class="colhalf">
				<div class="brow">
					<h4>This will show up in our directory</h4>
				</div>
				<label for="logo"><span class="red_">*</span>Logo:</label>
				<input required name="logo" type="file" class="styler shadow" id="logo">

				<p class="suppform">JPG or PNG file format  (234px by 134px)</p>
			</div>


			<div class="colhalf">
				<div class="brow">
					<h4>This wil be your author profile which shows on each of your articles</h4>
				</div>
				<label for="photo">Photo:</label>
				<input  name="photo" type="file" class="styler shadow" id="photo">

				<p class="suppform">JPG or PNG file format  (126px by 126px )</p>
			</div>
		</div>
	</div>

	<div class="colfull border">
		<div class="row">
			<div class="colhalf lastblock">
				<h4><span class="red_">*</span>Don’t suppose you would tell us how you found us, would you?</h4>

				<input required name="found-us" type="text" class="shadow">
			</div>

			<div class="colhalf lastblock">
				<h4><span  class="red_">*</span>Keywords that describe my business</h4>

				<input required name="keywords" type="text" class="greeninp shadow" placeholder="Please enter 8 keywords">
			</div>
		</div>
	</div>


	<div class="btnblock">
		<input type="submit" class="btn__" name="" value="LET ME IN !">
	</div>

</form>
</div>
<?php }?>

<script src="<?php echo get_template_directory_uri();?>/js/app.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.formstyler.min.js"></script>
<?php get_footer(); ?>

<?php
/**
 * Template Name: Green Businesses
 *
 * @package ziwira
 * @since ziwira 5.1
 */
get_header();
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=1' rel='stylesheet' type='text/css'>
<div id="maincontent" class="content_blogger_wrap">
		
<?php echo do_shortcode('[wpv-view name="green-businesses"]'); ?>

       
</div>

<?php get_footer(); ?>
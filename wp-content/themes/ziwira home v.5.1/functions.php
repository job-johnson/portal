<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';

//shortcode to check if its featured or not
add_shortcode('check_is_is_featured', 'is_featured');
function is_featured($atts, $value = '') {
   $content = wpv_do_shortcode($value);
   if($content == 1)
   {
       $content = 'light-bg';
   }
   else{
       $content = '';
   }

   return $content;
}
//shortcode to restrict the characters in a string
add_shortcode('limit_content', 'trim_shortcode');
function trim_shortcode($atts, $content = '') {
   $content = wpv_do_shortcode($content);
   $length = (int)$atts['length'];

   if (strlen($content) > $length) {
       $content = substr($content, 0, $length) . '…';
   }

   // Strip HTML Tags
   $content = strip_tags($content);

   return $content;
}

/*
add_filter('redirect_post_location', 'update_post_redirect');
function update_post_redirect($location){

   $w3Config =  include(WP_CONTENT_DIR."/w3tc-config/master.php");
   $serverName = "http://".$_SERVER['SERVER_NAME'];
   $post_meta = get_post_meta($_POST['post_ID'],'wpcf-image',1);
   $domain = parse_url($post_meta, PHP_URL_HOST);
   if($domain != $w3Config['cdn.cf.id'].".cloudfront.net"){
   $string = str_replace($serverName,"","$post_meta");
   $cloudfronthost = "http://".$w3Config['cdn.cf.id'].".cloudfront.net";
   $cloudFrontUrl = $cloudfronthost.$string;
   update_post_meta($_POST['post_ID'], 'wpcf-image', $cloudFrontUrl);
   }
   $syndicated = isset($_POST['syndicated']) ? $_POST['syndicated'] : 0;
   if($syndicated == true)
       $location .= '&syndicated=1';
   return $location;
}

function to push tinymce editor script from server
 function enque_tinymce_script($hook) {
   wp_register_script( "en1", includes_url("/js/tinymce/tinymce.min.js"));
   wp_register_script('en2', includes_url("/js/tinymce/plugins/compat3x/plugin.min.js"));
   wp_enqueue_script("en1");
   wp_enqueue_script("en2");
 }
 add_action( 'admin_enqueue_scripts', 'enque_tinymce_script' );
*/

/*green business*/
add_shortcode('theme_uri', 'wpse_66026_theme_uri_shortcode' );

function wpse_66026_theme_uri_shortcode( $attrs = array (), $content = '' )
{
   $theme_uri = is_child_theme()
       ? get_stylesheet_directory_uri()
       : get_template_directory_uri();

   return trailingslashit( $theme_uri );
}

/** Green Business Registration **/
function submit_green_registration_form(){

$message = '';

//echo "<pre>"; print_r($_POST);wp_die();
if(isset($_POST) && !empty($_POST)){
//	echo "<pre>"; print_r($_POST);wp_die('asdasda');
	// Gather post data.
	$post_id = post_exists( (isset($_POST['brand-name']) ? $_POST['brand-name']:'') );
if (!$post_id) {
    // code here

	$my_post = array(
	    'post_title'    => (isset($_POST['brand-name']) ? $_POST['brand-name']:''),
			'post_content'  => 'This is my post.',
	    'post_status'   => 'draft',
			'post_type' => 'green-businesses',
	    'post_author'   => 1
	);

	$post_ID = wp_insert_post($my_post);


	update_post_meta($post_ID,'wpcf-my-company-is-a',sanitize_text_field($_POST['my-company-is-a']));
	$api_result = $_POST['my-company-identifies-with'];
	$field = wpcf_admin_fields_get_field('my-company-identifies-with');
	if (isset($field['data']['options'])){
	        $res = array();
	    foreach ($field['data']['options'] as $key => $option){
	        if (in_array($option['set_value'], $api_result)){
	            $res[$key] = $option['set_value'];
	        }
	    }
	        update_post_meta( $post_ID, 'wpcf-my-company-identifies-with' , $res );
	}
	$category = $_POST['category'];
	$explode = explode('-',$category);
	$catValue = $explode[0].'-';
	if (substr($category, 0, strlen($catValue)) == $catValue) {
   $categoryData = substr($category, strlen($catValue));
}


	update_post_meta($post_ID,'wpcf-'.$explode[0],sanitize_text_field($categoryData));
	update_post_meta($post_ID,'wpcf-country-city',sanitize_text_field($_POST['country-city']));
	update_post_meta($post_ID,'wpcf-facebook',sanitize_text_field($_POST['facebook']));
	update_post_meta($post_ID,'wpcf-first-and-last-name',sanitize_text_field($_POST['first-last-name']));
	update_post_meta($post_ID,'wpcf-twitter',sanitize_text_field($_POST['twitter']));
	update_post_meta($post_ID,'wpcf-email-address',sanitize_text_field($_POST['email']));
	update_post_meta($post_ID,'wpcf-instagram',sanitize_text_field($_POST['instagram']));
	update_post_meta($post_ID,'wpcf-linkedin',sanitize_text_field($_POST['linkedin']));
	update_post_meta($post_ID,'wpcf-where-do-you-ship-to',sanitize_text_field($_POST['country-name']));

	update_post_meta($post_ID,'wpcf-phone',sanitize_text_field($_POST['phone']));
	update_post_meta($post_ID,'wpcf-youtube',sanitize_text_field($_POST['youtube']));
	update_post_meta($post_ID,'wpcf-author-profile-bio',sanitize_text_field($_POST['author-profile']));
	update_post_meta($post_ID,'wpcf-business-description',sanitize_text_field($_POST['business-description']));
	update_post_meta($post_ID,'wpcf-found-us-would-you',sanitize_text_field($_POST['found-us']));
update_post_meta($post_ID,'wpcf-keywords-that-describe-my-business',sanitize_text_field($_POST['keywords'] ));
	update_post_meta($post_ID,'wpcf-website-address',sanitize_text_field($_POST['website-address']));
	update_post_meta($post_ID,'wpcf-product-name-1',sanitize_text_field($_POST['product-name-1']));
	update_post_meta($post_ID,'wpcf-product-name-2',sanitize_text_field($_POST['product-name-2']));
	update_post_meta($post_ID,'wpcf-product-name-3',sanitize_text_field($_POST['product-name-3']));
update_post_meta($post_ID,'wpcf-describe-the-problem-your-business',sanitize_text_field($_POST['describe-business']));
  //echo $postId;wp_die();*/
//	green_business_upload_image();
if($_FILES['product-photo-1']['size'] != 0){
green_business_upload_image($_FILES['product-photo-1'],$post_ID,'wpcf-product-photo-1');
}
if($_FILES['product-photo-2']['size'] != 0){
green_business_upload_image($_FILES['product-photo-2'],$post_ID,'wpcf-product-photo-2');
}
if($_FILES['product-photo-3']['size'] != 0){
green_business_upload_image($_FILES['product-photo-3'],$post_ID,'wpcf-product-photo-3');
}
if($_FILES['logo']['size'] != 0){
green_business_upload_image($_FILES['logo'],$post_ID,'wpcf-logo');
}
if($_FILES['photo']['size'] != 0){
green_business_upload_image($_FILES['photo'],$post_ID,'wpcf-photo');
}
$message = "<b style='color:green'>You have successfully registered to Green Business</b>";
}

}

return $message;
//echo "<pre>"; print_r($_POST);wp_die();
//	echo "syed azhar"; wp_die();
}


function green_business_upload_image($upload,$post_id,$postMeta){
	$uploads = wp_upload_dir(); /* Get path of upload dir of wordpress */

		if (is_writable($uploads['path'])) /* Check if upload dir is writable */ {
				if ((!empty($upload['tmp_name']))) /* Check if uploaded image is not empty */ {
						if ($upload['tmp_name']) /* Check if image has been uploaded in temp directory */ {

								$overrides = array('test_form' => false);
		 					  $file = wp_handle_upload($upload, $overrides); /* Call our custom function to ACTUALLY upload the image */
							//	echo "<pre>"; print_r('asda');wp_die();
								$attachment = array /* Create attachment for our post */
										(
										'post_mime_type' => $file['type'], /* Type of attachment */
										'post_parent' => $post_id, /* Post id */
								);

								$aid = wp_insert_attachment($attachment, $file['file'], $post_id);  /* Insert post attachment and return the attachment id */
								$a = wp_generate_attachment_metadata($aid, $file['file']);  /* Generate metadata for new attacment */
								$attachmentUrl = wp_get_attachment_url($aid);
								//echo "<pre>"; print_r($attachmentUrl);wp_die();
								$prev_img = get_post_meta($post_id, $postMeta);  /* Get previously uploaded image */
								if (is_array($prev_img)) {
										if ($prev_img[0] != '') /* If image exists */ {
												wp_delete_attachment($prev_img[0]);  /* Delete previous image */
										}
								}
								update_post_meta($post_id, $postMeta, $attachmentUrl);  /* Save the attachment id in meta data */

								if (!is_wp_error($aid)) {
										wp_update_attachment_metadata($aid, wp_generate_attachment_metadata($aid, $file['file']));  /* If there is no error, update the metadata of the newly uploaded image */
								}
						}
				}
		}
}

function handle_image_upload($upload) {
	global $post;
 // if (file_is_displayable_image($upload['tmp_name'])) /* Check if image */ {
			/* handle the uploaded file */
			$overrides = array('test_form' => false);
			$file = wp_handle_upload($upload, $overrides);
	//}
	return $file;
}

function submit_article_submission(){
	$message = '';
	if(isset($_POST) && !empty($_POST)){
		// Gather post data.
		$title = (isset($_POST['article-title']) ? $_POST['article-title']:'');
		$post_id = post_exists($title);
	if (!$post_id) {
		$my_post = array(
				'post_title'    => $title,
				'post_content'  => (isset($_POST['body-text']) ? $_POST['body-text']:''),
				'post_status'   => 'draft',
				'post_type' => 'article-submissions',
				'post_author'   => 1
		);
		$post_ID = wp_insert_post($my_post);
		$category = $_POST['category'];
		$explode = explode('-',$category);
		$catValue = $explode[0].'-';
		if (substr($category, 0, strlen($catValue)) == $catValue) {
	   $categoryData = substr($category, strlen($catValue));
	}
		update_post_meta($post_ID,'wpcf-'.$explode[0],sanitize_text_field($categoryData));
		update_post_meta($post_ID,'wpcf-article-author-name',sanitize_text_field($_POST['article-author']));
		$message = "<b style='color:green'>Thanks for creating Article your article has been saved successfully.</b>";
	}

}
return $message;
}
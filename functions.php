<?php

/**
 * podtheme functions file
 *
 * @package WordPress
 * @subpackage podtheme
 * @since podtheme 1.0
 */

//extra stylesheets
/*function tina_load_css() {
	    wp_enqueue_style( 'tina', get_stylesheet_directory_uri() . '/tina.css' );
}
function is_child($pageID) { 
		global $post; 
		if(is_page($pageID)) {
	               return true;
	       	} else { 
	               return false; 
	       	}
		var_dump($pageID);
}
if ( is_page('tina')) {
	add_action( 'wp_enqueue_scripts', 'tina_load_css' );
}
*/

include 'meta.php';


/******************************************************************************\
	Theme support, standard settings, menus and widgets
\******************************************************************************/
add_filter( 'use_default_gallery_style', '__return_false' );
if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
		        set_post_thumbnail_size( 135, 135, true );
}
//update_option('thumbnail_size_w', 290);
//update_option('thumbnail_size_h', 290);
//update_option('thumbnail_crop', 1);

//test if were on a page or it's grandchildren
function is_tree($pid)
{
	  global $post;

	    $ancestors = get_post_ancestors($post->$pid);


	      if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors)))
		        {
				    return true;
				      }
	        else
			  {
				      return false;
				        }
};

function get_subsite_styles($this_page, $post){
    $checkbox = get_post_custom_values('subsite_checkbox', $this_page);
    $color = get_post_custom_values('subsite_color', $this_page);
    $logo = get_post_custom_values('subsite_imgadv', $this_page);
    $bg = get_post_custom_values('subsite_bg', $this_page);
    $subsite_id = $this_page; 
    if ($checkbox[0] == 1) {
        return array("check" => $checkbox[0], "color" => $color[0], "logo" => $logo[0], "bg" => $bg[0],"subsiteId" => $subsite_id);
    }
    elseif ($post->post_parent > 0) {
        return get_subsite_styles($post->post_parent, '0');
    }
    else {
        return false;
}
}
//test if we're on a subsite, or it's children

//build submenus for pages or their children
// Generate page tree
function subsite_page_tree($this_page) {
	$pagelist = '';
	//if( !$this_page->post_parent ) {
		$children = wp_list_pages('title_li=&child_of='.$this_page.'&echo=0');
		if( $children ) {
			$pagelist .= '<ul id="sub-nav">' . $children . '</ul>';
		}
	return $pagelist;
}

add_action( 'template_redirect', 'singe_post_css' );

function singe_post_css() {
	global $post; 
	if ( is_tree(170)) { //if it's tina or grandchild
		wp_enqueue_style('tina-css', get_stylesheet_directory_uri() . '/tina.css',false,0.1,'screen');
	}         $subsite_styles = get_subsite_styles(get_the_ID(), $post);
	if ($subsite_styles['check'] == 1){
		wp_enqueue_style('subsite', get_stylesheet_directory_uri() . '/subsite.css',false,0.1,'screen');
	}
}


add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'link' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );



add_image_size( 'full-bg', 1440, 900, true ); //fullscreen 

add_image_size( 'profile-image', 135, 135, true ); //300 pixels wide (and unlimited height)
add_image_size( 'hotbutton', 290, 290, true ); 
add_image_size( 'top-banner', 912, 308, true ); 

add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
	    return array_merge( $sizes, array(
		            'profile-image' => __('profile image'),
		            'hotbutton' => __('hotbutton size'),
			        ) );
}

//[person-profile]
function pp_func( $atts, $content = null ){
        return '<div class="person-profile">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'person-profile', 'pp_func' );

function pi_func( $atts, $content = null ){
        return '<div class="profile-image">' . $content . '</div>';
	}
	add_shortcode( 'profile-image', 'pi_func' );

function pt_func( $atts, $content = null ){
        return '<div class="profile-text">' . $content . '</div>';
	}
	add_shortcode( 'profile-text', 'pt_func' );

$custom_header_args = array(
	'width'         => 912,
	'height'        => 300,
	'default-image' => get_template_directory_uri() . '/images/header.png',
);
add_theme_support( 'custom-header', $custom_header_args );

/**
 * Print custom header styles
 * @return void
 */
function podtheme_custom_header() {
	$styles = '';
	if ( $color = get_header_textcolor() ) {
		echo '<style type="text/css"> ' .
				'.site-header .logo .blog-name, .site-header .logo .blog-description {' .
					'color: #' . $color . ';' .
				'}' .
			 '</style>';
	}
}
add_action( 'wp_head', 'podtheme_custom_header', 11 );

$custom_bg_args = array(
	'default-color' => 'fba919',
	'default-image' => '',
);
add_theme_support( 'custom-background', $custom_bg_args );

register_nav_menu( 'main-menu', __( 'Your sites main menu', 'podtheme' ) );

if ( function_exists( 'register_sidebars' ) ) {
	register_sidebar(
		array(
			'id' => 'home-sidebar',
			'name' => __( 'Home widgets', 'podtheme' ),
			'description' => __( 'Shows on home page', 'podtheme' )
		)
	);

	register_sidebar(
		array(
			'id' => 'footer-sidebar',
			'name' => __( 'Footer widgets', 'podtheme' ),
			'description' => __( 'Shows in the sites footer', 'podtheme' )
		)
	);
	register_sidebar(
		array(
			'id' => 'shop-sidebar',
			'name' => __( 'Shop widgets', 'podtheme' ),
			'description' => __( 'Shows in the sites footer', 'podtheme' )
		)
	);
}

if ( ! isset( $content_width ) ) $content_width = 650;

/**
 * Include editor stylesheets
 * @return void
 */
function podtheme_editor_style() {
    add_editor_style( 'css/wp-editor-style.css' );
}
add_action( 'init', 'podtheme_editor_style' );


/******************************************************************************\
	Scripts and Styles
\******************************************************************************/

/**
 * Enqueue podtheme scripts
 * @return void
 */
function podtheme_enqueue_scripts() {
	wp_enqueue_style( 'podtheme-styles', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'default-scripts', get_template_directory_uri() . '/js/scripts.min.js', array(), '1.0', true );
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'podtheme_enqueue_scripts' );


/******************************************************************************\
	Content functions
\******************************************************************************/

/**
 * Displays meta information for a post
 * @return void
 */
function podtheme_post_meta() {
	if ( get_post_type() == 'post' ) {
		echo sprintf(
			__( 'Posted %s in %s%s by %s. ', 'podtheme' ),
			get_the_time( get_option( 'date_format' ) ),
			get_the_category_list( ', ' ),
			get_the_tag_list( __( ', <b>Tags</b>: ', 'podtheme' ), ', ' ),
			get_the_author_link()
		);
	}
	edit_post_link( __( ' (edit)', 'podtheme' ), '<span class="edit-link">', '</span>' );

}
//woocommerce shop
//dont use the woo template
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
//set wrapper
function my_theme_wrapper_start() {
	  echo '<section id="main" class="page-content primary">';
}

function my_theme_wrapper_end() {
	  echo '</section>';
}
//css  remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
//fix breadcrumbs
add_filter( 'woocommerce_breadcrumb_defaults', 'd_woo_breadcrumb_defaults');
function d_woo_breadcrumb_defaults($defaults) {
	$defaults['delimiter'] = '&nbsp;&raquo;&nbsp;'; //whatever delimiter you want
	return $defaults;
}
//customise the category view
//remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
//add_action( 'woocommerce_after_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

add_action( 'woocommerce_after_subcategory_title', 'my_add_cat_description', 10);

//remove_action( 'woocommerce_after_main_content', 'woocommerce_get_sidebar', 10);
//add_action( 'woocommerce_before_main_content', 'woocommerce_get_sidebar', 10);
function my_add_cat_description ($category) {
	$cat_id=$category->term_id;
	$prod_term=get_term($cat_id,'product_cat');
	$description=$prod_term->description;
	echo '<div class="shop_cat_desc">'.$description.'</div>';
}
//single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5);
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

	 unset($tabs['reviews']);

	  return $tabs;
}
remove_action( 'woocommerce_after_single_product_summary', 
	'woocommerce_output_related_products', 20);
function wpa_123136_no_shipping( $needs_shipping, $product ){
	  if( $product->get_shipping_class() == 'local-pickup-only' ){
		      $needs_shipping = false;
		        }
	    return $needs_shipping;
}
add_filter('woocommerce_product_needs_shipping','wpa_123136_no_shipping', 10, 2 );
//bsb label on bacs
function wpse_77783_woo_bacs_ibn($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'Sort Code':
                $translation = 'BSB';
                break;
 
        }
    }
 
    return $translation;
}
 
add_filter('gettext', 'wpse_77783_woo_bacs_ibn', 10, 3);

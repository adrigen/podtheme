<?php
/**
 * podtheme template for displaying the header
 *
 * @package WordPress
 * @subpackage podtheme
 * @since podtheme 1.0
 */
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie-no-support" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title( ); ?></title>
		<meta name="viewport" content="width=device-width" />
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
<header class="navigation">
  <div class="menu-wrapper">
    <a href="http://octapod.org" class="logo">
      <img src="/wp-content/themes/podtheme/images/logo.png" href="<?php echo home_url(); ?>" alt="<?php bloginfo( 'name' ); ?>" title="">
    </a>
    <p class="navigation-menu-button" id="js-mobile-menu">MENU</p>
    <div class="nav">
<?php

$nav_menu = wp_nav_menu(
	array(
		'container' => 'nav',
		'container_class' => 'main-menu',
		'items_wrap' => '<ul class="%2$s">%3$s</ul>',
		'theme_location' => 'main-menu',
		'fallback_cb' => '__return_false',
	)
); ?>
      
    </div>
    <!--<div class="navigation-tools">
      <div class="search-bar">
        <div class="search-and-submit">
          <input type="search" placeholder="Enter Search" />
          <button type="submit">
            <img src="https://raw.githubusercontent.com/Magnus-G/Random/master/search-icon.png" alt="">
          </button>
        </div>
      </div>
      <a href="javascript:void(0)" class="sign-up">Sign Up</a>
    </div>-->
  </div>
</header>
<div class="subsite-header">
<?php

if ( is_tree(170)) { //is it tina or grandchild?
	
?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <img class="feature-image-for-page" src="<?php echo $image[0]; ?>" alt="" />
			 

<img class="page-logo" src="http://octapod.org/wordpress-2013/wp-content/themes/podtheme/images/art-img.png" alt="This Is Not Art" /> 
            	<div id="sub-nav">
                	
<?php
$defaults = array(
		'menu'            => 'tina_menu',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'items_wrap'      => '<ul>%3$s</ul>',
		);
wp_nav_menu( $defaults );

?>
                </div>
<?php
} else if ( is_tree(55)){ //is it podspace or grandchild?
?>

<img class="page-logo" src="http://octapod.org/wordpress-2013/wp-content/themes/podtheme/images/podspace-logo.gif" alt="PODspace" /> 
            	<div id="sub-nav">
                	
<?php
$defaults = array(
		'menu'            => 'podaspace',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'items_wrap'      => '<ul>%3$s</ul>',
		);
wp_nav_menu( $defaults );

?>
</div>
<?php
}
?>
</div><!--end subsite-header-->
<div class="site">

<?php

if ( is_tree(55)) { //is it podspace or grandchild?
	
?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <img class="podspace feature-image-for-page" src="<?php echo $image[0]; ?>" alt="" />
<?php } ?>

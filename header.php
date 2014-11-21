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
		<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
		<meta name="viewport" content="width=device-width" />
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

<header class="navigation">
  <div class="menu-wrapper">
  <a href="<?php echo home_url(); ?>" class="logo">
      <img src="http://octapod.org/wordpress-2013/wp-content/themes/podtheme/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" title="">
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

<!-- banner start -->

		<?php if(is_front_page()){ ?>
<div class="home-box">
	<div class="slider">
        	<div class="flexslider">
          		<ul class="slides">
		  <?php $args = array(
	'posts_per_page'   => 5,
	'category'		   => 22,
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => 'slider',
	'post_status'      => 'publish',
	'suppress_filters' => true ); ?>
	<?php $myposts = get_posts( $args ); 
	$key = 'link';
	?>
	
			<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<?php $thumbnail = get_post_thumbnail_id($post->ID); $image = wp_get_attachment_image_src(( $thumbnail ), 'single-post-thumbnail' ); $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);?>
	<li><a href="<?php echo get_post_meta($post->ID, $key, true); ?>" title=""><?php echo get_the_post_thumbnail( $post->ID, 'top-banner'); ?></li>

			<?php endforeach;  wp_reset_postdata();?>
         
          		</ul>
        	</div>
        </div>


        <div id="ticker">                 
                	<?php $args = array(
	'posts_per_page'   => 3,
	'orderby'          => 'post_date',
	'order'            => 'DSC',
	'post_status'      => 'publish',
	'suppress_filters' => true ); ?>
	<?php $myposts = get_posts( $args ); ?> 
	<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
 					<div class="slide"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>	
	<?php endforeach;  wp_reset_postdata();?>
	</div>



<div class="hotlinks">
						<?php $args = array(
	'posts_per_page'   => 5,
	'category'		   => 21,
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'post_type'        => 'slider',
	'post_status'      => 'publish',
	'suppress_filters' => true ); ?>
	<?php $myposts = get_posts( $args ); ?>
 



	
			<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'hotbutton' ); ?>
 
<div class="hotlink-single"
style="background-image:url('<?php $postid = $post->ID; echo $image[0] ?>')" 
>	
	<a href="<?php  echo get_post_meta($postid, 'link', true); ?>" 
	   class="text-over-image">
            <p class="text-over-image-small"><?php  echo get_post_meta($postid, 'text_over_image_small', true); ?></p>
	    <p class="text-over-image-large"><?php  echo get_post_meta($postid, 'text_over_image', true); ?></p>
	</a>
</div>

	<?php endforeach;  wp_reset_postdata();?>

          				


  
</div>



</div>
		<?php } ?>




<div class="subsite-header">
<?php $subsite_styles = get_subsite_styles(get_the_ID(), $post); ?>
<?php 
 if ($subsite_styles['logo']) {
    echo wp_get_attachment_image($subsite_styles['logo'], 'id');
    }
 ?>
  <?php 
 if ($subsite_styles['check']) {
	if( function_exists( 'subsite_page_tree') && subsite_page_tree($subsite_styles['subsiteId']) != '' ) :?>
         
	<?php echo subsite_page_tree($subsite_styles['subsiteId']);?>
	<?php endif;?>
<?php
}

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
	}?> </div><!--end subsite-header-->
<div class="site">

<?php if ($subsite_styles['bg'] && $subsite_styles['subsiteId']==get_the_id()) { 
$attr = array(
	'id'	=> "subsitebg",
	'class'	=> "subsite-parent-bg",

);
    echo wp_get_attachment_image($subsite_styles['bg'], 'full-bg', 0, $attr);
    }
 ?>

<?php

if ( is_tree(999)) { //is it podspace or grandchild?55
	
?>
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <img class="podspace feature-image-for-page" src="<?php echo $image[0]; ?>" alt="" />
<?php } ?>

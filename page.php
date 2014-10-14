<?php
/**
 * podtheme template for displaying Pages
 *
 * @package WordPress
 * @subpackage podtheme
 * @since podtheme 1.0
 */

get_header(); ?>

<!-- get all meta values for page -->
<?php
$subsite_styles = get_subsite_styles(get_the_ID(), $post);
?>

<!-- override colors with subsite parent's -->
<STYLE TYPE="text/css" MEDIA=screen>

  a  { color: <?php echo $subsite_styles['color'];?> }
body #sub-nav {
border-bottom: 4px solid <?php echo $subsite_styles['color'];?>;
}
h1 {
color: <?php echo $subsite_styles['color'];?>;
}
</STYLE>



		<!-- featured Image For page -->

		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-width' ); ?>
		<img class="feature-image-for-page" src="<?php echo $image[0]; ?>" alt="" />
		
	<!-- Finish featured Image For page -->

	<section class="page-content primary" role="main">
<?php if(function_exists('simple_breadcrumb')) {simple_breadcrumb();} ?>

		<?php
			if ( have_posts() ) : the_post();
				
			        
				get_template_part( 'loop' ); ?>

				<aside class="post-aside"><?php

					wp_link_pages(
						array(
							'before'           => '<div class="linked-page-nav"><p>' . sprintf( __( '<em>%s</em> is separated in multiple parts:', 'podtheme' ), get_the_title() ) . '<br />',
							'after'            => '</p></div>',
							'next_or_number'   => 'number',
							'separator'        => ' ',
							'pagelink'         => __( '&raquo; Part %', 'podtheme' ),
						)
					); ?>

					<?php
						if ( comments_open() || get_comments_number() > 0 ) :
							comments_template( '', true );
						endif;
					?>

				</aside><?php

			else :

				get_template_part( 'loop', 'empty' );

			endif;
		?>

	</section>

<?php get_footer(); ?>

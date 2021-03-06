<?php
/**
 * podtheme template for displaying the standard Loop
 *
 * @package WordPress
 * @subpackage podtheme
 * @since podtheme 1.0
 */
?>
<?php if(!is_front_page()){ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php //$pageid = get_the_ID(); echo get_the_post_thumbnail($pageid, 'thumbnail'); ?>
	<h1 class="post-title"><?php

		if ( is_singular() ) :
			the_title();
		else : ?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php
				the_title(); ?>
			</a><?php

		endif; ?>

	</h1>

	<div class="post-meta"><?php
		podtheme_post_meta(); ?>
	</div>

		<div class="post-content">


		<?php if ( is_front_page() || is_category() || is_archive() || is_search() ) : ?>

			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'podtheme' ); ?></a>

		<?php else : ?>

			<?php the_content( __( 'Continue reading &raquo', 'podtheme' ) ); ?>

		<?php endif; ?>

		<?php
			wp_link_pages(
				array(
					'before'           => '<div class="linked-page-nav"><p>'. __( 'This article has more parts: ', 'podtheme' ),
					'after'            => '</p></div>',
					'next_or_number'   => 'number',
					'separator'        => ' ',
					'pagelink'         => __( '&lt;%&gt;', 'podtheme' ),
				)
			);
		?>

	</div>

</article>
		<?php } ?>

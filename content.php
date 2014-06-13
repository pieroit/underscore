<?php
/**
 * @package underscore
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<a href=<?php  the_permalink(); ?>>
			<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail'); ?>
		</a>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
		<?php the_excerpt(); ?>
		<?php if( ! wp_is_mobile() ) : ?>
			<a href=<?php  the_permalink(); ?>>
				<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
			</a>
		<?php endif; ?>
		<!--<a href=<?php  the_permalink(); ?>>
			Read more...
		</a>-->
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'underscore' ),
				'after'  => '</div>',
			) );
		?>
	
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->

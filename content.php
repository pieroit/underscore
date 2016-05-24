<?php
/**
 * @package underscore
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-summary">
		<a href=<?php  the_permalink(); ?>>
			<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail'); ?>
		</a>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-## -->

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
		<a href=<?php  the_permalink(); ?>>
			<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
		</a>
		<?php the_excerpt(); ?>
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

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

			<?php underscore_posted_on(); ?>
			
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'underscore' ) );
				if ( $categories_list && underscore_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( ' in %1$s', 'underscore' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'underscore' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'underscore' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'underscore' ), __( '1 Comment', 'underscore' ), __( '% Comments', 'underscore' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'underscore' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

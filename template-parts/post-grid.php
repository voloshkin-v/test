<article <?php post_class('post-item'); ?> >
	<?php
		if ( has_post_thumbnail () ) {
			?>
			<a class="post-item__img" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium' ); ?>
			</a>
			<?
		}
	?>

	<a href="<?php the_permalink(); ?>" class="post-item__title"><?php the_title(); ?></a>

	<div class="post-item__description">
		<?php
			if ( has_excerpt() ) {
				echo wp_trim_words( get_the_excerpt(), 25 );
			} else if ( !empty (get_the_content()) ) {
				echo wp_trim_words( get_the_content(), 25 );
			} else {
				echo _e( 'No excerpt and no content...', 'test' );
			}
		?>
	</div>

	<div class="post-item__date">
		<span>
			<?php _e( 'Date of publised:', 'test' ); ?>
		</span>

		<?php echo get_the_date(); ?>
	</div>

	<a href="<?php the_permalink(); ?>" class="post-item__read-more"><?php _e( 'Ream more', 'test' ); ?></a>
</article>
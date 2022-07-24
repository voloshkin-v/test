<?php
	$title = get_the_title();
	$description = get_the_excerpt();
	$image = get_the_post_thumbnail();
?>

<article <?php post_class('single-item'); ?> id="<?php the_ID(); ?>">
	<?php
		if ( has_post_thumbnail () ) {
			?>
				<a href="<?php echo the_permalink(); ?>" class="single-item__image">
					<?php echo $image; ?>
				</a>
			<?
		}
	?>

	<div class="single-item__content">
			<?php if ( ! empty( $title ) ) {?>
				<a href="<?php echo the_permalink(); ?>" class="single-item__title"><?php echo $title; ?></a>
			<?} ?>

			<div class="single-item__description">
				<?php
					if ( has_excerpt() ) {
						echo wp_trim_words( $description, 25 );
					} else if ( !empty (get_the_content()) ) {
						echo wp_trim_words( get_the_content(), 25 );
					} else {
						echo _e( 'No excerpt and no content...', 'test' );
					}
				?>
			</div>

			<a href="<?php the_permalink(); ?>" class="single-item__read-more">
				<?php _e('Read more', 'test'); ?>
			</a>
	</div>
</article>
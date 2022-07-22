<?php get_header();  ?>

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();
			?>
				<article class='post-single'>
					<div class="container">
						<?php
							if ( has_post_thumbnail () ) {?>
								<div class="post-single__image">
									<?php the_post_thumbnail( 'large' ); ?>
								</div>
							<?}
						?>

						<div class="post-single__title"><?php the_title(); ?></div>

						<?php
							$categories = get_the_category();
							?>
								<div class='post-single__cat'>
									<?php
										_e('Categories of post: ', 'test');

										foreach ($categories as $cat) {
											echo $cat -> name . ', ';
										}
									?>
								</div>
							<?


						?>

						<?php
							$content = get_the_content();

							if ( ! empty ( $content )) {?>
								<div class="post-single__content">
									<?php echo $content; ?>
								</div>
							<?}
						?>

						<div class="post-single__date">
							<span>
								<?php _e('Date of publised:', 'test') ?>
							</span>
							<?php the_date(); ?>
						</div>
					</div>
				</article>
			<?
		}
	}
?>

<?php get_footer(); ?>
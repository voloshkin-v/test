<?php get_header(); ?>

<section class='tax-section'>
	<div class="container">
		<?php
			$tax = get_queried_object();
			?>
				<h1>
					<?php _e('Job offers: ', 'test');
					echo $tax->name ?>
				</h1>
			<?
		?>

		<div class="row">
			<?php
				$term_id = get_queried_object()->term_id;

				$args = array(
					'post_type' => 'job',
					'tax_query'	=> array(
						array(
							'taxonomy' => 'job_offers',
							'field'	   => 'term_id',
							'terms'	   => array($term_id)
						),
					),
				);

				$query = new WP_Query($args);

				if ($query -> have_posts()) {
					while ($query -> have_posts()) {
						$query->the_post();

						$title = get_the_title();
						$descr = get_the_excerpt();
						$image = get_the_post_thumbnail();

						?>
							<div class="single-item" id="<?php the_ID(); ?>">
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

										<div class="single-item__descr">
											<?php if ( has_excerpt() ) {
												echo $descr;
											} else {
												_e('Ooops... forgot add description....', 'test');
											} ?>
										</div>

										<a href="<?php the_permalink(); ?>" class="single-item__read-more">
											<?php _e('Read more', 'test'); ?>
										</a>
								</div>
							</div>
						<?
					}
				}
			?>
		</div>


	</div>
</section>

<?php get_footer(); ?>
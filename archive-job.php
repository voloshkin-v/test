<?php get_header(); ?>

<section class='job'>
	<div class="container">
		<?php
			$title = wp_unslash( get_field('job_title', 'option') );

			$allowed_html = array(
				'a' => [
					'href' => true
				],
				'br' => array(),
				'em' => array(),
				'strong' => array()
			);

			if ( ! empty( $title ) ) {
				?><h1><?php echo wp_kses( $title, $allowed_html ); ?></h1><?
			}
		?>

		<div class="job__wrapper">
			<?php
				$tax = 'job_offers';

				$terms = get_terms( [
					'taxonomy' => $tax,
					'hide_empty' => false,
				] );

				foreach($terms as $term) {
					$term_link = get_term_link( $term );
					$image_taxonomy = get_field('image_taxonomy', 'term_' . $term -> term_id);


					if ($term -> count > 0) {
						?>
							<a href='<?php echo $term_link; ?>' class="job-tax">
								<img src="<?php echo $image_taxonomy['url']; ?>" alt="term bg" class="job-tax__bg">

								<div class="job-tax__title">
									<?php echo $term->name; ?>
								</div>
							</a>
						<?
					}
				}
			?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
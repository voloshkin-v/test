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


		<?php
			if( have_posts() ) {
				?>
				<div class="row">
				<?
					while ( have_posts() ) {
						the_post();

						get_template_part('template-parts/post-item');
					}
				?>
				</div>
				<?
			} else {
				_e('No posts', 'test');
			}

			// $term_id = get_queried_object()->term_id;

			// $args = array(
			// 	'post_type' => 'job',
			// 	'tax_query'	=> array(
			// 		array(
			// 			'taxonomy' => 'job_offers',
			// 			'field'	   => 'term_id',
			// 			'terms'	   => array($term_id)
			// 		),
			// 	),
			// );

			// $query = new WP_Query($args);


			// if ($query -> have_posts()) {
				// while ($query -> have_posts()) {
					// $query->the_post();

					// get_template_part('template-parts/post-item');
				// }
			// }
		?>
	</div>
</section>

<?php get_footer(); ?>
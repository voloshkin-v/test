<?php get_header(); ?>

<?php
	global $wp_query;
?>


<section class='posts' id="post-0">
	<div class="container">
		<?php
			$title = wp_unslash( get_field('posts_title', 'option') );

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

		<?php
			if( have_posts() ) {
			?>
				<div class="row row--ajax" id="row-1"
					data-page="<?php echo get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ?>"
					data-max="<?php echo $wp_query->max_num_pages;?>"
				>
					<?php while ( have_posts() ) {
						the_post();
						?>
							<?php
							get_template_part('template-parts/post-grid');
							 ?>
						<?
					}?>
				</div>

				<?php
					$args = array(
						'show_all'     => false,
						'end_size'     => 1,
						'mid_size'     => 2,
						'prev_next'    => true,
						'prev_text'    => __('«'),
						'next_text'    => __('»'),
						'screen_reader_text' => __( 'Posts navigation' ),
						'class'        => '',
					);

					the_posts_pagination( $args );
				?>
			<?
			} else {
				_e('ooops... no found :(', 'test');
			}
		?>
	</div>
</section>

<?php
	$categories = get_categories();
	$currentModule = 1;

	if ( $categories ) {
		?>
			<div class="container">
				<h2 class='has-align-center'>Posts by CATEGORIES</h2>
			</div>
		<?

		foreach ( $categories as $cat ) {
			$cat_name = $cat->name;
			$cat_count = $cat->count;

			$current_page = ! empty( $_GET['module'.$currentModule.'-page'] ) ? intval( $_GET['module'.$currentModule.'-page'] ) : 1;

			$args = array(
				'category_name' => $cat->name,
				'paged'          => $current_page
			);

			$query = new WP_Query( $args );

			?>
				<section class='posts' id="<?php echo "post-$currentModule"; ?>" data-term="<?php echo $cat_name; ?>" data-page="<?php echo 1; ?>" data-pages="<?php echo $query->max_num_pages; ?>">
					<div class="container">
						<h2><?php echo 'CATEGORY: ' . $cat_name; ?></h2>
						<p><?php _e('Count of posts: ', 'test'); echo $cat_count; ?></p>

						<div class="row">
							<?php
								if ( $query->have_posts() ) {
									while ( $query->have_posts() ) {
										$query->the_post();
										?>
											<?php get_template_part('template-parts/post-grid'); ?>
										<?php
									}
								}
								else {
									_e('No posts in category.', 'test');
								}

								wp_reset_postdata();
							?>
						</div>

						<?php if ($query->max_num_pages > 1) : ?>
							<button class='load-more'>Load More</button>
						<?php endif;?>

						<!-- <div class="navigation"> -->
							<?php
								// echo paginate_links([
								// 	'format'	   => '?module'.$currentModule.'-page=%#%',
								// 	'current'      => $current_page,
								// 	'total'        => $query->max_num_pages,
								// 	'prev_text'    => sprintf( '<i></i> %1$s', __( '«', 'test' ) ),
								// 	'next_text'    => sprintf( '%1$s <i></i>', __( '»', 'test' ) ),
								// ]);
							?>
						<!-- </div> -->
					</div>
				</section>
			<?

			$currentModule++;
		}
	}
?>

<?php get_footer(); ?>

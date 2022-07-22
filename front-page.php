<?php get_header(); ?>

<section class='socials'>
	<h2><?php _e('Follow us. Our socials:', 'test') ?></h2>

	<?php if( have_rows('socials_links', 'option') ): ?>
		<ul class="socials__list">
			<?php while( have_rows('socials_links', 'option') ): the_row(); ?>
				<li>
					<a href="<?php the_sub_field('url'); ?>" target="_blank">
						<img src="<?php the_sub_field('icon'); ?>">
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
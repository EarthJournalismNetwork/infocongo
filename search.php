<?php get_header(); ?>

<div class="container">
	<div class="row">
		<h1><?php _e('Search results for:', 'infocongo'); ?> <?php echo $_GET['s']; ?></h1>
	</div>
	<div class="row">
		<div class="eight columns">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="search-results">
				<?php the_post_thumbnail('archive-list'); ?>
				<h2 class="list-title"><?php the_title(); ?></h2>
				<p class="result-excerpt"><?php the_excerpt(); ?></p>
				<a href="<?php echo get_permalink(); ?>" class="button read-more"><?php _e('Read More', 'infocongo'); ?></a>
			</div>
			<?php endwhile; ?>
		<?php endif; ?>
		</div>
		<div class="one column spacer"></div>
		<div class="three columns">
			<div class="sidebar widgets">
				<?php dynamic_sidebar('General Sidebar'); ?>
			</div>
		</div>
	</div>
</div>



<?php get_footer(); ?>
<?php get_header(); ?>

<section id="content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<div id="page" class="gray-page">
		<div class="container row">
			<div class="eight offset-by-two columns">
				<article id="post-<?php the_ID(); ?>" <?php post_class('main'); ?>>
						<header class="page-header">
							<h1 class="page-title"><?php the_title(); ?></h1>
						</header>
						<section class="post-content">
							<?php the_content(); ?>
						</section>
				</article>
			</div>
		</div>
	</div>
<?php endwhile; endif; ?>
</section>

<?php get_footer(); ?>
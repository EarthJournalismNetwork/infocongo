<?php get_header(); ?>

<section id="content">
	<div id="map-archive" class="gray-page archive-page">
		<div class="container">
				<?php if(have_posts()) : ?>

					<section id="maps" class="map-loop-section archive-list">
							<div class="twelve columns">
						<header class="page-header">
								<h1><?php $author_name = get_author_name( $user_id );
									echo  $author_name;
								?></h1>
						</header>
							</div>
						<?php get_template_part('loop'); ?>
					</section>

				<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
<?php get_header(); ?>

<section id="content">
	<div id="map-archive" class="gray-page archive-page">
		<?php if(have_posts()) : ?>

			<section id="datasets" class="dataset-loop-section archive-list container">
				<div class="page-header">
					<div class="row">
						<div class="twelve columns">
							<h1 class="archive-header"><?php _e('Datasets', 'infocongo'); ?></h1>
						</div>
					</div>
				</div>

				<div class="row">
					<?php get_template_part('loop', 'dataset'); ?>

					<div class="offset-by-one column three columns">

						<div class="row sources sidebar-item">
							<h3><?php _e('Sources', 'infocongo'); ?></h3>
							<ul>
								<?php wp_list_categories(array(
									'taxonomy' => 'source',
									'title_li' => ''
								)); ?>
							</ul> 
						</div>

						<div class="row licenses sidebar-item">
							<h3><?php _e('Licenses', 'infocongo'); ?></h3>
							<ul>
								<?php wp_list_categories(array(
									'taxonomy' => 'license',
									'title_li' => ''
								)); ?>
							</ul> 
						</div>
					</div>
				</div>
			</section>

		<?php endif; ?>
	</div>
</section>


<?php get_footer(); ?>
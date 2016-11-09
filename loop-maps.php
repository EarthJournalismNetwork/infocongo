<ul class="list-maps clearfix">
	<?php while(have_posts()) : the_post(); ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
			<article class="clearfix">
				<div class="map-list-thumb">
					<?php if(has_post_thumbnail()) {
						echo '<a href="' . get_permalink() .'" title="' . get_the_title() . '">' . get_the_post_thumbnail($post->ID, 'archive-list') . '</a>';
					} else {
						echo '<div class="nothumb map-list"></div>';
					}

					?>
				</div>
				<div class="map-list-info">
					<header class="post-header">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<section>
						<?php echo excerpt(35); ?>
					</section>
				</div>
			</article>
		</li>
	<?php endwhile; ?>
</ul>
<div class="twelve columns">
	<?php if(function_exists('wp_paginate')) wp_paginate(); ?>
</div>
<ul class="list-posts row">
	<?php while(have_posts()) : the_post(); ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class('post-item four columns'); ?>>
			<article class="loop-item">
				<header class="post-header">
					<div class="loop-list-thumb">
						<?php
						if(has_post_thumbnail()) {
							echo '<a href="' . get_permalink() .'" title="' . get_the_title() . '">' . get_the_post_thumbnail($post->ID, 'loop-list') . '</a>';
						} else {
							echo ' <div class="nothumb loop-list"></div>';
						}
						?>
					</div>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
					<h2 class="loop-post-title"><a href="<?php the_permalink(); ?>"><?php echo title(10); ?></a></h2>
				</header>
				<div class="post-content">
					<?php echo excerpt(20); ?>
				</div>
				<footer class="post-actions">
					<div class="buttons">
						<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more', 'infoamazonia'); ?></a>
						<a class="button" href="<?php echo jeo_get_share_url(array('p' => $post->ID)); ?>"><?php _e('Share', 'infoamazonia'); ?></a>
					</div>
				</footer>
			</article>
		</li>
	<?php endwhile; ?>
</ul>
<div class="twelve columns">
	<?php if(function_exists('wp_paginate')) wp_paginate(); ?>
</div>
<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$('.list-posts').imagesLoaded(function() {

				var $media = $('.list-posts .media-limit img');

				$media.each(function() {

					var containerHeight = $(this).parents('.media-limit').height();
					var imageHeight = $(this).height();

					var topOffset = (containerHeight - imageHeight) / 2;

					if(topOffset < 0) {
						$(this).css({
							'margin-top': topOffset
						});
					}

				});

			});
		});

		jeo.mapReady(function(map) {
			$('.list-posts li').click(function() {
				var markerID = $(this).attr('id');
				$('html,body').animate({
					scrollTop: $('#stage').offset().top
				}, 400);
				map.markers.openMarker(markerID, false);
				return false;
			});
			$('.list-posts li .button').click(function() {
				window.location = $(this).attr('href');
			});
		});
	})(jQuery);
</script>
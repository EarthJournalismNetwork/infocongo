<?php get_header(); ?>
	<div id="map-archive" class="gray-page archive-page">
		<section id="maps" class="map-loop-section archive-list">
			<header class="map-header">
			<?php infocongo_taxonomy_filter('Choose a topic', 'topic'); ?>
			</header>
			<div class="taxonomy-map">
				<?php
					global $jeo;
					$jeo->get_map(false, false, true); 
				?>
			</div>
			<div class="query-actions">
							<?php
							global $wp_query;
							$args = $wp_query->query;
							$args = array_merge($args, $_GET);
							$geojson = jeo_get_api_url($args);
							$download = jeo_get_api_download_url($args);
							$rss = add_query_arg(array('feed' => 'rss'));
							?>
							<a class="rss" href="<?php echo $rss; ?>"><?php _e('RSS Feed', 'infocongo'); ?></a>
							<a class="geojson" href="<?php echo $geojson; ?>"><?php _e('Get GeoJSON', 'infocongo'); ?></a>
							<a class="download" href="<?php echo $download; ?>"><?php _e('Download', 'infocongo'); ?></a>
						</div>
			<div class="container">
				<div class="twelve columns">
					<?php get_template_part('loop'); ?>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>
						
					
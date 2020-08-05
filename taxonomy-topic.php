<?php get_header(); ?>
	<div id="map-archive" class="gray-page archive-page">
		<section id="maps" class="map-loop-section archive-list">
			<header class="map-header">
			<?php infocongo_taxonomy_filter('Choose a topic', 'topic'); ?>
			</header>
			<div class="taxonomy-map">
				<?php
					global $jeo;
					// $jeo->get_map(false, false, true);

					$term_slug = get_query_var( 'term' );

					// by mohjak: fixed issue#4 topic map id
					if ( $term_slug === 'conservation'
						|| $term_slug === 'forests'
						|| $term_slug === 'environmental-conflict'
					) {
						$jeo->get_map(30, false, true);
					} else if ( $term_slug === 'industry'
						|| $term_slug === 'food'
					) {
						$jeo->get_map(4, false, true);
					} else if ( $term_slug === 'energy' ) {
						$jeo->get_map(67, false, true);
					} else if ( $term_slug === 'environmental-crime' ) {
						$jeo->get_map(209, false, true);
					} else if ( $term_slug === 'biodiversity') {
						$jeo->get_map(30, false, true);
					} else {
						$jeo->get_map(false, false, true);
					}

				?>
			</div>
			<div class="container">
				<div class="row">
					<div class="twelve columns">
						<div class="section-title">
						<h1>All posts about <?php echo single_term_title(); ?></h1>
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
						</div>
					</div>
					<div class="row">
						<div class="twelve-coluns">
							<?php get_template_part('loop'); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php get_footer(); ?>


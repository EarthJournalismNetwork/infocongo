<?php get_header(); ?>


<?php if(have_posts()) : the_post(); ?>

	<div id="single-post-map" class="container">
		<div class="twelve columns">
			<?php get_template_part('stage', 'map'); ?>
		</div>
	</div>
	<article id="single-post">
		<section>
			<div class="container-fluid special-report-style">

				<div class="row post-header">
					<div class="twelve columns">
						<h1><?php the_title(); ?></h1>
						<?php if(has_post_thumbnail()) {
							echo get_the_post_thumbnail();
						} else {
							echo '<div class="nothumb map-list"></div>';
						}

						?>
						<p class="post-excerpt"><?php the_excerpt(); ?></p>
					</div>
				</div>

				
				<div class="row ">
					<!-- <div class="post-content ten offset-by-one columns"> -->
                        <!-- Show map depending on a variable -->
                        <?php
                            // Get the variable show_map.
                            //$show_map = get_post_meta($post->ID, 'show_map', true);

                            // $show_map value yes, "" or no.
                            // When is yes o "" show the map.
                            // When is no not show the map.
                            //if($show_map != 'no'){
                        ?>
						<!-- <div style="width:100%;height:500px; margin-bottom:40px;"> -->
							<?php
							// global $jeo;
							// $jeo->get_map(false, false, true);
							?>
						<!-- </div> -->
                        <?php
                            //} 
                        ?>
                        <!-- End of map display depending on a variable -->
						<?php //the_content(); ?>
						<?php //$value = get_field( "article_url" );
							// if( $value ) {
							//     echo  '<p>Click <a href="' . $value . '">here</a> to read the original article. </p>';
							// }
						?>
						<?php //echo do_shortcode('[shareaholic app="share_buttons" id="19469300"]'); //share buttons ?>
						<?php //rp4wp_children(); //Related posts ?>
						<?php
							// if ( comments_open() || get_comments_number() ) :
							// 	comments_template();
							// endif;
						?>
					<!-- </div> -->

					<script type="text/javascript">
						var embedUrl = jQuery('.embed-button').attr('href');
						var printUrl = jQuery('.print-button').attr('href');
						jeo.mapReady(function(map) {
							if(map.conf.postID) {
								jQuery('.print-button').attr('href', printUrl + '&map_id=' + map.conf.postID + '#print');
								jQuery('.embed-button').attr('href', embedUrl + '&map_id=' + map.conf.postID);
							}
						});
						jeo.groupReady(function(group) {
							jQuery('.print-button').attr('href', printUrl + '&map_id=' + group.currentMapID + '#print');
							jeo.groupChanged(function(group, prevMap) {
								jQuery('.print-button').attr('href', printUrl + '&map_id=' + group.currentMapID + '#print');
							});
						});
					</script>
				</div>

				<div class="container">
					<div class="row post-meta">
					<div class="ten offset-by-one columns ">
						<div class="one-third column">
						<span class="icon_pencil"></span>
						<span class="info"><b>
							<?php echo get_the_date(); ?>
							<?php echo get_the_term_list( $post->ID, 'publisher', ' | ', ', ' ); ?>
							<?php echo ' <a> | </a>'; ?>
							<?php $author_name =  the_author_posts_link( $user_id ); echo $author_name; ?>
						</b></span>
						</div>
						<div class="one-third column"><span class="icon_pin_alt"></span><span class="info"><b><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></b></span></div>
						<div class="one-third column"><span class="icon_tag_alt"></span><span class="info"><b><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></b></span></div>
					</div>
				</div>
				</div>
			</div>
		</section>
	</article>
<?php endif; ?>


<?php get_footer(); ?>

<?php get_header(); ?>
<script>
	$.noConflict();
	jQuery( document ).ready(function( $ ) {

		var $topic_list = $('#topic-list li');
		var $topic_content = $('.topic-content');
		var $topic_ref;

		$topic_list.click(function() {

			$topic_list.removeClass('active');
			$topic_content.removeClass('active');

			$topic_ref = $(this).attr('id');
			$(this).addClass('active');
			$topic_content.each(function() {
				if ($(this).attr('id') == $topic_ref) {
					$(this).addClass('active');
				}
			});
		});

		$topic_list.filter(':first-child').click();

		var $country_list = $('#country-list li');
		var $country_content = $('.country-content');
		var $country_ref;

		$country_list.click(function() {

			$country_list.removeClass('active');
			$country_content.removeClass('active');

			$country_ref = $(this).attr('id');
			$(this).addClass('active');
			$country_content.each(function() {
				if ($(this).attr('id') == $country_ref) {
					$(this).addClass('active');
				}
			});
		});

		$country_list.filter(':first-child').click();

		$("#main-header .menu_responsive .btn_responsive").click(function() {
		    $("#main-nav").slideToggle();
		});
	//})(jQuery);
		// $("#main-header .menu_responsive .btn_responsive").click(function() {
		//     $("#main-nav").slideToggle();
		// });
    });
</script>


<div id="intro" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/examples/intro-header.png)">
	<div class="container">
		<div class="row">
			<div class="six columns offset-by-three column intro-logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-intro.png" alt=""></div>
		</div>
		<div class="row">
			<div class="six columns offset-by-three column intro-text">
				<p><?php $intro = get_bloginfo( 'description'); echo $intro; ?></p>
			</div>
		</div>
	</div>
	<div class="submit-a-story-banner">
		<div class="container">
			<div class="nine columns">
				<p class="take-action"><?php _e('Take action on Congo issues' , 'infocongo'); ?></p>
			</div>
			<div class="three columns">
				<a class="button submit-story"><?php _e('Submit a story', 'infocongo'); ?></a>
			</div>
		</div>
	</div>
</div>

<!-- Featured -->
<?php $first_query = new WP_Query(array('category_name' => 'featured-post', 'posts_per_page' => 1));
	while($first_query->have_posts()) : $first_query->the_post();
?>
	<div id="featured-content">
		<div class="container">
			<div class="row">
				<div class="six columns">
					<?php if(has_post_thumbnail()) {
					    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured' );
					     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
					} else{
							echo '<div class="nothumb featured"></div>';
						}?>
				</div>
				<div id="home-featured" class="six columns">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="featured-meta">
						<div class="meta-author"><span class="meta-icons icon_pencil"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?>
							<?php echo ' <a> | </a>'; ?>
							<?php $author_name =  the_author_posts_link( $user_id ); echo $author_name; ?>
						</p></span></div>
						<div class="meta-country"><span class="meta-icons icon_pin_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></p></span></div>
						<div class="meta-topic"><span class="meta-icons icon_tag_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></p></span></div>
					</div>
					<div class="excerpt"><p><?php echo excerpt(35); ?></p></div>
					<a class="button read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'infocongo'); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>

<!-- Topics -->
	<div class="list-content">
		<div class="container">
			<div class="three columns">
				<h2><?php _e( 'Topics', 'infocongo' ) ?></h2>
				<ul id="topic-list">
					<?php
					$terms = get_terms( 'topic' );
					 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					     foreach ( $terms as $term ) {
					       echo '<li id="' . $term->slug . '">' . $term->name . '</li>';
					     }
					 }
					 ?>
				</ul>
			</div>

			<?php
			$terms = get_terms('topic');
			foreach($terms as $term) :
				$term_query = new WP_Query(array('topic' => $term->slug, 'posts_per_page' => 4));
				if($term_query->have_posts()) :
					?>
					<div id="<?php echo $term->slug; ?>" class="topic-content">
						<ul>
							<?php while($term_query->have_posts()) : $term_query->the_post(); ?>
								<li id="<?php echo $term->slug; ?>-<?php the_ID(); ?>" class="home-post-list">
									<?php if(has_post_thumbnail()) {
									    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
									     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
									} else {
										echo '<div class="nothumb home-list"></div>';
									} ?>
									<h6><a href="<?php the_permalink(); ?>"><?php echo title(10); ?></a></h6>
									<div class="post-list-country">
										<span class="icon_pin_alt"></span>
										<span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
						<div class="all-stories">
							<a href="<?php echo get_term_link($term); ?>" class="button">
								<?php _e('See all stories about this topic', 'infocongo'); ?>
							</a>
						</div>
					</div>
					<?php
				endif;
			endforeach;
			?>

		</div>
	</div>
<?php wp_reset_postdata(); ?>

<!-- Country -->
	<div class="list-content">
		<div class="container">
			<div class="three columns">
				<h2><?php _e( 'Countries', 'infocongo' ) ?></h2>
				<ul id="country-list">
					<?php
					$terms = get_terms( 'country' );
					 if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					     foreach ( $terms as $term ) {
					       echo '<li id="' . $term->slug . '">' . $term->name . '</li>';
					     }
					 }
					 ?>
				</ul>
			</div>

			<?php
			$terms = get_terms( 'country' );
			foreach($terms as $term) :
				$term_query = new WP_Query(array('country' => $term->slug, 'posts_per_page' => 4));
				if($term_query->have_posts()) :
					?>
					<div id="<?php echo $term->slug; ?>" class="country-content">
						<ul>
							<?php while($term_query->have_posts()) : $term_query->the_post(); ?>
								<li id="<?php echo $term->slug; ?>-<?php the_ID(); ?>" class="home-post-list">
									<?php if(has_post_thumbnail()) {
									    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-list' );
									     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
									} else {
										echo '<div class="nothumb home-list"></div>';
									} ?>
									<h6><a href="<?php the_permalink(); ?>"><?php echo title(10); ?></a></h6>
									<div class="post-list-country">
										<span class="icon_pin_alt"></span>
										<span><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></span>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
						<div class="all-stories">
							<a href="<?php echo get_term_link($term); ?>" class="button">
								<?php _e('See all stories about this country', 'infocongo'); ?>
							</a>
						</div>
					</div>
					<?php
				endif;
			endforeach;
			?>

		</div>
	</div>
<?php wp_reset_postdata(); ?>

<?php
	$args = array(
		'cat'	=> 87,
	    'order' => 'ASC'
	);
	$fourth_query = new WP_Query($args);
?>

<!-- Popular -->
<div class="popular-content">
	<div class="container">
		<div class="three columns">
			<h2><?php _e('Popular posts' , 'infocongo' ); ?></h2>
		</div>
		<div class="eight offset-by-one-middle columns">
			<div class="slider">
				<?php while( $fourth_query->have_posts() ) : $fourth_query->the_post(); ?>
					<div id="home-slider">
							<div class="popular-thumb">
							<?php if(has_post_thumbnail()) {
							    $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-slider' );
							     echo '<img src="' . $image_src[0]  . '" width="100%"  />';
							} else {
								echo '<div class="nothumb popular-thumb"></div>';
							} ?>
						</div>
						<div class="slider-content">
							<h2><a href="<?php the_permalink(); ?>"><?php echo title(10); ?></a></h2>
							<div class="excerpt"><p><?php echo excerpt(20); ?></p></div>
						</div>
						<div class="slider-meta">
							<div class="meta-author"><span class="meta-icons icon_pencil"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'publisher', ' ', ', ' ); ?>
								<?php echo ' <a> | </a>'; ?>
								<?php $author_name =  the_author_posts_link( $user_id ); echo $author_name; ?>
							</p></span></div>
							<div class="meta-country"><span class="meta-icons icon_pin_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'country', ' ', ', ' ); ?></p></span></div>
							<div class="meta-topic"><span class="meta-icons icon_tag_alt"></span><span class="meta-content"><p><?php echo get_the_term_list( $post->ID, 'topic', ' ', ', ' ); ?></p></span></div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>

<!-- Maps -->
<div class="list-content">
	<div class="container">
		<div class="three columns">
			<h2><?php _e('Maps' , 'infocongo' ); ?></h2>
		</div>

		<?php
			$query = new WP_Query(
				array(
	    		    'post_type' => 'map',
					'meta_query' => array(
						array(
							'key' => 'show_map_index',
							'value' => 'yes'
						)
					)
				)
			);
		?>
		<!-- <div id="map-archive" class="gray-page archive-page"> -->
		<div id="map-archive" class="map-spotlight">
		<!-- <div id="map-archive" class="topic-content active"> -->
			<div class="container">
				<?php if($query->have_posts()) :?>
					<section id="maps" class="map-loop-section archive-list">
						<ul class="list-maps clearfix">
							<?php while($query->have_posts()) : $query->the_post(); ?>
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
							<?php //if(function_exists('wp_paginate')) wp_paginate(); ?>
						</div>
					</section>
				<?php endif; ?>
			<!-- </div> -->
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>

<?php get_header(); ?>

<section id="content">
	<div id="author-page">
		<?php if(have_posts()) : ?>
			<div  class="container">
				<div class="row">
					<header class="page-header">
							<h1><?php _e('Our team. Nice to meet you!', 'infocongo'); ?></h1>
					</header>
				</div>
				<div class="row">
					<?php while(have_posts()) : the_post(); ?>
						<div class="five offset-by-one columns author-post">
							<div class="author-thumb-box">
									<?php
								if(has_post_thumbnail()) {
									echo get_the_post_thumbnail($post->ID, 'author-thumb');
								} else {
									echo ' <div class="nothumb loop-list"></div>';
								}
								?>
							</div>
							<h2 class="name"><?php echo the_title(); ?></h2>
							<div class="occupation"><?php echo the_excerpt(); ?></div>
							<div class="description"><?php echo the_content(); ?></div>
							<div class="social">
							<?php 	$facebook = get_field( 'facebook' );
									$twitter = get_field('twitter');
									$google_plus = get_field('google_plus');
									$linkedin = get_field('linkedin');
									$infocongo = get_field('infocongo');

								if( $facebook ) {   
								    echo '<a href="' . $facebook . '"><span class="social_facebook"></span></a>';
								}
								if ($twitter){
								    echo '<a href="' . $twitter . '"><span class="social_twitter"></span></a>';
								} 
								if( $google_plus ) {   
								    echo '<a href="' . $google_plus . '"><span class="social_googleplus"></span></a>';
								}
								if ($linkedin){
								    echo '<a href="' . $linkedin . '"><span class="social_linkedin"></span></a>';
								} 
								if( $infocongo ) {   
								    echo '<a href="' . $infocongo . '"><span class="social_infocongo"></span></a>';
								}
							?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>

	</div><!-- .site-content -->

	<footer id="site-footer">
	<div class="main-footer container">
		<div class="six columns block">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-footer.png" alt="">
			<div class="row">
				<div class="one-half column">
					<p class="footer-description">InfoCongo is a news platform using data and interactive maps to capture ongoing positive and negative changes in the Congo Basin.</p>
				</div>
				<div class="one-half column">
					<?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>
				</div>
			</div>
		</div>
		<div class="six columns supports">
			<div class="twelve columns">
				<div class="row">
					<h4><?php _e( 'A project by' ) ?></h4>
					<a href="http://internews.org" class="logos internews"></a>
					<a href="http://earthjournalism.net/" class="logos earth"></a>	
				</div>
				<div class="row">
					<h4><?php _e( 'Supported by' ) ?></h4>
					<a href="http://carpe.umd.edu/" class="logos carpe"></a>	
					<a href="https://www.usaid.gov/" class="logos usaid"></a>	
				</div>
			</div>
		</div>
	</div>
	<div id="site-info">
		<div class="container">
			<div class="one-half columns">
				<p class="colophon">
					site by 
					<span>
						<a href="http://cardume.art.br">cardume </a>
					</span>
					<span class="cardume-logo"></span>
					 - development by 
					 <span>
						 <a href="http://jeowp.org">JEO Beta</a>
					 </span>
					 <span class="jeo-logo"></span>
					  <span> & </span> 
					 <span>
						 <a href="http://oniric.ca">oniricca</a>
					 </span>
					 <span class="oniricca-logo"></span>
				 </p>
			</div>
			<div class="one-half columns">
				<p class="footer-social-icons"></p>
			</div>
		</div>
	</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div> <!-- .container -->
<?php wp_footer(); ?>

</body>
</html>

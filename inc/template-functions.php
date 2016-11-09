<?php

function infocongo_taxonomy_filter($label, $taxonomy) {
	?>
	<section class="sub-header">
		<div class="container"> 
			<div class="ten columns">
				<div class="choose-filter <?php echo $taxonomy; ?>">
					<?php
					$terms = get_terms($taxonomy);
					$title = '<span class="title"> ' . $label . '</span>';
					$current_term = false;
					if(is_tax($taxonomy)) {
						$current_term = get_query_var($taxonomy);
						$current_term = get_term_by('slug', $current_term, $taxonomy);
						$title = '<h1 class="title">' . $current_term->name . '</h1>';
					}
					if($terms) : ?>
						<div class="box clearfix">
								<?php echo $title; ?>
								<span class="arrow_carrot-down"></span>
						</div>
						<ul>
							<?php foreach($terms as $term) : ?>
								<?php if($current_term && $term->slug == $current_term->slug) continue; ?>
								<li class="filter"><a href="<?php echo get_term_link($term); ?>" title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<script type="text/javascript">
							jQuery(document).ready(function($) {
								$('.choose-filter <?php echo $taxonomy; ?> .box').toggle(function() {
									$(this).parent().addClass('active');
								}, function() {
									$(this).parent().removeClass('active');
								});
							});
						</script>
					<?php endif; ?>
				</div>
			</div>
			<div class="toggle-more-filters">
				<a href="javascript:void(0);"><?php _e('More filters', 'infocongo'); ?></a>
			</div>   
		</div>
		<div class="more-filters">
			<div class="more-filters-content">
				<?php infoamazonia_adv_nav_filters(); ?>
			</div>
		</div>
	</section>
	<?php
}

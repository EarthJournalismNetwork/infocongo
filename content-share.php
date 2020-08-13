<?php
$page_title = __('Share a map', 'jeo');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<?php // by mohjak 2020-07-24: fixed comment https://tech.openinfo.cc/earth/infoamazonia/-/issues/8#note_8471 ?>
	<!-- Page Title -->
	<title><?php echo "$page_title | "; bloginfo('name'); ?></title>

<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/css/icons.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/sss.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/sss.css" type="text/css" media="all">
<script>
	jQuery(function($) {
	$('.slider').sss();
	});
</script>
<script>
jQuery(document).ready(function($) {

	var $et_top_menu = $( '#top-search' ),
		$search_icon = $( '.icon_search' );

	$search_icon.click( function() {
		var $this_el = $(this),
			$form = $this_el.siblings( '.search-form' );

		if ( $form.hasClass( 'hidden' ) ) {
			$form.css( { 'display' : 'block', 'opacity' : 0 } ).animate( { opacity : 1 }, 500 );
		} else {
			$form.animate( { opacity : 0 }, 500 );
		}

		$form.toggleClass( 'hidden' );
	});
});
</script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/responsive.css" type="text/css" media="all">
<script>
	$(document).ready(function(){
		$("#main-header .menu_responsive .btn_responsive").click(function() {
		    $("#main-nav").slideToggle();
		});
	});
	// jQuery(document).ready(function($) {
	// 	$("#main-header .menu_responsive .btn_responsive").click(function() {
	// 		// Hide why slideToggle in responsive. Cannot work.
	// 		//$("#main-nav").slideToggle();
	// 	});
	// });
</script>
</head>
<body <?php body_class(); ?>>
	<div id="site-wrapper">
		<header id="main-header">
			<div class="container">
				<div class="row">
					<div class="three columns">
						<span class="site-logo">
							<a href="<?php echo home_url('/' . $lang); ?>" title="<?php echo bloginfo('name'); ?>">
							<?php if(is_home()) { ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-mini.png" class="logo-mini" />
							<?php } else { ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-full.png" class="logo-full" />
							<?php } ?>
							</a>
						</span>
					</div>
					<div class="menu_responsive">
						<a href="javascript:void(0);" class="btn_responsive"><span class="icon_menu-square_alt2"></span></a>
					</div>
					<div class="nine columns">

						<div class="tools u-pull-right">
							<div id="top-search">
								<span class="icon_search"></span>
								<form role="search" method="get" class="search-form hidden" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
									printf( '<input type="search" class="search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
										esc_attr_x( 'Search &hellip;', 'placeholder', '' ),
										get_search_query(),
										esc_attr_x( 'Search for:', 'label', '' )
									);
								?>
								</form>
							</div>
							<div class="social-icons">
								<a href="http://facebook.com/InfoCongo.org">
									<span class="social_facebook_square"></span>
								</a>
								<a href="http://twitter.com/Info_Congo">
									<span class="social_twitter_square"></span>
								</a>
							</div>
							<div class="languages">
								<span><a href="?lang=en">en</a></span>
								<span>|</span>
								<span><a href="?lang=fr">fr</a></span>
							</div>
						</div>

						<div id="main-nav">
							<nav>
								<?php wp_nav_menu( array( 'theme_location' => 'header_menu' ) ); ?>
							</nav>
						</div>
					</div>

				</div>
			</div>
		</header>
		<!-- Finishes Header -->

		<div id="content" class="site-content">

<?php
$page_title = __('Share a map', 'jeo');
$map = false;
if(isset($_GET['map_id']) && $_GET['map_id']) {
	$map = get_post($_GET['map_id']);
	if($map && get_post_type($map->ID) == 'map')
		$page_title = __('Share', 'jeo') . ' ' . get_the_title($map->ID);
	else
		$map = false;
}

// All maps
$maps = get_posts(array('post_type' => 'map', 'posts_per_page' => -1));

// Single map
if(!$map && count($maps) <= 1) {
	$map = array_shift($maps);
	$page_title = __('Share the map', 'jeo');
}

// check for layer count

$allow_layers = true;
$layers = false;

if($allow_layers) {
	if(isset($_GET['layers'])) {
		$layers = explode(',', $_GET['layers']);
	} elseif($map) {
		$layers = jeo_get_map_layers($map->ID);
		if(count($layers) <= 1) {
			$layers = false;
		}
	}
}

// post
$post_id = false;
if(isset($_GET['p']))
	$post_id = $_GET['p'];

// share url
if($post_id) {
	$share_url = jeo_get_share_url(array('p' => $post_id));
} else {
	$share_url = jeo_get_share_url();
}
?>

<section id="content" class="share-page">
	<header class="page-header">
		<div class="container">
			<div class="twelve columns">
				<h1><?php echo $page_title; ?></h1>
			</div>
		</div>
	</header>
	<div id="jeo-share-widget">
		<div id="configuration">
			<div class="container row">
				<?php

				if(count($maps) > 1 || ($map && $layers)) :
					?>
					<div class="section layer three columns">
						<div class='inner'>
							<?php if(!$map) : ?>
								<h4>
									<?php _e('Choose a map', 'jeo'); ?>
									<a class='tip' href='#'>
										?
										<span class="popup arrow-left">
											<?php _e('Choose any map from the list', 'jeo'); ?>
										</span>
									</a>
								</h4>
								<div id='maps'>
									<select id="map-select" data-placeholder="<?php _e('Select a map', 'jeo'); ?>" class="chzn-select">
										<?php foreach($maps as $map) : ?>
											<option value="<?php echo $map->ID; ?>"><?php echo get_the_title($map->ID); ?></option>
										<?php endforeach; ?>
									</select>
									<?php if($allow_layers) : ?>
										<a href="#" class="select-map-layers" style="display:block;margin-top:5px;"><?php _e('Select layers from this map', 'jeo'); ?></a>
									<?php endif; ?>
								</div>
							<?php elseif($map && $layers) : ?>
								<?php $map_id = $map->ID; ?>
								<h4>
									<?php if(!isset($_GET['layers'])) : ?>
										<?php echo __('Select layers', 'jeo'); ?>
									<?php else : ?>
										<?php _e('Select layers', 'jeo'); ?>
									<?php endif; ?>
									<a class="tip" href="#">
										?
										<span class="popup arrow-left">
											<?php _e('Choose any layers from the list', 'jeo'); ?>
										</span>
									</a>
								</h4>
								<div id="maps">
									<?php if($layers) : ?>
										<select id="layers-select" data-placeholder="<?php _e('Select layers', 'jeo'); ?>" data-mapid="<?php echo $map_id; ?>" class="chzn-select" multiple>
											<?php foreach($layers as $layer) : ?>
												<?php
												if(!is_array($layer)) :
													$l = array('id' => $layer, 'title' => $layer);
													$layer = $l;
												endif;
												?>
												<option value="<?php echo $layer['id']; ?>" selected><?php if($layer['title']) : echo $layer['title']; else : echo $layer['id']; endif; ?></option>
											<?php endforeach; ?>
										</select>
									<?php endif; ?>
									<a class="clear-layers" href="#"><?php _e('Back to default layer configuration', 'jeo'); ?></a>
									<?php if(count($maps) > 1) : ?>
										<p><a class="button" href="<?php echo $share_url; ?>"><?php _e('View all maps', 'jeo'); ?></a></p>
									<?php endif; ?>
								</div>
							<?php else : ?>
								<h4>&nbsp;</h4>
								<input type="hidden" id="map_id" name="map_id" value="<?php echo $map->ID; ?>" />
								<p><a class="button" href="<?php echo $share_url; ?>"><?php _e('View all maps', 'jeo'); ?></a></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php
				$taxonomies = jeo_get_share_widget_taxonomies();
				?>

				<div class="section two columns">
					<div class="inner">
						<h4>
							<?php _e('Filter content', 'jeo'); ?>
							<a class="tip" href="#">
								?
								<span class="popup arrow-left">
									<?php _e('Filter the content displayed on the map through our options', 'jeo'); ?>
								</span>
							</a>
						</h4>
						<div id="map-content">
							<select id="content-select" data-placeholder="<?php _e('Select content', 'jeo'); ?>" class="chzn-select">
								<?php
								if(isset($_GET['p'])) :
									$post = get_post($_GET['p']);
									if($post) : ?>
										<optgroup label="<?php _e('Selected content', 'jeo'); ?>">
											<option value="post&<?php echo $post->ID; ?>" selected><?php echo get_the_title($post->ID); ?></option>
										</optgroup>
									<?php endif; ?>
								<?php endif; ?>
								<optgroup label="<?php _e('General content', 'jeo'); ?>">
									<option value="latest"><?php if(!isset($_GET['map_id'])) _e('Content from the map', 'jeo'); else _e('Latest content', 'jeo'); ?></option>
									<option value="map-only"><?php _e('No content (map only)', 'jeo'); ?></option>
								</optgroup>
								<?php foreach($taxonomies as $taxonomy) :
									$taxonomy = get_taxonomy($taxonomy);
									if($taxonomy) :
										$terms = get_terms($taxonomy->name);
										if($terms) :
											?>
											<optgroup label="<?php echo __('By', 'jeo') . ' ' . strtolower($taxonomy->labels->name); ?>">
												<?php foreach($terms as $term) : ?>
													<option value="tax_<?php echo $taxonomy->name; ?>&<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
												<?php endforeach; ?>
											</optgroup>
										<?php
										endif;
									endif;
								endforeach; ?>
							</select>
						</div>
					</div>
				</div>

				<div class='section size three columns'>
					<div class='inner'>
						<h4>
							<?php _e('Width & Height', 'jeo'); ?>
							<a class='tip' href='#'>
								?
								<span class="popup arrow-left">
									<?php _e('Select the width and height proportions you would like to embed to be.', 'jeo'); ?>
								</span>
							</a>
						</h4>
						<ul id='sizes' class='sizes clearfix'>
							<li><a href='#' data-size='small' data-width='480' data-height='300'><?php _e('Small', 'jeo'); ?></a></li>
							<li><a href='#' data-size='medium' data-width='600' data-height='400'><?php _e('Medium', 'jeo'); ?></a></li>
							<li><a href='#' data-size='large' data-width='960' data-height='480' class='active'><?php _e('Large', 'jeo'); ?></a></li>
						</ul>
					</div>
				</div>

				<div class='section output two columns'>
					<div class='inner'>
						<h4>
							<div class='popup arrow-right'>
							</div>
							<?php _e('HTML Output', 'jeo'); ?>
							<a class='tip' href='#'>
								?
								<span class="popup arrow-left">
									<?php _e('Copy and paste this code into an HTML page to embed with it\'s current settings and location', 'jeo'); ?>
								</span>
							</a>
						</h4>
						<textarea id="output"></textarea>
                        <div class="sub-inner">
                            <h5>
                                <div class='popup arrow-right'>
                                </div>
                                <?php _e('URL', 'jeo'); ?>
                                <a class='tip' href='#'>
                                    ?
                                    <span class="popup arrow-left">
                                        <?php _e('Get the original to use as a link or a custom embed.', 'jeo'); ?>
                                    </span>
                                </a>
                            </h5>
                            <input type="text" id="url-output" />
                        </div>
					</div>
				</div>

				<div class="section social two columns">
					<div class="inner">
						<h4>
							<div class="popup arrow-right">
							</div>
							<?php _e('Share', 'jeo'); ?>
							<a class="tip" href="#">
								?
								<span class="popup arrow-left">
									<?php _e('Share this map, with it\'s current settings and location, on your social network', 'jeo'); ?>
								</span>
							</a>
						</h4>
					</div>
					<p id="jeo-share-social" class="links">
						<a href="#" class="facebook"><span class="lsf">&#xE047;</span></a>
						<a href="#" class="twitter"><span class="lsf">&#xE12f;</span></a>
					</p>
				</div>

			</div>
		</div>

		<div class="container">
			<div class="twelve columns">
				<h2 class="preview-title"><?php _e('Map preview', 'jeo'); ?></h2>
			</div>
		</div>
		<div id="embed-container">
			<div class="content" id="widget-content">
				<!-- iframe goes here -->
			</div>
		</div>

	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		jeo_share_widget.controls();
	});
</script>

<?php get_footer(); ?>

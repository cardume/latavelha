<?php

/*
 * Theme setup
 */
function latavelha_setup() {

	// text domain
	load_child_theme_textdomain('latavelha', get_stylesheet_directory() . '/languages');

	include(STYLESHEETPATH . '/inc/taxonomies.php');
	include(STYLESHEETPATH . '/inc/post-types.php');
	include(STYLESHEETPATH . '/inc/widgets.php');

	//sidebars
	register_sidebar(array(
		'name' => __('Single news sidebar', 'latavelha'),
		'id' => 'single-news',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));
	register_sidebar(array(
		'name' => __('Generic sidebar', 'latavelha'),
		'id' => 'generic',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	));

	// importers
	//include(STYLESHEETPATH . '/inc/platform-importer.php');
	//include(STYLESHEETPATH . '/inc/accident-importer.php');
}
add_action('after_setup_theme', 'latavelha_setup');

/*
 * Scripts and styles
 */
function latavelha_scripts() {
	// styles
	wp_enqueue_style('font-blackops', 'http://fonts.googleapis.com/css?family=Black+Ops+One');
	wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('mappress-skeleton', 'font-opensans', 'font-blackops'), '1.0');
	wp_enqueue_style('isotope', get_stylesheet_directory_uri() . '/css/isotope.css', array('main'), '1.5.25');

	//scripts
	wp_enqueue_script('latavelha', get_stylesheet_directory_uri() . '/js/latavelha.js', array('jquery'), '0.0.7');
	wp_enqueue_script('isotope', get_stylesheet_directory_uri() . '/lib/jquery.isotope.min.js', array('jquery'), '1.5.25');
	wp_enqueue_script('imagesloaded', get_stylesheet_directory_uri() . '/lib/jquery.imagesloaded.min.js', array('jquery'), '2.1.1');
}
add_action('wp_enqueue_scripts', 'latavelha_scripts');

// register lata velha metaboxes
include(STYLESHEETPATH . '/metaboxes/metaboxes.php');

include(STYLESHEETPATH . '/inc/platform-functions.php');
include(STYLESHEETPATH . '/inc/accident-functions.php');

function latavelha_map($title = false, $single = true) {
	if($single)
		$tag = 'h1';
	else
		$tag = 'h2';
	?>
	<section id="map">
		<div class="container"><div class="twelve columns">
			<?php if($title) : ?>
				<<?php echo $tag; ?> class="map-title"><?php echo $title; ?></<?php echo $tag; ?>>
			<?php endif; ?>
		</div></div>
		<?php mappress_featured(true, true); ?>
	</section>
	<?php
}

// template redirects

function latavelha_template_redirect() {
	global $wp_query;
	if(is_search()) {
		if($wp_query->get('post_type') == 'platform') {
			include(STYLESHEETPATH . '/archive.php');
			exit();
		} elseif($wp_query->get('post_type') == 'post') {
			include(STYLESHEETPATH . '/news.php');
			exit();
		}
	}
}
add_action('template_redirect', 'latavelha_template_redirect');

function latavelha_get_archive_title() {
	if(is_post_type_archive()) {
		return post_type_archive_title('', false);
	} elseif(is_tax()) {
		return 'Teste';
	}
}

function latavelha_queries($query) {
	if(is_front_page())
		$query['post_type'] = 'platform';

	return $query;
}
add_filter('mappress_marker_query', 'latavelha_queries');

function latavelha_marker_extent($extent) {
	if(is_post_type_archive(array('platform', 'accident')))
		$extent = false;

	return $extent;
}
add_filter('mappress_use_marker_extent', 'latavelha_marker_extent');

// lata velha marker icons
add_filter('mappress_marker_icon', 'latavelha_markers_icon');
function latavelha_markers_icon($marker) {
	global $post;
	if(get_post_type() == 'platform') {
		$marker = array(
			'url' => get_stylesheet_directory_uri() . '/img/markers/platform_new.png',
			'width' => 32,
			'height' => 47
		);
		if(latavelha_is_platform_old()) {
			$marker['url'] = get_stylesheet_directory_uri() . '/img/markers/platform_old.png';
		}
	} elseif(get_post_type() == 'accident') {
		$marker = array(
			'url' => get_stylesheet_directory_uri() . '/img/markers/accident_' . latavelha_get_accident_type_icon() . '.png',
			'width' => 32,
			'height' => 48
		);
	}
	return $marker;
}

// map legends

function latavelha_map_legends($legend) {
	global $wp_query;
	ob_start(); ?>
	<ul class="platforms">
		<li class="platform-new"><?php _e('Platforms with <strong>less</strong> than 30 years', 'latavelha'); ?></li>
		<li class="platform-old"><?php _e('Platforms with <strong>more</strong> than 30 years', 'latavelha'); ?></li>
	</ul>
	<ul class="accidents">
		<li class="accident-blowout"><?php _e('Blow-out', 'latavelha'); ?></li>
		<li class="accident-leak"><?php _e('Leak', 'latavelha'); ?></li>
		<li class="accident-default"><?php _e('Others', 'latavelha'); ?></li>
	</ul>
	<ul class="oil-wells">
		<li class="well-warning"><?php _e('Oil wells <strong>with</strong> accident history', 'latavelha'); ?></li>
		<li class="well"><?php _e('Oil wells <strong>without</strong> accident history', 'latavelha'); ?></li>
	</ul>
	<?php
	$legend = ob_get_contents();
	ob_end_clean();
	return $legend;
}
add_filter('mappress_map_legend', 'latavelha_map_legends');

// lata velha marker class
add_filter('mappress_marker_class', 'latavelha_markers_class');
function latavelha_markers_class($class) {
	global $post;
	if(get_post_type() == 'platform') {
		if(latavelha_is_platform_old()) {
			$class[] = 'old-platform';
		}
	}
	return $class;
}

add_filter('mappress_marker_coordinates', 'latavelha_accident_coordinates');
function latavelha_accident_coordinates($coordinates) {
	global $post;
	if(get_post_type() == 'accident') {
		if($coordinates[0] === 0) {
			$platform = latavelha_get_accident_platform();
			if($platform) {
				$coordinates = latavelha_get_platform_geometry($platform->ID);
			}
		}
	}
	return $coordinates;
}

function latavelha_accident_order($query) {
	$vars = &$query->query_vars;
	if($vars['post_type'] == 'accident') {
		$vars['orderby'] = 'meta_value_num';
		$vars['meta_key'] = 'accident_date';
		$vars['order'] = 'DESC';
	}
	return $query;
}
add_filter('pre_get_posts', 'latavelha_accident_order');

function latavelha_platform_order($query) {
	$vars = &$query->query_vars;
	if($vars['post_type'] == 'platform') {
		$vars['orderby'] = 'meta_value_num';
		$vars['meta_key'] = 'construction_date';
		$vars['order'] = 'ASC';
	}
	return $query;
}
add_filter('pre_get_posts', 'latavelha_platform_order');

function latavelha_use_map_query() {
	return false;
}
add_filter('mappress_use_map_query', 'latavelha_use_map_query');

function latavelha_geocode_type() {
	return 'latlng';
}
add_filter('mappress_geocode_type', 'latavelha_geocode_type');

?>
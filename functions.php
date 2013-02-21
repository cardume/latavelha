<?php

/*
 * Theme setup
 */
function latavelha_setup() {
	include(STYLESHEETPATH . '/inc/post-types.php');
}
add_action('after_setup_theme', 'latavelha_setup');

/*
 * Scripts and styles
 */
function latavelha_scripts() {
	// styles
	wp_enqueue_style('base', get_stylesheet_directory_uri() . '/css/base.css', array(), '1.2');
	wp_enqueue_style('skeleton', get_stylesheet_directory_uri() . '/css/skeleton.css', array('base'), '1.2');
	wp_enqueue_style('font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
	wp_enqueue_style('font-blackops', 'http://fonts.googleapis.com/css?family=Black+Ops+One');
	wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.css', array('skeleton', 'font-opensans', 'font-blackops'), '0.0.0.1');
}
add_action('wp_enqueue_scripts', 'latavelha_scripts');

// register geocode metabox
add_action('add_meta_boxes', 'latavelha_geocode_metaboxes');
function latavelha_geocode_metaboxes() {
	// platform
	add_meta_box(
		'geocoding-address',
		__('Address and geolocation', 'latavelha'),
		'geocoding_inner_custom_box',
		'platform',
		'advanced',
		'high'
	);
	// accident
	add_meta_box(
		'geocoding-address',
		__('Address and geolocation', 'latavelha'),
		'geocoding_inner_custom_box',
		'accident',
		'advanced',
		'high'
	);
	// oil well
	add_meta_box(
		'geocoding-address',
		__('Address and geolocation', 'latavelha'),
		'geocoding_inner_custom_box',
		'oil-well',
		'advanced',
		'high'
	);
}

// markers query
add_filter('mappress_markers_query', 'latavelha_markers_query');
function latavelha_markers_query($query) {
	if(is_front_page())
		$query['post_type'] = array('post', 'platform', 'accident', 'oil-well');

	return $query;
}

?>
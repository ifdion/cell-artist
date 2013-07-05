<?php

/* Custom Post Types
--------------------------------------------------------------
*/

add_action('init', 'artwork_custom_post_type');
function artwork_custom_post_type() {

	$artwork_labels = array(
		'name' => _x('Artwork', 'post type general name'),
		'singular_name' => _x('artwork', 'post type singular name'),
		'add_new' => _x('Add New', 'artwork'),
		'add_new_item' => __('Add New Artwork', 'cell-artist'),
		'edit_item' => __('Edit Artwork', 'cell-artist'),
		'new_item' => __('New Artwork', 'cell-artist'),
		'view_item' => __('View Artwork', 'cell-artist'),
		'search_items' => __('Search Artwork', 'cell-artist'),
		'not_found' =>  __('No Artworks found', 'cell-artist'),
		'not_found_in_trash' => __('No Artworks found in Trash', 'cell-artist'),
		'parent_item_colon' => '',
		'menu_name' => __('Artwork', 'cell-artist')
	);
	$artwork_args = array(
		'labels' => $artwork_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','author','excerpt','thumbnail','editor')
	);
	
	register_post_type('artwork',$artwork_args);
}

?>
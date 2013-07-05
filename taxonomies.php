<?php

/* Taxonomies
--------------------------------------------------------------
*/

add_action( 'init', 'cell_artist_taxonomies', 1 );

function cell_artist_taxonomies() {

	$artwork_years_labels = array(
		'name' => _x( 'Artwork Years', 'taxonomy general name' ),
		'singular_name' => _x( 'Artwork Years', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Artwork Years','cell-artist'),
		'all_items' => __( 'All Artwork Years','cell-artist' ),
		'parent_item' => __( 'Parent Artwork Years','cell-artist' ),
		'parent_item_colon' => __( 'Parent Artwork Years:','cell-artist' ),
		'edit_item' => __( 'Edit Artwork Years','cell-artist' ), 
		'update_item' => __( 'Update Artwork Years','cell-artist' ),
		'add_new_item' => __( 'Add New Artwork Years','cell-artist' ),
		'new_item_name' => __( 'New Artwork Years Name','cell-artist' ),
		'menu_name' => __( 'Artwork Years','cell-artist' ),
	);
	
	register_taxonomy('artwork-year',array('artwork'), array(
		'hierarchical' => true,
		'labels' => $artwork_years_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'artwork-year' ),
	));


}

?>
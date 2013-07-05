<?php
	/*
	Plugin Name: Cell Artist
	Plugin URI: http://google.com
	Description: Cell Artist function plugin, made to work with any cell theme
	Version: 1.0
	Author: Saklik
	Author URI: http://saklik.com
	License: 
	*/


//set constant values
define( 'CELL_ARTIST_FILE', __FILE__ );
define( 'CELL_ARTIST', dirname( __FILE__ ) );
define( 'CELL_ARTIST_PATH', plugin_dir_path(__FILE__) );
define( 'CELL_ARTIST_TEXT_DOMAIN', 'cell-artist' );


// set for internationalization
function cell_artist_init() {
	load_plugin_textdomain('cell-artist', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'cell_artist_init');

/* session
---------------------------------------------------------------
*/

	if (!session_id()) {
		session_start();
	}

/* global 
---------------------------------------------------------------
*/

	// include_once ('cell-artist-options.php');

	include_once ('common-functions.php');

	include_once ('wpalchemy/setup.php');

/* custom post types 
---------------------------------------------------------------
*/

	include_once ('artwork/artwork.php');


/* taxonomies
---------------------------------------------------------------
*/

	include_once ('taxonomies.php');


/* data setup
---------------------------------------------------------------
*/

	include_once ('user-data-setup/user-data-setup.php');



?>
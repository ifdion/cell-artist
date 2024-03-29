<?php

include_once CELL_ARTIST_PATH . '/wpalchemy/MetaBox.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style() {
	wp_enqueue_style('wpalchemy-metabox', plugins_url() . '/cell-artist/wpalchemy/meta.css');
}

/* eof */
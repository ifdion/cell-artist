<?php
/* ajax : custom function to detect wheter a request is made by ajax or not
---------------------------------------------------------------
*/

if (!function_exists('ajax_request')) {
	function ajax_request(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		} else {
			return false;
		}
	}
}

/* ajax : custom function to create an ajax response or http location redirect
---------------------------------------------------------------
*/

if (!function_exists('ajax_response')) {
	function ajax_response($data,$redirect = false){
		if(ajax_request()){
			$data_json = json_encode($data);
			echo $data_json;			
		} else {
			$_SESSION['global_message'][] = $data;
		}
		if ($redirect) {
			wp_redirect( $redirect );
			exit;
			die();
		}
	}	
}

/* global message 
---------------------------------------------------------------
*/

add_action( 'init', 'setup_global_message');

if (!function_exists('setup_global_message')) {
	function setup_global_message(){
		global $global_message;
		if ( isset( $_SESSION['global_message'] ) ){
			$global_message = $_SESSION['global_message'];
			unset( $_SESSION['global_message'] );
		}
	}
}

if (!function_exists('the_global_message')) {
	function the_global_message(){
		global $global_message;
		if ($global_message != '' && (count($global_message) > 0)) {
			foreach ($global_message as $message){
				?>
					<div id="" class="alert alert-<?php echo $message['type'].' '.$message['type'] ?>">
						<a href="" class="delete">✕</a> <span><?php echo $message['message'] ?></span>
					</div>
				<?php
			}
		}
		$global_message = false;
	}	
}


/* get template file 
---------------------------------------------------------------
*/
if (!function_exists('get_template_file')) {
	function get_template_file($template){
		ob_start();
			include($template);
			$shopping_cart_content = ob_get_contents();
		ob_end_clean();
		return $shopping_cart_content;
	}
}


/* admin_bar_for_admin_only
---------------------------------------------------------------
*/

if (!function_exists('admin_bar_for_admin_only')) {
	add_filter( 'show_admin_bar' , 'admin_bar_for_admin_only');
	function admin_bar_for_admin_only(){
		// if (!current_user_can('administrator') && !is_admin()) {
			return false;
		// } else {
		// 	return true;
		// }
	}
}


/* wp-admin : add script in wp-admin 
---------------------------------------------------------------
*/

if (!function_exists('CELL_ARTIST_admin_script')) {
	add_action('admin_print_scripts', 'CELL_ARTIST_admin_script'); //dion

	function CELL_ARTIST_admin_script() { //dion
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script('admin-cellscript', plugins_url() . '/cell-artist/js/admin-script.js', array('jquery'),'1.0',true);
	}
}



/* wp-admin : add style in wp-admin 
---------------------------------------------------------------
*/

if (!function_exists('CELL_ARTIST_admin_style')) {
	add_action('admin_enqueue_scripts', 'CELL_ARTIST_admin_style');
	function CELL_ARTIST_admin_style() {
		wp_enqueue_style('smoothness', plugins_url() . '/cell-artist/css/smoothness/jquery-ui-1.9.0.custom.min.css');
	}
}


/* wp-admin : Adding Custom Post Type and Custom Taxonomy to Right Now Admin Widget
--------------------------------------------------------------
*/
add_action( 'right_now_content_table_end' , 'ucc_right_now_content_table_end' );

function ucc_right_now_content_table_end() {
	$args = array(
		'public' => true ,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	
	$post_types = get_post_types( $args , $output , $operator );
	
	foreach( $post_types as $post_type ) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
		if ( current_user_can( 'edit_posts' ) ) {
			$num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
			$text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
		echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
	}
	
	$taxonomies = get_taxonomies( $args , $output , $operator );
	
	foreach( $taxonomies as $taxonomy ) {
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->singular_name, $taxonomy->labels->name , intval( $num_terms ) );
		if ( current_user_can( 'manage_categories' ) ) {
			$num = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$num</a>";
			$text = "<a href='edit-tags.php?taxonomy=$taxonomy->name'>$text</a>";
		}
		echo '<tr><td class="first b b-' . $taxonomy->name . '">' . $num . '</td>';
		echo '<td class="t ' . $taxonomy->name . '">' . $text . '</td></tr>';
	}
}


/* wp-admin : add small image  size for admin table
---------------------------------------------------------------
*/
if (function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if (function_exists( 'add_image_size' ) ) { 
	add_image_size( '50', 50, 50, true );
}

/* check if is descendant 
---------------------------------------------------------------
*/

if(!function_exists('is_descendant')){
	function is_descendant( $page, $ancestor = false ) {
		if( !is_object( $page ) ) {
			$page = intval( $page );
			$page = get_post( $page );
		}
		if( is_object( $page ) ) {
			if( isset( $page->ancestors ) && !empty( $page->ancestors ) ) {
				if( !$ancestor ){
					return true;
				}elseif ( in_array( $ancestor, $page->ancestors ) ){
					return true;
				}
			}
		}
		return false;
	}
}

/* get id from slug 
---------------------------------------------------------------
*/
if (!function_exists('get_id_by_slug')) {
	function get_id_by_slug($post_slug,$post_type){
		global $wpdb;
		$post_id = $wpdb->get_var(
			"	SELECT ID
				FROM wp_posts
				WHERE post_name = '$post_slug'
				AND post_type ='$post_type'
				LIMIT 0,1
			");
		return $post_id;
	}
}



/* count transaction amount 
---------------------------------------------------------------
*/

function count_transaction($term_taxonomy_id){
	global $wpdb;

	$sql =
		 "SELECT sum($wpdb->postmeta.meta_value) as total
			FROM $wpdb->postmeta
	  INNER JOIN $wpdb->posts
			  ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
	  INNER JOIN $wpdb->term_relationships 
			  ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		   WHERE 1=1
			 AND ( $wpdb->term_relationships.term_taxonomy_id IN ($term_taxonomy_id) )
			 AND $wpdb->postmeta.meta_key = 'amount'
			 AND $wpdb->posts.post_type = 'transaction' 
			 AND $wpdb->posts.post_status = 'publish'
			 AND $wpdb->postmeta.meta_value != ''
	";

	$namount = $wpdb->get_results($sql);
	return $namount[0]->total;
}

/**
 * Conditional Tag to check if its a term or any of its children
 *
 * @param $terms - (string/array) list of term ids
 * @param $taxonomy - (string) the taxonomy name of which the holds the terms. 
 */
function is_or_descendant_tax( $terms,$taxonomy){
    if (is_tax($taxonomy, $terms)){
            return true;
    }
    foreach ( (array) $terms as $term ) {
        // get_term_children() accepts integer ID only
        $descendants = get_term_children( (int) $term, $taxonomy);
        if ( $descendants && is_tax($taxonomy, $descendants) )
            return true;
    }
    return false;
}
?>
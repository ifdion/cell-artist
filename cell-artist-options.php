<?php

define('NHP_OPTIONS_URL', site_url('/wp-content/plugins/cell-artist/options/'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

function setup_framework_options(){
	$args = array();
	$args['dev_mode'] = false;
	$args['show_import_export'] = false;
	$args['opt_name'] = 'cell-artist';
	$args['menu_title'] = __('Store Options', 'cell-artist');
	$args['page_title'] = __('Store Options', 'cell-artist');
	$args['page_slug'] = 'cell-artist-options';
	$args['page_cap'] = 'manage_options';
	$args['page_position'] = 27;
	$args['allow_sub_menu'] = false;

	$std['admin_email'] = get_bloginfo('admin_email');
	$std['url'] = get_bloginfo('url');

	$set_options = get_option('cell-artist');


	$std['currency_display'] = 'IDR';
	if (isset($set_options['currency_display'])) {
		$std['currency_display'] = $set_options['currency_display'];
	}
	$std['currency_thousand_separator'] = '.';
	if (isset($set_options['currency_thousand_separator'])) {
		$std['currency_thousand_separator'] = $set_options['currency_thousand_separator'];
	}
	$std['currency_decimal_separator'] = ',';
	if (isset($set_options['currency_decimal_separator'])) {
		$std['currency_decimal_separator'] = $set_options['currency_decimal_separator'];
	}

	$sections = array();

	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_023_cogwheels.png',
		'title' => __('General Options', 'cell-artist'),
		'desc' => __('<p class="description">General Store Options</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'general_email',
				'type' => 'text',
				'title' => __('Email address to send correspondence', 'cell-artist'), 
				'std' => $std['admin_email'],
				'validate' => 'email', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'product_slug',
				'type' => 'text',
				'title' => __('Product Slug', 'cell-artist'), 
				'sub_desc' => 'This will be used as the slug for the product archive e.g : '. $std['url'].'/product/product-name',
				'std' => 'product',
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'collection_slug',
				'type' => 'text',
				'title' => __('Collection Slug', 'cell-artist'), 
				'sub_desc' => 'This will be used as the slug for the collection e.g : '. $std['url'].'/collection',
				'std' => 'collection',
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'product_category_slug',
				'type' => 'text',
				'title' => __('Product Category Slug', 'cell-artist'), 
				'sub_desc' => 'This will be used as the slug for the product category e.g : '. $std['url'].'/product-category',
				'std' => 'product-category',
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'product_tag_slug',
				'type' => 'text',
				'title' => __('Product Tag Slug', 'cell-artist'), 
				'sub_desc' => 'This will be used as the slug for the product tag e.g : '. $std['url'].'/product-tag',
				'std' => 'product-tag',
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'redirect_after_buy',
				'type' => 'select',
				'title' => __('Redirection after Buy', 'cell-artist'),
				'options' => array('stay' => 'Stay in same page','checkout' => 'Checkout','shopping-cart'=>'Shopping Cart'),
				'std' => 'shopping-cart'
				),
			array(
				'id' => 'cancelation_treshold',
				'type' => 'text',
				'title' => __('Days before unconfirmed order cancelation', 'cell-artist'), 
				'std' => '1',
				'validate' => 'numeric', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			)
		);
				
	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_155_show_thumbnails.png',
		'title' => __('Store Pages', 'cell-artist'),
		'desc' => __('<p class="description">Choose which page is used as a store page.</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'shopping_cart_page',
				'type' => 'pages_select',
				'title' => __('Shopping Cart Page', 'cell-artist'), 
				),
			array(
				'id' => 'check_out_page',
				'type' => 'pages_select',
				'title' => __('Check Out Page', 'cell-artist'), 
				),
			array(
				'id' => 'payment_option_page',
				'type' => 'pages_select',
				'title' => __('Payment Option Page', 'cell-artist'), 
				),
			array(
				'id' => 'order_confirmation_page',
				'type' => 'pages_select',
				'title' => __('Order Confirmation Page', 'cell-artist'), 
				),
			array(
				'id' => 'payment_confirmation_page',
				'type' => 'pages_select',
				'title' => __('Payment Confirmation Page', 'cell-artist'), 
				),
			array(
				'id' => 'login_page',
				'type' => 'pages_select',
				'title' => __('Login Page', 'cell-artist'), 
				),
			array(
				'id' => 'profile_page',
				'type' => 'pages_select',
				'title' => __('Profile Page', 'cell-artist'), 
				),
			array(
				'id' => 'my_transaction_page',
				'type' => 'pages_select',
				'title' => __('My Transaction Page', 'cell-artist'), 
				),
			)
		);

	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_060_compass.png',
		'title' => __('Store Details', 'cell-artist'),
		'desc' => __('<p class="description">Basic Store details for invoice and correspondence.</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'store_name',
				'type' => 'text',
				'title' => __('Store Name', 'cell-artist'), 
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'store_address',
				'type' => 'textarea',
				'title' => __('Store Address', 'cell-artist'), 
				'validate' => 'no_html'
				),
			array(
				'id' => 'store_phone_1',
				'type' => 'text',
				'title' => __('Store Phone Number', 'cell-artist'), 
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'store_phone_2',
				'type' => 'text',
				'title' => __('Store Phone Number (2)', 'cell-artist'), 
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'store_email',
				'type' => 'text',
				'title' => __('Store Email', 'cell-artist'), 
				'validate' =>'email',
				),
			)
		);

	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_318_more-items.png',
		'title' => __('PayPal', 'cell-artist'),
		'desc' => __('<p class="description">Basic setup for PayPal payment gateway.</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'paypal_enable',
				'type' => 'checkbox',
				'title' => __('Enable', 'cell-artist'), 
				'desc' => __('Check to enable', 'cell-artist'),
				'std' => '1'
				),
			array(
				'id' => 'paypal_title',
				'type' => 'text',
				'title' => __('Title', 'cell-artist'), 
				'validate' => 'no_html', //builtin validation includes: email|html|html_custom|no_html|js|numeric|url
				),
			array(
				'id' => 'paypal_upload',
				'type' => 'upload',
				'title' => __('Image Upload', 'cell-artist'), 
				'desc' => __('This is the image that will be used before the title.', 'cell-artist')
				),
			array(
				'id' => 'paypal_description',
				'type' => 'editor',
				'title' => __('Description', 'cell-artist'), 
				),
			array(
				'id' => 'paypal_email',
				'type' => 'text',
				'title' => __('Email Account', 'cell-artist'), 
				// 'sub_desc' => __('This is the page that uses <code>[cell-shopping-cart]</code> shortcode. By default it will find page with the slug <code> shopping-cart</code>', 'cell-artist'),
				),
			array(
				'id' => 'paypal_sandbox',
				'type' => 'checkbox',
				'title' => __('Enable Sandbox Mode', 'cell-artist'), 
				'desc' => __('Check to enable', 'cell-artist'),
				'std' => '0'
				),
			array(
				'id' => 'paypal_sandbox_email',
				'type' => 'text',
				'title' => __('Sandbox Email Account', 'cell-artist'), 
				'validate' =>'email',
				),
			)
		);

	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_263_bank.png',
		'title' => __('Bank', 'cell-artist'),
		'desc' => __('<p class="description">Basic setup for Bank Wire Transfer payment gateway.</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'bank_1_title',
				'type' => 'text',
				'title' => __('Bank 1 : Title', 'cell-artist'), 
				),
			array(
				'id' => 'bank_1_upload',
				'type' => 'upload',
				'title' => __('Bank 1 Image Upload', 'cell-artist'), 
				'desc' => __('This is the image that will be used before the title.', 'cell-artist')
				),
			array(
				'id' => 'bank_1_description',
				'type' => 'editor',
				'title' => __('Bank 1 : Description', 'cell-artist'), 
				),
			array(
				'id' => 'bank_2_enable',
				'type' => 'checkbox',
				'title' => __('Enable Bank 2', 'cell-artist'), 
				'desc' => __('Check to enable', 'cell-artist'),
				'std' => '0'
				),
			array(
				'id' => 'bank_2_title',
				'type' => 'text',
				'title' => __('Bank 2 : Title', 'cell-artist'), 
				),
			array(
				'id' => 'bank_2_upload',
				'type' => 'upload',
				'title' => __('Bank 2 Image Upload', 'cell-artist'), 
				'desc' => __('This is the image that will be used before the title.', 'cell-artist')
				),
			array(
				'id' => 'bank_2_description',
				'type' => 'editor',
				'title' => __('Bank 2 : Description', 'cell-artist'), 
				),
			array(
				'id' => 'bank_3_enable',
				'type' => 'checkbox',
				'title' => __('Enable Bank 3', 'cell-artist'), 
				'desc' => __('Check to enable', 'cell-artist'),
				'std' => '0'
				),
			array(
				'id' => 'bank_3_title',
				'type' => 'text',
				'title' => __('Bank 3 : Title', 'cell-artist'), 
				),
			array(
				'id' => 'bank_3_upload',
				'type' => 'upload',
				'title' => __('Bank 3 Image Upload', 'cell-artist'), 
				'desc' => __('This is the image that will be used before the title.', 'cell-artist')
				),
			array(
				'id' => 'bank_3_description',
				'type' => 'editor',
				'title' => __('Bank 3 : Description', 'cell-artist'), 
				),
			)
		);

	$sections[] = array(
		'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_037_credit.png',
		'title' => __('Pricing', 'cell-artist'),
		'desc' => __('<p class="description">Basic setup for Pricing.</p>', 'cell-artist'),
		'fields'=> array(
			array(
				'id' => 'currency_display',
				'type' => 'text',
				'title' => __('Currency Display', 'cell-artist'), 
				'std' => 'IDR'
				),
			array(
				'id' => 'currency_thousand_separator',
				'type' => 'text',
				'title' => __('Thousand Separator', 'cell-artist'), 
				'std' => '.'
				),
			array(
				'id' => 'currency_decimal_separator',
				'type' => 'text',
				'title' => __('Decimal Separator', 'cell-artist'), 
				'std' => ','
				),
			array(
				'id' => 'currency_decimal_digit',
				'type' => 'text',
				'title' => __('Number of Decimal', 'cell-artist'), 
				'std' => '2'
				),
			array(
				'id' => 'currency_placement',
				'type' => 'select',
				'title' => __('Currency Placement', 'cell-artist'),
				'options' => array(
					'before' => sprintf('%1$s 10%2$s000%3$s00',$std['currency_display'],$std['currency_thousand_separator'], $std['currency_decimal_separator']),
					'after' => sprintf('10%2$s000%3$s 00 %1$s',$std['currency_display'],$std['currency_thousand_separator'], $std['currency_decimal_separator'])
					),
				),
			)
		);
	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args);

}//function
add_action('init', 'setup_framework_options', 0);

?>
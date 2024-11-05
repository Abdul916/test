<?php

/**
* @package WordPress
* @subpackage Default_Theme
*/

register_sidebar(array(
	'name'          => 'Topbar Special Offer',
'id'            => 'sidebar-1', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Main Menu',
'id'            => 'sidebar-2', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Top Banner Text',
'id'            => 'sidebar-3', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '<h1>',
'after_title'   => '</h1>',
));

register_sidebar(array(
	'name'          => 'Top Banner Picture',
'id'            => 'sidebar-4', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Testimonials',
'id'            => 'sidebar-5', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Footer Links',
'id'            => 'sidebar-6', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Payment Logos',
'id'            => 'sidebar-7', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Copyright',
'id'            => 'sidebar-8', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

register_sidebar(array(
	'name'          => 'Privacy Links',
'id'            => 'sidebar-9', // Added unique ID
'before_widget' => '',
'after_widget'  => '',
'before_title'  => '',
'after_title'   => '',
));

// add_action('init', 'get_orderry_products_postings', 10, 1);
// function get_orderry_products_postings() {
//     $curl = curl_init();
//     curl_setopt($curl, CURLOPT_URL, 'https://api.orderry.com/warehouse/postings/?token=ee99af0cec4b7ddd6a830a47fe2c4e15a858c133');
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_ENCODING, '');
//     curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
//     curl_setopt($curl, CURLOPT_TIMEOUT, 30);
//     curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
//     curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//         'Content-Type: application/json',
//         'Accept: application/json'
//     ));
//     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(
//         ['api_key' => 'dc89d26373ce444c82b47cf903403ffa']
//     ));
//     $response = curl_exec($curl);
//     $external_products = json_decode($response, true);
//     if ($external_products['success'] && !empty($external_products['data'])) {
//         foreach ($external_products['data'] as $external_product) {
//             $product_name = $external_product['products'][0]['title'];
//             $product = get_product_by_name($product_name);
//             if ($product) {
//                 $wc_product_id =  $product->get_id();
//                 update_post_meta($wc_product_id, 'orderry_product_id', $external_product['id']);
//                 update_post_meta($wc_product_id, 'orderry_supplier_id', $external_product['supplier_id']);
//                 update_post_meta($wc_product_id, 'orderry_warehouse_id', $external_product['warehouse_id']);
//             }

//         }
//     }
// }
// function get_product_by_name($product_name) {
//     $args = array(
//         'post_type'   => 'product',
//         'post_status' => 'publish',
//         'title'       => $product_name,
//         'posts_per_page' => 1,
//         'exact'       => true,
//     );
//     $query = new WP_Query($args);
//     if ($query->have_posts()) {
//         $query->the_post();
//         $product_id = get_the_ID();
//         $product = wc_get_product($product_id);
//         wp_reset_postdata();
//         return $product;
//     }
//     return null;
// }

add_action('woocommerce_thankyou', 'send_order_to_orderry', 10, 1);
function send_order_to_orderry($order_id) {
	$order = wc_get_order( $order_id );
	$first_name = $order->get_billing_first_name();
	$last_name = $order->get_billing_last_name();
	$email = $order->get_billing_email();
	$contact_name = esc_html($first_name).' '.esc_html($last_name);
	$city      = $order->get_billing_city();
	$state     = $order->get_billing_state();
	$postcode  = $order->get_billing_postcode();
	$country   = $order->get_billing_country();
	$phone_no   = $order->get_billing_phone();
	$notes   = $order->get_customer_note();
	$address = esc_html($city).' '.esc_html($state).' '.esc_html($postcode).' '.esc_html($country);

	$order_total = $order->get_total();
	$order_currency = $order->get_currency();
	$order_date = $order->get_date_created();
	$payment_method = $order->get_payment_method();
	$transaction_id = $order->get_transaction_id();
	$payment_status = $order->get_status();
	$payment_details = 'Order ID: '.$order_id.', Name: '.$contact_name.', Email: '.$email.', Amount: '.$order_currency.''.$order_total.', Transaction ID: '.$transaction_id.', Order Date: '.$order_date.', Payment Status: '.$payment_status;

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://api.orderry.com/token/new');
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Accept: application/json'
	]);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(
		['api_key' => 'dc89d26373ce444c82b47cf903403ffa']
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$auth_token_response = curl_exec($curl);
	curl_close($curl);
	$token = json_decode($auth_token_response, true);

	$curl1 = curl_init();
	curl_setopt($curl1, CURLOPT_URL, 'https://api.orderry.com/clients/?token='.$token['token'].'&emails[]='.$email);
	curl_setopt($curl1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl1, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($curl1, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Accept: application/json'
	]);
	curl_setopt($curl1, CURLOPT_POSTFIELDS, json_encode(
		['api_key' => 'dc89d26373ce444c82b47cf903403ffa']
	));
	$get_clients_response = curl_exec($curl1);
	curl_close($curl1);
	$clients = json_decode($get_clients_response, true);


	if ($clients['success'] && !empty($clients['data'])) {
		$client_id = $clients['data'][0]['id'];
		$curl2 = curl_init();
		curl_setopt($curl2, CURLOPT_URL, 'https://api.orderry.com/lead/?token='.$token['token']);
		curl_setopt($curl2, CURLOPT_POST, true);
		curl_setopt($curl2, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Accept: application/json'
		]);
		curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
		$post_lead_fields = array(
			'api_key'      	=> 'dc89d26373ce444c82b47cf903403ffa',
			'leadtype_id'   => '34026',
			'branch_id'     => '81883',
			'client_id'    	=> $client_id,
			'contact_name'  => $contact_name,
			'contact_phone'  => $phone_no,
			'description'   => $payment_details
		);
		curl_setopt($curl2, CURLOPT_POSTFIELDS, json_encode($post_lead_fields));
		$lead_response = curl_exec($curl2);
		curl_close($curl2);
		$lead = json_decode($lead_response, true);

	} else {

		$phone_numbers = array($phone_no);
		$curl3 = curl_init();
		curl_setopt($curl3, CURLOPT_URL, 'https://api.orderry.com/clients/?token='.$token['token']);
		curl_setopt($curl3, CURLOPT_POST, true);
		curl_setopt($curl3, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Accept: application/json'
		]);
		curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
		$post_client_fields = array(
			'api_key'      	=> 'dc89d26373ce444c82b47cf903403ffa',
			"name"			=> $contact_name,
			"first_name"	=> $first_name,
			"last_name"		=> $last_name,
			"email"			=> $email,
			"address"		=> $address,
			"notes"			=> $notes,
			"phone"        	=> $phone_numbers
		);
		curl_setopt($curl3, CURLOPT_POSTFIELDS, json_encode($post_client_fields));
		$get_client_response = curl_exec($curl3);
		curl_close($curl3);
		$client = json_decode($get_client_response, true);


		if (isset($client['data']['id'])) {
			$client_id = $client['data']['id'];
			$curl4 = curl_init();
			curl_setopt($curl4, CURLOPT_URL, 'https://api.orderry.com/lead/?token='.$token['token']);
			curl_setopt($curl4, CURLOPT_POST, true);
			curl_setopt($curl4, CURLOPT_HTTPHEADER, [
				'Content-Type: application/json',
				'Accept: application/json'
			]);
			curl_setopt($curl4, CURLOPT_RETURNTRANSFER, true);
			$post_lead_fields = array(
				'api_key'      	=> 'dc89d26373ce444c82b47cf903403ffa',
				'leadtype_id'   => '34026',
				'branch_id'     => '81883',
				'client_id'    	=> $client_id,
				'contact_name'  => $contact_name,
				'contact_phone'  => $phone_no,
				'description'   => $payment_details
			);
			curl_setopt($curl4, CURLOPT_POSTFIELDS, json_encode($post_lead_fields));
			$lead_response1 = curl_exec($curl4);
			curl_close($curl4);
			$lead1 = json_decode($lead_response1, true);
		}
	}
}

// Add 'Share via Email' button on single product pages
add_action('woocommerce_single_product_summary', 'custom_share_via_email_button', 35);
function custom_share_via_email_button() {
	global $product;
	$product_title = get_the_title($product->get_id());
	$product_link = get_permalink($product->get_id());
	$subject = rawurlencode("Check out this product: " . $product_title);
	$body = rawurlencode("I thought you might like this product:\n\n" . $product_title . "\n" . $product_link);
	echo '
	<div class="" style="text-align: left;">
	<figure class="">
	<a href="mailto:?subject=' . $subject . '&body=' . $body . '">
	<img decoding="async" width="263" height="49" src="https://adulismcs.com/wp-content/uploads/2023/09/btn_share_email.jpg" alt="Share via Email" style="width:132px;height:25px">
	</a>
	</figure>
	</div>';
}

add_action('woocommerce_after_shop_loop_item', 'custom_share_via_email_button_archive', 20);
function custom_share_via_email_button_archive() {
	global $product;
	$product_title = get_the_title($product->get_id());
	$product_link = get_permalink($product->get_id());
	$subject = rawurlencode("Check out this product: " . $product_title);
	$body = rawurlencode("I thought you might like this product:\n\n" . $product_title . "\n" . $product_link);
	echo '
	<div class="" style="text-align: left; margin-top: 10px;">
	<figure class="">
	<a href="mailto:?subject=' . $subject . '&body=' . $body . '">
	<img decoding="async" width="263" height="49" src="https://adulismcs.com/wp-content/uploads/2023/09/btn_share_email.jpg" alt="Share via Email" style="width:132px;height:25px">
	</a>
	</figure>
	</div>';
}
// End Code Add 'Share via Email' button on single product pages

// Remove WooCommerce pagination from the shop page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_filter('woocommerce_pagination_args', 'remove_pagination');
function remove_pagination($args) {
	$args['total'] = 0;
	return $args;
}
add_action('pre_get_posts', 'adjust_product_query');
function adjust_product_query($query) {
	$query->set( 'posts_per_page', -1 );
}
// End Code Remove WooCommerce pagination from the shop page

// Change "Add to Cart" text to "Booking" on all WooCommerce products
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_button_text' );
function custom_add_to_cart_button_text() {
	return __( 'BOOK NOW', 'woocommerce' );
}




?>
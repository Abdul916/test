<?php
/**
 * @package TownHub - Directory & Listing WordPress Theme
 * @author CTHthemes - http://themeforest.net/user/cththemes
 * @date 06-11-2019
 * @since 1.0.0
 * @version 1.0.0
 * @copyright Copyright ( C ) 2014 - 2019 cththemes.com . All rights reserved.
 * @license GNU General Public License version 3 or later; see LICENSE
 */
// Your php code goes here
//
function townhub_child_enqueue_styles() {
	$parent_style = 'townhub-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array( 'townhub-fonts', 'townhub-plugins' ), null );
	wp_enqueue_style( 'townhub-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style , 'townhub-color'),
		wp_get_theme()->get('Version')
	);
}
add_action( 'wp_enqueue_scripts', 'townhub_child_enqueue_styles' );

/// Adds pages within the dashbaord wrapper to use the side bars. Note: You will still need to add the menu int he sidebar.php override file.

add_filter( 'cth_listing_dashboard_skip_content', function($dashboard){
	if( $dashboard == 'affiliate-area' ) 
		return false;
	return $dashboard;
} );
add_action( 'cth_listing_dashboard_content_switch', function($dashboard){
	if( $dashboard == 'affiliate-area' ) {
        echo get_the_content(null, false, 9903); // 9903 is your page id
    }
} );


//My-Account

add_filter( 'cth_listing_dashboard_skip_content', function($dashboard){
	if( $dashboard == 'my-account' ) 
		return false;
	return $dashboard;
} );
add_action( 'cth_listing_dashboard_content_switch', function($dashboard){
	if( $dashboard == 'my-account' ) {
        echo get_the_content(null, false, 25); // 25 is your page id
    }
} );




add_filter( 'woocommerce_add_to_cart_validation', 'custom_check_user_purchase', 10, 3 );
function custom_check_user_purchase( $passed, $product_id, $quantity ) {
	if ( $product_id == 2317 ) {
		$user_id = get_current_user_id();
		if ( ! $user_id ) {
			return $passed;
		}
		$args = array(
			'customer' => $user_id,
			'status'   => 'completed', 
			'limit'    => -1, 
			'return'   => 'ids', 
		);

		$orders = wc_get_orders( $args );
		foreach ( $orders as $order_id ) {
			$order = wc_get_order( $order_id );
			foreach ( $order->get_items() as $item ) {
				if ( $item->get_product_id() == 2317 ) {
					wc_add_notice( 'You have already bought this free product.', 'notice' );
					add_action( 'wp_footer', 'custom_display_pop_up_notice' );
					return false; 
				}
			}
		}
	}
	return $passed;
}


// add_action( 'woocommerce_before_cart_item_quantity_update', 'custom_check_user_purchase_on_add_to_cart', 10, 3 );
// function custom_check_user_purchase_on_add_to_cart( $cart_item_key, $quantity, $cart_item ) {
// 	if ( isset( $cart_item['product_id'] ) && $cart_item['product_id'] == 2317 ) {
// 		$user_id = get_current_user_id();
// 		if ( ! $user_id ) {
// 			return;
// 		}
// 		$args = array(
// 			'customer' => $user_id,
// 			'status'   => 'completed', 
// 			'limit'    => -1, 
// 			'return'   => 'ids', 
// 		);
// 		$orders = wc_get_orders( $args );
// 		foreach ( $orders as $order_id ) {
// 			$order = wc_get_order( $order_id );
// 			foreach ( $order->get_items() as $item ) {
// 				if ( $item->get_product_id() == 2317 ) {
// 					wc_add_notice( 'You have already bought this free product.', 'notice' );
// 					WC()->cart->remove_cart_item( $cart_item_key );
// 					return;
// 				}
// 			}
// 		}
// 	}
// }


add_action( 'wp_footer', 'custom_show_wc_notices', 20 );
function custom_show_wc_notices() {
	wc_print_notices();
	error_log('wc_print_notices:');
}

function custom_display_pop_up_notice() {
    ?>
    <div id="custom-popup-notice" style="display:none;">
        <div class="popup-content">
            <p style="color: white !important;">You have already availed the free plan.<br>You can now upgrade to any other plan.<br>Thank you!</p><br>
            <button onclick="closePopup()">Go To Plans</button>
        </div>
    </div>
    <style>
        #custom-popup-notice {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 9999;
        }

        .popup-content {
            text-align: center;
            color: white;
        }

        #custom-popup-notice button {
            background-color: #007cba;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery('#custom-popup-notice').fadeIn();
        });
        function closePopup() {
            $('#custom-popup-notice').fadeOut();
            window.location.href = '<?php echo esc_url( site_url( '/pricing-tables/' ) ); ?>';
        }
    </script>
    <?php
}

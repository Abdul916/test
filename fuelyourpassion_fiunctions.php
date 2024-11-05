<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// END ENQUEUE PARENT ACTION

// Start Display Text Free Shipping
// function custom_shipping_message_after_shipping_fee() {
//     $cart_quantity = WC()->cart->get_cart_contents_count();     
//     if ( $cart_quantity == 1 ) {
//         echo '<tr class="shipping-free-notice"><td colspan="2"><p style="color: green; font-weight: bold; text-align: center;">Buy 2 or more for free shipping!</p></td></tr>';
//     }
// }
// add_action( 'woocommerce_cart_totals_after_shipping', 'custom_shipping_message_after_shipping_fee', 10 );
// add_action( 'woocommerce_review_order_after_shipping', 'custom_shipping_message_after_shipping_fee', 10 );
// End Display Text Free Shipping

// Start Subscribe and Save Button
add_action( 'woocommerce_cart_actions', 'add_subscribe_save_button', 20 );
function add_subscribe_save_button() {
    echo '<div class="subscribe-save-container" style="margin-top: 10px;">';
    echo '<button id="subscribe_and_save" class="button subscribe-save-button">Subscribe and Save</button>';
    echo '<p class="subscribe-save-text" style="margin-top: 5px; font-size: 14px; color: green;">Save 5% now and on repeated deliveries. No fees. Cancel anytime.</p>';
    echo '</div>';
}


add_action( 'wp_enqueue_scripts', 'enqueue_subscribe_save_scripts' );
function enqueue_subscribe_save_scripts() {
    wp_enqueue_script( 'subscribe-save', get_stylesheet_directory_uri() . '/js/subscribe_save.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'subscribe-save', 'subscribe_save_params', array('nonce' => wp_create_nonce('subscribe_save_nonce')));
}

add_action( 'wp_ajax_replace_with_subscription', 'replace_with_subscription' );
add_action( 'wp_ajax_nopriv_replace_with_subscription', 'replace_with_subscription' );
function replace_with_subscription() {
    check_ajax_referer( 'subscribe_save_nonce', 'nonce' );
    $cart = WC()->cart->get_cart();
    $subscription_product_id = 7413;
    foreach ( $cart as $cart_item_key => $cart_item ) {
        WC()->cart->remove_cart_item( $cart_item_key );
    }
    $added = WC()->cart->add_to_cart( $subscription_product_id );
    if ( $added ) {
        wp_send_json_success();
    } else {
        wp_send_json_error( 'Failed to add subscription product to cart.' );
    }
}

add_action( 'woocommerce_cart_is_empty', 'custom_return_to_home_button' );
function custom_return_to_home_button() {
    echo '<p class="return-to-home"><a class="button wc-backward" href="' . esc_url( home_url() ) . '">Return to Home</a></p>';
}
// End Subscribe and Save Button

// Add a custom message in cart totals if the subscription product is in the cart
add_action( 'woocommerce_cart_totals_before_order_total', 'display_discount_message_in_cart_totals', 10 );
function display_discount_message_in_cart_totals() {
    $subscription_product_id = 7413;
    $cart = WC()->cart->get_cart();
    foreach ( $cart as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['product_id'];
        if ( $product_id == $subscription_product_id ) {
            echo '<tr class="discount-applied-message"><th colspan="2"><strong style="color: green;">Discount was applied</strong></th></tr>';
            echo '<tr class="free-delivery"><th colspan="2"><strong style="color: green;">Free Delivery</strong></th></tr>';
            break;
        } else {
            echo '<tr class="one-time-purchase"><th colspan="2"><strong style="color: green;">One-time purchase</strong></th></tr>';
            break;
        }
    }
}

// Add to Cart click hone par cart empty karna
add_filter( 'woocommerce_add_to_cart_validation', 'clear_cart_before_add_to_cart', 20, 3 );
function clear_cart_before_add_to_cart( $passed, $product_id, $quantity ) {
    if( ! WC()->cart->is_empty() )
        WC()->cart->empty_cart();
    return $passed;
}

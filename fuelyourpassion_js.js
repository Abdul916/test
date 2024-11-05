jQuery(document).ready(function($) {
    $('#subscribe-and-save').on('click', function(e) {
        e.preventDefault();

        // Disable the button to prevent multiple clicks
        $(this).prop('disabled', true);

        // Send AJAX request to handle subscription
        $.ajax({
            type: 'POST',
            url: woocommerce_params.ajax_url, // WooCommerce AJAX URL
            data: {
                action: 'replace_with_subscription',
                nonce: subscribe_save_params.nonce // Security nonce
            },
            success: function(response) {
                if(response.success) {
                    window.location.reload(); // Reload the cart page to reflect changes
                } else {
                    alert(response.data); // Show error if any
                }
            }
        });
    });
});

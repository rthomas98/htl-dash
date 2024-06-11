jQuery(document).ready(function($) {
    $('#checkout-button').click(function() {
        $.ajax({
            url: ajaxurl,
            method: 'POST',
            data: {
                action: 'create_checkout_session',
                nonce: htl_dash.nonce
            },
            success: function(response) {
                if (response.success) {
                    var stripe = Stripe('your_publishable_key');
                    stripe.redirectToCheckout({ sessionId: response.data.id });
                } else {
                    alert(response.data.message);
                }
            }
        });
    });
});


jQuery(document).ready(function($) {
    $('#htl-dash-test-connection').on('click', function() {
        var statusElement = $('#htl-dash-stripe-status');
        statusElement.text('Checking...');

        $.ajax({
            url: htlDash.ajax_url,
            method: 'POST',
            data: {
                action: 'htl_dash_test_stripe_connection',
                nonce: htlDash.nonce
            },
            success: function(response) {
                if (response.success) {
                    statusElement.text(response.data.message).css('color', 'green');
                } else {
                    statusElement.text(response.data.message).css('color', 'red');
                }
            },
            error: function() {
                statusElement.text('Error: Could not connect to Stripe').css('color', 'red');
            }
        });
    });
});


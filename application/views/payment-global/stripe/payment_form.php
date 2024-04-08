<?php
    //start common code of all payment gateway
    $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_gateway['identifier']])->row_array();

    if($payment_details['is_instructor_payout_user_id'] > 0){
        $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
        $keys = json_decode($instructor_details['payment_keys'], true);
        $keys = $keys[$payment_gateway['identifier']];
    }else{
        $keys = json_decode($payment_gateway['keys'], true);
    }
    $test_mode = $payment_gateway['enabled_test_mode'];
    //ended common code of all payment gateway

    if($test_mode == 1){
        $public_key = $keys['public_key'];
        $secret_key = $keys['secret_key'];
    } else {
        $public_key = $keys['public_live_key'];
        $secret_key = $keys['secret_live_key'];
    }
    define('STRIPE_PUBLISHABLE_KEY', $public_key);
    define('STRIPE_API_KEY', $secret_key);
?>



<div id="stripePaymentResponse" class="text-danger"></div>
<!-- Buy button -->
<button class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway payment-button float-end" id="stripePayButton"><?php echo get_phrase("pay_with_stripe"); ?></button>

<script>
var buyBtn = document.getElementById('stripePayButton');
var responseContainer = document.getElementById('stripePaymentResponse');

// Create a Checkout Session with the selected product
var createCheckoutSession = function (stripe) {
    return fetch("<?= site_url('payment/create_stripe_payment/'); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            checkoutSession: 1,
        }),
    }).then(function (result) {
        return result.json();
    });
};

// Handle any errors returned from Checkout
var handleResult = function (result) {
    if (result.error) {
        responseContainer.innerHTML = '<p>'+result.error.message+'</p>';
    }
    buyBtn.disabled = false;
    buyBtn.textContent = 'Buy Now';
};

// Specify Stripe publishable key to initialize Stripe.js
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

buyBtn.addEventListener("click", function (evt) {
    buyBtn.disabled = true;
    buyBtn.textContent = '<?php echo get_phrase("please_wait"); ?>...';

    createCheckoutSession().then(function (data) {
        if(data.sessionId){
            stripe.redirectToCheckout({
                sessionId: data.sessionId,
            }).then(handleResult);
        }else{
            handleResult(data);
        }
    });
});
</script>

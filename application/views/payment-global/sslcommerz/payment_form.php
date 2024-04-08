<?php
//start common code of all payment gateway
if($payment_details['is_instructor_payout_user_id'] > 0){
    $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
    $keys = json_decode($instructor_details['payment_keys'], true);
    $keys = $keys[$payment_gateway['identifier']];
}else{
    $keys = json_decode($payment_gateway['keys'], true);
}
$test_mode = $payment_gateway['enabled_test_mode'];
//ended common code of all payment gateway
?>

<div id="sslCommerzePaymentResponse" class="text-danger"></div>
<button class="payment-button float-end gateway <?php echo $payment_gateway['identifier']; ?>-gateway" id="sslCommerzePayButton"><?php echo get_phrase('pay_by_ssl_commerz'); ?></button>
<script>
    var buyBtn = document.getElementById('sslCommerzePayButton');
    var responseContainer = document.getElementById('sslCommerzePaymentResponse');

    // Create a Checkout Session with the selected product
    var createSslCommerzCheckoutSession = function (stripe) {
        return fetch("<?= site_url('payment/create_ssl_commerz_payment/'); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({}),
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

    buyBtn.addEventListener("click", function (evt) {
        buyBtn.disabled = true;
        buyBtn.textContent = '<?php echo get_phrase("please_wait"); ?>...';

        createSslCommerzCheckoutSession().then(function (data) {
            if(data.GatewayPageURL){
                window.location.href = data.GatewayPageURL;
            }else{
                handleResult(data);
            }
        });
    });
</script>
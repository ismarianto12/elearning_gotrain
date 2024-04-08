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
<div id="xenditPaymentResponse" class="text-danger"></div>

<button class="payment-button float-end gateway <?php echo $payment_gateway['identifier']; ?>-gateway" id="xenditButton"><?php echo get_phrase('pay_by_xendit'); ?></button>
<script>
    var xenditBuyBtn = document.getElementById('xenditButton');
    var xenditResponseContainer = document.getElementById('xenditPaymentResponse');

    // Create a Checkout Session with the selected product
    var createXenditCheckoutSession = function () {
        return fetch("<?= site_url('payment/create_xendit_payment/'); ?>", {
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
            xenditResponseContainer.innerHTML = '<p>'+result.error.message+'</p>';
        }
        xenditBuyBtn.disabled = false;
        xenditBuyBtn.textContent = 'Buy Now';
    };

    xenditBuyBtn.addEventListener("click", function (evt) {
        xenditBuyBtn.disabled = true;
        xenditBuyBtn.textContent = '<?php echo get_phrase("please_wait"); ?>...';

        createXenditCheckoutSession().then(function (data) {
            if(data.GatewayPageURL){
                window.location.href = data.GatewayPageURL;
            }else{
                handleResult(data);
            }
        });
    });
</script>
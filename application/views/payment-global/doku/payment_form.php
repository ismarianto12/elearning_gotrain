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
<?php if ($test_mode == 1) { ?>
    <script async src="https://sandbox.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
<?php } else {?>
    <script async src="https://jokul.doku.com/jokul-checkout-js/v1/jokul-checkout-1.0.0.js"></script>
<?php } ?>
<div id="dokuPaymentResponse" class="text-danger"></div>
<button class="payment-button float-end gateway <?php echo $payment_gateway['identifier']; ?>-gateway" id="dokuPayButton"><?php echo get_phrase('pay_by_doku'); ?></button>
<script>
    var dokuBuyBtn = document.getElementById('dokuPayButton');
    var dokuResponseContainer = document.getElementById('dokuPaymentResponse');


    // Create a Checkout Session with the selected product
    var createDokuCheckoutSession = function () {
        return fetch("<?= site_url('payment/create_doku_payment/'); ?>", {
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
            dokuResponseContainer.innerHTML = '<p>'+result.error.message+'</p>';
        }
        dokuBuyBtn.disabled = false;
        dokuBuyBtn.textContent = 'Buy Now';
    };

    dokuBuyBtn.addEventListener("click", function (evt) {
        dokuBuyBtn.disabled = true;
        dokuBuyBtn.textContent = '<?php echo get_phrase("please_wait"); ?>...';

        createDokuCheckoutSession().then(function (data) {
            if(data.response){

                jsondata = data.response.response.payment.url;
                loadJokulCheckout(jsondata);
            }else{
                handleResult(data);
            }
        });
    });
</script>


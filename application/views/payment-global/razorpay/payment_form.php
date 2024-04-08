<?php
//start common code of all payment gateway
if ($payment_details['is_instructor_payout_user_id'] > 0) {
  $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
  $keys = json_decode($instructor_details['payment_keys'], true);
  $keys = $keys[$payment_gateway['identifier']];
} else {
  $keys = json_decode($payment_gateway['keys'], true);
}
$test_mode = $payment_gateway['enabled_test_mode'];
//ended common code of all payment gateway

// Convert the total payable amount to an integer value (assuming it's in INR)
$total_payable_amount = intval($payment_details['total_payable_amount'] * 100);
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- Payment button -->
<button id="rzp-button" class="payment-button float-end gateway <?php echo $payment_gateway['identifier']; ?>-gateway"><?php echo get_phrase('Pay Via Razorpay') ?></button>

<script>
    // Define Razorpay options
    var options = {
        key: '<?php echo $keys['key_id']; ?>', // Replace with your Razorpay API key
        amount: <?php echo $total_payable_amount; ?>, // Amount in paisa (e.g., 50000 for Rs 500)
        currency: '<?php echo $payment_gateway['currency']; ?>', // Currency code (e.g., INR for Indian Rupees)
        name: '<?php echo get_settings('system_title'); ?>', // Your company name or website name
        description: '<?php echo $payment_details['payment_title']; ?>', // Description of the payment
        image: '<?php echo site_url('uploads/system/'.get_settings('favicon')); ?>', // URL of your company logo
        handler: function(response) {
            // Handler function to handle successful payment
            window.location.href = '<?php echo $payment_details['success_url'] . '/' . $payment_gateway['identifier']; ?>' + '?razorpay_payment_id=' + response.razorpay_payment_id;
        }
    };

    // Event handler for payment button click
    document.getElementById('rzp-button').onclick = function(e){
        // Open Razorpay checkout form
        var rzp = new Razorpay(options);
        rzp.open();
        e.preventDefault();
    };
</script>


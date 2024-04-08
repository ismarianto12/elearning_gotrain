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

  if($test_mode == 1){
    $paypalURL       = 'https://api.sandbox.paypal.com/v1/';
    $paypalClientID = $keys['sandbox_client_id'];
  } else {
    $paypalURL       = 'https://api.paypal.com/v1/';
    $paypalClientID = $keys['production_client_id'];
  }
?>




<div class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway text-end mt-3 py-3" id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

  <script>
  paypal.Button.render({
    env: '<?php echo ($test_mode == 0) ? 'production':'sandbox';?>', // 'sandbox' or 'production'
    style: {
      label: 'paypal',
      size:  'large',    // small | medium | large | responsive
      shape: 'rect',     // pill | rect
      color: 'blue',     // gold | blue | silver | black
      tagline: true
    },
    client: {
      sandbox:    '<?php echo $paypalClientID; ?>',
      production: '<?php echo $paypalClientID; ?>'
    },

    commit: true, // Show a 'Pay Now' button

    payment: function(data, actions) {
      return actions.payment.create({
        payment: {
          transactions: [
            {
              amount: { total: '<?php echo $payment_details['total_payable_amount'];?>', currency: '<?php echo $payment_gateway['currency']; ?>' }
            }
          ]
        }
      });
    },
    onAuthorize: function(data, actions) {
      // executes the payment
      return actions.payment.execute().then(function() {
        // PASSING TO CONTROLLER FOR CHECKING
        window.location = '<?php echo $payment_details['success_url'].'/'.$payment_gateway['identifier'];?>'+'?payment_id='+data.paymentID+'&payment_token='+data.paymentToken+'&payer_id='+data.payerID;
      });
    }

  }, '#paypal-button');
</script>



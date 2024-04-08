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
<form class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway" method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
  <input type="hidden" name="public_key" value="<?php echo $keys['public_key']; ?>" />
  <input type="hidden" name="customer[email]" value="<?php echo $user_details['email']; ?>" />
  <input type="hidden" name="customer[name]" value="<?php echo $user_details['first_name'].' '.$user_details['last_name']; ?>" />
  <input type="hidden" name="tx_ref" value="txref-<?php echo random(15); ?>" />
  <input type="hidden" name="amount" value="<?php echo $payment_details['total_payable_amount']; ?>" />
  <input type="hidden" name="currency" value="<?php echo $payment_gateway['currency'] ?>" />
  <input type="hidden" name="meta[source]" value="docs-html-test" />
  <input type="hidden" name="redirect_url" value="<?php echo $payment_details['success_url'].'/'.$payment_gateway['identifier'] ?>" />

  <br>
  <button type="submit" class="payment-button float-end" id="start-payment-button" style="background-color: #ff9c00;"><?php echo get_phrase('Pay by Flutterwave'); ?></button>
</form>
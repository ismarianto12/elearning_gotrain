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

if ($test_mode == 1) {

    $psPayUrl = "https://api.sandbox.international.pagseguro.com";
} else {

    $psPayUrl = "https://billing.boacompra.com/payment.php";
}

$store_id = $payment_details['items'][0]['id'];
$notify_url = 'https://creativeitem.com';//base_url();
$order_id = $user_details['id'].$store_id;


$data = $store_id . $notify_url . $order_id . $payment_details['total_payable_amount'] . $payment_gateway['currency'];
$hash_key = hash_hmac('sha256', $data, $keys['secret_key']);
// hash_key = '4daa74ec2cf5aec7f19adbd5bad4b2fb30999efeb404d455d58be3d0a9f60e3c'
?>

<form method="POST" name="billing" action="<?php echo $psPayUrl; ?>" >
    <input type="hidden" name="test_mode" id="test_mode" value="1">

    <input type="hidden" name="store_id" id="store_id" value="<?php echo $store_id; ?>">
    <input type="hidden" name="return" value="<?php echo $payment_details["success_url"];?>">
    <input type="hidden" name="notify_url" value="<?php echo $payment_details["success_url"];?>">
    <input type="hidden" name="currency_code" id="currency_code" value="<?php echo $payment_gateway['currency']; ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id; ?>">
    <input type="hidden" name="order_description" value="Course purchase">
    <input type="hidden" name="amount" id="amount" value="<?php echo $payment_details['total_payable_amount']; ?>">
    <input type="hidden" name="hash_key" id="hash_key" value="<?php echo $hash_key; ?>">
    <button class="payment-button float-end gateway <?php echo $payment_gateway['identifier']; ?>-gateway" id="skrill-button1"><?php echo get_phrase('pay_by_pageSeGuro'); ?></button>
</form>


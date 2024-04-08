<?php
$user_data   = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
$payment_keys = json_decode($user_data['payment_keys'], true);
$paypal_keys = $payment_keys['paypal'];
$stripe_keys = $payment_keys['stripe'];
$razorpay_keys = $payment_keys['razorpay'];
?>
<?php include "breadcrumb.php"; ?>

<style>
  .affiliate_form {
	margin-top: 20px;
}
.affiliate_form h4 {
    font-size: 20px;
    padding-bottom: 10px;
    margin-bottom:10px;
    color: #000;
    border-bottom: 1px solid #ddd;
}
  .col-form-label {
	font-size: 14px;
}
 .form-group small{
  font-size:11px;
 }
 .header-title p{
  text-transform:uppercase;
 }
 .alert-heading{
  font-size:20px;
 }
</style>
<section class="wish-list-body ">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php include "profile_menus.php"; ?>
          </div>
        <div class="col-md-9 mt-5 mb-3">
          <div class="col-md-12 ">
            <div class="profile-ful-body common-card">
              <div>
                 <div class="alert alert-warning mb-3" role="alert">
                      <h4 class="alert-heading"><?php echo get_phrase('be_careful'); ?>!</h4>
                      <p><?php echo get_phrase('Just configure the payment gateway you want to use, leave the rest blank.')?></p>
                      <hr>
                      <p><?php echo get_phrase('Also, make sure that you have configured your payment settings correctly')?></p>
                  </div>
                 <h4 class="header-title"><p><?php echo get_phrase('setup_your_payment_settings'); ?></p></h4>
                <form class="affiliate_form" action="<?php echo site_url('home/frontend_payout_settings/paypal_settings'); ?>" method="post" enctype="multipart/form-data"> 
                  <?php $payment_gateways = $this->db->get('payment_gateways')->result_array();
                      foreach($payment_gateways as $key => $payment_gateway):
                      $keys = json_decode($payment_gateway['keys'], true);
                      $user_keys = json_decode($user_data['payment_keys'], true);
                      ?>
                      <div class="<?php if($payment_gateway['status'] != 1 || !addon_status($payment_gateway['identifier']) && $payment_gateway['is_addon'] == 1) echo 'd-none'; ?>">
                          <h4><?php echo get_phrase($payment_gateway['title']); ?></h4>
                          <?php foreach($keys as $index => $value):
                              if(array_key_exists($payment_gateway['identifier'], $user_keys)){
                                  if(array_key_exists($index, $user_keys[$payment_gateway['identifier']])){
                                      $value = $user_keys[$payment_gateway['identifier']][$index];
                                  }else{
                                      $value = '';
                                  }
                              }else{
                                  $value = '';
                              }
                              ?>

                              <div class="form-group row mb-3">
                                  <label class="text-dark fw-600" for="<?php echo $payment_gateway['identifier'].$index; ?>"> <?php echo get_phrase($index); ?></label>
                                  <div class="input-div">
                                      <input type="text" id="<?php echo $payment_gateway['identifier'].$index; ?>" name="gateways[<?php echo $payment_gateway['identifier']; ?>][<?php echo $index; ?>]" value="<?php echo $value; ?>" class="form-control bg-white-2 text-14px">
                                      <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                         
                      </div>
                   <?php endforeach; ?>
                  <div class="form-group w-100">
                     <button class="btn btn-primary float-right" type="submit"><?php echo get_phrase('save_changes'); ?></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</section>
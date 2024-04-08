<form class="gateway <?php echo $payment_gateway['identifier']; ?>-gateway" method="POST" action="<?php echo site_url('payment/tazapay_payment_form'); ?>">
    <label class="mb-2" for="<?php echo $payment_gateway['identifier']; ?>-country-code"><?php echo get_phrase('Select your country'); ?></label>
    <select class="form-control" name="country_code" id="<?php echo $payment_gateway['identifier']; ?>-country-code" required>
        <?php foreach($iso_country_codes as $code => $country): ?>
            <option value="<?php echo $code; ?>"><?php echo get_phrase($country); ?></option>
            <?php endforeach; ?>
    </select>
  <br>
  <button type="submit" class="payment-button float-end" id="start-payment-button" style="background-color: #26536b;"><?php echo get_phrase('Pay by Tazapay'); ?></button>
</form>

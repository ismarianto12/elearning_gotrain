<div class="card gateway <?php echo $payment_gateway['identifier']; ?>-gateway">
    <div class="card-body">
        <form method="post" action="<?php echo site_url('payment/pay_by_cashfree'); ?>">
            <div class="form-group mb-3">
                <label><?php echo get_phrase('Email') ?>:</label>
                <input class="form-control" name="customer_details[customer_email]" value="<?php echo $user_details['email']; ?>" readonly/>
            </div>
            <div class="form-group mb-3">
                <label><?php echo get_phrase('Phone') ?>:</label>
                <input class="form-control" name="customer_details[customer_phone]" value="<?php echo $user_details['phone']; ?>" required/>
            </div>
            <div class="form-group mb-3 text-end">
                <button type="submit" class="payment-button" value="Pay"><?php echo get_phrase('Pay by Cashfree') ?></button>
            </div>
        </form>
    </div>
</div>
<div class="card gateway <?php echo $payment_gateway['identifier']; ?>-gateway">
    <div class="card-body">
        <form method="post" action="<?php echo site_url('payment/create_maxicash_payment'); ?>">
            <div class="form-group mb-3">
                <label><?php echo get_phrase('Email') ?>:</label>
                <input class="form-control" name="customer_email" value="<?php echo $user_details['email']; ?>" readonly/>
            </div>
            <div class="form-group mb-3">
                <label><?php echo get_phrase('Telephone') ?>:</label>
                <input type="tel" class="form-control" name="telephone" required/>
            </div>
            <div class="form-group mb-3 text-end">
                <button type="submit" class="payment-button" value="Pay" style="background-color: #850000;"><?php echo get_phrase('Pay by Maxicash') ?></button>
            </div>
        </form>
    </div>
</div>
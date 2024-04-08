<?php
    $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
?>
<style type="text/css">
    .modal-footer{
        background-color: #fff;
    }
</style>
<form class="py-4 px-4 bg-white" action="<?php echo site_url('home/account_disable'); ?>" method="post">
    <div class="row">
        <div class="col-12 mb-3">
            <p class="mb-3"><?php echo site_phrase('If you want to reactivate the account after it has been disabled, you must first authenticate your account from signup page.'); ?></p>
            <label class="text-dark fw-600" for="email"><?php echo site_phrase('email'); ?></label>
            <div class="input-group">
                <input type="email" class="form-control bg-white-2" name = "email" id="email" placeholder="<?php echo site_phrase('email'); ?>" value="<?php echo $user_details['email']; ?>" disabled>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <div class="col-12 mb-3">
            <label class="text-dark fw-600" for="account_password"><?php echo site_phrase('Confirm your password'); ?></label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
                <input type="password" class="form-control bg-white-2 text-14px" id="account_password" name = "account_password" placeholder="<?php echo site_phrase('enter_current_password'); ?>">
            </div>
        </div>

        <div class="col-12 pt-4">
            <button class="btn btn-danger px-5 py-2 w-100"><?php echo site_phrase('Confirm'); ?></button>
        </div>
    </div>
</form>
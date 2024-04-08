<!---------- Header Section End  ---------->
<section class="sign-up my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center ">
                <img loading="lazy" width="65%" src="<?php echo site_url('assets/frontend/default-new/image/cloud-security.gif') ?>">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                <div class="sing-up-right">
                    <h3><?php echo get_phrase('Login Confirmation'); ?><span>!</span></h3>
                    <p><?php echo site_phrase('let_us_know_that_this_email_address_belongs_to_you'); ?> <?php echo site_phrase('Enter_the_code_from_the_email_sent_to').' <b>'.$this->session->userdata('new_device_user_email'); ?></p>

                    <form action="<?php echo site_url('login/new_login_confirmation/submit'); ?>" method="post" id="email_verification">
                        <div class="mb-3">
                            <h5><?php echo get_phrase('Verification code'); ?></h5>
                            <div class="position-relative">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" class="form-control" placeholder="<?php echo site_phrase('enter_the_verification_code'); ?>" aria-label="<?php echo site_phrase('new_device_verification_code'); ?>" aria-describedby="<?php echo site_phrase('new_device_verification_code'); ?>" name="new_device_verification_code" id="new_device_verification_code" required>
                            </div>
                        </div>
                        <a href="javascript:;" class="text-14px fw-500 text-muted" id="resend_mail_button" onclick="resend_new_device_verification_code()">
                          <div class="float-start"><?= site_phrase('resend_verification_code') ?></div>
                          <div id="resend_mail_loader" class="float-start ps-1"></div>
                        </a>
                        <div class="log-in">
                            <button type="submit" class="btn btn-primary">
                                <?php echo get_phrase('Continue') ?>
                            </button>
                        </div>
                    </form>

                    <div class="log-in">
                        <a href="<?php echo site_url('login') ?>" class="btn btn-primary my-0">
                            <span class="fas fa-angle-left"></span>
                            <?php echo get_phrase('Back to login') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
  function resend_new_device_verification_code() {
    $("#resend_mail_loader").html('<img loading="lazy" src="<?= base_url('assets/global/gif/page-loader-3.gif'); ?>" style="width: 25px;">');
    $.ajax({
      type: 'post',
      url: '<?php echo site_url('login/new_login_confirmation/resend'); ?>',
      success: function(response){
        toastr.success('<?php echo site_phrase('mail_successfully_sent_to_your_inbox');?>');
        $("#resend_mail_loader").html('');
      }
    });
  }
</script>

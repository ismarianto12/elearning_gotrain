<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!---------- Header Section End  ---------->
    <section class="sign-up my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12  text-center">
                    <img loading="lazy" width="65%" src="<?php echo site_url('assets/frontend/default-new/image/cloud-security.gif') ?>">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                    <div class="sing-up-right">
                        <h3><?php echo get_phrase('Email Verification'); ?><span>!</span></h3>
                        <p><?php echo get_phrase('Enter your verification code here') ?></p>

                        <form action="<?php echo site_url('login/verify_email_address') ?>" method="post">
                            <div class="mb-3">
                                <h5><?php echo get_phrase('Verification code'); ?></h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="form-control" id="verification_code" type="text" name="verification_code" placeholder="<?php echo get_phrase('Enter your verification code'); ?>">
                                </div>
                                <a href="javascript:;" class="text-14px fw-500 text-muted" id="resend_mail_button" onclick="resend_verification_code()">
                                    <div class="float-start"><?= site_phrase('resend_mail') ?></div>
                                    <div id="resend_mail_loader" class="float-start ps-1"></div>
                                </a>
                            </div>
                            <?php if(get_frontend_settings('recaptcha_status')): ?>
                                <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                            <?php endif; ?>
                            <div class="log-in">
                                <button type="button" onclick="continue_verify()" class="btn btn-primary">
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
function continue_verify() {
    var email = '<?= $this->session->userdata('register_email'); ?>';
    var verification_code = $('#verification_code').val();
    $.ajax({
        type: 'post',
        url: '<?php echo site_url('login/verify_email_address/'); ?>',
        data: {verification_code : verification_code, email : email},
        success: function(response){
            if(response){
                window.location.replace('<?= site_url('login'); ?>');
            }else{
                location.reload();
            }
        }
    });
}

function resend_verification_code() {
    $("#resend_mail_loader").html('<img loading="lazy" src="<?= base_url('assets/global/gif/page-loader-3.gif'); ?>" style="width: 19px;">');
    var email = '<?= $this->session->userdata('register_email'); ?>';
    $.ajax({
        type: 'post',
        url: '<?php echo site_url('login/resend_verification_code/'); ?>',
        data: {email : email},
        success: function(response){
            toastr.success('<?php echo site_phrase('mail_successfully_sent_to_your_inbox');?>');
            $("#resend_mail_loader").html('');
        }
    });
}
</script>
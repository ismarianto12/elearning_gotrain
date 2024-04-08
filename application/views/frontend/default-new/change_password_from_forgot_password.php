<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!---------- Header Section End  ---------->
    <section class="sign-up my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center ">
                    <img loading="lazy" width="65%" src="<?php echo site_url('assets/frontend/default-new/image/cloud-security.gif') ?>">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                    <div class="sing-up-right">
                        <h3><?php echo get_phrase('Change Password'); ?><span>!</span></h3>
                        <p><?php echo get_phrase('Change your password to secure your account') ?></p>

                        <form action="<?php echo site_url('login/change_password/'.$verification_code); ?>" method="post">
                            <div class="mb-4">
                                <h5><?php echo get_phrase('New Password'); ?></h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <input class="form-control" id="new_password" type="password" name="new_password" placeholder="<?php echo get_phrase('Enter a new password'); ?>">
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5><?php echo get_phrase('Confirm your new password'); ?></h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <input class="form-control" id="confirm_password" type="password" name="confirm_password" placeholder="<?php echo get_phrase('Retype your new password'); ?>">
                                </div>
                            </div>
                            <?php if(get_frontend_settings('recaptcha_status')): ?>
                                <div class="g-recaptcha" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                            <?php endif; ?>
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
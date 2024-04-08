<?php include "breadcrumb.php"; ?>

<?php if(get_frontend_settings('recaptcha_status')): ?>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<!------------ Contact section start ----->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="contact-heading">
                    <h3><?php echo get_phrase('Contact Us') ?></h3>
                    <p><?php echo get_phrase('Connect with us to experience seamless communication. We value open dialogue and are eager to engage with you. Whether you have questions, ideas, or feedback, we are here to listen and respond.') ?></p>
                </div>               
            </div>
            <div class="col-lg-6 col-md-4">
                <!-- no content -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact-image">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/'); ?>image/contact-img.png">
                </div>
                <div class="office-time">
                    <?php
                        $contact_info = json_decode(get_frontend_settings('contact_info'), true);
                    ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="office-hour mb-4" style="font-size:14px; font-weight:400;">
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="office-hour-text">
                                    <h4><?php echo get_phrase('Email'); ?></h4>
                                    <?php echo nl2br($contact_info['email']); ?>
                                </div>
                            </div>
                            <div class="office-hour mb-4" style="font-size:14px; font-weight:400;">
                                <div class="icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="office-hour-text">
                                    <h4><?php echo get_phrase('Get In Touch'); ?></h4>
                                    <?php echo nl2br($contact_info['phone']); ?>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="office-hour mb-4" style="font-size:14px; font-weight:400;">
                                <div class="icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="office-hour-text">
                                    <h4><?php echo get_phrase('Our Address'); ?></h4>
                                    <?php echo nl2br($contact_info['address']); ?>
                                </div>
                            </div>
                            <div class="office-hour mb-4" style="font-size:14px; font-weight:400;">
                                <div class="icon">
                                    <i class="fa-solid fa-house"></i>
                                </div>
                                <div class="office-hour-text">
                                    <h4><?php echo get_phrase('Office Hours'); ?></h4>
                                    <?php echo nl2br($contact_info['office_hours']); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="<?php echo site_url('home/contact_us/submit'); ?>" method="post" class="form-section">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="first_name" type="text" class="form-control" id="first_name" placeholder="<?php echo get_phrase('First Name') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="<?php echo get_phrase('Last Name') ?>">
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="email" type="text" class="form-control" id="email" placeholder="<?php echo get_phrase('Email address') ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="mb-3">
                                <input name="phone" type="text" class="form-control" id="phone" placeholder="<?php echo get_phrase('Phone') ?>">
                            </div>                           
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <input name="address" type="text" class="form-control" id="address" placeholder="Address">
                            </div> 
                            <div class="input-group comment">
                                <textarea name="message" class="form-control" aria-label="With textarea" id="message" placeholder="<?php echo get_phrase('Write your message'); ?>"></textarea>
                              </div>
                              <div class="cheack-box">
                                <div class="form-check">
                                    <input name="i_agree" class="form-check-input" type="checkbox" value="1" id="i_agree">
                                    <label class="form-check-label" for="i_agree"> 
                                        <p><?php echo get_phrase('I agree that my submitted data is being collected and stored.'); ?></p>
                                    </label>
                                  </div>                                  
                              </div>
                              <?php if(get_frontend_settings('recaptcha_status')): ?>
                                  <div class="g-recaptcha mt-3" data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                              <?php endif; ?>
                              <div class="form-btn">
                                <button type="submit" class="btn btn-primary"><?php echo get_phrase('Submit'); ?></button>
                              </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!------------ Contact secton end -------->
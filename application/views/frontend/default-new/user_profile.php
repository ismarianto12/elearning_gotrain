<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php $social_links = json_decode($user_details['social_links'], true); ?>


<?php include "breadcrumb.php"; ?>

<!--------  Wish List body section start------>
<section class="wish-list-body message">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8">
                <div class="profile">
                    <div class="profile-bg">
                        <!-- <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/img/profile-bg-2.jpg') ?>"> -->
                    </div>
                    <div class="profile-ful-body common-card">
                        <div class="profile-parrent mt-5">
                            <div class="profile-child">
                               <a href="#"><img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>"></a> 
                                <div class="child-text">
                                    <a href="#"><h5><?php echo get_phrase('Profile Photo') ?></h5></a>
                                    <p><?php echo get_phrase('Update your profile photo and personal details'); ?></p>  
                                </div>
                            </div>

                            <div class="profile-child-btn">
                                <form action="<?php echo site_url('home/update_profile/update_photo/true') ?>" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                                    <input type="file" id="profile-photo-input" name="user_image" onchange="
                                        $('.photo-upload-btn').toggleClass('d-hidden');
                                        $('[for=profile-photo-input]').toggleClass('d-hidden');
                                    " class="d-none">
                                    <label for="profile-photo-input" class="btn btn-light float-end" type="button" style="background-color: var(--bs-gray-200);"><i class="fas fa-upload"></i> <?php echo get_phrase('Upload photo') ?></label>
                                    <div class="photo-upload-btn d-hidden">
                                        <button type="submit" class="purchase-btn ms-1 float-end"><?php echo get_phrase('Save') ?></button>
                                        <button type="reset" onclick="
                                            $('.photo-upload-btn').toggleClass('d-hidden');
                                            $('[for=profile-photo-input]').toggleClass('d-hidden');
                                        " class="purchase-btn float-end"><?php echo get_phrase('Cancel') ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="profile-input-section">
                            <form class="" action="<?php echo site_url('home/update_profile/update_basics'); ?>" method="post">
                                <div class="row">
                                    <div class="col-12 border-bottom mb-3 pb-3">
                                        <h4 class="text-black"><?php echo site_phrase('Profile Info'); ?></h4>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="text-dark fw-600" for="FristName"><?php echo site_phrase('first_name'); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control bg-white-2 text-14px" name="first_name" id="FristName" placeholder="<?php echo site_phrase('first_name'); ?>" value="<?php echo $user_details['first_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-dark fw-600" for="FristName"><?php echo site_phrase('last_name'); ?></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control bg-white-2 text-14px" name="last_name" placeholder="<?php echo site_phrase('last_name'); ?>" value="<?php echo $user_details['last_name']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <?php if ($user_details['is_instructor'] > 0) : ?>
                                            <div class="form-group mb-3">
                                                <label class="text-dark fw-600" for="Biography"><?php echo site_phrase('title'); ?></label>
                                                <textarea class="form-control bg-white-2 text-14px" name="title" placeholder="<?php echo site_phrase('short_title_about_yourself'); ?>"><?php echo $user_details['title']; ?></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="text-dark fw-600" for="skills"><?php echo get_phrase('your_skills'); ?></label>
                                                <input type="text" class=" tagify" id="skills" name="skills" data-role="tagsinput" style="width: 100%;" value="<?php echo $user_details['skills'];  ?>" />
                                                <small class="text-muted"><?php echo get_phrase('write_your_skill_and_click_the_enter_button'); ?></small>
                                            </div>

                                        <?php endif; ?>

                                        <div class="form-group">
                                            <label class="text-dark fw-600" for="Biography"><?php echo site_phrase('biography'); ?></label>
                                            <textarea class="form-control bg-white-2 text-14px text_editor" name="biography" id="Biography"><?php echo $user_details['biography']; ?></textarea>
                                        </div>

                                        <hr class="my-5 bg-secondary">

                                        <label class="text-dark fw-600"><?php echo site_phrase('add_your_twitter_link'); ?></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                            <input type="text" class="form-control bg-white-2 text-14px" maxlength="60" name="twitter_link" placeholder="<?php echo site_phrase('twitter_link'); ?>" value="<?php echo $social_links['twitter']; ?>">
                                        </div>


                                        <label class="text-dark fw-600"><?php echo site_phrase('add_your_facebook_link'); ?></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                            <input type="text" class="form-control bg-white-2 text-14px" maxlength="60" name="facebook_link" placeholder="<?php echo site_phrase('facebook_link'); ?>" value="<?php echo $social_links['facebook']; ?>">
                                        </div>


                                        <label class="text-dark fw-600"><?php echo site_phrase('add_your_linkedin_link'); ?></label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                            <input type="text" class="form-control bg-white-2 text-14px" maxlength="60" name="linkedin_link" placeholder="<?php echo site_phrase('linkedin_link'); ?>" value="<?php echo $social_links['linkedin']; ?>">
                                        </div>
                                    </div>

                                    <div class="col-12 pt-4">
                                        <button class="btn btn-primary px-5"><?php echo site_phrase('save'); ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->
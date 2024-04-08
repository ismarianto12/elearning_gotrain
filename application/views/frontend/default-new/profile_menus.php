<?php
$this->db->where('receiver', $this->session->userdata('user_id'));
$this->db->where('read_status !=', 1);
$unreaded_message = $this->db->get('message')->num_rows();
?>

<div class="wish-list-search mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="student-profile-info">
                <img loading="lazy" class="profile-image" src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>">
                <h4><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h4>
                <span><?php echo $user_details['email']; ?></span>
            </div>
        </div>
    </div>
    <div class="wish-list-course">
        <a class="btn-profile-menu <?php if($page_name == 'my_courses') echo 'active'; ?>" href="<?php echo site_url('home/my_courses'); ?>">
            <i class="fa-solid fa-book-open-reader me-2"></i>
            <?php echo get_phrase('My Courses'); ?>
        </a>

        <?php if (addon_status('course_bundle')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_bundles' || $page_name == 'bundle_invoice') echo 'active'; ?>" href="<?php echo site_url('home/my_bundles'); ?>">
                <i class="fas fa-cubes me-2"></i>
                <?php echo get_phrase('Course Bundles'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('bootcamp')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_bootcamp' || $page_name == 'my_bootcamp_details') echo 'active'; ?>" href="<?php echo site_url('addons/bootcamp/my_bootcamp'); ?>">
                <span class="me-1">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_38_2)">
                            <path
                                d="M5.25 10.5C6.9045 10.5 8.25 9.1545 8.25 7.5C8.25 5.8455 6.9045 4.5 5.25 4.5C3.5955 4.5 2.25 5.8455 2.25 7.5C2.25 9.1545 3.5955 10.5 5.25 10.5ZM5.25 6C6.07725 6 6.75 6.67275 6.75 7.5C6.75 8.32725 6.07725 9 5.25 9C4.42275 9 3.75 8.32725 3.75 7.5C3.75 6.67275 4.42275 6 5.25 6ZM10.5 17.25C10.5 17.6647 10.164 18 9.75 18C9.336 18 9 17.6647 9 17.25C9 15.1823 7.31775 13.5 5.25 13.5C3.18225 13.5 1.5 15.1823 1.5 17.25C1.5 17.6647 1.164 18 0.75 18C0.336 18 0 17.6647 0 17.25C0 14.3558 2.355 12 5.25 12C8.145 12 10.5 14.3558 10.5 17.25ZM18 3.75V9.75C18 11.8177 16.3178 13.5 14.25 13.5H11.25C10.836 13.5 10.5 13.1647 10.5 12.75V11.25C10.5 10.8353 10.836 10.5 11.25 10.5H13.5C13.914 10.5 14.25 10.8353 14.25 11.25V12C15.4905 12 16.5 10.9905 16.5 9.75V3.75C16.5 2.5095 15.4905 1.5 14.25 1.5H7.09875C6.29775 1.5 5.55075 1.93125 5.1495 2.62575C4.94175 2.98425 4.4835 3.108 4.125 2.89875C3.76575 2.69175 3.6435 2.23275 3.85125 1.87425C4.52025 0.7185 5.7645 0 7.0995 0H14.2508C16.3185 0 18 1.68225 18 3.75Z"
                                fill="#1E293B" />
                        </g>
                        <defs>
                            <clipPath id="clip0_38_2">
                                <rect width="18" height="18" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </span>
                <?php echo get_phrase('Bootcamp'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('team_training')) : ?>
            <a class="btn-profile-menu <?php if ($page_name == 'my_teams' || $page_name == 'my_selected_team') echo 'active'; ?>" href="<?php echo site_url('addons/team_training/my_teams'); ?>">
                <i class="fas fa-users me-2"></i>
                <?php echo get_phrase('My Teams'); ?>
            </a>
        <?php endif; ?>

        <?php if (addon_status('tutor_booking')) : ?>
            <a class="btn-profile-menu <?php if( $page_name=='booked_schedule_student' ) echo 'active'; ?>" href="<?php echo site_url('my_bookings'); ?>">
                <i class="far fa-calendar-check me-2"></i>
                <?php echo get_phrase('Booked Tuition'); ?>
            </a>
        <?php endif; ?>

        <?php if(addon_status('ebook')): ?>
            <a class="btn-profile-menu <?php if($page_name == 'my_ebooks') echo 'active'; ?>" href="<?php echo site_url('home/my_ebooks'); ?>">
                <i class="fas fa-book me-2"></i>
                <?php echo get_phrase('My Ebooks'); ?>
            </a>
        <?php endif; ?>


        <a class="btn-profile-menu <?php if($page_name == 'my_wishlist') echo 'active'; ?>" href="<?php echo site_url('home/my_wishlist'); ?>">
            <i class="fa-regular fa-heart me-2"></i>
            <?php echo get_phrase('Wishlist'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'my_messages') echo 'active'; ?>" href="<?php echo site_url('home/my_messages'); ?>">
            <i class="fa-regular fa-comment-dots me-2"></i>
            <?php echo get_phrase('Messages'); ?>
            <?php if($unreaded_message > 0): ?>
                <span class="badge bg-danger"><?php echo $unreaded_message; ?></span>
            <?php endif; ?>
        </a>

        <?php if (addon_status('affiliate_course')) :
            $CI    = &get_instance();
            $CI->load->model('addons/affiliate_course_model');
            $is_affilator = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
            if ($is_affilator == 1) : ?>
                <a class="btn-profile-menu <?php if ($page_name == 'affiliate_course_history') echo 'active'; ?>" href="<?php echo site_url('addons/affiliate_course/affiliate_course_history'); ?>">
                    <i class="fas fa-poll me-2"></i>
                    <?php echo site_phrase('Affiliate History '); ?>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <?php $is_affilator = 0; ?>
        <?php endif;?>

        <?php if($is_affilator == 1 || $user_details['is_instructor'] == 1): ?>
            <a class="btn-profile-menu <?php if ($page_name == 'payment_settings') echo 'active'; ?>" href="<?php echo site_url('home/payout_settings'); ?>">
                <i class="fa-solid fa-gear me-2"></i>
                <?php echo site_phrase('Payout Settings'); ?>
            </a>
        <?php endif; ?>

        <a class="btn-profile-menu <?php if($page_name == 'purchase_history') echo 'active'; ?>" href="<?php echo site_url('home/purchase_history'); ?>">
            <i class="fas fa-history me-2"></i>
            <?php echo get_phrase('Purchase history'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'user_profile') echo 'active'; ?>" href="<?php echo site_url('home/profile/user_profile'); ?>">
            <i class="fa-regular fa-user me-2"></i>
            <?php echo get_phrase('Profile'); ?>
        </a>

        <a class="btn-profile-menu <?php if($page_name == 'user_credentials') echo 'active'; ?>" href="<?php echo site_url('home/profile/user_credentials'); ?>">
            <i class="fas fa-key me-2"></i>
            <?php echo get_phrase('Account'); ?>
        </a>
    </div>
</div>
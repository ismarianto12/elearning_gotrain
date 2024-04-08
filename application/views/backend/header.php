<!-- Topbar Start -->
<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="<?php echo site_url($this->session->userdata('role')); ?>" class="topnav-logo" style="min-width: unset;">
            <span class="topnav-logo-lg">
                <img src="<?php echo base_url('uploads/system/' . get_frontend_settings('small_logo')); ?>" alt="" height="40">
            </span>
            <span class="topnav-logo-sm">
                <img src="<?php echo base_url('uploads/system/' . get_frontend_settings('small_logo')); ?>" alt="" height="40">
            </span>
        </a>

        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="align-middle text-18"><i class="fas fa-language"></i></span> <i class="mdi mdi-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-59px, 72px, 0px);">

                    <?php $languages = $this->crud_model->get_all_languages();
                    foreach ($languages as $language) : ?>
                        <?php if (trim($language) != "" && $this->session->userdata('language') != strtolower($language)) : ?>
                            <a href="javascript:void(0);" onclick="switch_language('<?php echo strtolower($language); ?>')" class="dropdown-item notify-item">
                                <span class="align-middle"><?php echo ucwords($language); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- item-->

                </div>
            </li>

            <?php if ($this->session->userdata('is_instructor') == 1 || $this->session->userdata('admin_login') == 1) : ?>
                <li class="dropdown notification-list topbar-dropdown">
                    <?php if (addon_status('course_ai')) : ?>
                        <?php if ($this->session->userdata('admin_login') == 1) : ?>
                            <a class="nav-link arrow-none" href="#" onclick="AIModal('<?php echo site_url('admin/chat_gpt') ?>', '<i class=&quot;mdi mdi-robot head-robot-icon&quot;></i> <?php echo get_phrase('AI_Writer'); ?>')">
                                <i class="mdi mdi-robot head-robot-icon"></i>
                            </a>
                        <?php else : ?>
                            <a class="nav-link arrow-none" href="#" onclick="AIModal('<?php echo site_url('user/chat_gpt') ?>', '<i class=&quot;mdi mdi-robot head-robot-icon&quot;></i> <?php echo get_phrase('AI_Writer'); ?>')">
                                <i class="mdi mdi-robot head-robot-icon"></i>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="dripicons-view-apps noti-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg p-0 mt-5 border-top-0" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-278px, 70px, 0px);">

                        <div class="rounded-top py-3 border-bottom bg-primary">
                            <h4 class="text-center text-white"><?php echo get_phrase('quick_actions') ?></h4>
                        </div>

                        <div class="row row-paddingless" style="padding-left: 15px; padding-right: 15px;">
                            <!--begin:Item-->
                            <?php if ($this->session->userdata('is_instructor') == 1 && !$this->session->userdata('admin_login')  || has_permission('course')) : ?>
                                <div class="col-6 p-0 border-bottom border-right">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?= site_url($logged_in_user_role . '/course_form/add_course_shortcut'); ?>', '<?= get_phrase('create_course'); ?>')">
                                        <i class="dripicons-archive text-20"></i>
                                        <span class="w-100 d-block text-muted"><?= get_phrase('add_course'); ?></span>
                                    </a>
                                </div>

                                <div class="col-6 p-0 border-bottom">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/lesson_types/add_shortcut_lesson'); ?>', '<?php echo get_phrase('add_new_lesson'); ?>')">
                                        <i class="dripicons-media-next text-20"></i>
                                        <span class="d-block text-muted"><?= get_phrase('add_lesson'); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('admin_login') && has_permission('student')) : ?>
                                <div class="col-6 p-0 border-right">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_add_student'); ?>', '<?php echo get_phrase('add_student'); ?>')">
                                        <i class="dripicons-user text-20"></i>
                                        <span class="w-100 d-block text-muted"><?= get_phrase('add_student'); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('admin_login') && has_permission('enrolment')) : ?>
                                <div class="col-6 p-0">
                                    <a href="#" class="d-block text-center py-3 bg-hover-light" onclick="showAjaxModal('<?php echo site_url('modal/popup/shortcut_enrol_student'); ?>', '<?php echo get_phrase('enrol_a_student'); ?>')">
                                        <i class="dripicons-network-3 text-20"></i>
                                        <span class="d-block text-muted"><?= get_phrase('enrol_student'); ?></span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <?php if ($this->session->userdata('admin_login')) : ?>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" style="padding: 2px;">
                        <i class="mdi mdi-help-circle-outline" style="font-size: 23px;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-59px, 72px, 0px);">

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0"><?php echo get_phrase('help_center'); ?></h6>
                        </div>

                        <a href="https://creativeitem.com/docs/academy-lms" target="_blank" class="dropdown-item notify-item">
                            <i class="mdi mdi-file-document-box-outline"></i>
                            <span><?php echo get_phrase('read_documentation'); ?></span>
                        </a>

                        <a href="https://www.youtube.com/watch?v=-HHhJUGQPeU&list=PLR1GrQCi5Zqvhh7wgtt-ShMAM1RROYJgE" target="_blank" class="dropdown-item notify-item">
                            <i class="mdi mdi-youtube"></i>
                            <span><?php echo get_phrase('watch_video_tutorial'); ?></span>
                        </a>

                        <a href="https://support.creativeitem.com" target="_blank" class="dropdown-item notify-item">
                            <i class="far fa-life-ring"></i>
                            <span><?php echo get_phrase('get_customer_support'); ?></span>
                        </a>

                        <a href="https://support.creativeitem.com" target="_blank" class="dropdown-item notify-item">
                            <i class="mdi mdi-arrow-right-bold-circle-outline"></i>
                            <span><?php echo get_phrase('order_customization'); ?></span>
                        </a>

                        <a href="https://support.creativeitem.com" target="_blank" class="dropdown-item notify-item">
                            <i class="mdi mdi-tooltip-plus-outline"></i>
                            <span><?php echo get_phrase('request_a_new_feature'); ?></span>
                        </a>

                        <a href="https://codecanyon.net/collections/shared/9236f1b2a5de784f383c9ecd37b2f7b43dbfc225a5f96bc3ef32ac7ab397d392" target="_blank" class="dropdown-item notify-item">
                            <i class=" mdi mdi-open-in-new"></i>
                            <span><?php echo get_phrase('browse_addons'); ?></span>
                        </a>

                        <a href="https://creativeitem.com/services" target="_blank" class="dropdown-item notify-item text-warning d-flex items-align-center">
                            <i class="text-11 dripicons-toggles mr-1"></i>
                            <span><?php echo get_phrase('Get Services'); ?></span>
                            <i class="mdi mdi-crown ml-auto"></i>
                        </a>
                    </div>
                </li>


                <!-- Notification section -->
                <li class="dropdown notification-list">
                    <?php
                    $logged_user_id = $this->session->userdata('user_id');
                    $notifications = $this->db->order_by('status ASC, id desc')->limit(50)->where('to_user', $logged_user_id)->get('notifications');
                    $number_of_unread_notification = $this->db->order_by('status ASC, id desc')->limit(50)->where('status', 0)->where('to_user', $logged_user_id)->get('notifications')->num_rows();
                    ?>
                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="dripicons-bell noti-icon"></i>
                        <span id="newNotificationIcon" class="<?php if ($number_of_unread_notification > 0) echo 'noti-icon-badge'; ?>"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="javascript: void(0);" onclick="handleNotification('remove_all')" class="text-secondary">
                                        <small><?php echo get_phrase('Remove all'); ?></small>
                                    </a>
                                </span>
                                <?php echo get_phrase('Notification'); ?>
                            </h5>
                        </div>

                        <div id="headerNotification" class="slimscroll" style="max-height: 280px;">
                            <?php include "header_notification.php"; ?>

                        </div>

                        <a onclick="handleNotification('mark_all_as_read')" href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all text-muted">
                            <?php echo get_phrase('Mark all as read'); ?>
                        </a>

                    </div>
                </li>
            <?php endif; ?>




            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" class="rounded-circle">
                    </span>
                    <span style="color: #fff;">
                        <?php
                        $logged_in_user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
                        ?>
                        <span class="account-user-name"><?php echo $logged_in_user_details['first_name'] . ' ' . $logged_in_user_details['last_name']; ?></span>
                        <span class="account-position">
                            <?php
                            if (strtolower($this->session->userdata('role')) == 'user') {
                                if ($this->session->userdata('is_instructor')) {
                                    echo get_phrase('instructor');
                                } else {
                                    echo get_phrase('student');
                                }
                            } else {
                                echo get_phrase('admin');
                            }
                            ?>
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0"><?php echo get_phrase('welcome'); ?> !</h6>
                    </div>

                    <!-- Account -->
                    <?php if ($this->session->userdata('admin_login') == 1) : ?>
                        <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/manage_profile'); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle mr-1"></i>
                            <span><?php echo get_phrase('my_account'); ?></span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo site_url('home/profile/user_profile'); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-circle mr-1"></i>
                            <span><?php echo get_phrase('my_account'); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php if (strtolower($this->session->userdata('role')) == 'admin') : ?>
                        <!-- settings-->
                        <a href="<?php echo site_url('admin/system_settings'); ?>" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings mr-1"></i>
                            <span><?php echo get_phrase('settings'); ?></span>
                        </a>

                    <?php endif; ?>

                    <!-- Logout-->
                    <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout mr-1"></i>
                        <span><?php echo get_phrase('logout'); ?></span>
                    </a>

                </div>
            </li>
        </ul>
        <a class="button-menu-mobile disable-btn">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <div class="visit_website">
            <h4 style="color: #fff; float: left;" class="d-none d-md-inline-block"> <?php echo $this->db->get_where('settings', array('key' => 'system_name'))->row()->value; ?></h4>
            <a href="<?php echo site_url('home'); ?>" target="" class="btn btn-outline-light ml-3 d-none d-md-inline-block"><?php echo get_phrase('visit_website'); ?></a>
        </div>
    </div>
</div>
<!-- end Topbar -->



<script type="text/javascript">
    // setInterval(function(){
    //     handleNotification();
    // }, 10000);

    function handleNotification(type) {
        $.ajax({
            url: '<?php echo site_url('admin/get_my_notification/'); ?>' + type,
            success: function(response) {
                var responseVal = JSON.parse(response);
                $('#headerNotification').html(responseVal.rendered_view);
                $('#newNotificationIcon').removeClass('noti-icon-badge');
                $('#newNotificationIcon').addClass(responseVal.notification_icon_class);
            }
        });
    }
</script>
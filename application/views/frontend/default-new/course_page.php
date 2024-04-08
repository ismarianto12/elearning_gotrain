<?php
$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
$lessons = $this->crud_model->get_lessons('course', $course_details['id']);
$instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
$course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
$number_of_enrolments = $this->crud_model->enrol_history($course_details['id'])->num_rows();
$total_rating =  $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
$number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
if ($number_of_ratings > 0) {
    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
} else {
    $average_ceil_rating = 0;
}
?>

<!---------- Banner Start ---------->
<section>
    <div class="bread-crumb courses-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="courses-details-1st-text">
                        <h1><?php echo $course_details['title']; ?></h1>
                        <p class="mb-3"><?php echo $course_details['short_description']; ?></p>
                        <div class="review">
                            <div class="row ">
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info-tag">
                                        <img loading="lazy" width="25px" height="25px" class="rounded-circle object-fit-cover me-1" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>">
                                        <p class="text-12px mt-5px me-1"><?php echo get_phrase('Created By'); ?></p>
                                        <p class="text-15px mt-1">
                                            <a class="created-by-instructor" href="<?php echo site_url('home/instructor_page/' . $course_details['creator']); ?>"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></a>
                                        </p>
                                    </div>

                                    <div class="info-tag">
                                        <?php if ($course_duration) : ?>
                                            <i class="fa-regular fa-clock text-15px mt-7px"></i>
                                            <p class="text-15px mt-1"><?php echo $course_duration; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="info-tag">
                                        <i class="fa-regular fa-user text-15px mt-7px"></i>
                                        <p class="text-15px mt-1"><?php echo $number_of_enrolments ?> <?php echo get_phrase('Enrolled'); ?></p>
                                    </div>

                                    <div class="info-tag">
                                        <div class="icon">
                                            <ul>
                                                <?php for ($i = 1; $i < 6; $i++) : ?>
                                                    <?php if ($i <= $average_ceil_rating) : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-15px  mt-7px"></i></li>
                                                    <?php else : ?>
                                                        <li class="me-0"><i class="fa-solid fa-star text-light text-15px  mt-7px"></i></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <p class="text-15px mt-1">(<?php echo $number_of_ratings . ' ' . get_phrase('Reviews'); ?>)</p>
                                            </ul>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-12 course-heading-info mb-3">
                                    <div class="info-tag">
                                        <i class="fas fa-language text-15px mt-8px"></i>
                                        <p class="text-15px mt-1"><?php echo ucfirst($course_details['language']); ?></p>
                                    </div>

                                    <div class="info-tag">
                                        <p><i class="far fa-calendar-alt text-15px mt-7px"></i></p>
                                        <p class="text-12px mt-5px me-1"><?php echo get_phrase('Last Updated'); ?></p>
                                        <p class="text-15px mt-1">
                                            <?php if ($course_details['last_modified'] > 0) : ?>
                                                <?php echo date('D, d-M-Y', $course_details['last_modified']); ?>
                                            <?php else : ?>
                                                <?php echo date('D, d-M-Y', $course_details['date_added']); ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Banner Area End ---------->

<!--------- course Decription Page Start ------>
<section class="course-decription">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 order-2 order-lg-1">
                <div class="course-left-side">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="course-overview-tab" data-bs-toggle="tab" data-bs-target="#course-overview" type="button" role="tab" aria-controls="course-overview" aria-selected="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18.666" viewBox="0 0 14 18.666">
                                    <g id="Group_8" data-name="Group 8" transform="translate(14 0) rotate(90)">
                                        <path id="Shape" d="M7,14.307l3.7,3.78c1.3,1.326,3.3.227,3.3-1.81V0H0V16.277c0,2.037,2,3.136,3.3,1.81ZM2,2.385V16.277l5-5.11,5,5.11V2.385Z" transform="translate(0 14) rotate(-90)" fill="#1e293b" fill-rule="evenodd" />
                                    </g>
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Overview'); ?></button></span>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                                <svg id="Group_13" data-name="Group 13" xmlns="http://www.w3.org/2000/svg" width="20" height="19.692" viewBox="0 0 20 19.692">
                                    <path id="Shape" d="M14,2.5a.5.5,0,0,0-.5-.5H2.5a.5.5,0,0,0-.5.5V16.028a.455.455,0,0,0,.658.407,3,3,0,0,1,2.683,0L7.553,17.54a1,1,0,0,0,.894,0l2.211-1.106a3,3,0,0,1,2.683,0A.455.455,0,0,0,14,16.028Zm2,16.691a.5.5,0,0,1-.724.447l-2.829-1.415a1,1,0,0,0-.894,0L9.342,19.329a3,3,0,0,1-2.683,0L4.447,18.224a1,1,0,0,0-.894,0L.724,19.638A.5.5,0,0,1,0,19.191V0H16Z" transform="translate(2)" fill="#1e293b" fill-rule="evenodd" />
                                    <g id="Shape-2" data-name="Shape" transform="translate(6 4)">
                                        <path id="_5D20F028-8654-4138-BE2C-2596CB0A8C99" data-name="5D20F028-8654-4138-BE2C-2596CB0A8C99" d="M1,0A1,1,0,0,0,1,2H3A1,1,0,0,0,3,0Z" fill="#1e293b" />
                                        <path id="CB5AF5FF-CA28-49F3-8207-42C293893700" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6)" fill="#1e293b" />
                                        <path id="ECA14E2E-A90F-4909-9E68-1DC1F5104902" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 4)" fill="#1e293b" />
                                        <path id="_841F264B-A82E-487A-AEC1-CFCDCADF7975" data-name="841F264B-A82E-487A-AEC1-CFCDCADF7975" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 4)" fill="#1e293b" />
                                        <path id="AD528B39-E6BD-4596-94B4-DC58311EEB90" d="M0,1A1,1,0,0,1,1,0H3A1,1,0,0,1,3,2H1A1,1,0,0,1,0,1Z" transform="translate(0 8)" fill="#1e293b" />
                                        <path id="_6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" data-name="6CF152B9-DFD7-4CE1-B45B-12E7F5ED6D14" d="M1,0A1,1,0,1,0,2,1,1,1,0,0,0,1,0Z" transform="translate(6 8)" fill="#1e293b" />
                                    </g>
                                    <path id="Shape-3" data-name="Shape" d="M0,1A1,1,0,0,1,1,0H19a1,1,0,0,1,0,2H1A1,1,0,0,1,0,1Z" fill="#1e293b" />
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Curriculum') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                <svg id="Group_12" data-name="Group 12" xmlns="http://www.w3.org/2000/svg" width="15.582" height="19.666" viewBox="0 0 15.582 19.666">
                                    <path id="Shape" d="M7.791,1.731a6.06,6.06,0,0,0-6.06,6.06V9.522A.866.866,0,1,1,0,9.522V7.791a7.791,7.791,0,0,1,15.582,0V9.522a.866.866,0,1,1-1.731,0V7.791A6.06,6.06,0,0,0,7.791,1.731Z" transform="translate(0 9.278)" fill="#1e293b" />
                                    <path id="Shape-2" data-name="Shape" d="M5.194,8.656A3.463,3.463,0,1,0,1.731,5.194,3.463,3.463,0,0,0,5.194,8.656Zm0,1.731A5.194,5.194,0,1,0,0,5.194,5.194,5.194,0,0,0,5.194,10.388Z" transform="translate(2.597)" fill="#1e293b" fill-rule="evenodd" />
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Instructor') ?></span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                <svg id="Group_14" data-name="Group 14" xmlns="http://www.w3.org/2000/svg" width="20" height="19.749" viewBox="0 0 20 19.749">
                                    <path id="Shape" d="M5,13.9V17L10.062,14,10.591,14A40.888,40.888,0,0,0,16,13.533a1.9,1.9,0,0,0,1.649-1.542A23.708,23.708,0,0,0,18,8a23.709,23.709,0,0,0-.346-3.991A1.9,1.9,0,0,0,16,2.467,40.515,40.515,0,0,0,10,2a40.514,40.514,0,0,0-6,.467A1.9,1.9,0,0,0,2.346,4.009,23.7,23.7,0,0,0,2,8a23.7,23.7,0,0,0,.346,3.991,1.859,1.859,0,0,0,1.285,1.455ZM.375,3.67A3.9,3.9,0,0,1,3.695.489,42.513,42.513,0,0,1,10,0a42.512,42.512,0,0,1,6.305.489,3.9,3.9,0,0,1,3.319,3.18A25.7,25.7,0,0,1,20,8a25.694,25.694,0,0,1-.375,4.33,3.9,3.9,0,0,1-3.319,3.18,42.9,42.9,0,0,1-5.681.484L4.509,19.608A1,1,0,0,1,3,18.748v-3.4A3.859,3.859,0,0,1,.375,12.33,25.7,25.7,0,0,1,0,8,25.7,25.7,0,0,1,.375,3.67Z" fill="#1e293b" fill-rule="evenodd" />
                                    <path id="Shape-2" data-name="Shape" d="M1,0A1,1,0,0,0,1,2H11a1,1,0,0,0,0-2ZM1,4A1,1,0,0,0,1,6H5A1,1,0,0,0,5,4Z" transform="translate(4 5)" fill="#1e293b" fill-rule="evenodd" />
                                </svg>

                                <span class="ms-2"><?php echo get_phrase('Reviews') ?></span></button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="course-overview" role="tabpanel" aria-labelledby="course-overview-tab">
                            <?php include "course_page_info_description.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                            <?php include "course_page_curriculum.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                            <?php include "course_page_instructor.php"; ?>
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews">
                                <?php include "course_page_reviews.php"; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2">
                <div class="course-right-section">
                    <div class="course-card">
                        <div class="card-img">
                            <div class="courses-card-image">
                                <div class="card-video-icon" onclick="lesson_preview('<?php echo site_url('home/course_preview/' . $course_details['id']); ?>', '<?php echo get_phrase($course_details['title']) ?>')">
                                    <i class="fa-solid fa-play"></i>
                                </div>

                                <img loading="lazy" class="w-100" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>">

                                <div class="courses-icon <?php if (in_array($course_details['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course_details['id']; ?>">
                                    <i class="fa-solid fa-heart me-2 cursor-pointer checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/' . $course_details['id']); ?>')"></i>
                                </div>
                            </div>
                        </div>
                        <div class="ammount d-flex">
                            <?php if ($course_details['is_free_course']) : ?>
                                <h1 class="fw-500"><?php echo get_phrase('Free'); ?></h1>
                            <?php elseif ($course_details['discount_flag']) : ?>
                                <h1 class="fw-500"><?php echo currency($course_details['discounted_price']); ?></h1>
                                <h3 class="fw-500"><del><?php echo currency($course_details['price']); ?></del></h3>
                            <?php else : ?>
                                <h1 class="fw-500"><?php echo currency($course_details['price']); ?></h1>
                            <?php endif; ?>

                            <a href="<?php echo base_url('home/compare?course-1=' . slugify($course_details['title']) . '&course-id-1=' . $course_details['id']); ?>" title="<?php echo get_phrase('Compare this course') ?>" data-bs-toggle="tooltip" class="ms-auto py-2">
                                <img loading="lazy" width="18px" src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>" style="filter: invert(1);">
                            </a>
                        </div>
                        <div class="enrol">
                            <div class="icon">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-1.png') ?>">
                                <h4><?php echo get_phrase('Lectures') ?></h4>
                            </div>
                            <h5><?php echo $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?></h5>
                        </div>

                        <?php $number_of_quiz = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                        <?php if ($number_of_quiz > 0) : ?>
                            <div class="enrol">
                                <div class="icon">
                                    <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-4.png') ?>">
                                    <h4><?php echo get_phrase('Quizzes') ?></h4>
                                </div>

                                <h5><?php echo $number_of_quiz; ?></h5>
                            </div>
                        <?php endif; ?>

                        <div class="enrol">
                            <div class="icon">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-2.png') ?>">
                                <h4><?php echo get_phrase('Skill level') ?></h4>
                            </div>
                            <h5><?php echo get_phrase($course_details['level']); ?></h5>
                        </div>


                        <div class="enrol">
                            <div class="icon">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/c-enrold-5.png') ?>">
                                <h4><?php echo get_phrase('Expiry period') ?></h4>
                            </div>
                            <h5>
                                <?php if ($course_details['expiry_period'] <= 0) : ?>
                                    <?php echo get_phrase('Lifetime') ?>
                                <?php else : ?>
                                    <?php echo $course_details['expiry_period'] . ' ' . get_phrase('Months'); ?>
                                <?php endif; ?>
                            </h5>
                        </div>

                        <?php if (addon_status('certificate')) : ?>
                            <div class="enrol">
                                <div class="icon">
                                    <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/certificate.png') ?>">
                                    <h4><?php echo get_phrase('Certificate') ?></h4>
                                </div>

                                <h5><?php echo get_phrase('Yes') ?></h5>
                            </div>
                        <?php endif; ?>


                        <!-- button -->
                        <div class="button">
                            <?php $cart_items = $this->session->userdata('cart_items'); ?>
                            <?php if (is_purchased($course_details['id'])) : ?>
                                <a href="<?php echo site_url('home/lesson/' . slugify($course_details['title']) . '/' . $course_details['id']) ?>"><i class="far fa-play-circle"></i> <?php echo get_phrase('Start Now'); ?></a>
                                <?php if ($course_details['is_free_course'] != 1) : ?>
                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id'] . '?gift=1'); ?>')"><i class="fas fa-gift"></i> <?php echo get_phrase('Gift someone else'); ?></a>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php if ($course_details['is_free_course'] == 1) : ?>
                                    <a href="<?php echo site_url('home/get_enrolled_to_free_course/' . $course_details['id']); ?>"><?php echo get_phrase('Enroll Now'); ?></a>
                                <?php else : ?>

                                    <!-- Cart button -->
                                    <a id="added_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if (!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?> active" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>');"><i class="fas fa-minus"></i> <?php echo get_phrase('Remove from cart'); ?></a>
                                    <a id="add_to_cart_btn_<?php echo $course_details['id']; ?>" class="<?php if (in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" href="#" onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id']); ?>'); "><i class="fas fa-plus"></i> <?php echo get_phrase('Add to cart'); ?></a>
                                    <!-- Cart button ended-->

                                    <a href="#" onclick="actionTo('<?php echo site_url('home/handle_buy_now/' . $course_details['id']); ?>')"><i class="fas fa-credit-card"></i> <?php echo get_phrase('Buy Now'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (addon_status('affiliate_course')) : // course_addon start  adding
                                $CI    = &get_instance();
                                $CI->load->model('addons/affiliate_course_model');
                                $is_affiliattor = $CI->affiliate_course_model->is_affilator($this->session->userdata('user_id'));
                                if ($is_affiliattor == 1) :
                                    $user_data = $CI->affiliate_course_model->get__affiliator_status_table_info_by_user_id($this->session->userdata('user_id'));
                            ?>

                                    <a class="btn-custom_coursepage text-decoration-none fw-600 hover-shadow-1 d-inline-block" href="#myModel" data-bs-toggle="modal" data-bs-target="#myModel" id="shareBtn" data-bs-placement="top"><i class="fas fa-user-plus"></i> <?php echo site_phrase('Share and Earn'); ?></a>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>


                        <?php
                        if (isset($user_data['unique_identifier'])) :
                            $ref = $user_data['unique_identifier'];
                        else :
                            $ref = '';
                        endif;
                        ?>
                        <div class="w-100 px-4 pb-2 text-center">
                            <?php $share_url = site_url('home/course/' . slugify($course_details['title']) . '/' . $course_details['id']); ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #316FF6;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Facebook'); ?>" data-bs-placement="top">
                                <i class="fab fa-facebook text-20px"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $course_details['title']; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #1DA1F2;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Twitter'); ?>" data-bs-placement="top">
                                <i class="fab fa-twitter text-20px"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_url; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #128c7e;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Whatsapp'); ?>" data-bs-placement="top">
                                <i class="fab fa-whatsapp text-20px"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?url=<?php echo $share_url; ?>&title=<?php echo $course_details['title']; ?>&summary=<?php echo $course_details['short_description']; ?>&ref=<?php echo $ref; ?>" target="_blank" class="p-2" style="color: #0077b5;" data-bs-toggle="tooltip" title="<?php echo get_phrase('Share on Linkedin'); ?>" data-bs-placement="top">
                                <i class="fab fa-linkedin text-20px"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--------- course Decription Page end ------>


<!-------- Related course section start ----->
<section class="courses grid-view-body course-details-card">
    <div class="container">
        <h1><?php echo get_phrase('Related Courses'); ?></h1>
        <div class="courses-card">
            <div class="row">
                <?php $related_courses = $this->crud_model->get_related_courses($course_details['category_id'], $course_details['sub_category_id'], $course_details['id'], 12)->result_array(); ?>
                <?php foreach ($related_courses as $key => $course) :

                    $lessons = $this->crud_model->get_lessons('course', $course['id']);
                    $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
                    $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
                    $total_rating =  $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                    $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                    if ($number_of_ratings > 0) {
                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                    } else {
                        $average_ceil_rating = 0;
                    }
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>" class="checkPropagation courses-card-body">
                            <div class="courses-card-image">
                                <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>">
                                <div class="courses-icon <?php if (in_array($course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course['id']; ?>">
                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/' . $course['id']); ?>')"></i>
                                </div>
                                <div class="courses-card-image-text">
                                    <h3><?php echo get_phrase($course['level']); ?></h3>
                                </div>
                            </div>
                            <div class="courses-text">
                                <h5 class="mb-2"><?php echo $course['title']; ?></h5>
                                <div class="review-icon">
                                    <div class="review-icon-star">
                                        <p><?php echo $average_ceil_rating; ?></p>
                                        <i class="fa-solid fa-star <?php if ($number_of_ratings > 0) echo 'filled'; ?>"></i>
                                        <p>(<?php echo $number_of_ratings; ?> <?php echo get_phrase('Reviews') ?>)</p>
                                    </div>
                                    <div class="review-btn">
                                        <span class="compare-img checkPropagation" onclick="redirectTo('<?php echo base_url('home/compare?course-1=' . slugify($course['title']) . '&course-id-1=' . $course['id']); ?>');">
                                            <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>">
                                            <?php echo get_phrase('Compare'); ?>
                                        </span>
                                    </div>
                                </div>
                                <p class="ellipsis-line-2 mx-0"><?php echo $course['short_description']; ?></p>
                                <div class="courses-price-border">
                                    <div class="courses-price">
                                        <div class="courses-price-left">
                                            <?php if ($course['is_free_course']) : ?>
                                                <h5><?php echo get_phrase('Free'); ?></h5>
                                            <?php elseif ($course['discount_flag']) : ?>
                                                <h5><?php echo currency($course['discounted_price']); ?></h5>
                                                <p class="mt-1"><del><?php echo currency($course['price']); ?></del></p>
                                            <?php else : ?>
                                                <h5><?php echo currency($course['price']); ?></h5>
                                            <?php endif; ?>
                                        </div>
                                        <div class="courses-price-right ">
                                            <?php if ($course_duration) : ?>
                                                <i class="fa-regular fa-clock"></i>
                                                <p class="m-0"><?php echo $course_duration; ?></p>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-------- Related course section end ----->


<?php if (addon_status('affiliate_course') && $is_affiliattor == 1) : ?>
    <?php include 'affiliate_course_modal.php';  // course_addon  single line /adding 
    ?>
<?php endif; ?>

<?php if (addon_status('team_training')) : ?>
    <?php include 'course_related_packages.php'; ?>
<?php endif; ?>
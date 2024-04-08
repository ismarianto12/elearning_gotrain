<?php $enrolments = $this->user_model->my_courses()->result_array(); ?>
<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php include "breadcrumb.php"; ?>

<!-------- Wish List body section start ------>
<section class="wish-list-body ">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="my-course-1-full-body">
                    <h1><?php echo get_phrase('Courses'); ?></h1>
                    <div class="row">
                        <?php foreach($enrolments as $enrolment):
                            $course_details = $this->crud_model->get_course_by_id($enrolment['course_id'])->row_array();
                            $instructor_details = $this->user_model->get_all_user($course_details['creator'])->row_array();
                            $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
                            $lectures = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type !=' => 'quiz']);
                            $quizzes = $this->db->get_where('lesson', ['course_id' => $course_details['id'], 'lesson_type' => 'quiz']);
                            $watch_history = $this->crud_model->get_watch_histories($this->session->userdata('user_id'), $course_details['id'])->row_array();
                            $course_progress = isset($watch_history['course_progress']) ? $watch_history['course_progress'] : 0;
                            ?>
                            <div class="col-lg-12 col-md-12 col-sm-6 col-12 mb-5">
                                <div class="my-course-1-full-body-card">
                                    <div class="my-course-1-img">
                                        <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" alt="">
                                    </div>
                                    <div class="my-course-1-text pt-1">
                                        <div class="my-course-1-text-heading">
                                            <h3><?php echo $course_details['title']; ?></h3>
                                            <div class="child-icon">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle py-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url('home/course/'.rawurlencode(slugify($course_details['title'])).'/'.$course_details['id']); ?>"><?php echo get_phrase('Go to course page') ?></a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item py-2" href="<?php echo site_url('home/instructor_page/'.$course_details['creator']) ?>"><?php echo get_phrase('Author profile') ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-course-1-lesson-text mb-2">
                                            <div class="icon-1">
                                                <p><i class="far fa-play-circle"></i> <?php echo get_phrase('Lectures').' '.$lectures->num_rows(); ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="far fa-question-circle"></i> <?php echo get_phrase('Quizzes').' '.$quizzes->num_rows(); ?></p>
                                            </div>
                                            <div class="icon-1">
                                                <p><i class="fa-regular fa-clock"></i> <?php echo $course_duration; ?></p>
                                            </div>
                                        </div>
                                        <div class="my-course-1-skill">
                                              <div class="skill-bar-container">
                                                <div class="skill-bar" style="width: <?php echo $course_progress; ?>%; animation: unset"></div>
                                              </div>
                                              <p><?php echo $course_progress; ?>%</p>
                                        </div>

                                        <?php include 'live_class_scadule.php'; ?>

                                        <div class="my-course-1-last">
                                            <div class="icon-img d-grid">
                                                <?php $my_rating = $this->crud_model->get_user_specific_rating('course', $course_details['id']); ?>
                                                <div class="d-flex align-items-center">
                                                    <img loading="lazy" class="ms-0" src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="">
                                                    <span class="text-14px ms-1 mt-1"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?> </span>
                                                    <div class="star m-0">
                                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                                            <i class="fa-solid fa-star <?php if($my_rating['rating'] >= $i) echo 'gold'; ?>"></i>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                                <?php if($enrolment['expiry_date'] > 0 && $enrolment['expiry_date'] < time()): ?>
                                                    <span class="text-12px text-start mt-2"><?php echo get_phrase('Expired') ?> - <b style="color: var(--bs-code-color);"><?php echo date('d M Y, H:i A', $enrolment['expiry_date']); ?></b></span>
                                                <?php else: ?>
                                                    <?php if($enrolment['expiry_date'] == 0): ?>
                                                        <span class="text-12px text-start mt-2"><?php echo get_phrase('Expiry period') ?> - <b class="text-success text-uppercase"><?php echo get_phrase('Lifetime Access'); ?></b></span>
                                                    <?php else: ?>
                                                        <span class="text-12px text-start mt-2"><?php echo get_phrase('Expiration On') ?> - <b><?php echo date('d M Y, H:i A', $enrolment['expiry_date']); ?></b></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="my-course-1-btn pt-4 me-4">
                                                <?php if($enrolment['expiry_date'] > 0 && $enrolment['expiry_date'] < time()): ?>
                                                    <a class="btn text-14px py-1 text-white" style="background-color: var(--bs-code-color);" href="#" onclick="actionTo('http://localhost/academy/academy_6.0/home/handle_buy_now/<?php echo $course_details['id']; ?>')">
                                                        <i class="far fa-calendar-plus"></i>
                                                        <?php echo get_phrase('Join again'); ?>
                                                    </a>
                                                <?php else: ?>
                                                    <a class="btn btn-primary text-14px py-1" href="<?php echo site_url('home/lesson/'.slugify($course_details['title']).'/'.$course_details['id']) ?>">
                                                        <i class="far fa-play-circle"></i>
                                                        <?php echo get_phrase('Start Now'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->

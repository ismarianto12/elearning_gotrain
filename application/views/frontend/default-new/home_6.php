<!-- Start Banner -->
<section class="banner-six pt-60">
  <div class="container">
    <div class="row flex-column-reverse flex-lg-row align-items-center">
      <div class="col-lg-6">
        <div class="banner-six-content pb-30">
          <p class="subtitle text-uppercase"><?php echo get_phrase('Welcome to').' '.get_settings('system_name'); ?></p>
          <?php
            $banner_title = site_phrase(get_frontend_settings('banner_title'));
            $banner_title_arr = explode(' ', $banner_title);
          ?>
          <h4 class="title">
              <?php
              foreach($banner_title_arr as $key => $value){
                  if(0 == $key){
                      echo '<span class="color-1">'.$value.'</span>';
                  }else{
                      echo $value.' ';
                  }
              }
              ?>
          </h4>
          <p class="info"><?php echo site_phrase(get_frontend_settings('banner_sub_title')); ?></p>

          <a href="<?php echo site_url('sign_up'); ?>" class="btn-six"><?php echo get_phrase('Join for free'); ?></a>
        </div>
        <div class="brand-4">
          <div class="item">
            <?php $all_students = $this->db->get_where('users', ['role_id !=' => 1]); ?>
            <h1><?php echo nice_number($all_students->num_rows()); ?>+</h1>
            <p><?php echo get_phrase('Happy Student') ?></p>
          </div>
          <div class="item">
            <?php $all_instructor = $this->db->get_where('users', ['is_instructor' => 1]); ?>
            <h1><?php echo nice_number($all_instructor->num_rows()); ?>+</h1>
            <p><?php echo get_phrase('Experienced Instructor') ?></p>
          </div>
          <div class="item">
            <?php $status_wise_courses = $this->crud_model->get_status_wise_courses_front(); ?>
            <h1><?php echo nice_number($status_wise_courses['active']->num_rows()); ?>+</h1>
            <p><?php echo get_phrase('Quality courses') ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="banner-six-img">
          <img loading="lazy" src="<?php echo base_url("uploads/system/" . get_current_banner('banner_image')); ?>" alt="" />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Banner -->

<!-- Start Course -->
<section class="pb-110 pt-60">
  <div class="container">
    <div class="section-item-six">
      <div class="item">
        <div class="icon">
          <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/kitchen-5.svg" alt="" />
        </div>
        <div class="content">
          <h4 class="title"><?php echo get_phrase('Latest Top Skills') ?></h4>
          <p class="info"><?php echo get_phrase('Stay ahead with our curated courses, mastering in-demand skills.') ?></p>
        </div>
      </div>
      <div class="item">
        <div class="icon">
          <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/kitchen-7.svg" alt="" />
        </div>
        
        <div class="content">
          <h4 class="title"><?php echo get_phrase('Globalization') ?></h4>
          <p class="info"><?php echo get_phrase('Opportunity for global networking and collaboration with peers worldwide.') ?></p>
        </div>
      </div>
      <div class="item">
        <div class="icon">
          <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/kitchen-6.svg" alt="" />
        </div>
        <div class="content">
          <h4 class="title"><?php echo get_phrase('Cost-effectiveness') ?></h4>
          <p class="info"><?php echo get_phrase('Cost-effective compared to traditional in-person education.') ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Course -->


<?php if(get_frontend_settings('top_course_section') == 1): ?> 
<!-- Start Top Rated Course -->
<section class="featured-course pb-110">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <!-- Title -->
        <div class="title-two text-center pb-50">
          <h4 class="title"><?php echo get_phrase('Top Courses') ?></h4>
          <p class="info"><?php echo get_phrase('These_are_the_most_popular_courses_among_Listen_Courses_learners_worldwide'); ?></p>
        </div>
      </div>
    </div>
    <!-- Items -->
    <div class="row g-3">
      <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
      foreach ($top_courses as $key => $top_course) :
        if($key == 8) break;
        $instructor_details = $this->user_model->get_all_user($top_course['creator'])->row_array();
        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($top_course['id']);
        $number_of_enrolled_students = $this->crud_model->enrol_history($top_course['id'], true)->num_rows();
        $lessons = $this->crud_model->get_lessons('course', $top_course['id']);
        $total_rating =  $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
        $number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
        if ($number_of_ratings > 0) {
            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
        } else {
            $average_ceil_rating = 0;
        }
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']); ?>" class="course-item-6 checkPropagation">
            <div class="img">
              <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" alt="" />
            </div>
            <div class="content">
              <h4 class="title"><?php echo $top_course['title']; ?></h4>
              <div class="time-rate d-flex justify-content-between align-items-center">
                <div class="time d-flex align-items-center">
                  <div class="icon">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/clock-6.svg" alt="" />
                  </div>
                  <p class="info"><?php echo $course_duration; ?></p>
                </div>
                <div class="rate d-flex align-items-center">
                  <p class="info"><?php echo $average_ceil_rating; ?></p>
                  <div class="icon">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/star.svg" alt="" />
                  </div>
                </div>
              </div>
              <div class="user-price d-flex justify-content-between align-items-center">
                <div class="user d-flex align-items-center checkPropagation" onclick="redirectTo('<?php echo site_url('home/instructor_page/'.$instructor_details['id']) ?>')">
                  <div class="img">
                    <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="" />
                  </div>
                  <h4 class="name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></h4>
                </div>
                <p class="price d-flex align-items-center">
                  <?php if($top_course['is_free_course']): ?>
                    <?php echo get_phrase('Free'); ?>
                  <?php elseif($top_course['discount_flag']): ?>
                    <?php echo currency($top_course['discounted_price']); ?>
                    <del class="ms-1 text-12px"><?php echo currency($top_course['price']); ?></del>
                  <?php else: ?>
                    <?php echo currency($top_course['price']); ?>
                  <?php endif; ?>
                </p>
              </div>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Top Rated Course -->
<?php endif; ?>


<?php if(get_frontend_settings('top_category_section') == 1): ?>
<!-- Start Categories -->
<section class="scategories-4 pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-60">
      <h4 class="title"><?php echo get_phrase('Popular Categories') ?></h4>
      <div class="bar"></div>
    </div>
    <!-- Items -->
    <div class="row justify-content-center">
      <?php $top_10_categories = $this->crud_model->get_top_categories(12, 'sub_category_id'); ?>
      <?php foreach($top_10_categories as $top_10_category): ?>
        <?php $category_details = $this->crud_model->get_category_details_by_id($top_10_category['sub_category_id'])->row_array(); ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <a class="category-item" href="<?php echo site_url('home/courses?category='.$category_details['slug']); ?>">
            <div class="icon text-center" style="color: #<?php echo rand(100000, 999999); ?>">
              <i class="<?php echo $category_details['font_awesome_class']; ?>"></i>
            </div>
            <h3 class="info">
              <?php echo $category_details['name']; ?>
              <p class="m-0 text-muted text-14px"><?php echo $top_10_category['course_number'].' '.site_phrase('Courses'); ?></p>
            </h3>

          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Categories -->
<?php endif; ?>

<?php if(get_frontend_settings('upcoming_course_section') == 1): ?>
<!-- Start Upcoming Course -->
<?php $upcoming_courses = $this->db->order_by('id', 'desc')->limit(6)->get_where('course', ['status' => 'upcoming']); ?>
<?php if($upcoming_courses->num_rows() > 0): ?>
<section class="featured-course pb-110">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <!-- Title -->
        <div class="title-two text-center pb-50">
          <h4 class="title"><?php echo get_phrase('Upcoming Courses'); ?></h4>
          <p class="info"><?php echo get_phrase('Unlock new expertise with industry experts and thought leaders in our upcoming courses.') ?></p>
        </div>
      </div>
    </div>
    <!-- Items -->
    <ul class="upcoming-course-list-six">
      <?php
      foreach($upcoming_courses->result_array() as $upcoming_course):
        $instructor_details = $this->user_model->get_all_user($upcoming_course['creator'])->row_array();
         $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($upcoming_course['id']);
         $lessons = $this->crud_model->get_lessons('course', $upcoming_course['id']);
        ?>
        <li>
          <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($upcoming_course['title'])) . '/' . $upcoming_course['id']); ?>" class="upcoming-course-six">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="upcoming-course-six-content">
                  <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($upcoming_course['id']); ?>" alt="" /></div>
                  <div class="content">
                    <h4 class="title"><?php echo $upcoming_course['title']; ?></h4>
                    <div class="user" onclick="redirectTo('<?php echo site_url('home/instructor_page/'.$instructor_details['id']) ?>')">
                      <div class="img">
                        <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="" />
                      </div>
                      <h4 class="name">
                        <?php echo $instructor_details['first_name'].' '.$instructor_details['last_name'] ?>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="upcoming-course-six-info">
                  <div class="item">
                    <p class="subtitle"><?php echo get_phrase('Lesson') ?></p>
                    <p class="title"><?php echo $lessons->num_rows(); ?></p>
                  </div>
                  <div class="item">
                    <p class="subtitle"><?php echo get_phrase('Duration') ?></p>
                    <p class="title"><?php echo $course_duration; ?></p>
                  </div>
                  <div class="item">
                    <p class="subtitle"><?php echo get_phrase('Price'); ?></p>
                    <p class="title price d-flex align-items-center">
                      <?php if($upcoming_course['is_free_course']): ?>
                        <?php echo get_phrase('Free'); ?>
                      <?php elseif($upcoming_course['discount_flag']): ?>
                        <?php echo currency($upcoming_course['discounted_price']); ?>
                        <del class="ms-1 text-12px"><?php echo currency($upcoming_course['price']); ?></del>
                      <?php else: ?>
                        <?php echo currency($upcoming_course['price']); ?>
                      <?php endif; ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
<!-- End Upcoming Course -->
<?php endif; ?>


<?php if(get_frontend_settings('latest_course_section') == 1): ?>
<!-- Start latest Course -->
<section class="featured-course pb-110">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <!-- Title -->
        <div class="title-two text-center pb-50">
          <h4 class="title"><?php echo get_phrase('Latest Courses') ?></h4>
          <p class="info"><?php echo get_phrase('These_are_the_most_latest_courses_among_Listen_Courses_learners_worldwide'); ?></p>
        </div>
      </div>
    </div>
    <!-- Items -->
    <div class="row g-3">
      <?php $latest_courses = $this->crud_model->get_latest_10_course();
      foreach ($latest_courses as $key => $latest_course) :
        if($key == 8) break;
        $instructor_details = $this->user_model->get_all_user($latest_course['creator'])->row_array();
        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($latest_course['id']);
        $number_of_enrolled_students = $this->crud_model->enrol_history($latest_course['id'], true)->num_rows();
        $lessons = $this->crud_model->get_lessons('course', $latest_course['id']);
        $total_rating =  $this->crud_model->get_ratings('course', $latest_course['id'], true)->row()->rating;
        $number_of_ratings = $this->crud_model->get_ratings('course', $latest_course['id'])->num_rows();
        if ($number_of_ratings > 0) {
            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
        } else {
            $average_ceil_rating = 0;
        }
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
          <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($latest_course['title'])) . '/' . $latest_course['id']); ?>" class="course-item-6 checkPropagation">
            <div class="img">
              <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" />
            </div>
            <div class="content">
              <h4 class="title"><?php echo $latest_course['title']; ?></h4>
              <div class="time-rate d-flex justify-content-between align-items-center">
                <div class="time d-flex align-items-center">
                  <div class="icon">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/clock-6.svg" alt="" />
                  </div>
                  <p class="info"><?php echo $course_duration; ?></p>
                </div>
                <div class="rate d-flex align-items-center">
                  <p class="info"><?php echo $average_ceil_rating; ?></p>
                  <div class="icon">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/star.svg" alt="" />
                  </div>
                </div>
              </div>
              <div class="user-price d-flex justify-content-between align-items-center">
                <div class="user d-flex align-items-center checkPropagation" onclick="redirectTo('<?php echo site_url('home/instructor_page/'.$instructor_details['id']) ?>')">
                  <div class="img">
                    <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>" alt="" />
                  </div>
                  <h4 class="name"><?php echo $instructor_details['first_name'].' '.$instructor_details['last_name']; ?></h4>
                </div>
                <p class="price d-flex align-items-center">
                  <?php if($latest_course['is_free_course']): ?>
                    <?php echo get_phrase('Free'); ?>
                  <?php elseif($latest_course['discount_flag']): ?>
                    <?php echo currency($latest_course['discounted_price']); ?>
                    <del class="ms-1 text-12px"><?php echo currency($latest_course['price']); ?></del>
                  <?php else: ?>
                    <?php echo currency($latest_course['price']); ?>
                  <?php endif; ?>
                </p>
              </div>
            </div>
          </a>
        </div>
        <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End latest Course -->
<?php endif; ?>


<!-- Start Counter -->
<section class="pb-110">
  <div class="container">
    <div class="counter-6">
      <div class="item">
        <h4 class="title"><?php echo nice_number($all_students->num_rows()); ?><span>+</span></h4>
        <p class="info"><?php echo get_phrase('Happy Student') ?></p>
      </div>
      <div class="item">
        <h4 class="title"><?php echo nice_number($all_instructor->num_rows()); ?><span>+</span></h4>
        <p class="info"><?php echo get_phrase('Quality Educators') ?></p>
      </div>

      <?php
        $premium_course = $this->db->get_where('course', ['status' => 'active', 'is_free_course' => null])->num_rows();
        $free_course = $this->db->get_where('course', ['status' => 'active', 'is_free_course' => 1])->num_rows();
      ?>
      <div class="item">
        <h4 class="title"><?php echo nice_number($premium_course); ?><span>+</span></h4>
        <p class="info"><?php echo get_phrase('Premium Courses') ?></p>
      </div>
      <div class="item">
        <h4 class="title"><?php echo nice_number($free_course); ?><span>+</span></h4>
        <p class="info"><?php echo get_phrase('Cost-free course') ?></p>
      </div>
    </div>
  </div>
</section>
<!-- End Counter -->

<?php if(get_frontend_settings('top_instructor_section') == 1): ?>
<!-- Start Instructor -->
<?php $top_instructor_ids = $this->crud_model->get_top_instructor(10); ?>
<?php if(count($top_instructor_ids) > 0): ?>
<section class="pb-110">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <!-- Title -->
        <div class="title-two text-center pb-50">
          <h4 class="title"><?php echo get_phrase('Popular Instructor') ?></h4>
          <p class="info"><?php echo get_phrase('Our popular instructor is a charismatic and knowledgeable individual who captivates students with engaging lessons, making learning a delightful and enriching experience.') ?></p>
        </div>
      </div>
    </div>
    <!-- Items -->
    <div class="row">
      <?php foreach($top_instructor_ids as $top_instructor_id):
        $top_instructor = $this->user_model->get_all_user($top_instructor_id['creator'])->row_array();
        $social_links  = json_decode($top_instructor['social_links'], true); ?>
        <div class="col-lg-4 col-sm-6">
          <div class="instructor-item-6">
            <div class="img cursor-pointer" onclick="redirectTo('<?php echo site_url('home/instructor_page/'.$top_instructor['id']); ?>')">
              <img loading="lazy" class="w-100" src="<?php echo $this->user_model->get_user_image_url($top_instructor['id']); ?>" alt="" />
            </div>
            <div class="content">
              <a href="<?php echo site_url('home/instructor_page/'.$top_instructor['id']); ?>">
                <h4 class="title">
                  <?php echo $top_instructor['first_name'].' '.$top_instructor['last_name']; ?>
                </h4>
                <p class="subtitle ellipsis-line-2"><?php echo $top_instructor['title']; ?></p>
              </a>
              <ul class="social">
                <?php if($social_links['facebook']): ?>
                  <li>
                    <a class="" href="<?php echo $social_links['facebook']; ?>" target="_blank">
                      <i class="fa-brands fa-facebook-f"></i>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if($social_links['twitter']): ?>
                  <li>
                    <a class="" href="<?php echo $social_links['twitter']; ?>" target="_blank">
                      <i class="fa-brands fa-twitter"></i>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if($social_links['linkedin']): ?>
                  <li>
                    <a class="" href="<?php echo $social_links['linkedin']; ?>" target="_blank">
                      <i class="fa-brands fa-linkedin"></i>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- End Instructor -->
<?php endif; ?>


<?php if(get_frontend_settings('motivational_speech_section') == 1): ?>
<!---------  Motivetional Speech Start ---------------->
<?php $motivational_speechs = json_decode(get_frontend_settings('motivational_speech'), true); ?>
<?php if(count($motivational_speechs) > 0): ?>
<section class="expert-instructor top-categories pb-110 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6">
        <h1 class="text-center mt-4"><?php echo get_phrase('Think more clearly'); ?></h1>
        <p class="text-center mt-4 mb-4"><?php echo get_phrase('Gather your thoughts, and make your decisions clearly') ?></p>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <ul class="speech-items">
        <?php foreach($motivational_speechs as $key => $motivational_speech): ?>
        <li>
            <div class="speech-item">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5">
                        <div class="speech-item-img">
                            <img loading="lazy" src="<?php echo site_url('uploads/system/motivations/'.$motivational_speech['image']) ?>" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="speech-item-content">
                            <p class="no"><?php echo ++$key; ?></p>
                            <div class="inner">
                                <h4 class="title">
                                    <?php echo $motivational_speech['title']; ?>
                                </h4>
                                <p class="info">
                                    <?php echo nl2br($motivational_speech['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
<!---------  Motivetional Speech end ---------------->
<?php endif; ?>


<?php if(get_frontend_settings('faq_section') == 1): ?>
<!-- Start FAQs -->
<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0): ?>
<section class="pb-110">
  <div class="container">
    <div class="pb-50">
      <div class="row justify-content-between">
        <div class="col-lg-4">
          <div class="title-two">
            <h4 class="title"><?php echo get_phrase('Frequently Asked Questions') ?></h4>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="title-two">
            <p class="info"><?php echo get_phrase('Have something to know?') ?> <?php echo get_phrase('Check here if you have any questions about us.') ?></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Faqs -->
    <div class="row">
      <div class="col-lg-12">
        <div class="accordion custom-accordion-two faq-6" id="accordionFaq">
          <?php foreach($website_faqs as $key => $faq): ?>
            <?php if($key > 4) break; ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="<?php echo 'faqItemHeading'.$key; ?>">
                <button class="accordion-button <?php if($key > 0) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel'.$key; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel'.$key; ?>">
                  <?php echo $faq['question']; ?>
                </button>
              </h2>
              <div id="<?php echo 'faqItempanel'.$key; ?>" class="accordion-collapse collapse <?php if($key == 0) echo 'show'; ?>" aria-labelledby="<?php echo 'faqItemHeading'.$key; ?>" data-bs-parent="#accordionFaq">
                <div class="accordion-body">
                  <p><?php echo nl2br($faq['answer']); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- End FAQs -->
<?php endif; ?>

<?php if(get_frontend_settings('blog_visibility_on_the_home_page') == 1): ?>
<!-- Start Blog -->
<?php $latest_blogs = $this->crud_model->get_latest_blogs(4); ?>
<?php if($latest_blogs->num_rows() > 0): ?>
<section class="pb-50">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <!-- Title -->
        <div class="title-two text-center pb-50">
          <h4 class="title"><?php echo get_phrase('Follow The Latest News') ?></h4>
          <p class="info"><?php echo site_phrase('Visit our valuable articles to get more information.')?></p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php foreach($latest_blogs->result_array() as $latest_blog):
        $user_details = $this->user_model->get_all_user($latest_blog['user_id'])->row_array();
        $blog_category = $this->crud_model->get_blog_categories($latest_blog['blog_category_id'])->row_array(); ?>
        <div class="col-md-6">
          <a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>" class="blog-item-6">
            <div class="img">
              <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail'];
              if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                   $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
              endif; ?>
              <img loading="lazy" src="<?php echo $blog_thumbnail; ?>" alt="" /></div>
            <div class="content">
              <div class="date">
                <div class="icon"><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/calendar-6.svg" alt="" /></div>
                <p><?php echo get_past_time($latest_blog['added_date']); ?></p>
              </div>
              <h4 class="title"><?php echo $latest_blog['title']; ?></h4>
              <p class="info ellipsis-line-2"><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($latest_blog['description'])), 150); ?></p>
              <p class="link"><i class="fa-solid fa-long-arrow-right"></i></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- End Blog -->
<?php endif; ?>


<?php if(get_frontend_settings('promotional_section') == 1): ?>
<!------------- Become Students Section start --------->
<section class="student">
    <div class="container">
        <div class="row">
            <div class="col-lg-6  <?php if (get_settings('allow_instructor') != 1) echo 'w-100'; ?>">
                <div class="student-body-1">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                            <div class="student-body-text">
                                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/2.png')?>">
                                <h1><?php echo site_phrase('join_now_to_start_learning'); ?></h1>
                                <p><?php echo site_phrase('Learn from our quality instructors!')?> </p>
                                <a href="<?php echo site_url('sign_up'); ?>"><?php echo site_phrase('get_started'); ?></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <img loading="lazy" class="man" src="<?php echo base_url('assets/frontend/default-new/image/student-1.png')?>">
                        </div>
                     </div>
                </div>      
            </div>
            <?php if (get_settings('allow_instructor') == 1) : ?>
                <div class="col-lg-6 ">
                    <div class="student-body-2">
                    <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 ">
                                <div class="student-body-text">
                                  <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/2.png')?>">
                                    <h1><?php echo site_phrase('become_a_new_instructor'); ?></h1>
                                    <p><?php echo site_phrase('Teach_thousands_of_students_and_earn_money!')?> </p>
                                    <?php if($this->session->userdata('user_id')): ?>
                                       <a  href="<?php echo site_url('user/become_an_instructor'); ?>"><?php echo site_phrase('join_now'); ?></a>
                                      <?php else: ?>
                                        <a  href="<?php echo site_url('sign_up?instructor=yes'); ?>"><?php echo site_phrase('join_now'); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                            <img loading="lazy" class="man" src="<?php echo base_url('assets/frontend/default-new/image/student-2.png')?>">
                            </div>
                        </div>  
                    </div> 
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!------------- Become Students Section End --------->
<?php endif; ?>

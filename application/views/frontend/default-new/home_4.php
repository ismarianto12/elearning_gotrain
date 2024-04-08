<!-- Start Banner -->
<section class="banner">
  <div class="container">
    <div class="banner-wrap">
      <div class="banner-img">
        <img loading="lazy" src="<?php echo base_url("uploads/system/" . get_current_banner('banner_image')); ?>" alt="" />
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="banner-content">

            <?php
              $banner_title = site_phrase(get_frontend_settings('banner_title'));
              $banner_title_arr = explode(' ', $banner_title);
            ?>
            <h4 class="title">
                <?php
                foreach($banner_title_arr as $key => $value){
                    if($key == 0){
                        echo '<span class="graphic-1"><img loading="lazy" src="'.site_url('assets/frontend/default-new/').'image/graphic-2.png" alt="" /></span> '.$value.'<br>';
                    }elseif($key == 1){
                      echo '<span class="color-1">'.$value.'</span> ';
                    }elseif($key == count($banner_title_arr) - 1){
                      echo '<span class="size-1">'.$value.'</span> ';
                    }else{
                        echo $value.' ';
                    }
                }
                ?>
            </h4>
            <p class="mb-5"><?php echo site_phrase(get_frontend_settings('banner_sub_title')); ?></p>

            <div class="search-option">
                <form action="<?php echo site_url('home/search'); ?>" method="get">
                    <input class="form-control" type="text" placeholder="<?php echo get_phrase('What do you want to learn'); ?>" name="query">
                    <button class="submit-cls" type="submit"><i class="fa fa-search"></i><?php echo get_phrase('Search') ?></button>
                </form>
            </div>
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
      </div>
    </div>
  </div>
</section>
<!-- End Banner -->

<!-- Start Our Services -->
<section class="pt-110 pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-60">
      <p class="subtitle text-uppercase"><?php echo get_phrase('Create intelligence') ?></p>
      <h4 class="title"><?php echo get_phrase('Learn with us') ?></h4>
      <div class="bar"></div>
    </div>
    <!-- Items -->
    <div class="row">
      <div class="col-lg-4 col-sm-6">
        <div class="service-item-one">
          <div class="icon"><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/video-editing.svg" alt="" /></div>
            <?php
              $status_wise_courses = $this->crud_model->get_status_wise_courses_front();
              $number_of_courses = $status_wise_courses['active']->num_rows();
            ?>
            <h4 class="title"><?php echo $number_of_courses . ' ' . site_phrase('online_courses'); ?></h4>
            <p class="info"><?php echo site_phrase('explore_a_variety_of_fresh_topics'); ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item-one">
          <div class="icon"><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/retouching.svg" alt="" /></div>
          <h4 class="title"><?php echo site_phrase('expert_instruction'); ?></h4>
          <p class="info"><?php echo site_phrase('find_the_right_course_for_you'); ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6">
        <div class="service-item-one">
          <div class="icon"><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/color.svg" alt="" /></div>
          <h4 class="title"><?php echo get_phrase('Smart solution') ?></h4>
          <p class="info"><?php echo site_phrase('learn_on_your_schedule'); ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Our Services -->

<?php if(get_frontend_settings('top_category_section') == 1): ?>
<!-- Start Categories -->
<section class="scategories-4 pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-60">
      <p class="subtitle text-uppercase"><?php echo get_phrase('Categories') ?></p>
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
<!-- Start Upcoming Courses -->
<?php $upcoming_courses = $this->db->order_by('id', 'desc')->limit(6)->get_where('course', ['status' => 'upcoming']); ?>
<?php if($upcoming_courses->num_rows() > 0): ?>
<section class="pb-110">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="title-one pb-20">
          <p class="subtitle text-uppercase"><?php echo get_phrase('Upcoming'); ?></p>
          <h4 class="title"><?php echo get_phrase('Upcoming courses'); ?></h4>
          <div class="bar"></div>
        </div>
        <p class="fz_15_m_24"><?php echo get_phrase('Discover a world of learning opportunities through our upcoming courses, where industry experts and thought leaders will guide you in acquiring new expertise, expanding your horizons, and reaching your full potential.') ?></p>
      </div>
      <div class="col-lg-8">
        <!-- Items -->
        <div class="row g-3">
          <?php
            foreach($upcoming_courses->result_array() as $upcoming_course):
            ?>
            <div class="col-lg-4">
              <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($upcoming_course['title'])) . '/' . $upcoming_course['id']); ?>" class="course-item-one">
                <div class="img-rating">
                  <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($upcoming_course['id']); ?>" alt="" /></div>
                  <!-- <p class="date">Sep<span>12</span></p> -->
                </div>
                <div class="content">
                  <h4 class="title"><?php echo $upcoming_course['title']; ?></h4>
                  <p class="info ellipsis-line-2"><?php echo $upcoming_course['short_description']; ?></p>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- End Upcoming Courses -->
<?php endif; ?>


<?php if(get_frontend_settings('top_course_section') == 1): ?> 
<!-- Start Top Rated Courses -->
<section class="pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-60">
      <p class="subtitle text-uppercase"><?php echo get_phrase('Courses') ?></p>
      <h4 class="title"><?php echo get_phrase('Top Rated Courses') ?></h4>
      <div class="bar"></div>
    </div>
    <!-- Items -->
    <div class="row g-3">
      <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
      foreach ($top_courses as $key => $top_course) :
        if($key == 8) break;
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
          <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']); ?>" class="course-item-one">
            <div class="img-rating">
              <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($top_course['id']); ?>" alt="" /></div>
              <div class="rating">
                <p class="no"><?php echo $average_ceil_rating; ?></p>
                <span><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/star.svg" alt="" /></span>
              </div>
            </div>
            <div class="content">
              <h4 class="title"><?php echo $top_course['title']; ?></h4>
              <div class="d-flex justify-content-between align-items-center">
                <div class="price d-flex align-items-center">
                  <?php if($top_course['is_free_course']): ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo get_phrase('Free'); ?></h5>
                  <?php elseif($top_course['discount_flag']): ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo currency($top_course['discounted_price']); ?></h5>
                    <p class="mt-1 ms-1 text-muted"><del><?php echo currency($top_course['price']); ?></del></p>
                  <?php else: ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo currency($top_course['price']); ?></h5>
                  <?php endif; ?>
                </div>
                <div class="view-play">
                  <div class="item">
                    <div class="icon" title="<?php echo get_phrase('Number of enrolled students'); ?>" data-bs-toggle="tooltip">
                      <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/eye.svg" alt="" />
                    </div>
                    <p class="info"><?php echo $number_of_enrolled_students; ?></p>
                  </div>
                  <div class="item">
                    <div class="icon" title="<?php echo get_phrase('Total lessons'); ?>" data-bs-toggle="tooltip">
                      <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/play.svg" alt="" />
                    </div>
                    <p class="info"><?php echo $lessons->num_rows(); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Top Rated Courses -->
<?php endif; ?>

<!-- Start Our identity -->
<section class="pb-110">
  <div class="container">
    <div class="row justify-content-center justify-content-lg-between align-items-center">
      <div class="col-lg-7 col-md-10">
        <div class="bar-right">
          <div class="title-one maw-538 pb-20">
            <p class="subtitle text-uppercase"><?php echo get_phrase('Our identity') ?></p>
            <h4 class="title"><?php echo get_phrase('We Always Prioritize Quality And Uniqueness') ?></h4>
            <div class="bar"></div>
          </div>
          <p class="fz_15_m_24 maw-538"><?php echo get_phrase('Our identity is a reflection of who we are as individuals or as an organization, while our profile provides a concise summary of our background, skills, and accomplishments.') ?></p>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="about-info">
          <div class="item" style="--icon-color: #ff58aa">
            <h4 class="title"><?php echo nice_number($all_students->num_rows()); ?><span>+</span></h4>
            <p class="info"><?php echo get_phrase('Happy Student') ?></p>
          </div>
          <div class="item" style="--icon-color: #c874f4">
            <h4 class="title"><?php echo nice_number($all_instructor->num_rows()); ?><span>+</span></h4>
            <p class="info"><?php echo get_phrase('Quality Educators') ?></p>
          </div>

          <?php
            $premium_course = $this->db->get_where('course', ['status' => 'active', 'is_free_course' => null])->num_rows();
            $free_course = $this->db->get_where('course', ['status' => 'active', 'is_free_course' => 1])->num_rows();
          ?>
          <div class="item" style="--icon-color: #feaf75">
            <h4 class="title"><?php echo nice_number($premium_course); ?><span>+</span></h4>
            <p class="info"><?php echo get_phrase('Premium Courses') ?></p>
          </div>
          <div class="item" style="--icon-color: #58c3ff">
            <h4 class="title"><?php echo nice_number($free_course); ?><span>+</span></h4>
            <p class="info"><?php echo get_phrase('Cost-free course') ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="pb-50"></div>
    <div class="about-img"><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/identity-us-4.jpeg" alt="" /></div>
  </div>
</section>
<!-- End Our identity -->

<?php if(get_frontend_settings('latest_course_section') == 1): ?>
<!-- Start Latest Courses -->
<section class="pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-60">
      <p class="subtitle"><?php echo get_phrase('Courses') ?></p>
      <h4 class="title"><?php echo get_phrase('Latest Courses') ?></h4>
      <div class="bar"></div>
    </div>
    <!-- Items -->
    <div class="row g-3">
      <?php
      $latest_courses = $this->crud_model->get_latest_10_course();
      foreach ($latest_courses as $key => $latest_course) :
        if($key == 8) break;
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
          <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($latest_course['title'])) . '/' . $latest_course['id']); ?>" class="course-item-one">
            <div class="img-rating">
              <div class="img"><img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($latest_course['id']); ?>" alt="" /></div>
              <div class="rating">
                <p class="no"><?php echo $average_ceil_rating; ?></p>
                <span><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/star.svg" alt="" /></span>
              </div>
            </div>
            <div class="content">
              <h4 class="title"><?php echo $latest_course['title']; ?></h4>
              <div class="d-flex justify-content-between align-items-center">
                <div class="price d-flex align-items-center">
                  <?php if($latest_course['is_free_course']): ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo get_phrase('Free'); ?></h5>
                  <?php elseif($latest_course['discount_flag']): ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo currency($latest_course['discounted_price']); ?></h5>
                    <p class="mt-1 ms-1 text-muted"><del><?php echo currency($latest_course['price']); ?></del></p>
                  <?php else: ?>
                    <h5 class="text-dark text-20px fw-600"><?php echo currency($latest_course['price']); ?></h5>
                  <?php endif; ?>
                </div>
                <div class="view-play">
                  <div class="item">
                    <div class="icon" title="<?php echo get_phrase('Number of enrolled students'); ?>" data-bs-toggle="tooltip">
                      <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/eye.svg" alt="" />
                    </div>
                    <p class="info"><?php echo $number_of_enrolled_students; ?></p>
                  </div>
                  <div class="item">
                    <div class="icon" title="<?php echo get_phrase('Total lessons'); ?>" data-bs-toggle="tooltip">
                      <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/icon/play.svg" alt="" />
                    </div>
                    <p class="info"><?php echo $lessons->num_rows(); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Featured Courses -->
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


<?php if(get_frontend_settings('top_instructor_section') == 1): ?>
<!---------  Expert Instructor Start ---------------->
<?php $top_instructor_ids = $this->crud_model->get_top_instructor(10); ?>
<?php if(count($top_instructor_ids) > 0): ?>
<section class="pb-110">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4 col-md-6">
        <!-- Title -->
        <div class="title-one pb-20">
          <p class="subtitle text-uppercase"><?php echo get_phrase('Instructors') ?></p>
          <h4 class="title"><?php echo get_phrase('Our Popular Instructor'); ?></h4>
          <div class="bar"></div>
        </div>
        <p class="fz_15_m_24 c-8e8e96 pb-30"><?php echo get_phrase('Our popular instructor is a charismatic and knowledgeable individual who captivates students with engaging lessons, making learning a delightful and enriching experience.') ?></p>
      </div>

      <?php foreach($top_instructor_ids as $top_instructor_id):
        $top_instructor = $this->user_model->get_all_user($top_instructor_id['creator'])->row_array();
        $social_links  = json_decode($top_instructor['social_links'], true); ?>
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="instructor-item">
            <div class="img"><img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($top_instructor['id']); ?>" alt="" /></div>
            <div class="content">
              <a href="<?php echo site_url('home/instructor_page/'.$top_instructor['id']); ?>">
                <h4 class="title">
                  <?php echo $top_instructor['first_name'].' '.$top_instructor['last_name']; ?>
                </h4>
                <p class="info ellipsis-line-2"><?php echo $top_instructor['title']; ?></p>
              </a>
              <ul class="social-nav justify-content-center">
                <?php $socio_ext = false; ?>
                <?php if($social_links['facebook']): ?>
                  <?php $socio_ext = true; ?>
                  <li>
                    <a class="" href="<?php echo $social_links['facebook']; ?>" target="_blank">
                      <i class="fa-brands fa-facebook-f"></i>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if($social_links['twitter']): ?>
                  <?php $socio_ext = true; ?>
                  <li>
                    <a class="" href="<?php echo $social_links['twitter']; ?>" target="_blank">
                      <i class="fa-brands fa-twitter"></i>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if($social_links['linkedin']): ?>
                  <?php $socio_ext = true; ?>
                  <li>
                    <a class="" href="<?php echo $social_links['linkedin']; ?>" target="_blank">
                      <i class="fa-brands fa-linkedin"></i>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if(!$socio_ext) echo '<li class="invisible">Socio</>'; ?>
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

<?php if(get_frontend_settings('faq_section') == 1): ?>
<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0): ?>
<!---------- Questions Section Start  -------------->
<section class="pb-110">
  <div class="container">
    <div class="row flex-column-reverse flex-lg-row align-items-center">
      <div class="col-lg-7">
        <!-- Title -->
        <div class="title-one pb-50">
          <h4 class="title"><?php echo get_phrase('Frequently Asked Questions') ?></h4>
        </div>
        <!-- FAQs -->
        <div class="accordion custom-accordion-two" id="accordionFaq">
          <?php foreach($website_faqs as $key => $faq): ?>
            <?php if($key == 5) break; ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="<?php echo 'faqItemHeading'.$key; ?>">
                <button class="accordion-button <?php if($key > 0) echo 'collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel'.$key; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel'.$key; ?>"><?php echo $faq['question']; ?></button>
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
      <div class="col-lg-5">
        <div class="faq-img"><img loading="lazy" width="80%" src="<?php echo site_url('assets/frontend/default-new/') ?>image/faq.png" alt="" /></div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<!-- End FAQs -->
<?php endif; ?>


<?php if(get_frontend_settings('blog_visibility_on_the_home_page') == 1): ?>
<!------------- Blog Section Start ------------>
<?php $latest_blogs = $this->crud_model->get_latest_blogs(3); ?>
<?php if($latest_blogs->num_rows() > 0): ?>
<!-- Start Blog -->
<section class="pb-110">
  <div class="container">
    <!-- Title -->
    <div class="title-one text-center pb-50">
      <p class="subtitle text-uppercase"><?php echo get_phrase('Blog'); ?></p>
      <h4 class="title"><?php echo get_phrase('Our Latest Blog') ?></h4>
      <div class="bar"></div>
    </div>
    <!-- Items -->
    <div class="row g-3">
      <?php foreach($latest_blogs->result_array() as $latest_blog):
        $user_details = $this->user_model->get_all_user($latest_blog['user_id'])->row_array();
        $blog_category = $this->crud_model->get_blog_categories($latest_blog['blog_category_id'])->row_array(); ?>
        <div class="col-lg-4 col-sm-6">
          <a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>" class="blog-item">
            <div class="img">
              <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail'];
               if(!file_exists($blog_thumbnail) || !is_file($blog_thumbnail)):
                   $blog_thumbnail = base_url('uploads/blog/thumbnail/placeholder.png');
              endif; ?>
              <img loading="lazy" src="<?php echo $blog_thumbnail; ?>" alt="" />
            </div>
            <div class="content">
              <h3 class="title"><?php echo $latest_blog['title']; ?></h3>
              <p class="info ellipsis-line-2"><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($latest_blog['description'])), 150); ?></p>
              <p class="link"><?php echo get_phrase('Read More'); ?> <i class="fa-solid fa-long-arrow-right"></i></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- End Blog -->
<?php endif; ?>
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

<div class="mobile-view-offcanves">
  <div class="offcanvas offcanvas-start bg-light" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
    <div class="offcanves-top">
      <?php if($user_id > 0): ?>
        <div class="offcanves-profile">
          <a href="#">
            <div class="user-img">
              <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/') ?>image/placeholder.png" alt="img" />
            </div>
            <div class="user-details">
              <h4><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h4>
              <p><?php echo $user_details['email'] ?></p>
            </div>
          </a>
        </div>
      <?php else: ?>
        <div class="offcanvas-header bg-light">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          <div class="offcanves-btn">
            <a href="<?php echo site_url('sign_up'); ?>" class="signUp-btn"><?php echo get_phrase('Sign Up'); ?></a>
            <a href="<?php echo site_url('login'); ?>" class="logIn-btn"><?php echo get_phrase('Login'); ?></a>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="offcanvas-body p-0">
      <div class="flex-shrink-0 mt-3">
        <ul class="list-unstyled ps-0">
          <?php if($user_login): ?>
            <?php if($user_details['is_instructor'] == 1): ?>
              <li><a href="<?php echo site_url('user/dashboard'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"><i class="fas fa-columns me-2"></i><?php echo site_phrase('Instructor Dashboard'); ?></a></li>
            <?php else: ?>
              <?php if (get_settings('allow_instructor') == 1) : ?>
                <li><a href="<?php echo site_url('home/become_an_instructor'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"><i class="fas fa-columns me-2"></i><?php echo site_phrase('Become an instructor'); ?></a></li>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>

          <li><a href="<?php echo site_url('home/shopping_cart'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 w-100"><i class="fa-solid fa-cart-shopping me-2"></i> <?php echo site_phrase('Cart'); ?> <span class="badge bg-danger ms-auto"><?php echo count($cart_items); ?></span></a></li>

          <li class="bg-light">
            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 collapsed" data-bs-toggle="collapse" data-bs-target="#category-collapse" aria-expanded="false">
              <i class="fas fa-book me-2"></i>
              <?php echo get_phrase('Categories'); ?>
            </button>
            <div class="collapse" id="category-collapse">
              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small bg-white pt-2">
                <?php
                $categories = $this->crud_model->get_categories()->result_array();
                foreach ($categories as $key => $category):?>
                <li>
                  <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 collapsed" data-bs-toggle="collapse" data-bs-target="#subCategory-collapse<?php echo $category['id']; ?>" aria-expanded="false">
                    <span class="icons"><i class="<?php echo $category['font_awesome_class'] ?>"></i></span>
                    <span class="text-cat"><?php echo $category['name']; ?></span>
                  </button>
                  <div class="collapse" id="subCategory-collapse<?php echo $category['id']; ?>">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                      <?php
                      $sub_categories = $this->crud_model->get_sub_categories($category['id']);
                      foreach ($sub_categories as $sub_category): ?>
                      <li>
                        <a class="text-dark text-14px fw-400 w-100" href="<?php echo site_url('home/courses?category='.slugify($sub_category['slug'])) ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded" style="padding-left: 35px;"><?php echo $sub_category['name']; ?></a>
                      </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </li>
                <?php endforeach; ?>
                <li>
                  <a href="" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100"> <i class="fas fa-list me-2"></i> <?php echo get_phrase('All Courses'); ?></a>
                </li>
              </ul>
            </div>
          </li>


          <?php if(addon_status('course_bundle')): ?>
            <li class="bg-light">
              <a href="<?php echo site_url('course_bundles'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-cube me-2"></i> <?php echo get_phrase('Course Bundles'); ?></a>
            </li>
          <?php endif; ?>

          <?php if (addon_status('bootcamp')) : ?>
            <li class="bg-light">
              <a href="<?php echo site_url('addons/bootcamp/bootcamp_list'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fab fa-centercode me-2"></i> <?php echo get_phrase('Bootcamp'); ?></a>
            </li>
          <?php endif; ?>

          <?php if (addon_status('team_training')) : ?>
            <li class="bg-light">
              <a href="<?php echo site_url('addons/team_training/packages'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-users me-2"></i> <?php echo get_phrase('Team training'); ?></a>
            </li>
          <?php endif; ?>

          <?php if(addon_status('ebook')): ?>
            <li class="bg-light">
              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500 collapsed" data-bs-toggle="collapse" data-bs-target="#ebook-category-collapse" aria-expanded="false">
                <i class="fas fa-file me-2"></i>
                <?php echo get_phrase('Ebook'); ?>
              </button>
              <div class="collapse" id="ebook-category-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small bg-white pt-2">
                  <?php
                $ebook_categories = $this->db->get('ebook_category')->result_array();
                foreach ($ebook_categories as $key => $ebook_category):?>
                  <li>
                    <a href="<?php echo site_url('ebook?category='.$ebook_category['slug'].'&price=all&rating=all') ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100"> <?php echo $ebook_category['title']; ?></a>
                  </li>
                  <?php endforeach; ?>
                  <li>
                    <a href="<?php echo site_url('ebook') ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-15px fw-400 py-2 w-100"> <i class="fas fa-list me-2"></i> <?php echo get_phrase('All Ebooks'); ?></a>
                  </li>
                </ul>
              </div>
            </li>
          <?php endif; ?>

          <?php if (addon_status('tutor_booking')) : ?>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('tutors'); ?>"><i class="fas fa-chalkboard-teacher me-2"></i><?php echo get_phrase('Find a Tutor'); ?></a></li>
          <?php endif; ?>

          <?php if($admin_login): ?>
            <li class="bg-light">
              <a href="<?php echo site_url('admin'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-location-arrow me-2"></i> <?php echo get_phrase('Administration'); ?></a>
            </li>
            <li class="bg-light">
              <a href="<?php echo site_url('admin/manage_profile'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-user me-2"></i> <?php echo get_phrase('Manage Profile'); ?></a>
            </li>
            <li class="bg-light">
              <a href="<?php echo site_url('admin/system_settings'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-cog me-2"></i> <?php echo get_phrase('Settings'); ?></a>
            </li>
          <?php elseif($user_login): ?>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('home/my_courses'); ?>"><i class="far fa-gem me-2"></i><?php echo site_phrase('my_courses'); ?></a></li>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('home/my_wishlist'); ?>"><i class="far fa-heart me-2"></i><?php echo site_phrase('my_wishlist'); ?></a></li>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('home/my_messages'); ?>"><i class="far fa-envelope me-2"></i><?php echo site_phrase('my_messages'); ?></a></li>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('home/purchase_history'); ?>"><i class="fas fa-shopping-cart me-2"></i><?php echo site_phrase('purchase_history'); ?></a></li>
            <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('home/profile/user_profile'); ?>"><i class="fas fa-user me-2"></i><?php echo site_phrase('user_profile'); ?></a></li>
            <?php if (addon_status('affiliate_course') ) :
                if ($x == 0 && get_settings('affiliate_addon_active_status') == 1) : ?>
                    <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('addons/affiliate_course/become_an_affiliator'); ?>"><i class="fas fa-user-plus me-2"></i><?php echo site_phrase('Become_an_Affiliator'); ?></a></li>
                <?php else : ?>
                    <?php if ($is_affiliator == 1) : ?>
                        <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('addons/affiliate_course/affiliate_course_history '); ?>"><i class="fa fa-book me-2"></i><?php echo site_phrase('Affiliation History'); ?></a></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (addon_status('customer_support')) : ?>
                <li class="bg-light"><a class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500" href="<?php echo site_url('addons/customer_support/user_tickets'); ?>"><i class="fas fa-life-ring me-2"></i><?php echo site_phrase('support'); ?></a></li>
            <?php endif; ?>
          <?php endif; ?>

          <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'header'); ?>
          <?php foreach ($custom_page_menus->result_array() as $custom_page_menu) : ?>
            <li class="bg-light">
              <a href="<?php echo site_url('page/' . $custom_page_menu['page_url']); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-arrow-alt-circle-right me-2"></i> <?php echo $custom_page_menu['button_title']; ?></a>
            </li>
          <?php endforeach; ?>

          <?php if($user_id > 0): ?>
            <li class="bg-light">
              <a href="<?php echo site_url('login/logout'); ?>" class="btn btn-toggle-list d-inline-flex align-items-center rounded border-0 text-dark text-16px fw-500"> <i class="fas fa-sign-out-alt me-2"></i> <?php echo get_phrase('Logout'); ?></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>

    </div>
  </div>
</div>
<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php include "breadcrumb.php"; ?>

<!-------- Wish List body section start ------>
<section class="wish-list-body grid-view-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="courses wishlist-course mt-5">
                    <div class="courses-card">
                        <div class="row">
                        	<?php foreach(json_decode($wishlist, true) as $course_id):
                        		$row = $this->crud_model->get_course_by_id($course_id);
                        		if($row->num_rows() == 0) continue;
                        		$course = $row->row_array();
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
			                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
			                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']); ?>" class="checkPropagation courses-card-body">
			                            <div class="courses-card-image">
			                                <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>">
			                                <div class="courses-icon <?php if(in_array($course['id'], $my_wishlist_items)) echo 'red-heart'; ?>" id="coursesWishlistIcon<?php echo $course['id']; ?>">
			                                    <i class="fa-solid fa-heart checkPropagation" onclick="actionTo('<?php echo site_url('home/toggleWishlistItems/'.$course['id']); ?>')"></i>
			                                </div>
			                                <div class="courses-card-image-text">
			                                    <h3><?php echo get_phrase($course['level']); ?></h3>
			                                </div> 
			                            </div>
			                            <div class="courses-text">
			                                <h5 class="mb-2"><?php echo $course['title']; ?></h5>
			                                <div class="review-icon">
			                                    <div class="review-icon-star align-items-center">
			                                        <p><?php echo $average_ceil_rating; ?></p>
			                                        <p><i class="fa-solid fa-star <?php if($number_of_ratings > 0) echo 'filled'; ?>"></i></p>
			                                        <p>(<?php echo $number_of_ratings; ?> <?php echo get_phrase('Reviews') ?>)</p>
			                                    </div>
			                                    <div class="review-btn d-flex align-items-center">
			                                       <span class="compare-img checkPropagation" onclick="redirectTo('<?php echo base_url('home/compare?course-1='.slugify($course['title']).'&course-id-1='.$course['id']); ?>');">
			                                            <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/compare.png') ?>">
			                                            <?php echo get_phrase('Compare'); ?>
			                                        </span>
			                                    </div>
			                                </div>
			                                <p class="ellipsis-line-2 mx-0"><?php echo $course['short_description']; ?></p>
			                                <div class="courses-price-border">
			                                    <div class="courses-price">
			                                        <div class="courses-price-left">
			                                            <?php if($course['is_free_course']): ?>
			                                                <h5><?php echo get_phrase('Free'); ?></h5>
			                                            <?php elseif($course['discount_flag']): ?>
			                                                <h5><?php echo currency($course['discounted_price']); ?></h5>
			                                                <p class="mt-1"><del><?php echo currency($course['price']); ?></del></p>
			                                            <?php else: ?>
			                                                <h5><?php echo currency($course['price']); ?></h5>
			                                            <?php endif; ?>
			                                        </div>
			                                        <div class="courses-price-right ">
			                                            <p class="m-0"><i class="fa-regular fa-clock text-15px p-0"></i> <?php echo $course_duration; ?></p>
			                                        </div>
			                                    </div>
			                                </div>
			                             </div>
			                        </a>
			                    </div>
	                        <?php endforeach; ?>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->

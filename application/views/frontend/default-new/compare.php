<link href="<?php echo site_url('assets/global/select2/css/select2.min.css') ?>" rel="stylesheet" />
<script src="<?php echo site_url('assets/global/select2/js/select2.min.js') ?>"></script>

<section class="compare-card">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="empty-card p-4">

                	<div class="card">
                		<div class="card-body text-center text-13px text-dark fw-600">
                			<?php $number_of_courses = isset($_GET) && count($_GET) ? count($_GET)/2:0; ?>
                			<?php echo get_phrase('Compare with '.$number_of_courses.' courses'); ?>
                		</div>
                	</div>

                	<?php
                		$course_id_1 = isset($course_1_details['id']) ? $course_1_details['id'] : '0';
                		$course_id_2 = isset($course_2_details['id']) ? $course_2_details['id'] : '0';
                		$course_id_3 = isset($course_3_details['id']) ? $course_3_details['id'] : '0';
                	?>

                    <form  id="compare_form" action="<?php echo site_url('home/compare'); ?>" method="get" class="comparison-form">
                    	<!-- For course 1 -->
                    	<div class="w-100 mb-4">
		                    <select class="server-side-select2 w-100" onchange="" name="course-id-1" action="<?php echo site_url('home/get_compare_course_select2/'.$course_id_1.'/'.$course_id_2.'/'.$course_id_3); ?>">
		                        <option value=""><?php echo site_phrase('Select a course'); ?></option>
		                        <?php if(isset($course_1_details['id'])): ?>
		                        	<option value="<?php echo isset($course_1_details['id']) ? $course_1_details['id'] : ''; ?>" selected>
		                        		<?php echo $course_1_details['title']; ?>
		                        	</option>
		                        <?php endif; ?>
		                    </select>
		                    <input type="hidden" name="course-1" value="<?php echo isset($course_1_details['title']) ? slugify($course_1_details['title']):''; ?>">
		                </div>

		               <script type="text/javascript">
		               	function submit_compare_form(e){
		               		var course_id = $(this).val();

		               		$("#compare_form").parent().parent().submit()
		               	}
		               </script>

	                    <!-- For course 2 -->
	                    <div class="w-100 mb-4">
		                    <select class="server-side-select2 w-100" onchange="$(this).parent().parent().submit()" name="course-id-2" action="<?php echo site_url('home/get_compare_course_select2/'.$course_id_1.'/'.$course_id_2.'/'.$course_id_3); ?>">
		                        <option value=""><?php echo site_phrase('Select a course'); ?></option>
		                        <?php if(isset($course_2_details['id'])): ?>
		                        	<option value="<?php echo isset($course_2_details['id']) ? $course_2_details['id'] : ''; ?>" selected>
		                        		<?php echo $course_2_details['title']; ?>
		                        	</option>
		                        <?php endif; ?>
		                    </select>
		                    <input type="hidden" name="course-2" value="<?php echo isset($course_2_details['title']) ? slugify($course_2_details['title']):''; ?>">
		                </div>


	                    <!-- For course 3 -->
	                    <div class="w-100 mb-4">
		                    <select class="server-side-select2 w-100" onchange="$(this).parent().parent().submit()" name="course-id-3" action="<?php echo site_url('home/get_compare_course_select2/'.$course_id_1.'/'.$course_id_2.'/'.$course_id_3); ?>">
		                        <option value=""><?php echo site_phrase('Select a course'); ?></option>
		                        <?php if(isset($course_3_details['id'])): ?>
		                        	<option value="<?php echo isset($course_3_details['id']) ? $course_3_details['id'] : ''; ?>" selected>
		                        		<?php echo $course_3_details['title']; ?>
		                        	</option>
		                        <?php endif; ?>
		                    </select>
		                    <input type="hidden" name="course-3" value="<?php echo isset($course_3_details['title']) ? slugify($course_3_details['title']):''; ?>">
		                </div>
	                </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
            	<?php if(isset($course_1_details['title'])): ?>
	                <div class="card">
	                    <h3><?php echo $course_1_details['title']; ?></h3>
	                    <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_1_details['id']); ?>" alt="<?php echo $course_1_details['title']; ?>">
	                    <div class="d-flex">
		                    <?php if($course_1_details['is_free_course']): ?>
	                            <h3><?php echo get_phrase('Free'); ?></h3>
	                        <?php elseif($course_1_details['discount_flag']): ?>
	                            <h3><?php echo currency($course_1_details['discounted_price']); ?></h3>
	                            <h6 class="ms-1" style="margin-top: 2px"><del><?php echo currency($course_1_details['price']); ?></del></h6>
	                        <?php else: ?>
	                            <h3><?php echo currency($course_1_details['price']); ?></h3>
	                        <?php endif; ?>
	                    </div>
	                    <p class="ellipsis-line-2"><?php echo $course_1_details['short_description'] ?></p>
	                    <a href="<?php echo site_url('home/course/' . slugify($course_1_details['title']) . '/' . $course_1_details['id']) ?>"><?php echo get_phrase('Learn More'); ?> <i class="fa-solid fa-angle-right"></i></a>
	                </div>
	            <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <?php if(isset($course_2_details['title'])): ?>
	                <div class="card">
	                    <h3><?php echo $course_2_details['title']; ?></h3>
	                    <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_2_details['id']); ?>" alt="<?php echo $course_2_details['title']; ?>">
	                    <div class="d-flex">
		                    <?php if($course_2_details['is_free_course']): ?>
	                            <h3><?php echo get_phrase('Free'); ?></h3>
	                        <?php elseif($course_2_details['discount_flag']): ?>
	                            <h3><?php echo currency($course_2_details['discounted_price']); ?></h3>
	                            <h6 class="ms-1" style="margin-top: 2px"><del><?php echo currency($course_2_details['price']); ?></del></h6>
	                        <?php else: ?>
	                            <h3><?php echo currency($course_2_details['price']); ?></h3>
	                        <?php endif; ?>
	                    </div>
	                    <p class="ellipsis-line-2"><?php echo $course_2_details['short_description'] ?></p>
	                    <a href="<?php echo site_url('home/course/' . slugify($course_2_details['title']) . '/' . $course_2_details['id']) ?>"><?php echo get_phrase('Learn More'); ?> <i class="fa-solid fa-angle-right"></i></a>
	                </div>
	            <?php endif; ?>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                <?php if(isset($course_3_details['title'])): ?>
	                <div class="card">
	                    <h3><?php echo $course_3_details['title']; ?></h3>
	                    <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_3_details['id']); ?>" alt="<?php echo $course_3_details['title']; ?>">
	                    <div class="d-flex">
		                    <?php if($course_3_details['is_free_course']): ?>
	                            <h3><?php echo get_phrase('Free'); ?></h3>
	                        <?php elseif($course_3_details['discount_flag']): ?>
	                            <h3><?php echo currency($course_3_details['discounted_price']); ?></h3>
	                            <h6 class="ms-1" style="margin-top: 2px"><del><?php echo currency($course_3_details['price']); ?></del></h6>
	                        <?php else: ?>
	                            <h3><?php echo currency($course_3_details['price']); ?></h3>
	                        <?php endif; ?>
	                    </div>
	                    <p class="ellipsis-line-2"><?php echo $course_3_details['short_description'] ?></p>
	                    <a href="<?php echo site_url('home/course/' . slugify($course_3_details['title']) . '/' . $course_3_details['id']) ?>"><?php echo get_phrase('Learn More'); ?> <i class="fa-solid fa-angle-right"></i></a>
	                </div>
	            <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="compare-table compare-2">
    <div class="container">
        <div class="compare-2-table">
        <table class="table">
                <thead>
                    <tr>
                      <th scope="col">
                      	<i class="fa-solid fa-bars"></i><?php echo get_phrase('Has Discount') ?>
                      </th>
                      <td class="border-0" scope="col">
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<?php if($course_1_details['discount_flag']): ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-r.png') ?>" alt=""></center>
                      		<?php else: ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-x.png') ?>" alt=""></center>
                      		<?php endif; ?>
                      	<?php endif; ?>
                      </td>
                      <td class="border-0" scope="col">
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<?php if($course_2_details['discount_flag']): ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-r.png') ?>" alt=""></center>
                      		<?php else: ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-x.png') ?>" alt=""></center>
                      		<?php endif; ?>
                      	<?php endif; ?>
                      </td>
                      <td class="border-0" scope="col">
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<?php if($course_3_details['discount_flag']): ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-r.png') ?>" alt=""></center>
                      		<?php else: ?>
                      			<center><img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/compare-x.png') ?>" alt=""></center>
                      		<?php endif; ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                  	<tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Expiry period') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<?php if($course_1_details['expiry_period'] <= 0): ?>
                      			<i class="far fa-flag"></i> <?php echo get_phrase('Lifetime'); ?>
                      		<?php else: ?>
                      			<i class="far fa-flag"></i>  <?php echo $course_1_details['expiry_period'].' '.get_phrase('Months'); ?>
                      		<?php endif; ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<?php if($course_2_details['expiry_period'] <= 0): ?>
                      			<i class="far fa-flag"></i> <?php echo get_phrase('Lifetime'); ?>
	                      	<?php else: ?>
	                      		<i class="far fa-flag"></i>  <?php echo $course_2_details['expiry_period'].' '.get_phrase('Months'); ?>
	                      	<?php endif; ?>
	                    <?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<?php if($course_3_details['expiry_period'] <= 0): ?>
	                      		<i class="far fa-flag"></i> <?php echo get_phrase('Lifetime'); ?>
	                      	<?php else: ?>
	                      		<i class="far fa-flag"></i>  <?php echo $course_3_details['expiry_period'].' '.get_phrase('Months'); ?>
                      		<?php endif; ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Made In') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fa-solid fa-globe"></i>
                      		<?php echo ucfirst($course_1_details['language']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fa-solid fa-globe"></i>
                      		<?php echo ucfirst($course_2_details['language']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fa-solid fa-globe"></i>
                      		<?php echo ucfirst($course_3_details['language']); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Last Updated At') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fa-solid fa-clipboard-list"></i>
                      		<?php echo date('D M Y', $course_1_details['last_modified']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fa-solid fa-clipboard-list"></i>
                      		<?php echo date('D M Y', $course_2_details['last_modified']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fa-solid fa-clipboard-list"></i>
                      		<?php echo date('D M Y', $course_3_details['last_modified']); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Level') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
	                      <div class="level">
	                      	<?php if($course_1_details['level'] == 'advanced'): ?>
		                          <span class="active active-1"></span>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php elseif($course_1_details['level'] == 'intermediate'): ?>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php else: ?>
		                          <span class="active active-3"></span>
		                      <?php endif; ?>
	                      </div>
                          <?php echo  get_phrase(ucfirst($course_1_details['level'])); ?>
                      	<?php endif; ?>
                      </td>
      
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
	                      <div class="level">
	                          <?php if($course_2_details['level'] == 'advanced'): ?>
		                          <span class="active active-1"></span>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php elseif($course_2_details['level'] == 'intermediate'): ?>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php else: ?>
		                          <span class="active active-3"></span>
		                      <?php endif; ?>
	                      </div>
                          <?php echo  get_phrase(ucfirst($course_2_details['level'])); ?>
                      	<?php endif; ?>
                      </td>

      				  <td>
                      	<?php if(isset($course_3_details['title'])): ?>
	                      <div class="level">
	                          <?php if($course_3_details['level'] == 'advanced'): ?>
		                          <span class="active active-1"></span>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php elseif($course_3_details['level'] == 'intermediate'): ?>
		                          <span class="active active-2"></span>
		                          <span class="active active-3"></span>
		                      <?php else: ?>
		                          <span class="active active-3"></span>
		                      <?php endif; ?>
	                      </div>
                          <?php echo  get_phrase(ucfirst($course_3_details['level'])); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Total Lectures') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fa-solid fa-book-open-reader"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_1_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fa-solid fa-book-open-reader"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_2_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fa-solid fa-book-open-reader"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_3_details['id'], 'lesson_type !=' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Total Quizzes') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fas fa-question"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_1_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fas fa-question"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_2_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fas fa-question"></i>
							<?php echo $this->db->get_where('lesson', ['course_id' => $course_3_details['id'], 'lesson_type' => 'quiz'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Total Duration') ?></th> 
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fa-regular fa-clock"></i>
                      		<?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_1_details['id']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fa-regular fa-clock"></i>
                      		<?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_2_details['id']); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fa-regular fa-clock"></i>
                      		<?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_3_details['id']); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Total Enrolment') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/Group 17906.png') ?>" alt="">
                      		<?php echo $this->crud_model->enrol_history($course_1_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/Group 17906.png') ?>" alt="">
                      		<?php echo $this->crud_model->enrol_history($course_2_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/Group 17906.png') ?>" alt="">
                      		<?php echo $this->crud_model->enrol_history($course_3_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Number Of Reviews') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<i class="fa-regular fa-message"></i>
                      		<?php echo $c_1_reviews = $this->crud_model->get_ratings('course', $course_1_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<i class="fa-regular fa-message"></i>
                      		<?php echo $c_2_reviews = $this->crud_model->get_ratings('course', $course_2_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<i class="fa-regular fa-message"></i>
                      		<?php echo $c_3_reviews = $this->crud_model->get_ratings('course', $course_3_details['id'])->num_rows(); ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Avg Rating') ?></th>
                      <td>
                      	<?php
                      	if(isset($course_1_details['title'])):
	                      	$total_rating =  $this->crud_model->get_ratings('course', $course_1_details['id'], true)->row()->rating;
	                      	if ($c_1_reviews > 0) {
							    $average_ceil_rating = ceil($total_rating / $c_1_reviews);
							} else {
							    $average_ceil_rating = 0;
							} ?>
	                      	<div class="compare-star">
	                      		<?php for($i= 1; $i <= 5; $i++): ?>
	                      			<?php if($average_ceil_rating >= $i): ?>
	                          			<i class="fa-solid fa-star avg-rating"></i>
	                          		<?php else: ?>
	                          			<i class="fa-solid fa-star"></i>
	                          		<?php endif; ?>
	                          	<?php endfor; ?>
	                      	</div>
	                  	<?php endif; ?>
                      </td>
                      <td>
                      	<?php
                      	if(isset($course_2_details['title'])):
	                      	$total_rating =  $this->crud_model->get_ratings('course', $course_2_details['id'], true)->row()->rating;
	                      	if ($c_1_reviews > 0) {
							    $average_ceil_rating = ceil($total_rating / $c_1_reviews);
							} else {
							    $average_ceil_rating = 0;
							} ?>
	                      	<div class="compare-star">
	                      		<?php for($i= 1; $i <= 5; $i++): ?>
	                      			<?php if($average_ceil_rating >= $i): ?>
	                          			<i class="fa-solid fa-star avg-rating"></i>
	                          		<?php else: ?>
	                          			<i class="fa-solid fa-star"></i>
	                          		<?php endif; ?>
	                          	<?php endfor; ?>
	                      	</div>
	                  	<?php endif; ?>
                      </td>
                      <td>
                      	<?php
                      	if(isset($course_3_details['title'])):
	                      	$total_rating =  $this->crud_model->get_ratings('course', $course_3_details['id'], true)->row()->rating;
	                      	if ($c_1_reviews > 0) {
							    $average_ceil_rating = ceil($total_rating / $c_1_reviews);
							} else {
							    $average_ceil_rating = 0;
							} ?>
	                      	<div class="compare-star">
	                      		<?php for($i= 1; $i <= 5; $i++): ?>
	                      			<?php if($average_ceil_rating >= $i): ?>
	                          			<i class="fa-solid fa-star avg-rating"></i>
	                          		<?php else: ?>
	                          			<i class="fa-solid fa-star"></i>
	                          		<?php endif; ?>
	                          	<?php endfor; ?>
	                      	</div>
	                  	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Short Description') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<?php echo $course_1_details['short_description']; ?>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<?php echo $course_2_details['short_description']; ?>
                      	<?php endif; ?>
                      </td>
                      <td class="border-bottom">
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<?php echo $course_3_details['short_description']; ?>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Outcomes') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_1_details['outcomes']) as $outcomes) : ?>
							            <?php if ($outcomes != "") : ?>
							                <li class="text-dark text-14px"><?php echo $outcomes; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_2_details['outcomes']) as $outcomes) : ?>
							            <?php if ($outcomes != "") : ?>
							                <li class="text-dark text-14px"><?php echo $outcomes; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                      <td class="border-bottom">
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_3_details['outcomes']) as $outcomes) : ?>
							            <?php if ($outcomes != "") : ?>
							                <li class="text-dark text-14px"><?php echo $outcomes; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><i class="fa-solid fa-bars"></i><?php echo get_phrase('Requirements') ?></th>
                      <td>
                      	<?php if(isset($course_1_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_1_details['requirements']) as $requirement) : ?>
							            <?php if ($requirement != "") : ?>
							                <li class="text-dark text-14px"><?php echo $requirement; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                      <td>
                      	<?php if(isset($course_2_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_2_details['requirements']) as $requirement) : ?>
							            <?php if ($requirement != "") : ?>
							                <li class="text-dark text-14px"><?php echo $requirement; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                      <td class="border-bottom">
                      	<?php if(isset($course_3_details['title'])): ?>
                      		<div class="course-description requirements">
    							<ul>
							        <?php foreach (json_decode($course_3_details['requirements']) as $requirement) : ?>
							            <?php if ($requirement != "") : ?>
							                <li class="text-dark text-14px"><?php echo $requirement; ?></li>
							            <?php endif; ?>
							        <?php endforeach; ?>
							    </ul>
							</div>
                      	<?php endif; ?>
                      </td>
                    </tr>
                  </tbody>
            
          </table>
        </div>
    </div>
</section>

<script>
	$(".server-side-select2" ).each(function() {
		var actionUrl = $(this).attr('action');
		$(this).select2({
			ajax: {
				url: actionUrl,
				dataType: 'json',
				delay: 500,
				data: function (params) {
					return {
						searchVal: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				}
			},
			placeholder: 'Search',
			minimumInputLength: 1,
		});
	});
</script>
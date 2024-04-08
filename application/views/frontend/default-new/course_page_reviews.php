<?php 
$user_id = $this->session->userdata('user_id');
$admin_login = $this->session->userdata('admin_login');
$my_rating = $this->db->where('user_id', $user_id)->where('ratable_id', $course_details['id'])->where('ratable_type', 'course')->get('rating'); ?>
<?php if($my_rating->num_rows() == 0 && enroll_status($course_details['id'])): ?>
    <div class="comment instructor-student-feed-back" id="course_page_add_review_form">
        <h1 class="ritt"><?php echo get_phrase('Write a Review') ?></h1>
        
        <div class="row">
            <div class="col-lg-12">
                <form class="ajaxForm" action="<?php echo site_url('home/rate_course'); ?>" method="post">
                    <input type="hidden" name="course_id" value="<?php echo $course_details['id']; ?>">
                    <select class="form-control mb-3" name="starRating">
                        <option value="1"><?php echo get_phrase('1 Start Rating') ?></option>
                        <option value="2"><?php echo get_phrase('2 Start Rating') ?></option>
                        <option value="3"><?php echo get_phrase('3 Start Rating') ?></option>
                        <option value="4"><?php echo get_phrase('4 Start Rating') ?></option>
                        <option value="5"><?php echo get_phrase('5 Start Rating') ?></option>
                    </select>
                    <textarea class="form-control text-section" name="review" placeholder="<?php echo get_phrase('Write your comment') ?>" ></textarea>
                    <div class="msg mt-3">
                        <button type="submit" class="btn btn-primary"><?php echo get_phrase('Submit'); ?></button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
<?php endif; ?>

<?php $ratings = $this->crud_model->get_ratings('course', $course_details['id'])->result_array();
foreach($ratings as $rating):
$user_details = $this->user_model->get_user($rating['user_id'])->row_array();
?>
    <div class="reviews-border" id="userReview<?php echo $rating['id']; ?>">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-5 col-5 mt-5">
                <h3 class="text-center text-black fw-500"><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h3>
                <p class="text-center"><?php echo date('d-M-Y', $rating['date_added']); ?></p>
                <h1><?php echo $rating['rating']; ?></h1>
                <div class="icon">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php if($rating['rating'] >= $i): ?>
                            <i class="fa-solid fa-star gold"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-7 col-7 mt-5">
                <!-- <h3 class="mb-3">Great product, smooth purchase</h3> -->
                <p class="text"><?php echo $rating['review']; ?></p>
            </div>
            <div class="col-md-12">
                <p class="d-flex justify-content-end">

                    <?php if($user_details['id'] == $user_id): ?>
                        <a class="px-2" onclick="$('#myReview<?php echo $rating['id']; ?>').toggle();" href="#" data-bs-toggle="tooltip" title="<?php echo get_phrase('Edit'); ?>"><i class="fas fa-pencil"></i></a>
                    <?php endif; ?>

                    <?php if($user_details['id'] == $user_id || $admin_login): ?>
                        <a  class="px-2 text-danger" onclick="actionTo('<?php echo site_url('home/remove_rating/'.$course_details['id'].'/'.$rating['id']) ?>')" href="#" data-bs-toggle="tooltip" title="<?php echo get_phrase('Remove'); ?>"><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
                </p>
            </div>
        </div>

        <?php if($user_details['id'] == $user_id): ?>
            <div class="row d-hidden mt-3" id="myReview<?php echo $rating['id']; ?>">
                <div class="col-lg-12">
                    <form class="ajaxForm" action="<?php echo site_url('home/rate_course'); ?>" method="post">
                        <input type="hidden" name="course_id" value="<?php echo $course_details['id']; ?>">
                        <select class="form-control mb-3" name="starRating">
                            <option value="1" <?php if($rating['rating'] == 1) echo 'selected'; ?>><?php echo get_phrase('1 Start Rating') ?></option>
                            <option value="2" <?php if($rating['rating'] == 2) echo 'selected'; ?>><?php echo get_phrase('2 Start Rating') ?></option>
                            <option value="3" <?php if($rating['rating'] == 3) echo 'selected'; ?>><?php echo get_phrase('3 Start Rating') ?></option>
                            <option value="4" <?php if($rating['rating'] == 4) echo 'selected'; ?>><?php echo get_phrase('4 Start Rating') ?></option>
                            <option value="5" <?php if($rating['rating'] == 5) echo 'selected'; ?>><?php echo get_phrase('5 Start Rating') ?></option>
                        </select>
                        <textarea class="form-control text-section" rows="4" name="review" placeholder="<?php echo get_phrase('Write your comment') ?>" ><?php echo $rating['review']; ?></textarea>
                        <div class="msg mt-3">
                            <button type="submit" class="btn btn-primary"><?php echo get_phrase('Submit'); ?></button>
                        </div>
                    </form>
                </div>
            </div> 
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php include "init.php"; ?>
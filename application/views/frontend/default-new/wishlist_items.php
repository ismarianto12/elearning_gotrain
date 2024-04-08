<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php foreach($my_wishlist_items as $my_wishlist_item): ?>
    <?php $course_details = $this->crud_model->get_course_by_id($my_wishlist_item)->row_array(); ?>
    <?php $instructor = $this->user_model->get_all_user($course_details['creator'])->row_array(); ?>
    <div class="path_pos_wish-2">
        <div class="path_pos_wish">
          <div class="menu_pro_wish-f-b">
            <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>" class="checkPropagation">
              <div class="menu_pro_wish-flex">
                <div class="img">
                  <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" />
                </div>
                <div class="text w-100">
                  <h4><?php echo $course_details['title']; ?></h4>
                  <p><?php echo get_phrase('By'); ?> <?php echo $instructor['first_name'].' '.$instructor['last_name']; ?></p>
                  <div class="spandiv">
                    <?php if($course_details['is_free_course']): ?>
                        <span><?php echo get_phrase('Free'); ?></span>
                    <?php elseif($course_details['discount_flag']): ?>
                        <span><?php echo currency($course_details['discounted_price']); ?></span>
                        <del><?php echo currency($course_details['price']); ?></del>
                    <?php else: ?>
                        <span><?php echo currency($course_details['price']); ?></span>
                    <?php endif; ?>

                    <?php if(!$course_details['is_free_course']): ?>
                        <span onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'].'/from_wishlist'); ?>');" id="add_to_cart_btn_from_wishlist<?php echo $course_details['id']; ?>" class="checkPropagation float-end me-4 <?php if(in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" data-bs-toggle="tooltip" title="<?php echo get_phrase('Add to cart'); ?>"><i class="fas fa-cart-plus text-13px p-1"></i></span>

                        <span onclick="actionTo('<?php echo site_url('home/handle_cart_items/' . $course_details['id'].'/from_wishlist'); ?>');" id="added_to_cart_btn_from_wishlist<?php echo $course_details['id']; ?>" class="checkPropagation float-end me-4 <?php if(!in_array($course_details['id'], $cart_items)) echo 'd-hidden'; ?>" data-bs-toggle="tooltip" title="<?php echo get_phrase('Remove from cart'); ?>"><i class="fas fa-minus-circle text-13px p-1"></i></span>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
    </div>
<?php endforeach; ?>

<?php if(count($my_wishlist_items) == 0): ?>
  <div class="path_pos_wish-2">
    <div class="path_pos_wish">
      <div class="menu_pro_wish-f-b text-center text-muted pb-4 pt-5 px-3">
        <?php echo get_phrase('You have no items in your wishlist!'); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
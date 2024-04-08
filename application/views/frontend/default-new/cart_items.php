<?php $cart_items = $this->session->userdata('cart_items'); ?>
<?php foreach($cart_items as $cart_item): ?>
	<?php $course_details = $this->crud_model->get_course_by_id($cart_item)->row_array(); ?>
	<?php $instructor = $this->user_model->get_all_user($course_details['creator'])->row_array(); ?>
	<div class="path_pos_wish-2">
	  <div class="path_pos_wish">
	    <div class="menu_pro_wish-f-b">
	      <a href="<?php echo site_url('home/course/'.slugify($course_details['title']).'/'.$course_details['id']); ?>" class="checkPropagation">
	        <div class="menu_pro_wish-flex">
	          <div class="img checkPropagation">
	            <img loading="lazy" src="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" />
	            <span onclick="actionTo('<?php echo site_url('home/handle_cart_items/'.$course_details['id']) ?>');" class="cart-minus checkPropagation rounded-circle m-0 p-0 w-auto h-auto"><i class="fa-solid fa-minus m-1 text-9px"></i></span>
	          </div>
	          <div class="text">
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
	            </div>
	          </div>
	        </div>
	      </a>
	    </div>
	  </div>
	</div>
<?php endforeach; ?>

<?php if(count($cart_items) == 0): ?>
	<div class="path_pos_wish-2">
	  <div class="path_pos_wish">
	    <div class="menu_pro_wish-f-b text-center text-muted pb-4 pt-5 px-4">
	    	<?php echo get_phrase('You have no items in your cart!'); ?>
	    </div>
	  </div>
	</div>
<?php endif; ?>

<?php include "init.php"; ?>
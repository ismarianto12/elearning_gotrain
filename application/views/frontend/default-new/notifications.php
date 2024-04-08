<?php
$logged_user_id = $this->session->userdata('user_id');
$notifications = $this->db->order_by('status ASC, id desc')->limit(50)->where('to_user', $logged_user_id)->get('notifications');
$number_of_unread_notification = $this->db->order_by('status ASC, id desc')->limit(50)->where('status', 0)->where('to_user', $logged_user_id)->get('notifications')->num_rows();
?>

<a class="menu_wisth_tgl mt-1">
    <i class="far fa-bell"></i>

    <?php if($number_of_unread_notification > 0): ?>
        <p class="menu_number">
          <?php echo $number_of_unread_notification; ?>
        </p>
    <?php endif; ?>
</a>
<div class="menu_pro_wish" style="width: 275px;">
    <div class="w-100 d-flex">
      <a href="#" onclick="actionTo('<?php echo site_url('home/get_my_notification/remove_all'); ?>');" class="text-secondary ms-auto mt-3 me-3">
        <small><?php echo get_phrase('Remove all'); ?></small>
      </a>
    </div>
    <div class="overflow-control" id="notifications">
        <?php foreach($notifications->result_array() as $notification): ?>
            <div class="notify-item cursor-pointer d-flex py-2 px-3 <?php if($notification['status'] == 0) echo 'unread' ?>" style="width: 275px;">
                <?php if($notification['type'] == 'signup'): ?>
                    <div class="notify-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                <?php else: ?>
                    <div class="notify-icon">
                        <i class="far fa-bell"></i>
                    </div>
                <?php endif; ?>
                <div class="ps-2">
                  <p class="notify-details text-13px">
                      <?php echo $notification['title']; ?>
                      <small class="text-muted float-end"><?php echo get_past_time($notification['created_at']); ?></small>
                  </p>
                  <div class="text-muted mb-0 user-msg text-13px">
                      <?php echo ($notification['description']); ?>
                  </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if($notifications->num_rows() == 0): ?>
            <div class="row mt-3">
                <div class="col-md-12 text-center">
                    <img loading="lazy" width="100px" src="<?php echo site_url('assets/global/image/empty-notification.png'); ?>">
                    <h5 class="my-1 text-15px"><?php echo get_phrase('No notification'); ?></h5>
                    <p class="px-4 mx-3 my-1 text-13px text-muted"><small><?php echo get_phrase('Stay tuned!'); ?> <?php echo get_phrase('Notifications about your activity will show up here.'); ?></small></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="menu_pro_btn">
      <a href="#" onclick="actionTo('<?php echo site_url('home/get_my_notification/mark_all_as_read'); ?>');" class="btn btn-primary text-white"><?php echo get_phrase('Mark all as read'); ?></a>
    </div>
</div>
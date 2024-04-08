<?php $user_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
<?php include "breadcrumb.php"; ?>

<!--------  Wish List body section start------>
<section class="wish-list-body message">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include "profile_menus.php"; ?>
            </div>
            <div class="col-lg-9">
                <div class="conversation-fulllll-body common-card">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="conversation ">
                                <h5 class="d-flex align-items-center">
                                    <?php echo get_phrase('Message') ?>
                                    <a href="#" onclick="$('.message-box-content').toggleClass('d-hidden');" class="btn ms-auto" data-bs-toggle="tooltip" title="<?php echo get_phrase('New message') ?>" data-><i class="fas fa-plus"></i></a>
                                </h5>
                                <form action="#">
                                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    <input class="form-control" type="text" placeholder="Type your keyword" onkeyup="searchMessages($(this).val())">
                                </form>
                                <div class="conversation-body-scroll-bar">
                                    <?php
                                    $this->db->where('sender', $user_details['id']);
                                    $this->db->or_where('receiver', $user_details['id']);
                                    $message_threads = $this->db->get('message_thread')->result_array();

                                    $this_conversation_user_info = '';
                                    $message_thread_details = '';
                                    foreach ($message_threads as $row) :
                                        // defining the user to show
                                        if ($row['sender'] != $user_details['id']) {
                                            $conversation_user_id = $row['sender'];
                                        }
                                        if ($row['receiver'] != $user_details['id']) {
                                            $conversation_user_id = $row['receiver'];
                                        }

                                        $number_of_unreaded_message = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                                        $conversation_user_info = $this->user_model->get_all_user($conversation_user_id)->row_array();
                                        $last_messages_details =  $this->crud_model->get_last_message_by_message_thread_code($row['message_thread_code'])->row_array();
                                        if (isset($message_thread_code) && $message_thread_code == $row['message_thread_code']) :
                                            $this_conversation_user_info = $conversation_user_info;
                                            $message_thread_details = $row;
                                        endif;
                                    ?>
                                        <div class="conversation-body-border" onclick="redirectTo('<?php echo site_url('home/my_messages/read_message/' . $row['message_thread_code']); ?>')">
                                            <div class="conversation-body-1 <?php if (isset($message_thread_code) && $message_thread_code == $row['message_thread_code']) echo 'active'; ?>">
                                                <div class="conversation-1">
                                                    <div class="conversation-heading">
                                                        <div class="conversation-img">
                                                            <img loading="lazy" class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($conversation_user_info['id']); ?>">
                                                            <?php if ($number_of_unreaded_message > 0) : ?>
                                                                <p><?php echo $number_of_unreaded_message; ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="conversation-name">
                                                            <h5>
                                                                <a class="heading" href="<?php echo site_url('home/my_messages/read_message/' . $row['message_thread_code']); ?>">
                                                                    <?php echo $conversation_user_info['first_name'] . ' ' . $conversation_user_info['last_name']; ?>
                                                                </a>
                                                            </h5>
                                                            <h6 class="ellipsis-line-2"><?php echo $conversation_user_info['email']; ?></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="conversation-body-1-text mt-0">
                                                    <p class="ellipsis-line-2" style="margin-top: 2px;">
                                                        <i class="fa-regular fa-comment-dots m-0"></i>
                                                        <?php echo $last_messages_details['message']; ?>
                                                    </p>
                                                </div>
                                                <p class="text-10px" style="line-height: 18px;"><?php echo get_past_time($last_messages_details['timestamp']); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-8 c-border ">
                            <?php
                            if ($this_conversation_user_info != '') :
                                $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array(); ?>
                                <div class="conversation-text message-box-content">
                                    <div class="conversation-text-2" style="overflow: auto;">
                                        <div class="conversation-msg-full">
                                            <div class="parrent">
                                                <div class="child-img">
                                                    <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($this_conversation_user_info['id']); ?>" class="parrent-image mb-2">
                                                </div>
                                                <div class="parrent-text">
                                                    <h5><a href="<?php echo site_url('home/instructor_page/' . $this_conversation_user_info['id']) ?>"><?php echo $this_conversation_user_info['first_name'] . ' ' . $this_conversation_user_info['last_name']; ?></a></h5>
                                                    <div class="child-description">
                                                        <p><?php echo $this_conversation_user_info['email']; ?></p>
                                                        <i></i>
                                                    </div>
                                                </div>
                                                <div class="child-time"></div>
                                            </div>
                                        </div>

                                        <?php foreach ($messages as $message) :
                                            if ($message['sender'] == $this->session->userdata('user_id')) {
                                                $conversation_user = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
                                            } else {
                                                $conversation_user = $this->user_model->get_all_user($message['sender'])->row_array();
                                            } ?>
                                            <div class="conversation-msg-full">
                                                <div class="parrent parrent-3rd">
                                                    <div class="parrent-2">
                                                        <div class="child-img">
                                                            <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($conversation_user['id']); ?>">
                                                        </div>
                                                        <div class="child-text">
                                                            <div class="child-text-body02">
                                                                <div class="child-name">
                                                                    <h5><a href="#"><?php echo $conversation_user['first_name'] . ' ' . $conversation_user['last_name']; ?></a></h5>
                                                                    <p><?php get_past_time($message['timestamp']) ?></p>
                                                                </div>
                                                                <div class="child-description">
                                                                    <p><?php echo $message['message']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="child-icon">
                                                        <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                                                              <li><a class="dropdown-item active" href="#">Action</a></li>
                                                              <li><a class="dropdown-item" href="#">Another action</a></li>
                                                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                            </ul>
                                                          </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="conversation-sending">
                                        <form action="<?php echo site_url('home/my_messages/send_reply/' . $message_thread_code); ?>" method="post">
                                            <textarea class="form-control" placeholder="<?php echo get_phrase('Write your message') ?>..." name="message"></textarea>
                                            
                                            <button type="submit" class="btn btn-primary float-end mb-3"><?php echo get_phrase('Send') ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="conversation-text message-box-content <?php if (isset($_GET['instructor_id']) && $_GET['instructor_id'] > 0) {
                                                                                } else {
                                                                                    echo 'd-hidden';
                                                                                } ?>">
                                <div class="conversation-sending">
                                    <form action="<?php echo site_url('home/my_messages/send_new'); ?>" method="post" class="mt-5">
                                        <div class="form-group mb-3">
                                            <?php $instructor_list = $this->user_model->get_instructor_list()->result_array(); ?>
                                            <label><?php echo get_phrase('Select a user'); ?></label>
                                            <select class="form-control my-2 py-3 radius-5" name="receiver">
                                                <?php foreach ($instructor_list as $instructor) :
                                                    if ($instructor['id'] == $this->session->userdata('user_id'))
                                                        continue;
                                                ?>
                                                    <option value="<?php echo $instructor['id']; ?>"><?php echo $instructor['first_name'] . ' ' . $instructor['last_name']; ?></option>
                                                <?php endforeach; ?>

                                                <?php if (isset($_GET['instructor_id']) && $_GET['instructor_id'] > 0) : ?>
                                                    <?php $user_details = $this->user_model->get_all_user($_GET['instructor_id'])->row_array(); ?>
                                                    <option value="<?php echo $user_details['id']; ?>"><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <textarea class="form-control" placeholder="<?php echo get_phrase('Write your message') ?>..." name="message"></textarea>
                                        
                                        <button type="submit" class="btn btn-primary float-end mb-3"><?php echo get_phrase('Send') ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-------- wish list bosy section end ------->

<script type="text/javascript">
    function searchMessages(searchVal) {
        var filter = searchVal.toUpperCase();
        var li = $('.conversation-body-scroll-bar a');
        for (var i = 0; i < li.length; i++) {
            var txtValue = li[i].textContent || li[i].innerText;
            txtValue = txtValue.toUpperCase();

            if (searchVal != "") {
                if (txtValue.toUpperCase().indexOf(filter) > 0) {
                    li[i].parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.style.display = "";
                } else {
                    li[i].parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.style.display = "none";
                }
            } else {
                $('.conversation-body-border').show();
            }
        }
    }
</script>
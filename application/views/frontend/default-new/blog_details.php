<?php $user_details = $this->user_model->get_all_user($blog_details['user_id'])->row_array(); ?>

<!--------- Blog section start ---------->
<section class="blog-body courses blog pb-3 mb-5">
    <div class="container">
        <h1 class="text-center"><span><?php echo get_phrase('Inspirational Journeys'); ?></span></h1>
        <p class="text-center"><?php echo get_phrase('Follow the Stories of Academics and Their Research Expeditions') ?></p>
        <div class="courses-card">
            <div class="row">
                <div class="col-lg-8">
                    <div class="top">
                        <h3><?php echo $blog_details['title']; ?></h3>
                        <div class="profile-img">
                            <a href="<?php echo site_url('home/instructor_page/' . $user_details['id']); ?>">
                                <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>">
                            </a> 
                            <a href="#"><h6><?php echo $user_details['first_name'] . ' ' . $user_details['last_name']; ?></h6></a>
                            <p><?php echo date('D, d M Y'); ?></p>
                        </div>

                        <?php $blog_banner = 'uploads/blog/banner/'.$blog_details['banner']; ?>
                        <?php if(file_exists($blog_banner) && is_file($blog_banner)): ?>
                            <img loading="lazy" src="<?php echo base_url($blog_banner); ?>" class="card-img-top radius-10" width="100%" alt="<?php echo $blog_details['title']; ?>">
                        <?php endif; ?>

                        <?php echo htmlspecialchars_decode_($blog_details['description']); ?>
                    </div>

                    <?php if(count(explode(',',$blog_details['keywords'])) > 1): ?>
                        <div class="left-tag flex-wrap">
                            <h3><?php echo get_phrase('Tags') ?>:</h3>
                            <?php foreach(explode(',',$blog_details['keywords']) as $value): ?>
                                <?php if(!$value) continue; ?>
                                <a href="#" class="mb-2"><?php echo $value; ?></a>
                            <?php endforeach ?>
                        </div>
                    <?php endif; ?>


                    <?php $blog_comments = $this->crud_model->get_blog_comments_by_blog_id($blog_details['blog_id']); ?>
                    <h1><?php echo $blog_comments->num_rows().' '.get_phrase('Comments'); ?></h1>
                    <?php foreach($blog_comments->result_array() as $blog_comment): ?>
                            <?php $commenter_details = $this->user_model->get_all_user($blog_comment['user_id'])->row_array(); ?>
                        <div class="instructor-student-feed-back">
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-2">
                                    <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($commenter_details['id']); ?>">
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                                    <div class="student-feed-back-text comment-student-feed-back-text">
                                        <h6><?php echo $commenter_details['first_name'] . ' ' . $commenter_details['last_name']; ?></h6>
                                        <p><?php echo date('D, d M Y'); ?></p>
                                        <p class="std"><?php echo $blog_comment['comment']; ?></p>
                                        <a href="#" onclick="$('#comment_add<?php echo $blog_comment['blog_comment_id']; ?>').toggle(); $('#comment_edit<?php echo $blog_comment['blog_comment_id']; ?>').hide();"><?php echo get_phrase('Reply') ?></a>


                                        <!-- Comment reply form -->
                                        <form action="<?php echo site_url('blog/add_blog_comment/'.$blog_details['blog_id']); ?>" method="POST" id="comment_add<?php echo $blog_comment['blog_comment_id']; ?>" class="feedback-form d-hidden  ms-2 ps-1">
                                            <div class="single-input">
                                                <textarea name="comment" class="form-control my-3" placeholder="<?php echo get_phrase('Comment Here') ?>" style="height: 100px"></textarea>
                                            </div>
                                            <input type="hidden" name="parent_id" value="<?php echo $blog_comment['blog_comment_id']; ?>">
                                            <button type="submit" class="message-btn"><?php echo get_phrase('Submit') ?></button>
                                        </form>

                                        <!--Comment Edit form-->
                                        <form action="<?php echo site_url('blog/update_blog_comment/'.$blog_comment['blog_comment_id']); ?>" method="POST" id="comment_edit<?php echo $blog_comment['blog_comment_id']; ?>" class="feedback-form ms-2 ps-1 d-hidden">
                                            <div class="single-input">
                                                <textarea name="comment" class="form-control my-3" placeholder="<?php echo get_phrase('Comment Here') ?>" style="height: 100px"><?php echo $blog_comment['comment']; ?></textarea>
                                            </div>
                                            <button type="submit" class="message-btn"><?php echo get_phrase('Save changes') ?></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                                    <?php if($this->session->userdata('user_id') == $blog_comment['user_id'] || $this->session->userdata('admin_login') == true): ?>
                                        <div class="settings-icon dropdown">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="$('#comment_edit<?php echo $blog_comment['blog_comment_id']; ?>').toggle(); $('#comment_add<?php echo $blog_comment['blog_comment_id']; ?>').hide();"><?php echo get_phrase('Edit'); ?></a></li>
                                                <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('blog/delete_comment/'.$blog_comment['blog_comment_id'].'/'.$blog_details['blog_id']); ?>')"><?php echo get_phrase('Delete'); ?></a></li>
                                              </ul>                                     
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php foreach($this->crud_model->get_blog_comments_by_parent_id($blog_comment['blog_comment_id'])->result_array() as $child_comment): ?>
                            <?php $child_commenter_details = $this->user_model->get_all_user($child_comment['user_id'])->row_array(); ?>
                                <div class="reply">
                                    <div class="row">
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-2">
                                            <img loading="lazy" src="<?php echo $this->user_model->get_user_image_url($child_commenter_details['id']); ?>">
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                                            <div class="student-feed-back-text">
                                                <h6><?php echo $child_commenter_details['first_name'] . ' ' . $child_commenter_details['last_name']; ?></h6>
                                                <p><?php echo date('D, d M Y'); ?></p>
                                                <p class="std"><?php echo $child_comment['comment']; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-2 col-2">
                                            <?php if($this->session->userdata('user_id') == $child_comment['user_id'] || $this->session->userdata('admin_login') == true): ?>
                                                <div class="settings-icon dropdown">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('blog/delete_comment/'.$child_comment['blog_comment_id'].'/'.$blog_details['blog_id']); ?>')"><?php echo get_phrase('Delete'); ?></a></li>
                                                      </ul>                                     
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="comment instructor-student-feed-back">
                        <h1><?php echo get_phrase('Leave a Comment') ?></h1>
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="<?php echo site_url('blog/add_blog_comment/'.$blog_details['blog_id']); ?>" method="post" class="feedback-form">
                                    <div class="single-input mb-3">
                                        <textarea name="comment" class="form-control" placeholder="<?php echo get_phrase('Enter your comments here'); ?>"></textarea>
                                        <input type="hidden" name="parent_id" value="">
                                    </div>
                                    <button type="submit" class="message-btn px-5"><?php echo get_phrase('Submit') ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php include "blog_sidebar.php"; ?>
                </div>
            </div>
        </div>
    </div>
</section>
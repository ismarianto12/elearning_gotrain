<!--------- Blog section start ---------->
<section class="blog-body courses blog pb-3 mb-5">
    <div class="container">
        <h1 class="text-center"><span><?php echo get_phrase('Inspirational Journeys'); ?></span></h1>
        <p class="text-center"><?php echo get_phrase('Follow the Stories of Academics and Their Research Expeditions') ?></p>
        <div class="courses-card">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <p class="my-2">
                                <?php if(isset($search_string) || isset($_GET['category'])):
                                    echo site_phrase('total').' '.$total_rows.' '.site_phrase('results');
                                else:
                                    echo site_phrase('total').' '.$total_rows.' '.site_phrase('articles');
                                endif; ?>
                            </p>
                        </div>

                        <?php foreach($blogs->result_array() as $blog): ?>
                            <?php $user_details = $this->user_model->get_all_user($blog['user_id'])->row_array(); ?>
                            <div class="col-md-6">
                                <a href="<?php echo site_url('blog/details/'.slugify($blog['title']).'/'.$blog['blog_id']); ?>" class="courses-card-body">
                                    <div class="courses-card-image">
                                        <div class="courses-card-image">
                                            <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$blog['thumbnail']; ?>
                                            <?php if(file_exists($blog_thumbnail) && is_file($blog_thumbnail)): ?>
                                                <img loading="lazy" src="<?php echo base_url($blog_thumbnail); ?>" alt="<?php echo $blog['title']; ?>">
                                            <?php else: ?>
                                                <img loading="lazy" src="<?php echo base_url('uploads/blog/thumbnail/placeholder.png'); ?>" alt="<?php echo $blog['title']; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="courses-card-image-text">
                                            <h3><?php echo $this->crud_model->get_blog_categories($blog['blog_category_id'])->row('title'); ?></h3>
                                        </div> 
                                    </div>
                                    <div class="courses-text">
                                        <h5><?php echo $blog['title']; ?></h5>
                                        <p class="ellipsis-line-2"><?php echo ellipsis(strip_tags(htmlspecialchars_decode_($latest_blog['description'])), 150); ?></p>
                                            <div class="courses-price-border">
                                                <div class="courses-price">
                                                    <div class="courses-price-left">
                                                        <img loading="lazy" class="rounded-circle" src="<?php echo $this->user_model->get_user_image_url($user_details['id']); ?>">
                                                        <h5><?php echo $user_details['first_name'].' '.$user_details['last_name']; ?></h5>
                                                    </div>
                                                    <div class="courses-price-right ">
                                                        <p><?php echo get_past_time($blog['added_date']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                 </a>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-12 text-center">
                            <nav><?php echo $this->pagination->create_links(); ?></nav>
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
<!--------- Blog section end ---------->
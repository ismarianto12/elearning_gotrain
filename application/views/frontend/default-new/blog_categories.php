<?php
    $categories = $this->crud_model->get_blog_categories()->result_array();
?>

<section class="blog-body courses blog pb-3 mb-5">
    <div class="container">
        <h1 class="text-center"><span><?php echo get_phrase('Inspirational Journeys'); ?></span></h1>
        <p class="text-center"><?php echo get_phrase('Follow the Stories of Academics and Their Research Expeditions') ?></p>
        <div class="courses-card">
            <div class="row">
                <div class="col-lg-8">

                    <div class="row justify-content-around pt-4">
                        <?php foreach($categories as $category): ?>
                            <div class="col-md-6">
                                <?php $number_of_blog = $this->crud_model->get_blogs_by_category_id($category['blog_category_id'])->num_rows(); ?>
                                <div class="list-group border radius-10 my-2">
                                    <a href="<?php echo site_url('blogs?category='.$category['slug']); ?>" class="p-3 list-group-item list-group-item-action border-0" aria-current="true" style="height: 118px;">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1"><?php echo $category['title']; ?></h6>
                                            <?php if($number_of_blog > 0): ?>
                                                <span class="badge bg-primary rounded-pill"><?php echo $number_of_blog; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <small class="ellipsis-line-3"><?php echo $category['subtitle']; ?></small>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <?php include "blog_sidebar.php"; ?>
                </div>
            </div>
        </div>
    </div>
</section>
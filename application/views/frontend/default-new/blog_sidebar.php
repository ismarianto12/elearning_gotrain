<?php
    $popular_categories = $this->crud_model->get_categories_with_blog_number(6);
    $latest_blogs = $this->crud_model->get_latest_blogs(3);
?>

<div class="right-section">
    <div class="search">
        <div class="search-bar">
            <form action="<?php echo site_url('blogs'); ?>" method="get">
                <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input value="<?php if(isset($search_string) && !empty($search_string)) echo $search_string; ?>" type="text" name="search" class="form-control" placeholder="<?php echo site_phrase('Type your keywords'); ?>" id="search-place">
            </form>
        </div>
    </div>
    <div class="title">
        <h4><?php echo get_phrase('Categories') ?></h4>
    </div>
    <div class="categories mb-4">
        <ul>
            <?php foreach($popular_categories as $popular_category): ?>
                <?php $blog_category = $this->crud_model->get_blog_categories($popular_category['blog_category_id'])->row_array(); ?>
                <li class="d-flex align-items-center">
                    <a href="<?php echo site_url('blogs?category='.$blog_category['slug']); ?>" class="me-1"><?php echo $blog_category['title']; ?></a>
                    <?php if($popular_category['blog_number'] > 0): ?>
                        <span class="badge bg-primary rounded-pill ms-auto"><?php echo $popular_category['blog_number']; ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <a class="text-14px mx-0 mt-4 text-muted" href="<?php echo site_url('blog/categories'); ?>"><?php echo site_phrase('all_categories'); ?></a>
    </div>
    <div class="title">
        <h4><?php echo get_phrase('Recent Posts') ?></h4>
    </div>

    <?php foreach($latest_blogs->result_array() as $latest_blog): ?>
        <div class="post">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                   <a href="<?php echo site_url('blog/details/'.slugify($latest_blog['title']).'/'.$latest_blog['blog_id']); ?>"><h5><?php echo $latest_blog['title']; ?></h5></a>
                   <p><i class="fa-solid fa-calendar-days"></i> <?php echo date('D, d M Y', $latest_blog['added_date']) ?></p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <?php $blog_thumbnail = 'uploads/blog/thumbnail/'.$latest_blog['thumbnail']; ?>
                    <?php if(file_exists($blog_thumbnail) && is_file($blog_thumbnail)): ?>
                        <img loading="lazy" src="<?php echo base_url($blog_thumbnail); ?>" alt="<?php echo $latest_blog['title']; ?>">
                    <?php else: ?>
                        <img loading="lazy" src="<?php echo base_url('uploads/blog/thumbnail/placeholder.png'); ?>" alt="<?php echo $latest_blog['title']; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>                                                
</div>
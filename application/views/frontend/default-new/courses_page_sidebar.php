<form action="<?php echo site_url('home/courses'); ?>" method="get" id="course_filter_form">

    <?php if(isset($_GET['query']) && !empty($_GET['query'])): ?>
        <input type="hidden" name="query" value="<?php echo $_GET['query']; ?>">
    <?php endif; ?>

    <div class="course-all-category">
        <div class="course-category">
            <h3><?php echo get_phrase('Categories'); ?></h3>
            
            <div class="form-check">
                <input class="form-check-input" type="radio" value="all" name="category"  id="category_all" onchange="filterCourse()" <?php if($selected_category == 'all') echo 'checked'; ?>>
                <label class="form-check-label" for="category_all">
                    <div class="category-heading">
                        <span class="text-13px"><?php echo get_phrase('All category') ?></span>
                    </div>
                    <span>(<?php echo $this->crud_model->get_active_course()->num_rows(); ?>)</span>
                </label>
            </div>
            <div class="webdesign webdesign-category less">
                <?php $categories = $this->crud_model->get_categories()->result_array(); ?>
                <?php foreach($categories as $category): ?>
                    <?php $course_number = $this->crud_model->get_active_course_by_category_id($category['id'], 'category_id')->num_rows(); ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="<?php echo $category['slug'] ?>" name="category" id="category-<?php echo $category['id']; ?>" onchange="filterCourse()" <?php if($selected_category == $category['slug']) echo 'checked'; ?>>
                        <label class="form-check-label" for="category-<?php echo $category['id']; ?>">
                            <div class="category-heading">
                                <span class="text-13px"><?php echo $category['name']; ?></span>
                            </div>
                            <span>(<?php echo $course_number; ?>)</span>
                        </label>
                    </div>
                    <ul>
                        <?php foreach ($this->crud_model->get_sub_categories($category['id']) as $sub_category): ?>
                            <?php $course_number = $this->crud_model->get_active_course_by_category_id($sub_category['id'], 'sub_category_id')->num_rows(); ?>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="<?php echo $sub_category['slug'] ?>" name="category" id="sub_category-<?php echo $sub_category['id']; ?>" onchange="filterCourse()" <?php if($selected_category == $sub_category['slug']) echo 'checked'; ?>>
                                    <label class="form-check-label" for="sub_category-<?php echo $sub_category['id']; ?>">
                                        <span class="text-13px"><?php echo $sub_category['name']; ?></span>
                                        <span>(<?php echo $course_number; ?>)</span>
                                    </label>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach; ?>
            </div>
            <div class="show-more">
                <a class="show-more-less-btn" href="#" onclick="$('.course-all-category .course-category .webdesign-category').toggleClass('less'); $('.show-more-less-btn').toggleClass('d-none');"><?php echo get_phrase('Show More'); ?></a>
                <a class="show-more-less-btn d-none" href="#" onclick="$('.course-all-category .course-category .webdesign-category').toggleClass('less'); $('.show-more-less-btn').toggleClass('d-none');"><?php echo get_phrase('Show Less'); ?></a>
            </div>
        </div>
        <div class="course-price course-category">
            <h3><?php echo get_phrase('Price'); ?></h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price" value="all" id="price_all" onchange="filterCourse()" <?php if($selected_price== 'all') echo 'checked'; ?>>
                <label class="form-check-label" for="price_all">
                    <span class="text-13px"><?php echo get_phrase('All'); ?></span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price" value="free"  id="price_free" onchange="filterCourse()" <?php if($selected_price == 'free') echo 'checked'; ?>>
                <label class="form-check-label" for="price_free">
                    <span class="text-13px"><?php echo get_phrase('Free'); ?></span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="price" value="paid" id="price_paid" onchange="filterCourse()" <?php if($selected_price == 'paid') echo 'checked'; ?>>
                <label class="form-check-label" for="price_paid">
                    <span class="text-13px"><?php echo get_phrase('Paid'); ?></span>
                </label>
            </div>
        </div>
        <div class="course-price course-category">
            <h3><?php echo get_phrase('Level'); ?></h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="level" value="all" id="level_all" onchange="filterCourse()" <?php if($selected_level == 'all') echo 'checked'; ?>>
                <label class="form-check-label" for="level_all">
                    <span class="text-13px"><?php echo get_phrase('All'); ?></span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="beginner" name="level" id="level_beginner" onchange="filterCourse()" <?php if($selected_level == 'beginner') echo 'checked'; ?>>
                <label class="form-check-label" for="level_beginner">
                    <span class="text-13px"><?php echo get_phrase('Beginner'); ?></span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="intermediate" name="level" id="level_intermediate" onchange="filterCourse()" <?php if($selected_level == 'intermediate') echo 'checked'; ?>>
                <label class="form-check-label" for="level_intermediate">
                    <span class="text-13px"><?php echo get_phrase('Intermediate'); ?></span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="advanced" name="level" id="level_advanced" onchange="filterCourse()" <?php if($selected_level == 'advanced') echo 'checked'; ?>>
                <label class="form-check-label" for="level_advanced">
                    <span class="text-13px"><?php echo get_phrase('Advanced'); ?></span>
                </label>
            </div>
        </div>
        <div class="course-price course-category">
            <h3><?php echo get_phrase('Language'); ?></h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="all" name="language" id="language_all" onchange="filterCourse()" <?php if($selected_language == 'all') echo 'checked'; ?>>
                <label class="form-check-label" for="language_all">
                    <span class="text-13px"><?php echo get_phrase('All'); ?></span>
                </label>
            </div>
            <div class="webdesign webdesign-lan less">
                <?php
                $languages = $this->crud_model->get_all_languages();
                foreach ($languages as $language): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="<?php echo strtolower($language); ?>" name="language" id="language_<?php echo $language; ?>" onchange="filterCourse()" <?php if($selected_language == strtolower($language)) echo 'checked'; ?>>
                        <label class="form-check-label" for="language_<?php echo $language; ?>">
                            <span class="text-13px"><?php echo ucfirst($language); ?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="show-more">
                <a class="show-more-less-btn-lan" href="#" onclick="$('.course-all-category .course-category .webdesign-lan').toggleClass('less'); $('.show-more-less-btn-lan').toggleClass('d-none');"><?php echo get_phrase('Show More'); ?></a>
                <a class="show-more-less-btn-lan d-none" href="#" onclick="$('.course-all-category .course-category .webdesign-lan').toggleClass('less'); $('.show-more-less-btn-lan').toggleClass('d-none');"><?php echo get_phrase('Show Less'); ?></a>
            </div>
        </div>
        <div class="course-price course-category">
            <h3><?php echo get_phrase('Ratings'); ?></h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="rating" value="all" id="rating_all" onchange="filterCourse()" <?php if($selected_rating == 'all') echo 'checked'; ?>>
                <label class="form-check-label" for="rating_all">
                    <span class="text-13px"><?php echo get_phrase('All'); ?></span>
                </label>
            </div>
            <div class="course-icon">
                <?php for($i=1; $i<=5; $i++): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="<?php echo $i; ?>" id="rating_<?php echo $i; ?>" onchange="filterCourse()" name="rating" <?php if($selected_rating == $i) echo 'checked'; ?>>
                        <label class="form-check-label" for="rating_<?php echo $i; ?>">
                            <div class="form-check-icon">
                                <ul>
                                    <?php for($sub_i = 1; $sub_i <= 5; $sub_i++): ?>
                                        <li class="<?php if($i>=$sub_i) echo 'icon-color'; ?>">
                                            <i class="fa-solid fa-star"></i>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </div>
                        </label>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <input id="sorting_hidden_input" type="hidden" name="sort_by" value="<?php echo $selected_sorting; ?>">
    
</form>
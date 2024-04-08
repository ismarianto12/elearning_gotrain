

<header>
       <!-- Sub Header Start -->
    <div class="sub-header">
        <div class="container">
            <div class="row"> 
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="icon icon-left">
                        <ul class="nav">
                            <li class="nav-item px-2"><a href="#"><i class="fa-solid fa-phone"></i> +9029-500-024</a></li>
                            <div class="vartical"></div> 
                            <li class="nav-item px-2"><a href="#"><i class="fa-solid fa-location-dot"></i> Melbourne, Australia</a></li>   
                        </ul>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 ">
                    <div class="icon right-icon  d-flex justify-content-end align-items-center">
                        <ul class="nav justify-content-end">
                            <li class="nav-item"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="nav-item"><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="nav-item"><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li class="nav-item"><a href="#"><i class="fa-brands fa-behance"></i></a></li>
                        </ul>
                        <form action="#" method="POST" class="language-control select-box">
                            <select name="" id="" class="select-control form-select nice-select">
                                <option value="en">English</option>
                                <option value="ban">Bangla</option>
                            </select>
                        </form>
                    </div>             
                </div>
            </div>
        </div>
    </div>
        <!---- Sub Header End ------>
    <section class="menubar">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- <a class="navbar-brand logo" href="#"><img loading="lazy" src="<?php// echo base_url('uploads/system/'.get_frontend_settings('dark_logo')); ?>" alt=""></a> -->
                <a class="navbar-brand logo" href="<?php echo site_url(''); ?>"><img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/logo.png')?>" alt=""></a>
                <!-- Mobile Offcanves  Icon Show -->
                <ul class="menu-offcanves">
                <li>
                    <div class="search-item">
                        <span class="m-cross-icon"><i class="fa-solid fa-xmark"></i></span>
                        <span class="m-search-icon"> <i class="fa-solid fa-magnifying-glass"></i></span>    
                    </div>
                </li>
                <li><a href="#mobile-primary-nav" class="btn-bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><i class="fa-sharp fa-solid fa-bars"></i></a></li>
                </ul>

                <div class="navbar-collapse" id="navbarSupportedContent">
                <?php include 'menu.php'; ?>
                
                    <div class="antryArea ">
                    <ul class="antry-col d-flex align-items-center">
                    <?php if(addon_status('tutor_booking')): ?>
                        <li><a class="antry-link" href="<?php echo site_url('tutors'); ?>"><?php echo site_phrase('tutors'); ?></a>
                                <ul class="antry-submenu">
                                <li><a href="#">Ebook booking</a></li>
                                <li><a href="#">Sell book</a></li>
                                <li><a href="#">Ebook collect</a></li>
                                </ul>
                        </li>
                        <?php endif; ?>
                        <?php if(addon_status('ebook')): ?>
                        <li><a class="antry-link" href="<?php echo site_url('ebook'); ?>"><?php echo site_phrase('ebooks'); ?>
                        </a>
                                <ul class="antry-submenu">
                                <li><a href="#">schedule  one</a></li>
                                <li><a href="#">Sell book</a></li>
                                <li><a href="#">schedule three </a></li>
                                </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                    </div>
                <!-- Small Device Hide -->
                <div class="menu-search d-none d-lg-block">
                    <div class="search-item">
                        <span class="cross-icon"><i class="fa-solid fa-xmark"></i></span>
                        <span class="search-icon"> <i class="fa-solid fa-magnifying-glass"></i></span>
                    </div>
                    <div class=" search-control">
                        <form action="<?php echo site_url('home/search'); ?>" method="POST">
                            <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                            <input type="text" name = 'query' value="<?php echo isset($_GET['query']) ? $_GET['query'] : ""; ?>" class="form-control" placeholder="<?php echo site_phrase('search_for_courses'); ?>">
                            </form>
                    </div>
                </div>
                
                <div class="right-menubar w-100">
                    
                    <ul class="sign-in-box">
                        <?php $custom_page_menus = $this->crud_model->get_custom_pages('', 'header'); ?>
                        <?php foreach($custom_page_menus->result_array() as $custom_page_menu): ?>
                        <li>
                        <a class=" <?php if(isset($page_url) && $custom_page_menu['page_url'] == $page_url) echo 'active'; ?>"  href="<?php echo site_url('page/'.$custom_page_menu['page_url']); ?>"><?php echo $custom_page_menu['button_title']; ?></a>
                        </li>
                        <?php endforeach; ?>
                        <?php if ($this->session->userdata('admin_login')): ?>
                        <li>
                            <a href="<?php echo site_url('admin'); ?>"><?php echo site_phrase('administrator'); ?></a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <div class="wisth_tgl_div d-flex align-items-center">
                            <div class="wisth_tgl_2div ">    
                                <a class="menu_pro_cart_tgl"><i class="fa-solid fa-cart-shopping"></i>
                                    <p class="menu_number">1</p></a>
                                <div class="menu_pro_wish">
                                    <div class="overflow-control">
                                        <!-- Single Item -->
                                        <div class="path_pos_wish-2">
                                            <div class="path_pos_wish">
                                                <div class="menu_pro_wish-f-b">
                                                    <a href="#">
                                                    <div class="menu_pro_wish-flex">
                                                            <div class="img">
                                                                <img loading="lazy" src="image/list-view-2.png">
                                                                <span class="cart-minus"><i class="fa-solid fa-minus"></i></span>
                                                            </div>
                                                            <div class="text">
                                                                <h4>Wordpress for Beginne...</h4>
                                                                <p>By Adam smith</p>
                                                                <div class="spandiv">
                                                                    <span>$12</span>
                                                                    <del>$16</del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Item -->
                                        <div class="path_pos_wish-2">
                                            <div class="path_pos_wish">
                                                <div class="menu_pro_wish-f-b">
                                                    <a href="#">
                                                    <div class="menu_pro_wish-flex">
                                                            <div class="img">
                                                                <img loading="lazy" src="image/list-view-2.png">
                                                                <span class="cart-minus"><i class="fa-solid fa-minus"></i></span>
                                                            </div>
                                                            <div class="text">
                                                                <h4>Wordpress for Beginne...</h4>
                                                                <p>By Adam smith</p>
                                                                <div class="spandiv">
                                                                    <span>$12</span>
                                                                    <del>$16</del>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="menu_pro_btn">
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </div>
                                </div> 
                                </div>
                            </div>
                        </li>
                        <li><a href="<?php echo site_url('login'); ?>"  class="sign-in-log">Login</a></li>
                        <li><a href="<?php echo site_url('sign_up'); ?>" class="sign-up-btn">Sign Up</a></li>
                    </ul>    
                </div> 
            </div>
            <!-- Mobile Device Form -->
            <form action="<?php echo site_url('home/search'); ?>" method="POST" class="inline-form">
                <div class="mobile-search">
                    <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input type="text" name = 'query' value="<?php echo isset($_GET['query']) ? $_GET['query'] : ""; ?>" class="form-control" placeholder="<?php echo site_phrase('search_for_courses'); ?>">
                </div>
            </form>
            </nav> 
            <!-- Offcanves Menu  -->
            <div class="mobile-view-offcanves">
            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanves-top">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                    <div class="offcanves-btn">
                            <a href="<?php echo site_url('sign_up'); ?>" class="signUp-btn"><?php echo site_phrase('sign_up')?></a>
                        <a href="<?php echo site_url('login'); ?>"  class="logIn-btn"><?php echo site_phrase('Login')?></a>
                        
                    </div>
                </div>
            </div>
            <div class="offcanvas-body">
                <div class="offcanvas-items">
                    <ul class="navbar-nav main-nav-wrap me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a  class="nav-link header-dropdown" href="#">Wishlist
                            </a>
                        </li>
                        <?php  $categories = $this->crud_model->get_categories()->result_array();
                                foreach ($categories as $key => $category):?>
                        <li class="nav-item">
                            <a id="headerOne" class="nav-link header-dropdown" href="#"> <?php echo site_phrase('courses'); ?> <i class="fa-solid fa-angle-right"></i>
                            </a>
                            <ul id="navOne" class="navbarHover">
                                <li  class="dropdown-submenu">
                                    <a  href="#" id="showMenu-one">
                                        <span class="icons"><i class="<?php echo $category['font_awesome_class']; ?>"></i></span>
                                        <span class="text-cat"><?php echo $category['name']; ?></span>
                                        <span class="has-sub-category ms-auto"><i class="fa-solid fa-angle-right"></i></span>
                                    </a>
                                    <ul id="hideSub-menu-one" class="sub-category-menu hideSub-menu">
                                        <?php  
                                            $sub_categories =   $this->crud_model->get_sub_categories ($category['id']);
                                            foreach ($sub_categories as $sub_category): ?>
                                            <li><a href="#"> <?php echo $category['name']; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            </ul> 
                        </li>
                        <?php endforeach; ?>
                        <li class="nav-item">
                            <a id="headerTwo" class="nav-link header-dropdown" href="#"> Ebook <i class="fa-solid fa-angle-right"></i>
                            </a>
                            <ul id="navTwo" class="navbarHover">
                                <li  class="dropdown-submenu">
                                    <a  href="#">
                                        <span class="text-cat">Ebook one</span>
                                    </a>
                                </li>
                                <li  class="dropdown-submenu">
                                    <a  href="#">
                                        <span class="text-cat">Booking Two</span>
                                    </a>
                                </li>
                            </ul> 
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            </div>
        
    </section>
</header>

<div class="mood-control">
        <a href="#"> <img loading="lazy" id="dark" src="image/moon.png" alt="moon"></a>
     </div>
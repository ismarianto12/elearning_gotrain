<?php include "breadcrumb.php"; ?>


<!------- body section Start ------>
<section class="error-body">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img loading="lazy" src="<?php echo base_url('assets/frontend/default-new/image/error.png') ?>">
            </div>
            <div class="col-lg-6">
                <div class="error-body-text">
                    <h1><?php echo get_phrase('404 Not Found') ?></h1>
					<p><?php echo get_phrase('The page you requested could not be found') ?></p>
					<p class="mb-2">Please try the following:</p>
					<ul>
						<li><?php echo get_phrase('Check the spelling of the URL') ?></li>
						<li><?php echo get_phrase('If you are still puzzled, click on the home link below') ?></li>
					</ul>
					<a class="mt-4" href="<?php echo site_url(); ?>"><?php echo get_phrase('Back to Home') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!------- body section end ------>
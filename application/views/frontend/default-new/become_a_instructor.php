<?php include "breadcrumb.php"; ?>

<section class="contact-page">
    <div class="container">
    	<div class="row">
    		<div class="col-md-8">
				<form class="form-section" action="<?php echo site_url('home/become_an_instructor'); ?>" method="post" enctype="multipart/form-data">
                	<div class="mb-4">
                        <label class="mb-2" for="phone"><?php echo get_phrase('Your Phone'); ?></label>
						<input class="form-control bg-white" id="phone" type="phone" name="phone" placeholder="<?php echo get_phrase('Enter your phone number'); ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="document"><?php echo get_phrase('Document'); ?> <small>(doc, docs, pdf, txt, png, jpg, jpeg)</small></label>
					    <input class="form-control bg-white mb-0" id="document" type="file" name="document" required>
					    <small><?php echo get_phrase('Provide some documents about your qualifications'); ?></small>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2" for="message"><?php echo get_phrase('message'); ?></label>
						<textarea class="form-control bg-white" id="message" name="message" rows="4"></textarea>
                    </div>

                    <div class="mb-4">
                    	<button class="btn btn-primary"><?php echo get_phrase('Submit'); ?></button>
                    </div>
		                
		        </form>
		    </div>
		</div>
	</div>
</section>
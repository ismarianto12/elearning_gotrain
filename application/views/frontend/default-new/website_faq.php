<?php include "breadcrumb.php"; ?>

<?php $website_faqs = json_decode(get_frontend_settings('website_faqs'), true); ?>
<?php if(count($website_faqs) > 0): ?>
<!---------- Questions Section Start  -------------->
<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-12 d-flex align-items-center">
                <div class="faq-img d-none d-md-inline-block">
                    <img loading="lazy" src="<?php echo site_url('assets/frontend/default-new/image/faq2.jpg') ?>">
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                <div class="faq-accrodion">
                    <div class="faq-acc-heading">
                        <h4><?php echo get_phrase('FAQS') ?></h4>
                        <h1><?php echo get_phrase('Looking for answers?') ?></h1>
                    </div>
                    <div class="accordion" id="accordionFaq">
                        <?php foreach($website_faqs as $key => $faq): ?>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="<?php echo 'faqItemHeading'.$key; ?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo 'faqItempanel'.$key; ?>" aria-expanded="true" aria-controls="<?php echo 'faqItempanel'.$key; ?>">
                                    <?php echo $faq['question']; ?>
                                </button>
                              </h2>
                              <div id="<?php echo 'faqItempanel'.$key; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo 'faqItemHeading'.$key; ?>"  data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    <p><?php echo nl2br($faq['answer']); ?></p>
                                </div>
                              </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!---------- Questions Section End  -------------->
<?php endif; ?>
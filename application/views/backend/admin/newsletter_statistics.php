<div class="row no-gutters">

    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo site_url('admin/newsletter_history/pending') ?>" class="text-secondary">
            <div class="card shadow-none m-0">
                <div class="card-body text-center">
                    <h3><span><?php echo $this->db->where('status', 'pending')->get('newsletter_histories')->num_rows(); ?></span></h3>
                    <p class="font-15 mb-0 text-warning"><?php echo get_phrase('Total Pending'); ?></p>
                    <small><?php echo get_phrase('Waiting to be sent') ?></small>
                    <h6 class="mb-0 text-warning"><i class="fas fa-long-arrow-alt-right"></i></h6>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo site_url('admin/newsletter_history/sent') ?>" class="text-secondary">
            <div class="card shadow-none m-0 border-left rounded-0">
                <div class="card-body text-center">
                    <h3><span><?php echo $this->db->where('status', 'sent')->get('newsletter_histories')->num_rows(); ?></span></h3>
                    <p class="font-15 mb-0 text-success"><?php echo get_phrase('Total Success'); ?></p>
                    <small><?php echo get_phrase('Successfully sent') ?></small>
                    <h6 class="mb-0 text-success"><i class="fas fa-long-arrow-alt-right"></i></h6>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo site_url('admin/newsletter_history/faild') ?>" class="text-secondary">
            <div class="card shadow-none m-0 border-left rounded-0">
                <div class="card-body text-center">
                    <h3><span><?php echo $this->db->where('status', 'faild')->get('newsletter_histories')->num_rows(); ?></span></h3>
                    <p class="font-15 mb-0 text-danger"><?php echo get_phrase('Total Faild'); ?></p>
                    <small><?php echo get_phrase('Waiting for the next cue') ?></small>
                    <h6 class="mb-0 text-danger"><i class="fas fa-long-arrow-alt-right"></i></h6>
                </div>
            </div>
        </a>
    </div>

    <div class="col-sm-6 col-xl-3">
        <a href="<?php echo site_url('admin/newsletter_history/unable') ?>" class="text-secondary">
            <div class="card shadow-none m-0 border-left rounded-0">
                <div class="card-body text-center">
                    <h3><span><?php echo $this->db->where('status', 'unable')->get('newsletter_histories')->num_rows(); ?></span></h3>
                    <p class="font-15 mb-0 text-secondary"><?php echo get_phrase('Unable to send'); ?></p>
                    <small><?php echo get_phrase('10 attempts failed, Click here to send email manually') ?></small>
                </div>
            </div>
        </a>
    </div>

</div> <!-- end row -->
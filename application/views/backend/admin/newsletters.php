<div class="row ">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-body">
        <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
          <a href="#" onclick="showAjaxModal('<?php echo site_url('admin/newsletter_add_form'); ?>', '<?php echo get_phrase('Newsletter template') ?>')" class="btn btn-outline-primary btn-rounded alignToTitle mr-1"><i class=" mdi mdi-plus"></i> <?php echo get_phrase('Newsletter'); ?></a>
        </h4>
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
</div>

<div class="row">
  <div class="col-12">
    <div class="card widget-inline">
      <div class="card-body p-0" id="newsletter_statistics">
        <?php include "newsletter_statistics.php"; ?>
      </div>
    </div> <!-- end card-box-->
  </div> <!-- end col-->
</div>

<div class="row">
  <div class="col-lg-8">
    <div id="accordion" class="custom-accordion mb-4">

      <?php $newsletters = $this->db->get('newsletters')->result_array(); ?>
      <?php foreach ($newsletters as $newsletter) : ?>
        <div class="card mb-0">
          <div class="card-header py-0" id="headingOne<?= $newsletter['id'] ?>">
            <h5 class="">
              <a class="custom-accordion-title d-flex flex-wrap align-items-center <?php echo isset($_GET['tab']) && $_GET['tab'] == $newsletter['id'] ? '' : 'collapsed'; ?> pt-2 pb-2" data-toggle="collapse" href="#collapseOne<?= $newsletter['id']; ?>" aria-expanded="true" aria-controls="collapseOne<?= $newsletter['id'] ?>">
                <p class="mb-0">
                  <i class="mdi mdi-arrow-right-bold-outline"></i>
                  <?php echo $newsletter['subject']; ?>
                </p>

                <p class="mb-0 ml-auto" style="min-width: 175px;">
                  <span class="float-right">
                    <i class="mdi mdi-chevron-down accordion-arrow"></i>
                  </span>
                  <span onclick="stopProp(event)">
                    <button class="btn btn-outline-danger float-right px-1 py-0 mr-4" onclick="confirm_modal('<?php echo site_url('admin/newsletters/delete/' . $newsletter['id']); ?>')" data-toggle="tooltip" title="<?php echo get_phrase('Delete'); ?>">
                      <i class="mdi mdi-delete"></i>
                    </button>
                    <button class="btn btn-outline-primary float-right px-1 py-0 mr-2" onclick="showAjaxModal('<?php echo site_url('admin/newsletter_edit_form/' . $newsletter['id']); ?>', '<?php echo get_phrase('Edit newsletter template') ?>')" data-toggle="tooltip" title="<?php echo get_phrase('Edit'); ?>">
                      <i class="mdi mdi-pencil"></i>
                    </button>
                    <button class="btn btn-outline-success float-right px-1 py-0 mr-2" onclick="showAjaxModal('<?php echo site_url('admin/newsletter_send_form/' . $newsletter['id']); ?>', '<?php echo get_phrase('Send Newsletter') ?>')" data-toggle="tooltip" title="<?php echo get_phrase('Send'); ?>">
                      <i class="mdi mdi-send  mdi-rotate-315"></i>
                    </button>
                  </span>
                </p>
              </a>
            </h5>
          </div>

          <div id="collapseOne<?= $newsletter['id'] ?>" class="collapse <?php echo isset($_GET['tab']) && $_GET['tab'] == $newsletter['id'] ? 'show' : ''; ?>" aria-labelledby="headingOne<?= $newsletter['id'] ?>" data-parent="#accordion">
            <div class="card-body">
              <?php echo $newsletter['description']; ?>
            </div>
          </div>
        </div> <!-- end card-->
      <?php endforeach; ?>

    </div> <!-- end custom accordions-->
  </div>
  <div class="col-lg-4">
    <div class="alert alert-info" role="alert">
      <h4 class="alert-heading"><?php echo get_phrase('Heads up'); ?>!</h4>
      <p>If you want to send a newsletter to more than 20 users at once, the system will automatically divide them into chunks of 20. Every minute, the server will initiate a process to send 20 emails at a time. In order to complete this task, the website needs to remain active in a browser until all the emails are successfully sent.</p>
      <hr>
      <p>Alternatively, you have the option to configure a cronjob manually for sending emails, eliminating the need to keep the website open.</p>
      <?php if (is_file('uploads/cronjob/newsletter_cron.php') && file_exists('uploads/cronjob/newsletter_cron.php')) : ?>
        <p class="bg-white p-1">
          <code class="" style="border-radius: 10px;">
            <?php echo realpath(APPPATH . '..') . '/uploads/cronjob/newsletter_cron.php'; ?>
          </code>
        </p>

        <a href="<?php echo site_url('admin/cronjob/stop'); ?>" class="btn btn-danger"><?php echo get_phrase('Remove Cronjob file'); ?></a>
      <?php else : ?>
        <a href="<?php echo site_url('admin/cronjob/start'); ?>" class="btn btn-primary"><?php echo get_phrase('Create Cronjob file'); ?></a>
      <?php endif; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  function stopProp(event) {
    event.stopPropagation();
  }
</script>
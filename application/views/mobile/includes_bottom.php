<!-- Script -->
<script src="<?php echo site_url('assets/playing-page/') ?>js/jquery.min.js"></script>
<script src="<?php echo site_url('assets/playing-page/') ?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo site_url('assets/playing-page/') ?>js/script.js"></script>
<script src="<?php echo base_url() . 'assets/global/jquery-form/jquery.form.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/global/toastr/toastr.min.js'; ?>"></script>

<?php if(addon_status('certificate')): ?>
	<script src="<?php echo base_url() . 'assets/global/jquery-form/jQuery-plugin-progressbar.js'; ?>"></script>
<?php endif; ?>
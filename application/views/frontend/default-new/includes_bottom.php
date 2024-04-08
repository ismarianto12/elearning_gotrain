<script src="<?php echo base_url() . 'assets/frontend/default-new/js/bootstrap.bundle.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/berli.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/course.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.meanmenu.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.nice-select.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/jquery.webui-popover.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/owl.carousel.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/script-2.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/slick.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/venobox.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/js/script.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default-new/summernote-0.8.20-dist/summernote-lite.min.js'; ?>"></script>




<script src="<?php echo base_url() . 'assets/global/toastr/toastr.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/global/jquery-form/jquery.form.min.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/global/tagify/jquery.tagify.js'; ?>"></script>

<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != "") : ?>

	<script type="text/javascript">
		toastr.success('<?php echo $this->session->flashdata("flash_message"); ?>');
	</script>

<?php endif; ?>

<?php if ($this->session->flashdata('error_message') != "") : ?>

	<script type="text/javascript">
		toastr.error('<?php echo $this->session->flashdata("error_message"); ?>');
	</script>

<?php endif; ?>

<?php if ($this->session->flashdata('info_message') != "") : ?>

	<script type="text/javascript">
		toastr.info('<?php echo $this->session->flashdata("info_message"); ?>');
	</script>

<?php endif; ?>
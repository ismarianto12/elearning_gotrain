<ul class="nav nav-tabs ct-tabs-custom-one player-bottom-tabs" role="tablist">

	<?php if (isset($lesson_details) && is_array($lesson_details) && count($lesson_details) > 0) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="summary-class-tab" data-bs-toggle="tab" data-bs-target="#summary-class-content" type="button" role="tab" aria-controls="summary-class-content" aria-selected="true">
				<i class="far fa-bookmark"></i>
				<?php echo get_phrase('Summary'); ?>
				<span></span>
			</button>
		</li>
	<?php endif; ?>

	<li class="nav-item" role="presentation">
		<button class="nav-link" id="live-class-tab" data-bs-toggle="tab" data-bs-target="#live-class-content" type="button" role="tab" aria-controls="live-class-content" aria-selected="true">
			<i class="fas fa-video"></i>
			<?php echo get_phrase('Live class'); ?>
			<span></span>
		</button>
	</li>

	<?php if (addon_status('assignment')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="assignment-tab" data-bs-toggle="tab" data-bs-target="#assignment-content" type="button" role="tab" aria-controls="assignment-content" aria-selected="true">
				<i class="fab fa-wpforms"></i>
				<?php echo get_phrase('Assignment'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<?php if (addon_status('forum')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" onclick="load_questions('<?= $course_id; ?>')" id="forum-tab" data-bs-toggle="tab" data-bs-target="#forum-content" type="button" role="tab" aria-controls="forum-content" aria-selected="true">
				<i class="far fa-comments"></i>
				<?php echo get_phrase('Forum'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<?php if (addon_status('noticeboard')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="noticeboard-tab" onclick="load_course_notices('<?= $course_id; ?>')" data-bs-toggle="tab" data-bs-target="#noticeboard-content" type="button" role="tab" aria-controls="noticeboard-content" aria-selected="true">
				<i class="far fa-bell"></i>
				<?php echo get_phrase('Noticeboard'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
	<?php if (addon_status('certificate')) : ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="certificate-tab" onclick="actionTo('<?php echo site_url('addons/certificate/certificate_progress/' . $course_details['id']); ?>')" data-bs-toggle="tab" data-bs-target="#certificate-content" type="button" role="tab" aria-controls="certificate-content" aria-selected="true">
				<i class="fas fa-graduation-cap"></i>
				<?php echo get_phrase('Certificate'); ?>
				<span></span>
			</button>
		</li>
	<?php endif ?>
</ul>

<div class="tab-content ct-tabs-content">
	<?php if (isset($lesson_details) && is_array($lesson_details) && count($lesson_details) > 0) : ?>
		<div class="tab-pane fade" id="summary-class-content" role="tabpanel" aria-labelledby="summary-class-tab">


			<?php $resource_files = $this->db->order_by('id', 'desc')->where('lesson_id', $lesson_details['id'])->get('resource_files')->result_array(); ?>
			<?php if (is_array($resource_files) && count($resource_files) > 0) : ?>
				<div class="row mb-4">
					<div class="col-auto">
						<h6 class="text-dark pt-2"><?php echo get_phrase('Attached Files'); ?>:</h6>
					</div>
					<?php foreach ($resource_files as $resource_file) : ?>
						<?php if ($resource_file['file_name']) : ?>
							<div class="col-auto">
								<a class="btn p-1" href="<?php echo base_url('uploads/resource_files/' . $resource_file['file_name']); ?>" download>
									<span class="mr-auto"><?php echo $resource_file['title']; ?></span>
									<i class="fas fa-download"></i>
								</a>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			<?php echo htmlspecialchars_decode_($lesson_details['summary']); ?>
		</div>
	<?php endif; ?>

	<div class="tab-pane fade" id="live-class-content" role="tabpanel" aria-labelledby="live-class-tab">
		
		<!-- BigBlueButton -->
				
		<?php $live_class_scheduled = 0; ?>
		<?php $bbb_meeting = $this->db->where('course_id', $course_id)->get('bbb_meetings');
		if ($bbb_meeting->num_rows() > 0) :
			$live_class_scheduled = 1;
			$bbb_meeting = $bbb_meeting->row_array(); ?>
			<div class="live_class">
				<i class="fa fa-calendar-check"></i> <?php echo get_phrase('BigBlueButton live class schedule'); ?>
				<div class="py-4">
					<?php echo $bbb_meeting['instructions']; ?>
				</div>
				<a href="<?php echo site_url('user/join_bbb_meeting/'.$course_id); ?>" target="_blank" class="btn btn_zoom">
					<i class="fa fa-video"></i>&nbsp;
					<?php echo get_phrase('join_live_class'); ?>
				</a>
			</div>
			<hr>
		<?php endif; ?>


		<?php if (addon_status('live-class')) : ?>
			<?php $live_class = $this->db->get_where('live_class', array('course_id' => $course_id));
			if ($live_class->num_rows() > 0) :
				$live_class_scheduled = 1;
				$live_class = $this->db->get_where('live_class', array('course_id' => $course_id))->row_array(); ?>
				<div class="live_class">
					<i class="fa fa-calendar-check"></i> <?php echo get_phrase('zoom_live_class_schedule'); ?>
					<h5 style="margin-top: 20px;"><?php echo date('h:i A', $live_class['time']); ?> : <?php echo date('D, d M Y', $live_class['date']); ?></h5>
					<div class="live_class_note">
						<?php echo $live_class['note_to_students']; ?>
					</div>
					<a href="<?php echo site_url('addons/liveclass/join/' . $lesson_details['course_id']); ?>" class="btn btn_zoom">
						<i class="fa fa-video"></i>&nbsp;
						<?php echo get_phrase('join_live_video_class'); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if (addon_status('live-class') && addon_status('jitsi-live-class')) echo '<hr>'; ?>

		<?php if (addon_status('jitsi-live-class')) : ?>
			<?php $live_class = $this->db->get_where('jitsi_live_class', array('course_id' => $course_id));
			if ($live_class->num_rows() > 0) :
				$live_class_scheduled = 1;
				$live_class = $live_class->row_array(); ?>
				<div class="live_class">
					<i class="fa fa-calendar-check"></i> <?php echo get_phrase('jitsi_live_class_schedule'); ?>
					<h5 style="margin-top: 20px;"><?php echo date('h:i A', $live_class['time']); ?> : <?php echo date('D, d M Y', $live_class['date']); ?></h5>
					<div class="live_class_note">
						<?php echo $live_class['note_to_students']; ?>
					</div>
					<a target="_blank" href="<?php echo site_url('addons/jitsi_liveclass/join/' . $course_id); ?>" class="btn btn_zoom">
						<i class="fa fa-video"></i>&nbsp;
						<?php echo get_phrase('join_live_video_class'); ?>
					</a>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<?php if(!$live_class_scheduled): ?>
			<div class="alert alert-warning" role="alert" style="padding: 30px 0px;">
				<?php echo get_phrase('live_class_is_not_scheduled_yet'); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php if (addon_status('assignment')) : ?>
		<div class="tab-pane fade" id="assignment-content" role="tabpanel" aria-labelledby="assignment-tab">
			<?php include 'assignment_body.php'; ?>
		</div>
	<?php endif; ?>

	<?php if (addon_status('forum')) : ?>
		<div class="tab-pane fade" id="forum-content" role="tabpanel" aria-labelledby="forum-tab"></div>
	<?php endif; ?>

	<?php if (addon_status('noticeboard')) : ?>
		<div class="tab-pane fade" id="noticeboard-content" role="tabpanel" aria-labelledby="noticeboard-tab"></div>
	<?php endif; ?>

	<?php if (addon_status('certificate')) : ?>
		<div class="tab-pane fade" id="certificate-content" role="tabpanel" aria-labelledby="certificate-tab"></div>
	<?php endif; ?>
</div>


<?php if (addon_status('forum')) : ?>
	<?php include 'course_forum_scripts.php'; ?>
<?php endif; ?>
<?php if (addon_status('noticeboard')) : ?>
	<?php include 'noticeboard_scripts.php'; ?>
<?php endif; ?>

<script>
	$(function() {
		setTimeout(function() {
			$('.player-bottom-tabs li:first button').trigger('click');
			$($('.player-bottom-tabs li:first button').attr('data-bs-target')).addClass('show');
		}, 300);
	});
</script>
<?php $bundle_id = isset($bundle_id) ? $bundle_id:''; ?>

<?php
$full_page = isset($full_page) ? $full_page : false;
$lesson_thumbnail_url = $this->crud_model->get_lesson_thumbnail_url($lesson_id);
$get_lesson_type = get_lesson_type($lesson_details['id']);
?>

<?php if ($get_lesson_type == 'youtube_video_url') : ?>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>">
		<div class="plyr__video-embed " id="player">
			<iframe height="500" src="<?php echo $lesson_details['video_url']; ?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
		</div>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'google_drive_video_url') : ?>
	<?php
	$url_array_1 = explode("/", $lesson_details['video_url'] . '/');
	$url_array_2 = explode("=", $lesson_details['video_url']);
	$video_id = null;
	if ($url_array_1[4] == 'd') :
		$video_id = $url_array_1[5];
	else :
		$video_id = $url_array_2[1];
	endif; ?>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>">
		<video id="player" playsinline controls>
			<source class="remove_video_src" src="https://www.googleapis.com/drive/v3/files/<?php echo $video_id; ?>?alt=media&key=<?php echo get_settings('youtube_api_key'); ?>" type="video/mp4">
			<?php if ($lesson_details['caption'] != "" && file_exists('uploads/captions/' . $lesson_details['caption'])) : ?>
				<track kind="captions" label="Caption" src="<?php echo base_url('uploads/captions/' . $lesson_details['caption']); ?>" srclang="en" default />
			<?php endif; ?>
		</video>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'vimeo_video_url') : ?>
	<?php $video_details = $this->video_model->getVideoDetails($lesson_details['video_url']);
	$video_id = $video_details['video_id']; ?>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>">
		<div class="plyr__video-embed" id="player">
			<iframe height="500" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
		</div>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'amazon_video_url' || $get_lesson_type == 'wasabi_video_url' || $get_lesson_type == 'academy_cloud' || $get_lesson_type == 'html5_video_url') : ?>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>">
		<video poster="<?php echo $lesson_thumbnail_url; ?>" id="player" playsinline controls>
			<source class="remove_video_src" src="<?php echo $lesson_details['video_url']; ?>" type="video/mp4">
			<?php if ($lesson_details['caption'] != "" && file_exists('uploads/captions/' . $lesson_details['caption'])) : ?>
				<track kind="captions" label="Caption" src="<?php echo base_url('uploads/captions/' . $lesson_details['caption']); ?>" srclang="en" default />
			<?php endif; ?>
		</video>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'video_file') : ?>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>">
		<video poster="<?php echo $lesson_thumbnail_url; ?>" id="player" playsinline controls>
			<source src="<?php echo site_url('files?course_id=' . $course_details['id'] . '&lesson_id=' . $lesson_details['id'] . '&type=video&ext=mp4' . '&expire=' . time()); ?>" type="video/mp4">
			<?php if ($lesson_details['caption'] != "" && file_exists('uploads/captions/' . $lesson_details['caption'])) : ?>
				<track kind="captions" label="Caption" src="<?php echo base_url('uploads/captions/' . $lesson_details['caption']); ?>" srclang="en" default />
			<?php endif; ?>
		</video>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'audio_file') : ?>
	<style>
		.plyr__menu__container{
			z-index: 1035 !important;
		}
	</style>
	<div class="p-3 <?php if ($full_page) echo 'bg-black'; ?>" style="margin-top: 250px;">
		<audio id="player" playsinline controls>
			<source src="<?php echo site_url('files?course_id=' . $course_details['id'] . '&lesson_id=' . $lesson_details['id'] . '&type=video&ext=mp4' . '&expire=' . time()); ?>" type="audio/mp3">
		</audio>
	</div>
	<?php include "plyr_config.php"; ?>
<?php elseif ($get_lesson_type == 'quiz') : ?>
	<div class="mt-0">
		<?php include 'quiz_view.php'; ?>
	</div>
<?php elseif ($get_lesson_type == 'text') : ?>
	<style>
		/* For safari */
		.white-space *{
			white-space: break-spaces;
		}
	</style>
	<div class="w-100 white-space text-wrap">
		<?php echo htmlspecialchars_decode_($lesson_details['attachment']); ?>
	</div>
<?php elseif ($get_lesson_type == 'image_file') : ?>
	<?php $img_size = getimagesize('uploads/lesson_files/' . $lesson_details['attachment']); ?>
	<img width="100%" style="max-width: <?php echo $img_size[0] . 'px'; ?>" height="auto" src="<?php echo site_url('files?course_id=' . $course_details['id'] . '&lesson_id=' . $lesson_details['id'] . '&type=image'); ?>" />
<?php elseif ($get_lesson_type == 'text_file') : ?>
	<iframe class="embed-responsive-item" width="100%" height="450px" src="<?php echo site_url('files?course_id=' . $course_details['id'] . '&lesson_id=' . $lesson_details['id'] . '&type=image'); ?>" allowfullscreen></iframe>
<?php elseif ($get_lesson_type == 'pdf_file') : ?>
	<iframe class="embed-responsive-item" width="100%" height="600px" src="<?php echo site_url('home/pdf_canvas/' . $course_details['id'] . '/' . $lesson_details['id'].'/'.$bundle_id); ?>" allowfullscreen></iframe>
<?php elseif ($get_lesson_type == 'doc_file') : ?>
	<iframe width="100%" height="500px" class="doc" src="<?php echo site_url('files?course_id=' . $course_details['id'] . '&lesson_id=' . $lesson_details['id']); ?>&embedded=true"></iframe>
<?php elseif ($get_lesson_type == 'wasabi_document_file') : ?>
	<?php if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') : ?>
		<p class="text-danger"><?php echo site_phrase('you_should_upload_the_application_on_a_live_server_to_preview_the_doc_file'); ?></p>
	<?php endif; ?>
	<iframe width="100%" height="500px" class="doc" src="https://docs.google.com/gview?url=<?php echo get_video_url($lesson_details['video_url'], $lesson_details['course_id']); ?>&embedded=true"></iframe>
<?php elseif ($get_lesson_type == 'wasabi_image_file') : ?>
	<?php $image = get_video_url($lesson_details['video_url'], $lesson_details['course_id']);
	echo '<img width="100%" style="max-width: 100%;" src="' . $image . '" alt="Image">'; ?>
<?php elseif ($get_lesson_type == 'wasabi_text_file') : ?>
	<iframe class="embed-responsive-item" width="100%" height="450px" src="<?php echo get_video_url($lesson_details['video_url'], $lesson_details['course_id']); ?>" allowfullscreen></iframe>
<?php else : ?>
	<div class="w-100">
		<iframe class="embed-responsive-item" width="100%" height="550px" src="<?php echo $lesson_details['attachment']; ?>" allowfullscreen></iframe>
	</div>
<?php endif; ?>
<!-- Course preview modal -->
<?php
    $provider = "";
    $video_details = array();
    if ($course_details['course_overview_provider'] == "html5") {
        $provider = 'html5';
    } elseif($course_details['course_overview_provider'] == "youtube"){
        $provider = 'youtube';
    } elseif($course_details['course_overview_provider'] == "vimeo") {
        $video_details = $this->video_model->getVideoDetails($course_details['video_url']);
        $provider = 'vimeo';
    }
?>

<?php if (strtolower(strtolower($provider)) == 'youtube') : ?>
<!------------- PLYR.IO ------------>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">

<div class="plyr__video-embed" id="player">
  <iframe height="500" src="<?php echo $course_details['video_url']; ?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
</div>

<script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
<script>
  var player = new Plyr('#player');
</script>
<!------------- PLYR.IO ------------>
<?php elseif (strtolower($provider) == 'vimeo') : ?>
<!------------- PLYR.IO ------------>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">
<div class="plyr__video-embed" id="player">
  <iframe height="500" src="https://player.vimeo.com/video/<?php echo $video_details['video_id']; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
</div>

<script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
<script>
  var player = new Plyr('#player');
</script>
<!------------- PLYR.IO ------------>
<?php else : ?>
<!------------- PLYR.IO ------------>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/global/plyr/plyr.css">
<video poster="<?php echo $this->crud_model->get_course_thumbnail_url($course_details['id']); ?>" id="player" playsinline controls>
  <?php if (get_video_extension($course_details['video_url']) == 'mp4') : ?>
    <source src="<?php echo $course_details['video_url']; ?>" type="video/mp4">
  <?php elseif (get_video_extension($course_details['video_url']) == 'webm') : ?>
    <source src="<?php echo $course_details['video_url']; ?>" type="video/webm">
  <?php else : ?>
    <h4><?php site_phrase('video_url_is_not_supported'); ?></h4>
  <?php endif; ?>
</video>

<script src="<?php echo base_url(); ?>assets/global/plyr/plyr.js"></script>
<script>
  var player = new Plyr('#player');
</script>
<!------------- PLYR.IO ------------>
<?php endif; ?>

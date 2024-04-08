<div class="resource_file_content">
	<?php $resource_file = $this->db->get_where('resource_files', ['id' => $param2])->row_array(); ?>
	<form class="ajaxFormSubmission resetable" action="<?php echo site_url('admin/resource_files/update/'.$resource_file['id']); ?>" method="post" enctype="multipart/form-data">
		<div class="from-group">
			<label for="resource_title"><?php echo get_phrase('Title'); ?></label>
			<input type="text" value="<?php echo $resource_file['title']; ?>" id="resource_title" name="title" class="form-control" placeholder="<?php get_phrase('Enter your title') ?>">
		</div>

		<div class="from-group mt-2">
			<label for="resource_file"><?php echo get_phrase('Resource file'); ?></label>
		     <input type="file" class="form-control" id="resource_file" name="resource_file">
		    <small class="badge badge-light"><?php echo 'maximum_upload_size'; ?>: <?php echo ini_get('upload_max_filesize'); ?></small>
		    <small class="badge badge-light"><?php echo 'post_max_size'; ?>: <?php echo ini_get('post_max_size'); ?></small>
	    </div>

		<div class="row">
			<div class="col-6 text-left">
				<button class="btn btn-primary mt-3" type="submit"><?php echo get_phrase('Update'); ?></button>
			</div>
			<div class="col-6 text-right">
				<a href="#" class="btn btn-primary mt-3" onclick="showAjaxModal('<?php echo site_url('modal/popup/resource_files/'.$resource_file['lesson_id']); ?>', '<?php echo get_phrase('Add new resource file'); ?>')"><?php echo get_phrase('Back'); ?></a>
			</div>
		</div>
	</form>
	

	<ul class="pl-0 pt-2 mt-3 border-top" style="list-style: none;">
		<li><h5 class="mb-0"><?php echo get_phrase('Resource files'); ?></h5></li>
		<?php $resource_files = $this->db->order_by('id', 'desc')->where('lesson_id', $resource_file['lesson_id'])->get('resource_files')->result_array(); ?>
		<?php foreach($resource_files as $resource_file): ?>
			<li class="d-flex align-items-center" id="resource_file_<?php echo $resource_file['id']; ?>">
				<span class="mr-auto"><?php echo $resource_file['title']; ?></span>

				<?php if($resource_file['file_name']): ?>
					<a class="btn p-1" href="<?php echo base_url('uploads/resource_files/'.$resource_file['file_name']); ?>" download><i class="mdi mdi-cloud-download-outline"></i></a>
				<?php endif; ?>

				<a class="btn p-1" href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/resource_file_edit/'.$resource_file['id']); ?>', '<?php echo get_phrase('Edit resource'); ?>')"><i class="mdi mdi-pencil-outline"></i></a>

				<a class="btn p-1" href="#" onclick="if(confirm('Are you sure to delete?')) actionTo('<?php echo site_url('admin/resource_files/delete/'.$resource_file['id']); ?>');"><i class="mdi mdi-trash-can-outline"></i></a>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php include APPPATH.'views/backend/init.php'; ?>
</div>



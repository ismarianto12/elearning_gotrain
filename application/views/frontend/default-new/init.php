<script type="text/javascript">
	$(function () {

		if($('[data-bs-toggle="tooltip"]').length > 0){
			$('[data-bs-toggle="tooltip"]').tooltip();
		}

		if($('.tagify').length > 0){
			$('.tagify:not(.initialized)').tagify();
			$('.tagify:not(.initialized)').addClass('initialized');
		}

		$('a[href="#"]').on('click', function(event){
	      event.preventDefault();
	    });

	    if($('.text_editor:not(.initialized)').length){
			$('.text_editor:not(.initialized)').summernote({
				height: 180,                 // set editor height
				minHeight: null,             // set minimum height of editor
				maxHeight: null,             // set maximum height of editor
				focus: true                  // set focus to editable area after initializing summernote
			});
			$('.text_editor:not(.initialized)').addClass('initialized');
		}


		//When need to add a wishlist button inside a anchor tag
		$('.checkPropagation').on('click', function(event){
			var action = $(this).attr('action');
			var onclickFunction = $(this).attr('onclick');
			var onChange = $(this).attr('onchange');
			var tag = $(this).prop("tagName").toLowerCase();
			console.log(tag);
			if(tag != 'a' && action){
				$(location).attr('href', $(this).attr('action'));
				return false;
			}else if(onclickFunction){
				if(onclickFunction){
					onclickFunction;					
				}
				return false;
			}else if(tag == 'a'){
				return true;
			}
		});

		//Ajax for submission start
		var formElement;
		if($('.ajaxForm:not(.initialized)').length > 0){
			$('.ajaxForm:not(.initialized)').ajaxForm({
				beforeSend: function(data, form) {
					var formElement = $(form);
				},
				uploadProgress: function(event, position, total, percentComplete) {
				},
				complete: function(xhr) {

					setTimeout(function(){
						distributeServerResponse(xhr.responseText);
					}, 400);

					if($('.ajaxForm.resetable').length > 0){
						$('.ajaxForm.resetable')[0].reset();
					}
				},
				error: function(e)
				{
					console.log(e);
				}
			});
			$('.ajaxForm:not(.initialized)').addClass('initialized');
		}
	});

</script>
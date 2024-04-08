
<script type="text/javascript">
	$(function () {
		//Ajax for submission start
		var formElement;
		if($('.ajaxFormSubmission:not(.initialized)').length > 0){
			$('.ajaxFormSubmission:not(.initialized)').ajaxForm({
				beforeSend: function(data, form) {
					var formElement = $(form);
				},
				uploadProgress: function(event, position, total, percentComplete) {
				},
				complete: function(xhr) {

					setTimeout(function(){
						distributeServerResponse(xhr.responseText);
					}, 400);

					if($('.ajaxFormSubmission.resetable').length > 0){
						$('.ajaxFormSubmission.resetable')[0].reset();
					}
				},
				error: function(e)
				{
					console.log(e);
				}
			});
			$('.ajaxFormSubmission:not(.initialized)').addClass('initialized');
		}
	});
</script>
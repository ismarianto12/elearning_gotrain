<script type="text/javascript">
function showAjaxModal(url, title, modalType)
{
    $('#modal_ajax .modal-dialog').removeClass('modal-sm');
    $('#modal_ajax .modal-dialog').removeClass('modal-md');
    $('#modal_ajax .modal-dialog').removeClass('modal-lg');
    $('#modal_ajax .modal-dialog').removeClass('modal-xl');
    $('#modal_ajax .modal-dialog').removeClass('modal-fullscreen');

    if(modalType){
        $('#modal_ajax .modal-dialog').addClass('modal-'+modalType);
    }
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#modal_ajax .modal-body').html('<div class="w-100 text-center pt-5"><img loading="lazy" class="mt-5 mb-5" width="80px" src="<?= base_url(); ?>assets/global/gif/page-loader-2.gif"></div>');

    // LOADING THE AJAX MODAL
    jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('#modal_ajax .title').html(title);
            jQuery('#modal_ajax .modal-body').html(response);
        }
    });
}

function lesson_preview(url, title){
    // SHOWING AJAX PRELOADER IMAGE
    jQuery('#lesson_preview .title').html(title);
    jQuery('#lesson_preview .modal-body').html('<div class="w-100 text-center pt-5"><img loading="lazy" class="mt-5 mb-5" width="80px" src="<?= base_url(); ?>assets/global/gif/page-loader-2.gif"></div>');

    // LOADING THE AJAX MODAL
    jQuery('#lesson_preview').modal('show', {backdrop: 'true'});

    // SHOW AJAX RESPONSE ON REQUEST SUCCESS
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('#lesson_preview .modal-body').html(response);
        }
    });
}
</script>

<!-- (Ajax Modal)-->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="title text-white"></h5>
                <button type="button" class="btn btn-secondary ms-auto py-0 px-2" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" style="overflow:auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default text-white" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="lesson_preview" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true" data-bs-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="title"></h5>
                <button type="button" class="btn btn-secondary ms-auto py-0 px-2" data-bs-dismiss="modal" aria-hidden="true" onclick="player.pause();">&times;</button>
            </div>
            <div class="modal-body" style="overflow:auto;">
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function confirm_modal(delete_url)
{
    jQuery('#modal-4').modal('show', {backdrop: 'static'});
    document.getElementById('delete_link').setAttribute('href' , delete_url);
}
</script>

<!-- (Normal Modal)-->
<div class="modal fade" id="modal-4">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">

            <div class="modal-header">
                <h5 class="modal-title text-center"><?php echo site_phrase('are_you_sure'); ?> ?</h5>
                <button type="button" class="btn btn-outline-secondary px-1 py-0" data-bs-dismiss="modal" aria-hidden="true"><i class="fas fa-times-circle"></i></button>
            </div>


            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="" class="btn btn-danger btn-yes" id="delete_link"><?php echo site_phrase('yes');?></a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo site_phrase('no');?></button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
function async_modal() {
    const asyncModal = new Promise(function(resolve, reject){
        $('#modal-4').modal('show');
        $('#modal-4 .btn-yes').click(function(){
            resolve(true);
        });
        $('#modal-4 .btn-cancel').click(function(){
            resolve(false);
        });
    });
    return asyncModal;
}
</script>

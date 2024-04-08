<form class="required-form ajaxForm" action="<?php echo site_url('admin/shortcut_enrol_student'); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_id_short"><?php echo get_phrase('user'); ?><span class="required">*</span> </label>
        <select class="form-control server-side-select3" name="user_id" id="user_id_short" action="<?php echo site_url('admin/get_select2_user_data'); ?>" required>
            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
        </select>
    </div>

    <div class="form-group">
        <label for="course_id_short"><?php echo get_phrase('course_to_enrol'); ?><span class="required">*</span> </label>
        <select class="form-control server-side-select3" name="course_id" id="course_id_short" action="<?php echo site_url('admin/get_select2_course_for_enroll'); ?>" required>
            <option value=""><?php echo get_phrase('select_a_course'); ?></option>
        </select>
    </div>
    <button type="button" class="btn btn-primary float-right" onclick="checkRequiredFields()"><?php echo get_phrase('enrol_student'); ?></button>
</form>

<script type="text/javascript">
    if($('select').hasClass('select2') == true){
        $('div').attr('tabindex', "");
        $(function(){$(".select2").select2()});
    }

    $(".ajaxForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(response)
           {    
            var myArray = jQuery.parseJSON(response);
                if(myArray['status']){
                    location.reload();
                }else{
                    error_notify(myArray['message']);
                }
           }
        });
    });

    $(function(){
        $(".server-side-select3").each(function() {
            var actionUrl = $(this).attr('action');
            $(this).select2({
                ajax: {
                    url: actionUrl,
                    dataType: 'json',
                    delay: 500,
                    data: function (params) {
                        return {
                            searchVal: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    }
                },
                placeholder: 'Search',
                minimumInputLength: 1,
            });
        });
    });
</script>  
<form action="<?php echo site_url('admin/sections/'.$param2.'/add'); ?>" method="post">
    <div class="form-group">
        <label for="title"><?php echo get_phrase('title'); ?></label>
        <input class="form-control" type="text" name="title" id="title" required>
        <small class="text-muted"><?php echo get_phrase('provide_a_section_name'); ?></small>
    </div>

    <!-- <div class="form-group mb-3">
        <label><?php echo get_phrase('Date of study plan'); ?> <small class="text-muted">(<?php echo get_phrase('Optional'); ?>)</small></label>
        <input type="text" name="date_range_of_study_plan" class="form-control date date-range-with-time" data-toggle="date-picker" data-time-picker="true" data-locale="{'format': 'DD/MM hh:mm A'}">

    </div>

    <div class="form-group mb-3">
        <label><?php echo get_phrase('Restriction of study plan'); ?></label>

        <br>
        <input type="radio" id="is_restricted_no" value="" name="restricted_by" checked> <label for="is_restricted_no"><?php echo get_phrase('No restriction'); ?></label>

        <br>
        <input type="radio" id="is_restricted_start_date" value="start_date" name="restricted_by"> <label for="is_restricted_start_date"><?php echo get_phrase('Until the start date, keep this section locked'); ?></label>

        <br>
        <input type="radio" id="is_restricted_date_range" value="date_range" name="restricted_by"> <label for="is_restricted_date_range"><?php echo get_phrase('Keep this section open only within the selected date range'); ?></label>

    </div> -->

    <div class="text-right">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>


<!-- <script type="text/javascript">
    $(function() {
        'use strict';
        $('.date-range-with-time').daterangepicker({
            timePicker: true,
            startDate: '<?php echo date('m/d/y 00:00:00'); ?>',
            endDate: '<?php echo date('m/d/y 00:00:00'); ?>',
            locale: {
                format: 'M/DD/YY hh:mm A'
            }
        });
    });
</script> -->

<style type="text/css">
    .calendar-time select{
        color: #787878 !important;
    }
</style>
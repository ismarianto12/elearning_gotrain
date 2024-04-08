<?php
    $course_details = $this->crud_model->get_course_by_id($param3)->row_array();
    $section_details = $this->crud_model->get_section('section', $param2)->row_array();
?>
<form action="<?php echo site_url('admin/sections/'.$param3.'/edit/'.$param2); ?>" method="post">
    <div class="form-group">
        <label for="title"><?php echo get_phrase('title'); ?></label>
        <input class="form-control" type="text" name="title" id="title" value="<?php echo $section_details['title']; ?>" required>
        <small class="text-muted"><?php echo get_phrase('provide_a_section_name'); ?></small>
    </div>

    <!-- <div class="form-group mb-3">
        <label><?php echo get_phrase('Date of study plan'); ?> <small class="text-muted">(<?php echo get_phrase('Optional'); ?>)</small></label>
        <input type="text" name="date_range_of_study_plan" class="form-control date date-range-with-time" data-toggle="date-picker" data-time-picker="true" data-locale="{'format': 'DD/MM hh:mm A'}">

    </div>

    <div class="form-group mb-3">
        <label><?php echo get_phrase('Restriction of study plan'); ?></label>

        <br>
        <input type="radio" id="is_restricted_no" value="" name="restricted_by" <?php if(!$section_details['restricted_by']) echo 'checked'; ?>> <label for="is_restricted_no"><?php echo get_phrase('No restriction'); ?></label>

        <br>
        <input type="radio" id="is_restricted_start_date" value="start_date" name="restricted_by" <?php if($section_details['restricted_by'] == 'start_date') echo 'checked'; ?>> <label for="is_restricted_start_date"><?php echo get_phrase('Until the start date, keep this section locked'); ?></label>

        <br>
        <input type="radio" id="is_restricted_date_range" value="date_range" name="restricted_by" <?php if($section_details['restricted_by'] == 'date_range') echo 'checked'; ?>> <label for="is_restricted_date_range"><?php echo get_phrase('Keep this section open only within the selected date range'); ?></label>

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
            startDate: '<?php echo date('m/d/y H:i:s', $section_details['start_date']); ?>',
            endDate: '<?php echo date('m/d/y H:i:s', $section_details['end_date']); ?>',
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        });
    });
</script> -->

<style type="text/css">
    .calendar-time select{
        color: #787878 !important;
    }
</style>
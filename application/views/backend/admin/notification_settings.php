<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('website_notification'); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">


                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item">
                        <a href="#smtpSettings" data-toggle="tab" aria-expanded="<?php  echo $tab == 'smtp-settings' ? 'true':'false'; ?>" class="nav-link rounded-0 <?php  echo $tab == 'smtp-settings' ? 'active':''; ?>">
                            <i class="mdi mdi-router-wireless-settings mr-1"></i>
                            <span><?php echo site_phrase('SMTP Settings'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#emailTemplate" data-toggle="tab" aria-expanded="<?php  echo $tab == 'email-template' ? 'true':'false'; ?>" class="nav-link rounded-0 <?php  echo $tab == 'email-template' ? 'active':''; ?>">
                            <i class="mdi mdi mdi-email-plus-outline mr-1"></i>
                            <span><?php echo site_phrase('Email template'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#notification" data-toggle="tab" aria-expanded="<?php  echo $tab == 'notification' ? 'true':'false'; ?>" class="nav-link rounded-0 <?php  echo $tab == 'notification' ? 'active':''; ?>">
                            <i class="mdi mdi-bell-plus-outline mr-1"></i>
                            <span><?php echo get_phrase('Notification'); ?></span>
                        </a>
                    </li>
                </ul>

                <?php $notify_settings = $this->db->get('notification_settings')->result_array();?>
                <div class="tab-content">
                    <div class="tab-pane <?php  echo $tab == 'smtp-settings' ? 'show active':''; ?>" id="smtpSettings">
                        <h4 class="mb-3 header-title"><?php echo get_phrase('SMTP settings');?></h4>
                        <div class="row">
                            <div class="col-md-7">
                                <form class="required-form" action="<?php echo site_url('admin/notification_settings/smtp_settings'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="smtp_protocol"><?php echo get_phrase('protocol'); ?> <small>(smtp or ssmtp or mail)</small><span class="required">*</span></label>
                                        <input type="text" name = "protocol" id = "smtp_protocol" class="form-control" value="<?php echo get_settings('protocol');  ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_crypto"><?php echo get_phrase('smtp_crypto'); ?> <small>(ssl or tls)</small><span class="required">*</span></label>
                                        <input type="text" name = "smtp_crypto" id = "smtp_crypto" class="form-control" value="<?php echo get_settings('smtp_crypto');  ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_host"><?php echo get_phrase('smtp_host'); ?><span class="required">*</span></label>
                                        <input type="text" name = "smtp_host" id = "smtp_host" class="form-control" value="<?php echo get_settings('smtp_host');  ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_port"><?php echo get_phrase('smtp_port'); ?><span class="required">*</span></label>
                                        <input type="text" name = "smtp_port" id = "smtp_port" class="form-control" value="<?php echo get_settings('smtp_port');  ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_from_email"><?php echo get_phrase('smtp_from_email'); ?><span class="required">*</span></label>
                                        <input type="text" name = "smtp_from_email" id = "smtp_from_email" class="form-control" value="<?php echo get_settings('smtp_from_email');  ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_user"><?php echo get_phrase('smtp_username'); ?><span class="required">*</span></label>
                                        <input type="text" name = "smtp_user" id = "smtp_user" class="form-control" value="<?php echo get_settings('smtp_user');  ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="smtp_pass"><?php echo get_phrase('smtp_password'); ?><span class="required">*</span></label>
                                        <input onfocus="$(this).attr('type', 'text');" onblur="$(this).attr('type', 'password');" type="password" name = "smtp_pass" id = "smtp_pass" class="form-control" value="<?php echo get_settings('smtp_pass');  ?>" required>
                                    </div>

                                    <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase('save'); ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane <?php  echo $tab == 'email-template' ? 'show active':''; ?>" id="emailTemplate">

                        <div class="table-responsive-sm mt-4">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo get_phrase('Email type'); ?></th>
                                        <th><?php echo get_phrase('Email subject'); ?></th>
                                        <th><?php echo get_phrase('Email template'); ?></th>
                                        <th><?php echo get_phrase('Action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($notify_settings as $key => $notification_row) :?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td>
                                                <h5><?php echo $notification_row['setting_title'] ?></h5>
                                                <p><?php echo $notification_row['setting_sub_title'] ?></p>
                                            </td>
                                            <td>
                                                <?php foreach(json_decode($notification_row['subject'], true) as $user_type => $subject): ?>
                                                    <p><?php echo get_phrase('To '.$user_type); ?>: <?php echo $subject; ?></p>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <?php foreach(json_decode($notification_row['template'], true) as $user_type => $template): ?>
                                                    <p><?php echo get_phrase('To '.$user_type); ?>: <?php echo $template; ?></p>
                                                <?php endforeach; ?>
                                            </td>
                                            <td>
                                                <a onclick="showRightModal('<?php echo site_url('admin/edit_email_template/'.$notification_row['id']); ?>', '<?php echo nl2br($notification_row['setting_title']) ?>')" class="btn btn-primary btn-rounded" href="javascript:;" data-toggle="tooltip" title="<?php echo get_phrase('Edit email template'); ?>" style="min-width: 40px;"><i class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane <?php  echo $tab == 'notification' ? 'show active':''; ?>" id="notification">
                        <h4 class="mb-3 header-title"><?php echo get_phrase('Configure your notification settings');?></h4>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                foreach($notify_settings as $row):
                                    if(!empty($row['addon_identifier']) && !addon_status($row['addon_identifier'])){
                                        continue;
                                    }
                                    $system_notification = json_decode($row['system_notification'], true);
                                    $email_notification = json_decode($row['email_notification'], true);
                                    ?>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="m-0 p-0">
                                                <?php echo get_phrase($row['setting_title']); ?>
                                                <?php if($row['is_editable'] != 1): ?>
                                                    <small class="text-warning"><b>(<?php echo get_phrase('Not editable'); ?>)</b></small>
                                                <?php endif; ?>
                                            </label>
                                            <p class="text-muted mb-1"><small><?php echo get_phrase($row['setting_sub_title']); ?></small></p>
                                        </div>
                                        <?php foreach(json_decode($row['user_types'], true) as $user_type): ?>
                                            <div class="col-auto">
                                                <small class="text-muted"><?php echo get_phrase('Configure for '.$user_type); ?></small>
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo $row['id'].$user_type; ?>_system" <?php if($system_notification[$user_type]) echo 'checked' ?> <?php if($row['is_editable'] != 1) echo 'disabled'; ?>>
                                                    <label onclick="notification_enable_disable('<?php echo $row['id']; ?>', '<?php echo $user_type; ?>', 'system')" class="custom-control-label text-muted text-14" for="<?php echo $row['id'].$user_type; ?>_system"><?php echo get_phrase('System notification'); ?></label>
                                                </div>
                                            
                                                <div class="custom-control custom-switch mb-2">
                                                    <input type="checkbox" class="custom-control-input" id="<?php echo $row['id'].$user_type; ?>_email" <?php if($email_notification[$user_type]) echo 'checked' ?> <?php if($row['is_editable'] != 1) echo 'disabled'; ?>>
                                                    <label onclick="notification_enable_disable('<?php echo $row['id']; ?>', '<?php echo $user_type; ?>', 'email')" class="custom-control-label text-muted text-14" for="<?php echo $row['id'].$user_type; ?>_email"><?php echo get_phrase('Email notification'); ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div>
    </div>
</div>




<script type="text/javascript">
  $(document).ready(function () {
    initSummerNote(['#about_us', '#terms_and_condition', '#privacy_policy', '#cookie_policy', '#refund_policy']);
  });



  function notification_enable_disable(id, user_type, notification_type){
    var input_val = $('#'+id+user_type+'_'+notification_type).prop('checked');
    if(!input_val){
        input_val = 1;
    }else{
        input_val = 0;
    }
    $.ajax({
        type: "POST",
        url: '<?php echo site_url('admin/notification_settings/notification_enable_diable'); ?>',
        data: {id:id, user_type:user_type, notification_type:notification_type, input_val:input_val},
        success: function(response){
            if(response){
                success_notify(response);
            }
        }
    });
  }
</script>



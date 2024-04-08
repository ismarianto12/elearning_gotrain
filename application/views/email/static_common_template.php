<!DOCTYPE html>
<html>
<head>
  <title><?php echo $subject; ?></title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">
  <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">

    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 20px;">
      <img src="<?= base_url('uploads/system/'.get_frontend_settings('dark_logo')); ?>" alt="Website Logo" width="250" height="auto">
    </div>

    <!-- Email subject -->
    <h1 style="color: #333333; font-size: 25px; text-align: center; margin-bottom: 20px;"><?php echo $subject; ?></h1>

    <!-- Email body -->
    <!-- Start and end hidden div are needed for tracking system notification. SO don't remove -->
    <div class="system_notification_start" style="display: none;"></div>
    <div><?php echo $message; ?></div>
    <div class="system_notification_end" style="display: none;"></div>

    <!-- Email footer -->
    <p style="text-align: center; margin-top: 40px; color: #999999; font-size: 14px;">&copy; <?= date('Y') ?> <?= get_settings('system_name'); ?>. All rights reserved.</p>
  </div>
</body>
</html>

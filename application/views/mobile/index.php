<!DOCTYPE html>
<html>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo get_settings('system_name'); ?></title>

	<?php include 'includes_top.php'; ?>
</head>

<body>
	<div class="container-fluid">
		<!-- HEADER -->
		<?php include $page_name . '.php'; ?>
	</div>
	<!-- all the js files -->
	<?php include 'includes_bottom.php'; ?>
	<?php include 'payment_model.php'; ?>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<title><?php echo APP_NAME ?> | <?php echo $page_title; ?></title>

	<!-- <link rel="icon" type="image/ico" href="<?php echo base_url() ?>assets/images/favicon.ico" /> -->
	<link rel="shortcut icon" type="image/ico" href="<?php echo base_url() ?>assets/images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-icons/entypo/css/entypo.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-icons/font-awesome/css/font-awesome.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-theme.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-forms.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/skins/white.css?ver=<?php echo DO_NO_CACHE; ?>">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/parsley.css">
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js?ver=<?php echo DO_NO_CACHE; ?>"></script>

</head>
<body class="page-body login-page login-form-fall" >

	<!-- This is needed when you send requests via Ajax -->
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		<?php if($this->input->get("return_url")){ ?>
			var temp = '<?php echo $this->input->get("return_url"); ?>';
			base_url+=temp;
		<?php } ?>
		</script>
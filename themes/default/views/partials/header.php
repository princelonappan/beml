<meta charset="utf-8" />
<title>Login Page - BEML Admin</title>

<meta name="description" content="User login page" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!--basic styles-->

<link href="<?php echo base_url("assests/css/bootstrap.min.css"); ?>" rel="stylesheet" />
<link href="<?php echo base_url("assests/css/bootstrap-responsive.min.css"); ?>" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url("assests/css/font-awesome.min.css"); ?>" />

<!--[if IE 7]>
  <link rel="stylesheet" href="assests/css/font-awesome-ie7.min.css" />
<![endif]-->

<!--page specific plugin styles-->

<!--fonts-->

<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />-->

<!--ace styles-->

<link rel="stylesheet" href="<?php echo base_url("assests/css/ace.min.css"); ?>" />
<link rel="stylesheet" href="<?php echo base_url("assests/css/ace-responsive.min.css"); ?>" />
<link rel="stylesheet" href="<?php echo base_url("assests/css/ace-skins.min.css"); ?>" />
<link rel="stylesheet" href="<?php echo base_url("assests/css/style.css"); ?>" />
<!--[if lte IE 8]>
  <link rel="stylesheet" href="assests/css/ace-ie.min.css" />
<![endif]-->

<!--inline styles related to this page-->
<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url("assests/js/jquery-2.0.3.min.js"); ?>'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assests/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo base_url("assests/js/jquery.mobile.custom.min.js"); ?>'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url("assests/js/bootstrap.min.js"); ?>"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="<?php echo base_url("assests/js/ace-elements.min.js"); ?>"></script>
		<script src="<?php echo base_url("assests/js/ace.min.js"); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url("assests/js/jquery.validate.min.js"); ?>"></script>
                <script src="<?php echo base_url("assests/js/common_js.js"); ?>"></script>
		<!--inline scripts related to this page-->

		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
		</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!DOCTYPE html>
<!--
	This is a starter template page. Use this page to start your new project from
	scratch. This page gets rid of all links and provides the needed markup only.
	-->
<html>
	<head>
		<?php
			ob_start();
			include "f_check_cookie.php";
			ob_end_clean();
			?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Watch_Dog | Dashboard</title>
		
		<!-- Site icon -->
		<link rel="icon" href="img/system_icon.ico">
		
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		  <!-- bootstrap slider -->
		<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">
		
		
		
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
			page. However, you can choose any other skin. Make sure you
			apply the skin class to the body tag so the changes take effect. -->
		<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js rdoesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?>  sidebar-mini">
		<div class="wrapper">
			<?php
				$fn = basename($_SERVER['PHP_SELF']);
				include 'menu.php';
			?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Dashbord
						<small>หน้าแผงควบคุมและสรุป</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Dashbord</a></li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<!-- left column -->
						
					</div>

						
						
						
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<!-- Main Footer -->
			<?php
				include "footer.php";
			?>
			<!-- Add the sidebar's background. This div must be placed
				immediately after the control sidebar -->
		</div>
		<!-- ./wrapper -->
		<!-- REQUIRED JS SCRIPTS -->
		<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- ChartJS -->
		<script src="dist/chartjs/Chart.js"></script>
		<script src="dist/chartjs/utils.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
// Global var  =========================================





// Page function ========================================= 

$("#sidebar_search_text" ).keyup(function() {
  var search_target = $(this).val();
  if (search_target.trim() == "")
  {
	  $("#sidebar_search_wd_result").html("");
  }
  else
  {
		var add_data = {}
		add_data['f'] = '5';
		add_data['search_text'] = search_target;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			//data = data.replace(search_target,'<font color="red">'+search_target+'</font>');
			//alert (data)
			 $("#sidebar_search_wd_result").html(data);
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
  
});

$("#sidebar_search_text_case" ).keyup(function() {
  var search_target = $(this).val();
  if (search_target.trim() == "")
  {
	  $("#sidebar_search_case_result").html("");
  }
  else
  {
		var add_data = {}
		add_data['f'] = '6';
		add_data['search_text'] = search_target;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			//data = data.replace(search_target,'<font color="red">'+search_target+'</font>');
			//alert (data)
			 $("#sidebar_search_case_result").html(data);
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
  
});

$('body').on('click', '#toggle_sb_bt', function() {
	var add_data = {}
	add_data['f'] = '16';
	add_data['staff_key_id'] = '<?php echo $staff_key_id;?>';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	});
});





// Initial Run ========================================= 



});

	</script>
	</body>
</html>
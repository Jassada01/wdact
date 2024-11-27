<!DOCTYPE html>
<!--
	This is a starter template page. Use this page to start your new project from
	scratch. This page gets rid of all links and provides the needed markup only.
	-->
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Watch_Dog | Vote Result</title>
		
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
		
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		
		<!-- Sweet Alert -->
	   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
		
		<!-- J-ui css-->
        <link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
		
		<!-- crop style -->
			<link rel="stylesheet" href="dist/css/cropstyle.css">
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
			
			
			
					<style>
			.delete_personal_skill:hover { 
				color: #dd0000;
				cursor: pointer;
			}
			
			
			</style>
	</head>
	<body class="hold-transition skin-blue sidebar-collapse  sidebar-mini">
		<div class="wrapper">
		
		<?php
				$token = $_GET['token'];
				$event_id = $_GET['event_id'];
		?>
		
		
		
		<header class="main-header">
	<!-- Logo -->
	<a href="#" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>WD</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>Watch_Dog</b></span>
	</a>
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" id="toggle_sb_bt" class="sidebar-toggle" data-toggle="push-menu" role="button" style="display: none">
		<span class="sr-only">Toggle navigation</span>
		</a>

	</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p></p>
				<a href="#"><i class="fa fa-circle text-success"></i></a>
			</div>
		</div>

		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
			
		
		
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1 id="trainning_name">
						
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						
						<div class="col-xs-12">
							<!-- Profile Image -->
							
							<!-- Profile Image -->
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title"><span id="event_name"></span>   <small id="event_time"></small></h3>
								</div>
								<div class="box-body">
									<div class="col-sm-4">
										<p>
											<strong>ผลโหวต</strong>
										</p>
										<Table class="table table-striped">
											<TR>
												<TH>ตัวเลือก</TH>
												<TH>คะแนนรวม</TH>
											</TR>
											<Tbody id="result_table">
											</Tbody>
										</Table>
									</div>
									<div class="col-sm-8">
										<div  id="chart_panel"  style="display: none;">
											<div id="canvas-holder">
												<canvas id="chart_result"></canvas>
											</div>
										</div>
									</div>
								</div>
								
								
								
							</div>
							<!-- /.box -->

						</div>
						<!-- /.col -->
					</div>

				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<!-- Main Footer -->
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
		<!--QRCode -->
		<script src="plugins/QRCode/jquery.qrcode.js"></script>
		<script src="plugins/QRCode/qrcode.js"></script>
		
		
		<!-- Moment with Local -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>
		
		<!-- bootstrap tab -->
		  <script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
		  
		  <!-- ChartJS -->
		<script src="bower_components/chart.js/src27/Chart.bundle.js"></script>
		<script src="bower_components/chart.js/src27/utils.js"></script>
		  
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
// Global var  =========================================
moment.locale('th');

var token = "<?php echo $token;?>";


var EVENT_ID = '<?php echo $event_id; ?>';
var TOTAL_WD_JOIN = 1;

// Initial Object ========================================




// Function ========================================

function get_event_hdr()
{
	var add_data = {}
	add_data['f'] = '32';
	add_data['event_id'] = EVENT_ID;
	add_data['token'] = token;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_user_profile.php',
		data: (add_data)
	})
	.done(function(data) {
		if (data != "[]")
		{
			var ojb = JSON.parse(data);
			$("#trainning_name").html(ojb[0].Training_subject + "<small>"+ojb[0].location+"</small>")
			$("#event_name").html(ojb[0].event_name)
			$("#event_time").html(moment(ojb[0].start, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm') + " - " + moment(ojb[0].end, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm'));
			get_vote_table();
			chart_create();
			setInterval(function(){  
				get_vote_table();
				chart_create();
			}, 3000);
		}
		
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_vote_table()
{
	var add_data = {}
	add_data['f'] = '33';
	add_data['event_id'] = EVENT_ID;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_user_profile.php',
		data: (add_data)
	})
	.done(function(data) {
		if (data != "[]")
		{
			var data_arr = JSON.parse(data);
			print_text = "";
			jQuery.each( data_arr, function( i, val ) {
				print_text +="<TR>";
				print_text +="<TD>"+val.value+"</TD>";
				print_text +="<TD><B>"+val.cnt+"</B></TD>";
				print_text +="<TR>";
			});
			
			$("#result_table").html(print_text);
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


// Initial 	
var chart_result = document.getElementById('chart_result').getContext('2d');
var config = {
		type: 'pie',
		data: {
			datasets: [{
				data: [32, 18],
				backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
				label: 'Dataset 1'
			}],
			labels: [
				'TEST',
				'TEST2'
			]
		},
		options: {
			animation: false,
			responsive: true,
			legend: {
					position: 'right',
				}
		}
	};
window.pie_data = new Chart(chart_result, config);

function chart_create()
{
	var add_data = {}
	add_data['f'] = '34';
	add_data['event_id'] = EVENT_ID;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_user_profile.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		if (data != "[]")
		{
			var chrt_data = [];
			var chrt_value = [];
			
			var data_arr = JSON.parse(data);
			jQuery.each( data_arr, function( i, val ) {
				chrt_data.push(val.option_value_1)
				chrt_value.push(val.cnt)
			});
			
			
			var config = {
				type: 'pie',
				data: {
					datasets: [{
						data: chrt_value,
						backgroundColor: ['#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000'
						],
						label: 'Dataset 1'
					}],
					labels: chrt_data
				},
				options: {
					animation: false,
					responsive: true,
					legend: {
							position: 'right',
						}
				}
			};
			window.pie_data.destroy();
			window.pie_data = new Chart(chart_result, config);
			
			$( "#chart_panel" ).show();
			
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


// Initial Run ========================================= 
//get_address_for_select();
get_event_hdr()
});

	</script>
	</body>
</html>
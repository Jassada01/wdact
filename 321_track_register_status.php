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
		<title>Watch_Dog | Track register Status</title>
		
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
		
		<!-- Sweet Alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
		
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
				$event_id = $_GET['event_id'];
				
			?>
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
						<!-- left column -->
						<div class="col-md-12">
							<div class="box  box-primary">
								<div class="box-header with-border">
									<h3 class="box-title"><span id="event_name"></span>   <small id="event_time"></small></h3>
								</div>
								
								<div class="box-body">
									<div class="row">
										<div class="col-md-8">
											<Table class="table table-striped">
												<tr>
													<th style="width: 10px">#</th>
													<th>ชื่อ - นามสกุล</th>
													<th>ชื่อเล่น</th>
													<th>รุ่น</th>
													<th>โทร</th>
													<th>สถานะ</th>
													<th>เวลาที่ลงทะเบียน</th>
												</tr>
												<tbody id="event_table_list">
												</tbody>
											</Table>
										</div>
										<div class="col-md-4">
											<p class="text-center">
												<strong>สถิติ</strong>
											</p>

											<div class="progress-group">
												<span class="progress-text">ยอดผู้ลงทะเบียนแล้ว</span>
												<span class="progress-number"><b id="wd_checkin_cnt"></b>/<span id="all_wd_join"></span></span>

												<div class="progress sm" id="checkin_progress">
													
												</div>
											</div>
											<!-- /.progress-group -->

										</div>
									</div>
								</div>
								
								
							 </div>
						</div>
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
		<!-- Moment with Local -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
// Global var  =========================================

moment.locale('th');

var EVENT_ID = '<?php echo $event_id; ?>';
var TOTAL_WD_JOIN = 1;

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

function get_event_hdr()
{
	var add_data = {}
	add_data['f'] = '46';
	add_data['event_id'] = EVENT_ID;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		var ojb = JSON.parse(data);
		$("#trainning_name").html(ojb[0].Training_subject + "<small>"+ojb[0].location+"</small>")
		TOTAL_WD_JOIN = ojb[0].count_join_wd;
		$("#all_wd_join").html(TOTAL_WD_JOIN);
		$("#event_name").html(ojb[0].event_name)
		$("#event_time").html(moment(ojb[0].start, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm') + " - " + moment(ojb[0].end, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm'));
		
		// Load table
		get_table_data();
		setInterval(function(){  get_table_data(); }, 3000);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_table_data()
{
	//alert ("zzzz");
	var add_data = {}
	add_data['f'] = '47';
	add_data['event_id'] = EVENT_ID;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		var Check_in_CNT = 0;
		var data_arr = JSON.parse(data);
		print_text = "";
		jQuery.each( data_arr, function( i, val ) {
			print_text +="<TR>";
			print_text +="<TD>"+(i+1)+".</TD>";
			print_text +="<TD>"+val.name + " " + val.s_name+"</TD>";
			print_text +="<TD>"+val.n_name + "</TD>";
			print_text +="<TD>"+val.gen + "</TD>";
			print_text +="<TD>"+val.tel + "</TD>";
			
			if (val.time_stmp == null)
			{
				print_text +="<TD><font color='#ff8080'><B>ยังไม่เช็คอิน</B></font></TD>";
				print_text +="<TD></TD>";
			}
			else
			{
				Check_in_CNT = Check_in_CNT + 1;
				print_text +="<TD><font color='#00cc00'><B>เช็คอินแล้ว</B></font></TD>";
				print_text +="<TD>"+moment(val.time_stmp, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm')+"</TD>";
			}
			
			print_text +="</TR>";
		});
		
		$("#event_table_list").html(print_text);
		$("#wd_checkin_cnt").html(Check_in_CNT);
		
		var cal_pct = (Check_in_CNT / TOTAL_WD_JOIN) * 100;
		$("#checkin_progress").html('<div class="progress-bar progress-bar-aqua" style="width: '+cal_pct+'%"></div>');
		
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}




// Initial Run ========================================= 
	get_event_hdr();


});

	</script>
	</body>
</html>
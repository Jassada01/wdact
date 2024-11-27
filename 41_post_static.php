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
		<title>Watch_Dog | Post Static</title>
		
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
		<!-- daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<!-- bootstrap datepicker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		
		
		
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
			.div_select_page:hover 
			{
				background-color: #dddddd;
				cursor: pointer;
			}
			
			.post_data_type4click:hover 
			{
				cursor: pointer;
			}

		</style>
	</head>
	<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?>  sidebar-mini">
		<div class="wrapper">
			<?php
				$fn = basename($_SERVER['PHP_SELF']);
				include 'menu.php';
				$ini_post_id = '';
				if (isset($_GET['post_id']) )
				{
					$ini_post_id = $_GET['post_id'];
				}
			?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Post Static
						<small>ข้อมูลทางสถิติของ Post</small>
					</h1>
					<ol class="breadcrumb">
						<button type="button" class="btn btn-box-tool" id="export_to_excel_btn"><i class="fa fa-cloud-upload"></i> Export Data</button>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
									
					<div class="row" id="row_post_static"  style="display: none">
						<div class="col-sm-4">
							<div class="col-sm-12">
								<div class="box  box-danger">
									<div class="box-header">
										<h3 class="box-title">ข้อมูล</h3>
									</div>
								<!-- /.box-header -->
									<div class="box-body">
										<div id="post_msg_v1">
										</div>
									</div>
									<div class="overlay" style="display: none" id="post_data_ovl">
										<i class="fa fa-refresh fa-spin"></i>
									</div>
									
								<!-- /.box-body -->
								</div>
								<!-- /.box -->
							</div>
							<div class="col-sm-12">
								<div class="box  box-info">
									<div class="box-header">
										<h3 class="box-title">เคสในระบบที่เกียวข้อง</h3>
									</div>
								<!-- /.box-header -->
									<div class="box-body" id="relate_case_list">
									</div>
								<!-- /.box-body -->
								</div>
							</div>
						</div>
						<div class="col-sm-8">
							<div class="box  box-danger">
								<div class="box-header">
									<h3 class="box-title">สถิติ</h3>
									<div class="box-tools">
										<div class="input-group input-group-sm" style="width: 250px;">
											<span class="input-group-addon"><i class="fa fa-search"></i></span>
											<input type="text" id="post_search_2" class="form-control pull-right" placeholder="ค้นหา">
										</div>
									</div>
								</div>
							<!-- /.box-header -->
								<div class="box-body">
									<div id="div_search_result_upper" class="col-sm-12"  style="height:200px;display: none;overflow:auto;">
										
									</div>
									<div id="div_static_show_case" class="col-sm-12">
										<div class="col-sm-4 col-xs-12  post_data_type4click"  value="post_activity">
											<div class="info-box bg-aqua">
												<span class="info-box-icon"><i class="fa fa-comments"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><b>เรื่องราวที่เกิดจากโพส</b></span>
													<span class="info-box-number"><span  id="S_post_activity"></span> <small>ครั้ง</small></span>
												</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-12 post_data_type4click"   value="post_clicks">
											<div class="info-box bg-green">
												<span class="info-box-icon"><i class="fa fa-hand-pointer-o"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><B>โพสถูกคลิก</B></span>
													<span class="info-box-number"><span  id="S_post_clicks"></span> <small>ครั้ง</small></span>
													<span class="progress-description">
														จาก <span id="S_post_clicks_unique"></span> คน
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-12 post_data_type4click"  value="post_engaged_users">
											<div class="info-box bg-purple">
												<span class="info-box-icon"><i class="fa fa-keyboard-o"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><B>มีส่วนร่วมต่อโพส</B></span>
													<span class="info-box-number"><span  id="S_post_engaged_users"></span> <small>คน</small></span>
													<span class="progress-description">
														เฉพาะ fanpage <span id="S_post_engaged_fan"></span> คน
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-12 post_data_type4click"  value="post_impressions">
											<div class="info-box bg-blue">
												<span class="info-box-icon"><i class="fa fa-facebook-square"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><B>โพสปรากฏบนฟีด</B></span>
													<span class="info-box-number"><span  id="S_post_impressions"></span> <small>ครั้ง</small></span>
													<span class="progress-description">
														จาก <span id="S_post_impressions_unique"></span> คน
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-12 post_data_type4click"  value="post_impressions_viral">
											<div class="info-box bg-maroon">
												<span class="info-box-icon"><i class="fa fa-exchange"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><B>ปฏิสัมพันธ์ปรากฏบนฟีด</B></span>
													<span class="info-box-number"><span  id="S_post_impressions_viral"></span> <small>ครั้ง</small></span>
													<span class="progress-description">
														จาก <span id="S_post_impressions_viral_unique"></span> คน
													</span>
												</div>
											</div>
										</div>
										<div class="col-sm-4 col-xs-12 post_data_type4click" value="post_negative_feedback">
											<div class="info-box bg-red">
												<span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span>
												<div class="info-box-content">
													<span class="info-box-text"><B>ผลตอบกลับเชิงลบ</B></span>
													<span class="info-box-number"><span  id="S_post_negative_feedback"></span> <small>ครั้ง</small></span>
													<span class="progress-description">
														จาก <span id="S_post_negative_feedback_unique"></span> คน
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="box-header">
											<h4 class="box-title"><i class="fa  fa-fire"></i> <span id="data_type_current_post_title"></span></h4>
											<button type="button" class="btn btn-box-tool btn_change_type_of_data" value="total"><i class="fa fa-share-alt"></i></button>
											<button type="button" class="btn btn-box-tool btn_change_type_of_data" value="user"><i class="fa fa-users"></i></button>
											<font color="#999999"><h5  id="data_type_current_post_desc"></h5></font>
										</div>
										<div class="box-body">
											<div id="chart_div_post_static" style="height:400px;"></div>
										</div>
									</div>
								</div>
							<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
						
					</div>
					<div class="row" id="row_post_main">
						<!-- left column -->
						<div class="col-sm-6">
						  <div class="box  box-danger">
							<div class="box-header">
							  <h3 class="box-title">โพสยอดฮิตในรอบเดือน</h3><BR>
							</div>
							<!-- /.box-header -->
							<div class="box-body"  style="height: 450px; overflow-y: auto;">
							<div class="users-list clearfix" id="best_post_list">
							</div>
							</div>
							<!-- /.box-body -->
						  </div>
						  <!-- /.box -->
						</div>
						
						<div class="col-sm-6">
						  <div class="box  box-success">
							<div class="box-header">
								<h3 class="box-title">โพสทั้งหมด</h3><BR>
								<div class="box-tools">
									<div class="input-group input-group-sm" style="width: 250px;">
										<span class="input-group-addon"><i class="fa fa-search"></i></span>
										<input type="text" id="post_search" class="form-control pull-right" placeholder="ค้นหา">
									</div>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body"  style="height: 450px; overflow-y: auto;">
							<div class="col-sm-12" id="last_post_list">
							</div>
							</div>
							<!-- /.box-body -->
						  </div>
						  <!-- /.box -->
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="modal_export_data">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title"><i class="fa fa-cloud-upload"></i> Export Data</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-6">
											<button type="button" class="btn btn-default pull-left" id="daterange_btn_export_data">
												<span>
													<i class="fa fa-calendar"></i> เลือกช่วงเวลา
												</span>
												<i class="fa fa-caret-down"></i>
											</button>
										</div>
										<div class="col-sm-6" id="download_excel_result">
											<button type="button" class="btn btn-primary pull-right" id="btn_create_excel"><i class="fa fa-file-excel-o"></i> Create Excel</button>
										</div>
									</div>
									
								</div>
								<div class="modal-footer">
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
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
		<!-- Amcharts  JS-->
		<script src="plugins/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="plugins/amcharts/serial.js" type="text/javascript"></script>
		
		<!-- Animate_number -->
		<script src="plugins/animate_number/jquery.animateNumber.min.js"></script>
		
		<!-- Moment with Local -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>

		<!-- date-range-picker -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
// Initial Setting component ============================================================

// Moment Setting
moment.locale('th');
	
	
	
	
// Global var  =========================================
var ini_post_id = "<?php echo $ini_post_id; ?>";

var current_post_target = "";
var current_post_static_target = "post_impressions";
var current_post_static_target_unq = "_unique";
var search_result_count = 7;



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

function get_best_post()
{
	var add_data = {}
	add_data['f'] = '6';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		
		var print_text = "";
		$.each( ojb, function( key, data_arr ) {
			msg = data_arr.msg.substring(0, 60);
			if (data_arr.msg.length > 60)
			{
				msg += "...";
			}
			
			if (String(data_arr.img_src) == "")
			{
				data_arr.img_src = "img/wd_img/default.png";
			}
			
			print_text += '<div class="col-md-6">';
			print_text += '<div class="info-box div_select_page" id="select_post_clicked" value="'+data_arr.post_id+'">';
			print_text += '<img class="info-box-icon img-circle" src="'+data_arr.img_src+'" height="85" width="85">';
			print_text += '<div class="info-box-content">';
			print_text += '<span class="info-box-number"><small>'+msg+'</small></span>';
			print_text += '<B><i class="fa fa-users"></i><font color="red"> '+data_arr.value_str+'</B></font><Br>';
			print_text += '</div>';
			print_text += '</div>';
			print_text += '</div>';
		});
		//last_member_list
		$('#best_post_list').html(print_text);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_lasted_post(search_target = "", target_div="#last_post_list")
{
	//alert (search_target)
	var add_data = {}
	add_data['f'] = '7';
	add_data['target'] = search_target;
	add_data['result_cnt'] = search_result_count;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		//console.log(ojb)
		var print_text = "";
		$.each( ojb, function( key, data_arr ) {
			msg = data_arr.msg.substring(0, 60);
			
			if (data_arr.msg.length > 60)
			{
				msg += "...";
			}
			
			print_text += '<div class="col-md-6">';
			print_text += '<div class="info-box div_select_page" id="select_post_clicked" value="'+data_arr.post_id+'">';
			if (String(data_arr.img_src) == "")
			{
				print_text += '<img class="info-box-icon" src="img/wd_img/default.png" height="85" width="85">';
			}
			else
			{
				print_text += '<img class="info-box-icon" src="'+data_arr.img_src+'" height="85" width="85">';
			}
			print_text += '<div class="info-box-content">';
			print_text += '<span class="info-box-number"><small>'+msg+'</small></span>';
			
			// Cal date
			var now = moment(new Date()); //todays date
			var end = moment(data_arr.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
			var duration = moment.duration(now.diff(end));
			var diff_days = duration.asDays();
			
			if (diff_days <= 7.0)
			{
				print_text += '<small><font color="#aaaaaa">'+moment(data_arr.pub_time, "YYYY-MM-DD hh:mm:ss").calendar()+'</font></small><br>';
			}
			else
			{
				print_text += '<small><font color="#aaaaaa">'+moment(data_arr.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm')+'</font></small><br>';
			}
			
			//print_text += '<span class="info-box-text">'+moment(data_arr.pub_time).format('D MMMM YYYY HH:mm')+'</span>';
			print_text += '</div>';
			print_text += '</div>';
			print_text += '</div>';
		});
		if (search_target == "")
		{
			print_text += '<div class="col-md-6"><button type="button" class="btn btn-sm bg-primary pull-right" id="add_more_search_result"><i class="fa fa-plus"></i></button></div>';
		}
		
		//last_member_list
		$(target_div).html(print_text);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


// When Select post =============================================
$('body').on('click', '#select_post_clicked', function() {
		var target = ($(this).attr('value'));
		
		// Set Value
		current_post_target = target;
		current_post_static_target = "post_impressions";
		current_post_static_target_unq = "_unique";
		
		
		//$("#row_post_main").hide();
		$("#row_post_static").show();
		$("#div_static_show_case").show();
		$("#div_search_result_upper").hide();
		$("#post_search_2" ).val("");
		get_post_data(target);
		get_post_static(target);
		get_post_static_chart();
		get_relate_case_list(target)
});

// Search
$("#post_search" ).keyup(function() {
  get_lasted_post($(this).val());
});

// Search
$("#post_search_2" ).keyup(function() {
  var search_target = $(this).val();
  if (search_target.trim() != "")
  {
	  $("#div_search_result_upper").show("fast");
	  $("#div_static_show_case").hide("fast");
	  get_lasted_post(search_target,"#div_search_result_upper")
  }
  else
  {
	  $("#div_static_show_case").show("fast");
	  $("#div_search_result_upper").hide("fast");
  }
});




function get_post_data(post_id_target)
{
	//$("#post_msg_v1").html('<i class="fa fa-refresh fa-spin"></i> Loading...');
	$("#post_data_ovl").show();
	var add_data = {}
	add_data['f'] = '59';
	add_data['target'] = post_id_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_1_case.php',
		data: (add_data)
	})
	.done(function(data) {
		var data_ojb = JSON.parse(data);
		var header_text = (data_ojb.message.split('\n')[0]);
		if(header_text.length > 40) 
		{
			header_text = header_text.substring(0,40) + "...";
		}
		
		var print_all_msg = data_ojb.message.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		while (print_all_msg.indexOf("\n") > 0)
		{
			//alert (print_all_msg.indexOf("\n"))
			print_all_msg = print_all_msg.replace("\n", "<br>&nbsp;&nbsp;&nbsp;");
		}
		
		// Cal_star
		var star_text = "";
		
		for (i=0;i< Math.floor(data_ojb.post_star) ; i++)
		{
			star_text += '<i class="fa  fa-star"></i>';
		}
		if ((data_ojb.post_star % 1) > 0)
		{
			star_text += '<i class="fa  fa-star-half"></i>';
		}
		
		var print_text = "";
		print_text += '<Table>';
		print_text += '<TR>';
		print_text += '<TD>';
		if (data_ojb.picture == null)
		{
			print_text += '<img src="img/wd_img/default.png" class="img-circle" height="150" width="150">';
		}
		else
		{
			print_text += '<img src="'+data_ojb.picture+'" class="img-circle" height="150" width="150">';
		}
		//print_text += '<img src="'+data_ojb.picture+'" height="120" width="120">';
		print_text += '</TD>';
		print_text += '<TD style="padding: 5px;">';
		print_text += '<B><a href="'+data_ojb.target_url+'" target="_blank">'+header_text+'</a><Br>';
		
		
		// Cal date
		var now = moment(new Date()); //todays date
		var end = moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
		var duration = moment.duration(now.diff(end));
		var diff_days = duration.asDays();
		
		if (diff_days <= 7.0)
		{
			print_text += '<small><font color="#aaaaaa">'+moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").calendar()+'</font></small><br>';
		}
		else
		{
			print_text += '<small><font color="#aaaaaa">'+moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm')+'</font></small><br>';
		}
		
		print_text += '<B><font color="red">'+star_text+'</B></font><Br>';
		
		
		if ( data_ojb.post_impressions_unique == null)
		{
			print_text += '<B><i class="fa fa-users"></i><font color="red">-</B></font><Br>';
		}
		else
		{
			print_text += '<B><i class="fa fa-users"></i><font color="red"> '+data_ojb.post_impressions_unique+'</B></font><Br>';
		}
		
		print_text += '<b><i class="fa fa-comment-o"></i> '+data_ojb.comment+' <i class="fa fa-share"></i> '+data_ojb.shares+'</B><Br>';
		
		if ( data_ojb.post_reactions_like == null)
		{
			print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i>-</span> ';
		}
		else
		{
			print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i> '+data_ojb.post_reactions_like+'</span> ';
		}
		
		if ( data_ojb.post_reactions_love == null)
		{
			print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ -</span>  ';
		}
		else
		{
			print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ '+data_ojb.post_reactions_love+'</span>  ';
		}
		
		if ( data_ojb.post_reactions_haha == null)
		{
			print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  -</span> ';
		}
		else
		{
			print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  '+data_ojb.post_reactions_haha+'</span> ';
		}
		
		if ( data_ojb.post_reactions_wow == null)
		{
			print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 -</span>  ';
		}
		else
		{
			print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 '+data_ojb.post_reactions_wow+'</span>  ';
		}
		
		if ( data_ojb.post_reactions_sorry == null)
		{
			print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 -</span> ';
		}
		else
		{
			print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 '+data_ojb.post_reactions_sorry+'</span> ';
		}
		
		if ( data_ojb.post_reactions_anger == null)
		{
			print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  -</span>';
		}
		else
		{
			print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  '+data_ojb.post_reactions_anger+'</span>';
		}
		
		print_text += '</TD>';
		print_text += '</TR>';
		print_text += '</Table>';
		print_text += '<h5 class="widget-user-desc post_desc break-word" value = "'+encodeURIComponent(data_ojb.message)+'">'+print_all_msg+'</h5>';
		$("#post_msg_v1").html(print_text);
		$("#post_data_ovl").hide();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_post_static(post_id_target)
{
	//alert (post_id_target);
	var add_data = {}
	add_data['f'] = '8';
	add_data['post_id'] = post_id_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		var ojb = JSON.parse(data);
		var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
		$.each( ojb, function( key, data_arr ) {
			//$("#S_"+data_arr.f_name).html(data_arr.value_str);
			$("#S_"+data_arr.f_name).animateNumber(
			  {
				number: data_arr.value,
				numberStep: comma_separator_number_step
			  }
			);
			
		});
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_post_static_chart()
{
	//alert (current_post_target);
	var add_data = {}
	add_data['f'] = '9';
	add_data['post_id'] = current_post_target;
	add_data['data_target'] = current_post_static_target + current_post_static_target_unq;
	get_datatype_desc(current_post_static_target + current_post_static_target_unq);
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		// Receive Data
		if (typeof post_static_chart !== 'undefined') {
				post_static_chart.clear();
			}
		if (data == "[]")
		{
			$("#chart_div_post_static").html("<H4><font color='red'>**ไม่มีข้อมูล Hot zone</font></H4>")
		}
		else
		{
			var ojb_chart_data = JSON.parse(data);
			var like_chart_minPeriod_value = "15mm";
			
			post_static_chart = new AmCharts.AmSerialChart();
			post_static_chart.dataProvider = ojb_chart_data;
			post_static_chart.marginLeft = 10;
			post_static_chart.dataDateFormat = "YYYY-MM-DD JJ:NN:SS";
			post_static_chart.categoryField = "time_stmp";
			
			var categoryAxis = post_static_chart.categoryAxis;
			categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
			categoryAxis.minPeriod = like_chart_minPeriod_value; // our data is yearly, so we set minPeriod to YYYY
			categoryAxis.dashLength = 3;
			categoryAxis.minorGridEnabled = true;
			categoryAxis.minorGridAlpha = 0.1;
			
			
			
			// second value axis (on the right)
		   var valueAxis2 = new AmCharts.ValueAxis();
		   valueAxis2.position = "right"; // this line makes the axis to appear on the right
		   valueAxis2.axisColor = "#99ccff";
		   valueAxis2.dashLength = 1;
		   post_static_chart.addValueAxis(valueAxis2);
		   
		   
			// value
			var valueAxis = new AmCharts.ValueAxis();
			valueAxis.axisColor = "#d1655d";
			valueAxis.dashLength = 1;
			post_static_chart.addValueAxis(valueAxis);
			
			
			
			
			
			// GRAPH
			var graph = new AmCharts.AmGraph();
			graph.valueAxis = valueAxis; // we have to indicate which value axis should be used
			graph.valueField = "diff_value";
			graph.balloonText = "เพิ่มขึ้น : <b><span style='font-size:14px;'>[[value]]</span></b>";
			graph.fillColors = "#66b3ff";
			graph.type = "column";
			//graph.animationPlayed =  true;
			graph.lineAlpha = 0;
			graph.fillAlphas = 0.5;
			
			// GRAPH
			graph2 = new AmCharts.AmGraph();
			graph2.valueAxis = valueAxis2; // we have to indicate which value axis should be used
			graph2.type = "line"; // this line makes the graph smoothed line.
			//graph2.type = "smoothedLine"; // this line makes the graph smoothed line.
			graph2.lineColor = "#d1655d";
			graph2.lineThickness = 2;
			graph2.animationPlayed =  true;
			graph2.valueField = "value";
			graph2.dashLengthField = "dashLengthLine";
			graph2.balloonText = "<b><span style='font-size:14px;'>[[value]]</span></b>";
			post_static_chart.addGraph(graph2);
			
			
			
			
			// SCROLLBAR
			var chartScrollbar = new AmCharts.ChartScrollbar();
			post_static_chart.addChartScrollbar(chartScrollbar);
			
			// Animation
			post_static_chart.startEffect = "elastic";
			post_static_chart.startDuration = 1;
			post_static_chart.addGraph(graph);
			
			// CURSOR
			var chartCursor = new AmCharts.ChartCursor();
			chartCursor.cursorAlpha = 0;
			chartCursor.cursorPosition = "mouse";
			chartCursor.categoryBalloonDateFormat = "DD MMM JJ:NN";
			post_static_chart.addChartCursor(chartCursor);
			
			
			// WRITE
			post_static_chart.write("chart_div_post_static");
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});

}

//post_data_type4click
$('body').on('click', '.post_data_type4click', function() {
	var target = ($(this).attr('value'));
	current_post_static_target = target;
	current_post_static_target_unq = "";
	get_post_static_chart();
});

//btn_change_type_of_data
$('body').on('click', '.btn_change_type_of_data', function() {
	var target = ($(this).attr('value'));
	var not_value_value = ['post_activity','post_reactions_haha', 'post_reactions_like', 'post_reactions_love', 'post_reactions_anger', 'post_reactions_sorry'];
	if (not_value_value.indexOf(current_post_static_target) < 0)
	{
		current_post_static_target_unq = "";
		if (target == "user")
		{
			if (current_post_static_target == "post_engaged_users")
			{
				current_post_static_target = "post_engaged_fan";
				current_post_static_target_unq = "";
			}
			else if  (current_post_static_target == "post_engaged_fan")
			{
				current_post_static_target_unq = "";
			}
			else
			{
				current_post_static_target_unq = "_unique";
			}
		}
		else
		{
			if (current_post_static_target == "post_engaged_fan")
			{
				current_post_static_target = "post_engaged_users";
				current_post_static_target_unq = "";
			}
			else if  (current_post_static_target == "post_engaged_users")
			{
				current_post_static_target_unq = "";
			}
			else
			{
				current_post_static_target_unq = "";
			}
			
		}
		//alert (current_post_static_target + current_post_static_target_unq)
		get_post_static_chart();
	}
});

function get_datatype_desc(data_type)
{
	//alert (data_type);
	var add_data = {}
	add_data['f'] = '10';
	add_data['data_type'] = data_type;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		var ojb = JSON.parse(data);
		$("#data_type_current_post_title").html(ojb[0].show_name)
		$("#data_type_current_post_desc").html(ojb[0].Full_Desc)
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_relate_case_list(target)
{
	//alert (data_type);
	var add_data = {}
	add_data['f'] = '11';
	add_data['post_id'] = target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		if (data == "[]")
		{
			$("#relate_case_list").html('<H5><font color="red">**ยังไม่ได้จับคู่โพสนี้กับเคสในระบบ</font></H5>');
		}
		else
		{
			var ojb = JSON.parse(data);
			var print_text = "";
			$.each( ojb, function( key, data_arr ) {
				print_text += '<div class="product-info">';
				print_text += '<a href="14_case_data.php?case_id='+data_arr.case_id+'" class="product-title"><B>' + data_arr.topic+"</B>";
				print_text += '<span class="label label-primary pull-right">'+data_arr.case_id+'</span></a><Br>';
				print_text += '<span class="product-description"><font color="#999999">';
				print_text += data_arr.t_sum+'</font>';
				print_text += '</span>';
				print_text += '</div>';								
			});
			$("#relate_case_list").html(print_text);
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function initial_if_pass_value()
{
	if (ini_post_id != "")
	{
		// Set Value
		target=ini_post_id;
		current_post_target = target;
		current_post_static_target = "post_impressions";
		current_post_static_target_unq = "_unique";
		
		//$("#row_post_main").hide();
		$("#row_post_static").show();
		$("#div_static_show_case").show();
		$("#div_search_result_upper").hide();
		$("#post_search_2" ).val("");
		get_post_data(target);
		//alert (current_post_target)
		get_post_static(target);
		get_post_static_chart();
		get_relate_case_list(target)
	}
}


//add_more_search_result
$('body').on('click', '#add_more_search_result', function() {
	search_result_count += 10;
	get_lasted_post();
	
	
});

//export_to_excel_btn
$("#export_to_excel_btn").click(function() {
	$("#download_excel_result").html('<button type="button" class="btn btn-primary pull-right" id="btn_create_excel"><i class="fa fa-file-excel-o"></i> Create Excel</button>');
	$('#modal_export_data').modal('show');
});

//daterange_btn_export_data
$('#daterange_btn_export_data').daterangepicker(
  {
	ranges   : {
	  //'วันนี้'       : [moment(), moment()],
	  'เมื่อวาน'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	  '7 วันล่าสุด' : [moment().subtract(6, 'days'), moment()],
	  '30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
	  'เดือนนี้'  : [moment().startOf('month'), moment().endOf('month')],
	  'เดือนที่ผ่านมา'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
	  '3 เดือนที่ผ่านมา'  : [moment().subtract(3, 'month'), moment()],
	  'ปีนี้'  : [moment().startOf('year'), moment().endOf('year')]
	},
	startDate: moment().startOf('month'),
	endDate  : moment().endOf('month')
  },
  function (start, end) {
	$('#daterange_btn_export_data span').html(start.format(' D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'))
	//get_heatmap();
  }
);
$('#daterange_btn_export_data span').html($('#daterange_btn_export_data').data('daterangepicker').startDate.format(' D MMMM YYYY') + " - " + $('#daterange_btn_export_data').data('daterangepicker').endDate.format(' D MMMM YYYY'));



//btn_create_excel
	$('body').on('click', '#btn_create_excel', function() {
	$("#download_excel_result").html('<font size="14"><i class="fa fa-refresh fa-spin pull-right"></i></font>');
	var start_date = $('#daterange_btn_export_data').data('daterangepicker').startDate.format(' YYYY-MM-DD');
	var end_date = $('#daterange_btn_export_data').data('daterangepicker').endDate.format(' YYYY-MM-DD 23:59');
	
	var add_data = {}
	add_data['f'] = '32';
	add_data['start_date'] = start_date;
	add_data['end_date'] = end_date;
	
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#download_excel_result").html(data);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});

// Initial Run ========================================= 

get_best_post();
get_lasted_post();

get_post_static_chart();
initial_if_pass_value();

});

	</script>
	</body>
</html>
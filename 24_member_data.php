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
		<title>Watch_Dog | ข้อมูลสมาชิก</title>
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
		<!-- crop style -->
		<link rel="stylesheet" href="dist/css/cropstyle.css">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
			page. However, you can choose any other skin. Make sure you
			apply the skin class to the body tag so the changes take effect. -->
		<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
		
		  <!-- Sweet Alert -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
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
				$wd_id = $_GET['wd_id'];
				?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						ข้อมูลสมาชิกหมาเฝ้าบ้าน
					</h1>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-3">
							<!-- Profile Image -->
							<div class="box box-primary">
								<div class="box-header">
									<span id="trash_panel" style="display: none;"><font color="red"><i class="fa fa-trash"></i> </font></span> <h3 class="box-title" id="wd_status_show"></h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" id="btn_add_bin"><i class="fa fa-trash"></i></button>
										<button type="button" class="btn btn-box-tool" id="btn_edit_data"><i class="fa fa-pencil"></i> แก้ไข</button>
										<button type="button" class="btn btn-box-tool" id="btn_show_access_token"><i class="fa fa-qrcode"></i> Access Token</button>
										<a type="button" class="btn btn-box-tool" id="btn_next_wd"><i class="fa fa-chevron-right"></i> </a>
									</div>
								</div>
								<div class="box-body box-profile">
									<div id="access_qr_code_panel" style="display: none" >
										<div id="access_qr_code" align="center"></div>
											<div  align="center"><input type="text" id="code_link_text" ></input>
												<button type="button" id="copy_code_link_text" class="btn" ><i class="fa fa-qrcode"></i> Copy Link</button>
											</div>
											<div  align="center">
												<button type="button" id="reset_password" class="btn btn-danger" ><i class="fa fa-qrcode"></i> Reset password</button>
											</div>
									</div>
									<img class="profile-user-img img-responsive img-circle" src="img/wd_img/default.png" id = "member_img" alt="User profile picture">
									<h3 class="profile-username text-center" id="m_info_nick_name"><font color="#ffffff">.</font></h3>
									<p class="text-muted text-center" id="m_info_name"><font color="#ffffff">.</font></p>
									<ul class="list-group list-group-unbordered" id="main_info_item_list">
									</ul>
									
								</div>
								
								
								<!-- /.box-body -->
								<div class="overlay" id="ovl_load_main_data">
									<i class="fa fa-refresh fa-spin"></i>
								</div>
							</div>
							<!-- /.box -->
							<!-- About Me Box -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลทั่วไป</h3>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
									<p class="text-muted" id="address_text"> </p>
									<hr>
									<strong><i class="fa fa-graduation-cap margin-r-5"></i> อาชีพและการศึกษา</strong>
									<p class="text-muted"  id="occ_text"></p>
									<hr>
									<strong><i class="fa fa-pencil margin-r-5"></i> ทักษะ</strong>
									<p id="skill_data_text"></p>
									<hr>
									<strong><i class="fa fa-street-view margin-r-5"></i>สังกัดทีม</strong>
									<p id="team_data_text"></p>
									<hr>
									<strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
									<p id="note_text"></p>
								</div>
								<!-- /.box-body -->
								<div class="overlay" id="ovl_load_basic_data">
									<i class="fa fa-refresh fa-spin"></i>
								</div>
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
						<div class="col-md-9">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li  class="active"><a href="#activity" data-toggle="tab">กิจกรรม</a></li>
									<li><a href="#timeline" data-toggle="tab">ไทม์ไลน์</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="activity">
										<div class="row">
											<div class="col-sm-4">
												<div class="info-box bg-aqua">
													<span class="info-box-icon "><span id="score_total">0</span></span>
													<div class="info-box-content">
														<span class="info-box-text"><B>ส่งเรื่อง : </B><span id="score_send">0</span> <small>คะแนน</small></span>
														<span class="info-box-text"><B>รุม : </B><span id="score_support">0</span> <small>คะแนน</small></span>
														<span class="info-box-text"><B>ทีม : </B><span id="score_team">0</span> <small>คะแนน</small></span>
													</div>
													<!-- /.info-box-content -->
												</div>
												<!-- /.info-box -->
											</div>
											<!-- /.col -->
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="box box-primary">
													<div class="box-header">
														<h3 class="box-title"><b>เรื่องที่ส่ง</b></h3>
													</div>
													<!-- /.box-header -->
													<div class="box-body no-padding" id="case_send_list_panel_box" style="overflow:auto;height:300px;">
														<div  class="col-sm-12">
															<ul class="products-list product-list-in-box" id="case_send_list_panel">
																
															</ul>
														</div>
													</div>
													<!-- /.box-body -->
												</div>
												<!-- /.box -->
											</div>
											
											<div class="col-sm-12">
												<div class="box box-info">
													<div class="box-header">
														<h3 class="box-title"><b>เรื่องที่ช่วยรุม</b></h3>
													</div>
													<!-- /.box-header -->
													<div class="box-body no-padding" id="case_support_list_panel_box" style="overflow:auto;height:300px;">
														<div  class="col-sm-12">
															<ul class="products-list product-list-in-box" id="case_support_list_panel">
																
															</ul>
														</div>
													</div>
													<!-- /.box-body -->
												</div>
												<!-- /.box -->
											</div>
											
											<div class="col-sm-12">
												<div class="box box-success">
													<div class="box-header">
														<h3 class="box-title"><b>เรื่องที่ทีมช่วยรุม</b></h3>
													</div>
													<!-- /.box-header -->
													<div class="box-body no-padding" id="case_team_support_list_panel_box" style="overflow:auto;height:300px;">
														<div  class="col-sm-12">
															<ul class="products-list product-list-in-box" id="case_team_support_list_panel">
																
															</ul>
														</div>
													</div>
													<!-- /.box-body -->
												</div>
												<!-- /.box -->
											</div>
											
											<div class="col-sm-12">
												<div class="box box-danger">
													<div class="box-header">
														<h3 class="box-title"><b>งานอบรมที่เข้าร่วม</b></h3>
													</div>
													<!-- /.box-header -->
													<div class="box-body no-padding">
														<div  class="col-sm-12">
															<table class="table table-striped">
																<tr>
																	<th style="width: 10px">#</th>
																	<th>การอบรม</th>
																	<th>ประเภท</th>
																	<th>วันที่อบรม</th>
																</tr>
																<TBody id="table_training_list">
																</TBody>
															</Table>
														
														
														</div>
													</div>
													<!-- /.box-body -->
												</div>
												<!-- /.box -->
											</div>
										</div>
									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="timeline">
										<!-- The timeline -->
										<ul class="timeline" id="timeline_data">
										</ul>
									</div>
									<!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							</div>
							<!-- /.nav-tabs-custom -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
					<div class="modal fade" id="modal_add_img">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">เพิ่มรูปสมาชิก</h4>
								</div>
								<div class="modal-body">
									<div class="imageBox">
										<div class="thumbBox"></div>
										<div class="spinner" style="display: none">Loading...</div>
									</div>
									<div class="action ">
										<span class="btn btn-file" id="btn_img">
										<font color="#D81B60"><i class="fa fa-image"></i> เลือกรูป</font> <input type="file" id="file" accept="image/*">
										</span>
										<input type="button" id="btnZoomIn" class="btn btn-primary pull-right" value="+">
										<input type="button" id="btnZoomOut" class="btn btn-primary pull-right" value="-">
									</div>
								</div>
								<div class="modal-footer">
									<input type="button" id="btnCrop" class="btn btn-success pull-right" value="ตกลง">
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
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
		
		<!--QRCode -->
		<script src="plugins/QRCode/jquery.qrcode.js"></script>
		<script src="plugins/QRCode/qrcode.js"></script>
		
		<!-- Moment with Local -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<!--  cropbox-->
		<script src="dist/js/cropbox.js"></script>
		<script>
			$(document).ready(function(){
			
			// Global var ==============================================
			
			
			// Initial Function and Var ==============================================
			// Moment Setting
			moment.locale('th');
			
			
				
				
				
				
			//Page Function ==============================================
				// Add traning on click
				
				
			// Crop box =========================
				$( "#member_img" ).click(function() {
					$('#modal_add_img').modal('show');
				});
				var options =
				{
					thumbBox: '.thumbBox',
					spinner: '.spinner',
					imgSrc: 'avatar.png'
				}
				var cropper = $('.imageBox').cropbox(options);
				$('#file').on('change', function(){
				var reader = new FileReader();
				reader.onload = function(e) {
					options.imgSrc = e.target.result;
					cropper = $('.imageBox').cropbox(options);
				}
				reader.readAsDataURL(this.files[0]);
				this.files = [];
				})
				$('#btnCrop').on('click', function(){
					var img = cropper.getDataURL();
				   // $('.cropped').append('<img src="'+img+'">');
					 $('#member_img').attr('src', img);
					 $('#modal_add_img').modal('hide');
				})
				$('#btnZoomIn').on('click', function(){
					cropper.zoomIn();
				})
				$('#btnZoomOut').on('click', function(){
					cropper.zoomOut();
				})
			
			
			
			
			
			//btn_edit_data =========================
			$( "#btn_edit_data" ).click(function() {
					//window.open('22_member-edit.php?id=<?php  echo $wd_id;?>', '_blank');
					var win = window.open('22_member-edit.php?id=<?php  echo $wd_id;?>', '_blank');
  win.focus();
			});
			
			
			
				
			// Load WD_Data
			function load_wd_data()
			{
				var add_data = {}
				add_data['f'] = '20';
				add_data['wd_id'] = "<?php  echo $wd_id;?>";
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_2_member.php',
					data: (add_data)
				})
				.done(function(data) {
					//alert (data);
					var ojb = JSON.parse(data);
					
					// Output
					$("#wd_status_show").html(ojb.status_string);
					$('#member_img').attr('src', "img/wd_img/"+ojb.wd_img);
					
					
					//  + ojb.sex_text
					
					$("#m_info_nick_name").html(ojb.n_name);
					$("#m_info_name").html(ojb.name + " " + ojb.s_name + " " + ojb.sex_text);
					
					//                
					
					var item_main_list_text = '<li class="list-group-item"><b id="gen_taxt">รุ่นที่ '+ojb.gen+'</b> <span class="pull-right" id="age_text">อายุ '+ojb.age+' ปี</span> </li>';
					
					item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Facebook</b> <span class="pull-right" id="age_text"><a href="https://www.facebook.com/search/people/?q='+ojb.soc_fb+'" target="_blank">'+ojb.soc_fb+'</a></span> </li>';
					
					if (ojb.soc_fb_2.trim() != "")
					{
						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Facebook_2</b> <span class="pull-right" id="age_text"><a href="https://www.facebook.com/search/people/?q='+ojb.soc_fb_2+'" target="_blank">'+ojb.soc_fb_2+'</a></span> </li>';
					}
					
					item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">เบอร์โทร</b> <span class="pull-right" id="age_text">'+ojb.tel+'</span> </li>';
					if (ojb.tel_2.trim() != "")
					{
						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">เบอร์โทรสำรอง</b> <span class="pull-right" id="age_text">'+ojb.tel_2+'</span> </li>';
					}
					
					item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">อีเมล</b> <span class="pull-right" id="age_text">'+ojb.email+'</span> </li>';
					
					if (ojb.soc_line.trim() != "")
					{
						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Line</b> <span class="pull-right" id="age_text">'+ojb.soc_line+'</span> </li>';
					}
					
					if (ojb.soc_twitter.trim() != "")
					{
						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Twitter</b> <span class="pull-right" id="age_text">'+ojb.soc_twitter+'</span> </li>';
					}
					
					$("#main_info_item_list").html(item_main_list_text);
					//$("#age_text").html("อายุ " + ojb.age + " ปี");
					$( "#ovl_load_main_data" ).hide();
				})
				.fail(function() {
					// just in case posting your form failed
					alert("Posting failed.");
				});
			}
			
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
			
			
			// Load WD_Data
			function load_basic_wd_data()
			{
				var add_data = {}
				add_data['f'] = '21';
				add_data['wd_id'] = "<?php  echo $wd_id;?>";
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_2_member.php',
					data: (add_data)
				})
				.done(function(data) {
					//alert (data);
					var ojb = JSON.parse(data);
					
					$("#address_text").html(ojb.all_address_text);
					$("#occ_text").html("<B>อาชีพ : </B>"+ojb.occ_text + "<BR><B>การศึกษา : </B>"+ojb.education);
					$("#note_text").html(ojb.note);
					$("#team_data_text").html(ojb.team_data);
					$("#skill_data_text").html(ojb.personal_skill_data + ojb.team_skill_data);
			
					$( "#ovl_load_basic_data" ).hide();
				})
				.fail(function() {
					// just in case posting your form failed
					alert("Posting failed.");
				});
			}
			
			//btn_edit_data
			//$( "#btn_edit_data" ).click(function() {
			//		window.location.replace('22_member-edit.php?id=<?php  echo $wd_id;?>');
			//});
			
			
			// Load WD_Data
			function get_timeline_data()
			{
				var add_data = {}
				add_data['f'] = '23';
				add_data['wd_id'] = "<?php  echo $wd_id;?>";
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_2_member.php',
					data: (add_data)
				})
				.done(function(data) {
					//alert (data)
					$("#timeline_data").html(data);
				})
				.fail(function() {
					// just in case posting your form failed
					alert("Posting failed.");
				});
			}
			
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
			
			
			function get_wd_send_case_data()
			{
				var add_data = {}
					add_data['f'] = '25';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status= "";
						text_color = "";
						jQuery.each( data_arr, function( i, val ) {
							
							switch(val.status) {
								case "0":
									text_status= '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status= '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status= '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status= '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status= '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status= '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status= '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status= '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status= '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status= "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "")
							{
								case_link_in_cnt = '"'+val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';		
							if (val.status == "5")
							{
								print_text += '<a href="'+val.post_link+'" target="_blank"><img src="'+val.img+'" alt="Product Image"></a>';		
							}
							else
							{
								print_text += '<img src="'+val.img+'" alt="Product Image">';		
							}		
							print_text += '</div>';					
							print_text += ' <div class="product-info">';					
							print_text += '<a href='+case_link_in_cnt+' class="product-title">' + val.print_case_id+' : '+val.topic+'</a>';					
							print_text += '<span class="label '+text_color+' pull-right">'+text_status+'</span>';					
							print_text += '<span class="product-description">';					
							print_text += val.t_sum;					
							print_text += '</span>';					
							print_text += '</div>';					
							print_text += '</li>';					

						});
						$("#case_send_list_panel").html(print_text);
						if (data == "[]")
						{
							$("#case_send_list_panel_box").css("height", "50px");
							$("#case_send_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			function get_wd_support_case_data()
			{
				var add_data = {}
					add_data['f'] = '26';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						//console.log(data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status= "";
						text_color = "";
						jQuery.each( data_arr, function( i, val ) {
							
							switch(val.status) {
								case "0":
									text_status= '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status= '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status= '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status= '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status= '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status= '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status= '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status= '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status= '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status= "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "")
							{
								case_link_in_cnt = '"'+val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';		
							if (val.status == "5")
							{
								print_text += '<a href="'+val.post_link+'" target="_blank"><img src="'+val.img+'" alt="Product Image"></a>';		
							}
							else
							{
								print_text += '<img src="'+val.img+'" alt="Product Image">';		
							}		
							print_text += '</div>';					
							print_text += ' <div class="product-info">';					
							print_text += '<a href='+case_link_in_cnt+' class="product-title">' + val.print_case_id+' : '+val.topic+'</a>';					
							print_text += '<span class="label '+text_color+' pull-right">'+text_status+'</span>';					
							print_text += '<span class="product-description">';					
							print_text += val.t_sum;					
							print_text += '</span>';					
							print_text += '</div>';					
							print_text += '</li>';					

						});
						$("#case_support_list_panel").html(print_text);
						if (data == "[]")
						{
							$("#case_support_list_panel_box").css("height", "50px");
							$("#case_support_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			function get_wd_team_support_case_data()
			{
				var add_data = {}
					add_data['f'] = '27';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status= "";
						text_color = "";
						jQuery.each( data_arr, function( i, val ) {
							
							switch(val.status) {
								case "0":
									text_status= '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status= '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status= '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status= '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status= '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status= '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status= '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status= '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status= '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status= "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "")
							{
								case_link_in_cnt = '"'+val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';		
							if (val.status == "5")
							{
								print_text += '<a href="'+val.post_link+'" target="_blank"><img src="'+val.img+'" alt="Product Image"></a>';		
							}
							else
							{
								print_text += '<img src="'+val.img+'" alt="Product Image">';		
							}		
							print_text += '</div>';					
							print_text += ' <div class="product-info">';					
							print_text += '<a href='+case_link_in_cnt+' class="product-title">' + val.print_case_id+' : '+val.topic+'</a>';					
							print_text += '<span class="label '+text_color+' pull-right">'+text_status+'</span>';					
							print_text += '<span class="product-description">';					
							print_text += val.t_sum;					
							print_text += '</span>';					
							print_text += '</div>';					
							print_text += '</li>';					

						});
						$("#case_team_support_list_panel").html(print_text);
						if (data == "[]")
						{
							$("#case_team_support_list_panel_box").css("height", "50px");
							$("#case_team_support_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			
			function get_wd_score()
			{
				var add_data = {}
					add_data['f'] = '28';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						var total = 0;
						jQuery.each( data_arr, function( i, val ) {
							if (val.type == "send")
							{
								$("#score_send").html(val.point)
								total += parseInt(val.point);
							}
							if (val.type == "support")
							{
								$("#score_support").html(val.point)
								total += parseInt(val.point);
							}
							if (val.type == "team_sp")
							{
								$("#score_team").html(val.point)
								total += parseInt(val.point);
							}
						});
						
						$("#score_total").html(total);
						
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			
			function get_training_history()
			{
				var add_data = {}
					add_data['f'] = '29';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each( data_arr, function( i, val ) {
							//alert (val.Training_Start)
							print_text += "<TR>";
							print_text += "<TD>"+(i+1)+"</TD>";
							print_text += "<TD>"+val.Training_subject+"</TD>";
							print_text += "<TD>"+val.Training_type+"</TD>";
							print_text += "<TD>"+moment(val.Training_Start, "YYYY-MM-DD").format('D MMMM') + " - "+ moment(val.Training_End, "YYYY-MM-DD").format('D MMMM YYYY') + "</TD>";
							print_text += "</TR>";
							print_text += "";
							
						});
						
						$("#table_training_list").html(print_text)
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			//btn_show_access_token
			$('body').on('click', '#btn_show_access_token', function() {
					$("#access_qr_code_panel").toggle("fast")
					$("#member_img").toggle("fast")
			});
			
			
			function get_token_data()
			{
				var add_data = {}
				add_data['f'] = '30';
				add_data['wd_id'] = "<?php  echo $wd_id;?>";
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_2_member.php',
					data: (add_data)
				})
				.done(function(data) {
					//alert (data);
					jQuery('#access_qr_code').qrcode({
					text : data
				});	
				$("#code_link_text").val(data)
				
			}).fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			
			
			//copy_code_link_text
			$('body').on('click', '#copy_code_link_text', function() {
					//alert ($("#code_link_text").val());
					/* Get the text field */
					  var copyText = document.getElementById("code_link_text");

					  /* Select the text field */
					  copyText.select();

					  /* Copy the text inside the text field */
					  document.execCommand("copy");
					
					swal({
						  position: 'top-end',
						  type: 'success',
						  title: 'Copy Link แล้ว',
						  showConfirmButton: false,
						  timer: 3000
						});
					
					
			});
			
			// reset_password
			$('body').on('click', '#reset_password', function() {

					Swal.fire({
					  title: 'Are you sure?',
					  text: "ต้องการรีเซ็ตรหัสของสมาชิกหรือไม่",
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'ใช่!',
					  cancelButtonText: 'ยกเลิก'
					}).then((result) => {
					  if (result.value) {
						reset_password_process();
					  }
					})
					
					
			});
			
			// Reset Password Function
			function reset_password_process()
			{
				var add_data = {}
				add_data['f'] = '31';
				add_data['wd_id'] = "<?php  echo $wd_id;?>";
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_2_member.php',
					data: (add_data)
				})
				.done(function(data) {
					Swal.fire({
					  type: 'success',
					  allowOutsideClick : false,
					  title: data,
					  text: 'รหัสผ่านใหม่',
					})
				});	
				$("#code_link_text").val(data)
			}
			
			// btn_add_bin
			$('body').on('click', '#btn_add_bin', function() {
				var add_data = {}
					add_data['f'] = '32';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
							swal({
							  position: 'top-end',
							  type: 'success',
							  title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							  showConfirmButton: false,
							  timer: 1000
							});
						load_trash_wd();
					});	
					
			});
			
			function load_trash_wd()
			{
				var add_data = {}
					add_data['f'] = '33';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						//alert(data_arr[0].cnt);
						if (data_arr[0].cnt == "1")
						{
							$("#trash_panel").show()
						}
						else
						{
							$("#trash_panel").hide()
						}
					});	
			}
			
				function load_next_wd()
			{
				var add_data = {}
					add_data['f'] = '34';
					add_data['wd_id'] = "<?php  echo $wd_id;?>";
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						var data_arr = JSON.parse(data);
						$("#btn_next_wd").attr("href", "24_member_data.php?wd_id="+data_arr[0].wd_id)
						//var data_arr = JSON.parse(data);
					});	
			}
			
			
			
			//Initial Run==============================================	
				load_wd_data();
				load_basic_wd_data();
				get_timeline_data();
				get_wd_send_case_data();
				get_wd_support_case_data();
				get_wd_team_support_case_data();
				get_wd_score();
				get_training_history();
				get_token_data();
				load_trash_wd();
				load_next_wd();
				
				
				
				
				
				
				
				
				
				
				
				
			});
					
					
		</script>
	</body>
</html>
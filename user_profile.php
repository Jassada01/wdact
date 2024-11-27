<!DOCTYPE html>
<!--
	This is a starter template page. Use this page to start your new project from
	scratch. This page gets rid of all links and provides the needed markup only.
	-->
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Watch_Dog | Profile</title>

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

	<!-- bootstrap slider -->
	<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

	<!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

	<!-- J-ui css-->
	<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">



	<!-- CROPPER -->
	<link rel="stylesheet" href="plugins/cropper/dist/cropper.css">


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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



	<style>
		input[type='range'] {
			width: 75%;
			height: 50px;
			overflow: hidden;
			cursor: pointer;
		}

		input[type='range'],
		input[type='range']::-webkit-slider-runnable-track,
		input[type='range']::-webkit-slider-thumb {
			-webkit-appearance: none;
		}

		input[type='range']::-webkit-slider-runnable-track {
			width: 200px;
			height: 10px;
			background: #AAA;
		}

		input[type='range']::-webkit-slider-thumb {
			position: relative;
			height: 30px;
			width: 30px;
			margin-top: -10px;
			background: steelblue;
			border-radius: 50%;
			border: 2px solid white;
		}

		input[type='range']::-webkit-slider-thumb::before {
			position: absolute;
			content: '';
			height: 10px;
			/* equal to height of runnable track */
			width: 500px;
			/* make this bigger than the widest range input element */
			left: -502px;
			/* this should be -2px - width */
			top: 8px;
			/* don't change this */
			background: #777;
		}


		/* Limit image width to avoid overflow the container */
		.img_data {
			max-width: 100%;
			/* This rule is very important, please do not ignore this! */
		}



		.delete_personal_skill:hover {
			color: #dd0000;
			cursor: pointer;
		}

		.chip {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 15px;
			line-height: 35px;
			border-radius: 25px;
			background-color: #ccffdd;
		}

		.chip_2 {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 15px;
			line-height: 35px;
			border-radius: 25px;
			background-color: #66b3ff;
		}

		.closebtn {
			padding-left: 10px;
			color: #888;
			font-weight: bold;
			float: right;
			font-size: 20px;
			cursor: pointer;
		}

		.closebtn:hover {
			color: #000;
		}
	</style>
</head>

<body class="hold-transition skin-blue sidebar-collapse  sidebar-mini">
	<div class="wrapper">

		<?php
		$token = $_GET['token'];
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
				<h1>
					Profile
					<small></small>
				</h1>
			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row" style="display: none" id="display_data_panel">
					<!-- left column -->
					<div class="col-lg-12" style="display: none" id="current_event_now_panel">
						<div class="box box-danger ">
							<div class="box-header">
								<h3 class="box-title"><B> กิจกรรมขณะนี้</B></h3>
							</div>
							<div class="box-body">
								<div class="col-xs-12" id="event_now_list">
								</div>
							</div>


							<!-- /.box-body -->
						</div>
					</div>
					<div class="col-lg-3">
						<!-- Profile Image -->

						<!-- Profile Image -->
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title" id="wd_status_show"></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id="btn_edit_data"><i class="fa fa-pencil"></i> แก้ไข</button>
									<button type="button" class="btn btn-box-tool" id="btn_show_access_token"><i class="fa fa-qrcode"></i> Access Token</button>
								</div>
							</div>
							<div class="box-body box-profile">
								<div id="access_qr_code_panel" style="display: none">
									<div id="access_qr_code" align="center"></div>
									<div align="center"><input type="text" id="code_link_text"></input>
										<button type="button" id="copy_code_link_text" class="btn"><i class="fa fa-qrcode"></i> Copy Link</button>
									</div>
								</div>
								<img class="profile-user-img img-responsive img-circle" src="img/wd_img/default.png" id="member_img" alt="User profile picture">
								<h3 class="profile-username text-center" id="m_info_nick_name">
									<font color="#ffffff">.</font>
								</h3>
								<p class="text-muted text-center" id="m_info_name">
									<font color="#ffffff">.</font>
								</p>

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
						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title">คำยินยอมข้อมูลส่วนบุคคล</h3>
							</div>
							<div class="box-body">
								<span><button type="button" class="btn btn-danger  pull-right" id="btn_change_pdpa">แก้ไขคำยินยอมข้อมูลส่วนบุคคล</button></span>
							</div>
						</div>
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">ข้อมูลทั่วไป</h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id="btn_edit_general_data"><i class="fa fa-pencil"></i> แก้ไข</button>
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<strong><i class="fa fa-map-marker margin-r-5"></i> ที่อยู่</strong>
								<p class="text-muted" id="address_text"> </p>
								<hr>
								<strong><i class="fa fa-graduation-cap margin-r-5"></i> อาชีพและการศึกษา</strong>
								<p class="text-muted" id="occ_text"></p>
								<hr>
								<strong><i class="fa fa-pencil margin-r-5"></i> ทักษะ</strong>
								<p id="skill_data_text"></p>
								<p id="person_skill_data_text"></p>
								<form class="form-horizontal">
									<div class="form-group">
										<div class="col-sm-10">
											<div class="input-group">
												<input type="text" class="form-control" id="m_skill" placeholder="ความเชียวชาญ">
												<span class="input-group-btn">
													<button type="button" class="btn btn-success btn-flat" id="m_add_skill"><i class="fa fa-plus"></i> เพิ่ม</button>
												</span>
											</div>
										</div>
									</div>

									<input type="text" style="display: none;" />
								</form>

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
					<div class="col-lg-9">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#activity" data-toggle="tab">กิจกรรม</a></li>
								<li><a href="#timeline" data-toggle="tab">ไทม์ไลน์</a></li>
								<li><a href="#pending_case" data-toggle="tab">เรื่องค้าง</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="activity">
									<div class="row">
										<div class="col-sm-4">
											<div class="info-box bg-aqua" style="display: none">
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
													<div class="col-sm-12">
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
													<div class="col-sm-12">
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
													<div class="col-sm-12">
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
													<div class="col-sm-12">
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
								<div class="tab-pane" id="pending_case">
									<div class="row">
										<div class="col-sm-12">
											<div class="box box-danger">
												<div class="box-header">
													<h3 class="box-title"><b>เรื่องค้างในศูนย์</b></h3>
												</div>
												<!-- /.box-header -->
												<div class="box-body no-padding" style="overflow:auto;height:700px;">
													<div class="col-sm-12">
														<B>ตามประเภทงาน</B>
														<ul class="products-list product-list-in-box" id="pending_type">

														</ul>
													</div>
													<BR>
													<BR>
													<div class="col-sm-12">
														<B>ตามประเภทการทุจริต</B>
														<ul class="products-list product-list-in-box" id="case_pending_by_crp_list">

														</ul>
													</div>
												</div>
												<!-- /.box-body -->
											</div>
											<!-- /.box -->
										</div>
									</div>
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
					<!-- /.col -->
				</div>

				<div class="modal fade" id="modal_password" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">กรุณาใส่ Password</h4>
							</div>
							<div class="modal-body">

								<input type="password" class="form-control" id="login_password" placeholder="Password" autocomplete="off">
								<B><span id="access_result"></span></B>
								</br>


							</div>
							<div class="modal-footer">
								<input type="button" id="login_btn" class="btn btn-primary pull-right" value="ตกลง">
								<a class="btn btn-danger pull-left" href="metro/password-reset.php">ลืมรหัส</a>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>


				<div class="modal fade" id="edit_profile_data">
					<div class="modal-dialog  modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
								<h4 class="modal-title">แก้ไขข้อมูลส่วนบุคคล</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label for="user_name" class="col-sm-3 control-label">ชื่อ<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_name" placeholder="ชื่อ">
										</div>
									</div>

									<div class="form-group">
										<label for="user_sirname" class="col-sm-3 control-label">นามสกุล<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_sirname" placeholder="นามสกุล">
										</div>
									</div>

									<div class="form-group">
										<label for="user_nickname" class="col-sm-3 control-label">ชื่อเล่น<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_nickname" placeholder="ชื่อเล่น">
										</div>
									</div>
									<div class="form-group">
										<label for="user_tel_1" class="col-sm-3 control-label">วดปเกิด<font color='red'>*</font></label>
										<div class="col-sm-6">
											<div class="col-sm-4">
												<select id="e_bd_d" class="form-control" style="width: 100%">
												</select>
											</div>
											<div class="col-sm-4">
												<select id="e_bd_m" class="form-control" style="width: 100%">
												</select>
											</div>
											<div class="col-sm-4">
												<select id="e_bd_y" class="form-control" style="width: 100%">
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="user_tel_1" class="col-sm-3 control-label">เบอร์โทร<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_tel_1" placeholder="เบอร์โทร">
										</div>
									</div>

									<div class="form-group">
										<label for="user_tel_2" class="col-sm-3 control-label">เบอร์โทรสำรอง</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_tel_2" placeholder="เบอร์โทรสำรอง">
										</div>
									</div>

									<div class="form-group">
										<label for="user_email" class="col-sm-3 control-label">Email</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_email" placeholder="Email">
										</div>
									</div>

									<div class="form-group">
										<label for="user_fb_1" class="col-sm-3 control-label">Facebook<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_fb_1" placeholder="Facebook">
										</div>
									</div>

									<div class="form-group">
										<label for="user_fb_2" class="col-sm-3 control-label">Facebook2</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_fb_2" placeholder="Facebook Avatar">
										</div>
									</div>

									<div class="form-group">
										<label for="user_line" class="col-sm-3 control-label">Line</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_line" placeholder="Line ID">
										</div>
									</div>

									<div class="form-group">
										<label for="user_twister" class="col-sm-3 control-label">Twister</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="user_twister" placeholder="Twister ID">
										</div>
									</div>
								</form>


							</div>
							<div class="modal-footer">
								<div class="col-xs-10">
									<input type="button" id="btn_save_main_data" class="btn btn-primary pull-right" value="บันทึกข้อมูล">
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>


				<div class="modal fade" id="edit_profile_data2">
					<div class="modal-dialog  modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
								<h4 class="modal-title">แก้ไขข้อมูลที่อยู่/อาชีพ</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label for="e_address" class="col-sm-3 control-label">ที่อยู่<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="e_address" placeholder="ที่อยู่">
										</div>
									</div>

									<div class="form-group" style="display: none">
										<label for="e_add_code" class="col-sm-3 control-label">ตำบล อำเภอ จังหวัด<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_add_code" style="width: 100%">
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="e_add_province" class="col-sm-3 control-label">จังหวัด<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_add_province" style="width: 100%">
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="e_add_ampher" class="col-sm-3 control-label">อำเภอ<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_add_ampher" style="width: 100%">
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="e_add_district" class="col-sm-3 control-label">ตำบล<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_add_district" style="width: 100%">
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="e_occ" class="col-sm-3 control-label">อาชีพ<font color='red'>*</font></label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="e_occ" placeholder="อาชีพ">
										</div>
									</div>

									<div class="form-group">
										<label for="e_occ_type" class="col-sm-3 control-label">กลุ่มอาชีพ<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_occ_type" style="width: 100%">
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="e_occ_location" class="col-sm-3 control-label">สถานที่ทำงาน</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="e_occ_location" placeholder="สถานที่ทำงาน">
										</div>
									</div>

									<div class="form-group">
										<label for="e_education" class="col-sm-3 control-label">การศึกษา<font color='red'>*</font></label>
										<div class="col-sm-6">
											<select class="select2" id="e_education" style="width: 100%">
											</select>
										</div>
									</div>

								</form>


							</div>
							<div class="modal-footer">
								<div class="col-xs-10">
									<input type="button" id="btn_save_main2_data" class="btn btn-primary pull-right" value="บันทึกข้อมูล">
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>






				<div class="modal fade" id="modal_vote">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="vote_event_name"></h3>
							</div>
							<div class="modal-body">
								<H4>เลือกตัวเลือกที่ต้องการโหวต : </H4>
								<H4>
									<select id="vote_selection">

									</select>
								</H4>

							</div>
							<div class="modal-footer">
								<input type="button" id="confirm_vote" class="btn btn-success pull-right" value="ยืนยันโหวต">
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal modal-default fade" id="modal_cng_pwd" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">เปลี่ยนรหัสผ่าน <small>รหัสผ่านนี้เป็นรหัสผ่านชั่วคราว</small></h4>
							</div>
							<div class="modal-body">

								<form>
									<div class="row">
										<div class="form-group">
											<label for="nw_pass1" class="col-xs-4 control-label">รหัสผ่านใหม่</label>
											<div class="col-xs-6">
												<input type="password" class="form-control" id="nw_pass1">
											</div>
										</div>
									</div>
									<br>
									<div class="row">
										<div class="form-group">
											<label for="nw_pass2" class="col-xs-4 control-label">ยืนยันรหัสผ่านใหม่</label>
											<div class="col-xs-6">
												<input type="password" class="form-control" id="nw_pass2">
											</div>
											<div class="col-xs-2" id="check_chn_password_icon" style="display: none;">
												<BIG>
													<font color="#00a65a"><i class="fa fa-check"></i></font>
												</BIG>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-warning" id="btn-change-Password" disabled>เปลี่ยนรหัสผ่าน</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->





				<div class="modal fade" id="modal_img2">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">แก้ไขรูป</h4>
							</div>
							<div class="modal-body">

								<!-- <h3>Demo:</h3> -->
								<div style="overflow:auto;height:300px;width:300px;">
									<img id="image" src="img/wd_img/default.png" class="img_data" alt="Picture">
								</div>
								<div class="row ">
									<div class="col-lg-12 ">
										<span class="btn btn-file" id="btn_img">
											<font color="#D81B60"><i class="fa fa-image"></i> เลือกรูป</font> <input type="file" id="file" accept="image/*">
										</span>
										<Br>
										<div class="btn-group">
											<button type="button" id="btnZoomIn" class="btn btn-primary"><i class="fa fa-search-plus"></i></button>
											<button type="button" id="btnZoomOut" class="btn btn-primary"><i class="fa fa-search-minus"></i></button>

										</div>
										<div class="btn-group">
											<button type="button" id="btnL" class="btn btn-success"><i class="fa fa-arrow-left"></i></button>
											<button type="button" id="btnR" class="btn btn-success"><i class="fa fa-arrow-right"></i></button>
											<button type="button" id="btnU" class="btn btn-success"><i class="fa fa-arrow-up"></i></button>
											<button type="button" id="btnD" class="btn btn-success"><i class="fa fa-arrow-down"></i></button>
										</div>
										<span class="pull-right">&nbsp; &nbsp; </span>
										<button type="button" id="btncicle" class="btn btn-danger"><i class="fa fa-rotate-right"></i></button>
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" id="save_image">ตกลง</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->


				<div class="modal fade" id="modal_eva">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="eva_event_name"></h3>
							</div>
							<div class="modal-body">

								<div id="eva_panel">

								</div>




							</div>
							<div class="modal-footer">
								<input type="button" id="commit_eva" class="btn btn-success pull-right" value="ส่งแบบประเมิน">
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="moda_pending_type">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
								<h3 class="modal-title" id="moda_pending_type_name"></h3>
							</div>
							<div class="modal-body">
								<ul class="products-list product-list-in-box" id="pending_type_list">
								</ul>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->






				<div class="modal fade" id="modal_PDPA">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">แก้ไขคำยินยอมเปิดเผยข้อมูลส่วนบุคคล</h3>
							</div>
							<div class="modal-body">
								<p><small> <B>ข้อมูลส่วนบุคคล</B> หมายถึง ข้อมูลเกี่ยวกับบุคคลซึ่งทำให้สามารถระบุตัวบุคคลนั้นได้ ไม่ว่าทางตรงหรือทางอ้อม ได้แก่ ชื่อ - นามสกุล, เลขประจำตัวประชาชน, ที่อยู่, เบอร์โทรศัพท์, วันเกิด, อีเมล, การศึกษา, เพศ, อาชีพ, รูปถ่าย, ข้อมูลทางการเงิน นอกจากนี้ยังรวมถึง ข้อมูลส่วนบุคคลที่มีความละเอียดอ่อน (Sensitive Personal Data) ด้วย เช่น ข้อมูลทางการแพทย์หรือสุขภาพ, ข้อมูลทางพันธุกรรมและไบโอเมทริกซ์, เชื้อชาติ, ความคิดเห็นทางการเมือง, ความเชื่อทางศาสนาหรือปรัชญา, พฤติกรรมทางเพศ, ประวัติอาชญากรรม, ข้อมูลสหภาพแรงงาน เป็นต้น</small>
								</p>
								<table class="table table-condensed">
									<tr>
										<th style="width: 10px">#</th>
										<th>เนื้อหา</th>
										<th style="width: 20%">ความยินยอม</th>
									</tr>
									<tbody id="table_pdpa">

										<tr>
											<td>1</td>
											<td>ยินยอมให้มีการส่งต่อข้อมูลส่วนบุคคลไปยังหน่วยงานภายในองค์กรต่อต้านคอร์รัปชัน (ประเทศไทย)</td>
											<td><input type="checkbox" id="consent_active_cb"></td>
										</tr>
									</tbody>
								</table>
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

	<!-- Select2 -->
	<script src="bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- InputMask -->
	<script src="plugins/input-mask/jquery.inputmask.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

	<!-- Moment with Local -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>

	<!-- bootstrap tab -->
	<script src="bower_components/jquery-ui/jquery-ui_new.js"></script>

	<!--  cropbox-->
	<script src="dist/js/cropbox.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="plugins/iCheck/icheck.min.js"></script>

	<!-- CROPPER -->
	<script src="plugins/cropper/dist/cropper.js"></script>

	<!-- Bootstrap slider -->
	<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================

			var token = "<?php echo $token; ?>";
			var MAIN_password = '';
			var MAIN_data = '';
			var skill_list = [];


			var _temp_var_1 = '';
			var _temp_var_2 = '';

			// Initial Object ========================================
			//Datemask dd/mm/yyyy
			$('#datemask').inputmask('dd/mm/yyyy', {
				'placeholder': 'dd/mm/yyyy'
			})
			//Money Euro
			$('[data-mask]').inputmask()
			moment.locale('th');


			$('.slider').slider();


			// Initial Cropper


			var $image = $('#image');

			$image.cropper({
				aspectRatio: 1 / 1
			});

			// Get the Cropper.js instance after initialized
			var cropper = $image.data('cropper');


			var $inputImage = $('#file');
			var URL = window.URL || window.webkitURL;
			var blobURL;

			if (URL) {
				$inputImage.change(function() {
					var files = this.files;
					var file;

					if (!$image.data('cropper')) {
						return;
					}

					if (files && files.length) {
						file = files[0];

						if (/^image\/\w+$/.test(file.type)) {
							blobURL = URL.createObjectURL(file);
							$image.one('built.cropper', function() {

								// Revoke when load complete
								URL.revokeObjectURL(blobURL);
							}).cropper('reset').cropper('replace', blobURL);
							$inputImage.val('');
						} else {
							window.alert('กรุณาเลือกรูปภาพ');
						}
					}
				});
			} else {
				$inputImage.prop('disabled', true).parent().addClass('disabled');
			}

			$('body').on('click', '#btnZoomIn', function() {
				$image.cropper("zoom", 0.1)
			});
			$('body').on('click', '#btnZoomOut', function() {
				$image.cropper("zoom", -0.1)
			});

			$('body').on('click', '#btnL', function() {
				$image.cropper("move", 10, 0)
			});
			$('body').on('click', '#btnR', function() {
				$image.cropper("move", -10, 0)
			});
			$('body').on('click', '#btnD', function() {
				$image.cropper("move", 0, -10)
			});
			$('body').on('click', '#btnU', function() {
				$image.cropper("move", 0, 10)
			});
			$('body').on('click', '#btncicle', function() {
				$image.cropper("rotate", 90)

			});
			$('body').on('click', '#save_image', function() {
				var imgurl = $image.cropper("getCroppedCanvas", {
					width: 200,
					height: 200
				}).toDataURL();
				var formData = new FormData();
				file_name = makeid() + ".png";
				//alert (file_name)
				formData.append('filUpload', imgurl);
				formData.append("file_name", file_name);
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'uploadfile.php', true);
				xhr.send(formData);
				update_img_data(file_name);
				$('#modal_img2').modal('hide');

			});



			var availableTags = [
				<?php
				// Connect to MySQL Database
				include "connectionDb.php";
				$sql = "SELECT DISTINCT(wd_skill) as data from wd_skill ";
				$res = $conn->query(trim($sql));
				mysqli_close($conn);
				$cl_check = "";
				while ($row = $res->fetch_assoc()) {
					echo $cl_check . '"' . $row['data'] . '"';
					$cl_check = ",";
				}
				?>
			];
			$("#m_skill").autocomplete({
				source: availableTags
			});

			// Random_code
			function makeid() {
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for (var i = 0; i < 15; i++)
					text += possible.charAt(Math.floor(Math.random() * possible.length));
				return text;
			}


			// Page function ========================================= 
			$('body').on('click', '#login_btn', function() {
				$("#access_result").html("")
				MAIN_password = $("#login_password").val();
				var add_data = {}
				add_data['f'] = '1';
				add_data['token'] = token;
				add_data['password'] = MAIN_password;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "") {
							$('#modal_password').modal('hide');
							load_data(data)
						} else {
							//access_result
							$("#access_result").html("<font color='red'><i class='fa fa-times-circle'></i> Password ไม่ถูกต้อง!!</font>")
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});





			function load_wd_data(data) {
				var add_data = {}
				add_data['f'] = '2';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var ojb = JSON.parse(data);

						// Output
						$("#wd_status_show").html(ojb.status_string);
						$('#member_img').attr('src', "img/wd_img/" + ojb.wd_img);


						//  + ojb.sex_text

						$("#m_info_nick_name").html(ojb.n_name);
						$("#m_info_name").html(ojb.name + " " + ojb.s_name + " " + ojb.sex_text);

						//                

						var item_main_list_text = '<li class="list-group-item"><b id="gen_taxt">รุ่นที่ ' + ojb.gen + '</b> <span class="pull-right" id="age_text">อายุ ' + ojb.age + ' ปี</span> </li>';

						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Facebook</b> <span class="pull-right" id="age_text"><a href="https://www.facebook.com/search/people/?q=' + ojb.soc_fb + '" target="_blank">' + ojb.soc_fb + '</a></span> </li>';

						if (ojb.soc_fb_2.trim() != "") {
							item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Facebook_2</b> <span class="pull-right" id="age_text"><a href="https://www.facebook.com/search/people/?q=' + ojb.soc_fb_2 + '" target="_blank">' + ojb.soc_fb_2 + '</a></span> </li>';
						}

						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">เบอร์โทร</b> <span class="pull-right" id="age_text">' + ojb.tel + '</span> </li>';
						if (ojb.tel_2.trim() != "") {
							item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">เบอร์โทรสำรอง</b> <span class="pull-right" id="age_text">' + ojb.tel_2 + '</span> </li>';
						}

						item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">อีเมล</b> <span class="pull-right" id="age_text">' + ojb.email + '</span> </li>';

						if (ojb.soc_line.trim() != "") {
							item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Line</b> <span class="pull-right" id="age_text">' + ojb.soc_line + '</span> </li>';
						}

						if (ojb.soc_twitter.trim() != "") {
							item_main_list_text += '<li class="list-group-item"><b id="gen_taxt">Twitter</b> <span class="pull-right" id="age_text">' + ojb.soc_twitter + '</span> </li>';
						}

						$("#main_info_item_list").html(item_main_list_text);

						$("#ovl_load_main_data").hide();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}



			// Load WD_Data
			function load_basic_wd_data(data) {
				var add_data = {}
				add_data['f'] = '3';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var ojb = JSON.parse(data);

						$("#address_text").html(ojb.all_address_text);
						$("#occ_text").html("<B>อาชีพ : </B>" + ojb.occ_text + "<BR><B>การศึกษา : </B>" + ojb.education);
						$("#note_text").html(ojb.note);
						$("#team_data_text").html(ojb.team_data);
						$("#skill_data_text").html(ojb.team_skill_data);
						$("#ovl_load_basic_data").hide();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_timeline_data(data) {
				var add_data = {}
				add_data['f'] = '4';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
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

			function get_wd_send_case_data(data) {
				var add_data = {}
				add_data['f'] = '5';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {

							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#case_send_list_panel").html(print_text);
						if (data == "[]") {
							$("#case_send_list_panel_box").css("height", "50px");
							$("#case_send_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}



			function get_wd_support_case_data(data) {
				var add_data = {}
				add_data['f'] = '6';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						//console.log(data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {

							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#case_support_list_panel").html(print_text);
						if (data == "[]") {
							$("#case_support_list_panel_box").css("height", "50px");
							$("#case_support_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_wd_team_support_case_data(data) {
				var add_data = {}
				add_data['f'] = '7';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {

							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#case_team_support_list_panel").html(print_text);
						if (data == "[]") {
							$("#case_team_support_list_panel_box").css("height", "50px");
							$("#case_team_support_list_panel").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_wd_score(data) {
				var add_data = {}
				add_data['f'] = '8';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						var total = 0;
						jQuery.each(data_arr, function(i, val) {
							if (val.type == "send") {
								$("#score_send").html(val.point)
								//$("#score_send").html("-")
								total += parseInt(val.point);
							}
							if (val.type == "support") {
								$("#score_support").html(val.point)
								//$("#score_support").html("-")
								total += parseInt(val.point);
							}
							if (val.type == "team_sp") {
								$("#score_team").html(val.point)
								//$("#score_team").html("-")
								total += parseInt(val.point);
							}
						});

						$("#score_total").html(total);
						//$("#score_total").html("-");

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_pending_case_for_support() {
				var add_data = {}
				add_data['f'] = '35';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {

							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#case_pending_list").html(print_text);
						if (data == "[]") {
							$("#case_pending_list").html("** ไม่พบข้อมูล **");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			function get_training_history(data) {
				var add_data = {}
				add_data['f'] = '9';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							//alert (val.Training_Start)
							print_text += "<TR>";
							print_text += "<TD>" + (i + 1) + "</TD>";
							print_text += "<TD>" + val.Training_subject + "</TD>";
							print_text += "<TD>" + val.Training_type + "</TD>";
							print_text += "<TD>" + moment(val.Training_Start, "YYYY-MM-DD").format('D MMMM') + " - " + moment(val.Training_End, "YYYY-MM-DD").format('D MMMM YYYY') + "</TD>";
							print_text += "</TR>";
							print_text += "";

						});
						//alert (print_text)
						$("#table_training_list").html(print_text)
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			$('body').on('click', '#btn_show_access_token', function() {
				$("#access_qr_code_panel").toggle("fast")
				$("#member_img").toggle("fast")
			});


			function get_token_data(data) {
				var add_data = {}
				add_data['f'] = '10';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						$("#access_qr_code").html("");
						jQuery('#access_qr_code').qrcode({
							text: data
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


			// edit_profile_data
			// btn_edit_data
			$('body').on('click', '#btn_edit_data', function() {
				load_main_data_for_edit();
				$('#edit_profile_data').modal('show');
			});

			/*
			$("#user_birthday").keyup(function() {
				inner_text = ($(this).val());
				var today = new Date();
				dt = inner_text.split('/');
				if (isDate(dt[2] + '-' + dt[1] + '-' + dt[0])) {
					var birthDate = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])
					var age = today.getFullYear() - (birthDate.getFullYear() - 543);
					var m = today.getMonth() - birthDate.getMonth();
					if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
						age--;
					}
					if ((age > 0) && (age <= 100)) {
						$("#user_age").val(age);
					}

				} else {
					$("#user_age").val("");
				}
			});
*/

			function isDate(value) {
				switch (typeof value) {
					case 'number':
						return true;
					case 'string':
						return !isNaN(Date.parse(value));
					case 'object':
						if (value instanceof Date) {
							return !isNaN(value.getTime());
						}
						default:
							return false;
				}
			}

			function load_main_data_for_edit() {
				var add_data = {}
				add_data['f'] = '11';
				add_data['post_data'] = MAIN_data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data) 
						var data_arr = JSON.parse(data);
						val_data = data_arr[0];
						//console.log(data_arr)

						// 
						var bd_moment = moment(val_data.birthday);
						$("#e_bd_d").val(bd_moment.format("D"));
						$("#e_bd_m").val(bd_moment.format("MM"));
						$("#e_bd_y").val(bd_moment.format("Y"));
						$("#user_name").val(val_data.name);
						$("#user_sirname").val(val_data.s_name);
						$("#user_nickname").val(val_data.n_name);
						//$("#user_birthday").val(val_data.dob);
						//$('#user_birthday').keyup();
						$("#user_tel_1").val(val_data.tel);
						$("#user_tel_2").val(val_data.tel_2);
						$("#user_email").val(val_data.email);
						$("#user_fb_1").val(val_data.soc_fb);
						$("#user_fb_2").val(val_data.soc_fb_2);
						$("#user_line").val(val_data.soc_line);
						$("#user_twister").val(val_data.soc_twitter);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			// btn_reset_main_data
			$('body').on('click', '#btn_reset_main_data', function() {
				load_main_data_for_edit();
				//$('#edit_profile_data').modal('show');
			});

			$('body').on('click', '#btn_save_main_data', function() {
				//var target_check_list_1 = ['user_name', 'user_sirname', 'user_nickname', 'user_birthday', 'user_tel_1', 'user_fb_1'];
				var target_check_list_1 = ['user_name', 'user_sirname', 'user_nickname', 'user_tel_1', 'user_fb_1'];
				var check_rest = 0;
				$("input").each(function(index) {
					if (jQuery.inArray($(this).attr('id'), target_check_list_1) != -1) {
						$(this).css({
							'background-color': '#ffffff'
						});
						if ($(this).val() == "") {
							check_rest = 1;
							$(this).css({
								'background-color': '#ffb3b3'
							});
						}
					}
				});
				var birthDate = $("#e_bd_y").val() + '-' + $("#e_bd_m").val() + '-' + $("#e_bd_d").val();
				$("#e_bd_d").css({
					'background-color': '#ffffff'
				});
				if (moment(birthDate).isValid() == false) {
					check_rest = 1;
					$("#e_bd_d").css({
						'background-color': '#ffb3b3'
					});
					alert("วันเดือนปีเกิด ไม่ถูกต้อง")
				}

				//inner_text = ($("#user_birthday").val());
				//var today = new Date();
				//dt = inner_text.split('/');
				//var birthDate = (dt[2] - 543) + '-' + dt[1] + '-' + dt[0];

				//alert (birthDate)

				if (check_rest == 0) // If check is OK 
				{
					var add_data = {}
					add_data['f'] = '12';
					add_data['post_data'] = MAIN_data;
					add_data['user_name'] = $("#user_name").val();
					add_data['user_sirname'] = $("#user_sirname").val();
					add_data['user_nickname'] = $("#user_nickname").val();
					add_data['birthDate'] = birthDate;
					add_data['user_tel_1'] = $("#user_tel_1").val();
					add_data['user_tel_2'] = $("#user_tel_2").val();
					add_data['user_email'] = $("#user_email").val();
					add_data['user_fb_1'] = $("#user_fb_1").val();
					add_data['user_fb_2'] = $("#user_fb_2").val();
					add_data['user_line'] = $("#user_line").val();
					add_data['user_twister'] = $("#user_twister").val();
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_user_profile.php',
							data: (add_data)
						})
						.done(function(data) {
							load_data(MAIN_data);
							$('#edit_profile_data').modal('hide');
							swal({
								position: 'top-end',
								type: 'success',
								title: 'ลงทะเบียนสำเร็จ',
								showConfirmButton: false,
								timer: 1500
							})
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}

			});

			$('body').on('click', '#btn_edit_general_data', function() {
				get_main2_for_edit();
				$('#edit_profile_data2').modal('show');
			});


			function get_address_for_select(selected_data) {
				var add_data = {}
				add_data['f'] = '13';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data) 
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							if (val.DISTRICT_CODE.trim() == selected_data) {
								print_text += '<Option value="' + val.DISTRICT_CODE.trim() + '" selected>' + val.address_text + '</Option>';
							} else {
								print_text += '<Option value="' + val.DISTRICT_CODE.trim() + '">' + val.address_text + '</Option>';
							}

						});
						$("#e_add_code").html(print_text);
						$('#e_add_code').select2({
							width: 'resolve'
						});

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_occ_type_for_select() {
				var add_data = {}
				add_data['f'] = '14';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data) 
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += '<Option value="' + val.id + '">' + val.occ_type + '</Option>';
						});
						$("#e_occ_type").html(print_text);
						//alert (print_text);
						//Initialize Select2 Elements
						$('#e_occ_type').select2({
							width: 'resolve'
						})


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_selected_education(selected_edu) {
				edu_list = ['ไม่ระบุ', 'กำลังศึกษา', 'ต่ำกว่าปริญญาตรี', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก'];
				var print_text = "";
				jQuery.each(edu_list, function(i, val) {
					//	print_text += '<Option value="'+val+'">'+val+'</Option>';

					if (val == selected_edu) {
						print_text += '<Option value="' + val + '" selected>' + val + '</Option>';
					} else {
						print_text += '<Option value="' + val + '">' + val + '</Option>';
					}



				});
				$("#e_education").html(print_text)
				$('#e_education').select2({
					width: 'resolve'
				});
			}

			function get_main2_for_edit() {
				var add_data = {}
				add_data['f'] = '15';
				add_data['post_data'] = MAIN_data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						val = data_arr[0];

						$("#e_occ_type").select2("val", val.occ_type);
						get_selected_education(val.education)
						//get_address_for_select(val.add_code);
						get_address_for_select_1();
						$("#e_address").val(val.address)
						$("#e_occ").val(val.occ)
						$("#e_occ_location").val(val.occ_add)

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			// btn_save_main2_data
			$('body').on('click', '#btn_save_main2_data', function() {
				if ($("#e_add_district").val() == null) {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณาระบุที่อยู่ให้ครบถ้วน',
						showConfirmButton: false,
						timer: 2000
					});
				} else {
					var add_data = {}
					add_data['f'] = '16';
					add_data['post_data'] = MAIN_data;
					add_data['new_address'] = $("#e_address").val();
					//add_data['new_address_code'] = $("#e_add_code").val();
					add_data['new_address_code'] = $("#e_add_district").val();
					add_data['new_occ'] = $("#e_occ").val();
					add_data['new_occ_type'] = $("#e_occ_type").val();
					add_data['new_occ_location'] = $("#e_occ_location").val();
					add_data['new_education'] = $("#e_education").val();
					//console.log(add_data)

					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_user_profile.php',
							data: (add_data)
						})
						.done(function(data) {
							//alert (data);
							$('#edit_profile_data2').modal('hide');
							load_data(MAIN_data)
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 2000
							});
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}


			});

			function get_and_print_skill(data) {
				var add_data = {}
				add_data['f'] = '18';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						print_text = "";
						skill_list = [];
						jQuery.each(data_arr, function(i, val) {
							skill_list.push(val.wd_skill);
							//print_text += '<BR>&nbsp;&nbsp;&nbsp;<i class="fa fa-check"></i> ' + val.wd_skill + '<small class="delete_personal_skill" id="delete_personal_skill" value="'+val.ranstr+'"><i class="fa fa-times"></i></small>';
							//print_text += '<span style="font-size: 20;" class="label label-success"> ' + val.wd_skill + ' <small class="delete_personal_skill" id="delete_personal_skill" value="'+val.ranstr+'"><i class="fa fa-times"></i></small>  </span>&nbsp;';
							print_text += '<div class="chip">' + val.wd_skill + '<span class="closebtn" id="delete_personal_skill" value="' + val.ranstr + '">&times;</span></div>';
						});
						//alert (print_text);
						$("#person_skill_data_text").html(print_text);
						//var data_arr = JSON.parse(data);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// btn_save_main2_data
			$('body').on('click', '#delete_personal_skill', function() {
				var target = ($(this).attr('value'));
				//alert(target);
				var add_data = {}
				add_data['f'] = '19';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						get_and_print_skill(MAIN_data)
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 2000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});


			//m_add_skill
			$('body').on('click', '#m_add_skill', function() {
				target = ($("#m_skill").val());
				if (jQuery.inArray(target, skill_list) == -1) {
					if (target.trim() !== "") {
						var add_data = {}
						add_data['f'] = '20';
						add_data['post_data'] = MAIN_data;
						add_data['target'] = target;
						$.ajax({
								type: 'POST',
								dataType: "text",
								url: 'f_user_profile.php',
								data: (add_data)
							})
							.done(function(data) {
								get_and_print_skill(MAIN_data)
								swal({
									position: 'top-end',
									type: 'success',
									title: 'บันทึกข้อมูลสำเร็จ',
									showConfirmButton: false,
									timer: 2000
								});
							})
							.fail(function() {
								// just in case posting your form failed
								alert("Posting failed.");
							});
					}
				}
				$("#m_skill").val("");
			});


			// member_img
			$('body').on('click', '#member_img', function() {
				$('#modal_img2').modal('show');
			});


			function update_img_data(img) {
				$('#member_img').attr('src', "img/loading.gif");
				var add_data = {}
				add_data['f'] = '21';
				add_data['data'] = MAIN_data;
				add_data['img'] = img;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						load_wd_data(MAIN_data);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//get_event_now_list
			function get_event_now_list(data) {
				var add_data = {}
				add_data['f'] = '22';
				add_data['post_data'] = data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						if (data == "[]") {
							$('#current_event_now_panel').hide();
						} else {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {

								if (val.event_type == 1) {
									if (val.time_stmp == null) {
										print_text += '<button type="button" class="btn btn-primary btn-lg" val_1="' + val.event_id + '" val_2="' + val.wd_id + '" id="btn_check_in"><i class="fa fa-check-circle-o"></i> เช็คอิน : ' + val.event_name + '</button><BR/><BR/>';
									} else {
										print_text += "<H4>" + (i + 1) + ". " + val.event_name;
										print_text += " : <font color='green'><B>ลงทะเบียนแล้ว</B></font></H4><BR/>";
									}
								}

								if (val.event_type == 2) {
									if (val.time_stmp == null) {
										print_text += '<button type="button" class="btn btn-danger btn-lg" val_1="' + val.event_id + '" val_2="' + val.wd_id + '"  event_name="' + val.event_name + '" id="btn_vote"><i class="fa fa-star"></i> โหวต : ' + val.event_name + '</button><BR/><BR/>';
									} else {
										print_text += "<H4>" + (i + 1) + ". " + val.event_name;
										print_text += " : <font color='green'><B>โหวตแล้ว</B></font>   <a href='vote_result.php?token=" + token + "&event_id=" + val.event_id + "' target='_blank'>ผลโหวต</a>  </H4><BR/>";
									}
								}

								if (val.event_type == 3) {
									if (val.time_stmp == null) {
										print_text += '<button type="button" class="btn btn-info btn-lg" val_1="' + val.event_id + '" val_2="' + val.wd_id + '"  event_name="' + val.event_name + '" id="btn_eva"><i class="fa fa-commenting-o"></i> ประเมิน : ' + val.event_name + '</button><BR/><BR/>';
									} else {
										print_text += "<H4>" + (i + 1) + ". " + val.event_name;
										print_text += " : <font color='green'><B>ทำแบบประเมินแล้ว</B></font></H4><BR/>";
									}
								}




							});

							$("#event_now_list").html(print_text);
							$('#current_event_now_panel').show();
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//btn_check_in
			$('body').on('click', '#btn_check_in', function() {
				var add_data = {}
				add_data['f'] = '23';
				add_data['val_1'] = $(this).attr('val_1');
				add_data['val_2'] = $(this).attr('val_2');

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						get_event_now_list(MAIN_data)
						swal({
							position: 'top-end',
							type: 'success',
							title: 'เช็คอินสำเร็จ',
							showConfirmButton: false,
							timer: 2000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			//btn_vote
			$('body').on('click', '#btn_vote', function() {

				_temp_var_1 = $(this).attr('val_1');
				_temp_var_2 = $(this).attr('val_2');
				load_selection_list();
				$("#vote_event_name").html($(this).attr('event_name'));

			});

			// btn_eva
			$('body').on('click', '#btn_eva', function() {

				_temp_var_1 = $(this).attr('val_1');
				_temp_var_2 = $(this).attr('val_2');
				load_eva_list();
				$("#eva_event_name").html($(this).attr('event_name'));

			});





			function load_selection_list() {
				var add_data = {}
				add_data['f'] = '24';
				add_data['vote_id'] = _temp_var_1;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								print_text += "<Option value='" + val.value + "'> ";
								print_text += val.value;
								print_text += " </Option>";
							});
							$("#vote_selection").html(print_text);
							$('#modal_vote').modal('show');
						}

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// confirm_vote
			$('body').on('click', '#confirm_vote', function() {
				var add_data = {}
				add_data['f'] = '25';
				add_data['val_1'] = _temp_var_1;
				add_data['val_2'] = _temp_var_2;
				add_data['val_3'] = $("#vote_selection").val();
				add_data['val_4'] = "";

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						get_event_now_list(MAIN_data)
						$('#modal_vote').modal('hide');
						swal({
							position: 'top-end',
							type: 'success',
							title: 'โหวตสำเร็จ',
							showConfirmButton: false,
							timer: 2000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			function check_is_temp_pwd(data) {
				var add_data = {}
				add_data['f'] = '26';
				add_data['post_data'] = data;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						//modal_cng_pwd
						var data_arr = JSON.parse(data);
						if (data_arr[0].temp_flg == 'Y') {
							$('#modal_cng_pwd').modal('show');
							$('#display_data_panel').hide();
						}


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// Check password is same or not
			function check_password2() {
				if ($('#nw_pass1').val() != "") {
					if ($('#nw_pass1').val() == $('#nw_pass2').val()) {
						$('#check_chn_password_icon').show();
						$("#btn-change-Password").removeAttr("disabled");
						$('#change-password-result').html("");
					} else {
						$('#check_chn_password_icon').hide();
						$("#btn-change-Password").attr("disabled", true);
						$('#change-password-result').html("");
					}
				}
			}

			// ================================
			$("#nw_pass1").keyup(function() {
				check_password2();

			});

			// ================================
			$("#nw_pass2").keyup(function() {
				check_password2();
			});

			$("#btn-change-Password").click(function() {
				var add_data = {}
				add_data['f'] = '27';
				add_data['post_data'] = '<?php echo $token; ?>';
				add_data['data_1'] = $('#nw_pass1').val();

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						$('#modal_cng_pwd').modal('hide');
						$('#display_data_panel').show();
						swal({
							position: 'top-end',
							type: 'success',
							title: 'เปลี่ยนรหัสผ่านสำเร็จ',
							showConfirmButton: false,
							timer: 2000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});




			});

			function get_address_for_select_1() {
				var add_data = {}
				add_data['f'] = '28';
				add_data['post_data'] = '<?php echo $token; ?>';

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						get_province(data_arr[0].PROVINCE_ID)
						get_ampher(data_arr[0].PROVINCE_ID, data_arr[0].AMPHUR_ID)
						get_district(data_arr[0].AMPHUR_ID, data_arr[0].DISTRICT_CODE)
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_province(initial_prov = '') {
				var add_data = {}
				add_data['f'] = '29';

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							if (initial_prov == val.PROVINCE_ID) {
								print_text += "<Option value = " + val.PROVINCE_ID + " selected>" + val.PROVINCE_NAME + "</Option>";
							} else {
								print_text += "<Option value = " + val.PROVINCE_ID + ">" + val.PROVINCE_NAME + "</Option>";
							}

						});
						$("#e_add_province").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_ampher(province_id, initial_amp = '') {
				var add_data = {}
				add_data['f'] = '30';
				add_data['prov'] = province_id;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						if (initial_amp == '') {
							print_text += "<Option selected disabled>== เลือกอำเภอ ==</Option>";
						}
						jQuery.each(data_arr, function(i, val) {


							if (initial_amp == val.AMPHUR_ID) {
								print_text += "<Option value = " + val.AMPHUR_ID + " selected>" + val.AMPHUR_NAME + "</Option>";
							} else {
								print_text += "<Option value = " + val.AMPHUR_ID + ">" + val.AMPHUR_NAME + "</Option>";
							}

						});
						$("#e_add_ampher").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_district(ampher_id, initial_district = '') {
				var add_data = {}
				add_data['f'] = '31';
				add_data['ampher'] = ampher_id;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						if (initial_district == '') {
							print_text += "<Option selected disabled>== เลือกตำบล ==</Option>";
						}
						jQuery.each(data_arr, function(i, val) {

							if (initial_district == val.DISTRICT_CODE) {
								print_text += "<Option value = " + val.DISTRICT_CODE + " selected>" + val.DISTRICT_NAME + "</Option>";
							} else {
								print_text += "<Option value = " + val.DISTRICT_CODE + ">" + val.DISTRICT_NAME + "</Option>";
							}

						});
						$("#e_add_district").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// e_add_province
			$("#e_add_province").change(function() {
				// Clear Data
				$("#e_add_district").html("");
				//ajax_function(2, "#m_add_aumper", $(this).val());
				get_ampher($(this).val())
			});

			$("#e_add_ampher").change(function() {
				//ajax_function(2, "#m_add_aumper", $(this).val());
				get_district($(this).val());
			});



			function load_eva_list() {
				var add_data = {}
				add_data['f'] = '24';
				add_data['vote_id'] = _temp_var_1;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								print_text += '<H3>' + val.value + ' : <small id="show_text_eva_' + i + '">พอใช้</small><input value="3" type="range" min="1" max="5" class="eva_select_title" value_title="' + val.value + '"  show_text_target="show_text_eva_' + i + '"></H3>';
							});

							print_text += '<H3>ข้อเสนอแนะ : </H3><Br/><textarea rows="4" cols="30" class="eva_select_title" value_title="ข้อเสนอแนะ"></textarea>';

							$("#eva_panel").html(print_text);
							$('#modal_eva').modal('show');
						}

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			$('body').on('click', '#commit_eva', function() {
				$(".eva_select_title").each(function(index) {
					var eva_titel = $(this).attr('value_title');
					var eva_value = $(this).val();

					//alert (eva_value);
					var add_data = {}
					add_data['f'] = '25';
					add_data['val_1'] = _temp_var_1;
					add_data['val_2'] = _temp_var_2;
					add_data['val_3'] = eva_titel;
					add_data['val_4'] = eva_value;

					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_user_profile.php',
							data: (add_data)
						})
						.done(function(data) {
							get_event_now_list(MAIN_data)
						});
				});


				$('#modal_eva').modal('hide');
				swal({
					position: 'top-end',
					type: 'success',
					title: 'ประเมินเสร็จ',
					showConfirmButton: false,
					timer: 2000
				});

			});

			$('body').on('change', '.eva_select_title', function() {
				//alert ($(this).val()); show_text_target    $(this).val()
				var target_div_name = $(this).attr('show_text_target');
				var text_to_show = "";
				switch ($(this).val()) {
					case "1":
						text_to_show = "แย่มาก";
						break;
					case "2":
						text_to_show = "แย่";
						break;
					case "3":
						text_to_show = "พอใช้";
						break;
					case "4":
						text_to_show = "ดี";
						break;
					case "5":
						text_to_show = "ดีมาก";
						break;
				}



				$("#" + target_div_name).html(text_to_show);

			});


			function get_pending_type() {
				var add_data = {}
				add_data['f'] = '36';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							//print_text += '<div class="chip" id="load_pending_type" value="'+val.+'">'+val.wd_skill+'<span class="closebtn" id="delete_personal_skill" value="'+val.ranstr+'">&times;</span></div>';
							print_text += '<div class="chip" id="load_pending_type" value="' + val.job_type + '">' + val.job_type + ' (' + val.cnt + ')</div>';
						});
						//alert (print_text);
						$("#pending_type").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			// load_pending_type

			$('body').on('click', '#load_pending_type', function() {
				var target = ($(this).attr('value'));
				//alert(target);
				var add_data = {}
				add_data['f'] = '37';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {
							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#pending_type_list").html(print_text);
						if (data == "[]") {
							$("#pending_type_list").html("** ไม่พบข้อมูล **");
						}
						// Name
						$("#moda_pending_type_name").html(target);

						// Show
						$('#moda_pending_type').modal('show');

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			function get_pending_crp() {
				var add_data = {}
				add_data['f'] = '38';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += '<div class="chip" id="load_pending_crp" value="' + val.crp_type + '">' + val.crp_type + ' (' + val.cnt + ')</div>';
						});
						//alert (print_text);
						$("#case_pending_by_crp_list").html(print_text);
					})
					.fail(function() {
						alert("Posting failed.");
					});
			}

			$('body').on('click', '#load_pending_crp', function() {
				var target = ($(this).attr('value'));
				//alert(target);
				var add_data = {}
				add_data['f'] = '39';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						var data_arr = JSON.parse(data);
						print_text = "";
						text_status = "";
						text_color = "";
						jQuery.each(data_arr, function(i, val) {
							switch (val.status) {
								case "0":
									text_status = '<i class="fa fa-sign-out"></i> เคสใหม่';
									text_color = "bg-purple";
									break;
								case "1":
									text_status = '<i class="fa fa-check-square-o"></i> ทำข้อมูล';
									text_color = "bg-blue";
									break;
								case "2":
									text_status = '<i class="fa fa-info"></i> รอข้อมูล';
									text_color = "bg-aqua";
									break;
								case "3":
									text_status = '<i class="fa fa-coffee"></i> ชะลอ';
									text_color = "bg-maroon";
									break;
								case "4":
									text_status = '<i class="fa fa-times"></i> ยุติ';
									text_color = "bg-red";
									break;
								case "5":
									text_status = '<i class="fa fa-facebook"></i> ลงเพจ';
									text_color = "label-success";
									break;
								case "6":
									text_status = '<i class="fa fa-check-circle-o"></i> สรุปข้อมูล';
									text_color = "label-warning";
									break;
								case "7":
									text_status = '<i class="fa fa-book"></i> รอตรวจต้นฉบับ';
									text_color = "label-warning";
									break;
								case "8":
									text_status = '<i class="fa fa-book"></i> เขียนต้นฉบับ';
									text_color = "label-success";
									break;
								default:
									text_status = "";
									text_color = "";
							}
							// Case URL
							var case_link_in_cnt = "'#'";
							if (val.case_cnt_url.trim() != "") {
								case_link_in_cnt = '"' + val.case_cnt_url + '" target="_blank"';
							}
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							if (val.status == "5") {
								print_text += '<a href="' + val.post_link + '" target="_blank"><img src="' + val.img + '" alt="Product Image"></a>';
							} else {
								print_text += '<img src="' + val.img + '" alt="Product Image">';
							}
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.case_cnt_url.trim() == "") {

								print_text += '<span class="product-title">' + val.print_case_id + ' : ' + val.topic + '</span>';
							} else {
								print_text += '<a href=' + case_link_in_cnt + ' class="product-title">' + val.print_case_id + ' : ' + val.topic + '</a>';
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span>';
							print_text += '<span class="product-description">';
							print_text += val.t_sum;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#pending_type_list").html(print_text);
						if (data == "[]") {
							$("#pending_type_list").html("** ไม่พบข้อมูล **");
						}
						// Name
						$("#moda_pending_type_name").html(target);

						// Show
						$('#moda_pending_type').modal('show');

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});



			function load_pdpa_data() {
				var add_data = {}
				add_data['f'] = '40';
				add_data['MAIN_data'] = MAIN_data;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_user_profile.php',
						data: (add_data)
					})
					.done(function(data) {

						var ojb = JSON.parse(data);
						print_text = ""
						$.each(ojb, function(index, val) {
							print_text += "<TR>"
							print_text += "<td>" + val.consent_id + "</td>"
							print_text += "<td>" + val.consent_desc + "</td>"

							if (val.consent_value == "1") {
								print_text += "<td><input type='checkbox' id='consent_select' class='flat-red' value='" + val.consent_id + "' checked></td>"
							} else {
								print_text += "<td><input type='checkbox' id='consent_select' class='flat-red' value='" + val.consent_id + "' ></td>"
							}
							print_text += "</TR>"
						});
						$("#table_pdpa").html(print_text)

						//
						//$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
						//	checkboxClass: 'icheckbox_flat-red',
						//	radioClass   : 'iradio_flat-red'
						//})
					});
			}




			$('body').on('click', '#consent_select', function() {
				var consent_id = ($(this).attr('value'));
				var consent_value = 0
				if ($(this).is(':checked')) {
					var consent_value = 1
				}
				var add_data = {}
				add_data['f'] = '41';
				add_data['MAIN_data'] = MAIN_data;
				add_data['consent_id'] = consent_id;
				add_data['consent_value'] = consent_value;
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_user_profile.php',
					data: (add_data)
				});
			});


			//btn_change_pdpa
			$('body').on('click', '#btn_change_pdpa', function() {
				$('#modal_PDPA').modal('show');
				// Load PDPA_Data
				load_pdpa_data()
				//table_pdpa



			});

			function load_data(data) {
				MAIN_data = data;

				generate_initial_date();
				$('#modal_password').modal('hide');
				$('#display_data_panel').show();
				check_is_temp_pwd(data);
				load_wd_data(MAIN_data)
				load_basic_wd_data(MAIN_data)
				get_timeline_data(MAIN_data)
				get_wd_send_case_data(MAIN_data)
				get_wd_support_case_data(MAIN_data)
				get_wd_team_support_case_data(MAIN_data)
				get_pending_type()
				get_pending_crp()
				//get_pending_case_for_support()
				get_wd_score(MAIN_data)
				get_training_history(MAIN_data)
				get_token_data(MAIN_data)
				get_and_print_skill(MAIN_data)
				get_event_now_list(MAIN_data)
				get_address_for_select_1();

				setInterval(function() {
					location.reload();
				}, 1800000);
			}

			function generate_initial_date() {
				//e_bd_d
				var year = moment().year();
				//console.log(year);
				var _flg_year_select = 0;
				print_text = "";
				while (true) {
					year_bd = year + 543;
					if (_flg_year_select == 0) {
						print_text += "<option value ='" + year + "' selected>" + year_bd + "</option>";
					} else {
						print_text += "<option value ='" + year + "'>" + year_bd + "</option>";
					}
					_flg_year_select = 1;
					year -= 1
					if (year <= 1930) {
						break;
					}

					//	alert(print_text)
				}
				$("#e_bd_y").html(print_text);

				// Month
				var current_time = moment('2021-01-01');
				//console.log(year);
				var _flg_select = 0;
				print_text = "";
				while (true) {
					if (_flg_select == 0) {
						print_text += "<option value ='" + current_time.format("MM") + "' selected>" + current_time.format("MMMM") + "</option>";
					} else {
						print_text += "<option value ='" + current_time.format("MM") + "'>" + current_time.format("MMMM") + "</option>";
					}
					_flg_select = 1;

					if (current_time.format("M") == 12) {
						break;
					}
					current_time.add(1, 'month')
				}
				$("#e_bd_m").html(print_text);


				print_text = "";
				for (i = 1; i <= 31; i++) {
					print_text += "<option value ='" + i + "'>" + i + "</option>";
				}
				$("#e_bd_d").html(print_text);
			}

			// Initial Run ========================================= 
			//get_address_for_select();

			get_occ_type_for_select();

			$('#modal_password').modal('show');



		});
	</script>
</body>

</html>
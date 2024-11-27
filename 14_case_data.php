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
	<title>Watch_Dog | Case edit</title>

	<!-- Site icon -->
	<link rel="icon" href="img/system_icon.ico">

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
	<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js rdoesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<!-- J-ui css-->
	<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
	<!-- Bootstrap Tagsinput Css -->
	<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet">
	<link href="bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">



	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	<!-- Select 2 -->
	<link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">

	<!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

	<style>
		.ui-autocomplete-category {
			font-weight: bold;
			padding: .2em .4em;
			margin: .8em 0 .2em;
			line-height: 1.5;
		}
	</style>
	<style>
		.delete_time_line {
			color: #efefef;

		}

		.break-word {
			width: 98%;
			overflow-wrap: break-word;
		}



		.delete_time_line:hover {
			color: #dd0000;
			cursor: pointer;

		}

		.post_desc:hover {
			cursor: pointer;
		}


		.chip {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 15px;
			height: 35px;
			font-size: 17px;
			line-height: 35px;
			border-radius: 25px;
			background-color: #ccffdd;
		}

		.div_select_page:hover {
			background-color: #b5b5b5;
			cursor: pointer;
		}

		.chip_case_type {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 25px;
			color: #000000;
			height: 35px;
			font-size: 15px;
			line-height: 35px;
			border-radius: 25px;
			background-color: #bebddb;
		}

		.chip_add {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 15px;
			height: 35px;
			font-size: 15px;
			line-height: 35px;
			border-radius: 0px;
			background-color: #f1f1f1;
		}

		.chip_add_current {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 15px;
			height: 35px;
			font-size: 15px;
			font-weight: bold;
			line-height: 35px;
			border-radius: 0px;
			background-color: #66b3ff;
		}

		.chip_add_selected {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 15px;
			height: 35px;
			font-size: 15px;
			font-weight: bold;
			line-height: 35px;
			border-radius: 0px;
			background-color: #80ffdf;
		}

		.chip_add:hover {
			background-color: #b5b5b5;
			cursor: pointer;
		}

		.chip img {
			float: left;
			margin: 0 10px 0 -25px;
			height: 35px;
			width: 35px;
			border-radius: 50%;
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

		.wrap-text {
			overflow: hidden;
			white-space: nowrap;
			text-overflow: ellipsis;
		}

		.case_image {
			border-radius: 20px;
		}

		.chat_sticker {
			width: 100%;
			max-width: 35%;
		}

		.chat_sticker_img {
			width: 100%;
			max-width: 50%;
			border-radius: 10px;
			border: 1px solid #bbb;
			padding: 5px;

		}

		.chat_msg_send {
			border-radius: 15px 15px 15px 15px;
			max-width: 80%;
			color: #111111;
			background: #DFDFDF;
			padding: 5px 10px 5px 10px;
		}

		.chat_msg_page {
			border-radius: 15px 15px 15px 15px;
			max-width: 80%;
			color: #f1f0f0;
			background: #1a90ff;
			padding: 5px 10px 5px 10px;
		}

		.hover_pointer:hover {
			cursor: pointer;
		}

		.c_hover {
			cursor: pointer;
		}




		.gallery {
			width: 100%;
			margin: auto;
			border-radius: 3px;
			overflow: hidden;
			position: relative;
		}

		.img-c {
			width: 50%;
			height: 180px;
			float: left;
			position: relative;
			overflow: hidden;
		}

		.img-w {
			position: absolute;
			width: 100%;
			height: 100%;
			background-size: cover;
			background-position: center;
			cursor: pointer;
			transition: transform ease-in-out 300ms;


		}

		.img-w img {
			display: none;
		}

		.img-c {
			transition: width ease 400ms, height ease 350ms, left cubic-bezier(0.4, 0, 0.2, 1) 420ms, top cubic-bezier(0.4, 0, 0.2, 1) 420ms;
		}

		.img-c:hover .img-w {
			transform: scale(1.3);
			transition: transform cubic-bezier(0.4, 0, 0.2, 1) 450ms;
		}

		.img-attached-show {
			max-width: 100%;
			max-height: 100%;
		}
	</style>
</head>

<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?>  sidebar-mini">
	<div class="wrapper">
		<?php
		$fn = basename($_SERVER['PHP_SELF']);
		include 'menu.php';
		$case_id = $_GET['case_id'];
		$pass_success = 0;
		$pass_success_text = '';
		if (isset($_GET['pcs'])) {
			$pass_success = $_GET['pcs'];
		}
		if ($pass_success != 0) {
			$pass_success_text = '$.notify("บันทึกข้อมูลสำเร็จ", "success");';
		}
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<span id="case_id"></span>
					<small>ข้อมูลเคส</small>
					<small class="pull-right" id="btn_next_case"></small>
					<small class="pull-right" id="btn_bf_case"></small>
				</h1>
				<div class="box box-solid" style="background:#0288d1">
					<div class="box-body">
						<font color="#ffffff">
							<h3 id="topic"></h3>
							<h5 class="wrap-text" id="t_sum" style="max-width: 100%;"></h5>
						</font>
					</div>
				</div>

			</section>

			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<div class="col-md-12">
						<!-- Widget: user widget style 1 -->
						<div class="box box-widget widget-user" id="btn_update_info_header" style="display: none;">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-aqua-active">
								<h4 class="widget-user-desc pull-right"></h4>



							</div>

						</div>
						<!-- /.widget-user -->
					</div>

				</div>
				<div class="row">
					<div id="ofd_name_panel" class="col-md-12">

					</div>

				</div>
				<br>

				<div class="row">
					<!-- Left col -->
					<div class="col-md-8">
						<!-- MAP & BOX PANE -->
						<div class="row">
							<div class="col-sm-12">
								<div class="box box-solid bg-light-blue" id="box_status">
									<div class="box-body" id="btn_status_edit">
										<h3 class="box-title"><B> สถานะ : <span id="status_text"><span> </B></h3>
										<H5><small><i><font color="#FFF"><span id="status_text_warnning">คลิกเพื่อเปลี่ยนสถานะ</span></font></i></small></H5>
									</div>
								</div>
							</div>
						</div>
						<div class="box box-success" id="box_case_info">
							<div class="box-header with-border">
								<h3 class="box-title"><B>Case Information</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id="btn_update_info"><i class="fa fa-pencil"></i> แก้ไข</button>
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12">
										<B>Tag : </B><span id="case_hashtags_result"></span><button type="button" class="btn btn-outlinebg-primary" id="add_new_tag">+</button>
									</div>

								</div>
								<div class="row" id="add_new_tag_panel" style="display: none;">
									<div class="col-sm-3">
										<select id="select_new_hashtag" class="form-control"></select>
									</div>

								</div>
								<div class="row">
									<div class="col-sm-8">
										<h5><B>ระดับความสำคัญ : </B><span id="priority_text"></span><span class="label"> </span></h5>
										<!-- /.description-block -->
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<h5><B>ประเภทงาน : </B>
											<span id="case_job_type_panel">
											</span>
											<button type="button" class="btn btn-outlinebg-primary" id="add_case_job_type_button">+</button>
										</h5>
										<!-- /.description-block -->

										<div class="form-group" id="new_case_job_type_box" style="display: none;">
											<label for="new_case_job_type" class="col-xs-1 control-label"></label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="new_case_job_type" placeholder="ประเภทงาน">
											</div>


											<div class="col-sm-6" id="new_case_job_type_select">

											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<h5><B>ผู้กระทำผิด : </B><button type="button" class="btn btn-outlinebg-primary" id="add_ofd_name">+</button></h5>
										<div class="col-xs-8">
											<ul class="todo-list" id="ofd_person_name_panel">

											</ul>
										</div>
										<!-- /.description-block -->
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<h5><B>Note : </B><span id="note"></span></h5>
										<!-- /.description-block -->
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4 border-right">
										<div class="description-block">
											<h4><B><span class="description-percentage text-red" id="cannot_est_dmg_text"></span></B></h4>
										</div>
										<!-- /.description-block -->
									</div>
									<!-- /.col -->
									<div class="col-sm-4">
										<div class="description-block">
											<h5 class="description-header">มูลค่าโครงการ</h5>
											<h4><B><span class="description-percentage text-red" id="crp_dmg_off"></span></B></h4>

										</div>
									</div>
									<div class="col-sm-4 border-left">
										<div class="description-block">
											<h5 class="description-header">ความเสียหาย</h5>
											<h4><B><span class="description-percentage text-red" id="ofd_dmg"></span></B></h4>
										</div>
										<!-- /.description-block -->
									</div>
								</div>

							</div>


						</div>

						<div class="box box-primary" id="div_for_msg_in_page">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-envelope"></i> ข้อความในเพจ </B></h3>

								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool text-primary" id="add_msg_inbox">
										<font color="green"><B><i class="fa fa-plus-circle"></i> เพิ่ม </B></font>
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<div class="col-sm-4">
										<form class="form-horizontal">
											<div class="input-group">
												<span class="input-group-addon" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;" id="delete_msg_inbox"><i class="fa fa-minus"></i></span>

												<select class="form-control" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px" id="list_4_select_msg_inbox_case">
												</select>

												<span class="input-group-addon" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;" id="jump_msg"><i class="fa fa-commenting"></i></span>
												<input type="text" style="display: none;">
											</div>

										</form>
									</div>
									<div class="col-sm-8">
										<div class="direct-chat-messages" style="overflow:auto;height:400px;" id="msg_result_box">
										</div>
									</div>
								</div>
							</div>

						</div>






						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-bullhorn"></i> การเผยแพร่ผ่านสื่อ/การตรวจสอบ/ความเคลื่อนไหว</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</div>
							</div>

							<div class="box-body">
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#uap_tab_1" data-toggle="tab">การเผยแพร่ผ่านสื่อ</a></li>
										<li><a href="#uap_tab_2" data-toggle="tab">การตรวจสอบจากหน่วยงาน</a></li>
										<li><a href="#uap_tab_0" data-toggle="tab">ความเคลื่อนไหว</a></li>
									</ul>
									<div class="tab-content">

										<div class="tab-pane active" id="uap_tab_1">
											<form class="form-horizontal">

												<div class="form-group">
													<label for="case_a_pub_title" class="col-sm-3 control-label">หัวข้อ<font color="red">*</font></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_pub_title" autocomplete="off" />
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_pub_url" class="col-sm-3 control-label">ลิ้ง</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_pub_url" autocomplete="off" />
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_pub_name" class="col-sm-3 control-label">ช่องทาง<font color="red">*</font></label>
													<div class="col-sm-5" id="select_pub_chanel">

													</div>
												</div>

												<div class="form-group">
													<label for="case_a_pub_date" class="col-sm-3 control-label">วันที่เผยแพร่<font color="red">*</font></label>
													<div class="col-sm-3">
														<input type="text" class="form-control" id="case_a_pub_date" readonly />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label"></label>
													<div class="col-sm-3">
														<button type="button" class="btn  btn-primary pull-left" id="btn_case_pub_add">บันทึกข้อมูล</button>
													</div>
												</div>

											</form>
										</div>
										<!-- /.tab-pane -->
										<div class="tab-pane" id="uap_tab_2">
											<form class="form-horizontal" id="f_add_eff_info">

												<div class="form-group">
													<label for="case_a_eff_name" class="col-sm-3 control-label">หน่วยงาน<font color="red">*</font></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_eff_name" />
													</div>
												</div>
												<div class="form-group">
													<label for="case_a_eff_name" class="col-sm-3 control-label">ประเภทหน่วยงาน<font color="red">*</font></label>
													<div class="col-sm-8">
														<select class="form-control" id="case_a_eff_type">
														</select>
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_eff_detail" class="col-sm-3 control-label">ผลการตรวจสอบ</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_eff_detail" autocomplete="off" />
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_eff_url" class="col-sm-3 control-label">อ้างอิง(URL)</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_eff_url" autocomplete="off" />
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_eff_date" class="col-sm-3 control-label">วันที่ตรวจสอบ<font color="red">*</font></label>
													<div class="col-sm-5">
														<input type="text" class="form-control" id="case_a_eff_date" readonly />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label"></label>
													<div class="col-sm-3">
														<button type="button" class="btn  btn-primary pull-left" id="btn_case_eff_add">บันทึกข้อมูล</button>
													</div>
												</div>

											</form>
										</div>
										<!-- /.tab-pane -->

										<div class="tab-pane" id="uap_tab_0">
											<form class="form-horizontal">

												<div class="form-group">
													<label for="case_a_pub_url" class="col-sm-3 control-label">รายละเอียด<font color="red">*</font></label>
													<div class="col-sm-8">
														<input type="text" class="form-control" id="case_a_pub_oth_detail" autocomplete="off" />
													</div>
												</div>

												<div class="form-group">
													<label for="case_a_pub_oth_date" class="col-sm-3 control-label">วันที่<font color="red">*</font></label>
													<div class="col-sm-5">
														<input type="text" class="form-control" id="case_a_pub_oth_date" readonly />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label"></label>
													<div class="col-sm-8">
														<button type="button" class="btn  btn-primary pull-left" id="btn_case_pub_add_oth">บันทึกข้อมูล</button>
													</div>
												</div>

											</form>
										</div>
										<!-- /.tab-pane -->
									</div>
									<!-- /.tab-content -->
								</div>
							</div>

						</div>

						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-users"></i> ผู้มีส่วนเกี่ยวข้อง</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="col-sm-6">
									<h5><B>ผู้ส่งข้อมูล</B></h5>
									<div id="sender_panel">

									</div>
									<form class="form-horizontal">
										<div class="form-group">
											<div class="col-sm-10">
												<input type="text" class="form-control" id="case_a_snd_info" placeholder="หมาเฝ้าบ้าน/ลิ้งค์บุคคลภายนอก">
											</div>

										</div>
										<div class="form-group">
											<label class="col-sm-2 col-xs-12 control-label">วันที่ส่งข้อมูล</label>
											<div class="col-sm-6 col-xs-8">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="snd_date" readonly>
												</div>
											</div>
											<div class="col-sm-2 col-xs-4">
												<button type="button" class="btn bg-primary" id="btn_add_sender">เพิ่ม</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-sm-6">
									<h5><B>Staff ผู้ปฏิบัติงาน</B></h5>
									<div id="operator_staff_panel">
									</div>
									<form class="form-horizontal">
										<div class="form-group">
											<div class="col-xs-8">
												<select class="form-control" id="case_staff">
												</select>
											</div>
											<div class="col-xs-2">
												<button type="button" class="btn bg-primary" id="btn_add_opr_staff">เพิ่ม</button>
											</div>
										</div>
									</form>
									<h5><B>ทีมสื่อสาร</B></h5>
									<form class="form-horizontal">
										<div class="form-group">
											<div class="col-xs-8">
												<select id="c_table_team" class="form-control" multiple="multiple">
												</select>
											</div>
										</div>
									</form>

								</div>

							</div>
						</div>

						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-child"></i>หมาหมู่</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<div class="col-sm-6">
									<h5><B>ทีมที่มีส่วนร่วม</B></h5>
									<form class="form-horizontal">
										<div class="form-group">
											<div class="col-xs-8">
												<select class="form-control" id="team_list">
												</select>
											</div>
											<div class="col-xs-2">
												<button type="button" class="btn bg-primary" id="btn_add_team_support">เพิ่ม</button>
											</div>
										</div>
									</form>
									<div id="team_support_panel">

									</div>


								</div>
								<div class="col-sm-6">
									<h5><B>ผู้มีส่วนร่วม</B></h5>
									<form class="form-horizontal" onSubmit="return false;">
										<div class="form-group">
											<div class="col-xs-8">
												<input type="text" class="form-control" id="case_add_wd_support" placeholder="หมาเฝ้าบ้าน">
											</div>
											<div class="col-xs-2">
												<button type="button" class="btn bg-primary" id="btn_add_wd_support">เพิ่ม</button>
											</div>
										</div>
									</form>
									<div id="wd_support_panel">

									</div>
								</div>

							</div>
						</div>

					</div>


					<div class="col-md-4">

						<div class="box box-danger" style="display: none;" id="gov_check_box_pan">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-warning"></i> ข้อมูลการถูกตรวจสอบ</B></h3>
							</div>

							<div class="box-body">
								<div class="row">
									<div class="col-sm-12" style="padding: 0px 20px" id="gov_check_data_panal">
									</div>
								</div>
							</div>

						</div>



						<div class="box box-info">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-facebook"></i> ข้อมูลในศูนย์</B></h3>
								<div class="box-tools pull-right">
									<a type="button" class="btn btn-box-tool" id="bref_case_url" href=""><i class="fa fa-briefcase"></i></a>
									<button type="button" class="btn btn-box-tool" id="btn_edit_case_link"><i class="fa fa-pencil"></i></button>
								</div>
							</div>

							<div class="box-body">
								<div class="row">
									<div class="col-sm-12">
										<button type="button" class="btn bg-primary" id="btn_add_case_link">เพิ่มข้อมูลในศูนย์</button>
										<button type="button" class="btn bg-danger" id="Delete_selected_group_case" style="display: none;">ลบ</button>
										<!-- /.description-block -->
									</div>
									<div class="col-sm-12" id="group_post_data_result">

									</div>
								</div>
							</div>

						</div>


						<div class="box box-danger">
							<div class="box-header with-border">
								<h3 class="box-title"><B> ACT AI</B></h3>
							</div>

							<div class="box-body">
								<div class="input-group">
									<input type="text" placeholder="ACT AI URL" id="case_text_case_url" class="form-control">
									<span class="input-group-addon c_hover" id="add_case_url"><i class="fa fa-plus"></i></span>
								</div>
								<BR>
								<div id="case_url_preview">
								</div>
							</div>

						</div>

						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-file"></i> ไฟล์ที่เกี่ยวข้อง</B></h3>
							</div>

							<div class="box-body" style="text-align: center;">
								<div class="row">
									<div class="col-sm-12" id="gg_drive_link">

									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="gallery" style="overflow:auto;max-height:400px;" id="attached_img_gallery"></div>
									</div>
								</div>
							</div>

						</div>










						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-info-circle"></i> ประเภทการทุจริต</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id="btn_edit_type"><i class="fa fa-plus"></i></button>
								</div>
							</div>

							<div class="box-body">
								<div id="ofd_type_2_panel">
								</div>

								<div id="add_crp_type_2" style="display: none;">
									<div class="form-group">
										<label for="crp_type_x2" class="col-sm-3 control-label">ประเภทการทุจริต</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="crp_type_x2" placeholder="ประเภทการทุจริต">
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-12" id="crp_type_x2_select_panel">

										</div>
									</div>
								</div>
							</div>

						</div>




						<div class="info-box" style="display: none;">
							<span class="info-box-icon" id="btn_edit_link"><i class="fa fa-external-link"></i></span>
							<div class="info-box-content">
								<div class="col-sm-6 border-right">
									<div class="description-block">
										<span class="info-box-number"><a id="case_cnt_url" target="_blank"><i class="fa fa-facebook-square"> ลิ้งในศูนย์</i></a></span>
									</div>
									<!-- /.description-block -->
								</div>
								<div class="col-sm-6 border-right">
									<div class="description-block">
										<span class="info-box-number"><a id="case_folder_url" target="_blank"><i class="fa fa-folder"></i> Folder งาน</a></span>
									</div>
									<!-- /.description-block -->
								</div>
							</div>
							<!-- /.info-box-content -->
						</div>
						<div class="info-box bg-aqua" id="btn_edit_date">
							<span class="info-box-icon"><i class="fa fa-calendar"></i></span>
							<div class="info-box-content">
								<span class="info-box-text">รับเข้าระบบ <span id="add_date_text"></span></span>
								<span class="info-box-number">กำหนดเสร็จ <span id="finished_date_text"></span></span>

								<div class="progress">
									<div class="progress-bar" style="width: 0%" id="remain_percentage"></div>
								</div>
								<span class="progress-description">เหลือเวลาอีก <span id="from_now"></span> วันจะถึงกำหนดเสร็จ</span>
							</div>
							<!-- /.info-box-content -->
						</div>
						<!-- Info Boxes Style 2 -->

						<div>
							<!-- The time line -->
							<ul class="timeline" id="timeline_new">
							</ul>

						</div>


						<div class="box box-primary" style="display: none;">
							<div class="box-header with-border">
								<h3 class="box-title"><B><i class="fa fa-cube"></i> Timeline</B></h3>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							<div class="box-body">
								<ul class="timeline" id="timeline_data">

								</ul>
								<!-- END timeline item -->
							</div>

						</div>
					</div>
				</div>
				<!--------------------------
        | Your Page Content Here |
        -------------------------->

				<!--------------------------
        |                MODAL               |
        -------------------------->
				<div class="modal fade" id="modal-load_data">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title"><i class="fa fa-spinner fa-spin"></i>กำลังโหลดข้อมูล...</h4>
							</div>
							<div class="modal-body" id="modal-summary-data">
								<div class="row">
									<div class="col-md-2 col-md-offset-3">
										<img src="img/load.gif" />
									</div>
								</div>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="modal_update_info">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">แก้ไขข้อมูลพื้นฐานการตรวจสอบทุจริต</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_update_info">
										<div class="box-body">

											<div class="form-group">
												<label for="u_case_name" class="col-sm-3 control-label">หัวข้อ<font color="red">*</font></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="u_case_name" placeholder="หัวข้อทุจริต">
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_summary" class="col-sm-3 control-label">รายละเอียด</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="u_case_summary" placeholder="รายละเอียดคร่าวๆ">
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_priority" class="col-sm-3 control-label">ความสำคัญ</label>
												<div class="col-sm-4">
													<select class="form-control" id="u_case_priority">
														<option value="0">รอได้</option>
														<option value="1">ปกติ</option>
														<option value="2">สำคัญ</option>
														<option value="3">เร่งด่วน</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_note" class="col-sm-3 control-label">Note</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="u_case_note" placeholder="Note">
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_note" class="col-sm-3 control-label"></label>
												<div class="col-sm-4">
													<div class="checkbox">
														<input type="checkbox" id="u_case_cannot_estimate_check" class="flat-red"> ไม่สามารถประเมินราคาได้
													</div>
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_ofd_dmg" class="col-sm-3 control-label">มูลค่าโครงการ</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="u_case_ofd_dmg" placeholder="มูลค่าโครงการ" value="0">
												</div>
											</div>

											<div class="form-group">
												<label for="u_case_ofd_dmg2" class="col-sm-3 control-label">ความเสียหาย</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="u_case_ofd_dmg2" placeholder="ความเสียหาย(วงเงิน)" value="0">
												</div>
											</div>


										</div>
										<!-- /.box-body -->
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_info">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="modal_update_status">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">อัพเดทสถานะการตรวจสอบทุจริต</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f8_1">
										<div class="box-body">

											<div class="form-group">
												<label for="c_n_status" class="col-sm-3 control-label">สถานะ</label>
												<div class="col-sm-4">
													<select class="form-control" id="c_n_status">
														<option value="1">ทำข้อมูล</option>
														<option value="2">รอข้อมูล</option>
														<option value="3">ชะลอ</option>
														<option value="4">ยุติ</option>
														<option value="5">ลงเพจ</option>
													</select>
												</div>
											</div>


											<div class="form-group">
												<label for="c_n_deteil" class="col-sm-3 control-label">รายละเอียด</label>
												<div class="col-sm-8">
													<textarea class="form-control" rows="3" id="c_n_deteil" placeholder="ข้อมูลอัพเดท" style="overflow:auto;resize:none"></textarea>
												</div>
											</div>

											<div class="form-group">
												<label for="c_n_url" class="col-sm-3 control-label">ลิ้งที่เกี่ยวข้อง</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="c_n_url" placeholder="URL">
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_status">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="modal_update_status_v2">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">อัพเดทสถานะการตรวจสอบทุจริต</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f8">
										<div class="box-body">

											<div class="form-group">
												<div class="col-sm-12" id="c_n_status_tag_select">
												</div>
											</div>

											<div class="form-group" id="case_stop_tag_panel" style="display: none;">
												<label for="c_n_deteil" class="col-sm-3 control-label">สาเหตุ</label>
												<div class="col-sm-9" id="case_stop_tag">
												</div>
											</div>


											<div class="form-group">
												<label for="c_n_deteil_new" class="col-sm-3 control-label">รายละเอียด</label>
												<div class="col-sm-8">
													<textarea class="form-control" rows="3" id="c_n_deteil_new" placeholder="ข้อมูลอัพเดท" style="overflow:auto;resize:none"></textarea>
												</div>
											</div>

											<div class="form-group" id="new_fin_date_for_postpone_panel" style="display: none;">
												<label for="" class="col-sm-3 control-label">กำหนดเสร็จ</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="new_fin_date_for_postpone" readonly />
												</div>
											</div>

											<div class="form-group" id="case_time_panel">
												<label for="c_n_upd_time" class="col-sm-3 control-label">เวลาบันทึก</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="c_n_upd_time">
												</div>
											</div>

											<div class="form-group" id="case_url_panel">
												<label for="c_n_url" class="col-sm-3 control-label">ลิ้งที่เกี่ยวข้อง</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="c_n_url_new" placeholder="URL" autocomplete="off">
												</div>
											</div>



											<div class="form-group" id="case_search_post_panel" style="display: none;">
												<label for="c_n_url" class="col-sm-3 control-label">ค้นหา</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="c_n_post_new" autocomplete="off">
												</div>
											</div>

											<div class="form-group" id="case_search_post_result_panel" style="display: none;">
												<label for="c_n_url" class="col-sm-3 control-label"></label>
												<div class="col-sm-8" id="search_post_result">
												</div>
											</div>

										</div>
										<!-- /.box-body -->
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_status_new">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" role="dialog" id="modal_edit_type">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">แก้ไขประเภททุจริต</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_edit_type">
										<div class="box-body">

											<div class="form-group">
												<label for="case_u_select_type" class="col-sm-3 control-label">ประเภท</label>
												<div class="col-sm-8">
													<select class="form-control" id="case_u_select_type">
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="case_u_case_other" class="col-sm-3 control-label"></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="case_u_case_other" placeholder="อื่นๆ" />
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_type">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" role="dialog" id="modal_edit_url">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">แก้ไขลิ้งงาน</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_edit_url">
										<div class="box-body">

											<div class="form-group" style="display: none;">
												<label for="case_u_cnt_url" class="col-sm-3 control-label">ลิ้งในศูนย์</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="case_u_cnt_url" placeholder="URL" />
												</div>
											</div>

											<div class="form-group">
												<label for="case_u_wfd_url" class="col-sm-3 control-label">ลิ้ง Folder งาน</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="case_u_wfd_url" placeholder="URL" />
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_link">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" role="dialog" id="modal_edit_date">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">แก้ไขวันที่</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_edit_date">
										<div class="box-body">

											<div class="form-group">
												<label for="case_u_date" class="col-sm-3 control-label">ลงทะเบียนงาน</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="case_u_date_in" disabled />
												</div>
											</div>

											<div class="form-group">
												<label for="case_u_date" class="col-sm-3 control-label">กำหนดเสร็จ</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="case_u_date_fin" readonly />
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_date">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<div class="modal fade" id="modal_add_from_group">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">โพสในศูนย์</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="f9">
									<div class="box-body">

										<div class="form-group" id="case_search_post_panel_2">
											<label for="group_post_search" class="col-sm-3 control-label">ค้นหา<font color="red">*</font></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="group_post_search" autocomplete="off">
											</div>
										</div>
										<input type="text" class="form-control" autocomplete="off" style="display: none;">
										<div class="form-group" id="search_group_post_result_panel">
											<label for="search_post_result_2" class="col-sm-3 control-label"></label>
											<div class="col-sm-8" id="search_group_post_result">
											</div>
										</div>

									</div>
									<!-- /.box-body -->
								</form>

							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>

				<div class="modal fade" role="dialog" id="modal_add_ofd">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">เพิ่มหน่วยงาน</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_edit_date_1">
										<div class="box-body">

											<div class="form-group">
												<label for="case_a_ofd_name" class="col-sm-3 control-label">ชื่อหน่วยงาน<font color="red">*</font></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="case_a_ofd_name" autocomplete="off" />
												</div>
											</div>

											<div class="form-group">
												<label for="ofd_type_2" class="col-sm-3 control-label">ประเภทหน่วยงาน</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="ofd_type_2" />
												</div>
											</div>


											<div class="form-group" id="select_ofd_type_2_panel" style="display: none;">
												<label for="select_ofd_type_2_panel2" class="col-sm-3 control-label"></label>
												<div class="col-sm-8" id="select_ofd_type_2_panel2">

												</div>
											</div>

											<div class="form-group">
												<label for="ofd_add_province" class="col-sm-3 col-xs-12 control-label">จังหวัด/อำเภอ<font color="red">*</font></label>
												<div class="col-sm-4  col-xs-6">
													<select class="form-control" id="ofd_add_province">
													</select>
												</div>
												<div class="col-sm-4  col-xs-6">
													<select class="form-control" id="ofd_add_aumpher">
													</select>
												</div>
											</div>
											<div class="form-group" id="sw3">
												<label for="ofd_geo" class="col-sm-3 control-label">ภาค</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="ofd_geo" placeholder="ภาค" disabled>
												</div>
											</div>
											<div class="form-group" id="sw4">
												<label for="ofd_lo_name" class="col-sm-3 control-label">ประเภท<font color="red">*</font></label>
												<div class="col-sm-6">
													<select class="form-control" id="select_org_type">
													</select>
												</div>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_add_ofd">เพิ่มหน่วยงาน</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->


				<div class="modal fade" role="dialog" id="modal_add_ofd_person">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">เพิ่มชื่อผู้กระทำผิด</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f_add_ofd_person">
										<div class="box-body">
											<div class="form-group">
												<label for="new_ofd_name" class="col-sm-3 control-label">ชื่อ<font color="red">*</font></label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="new_ofd_name" autocomplete="off" />
												</div>
											</div>

											<div class="form-group">
												<label for="new_ofd_pos" class="col-sm-3 control-label">ตำแหน่ง</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="new_ofd_pos" autocomplete="off" />
												</div>
											</div>

											<div class="form-group">
												<label for="new_ofd_detail" class="col-sm-3 control-label">รายละเอียด</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="new_ofd_detail" autocomplete="off" />
												</div>
											</div>

										</div>
										<!-- /.box-body -->
									</form>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_add_ofd_person">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<div class="modal fade" id="modal_send_data_info">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ข้อมูลเพิ่มเติมสำหรับ ผู้ส่งข้อมูลภายนอก</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="f_snder">
									<div class="form-group">
										<label for="snd_info_facebook" class="col-sm-4 control-label">Facebook</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_facebook" placeholder="Link facebook">
										</div>
									</div>
									<div class="form-group">
										<label for="snd_info_Line" class="col-sm-4 control-label">Line</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_Line" placeholder="Line ID">
										</div>
									</div>
									<div class="form-group">
										<label for="snd_info_mail" class="col-sm-4 control-label">E-Mail</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_mail" placeholder="Email Address">
										</div>
									</div>
									<div class="form-group">
										<label for="snd_info_tel" class="col-sm-4 control-label">โทร</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_tel" placeholder="เบอร์โทร">
										</div>
									</div>
									<div class="form-group">
										<label for="snd_info_tel" class="col-sm-4 control-label">ตำแหน่ง/อาชีพ</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_occ" placeholder="ตำแหน่ง/อาชีพ">
										</div>
									</div>

									<div class="form-group">
										<label for="snd_info_tel" class="col-sm-4 control-label">ความเกี่ยวข้อง</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_relate" placeholder="ความเกี่ยวข้อง">
										</div>
									</div>

									<div class="form-group">
										<label for="snd_info_tel" class="col-sm-4 control-label">Note</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="snd_info_note" placeholder="Note">
										</div>
									</div>


								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn  bg-primary" id="btn_add_oth_snd">ตกลง</button>
								<button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="modal_update_after_pub">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ลงเพจอีกครั้ง</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" id="f9_1">
									<div class="box-body">
										<div class="form-group">
											<label for="c_n_deteil_new_2" class="col-sm-3 control-label">รายละเอียด</label>
											<div class="col-sm-8">
												<textarea class="form-control" rows="3" id="c_n_deteil_new_2" placeholder="ข้อมูลอัพเดท" style="overflow:auto;resize:none"></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="new_episode" class="col-sm-3 control-label"></label>
											<div class="col-sm-8">
												<div class="checkbox">
													<input type="checkbox" id="new_episode" class="flat-red" checked> Episode
												</div>
											</div>
										</div>
										<div class="form-group" id="case_search_post_panel_2">
											<label for="c_n_post_new_2" class="col-sm-3 control-label">ค้นหา<font color="red">*</font></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_n_post_new_2" autocomplete="off">
											</div>
										</div>
										<input type="text" class="form-control" autocomplete="off" style="display: none;">
										<div class="form-group" id="search_post_result_2_panel">
											<label for="search_post_result_2" class="col-sm-3 control-label"></label>
											<div class="col-sm-8" id="search_post_result_2">
											</div>
										</div>

									</div>
									<!-- /.box-body -->
								</form>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_new_post">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>

				<div class="modal fade" id="modal_select_support_type">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ประเภทการช่วย</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<form class="form-horizontal" id="f_supporter_wd">
											<select class="form-control" id="select_support_type_for_wd">
											</select>
										</form>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn  bg-primary" id="bt_confirm_add_suppot_wd">ตกลง</button>
								<button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>

				<div class="modal fade" id="select_inbox_msg">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ข้อความในเพจ</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<!-- Conversations are loaded here -->
										<div>
											<div class="input-group">
												<input type="text" id="search_text_case_msg" style="border-top-left-radius: 5px;border-bottom-left-radius: 5px" class="form-control" placeholder="ค้นหา" autocomplete="off" />
												<span class="input-group-addon" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;" id="load_spin_contact_list"><i class="fa fa-search"></i></span>
												<input type="text" style="display: none;">
											</div>
											<ul class="contacts-list" id="contact_list_panel">

											</ul>
										</div>

									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>



				<div class="modal fade" id="modal_show_attached_image">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-body">
								<img class="img-attached-show" id="img-attached-show" src="https://images.unsplash.com/photo-1485889397316-8393dd065127?dpr=1&auto=format&fit=crop&w=1500&h=843&q=80&cs=tinysrgb&crop=" alt="" />
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
	<script src="dist/chartjs/utils.js"></script>
	<!-- J-ui tab -->
	<script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
	<!-- bootstrap datepicker -->
	<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="plugins/iCheck/icheck.min.js"></script>

	<!-- Notify -->
	<script src="plugins/notify/notify.js"></script>
	<!-- Bootstrap Tags Input Plugin Js -->
	<script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<!-- Typehead -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

	<!-- Moment with Local -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>

	<!-- Date Time Picker-->
	<script src="bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>

	<!-- Select2-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
	<script>
		$(function() {
			$.widget("custom.catcomplete", $.ui.autocomplete, {
				_create: function() {
					this._super();
					this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
				},
				_renderMenu: function(ul, items) {
					var that = this,
						currentCategory = "";
					$.each(items, function(index, item) {
						var li;
						if (item.category != currentCategory) {
							ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
							currentCategory = item.category;
						}
						li = that._renderItemData(ul, item);
						if (item.category) {
							li.attr("aria-label", item.category + " : " + item.label);
						}
					});
				}
			});
		});
	</script>
	<script>
		// Initial Load Data
		swal({
			type: 'info',
			title: 'กำลังโหลดข้อมูล',
			text: "กรุณารอสักครู่",
			allowOutsideClick: false,
			showConfirmButton: false,
		});


		$(document).ready(function() {



			// Initial function

			//var passhash = CryptoJS.MD5("TEST").toString();
			//alert (passhash);

			// Moment Setting
			moment.locale('th');


			// Initial count load
			var count_initial_process = 0;


			// Update Status time initial
			$('#c_n_upd_time').datetimepicker({
				dayViewHeaderFormat: 'DD MMM YYYY',
				format: 'DD MMMM YYYY HH:mm',
				locale: 'th',
				defaultDate: moment()
			});

			//Date picker
			$('#case_u_date_in').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})

			//Date picker
			$('#case_u_date_fin').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})

			//Date picker
			$('#new_fin_date_for_postpone').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})

			//Date picker
			$('#snd_date').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			$("#snd_date").datepicker("setDate", new Date());

			//Date picker
			$('#case_a_pub_date').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			$("#case_a_pub_date").datepicker("setDate", new Date());


			//Date picker
			$('#case_a_pub_oth_date').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			$("#case_a_pub_oth_date").datepicker("setDate", new Date());

			// case_a_eff_date
			$('#case_a_eff_date').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			$("#case_a_eff_date").datepicker("setDate", new Date());







			function mobileAndTabletcheck() {
				var check = false;
				(function(a) {
					if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
				})(navigator.userAgent || navigator.vendor || window.opera);
				return check;
			};

			var __CHKMB = mobileAndTabletcheck();

			// Global Var  ================
			// Crp type
			var case_crp_type = "0";
			var case_crp_other_data = "";

			// Status ID

			var case_cnt_status = 0;
			// Date in and finished

			var date_u_in = "";
			var date_u_finished = "";

			// Ofd_name
			var ofd_name_arr = [];
			var ofd_type_arr = [];
			var ofd_type2_arr = [];
			var ofd_location_arr = [];

			// Sender info
			var c_snd_type = [];
			var c_snd_name = [];
			var c_snd_line = [];
			var c_snd_email = [];
			var c_snd_tel = [];
			var c_snd_date = [];
			var c_snd_b_name = [];
			var c_snd_n_name = [];
			var c_snd_gen = [];
			// Add 2019-03-02
			var c_snd_occ = [];
			var c_snd_relate = [];
			var c_snd_note = [];


			// Team_support
			var support_team_id = [];
			var support_team_name = [];



			// WD support
			var support_wd_id = [];
			var support_wd_name = [];
			var support_wd_n_name = [];
			var support_wd_gen = [];

			// Staff operator
			var support_staff_type = [];
			var support_staff_id = [];
			var support_staff_name = [];
			var support_staff_n_name = [];


			var case_ofd_type_data_label = [];
			var case_ofd_type_data_id = [];

			var crp_type_current_data = [];


			var case_job_type_current_data = [];

			var current_select_case_status = 0;
			var current_selected_case_status = 99;

			var case_stop_select = "";

			var availableTags_c_case_job_type = [];
			var availableTags_ofd_type_2 = ['โรงเรียน', 'มหาวิทยาลัย', 'โรงพยาบาล', 'สารธารณสุข', 'ทางหลวง', 'ทางหลวงชนบท'];
			var availablecase_stop_tag = ['ไม่พบการทุจริต', 'ข้อมูลไม่เพียงพอ', 'ผู้ให้ข้อมูลหาย', 'เป็นข่าวแล้ว', 'โครงการถูกยุติ'];
			var availablepub_chanel_tag = ['ทีวี', 'Online/Web', 'หนังสือพิมพ์', 'อื่นๆ'];

			var selected_post_from_page_value = "";
			var selected_post_from_page_pub_time = "";

			var selected_post_from_page_value_2 = "";
			var selected_post_from_page_pub_time_2 = "";

			var selected_pub_chanel = ""


			var xlv = <?php echo $user_level; ?>;


			var global_random_no = "";


			// ++++++++++  Standard Ajax Function ++++++++++
			function isUrlValid(url) {
				return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
			}

			function ajax_function($f, d_name, $p1, $p2, $p3) {
				// Check parameter has been set or not
				$f = $f || "0";
				$p1 = $p1 || "0";
				$p2 = $p2 || "0";
				$p3 = $p3 || "0";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: $f,
							p1: $p1,
							p2: $p2,
							p3: $p3
						})
					})

					.done(function(data) {
						$(d_name).html(data);
						update_initial_process();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			function ajax_function2($f, d_name, $p1, $p2, $p3) {
				// Check parameter has been set or not
				$f = $f || "0";
				$p1 = $p1 || "0";
				$p2 = $p2 || "0";
				$p3 = $p3 || "0";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: $f,
							p1: $p1,
							p2: $p2,
							p3: $p3
						})
					})

					.done(function(data) {
						$(d_name).val(data);
						update_initial_process();
						//document.getElementById(d_name).innerHTML = data;
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};


			// Standard Ajax Function 
			function get_case_data() {
				// Set Ajax
				//$('#modal-load_data').modal('show');
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: '11',
							p1: '<?php echo $case_id; ?>'
						})
					})
					.done(function(data) {
						var ojb = JSON.parse(data);

						// Basic Information
						$("#case_id").html(ojb.case_id);
						$("#priority_text").html(ojb.priority_text);
						$("#note").html(ojb.note);
						$("#status_text").html(ojb.status_text);
						$("#status_text_warnning").html("คลิกเพื่อเปลี่ยนสถานะ");
						case_cnt_status = ojb.status;
						$("#box_status").removeClass();
						switch (ojb.status) {
							case "0":
								$("#box_status").addClass("box box-solid bg-aqua");
								break;
							case "1":
								$("#box_status").addClass("box box-solid bg-light-blue");
								break;
							case "2":
								$("#box_status").addClass("box box-solid bg-yellow");
								break;
							case "3":
								$("#box_status").addClass("box box-solid bg-maroon");
								break;
							case "4":
								$("#box_status").addClass("box box-solid bg-red");
								$("#status_text_warnning").html("");
								break;
							case "5":
								$("#box_status").addClass("box box-solid bg-green");
								$("#status_text_warnning").html("คลิกเพื่อบันทึกการโพสลงเพจอีกครั้ง");
								$("#gov_check_box_pan").show();
								break;
							case "6":
								$("#box_status").addClass("box box-solid bg-yellow");
								break;
							case "7":
								$("#box_status").addClass("box box-solid bg-green");
								break;
							case "8":
								$("#box_status").addClass("box box-solid bg-yellow");
								break;
							default:
								$("#box_status").addClass("box box-solid bg-navy");
						}


						$("#t_sum").html(ojb.t_sum);
						$("#u_case_summary").val(ojb.t_sum);

						$("#topic").html(ojb.topic);
						$("#u_case_name").val(ojb.topic);
						$("#u_case_priority").val(ojb.priority);


						if (ojb.cannot_est_dmg == "1") {
							$('#u_case_cannot_estimate_check').iCheck('check');
						} else {
							$('#u_case_cannot_estimate_check').iCheck('uncheck');
						}


						$("#u_case_note").val(ojb.note);

						$("#u_case_ofd_dmg").val(ojb.crp_dmg1);

						$("#u_case_ofd_dmg2").val(ojb.crp_dmg2);


						$("#cannot_est_dmg_text").html(ojb.cannot_est_dmg_text);
						$("#crp_dmg_off").html(ojb.crp_dmg_off);
						$("#ofd_dmg").html(ojb.ofd_dmg);


						$("#from_now").html(ojb.from_now);
						$("#add_date_text").html(ojb.add_date_text);

						// Set value date
						date_u_in = ojb.date_in;
						date_u_finished = ojb.date_finished;

						$("#finished_date_text").html(ojb.finished_date_text);
						//alert (ojb.case_cnt_url);
						if (ojb.case_cnt_url == "#") {
							$("#case_cnt_url").hide("fast");
						} else {
							$("#case_cnt_url").show("fast");
						}

						if (ojb.case_folder_url == "#") {
							$("#case_folder_url").hide("fast");
							$("#bref_case_url").hide();
						} else {
							$("#case_folder_url").show("fast");
							$("#bref_case_url").show("fast");
						}

						$("#case_cnt_url").attr("href", ojb.case_cnt_url)
						$("#case_folder_url").attr("href", ojb.case_folder_url)
						$("#bref_case_url").attr("href", ojb.case_folder_url)




						$('div#remain_percentage').width(ojb.remain_percentage);
						//$('#modal-load_data').modal('hide');
						update_initial_process();

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			$('body').on('click', '#toggle_sb_bt', function() {
				var add_data = {}
				add_data['f'] = '16';
				add_data['staff_key_id'] = '<?php echo $staff_key_id; ?>';
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_0_index.php',
					data: (add_data)
				});
			});



			// Standard Ajax Function 
			function get_ofd_name_list() {
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: '17',
							p1: '<?php echo $case_id; ?>'
						})
					})
					.done(function(data) {
						var ojb = JSON.parse(data);
						ofd_name_arr = ojb.ofd_name.split('-,-');
						ofd_type_arr = ojb.ofd_type.split('-,-');
						ofd_type_2_arr = ojb.ofd_type_2.split('-,-');
						ofd_location_arr = ojb.ofd_location.split('-,-');
						print_ofd_list();
						//alert(ofd_location_arr)
						update_initial_process();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			// Standard Ajax Function 
			function get_case_sender() {
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: '18',
							p1: '<?php echo $case_id; ?>'
						})
					})
					.done(function(data) {
						var ojb = JSON.parse(data);

						c_snd_type = ojb.c_snd_type.split('-,-');
						c_snd_name = ojb.c_snd_name.split('-,-');
						c_snd_line = ojb.c_snd_line.split('-,-');
						c_snd_email = ojb.c_snd_email.split('-,-');
						c_snd_tel = ojb.c_snd_tel.split('-,-');
						c_snd_date = ojb.c_snd_date.split('-,-');
						c_snd_b_name = ojb.c_snd_b_name.split('-,-');
						c_snd_n_name = ojb.c_snd_n_name.split('-,-');
						c_snd_gen = ojb.c_snd_gen.split('-,-');
						// Add 2019-03-02
						c_snd_occ = ojb.c_snd_occ.split('-,-');
						c_snd_relate = ojb.c_snd_relate.split('-,-');
						c_snd_note = ojb.c_snd_note.split('-,-');



						print_sender_list();
						update_initial_process();

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			function get_team_support() {
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: '19',
							p1: '<?php echo $case_id; ?>'
						})
					})
					.done(function(data) {
						var ojb = JSON.parse(data);
						//alert(data)
						support_team_id = ojb.support_team_id.split('-,-');
						support_team_name = ojb.support_team_name.split('-,-');
						print_team_support();
						update_initial_process();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			function get_wd_support() {
				var add_data = {}
				add_data['f'] = '65';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = '<ul class="users-list clearfix">';
							jQuery.each(data_arr, function(i, val) {
								print_text += ' <li><button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_wd_support" value="' + val.wd_id + '"><small>&times;</small></button>';
								print_text += ' <img src="img/wd_img/' + val.wd_img + '" alt="User Image">';
								if (xlv == 2) {
									print_text += ' <span class="users-list-name">' + val.n_name + '  <BR><small class="text-muted">' + val.support_type + '</small></span>';
								} else {
									print_text += ' <a class="users-list-name" href="24_member_data.php?wd_id=' + val.wd_id + '" target="_blank">' + val.n_name + '  <BR><small class="text-muted">' + val.support_type + '</small></a>';
								}

								print_text += ' <span class="users-list-date">รุ่น ' + val.gen + '</span>';
								print_text += ' </li>';


								//print_text += '<div class="callout callout-info small">';
								//print_text += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_wd_support" value="'+val.wd_id+'">&times;</button>';


								//if (xlv == 2)
								//{
								//	print_text += '<h4><img src="img/wd_img/'+val.wd_img+'" height="38" width="38"  class="img-circle" alt="User Image">  '+val.n_name+' รุ่น '+val.gen+'</h4>';
								//}
								//else
								//{
								//	print_text += '<h4><img src="img/wd_img/'+val.wd_img+'" height="38" width="38"  class="img-circle" alt="User Image">  '+val.name+' ('+val.n_name+') รุ่น '+val.gen+'</h4>';
								//}



							});
							print_text += ' </ul>';
							$("#wd_support_panel").html(print_text);

						}
						update_initial_process();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			};


			function get_staff_operator() {
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: ({
							f: '21',
							p1: '<?php echo $case_id; ?>'
						})
					})
					.done(function(data) {
						var ojb = JSON.parse(data);

						support_staff_type = ojb.support_staff_type.split('-,-');
						support_staff_id = ojb.support_staff_id.split('-,-');
						support_staff_name = ojb.support_staff_name.split('-,-');
						support_staff_n_name = ojb.support_staff_n_name.split('-,-');

						print_staff_support();
						update_initial_process();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};



			// Custom_for update Status data Ajax Function 
			function ajax_update_status_function() {
				// Get All Data
				var s_update_data = {}
				s_update_data['f'] = '12';

				s_update_data['detail'] = $('textarea#c_n_deteil').val();
				s_update_data['status'] = $("#c_n_status").val();
				s_update_data['url'] = $("#c_n_url").val();
				s_update_data['staff_kid'] = "<?php echo $staff_key_id; ?>";
				s_update_data['case_id'] = "<?php echo $case_id; ?>";

				// Set Ajax
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (s_update_data)
					})
					.done(function(data) {
						//alert(data);
						window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				return false;
			};

			// 
			// Print ofd name list to panel
			function print_ofd_list() {
				var print_text = "";
				if (ofd_name_arr[0] != "") {
					$.each(ofd_name_arr, function(index, value) {
						ofd_type_2_name = ofd_type_2_arr[index].trim();
						if (ofd_type_2_name != "") {
							ofd_type_2_name += " - ";
						}
						print_text += '<div class="col-md-4 col-sm-6 col-xs-12">';
						print_text += '<div class="info-box">';
						print_text += '<span class="info-box-icon bg-aqua"><i class="fa  fa-institution"></i></span>';
						print_text += '<div class="info-box-content">';
						print_text += '<button type="button" class="close" aria-hidden="true" value="' + value + '" id="delete_ofd_location">&times;</button>';
						print_text += '<span class="info-box-number"><small>' + value + '</small></span>';
						print_text += '<span class="info-box-text"><small>' + ofd_location_arr[index] + '</small></span>';
						print_text += '<span class="info-box-text"><small> ' + ofd_type_2_name + ofd_type_arr[index] + '</small></span>';
						print_text += '</div>';
						print_text += '</div>';
						print_text += '</div>';
					});
				}

				print_text += '<div class="col-sm-1" id="plus_ofd_location">';
				print_text += '<span class="info-box-icon bg-gray"><i class="fa fa-plus-circle"></i></span>';
				print_text += '</div>';


				// Print output
				$("#ofd_name_panel").html(print_text);
			}

			// Prinf for sender panel
			function print_sender_list() {
				var print_text = "";
				if (c_snd_type[0] != "") {
					$.each(c_snd_type, function(index, value) {
						dt = c_snd_date[index].split('-');
						snd_date = dt[2] + '/' + dt[1] + '/' + (parseInt(dt[0]) + 543);

						if (value == 0) {

							print_text += '<div class="callout callout-info">';
							print_text += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_sender" value="' + c_snd_name[index] + '">&times;</button>';
							if (xlv == 2) {
								print_text += '<h5><img src="img/wd_img/default.png" height="25" width="25"  class="img-circle" alt="User Image"> ' + c_snd_n_name[index] + ' รุ่น ' + c_snd_gen[index] + ' : ' + snd_date + '</h5>';
							} else {
								print_text += '<h5><img src="img/wd_img/default.png" height="25" width="25"  class="img-circle" alt="User Image"> ' + c_snd_b_name[index] + ' (' + c_snd_n_name[index] + ') รุ่น ' + c_snd_gen[index] + ' : ' + snd_date + '</h5>';
							}

							print_text += '</div>';
						} else {
							show_url = c_snd_name[index];
							if (show_url.length > 30) {
								show_url = show_url.substring(0, 30) + "...";
							}
							print_text += '<div class="callout callout-info">';
							print_text += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_sender" value="' + c_snd_name[index] + '">&times;</button>';

							if (c_snd_name[index].indexOf("https://") != -1) {
								print_text += '<h4><a href="' + c_snd_name[index] + '" target="_blank">' + show_url + ' </a>(' + snd_date + ')</h4>';
							} else {
								print_text += '<h4><a href="https://web.facebook.com/search/top/?q=' + c_snd_name[index] + '" target="_blank">' + show_url + ' </a>(' + snd_date + ')</h4>';
							}


							print_text += '<p>';
							print_text += 'Line : ' + c_snd_line[index] + ' <BR>';
							print_text += 'Email : ' + c_snd_email[index] + ' <BR>';
							print_text += 'Tel :' + c_snd_tel[index] + ' <BR>';
							print_text += 'ตำแหน่ง/อาชีพ :' + c_snd_occ[index] + ' <BR>';
							print_text += 'ความเกี่ยวข้อง :' + c_snd_relate[index] + ' <BR>';
							print_text += 'Note :' + c_snd_note[index] + ' <BR>';
							print_text += '</p>';
							print_text += '</div>';
						}
					});
				}
				// Print output
				$("#sender_panel").html(print_text);
			}

			// Prinf for team_support panel
			function print_team_support() {
				var print_text = "";
				if (support_team_id[0] != "") {
					$.each(support_team_id, function(index, value) {
						print_text += '<div class="callout callout-success">';
						print_text += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_team_support" value ="' + support_team_id[index] + '">&times;</button>';
						print_text += '<h4> ทีม ' + support_team_name[index] + '</h4>';
						print_text += '</div>';
					});
				}
				// Print output
				$("#team_support_panel").html(print_text);
			}

			// Prinf for wd_support panel
			function print_wd_support() {
				var print_text = "";
				if (support_wd_id[0] != "") {
					$.each(support_wd_id, function(index, value) {
						print_text += '<div class="callout callout-info">';
						print_text += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_wd_support" value="' + support_wd_id[index] + '">&times;</button>';


						if (xlv == 2) {
							print_text += '<h4><img src="img/wd_img/default.png" height="25" width="25"  class="img-circle" alt="User Image">  ' + support_wd_n_name[index] + ' รุ่น ' + support_wd_gen[index] + '</h4>';
						} else {
							print_text += '<h4><img src="img/wd_img/default.png" height="25" width="25"  class="img-circle" alt="User Image">  ' + support_wd_name[index] + ' (' + support_wd_n_name[index] + ') รุ่น ' + support_wd_gen[index] + '</h4>';
						}


						print_text += '</div>';
					});
				}
				// Print output
				$("#wd_support_panel").html(print_text);
			}

			// Prinf for team_support panel
			function print_staff_support() {
				var print_text = "";
				var inr_print = "";
				if (support_staff_id[0] != "") {
					$.each(support_staff_type, function(index, value) {
						inr_print = "";
						style = '<div class="callout callout-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" id="delete_case_staff" value="' + support_staff_id[index] + '">&times;</button>';
						if (value == 0) {
							inr_print = "(รับเรื่อง) : ";
							style = '<div class="callout callout-warning">';
						}
						print_text += style;
						print_text += '<h4> ' + support_staff_n_name[index] + ' </h4>';
						print_text += '</div>';
					});
				}
				// Print output
				$("#operator_staff_panel").html(print_text);
			}


			// Click case info edit btn_case_info_edit
			$("#btn_status_edit").click(function() {
				$('#f8').trigger("reset");
				//alert (case_cnt_status);
				if ((case_cnt_status == "4") || (case_cnt_status == "5")) {
					if (case_cnt_status == "5") {
						//f_add_pub_lnk
						$('#f_add_pub_lnk').trigger("reset");
						$('#f_add_eff_info').trigger("reset");

						$("#case_a_pub_date").datepicker("setDate", new Date());
						$("#case_a_eff_date").datepicker("setDate", new Date());

						$('#modal_update_after_pub').modal('show');
					} else {
						swal({
							position: 'top-end',
							type: 'error',
							title: 'เคสนี้ยุติแล้ว',
							showConfirmButton: false,
							timer: 1000
						});
					}
				} else {
					//get_last_post_from_page();
					current_selected_case_status = 99;
					case_stop_select = "";
					get_status_type();
					selected_post_from_page_value = "";
					selected_post_from_page_pub_time = "";
					$('textarea#c_n_deteil_new').val("")
					$('#c_n_url_new').val("")

					$("#case_stop_tag_panel").hide();
					$("#case_search_post_result_panel").hide();
					$("#case_url_panel").show();
					$("#case_time_panel").show();
					$("#case_search_post_panel").hide();
					$('#modal_update_status_v2').modal('show');


				}
			});


			// Update info btn_update_info
			$("#btn_update_info").click(function() {
				//$('#f8').trigger("reset");
				$('#modal_update_info').modal('show');
			});

			// Update info btn_update_info
			$("#btn_update_info_header").click(function() {
				//$('#f8').trigger("reset");
				$('#modal_update_info').modal('show');
			});




			// Save Status btn_save_status
			$("#btn_save_status").click(function() {
				$("#c_n_url").css({
					'background-color': '#ffffff'
				});
				if ($("#c_n_status").val() == "5") {
					if ($("#c_n_url").val().trim() == "") {
						$("#c_n_url").css({
							'background-color': '#ffb3b3'
						});
					} else {
						ajax_update_status_function();
					}
				} else {
					ajax_update_status_function();
				}
				//
			});

			// If cannot estimate damage check
			$('#u_case_cannot_estimate_check').on('ifChecked', function(event) {
				$("#u_case_ofd_dmg").val("0");
				$("#u_case_ofd_dmg2").val("0");

				$("#u_case_ofd_dmg").prop('disabled', true);
				$("#u_case_ofd_dmg2").prop('disabled', true);
			});

			// If cannot estimate damage uncheck
			$('#u_case_cannot_estimate_check').on('ifUnchecked', function(event) {
				$("#u_case_ofd_dmg").val("0");
				$("#u_case_ofd_dmg2").val("0");

				$("#u_case_ofd_dmg").prop('disabled', false);
				$("#u_case_ofd_dmg2").prop('disabled', false);
			});

			$("#u_case_ofd_dmg").keyup(function() {
				chk_str = $("#u_case_ofd_dmg").val($.trim($("#u_case_ofd_dmg").val().replace(",", "")));
				if (!$.isNumeric($("#u_case_ofd_dmg").val())) {
					$("#u_case_ofd_dmg").val("");
				}
			});

			$("#u_case_ofd_dmg2").keyup(function() {
				chk_str = $("#u_case_ofd_dmg2").val($.trim($("#u_case_ofd_dmg2").val().replace(",", "")));
				if (!$.isNumeric($("#u_case_ofd_dmg2").val())) {
					$("#u_case_ofd_dmg2").val("");
				}
			});

			// Edit type Click btn_edit_type

			// Update info btn_update_info
			$("#btn_edit_type").click(function() {
				$("#crp_type_x2").val("");
				$("#add_crp_type_2").toggle('fast');
			});

			$("#case_u_select_type").change(function() {
				if ($(this).val() == 99999) {
					$("#case_u_case_other").prop('disabled', false);
				} else {
					$("#case_u_case_other").val("");
					$("#case_u_case_other").prop('disabled', true);
				}
			});

			// btn_save_type Click update tyoe
			$("#btn_save_type").click(function() {
				var crp_type = $("#case_u_select_type").val()
				var crp_option_name = $("#case_u_case_other").val();

				var add_data = {}
				add_data['f'] = '23';
				add_data['crp_type'] = crp_type;
				add_data['crp_option_name'] = crp_option_name;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						$('#modal_edit_type').modal('hide');
						window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				//$('#modal_update_info').modal('show');
			});




			// Update info btn_update_info
			$("#btn_edit_link").click(function() {
				//$("#case_u_cnt_url").val($("#case_cnt_url").attr("href").replace('#', ''))
				$("#case_u_wfd_url").val($("#case_folder_url").attr("href").replace('#', ''))
				$('#modal_edit_url').modal('show');
			});

			$("#btn_save_link").click(function() {
				var case_cnt_url = $("#case_u_cnt_url").val()
				var case_wfd_url = $("#case_u_wfd_url").val();

				var add_data = {}
				add_data['f'] = '24';
				add_data['case_cnt_url'] = case_cnt_url;
				add_data['case_wfd_url'] = case_wfd_url;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						get_case_data();
						$('#modal_edit_url').modal('hide');
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});

						//window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			// btn_edit_date Click
			$("#btn_edit_date").click(function() {
				$("#case_u_date_in").datepicker("setDate", date_u_in);
				$("#case_u_date_fin").datepicker("setDate", date_u_finished);
				$("#case_u_date_fin").datepicker("setStartDate", date_u_in);
				$('#modal_edit_date').modal('show');
			});



			// Click save new date btn_save_date
			$("#btn_save_date").click(function() {
				var dt = $("#case_u_date_in").val().split('/');
				var start_date = dt[2] + '-' + dt[1] + '-' + dt[0];

				dt = $("#case_u_date_fin").val().split('/');
				var finished_date = dt[2] + '-' + dt[1] + '-' + dt[0];


				var add_data = {}
				add_data['f'] = '25';
				add_data['finished_date'] = finished_date;
				add_data['start_date'] = start_date;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						$('#modal_edit_date').modal('hide');
						window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});




			$("#ofd_add_province").change(function() {
				// Call Function std Ajax for get Aumpher name
				ajax_function(2, "#ofd_add_aumpher", $(this).val());

				// Call Function std Ajax for get GEO name
				ajax_function2(4, "#ofd_geo", $(this).val());
			});



			//plus_ofd_location
			$('body').on('click', '#plus_ofd_location', function() {
				ajax_function(1, "#ofd_add_province");
				ajax_function(16, "#select_org_type");
				$("#ofd_add_aumpher").html("");
				$("#ofd_type_2").val("");
				$("#case_a_ofd_name").val("");
				$("#select_ofd_type_2_panel").hide();
				$('#modal_add_ofd').modal('show');




			});


			//btn_add_ofd Click
			$("#btn_add_ofd").click(function() {
				var check_rest = 0;

				// Check ofd name
				$("#case_a_ofd_name").css({
					'background-color': '#ffffff'
				});
				if ($("#case_a_ofd_name").val() == "") {
					check_rest = 1;
					$("#case_a_ofd_name").css({
						'background-color': '#ffb3b3'
					});
				}

				// Check ofd_add_aumpher
				$("#ofd_add_aumpher").css({
					'background-color': '#ffffff'
				});
				if ($("#ofd_add_aumpher").val() == null) {
					check_rest = 1;
					$("#ofd_add_aumpher").css({
						'background-color': '#ffb3b3'
					});
				}

				// Check ofd_add_aumpher
				$("#select_org_type").css({
					'background-color': '#ffffff'
				});
				if ($("#select_org_type").val() == null) {
					check_rest = 1;
					$("#select_org_type").css({
						'background-color': '#ffb3b3'
					});
				}
				if (check_rest == 0) {
					var add_data = {}
					add_data['f'] = '26';
					add_data['ofd_name'] = $("#case_a_ofd_name").val();
					add_data['ofd_type_id'] = $("#select_org_type").val();
					add_data['ofd_address_code'] = $("#ofd_add_aumpher").val();
					add_data['ofd_type_2'] = $("#ofd_type_2").val().trim();
					add_data['case_id'] = "<?php echo $case_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$('#modal_add_ofd').modal('hide');
							//$.notify("บันทึกข้อมูลสำเร็จ", "success");
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							get_ofd_name_list();
							//window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}



			});


			//Delete OFD
			$('body').on('click', '#delete_ofd_location', function() {
				var target = ($(this).attr('value'));
				if (ofd_name_arr.length > 1) {
					var add_data = {}
					add_data['f'] = '27';
					add_data['ofd_name'] = target;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$('#modal_add_ofd').modal('hide');
							//alert (data)
							//$.notify("บันทึกข้อมูลสำเร็จ", "success");
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							})
							get_ofd_name_list();
							//window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}
				//alert (target);
			});



			// ============================ TAG memeber ===============
			// Source for add team
			var availableTags = [

				<?php
				// Connect to MySQL Database
				include "connectionDb.php";
				$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a WHERE a.status in (1, 2, 5) Order By a.wd_id";
				$res = $conn->query(trim($sql));
				mysqli_close($conn);
				$cl_check = "";
				while ($row = $res->fetch_assoc()) {
					if ($user_level == 2) {
						echo $cl_check . '{label:"' . '' . $row['n_name'] . ' : ' . $row['soc_fb'] . ' ' . $row['soc_fb_2'] . '", value : "' . $row['wd_id'] . $row['n_name'] . ' รุ่น ' . $row['gen'] . '", category: "รุ่น  ' . $row['gen'] . '"}';
					} else {
						echo $cl_check . '{label:"' . $row['name'] . ' ' . $row['s_name'] . '(' . $row['n_name'] . ') : ' . $row['soc_fb'] . ' ' . $row['soc_fb_2'] . '", value : "' . $row['wd_id'] . ' - ' . $row['name'] . ' (' . $row['n_name'] . ') รุ่น ' . $row['gen'] . '", category: "รุ่น  ' . $row['gen'] . '"}';
					}

					$cl_check = ",";
				}
				?>
			];

			$("#case_a_snd_info").catcomplete({
				source: availableTags
			});


			$("#case_add_wd_support").catcomplete({
				source: availableTags
			});

			// btn_add_sender click
			$("#btn_add_sender").click(function() {
				var add_text = $("#case_a_snd_info").val();
				if (add_text.trim() != "") {
					_id = add_text.substring(0, 8);
					if ($.isNumeric(_id)) {
						add_text = _id;
						if (jQuery.inArray(add_text, c_snd_name) == -1) {
							case_add_sender_info("0", add_text, "", "", "", $("#snd_date").val())
						}
					} else {
						if (jQuery.inArray(add_text, c_snd_name) == -1) {
							// Reset f_snder
							$('#f_snder').trigger("reset");
							$('#snd_info_facebook').val(add_text);
							$('#modal_send_data_info').modal('show');
						}
					}
				}
				$("#case_a_snd_info").val("")
			});


			// Click btn_add_oth_snd
			$("#btn_add_oth_snd").click(function() {
				$('#modal_send_data_info').modal('hide');
				case_add_sender_info("1", $("#snd_info_facebook").val(), $("#snd_info_Line").val(), $("#snd_info_mail").val(), $("#snd_info_tel").val(), $("#snd_date").val())
			});

			function case_add_sender_info(snd_type, name, line, email, tel, date) {
				dt = date.split('/');
				var snd_date_data = dt[2] + '-' + dt[1] + '-' + dt[0];
				var add_data = {}
				add_data['f'] = '28';
				add_data['snd_type'] = snd_type;
				add_data['snd_name'] = name;
				add_data['snd_line'] = line;
				add_data['snd_mail'] = email;
				add_data['snd_tel'] = tel;
				// Add 2019-03-02
				add_data['snd_occ'] = $("#snd_info_occ").val();
				add_data['snd_relate'] = $("#snd_info_relate").val();
				add_data['snd_note'] = $(snd_info_note).val();

				add_data['snd_date'] = snd_date_data;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//$.notify("บันทึกข้อมูลสำเร็จ", "success");
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						})
						get_case_sender();
						//alert (data)
						//window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			}

			// add_send key up
			$('#case_a_snd_info').keyup(function(e) {
				if (e.keyCode == 13) {
					$("#btn_add_sender").trigger("click");
				}
			});

			// delete_sender click
			$('body').on('click', '#delete_sender', function() {
				if (c_snd_type.length > 1) {
					var target = ($(this).attr('value'));
					//alert (target)
					var add_data = {}
					add_data['f'] = '29';
					add_data['snd_name'] = target;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							})
							get_case_sender();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}
				//alert (target);
			});

			//btn_add_opr_staff  Click
			$("#btn_add_opr_staff").click(function() {
				//alert ($("#case_staff").val());
				var target = ($("#case_staff").val());
				if (target.trim() != "") {
					var add_data = {}
					add_data['f'] = '30';
					add_data['stf_kid'] = target;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							//alert(data)
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							get_staff_operator();
							ajax_function(6, "#case_staff");
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}

			});

			// delete_case_staff click
			$('body').on('click', '#delete_case_staff', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '31';
				add_data['stf_kid'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
						get_staff_operator();
						ajax_function(6, "#case_staff");
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			// btn_add_team_support Click
			$("#btn_add_team_support").click(function() {
				//alert ($("#case_staff").val());
				var target = ($("#team_list").val());
				//support_team_id
				if (target.trim() != "") {
					if (jQuery.inArray(target, support_team_id) == -1) {
						var add_data = {}
						add_data['f'] = '32';
						add_data['team_id'] = target;
						add_data['case_id'] = "<?php echo $case_id; ?>";
						$.ajax({
								type: 'POST',
								dataType: "text",
								url: 'f_1_case.php',
								data: (add_data)
							})
							.done(function(data) {
								//alert(data)
								swal({
									position: 'top-end',
									type: 'success',
									title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
									showConfirmButton: false,
									timer: 1000
								});
								get_team_support();
								ajax_function(15, "#team_list");
							})
							.fail(function() {
								// just in case posting your form failed
								alert("Posting failed.");
							});
					}
				}
			});

			// delete_team_support Click
			$('body').on('click', '#delete_team_support', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '33';
				add_data['team_id'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
						get_team_support();
						ajax_function(15, "#team_list");
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			// 

			// add_send key up
			$('#case_add_wd_support').keyup(function(e) {
				if (e.keyCode == 13) {
					$("#btn_add_wd_support").trigger("click");
				}
			});


			// delete_wd_support Click
			$('body').on('click', '#delete_wd_support', function() {
				var target = ($(this).attr('value'));
				//alert (target)
				var add_data = {}
				add_data['f'] = '35';
				add_data['wd_id'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
						get_wd_support();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			// Click btn_case_pub_add

			$("#btn_case_pub_add").click(function() {
				// Check Process
				var chk_cnt = 0;


				if (selected_pub_chanel == "") {
					chk_cnt = 1;
					$("#case_a_pub_name").css({
						'background-color': '#ffb3b3'
					});
				}

				// Check title
				$("#case_a_pub_title").css({
					'background-color': '#ffffff'
				});
				if ($("#case_a_pub_title").val().trim() == "") {
					chk_cnt = 1;
					$("#case_a_pub_title").css({
						'background-color': '#ffb3b3'
					});
				}

				// Check date
				$("#case_a_pub_date").css({
					'background-color': '#ffffff'
				});
				if ($("#case_a_pub_date").val().trim() == "") {
					chk_cnt = 1;
					$("#case_a_pub_date").css({
						'background-color': '#ffb3b3'
					});
				}

				if (chk_cnt == 0) {
					var add_data = {}
					var dt = $("#case_a_pub_date").val().split('/');
					var pub_date_info = dt[2] + '-' + dt[1] + '-' + dt[0];
					add_data['f'] = '36';
					//add_data['name'] = $("#case_a_pub_name").val().trim();
					add_data['name'] = selected_pub_chanel;
					add_data['title'] = $("#case_a_pub_title").val().trim();
					add_data['url'] = $("#case_a_pub_url").val().trim();
					add_data['date'] = pub_date_info;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['stf_kid'] = "<?php echo $staff_key_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							//$("#case_a_pub_name").val("");
							selected_pub_chanel = "";
							$("#case_a_pub_title").val("");
							$("#case_a_pub_url").val("");
							$("#case_a_pub_date").datepicker("setDate", new Date());
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							print_pub_chanel_tag();
							load_new_timeline();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				} else {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						showConfirmButton: false,
						timer: 1000
					});
				}
			});


			// Click btn_case_eff_add
			$("#btn_case_eff_add").click(function() {
				//alert($("#case_a_eff_type").val());
				// Check Process
				var chk_cnt = 0;

				// Check pub_name
				$("#case_a_eff_name").css({
					'background-color': '#ffffff'
				});
				if ($("#case_a_eff_name").val().trim() == "") {
					chk_cnt = 1;
					$("#case_a_eff_name").css({
						'background-color': '#ffb3b3'
					});
				}
				// Check date
				$("#case_a_eff_date").css({
					'background-color': '#ffffff'
				});
				if ($("#case_a_eff_date").val().trim() == "") {
					chk_cnt = 1;
					$("#case_a_eff_date").css({
						'background-color': '#ffb3b3'
					});
				}

				if (chk_cnt == 0) {
					var add_data = {}
					var dt = $("#case_a_eff_date").val().split('/');
					var eff_date_info = dt[2] + '-' + dt[1] + '-' + dt[0];
					add_data['f'] = '37';
					add_data['name'] = $("#case_a_eff_name").val().trim();
					add_data['case_a_eff_type'] = $("#case_a_eff_type").val();
					add_data['detail'] = $("#case_a_eff_detail").val().trim();
					add_data['url'] = $("#case_a_eff_url").val().trim();
					add_data['date'] = eff_date_info;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['stf_kid'] = "<?php echo $staff_key_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$("#case_a_eff_name").val("");
							$("#case_a_eff_detail").val("");
							$("#case_a_eff_url").val("");
							$("#case_a_eff_date").datepicker("setDate", new Date());
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							load_new_timeline();

						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				} else {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						showConfirmButton: false,
						timer: 1000
					});
				}
			});


			$("#sidebar_search_text").keyup(function() {
				var search_target = $(this).val();
				if (search_target.trim() == "") {
					$("#sidebar_search_wd_result").html("");
				} else {
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
							$("#sidebar_search_wd_result").html(data);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}

			});

			$("#sidebar_search_text_case").keyup(function() {
				var search_target = $(this).val();
				if (search_target.trim() == "") {
					$("#sidebar_search_case_result").html("");
				} else {
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
							$("#sidebar_search_case_result").html(data);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}

			});

			// btn_case_pub_add_oth
			$("#btn_case_pub_add_oth").click(function() {

				var pub_oth_data = $("#case_a_pub_oth_detail").val();

				$("#case_a_pub_oth_detail").css({
					'background-color': '#ffffff'
				});

				if (pub_oth_data != "") {
					var dt = $("#case_a_pub_oth_date").val().split('/');
					var case_pub_date_wd = dt[2] + '-' + dt[1] + '-' + dt[0];

					var add_data = {}
					add_data['f'] = '40';
					add_data['date'] = case_pub_date_wd;
					add_data['detail'] = pub_oth_data;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['stf_kid'] = "<?php echo $staff_key_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$("#case_a_pub_oth_detail").val("");
							$("#case_a_pub_oth_date").datepicker("setDate", new Date());
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							load_new_timeline();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				} else {
					$("#case_a_pub_oth_detail").css({
						'background-color': '#ffb3b3'
					});
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						showConfirmButton: false,
						timer: 1000
					});
				}
			});

			// Save Status btn_save_info
			$("#btn_save_info").click(function() {
				// Check Ofd_Name and Location
				$("#u_case_name").css({
					'background-color': '#ffffff'
				});
				if ($("#u_case_name").val().trim() == "") {
					$("#u_case_name").css({
						'background-color': '#ffb3b3'
					});
				} else {
					var add_data = {}
					add_data['f'] = '22';
					$("form#f_update_info :input").each(function() {
						add_data[$(this).attr('id')] = $(this).val();
					});
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['u_case_cannot_estimate_check'] = $('#u_case_cannot_estimate_check').is(':checked');
					add_data['u_case_urgent_check'] = $('#u_case_urgent_check').is(':checked');

					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$('#modal_update_info').modal('hide');
							//get_case_data();
							window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}
			});


			function get_ofd_type_2() {
				var add_data = {}
				add_data['f'] = '42';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						var ojb = JSON.parse(data);
						crp_type_current_data = [];
						print_text = "";
						$.each(ojb, function(index, value) {
							crp_type_current_data.push(ojb[index].crp_type);
							print_text += '<div class="chip c_hover"><span id="load_crp_type_analyz" value="' + ojb[index].crp_type + '">' + ojb[index].crp_type + '</span><span class="closebtn" id="delete_c_case_type" value="' + ojb[index].rnd_str + '">&times;</span></div>';
						});
						$("#ofd_type_2_panel").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			$('body').on('click', '#delete_c_case_type', function() {
				if (crp_type_current_data.length <= 1) {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'ต้องมีประเภทการทุจริตอย่างน้อย 1 ประเภท',
						showConfirmButton: false,
						timer: 1000
					});
				} else {
					var target = ($(this).attr('value'));
					var add_data = {}
					add_data['f'] = '43';
					add_data['type_rnd_str'] = target;
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
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
							get_ofd_type_2();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}

			});


			function get_crp_type_data() {
				var add_data = {}
				add_data['f'] = '41';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb_data = JSON.parse(data);

						case_ofd_type_data_id = [];
						case_ofd_type_data_label = []

						$.each(ojb_data, function(index, value) {
							case_ofd_type_data_label.push(ojb_data[index].label)
							case_ofd_type_data_id.push(ojb_data[index].id)
						});
						print_ofd_type_x2_select();
						$("#crp_type_x2").autocomplete({
							minLength: 0,
							source: ojb_data,
							focus: function(event, ui) {
								$("#crp_type_x2").val(ui.item.label);
								return false;
							}
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// add_send key up
			$('#crp_type_x2').keyup(function(e) {
				if (e.keyCode == 13) {
					var snd_case_type_id = "";
					var snd_case_type_data = "";
					if ($(this).val().trim() != "") {
						if (jQuery.inArray($(this).val().trim(), crp_type_current_data) == -1) {
							var check_value = jQuery.inArray($(this).val().trim(), case_ofd_type_data_label);
							//alert (check_value)
							if (check_value >= 0) {
								snd_case_type_id = case_ofd_type_data_id[check_value];
								snd_case_type_data = case_ofd_type_data_label[check_value];
							} else {
								snd_case_type_id = "99999";
								snd_case_type_data = $(this).val().trim();
							}
						}
						if (snd_case_type_id.trim() != "") {
							var add_data = {}
							add_data['f'] = '44';
							add_data['case_id'] = "<?php echo $case_id; ?>";
							add_data['type_id'] = snd_case_type_id;
							add_data['type_data'] = snd_case_type_data;
							$.ajax({
									type: 'POST',
									dataType: "text",
									url: 'f_1_case.php',
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
									$("#add_crp_type_2").hide('fast');
									get_ofd_type_2();
								})
								.fail(function() {
									// just in case posting your form failed
									alert("Posting failed.");
								});
						}
					}
					$("#crp_type_x2").val("");
				}
			});

			// add_case_job_type_button
			$("#add_case_job_type_button").click(function() {
				$("#new_case_job_type").val("");
				$("#new_case_job_type_box").toggle('fast');
			});

			function get_Job_type() {
				var add_data = {}
				add_data['f'] = '45';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						var ojb = JSON.parse(data);
						case_job_type_current_data = [];
						print_text = "";
						$.each(ojb, function(index, value) {
							case_job_type_current_data.push(ojb[index].job_type);
							print_text += '<div class="chip c_hover"><span id="load_job_type_anyz" value="' + ojb[index].job_type + '">' + ojb[index].job_type + '</span><span class="closebtn" id="delete_c_case_job_type" value="' + ojb[index].rnd_str + '">&times;</span></div>';
						});
						//console.log(case_job_type_current_data);
						$("#case_job_type_panel").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// add_send key up
			$('#new_case_job_type').keyup(function(e) {
				if (e.keyCode == 13) {

					if ($(this).val().trim() != "") {
						if (jQuery.inArray($(this).val().trim(), case_job_type_current_data) == -1) {
							var add_data = {}
							add_data['f'] = '46';
							add_data['case_id'] = "<?php echo $case_id; ?>";
							add_data['case_job'] = $(this).val().trim();
							$.ajax({
									type: 'POST',
									dataType: "text",
									url: 'f_1_case.php',
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
									$("#new_case_job_type_box").hide('fast');
									get_Job_type();
								})
								.fail(function() {
									// just in case posting your form failed
									alert("Posting failed.");
								});
						}
					}
					$("#new_case_job_type").val("");
				}
			});


			$('body').on('click', '#delete_c_case_job_type', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '47';
				add_data['type_rnd_str'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
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
						get_Job_type();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			function get_ofd_name_list_v2() {
				var add_data = {}
				add_data['f'] = '48';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						var ojb = JSON.parse(data);
						print_text = "";
						$.each(ojb, function(index, value) {
							print_arr_detail = "";
							if (ojb[index].detail != "") {
								print_arr_detail = "<BR><small>" + ojb[index].detail + "</small>";
							}

							if (ojb[index].ofd_pos == "") {
								print_text += '<li  class="danger"><span class="text">' + ojb[index].ofd_name + print_arr_detail + '</span><div class="tools"><i class="fa fa-times-circle" id="del_ofd_person_name" value="' + ojb[index].rnd_str + '"></i></div></li>';
							} else {
								print_text += '<li class="danger"><span class="text">' + ojb[index].ofd_name + " (" + ojb[index].ofd_pos + " )" + print_arr_detail + ' </span><div class="tools"><i class="fa fa-times-circle" id="del_ofd_person_name" value="' + ojb[index].rnd_str + '"></i></div></li>';
							}
						});
						//console.log(case_job_type_current_data);
						$("#ofd_person_name_panel").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			$('body').on('click', '#del_ofd_person_name', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '49';
				add_data['type_rnd_str'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
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
						get_ofd_name_list_v2();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			//add_ofd_name
			//modal_add_ofd_person

			// Click case info edit btn_case_info_edit
			$("#add_ofd_name").click(function() {
				$('#f_add_ofd_person').trigger("reset");
				$('#modal_add_ofd_person').modal('show');

			});

			//btn_add_ofd_person
			$("#btn_add_ofd_person").click(function() {
				// Check _satge
				if ($("#new_ofd_name").val().trim() != "") {
					var add_data = {}
					add_data['f'] = '50';
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['ofd_name'] = $("#new_ofd_name").val();
					add_data['ofd_pos'] = $("#new_ofd_pos").val();
					add_data['ofd_detail'] = $("#new_ofd_details").val();
					console.log(add_data);
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$('#modal_add_ofd_person').modal('hide');

							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							get_ofd_name_list_v2();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				} else {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						showConfirmButton: false,
						timer: 1000
					});
				}

			});






			$('body').on('click', '#add_case_type_real', function() {
				var target = ($(this).attr('value'));
				if (jQuery.inArray(target, case_job_type_current_data) == -1) {
					var add_data = {}
					add_data['f'] = '46';
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['case_job'] = target;
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
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
							$("#new_case_job_type_box").hide('fast');
							get_Job_type();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}
				$("#new_case_job_type").val("");
			});





			//ofd_type_2
			$("#ofd_type_2").focus(function() {
				$("#select_ofd_type_2_panel").show("fast");
			});

			//btn_ofd_type_2_selected
			$('body').on('click', '#btn_ofd_type_2_selected', function() {
				var target = ($(this).attr('value'));
				$("#ofd_type_2").val(target);
				$("#select_ofd_type_2_panel").hide("fast");
			});

			// Print label for each cry pype select
			function print_ofd_type_x2_select() {
				var print_text = "";
				$.each(case_ofd_type_data_id, function(index, value) {
					print_text += '<div class="chip_add" id="add_crp_type_real" value="' + value + '" value_2="' + case_ofd_type_data_label[index] + '"> + ' + case_ofd_type_data_label[index] + '</div>';
				});
				print_text += '<BR><div class="chip_add" id="close_select_type_real_panel"> <i class="fa fa-angle-double-up"></i> </div>';
				$('#crp_type_x2_select_panel').html(print_text);
			}

			//btn_ofd_type_2_selected
			$('body').on('click', '#add_crp_type_real', function() {
				var target = ($(this).attr('value'));
				var target2 = ($(this).attr('value_2'));
				var add_data = {}
				add_data['f'] = '44';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				add_data['type_id'] = target;
				add_data['type_data'] = target2;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
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
						$("#add_crp_type_2").hide('fast');
						get_ofd_type_2();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
				$("#crp_type_x2").val("");
			});


			$('body').on('click', '#close_select_type_real_panel', function() {
				$("#add_crp_type_2").hide("fast");
			});


			function get_last_post_from_page() {
				var add_data = {}
				add_data['f'] = '53';

				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_1_case.php',
					data: (add_data)
				})
			}



			function get_status_type() {
				var add_data = {}
				add_data['f'] = '54';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb_data = JSON.parse(data);
						var print_text = "";
						$.each(ojb_data, function(index, value) {
							if (ojb_data[index].id == ojb_data[index].current_status) {
								print_text += '<div class="chip_add_current" value="' + ojb_data[index].id + '"  >' + ojb_data[index].crp_status + '</div>';
							} else if (ojb_data[index].id == current_selected_case_status) {
								print_text += '<div class="chip_add_selected" value="' + ojb_data[index].id + '"  >' + ojb_data[index].crp_status + '</div>';
							} else {
								print_text += '<div class="chip_add" id="select_new_status" value="' + ojb_data[index].id + '"  >' + ojb_data[index].crp_status + '</div>';
							}

							current_select_case_status = ojb_data[index].current_status;

						});
						$('#c_n_status_tag_select').html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}



			function print_case_stop_tag() {
				var print_text = "";
				$.each(availablecase_stop_tag, function(index, value) {
					if (value == case_stop_select) {
						print_text += '<div class="chip_add_selected" id="case_stop_tag_deselected" value="' + value + '"><span class="addbtn"></span>' + value + '</div>';
					} else {
						print_text += '<div class="chip_add" id="case_stop_tag_selected" value="' + value + '"><span class="addbtn"></span>' + value + '</div>';
					}

				});
				$('#case_stop_tag').html(print_text);
			}

			$('body').on('click', '#case_stop_tag_selected', function() {
				var target = ($(this).attr('value'));
				case_stop_select = target;
				print_case_stop_tag();
			});

			$('body').on('click', '#case_stop_tag_deselected', function() {
				case_stop_select = "";
				print_case_stop_tag();
			});


			$('body').on('click', '#select_new_status', function() {
				var target = ($(this).attr('value'));

				if (target == 4) {
					case_stop_select = "";
					print_case_stop_tag();
					$("#case_stop_tag_panel").show("fast");
				} else {
					$("#case_stop_tag_panel").hide("fast");
				}

				if (target == 5) {
					$("#c_n_post_new").val("");
					$("#search_post_result").html("");
					$("#case_url_panel").hide("fast");
					$("#case_time_panel").hide("fast");
					$("#case_search_post_result_panel").show("fast");
					$("#case_search_post_panel").show("fast");
				} else {
					$("#case_url_panel").show("fast");
					$("#case_time_panel").show("fast");
					$("#case_search_post_panel").hide("fast");
					$("#case_search_post_result_panel").hide("fast");
				}


				if (target == 3) {
					$("#new_fin_date_for_postpone").datepicker("setDate", date_u_finished);
					$("#new_fin_date_for_postpone").datepicker("setStartDate", date_u_in);
					$("#new_fin_date_for_postpone_panel").show("fast")
				} else {
					$("#new_fin_date_for_postpone_panel").hide("fast")
				}
				current_selected_case_status = target;
				get_status_type();
			});

			//btn_save_status_new
			// Click case info edit btn_case_info_edit
			$("#btn_save_status_new").click(function() {
				//alert ($("#c_n_upd_time").val() + ":00");
				//alert (moment($('#c_n_upd_time').data("DateTimePicker").viewDate()).format('YYYY-MM-DD HH:mm:ss'))
				if (current_selected_case_status != 99) {
					if ((current_selected_case_status == 5) && (selected_post_from_page_value == "")) {
						alert("กรุณาเลือก Post จากเพจ")
					} else {
					
						$("#btn_save_status_new").prop('disabled', true);
						var case_update_detail = $('textarea#c_n_deteil_new').val();
						if ((current_selected_case_status == 4) && (case_stop_select != "")) {
							case_update_detail += " #" + case_stop_select
						}
						//alert (case_update_detail);
						case_new_url = $("#c_n_url_new").val().trim();

						if (current_selected_case_status == 5) {
							//alert (selected_post_from_page_value)
							case_new_url = selected_post_from_page_value;
						}

						finished_date = "";
						if (current_selected_case_status == 3) {
							dt = $("#new_fin_date_for_postpone").val().split('/');
							finished_date = dt[2] + '-' + dt[1] + '-' + dt[0];
						}

						//alert (finished_date)

						//alert (selected_post_from_page_pub_time);
						var s_update_data = {}
						s_update_data['f'] = '12';

						s_update_data['detail'] = case_update_detail;
						s_update_data['status'] = current_selected_case_status;
						s_update_data['selected_post_from_page_pub_time'] = selected_post_from_page_pub_time;
						s_update_data['finished_date'] = finished_date;
						s_update_data['url'] = case_new_url;
						//s_update_data['c_n_upd_time'] = $("#c_n_upd_time").val() + ":00";
						s_update_data['c_n_upd_time'] = moment($('#c_n_upd_time').data("DateTimePicker").viewDate()).format('YYYY-MM-DD HH:mm') + ":59";
						s_update_data['staff_kid'] = "<?php echo $staff_key_id; ?>";
						s_update_data['case_id'] = "<?php echo $case_id; ?>";

						// Set Ajax
						$.ajax({
								type: 'POST',
								dataType: "text",
								url: 'f_1_case.php',
								data: (s_update_data)
							})
							.done(function(data) {
								//alert(data);
								//window.location.replace('14_case_data.php?case_id=<?php echo $case_id; ?>&pcs=1');
								swal({
									position: 'top-end',
									type: 'success',
									title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
									showConfirmButton: false,
									timer: 1000
								});
								$('#modal_update_status_v2').modal('hide');
								get_case_data();
								load_new_timeline();
								$("#btn_save_status_new").prop('disabled', false);
							})
							.fail(function() {
								// just in case posting your form failed
								alert("Posting failed.");
							});
						return false;
					}
				}

			});

			$("#c_n_post_new").keyup(function() {
				target = $(this).val();
				if (target.trim() == "") {
					$("#search_post_result").html("");
				} else {
					search_post(target);
				}

			});

			function search_post(target) {
				var add_data = {}
				add_data['f'] = '55';
				add_data['search'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb = JSON.parse(data);
						var print_text = "";
						if (ojb.length == 0) {
							print_text = "<font color='red'><B>ไม่พบข้อมูล</B></font>";
						} else {
							$.each(ojb, function(index, value) {
								msg = ojb[index].msg.substring(0, 85);
								if (ojb[index].msg.length > 85) {
									msg += "...";
								}
								print_text += '<div class="col-md-10">';
								print_text += '<div class="info-box div_select_page" id="select_post_page" value="' + ojb[index].post_id + '">';
								print_text += '<img class="info-box-icon img-circle" src="' + ojb[index].img_data + '" height="85" width="85">';
								print_text += '<div class="info-box-content">';
								print_text += '<span class="info-box-number"><small>' + msg + '</small></span>';
								print_text += '<span class="info-box-text">' + ojb[index].pub_time + '</span>';
								print_text += '</div>';
								print_text += '</div>';
								print_text += '</div>';
							});
						}

						//alert (print_text);
						$("#search_post_result").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			$('body').on('click', '#select_post_page', function() {
				var target = ($(this).attr('value'));
				selected_post_from_page_value = target;
				$("#case_search_post_panel").hide("fast");
				$("#c_n_post_new").val("");
				var add_data = {}
				add_data['f'] = '56';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb = JSON.parse(data);
						var print_text = "";
						$.each(ojb, function(index, value) {
							msg = ojb[index].msg.substring(0, 85);
							if (ojb[index].msg.length > 85) {
								msg += "...";
							}
							print_text += '<div class="col-md-10">';
							print_text += '<div class="info-box">';
							print_text += '<img class="info-box-icon img-circle" src="' + ojb[index].img_data + '" height="85" width="85">';
							print_text += '<div class="info-box-content">';
							print_text += '<button type="button" class="close" aria-hidden="true" id="delete_select_post_page">&times;</button>';
							print_text += '<span class="info-box-number"><small>' + msg + '</small></span>';
							print_text += '<span class="info-box-text">' + ojb[index].pub_time + '</span>';
							print_text += '</div>';
							print_text += '</div>';
							print_text += '</div>';

							selected_post_from_page_pub_time = ojb[index].pub_time;
						});
						//alert (print_text);
						$("#search_post_result").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			$('body').on('click', '#delete_select_post_page', function() {
				selected_post_from_page_value = "";
				selected_post_from_page_pub_time = "";
				$("#search_post_result").html("");
				$("#case_search_post_panel").show("fast");
			});

			$('body').on('click', '#delete_time_line_item', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '57';
				add_data['target'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "") {
							swal({
								position: 'top-end',
								type: 'error',
								//title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								title: data,
								showConfirmButton: false,
								timer: 2000
							});
						} else {
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							get_case_data();
							load_new_timeline();
						}


					})
					.fail(function() {
						alert("Posting failed.");
					});
			});


			function print_pub_chanel_tag() {
				var print_text = "";
				$.each(availablepub_chanel_tag, function(index, value) {
					if (value == selected_pub_chanel) {
						print_text += '<div class="chip_add_selected" value="' + value + '"><span class="addbtn"></span>' + value + '</div>';
					} else {
						print_text += '<div class="chip_add" id="case_pub_chanel_selected" value="' + value + '"><span class="addbtn"></span>' + value + '</div>';
					}

				});
				$('#select_pub_chanel').html(print_text);
			}

			$('body').on('click', '#case_pub_chanel_selected', function() {
				selected_pub_chanel = ($(this).attr('value'));
				print_pub_chanel_tag();
			});


			$("#c_n_post_new_2").keyup(function(e) {
				target = $(this).val();
				if (e.keyCode == 13) {
					e.preventDefault();
				}
				if (target.trim() == "") {
					$("#search_post_result_2").html("");
				} else {
					search_post_2(target);
				}
			});

			function search_post_2(target) {
				var add_data = {}
				add_data['f'] = '55';
				add_data['search'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb = JSON.parse(data);
						var print_text = "";
						if (ojb.length == 0) {
							print_text = "<font color='red'><B>ไม่พบข้อมูล</B></font>";
						} else {
							$.each(ojb, function(index, value) {
								msg = ojb[index].msg.substring(0, 85);
								if (ojb[index].msg.length > 85) {
									msg += "...";
								}
								print_text += '<div class="col-md-10">';
								print_text += '<div class="info-box div_select_page" id="select_post_page_2" value="' + ojb[index].post_id + '">';
								print_text += '<img class="info-box-icon img-circle" src="' + ojb[index].img_data + '" height="85" width="85">';
								print_text += '<div class="info-box-content">';
								print_text += '<span class="info-box-number"><small>' + msg + '</small></span>';
								print_text += '<span class="info-box-text">' + ojb[index].pub_time + '</span>';
								print_text += '</div>';
								print_text += '</div>';
								print_text += '</div>';
							});
						}

						//alert (print_text);
						$("#search_post_result_2").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			$('body').on('click', '#select_post_page_2', function() {
				var target = ($(this).attr('value'));
				selected_post_from_page_value_2 = target;
				$("#case_search_post_panel_2").hide("fast");
				$("#c_n_post_new_2").val("");
				var add_data = {}
				add_data['f'] = '56';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb = JSON.parse(data);
						var print_text = "";
						$.each(ojb, function(index, value) {
							msg = ojb[index].msg.substring(0, 85);
							if (ojb[index].msg.length > 85) {
								msg += "...";
							}
							print_text += '<div class="col-md-10">';
							print_text += '<div class="info-box">';
							print_text += '<img class="info-box-icon img-circle" src="' + ojb[index].img_data + '" height="85" width="85">';
							print_text += '<div class="info-box-content">';
							print_text += '<button type="button" class="close" aria-hidden="true" id="delete_select_post_page_2">&times;</button>';
							print_text += '<span class="info-box-number"><small>' + msg + '</small></span>';
							print_text += '<span class="info-box-text">' + ojb[index].pub_time + '</span>';
							print_text += '</div>';
							print_text += '</div>';
							print_text += '</div>';

							selected_post_from_page_pub_time_2 = ojb[index].pub_time;
						});
						//alert (print_text);
						$("#search_post_result_2").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			$('body').on('click', '#delete_select_post_page_2', function() {
				selected_post_from_page_value_2 = "";
				selected_post_from_page_pub_time_2 = "";
				$("#search_post_result_2").html("");
				$("#case_search_post_panel_2").show("fast");
			});


			$("#btn_save_new_post").click(function() {
				$("#btn_save_new_post").prop('disabled', true);
				// Check Process
				var chk_cnt = 0;

				$("#c_n_post_new_2").css({
					'background-color': '#ffffff'
				});
				if (selected_post_from_page_value_2 == "") {
					chk_cnt = 1;
					$("#c_n_post_new_2").css({
						'background-color': '#ffb3b3'
					});
				}

				if (chk_cnt == 0) {
					var add_data = {}
					add_data['f'] = '58';
					add_data['post_id'] = selected_post_from_page_value_2;
					add_data['detail'] = $('textarea#c_n_deteil_new_2').val();
					add_data['new_episode'] = $('#new_episode').is(':checked');
					add_data['date'] = selected_post_from_page_pub_time_2;
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['stf_kid'] = "<?php echo $staff_key_id; ?>";
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							$('#modal_update_after_pub').modal('hide');
							selected_post_from_page_value_2 = ""
							selected_post_from_page_pub_time_2 = ""
							$('textarea#c_n_deteil_new_2').val("");
							$("#case_search_post_panel_2").show("fast");
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							load_new_timeline();
							$("#btn_save_new_post").prop('disabled', false);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				} else {
					swal({
						position: 'top-end',
						type: 'error',
						title: 'กรุณากรอกข้อมูลให้ครบ',
						showConfirmButton: false,
						timer: 1000
					});
				}
			});

			function load_timeline() {
				var add_data = {}
				add_data['f'] = '14';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						$("#timeline_data").html(data);
						load_facebook_data();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function load_facebook_data() {
				$('body div#timeline_facebook_panel').each(function(i, obj) {
					var target = ($(this).attr('value'));
					$(this).html('<i class="fa fa-refresh fa-spin"></i> Loading...');
					var add_data = {}
					add_data['f'] = '59';
					add_data['target'] = target;
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {

							var data_ojb = JSON.parse(data);
							var header_text = (data_ojb.message.split('\n')[0]);
							if (header_text.length > 40) {
								header_text = header_text.substring(0, 40) + "...";
							}
							var total_msg = data_ojb.message.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
							var cut_msg = total_msg;
							if (cut_msg.length > 200) {
								cut_msg = cut_msg.substring(0, 200) + "...";
							}

							// Cal_star
							var star_text = "";

							for (i = 0; i < Math.floor(data_ojb.post_star); i++) {
								star_text += '<i class="fa  fa-star"></i>';
							}
							if ((data_ojb.post_star % 1) > 0) {
								star_text += '<i class="fa  fa-star-half"></i>';
							}

							var print_text = "";
							print_text += '<Table>';
							print_text += '<TR>';
							print_text += '<TD><a href="41_post_static.php?post_id=' + target + '">';
							if (data_ojb.picture == null) {
								print_text += '<img src="img/wd_img/default.png" class="img-circle" height="150" width="150">';
							} else {
								print_text += '<img src="' + data_ojb.picture + '" class="img-circle" height="150" width="150">';
							}
							//print_text += '<img src="'+data_ojb.picture+'" height="120" width="120">';
							print_text += '</a></TD>';
							print_text += '<TD style="padding: 5px;">';
							print_text += '<B><a href="' + data_ojb.target_url + '" target="_blank">' + header_text + '</a><Br>';


							// Cal date
							var now = moment(new Date()); //todays date
							var end = moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
							var duration = moment.duration(now.diff(end));
							var diff_days = duration.asDays();

							if (diff_days <= 7.0) {
								print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
									sameElse: 'DD MMMM YYYY'
								}) + '</font></small><br>';
							} else {
								print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm') + '</font></small><br>';
							}

							print_text += '<B><font color="red">' + star_text + '</B></font><Br>';


							if (data_ojb.post_impressions_unique == null) {
								print_text += '<B><i class="fa fa-users"></i><font color="red">-</B></font><Br>';
							} else {
								print_text += '<B><i class="fa fa-users"></i><font color="red"> ' + data_ojb.post_impressions_unique + '</B></font><Br>';
							}

							print_text += '<b><i class="fa fa-comment-o"></i> ' + data_ojb.comment + ' <i class="fa fa-share"></i> ' + data_ojb.shares + '</B><Br>';

							if (data_ojb.post_reactions_like == null) {
								print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i>-</span> ';
							} else {
								print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i> ' + data_ojb.post_reactions_like + '</span> ';
							}

							if (data_ojb.post_reactions_love == null) {
								print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ -</span>  ';
							} else {
								print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ ' + data_ojb.post_reactions_love + '</span>  ';
							}

							if (data_ojb.post_reactions_haha == null) {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  -</span> ';
							} else {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  ' + data_ojb.post_reactions_haha + '</span> ';
							}

							if (data_ojb.post_reactions_wow == null) {
								print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 -</span>  ';
							} else {
								print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 ' + data_ojb.post_reactions_wow + '</span>  ';
							}

							if (data_ojb.post_reactions_sorry == null) {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 -</span> ';
							} else {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 ' + data_ojb.post_reactions_sorry + '</span> ';
							}

							if (data_ojb.post_reactions_anger == null) {
								print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  -</span>';
							} else {
								print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  ' + data_ojb.post_reactions_anger + '</span>';
							}
							print_text += '</TD>';
							print_text += '</TR>';
							print_text += '</Table>';
							print_text += '<h5 class="widget-user-desc post_desc break-word" value = "' + encodeURIComponent(data_ojb.message) + '">' + cut_msg + '</h5>';
							//alert(print_text)
							//console.log(print_text)
							$(obj).html(print_text);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				});
			}

			$('body').on('click', '.post_desc', function() {
				//var target = ($(this).attr('value'));
				var print_all_msg = decodeURIComponent($(this).attr('value')).replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
				while (print_all_msg.indexOf("\n") > 0) {
					//alert (print_all_msg.indexOf("\n"))
					print_all_msg = print_all_msg.replace("\n", "<br>");
				}



				$(this).html(print_all_msg);

			});


			function update_initial_process() {
				count_initial_process += 1;
				//alert(count_initial_process)
				if (count_initial_process == 8) {
					swal.close();
				}
			}


			function load_bf_case() {
				var add_data = {}
				add_data['f'] = '63';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "[]") {
							var ojb = JSON.parse(data);
							$("#btn_bf_case").html('<a type="button" class="btn btn-box-tool" href="14_case_data.php?case_id=' + ojb[0].case_id + '" ><i class="fa fa-chevron-left"></i></a>')
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function load_next_case() {
				var add_data = {}
				add_data['f'] = '64';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "[]") {
							var ojb = JSON.parse(data);
							$("#btn_next_case").html('<a type="button" class="btn btn-box-tool" href="14_case_data.php?case_id=' + ojb[0].case_id + '" ><i class="fa fa-chevron-right"></i></a>')
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function load_job_type_for_select() {
				var add_data = {}
				add_data['f'] = '66';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						jQuery.each(data_arr, function(i, val) {
							availableTags_c_case_job_type.push(val.JOBTYPE)
						});
						// Auto complete Jobtype 
						$("#new_case_job_type").autocomplete({
							source: availableTags_c_case_job_type
						});

						// print select job type panal
						print_job_type_select_panel();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function print_job_type_select_panel() {
				var print_text = "";
				$.each(availableTags_c_case_job_type, function(index, value) {
					print_text += '<div class="chip_add" id="add_case_type_real" value="' + value + '">+ ' + value + '</div>';
				});
				$('#new_case_job_type_select').html(print_text);
			}



			var availableTags_ofd_type_3 = [];

			function load_ofd_type_for_select() {
				var add_data = {}
				add_data['f'] = '67';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var data_arr = JSON.parse(data);
						jQuery.each(data_arr, function(i, val) {
							availableTags_ofd_type_3.push(val.OFDTYPE)
						});

						print_ofd_type_2_select();

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function print_ofd_type_2_select() {
				var print_text = "";
				$.each(availableTags_ofd_type_3, function(index, value) {
					print_text += '<div class="chip_add" id="btn_ofd_type_2_selected" value="' + value + '"><span class="addbtn">+ </span>' + value + '</div>';
				});
				$('#select_ofd_type_2_panel2').html(print_text);
			}

			// btn_add_wd_support Click
			$("#btn_add_wd_support").click(function() {
				//alert ($("#case_staff").val());
				var target = ($("#case_add_wd_support").val());
				if (target.trim() != "") {
					_id = target.substring(0, 8);
					if ($.isNumeric(_id)) {
						if (jQuery.inArray(_id, support_wd_id) == -1) {
							getselect_support_type_for_wd();
							$('#modal_select_support_type').modal('show');
						}
					}

				}
			});

			// getselect_support_type_for_wd====================================
			function getselect_support_type_for_wd() {
				var add_data = {}
				add_data['f'] = '68';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						//select_support_type_for_wd
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += "<option value='" + val.support_type + "'>" + val.support_type + "</option>";
						});

						$("#select_support_type_for_wd").html(print_text);


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}
			//bt_confirm_add_suppot_wd
			//function save_wd_support()
			$('body').on('click', '#bt_confirm_add_suppot_wd', function() {
				var target = ($("#case_add_wd_support").val());
				_id = target.substring(0, 8);
				$("#case_add_wd_support").val("");
				var add_data = {}
				add_data['f'] = '34';
				add_data['select_support_type_for_wd'] = $("#select_support_type_for_wd").val();
				add_data['wd_id'] = _id;
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						$('#modal_select_support_type').modal('hide');
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
						get_wd_support();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			// btn_edit_case_link
			$("#btn_edit_case_link").click(function() {
				//$("#case_u_cnt_url").val($("#case_cnt_url").attr("href").replace('#', ''))
				$("#case_u_wfd_url").val($("#case_folder_url").attr("href").replace('#', ''))
				$('#modal_edit_url').modal('show');
			});


			function load_group_post_data_detail() {
				var add_data = {}
				add_data['case_id'] = "<?php echo $case_id; ?>";
				add_data['f'] = '70';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);

						if (data != "[]") {
							//$("#btn_add_case_link").hide();
							var ojb = JSON.parse(data);
							//console.log(ojb)
							print_text = '';
							$.each(ojb, function(index, value) {

								data_arr = ojb[index];
								if (data_arr['full_picture'] == "") {
									data_arr['full_picture'] = "img/wd_img/default.png"
								}


								if (data_arr['message'].length >= 200) {
									data_arr['message'] = data_arr['message'].substring(0, 200) + "..."
									//alert("aaa")
								}



								print_text += '<div style="width:80%; text-align:right; ">';
								print_text += '<span class="delete_time_line" value="' + data_arr['rnd_str'] + '" id="delete_post_link_for_case"><font color="#ff9999"><i class="fa fa-close"></i></font></span>';
								print_text += '</div>';

								print_text += '<div style="width:100%; text-align:center; ">';

								if (__CHKMB) {
									print_text += '<a href="fb://group?id=415081651847006&object_id=' + data_arr['id'] + '&view=permalink" target="_blank"><img class="case_image" src="' + data_arr['full_picture'] + '"   width="50%"></a>';
									//print_text += '<a href="fb://post?id=372488206116588_2036065253092200" target="_blank"><img class="case_image" src="'+data_arr['full_picture']+'"   width="50%"></a>';
								} else {
									print_text += '<a href="https://www.facebook.com/groups/Watchdog.TAC1/' + data_arr['id'] + '" target="_blank"><img class="case_image" src="' + data_arr['full_picture'] + '"   width="50%"></a>';
								}


								print_text += '<font color="#999999">';
								print_text += '<BR><BR>โพสเมื่อ : ' + moment(data_arr['created_time'], "YYYY-MM-DD hh:mm:ss").calendar(null, {
									sameElse: 'DD MMMM YYYY'
								});
								print_text += '<BR>อัพเดท : ' + moment(data_arr['last_update'], "YYYY-MM-DD hh:mm:ss").calendar(null, {
									sameElse: 'DD MMMM YYYY'
								});
								print_text += '</font>';
								print_text += '</div>';
								print_text += '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	';
								print_text += data_arr['message'];
								print_text += '</span>';
							});
							$("#group_post_data_result").html(print_text);
						} else {
							$("#btn_add_case_link").show();
							$("#group_post_data_result").html("<h5><font color='#ff9999'>ยังไม่ได้ผูก Case นี้กับ Post ในศูนย์</font></h5>");
						}


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//btn_add_case_link
			$("#btn_add_case_link").click(function() {
				// Add data
				$("#group_post_search").val("");
				load_group_post_data("");
				$('#modal_add_from_group').modal('show');
			});

			function load_group_post_data(search_text) {
				global_random_no = makeid();
				var temp_rnd_id = global_random_no;
				var add_data = {}
				add_data['f'] = '69';
				add_data['search_text'] = search_text;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						if (temp_rnd_id == global_random_no) {
							if (data != "[]") {
								var ojb = JSON.parse(data);
								print_text = "";
								$.each(ojb, function(index, value) {
									message = ojb[index].message.substring(0, 50);
									if (ojb[index].message.length > 50) {
										message += "...";
									}
									if (ojb[index].full_picture == "") {
										ojb[index].full_picture = "img/wd_img/default.png"
									}
									print_text += '<div class="col-md-10">';
									print_text += '<div class="info-box div_select_page" id="select_group_post" value="' + ojb[index].id + '">';
									print_text += '<img class="info-box-icon img-circle" src="' + ojb[index].full_picture + '" height="85" width="85">';
									print_text += '<div class="info-box-content">';
									print_text += '<span class="info-box-number"><small>' + message + '</small></span>';
									//print_text += '<span class="info-box-text">'+ojb[index].created_time+'</span>';
									print_text += '<span class="info-box-text">' + moment(ojb[index].created_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
										sameElse: 'DD MMMM YYYY'
									}) + '</span>';
									print_text += '</div>';
									print_text += '</div>';
									print_text += '</div>';
								});
								$("#search_group_post_result").html(print_text);
							} else {
								$("#search_group_post_result").html("<font color='red'>**ไม่พบข้อมูล**</font>");
							}
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			$("#group_post_search").keyup(function() {
				//alert ($(this).val());
				load_group_post_data($(this).val());
			});



			function makeid() {
				var text = "";
				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

				for (var i = 0; i < 15; i++)
					text += possible.charAt(Math.floor(Math.random() * possible.length));
				return text;
			}

			// select_group_post
			$('body').on('click', '#select_group_post', function() {

				var post_id = ($(this).attr('value'));
				var post_link = "https://www.facebook.com/groups/Watchdog.TAC1/" + post_id;
				var add_data = {}
				add_data['f'] = '71';
				add_data['post_id'] = post_id;
				add_data['post_link'] = post_link;

				add_data['case_id'] = "<?php echo $case_id; ?>";

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						$('#modal_add_from_group').modal('hide');
						//$("#btn_add_case_link").toggle("fast");
						load_group_post_data_detail();
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			//btn_add_case_link
			$('body').on('click', '#delete_post_link_for_case', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '72';
				add_data['target'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//$("#btn_add_case_link").toggle("fast");
						load_group_post_data_detail();
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			function load_case_hashtag() {
				var add_data = {};
				add_data['f'] = '73';
				add_data['case_id'] = "<?php echo $case_id; ?>";

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								if (val.type == "page") {
									print_text += '<div class="chip c_hover" style="background-color:#ffffcc;" ><span id="load_tag_analyz" value="' + val.Hashtag + '">' + val.Hashtag + '</span><span class="closebtn" id="delete_tag" value="' + val.rnd_str + '">&times;</span></div>';
								} else if (val.type == "group") {
									print_text += '<div class="chip c_hover" style="background-color:#ccf2ff;" ><span  id="load_tag_analyz" value="' + val.Hashtag + '">' + val.Hashtag + '</span><span class="closebtn" id="delete_tag" value="' + val.rnd_str + '">&times;</span></div>';
								} else {
									print_text += '<div class="chip c_hover" style="background-color:#e6e6ff;" ><span  id="load_tag_analyz" value="' + val.Hashtag + '">' + val.Hashtag + '</span><span class="closebtn" id="delete_tag" value="' + val.rnd_str + '">&times;</span></div>';
								}
							});

							$("#case_hashtags_result").html(print_text);
						} else {
							$("#case_hashtags_result").html("");
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			// delete_tag
			$('body').on('click', '#delete_tag', function() {
				var target = ($(this).attr('value'));

				var add_data = {};
				add_data['f'] = '74';
				add_data['target'] = target;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						load_case_hashtag();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});

			// Click case info edit btn_case_info_edit
			$("#add_msg_inbox").click(function() {
				//$('#f_add_ofd_person').trigger("reset");
				$("#contact_list_panel").html("");
				$("#search_text_case_msg").val("");
				$('#select_inbox_msg').modal('show');

			});


			function get_msg_contact_list(target_search = "") {
				// load_spin_contact_list
				if ($("#load_spin_contact_list").html() == '<i class="fa fa-search"></i>') {
					$("#load_spin_contact_list").html('<i class="fa fa-refresh fa-spin"></i>')
				}
				random_id_search = makeid();
				var _temp_random_id_search = random_id_search;
				var add_data = {};
				add_data['f'] = '31';
				add_data['target_search'] = target_search;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_0_index.php',
						data: (add_data)
					})
					.done(function(data) {
						if (_temp_random_id_search == random_id_search) {
							if (data != "[]") {
								var data_arr = JSON.parse(data);
								console.log(data_arr)
								print_text = "";
								jQuery.each(data_arr, function(i, val) {
									var ms = moment().diff(moment(val.update_time, "YYYY-MM-DD hh:mm:ss"));

									print_text += '<li id="select_contact_list" class="hover_pointer" value="' + val.msg_id + '">';
									print_text += '<a>';
									//print_text += '<img class="contacts-list-img" src="msg" alt="User Image">';
									print_text += '<div>';
									print_text += '<span class="contacts-list-name" ><font color="#222222">';
									print_text += val.sender_name.replace(target_search, "<font color='red'>" + target_search + "</font>") + "</font>";
									if (ms < 259200000) {
										print_text += '<small class="contacts-list-date pull-right">' + moment(val.update_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</small>';
									} else {
										print_text += '<small class="contacts-list-date pull-right">' + moment(val.update_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</small>';
									}

									print_text += '</span>';
									print_text += '<span class="contacts-list-msg">' + val.MSG.replace(target_search, "<font color='red'>" + target_search + "</font>") + '</span>';
									print_text += '</div>';
									print_text += '</a>';
									print_text += '</li>';
								});
								$("#contact_list_panel").html(print_text)
							} else {
								$("#contact_list_panel").html("<li><font color='red'>**ไม่พบข้อมูล**</font></li>")
							}
							$("#load_spin_contact_list").html('<i class="fa fa-search"></i>')
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//search_text_case_msg
			$("#search_text_case_msg").keyup(function() {
				var search_target = $(this).val();
				//alert(search_target);
				if (search_target.trim() == "") {
					get_msg_contact_list();
				} else {
					get_msg_contact_list(search_target);
				}
			});


			// select_contact_list
			$('body').on('click', '#select_contact_list', function() {
				var target = ($(this).attr('value'));
				$('#select_inbox_msg').modal('hide');
				//alert(target)
				var add_data = {};
				add_data['f'] = '75';
				add_data['MSG_ID'] = target;
				add_data['case_id'] = "<?php echo $case_id; ?>";;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						load_map_msg_4_select();
						load_attached_img();
						swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			function load_map_msg_4_select() {
				//alert(target)

				var add_data = {};
				add_data['f'] = '76';
				add_data['case_id'] = "<?php echo $case_id; ?>";;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							//print_text = "<Option disabled selected>=== เลือกข้อความ ===</Option>";
							var first_select_str = " selected"
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								print_text += "<Option value='" + val.MSG_ID + "' " + first_select_str + " msg_url='" + val.msg_link + "'> " + val.sender_name + " </Option>";
								first_select_str = ""
							});

							$("#list_4_select_msg_inbox_case").html(print_text);
							$("#div_for_msg_in_page").removeClass("collapsed-box");
							$("#list_4_select_msg_inbox_case").change();

						} else {
							$("#div_for_msg_in_page").removeClass("collapsed-box").addClass("collapsed-box");

						}
					});
			}

			//list_4_select_msg_inbox_case
			$("#list_4_select_msg_inbox_case").change(function() {
				load_inbox_msg();
			});

			function load_inbox_msg() {

				var target = $("#list_4_select_msg_inbox_case").val();
				$("#msg_result_box").html('<i class="fa fa-refresh fa-spin"></i> Loading...')
				var add_data = {};
				add_data['f'] = '30';
				add_data['msg_id'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_0_index.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "[]") {
							var current_contact_name = "";
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								other_msg = "";
								//CHECK IS URL
								if (isUrlValid(val.MSG)) {
									val.MSG = "<a href='" + val.MSG + "' target='_blank'>" + val.MSG.substring(0, 30) + "...</a>";
								}




								if (val.Attached_flg == 'Y') {
									is_sticker_text = "";
									//alert (val.file_type)
									switch (val.file_type) {
										case "application/pdf":
											//alert (val.file_type)
											other_msg = '<a href="' + val.File_URL + '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' + val.file_name + '</font></small></H4></a>';
											break;
										case "image/jpeg":
											//alert (val.file_type)
											other_msg = '<a href="' + val.File_URL + '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' + val.file_name + '</font></small></H4></a>';
											other_msg = "<img class='chat_sticker_img' src='" + val.File_URL + "'></img>";
											break;
										default:
											other_msg = '<a href="' + val.File_URL + '" target="_blank"><H4><i class="fa fa-file-o"> </i> <small><font color="#444444">' + val.file_name + '</font></small></H4></a>';
											break;
									}
								}

								var ms = moment().diff(moment(val.created_time, "YYYY-MM-DD hh:mm:ss"));

								if (val.From_ID == '372488206116588') {
									is_sticker_text = "chat_msg_page"
									if (val.sticker != "") {
										other_msg = "<img class='chat_sticker' src='" + val.sticker + "'></img>"
										is_sticker_text = "";
									}
									if (val.Attached_flg == 'Y') {
										is_sticker_text = "";
									}
									print_text += '<div class="direct-chat-msg right">';
									print_text += '<div class="direct-chat-info clearfix">';
									//print_text += '<span class="direct-chat-name pull-right">'+val.from_name+'</span><BR>';
									if (ms < 259200000) {
										print_text += '<span class="direct-chat-timestamp pull-right">' + moment(val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</span>';
									} else {
										print_text += '<span class="direct-chat-timestamp pull-right">' + moment(val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</span>';
									}

									print_text += '</div>';
									//print_text += '<img class="direct-chat-img" src="img/wd_img/default.png" alt="message user image">';

									print_text += '<div class="' + is_sticker_text + ' pull-right">';
									print_text += val.MSG;
									print_text += other_msg;
									print_text += '</div>';
									print_text += '</div>';
								} else {
									is_sticker_text = "chat_msg_send"
									if (val.sticker != "") {
										other_msg = "<img class='chat_sticker' src='" + val.sticker + "'></img>"
										is_sticker_text = "";
									}
									if (val.Attached_flg == 'Y') {
										is_sticker_text = "";
									}
									current_contact_name = val.from_name;
									print_text += '<div class="direct-chat-msg">';
									print_text += '<div class="direct-chat-info clearfix">';
									//print_text += '<span class="direct-chat-name pull-left">'+val.from_name+'</span><BR>';
									if (ms < 86400000) {
										print_text += '<span class="direct-chat-timestamp pull-left">' + moment(val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</span>';
									} else {
										print_text += '<span class="direct-chat-timestamp pull-left">' + moment(val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
											sameElse: 'DD MMMM YYYY'
										}) + '</span>';
									}
									print_text += '</div>';
									//print_text += '<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">';
									print_text += '<div class="' + is_sticker_text + ' pull-left">';
									print_text += val.MSG;
									print_text += other_msg;
									print_text += '</div>';
									print_text += '</div>';

								}
							});

							//$("#contact_name").html(current_contact_name);

							$("#msg_result_box").html(print_text)
							var objDiv = document.getElementById("msg_result_box");
							objDiv.scrollTop = objDiv.scrollHeight;
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			//delete_msg_inbox
			$('body').on('click', '#delete_msg_inbox', function() {
				var target = $("#list_4_select_msg_inbox_case").val();

				if (target != null) {
					var add_data = {};
					add_data['f'] = '77';
					add_data['MSG_ID'] = target;
					add_data['case_id'] = "<?php echo $case_id; ?>";;

					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							//load_map_msg_4_select()

							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});

							// Refresh msg
							load_attached_img();
							load_map_msg_4_select();
							$("#msg_result_box").html("")


						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}


			});

			function getyoutubeId(url) {
				var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = url.match(regExp);

				if (match && match[2].length == 11) {
					return match[2];
				} else {
					return 'error';
				}
			}


			function load_new_timeline() {
				var add_data = {};
				add_data['f'] = '78';
				add_data['case_id'] = "<?php echo $case_id; ?>";;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var current_contact_name = "";
							var data_arr = JSON.parse(data);
							print_text = "";
							current_date = "";
							var _ep_cnt = 1;
							var EP_Print = ""
							jQuery.each(data_arr, function(i, val) {

								// Setup Text
								temp_current_date = moment(val.time_stmp, "YYYY-MM-DD hh:mm:ss").format('ddd D MMM YYYY');
								//alert(temp_current_date)
								if (current_date != temp_current_date) {
									current_date = temp_current_date;
									print_text += '<li class="time-label"><span class="bg-blue">' + current_date + '</span></li>';
								}
								var status_header = ""
								var status_time = '<i class="fa fa-clock-o"></i> ' + moment(val.time_stmp, "YYYY-MM-DD hh:mm:ss").format('LT');
								var status_show = ""
								var detail_show = val.detail;
								var bg_color_text = "";
								EP_Print = ""
								switch (val.case_status) {
									case '0':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-home bg-blue"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '1':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-compass bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '2':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-commenting bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '3':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-hand-stop-o bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '4':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-ban bg-red"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '5':
										//bg_color_text = 'style="background-color: #eef6ee;" ';
										if (val.CHECK_EP != null) {
											EP_Print = "<span class='badge bg-green pull-right'>Episode : " + _ep_cnt + '</span><Br>';
											_ep_cnt += 1;

										}

										detail_show = EP_Print + " <div class='timeline-footer' id='timeline_facebook_panel' value = '" + val.url + "' style='padding: 5px; width: 100%; word-break: break-all; word-wrap: break-word;'></div>"
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-facebook bg-green"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '6':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-bookmark-o bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '7':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-book bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '8':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-pencil bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '11':
										status_time = ""
										//bg_color_text = 'style="background-color: #ecdfdf;" ';
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-newspaper-o  bg-blue"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										if (isUrlValid(val.url)) {
											if (val.url.indexOf("youtu") >= 0) {
												var videoId = getyoutubeId(val.url);
												detail_show += '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>'
											} else if (val.url.indexOf("facebook.com") >= 0) {
												detail_show += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
											} else {
												detail_show = "<div value='" + val.url + "' id='timeline_other_link_panel' ></div>";
											}

										}
										//detail_show += val.url;

										break;
									case '12':
										status_time = ""
										//bg_color_text = 'style="background-color: #ecdfdf;" ';
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-hand-o-right bg-maroon"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										if (isUrlValid(val.url)) {
											if (val.url.indexOf("youtu") >= 0) {
												var videoId = getyoutubeId(val.url);
												detail_show += '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>'
											} else if (val.url.indexOf("facebook.com") >= 0) {
												detail_show += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
											} else {
												detail_show = "<div value='" + val.url + "' id='timeline_other_link_panel' ></div>";
											}

										}
										break;
									case '13':
										status_time = ""
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-quote-left bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '20':
										status_time = ""
										status_header = val.description;
										status_show = '<i class="fa fa-paper-plane bg-blue"></i>';
										break;
									case '21':
										status_time = ""
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-send bg-orange"></i>';
										break;
									case '31':
										//status_time = ""
										status_header = val.description;
										//alert(val.url)
										status_show = '<i class="fa fa-facebook bg-yellow"></i>';
										detail_show = '<a class="btn btn-social btn-facebook" href="https://www.facebook.com/groups/Watchdog.TAC1/' + val.url + '" target="_blank">'
										detail_show += '<i class="fa fa-facebook"></i> ลิ้งในศูนย์'
										detail_show += '</a>'
										break;
									default:
										break;

								}
								//
								var disable_body = ""
								//style="display: none;"
								if (detail_show == "") {
									disable_body = 'style="display: none;"';
								}




								print_text += '<li>';
								print_text += status_show;
								print_text += '<div class="timeline-item" ' + bg_color_text + ' >';
								print_text += '<span class="time">' + status_time + '</span>';
								print_text += '<h5 class="timeline-header">' + status_header + '</h5>';
								print_text += '<div class="timeline-body" ' + disable_body + '>' + detail_show;
								print_text += '</div>';
								print_text += '</div>';
								print_text += '</li>';
							});
							print_text += '<li><i class="fa fa-clock-o bg-gray"></i></li>';
							$("#timeline_new").html(print_text);
							load_facebook_data();
							load_other_url_data();
							load_gov_check_per_case();
						}


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function load_other_url_data() {
				$('body div#timeline_other_link_panel').each(function(i, obj) {
					var target = ($(this).attr('value'));
					$(this).html('<i class="fa fa-refresh fa-spin"></i> Loading...');
					//alert(target)
					var print_text = ""
					var add_data = {};
					add_data['key'] = 'd5745023a4695eb988418ba754e38477';
					add_data['q'] = target;

					$.ajax({
							type: 'GET',
							dataType: "text",
							url: 'http://api.linkpreview.net/',
							data: (add_data)
						})
						.done(function(data) {
							//alert(data)

							var data_arr = JSON.parse(data);
							//console.log(data_arr);
							var val = data_arr

							if (val.title != "") {


								print_text += '<Table>';
								print_text += '<TR>';
								print_text += '<TD>';
								print_text += '<img src="' + val.image + '"  height="150" width="150">';
								print_text += '</TD>';
								print_text += '<TD style="padding: 5px;">';
								print_text += '<B><a href="' + val.url + '" target="_blank">' + val.title + '</a></font></TD>';
								print_text += '</TR>';
								print_text += '</Table>';
								print_text += '<h5>' + val.description + '</h5>';
								//alert(print_text);
								$(obj).html(print_text);
								//$(this).html(print_text)
							} else {
								//alert("zzz")
								print_text += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
								$(obj).html(print_text);
							}


						})
						.fail(function() {
							// just in case posting your form failed
							print_text += "<BR><a href='" + target + "' target='_blank'>" + target.substring(0, 30) + "...</a>";
							//alert(print_text)
							$(obj).html(print_text);
						});


				});
			}





			// Show image process...
			function initial_attached_image() {
				$(".img-w").each(function() {
					$(this).wrap("<div class='img-c'></div>")
					let imgSrc = $(this).find("img").attr("src");
					$(this).css('background-image', 'url(' + imgSrc + ')');
				})


				$(".img-w").click(function() {
					var img_target = $(this).find("img").attr("src")
					//modal_show_attached_image
					// img-attached-show
					$("#img-attached-show").attr("src", img_target)
					$('#modal_show_attached_image').modal('show');

				})

			};


			function load_attached_img() {
				var add_data = {};
				add_data['f'] = '82';
				add_data['case_id'] = "<?php echo $case_id; ?>";

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {

						print_text = ""
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							jQuery.each(data_arr, function(i, val) {
								//alert(val.File_URL)
								print_text += '<div class="img-w"><img src="' + val.File_URL + '" alt="" /></div>'
							});




						}

						$("#attached_img_gallery").html(print_text)
						//alert(print_text)
						initial_attached_image()







					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//jump_msg
			$('body').on('click', '#jump_msg', function() {
				//var target = $("#list_4_select_msg_inbox_case").val();
				var msg_url = $('option:selected', "#list_4_select_msg_inbox_case").attr('msg_url');
				window.open('https://www.facebook.com/' + msg_url, '_blank');

			});


			//$("#c_table_team").select2();
			function load_c_table_4_select() {
				//alert(target)

				var add_data = {};
				add_data['f'] = '85';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						var data_arr = JSON.parse(data);
						//print_text = "<Option disabled selected>=== เลือกข้อความ ===</Option>";
						//var first_select_str = " selected"
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							if (val.exist_wd_id != null) {
								print_text += "<Option value='" + val.wd_id + "' selected>" + val.n_name + "</Option>";
							} else {
								print_text += "<Option value='" + val.wd_id + "'>" + val.n_name + "</Option>";
							}

						});

						$("#c_table_team").html(print_text);
						$("#c_table_team").select2();


					});
			}
			$("#c_table_team").on("change", function(e) {
				var values = $(this).val().join(",");
				//alert(values);
				var add_data = {};
				add_data['f'] = '86';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				add_data['support_wd'] = values;
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						get_wd_support();
					});


			});

			function load_google_drive_link() {
				//alert(values);
				var add_data = {};
				add_data['f'] = '87';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							$("#gg_drive_link").html('<a href="' + data_arr[0]['gg_folder_URL'] + '" target="_blank"><img src="img/g_drive.png" width="50%" ></img></a>')
							//alert(data_arr[0]['gg_folder_URL'])
						}
					});
			}


			function load_eff_type() {
				//alert(values);
				var add_data = {};
				add_data['f'] = '90';
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {
								print_text += "<Option value='" + val.gc_id + "'>" + val.s_name + "</Option>";

							});

							$("#case_a_eff_type").html(print_text);
							//$("#case_a_eff_type").select2();
						}
					});
			}

			function load_gov_check_per_case() {
				//alert(values);
				var add_data = {};
				add_data['f'] = '91';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "";
							jQuery.each(data_arr, function(i, val) {

								if (val.case_id == null) {
									print_text += '<H4 class="text-mute"><i class="fa fa-square-o"></i> ' + val.s_name + ' </H4>';
								} else {
									print_text += '<H4 class="text-green"><i class="fa fa-check-square-o"></i> ' + val.s_name + '  <small>(' + val.gov_dev_name + ' วันที่ ' + moment(val.investigate_date, "YYYY-MM-DD").format('D MMM YYYY') + ')</small> </H4>';
								}
							});
							//alert(print_text)
							$("#gov_check_data_panal").html(print_text);
							//alert(data_arr[0]['gg_folder_URL'])
						}
					});
			}

			function load_hastag_for_select() {
				//alert(values);
				var add_data = {};
				add_data['f'] = '88';
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "[]") {
							var data_arr = JSON.parse(data);
							print_text = "<Option selected disabled></Option>";
							jQuery.each(data_arr, function(i, val) {

								print_text += "<Option>";
								print_text += val.hashtag;
								print_text += "</Option>";
							});
							//alert(print_text)
							$("#select_new_hashtag").html(print_text);
							$("#select_new_hashtag").select2({
								tags: true
							});
						}

					});
			}

			$("#select_new_hashtag").on("change", function(e) {
				var values = $(this).val();
				var add_data = {};
				add_data['f'] = '89';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				add_data['new_hash_tag'] = values;
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						load_hastag_for_select();
						load_case_hashtag();
						$("#add_new_tag_panel").hide();
					});

			});

			//add_new_tag
			$('body').on('click', '#add_new_tag', function() {
				$("#add_new_tag_panel").show("fast");
				load_hastag_for_select();

			});

			//load_tag_analyz
			$('body').on('click', '#load_tag_analyz', function() {

				var target_tag = $(this).attr('value');
				var add_data = {};
				add_data['f'] = '93';
				add_data['target_tag'] = target_tag;
				//alert(add_data['support_wd']);
				swal({
					type: 'info',
					title: 'กำลังโหลดข้อมูล',
					text: "กรุณารอสักครู่",
					allowOutsideClick: false,
					showConfirmButton: false,
				});
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						//http://127.0.0.1/WD_system/16_case_analysis.php?ran_str=
						swal.close();
						//window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						var redirectWindow = window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						redirectWindow.location;
					});

			});

			//load_job_type_anyz
			$('body').on('click', '#load_job_type_anyz', function() {

				var target_data = $(this).attr('value');
				//alert(target_data)
				var add_data = {};
				add_data['f'] = '96';
				add_data['target_data'] = target_data;
				//alert(add_data['support_wd']);
				swal({
					type: 'info',
					title: 'กำลังโหลดข้อมูล',
					text: "กรุณารอสักครู่",
					allowOutsideClick: false,
					showConfirmButton: false,
				});
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						swal.close();
						//console.log(data)
						//window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						var redirectWindow = window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						redirectWindow.location;
					});

			});

			//load_crp_type_analyz
			$('body').on('click', '#load_crp_type_analyz', function() {

				var target_data = $(this).attr('value');
				//alert(target_data)
				var add_data = {};
				add_data['f'] = '97';
				add_data['target_data'] = target_data;
				swal({
					type: 'info',
					title: 'กำลังโหลดข้อมูล',
					text: "กรุณารอสักครู่",
					allowOutsideClick: false,
					showConfirmButton: false,
				});
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						swal.close();
						//console.log(data)
						//window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						var redirectWindow = window.open('16_case_analysis.php?ran_str=' + data, '_blank');
						redirectWindow.location;
					});

			});

			//add_case_url
			$('body').on('click', '#add_case_url', function() {

				var target_data = $("#case_text_case_url").val();
				if (target_data != "") {
					$("#case_text_case_url").val("")
					var add_data = {};
					add_data['f'] = '101';
					add_data['case_id'] = "<?php echo $case_id; ?>";
					add_data['target_data'] = target_data;
					//alert(add_data['support_wd']);
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {
							load_act_ai_url();
						});
				}

			});

			function load_act_ai_url() {
				var add_data = {};
				add_data['f'] = '102';
				add_data['case_id'] = "<?php echo $case_id; ?>";
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "[]") {

							var data_arr = JSON.parse(data);
							var print_html = "";
							jQuery.each(data_arr, function(i, val) {
								print_html += "<div id='act_ai_link_panel' value='" + val.url + "' rnd_id='" + val.rnd_id + "'>"
								print_html += "</div><HR>"

							});
							//alert(print_html)
							$("#case_url_preview").html(print_html);
						}
						load_act_ai_pnl()

					});
			}

			function load_act_ai_pnl() {
				$('body div#act_ai_link_panel').each(function(i, obj) {
					var target = ($(this).attr('value'));
					var rnd_id = ($(this).attr('rnd_id'));
					//alert(target)
					//alert(rnd_id)
					$(this).html('<i class="fa fa-refresh fa-spin"></i> Loading...');
					//alert(target)
					var print_text = ""
					var add_data = {};
					add_data['key'] = 'd5745023a4695eb988418ba754e38477';
					add_data['q'] = target;

					$.ajax({
							type: 'GET',
							dataType: "text",
							url: 'https://api.linkpreview.net/',
							data: (add_data)
						})
						.done(function(data) {
							//alert(data);

							var data_arr = JSON.parse(data);
							//console.log(data_arr);
							var val = data_arr

							if (val.title != "") {


								print_text += '<Table>';
								print_text += '<TR>';
								print_text += '<TD>';
								print_text += '<img src="' + val.image + '"  height="100" width="100">';
								print_text += '</TD>';
								print_text += '<TD style="padding: 5px;">';
								print_text += '<B><a href="' + val.url + '" target="_blank">' + val.title + '</a></font><BR><h5>' + val.description + '</h5><TD>';
								print_text += '<TD><button type="button" class="close"  id="delete_act_ai_url" value="' + rnd_id + '"><small>&times;</small></button></TD>';
								print_text += '</TR>';
								print_text += '</Table>';
								//alert(print_text);
								$(obj).html(print_text);
								//$(this).html(print_text)
							} else {
								//alert("zzz")
								print_text += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>" + '<button type="button" class="close" id="delete_act_ai_url" value="' + rnd_id + '"><small>&times;</small></button>';
								$(obj).html(print_text);
							}
						})
						.fail(function() {
							// just in case posting your form failed
							print_text += "<BR><a href='" + target + "' target='_blank'>" + target.substring(0, 30) + "...</a>";
							//alert(print_text)
							$(obj).html(print_text);
						});
					//alert(rnd_id)

				});
			}

			//delete_act_ai_url
			$('body').on('click', '#delete_act_ai_url', function() {

				var target_data = $(this).attr('value');
				var add_data = {};
				add_data['f'] = '103';
				add_data['target_data'] = target_data;
				//alert(add_data['support_wd']);
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						load_act_ai_url();
					});


			});








			// ============ Initial when start ========================
			get_case_data();
			get_ofd_name_list();
			get_case_sender();
			get_team_support();
			get_wd_support();
			get_staff_operator();
			print_pub_chanel_tag();
			load_c_table_4_select();
			//ajax_function(14, "#timeline_data", "<?php echo $case_id; ?>");
			//load_timeline();
			ajax_function(6, "#case_staff");
			ajax_function(15, "#team_list");
			get_ofd_type_2();
			get_crp_type_data();

			get_Job_type();

			get_ofd_name_list_v2();

			//print_job_type_select_panel();
			load_job_type_for_select();
			load_ofd_type_for_select();

			load_bf_case();
			load_next_case();

			load_group_post_data_detail();

			load_case_hashtag();
			load_hastag_for_select();


			load_map_msg_4_select();


			load_new_timeline();


			load_attached_img();
			load_google_drive_link();

			load_eff_type();

			load_gov_check_per_case();
			load_act_ai_url();




			<?php echo $pass_success_text; ?>


			//Flat red color scheme for iCheck
			$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
				checkboxClass: 'icheckbox_flat-red',
				radioClass: 'iradio_flat-red'
			})




			window.setTimeout(function() {
				if ($('#alert_sucess_save_data').css('display') != 'none') {
					$("#alert_sucess_save_data").fadeTo(500, 0).slideUp(500, function() {
						$(this).remove();
					});
				}
			}, 4000);

		});
	</script>







</body>

</html>
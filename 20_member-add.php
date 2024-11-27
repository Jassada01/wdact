<!DOCTYPE html>
<html>
	<head>
		<?php
			ob_start();
			include "f_check_cookie.php";
			ob_end_clean();
		?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Watch_Dog | ข้อมูลอาสาสมัคร</title>
		
		<!-- Site icon -->
		<link rel="icon" href="img/system_icon.ico">
		
		
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		
		<!-- crop style -->
		<link rel="stylesheet" href="dist/css/cropstyle.css">
		
		
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js rdoesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
			
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
						Member
						<small>เพิ่มข้อมูลอาสาสมัคร</small>
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-md-6">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลส่วนบุคคล</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal ">
									<div class="box-body">
											<div class="row">
												<div class="col-xs-offset-3  col-xs-6 col-md-offset-4 col-md-3">
													<span class="btn btn-file" id="btn_img" style="background-color:transparent">
														<img id="usr_img" src="img/wd_img/default.png" class="img-circle img-responsive">
													</span>
													<Br>
												</div>
											</div>
										<div class="form-group">
												<label for="m_id" class="col-sm-2 control-label">ID</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="m_id" placeholder="YYGGGXXX"  maxlength="8">
													<div id="warnning_m_id"></div>
												</div>
												
												<label for="m_gen" class="col-sm-2 control-label">รุ่น</label>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="m_gen">
												</div>
										</div>
										
									
										<div class="form-group">
											<label for="m_name" class="col-sm-2 control-label">ชื่อ</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_name" placeholder="ชื่อ">
											</div>
										</div>
										<div class="form-group">
											<label for="m_sname" class="col-sm-2 control-label">นามสกุล</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_sname" placeholder="นามสกุล">
											</div>
										</div>
										<div class="form-group">
											<label for="m_nickname" class="col-sm-2 control-label">ชื่อเล่น</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="m_nickname" placeholder="ชื่อเล่น">
											</div>
										</div>
										<div class="form-group">
											<label for="m_nickname" class="col-sm-2 control-label">วดป เกิด</label>
											<div class="col-sm-4">
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask id="m_dob">
												</div>
												<!-- /.input group -->
											</div>
											
											<label for="m_age" class="col-sm-1 control-label">อายุ</label>
											<div class="col-sm-2">
												<div class="input-group">
													<input type="text" class="form-control" id="m_age" disabled> 
												</div>
												<!-- /.input group -->
											</div>
											
										</div>
										<div class="form-group">
											<label for="m_sex" class="col-sm-2 control-label">เพศ</label>
											<div class="col-sm-4">
												<select class="form-control" id="m_sex">
													<option selected disabled>== เลือกเพศ ==</option>
													<option value="0">ชาย</option>
													<option value="1">หญิง</option>
												</select>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">อาชีพและการศึกษา</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">
									
										<div class="form-group">
											<label for="m_occ" class="col-sm-2 control-label">อาชีพ</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_occ" placeholder="อาชีพ">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_occ_type" class="col-sm-2 control-label">กลุ่มอาชีพ</label>
											<div class="col-sm-8">
												<select class="form-control" id="m_occ_type">
													
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_occ_loc" class="col-sm-2 control-label">ที่ทำงาน</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_occ_loc" placeholder="สถานที่ทำงาน">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_edu" class="col-sm-2 control-label">การศึกษา</label>
											<div class="col-sm-8">
													<select class="form-control" id="m_edu">
														<option value="ไม่ระบุ" selected>ไม่ระบุ</option>
														<option value="กำลังศึกษา">กำลังศึกษา</option>
														<option value="ต่ำกว่าปริญญาตรี">ต่ำกว่าปริญญาตรี</option>
														<option value="ปริญญาตรี">ปริญญาตรี</option>
														<option value="ปริญญาโท">ปริญญาโท</option>
														<option value="ปริญญาเอก">ปริญญาเอก</option>
													</select>
											</div>
										</div>
										
										
										
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">ทีม และ ความเชียวชาญ</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">
										<div class="form-group">
											<label for="m_sex" class="col-sm-2 control-label">ทีม</label>
											<div class="col-sm-8">
												<div class="input-group">
													<select class="form-control" id="m_team">
													</select>
													<span class="input-group-btn" >
														<button type="button" class="btn btn-info btn-flat" id="m_add_team">เพิ่ม</button>
													</span>
												</div>
											</div>
										</div>
										<div class="form-group">
												<label class="col-sm-2 control-label"></label>
												<div class="col-sm-8">
													<div class="col-sm-12">
														 <ul class="todo-list" id="add_team_list">
															
														  </ul>
													  </div>
													  
												</div>
											</div>
										
										<div class="form-group">
											<label for="m_skill" class="col-sm-2 control-label">ความสามารถ</label>
											<div class="col-sm-8">
												<div class="input-group">
													<input type="text" class="form-control" id="m_skill" placeholder="ความเชียวชาญ">
													<span class="input-group-btn" >
														<button type="button" class="btn btn-info btn-flat" id="m_add_skill">เพิ่ม</button>
													</span>
												</div>
											</div>
										</div>
										
											
											<div class="form-group">
												<label class="col-sm-2 control-label"></label>
												<div class="col-sm-8">
													<div class="col-sm-12">
														 <ul class="todo-list" id="add_skill_list">
															
														  </ul>
													  </div>
													  
												</div>
											</div>
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
						</div>
						
						<!-- Right Colume -->
						<div class="col-md-6">
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">ที่อยู่เพื่อการติดต่อ</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">
									
										<div class="form-group">
											<label for="m_add" class="col-sm-2 control-label">ที่อยู่</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_add" placeholder="ที่อยู่">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_add_province" class="col-sm-2 control-label">จังหวัด</label>
											<div class="col-sm-8">
												<select class="form-control" id="m_add_province">
													
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_add_aumper" class="col-sm-2 control-label">อำเภอ</label>
											<div class="col-sm-8">
												<select class="form-control" id="m_add_aumper">
													
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_add_district" class="col-sm-2 control-label">ตำบล</label>
											<div class="col-sm-8">
												<select class="form-control" id="m_add_district">
													
												</select>
											</div>
										</div>
										
										<div class="form-group">
										
											<label for="m_add_zipcode" class="col-sm-2 control-label"></label>
											<div class="col-xs-3">
												<input type="text" class="form-control" id="m_add_zipcode" disabled>
											</div>
										
											<div class="col-xs-5">
												<div class="input-group">
													<input type="text" class="form-control" id="m_add_geo" disabled> 
												</div>
												<!-- /.input group -->
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_tel" class="col-xs-5 col-sm-2 control-label">เบอร์โทร</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_tel" placeholder="เบอร์โทรหลัก">
											</div>
										</div>
										<div class="form-group">
											<label for="m_tel_2" class="col-xs-5 col-sm-2 control-label">เบอร์โทร</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_tel_2" placeholder="เบอร์โทรสำรอง">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_email" class="col-sm-2 control-label">E-mail</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_email" placeholder="E-mail Address">
											</div>
										</div>	
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">Social Media</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">
									
										<div class="form-group">
											<label for="m_facebook" class="col-sm-2 control-label">FB</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_facebook" placeholder="Facebook">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_facebook_2" class="col-sm-2 control-label">FB 2</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_facebook_2" placeholder="Facebook Avatar">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_line" class="col-sm-2 control-label">Line</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_line" placeholder="Line ID">
											</div>
										</div>
										
										<div class="form-group">
											<label for="m_twitter" class="col-sm-2 control-label">twitter</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="m_twitter" placeholder="twitter">
											</div>
										</div>	
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-warning">
								<div class="box-header with-border">
									<h3 class="box-title">ประวัติการฝึกอบรม</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">

											<label for="m_training" class="col-sm-2 control-label">การอบรม</label>
											<div class="col-sm-6 input-group">
												<select class="form-control" id="m_training">
													
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-info btn-flat" id="m_add_training">เพิ่ม</button>
												</span>
											</div>
											
											<Br>
											
											<div class="col-sm-12">
											 <ul class="todo-list" id="add_training_list">
												
											  </ul>
										  </div>
										  <div class="pull-right">
											<button type="button" class="btn bg-maroon margin" id="clear_training_data">ล้างข้อมูลการฝึกอบรม</button>
										  </div>
									</div>
								</form>
								
							</div>
							
							<div class="box box-navy">
								<div class="box-header with-border">
									<h3 class="box-title">หมายเหตุ</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal">
									<div class="box-body">
									
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="m_remark" placeholder="หมายเหตุ">
											</div>
										</div>
									</div>
								</form>
							</div>
							
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-12">
								<div class="box-header with-border text-center">
									<button type="button" class="btn bg-primary btn-lg" id="submit_data">บันทึกข้อมูล</button>
									<button type="button" class="btn bg-danger btn-lg" onClick="window.location.reload()">ล้างข้อมูล</button>
								</div>
						</div>
					</div>
					
					<!-- /.box -->
				<div class="modal modal-danger fade" id="modal-danger">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน</h4>
							</div>
							<div class="modal-body">
								<p>กรอกข้อมูลที่จำเป็นในช่องที่ไฮไลท์สีแดง</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline" data-dismiss="modal">ปิด</button>
							</div>
						</div>
							<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				
				
			<div class="modal fade" id="modal-summary">
				<div class="modal-dialog  modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">ข้อมูลอาสาสมัคร</h4>
						</div>
						<div class="modal-body">
							<!-- Profile Image -->
							<div class="row">
								<div class="col-md-6">
									<div class="box box-primary">
										<div class="box-header">
											<h3 class="box-title" id="wd_status_show"></h3>
											<div class="box-tools pull-right">
												<button type="button" class="btn btn-box-tool" id="btn_detail_data"><i class="fa fa-share-square"></i> ข้อมูลอย่างละเอียด</button>
												<button type="button" class="btn btn-box-tool" id="btn_edit_data"><i class="fa fa-pencil"></i> แก้ไข</button>
											</div>
										</div>
										<div class="box-body box-profile">
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
								</div>
								<!-- /.box -->
								<div class="col-md-6">
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
								</div>
								<!-- /.box -->
							</div>
							<!-- /.row -->
						</div>
						<div class="modal-footer">
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			
			<div class="modal fade" id="modal-add-img">
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
		<!-- Select2 -->
		<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
		<!-- InputMask -->
		<script src="plugins/input-mask/jquery.inputmask.js"></script>
		<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<!-- date-range-picker -->
		<script src="bower_components/moment/min/moment.min.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap datepicker -->
		<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- bootstrap color picker -->
		<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<!-- bootstrap time picker -->
		<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<!-- SlimScroll -->
		<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<!-- iCheck 1.0.1 -->
		<script src="plugins/iCheck/icheck.min.js"></script>
		<!-- FastClick -->
		<script src="bower_components/fastclick/lib/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!--  cropbox-->
		<script src="dist/js/cropbox.js"></script>
		
		
		<!-- bootstrap tab -->
		  <script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
		<!-- Page script -->
		<script>
		$(document).ready(function(){

		var availableTags = [
		<?php
			// Connect to MySQL Database
			include "connectionDb.php";
			$sql = "SELECT DISTINCT(wd_skill) as data from wd_skill "; 
			$res = $conn->query(trim($sql));
			mysqli_close($conn);
			$cl_check = "";
			while ($row = $res->fetch_assoc()){
				echo $cl_check.'"'.$row['data'].'"';
				$cl_check = ",";
			}
		?>
    ];
    $( "#m_skill" ).autocomplete({
      source: availableTags
    });

	
			var availableTags2 = [
			<?php
				// Connect to MySQL Database
				include "connectionDb.php";
				$sql = "Select DISTINCT(education) as data From wd_db  ";
				$res = $conn->query(trim($sql));
				mysqli_close($conn);
				$cl_check = "";
				while ($row = $res->fetch_assoc()){
					echo $cl_check.'"'.$row['data'].'"';
					$cl_check = ",";
				}
			?>
		];
		$( "#m_edu" ).autocomplete({
		  source: availableTags2
		});
			//Global Var
			var traning_list = [];
			var traning_list_id = [];
			var skill_list = [];
			var team_skill_list = [];
			var team_list = [];
			var team_list_name = [];
			
			var current_modal_show_wd_id = "";
			
			
			
			// Standard Ajax Function 
				function ajax_function($f, $d_name, $p1, $p2, $p3) {
					// Check parameter has been set or not
					$f = $f || "0";
					$p1= $p1 || "0";
					$p2= $p2 || "0";
					$p3= $p3 || "0";
					// Set Ajax
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: ({f : $f,
								p1 : $p1,
								p2 : $p2,
								p3 : $p3})
					})
					.done(function(data){
							if ($($d_name).is('input'))
							{
								$($d_name).val(data);
							}
							else
							{
								$($d_name).html(data);
							}
					})
					.fail(function() {
						// just in case posting your form failed
						alert( "Posting failed." );
					});
					return false;	
				};
			
			// Standard get Skill team Ajax Function 
				function ajax_get_skill_team_function($f, $d_name, $p1, $p2, $p3) {
					// Check parameter has been set or not
					$f = $f || "0";
					$p1= $p1 || "0";
					$p2= $p2 || "0";
					$p3= $p3 || "0";
					// Set Ajax
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						data: ({f : $f,
								p1 : $p1,
								p2 : $p2,
								p3 : $p3})
					})
					.done(function(data){
							 team_skill_list = data.split(",");
							 if (team_skill_list[0] == "")
							 {
								 team_skill_list = [];
							 }
							 print_skill_list();
							//return data;
					})
					.fail(function() {
						// just in case posting your form failed
						alert( "Posting failed." );
						return false;
					});
				};
			
			// Custom_for send data Ajax Function 
				function ajax_snd_data_function($f, $d_name) {
					// Check parameter has been set or not
					$f = $f || "0";
					
					
					// Upload Image
					file_name = "default.png";
					if ($('#usr_img').attr('src') != "img/wd_img/default.png")
					{
						file_name = makeid()+".png";
						//alert (file_name)
						var file = $('#usr_img').attr('src');
						
						var formData = new FormData();
						formData.append("filUpload", file);
						formData.append("file_name", file_name);
						
						var xhr = new XMLHttpRequest();
						xhr.open('POST', 'uploadfile.php', true);
						xhr.send(formData);
					}
					
					
					// Get All Data
					var ass_data = {}
					ass_data['f'] = '8';
					$( "input" ).each(function( index ) {
						ass_data[$( this ).attr('id')] = $( this ).val();
					});
					
					// Get traning_info
					traning_text = "";
					$.each(traning_list_id, function( index, value) {
						if (index != 0)
						{
							traning_text = traning_text + "-,-";
						}
						traning_text = traning_text + value;
					});
					ass_data['img'] = file_name;
					ass_data['traning_data'] = traning_text;
					
					// Get skill_info
					skill_text = "";
					$.each(skill_list, function( index, value) {
						if (index != 0)
						{
							skill_text = skill_text + "-,-";
						}
						skill_text = skill_text + value;
					});
					ass_data['skill_data'] = skill_text;
					ass_data['team_data'] = team_list.join();
					
					
					// Get Occ Type
					ass_data['m_occ_type'] = $("#m_occ_type").val()
					
					// Get District Code
					ass_data['m_add_district'] = $("#m_add_district").val()
					
					// Get Sex
					ass_data['m_sex'] = $("#m_sex").val()
					
					// Get Sex
					ass_data['m_edu'] = $("#m_edu").val()
					// Set Ajax
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_2_member.php',
						
						data: (ass_data)
					})
					.done(function(data){
							if (data == "")
							{
								 var target_id = $( "#m_id" ).val();
								 current_modal_show_wd_id = target_id;
								 load_basic_wd_data(target_id);
								 load_wd_data(target_id);
								//ajax_function(10, "#modal-summary-data", $( "#m_id" ).val());
								$('#modal-summary').modal('show');
							}
							else 
							{
								alert(data);
							}
							
					})
					.fail(function() {
						// just in case posting your form failed
						alert( "Posting failed." );
					});
					return false;	
				};
			
			// Get Aumpher when select Province==================
			$( "#m_add_province" ).change(function() {
				// Clear Data
				$("#m_add_district").html("");
				$("#m_add_zipcode").val("");
				
				// Call Function std Ajax for get Aumpher name
				ajax_function(2, "#m_add_aumper", $(this).val());
				// Call Function std Ajax for get GEO name
				ajax_function(4, "#m_add_geo", $(this).val());
				
				
			});
			
			// Get District  when select Aumpher==================
			$( "#m_add_aumper" ).change(function() {
				//clear Data
				$("#m_add_zipcode").val("");
				
				// Call Function std Ajax for get district  name
				ajax_function(3, "#m_add_district", $(this).val());
			});
			
			// Get Zipcode  when select district==================
			$( "#m_add_district" ).change(function() {
				// Call Function std Ajax for get zipcode 
				ajax_function(5, "#m_add_zipcode", $(this).val());
			});
			
			// Add traning on click
			$( "#m_add_training" ).click(function() {
				//alert($("#m_training").val());
				//traning_list.push($("#m_training").val())
				if(jQuery.inArray($("#m_training").val(), traning_list) == -1)
				{
					if ($("#m_training").val() !== null)
					{
						traning_list.push($("#m_training option:selected").text());
						traning_list_id.push($("#m_training").val())
					}
					
				}
				print_traning_list();
			});
			
			// Clear Traing Data
			$( "#clear_training_data" ).click(function() {
					traning_list = [];
					traning_list_id = [];
					print_traning_list();
			});
			
			// make traning list output
			function print_traning_list()
			{
				//alert(traning_list);
				var print_text = "";
				$.each(traning_list, function( index, value) {
				  print_text += '<li><span class="text">' + value + '</span></li>';
				});
				
				// Print output
				$("#add_training_list").html(print_text);
			}
			
			// ============ Skill ========================
			// Add traning on click
			$( "#m_add_skill" ).click(function() {
				if(jQuery.inArray($("#m_skill").val(), skill_list) == -1)
				{
					if ($("#m_skill").val() !== "")
					{
						skill_list.push($("#m_skill").val())
						$("#m_skill").val("");
					}
					
				}
				print_skill_list();
			});
			// Random_code
			function makeid() {
					var text = "";
					var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

					for (var i = 0; i < 15; i++)
						text += possible.charAt(Math.floor(Math.random() * possible.length));
					return text;
				}

			
			// ============================ Check when focus lost ============================
			

			// Update Gen when change ID
			$( "#m_id" ).keyup(function() {
					if($.isNumeric($("#m_id").val()))
					{
						if ($( "#m_id" ).val().length == 8)
						{
							var id_tmp = $( "#m_id" ).val();
							var gen_tmp = id_tmp.substring(2, 5);
							var gen = parseInt(gen_tmp);
							$("#m_gen").val(gen);
							
							traning_list = [];
							traning_list.push("อบรมเชิงปฏิบัติการ รุ่นที่ " + gen);
							print_traning_list();
							
							ajax_function(9, "#warnning_m_id", $( "#m_id" ).val());
						}
						else
						{
							$("#warnning_m_id").html("");
						}		
					}
					
			});
			
			$('body').on('click','#skill_list',function(){
				//var target = ($(this).prev().text());
				var target = ($(this).attr('value'));
				//alert(target)
				$.each(skill_list, function( index, value) {
					if (value == target)
					{
						skill_list.splice(index, 1);
					}
				});
				print_skill_list();
			});
			
			// make skill  list output
			function print_skill_list()
			{
				//alert(traning_list);
				var print_text = "";
				$.each(skill_list, function( index, value) {
				  print_text += '<li class="success"><span class="text"">' + value + '</span><div class="tools"><i class="fa fa-trash-o" id="skill_list" value="' + value + '"></i></div></li>';
				});
				
				//alert (team_skill_list);
				$.each(team_skill_list, function( index, value) {
				  print_text += '<li class="danger"><span class="text"">' + value + '</span></li>';
				});
				
				$("#add_skill_list").html(print_text);
			}
			
			//  Reset all input
			function reset_all_input()
			{
				$( "input" ).each(function( index ) {
					$( this ).val("");
				});
			}
			
			
			// Function for calculate age ==================
			$('#m_dob').focusout(function(){
					    var today = new Date();
						dt = this.value.split('/');
						var birthDate = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])
						var age = today.getFullYear() - (birthDate.getFullYear() - 543);
						var m = today.getMonth() - birthDate.getMonth();
						if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
							age--;
						}
						//alert(age);
						$("#m_age").val(age);
			});
			
			// Mgen focus out muto create ID
			$('#m_gen').focusout(function(){
				if ($.isNumeric($('#m_gen').val()))
				{
					if (($( "#m_id" ).val() == "") || ($( "#m_id" ).val().length != 8) || parseInt($( "#m_id" ).val().substring(2, 5)) != $('#m_gen').val())
					{
						
						ajax_function(11, "#m_id", $( "#m_gen" ).val());
						var gen = $('#m_gen').val()
						
						traning_list = [];
						traning_list_id = [];
						traning_list.push("อบรมเชิงปฏิบัติการ รุ่นที่ " + gen);
						
						// Get gen id
						var add_data = {}
						add_data['f'] = '19';
						add_data['gen'] = gen;
						$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_2_member.php',
							data: (add_data)
						})
						.done(function(data) {
							var ojb = JSON.parse(data);
							traning_list_id.push(ojb.Training_ID);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
							
						});
						print_traning_list();
					}
				}
			});
			//============== Submit Click ============================
			$( "#submit_data" ).click(function() {
					
				   // Check data
				   var target_check_list = ['m_id', 'm_gen', 'm_name', 'm_sname', 'm_nickname', 'm_dob', 'm_occ', 'm_edu', 'm_add', 'm_tel', 'm_facebook'];
				   var check_rest = 0;
				   
				   

				   
				   $( "input" ).each(function( index ) {
					   if(jQuery.inArray($( this ).attr('id'), target_check_list) != -1)
					   {
						   $(this).css({'background-color' : '#ffffff'});
						   if ($(this).val() == "")
						   {
							   check_rest = 1;
								$(this).css({'background-color' : '#ffb3b3'});
						   } 
					   }
					});
				   
				   
				   // Check Sex input
				   $("#m_sex").css({'background-color' : '#ffffff'});
				   if ($("#m_sex").val() == null)
				   {
					   check_rest = 1;
					   $("#m_sex").css({'background-color' : '#ffb3b3'});
				   }
				   
				   // Check edu input
				   $("#m_edu").css({'background-color' : '#ffffff'});
				   if ($("#m_edu").val() == null)
				   {
					   check_rest = 1;
					   $("#m_edu").css({'background-color' : '#ffb3b3'});
				   }
				   
				   // Check occ_type input
				   $("#m_occ_type").css({'background-color' : '#ffffff'});
				   if ($("#m_occ_type").val() == null)
				   {
					   check_rest = 1;
					   $("#m_occ_type").css({'background-color' : '#ffb3b3'});
				   }
				   
				    // Check add_district input
				   $("#m_add_district").css({'background-color' : '#ffffff'});
				   if ($("#m_add_district").val() == null)
				   {
					   check_rest = 1;
					   $("#m_add_district").css({'background-color' : '#ffb3b3'});
				   }
				   
				   
				   // Check M_ID
				 //alert($("#warnning_m_id").html())
				   if ($("#warnning_m_id").html() != "" )
				   {
					   check_rest = 1;
					   $("#m_id").css({'background-color' : '#ffb3b3'});
				   }					   
					   
				   
				   if (check_rest == 0)
				   //if (1)
				   {
					   ajax_snd_data_function(8, "add_skill_list");
				   }
				   else
				   {
					   $('#modal-danger').modal('show');
				   }
				   
					//ajax_snd_data_function(8, "add_skill_list");

			});

			$('#modal-summary').on('hidden.bs.modal', function () {
			  window.location.reload()
			});
			
			// Crop box =========================
			$( "#usr_img" ).click(function() {
				$('#modal-add-img').modal('show');
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
			 $('#usr_img').attr('src', img);
			 $('#modal-add-img').modal('hide');
        })
        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })
        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
			
		// Click add team
		$( "#m_add_team" ).click(function() {
				var select_team = $("#m_team").val();
				if(jQuery.inArray(select_team, team_list) == -1)
					{
								team_list.push(select_team);
								team_list_name.push($("#m_team option:selected").text());
								print_team_list();
					}
				//alert (team_list_name)
			});
		
		$('body').on('click','#del_team_list',function(){
				//var target = ($(this).prev().text());
				var target = ($(this).attr('value'));
				//alert(target)
				$.each(team_list, function( index, value) {
					if (value == target)
					{
						team_list.splice(index, 1);
						team_list_name.splice(index, 1);
					}
				});
				print_team_list();
			});
		
		function print_team_list()
		{
			//alert(traning_list); 
			var print_text = "";
			$.each(team_list_name, function( index, value) {
				print_text += '<li class="info"><span class="text"">' + value + '</span><div class="tools"><i class="fa fa-trash-o" id="del_team_list" value="' + team_list[index] + '"></i></div></li>';
			});
			
			// Print output
			$("#add_team_list").html(print_text);
			ajax_get_skill_team_function(16, "", team_list.join());
			//alert (skill_list_from_team);
			
		}
		
			// Load WD_Data
			function load_basic_wd_data(target_wd_id)
			{
			//alert (target_wd_id);
			var add_data = {}
			add_data['f'] = '21';
			add_data['wd_id'] = target_wd_id;
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
				
				
				
				
			// Load WD_Data
			function load_wd_data(target_wd_id)
			{
			var add_data = {}
			add_data['f'] = '20';
			add_data['wd_id'] = target_wd_id;
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
			
			//btn_edit_data
			$( "#btn_edit_data" ).click(function() {
				//window.location.href ('22_member-edit.php?id=' + current_modal_show_wd_id);
				window.open('22_member-edit.php?id=' + current_modal_show_wd_id, '_blank');
			});
				
				
			//btn_edit_data
			$( "#btn_detail_data" ).click(function() {
				//window.location.href ('22_member-edit.php?id=' + current_modal_show_wd_id);
				window.open('24_member_data.php?wd_id=' + current_modal_show_wd_id, '_blank');
			});
			
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

			
			// ======= Initial run from start page==========================
			
			ajax_function(1, "#m_add_province");
			ajax_function(6, "#m_training");
			ajax_function(7, "#m_occ_type");
			ajax_function(15, "#m_team");
			
			//==================================================
			
		});
		$(function(){
			//Datemask dd/mm/yyyy
			//$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
			//Money Euro
			$('[data-mask]').inputmask()	

			
		});
		</script>

	</body>
</html>

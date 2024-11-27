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
		<title>Watch_Dog | การตรวจสอบทุจริต</title>
		
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
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?>  sidebar-mini">
		<div class="wrapper">
			<?php
				$fn = basename($_SERVER['PHP_SELF']);
				include 'menu.php';
				// Get id data
				$case_id = $_GET['case_id'];
				?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Case
						<small>แก้ไข update ข้อมูลเคส</small>
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
									<h3 class="box-title">ข้อมูลเบื้องต้นเคส</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f1">
									<div class="box-body">
										<!-- Case ID -->
										<div class="form-group">
											<label for="c_ID" class="col-sm-2 control-label">เคส ID</label>
											<div class="col-sm-5">
												<input type="text" class="form-control" id="c_ID" placeholder="เคส ID" disabled>
											</div>
										</div>
										
										<!-- Topic -->
										<div class="form-group">
											<label for="c_name" class="col-sm-2 control-label">หัวข้อ</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_name" placeholder="หัวข้อ การทุจริต">
											</div>
										</div>
										<div class="form-group">
											<label for="c_summary" class="col-sm-2 control-label">รายละเอียด</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_summary" placeholder="รายละเอียดคร่าวๆ">
											</div>
										</div>
										
										<!-- Priority and Status -->
										<div class="form-group">
											<label for="c_priority" class="col-sm-2 control-label">ความสำคัญ</label>
											<div class="col-sm-4">
												<select class="form-control" id="c_priority">
                                                    <option value="0">รอได้</option>
                                                    <option value="1">ปกติ</option>
                                                    <option value="2">สำคัญ</option>
                                                    <option value="3">เร่งด่วน</option>
                                                </select>
											</div>
											
											<div class="col-sm-4" style="display: none;">
												<div class="checkbox">
													<label>
													 <input type="checkbox" id="urgent_check">
														เร่งด่วน
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="c_status" class="col-sm-2 control-label">สถานะ</label>
											<div class="col-sm-3">
												<input type="text" class="form-control" id="c_staus_show" value="" disabled>
											</div>
											
											<div class="col-sm-5">
												<label for="datepicker" class="col-sm-4 control-label">วันที่</label>
												<div class="input-group date">
												  <div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												  </div>
												  <input type="text" class="form-control pull-right" id="datepicker" disabled>
												</div>
											</div>
										</div>
										
										
										<div class="form-group">
											<label for="c_status" class="col-sm-2 control-label"></label>
											<div class="col-sm-3">
												<button type="button" class="btn btn-block btn-info" id="status_update_btn">Update สถานะ</button>
											</div>
											
											<div class="col-sm-3">
												<button type="button" class="btn btn-block btn-success" id="timeline_btn">Timeline</button>
											</div>
										</div>
										
										<!-- Note  -->
										<div class="form-group">
											<label for="c_note" class="col-sm-2 control-label">Note</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_note" placeholder="Note">
											</div>
										</div>
										<div class="form-group">
											<label for="c_cnt_url" class="col-sm-2 control-label">ลิ้งในศูนย์</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_cnt_url" placeholder="URL">
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-info">
								<div class="box-header with-border">
									<h3 class="box-title">ผู้ปฎิบัติงาน</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f2">
									<div class="box-body">
									
										<div class="form-group">
											<label for="stf_input" class="col-sm-2 control-label">ผู้รับเรื่อง</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="stf_input"  disabled>
											</div>
										</div>
										
										<div class="form-group">
											<label for="case_staff" class="col-sm-2 control-label"></label>
											<div class="col-sm-5 input-group">
												<select class="form-control" id="case_staff">
													
												</select>
												<span class="input-group-btn">
													<button type="button" class="btn btn-info btn-flat" id="add_staff">เพิ่ม</button>
												</span>
											</div>
											
											<Br>
											
											<div class="col-sm-12">
											 <ul class="todo-list" id="staff_list">
												
											  </ul>
											</div>
										  </div>
										
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							
							
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">ผู้ให้ข้อมูล</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f3">
									<div class="box-body">
										
										<!-- Priority and Status -->
										<div>
											<label class="col-sm-4 control-label">ผู้ให้ข้อมูล</label>		
											<div class="col-sm-8">
												<div class="form-group">
													<div class="radio col-sm-4">
														<label>
														 <input type="radio" name="sender_type" id="sender_type_opt_1" value="0" disabled>
															หมาเฝ้าบ้าน
														</label>
													</div>
													<div class="radio col-sm-4">
														<label>
														 <input type="radio" name="sender_type" id="sender_type_opt_2" value="1" disabled>
															บุคคลทั่วไป
														</label>
													</div>
												</div>
											</div>
										</div>
										
									
									
										<div class="form-group" id="member_sender">
											<label for="get_member_sender" class="col-sm-4 control-label">หมาเฝ้าบ้าน</label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="snd_wd" disabled>
											</div>
											<div class="col-sm-1">
												<span class="input-group-btn">
													<button type="button" class="btn btn-info btn-flat" id="get_member_sender" disabled>เลือก</button>
												</span>
											</div>
										</div>
										
										
										<div class="form-group" id="frm_other_sender">
											<label for="c_snd_fb" class="col-sm-4 control-label">เฟสบุคทั่วไป</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_snd_fb" placeholder="URL Facebook" disabled>
											</div>
										</div>
										

										
										<div class="col-sm-12">
												<label for="datepicker2" class="col-sm-4 control-label">วันที่ส่งข้อมูล</label>
												<div class="input-group date">
												  <div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												  </div>
												  <input type="text" class="form-control pull-right col-sm-4" id="datepicker2" disabled>
												</div>
										</div>
										
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">ผู้ร่วมปฏิบัติงาน</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f4">
									<div class="box-body">
									<div class="form-group">
										<label for="m_gen_a" class="col-sm-2 control-label">รุ่น/ชื่อ</label>
										<div class="col-sm-3">
											<select class="form-control" id="m_gen_a">
												
											</select>
										</div>
										
										<div class="col-sm-4">
											<select class="form-control" id="m_name_a">
												
											</select>
										</div>
										<div class="col-sm-2">
											<button type="button" class="btn btn-info btn-flat" data-dismiss="modal" id="btn-select-join-wd" disabled>เพิ่ม</button>
										</div>
									</div>
										<div class="col-sm-12">
											<ul class="todo-list" id="wd_join_list">
													
											</ul>
										</div>
										
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
						</div>
						
						
						<div class="col-md-6">
							<div class="box box-danger">
								<div class="box-header with-border">
									<h3 class="box-title">หน่วยงานและผู้กระทำผิด</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f5">
									<div class="box-body">
									
										<div class="form-group">
											<label for="ofd_lo_name" class="col-sm-2 control-label">หน่วยงาน</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="ofd_lo_name" placeholder="ชื่อหน่วยงาน">
											</div>
										</div>
										
										<div class="form-group">
											<label for="ofd_ump" class="col-sm-2 control-label">อำเภอ/จังหวัด</label>
											<div class="col-sm-4">
												<select class="form-control" id="ofd_add_province">
													
												</select>
											</div>
											
											<div class="col-sm-4">
												<select class="form-control" id="ofd_add_aumpher">
													
												</select>
											</div>
										</div>
										
										
										
										<div class="form-group">
											<label for="ofd_geo" class="col-sm-2 control-label">ภาค</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="ofd_geo" placeholder="ภาค" disabled>
											</div>
										</div>
										
										<div class="form-group">
											<label for="ofd_name" class="col-sm-2 control-label">ชื่อ</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="ofd_name" placeholder="ชื่อผู้กระทำผิด">
											</div>
										</div>
										
										<div class="form-group">
											<label for="ofd_position" class="col-sm-2 control-label">ตำแหน่ง</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="ofd_position" placeholder="ตำแหน่ง">
											</div>
										</div>
										
										<div class="form-group">
											<label for="crp_type" class="col-sm-2 control-label">ประเภท</label>
											<div class="col-sm-8">
												<select class="form-control" id="crp_type">
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="crp_type_oth" class="col-sm-2 control-label"></label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="crp_type_oth" placeholder="อื่นๆ" disabled>
											</div>
										</div>
										
										<div class="form-group">
											<label for="ofd_dmg" class="col-sm-2 control-label">ความเสียหาย</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="ofd_dmg" placeholder="ความเสียหาย(วงเงิน)" value="0">
											</div>
										</div>
										
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title">ช่องทางการเผยแพร่</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form class="form-horizontal" id="f6">
									<div class="box-body">
									
										<div class="form-group">
											<label for="c_release_FB" class="col-sm-2 control-label">FB</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_release_FB" placeholder="URL เพจหมาเฝ้าบ้าน">
											</div>
										</div>
										
										<div class="form-group">
											<label for="c_release_Other" class="col-sm-2 control-label">อื่นๆ</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="c_release_Other" placeholder="URL อิ่นๆ">
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							
							<div class="box box-warning">
								<div class="box-header with-border">
									<h3 class="box-title">ผลสรุปทางคดี</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								
								<!-- text input -->
								<div class="box-body">
									<form role="form" id="f7">
									<!-- text input -->
										<div class="form-group">
											<label>ความคืบหน้าขั้นต้น</label>
											<input type="text" class="form-control" id="info1" placeholder="...">
										</div>
										
										<div class="form-group">
											<label>ผลการสืบขั้นต้น</label>
											<input type="text" class="form-control" id="info2" placeholder="...">
										</div>
										
										<div class="form-group">
											<label>ผลสรุปการตรวจสอบ</label>
											<input type="text" class="form-control" id="info3" placeholder="...">
										</div>
										
										<div class="form-group">
											<label>ผลการดำเนินคดีทาง แพ่ง อาญา วินัย</label>
											<input type="text" class="form-control" id="info4" placeholder="...">
										</div>
									</form>
									
								</div>
								
							</div>
							
								
							</div>
							
						</div>
						<div class="row">
						<div class="col-md-12">
								<div class="box-header with-border text-center">
									<button type="button" class="btn bg-primary btn-lg" id="submit_data">บันทึกการแก้ไขข้อมูล</button>
									<button type="button" class="btn bg-danger btn-lg" onClick="window.location.reload()">ยกเลิกการเปลี่ยนแปลง</button>
								</div>
						</div>
					</div>
						
					</div>
					<!-- /.box -->
					
					<!-- --------------------- Modal --------------------- -->
				<div class="modal modal-default fade" id="modal-get-member">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">เลือกสมาชิกหมาเฝ้าบ้าน</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="snd_m_gen" class="col-sm-2 control-label">รุ่น/ชื่อ</label>
									<div class="col-sm-3">
										<select class="form-control" id="snd_m_gen">
											
										</select>
									</div>
									
									<div class="col-sm-6">
										<select class="form-control" id="snd_m_name">
											
										</select>
									</div>
								</div>
								<Br>
								
								
								
								
								
							</div>
							<div class="modal-footer">
								<button type="button" class="btn" data-dismiss="modal" id="btn-select-wd">เลือก</button>
							</div>
						</div>
							<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				
				
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
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">บันทึกข้อมูลสำเร็จ</h4>
							</div>
							<div class="modal-body" id="modal-summary-data">
								
							</div>
						</div>
					<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
			<div class="modal fade" id="modal-load_data">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">กำลังโหลดข้อมูล...</h4>
						</div>
						<div class="modal-body" id="modal-summary-data">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
									<img  src="img/load.gif"/>
							</div>
						</div>	
						</div>
					</div>
				<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			
			<div class="modal fade" id="modal_time_line">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
							
						</div>
						<div class="modal-body" id="modal-summary-data">
						  <!-- row -->
						  <div class="row">
							<div class="col-md-12">
							  <!-- The time line -->
							  <ul class="timeline" id="time_line_data">
											
							  </ul>
							</div>
							<!-- /.col -->
						  </div>
						  <!-- /.row -->
						</div>
					</div>
				<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			
			
			
			<div class="modal fade" id="modal-update-status">
				<div class="modal-dialog">
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
											<label for="c_n_deteil" class="col-sm-3 control-label">FB</label>
											<div class="col-sm-8">
												<textarea class="form-control" rows="3"  id="c_n_deteil" placeholder="ข้อมูลอัพเดท" style="overflow:auto;resize:none" ></textarea>
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
		<!-- Page script -->
		<script>
$(document).ready(function(){

	//Date picker
	$('#datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})
	
	
	//Date picker2
	$('#datepicker2').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})
	
//Global Var ======================================
var staff_list_arr = [];
var staff_print_list_arr = [];

var wd_join_arr = [];
var wd_join_name_arr = [];
var snd_wd_id = "";
	
	
	
	
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
		url: 'f_1_case.php',
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

// Custom_for send data Ajax Function 
	function ajax_snd_data_function($f, $d_name) {
		// Check parameter has been set or not
		$f = $f || "0";
		
		// Get All Data
		var add_data = {}
		add_data['f'] = '13';
		$( "input" ).each(function( index ) {
			add_data[$( this ).attr('id')] = $( this ).val();
		});

		// Get get Staff for this case
		staff_text = "";
		$.each(staff_list_arr, function( index, value) {
			if (index != 0)
			{
				staff_text = staff_text + "-,-";
			}
			staff_text = staff_text + value;
		});
		add_data['respons_staff'] = staff_text;
		
		//  Get get support WD Staff
		support_wd = "";
		$.each(wd_join_arr, function( index, value) {
			if (index != 0)
			{
				support_wd = support_wd + "-,-";
			}
			support_wd = support_wd + value;
		});
		add_data['support_wd'] = support_wd;
		

		// Get Priority
		add_data['c_priority'] = $("#c_priority").val();
		
		// Get Aumpher Code
		add_data['ofd_add_aumpher'] = $("#ofd_add_aumpher").val();
		
		// Get crp type Code
		add_data['crp_type_c'] = $('#crp_type').val();
		
		// Get Case Status
		add_data['c_status'] = $('#c_status').val();
		
		// Get Urgent
		add_data['check_urgent'] = $('#urgent_check').is(':checked'); 
		
		// Snd WD_ID
		add_data['snd_wd_id'] = snd_wd_id; 
		//alert($("#c_priority").val());
		
		//snd Type
		add_data['sender_type']  = $('input[name=sender_type]:checked').val();
		
		// Input_Staff
		add_data['Input_staff']  = '<?php echo $staff_key_id;?>';
	// Set Ajax
			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_1_case.php',
				data: (add_data)
			})
			.done(function(data){
					$($d_name).html(data);
					$('#modal-summary').modal('show');
			})
			.fail(function() {
				// just in case posting your form failed
				alert( "Posting failed." );
			});
			return false;	
		};


// Standard Ajax Function 
function get_staff_data() {
	// Set Ajax
	$('#modal-load_data').modal('show');
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_1_case.php',
		data: ({f : '11',
				p1 : '<?php echo $case_id; ?>'})
	})
	.done(function(data){
		var ojb = JSON.parse(data);
		
		// Basic Information
		$('#c_ID').val(ojb.case_id);
		$('#c_name').val(ojb.topic);
		$('#c_summary').val(ojb.t_sum);
		$('#c_priority').val(ojb.priority);
		if (ojb.urgent == "1")
		{
			$('#urgent_check').prop('checked', true);
		}
		
		var text_status = "";
		switch(ojb.status) {
			case '0':
				text_status = "เรื่องใหม่";
				break;
			case '1':
				text_status = "ทำข้อมูล";
				break;
			case '2':
				text_status = "รอข้อมูล";
				break;
			case '3':
				text_status = "ชะลอ";
				break;
			case '4':
				text_status = "ยุติ";
				break;
			case '5':
				text_status = "ลงเพจ";
				break;
			default:
				text_status = "";
		}
		
		$('#c_staus_show').val(text_status);
		
		
		
		$("#datepicker").datepicker("setDate", new Date(ojb.add_date));
		$('#c_note').val(ojb.note);
		$('#c_cnt_url').val(ojb.case_cnt_url);
		
		// Staff
		$('#stf_input').val(ojb.input_staff_name);
		
		
		// Information from
		if (ojb.submit_ID == "OTHER")
		{
			$("#sender_type_opt_1").prop("checked", false);
			$("#sender_type_opt_2").prop("checked", true);
			$("#member_sender").hide();
            $("#frm_other_sender").show();
			$('#c_snd_fb').val(ojb.submit_fb);
		}
		else
		{
			$("#sender_type_opt_1").prop("checked", true);
			$("#sender_type_opt_2").prop("checked", false);
			$("#member_sender").show();
            $("#frm_other_sender").hide();
			$('#snd_wd').val(ojb.n_name + "-" + ojb.submit_name + " รุ่นที่ " + ojb.gen);
		}
		$("#datepicker2").datepicker("setDate", new Date(ojb.submit_date));
		
		
		// Set Ofd Information
		$('#ofd_lo_name').val(ojb.crp_lo_name);
		$('#ofd_name').val(ojb.crp_name);
		$('#ofd_position').val(ojb.crp_n_position);
		$('#crp_type').val(ojb.crp_type);
		$('#crp_type_oth').val(ojb.crp_type_option);
		$('#ofd_dmg').val(ojb.crp_dmg);
		// Address
		$('#ofd_add_province').val(ojb.PROVINCE_ID);
		// Call Function std Ajax for get Aumpher name
		ajax_function(2, "#ofd_add_aumpher", ojb.PROVINCE_ID, ojb.AMPHUR_ID);
		// Call Function std Ajax for get GEO name
		ajax_function(4, "#ofd_geo", ojb.PROVINCE_ID);
		
		//alert(ojb.PROVINCE_ID);
		
		//alert (ojb.PROVINCE_ID);
		
		// Release 
		$('#c_release_FB').val(ojb.release_wd);
		$('#c_release_Other').val(ojb.release_other);
		
		// info update
		$('#info1').val(ojb.info1);
		$('#info2').val(ojb.info2);
		$('#info3').val(ojb.info3);
		$('#info4').val(ojb.info4);
		
		// staff_list
		staff_list_arr = [];
		if (ojb.all_support_staff.trim() != "")
		{
			staff_list_arr = ojb.all_support_staff.trim().split(","); 
		}
		
		// staff_list
		staff_print_list_arr = [];
		if (ojb.all_support_staff_print.trim() != "")
		{
			staff_print_list_arr = ojb.all_support_staff_print.trim().split(","); 
			print_staff_list();
		}
		
		
		// WS Support List
		wd_join_arr = [];
		if (ojb.all_support_wd.trim() != "")
		{
			wd_join_arr = ojb.all_support_wd.trim().split(","); 
		}
		
		wd_join_name_arr = [];
		if (ojb.all_support_wd_print.trim() != "")
		{
			wd_join_name_arr = ojb.all_support_wd_print.trim().split(","); 
			print_wd_list();
		}

		$('#modal-load_data').modal('hide');
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert( "Posting failed." );
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
	s_update_data['staff_kid'] = "<?php  echo $staff_key_id;?>";
	s_update_data['case_id'] = "<?php  echo $case_id;?>";
	
		// Set Ajax
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_1_case.php',
			data: (s_update_data)
		})
		.done(function(data){
				//alert(data);
				alert("บันทึกการเปลี่ยนแปลงสถานะสมบูรณ์");
				window.location.reload();
		})
		.fail(function() {
			// just in case posting your form failed
			alert( "Posting failed." );
		});
		return false;	
};

// ++++++++++++++++++ Operation function ++++++++++++++++++




// Add staff on click
$( "#add_staff" ).click(function() {
	//alert($("#case_staff").val());
	//traning_list.push($("#m_training").val())
	if(jQuery.inArray($("#case_staff").val(), staff_list_arr) == -1)
	{
		if ($("#case_staff").val() !== null)
		{
			staff_list_arr.push($("#case_staff").val())
			staff_print_list_arr.push($("#case_staff option:selected").text())
		}
		
	}
	print_staff_list();
});


// make staff list output
function print_staff_list()
{
	//alert(traning_list);
	var print_text = "";
	$.each(staff_print_list_arr, function( index, value) {
	  print_text += '<li><span class="text">' + value + '</span><i class="fa fa-minus-circle pull-right" id="delete_staff_list"></i></li>';
	});
	
	// Print output
	$("#staff_list").html(print_text);
}


// Add staff on click
$( "#btn-select-join-wd" ).click(function() {
	
	if(jQuery.inArray($("#m_name_a").val(), wd_join_arr) == -1)
	{
		if ($("#m_name_a").val() !== null)
		{
			wd_join_arr.push($("#m_name_a").val())
			wd_join_name_arr.push($("#m_name_a option:selected").text() + " " + $("#m_gen_a option:selected").text())
		}
		
	}
	print_wd_list();
});


// make staff list output
function print_wd_list()
{
	//alert(traning_list);
	var print_text = "";
	$.each(wd_join_name_arr, function( index, value) {
		print_text += '<li><span class="text">' + value + '</span><i class="fa fa-minus-circle pull-right" id="delete_wd_list"></i></li>';
	});
	
	// Print output
	$("#wd_join_list").html(print_text);
}








// Clear Traing Data
$( "#get_member_sender" ).click(function() {
		$("#btn-select-wd").prop('disabled', true);
		$('#modal-get-member').modal('show');
});


// Get Aumpher when select Province==================
$( "#ofd_add_province" ).change(function() {
	// Call Function std Ajax for get Aumpher name
	ajax_function(2, "#ofd_add_aumpher", $(this).val());
	// Call Function std Ajax for get GEO name
	ajax_function(4, "#ofd_geo", $(this).val());
});

$( "#crp_type" ).change(function() {
	if ($(this).val() == 7)
	{
		$("#crp_type_oth").prop('disabled', false);
	}
	else
	{
		$("#crp_type_oth").val("");
		$("#crp_type_oth").prop('disabled', true);
	}
});


// When radio change
$('input[type=radio][name=sender_type]').change(function() {
        if (this.value == 0) {
            $("#member_sender").show();
            $("#frm_other_sender").hide();
        }
        else if (this.value == 1) {
			$("#member_sender").hide();
            $("#frm_other_sender").show();
        }
});


// Get name in Gen
$( "#snd_m_gen" ).change(function() {
	// Call Function std Ajax for get Aumpher name
	ajax_function(8, "#snd_m_name", $(this).val());
	$("#btn-select-wd").prop('disabled', true);
});

// Get name in Gen
$( "#snd_m_name" ).change(function() {
	$("#btn-select-wd").prop('disabled', false);
});


// Get name in Gen
$( "#m_gen_a" ).change(function() {
	// Call Function std Ajax for get Aumpher name
	ajax_function(8, "#m_name_a", $(this).val());
	$("#btn-select-join-wd").prop('disabled', true);
});

// Get name in Gen
$( "#m_name_a" ).change(function() {
	$("#btn-select-join-wd").prop('disabled', false);
});


// Click Select wd
$( "#btn-select-wd" ).click(function() {
		$("#snd_wd").val($("#snd_m_name option:selected").text() + " " + $("#snd_m_gen option:selected").text());
		snd_wd_id = $("#snd_m_name").val();
});



$('body').on('click','#delete_wd_list',function(){
    var target = ($(this).prev().text());
	$.each(wd_join_name_arr, function( index, value) {
		if (value == target)
		{
			wd_join_name_arr.splice(index, 1);
			wd_join_arr.splice(index, 1);
		}
	});
	print_wd_list();
});

$('body').on('click','#delete_staff_list',function(){
    var target = ($(this).prev().text());
	$.each(staff_print_list_arr, function( index, value) {
		if (value == target)
		{
			staff_print_list_arr.splice(index, 1);
			staff_list_arr.splice(index, 1);
		}
	});
	print_staff_list();
});

// Chk Ofd_dmg
$( "#ofd_dmg" ).keyup(function() {
		chk_str = $("#ofd_dmg").val($.trim($("#ofd_dmg").val().replace(",", "")));
		if(!$.isNumeric($("#ofd_dmg").val()))
		{
			$("#ofd_dmg").val("");
		}
		
});


// Click Status Update status_update_btn
// Click Select wd timeline_btn
$( "#status_update_btn" ).click(function() {
		$('#f8').trigger("reset");
		$('#modal-update-status').modal('show');
});


$( "#timeline_btn" ).click(function() {
		ajax_function(14, "#time_line_data", "<?php  echo $case_id;?>");
		$('#modal_time_line').modal('show');
});


// Save Status btn_save_status
$( "#btn_save_status" ).click(function() {
		ajax_update_status_function();
});


//============== Submit Click ============================
			$( "#submit_data" ).click(function() {
				   // Check data
				   var target_check_list = ['c_name', 'c_summary',  'ofd_lo_name',  'datepicker', 'datepicker2'];
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
				   
				   
				   // Check Aumpher
				   $("#ofd_add_aumpher").css({'background-color' : '#ffffff'});
				   if ($("#ofd_add_aumpher").val() == null)
				   {
					   check_rest = 1;
					   $("#ofd_add_aumpher").css({'background-color' : '#ffb3b3'});
				   }
				    
				   
				   // Check Crp_type
				   $("#crp_type").css({'background-color' : '#ffffff'});
				   if ($("#crp_type").val() == null)
				   {
					   check_rest = 1;
					   $("#crp_type").css({'background-color' : '#ffb3b3'});
				   }
				   
				   if ($("#crp_type").val() == 7)
				   {
					   $("#crp_type_oth").css({'background-color' : '#ffffff'});
					   if ($("#crp_type_oth").val() == "")
					   {
						   check_rest = 1;
						   $("#crp_type_oth").css({'background-color' : '#ffb3b3'});
					   }
				   }
				   
				  if ($('input[name=sender_type]:checked').val() == 0)
				  {
					   $("#snd_wd").css({'background-color' : '#eeeeee'});
					   if ($("#snd_wd").val() == "")
					   {
						   check_rest = 1;
						   $("#snd_wd").css({'background-color' : '#ffb3b3'});
					   }
				  }
				   
				   if (check_rest == 0)
				   //if (1)
				   {
					   ajax_snd_data_function(8, "#modal-summary-data");
				   }
				   else
				   {
					   $('#modal-danger').modal('show');
				   }
				   
					//ajax_snd_data_function(8, "add_skill_list");

			});


$('#modal-summary').on('hidden.bs.modal', function () {
  window.location.reload()
})

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


// ----- Initial when start ----------
$('#modal-load_data').modal('show');
$('#f1').trigger("reset");
$('#f2').trigger("reset");
$('#f3').trigger("reset");
$('#f4').trigger("reset");
$('#f5').trigger("reset");
$('#f6').trigger("reset");
$('#f7').trigger("reset");
$('#f8').trigger("reset");

$("#frm_other_sender").hide();
ajax_function(1, "#ofd_add_province");
ajax_function(5, "#crp_type");
ajax_function(6, "#case_staff");
ajax_function(7, "#snd_m_gen");
ajax_function(7, "#m_gen_a");

// Set Date to today
$("#datepicker").datepicker("setDate", new Date());
$("#datepicker2").datepicker("setDate", new Date());

get_staff_data();
//$("#datepicker").val( moment().format('DD/MM/YYYY') );
//$("#datepicker2").val( moment().format('DD/MM/YYYY') );




	
});	  // End --------------------------
$(function(){
	//Datemask dd/mm/yyyy
	$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	//Money Euro
	$('[data-mask]').inputmask()


});
			
			
		</script>
	</body>
</html>

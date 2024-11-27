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
		<title>Watch_Dog | Training Management</title>
		
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
		 <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="plugins/iCheck/all.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		
		
		 <!-- J-ui css-->
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		
		<!-- Bootstrap Tagsinput Css -->
		<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
		<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet">
		
		
		
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
		
		<!-- Sweet Alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
		
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
						Training Management
						<small>จัดการการอบรม</small>
					</h1>
					
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
											<!-- Custom Tabs -->
											<div class="nav-tabs-custom">
												<ul class="nav nav-tabs">
													<li><a href="#tab_1" data-toggle="tab">เพิ่มการอบรม/กิจกรรม</a></li>
													<li  class="active"><a href="#tab_2" data-toggle="tab">จัดการการอบรม/กิจกรรม</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane" id="tab_1">
														<!-- form start -->
														<form class="form-horizontal" id="frm_new_tr" >
															<div class="box-body">
																<div class="form-group">
																	<label for="ns_id" class="col-sm-2 control-label"></label>
																	<div class="col-sm-3">
																		<input type="checkbox" id="chk_main_training" class="flat-red">  อบรมเชิงปฎิบัติการ
																	</div>
																</div>
																<div class="form-group">
																	<label for="tr_name" class="col-sm-2 control-label">ชื่อกิจกรรม/อบรม</label>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="tr_name" autocomplete="off" disabled>
																	</div>
																</div>
																<div class="form-group">
																	<label for="tr_type" class="col-sm-2 control-label">ประเภท</label>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="tr_type" autocomplete="off" disabled>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="tr_type" class="col-sm-2 control-label">ลักษณะการอบรม</label>
																	<div class="col-sm-4">
																		<Select  class="form-control" id="tr_spc" disabled>
																			<option value="Training">Training</option>
																			<option value="Event">Event</option>
																			<option value="Workshop">Workshop</option>
																		</Select>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="tr_location" class="col-sm-2 control-label">สถานที่</label>
																	<div class="col-sm-4">
																		<input type="text" class="form-control" id="tr_location" autocomplete="off">
																	</div>
																</div>
																<div class="form-group">
																	<label for="tr_start_date" class="col-sm-2 control-label">ระหว่างวันที่</label>
																	<div class="col-sm-2">
																		<div class="input-group date">
																			<div class="input-group-addon">
																				<i class="fa fa-calendar"></i>
																			</div>
																			<input type="text" class="form-control pull-right" id="tr_start_date" autocomplete="off" readonly>
																		</div>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="tr_end_date" class="col-sm-2 control-label">ถึงวันที่</label>
																	<div class="col-sm-2">
																		<div class="input-group date">
																			<div class="input-group-addon">
																				<i class="fa fa-calendar"></i>
																			</div>
																			<input type="text" class="form-control pull-right" id="tr_end_date" autocomplete="off" readonly>
																		</div>
																	</div>
																</div>
															</div>
															<!-- /.box-body -->
															<div class="box-footer">
																<button type="button" class="btn btn-default" id="tr_btn_reset">Reset</button>
																<button type="button" class="btn btn-info pull-right" id="tr_btn_add">เพิ่ม</button>
															</div>
															<!-- /.box-footer -->
														</form>
													</div>
													<!-- /.tab-pane -->
													<div class="tab-pane active" id="tab_2">
														<div class="row">
															<label for="ed_tr_list" class="col-sm-2 control-label"></label>
															<div class="col-sm-4">
																<select id="ed_tr_list">
																</select>
															</div>
														</div>
														<HR>
														<div class="row">
															<div class="col-sm-4" id="tab_edit_tr_info">
																<div class = "box box-success" id="frm_ed_tr" style="display: none;">
																	<div class="box-body">
																		<!-- form start -->
																		<form class="form-horizontal"  >
																		
																			<div class="form-group">
																				<label for="tr_name_ed" class="col-sm-4 control-label">ชื่อกิจกรรม/อบรม</label>
																				<div class="col-sm-8">
																					<input type="text" class="form-control" id="tr_name_ed" autocomplete="off" disabled>
																				</div>
																			</div>
																			<div class="form-group">
																				<label for="tr_type_ed" class="col-sm-4 control-label">ประเภท</label>
																				<div class="col-sm-8">
																					<input type="text" class="form-control" id="tr_type_ed" autocomplete="off" disabled>
																				</div>
																			</div>
																			<div class="form-group">
																				<label for="tr_type" class="col-sm-4 control-label">ลักษณะการอบรม</label>
																				<div class="col-sm-8">
																					<Select  class="form-control" id="tr_spc_ed" disabled>
																						<option value="Training">Training</option>
																						<option value="Event">Event</option>
																						<option value="Workshop">Workshop</option>
																					</Select>
																				</div>
																			</div>
																			<div class="form-group">
																				<label for="tr_location_ed" class="col-sm-4 control-label">สถานที่</label>
																				<div class="col-sm-8">
																					<input type="text" class="form-control" id="tr_location_ed" autocomplete="off">
																				</div>
																			</div>
																			<div class="form-group">
																				<label for="tr_start_date_ed" class="col-sm-4 control-label">ระหว่างวันที่</label>
																				<div class="col-sm-4">
																					<div class="input-group date">
																						<div class="input-group-addon">
																							<i class="fa fa-calendar"></i>
																						</div>
																						<input type="text" class="form-control pull-right" id="tr_start_date_ed" autocomplete="off" readonly>
																					</div>
																				</div>
																			</div>
																			
																			<div class="form-group">
																				<label for="tr_end_date_ed" class="col-sm-4 control-label">ถึงวันที่</label>
																				<div class="col-sm-4">
																					<div class="input-group date">
																						<div class="input-group-addon">
																							<i class="fa fa-calendar"></i>
																						</div>
																						<input type="text" class="form-control pull-right" id="tr_end_date_ed" autocomplete="off" readonly>
																					</div>
																				</div>
																			</div>
																			</form>
																	</div>
																	<!-- /.box-body -->
																	<div class="box-footer">
																		<button type="button" class="btn btn-default" id="tr_btn_ed_reset">Reset</button>
																		<button type="button" class="btn btn-info pull-right" id="tr_btn_ed">บันทึกการเปลี่ยนแปลง</button>
																	</div>
																	<!-- /.box-footer -->
																	
																</div>
															</div>
															<div class="col-sm-8" id="tab_add_tr_wd" style="display: none;" >
																<div class="box box-danger">
																	<div class="box-header">
																	  <h3 class="box-title">เพิ่มผู้เข้าอบรม</h3>
																	  <div class="box-tools pull-right">
																		<button type="button" class="btn btn-box-tool" id="btn_add_tr_wd_close"> <i class="fa fa-times"></i> </button>
																	</div>
																	</div>
																	<div class="box-body">
																		<form class="form-horizontal" id="tab_add_tr_wd" >
																			<div class="form-group">
																				<label for="tr_name_ed" class="col-sm-2 control-label">ผู้เข้าอบรม</label>
																				<div class="col-sm-8">
																					<div class="input-group">
																						<input type="text" class="form-control pull-right" id="txt_add_tr_wd"/>
																						<span class="input-group-btn" >
																							<button type="button" class="btn btn-info btn-flat" id="btn_add_tr_wd">เพิ่ม</button>
																						</span>
																					</div>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															
															
															
															
															</div>
															<div class="col-sm-8">
																<div class="col-xs-12">
																	<div class="box box-primary" id="tbl_box_event" style="display: none;">
																	<div class="box-header">
																	  <h3 class="box-title">Event</h3>
																	  <div class="box-tools pull-right">
																			<button type="button" class="btn btn-box-tool" id="add_event"> <i class="fa fa-plus-circle"></i> เพิ่ม</button>
																	  </div>
																	</div>
																	
																	<!-- /.box-header -->
																	<div class="box-body">
																		<div id="new_event_div" style="display: none;">
																		 <!-- Date and time range -->
																		  
																		  <form class="form-horizontal"  >
																				<div class="form-group">
																					<label for="event_name" class="col-sm-3 control-label">กิจกรรม</label>
																					<div class="col-sm-8">
																						<input type="text" class="form-control" id="event_name" autocomplete="off">
																					</div>
																				</div>
																				<div class="form-group">
																					<label for="event_type" class="col-sm-3 control-label">ประเภท</label>
																					<div class="col-sm-8">
																						<Select id="event_type">
																							<option value="1">ลงทะเบียน</option>
																							<option value="2">โหวต</option>
																							<option value="3">แบบประเมิน</option>
																						</Select>
																					</div>
																				</div>
																				<div class="form-group">
																					<label for="event_time" class="col-sm-3 control-label">ห้วงเวลากิจกรรม :</label>
																					<div class="col-sm-8">
																						<div class="input-group">
																						  <div class="input-group-addon">
																								<i class="fa fa-clock-o"></i>
																						  </div>
																						  <input type="text" class="form-control pull-right" id="event_time">
																						</div>
																					</div>
																				</div>
																				
																				<div class="form-group">
																					<label for="event_time" class="col-sm-3 control-label"></label>
																					<div class="col-sm-8">
																						<button type="button" class="btn btn-primary pull-right" id="btn_add_new_event">เพิ่ม Event</button>
																					</div>
																				</div>
																				
																				
																				
																			</form>
																		  
																		  
																		  <!-- /.form group -->
																																	
																		</div>
																	  <div id="event_list">
																		<Table  class="table table-striped">
																			<tr  bg-light-blue>
																				<th style="width: 30px">#</th>
																				<th>Event</th>
																				<th>ประเภท</th>
																				<th>เริ่ม</th>
																				<th>สิ้นสุด</th>
																				<th></th>
																				<th></th>
																			</tr>
																			<tbody id="event_list_table">
																			</tbody>
																		</table>
																	  </div>
																	</div>
																	<!-- /.box-body -->
																  </div>
															  </div>
															
															
																<div class="col-xs-12">
																	<div class="box box-info" id="tbl_box_data" style="display: none;">

																	<div class="box-header">
																	  <h3 class="box-title">รายชื่อผู้เข้าอบรม</h3>
																	  <div class="box-tools pull-right">
																			<button type="button" class="btn btn-box-tool" id="add_tr_wd"> <i class="fa fa-plus-circle"></i> เพิ่ม</button>
																			<button type="button" class="btn btn-box-tool" id="edit_tr_wd"> <i class="fa fa-edit"></i> แก้ไข</button>
																			<button type="button" class="btn btn-box-tool" id="data_refresh"> <i class="fa fa-refresh"></i></button>
																			<button type="button" class="btn btn-box-tool" id="download_excel"> <i class="fa fa-file-excel-o"></i></button>
																			<button type="button" class="btn btn-box-tool" id="download_pdf"> <i class="fa fa-file-pdf-o"></i> ทะเบียน</button>
																			<button type="button" class="btn btn-box-tool" id="download_pdf_card"> <i class="fa fa-file-pdf-o"></i> Card</button>
																	  </div>
																	</div>
																	
																	<!-- /.box-header -->
																	<div class="box-body">
																	  <div id="member_list_data">
																		
																	  </div>
																	</div>
																	<!-- /.box-body -->
																  </div>
															  </div>
															  
															  
															  
															  
															  
															</div>
														</div>
													</div>
													<!-- /.tab-pane -->
												</div>
												<!-- /.tab-content -->
											</div>
											<!-- nav-tabs-custom -->
										</div>
										<!-- /.col -->
						
					</div>

			<div class="modal fade" id="modal_vote_option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
							<h3 class="modal-title" id="vote_event_name"></h3>
						</div>
						<div class="modal-body">
							
							  <div class="box box-solid">
								<div class="box-body">
								<div class="input-group margin">
								<input type="text" id="new_option_data" class="form-control">
									<span class="input-group-btn">
									  <button type="button" id="add_option_for_vote" class="btn btn-info btn-flat">เพิ่ม</button>
									</span>
							  </div>
									<div id="vote_list_data">
									</div>
								</div>
							  </div>
							  
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
		<!-- ChartJS -->
		<script src="dist/chartjs/utils.js"></script>
		<!-- iCheck 1.0.1 -->
		<script src="plugins/iCheck/icheck.min.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
			
		
		<!-- date-range-picker -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>
	<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		<!-- Notify -->
		<script src="plugins/notify/notify.js"></script>
		
		<!-- J-ui tab -->
	<script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
	
	<!-- bootstrap datepicker -->
	<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	
	 <!-- Bootstrap Tags Input Plugin Js -->
	<script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<!-- Typehead -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
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
								ul.append("<li class='ui-autocomplete-category'><b>" + item.category + "</b></li>");
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
		$(function() {
			
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red'
            })

        });
		</script>

		<script>
$(document).ready(function(){
// Initial Setting 

// Set Moment 
moment.locale('th');

//Date picker
			
			//Date picker
            $('#tr_start_date').datepicker({
                autoclose: true,
				language: 'th',
                format: 'dd/mm/yyyy'
            })
			
			$('#tr_end_date').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			
			$('#tr_start_date_ed').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			$('#tr_end_date_ed').datepicker({
				autoclose: true,
				language: 'th',
				format: 'dd/mm/yyyy'
			})
			
			//Date range picker with time picker
			$('#event_time').daterangepicker(
				{
					timePicker: true,
					timePicker24Hour : true,
					timePickerIncrement: 30,
					//format: 'MM/DD/YYYY h:mm A' 
					locale: {
							format: 'DD MMM HH:mm',
							applyLabel: "ยืนยันตั้งค่า",
							cancelLabel: "ยกเลิก"
					}
				}
			)
			
	
	
// Initial var =============================================
var new_gen = 0;
var current_target_add_event = '';
// Table _data
var tbl_wd_id = [];
var tbl_gen = [];
var tbl_name = [];
var tbl_s_name = [];
var tbl_n_name = [];
var tbl_sex = [];
var tbl_tel = [];
var tbl_prov = [];




// Initial function =============================================
// Set date 
$("#tr_start_date").datepicker("setDate", new Date());
$("#tr_end_date").datepicker("setDate", new Date());
// Set check
$('#chk_main_training').iCheck('check'); 
	
	
// ++++++++++  Standard Ajax Function ++++++++++
function ajax_function($f, d_name, $p1, $p2, $p3) {
	// Check parameter has been set or not
	$f = $f || "0";
	$p1= $p1 || "0";
	$p2= $p2 || "0";
	$p3= $p3 || "0";
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: ({f : $f,
				p1 : $p1,
				p2 : $p2,
				p3 : $p3})
	})
	
	.done(function(data){
		$(d_name).html(data);
		//document.getElementById(d_name).innerHTML = data;
	})
	.fail(function() {
		// just in case posting your form failed
		alert( "Posting failed." );
	});
	return false;	
};			
			
// Get maximum training 
function get_max_main_training()
	{
		var add_data = {}
		add_data['f'] = '14';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			//alert(data);
			var ojb = JSON.parse(data);
			new_gen = ojb.new_gen;
			$("#tr_name").val(ojb.new_gen_text);
			$("#tr_type").val("อบรมเชิงปฎิบัติการ");
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
	
//  If cannot estimate damage check
$('#chk_main_training').on('ifChecked', function(event) {
	$("#tr_name").prop('disabled', true);
	$("#tr_type").prop('disabled', true);
	$("#tr_spc").prop('disabled', true);
	$("#tr_spc").val("Training").change();
	
	get_max_main_training();
});

// If cannot estimate damage uncheck
$('#chk_main_training').on('ifUnchecked', function(event) {
	$("#tr_name").val("");
	$("#tr_type").val("");
	new_gen = 0;
	$("#tr_name").prop('disabled', false);
	$("#tr_type").prop('disabled', false);
	$("#tr_spc").prop('disabled', false);
});
			
// tr_btn_add Click ===============================
$("#tr_btn_add").click(function() {
	//alert ($("#tr_spc").val().trim());
	// Check Process
	var check_rest = 0;
	//alert (new_gen);
	if ($("#tr_name").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล ชื่อการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล ชื่อการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if ($("#tr_type").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล ประเภทการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล ประเภทการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if ($("#tr_location").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล สถานที่อบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล สถานที่อบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if ($("#tr_start_date").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล วันที่ในการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล วันที่ในการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}

	if ($("#tr_end_date").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล วันที่ในการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล วันที่ในการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if (check_rest == 0)
	{
		var dt = $("#tr_start_date").val().split('/');
		var start_date = dt[2] + '-' + dt[1] + '-' + dt[0];
		//alert (start_date);
		dt = $("#tr_end_date").val().split('/');
		var end_date = dt[2] + '-' + dt[1] + '-' + dt[0];
		//alert (end_date);
		var add_data = {}
		add_data['f'] = '15';
		add_data['new_gen'] = new_gen;
		
		add_data['tr_name'] = $("#tr_name").val().trim();
		add_data['tr_type'] = $("#tr_type").val().trim();
		add_data['tr_location'] = $("#tr_location").val().trim();
		add_data['tr_spc'] = $("#tr_spc").val().trim();
		add_data['start_date'] = start_date;
		add_data['end_date'] = end_date;
		
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			// Set date 
			$("#tr_start_date").datepicker("setDate", new Date());
			$("#tr_end_date").datepicker("setDate", new Date());
			// Set check
			$('#chk_main_training').iCheck('check'); 
			$("#tr_name").prop('disabled', true);
			$("#tr_type").prop('disabled', true);
			$("#tr_location").val("");
			get_max_main_training();
			ajax_function(16, "#ed_tr_list");
			//$.notify("บันทึกข้อมูลสำเร็จ", "success");
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'บันทึกข้อมูลสำเร็จ',
			  showConfirmButton: false,
			  timer: 1500
			});
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
	
});

//Reset click
$("#tr_btn_reset").click(function() {
	// Set date 
	$("#tr_start_date").datepicker("setDate", new Date());
	$("#tr_end_date").datepicker("setDate", new Date());
	// Set check
	$('#chk_main_training').iCheck('check'); 
	$("#tr_name").prop('disabled', true);
	$("#tr_type").prop('disabled', true);
	$("#tr_location").val("");
	get_max_main_training();
});

// Load Data when Select changed ==========
$("#ed_tr_list").change(function() {
		//alert ($(this).val());
		var add_data = {}
		add_data['f'] = '17';
		add_data['tr_target'] = $(this).val();

		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			$("#tr_name_ed").val(ojb.Training_subject);
			$("#tr_type_ed").val(ojb.Training_type);
			$("#tr_spc_ed").val(ojb.training_spc);
			
			if (ojb.Training_type == "อบรมเชิงปฎิบัติการ")
			{
				$("#tr_type_ed").prop('disabled', true);
				$("#tr_spc_ed").prop('disabled', true);
			}
			else
			{
				$("#tr_type_ed").prop('disabled', false);
				$("#tr_spc_ed").prop('disabled', false);
			}
			$("#tr_location_ed").val(ojb.location);
			$("#tr_start_date_ed").datepicker("setDate", ojb.Training_Start);
			$("#tr_end_date_ed").datepicker("setDate", ojb.Training_End);
			$('#frm_ed_tr').show();
			$('#tbl_box_data').show();
			$('#tab_edit_tr_info').show();
			$('#tbl_box_event').show();
			$('#tab_add_tr_wd').hide();
			get_tr_list_table();
			get_event_list_table();
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
		
});

			
			
			
// tr_btn_add Click ===============================
$("#tr_btn_ed").click(function() {
	// Check Process
	var check_rest = 0;
	//alert (new_gen);
	if ($("#tr_location_ed").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล สถานที่อบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล สถานที่อบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if ($("#tr_type_ed").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล สถานที่อบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล ประเภทการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if ($("#tr_start_date_ed").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล วันที่ในการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล วันที่ในการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}

	if ($("#tr_end_date_ed").val().trim() == "") {
		check_rest = 1;
		//$.notify("กรุณากรอกข้อมูล วันที่ในการอบรม", "error");
		swal({
			  position: 'top-end',
			  type: 'warning',
			  title: 'กรุณากรอกข้อมูล วันที่ในการอบรม',
			  showConfirmButton: false,
			  timer: 1500
			});
	}
	
	if (check_rest == 0)
	{
		var dt = $("#tr_start_date_ed").val().split('/');
		var start_date = dt[2] + '-' + dt[1] + '-' + dt[0];
		
		dt = $("#tr_end_date_ed").val().split('/');
		var end_date = dt[2] + '-' + dt[1] + '-' + dt[0];
		
		var add_data = {}
		add_data['f'] = '18';
		
		add_data['tr_target'] = $("#ed_tr_list").val();
		add_data['tr_type'] = $("#tr_type_ed").val();
		add_data['tr_location'] = $("#tr_location_ed").val().trim();
		add_data['tr_spc_ed'] = $("#tr_spc_ed").val().trim();
		add_data['start_date'] = start_date;
		add_data['end_date'] = end_date;

		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			swal({
			  position: 'top-end',
			  type: 'success',
			  title: 'บันทึกข้อมูลสำเร็จ',
			  showConfirmButton: false,
			  timer: 1500
			});
			
			//ajax_function(16, "#ed_tr_list");
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
	
});			
			
function get_tr_list_table()
{
	//var target_tr = $("#ed_tr_list").val();
	//alert (target_tr);
	$("#member_list_data").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
	var add_data = {}
	add_data['f'] = '19';
	add_data['tr_target'] =  $("#ed_tr_list").val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data);
		//$.notify("บันทึกข้อมูลสำเร็จ", "success");
		var ojb = JSON.parse(data);
		
		tbl_wd_id = ojb.wd_id.split('-,-');
		tbl_gen = ojb.gen.split('-,-');
		tbl_name = ojb.name.split('-,-');
		tbl_s_name = ojb.s_name.split('-,-');
		tbl_n_name = ojb.n_name.split('-,-');
		tbl_sex = ojb.sex.split('-,-');
		tbl_tel = ojb.tel.split('-,-');
		tbl_prov = ojb.prov.split('-,-');

		print_tr_list_table();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


function get_tr_list_table_for_edit()
{
	//var target_tr = $("#ed_tr_list").val();
	//alert (target_tr);
	$("#member_list_data").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
	var add_data = {}
	add_data['f'] = '19';
	add_data['tr_target'] =  $("#ed_tr_list").val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data);
		//$.notify("บันทึกข้อมูลสำเร็จ", "success");
		var ojb = JSON.parse(data);
		
		tbl_wd_id = ojb.wd_id.split('-,-');
		tbl_gen = ojb.gen.split('-,-');
		tbl_name = ojb.name.split('-,-');
		tbl_s_name = ojb.s_name.split('-,-');
		tbl_n_name = ojb.n_name.split('-,-');
		tbl_sex = ojb.sex.split('-,-');
		tbl_tel = ojb.tel.split('-,-');
		tbl_prov = ojb.prov.split('-,-');

		print_tr_list_table_edit_version();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function print_tr_list_table()
{
	var print_text = '<Table  class="table table-striped"><tr  bg-light-blue> <th style="width: 30px">#</th> <th>ขื่อ-สกุล</th>  <th>ชื่อเล่น</th> <th>เพศ</th> <th>รุ่น</th> <th>จังหวัด</th> <th>โทร</th> </tr>';
	if (tbl_wd_id[0] != "")
	{
		$.each(tbl_wd_id, function(index, value) {
				if (tbl_sex[index] == "0")
				{
					print_sex = '<span class="badge bg-green">ชาย</span>';
				}
				else
				{
					print_sex = '<span class="badge bg-light-blue">หญิง</span>';
				}
				print_text += '<tr>';
				print_text += '<td>'+(index + 1)+'.</td>';
				print_text += '<td><a href="24_member_data.php?wd_id='+value+'" target="_blank">'+tbl_name[index]+' '+tbl_s_name[index]+'</a></td>';
				print_text += '<td>'+tbl_n_name[index]+'</td>';
				print_text += '<td>'+print_sex +'</td>';
				print_text += '<td>'+tbl_gen[index]+'</td>';
				print_text += '<td>'+tbl_prov[index]+'</td>';
				print_text += '<td>'+tbl_tel[index]+'</td>';
				print_text += '</tr>';
				
		});
	}
	print_text += '</Table>';
	// Print output
	$("#member_list_data").html(print_text);

}

// Print_edition version
function print_tr_list_table_edit_version()
{
	var print_text = '<Table  class="table table-striped"><tr  bg-light-blue> <th style="width: 30px">#</th> <th>ขื่อ-สกุล</th>  <th>ชื่อเล่น</th><th>เพศ</th> <th>รุ่น</th> <th></th> </tr>';
	if (tbl_wd_id[0] != "")
	{
		$.each(tbl_wd_id, function(index, value) {
				if (tbl_sex[index] == "0")
				{
					print_sex = '<span class="badge bg-green">ชาย</span>';
				}
				else
				{
					print_sex = '<span class="badge bg-light-blue">หญิง</span>';
				}
				print_text += '<tr>';
				print_text += '<td>'+(index + 1)+'.</td>';
				print_text += '<td><a href="22_member-edit.php?id='+tbl_wd_id[index]+'" target="_blank">'+tbl_name[index]+' '+tbl_s_name[index]+'</a></td>';
				print_text += '<td>'+tbl_n_name[index]+'</td>';
				print_text += '<td>'+print_sex +'</td>';
				print_text += '<td>'+tbl_gen[index]+'</td>';
				print_text += '<td  class="btn" id="btn_delete_tr_wd" value="'+tbl_wd_id[index]+'"><font color="#D81B60"><i class="fa fa-minus-circle"></i></font></td>';
				print_text += '</tr>';
				
		});
	}
	print_text += '</Table>';
	// Print output
	$("#member_list_data").html(print_text);

}

			
// Download Excel click
$("#download_excel").click(function() {
	$("#member_list_data").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
	var add_data = {}
	add_data['f'] = '20';
	add_data['tr_target'] =  $("#ed_tr_list").val();
	add_data['tr_name'] =  $("#tr_name_ed").val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#member_list_data").html(data);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});

// refresh click
$("#data_refresh").click(function() {
	get_tr_list_table();
});

// Download Excel click
$("#download_pdf").click(function() {
	target = $("#ed_tr_list").val();
	window.open('pdf/reg_doc.php?trid='+target, '_blank');
});
$("#download_pdf_card").click(function() {
	target = $("#ed_tr_list").val();
	window.open('pdf/member_card.php?tr_id='+target, '_blank');
});

// add_tr_wd click
$("#add_tr_wd").click(function() {
	$('#tab_edit_tr_info').hide();
	$('#tab_add_tr_wd').show();
});

// btn_add_tr_wd click
$("#btn_add_tr_wd").click(function() {
	var add_text = $("#txt_add_tr_wd").val();
	if (add_text.trim() != "")
	{
		_id = add_text.substring(0, 8);
		if ($.isNumeric(_id)) {
			var add_data = {}
			add_data['f'] = '21';
			
			add_data['tr_target'] = $("#ed_tr_list").val();
			add_data['tr_wd_id'] = _id;

			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_3_staff.php',
				data: (add_data)
			})
			.done(function(data) {
				switch(data) {
					case "0":
							swal({
								  position: 'top-end',
								  type: 'success',
								  title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								  showConfirmButton: false,
								  timer: 1500
								})
							break;
					case "1":
							//$.notify("มีสมาชิกนี้ในการอบรมอยู่แล้ว", "error");
							swal({
								  position: 'top-end',
								  type: 'warning',
								  title: 'มีสมาชิกนี้ในการอบรมอยู่แล้ว',
								  showConfirmButton: false,
								  timer: 1500
								})
							break;
					default:
							swal({
								  position: 'top-end',
								  type: 'error',
								  title: 'error',
								  showConfirmButton: false,
								  timer: 1500
								})
				}
				get_tr_list_table();
				
				
			})
			.fail(function() {
				// just in case posting your form failed
				alert("Posting failed.");
			});
		}
		else
		{
			//$.notify("ไม่พบสมาชิก ID นี้", "error");
			swal({
					  position: 'top-end',
					  type: 'error',
					  title: 'ไม่พบสมาชิก ID นี้',
					  showConfirmButton: false,
					  timer: 1500
					})
		}
	}
});

// btn_add_tr_wd_close Click
// add_tr_wd click
$("#btn_add_tr_wd_close").click(function() {
	$('#tab_edit_tr_info').show();
	$('#tab_add_tr_wd').hide();
});


// edit_tr_wd Click
$("#edit_tr_wd").click(function() {
	print_tr_list_table_edit_version();
});


// btn_delete_tr_wd Click
$('body').on('click', '#btn_delete_tr_wd', function() {
	var target = ($(this).attr('value'));
	var tr_id_target = $("#ed_tr_list").val();
	
	var add_data = {}
	add_data['f'] = '22';
	add_data['target'] =  target;
	add_data['tr_id_target'] =  tr_id_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		get_tr_list_table_for_edit();
		swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
				  showConfirmButton: false,
				  timer: 1500
				})
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
	
	
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









// ============================ TAG memeber ===============
// Source for add team
var availableTags = [

	 <?php
				// Connect to MySQL Database
				include "connectionDb.php";
				$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a WHERE a.status in (1, 2) Order By a.wd_id"; 
				$res = $conn->query(trim($sql));
				mysqli_close($conn);
				$cl_check = "";
				while ($row = $res->fetch_assoc()){
				echo $cl_check.'{label:"'.$row['name'].' '.$row['s_name'].'('.$row['n_name'].') : '.$row['soc_fb'].' '.$row['soc_fb_2'].'", value : "'.$row['wd_id'].' - '.$row['name'].' ('.$row['n_name'].') รุ่น '.$row['gen'].'", category: "รุ่น  '.$row['gen'].'"} '. PHP_EOL;
					$cl_check = ",";
				}
				?>
];
$("#txt_add_tr_wd").catcomplete({
	source: availableTags
});





//btn_add_new_event
$('body').on('click', '#btn_add_new_event', function() {
	var add_data = {}
	add_data['f'] = '43';
	add_data['tr_id_target'] =  $("#ed_tr_list").val();
	add_data['event_name'] =   $("#event_name").val();
	add_data['event_type'] =   $("#event_type").val();
	add_data['event_start'] =   $('#event_time').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm');
	add_data['event_end'] =   $('#event_time').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm');
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		console.log(data);
		$("#new_event_div").hide("fast");
		get_event_list_table();
		swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
				  showConfirmButton: false,
				  timer: 1500
				})
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});


function get_event_list_table()
{
	var add_data = {}
	add_data['f'] = '44';
	add_data['tr_id_target'] =  $("#ed_tr_list").val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data);
		if (data == "[]")
		{
			$("#event_list_table").html("<TR><TD colspan='7'>**ยังไม่มีกิจกรรม**</TD></TR>");
		}
		else
		{
			var data_arr = JSON.parse(data);
			print_text = "";
			jQuery.each( data_arr, function( i, val ) {
				print_text +="<TR>";
				print_text +="<TD>"+(i + 1)+"</TD>";
				if (val.event_type == 1)
				{
					print_text +="<TD><a href='321_track_register_status.php?event_id="+val.event_id+"' target='_blank'>"+val.event_name+"</a></TD>";
				}
				if (val.event_type == 2)
				{
					print_text +="<TD><a href='322_track_vote_status.php?event_id="+val.event_id+"' target='_blank'>"+val.event_name+"</a></TD>";
				}
				if (val.event_type == 3)
				{
					print_text +="<TD><a href='323_track_eva_status.php?event_id="+val.event_id+"' target='_blank'>"+val.event_name+"</a></TD>";
				}
				
				
				if (val.event_type == 1)
				{
					print_text +="<TD>ลงทะเบียน</TD>";
				}
				if (val.event_type == 2)
				{
					print_text +="<TD>โหวต</TD>";
				}
				if (val.event_type == 3)
				{
					print_text +="<TD>แบบประเมิน</TD>";
				}
				
				print_text +="<TD>"+moment(val.start, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm')+"</TD>";
				print_text +="<TD>"+moment(val.end, "YYYY-MM-DD hh:mm:ss").format('D MMM HH:mm')+"</TD>";
				
				if (val.event_type == 1)
				{
					print_text +='<td></td><td><a  class="btn" id="btn_delete_event" value="'+val.event_id+'"><font color="#D81B60"><i class="fa fa-minus-circle"></i> ลบ</font></a></td>';
				}
				if (val.event_type == 2)
				{
					print_text +='<td><a  class="btn" id="btn_add_option" value="'+val.event_id+'" value2="'+val.event_name+'"><font color="#AAAAAA"><i class="fa fa-cog"></i> เพิ่มตัวเลือก</font></a></td><td><a  class="btn" id="btn_delete_event" value="'+val.event_id+'"><font color="#D81B60"><i class="fa fa-minus-circle"></i> ลบ</font></a></td>';
				}
				if (val.event_type == 3)
				{
					print_text +='<td><a  class="btn" id="btn_add_option" value="'+val.event_id+'" value2="'+val.event_name+'"><font color="#AAAAAA"><i class="fa fa-cog"></i> เพิ่มหัวข้อประเมิน</font></a></td><td><a  class="btn" id="btn_delete_event" value="'+val.event_id+'"><font color="#D81B60"><i class="fa fa-minus-circle"></i> ลบ</font></a></td>';
				}
				
				print_text +="</TR>";
			});
			
			$("#event_list_table").html(print_text);
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

//add_event
$('body').on('click', '#add_event', function() {
	$("#new_event_div").toggle("fast");
	$("#event_name").val("");
	$("#event_type").val("1");
});

//btn_delete_event
$('body').on('click', '#btn_delete_event', function() {
	 var del_target = $(this).attr('value');
	 var add_data = {}
	add_data['f'] = '45';
	add_data['del_target'] = $(this).attr('value');
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		get_event_list_table();
		swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
				  showConfirmButton: false,
				  timer: 1500
				})
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});


// btn_add_option
$('body').on('click', '#btn_add_option', function() {
	current_target_add_event = $(this).attr('value');
	 var target_add_event_name = $(this).attr('value2');
	 vote_list_data_fnc();
	 $("#vote_event_name").html(target_add_event_name);
	 $('#modal_vote_option').modal('show');
});

// add_option_for_vote
$('body').on('click', '#add_option_for_vote', function() {
	var new_vote = $("#new_option_data").val();
	var add_data = {}
	add_data['f'] = '48';
	add_data['new_vote'] = new_vote;
	add_data['current_target_add_event'] = current_target_add_event;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#new_option_data").val('');
		vote_list_data_fnc()
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});


function vote_list_data_fnc()
{
	
	var add_data = {}
	add_data['f'] = '49';
	add_data['current_target_add_event'] = current_target_add_event;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		
		if (data == "[]")
		{
			$("#vote_list_data").html("**ยังไม่มีข้อมูล**");
		}
		else
		{
			var data_arr = JSON.parse(data);
			print_text = "";
			jQuery.each( data_arr, function( i, val ) {
				print_text += '<a  class="btn" id="btn_delete_option" value="'+val.vote_id+'"><font color="#D81B60"><i class="fa fa-minus-circle"></i></font></a> '+val.value +'<BR/>';
			});
			$("#vote_list_data").html(print_text);
		}
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

// btn_delete_option
$('body').on('click', '#btn_delete_option', function() {
	 var del_target = $(this).attr('value');
	 var add_data = {}
	add_data['f'] = '50';
	add_data['del_target'] = del_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		vote_list_data_fnc()
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});





		
			
			
			
			
			
			
			
			
			
			// Initial running ====================================
			get_max_main_training();
			ajax_function(16, "#ed_tr_list");
			
			//$('#frm_ed_tr').hide();
			//$('#tbl_box_data').hide();
			//$('#tab_add_tr_wd').hide();
			
			

});
		</script>
		
	</body>
</html>
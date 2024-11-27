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
		<title>Watch_Dog | Team management</title>
		
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
		
		<!-- Bootstrap Tagsinput Css -->
		<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
		<link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet">
		<!-- J-ui css-->
		<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
		<!-- Bootstrap Select Css -->
		<link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
		
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		
		  <style>
		  .ui-autocomplete-category {
			font-weight: bold;
			padding: .2em .4em;
			margin: .8em 0 .2em;
			line-height: 1.5;
		  }
		  </style>
		  
		  <style>
			canvas{
				-moz-user-select: none;
				-webkit-user-select: none;
				-ms-user-select: none;
			}
			</style>
		
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
						Team Management
						<small>จัดการทีม</small>
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-lg-3">
						  <div class="box  box-primary">
							<div class="box-header">
							  <h3 class="box-title">รายชื่อทีม</h3>
							  <div class="box-tools">
								<button type="button" class="btn btn-box-tool" id="btn_add_team"><i class="fa fa-plus"></i> เพิ่มทีม</button>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div  id="add_new_team" style="display: none;">
									<form class="form-horizontal" id="frm_new_team" >
										<div class="form-group">
											<label for="new_team_name" class="col-sm-3 control-label">ชื่อทีม<font color="red">*</font></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="new_team_name"  placeholder="ทีมใหม่" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label for="new_team_desc" class="col-sm-3 control-label">คำอธิบาย</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="new_team_desc" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label for="new_team_type" class="col-sm-3 control-label">ประเภท<font color="red">*</font></label>
											<div class="col-sm-8">
												<select class="form-control" id="new_team_type">
													
                                                </select>
												<button type="button" class="btn btn-box-tool pull-right" id="btn_add_team_submit" style="display: none;"><font color="#00bfff"><i class="fa fa-plus"></i> เพิ่มทีมใหม่</font></button>
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>
								<div class="table-responsive no-padding"  id = "team_table">
								</div>
							</div>
							<!-- /.box-body -->
						  </div>
						  <!-- /.box -->
						</div>
						
						
						<!-- right column -->
						<div class="col-lg-5" id="pan_info_1" style="display: none;">
						  <div class="box box-info">
							<div class="box-header">
							  <h3 class="box-title">ทีม<span id="info_team_name"></span>  <small id="team_desc"></small>  </h3>
							  <div class="box-tools">
								<button type="button" class="btn btn-box-tool pull-right" id="btn_dl_xls"><i class="fa fa-file-excel-o"></i></button>
								<button type="button" class="btn btn-box-tool pull-right" id="btn_edit"><i class="fa fa-pencil"></i></button>
								<button type="button" class="btn btn-box-tool pull-right" id="btn_add_mem"><i class="fa fa-plus"></i></button>
								<button type="button" class="btn btn-box-tool pull-right" id="btn_add_mem_submit" style="display: none;"><i class="fa fa-plus"></i> เพิ่ม</button>
								
								<div class="input-group input-group-sm pull-right" style="width: 200px;" >
								  <input type="text" class="form-control pull-right" placeholder="ค้นหา" style="display: none;" id="member_add_txt"/>
								</div>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div  id="edit_team" style="display: none;">
									<form class="form-horizontal" id="frm_edir_team" >
										<div class="form-group">
											<label for="edt_team_name" class="col-sm-3 control-label">ชื่อทีม<font color="red">*</font></label>
											<div class="col-sm-6">
												<input type="text" class="form-control" id="edt_team_name"  placeholder="ชื่อทีม" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label for="edt_team_desc" class="col-sm-3 control-label">คำอธิบาย</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" id="edt_team_desc" autocomplete="off"/>
											</div>
										</div>
										<div class="form-group">
											<label for="wdt_team_type" class="col-sm-3 control-label">ประเภท<font color="red">*</font></label>
											<div class="col-sm-8">
												<select class="form-control" id="edt_team_type">
														
                                                </select>
												<button type="button" class="btn btn-box-tool pull-left" id="btn_edt_team_delete"><font color="#ff2222"><i class="fa fa-save"></i> ลบทีม</font></button>
												<button type="button" class="btn btn-box-tool pull-right" id="btn_edt_team_submit"><font color="#1122ff"><i class="fa fa-save"></i> บันทึกข้อมูล</font></button>
												
											</div>
										</div>
										<!-- /.box-body -->
									</form>
								</div>
								<div id="member_list_data">
								</div>
								
							</div>
							<!-- /.box-body -->
							<div class="overlay" id="ovl_load_tbl_data" style="display: none;">
							</div>
						  </div>
						  <!-- /.box -->
						</div>
						
						<!-- right column -->
						<div class="col-lg-4" 	id="pan_info_2" style="display: none;">
							<div class="box box-success">
							<div class="box-header">
							  <h3 class="box-title">ความสามารถทีม</h3>
							  <div class="box-tools" id="save_skill_box">
								<button type="button" class="btn btn-box-tool" id="btn_save_skill"><i class="fa fa-save"></i> บันทึกการเปลี่ยนแปลง</button>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label for="ns_nickname" class="col-sm-1 control-label"></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" data-role="tagsinput" id="team_skill" >
										</div>
									</div>
									<!-- /.box-body -->
								</form>
							</div>
							<!-- /.box-body -->
						  </div>
						  
							  <!-- Custom Tabs (Pulled to the right) -->
							  <div class="nav-tabs-custom">
								<ul class="nav nav-tabs pull-right">
								  <li class="active"><a href="#tab_1-1" data-toggle="tab">เพศ</a></li>
								  <li><a href="#tab_2-2" data-toggle="tab">อาชีพ</a></li>
								  <li><a href="#tab_3-2" data-toggle="tab">ภูมิภาค</a></li>
								  <li class="pull-left header"><i class="fa fa-bar-chart"></i> </li>
								</ul>
								<div class="tab-content">
								  <div class="tab-pane active" id="tab_1-1">
									<div id="canvas-holder">
										<canvas id="chart_member_sex"></canvas>
									</div>
								  </div>
								  <!-- /.tab-pane -->
								  <div class="tab-pane" id="tab_2-2" >
									<div >
										<canvas id="chart_member_occ" ></canvas>
									</div>
								  </div>
								  <!-- /.tab-pane -->
								  <div class="tab-pane" id="tab_3-2">
									
												
								  </div>
								  <!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							  </div>
							  <!-- nav-tabs-custom -->
						</div>
					</div>

					
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
		<script src="bower_components/chart.js/src27/Chart.bundle.js"></script>
		<script src="bower_components/chart.js/src27/utils.js"></script>
		
		<!-- Select Plugin Js -->
		<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
		<!-- Bootstrap Tags Input Plugin Js -->
		<script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<!-- Typehead -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
		<!-- J-ui tab -->
		<script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
		
		<!-- Notify -->
		<script src="plugins/notify/notify.js"></script>
		
		<script>
					 $( function() {
				$.widget( "custom.catcomplete", $.ui.autocomplete, {
				  _create: function() {
					this._super();
					this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
				  },
				  _renderMenu: function( ul, items ) {
					var that = this,
					  currentCategory = "";
					$.each( items, function( index, item ) {
					  var li;
					  if ( item.category != currentCategory ) {
						ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
						currentCategory = item.category;
					  }
					  li = that._renderItemData( ul, item );
					  if ( item.category ) {
						li.attr( "aria-label", item.category + " : " + item.label );
					  }
					});
				  }
				});
			});
		</script>
		
		
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
// Global var  =========================================

var tbl_team_id = [];
var tbl_team_name = [];
var tbl_teamtype_id = [];
var tbl_teamtype_desc = [];

var tbl_wd_id = [];
var tbl_gen = [];
var tbl_name = [];
var tbl_n_name = [];
var tbl_fb = [];
var tbl_prov = [];

// Current_team ID
var cur_team_id = "";
var cur_team_name = "";

// Current_WD_ID
var current_modal_show_wd_id  = "";



// Chart Global Fnc
var chart_sex = document.getElementById('chart_member_sex').getContext('2d');
var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [32, 18],
					backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
					label: 'Dataset 1'
				}],
				labels: [
					'ชาย',
					'หญิง'
				]
			},
			options: {
				responsive: true,
				legend: {
						position: 'right',
					}
			}
		};
		
// Chart chart_bar_occ
var color = Chart.helpers.color;
var chart_occ_config = {
		type: 'bar',
		data: {
	labels: [],
	datasets: [{
		label: 'Dataset 1',
		backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
		borderColor: window.chartColors.red,
		borderWidth: 1,
		data: []
	}]
},
options: {
	responsive: true,
	legend: {
		position: 'top',
	},
	title: {
		display: false,
		text: 'Chart.js Bar Chart'
	}
}
};		
var chart_bar_occ = document.getElementById('chart_member_occ').getContext('2d');


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
			 $("#sidebar_search_case_result").html(data);
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
});




function get_team_table()
{
	var add_data = {}
		add_data['f'] = '25';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			var obj = JSON.parse(data);
			
			tbl_team_id = obj.team_ID.split('-,-');
			tbl_team_name = obj.team_name.split('-,-');
			tbl_teamtype_id = obj.team_type_ID.split('-,-');
			tbl_teamtype_desc = obj.team_type_desc.split('-,-');
			
			 // Print Table
			 print_table();
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

// Print Table of team list
function print_table()
{
	
	var print_text = '<table class="table table-hover">';
	
	$.each(tbl_team_id, function(index, value) {
		print_text += '<tr  id="btn_team_select" value="'+tbl_team_id[index]+'"><td></td><td>'+(parseInt(index)+1).toString() +'. </td><td>'+  tbl_team_name[index]  +'</td><td>'+tbl_teamtype_desc[index]+'</td></tr>';
	});
	
	print_text += "<tr><td></td><td></td><td></td><td></td></tr></table>";
	// Print output
	$("#team_table").html(print_text);
	
}

$('body').on('click', '#btn_team_select', function() {
	var target = ($(this).attr('value'));	
	//alert (target);
	$( "#btn_add_mem" ).html('<i class="fa fa-plus"></i>');
	$( "#member_add_txt" ).hide( "fast" );
	$( "#btn_add_mem_submit" ).hide( "fast" );
	get_table_member_list(target);
	get_team_info(target);
	get_team_skill(target);
	$( "#pan_info_1" ).show( "fast" );
	$( "#pan_info_2" ).show( "fast" );
	
});


function get_table_member_list(target)
{
	$( "#ovl_load_tbl_data" ).show();
	var add_data = {}
	add_data['f'] = '26';
	add_data['team_target'] =  target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		var ojb = JSON.parse(data);
		
		tbl_wd_id = ojb.wd_id.split('-,-');
		tbl_gen = ojb.wd_gen.split('-,-');
		tbl_name = ojb.wd_name.split('-,-');
		tbl_n_name = ojb.wd_n_name.split('-,-');
		tbl_fb = ojb.wd_fb.split('-,-');
		tbl_prov = ojb.wd_prov.split('-,-');
		
		print_team_list_table();
		Load_team_sex_cnt(target);
		Load_team_occ_cnt(target);
		load_team_geo_Data(target);
		$( "#ovl_load_tbl_data" ).hide();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function print_team_list_table()
{
	var print_text = '<Table  class="table table-striped"><tr  bg-light-blue> <th style="width: 30px">#</th> <th>ขื่อ-สกุล</th>  <th>ชื่อเล่น</th> <th>รุ่น</th> <th>จังหวัด</th><th></th></tr>';
	if (tbl_wd_id[0] != "")
	{
		$.each(tbl_wd_id, function(index, value) {
				print_text += '<tr>';
				print_text += '<td>'+(index + 1)+'.</td>';
				print_text += '<td><a class="btn" id="btn_show_wd_data" value="'+tbl_wd_id[index]+'">'+tbl_name[index]+'</a></td>';
				print_text += '<td>'+tbl_n_name[index]+'</td>';
				print_text += '<td>'+tbl_gen[index]+'</td>';
				print_text += '<td>'+tbl_prov[index]+'</td>';
				print_text += '<td class="btn" id="btn_delete_tr_wd" value="'+tbl_wd_id[index]+'"><font color="#ffb3b3"><i class="fa fa-minus-circle"></i></font></td>';
				print_text += '</tr>';
				
		});
	}
	print_text += '</Table>';
	// Print output
	$("#member_list_data").html(print_text);
}

function get_team_info(target)
{
	
	var add_data = {}
	add_data['f'] = '27';
	add_data['team_target'] =  target;
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
		cur_team_id = ojb.team_ID;
		$( "#edit_team" ).hide( "fast" );
		get_team_type_for_edit();
		$("#info_team_name").html(ojb.team_name);
		cur_team_name = ojb.team_name;
		$("#team_desc").html(ojb.team_des);
		$( "#btn_edit" ).html('<i class="fa fa-pencil"></i>');
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_team_skill(target)
{
	var add_data = {}
	add_data['f'] = '28';
	add_data['team_target'] =  target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		var arr_skill=data.split(',');
		$('#team_skill').tagsinput('removeAll');
		$.each(arr_skill, function( index, value ) {
		 if ($.trim(value) != "")
		  {
			$('#team_skill').tagsinput('add',value);
		  }
		});

		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


//btn_add_mem
$( "#btn_add_mem" ).click(function() {
	$( "#member_add_txt" ).val("");
	if ($( "#btn_add_mem" ).html() == '<i class="fa fa-plus"></i>')
	{
		$( "#btn_add_mem" ).html('<i class="fa fa-chevron-right"></i>');
	}
	else 
	{
		$( "#btn_add_mem" ).html('<i class="fa fa-plus"></i>');
	}
		
	$( "#member_add_txt" ).toggle( "fast" );
	$( "#btn_add_mem_submit" ).toggle( "fast" );
});


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
$( "#member_add_txt" ).catcomplete({
	  source: availableTags
});



// btn_add_mem_submit
$( "#btn_add_mem_submit" ).click(function() {
	wd_target = $("#member_add_txt").val();
	$("#member_add_txt").val("");
	if (wd_target.trim() != "")
	{
		_id = wd_target.substring(0, 8);
		//alert (_id);
		if ($.isNumeric(_id)) {
			if (jQuery.inArray(_id, tbl_wd_id) == -1) {
				var add_data = {}
				add_data['f'] = '29';
				add_data['team_target'] =  cur_team_id;
				add_data['wd_id'] =  _id;
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_3_staff.php',
					data: (add_data)
				})
				.done(function(data) {
					get_table_member_list(cur_team_id);
					$.notify("บันทึกข้อมูลสำเร็จ", "success");
					
				})
				.fail(function() {
					// just in case posting your form failed
					alert("Posting failed.");
				});
			}
			else
			{
				//alert ("NG");
				$.notify("มีสมาชิกคนนี้อยู่ในทีมแล้ว", "error");
			}
		}
	}
});

// add_send key up
$('#member_add_txt').keyup(function(e) {
	if (e.keyCode == 13) {
		$("#btn_add_mem_submit").trigger("click");
	}
});




$('body').on('click', '#btn_delete_tr_wd', function() {
	var target = ($(this).attr('value'));	
	var add_data = {}
	add_data['f'] = '30';
	add_data['team_target'] =  cur_team_id;
	add_data['wd_id'] =  target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		get_table_member_list(cur_team_id);
		$.notify("ลบสมาชิกทีมแล้ว", "success");
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});

// btn_add_mem_submit
$( "#btn_save_skill" ).click(function() {
	var team_skill = $("#team_skill").val();
	var add_data = {}
	add_data['f'] = '31';
	add_data['team_target'] =  cur_team_id;
	add_data['team_skill'] =  team_skill;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		get_team_skill(cur_team_id);
		$.notify("บันทึกข้อมูลสำเร็จ", "success");
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
	
});

function get_team_type()
{
	var add_data = {}
	add_data['f'] = '32';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#new_team_type").html(data);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function get_team_type_for_edit()
{
	var add_data = {}
	add_data['f'] = '32';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		$("#edt_team_type").html(data);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

// add_send key up
$('#new_team_name').keyup(function(e) {
	if ($(this).val().trim() != "")
	{
		$( "#btn_add_team_submit" ).show( "fast" );
	}
	else
	{
		$( "#btn_add_team_submit" ).hide( "fast" );
	}
});


//new_team_name
$( "#btn_add_team" ).click(function() {
	 $('#frm_new_team').trigger("reset");
	if ($( "#btn_add_team" ).html() == '<i class="fa fa-plus"></i> เพิ่มทีม')
	{
		$( "#btn_add_team" ).html('<i class="fa fa-chevron-up"></i>');
		//add_new_team
		$( "#add_new_team" ).show( "fast" );
		$( "#btn_add_team_submit" ).hide( "fast" );
		
		
	}
	else 
	{
		$( "#btn_add_team" ).html('<i class="fa fa-plus"></i> เพิ่มทีม');
		$( "#add_new_team" ).hide( "fast" );
		$( "#btn_add_team_submit" ).hide( "fast" );
	}
		
	//$( "#member_add_txt" ).toggle( "fast" );
	//$( "#btn_add_mem_submit" ).toggle( "fast" );
});


$( "#btn_add_team_submit" ).click(function() {
	var add_data = {}
	add_data['f'] = '33';
	add_data['team_name'] = $('#new_team_name').val();
	add_data['team_desc'] = $('#new_team_desc').val();
	add_data['team_type'] = $('#new_team_type').val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		var target = data;	
		//alert (target);
		get_team_table();
		$( "#btn_add_mem" ).html('<i class="fa fa-plus"></i>');
		$( "#btn_add_team" ).html('<i class="fa fa-plus"></i> เพิ่มทีม');
		$( "#member_add_txt" ).hide( "fast" );
		$( "#btn_add_mem_submit" ).hide( "fast" );
		get_table_member_list(target);
		get_team_info(target);
		get_team_skill(target);
		$( "#pan_info_1" ).show( "fast" );
		$( "#pan_info_2" ).show( "fast" );
		$( "#add_new_team" ).hide( "fast" );
		$.notify("บันทึกข้อมูลสำเร็จ", "success");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
	
});


$( "#btn_edit" ).click(function() {
	if ($( "#btn_edit" ).html() == '<i class="fa fa-pencil"></i>')
	{
		$( "#btn_edit" ).html('<i class="fa fa-chevron-up"></i>');
		var add_data = {}
		add_data['f'] = '34';
		add_data['team_id'] = cur_team_id;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			//var target = data;	
			//alert (data)
			var ojb = JSON.parse(data);
			$("#edt_team_name").val(ojb.team_name);
			$("#edt_team_desc").val(ojb.team_des);
			$("#edt_team_type").val(ojb.team_type_id);
			$( "#edit_team" ).show( "fast" );
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
	}
	else 
	{
		$( "#btn_edit" ).html('<i class="fa fa-pencil"></i>');
		$( "#edit_team" ).hide( "fast" );
	}
});


//btn_edt_team_submit
$( "#btn_edt_team_submit" ).click(function() {
	var add_data = {}
	add_data['f'] = '35';
	add_data['team_id'] = cur_team_id;
	add_data['edt_team_name'] = $('#edt_team_name').val();
	add_data['edt_team_desc'] = $('#edt_team_desc').val();
	add_data['edt_team_type'] = $('#edt_team_type').val();
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		var target = data;	
		//alert (target);
		get_team_table();
		$( "#btn_add_mem" ).html('<i class="fa fa-plus"></i>');
		$( "#btn_add_team" ).html('<i class="fa fa-plus"></i> เพิ่มทีม');
		$( "#member_add_txt" ).hide( "fast" );
		$( "#btn_add_mem_submit" ).hide( "fast" );
		get_table_member_list(target);
		get_team_info(target);
		get_team_skill(target);
		$( "#pan_info_1" ).show( "fast" );
		$( "#pan_info_2" ).show( "fast" );
		$( "#add_new_team" ).hide( "fast" );
		$.notify("บันทึกข้อมูลสำเร็จ", "success");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});

//btn_edt_team_submit
$( "#btn_edt_team_delete" ).click(function() {
	var add_data = {}
	add_data['f'] = '36';
	add_data['team_id'] = cur_team_id;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		var target = data;	
		//alert (target);
		get_team_table();
		$( "#btn_add_mem" ).html('<i class="fa fa-plus"></i>');
		$( "#btn_add_team" ).html('<i class="fa fa-plus"></i> เพิ่มทีม');
		$( "#member_add_txt" ).hide( "fast" );
		$( "#edit_team" ).hide( "fast" );
		$( "#btn_add_mem_submit" ).hide( "fast" );
		$( "#pan_info_1" ).hide( "fast" );
		$( "#pan_info_2" ).hide( "fast" );
		$( "#add_new_team" ).hide( "fast" );
		$.notify("ลบทีมสำเร็จ", "success");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});



$('body').on('click', '#btn_show_wd_data', function() {
	var target = ($(this).attr('value'));	
	current_modal_show_wd_id = target;
	 load_basic_wd_data(target);
	 load_wd_data(target);
	$('#modal-summary').modal('show');
});


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


function Load_team_sex_cnt(team_target)
{
	var add_data = {}
	add_data['f'] = '37';
	add_data['team_id'] = team_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data);
		
		var sex_data = data.split(',');
		
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: sex_data,
					backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
					label: 'Dataset 1'
				}],
				labels: [
					'ชาย',
					'หญิง'
				]
			},
			options: {
				responsive: true,
				legend: {
						position: 'right',
					}
			}
		};
	window.myPie_sex.destroy();
	window.myPie_sex = new Chart(chart_sex, config);
	//chart_sex.update();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

function Load_team_occ_cnt(team_target)
{
	var add_data = {}
	add_data['f'] = '38';
	add_data['team_id'] = team_target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data);
		var ojb = JSON.parse(data);
		var label_occ = ojb.label.split('-,-');
		var cnt_occ = ojb.cnt_data.split('-,-');
		//alert(cnt_occ);
		
		var color = Chart.helpers.color;
		var chart_occ_config = {
				type: 'horizontalBar',
				data: {
			labels: label_occ,
			datasets: [{
				label: 'จำนวน',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: cnt_occ
			}]
		},
		options: {
			responsive: true,
			legend: {
				position: 'top',
			},
			legend: {
				display: false,
				labels: {
					fontColor: 'rgb(255, 99, 132)'
				}
			},
		scales: {
					xAxes: [{
						stacked: true,
						beginAtZero: true,
						ticks: {
							stepSize: 1,
							min: 0,
							autoSkip: false
							
						}
					}],
					yAxes: [{
						stacked: true,
						beginAtZero: true,
						ticks: {
							stepSize: 1,
							min: 0,
							autoSkip: false
						}
					}]
					
				}
		}
		};		
		
		window.myBar_occ.destroy();
		window.myBar_occ = new Chart(chart_bar_occ, chart_occ_config);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


function load_team_geo_Data(team_target)
{
//alert (target_wd_id);
var add_data = {}
add_data['f'] = '39';
add_data['team_id'] = team_target;
$.ajax({
	type: 'POST',
	dataType: "text",
	url: 'f_3_staff.php',
	data: (add_data)
})
.done(function(data) {
	//alert (data);
	$("#tab_3-2").html(data);
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


// btn_dl_xls
$('body').on('click', '#btn_dl_xls', function() {
	var add_data = {}
	add_data['f'] = '55';
	add_data['cur_team_id'] = cur_team_id;
	add_data['cur_team_name'] = cur_team_name;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data)
		window.open(data, "_blank");
})
.fail(function() {
	// just in case posting your form failed
	alert("Posting failed.");
});
});

// Initial Run ========================================= 

get_team_table();
get_team_type();
window.myPie_sex = new Chart(chart_sex, config);
window.myBar_occ = new Chart(chart_bar_occ, chart_occ_config);
		
});

	</script>
	</body>
</html>
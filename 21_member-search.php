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
		<title>Watch_Dog | ข้อมูลสมาชิกหมาเฝ้าบ้าน</title>
		
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
		
		<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
		
		
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
		#wd_data_table tr:hover{
			cursor: pointer;
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
						Member
						<small>ข้อมูลสมาชิกหมาเฝ้าบ้าน</small>
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-md-12">
							<!-- general form elements -->
							<div class="box box-primary box-solid">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลส่วนบุคคลสมาชิก</h3>
									<div class="box-tools">
										<button type="button" class="btn btn-box-tool" id="btn_search_mem"><i class="fa fa-search"></i> ค้นหาละเอียด</button>
									  </div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
								
								<div class="row"  id="search_div" style="display: none;">
									<div class = "col-sm-3 col-xs-6"> <!-- [1]-->
										<!-- form start -->
										<form class="form-horizontal">
										
										
											<div class="form-group">
											  <label class="col-sm-4 control-label">ชื่อ-สกุล</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="2">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">รุ่น</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="1">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">เพศ</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="6">
											  </div>
											</div>
											
										</form>
									</div>
									
									<div class = "col-sm-3 col-xs-6"> <!-- [2]-->
										<!-- form start --> 
										<form class="form-horizontal">
										
										
											<div class="form-group">
											  <label class="col-sm-4 control-label">ชื่อเล่น</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="3">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">สถานะ</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="7" value="Active">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">Facebook</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="11">
											  </div>
											</div>
											
										</form>
									</div>
									
									<div class = "col-sm-3 col-xs-6">  <!-- [3]-->
										<!-- form start -->
										<form class="form-horizontal">
										
										
											<div class="form-group">
											  <label class="col-sm-4 control-label">จังหวัด</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="9">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">อาชีพ</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="5">
											  </div>
											</div>
											
										</form>
									</div>
									
									<div class = "col-sm-3 col-xs-6">  <!-- [4]-->
										<!-- form start -->
										<form class="form-horizontal">
										
										
											<div class="form-group">
											  <label class="col-sm-4 control-label">ภาค</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="10">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label">การศึกษา</label>
											  <div class="col-sm-8">
												<input type="text" class="search_table_text form-control" data-index="8">
											  </div>
											</div>
											
											<div class="form-group">
											  <label class="col-sm-4 control-label"></label>
											  <div class="col-sm-8">
												<button type="button" class="btn btn-box-tool pull-right" id="btn_search_mem_hide"><i class="fa fa-chevron-up"></i></button>
											  </div>
											</div>
											
										</form>
									</div>
								</div>
								
						<table id="wd_data_table" class="table table-bordered table-hover display responsive no-wrap" style="width:100%">
						</table>
								
								
								
								
								
								
								
								
								
								
								</div>
								<div class="overlay" id="Ovl_table">
													<i class="fa fa-refresh fa-spin"></i>
												</div>
							</div>
						</div>
					</div>

						
				
				
				
				<!--  MODAL -->
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
				
				<!--  /.MODAL -->
				
						
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
		<script src="dist/chartjs/Chart.js"></script>
		<script src="dist/chartjs/utils.js"></script>
		<!-- DataTables -->
		<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
		
		
		<script>	
$(document).ready(function(){
// Global var  =========================================

var current_modal_show_wd_id;




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


function get_wd_table()
{
	var add_data = {}
		add_data['f'] = '24';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_2_member.php',
			data: (add_data)
		})
		.done(function(data) {
			//alert (data)
			 var ojb = JSON.parse(data);
			 //alert (ojb);
			 var table  = $('#wd_data_table').DataTable( {
					responsive: true,
					 "dom": 'Blrtip',
					buttons: [
					{extend: 'excel',
						text: '<i class="fa fa-file-excel-o"> Download</i>',
						buttons: [ 'columnsVisibility' ],
						visibility: true
					},
					{extend: 'collection',
						text: '<i class="fa fa-plus-circle"> คอลัมน์</i>',
						buttons: [ 'columnsVisibility' ],
						visibility: true
					}],
				data: ojb,
				columns: [
					{ title: "ID" }
					,{ title: "รุ่น" }
					,{ title: "ชื่อ-สกุล" }
					,{ title: "ชื่อเล่น" }
					,{ title: "อายุ" }
					,{ title: "อาชีพ" }
					,{ title: "เพศ" }
					,{ title: "สถานะ" }
					,{ title: "การศึกษา" }
					,{ title: "จังหวัด" }
					,{ title: "ภาค" }
					,{ title: "Facebook" }
				],
				"pageLength": 100,
				"columnDefs": [
						{
							"targets": [0, 4, 5, 6],
							"visible": false
						}
					],
				
				
			});
			//table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
			//console.log(table.column( 0 ).data());
			 
			table.columns(7).search( "Active", true, false, false ).draw();
			//table.fnFilter( "Active" );
			
			
			$('.search_table_text').on( 'keyup', function (index,item) {
				cul_target = parseInt($(this).attr("data-index"));
				search_text =  $(this).val();
				table.columns(cul_target).search( search_text).draw();
			});
			
			$('body').on('click', '#wd_data_table tr', function() {
				target_id = table.row( this ).data()[0];
				show_wd_data(target_id);
			});
			
			
			$( "#Ovl_table" ).hide();
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}


//btn_search_mem
$( "#btn_search_mem" ).click(function() {
	$( "#search_div" ).toggle( "fast" );
});

$( "#btn_search_mem_hide" ).click(function() {
	$( "#search_div" ).toggle( "fast" );
});



function show_wd_data(target_id)
{
	//alert (target_id);
	current_modal_show_wd_id = target_id;
	load_basic_wd_data(target_id);
	 load_wd_data(target_id);
	//alert ($( this ).attr('value'));
	//ajax_function(10, "#modal-summary-data", $( this ).attr('value'));
	$('#modal-summary').modal('show');
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
			
			
			
// =====================Initial Run ========================================= 
// Table
//$('#example').DataTable();

// Call function
get_wd_table();





});

	</script>
	</body>
</html>
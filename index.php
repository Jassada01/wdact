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
		<title>Watch_Dog | Dashboard</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
		<!-- Site icon -->
		<link rel="icon" href="img/system_icon.ico">

		
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- bootstrap slider -->
		<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
			page. However, you can choose any other skin. Make sure you
			apply the skin class to the body tag so the changes take effect. -->
		<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
		
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		
		<!-- bootstrap datepicker -->
        <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		
		 <!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js rdoesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
			
		<!-- Sweet Alert -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
			<style>
			.expand_task_detail:hover 
			{
				cursor: pointer;
			}
			#select_contact_list:hover 
			{
				cursor: pointer;
			}
			
			.cover_case_img {
			  object-fit: cover;
			}
			
			.break-word {
			  width: 100%;
			  overflow-wrap: break-word;
			}
			
			.chat_sticker{
				width:100%;
				max-width: 35%;
			}
			.chat_sticker_img{
				width:100%;
				max-width: 50%;
				border-radius: 10px;
				border: 1px solid #bbb;
				padding: 5px;
				
			}
			
			.case_img {
				zoom: 2;  //increase if you have very small images

				display: block;
				margin: auto;

				height: auto;
				max-height:50px;

				width: auto;
				max-width: 100%;
			}

			.chat_msg_send {
			border-radius: 15px 15px 15px 15px;
			max-width: 80%;
			color:#111111;
			background: #DFDFDF;
			padding: 5px 10px 5px 10px;
		}
		.chat_msg_page {
			border-radius: 15px 15px 15px 15px;
			max-width: 80%;
			color:#f1f0f0;
			background: #1a90ff;
			padding: 5px 10px 5px 10px;
		}
			
		</style>
		
	</head>
	<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?> sidebar-mini">
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
						Dashboard
						<small>หน้าแผงควบคุมและสรุป</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Dashbord</a></li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Small boxes (Stat box) -->
					<div class="row">
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-aqua">
								<div class="inner">
									<h3><span id="like_cnt_data">0</span></h3>
									<p><span id="like_to_target"></span> to target <font color="#00ff00"> <i class="fa fa-chevron-up"></i><span id="like_today_plus">0</span></font></p>
								</div>
								<div class="icon">
									<i class="fa fa-feed"></i>
								</div>
								<a href="40_page_static.php" class="small-box-footer" id="a_modal_detail_like">More info <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-green">
								<div class="inner">
									<h3><span  id="pub_post_cnt"></span><sup style="font-size: 14px"> เคส</sup></h3>
									<p>ลงเพจ</p>
								</div>
								<div class="icon">
									<i class="fa fa-bullhorn"></i>
								</div>
								<a href="41_post_static.php"class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-yellow">
								<div class="inner">
									<h3 id="new_mem_data">0</h3>
									<p>สมาชิกใหม่</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="42_member_static.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-xs-6">
							<!-- small box -->
							<div class="small-box bg-red">
								<div class="inner">
									<h3><span id="dmg_yr_data">0</span><sup style="font-size: 14px"> ล้านบาท</sup></h3>
									<p>ความเสียหายที่ตรวจสอบ</p>
								</div>
								<div class="icon">
									<i class="fa fa-get-pocket"></i>
								</div>
								<a href="43_case_static.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row -->
					      <!-- Main row ----------------------------------------------------------------------------------------------------------------------------------------->

						  
						  <!-- Main content -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
		<!-- TO DO List -->
		
		<div class="box box-solid box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"> เรื่องลงเพจล่าสุด </h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <ul class="products-list product-list-in-box" id="last_pub_case">
					<i class="fa fa-refresh fa-spin"></i> Loading...
				  
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
         </div>
		
		
		  <div class="box box-info" style="overflow:auto;height:250;">
            <div class="box-header">
            

              <h3 class="box-title pull-left"><B>  <i class="ion ion-clipboard"></i> Page Static </B></h3>
			  <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
			<div class="box-body  no-padding">
					<div class="box-tools col-xs-12">
						<span class="pull-leftt"><B>สถิติต่างๆ (<span id="page_static_rang_date_text"></span>)</B></span>
						<div class="input-group input-group-sm pull-right  ">
						
						 <!-- Date and time range -->
							<div class="form-group">
								<div class="input-group">
									<button type="button" class="btn btn-default pull-right" id="daterange-btn">
										<span>
											<i class="fa fa-calendar"></i> เลือกช่วงเวลา
										</span>
										<i class="fa fa-caret-down"></i>
									</button>
								</div>
							</div>
							<!-- /.form group -->
						</div>
					</div>
				
				<div class="col-xs-12" id="result_page_status">

				</div>
					<!-- /.row -->
				
			
			
			
			
			
			
			
			
			
			</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		  
		  
		
		  
		  
		  <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">เรื่องเด่นรอบปีนี้ <button type="button" class="btn btn-box-tool" id="export_to_excel_btn_best_case"><i class="fa fa-file-excel-o"></i> Create Excel</button> <span id="export_to_excel_btn_best_case_result"></span></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
				  <ul class="products-list product-list-in-box" id="best_case_panel">
					<i class="fa fa-refresh fa-spin"></i> Loading...
				  
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
              </div>
		  
		  <div class="box box-danger" >
            <div class="box-header">

              <i class="fa fa-map-marker"></i>
              <h3 class="box-title">
					เคสที่กำลังทำข้อมูล
              </h3>
			  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
            </div>
            <div class="box-body" style="overflow:auto;height:400px;">
			
			  <ul class="products-list product-list-in-box"  id="wip_case_list">
				
				
              </ul>
			  
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
		
		<!-- DIRECT CHAT -->
              <div class="box box-primary box-solid direct-chat direct-chat-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">ข้อความในเพจ - <span id="contact_name"></span></h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"  id="btn_click_toggle_contact_list"
                            data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" >
                  <!-- Conversations are loaded here -->
                  	<div class="direct-chat-messages" style="overflow:auto;height:400px;" id="msg_result_box">
                    	<!-- Message. Default to the left -->
                    	<i class="fa fa-refresh fa-spin"></i> Loading...
                	</div>




                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts" style="overflow:auto;height:400px;">
					<ul class="contacts-list">
						<li>
							<div class="input-group">
								<input type="text" id="search_text_case_msg" style="color:#95abb7;background-color:#374850; border-color: transparent; border-top-left-radius: 5px;border-bottom-left-radius: 5px"  class="form-control" placeholder="ค้นหา" autocomplete="off" />
								<span class="input-group-addon"  style="color:#95abb7;background-color:#374850; border-color: transparent;border-top-right-radius: 5px;border-bottom-right-radius: 5px;" id="load_spin_contact_list"></span>
								<input type="text" style="display: none;">
							</div>
						</li>
					</ul>
							
                    <ul class="contacts-list" id="contact_list_panel">

                    </ul>
                    <!-- /.contatcts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
				
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			<!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">To Do List</h3>

              <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div id="div_add_task_panel" style="display: none;">
					<b>เพิ่ม Task</b></br>
					<form class="form-horizontal" id="form_add_new_task">
						<div class="form-group" id="new_task_title_form_group">
							<label for="new_task_title" class="col-sm-2 control-label">เรื่อง</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="new_task_title"  placeholder="ขื่อ task">
							</div>
						</div>
						<div class="form-group">
							<label for="new_task_detail_textarea" class="col-sm-2 control-label">รายละเอียด</label>
							<div class="col-sm-10">
								<textarea id="new_task_detail_textarea" placeholder="รายละเอียด"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="task_finished_datepicker" class="col-sm-2 control-label">กำหนดเสร็จ</label>
							<div class="col-xs-4">
									<input type="text" class="form-control" id="task_finished_datepicker">
							</div>
								<label class="col-sm-2 control-label"><font color="orange" id="task_finished_datepicker_from_now"></font></label>
						</div>
						<div class="form-group">
							<label for="task_handle_staff" class="col-sm-2 control-label">กำหนดให้</label>
							<div class="col-sm-5">
								<select class="form-control" id="task_handle_staff">
                                </select>
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label"></label>
							<div class="col-sm-8">
								<button type="button" class="btn btn-primary pull-right" id="btn_submit_new_task"><i class="fa fa-download"></i> บันทึก</button>
								<button type="button" class="btn btn-danger pull-left" id="btn_dismiss_div_add_task_panel"><i class="fa fa-times"></i> ยกเลิก</button>
							</div>
						</div>
					</form>
					<Hr>
				</div>
				
				<div  style='overflow:auto;height:200px;'>
				  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
				  <ul class="todo-list" id="to_do_task_list">
				  </ul>
			  </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
				<button type="button" class="btn btn-success pull-right" id="add_new_task"><i class="fa fa-plus"></i> เพิ่ม</button>
            </div>
          </div>
          <!-- /.box -->
		  
		  
		  <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#mem_in_geo_tab" data-toggle="tab">ภาค</a></li>
              <li><a href="#mem_in_prov" data-toggle="tab">จังหวัด</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i> สมาชิกตามภูมิภาค <button type="button" class="btn btn-box-tool" id="export_to_excel_btn_prov"><i class="fa fa-file-excel-o"></i> Create Excel</button> <span id="export_to_excel_btn_prov_result"></span></li>
            </ul>
            <div class="tab-content">
              <!-- Morris chart - Sales -->
              <div class="tab-pane active" id="mem_in_geo_tab" >
				<div  id="mem_in_geo" >
				</div>
					<div id="chart_geo" style="width: 100%; height: 400px;"></div>
			  </div>
              <div class="tab-pane" id="mem_in_prov" >
					
					<div  id="mem_in_prov_table" >
					</div>
					<div  class="box-footer">
							<button type="button" class="btn btn-sm bg-primary pull-right" id="btn_load_all_mem_in_prov">ทั้งหมด...</button>
							<button type="button" class="btn btn-sm bg-primary pull-right" id="btn_load_10_mem_in_prov" style="display: none;"><i class="fa  fa-chevron-up"></i></button>
					</div>
					
			  </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
		  
			  
			   <div class="box box-danger" style="display: none;" >
                <div class="box-header with-border">
                  <h3 class="box-title">ท๊อปหมาเฝ้าบ้าน</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="top_member_list">
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
              </div>
			  
			  
		  
              <div class="box box-danger collapsed-box" style="display: none;">
                <div class="box-header with-border">
                  <h3 class="box-title">สมาชิกล่าสุด</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="last_member_list">
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
              </div>

		
		  
		  
		  
		  
		  
		  

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

						  
							<!-- /.row (main row) -->

				</section>
				
				
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<!-- Main Footer -->
			<?php
				include "footer.php";
			?>
			
			
			
			
			
			
		</div>
		<!-- ./wrapper -->
		<!-- REQUIRED JS SCRIPTS -->
		
		<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		
		<!-- bootstrap datepicker -->
		<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		
		<!-- date-range-picker -->
		<script src="bower_components/moment/min/moment-with-locales.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		<!-- Animate_number -->
		<script src="plugins/animate_number/jquery.animateNumber.min.js"></script>
  
  
		 <!-- Bootstrap WYSIHTML5 -->
		<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes)
		<script src="dist/js/pages/dashboard.js"></script> -->
		
		<!-- Select2 -->
		<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
		
		

		<!-- Numeral -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

		<!-- Notify -->
		<script src="plugins/notify/notify.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
			<!-- Chart JS -->
		<script src="bower_components/chart.js/src27/Chart.js"></script>
			<!-- Amcharts  JS-->
		<script src="plugins/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="plugins/amcharts/pie.js" type="text/javascript"></script>
			
			
<script>





var randomScalingFactor = function(){ return Math.round(Math.random()*100)};


$(function () {

  'use strict';

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });
  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');
});
		
$(document).ready(function(){
// Global var  =========================================
var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')


var random_id_search = "";

// Initial Setting =========================================
// Set Moment 
moment.locale('th');

// Select 2
//$('.select2').select2()

// Set wysihtml5
$('#new_task_detail_textarea').wysihtml5(
{
  toolbar: {
    "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
    "emphasis": true, //Italics, bold, etc. Default true
    "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    "html": false, //Button which allows you to edit the generated HTML. Default false
    "link": false, //Button to insert a link. Default true
    "image": false, //Button to insert an image. Default true,
    "color": false, //Button to change color of font  
    "blockquote": false //Blockquote  
  }
});

//check_gen_fan_datepicker
$('#check_gen_fan_datepicker').datepicker({
	autoclose: true,
	format: 'dd/mm/yyyy'
}).on('changeDate', function(ev){
       target = $(this).val();
	   //get_gen_fan_from_datepicker(target);
});
var today = new Date();
yesterday = new Date(today);
yesterday.setDate(today.getDate() - 1);

$("#check_gen_fan_datepicker").datepicker("setDate", yesterday);
$("#check_gen_fan_datepicker").datepicker("setEndDate", yesterday);


//task_finished_datepicker
$('#task_finished_datepicker').datepicker({
	autoclose: true,
	format: 'dd/mm/yyyy'
}).on('changeDate', function(ev){
       target = $(this).val();
	   $('#task_finished_datepicker_from_now').html(moment(target + "17:00", "DD/MM/YYYY hh:mm").fromNow());
});
var today = new Date();
next_day = new Date(today);
next_day.setDate(today.getDate() +1);

$("#task_finished_datepicker").datepicker("setDate", next_day);
$("#task_finished_datepicker").datepicker("setStartDate", today);

//Date range as a button
$('#daterange-btn').daterangepicker(
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
	startDate: moment().subtract(1, 'days'),
	endDate  : moment().subtract(1, 'days')
  },
  function (start, end) {
	$('#daterange-btn span').html(start.format(' D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'))
	get_page_data_from_range(start.format(' YYYY-MM-DD'), end.format(' YYYY-MM-DD'));
  }
)

	
	// Initial carousel
	$('.carousel').carousel({
		  interval: false
	})



// Page function ========================================= 
// ====
// Random ID
function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 15; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	return text;
}


function isUrlValid(url) {
	return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}


function load_static_like_data()
{
	var add_data = {}
	add_data['f'] = '1';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		//alert(ojb.like_cnt)
		//$('#like_cnt_data').html();
		$("#like_cnt_data").animateNumber(
		  {
			number: ojb.follow_cnt,
			numberStep: comma_separator_number_step
		  });
		  
		$('#like_to_target').html(ojb.diff_cnt);
		$('#like_today_plus').html(ojb.today_plus);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

// ====
function load_static_public_data()
{
	var add_data = {}
	add_data['f'] = '2';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		//alert(ojb.like_cnt)
		//$('#pub_post_cnt').html(ojb.pub_cnt);
		$("#pub_post_cnt").animateNumber(
		  {
			number: ojb.pub_cnt,
			numberStep: comma_separator_number_step
		  });
		  
		//$('#pub_post_pct').html(ojb.percentage);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

// ====
function load_static_new_mem_data()
{
	var add_data = {}
	add_data['f'] = '3';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		//alert(ojb.like_cnt)
		//$('#new_mem_data').html(ojb.cnt);
		$("#new_mem_data").animateNumber(
		  {
			number: ojb.cnt,
			numberStep: comma_separator_number_step
		  });
		//$('#pub_post_pct').html(ojb.percentage);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

// ====
function load_static_damage_data()
{
	var add_data = {}
	add_data['f'] = '4';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		//alert(ojb.like_cnt)
		//$('#dmg_yr_data').html(ojb.target);
		$("#dmg_yr_data").animateNumber(
		  {
			number: ojb.target,
			numberStep: comma_separator_number_step
		  });
		//$('#pub_post_pct').html(ojb.percentage);
		
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


// Like chart get _data_
function get_like_chart_data()
{
	var add_data = {}
		add_data['f'] = '7';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			
			var ojb = JSON.parse(data);
			
			var date_like_chart = [];
			var like_cnt = [];
			$.each( ojb, function( key, data ) {
			  date_like_chart.push(data.date_now);
			  like_cnt.push(data.value);
			});			
			var barChartData = {
			labels: date_like_chart,
			datasets: [{
				label: 'ยอด Like',
				backgroundColor: Color("#D81B60").alpha("0.4").rgbString(),
				borderWidth: 1,
				data: like_cnt
			}
			]
		};
		
		var ctx = document.getElementById('like_chart').getContext('2d');
			window.myBar_like_chart = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						display: false
					},
					title: {
						display: false,
					},
					tooltips: {
						mode: 'index',
						intersect: false,
					}
				}
			});	
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});	
}


function get_wip_case()
{
	var add_data = {}
		add_data['f'] = '9';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			
			var ojb = JSON.parse(data);
			var print_text = "";
			jQuery.each( ojb, function( i, val ) {
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
						text_color = "label-success";
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
				
				if (val.img == null)
				{
					val.img = "img/wd_img/default.png";
				}
				
				print_text += '<li class="item">';
				print_text += '<div class="product-img">';					
				print_text += '<img src="'+val.img+'" alt="Product Image">';					
				print_text += '</div>';					
				print_text += ' <div class="product-info">';					
				print_text += '<a href="14_case_data.php?case_id='+val.case_id+'" class="product-title" target="_blank">' + val.case_id_show + " " + val.topic;					
				print_text += '<span class="label '+text_color+' pull-right">'+text_status+'</span></a>';					
				print_text += '<span class="product-description">';					
				print_text += val.t_sum;					
				print_text += '</span>';					
				print_text += '</div>';					
				print_text += '</li>';		
			});
			//console.log(print_text)
			$('#wip_case_list').html(print_text);
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

function get_wip_case_in_task()
{
	var add_data = {}
		add_data['f'] = '10';
		add_data['stf_kid'] = '<?php echo $staff_key_id;?>';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			var print_html = "";
			$.each( ojb, function( key, data ) {
				//alert (data.priority)
				var priority_string = "success";
				var status_string = "success";
				var work_fd = "";
				var case_lnk = "";
				
				switch(data.priority) {
					case "2" : 
					{
						priority_string = "warning";
						break;
					}
					case "3" : 
					{
						priority_string = "danger";
						break;
					}
				}
				
				switch(data.status) {
					case "0" : 
					{
						status_string = '<small class="label  bg-purple"><i class="fa fa-sign-out"></i> เคสใหม่</small>';
						break;
					}
					
					case "1" : 
					{
						status_string = '<small class="label  bg-blue"><i class="fa fa-check-square-o"></i> ทำข้อมูล</small>';
						break;
					}
					
					case "2" : 
					{
						status_string = '<small class="label  bg-aqua"><i class="fa fa-info"></i> รอข้อมูล</small>';
						break;
					}
					
					case "3" : 
					{
						status_string = '<small class="label  bg-maroon"><i class="fa fa-coffee"></i> ชะลอ</small>';
						break;
					}
					
					case "4" : 
					{
						status_string = '<small class="label  bg-red"><i class="fa fa-times"></i> ยุติ</small>';
						break;
					}
					
					case "5" : 
					{
						status_string = '<small class="label  bg-green"><i class="fa fa-facebook"></i> ลงเพจ</small>';
						break;
					}
					case "6" : 
					{
						status_string = '<small class="label  bg-yellow"><i class="fa fa-check-circle-o"></i> สรุปข้อมูล</small>';
						break;
					}
					case "8" : 
					{
						status_string = '<small class="label  bg-green"><i class="fa fa-book"></i> เขียนต้นฉบับ</small>';
						break;
					}
					case "7" : 
					{
						status_string = '<small class="label  bg-book"><i class="fa fa-facebook"></i> รอตรวจต้นฉบับ</small>';
						break;
					}
				}
				if (data.case_folder_url.trim() != "")
				{
					work_fd = '<a href="'+data.case_folder_url+'" target="_blank"><i class="fa fa-folder"></i></a> ';
				}
				
				if (data.case_cnt_url.trim() != "")
				{
					case_lnk = '<a href="'+data.case_cnt_url+'" target="_blank"><i class="fa fa-facebook-square"></i></a> ';
				}
				
				
				print_html += '<li class="'+priority_string+'"><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><span class="text">'+data.topic+'</span>'+status_string+'<div class="tools">'+work_fd+case_lnk+'<a href="14_case_data.php?case_id='+data.case_id+'" target="_blank"><i class="fa fa-mail-forward"></i></a></div></li>';
			});
			$('#to_do_task_list').html(print_html);
			
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}
  // jQuery UI sortable for the todo list
  $('#to_do_task_list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  });

function get_last_member()
{
	var add_data = {}
	add_data['f'] = '11';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		var print_html = "";
		$.each( ojb, function( key, data ) {
			var member_name = data.name + " " + data.s_name;
			var sex_string = '<font color="#bbbbbb"><i class="fa fa-mars"></i></font>';
			if (data.sex == '1')
			{
				sex_string = '<font color="#bbbbbb"><i class="fa fa-venus"></i></font>';
			}
			
			
			print_html += '<li><img src="img/wd_img/'+data.wd_img+'" alt="User Image"><a class="users-list-name" href="24_member_data.php?wd_id='+data.wd_id+'" target="_blank">'+member_name+'</a><span class="users-list-date">'+data.n_name+' ' + sex_string+'</span></li>';
		});
		
		//last_member_list
		$('#last_member_list').html(print_html);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


function get_table_mem_geo()
{
	var add_data = {}
		add_data['f'] = '12';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			var print_html = '<table class="table table-condensed" ><TR><TH>ภูมิภาค</TH><TH>Active</TH><TH>ชั้นลอย</TH><TH>บ่อพัก</TH><TH>ออกจากศูนย์/แบน</TH><TH>รวม</TH></TR>';
			$.each( ojb, function( key, data ) {
				print_html += "<TR>";
				print_html += "<TD><B>"+data.geo_name+"<B></TD>";
				print_html += "<TD><font color='#07b38e'>"+data.cnt_active+"</font></TD>";
				print_html += "<TD><font color='#8cc775'>"+data.cnt_upper+"</font></TD>";
				print_html += "<TD><font color='#e3d372'>"+data.cnt_idle+"</font></TD>";
				print_html += "<TD><font color='red'>"+data.cnt_other+"</font></TD>";
				print_html += "<TD><B>"+data.total+"</B></TD>";
				print_html += "</TR>";
				
			});
			print_html += "</Table>";
			$("#mem_in_geo").html(print_html);
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

function get_table_mem_prov()
{
	var add_data = {}
		add_data['f'] = '13';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			var print_html = '<table class="table table-condensed" ><TR><TH>ภูมิภาค</TH><TH>Active</TH><TH>ชั้นลอย</TH><TH>บ่อพัก</TH><TH>ออกจากศูนย์/แบน</TH><TH>รวม</TH></TR>';
			$.each( ojb, function( key, data ) {
				print_html += "<TR>";
				print_html += "<TD><B>"+data.prv_name+"<B></TD>";
				print_html += "<TD><font color='#07b38e'>"+data.cnt_active+"</font></TD>";
				print_html += "<TD><font color='#8cc775'>"+data.cnt_upper+"</font></TD>";
				print_html += "<TD><font color='#e3d372'>"+data.cnt_idle+"</font></TD>";
				print_html += "<TD><font color='red'>"+data.cnt_other+"</font></TD>";
				print_html += "<TD><B>"+data.total+"</B></TD>";
				print_html += "</TR>";
				
			});
			print_html += "</Table>";
			$("#mem_in_prov_table").html(print_html);
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}


function get_table_mem_prov_all()
{
	var add_data = {}
	add_data['f'] = '14';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		var ojb = JSON.parse(data);
		var print_html = '<table class="table table-condensed" ><TR><TH>ภูมิภาค</TH><TH>Active</TH><TH>ชั้นลอย</TH><TH>บ่อพัก</TH><TH>ออกจากศูนย์/แบน</TH><TH>รวม</TH></TR>';
		$.each( ojb, function( key, data ) {
			print_html += "<TR>";
			print_html += "<TD><B>"+data.prv_name+"<B></TD>";
			print_html += "<TD><font color='#07b38e'>"+data.cnt_active+"</font></TD>";
			print_html += "<TD><font color='#8cc775'>"+data.cnt_upper+"</font></TD>";
			print_html += "<TD><font color='#e3d372'>"+data.cnt_idle+"</font></TD>";
			print_html += "<TD><font color='red'>"+data.cnt_other+"</font></TD>";
			print_html += "<TD><B>"+data.total+"</B></TD>";
			print_html += "</TR>";
			
		});
		print_html += "</Table>";
		$("#mem_in_prov_table").html(print_html);
		
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

//btn_load_all_mem_in_prov
$( "#btn_load_all_mem_in_prov" ).click(function() {
	
	$( "#btn_load_10_mem_in_prov" ).toggle();
	$( "#btn_load_all_mem_in_prov" ).toggle();
	
	$("#mem_in_prov_table").html('<i class="fa fa-refresh fa-spin"></i>');
	get_table_mem_prov_all();
});

//btn_load_all_mem_in_prov
$( "#btn_load_10_mem_in_prov" ).click(function() {
	
	$( "#btn_load_10_mem_in_prov" ).toggle();
	$( "#btn_load_all_mem_in_prov" ).toggle();
	
	$("#mem_in_prov_table").html('<i class="fa fa-refresh fa-spin"></i>');
	get_table_mem_prov();
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


function get_gen_fan_from_datepicker(target_date)
{
	//alert (target_date);
	dt = target_date.split('/');
	var target  = dt[2] + '-' + dt[1] + '-' + dt[0];
	//alert (target);
	
	var add_data = {}
	add_data['f'] = '17';
	add_data['target'] = target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	
	.done(function(data) {
		var ojb = JSON.parse(data);
		//alert (data);
		try 
		{
			window.fan_gen_chart.destroy();
		}
		catch(err) 
		{
		   // DO NOTTING;
		}
			var date_fan_chart = [];
			var fan_cnt = [];
			
			$.each( ojb, function( key, data ) 
			{
				if (data.sub_name.indexOf("U"))
				{
					date_fan_chart.push(data.sub_name.replace('M.', 'ชาย ').replace('F.', 'หญิง '));
					fan_cnt.push(data.value);
				}
				
			});	
			
			// Create Table
			var print_text = '<Table  class="table table-condensed">';
			$.each(date_fan_chart, function(index, value) {
				print_text += "<TR>";
				print_text += "<TD><B>"+value+"</B></TD>";
				print_text += "<TD>"+parseInt(fan_cnt[index]).toLocaleString();+"</TD>";
				print_text += "</TR>";
			});
			print_text += "</Table>";
			$("#fan_gen_table").html(print_text);
			
			// Change date label
			$("#fan_gen_date_target_label").html(target_date);
			
			// Create Chart
			var barChartData = {
			labels: date_fan_chart,
			datasets: [{
					label: 'ยอดเช้าชม',
					backgroundColor: Color("#166a8f").alpha("0.4").rgbString(),
					borderWidth: 1,
					data: fan_cnt
				}	
			]
		};
		var ctx = document.getElementById('fan_gen_chart').getContext('2d');
			window.fan_gen_chart= new Chart(ctx, {
				type: 'horizontalBar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						display: false
					},
					title: {
						display: false,
					},
					tooltips: {
						mode: 'index',
						intersect: false,
					},
					scales: {
						yAxes: [{
							gridLines: {
								display:false
							}
						}],
						xAxes: [{
							gridLines: {
								display:false
							}
						}]
					}
				}
			});	
		
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


function get_page_data_from_range (start, end)
{
	var text_date_start_to_end = $('#daterange-btn').data('daterangepicker').startDate.format(' D MMMM YYYY') + " ถึง " + $('#daterange-btn').data('daterangepicker').endDate.format(' D MMMM YYYY');
	$("#page_static_rang_date_text").html(text_date_start_to_end);
	var add_data = {}
		add_data['f'] = '18';
		add_data['start'] = start;
		add_data['end'] = end;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			//alert (data);
			var ojb = JSON.parse(data);
			var print_text = "";
			$.each( ojb, function( key, data ) {
				
				// Create Diff str
				var diff_str = "";
				if (data.diff >= 0)
				{
					diff_str = '<font><i class="fa fa-angle-double-up"></i>  '+data.diff_str+'% จากค่าเฉลี่ยรอบเดือน</font>';
				}
				else
				{
					diff_str = '<font><i class="fa fa-angle-double-down"></i>  '+data.diff_str+'% จากค่าเฉลี่ยรอบเดือน</font>';
				}
				
				print_text += '<div class="col-sm-4 col-xs-12">';
				//print_text += '<div class="info-box '+data.bg_color+'">';
				print_text += '<div class="info-box '+data.bg_color+'">';
				print_text += '<span class="info-box-icon"><i class="fa '+data.Icon+'"></i></span>';
				print_text += '<div class="info-box-content">';
				print_text += '<span class="info-box-text"><B>'+data.show_name+'</B></span>';
				//alert(data.f_name)
				if ((data.f_name == "page_impressions_unique") || (data.f_name == "page_impressions_viral_unique") || (data.f_name == "page_engaged_users") || (data.f_name == "page_consumptions_unique") )
				{
					print_text += '<span class="info-box-number"><span class="number_cnt_target" value="'+data.avg_str.replace(/\,/g, '')+'"></span> ' + data.Unit+ '</span>';
				}
				else
				{
					print_text += '<span class="info-box-number"><span class="number_cnt_target" value="'+data.value_str.replace(/\,/g, '')+'"></span> ' + data.Unit + '</span>';
				}
				
				
				print_text += '<span class="progress-description">';
				print_text += diff_str;
				print_text += '</span>';
				print_text += '</div>';
				print_text += '</div>';
				print_text += '</div>';
				print_text += '';
			});			
			$("#result_page_status").html(print_text);
			animate_count_value();
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

function animate_count_value()
{
	$('body span.number_cnt_target').each(function(i, obj) {
			var target = ($(this).attr('value'));
			//alert (target)
			$(this).animateNumber(
			  {
				number: target,
				numberStep: comma_separator_number_step
			  }
			);
	});
}

function get_task_handle_staff_list()
{
	var add_data = {}
		add_data['f'] = '19';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			//alert (data);
			var ojb = JSON.parse(data);
			var current_staff_id = '<?php echo $staff_key_id;?>';
			var print_text = "";
			$.each( ojb, function( key, data_arr ) {
				if (data_arr.key_ID == current_staff_id)
				{
					print_text += '<option value="'+data_arr.key_ID+'" selected>'+data_arr.Name+' ('+data_arr.nick_name+')</option>';
				}
				else
				{		
					print_text += '<option value="'+data_arr.key_ID+'">'+data_arr.Name+' ('+data_arr.nick_name+')</option>';
				}
			});
			$("#task_handle_staff").html(print_text);
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

//add_new_task
$('body').on('click', '#add_new_task', function() {
	$('#form_add_new_task').trigger("reset");
	get_task_handle_staff_list();
	var today = new Date();
	next_day = new Date(today);
	next_day.setDate(today.getDate() +1);
	$("#task_finished_datepicker").datepicker("setDate", next_day);
	$("#task_finished_datepicker").datepicker("setStartDate", today);
	$("#new_task_title").val("");
	$( "#new_task_title_form_group" ).removeClass( "has-error" );
	$('textarea#new_task_detail_textarea').val('');
	$("#div_add_task_panel").show("fast")
});

//btn_dismiss_div_add_task_panel
$('body').on('click', '#btn_dismiss_div_add_task_panel', function() {
	$("#div_add_task_panel").hide("fast")
});

//btn_submit_new_task
$('body').on('click', '#btn_submit_new_task', function() {
	$( "#new_task_title_form_group" ).removeClass( "has-error" );
	if ($("#new_task_title").val() == "")
	{
			$( "#new_task_title_form_group" ).addClass( "has-error" );
	}
	else
	{
		var add_data = {}
		add_data['f'] = '20';
		add_data['task_name'] = $("#new_task_title").val();
		add_data['task_detail'] = $("#new_task_detail_textarea").val();
		add_data['task_end'] = (moment($("#task_finished_datepicker").val(), "DD/MM/YYYY").format("YYYY-MM-DD") + " 17:00");
		add_data['handle_staff'] = $('#task_handle_staff').val();
		add_data['add_staff'] = '<?php echo $staff_key_id;?>';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			$("#div_add_task_panel").hide("fast");
			get_task_list();
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
	}
	//new_task_title_form_group

	
});


function get_task_list()
{
	var add_data = {}
		add_data['f'] = '21';
		add_data['k_id'] = '<?php echo $staff_key_id;?>';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			var print_html = "";
			$.each( ojb, function( key, data ) {
				if (data.type == "case")
				{
					var priority_string = "danger";
					var status_string = "success";
					var work_fd = "";
					var case_lnk = "";
					//alert (data.status_id)
					switch(data.status_id) {
						case "0" : 
						{
							status_string = '<small class="label  bg-purple"><i class="fa fa-sign-out"></i> เคสใหม่</small>';
							break;
						}
						
						case "1" : 
						{
							status_string = '<small class="label  bg-blue"><i class="fa fa-check-square-o"></i> ทำข้อมูล</small>';
							break;
						}
						
						case "2" : 
						{
							status_string = '<small class="label  bg-aqua"><i class="fa fa-info"></i> รอข้อมูล</small>';
							break;
						}
						
						case "3" : 
						{
							status_string = '<small class="label  bg-maroon"><i class="fa fa-coffee"></i> ชะลอ</small>';
							break;
						}
						
						case "4" : 
						{
							status_string = '<small class="label  bg-red"><i class="fa fa-times"></i> ยุติ</small>';
							break;
						}
						
						case "5" : 
						{
							status_string = '<small class="label  bg-green"><i class="fa fa-facebook"></i> ลงเพจ</small>';
							break;
						}
						case "6" : 
						{
							status_string = '<small class="label  bg-yellow"><i class="fa fa-check-circle-o"></i> สรุปข้อมูล</small>';
							break;
						}
						case "8" : 
						{
							status_string = '<small class="label  bg-green"><i class="fa fa-book"></i> เขียนต้นฉบับ</small>';
							break;
						}
						case "7" : 
						{
							status_string = '<small class="label  bg-book"><i class="fa fa-facebook"></i> รอตรวจต้นฉบับ</small>';
							break;
						}
					}
					if (data.case_folder_url.trim() != "")
					{
						work_fd = '<a href="'+data.case_folder_url+'" target="_blank"><i class="fa fa-folder"></i></a> ';
					}
					
					if (data.case_cnt_url.trim() != "")
					{
						case_lnk = '<a href="'+data.case_cnt_url+'" target="_blank"><i class="fa fa-facebook-square"></i></a> ';
					}
					
					print_html += '<li class="'+priority_string+'"><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><span class="text">'+data.topic+'  <small><font color="red">'+moment(data.finished_date_str, "YYYY-MM-DD hh:mm").fromNow()+'</font></small> </span>'+status_string+'<div class="tools">'+work_fd+case_lnk+'<a href="14_case_data.php?case_id='+data.case_id+'" target="_blank"><i class="fa fa-mail-forward"></i></a></div><font color="#aaaaaa"><span  id="task_no_'+data.case_id+'" style="display: none;">'+data.t_sum+'</span></font></li>';
					//alert(print_html)
				}
				else
				{
					//print_html += '<li class="primary"><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><span class="text">'+data.topic+'  <small><font color="red">'+moment(data.finished_date_str, "YYYY-MM-DD hh:mm").fromNow()+'</font></small> <font color="#aaaaaa"><small class="expand_task_detail" value="task_no_'+data.case_id+'"><i class="fa fa-angle-double-down"></i></small></font> </span><span id="task_no_'+data.case_id+'" style="display: none;"><font color="#aaaaaa">'+htmlDecode(data.t_sum)+'</font></span><div class="tools"><i class="fa fa-check" id="btn_complete_task" value="'+data.case_id+'"></i><i class="fa fa-pencil" id="btn_edit_task" value="'+data.case_id+'"></i><i class="fa fa-times" id="btn_delete_task" value="'+data.case_id+'"></i></div></li>';
					print_html += '<li class="primary"><span class="handle"><i class="fa fa-ellipsis-v"></i><i class="fa fa-ellipsis-v"></i></span><span class="text">'+data.topic+'  <small><font color="red">'+moment(data.finished_date_str, "YYYY-MM-DD hh:mm").fromNow()+'</font></small> <font color="#aaaaaa"><small class="expand_task_detail" value="task_no_'+data.case_id+'"><i class="fa fa-angle-double-down"></i></small></font> </span><span id="task_no_'+data.case_id+'" style="display: none;"><font color="#aaaaaa">'+htmlDecode(data.t_sum)+'</font></span><div class="tools"><i class="fa fa-check" id="btn_complete_task" value="'+data.case_id+'"></i></i><i class="fa fa-times" id="btn_delete_task" value="'+data.case_id+'"></i></div></li>';
					//alert(print_html);
				}
			});
			$('#to_do_task_list').html(print_html);
			
		})
		.fail(function() {
			// just in case posting your form failed
			//alert("Posting failed.");
		});
}

function htmlDecode(input){
  var e = document.createElement('div');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

//post_data_type4click
$('body').on('click', '.expand_task_detail', function() {
	var target = ($(this).attr('value'));
	$("#"+target).toggle()
});

//post_data_type4click
$('body').on('click', '#btn_complete_task', function() {
	var target = ($(this).attr('value'));
	var add_data = {}
	add_data['f'] = '22';
	add_data['task_id'] = target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		get_task_list();
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

//post_data_type4click
$('body').on('click', '#btn_delete_task', function() {
	var target = ($(this).attr('value'));
	var add_data = {}
	add_data['f'] = '23';
	add_data['task_id'] = target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		get_task_list();
		swal({
				  position: 'top-end',
				  type: 'success',
				  title: 'ลบ Task สำเร็จ',
				  showConfirmButton: false,
				  timer: 1000
				});
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
});


//export_to_excel_btn_prov
$('body').on('click', '#export_to_excel_btn_prov', function() {
	$("#export_to_excel_btn_prov").html('<i class="fa fa-refresh fa-spin"></i>');
	var add_data = {};
	add_data['f'] = '24';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#export_to_excel_btn_prov").hide("fast");
		$("#export_to_excel_btn_prov_result").html(data);
		//alert(data)
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
	
});


function get_geo_chart()
{
	var add_data = {};
	add_data['f'] = '25';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
			//alert (data)
			var ojb = JSON.parse(data);
			var get_chart;
            var legend;
                // PIE CHART
                get_chart = new AmCharts.AmPieChart();
                get_chart.dataProvider = ojb;
                get_chart.titleField = "geo_name";
                get_chart.valueField = "value";
                get_chart.outlineColor = "#FFFFFF";
                get_chart.outlineAlpha = 0.8;
                get_chart.outlineThickness = 2;
                get_chart.startDuration = 0;
                get_chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                get_chart.depth3D = 15;
                get_chart.angle = 30;
				
				// Logo Position
				get_chart.creditsPosition = "bottom-left";
                // WRITE
                get_chart.write("chart_geo");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_top_member()
{
	var add_data = {}
	add_data['f'] = '26';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		var ojb = JSON.parse(data);
		var print_html = "";
		$.each( ojb, function( key, data ) {
			var member_name = data.name + " " + data.s_name;
			var sex_string = '<font color="#bbbbbb"><i class="fa fa-mars"></i></font>';
			if (data.sex == '1')
			{
				sex_string = '<font color="#bbbbbb"><i class="fa fa-venus"></i></font>';
			}
			
			
			print_html += '<li><img src="img/wd_img/'+data.wd_img+'" alt="User Image"><a class="users-list-name" href="24_member_data.php?wd_id='+data.wd_id+'" target="_blank">'+data.n_name+" : "+ data.point+' คะแนน</a><span class="users-list-date">'+member_name+'</span></li>';
		});
		
		//last_member_list
		$('#top_member_list').html(print_html);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}



function get_best_case()
{
	var add_data = {}
	add_data['f'] = '27';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert(data);
		//console.log(data);
		var ojb = JSON.parse(data);
		var print_text = "";
		$.each( ojb, function( key, val ) {

				print_text += '<li class="item">';
				print_text += '<div class="product-img">';					
				print_text += '<img src="'+val.img_src+'" alt="Product Image">';					
				print_text += '</div>';					
				print_text += ' <div class="product-info">';					
				print_text += '<a href="14_case_data.php?case_id='+val.case_id+'" class="product-description " target="_blank"><B><font color="#001F3F">' + val.topic;					
				print_text += '</B></font></a>';					
				print_text += '<span class="product-description"> <font color="#ff0040">  <i class="fa fa-users"></i> ' + numeral(val.Reach).format('0.00 a') ;					
							
				print_text += '</font>  </span>';					
				print_text += '</div>';					
				print_text += '</li>';

			//print_html += '<li><img src="'+data.img_src+'" class="case_img" ><a class="users-list-name" href="14_case_data.php?case_id='+data.case_id+'" target="_blank">'+data.topic+'</a><span class="users-list-name"><small><font color="#888888">'+data.ofd_name+'</font></small></span></li>';
		});
		//alert (print_text)
		//last_member_list
		$('#best_case_panel').html(print_text);
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}


//export_to_excel_btn_prov
$('body').on('click', '#export_to_excel_btn_best_case', function() {
	$("#export_to_excel_btn_best_case").html('<i class="fa fa-refresh fa-spin"></i>');
	var add_data = {};
	add_data['f'] = '28';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		$("#export_to_excel_btn_best_case").hide("fast");
		$("#export_to_excel_btn_best_case_result").html(data);
		//alert(data)
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
	
});

function get_last_pub_case()
{
	var add_data = {}
		add_data['f'] = '29';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_0_index.php',
			data: (add_data)
		})
		.done(function(data) {
			
			var ojb = JSON.parse(data);
			var print_text = "";
			jQuery.each( ojb, function( i, val ) {
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
						text_color = "label-success";
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
				
				if (val.img == null)
				{
					val.img = "img/wd_img/default.png";
				}
				
				var ms = moment().diff(moment(val.pub_time,"YYYY-MM-DD hh:mm:ss"));
				print_text += '<li class="item">';
				print_text += '<div class="product-img">';					
				print_text += '<img src="'+val.img+'" alt="Product Image">';					
				print_text += '</div>';					
				print_text += ' <div class="product-info">';					
				print_text += '<a href="14_case_data.php?case_id='+val.case_id+'" class="product-description " target="_blank"><B><font color="#001F3F">' + val.case_id_show + " " + val.topic;					
				print_text += '</B></font></a>';					
				print_text += '<span class="product-description"> '+val.ep+' EP - โพสครั้งแรก : ';					
				//print_text += val.t_sum;
				if (ms < 259200000)
				{
					print_text += moment(val.pub_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {sameElse: 'DD MMMM YYYY'});	
				}
				else
				{
					print_text += moment(val.pub_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {sameElse: 'DD MMMM YYYY'});	
				}
									
				print_text += '</span>';					
				print_text += '</div>';					
				print_text += '</li>';		
			});
			//console.log(print_text)
			$('#last_pub_case').html(print_text);
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}


function query_msg(msg_id="max")
{
	if (msg_id != "max")
	{
		$("#btn_click_toggle_contact_list").click();
	}
	$("#msg_result_box").html('<i class="fa fa-refresh fa-spin"></i> Loading...')
	var add_data = {};
	add_data['f'] = '30';
	add_data['msg_id'] = msg_id;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	})
	.done(function(data) {
		if (data != "[]")
		{
			var current_contact_name = "";
			var data_arr = JSON.parse(data);
			print_text = "";
			jQuery.each( data_arr, function( i, val ) {
				other_msg = "";
				//is_sticker_text = "direct-chat-text"

				//CHECK IS URL
				if (isUrlValid(val.MSG))
				{
					val.MSG = "<a href='"+val.MSG+"' target='_blank'>"+val.MSG.substring(0, 30)+"...</a>";
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
			
			$("#contact_name").html(current_contact_name);
			
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

function get_msg_contact_list(target_search="")
{
	// load_spin_contact_list
	if ($("#load_spin_contact_list").html() == '<i class="fa fa-search"></i>')
	{
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
		if (_temp_random_id_search == random_id_search)
		{
			if (data != "[]")
			{
				var data_arr = JSON.parse(data);
				console.log(data_arr)
				print_text = "";
				jQuery.each( data_arr, function( i, val ) {
					var ms = moment().diff(moment(val.update_time,"YYYY-MM-DD hh:mm:ss"));
					
					print_text += '<li id="select_contact_list" value="'+val.msg_id+'">';
					print_text += '<a>';
					//print_text += '<img class="contacts-list-img" src="msg" alt="User Image">';
					print_text += '<div class="contacts-list-info">';
					print_text += '<span class="contacts-list-name">';
					print_text += val.sender_name.replace(target_search, "<font color='red'>"+target_search+"</font>");
					if (ms < 259200000)
					{
						print_text += '<small class="contacts-list-date pull-right">'+moment(val.update_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {sameElse: 'DD MMMM YYYY'})+'</small>';
					}
					else
					{
						print_text += '<small class="contacts-list-date pull-right">'+moment(val.update_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {sameElse: 'DD MMMM YYYY'})+'</small>';
					}
					
					print_text += '</span>';
					print_text += '<span class="contacts-list-msg">'+val.MSG.replace(target_search, "<font color='red'>"+target_search+"</font>")+'</span>';
					print_text += '</div>';
					print_text += '</a>';
					print_text += '</li>';
				});
				$("#contact_list_panel").html(print_text)
			}
			else
			{
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
$("#search_text_case_msg" ).keyup(function() {
  var search_target = $(this).val();
  //alert(search_target);
  if (search_target.trim() == "")
  {
	 get_msg_contact_list();
  }
  else
  {
	  get_msg_contact_list(search_target);
  }
});

//select_contact_list
$('body').on('click', '#select_contact_list', function() {
	var target = ($(this).attr('value'));
	query_msg(target);
});
// Initial Run ========================================= 


get_last_pub_case();
load_static_like_data();
load_static_public_data();
load_static_new_mem_data();
load_static_damage_data();
get_wip_case();
//get_wip_case_in_task();
get_last_member();
get_table_mem_geo();
get_table_mem_prov();

get_task_list();


//get_like_chart_data();
get_page_data_from_range(moment().subtract(1, 'days').format(' YYYY-MM-DD'), moment().subtract(1, 'days').format(' YYYY-MM-DD'))

get_task_handle_staff_list();


get_geo_chart();

get_top_member();


get_best_case();

query_msg();

get_msg_contact_list();

//var objDiv = document.getElementById("msg_result_box");
//objDiv.scrollTop = objDiv.scrollHeight;

});

	</script>
	</body>
</html>

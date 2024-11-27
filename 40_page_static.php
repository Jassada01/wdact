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
	<title>Watch_Dog | Page Static</title>

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
	<!-- bootstrap slider -->
	<link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">
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
		.chip {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 17px;
			line-height: 35px;
			border-radius: 25px;
			background-color: #efefef;
		}

		.chip_hdr {
			margin: .2em 0.2em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 17px;
			line-height: 35px;
			border-radius: 2px;
			background-color: #ffffff;
		}


		.chip_hdr_selected {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 17px;
			font-weight: bold;
			line-height: 35px;
			border-radius: 2px;
			background-color: #ff6699;
		}

		.chip_selected {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 17px;
			font-weight: bold;
			line-height: 35px;
			border-radius: 25px;
			background-color: #ccffdd;
		}

		.chip_hdr:hover {
			background-color: #b5b5b5;
			cursor: pointer;
		}

		.chip:hover {
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
			padding: 0 25px;
			height: 35px;
			font-size: 15px;
			line-height: 35px;
			border-radius: 0px;
			background-color: #f1f1f1;
		}

		.chip_add_current {
			margin: 0.1em 0.1em;
			display: inline-block;
			padding: 0 25px;
			height: 35px;
			font-size: 15px;
			font-weight: bold;
			line-height: 35px;
			border-radius: 0px;
			background-color: #66b3ff;
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
			<div class="chip_selected">Facebook </div>
			<div class="chip" style="background-color:#FFFFFF;" id="btn_go_line"><B>Line</B></div>
			
				<h1>
					Facebook Page Static
					<small>ข้อมูลทางสถิติของเพจปฏิบัติการหมาเฝ้าบ้าน Facebook</small>
				</h1>
				<ol class="breadcrumb">
					<button type="button" class="btn btn-box-tool" id="export_to_excel_btn"><i class="fa fa-cloud-upload"></i> Export Data</button>
				</ol>
			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-sm-12" id="available_select_like_chart_data_panel"></div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<div class="box  box-primary">
							<div class="box-header">
								<h3 class="box-title" id="current_data_title"></h3><BR>
								<small id="current_data_title_desc"></small>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="pull-left" id="available_select_like_chart_type_panel"></div>
								<div class="pull-right" id="available_select_like_group_by_panel"></div>
								<div id="chartdiv" style="width:100%; height:400px;"></div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>

					<div class="col-sm-2">
						<div class="box  box-warning">
							<div class="box-header">
								<h3 class="box-title">สถิติ</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<ul class="products-list product-list-in-box">
									<li class="item">
										<B>สูงสุด : <font color="green"><span id="data_max_value"><span></font></B>
										<span class="label label-success pull-right"><span id="data_max_pct"></span>% จากค่าเฉลี่ย</span>
										<span class="product-description" id="data_max_date"></span>
									</li>
									<!-- /.item -->
									<li class="item">
										<B>ต่ำสุด : <font color="red"><span id="data_min_value"><span></font></B>
										<span class="label label-danger pull-right"><span id="data_min_pct"></span>% ของค่าเฉลี่ย</span>
										<span class="product-description" id="data_min_date"></span>
									</li>

									<li class="item">
										<B>เฉลี่่ยต่อวัน : <font color="blue"><span id="data_avg_value"><span></font></B>
									</li>
									<!-- /.item -->
								</ul>

							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>

				</div>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						<div class="box  box-info">
							<div class="box-header">
								<h4 class="box-title">ยอด Like</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div id="chart_div_page_like" style="height:400px;"></div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
					<div class="col-sm-6">
						<div class="box  box-info">
							<div class="box-header">
								<h4 class="box-title">ยอด Follow</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div id="chart_div_page_follow" style="height:400px;"></div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-5"></div>
					<div class="col-sm-6">
						<div id="available_select_heatmap_type_panel"></div>
					</div>
					<Br>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box  box-danger">
							<div class="box-header">
								<h3 class="box-title" id="heatmap_data_type_title"></h3>

								<!-- Date and time range -->
								<div class="form-group pull-right">
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
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12">

										<button type="button" class="btn btn-primary pull-left" id="adjust_heatmap_btn">ปรับมุมมองละเอียด</button>
									</div>
								</div>
								<form class="form-horizontal" id="detail_heatmap_adjust_form" style="display: none">
									<div class="form-group">
										<label for="m_facebook_2" class="col-sm-2 control-label">ความต่าง</label>
										<div class="col-sm-8">
											<input type="text" id="heat_map_adjust_value" value="20" class="slider form-control" data-slider-min="5" data-slider-max="100" data-slider-step="5" data-slider-value="20" data-slider-id="blue" />
										</div>
									</div>
									<div class="form-group">
										<label for="heat_map_adjust_rad" class="col-sm-2 control-label" id="temp_res">รัศมี</label>
										<div class="col-sm-8">
											<input type="text" id="heat_map_adjust_rad" value="32" class="slider form-control" data-slider-min="5" data-slider-max="100" data-slider-step="5" data-slider-value="32" data-slider-id="blue" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-10">
											<button type="button" class="btn btn-danger pull-right" id="btn_get_res_adjust">ปรับ</button>
										</div>
									</div>
								</form>

								<Br>
								<Br>
								<div id="map" style="width:100%;height:600px"></div>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>


					<div class="col-sm-6">
						<div class="box  box-danger">
							<div class="box-header">
								<h3 class="box-title"></h3>
								<div class="input-group input-group-sm pull-right" style="width: 150px;">
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									<input type="text" class="form-control pull-right" id="check_gen_fan_datepicker">
								</div>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="col-sm-9 col-xs-12">
									<canvas id="fan_gen_chart"></canvas>
								</div>
								<div class="col-sm-3 col-xs-12" id="fan_gen_table">
								</div>
							</div>
						</div>
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



	<!-- date-range-picker -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>
	<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

	<!-- bootstrap datepicker -->
	<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- Amcharts  JS-->
	<script src="plugins/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="plugins/amcharts/serial.js" type="text/javascript"></script>

	<!-- Chart JS -->
	<script src="bower_components/chart.js/src27/Chart.js"></script>

	<!-- Bootstrap slider -->
	<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
	<!-- Google Heatmap-->
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-qmWmKTeZYf9ohc7WqHP_8WUsK-DjIBI&libraries=visualization&callback=initMap&language=th&region=TH"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================

			var gb_current_select_page_like_groupby = "Day";
			var gb_avilable_select_page_like_groupby = ["monthly", "weekly", "Day"];
			var gb_avilable_select_page_like_groupby_desc = ["รายเดือน", "รายสัปดาห์", "รายวัน"];


			var gb_current_select_page_like_chart_type = "Bar";
			var gb_avilable_select_page_like_chart_type = ["Line", "Bar"];
			var gb_avilable_select_page_like_chart_type_icon = ["fa-line-chart", "fa-bar-chart"];


			var gb_current_select_data_type = "page_fan_adds_unique";
			var gb_avilable_select_data_type = ["page_fan_adds_unique", "page_fan_removes_unique", "page_impressions", "page_impressions_unique", "page_impressions_viral", "page_impressions_viral_unique", "page_post_engagements", "page_engaged_users", "page_consumptions", "page_consumptions_unique", "page_views_total"];
			var gb_avilable_select_data_type_desc = ["like", "Unlike", "Impressions Total", "Impressions", "Impressions Viral Total", "Impressions Viral", "Post Engagements Total", "Post Engagements", "Consumptions Total", "Consumptions", "Page View"];
			//var  gb_avilable_select_data_type_desc = ["กดถูกใจเพจรายใหม่", "เลิกถูกใจเพจ", "จำนวนครั้งที่เนื้อหาปรากฏบนฟีด", "จำนวนคนที่เนื้อหาปรากฏบนฟีด(สะสมรายวัน)", "จำนวนแสดงการมีปฏิสัมพันธ์ต่อเพจ", "จำนวนคนที่เห็นการมีปฏิสัมพันธ์ต่อเพจ", "จำนวนการมีส่วนร่วมในเพจ", "จำนวนคนที่มีส่วนร่วมในเพจ(สะสมรายวัน)", "เนื้อหาถูกคลิก", "จำนวนผู้คลิกเนื้อหา(สะสมรายวัน)", "ดูหน้าเพจ"];


			var gb_current_heatmap_data_type = "page_impressions_by_city_unique";
			var gb_avilable_heatmap_data_type = ["page_impressions_by_city_unique", "page_content_activity_by_city_unique"];
			var gb_avilable_heatmap_data_type_desc = ["Impressions", "Activity"];


			var gb_current_heatmap_data_type2 = "page_impressions_by_age_gender_unique";
			var gb_avilable_heatmap_data_type2 = ["page_impressions_by_age_gender_unique", "page_content_activity_by_age_gender_unique"];


			var heatmap_adjust_setting = 0;

			// Initial Setting component ============================================================

			// Moment Setting
			moment.locale('th');


			//Date range as a button
			$('#daterange-btn').daterangepicker({
					ranges: {
						//'วันนี้'       : [moment(), moment()],
						'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
						'30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
						'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
						'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
						'3 เดือนที่ผ่านมา': [moment().subtract(3, 'month'), moment()],
						'ปีนี้': [moment().startOf('year'), moment().endOf('year')]
					},
					startDate: moment().startOf('year'),
					endDate: moment().endOf('year')
				},
				function(start, end) {
					$('#daterange-btn span').html(start.format(' D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'))
					get_heatmap();
				}
			);
			$('#daterange-btn span').html($('#daterange-btn').data('daterangepicker').startDate.format(' D MMMM YYYY') + " - " + $('#daterange-btn').data('daterangepicker').endDate.format(' D MMMM YYYY'));


			//daterange_btn_export_data
			$('#daterange_btn_export_data').daterangepicker({
					ranges: {
						//'วันนี้'       : [moment(), moment()],
						'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'7 วันล่าสุด': [moment().subtract(6, 'days'), moment()],
						'30 วันล่าสุด': [moment().subtract(29, 'days'), moment()],
						'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
						'เดือนที่ผ่านมา': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
						'3 เดือนที่ผ่านมา': [moment().subtract(3, 'month'), moment()],
						'ปีนี้': [moment().startOf('year'), moment().endOf('year')]
					},
					startDate: moment().startOf('month'),
					endDate: moment().endOf('month')
				},
				function(start, end) {
					$('#daterange_btn_export_data span').html(start.format(' D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'))
					//get_heatmap();
				}
			);
			$('#daterange_btn_export_data span').html($('#daterange_btn_export_data').data('daterangepicker').startDate.format(' D MMMM YYYY') + " - " + $('#daterange_btn_export_data').data('daterangepicker').endDate.format(' D MMMM YYYY'));


			$('.slider').slider()



			//check_gen_fan_datepicker
			$('#check_gen_fan_datepicker').datepicker({
				autoclose: true,
				format: 'dd/mm/yyyy'
			}).on('changeDate', function(ev) {
				get_gen_fan_from_datepicker();
			});
			var today = new Date();
			yesterday = new Date(today);
			yesterday.setDate(today.getDate() - 1);

			$("#check_gen_fan_datepicker").datepicker("setDate", yesterday);
			$("#check_gen_fan_datepicker").datepicker("setEndDate", yesterday);
			// Page function ========================================= 

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
				add_data['staff_key_id'] = '<?php echo $staff_key_id; ?>';
				$.ajax({
					type: 'POST',
					dataType: "text",
					url: 'f_0_index.php',
					data: (add_data)
				});
			});

			function chart_like_count() {
				get_current_title_desc();
				var add_data = {}
				add_data['f'] = '1';
				//alert (gb_current_select_page_like_groupby);
				add_data['group_by_str'] = gb_current_select_page_like_groupby;
				add_data['selected_data_type'] = gb_current_select_data_type;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						if (typeof like_count_chart !== 'undefined') {
							like_count_chart.clear();
						}
						// Receive Data
						//alert (data);
						var ojb_chart_data = JSON.parse(data);

						var average_value = ojb_chart_data[0].avg_val;
						var average_value_text = ojb_chart_data[0].avg_val_text;
						// Initial Setting
						var like_chart_minPeriod_value = "DD";
						//var like_chart_fixedColumnWidth_value = 3;

						var categoryBalloonDateFormat_data = "DD MMMM YYYY";

						if (gb_current_select_page_like_groupby == "monthly") {
							like_chart_minPeriod_value = "MM";
							//like_chart_fixedColumnWidth_value = 75;
							categoryBalloonDateFormat_data = "MMMM";
						}

						if (gb_current_select_page_like_groupby == "weekly") {
							//like_chart_minPeriod_value = "W";
							like_chart_fixedColumnWidth_value = 20;
						}


						var like_count_chart;
						var graph;
						// SERIAL CHART
						var like_count_chart = new AmCharts.AmSerialChart();
						//alert (jQuery.type(ojb))
						like_count_chart.dataProvider = ojb_chart_data;
						//like_count_chart.marginLeft = 20;
						like_count_chart.categoryField = "data_date";
						like_count_chart.dataDateFormat = "YYYY-MM-DD";


						// listen for "dataUpdated" event (fired when chart is inited) and call zoomChart method when it happens
						//chart.addListener("dataUpdated", zoomChart_like_count);

						// AXES
						// category
						var categoryAxis = like_count_chart.categoryAxis;
						categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
						categoryAxis.minPeriod = like_chart_minPeriod_value; // our data is yearly, so we set minPeriod to YYYY
						categoryAxis.dashLength = 3;
						categoryAxis.minorGridEnabled = true;
						categoryAxis.minorGridAlpha = 0.1;

						// value
						var valueAxis = new AmCharts.ValueAxis();
						valueAxis.axisColor = "#DADADA";
						valueAxis.dashLength = 1;
						//valueAxis.logarithmic = true; // this line makes axis logarithmic
						like_count_chart.addValueAxis(valueAxis);

						// GUIDE for average
						var guide = new AmCharts.Guide();
						guide.value = average_value;
						guide.lineColor = "#CC0000";
						guide.dashLength = 2;
						guide.label = "เฉลี่ย " + average_value_text;
						guide.inside = true;
						guide.lineAlpha = 1;
						valueAxis.addGuide(guide);


						// GRAPH
						if (gb_current_select_page_like_chart_type == "Line") {
							var graph = new AmCharts.AmGraph();
							graph.type = "smoothedLine"; // this line makes the graph smoothed line.
							graph.lineColor = "#80aaff";
							graph.negativeLineColor = "#ff99bb"; // this line makes the graph to change color when it drops below 0
							graph.negativeBase = average_value;
							graph.lineThickness = 2;
							graph.valueField = "value";
							graph.animationPlayed = true;
							graph.balloonText = "[[category]]<br><b><span style='font-size:14px;';>[[value]]</span></b>";
							like_count_chart.addGraph(graph);


						}


						if (gb_current_select_page_like_chart_type == "Bar") {
							var graph = new AmCharts.AmGraph();
							graph.valueField = "value";
							graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>";
							graph.type = "column";
							if (gb_current_select_page_like_groupby == "monthly") {
								graph.labelText = "[[value]]";
								//like_chart_minPeriod_value = "MM";
								//like_chart_fixedColumnWidth_value = 75;
							}

							graph.lineAlpha = 0;
							graph.fillAlphas = 0.8;
							graph.lineColor = "#80aaff";
							//graph.fixedColumnWidth = like_chart_fixedColumnWidth_value;
							like_count_chart.addGraph(graph);
							// Animation
							like_count_chart.startEffect = "elastic";
							like_count_chart.startDuration = 1;
						}

						// SCROLLBAR
						var chartScrollbar = new AmCharts.ChartScrollbar();
						like_count_chart.addChartScrollbar(chartScrollbar);

						// CURSOR
						var chartCursor = new AmCharts.ChartCursor();
						chartCursor.cursorAlpha = 0;
						chartCursor.cursorPosition = "mouse";
						chartCursor.categoryBalloonDateFormat = categoryBalloonDateFormat_data;
						//chartCursor.categoryBalloonDateFormat = "DD MMMM YYYY";
						like_count_chart.addChartCursor(chartCursor);

						// Logo Position
						like_count_chart.creditsPosition = "top-left";




						// WRITE
						like_count_chart.write("chartdiv");




						// this method is called when chart is first inited as we listen for "dataUpdated" event
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function print_available_select_like_group_by_panel() {
				var print_text = "";
				$.each(gb_avilable_select_page_like_groupby, function(index, value) {
					if (value == gb_current_select_page_like_groupby) {
						print_text += '<div class="chip_selected" value="' + value + '"  >' + gb_avilable_select_page_like_groupby_desc[index] + '</div>';
					} else {
						print_text += '<div class="chip" value="' + value + '"  id="select_avilable_select_page_like_groupby">' + gb_avilable_select_page_like_groupby_desc[index] + '</div>';
					}
				});
				$("#available_select_like_group_by_panel").html(print_text);
			}

			$('body').on('click', '#select_avilable_select_page_like_groupby', function() {
				var target = ($(this).attr('value'));
				//alert (target);
				gb_current_select_page_like_groupby = target;
				print_available_select_like_group_by_panel();
				chart_like_count();

			});

			function print_avilable_select_page_like_chart_type() {
				var print_text = "";
				$.each(gb_avilable_select_page_like_chart_type, function(index, value) {
					if (value == gb_current_select_page_like_chart_type) {
						print_text += '<div class="chip_selected" value="' + value + '"  ><i class="fa ' + gb_avilable_select_page_like_chart_type_icon[index] + '"></i></div>';
					} else {
						print_text += '<div class="chip" value="' + value + '"  id="select_select_like_chart_type"><i class="fa ' + gb_avilable_select_page_like_chart_type_icon[index] + '"></i></div>';
					}
				});
				$("#available_select_like_chart_type_panel").html(print_text);
			}


			$('body').on('click', '#select_select_like_chart_type', function() {
				var target = ($(this).attr('value'));
				//alert (target);
				gb_current_select_page_like_chart_type = target;
				print_avilable_select_page_like_chart_type();
				chart_like_count();

			});


			function print_avilable_data_type() {
				var print_text = "";
				$.each(gb_avilable_select_data_type, function(index, value) {
					if (value == gb_current_select_data_type) {
						print_text += '<div class="chip_hdr_selected" value="' + value + '"  >' + gb_avilable_select_data_type_desc[index] + '</div> ';
						$("#current_data_title").html(gb_avilable_select_data_type_desc[index]);
					} else {
						print_text += '<div class="chip_hdr" value="' + value + '"  id="select_data_type">' + gb_avilable_select_data_type_desc[index] + '</div> ';
					}
				});
				$("#available_select_like_chart_data_panel").html(print_text);

			}

			$('body').on('click', '#select_data_type', function() {
				var target = ($(this).attr('value'));
				//alert (target);
				gb_current_select_data_type = target;
				get_data_max_min_avg();
				print_avilable_data_type();
				chart_like_count();

			});


			function get_current_title_desc() {
				var add_data = {}
				add_data['f'] = '2';
				add_data['data_type'] = gb_current_select_data_type;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//data = data.replace(search_target,'<font color="red">'+search_target+'</font>');
						//alert (data)
						$("#current_data_title_desc").html(data);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_data_max_min_avg() {
				var add_data = {}
				add_data['f'] = '3';
				add_data['data_type'] = gb_current_select_data_type;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var ojb = JSON.parse(data);

						$("#data_max_value").html(ojb.value_max);
						$("#data_max_date").html(ojb.date_max);
						$("#data_max_pct").html(ojb.pct_max);

						$("#data_min_value").html(ojb.value_min);
						$("#data_min_date").html(ojb.date_min);
						$("#data_min_pct").html(ojb.pct_min);

						$("#data_avg_value").html(ojb.avg);


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_heatmap() {
				var start_date = $('#daterange-btn').data('daterangepicker').startDate.format(' YYYY-MM-DD');
				var end_date = $('#daterange-btn').data('daterangepicker').endDate.format(' YYYY-MM-DD');
				var div_value = $("#heat_map_adjust_value").val();
				var rad = $("#heat_map_adjust_rad").val();

				//alert (div_value+ rad);

				var add_data = {}
				add_data['f'] = '4';
				add_data['start_date'] = start_date;
				add_data['div_value'] = div_value;
				add_data['end_date'] = end_date;
				add_data['data_type'] = gb_current_heatmap_data_type;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						var data = JSON.parse(data);
						var data_geo = [];
						jQuery.each(data, function(i, val) {
							if (heatmap_adjust_setting == 0) {
								data_geo.push({
									location: new google.maps.LatLng(data[i]['lat'], data[i]['lon']),
									weight: Math.floor(data[i]['value'])
								});
							} else {

								data_geo.push({
									location: new google.maps.LatLng(data[i]['lat'], data[i]['lon']),
									weight: Math.floor(data[i]['value_kai'])
								});
							}
						});
						heatmap.set('data', heatmap.get('data') ? null : data_geo);
						heatmap = new google.maps.visualization.HeatmapLayer({
							data: data_geo,
							map: map
						});
						heatmap.set('radius', heatmap.get('radius') ? null : rad);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//adjust_heatmap_btn
			// adjust_heatmap_btn
			$("#adjust_heatmap_btn").click(function() {
				if (heatmap_adjust_setting == 0) {
					heatmap_adjust_setting = 1;
				} else {
					$("#heat_map_adjust_rad").val("30");
					$("#heat_map_adjust_value").val("6");
					heatmap_adjust_setting = 0;
					get_heatmap();
				}
				$("#detail_heatmap_adjust_form").toggle('fast');

			});

			$("#heat_map_adjust_rad").change(function() {
				var rad = $("#heat_map_adjust_rad").val();
				//$("#temp_res").html(rad)
				heatmap.set('radius', heatmap.get('radius') ? null : rad);
			});


			//btn_get_res_adjust
			$("#btn_get_res_adjust").click(function() {
				get_heatmap();
			});

			function print_available_select_heatmap_type() {
				var print_text = "";
				$.each(gb_avilable_heatmap_data_type, function(index, value) {
					if (value == gb_current_heatmap_data_type) {
						print_text += '<div class="chip_hdr_selected" value="' + value + '"  >' + gb_avilable_heatmap_data_type_desc[index] + '</div> ';
						$("#heatmap_data_type_title").html(gb_avilable_heatmap_data_type_desc[index]);
						gb_current_heatmap_data_type2 = gb_avilable_heatmap_data_type2[index];
						//alert (gb_current_heatmap_data_type2);
						get_gen_fan_from_datepicker();
					} else {
						print_text += '<div class="chip_hdr" value="' + value + '"  id="select_heapmap_data_type">' + gb_avilable_heatmap_data_type_desc[index] + '</div> ';
					}
				});
				$("#available_select_heatmap_type_panel").html(print_text);
			}

			$('body').on('click', '#select_heapmap_data_type', function() {
				var target = ($(this).attr('value'));
				//alert (target);
				gb_current_heatmap_data_type = target;
				print_available_select_heatmap_type();
				get_heatmap();
			});


			function get_gen_fan_from_datepicker() {
				target_date = $("#check_gen_fan_datepicker").val();
				//alert (target_date);
				dt = target_date.split('/');
				var target = dt[2] + '-' + dt[1] + '-' + dt[0];
				//alert (target);

				var add_data = {}
				add_data['f'] = '5';
				add_data['target'] = target;
				add_data['data_type'] = gb_current_heatmap_data_type2;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})

					.done(function(data) {
						var ojb = JSON.parse(data);
						//alert (data);
						try {
							window.fan_gen_chart.destroy();
						} catch (err) {
							// DO NOTTING;
						}
						var date_fan_chart = [];
						var fan_cnt = [];

						$.each(ojb, function(key, data) {
							if (data.sub_name.indexOf("U")) {
								date_fan_chart.push(data.sub_name.replace('M.', 'ชาย ').replace('F.', 'หญิง '));
								fan_cnt.push(data.value);
							}

						});

						// Create Table
						var print_text = '<Table  class="table table-condensed">';
						$.each(date_fan_chart, function(index, value) {
							print_text += "<TR>";
							print_text += "<TD><B>" + value + "</B></TD>";
							print_text += "<TD>" + parseInt(fan_cnt[index]).toLocaleString(); + "</TD>";
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
							}]
						};
						var ctx = document.getElementById('fan_gen_chart').getContext('2d');
						window.fan_gen_chart = new Chart(ctx, {
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
											display: false
										}
									}],
									xAxes: [{
										gridLines: {
											display: false
										}
									}]
								}
							}
						});


					})
					.fail(function() {
						alert("Posting failed.");
					});
			}

			//export_to_excel_btn
			$("#export_to_excel_btn").click(function() {
				$("#download_excel_result").html('<button type="button" class="btn btn-primary pull-right" id="btn_create_excel"><i class="fa fa-file-excel-o"></i> Create Excel</button>');
				$('#modal_export_data').modal('show');
			});

			//btn_create_excel
			//$("#btn_create_excel").click(function() {
			$('body').on('click', '#btn_create_excel', function() {
				$("#download_excel_result").html('<font size="14"><i class="fa fa-refresh fa-spin pull-right"></i></font>');
				var start_date = $('#daterange_btn_export_data').data('daterangepicker').startDate.format(' YYYY-MM-DD');
				var end_date = $('#daterange_btn_export_data').data('daterangepicker').endDate.format(' YYYY-MM-DD');

				var add_data = {}
				add_data['f'] = '14';
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

			function get_like_count_chart() {
				var add_data = {}
				add_data['f'] = '17';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var ojb_chart_data = JSON.parse(data);
						var like_chart_minPeriod_value = "DD";

						post_static_chart = new AmCharts.AmSerialChart();
						post_static_chart.dataProvider = ojb_chart_data;
						post_static_chart.marginLeft = 10;
						post_static_chart.dataDateFormat = "YYYY-MM-DD";
						post_static_chart.categoryField = "data_date";

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
						graph.valueField = "value";
						graph.balloonText = "เพิ่มขึ้น : <b><span style='font-size:14px;'>[[value]]</span></b>";
						graph.fillColors = "#003f5c";
						graph.type = "column";
						graph.animationPlayed = true;
						graph.lineAlpha = 0;
						graph.fillAlphas = 0.5;

						// GRAPH
						graph2 = new AmCharts.AmGraph();
						graph2.valueAxis = valueAxis2; // we have to indicate which value axis should be used
						graph2.type = "line"; // this line makes the graph smoothed line.
						//graph2.type = "smoothedLine"; // this line makes the graph smoothed line.
						graph2.lineColor = "#d1655d";
						graph2.lineThickness = 2;
						graph2.animationPlayed = true;
						graph2.valueField = "like_cnt";
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
						chartCursor.categoryBalloonDateFormat = "DD MMM";
						post_static_chart.addChartCursor(chartCursor);


						// WRITE
						post_static_chart.write("chart_div_page_like");

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_follow_count_chart() {
				var add_data = {}
				add_data['f'] = '18';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var ojb_chart_data = JSON.parse(data);
						var like_chart_minPeriod_value = "DD";

						post_static_chart = new AmCharts.AmSerialChart();
						post_static_chart.dataProvider = ojb_chart_data;
						post_static_chart.marginLeft = 10;
						post_static_chart.dataDateFormat = "YYYY-MM-DD";
						post_static_chart.categoryField = "data_date";

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
						graph.valueField = "value";
						graph.balloonText = "เพิ่มขึ้น : <b><span style='font-size:14px;'>[[value]]</span></b>";
						graph.fillColors = "#ffa600";
						graph.type = "column";
						graph.animationPlayed = true;
						graph.lineAlpha = 0;
						graph.fillAlphas = 0.5;

						// GRAPH
						graph2 = new AmCharts.AmGraph();
						graph2.valueAxis = valueAxis2; // we have to indicate which value axis should be used
						graph2.type = "line"; // this line makes the graph smoothed line.
						//graph2.type = "smoothedLine"; // this line makes the graph smoothed line.
						graph2.lineColor = "#d1655d";
						graph2.lineThickness = 2;
						graph2.animationPlayed = true;
						graph2.valueField = "cnt";
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
						chartCursor.categoryBalloonDateFormat = "DD MMM";
						post_static_chart.addChartCursor(chartCursor);


						// WRITE
						post_static_chart.write("chart_div_page_follow");

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//btn_go_line
			$('body').on('click', '#btn_go_line', function() {
				window.location.replace('44_Line_static.php');
			});


			// Initial Run ========================================= 
			chart_like_count();
			print_available_select_like_group_by_panel();
			print_avilable_select_page_like_chart_type();
			print_avilable_data_type();
			print_available_select_heatmap_type();

			get_data_max_min_avg();

			get_heatmap();

			get_like_count_chart();
			get_follow_count_chart();












		});
	</script>
	<script>
		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 6,
				streetViewControl: false,
				center: {
					lat: 14,
					lng: 101
				},
				mapTypeId: 'roadmap',
				mapTypeControl: false,
				styles: [{
						"featureType": "administrative.country",
						"elementType": "geometry.stroke",
						"stylers": [{
							"weight": 2
						}]
					},
					{
						"featureType": "administrative.country",
						"elementType": "labels",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "administrative.province",
						"elementType": "geometry.stroke",
						"stylers": [{
							"weight": 1
						}]
					},
					{
						"featureType": "administrative.province",
						"elementType": "labels.text.fill",
						"stylers": [{
							"color": "#7c7c7c"
						}]
					},
					{
						"featureType": "landscape.natural",
						"elementType": "geometry.fill",
						"stylers": [{
							"color": "#ffffff"
						}]
					},
					{
						"featureType": "landscape.natural.terrain",
						"elementType": "geometry",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "poi",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "poi.business",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "poi.park",
						"elementType": "labels.text",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "road",
						"stylers": [{
							"visibility": "off"
						}]
					},
					{
						"featureType": "transit",
						"stylers": [{
							"visibility": "off"
						}]
					}
				]
			});

			heatmap = new google.maps.visualization.HeatmapLayer({
				map: map
			});
		}
	</script>
</body>

</html>
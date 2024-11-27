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
	<title>Watch_Dog | Case static</title>

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

	<link type="text/css" href="plugins/amcharts/plugins/export/export.css" rel="stylesheet">



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
		.sum_table_value:hover {
			cursor: pointer;
		}

		.crp_table_name:hover {
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
					Case static
					<small>สถิติการตรวจสอบทุจริต</small>
				</h1>
				<select class="breadcrumb" id="select_year_case">
				</select>
			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-4">
								<div class="info-box bg-blue">
									<span class="info-box-icon"><i class="fa fa-sign-out"></i></span>

									<div class="info-box-content">
										<span class="info-box-text"><b>เคสที่รับเข้าปีนี้</b></span>
										<span class="info-box-number" id="m_income_case"></span>

									</div>
									<!-- /.info-box-content -->
								</div>
							</div>
							<!-- ./col -->

							<div class="col-md-4">
								<div class="info-box bg-green">
									<span class="info-box-icon"><i class="fa fa-facebook-square"></i></span>

									<div class="info-box-content">
										<span class="info-box-text"><b>เคสที่ลงเพจ</b></span>
										<span class="info-box-number" id="m_pub_case"></span>

									</div>
									<!-- /.info-box-content -->
								</div>
							</div>
							<!-- ./col -->

							<div class="col-md-4">
								<div class="info-box bg-orange">
									<span class="info-box-icon"><i class="fa fa-get-pocket"></i></span>

									<div class="info-box-content">
										<span class="info-box-text"><b>ความเสียหายที่ตรวจสอบ</b></span>
										<span class="info-box-number"><span id="this_year_pub_ofd" class='number_cnt_target'></span><small> ล้านบาท</small></span>
										<span class="progress-description">
											<span id="this_year_pub_ofd_cannot_estm"></span> เคสที่ประเมินความเสียหายไม่ได้
										</span>
									</div>
									<!-- /.info-box-content -->
								</div>
							</div>
							<!-- ./col -->

						</div>

						<div class="box box-danger  box-solid">
							<div class="box-header with-border">
								<h3 class="box-title"><B>สรุปรายปี</B> </h3>


								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" id="export_case_data"><i class="fa fa-file-excel-o"></i> Export Data
									</button>
								</div>
							</div>
							<div class="box-body">
								<div class="col-sm-12" style="overflow:auto;height:400px;">
									<table class="table table-condensed" style="width:2000px">
										<thead>
											<TR>
												<TH rowspan="2" style="text-align:center;">เดือน</TH>
												<TH colspan="3" style="text-align:center;background-color:#e6ffff;">สรุปเคส</TH>
												<TH colspan="5" style="text-align:center;background-color:#ffe6e6;">สรุปโพส</TH>
												<TH colspan="7" style="text-align:center;background-color:#ffffe6;">สถิติ</TH>
												<TH colspan="3" style="text-align:center;background-color:#e6ffe6;">Inbox</TH>
											</TR>
											<TR>

												<TH style="text-align:center;background-color:#e6ffff;">เคสเข้าใหม่</TH>
												<TH style="text-align:center;background-color:#e6ffff;">ยุติ</TH>
												<TH style="text-align:center;background-color:#e6ffff;">คงค้าง</TH>
												<TH style="text-align:center;background-color:#ffe6e6;">โพสทั้งหมด</TH>
												<TH style="text-align:center;background-color:#ffe6e6;">โพสเคสใหม่</TH>
												<TH style="text-align:center;background-color:#ffe6e6;">โพสเคสUpdate</TH>
												<TH style="text-align:center;background-color:#ffe6e6;">โพส EP</TH>
												<TH style="text-align:center;background-color:#ffe6e6;">โพสอื่นๆ</TH>
												<TH style="text-align:center;background-color:#ffffe6;">ยอด Like</TH>
												<TH style="text-align:center;background-color:#ffffe6;">ยอด Follow</TH>
												<TH style="text-align:center;background-color:#ffffe6;">Reach</TH>
												<TH style="text-align:center;background-color:#ffffe6;">Reach User</TH>
												<TH style="text-align:center;background-color:#ffffe6;">Engagements</TH>
												<TH style="text-align:center;background-color:#ffffe6;">Engagement User</TH>
												<TH style="text-align:center;background-color:#ffffe6;">Ratio</TH>
												<TH style="text-align:center;background-color:#e6ffe6;">Inboxทั้งหมด</TH>
												<TH style="text-align:center;background-color:#e6ffe6;">มีประโยชน์</TH>
												<TH style="text-align:center;background-color:#e6ffe6;">ความเร็วในการตอบ</TH>
											</TR>

										</thead>
										<tbody id="table_case_summary_2">
										</tbody>
										<TR style="background-color:#eee;">
											<TH>เป้าหมาย</TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_Follow"></span></TH>
											<TH></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_Reach"></span></TH>
											<TH></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_Engagements"></span></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_R_E_Ratio"></span> %</TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_Inbox"></span></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_Inbox_qly"></span></TH>
											<TH style="font-weight: 300;text-align:center;"><span id="tr_IB_res"></span> น.</TH>
										</TR>
									</table>
								</div>
							</div>
						</div>

						<div class="box box-primary  box-solid">
							<div class="box-header with-border">
								<h3 class="box-title"><B>การรับเคสเข้ารายเดือน</B></h3>
							</div>
							<div class="box-body">
								<div id="main_chartdiv" style="height: 400px;"></div>
							</div>
						</div>

						<div class="box box-success  box-solid">
							<div class="box-header with-border">
								<h3 class="box-title"><B>สรุปเคสรายเดือน</B></h3>
							</div>
							<div class="box-body">
								<div class="col-sm-8">
									<table class="table table-condensed">
										<thead>
											<TR>
												<TH>เดือน</TH>
												<TH>ยกยอดมา</TH>
												<TH>เข้าใหม่</TH>
												<TH>ยุติ</TH>
												<TH>ลงเพจ</TH>
												<TH>คงค้าง</TH>
											</TR>
										</thead>
										<tbody id="table_case_summary">
										</tbody>
									</table>
								</div>
								<div class="col-sm-4">
									<h4 id="hdr_val_text"></h4>
									<div class="col-sm-12" style="overflow:auto;height:300px;">
										<ul class="products-list product-list-in-box" id="summary_case_detail">

										</ul>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-4">
						<div class="box box-danger  box-solid">
							<div class="box-header with-border">
								<h3 class="box-title"><B>ประเภทการทุจริต</B></h3>
							</div>
							<div class="box-body">
								<table class="table table-condensed">
									<thead>
										<TR>
											<TH>ประเภท</TH>
											<TH>ทำข้อมูล</TH>
											<TH>ยุติ</TH>
											<TH>ลงเพจ</TH>
											<TH>รวม</TH>
										</TR>
									</thead>
									<tbody id="table_case_by_crp_type">
									</tbody>
								</table>



								<div id="hide_case_list_by_type_panel" style="display: none;">
									<Hr>
									<h4 id="hdr_type_text"></h4>
									<div class="col-sm-12" style="overflow:auto;height:450px;">
										<ul class="products-list product-list-in-box" id="case_by_type_list_panel">

										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box  box-danger">
							<div class="box-header">
								<h3 class="box-title"><B id="map_name"></B></h3>
								<div class="form-group  pull-right">
									<label>
										<input type="checkbox" class="flat-red" id="only_pub_check">
										เฉพาะที่ลงเพจ
									</label>
								</div>

							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div id="chart_div" style="height: 1000px;"></div>
							</div>
							<div class="overlay" id="load_active_map">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
							<!-- Loading (remove the following to stop the loading)-->

							<!-- end loading -->
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
				</div>

				<!-- MODAL -->
				<div class="modal fade" id="Select_export_data_modal">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ดึงข้อมูลสรุปเคส</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<form class="form-horizontal" id="f8_1">
										<div class="box-body">

											<div class="form-group">
												<label for="c_n_status" class="col-sm-3 control-label">ข้อมูลปี</label>
												<div class="col-sm-2">
													<select class="form-control" id="ex_year">
													</select>
												</div>
											</div>

											<div class="form-group">
												<label for="c_n_status" class="col-sm-3 control-label">เดือน</label>
												<div class="col-sm-3">
													<select class="form-control" id="ex_mn_st">
													</select>
												</div>
												<label for="c_n_status" class="col-sm-1 control-label">-</label>
												<div class="col-sm-3">
													<select class="form-control" id="ex_mn_en">
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="c_n_status" class="col-sm-3 control-label"></label>
												<div class="col-sm-3">
													<span id="report_export_result"></span>
												</div>
											</div>
											


										</div>
										<!-- /.box-body -->
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_export_data">Export Data</button>
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
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- Amcharts  JS-->
	<script src="plugins/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="plugins/amcharts/serial.js" type="text/javascript"></script>
	<script type="text/javascript" src="plugins/amcharts/plugins/export/export.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="plugins/iCheck/icheck.min.js"></script>
	<!-- Animate_number -->
	<script src="plugins/animate_number/jquery.animateNumber.min.js"></script>

	<!-- Google Heatmap-->
	<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>


	<script src="bower_components/moment/min/moment-with-locales.js"></script>


	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================
			var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')

			//Flat red color scheme for iCheck
			$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass: 'iradio_flat-green'
			})

			var map_pub_check_value = 0;

			// Set Moment 
			moment.locale('th');

			// Page function ========================================= 

			function addCommas(nStr) {
				nStr += '';
				x = nStr.split('.');
				x1 = x[0];
				x2 = x.length > 1 ? '.' + x[1] : '';
				var rgx = /(\d+)(\d{3})/;
				while (rgx.test(x1)) {
					x1 = x1.replace(rgx, '$1' + ',' + '$2');
				}
				return x1 + x2;
			}

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


			function get_monthly_graph_data() {
				var add_data = {}
				add_data['f'] = '12';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//data = data.replace(search_target,'<font color="red">'+search_target+'</font>');
						//alert (data)
						var ojb_chart_data = JSON.parse(data);
						var chart;
						// SERIAL CHART
						main_chart = new AmCharts.AmSerialChart();
						main_chart.dataProvider = ojb_chart_data;
						main_chart.categoryField = "cat_str";
						main_chart.plotAreaBorderAlpha = 0.2;

						// AXES
						// category
						var categoryAxis = main_chart.categoryAxis;
						categoryAxis.gridAlpha = 0.1;
						categoryAxis.axisAlpha = 0;
						categoryAxis.gridPosition = "start";

						// value
						var valueAxis = new AmCharts.ValueAxis();
						valueAxis.stackType = "regular";
						valueAxis.gridAlpha = 0.1;
						valueAxis.axisAlpha = 0;
						main_chart.addValueAxis(valueAxis);

						var color_aug = ['#029fd4', '#4596e5', '#8586e8', '#be6fd6', '#e951b0', '#ff377a', '#ff3d3d', '#5cff96'];
						// GRAPHS
						// first graph
						var graph = new AmCharts.AmGraph();
						graph.title = "เรื่องใหม่";
						graph.labelText = "[[value]]";
						graph.valueField = "s_0";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[0];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// second graph
						graph = new AmCharts.AmGraph();
						graph.title = "ทำข้อมูล";
						graph.labelText = "[[value]]";
						graph.valueField = "s_1";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[1];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// third graph
						graph = new AmCharts.AmGraph();
						graph.title = "รอข้อมูล";
						graph.labelText = "[[value]]";
						graph.valueField = "s_2";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[2];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// fourth graph
						graph = new AmCharts.AmGraph();
						graph.title = "ชะลอ";
						graph.labelText = "[[value]]";
						graph.valueField = "s_3";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[3];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// fifth graph
						graph = new AmCharts.AmGraph();
						graph.title = "รอตรวจต้นฉบับ";
						graph.labelText = "[[value]]";
						graph.valueField = "s_7";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[4];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span style='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// sixth graph
						graph = new AmCharts.AmGraph();
						graph.title = "สรุปข้อมูล";
						graph.labelText = "[[value]]";
						graph.valueField = "s_6";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[5];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span class='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// sixth graph
						graph = new AmCharts.AmGraph();
						graph.title = "ลงเพจ";
						graph.labelText = "[[value]]";
						graph.valueField = "s_5";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[7];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span class='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// sixth graph
						graph = new AmCharts.AmGraph();
						graph.title = "ยุติ";
						graph.labelText = "[[value]]";
						graph.valueField = "s_4";
						graph.type = "column";
						graph.lineAlpha = 0;
						graph.fillAlphas = 1;
						graph.lineColor = color_aug[6];
						graph.balloonText = "<span style='color:#555555;'>[[category]]</span><br><span class='font-size:14px'>[[title]]:<b>[[value]]</b></span>";
						main_chart.addGraph(graph);

						// LEGEND
						var legend = new AmCharts.AmLegend();
						legend.borderAlpha = 0.2;
						legend.horizontalGap = 10;
						main_chart.addLegend(legend);


						// WRITE
						main_chart.write("main_chartdiv");


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_table_by_crp_type() {
				var add_data = {}
				add_data['f'] = '13';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//table_case_by_crp_type
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += "<TR>";
							print_text += "<TD class='crp_table_name' value='" + val.crp_id + "' hdr_val='" + val.crp_type + "'><B>" + val.crp_real_name + "</B></TD>";
							print_text += "<TD><font color='#0D52D1'><span class='number_cnt_target' value='" + val.pending + "'>" + val.pending + "</span></font></TD>";
							print_text += "<TD><font color='#f56954'> <span class='number_cnt_target value='" + val.stop_case + "'>" + val.stop_case + "</span></font></TD>";
							print_text += "<TD><font color='#00a65a'> <span class='number_cnt_target' value='" + val.on_page + "'>" + val.on_page + "</span></font></TD>";
							print_text += "<TD><B><span class='number_cnt_target' value='" + val.count_case + "'>" + val.count_case + "</span></B></TD>";
							print_text += "</TR>";
						});
						$("#table_case_by_crp_type").html(print_text);
						animate_count_value();
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function animate_count_value() {
				$('body span.number_cnt_target').each(function(i, obj) {
					var target = ($(this).attr('value'));
					//alert (target)
					$(this).animateNumber({
						number: target,
						numberStep: comma_separator_number_step
					});
				});
			}

			function get_table_case_summary() {
				var add_data = {}
				add_data['f'] = '15';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						var _year = "2018";
						var _month = "0";

						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += "<TR>";
							print_text += "<TD><B>" + val.print_month + "</B></TD>";
							print_text += "<TD><font color='#000000'><span>" + val.bg + "</span></font></TD>";
							print_text += "<TD class='sum_table_value'  year='" + val.year + "' month='" + val.month + "' type='new' print_type='" + val.print_month + "' hdr_val='เคสเข้าใหม่ " + val.print_month + "'><font color='#0D52D1'> <span>" + val.new + "</span></font></TD>";
							print_text += "<TD class='sum_table_value'  year='" + val.year + "' month='" + val.month + "' type='stop' print_type='" + val.print_month + "' hdr_val='เคสยุติ " + val.print_month + "'><font color='#f56954'> <span>" + val.stop + "</span></font></TD>";
							print_text += "<TD class='sum_table_value' year='" + val.year + "' month='" + val.month + "' type='pub' print_type='" + val.print_month + "' hdr_val='เคสลงเพจ " + val.print_month + "'><font color='#00a65a'> <span>" + val.pub + "</span></font></TD>";
							print_text += "<TD><B><span>" + val.ending + "</span></B></TD>";
							print_text += "</TR>";
							_year = val.year;
							_month = val.month;
							_printm = val.print_month;
						});
						startup_summary_case_detail("เคสลงเพจ " + _printm, _year, _month, "pub")
						$("#table_case_summary").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//export_to_excel_btn_prov
			$('body').on('click', '.sum_table_value', function() {
				var hdr_val = ($(this).attr('hdr_val'));
				$("#hdr_val_text").html(hdr_val);

				startup_summary_case_detail(hdr_val, $(this).attr('year'), $(this).attr('month'), $(this).attr('type'))
			});

			function startup_summary_case_detail(hdr_val, year, month, type) {
				$("#hdr_val_text").html(hdr_val);

				//hdr_val
				//alert (target);
				var add_data = {}
				add_data['f'] = '16';
				add_data['year'] = year;
				add_data['month'] = month;
				add_data['type'] = type;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						//alert (data)
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
									text_color = "label-success";
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
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							print_text += '<img src="' + val.img + '" alt="Product Image">';
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							if (val.ep != "0") {
								print_text += '<a href="14_case_data.php?case_id=' + val.case_id + '" class="product-title" target="_blank">' + val.print_case_id + " : " + val.ep + " EP";
							} else {
								print_text += '<a href="14_case_data.php?case_id=' + val.case_id + '" class="product-title" target="_blank">' + val.print_case_id;
							}
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span></a>';
							print_text += '<span class="product-description">';
							print_text += val.topic;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#summary_case_detail").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			}



			//crp_table_name
			$('body').on('click', '.crp_table_name', function() {

				//var target = ($(this).attr('value'));
				var target = ($(this).attr('hdr_val'));
				$("#hdr_type_text").html($(this).attr('hdr_val'));

				$("#hide_case_list_by_type_panel").show("fast");

				var add_data = {}
				add_data['f'] = '19';
				add_data['case_type'] = target;
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data);
						var data_arr = JSON.parse(data);
						//alert (data)
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
									text_color = "label-success";
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
							print_text += '<li class="item">';
							print_text += '<div class="product-img">';
							print_text += '<img src="' + val.img + '" alt="Product Image">';
							print_text += '</div>';
							print_text += ' <div class="product-info">';
							print_text += '<a href="14_case_data.php?case_id=' + val.case_id + '" class="product-title" target="_blank">' + val.print_case_id;
							print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span></a>';
							print_text += '<span class="product-description">';
							print_text += val.topic;
							print_text += '</span>';
							print_text += '</div>';
							print_text += '</li>';

						});
						$("#case_by_type_list_panel").html(print_text);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


			function get_main_static() {
				var add_data = {}
				add_data['f'] = '20';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						$("#m_income_case").html(data_arr.this_year_income_case);
						$("#m_pub_case").html(data_arr.this_year_pub_case);
						//$("#pubcase_pct_text").html(data_arr.pub_post_target_pct);
						//$("#pubcase_pct").html('<div class="progress-bar" style="width: '+data_arr.pub_post_target_pct+'%"></div>');
						$("#this_year_pub_ofd").html(data_arr.this_year_pub_ofd);
						$("#this_year_pub_ofd_cannot_estm").html(data_arr.this_year_pub_ofd_cannot_estm);

						// alert(data_arr.pub_post_target_pct)

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function get_year_data() {
				var add_data = {}
				add_data['f'] = '29';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						var _flg_year_select = 0;
						jQuery.each(data_arr, function(i, val) {
							if (_flg_year_select == 0) {
								print_text += "<option value ='" + val.YR + "' selected>" + val.YR + "</option>";
							} else {
								print_text += "<option value ='" + val.YR + "'>" + val.YR + "</option>";
							}
							_flg_year_select = 1;
						});
						//select_year_case
						$("#select_year_case").html(print_text);

						load_page_data();


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}




			$("#select_year_case").change(function() {
				load_page_data();
			});


			function get_table_case_summary_2() {
				$("#table_case_summary_2").html('<tr><td colspan=10><i class="fa fa-refresh fa-spin"></i> Loading...</td></tr>');

				var add_data = {}
				add_data['f'] = '31';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						//console.log(data_arr)
						print_text = "";
						//alert("aa")
						jQuery.each(data_arr, function(i, val) {
							print_text += "<TR>";
							//moment(val.pub_time, "YYYY-MM-DD hh:mm:ss")
							print_text += "<TD><B>" + moment(val.ym, "YYYYMM").format('MMM YY'); + "</B></TD>";
							print_text += "<TD style='text-align:center;background-color:#e6ffff;'>" + val.NEW_CASE + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#e6ffff;'>" + val.STOP_CASE + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#e6ffff;'>" + val.PENDING_CASE + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffe6e6;'>" + val.total_post + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffe6e6;'>" + val.COUNT_POST_NEW_CASE + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffe6e6;'>" + val.COUNT_UPDATE_CASE + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffe6e6;'>" + val.COUNT_EP + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffe6e6;'>" + val.COUNT_OTHER_POST + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.LIKE_COUNT) + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.FOLLOW_CNT) + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.Impressions) + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.Impressions_Person) + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.Engagements) + "</TD>";
							print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(val.Engagements_person) + "</TD>";
							if (val.Impressions_Person != "0") {
								print_text += "<TD style='text-align:center;background-color:#ffffe6;'>" + addCommas(((val.Engagements_person / val.Impressions_Person) * 100).toFixed(2)) + " % </TD>";
							} else {
								print_text += "<TD style='text-align:center;background-color:#ffffe6;'> - </TD>";
							}
							if (val.ym >= "201910") {
								print_text += "<TD style='text-align:center;background-color:#e6ffe6;'>" + addCommas(val.CNT_TOTAL_IB) + "</TD>";
								//print_text += "<TD style='text-align:center'>"+addCommas(val.QTY_INBOX)+"</TD>";
								print_text += "<TD style='text-align:center;background-color:#e6ffe6;'>" + addCommas(val.GIBCNT) + "</TD>";
							} else {
								print_text += "<TD style='text-align:center;background-color:#e6ffe6;'>" + addCommas(val.CNT_TOTAL_IB) + "</TD>";
								print_text += "<TD style='text-align:center;background-color:#e6ffe6;'> - </TD>";
							}

							print_text += "<TD style='text-align:center;background-color:#e6ffe6;'>" + addCommas(val.RES_IB) + " น.</TD>";
							print_text += "</TR>";
						});

						$("#table_case_summary_2").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			function load_yearly_target() {
				var add_data = {}
				add_data['f'] = '56';
				add_data['tr_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_3_staff.php',
						data: (add_data)
					})
					.done(function(data) {
						var data_arr = JSON.parse(data);
						//print_text = "";
						//alert("aa")
						jQuery.each(data_arr, function(i, val) {
							$("#tr_" + val.target_type).html(addCommas(val.target));
						});
					});
			}


			function load_page_data() {
				//alert ($("#select_year_case").val())
				get_monthly_graph_data();
				get_table_by_crp_type();
				get_main_static();
				get_table_case_summary();
				get_table_case_summary_2();
				google.charts.setOnLoadCallback(drawMarkersMap_Province);
				load_yearly_target();

			}


			//only_pending_check
			$('#only_pub_check').on('ifChecked', function(event) {
				google.charts.setOnLoadCallback(drawMarkersMap_Province);
			});
			$('#only_pub_check').on('ifUnchecked', function(event) {
				google.charts.setOnLoadCallback(drawMarkersMap_Province);
			});


			function drawMarkersMap_Province() {
				$("#map_name").html("เคสที่ตรวจสอบ ปี " + $("#select_year_case").val());

				if ($("#only_pub_check").prop('checked') == true) {
					map_pub_check_value = 1;
				} else {
					map_pub_check_value = 0;
				}


				var add_data = {}
				add_data['f'] = '30';
				add_data['select_year'] = $("#select_year_case").val();
				add_data['map_pub_check_value'] = map_pub_check_value;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data = JSON.parse(data);
						var data_geo = [
							['CITY', 'จำนวน']
						];
						jQuery.each(data, function(i, val) {
							var _temp = [];
							_temp.push(val.PROVINCE_NAME, parseInt(val.cnt));
							data_geo.push(_temp);
						});
						var data_map = google.visualization.arrayToDataTable(data_geo);
						var options = {
							region: 'TH',
							resolution: 'provinces',
							colorAxis: {
								colors: ['#FFFFFF', '#AD1231']
							}
						};

						var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
						chart.draw(data_map, options);
						google.visualization.events.addListener(chart, 'select', function myClickHandler() {
							var selection = chart.getSelection();
							var message = '';
							for (var i = 0; i < selection.length; i++) {
								var item = selection[i];
								if (item.row != null && item.column != null) {
									message += '{row:' + item.row + ',column:' + item.column + '}';
								} else if (item.row != null) {
									message += item.row;
								} else if (item.column != null) {
									message += '{column:' + item.column + '}';
								}
							}
							if (message == '') {
								message = 'nothing';
							}
							//alert('You selected ' + message);
							//console.log(data_geo[parseInt(message) + 1][0]);

						});
						$("#load_active_map").hide();


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			};


			function get_year_data_2() {
				//var now = Date.now();
				var d = new Date();
				var n_year = d.getFullYear();
				//alert(n_year)
				var _flg_year_select = 0;
				var print_text = "";
				while (true) {
					if (_flg_year_select == 0) {
						print_text += "<option value ='" + n_year + "' selected>" + n_year + "</option>";
					} else {
						print_text += "<option value ='" + n_year + "'>" + n_year + "</option>";
					}
					_flg_year_select = 1;
					n_year -= 1
					if (n_year <= 2016) {
						break;
					}
					//	alert(print_text)
				}


				//select_year_case
				$("#select_year_case").html(print_text);

				load_page_data();



			}
			// export_case_data
			//Select_export_data_modal


			$('body').on('click', '#export_case_data', function() {
				crt_year_4_Select();
				crt_month_start_4_Select();
				crt_month_end_4_Select();
				$("#report_export_result").html("");
				check_select_year();
				$('#Select_export_data_modal').modal('show');
			});

			function check_select_year(){
				if ($("#ex_year").val() == moment().year())
				{
					$("#ex_mn_st").val(moment().format("MM"));
					$("#ex_mn_en").val(moment().format("MM"));
				}
				else
				{
					$("#ex_mn_st").val('01');
					$("#ex_mn_en").val('12');
				}
			}
			$('body').on('change', '#ex_year', function() {
				check_select_year();
			});


			// Generate Year for Select 
			function crt_year_4_Select() {
				var year = moment().year();
				//console.log(year);
				var _flg_year_select = 0;
				print_text = "";
				while (true) {
					if (_flg_year_select == 0) {
						print_text += "<option value ='" + year + "' selected>" + year + "</option>";
					} else {
						print_text += "<option value ='" + year + "'>" + year + "</option>";
					}
					_flg_year_select = 1;
					year -= 1
					if (year <= 2016) {
						break;
					}

					//	alert(print_text)
				}
				$("#ex_year").html(print_text);
			}

			function crt_month_start_4_Select() {
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
				$("#ex_mn_st").html(print_text);
			}

			function crt_month_end_4_Select() {
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
				$("#ex_mn_en").html(print_text);
			}


			//btn_export_data

			$('body').on('click', '#btn_export_data', function() {
				//$("#btn_export_data").html('<i class="fa fa-refresh fa-spin"></i>');
				$("#report_export_result").html("<i class='fa fa-spin fa-refresh'></i> กำลังสร้าง Report...");
				var add_data = {};
				add_data['f'] = '33';
				add_data['ex_year'] = $("#ex_year").val();
				add_data['ex_ymbg'] = $("#ex_year").val() + '01';
				add_data['ex_ymed'] = $("#ex_year").val() + '12';
				add_data['ex_year_th'] = parseInt($("#ex_year").val()) + 543;
				add_data['ex_year_last'] = parseInt($("#ex_year").val()) - 1;
				add_data['ex_mn_st'] = $("#ex_mn_st").val();
				add_data['ex_yrmn_st'] = $("#ex_year").val() + $("#ex_mn_st").val();
				add_data['ex_mn_en'] = $("#ex_mn_en").val();
				add_data['ex_yrmn_en'] = $("#ex_year").val() + $("#ex_mn_en").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//$("#export_to_excel_btn_best_case").hide("fast");
						$("#report_export_result").html(data);
						//alert(data)
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});

			});



			google.charts.load('current', {
				'packages': ['geochart'],
				'mapsApiKey': 'AIzaSyC-qmWmKTeZYf9ohc7WqHP_8WUsK-DjIBI'
			});

			// Initial Run ========================================= 

			//drawMarkersMap_Province();
			//get_year_data();
			get_year_data_2();



		});
	</script>
</body>

</html>
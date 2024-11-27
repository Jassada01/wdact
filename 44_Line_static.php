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
				<div class="chip" style="background-color:#FFFFFF;" id="btn_facebook"><B>Facebook</B></div>
				<div class="chip_selected"><B>Line</B></div>
				<h1>
					Line Static
					<small>ข้อมูลทางสถิติของ Line Offical ปฏิบัติการหมาเฝ้าบ้าน</small>
				</h1>
				<BR>
				<div class="row">
					<div class="col-sm-12">
						<div class="box  box-success">
							<div class="box-header">
								<h4 class="box-title">ยอด Follow รายวันของปีนี้</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div id="chart_div_fl_year" style="height:400px;"></div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="box  box-success">
							<div class="box-header">
								<h4 class="box-title">สัดส่วนผู้ติดตาม Line Offical</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div>
									<canvas id="chart_div_1"></canvas>
								</div>

							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<div class="col-sm-6">
						<div class="box  box-success">
							<div class="box-header">
								<h4 class="box-title">แยกตามระบบปฏิบัติการ</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div>
									<canvas id="chart_div_2"></canvas>
								</div>

							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<div class="col-sm-6">
						<div class="box  box-success">
							<div class="box-header">
								<h4 class="box-title">ผู้ติดตามตามห้วงอายุ</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div>
									<canvas id="fan_gen_chart"></canvas>
								</div>

							</div>
							<!-- /.box-body -->
						</div>
					</div>

					<div class="col-sm-6">
						<div class="box  box-success">
							<div class="box-header">
								<h4 class="box-title">สัดส่วนแยกตามภูมิภาค</h4>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div>
									<canvas id="chart_div_3"></canvas>
								</div>

							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>



			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-sm-12" id="available_select_like_chart_data_panel"></div>
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


	<!-- ChartJS -->
	<script src="bower_components/chart.js/src27/Chart.bundle.js"></script>
	<script src="bower_components/chart.js/src27/utils.js"></script>

	<!-- Bootstrap slider -->
	<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================


			// Initial Setting component ============================================================

			// Moment Setting
			moment.locale('th');

			function get_follow_count_chart() {
				var add_data = {}
				add_data['f'] = '34';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data);
						var ojb_chart_data = JSON.parse(data);

						//console.log(ojb_chart_data);
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
						post_static_chart.write("chart_div_fl_year");

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function Load_sex_cnt() {
				var chart_sex = document.getElementById('chart_div_1').getContext('2d');
				var add_data = {}
				add_data['f'] = '35';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//console.log(data);
						var ojb_chart_data = JSON.parse(data);
						var sex_data = [];
						$.each(ojb_chart_data, function(index, val) {
							sex_data.push(val.Value);
						});
						//console.log(sex_data);
						var config = {
							type: 'pie',
							data: {
								datasets: [{
									data: sex_data,
									backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],
									label: 'Dataset 1'
								}],
								labels: [
									'หญิง',
									'ชาย',
									'ไม่ระบุ'
								]
							},
							options: {
								responsive: true,
								legend: {
									position: 'right',
								},
							}
						};
						window.myPie_sex = new Chart(chart_sex, config);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function Load_OS_cnt() {
				var chart_sex = document.getElementById('chart_div_2').getContext('2d');
				var add_data = {}
				add_data['f'] = '36';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//console.log(data);
						var ojb_chart_data = JSON.parse(data);
						var sex_data = [];
						$.each(ojb_chart_data, function(index, val) {
							sex_data.push(val.Value);
						});
						//console.log(sex_data);
						var config = {
							type: 'pie',
							data: {
								datasets: [{
									data: sex_data,
									backgroundColor: ['rgba(54, 235, 162, 0.5)', 'rgba(54, 162, 235, 0.5)'],
									label: 'Dataset 1'
								}],
								labels: [
									'Android',
									'iOS',
									'อื่นๆ'
								]
							},
							options: {
								responsive: true,
								legend: {
									position: 'right',
								},
							}
						};
						window.myPie_sex = new Chart(chart_sex, config);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}


			function get_age_count_graph() {
				//alert (target);

				var add_data = {}
				add_data['f'] = '37';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})

					.done(function(data) {
						var ojb = JSON.parse(data);
						console.log(ojb)
						//alert (data);
						try {
							window.fan_gen_chart.destroy();
						} catch (err) {
							// DO NOTTING;
						}
						var date_fan_chart = [];
						var fan_cnt = [];

						$.each(ojb, function(key, data) {
							if (data.Cat_sub_2.indexOf("U")) {
								date_fan_chart.push(data.Cat_sub_2.replace('M.', 'ชาย ').replace('F.', 'หญิง '));
								fan_cnt.push(data.Value);
							}

						});
						var barChartData = {
							labels: date_fan_chart,
							datasets: [{
								label: 'สัดส่วน(%)',
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

			function load_line_location() {
				var chart_sex = document.getElementById('chart_div_3').getContext('2d');
				var add_data = {}
				add_data['f'] = '38';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//console.log(data);
						var ojb_chart_data = JSON.parse(data);
						var sex_data = [];
						$.each(ojb_chart_data, function(index, val) {
							sex_data.push(val.Value);
						});
						//console.log(sex_data);
						var config = {
							type: 'pie',
							data: {
								datasets: [{
									data: sex_data,
									backgroundColor: ['#00876c', '#51a676', '#88c580', '#c2e38c', '#ffff9d', '#fdd172', '#f7a258', '#ea714e', '#d43d51'],
									label: 'Dataset 1'
								}],
								labels: [
									'กรุงเทพ',
									'ภาคกลาง',
									'ภาคตะวันออก',
									'ภาคตะวันออกเฉียงเหนือ',
									'ภาคเหนือ',
									'พัทยา',
									'ภาคใต้',
									'ไม่ระบุ',
									'ภาคตะวันตก',
								]
							},
							options: {
								responsive: true,
								legend: {
									position: 'right',
								},
							}
						};
						window.myPie_sex = new Chart(chart_sex, config);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			//btn_facebook
			$('body').on('click', '#btn_facebook', function() {
				window.location.replace('40_page_static.php');
			});


			// Initial Run ========================================= 
			get_follow_count_chart();
			Load_sex_cnt();
			Load_OS_cnt();
			get_age_count_graph();
			load_line_location();












		});
	</script>
</body>

</html>
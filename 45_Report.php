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
	<title>Watch_Dog | Monthly Report</title>

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



	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

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
		.table_tr:hover {
			cursor: pointer;
		}

		.zoom {
			transition: transform .2s;
			height: 100px;
			width: 100%;

		}

		.edit_post_type:hover {
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
					Monthly Report
					<small>รายงานประจำเดือน </small>
				</h1>
			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-xs-12 col-sm-12 col-md-8 col-xl-6">
						<div class="box  box-success">
							<div class="box-body">
								<form class="form-horizontal" id="f8_1">
									<div class="box-body">

										<div class="form-group">
											<label for="c_n_status" class="col-md-3 control-label">ข้อมูลปี</label>
											<div class="col-md-3">
												<select class="form-control" id="ex_year">
												</select>
											</div>
										</div>

										<div class="form-group">
											<label for="c_n_status" class="col-md-3 control-label">เดือน</label>
											<div class="col-md-3">
												<select class="form-control" id="ex_mn_st">
												</select>
											</div>
											<label for="c_n_status" class="col-md-1 control-label"> ถึง </label>
											<div class="col-md-3">
												<select class="form-control" id="ex_mn_en">
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="c_n_status" class="col-md-3 control-label"></label>
											<div class="col-md-3">
												<span id="report_export_result"></span>
											</div>
										</div>
									</div>
									<div class="box-footer">
										<button type="button" class="btn bg-primary pull-right" id="btn_export_data">Export Data</button>
									</div>



								</form>
							</div>
							<div class="overlay" id="Loading_panel">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
						<!-- /.box-body -->

					</div>





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
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>



	<!-- number_format -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>



	<!-- Moment with Local -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================

			// Moment Setting
			//moment.locale('th');
			var __TARGET_POST_ID = ""

			// Set Moment 
			moment.locale('th');



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



			function check_select_year() {
				if ($("#ex_year").val() == moment().year()) {
					$("#ex_mn_st").val(moment().format("MM"));
					$("#ex_mn_en").val(moment().format("MM"));
				} else {
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
				$("#Loading_panel").hide();
			}

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





			// Initial Run ========================================= 
			crt_year_4_Select();
			crt_month_start_4_Select();
			crt_month_end_4_Select();
			$("#report_export_result").html("");
			check_select_year();

		});
	</script>
</body>

</html>
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
	<title>Watch_Dog | Page Post</title>

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
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="plugins/iCheck/all.css">

	<!-- Select 2 -->
	<link rel="stylesheet" href="bower_components/select2/dist/css/select2.css">


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

		.msg_box {
			width: 100%;
			width-max: 50px;
			overflow-wrap: break-word;
		}

		.edit_post_type:hover {
			cursor: pointer;
		}

		.c_hover {
			cursor: pointer;
		}

		#load_post_modal:hover {
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
					Page Post
					<small>โพสในเพจ </small>
				</h1>
				<div class="breadcrumb">
					<select id="select_year_case">
					</select>
					<button type="button" class="btn btn-box-tool" id="export_to_excel_btn"><i class="fa fa-cloud-upload"></i> Export Data</button>
					<span id="download_export_file"></span>
				</div>
			</section>
			<!-- Main content -->
			<section class="content container-fluid">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">

						<div class="box box-primary box-solid " style="overflow:auto;">
							<div class="box-body" id="Table_Data">
								<table class="table datatable-basic display " id="style-1" style="width:100%">

									<thead>
										<tr>
											<th style="max-width:10%"></th>
											<th style="width:30%" class="text_search">ข้อความ</th>
											<th style="width:15%" class="text_search">โพสเมื่อ</th>
											<th style="width:15%" class="text_search">ประเภทโพส</th>
											<th style="width:10%" class="text_search">ผูกกับเคส</th>
											<th style="width:10%" class="text_search">สถานะเคส</th>
											<th style="width:10%"><i class="fa  fa-users"></i> Reach</th>
										</tr>
									</thead>

									<tbody id="table_result">


									</tbody>

								</table>
							</div>
							<div class="overlay" id="overlay_load" style="display: none;">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
						</div>
					</div>





				</div>



				<div class="modal fade" id="modal_update_post_data">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">กำหนดประเภทของโพสในเพจ</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-6">
										<div id='timeline_facebook_panel'>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="row">
											<div class="col-sm-12">
												<form class="form-horizontal">
													<div class="form-group">
														<label for="select_post_type" class="col-sm-2 control-label">ประเภท</label>

														<div class="col-sm-10">
															<select class="form-control" id="select_post_type">
															</select>
														</div>
													</div>
												</form>
											</div>





											<div class="col-sm-12" id="div_for_sp_type">

												<form class="form-horizontal">

													<div class="form-group">
														<div class="col-sm-12">
															<div class="checkbox">
																<input type="checkbox" id="new_sp_case" class="flat-red" checked> เคสใหม่
															</div>
														</div>
													</div>
													<div id="input_new_sp_case_data">
														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="new_sp_case_id" placeholder="CASE ID" disabled />
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-12">
																<input type="text" class="form-control" id="new_sp_case_title" placeholder="หัวข้อ" />
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-12">
																<textarea class="form-control" rows="3" id="new_sp_case_detail" placeholder="รายละเอียด" style="overflow:auto;resize:none"></textarea>
															</div>
														</div>
													</div>
													<div id="select_exist_sp_case" style="display: none;">
														<div class="form-group">
															<div class="col-sm-12">
																<select class="form-control" id="select_exist_sp_case_sl">
																</select>
															</div>
														</div>
													</div>
												</form>


											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_type">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->

				<div class="modal fade" id="modal_spcase_data">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="SP_CASE_ID"></h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-6">
										<blockquote>
											<p id="SP_CASE_NAME"></p>
											<small id="SP_CASE_DESC"></small>
										</blockquote>
									</div>
									<div class="col-sm-6">
										<ul class="timeline" id="timeline_new">
										</ul>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary" data-dismiss="modal">ตกลง</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->


				<div class="modal fade" id="modal_post_data">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ข้อมูลโพสในเพจ</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-sm-12">
										<div id='timeline_facebook_panel_3'>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary" data-dismiss="modal">ตกลง</button>
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
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>




	<!-- DataTables -->
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<!-- number_format -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

	<!-- Date Sort -->
	<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-dd-MMM-yyyy.js"></script>


	<!-- Moment with Local -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>

	<!-- iCheck 1.0.1 -->
	<script src="plugins/iCheck/icheck.min.js"></script>

	<!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

	<!-- Select2-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>

	<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
	<script>
		$(document).ready(function() {
			// Global var  =========================================

			// Moment Setting
			//moment.locale('th');
			__TARGET_POST_ID = ""
			__TARGET_SP_CASE_ID = ""


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


			$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
				checkboxClass: 'icheckbox_flat-red',
				radioClass: 'iradio_flat-red'
			});



			// Basic datatable


			// Setup - add a text input to each footer cell
			$('.datatable-basic thead th').each(function() {
				if ($(this).hasClass("text_search")) {
					var title = $(this).text();
					$(this).html('<input type="text" placeholder=" ' + title + '"  style="width:100%"/>');
				}

			});

			function load_table_data() {
				$("#export_to_excel_btn").show()
				$("#download_export_file").html("")
				$("#overlay_load").show()

				if ($.fn.dataTable.isDataTable('.datatable-basic')) {
					$('.datatable-basic').DataTable().destroy();
				}
				var add_data = {}
				add_data['f'] = '1';
				add_data['select_year'] = $("#select_year_case").val();
				//alert(add_data['select_year'])
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_6_page_post.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)

						//alert(data)
						var print_text = "";
						var data_arr = JSON.parse(data);

						console.log(data_arr)


						jQuery.each(data_arr, function(i, val) {
							//val.print_case_id = "---"

							print_text += "<TR >"
							if (val.full_picture == '') {
								print_text += "<TD  class='table_tr' value='" + val.id + "'><img src='img/wd_img/default.png'  style='object-fit: cover;' class='zoom'></img> </TD>"
							} else {

								print_text += "<TD  class='table_tr' value='" + val.id + "'><img src='" + val.full_picture + "'  style='object-fit: cover;' class='zoom'></img> </TD>"
							}

							print_text += "<TD id='load_post_modal' value='" + val.id + "'><H6 class='msg_boxmsg_box'>" + val.MSG.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") + "</H6></TD>"

							case_add_time = moment(val.created_time, "YYYY-MM-DD hh:mm:ss").format('DD-MMM-YYYY')
							print_text += "<TD>" + case_add_time + "</TD>"
							print_post_type = val.post_type;
							if (val.post_type == "CC") {
								print_post_type = 'โพสเคสจากศูนย์';
							}


							print_text += "<TD>" + print_post_type + "</TD>"
							//print_text += "<TD>"+val.CASE_ID+"</TD>"
							if (val.CASE_ID != '-') {
								if (val.CASE_ID.indexOf("SP")) {
									if (val.CASE_ID.indexOf(",") != -1)
									{
										var target_case_id_axx  = val.CASE_ID.split(',');
										
										print_text += "<TD>"
										jQuery.each(target_case_id_axx, function(ii, vv) {
											var text_case_id_substr = target_case_id_axx[ii].substr(0, 2) + "-" + target_case_id_axx[ii].substr(2, 2) + "-" + target_case_id_axx[ii].substr(4, 3);
											print_text += " <a href='14_case_data.php?case_id=" + target_case_id_axx[ii] + "' target='_blank'>" + text_case_id_substr + "</a><BR>"

										});
										print_text += "</TD>"
									}
									else
									{
										print_text += "<TD><a href='14_case_data.php?case_id=" + val.CASE_ID + "' target='_blank'>" + val.print_case_id + "</a></TD>"
									}
									
								} else {
									print_text += "<TD><a class='c_hover' id='load_modal_spacial_case' value='" + val.CASE_ID + "'>" + val.print_case_id + "</a></TD>"
								}

							} else {
								print_text += "<TD>" + val.print_case_id + "</TD>"
							}




							case_status_bg = "";
							case_status_font = "#FFF";

							switch (val.STATUS_CODE) {
								case '0':
									case_status_bg = "#1A90FF"
									case_status_icon = "<i class='fa fa-home'></i>"
									break;
								case '2':
									case_status_bg = "#F9F871"
									case_status_font = "#111";
									case_status_icon = "<i class='fa fa-commenting'></i>"
									break;
								case '3':
									case_status_bg = "#F9F871"
									case_status_font = "#111";
									case_status_icon = "<i class='fa fa-hand-stop-o'></i>"
									break;
								case '4':
									case_status_bg = "#F75A3F"
									case_status_icon = "<i class='fa fa-ban'></i>"
									break;
								case '5':
									case_status_bg = "#00E6BB"
									case_status_font = "#111";
									case_status_icon = "<i class='fa fa-facebook'></i>"
									break;
								case '6':
									case_status_bg = "#00186A"
									case_status_icon = "<i class='fa fa-bookmark-o'></i>"
									break;
								case '7':
									case_status_bg = "#00186A"
									case_status_icon = "<i class='fa fa-book'></i>"
									break;
								case '8':
									case_status_bg = "#00186A"
									case_status_icon = "<i class='fa fa-pencil'></i>"
									break;
								default:
									case_status_bg = "#687DE8"
									case_status_icon = "<i class='fa fa-compass'></i>"
							}

							if (val.STATUS_CODE != '-') {
								print_text += "<TD><span class='label' style='background-color:" + case_status_bg + "; color:" + case_status_font + ";'>" + case_status_icon + " " + val.STATUS_TEXT + "</span></TD>"
							} else {
								if (val.post_type == '-') {
									print_text += "<TD>ยังไม่ได้ผูกเคส <span class='edit_post_type' value='" + val.id + "' id='edit_post_type'><i class='fa fa-pencil'></i></span></TD>"
								} else {
									print_text += '<TD></TD>';
								}
							}

							print_text += '<TD>' + numeral(val.reach).format('0,0') + '</TD>';

							print_text += "</TR>"
						});

						$("#table_result").html(print_text)





						//$('.datatable-basic').DataTable().clear().destroy();

						// Initial Table 
						var table_data = $('.datatable-basic').DataTable(
							// Table Option -----------------------
							{
								"language": {
									"decimal": ".",
									"thousands": ","
								},
								columnDefs: [{
									type: 'date-dd-mmm-yyyy',
									targets: 0
								}],
								"pageLength": 50,
							}
							// End Table Option -------------------
						);


						table_data.columns().every(function() {
							var that = this;
							$('input', this.header()).on('keyup change clear', function() {
								if (that.search() !== this.value) {
									that
										.search(this.value)
										.draw();
								}
							});
						});
						//($("#Table_Data")).toggle();
						$("#overlay_load").hide()
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}



			$("#select_year_case").change(function() {
				load_table_data();
			});

			//export_to_excel_btn
			$('body').on('click', '#export_to_excel_btn', function() {
				$(this).hide()
				$("#download_export_file").html("<i class='fa fa-refresh fa-spin'></i> Create File...")
				var add_data = {}
				add_data['f'] = '2';
				add_data['select_year'] = $("#select_year_case").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_6_page_post.php',
						data: (add_data)
					}).done(function(data) {
						//alert (data)
						$("#download_export_file").html(data)
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			function create_monthly_Purpose() {
				date_now = moment()
				print_text = "";
				for (i = 0; i < 36; i++) {
					//alert(date_now.format('YYYY-MM-DD'));
					if (date_now.isBefore('2018-01-01')) {
						break;
					}
					print_text += "<Option value='" + date_now.format('YYYY') + "'>" + date_now.format('YYYY') + "</Option>";
					date_now.subtract(1, 'Year');
				}
				$("#select_year_case").html(print_text);
				load_table_data();
			}

			//table_tr
			$('body').on('click', '.table_tr', function() {
				var target = $(this).attr('value')
				//alert(target)
				var post_link = "https://www.facebook.com/Watchdog.ACT/posts/" + target;
				var win = window.open(post_link, '_blank');
				win.focus();
			});


			//edit_post_type
			$('body').on('click', '#edit_post_type', function() {
				var target = $(this).attr('value')
				__TARGET_POST_ID = target
				//alert(target)
				load_facebook_data(target);
				load_page_post_status_for_select();
				$('#modal_update_post_data').modal('show');
			});

			function load_facebook_data(target) {
				//var target = ($(this).attr('value'));
				$("#timeline_facebook_panel").html('<i class="fa fa-refresh fa-spin"></i> Loading...');
				var add_data = {}
				add_data['f'] = '59';
				add_data['target'] = __TARGET_POST_ID;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {

						var data_ojb = JSON.parse(data);
						var header_text = (data_ojb.message.split('\n')[0]);
						if (header_text.length > 40) {
							header_text = header_text.substring(0, 40) + "...";
						}
						var total_msg = data_ojb.message.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
						var cut_msg = total_msg;
						if (cut_msg.length > 200) {
							cut_msg = cut_msg.substring(0, 200) + "...";
						}

						// Cal_star
						var star_text = "";

						for (i = 0; i < Math.floor(data_ojb.post_star); i++) {
							star_text += '<i class="fa  fa-star"></i>';
						}
						if ((data_ojb.post_star % 1) > 0) {
							star_text += '<i class="fa  fa-star-half"></i>';
						}

						var print_text = "";
						print_text += '<Table>';
						print_text += '<TR>';
						print_text += '<TD><a href="41_post_static.php?post_id=' + target + '">';
						if (data_ojb.picture == null) {
							print_text += '<img src="img/wd_img/default.png" class="img-circle" height="150" width="150">';
						} else {
							print_text += '<img src="' + data_ojb.picture + '" class="img-circle" height="150" width="150">';
						}
						//print_text += '<img src="'+data_ojb.picture+'" height="120" width="120">';
						print_text += '</a></TD>';
						print_text += '<TD style="padding: 5px;">';
						print_text += '<B><a href="' + data_ojb.target_url + '" target="_blank">' + header_text + '</a><Br>';


						// Cal date
						var now = moment(new Date()); //todays date
						var end = moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
						var duration = moment.duration(now.diff(end));
						var diff_days = duration.asDays();

						if (diff_days <= 7.0) {
							print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
								sameElse: 'DD MMMM YYYY'
							}) + '</font></small><br>';
						} else {
							print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm') + '</font></small><br>';
						}

						print_text += '<B><font color="red">' + star_text + '</B></font><Br>';


						if (data_ojb.post_impressions_unique == null) {
							print_text += '<B><i class="fa fa-users"></i><font color="red">-</B></font><Br>';
						} else {
							print_text += '<B><i class="fa fa-users"></i><font color="red"> ' + data_ojb.post_impressions_unique + '</B></font><Br>';
						}

						print_text += '<b><i class="fa fa-comment-o"></i> ' + data_ojb.comment + ' <i class="fa fa-share"></i> ' + data_ojb.shares + '</B><Br>';

						if (data_ojb.post_reactions_like == null) {
							print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i>-</span> ';
						} else {
							print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i> ' + data_ojb.post_reactions_like + '</span> ';
						}

						if (data_ojb.post_reactions_love == null) {
							print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ -</span>  ';
						} else {
							print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ ' + data_ojb.post_reactions_love + '</span>  ';
						}

						if (data_ojb.post_reactions_haha == null) {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  -</span> ';
						} else {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  ' + data_ojb.post_reactions_haha + '</span> ';
						}

						if (data_ojb.post_reactions_wow == null) {
							print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 -</span>  ';
						} else {
							print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 ' + data_ojb.post_reactions_wow + '</span>  ';
						}

						if (data_ojb.post_reactions_sorry == null) {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 -</span> ';
						} else {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 ' + data_ojb.post_reactions_sorry + '</span> ';
						}

						if (data_ojb.post_reactions_anger == null) {
							print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  -</span>';
						} else {
							print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  ' + data_ojb.post_reactions_anger + '</span>';
						}
						print_text += '</TD>';
						print_text += '</TR>';
						print_text += '</Table>';
						print_text += '<h5 class="widget-user-desc post_desc break-word" value = "' + encodeURIComponent(data_ojb.message) + '">' + cut_msg + '</h5>';
						//alert(print_text)
						//console.log(print_text)
						//$(obj).html(print_text);
						$("#timeline_facebook_panel").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}



			function load_page_post_status_for_select() {
				var add_data = {}
				add_data['f'] = '3';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_6_page_post.php',
						data: (add_data)
					}).done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						jQuery.each(data_arr, function(i, val) {
							print_text += "<Option value='" + val.id + "'>" + val.type_name + "</Option>";
						});
						$("#select_post_type").html(print_text);

					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			$("#select_post_type").change(function() {
				var target = $(this).val();
				//alert(target)
				if (target == 1) {
					$("#div_for_sp_type").show("fast");
				} else {
					$("#div_for_sp_type").hide("fast");
				}
			});

			// If cannot estimate damage check
			$('#new_sp_case').on('ifChecked', function(event) {

				$("#input_new_sp_case_data").show("fast");
				$("#select_exist_sp_case").hide("fast");
			});

			// If cannot estimate damage uncheck
			$('#new_sp_case').on('ifUnchecked', function(event) {
				load_exist_case_for_select();
				$("#input_new_sp_case_data").hide();
				$("#select_exist_sp_case").show();
			});

			//btn_save_type
			//edit_post_type
			$('body').on('click', '#btn_save_type', function() {
				// Validate data
				type_post = $('#select_post_type').val();
				__DATA_COMPLETE = true;
				create_new_sp = "none"
				selected_case = ""
				case_id = ""
				if (type_post == 1) {
					// Check new SP
					if ($('#new_sp_case').is(':checked')) {
						create_new_sp = "NEW";
						if ($("#new_sp_case_title").val() == "") {

							__DATA_COMPLETE = false;
							swal({
								type: 'error',
								title: 'กรุณากรอกหัวข้อเคส'
							});
						}

					} else {
						create_new_sp = "EXIST";
						case_id = $("#select_exist_sp_case_sl").val();
						if (case_id == null) {
							__DATA_COMPLETE = false;
							swal({
								type: 'error',
								title: 'กรุณาเลือกเคสนอกศูนย์'
							});
						}
					}

					// Exist SP case

				}
				//__DATA_COMPLETE = false;
				if (__DATA_COMPLETE) {
					swal({
						type: 'info',
						title: 'กำลังบันทึกข้อมูล',
						text: "กรุณารอสักครู่",
						allowOutsideClick: false,
						showConfirmButton: false,
					});
					var add_data = {}
					add_data['f'] = '4';
					add_data['case_id'] = case_id;
					add_data['__TARGET_POST_ID'] = __TARGET_POST_ID;
					add_data['create_new_sp'] = create_new_sp;
					add_data['selected_case'] = selected_case;
					add_data['type_post'] = type_post;
					add_data['new_sp_case_title'] = $("#new_sp_case_title").val();
					add_data['new_sp_case_detail'] = $('textarea#new_sp_case_detail').val();
					add_data['staff_key_id'] = '<?php echo $staff_key_id; ?>';

					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_6_page_post.php',
							data: (add_data)
						}).done(function(data) {
							//alert (data)
							window.location.reload();
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				}
			});

			function load_exist_case_for_select() {
				var add_data = {}
				add_data['f'] = '5';
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_6_page_post.php',
						data: (add_data)
					}).done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						//console.log(data_arr);
						print_text = "<option disabled selected> == เลือกเคสนอกศูนย์ ==</option>";
						jQuery.each(data_arr, function(i, val) {
							print_text += "<Option value='" + val.CASE_ID + "'>" + val.print_case_id + " : " + val.Case_Title + "</Option>";
						});
						$("#select_exist_sp_case_sl").html(print_text);
						$("#select_exist_sp_case_sl").select2();

					})
					.fail(function() {
						alert("Posting failed.");
					});
			};

			//load_modal_spacial_case
			$('body').on('click', '#load_modal_spacial_case', function() {
				var target = $(this).attr('value')
				__TARGET_SP_CASE_ID = target;
				//alert(target)
				//load_facebook_data(target);
				//load_page_post_status_for_select();
				load_new_timeline();
				load_sp_case_data();
				$('#modal_spcase_data').modal('show');
			});


			function load_sp_case_data() {
				var add_data = {}
				add_data['f'] = '6';
				add_data['case_id'] = __TARGET_SP_CASE_ID;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_6_page_post.php',
						data: (add_data)
					}).done(function(data) {
						var data_arr = JSON.parse(data);
						jQuery.each(data_arr, function(i, val) {
							$("#SP_CASE_ID").html(val.print_case_id)
							$("#SP_CASE_NAME").html(val.Case_Title)
							$("#SP_CASE_DESC").html(val.Case_Detail)
						});


					})
					.fail(function() {
						alert("Posting failed.");
					});
			}

			function load_new_timeline() {
				var add_data = {};
				add_data['f'] = '78';
				add_data['case_id'] = __TARGET_SP_CASE_ID;

				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert(data)
						if (data != "[]") {
							var current_contact_name = "";
							var data_arr = JSON.parse(data);
							print_text = "";
							current_date = "";
							var _ep_cnt = 1;
							var EP_Print = ""
							jQuery.each(data_arr, function(i, val) {

								// Setup Text
								temp_current_date = moment(val.time_stmp, "YYYY-MM-DD hh:mm:ss").format('ddd D MMM YYYY');
								//alert(temp_current_date)
								if (current_date != temp_current_date) {
									current_date = temp_current_date;
									print_text += '<li class="time-label"><span class="bg-blue">' + current_date + '</span></li>';
								}
								var status_header = ""
								var status_time = '<i class="fa fa-clock-o"></i> ' + moment(val.time_stmp, "YYYY-MM-DD hh:mm:ss").format('LT');
								var status_show = ""
								var detail_show = val.detail;
								var bg_color_text = "";
								EP_Print = ""
								switch (val.case_status) {
									case '0':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-home bg-blue"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '1':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-compass bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '2':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-commenting bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '3':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-hand-stop-o bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '4':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-ban bg-red"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '5':
										//bg_color_text = 'style="background-color: #eef6ee;" ';
										if (val.CHECK_EP != null) {
											EP_Print = "<span class='badge bg-green pull-right'>Episode : " + _ep_cnt + '</span><Br>';
											_ep_cnt += 1;

										}

										detail_show = EP_Print + " <div class='timeline-footer' id='timeline_facebook_panel' value = '" + val.url + "' style='padding: 5px; width: 100%; word-break: break-all; word-wrap: break-word;'></div>"
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-facebook bg-green"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '6':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-bookmark-o bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '7':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-book bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;
									case '8':
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-pencil bg-purple"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '11':
										status_time = ""
										//bg_color_text = 'style="background-color: #ecdfdf;" ';
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-newspaper-o  bg-blue"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										if (isUrlValid(val.url)) {
											if (val.url.indexOf("youtu") >= 0) {
												var videoId = getyoutubeId(val.url);
												detail_show += '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>'
											} else if (val.url.indexOf("facebook.com") >= 0) {
												detail_show += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
											} else {
												detail_show = "<div value='" + val.url + "' id='timeline_other_link_panel' ></div>";
											}

										}
										//detail_show += val.url;

										break;
									case '12':
										status_time = ""
										//bg_color_text = 'style="background-color: #ecdfdf;" ';
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-hand-o-right bg-maroon"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										if (isUrlValid(val.url)) {
											if (val.url.indexOf("youtu") >= 0) {
												var videoId = getyoutubeId(val.url);
												detail_show += '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe></div>'
											} else if (val.url.indexOf("facebook.com") >= 0) {
												detail_show += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
											} else {
												detail_show = "<div value='" + val.url + "' id='timeline_other_link_panel' ></div>";
											}

										}
										break;
									case '13':
										status_time = ""
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-quote-left bg-orange"></i>';
										status_time += ' <i id="delete_time_line_item" class="fa fa-times delete_time_line" value="' + val.rnd_str + '"></i>';
										break;

									case '20':
										status_time = ""
										status_header = val.description;
										status_show = '<i class="fa fa-paper-plane bg-blue"></i>';
										break;
									case '21':
										status_time = ""
										status_header = '<img class="img-circle img-bordered-sm" src="' + val.IMG + '" height="42" width="42" /> ' + val.nick_name + " : " + val.description;
										status_show = '<i class="fa fa-send bg-orange"></i>';
										break;
									case '31':
										//status_time = ""
										status_header = val.description;
										//alert(val.url)
										status_show = '<i class="fa fa-facebook bg-yellow"></i>';
										detail_show = '<a class="btn btn-social btn-facebook" href="https://www.facebook.com/groups/Watchdog.TAC1/' + val.url + '" target="_blank">'
										detail_show += '<i class="fa fa-facebook"></i> ลิ้งในศูนย์'
										detail_show += '</a>'
										break;
									default:
										break;

								}
								//
								var disable_body = ""
								//style="display: none;"
								if (detail_show == "") {
									disable_body = 'style="display: none;"';
								}




								print_text += '<li>';
								print_text += status_show;
								print_text += '<div class="timeline-item" ' + bg_color_text + ' >';
								print_text += '<span class="time">' + status_time + '</span>';
								print_text += '<h5 class="timeline-header">' + status_header + '</h5>';
								print_text += '<div class="timeline-body" ' + disable_body + '>' + detail_show;
								print_text += '</div>';
								print_text += '</div>';
								print_text += '</li>';
							});
							print_text += '<li><i class="fa fa-clock-o bg-gray"></i></li>';
							$("#timeline_new").html(print_text);
							load_facebook_data_2();
							load_other_url_data();
							//load_gov_check_per_case();
						}


					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}

			function load_facebook_data_2() {
				$('body div#timeline_facebook_panel').each(function(i, obj) {
					var target = ($(this).attr('value'));
					$(this).html('<i class="fa fa-refresh fa-spin"></i> Loading...');
					var add_data = {}
					add_data['f'] = '59';
					add_data['target'] = target;
					$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_1_case.php',
							data: (add_data)
						})
						.done(function(data) {

							var data_ojb = JSON.parse(data);
							var header_text = (data_ojb.message.split('\n')[0]);
							if (header_text.length > 40) {
								header_text = header_text.substring(0, 40) + "...";
							}
							var total_msg = data_ojb.message.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
							var cut_msg = total_msg;
							if (cut_msg.length > 200) {
								cut_msg = cut_msg.substring(0, 200) + "...";
							}

							// Cal_star
							var star_text = "";

							for (i = 0; i < Math.floor(data_ojb.post_star); i++) {
								star_text += '<i class="fa  fa-star"></i>';
							}
							if ((data_ojb.post_star % 1) > 0) {
								star_text += '<i class="fa  fa-star-half"></i>';
							}

							var print_text = "";
							print_text += '<Table>';
							print_text += '<TR>';
							print_text += '<TD><a href="41_post_static.php?post_id=' + target + '">';
							if (data_ojb.picture == null) {
								print_text += '<img src="img/wd_img/default.png" class="img-circle" height="150" width="150">';
							} else {
								print_text += '<img src="' + data_ojb.picture + '" class="img-circle" height="150" width="150">';
							}
							//print_text += '<img src="'+data_ojb.picture+'" height="120" width="120">';
							print_text += '</a></TD>';
							print_text += '<TD style="padding: 5px;">';
							print_text += '<B><a href="' + data_ojb.target_url + '" target="_blank">' + header_text + '</a><Br>';


							// Cal date
							var now = moment(new Date()); //todays date
							var end = moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
							var duration = moment.duration(now.diff(end));
							var diff_days = duration.asDays();

							if (diff_days <= 7.0) {
								print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
									sameElse: 'DD MMMM YYYY'
								}) + '</font></small><br>';
							} else {
								print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm') + '</font></small><br>';
							}

							print_text += '<B><font color="red">' + star_text + '</B></font><Br>';


							if (data_ojb.post_impressions_unique == null) {
								print_text += '<B><i class="fa fa-users"></i><font color="red">-</B></font><Br>';
							} else {
								print_text += '<B><i class="fa fa-users"></i><font color="red"> ' + data_ojb.post_impressions_unique + '</B></font><Br>';
							}

							print_text += '<b><i class="fa fa-comment-o"></i> ' + data_ojb.comment + ' <i class="fa fa-share"></i> ' + data_ojb.shares + '</B><Br>';

							if (data_ojb.post_reactions_like == null) {
								print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i>-</span> ';
							} else {
								print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i> ' + data_ojb.post_reactions_like + '</span> ';
							}

							if (data_ojb.post_reactions_love == null) {
								print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ -</span>  ';
							} else {
								print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ ' + data_ojb.post_reactions_love + '</span>  ';
							}

							if (data_ojb.post_reactions_haha == null) {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  -</span> ';
							} else {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  ' + data_ojb.post_reactions_haha + '</span> ';
							}

							if (data_ojb.post_reactions_wow == null) {
								print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 -</span>  ';
							} else {
								print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 ' + data_ojb.post_reactions_wow + '</span>  ';
							}

							if (data_ojb.post_reactions_sorry == null) {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 -</span> ';
							} else {
								print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 ' + data_ojb.post_reactions_sorry + '</span> ';
							}

							if (data_ojb.post_reactions_anger == null) {
								print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  -</span>';
							} else {
								print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  ' + data_ojb.post_reactions_anger + '</span>';
							}
							print_text += '</TD>';
							print_text += '</TR>';
							print_text += '</Table>';
							print_text += '<h5 class="widget-user-desc post_desc break-word" value = "' + encodeURIComponent(data_ojb.message) + '">' + cut_msg + '</h5>';
							//alert(print_text)
							//console.log(print_text)
							$(obj).html(print_text);
						})
						.fail(function() {
							// just in case posting your form failed
							alert("Posting failed.");
						});
				});
			}

			function load_other_url_data() {
				$('body div#timeline_other_link_panel').each(function(i, obj) {
					var target = ($(this).attr('value'));
					$(this).html('<i class="fa fa-refresh fa-spin"></i> Loading...');
					//alert(target)
					var print_text = ""
					var add_data = {};
					add_data['key'] = 'd5745023a4695eb988418ba754e38477';
					add_data['q'] = target;

					$.ajax({
							type: 'GET',
							dataType: "text",
							url: 'http://api.linkpreview.net/',
							data: (add_data)
						})
						.done(function(data) {
							//alert(data)

							var data_arr = JSON.parse(data);
							//console.log(data_arr);
							var val = data_arr

							if (val.title != "") {


								print_text += '<Table>';
								print_text += '<TR>';
								print_text += '<TD>';
								print_text += '<img src="' + val.image + '"  height="150" width="150">';
								print_text += '</TD>';
								print_text += '<TD style="padding: 5px;">';
								print_text += '<B><a href="' + val.url + '" target="_blank">' + val.title + '</a></font>';
								print_text += '</TR>';
								print_text += '</Table>';
								print_text += '<h5>' + val.description + '</h5>';
								//alert(print_text);
								$(obj).html(print_text);
								//$(this).html(print_text)
							} else {
								//alert("zzz")
								print_text += "<BR><a href='" + val.url + "' target='_blank'>" + val.url.substring(0, 30) + "...</a>";
								$(obj).html(print_text);
							}


						})
						.fail(function() {
							// just in case posting your form failed
							print_text += "<BR><a href='" + target + "' target='_blank'>" + target.substring(0, 30) + "...</a>";
							//alert(print_text)
							$(obj).html(print_text);
						});


				});
			}

			$('body').on('click', '#delete_time_line_item', function() {
				var target = ($(this).attr('value'));
				var add_data = {}
				add_data['f'] = '57';
				add_data['target'] = target;
				add_data['case_id'] = __TARGET_SP_CASE_ID;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {
						if (data != "") {
							swal({
								position: 'top-end',
								type: 'error',
								//title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								title: data,
								showConfirmButton: false,
								timer: 2000
							});
						} else {
							swal({
								position: 'top-end',
								type: 'success',
								title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
								showConfirmButton: false,
								timer: 1000
							});
							load_new_timeline();
						}


					})
					.fail(function() {
						alert("Posting failed.");
					});
			});





			function load_facebook_data_3(target) {
				//var target = ($(this).attr('value'));
				$("#timeline_facebook_panel_3").html('<i class="fa fa-refresh fa-spin"></i> Loading...');
				var add_data = {}
				add_data['f'] = '59';
				add_data['target'] = target;
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_1_case.php',
						data: (add_data)
					})
					.done(function(data) {

						//alert(data)

						var data_ojb = JSON.parse(data);
						var header_text = (data_ojb.message.split('\n')[0]);
						if (header_text.length > 40) {
							header_text = header_text.substring(0, 40) + "...";
						}
						var total_msg = data_ojb.message.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
						var cut_msg = total_msg;
						if (cut_msg.length > 200) {
							cut_msg = cut_msg.substring(0, 200) + "...";
						}

						// Cal_star
						var star_text = "";

						for (i = 0; i < Math.floor(data_ojb.post_star); i++) {
							star_text += '<i class="fa  fa-star"></i>';
						}
						if ((data_ojb.post_star % 1) > 0) {
							star_text += '<i class="fa  fa-star-half"></i>';
						}

						var print_text = "";
						print_text += '<Table>';
						print_text += '<TR>';
						print_text += '<TD><a href="41_post_static.php?post_id=' + target + '">';
						if (data_ojb.picture == null) {
							print_text += '<img src="img/wd_img/default.png" class="img-circle" height="150" width="150">';
						} else {
							print_text += '<img src="' + data_ojb.picture + '" class="img-circle" height="150" width="150">';
						}
						//print_text += '<img src="'+data_ojb.picture+'" height="120" width="120">';
						print_text += '</a></TD>';
						print_text += '<TD style="padding: 5px;">';
						print_text += '<B><a href="' + data_ojb.target_url + '" target="_blank">' + header_text + '</a><Br>';


						// Cal date
						var now = moment(new Date()); //todays date
						var end = moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss"); // another date
						var duration = moment.duration(now.diff(end));
						var diff_days = duration.asDays();

						if (diff_days <= 7.0) {
							print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
								sameElse: 'DD MMMM YYYY'
							}) + '</font></small><br>';
						} else {
							print_text += '<small><font color="#aaaaaa">' + moment(data_ojb.pub_time, "YYYY-MM-DD hh:mm:ss").format('D MMMM YYYY HH:mm') + '</font></small><br>';
						}

						print_text += '<B><font color="red">' + star_text + '</B></font><Br>';


						if (data_ojb.post_impressions_unique == null) {
							print_text += '<B><i class="fa fa-users"></i><font color="red">-</B></font><Br>';
						} else {
							print_text += '<B><i class="fa fa-users"></i><font color="red"> ' + data_ojb.post_impressions_unique + '</B></font><Br>';
						}

						print_text += '<b><i class="fa fa-comment-o"></i> ' + data_ojb.comment + ' <i class="fa fa-share"></i> ' + data_ojb.shares + '</B><Br>';

						if (data_ojb.post_reactions_like == null) {
							print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i>-</span> ';
						} else {
							print_text += '<span class="badge bg-blue post_data_type4click" value="post_reactions_like"><i class="fa fa-thumbs-o-up"></i> ' + data_ojb.post_reactions_like + '</span> ';
						}

						if (data_ojb.post_reactions_love == null) {
							print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ -</span>  ';
						} else {
							print_text += '<span class="badge bg-red post_data_type4click" value="post_reactions_love"> ❤ ' + data_ojb.post_reactions_love + '</span>  ';
						}

						if (data_ojb.post_reactions_haha == null) {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  -</span> ';
						} else {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_haha"> 😆  ' + data_ojb.post_reactions_haha + '</span> ';
						}

						if (data_ojb.post_reactions_wow == null) {
							print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 -</span>  ';
						} else {
							print_text += '<br><span class="badge bg-yellow post_data_type4click" value="post_reactions_wow"> 😲 ' + data_ojb.post_reactions_wow + '</span>  ';
						}

						if (data_ojb.post_reactions_sorry == null) {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 -</span> ';
						} else {
							print_text += '<span class="badge bg-yellow post_data_type4click" value="post_reactions_sorry"> 😢 ' + data_ojb.post_reactions_sorry + '</span> ';
						}

						if (data_ojb.post_reactions_anger == null) {
							print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  -</span>';
						} else {
							print_text += '<span class="badge bg-orange post_data_type4click" value="post_reactions_anger"> 😡  ' + data_ojb.post_reactions_anger + '</span>';
						}
						print_text += '</TD>';
						print_text += '</TR>';
						print_text += '</Table>';


						var print_all_msg = decodeURIComponent(encodeURIComponent(data_ojb.message)).replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
						while (print_all_msg.indexOf("\n") > 0) {
							//alert (print_all_msg.indexOf("\n"))
							print_all_msg = print_all_msg.replace("\n", "<br>");
						}


						print_text += '<h5 class="widget-user-desc post_desc break-word" >' + print_all_msg + '</h5>';
						//alert(print_text)
						//console.log(print_text)
						//$(obj).html(print_text);
						$("#timeline_facebook_panel_3").html(print_text);
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			}




			//load_post_modal
			$('body').on('click', '#load_post_modal', function() {
				var target = ($(this).attr('value'));
				load_facebook_data_3(target);
				//modal_post_data
				$('#modal_post_data').modal('show');

			});



			// Initial Run ========================================= 
			create_monthly_Purpose()



		});
	</script>
</body>

</html>
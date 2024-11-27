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
		<!-- Google Font -->
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
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
						Dashbord
						<small>หน้าแผงควบคุมและสรุป</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Dashbord</a></li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<!-- left column -->
						<div class="col-md-4">
							<div class="box box-default">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลหมาเฝ้าบ้าน</h3>
									<div class="box-tools pull-right">
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
										</button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="row">
										<div class="col-md-12">
											<div class="chart-responsive">
												<span class="progress-text">แยกตามภาค</span>
												<canvas id="pieChart_wd_geo" height="150"></canvas>
											</div>
											<!-- ./chart-responsive -->
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									<ul class="nav nav-pills nav-stacked">
										<li>
											<span class="progress-text">แยกตามเพศ</span>
											<div class="progress">
												<?php
													include "connectionDb.php";
													$sql = "SELECT sex, count(sex) as cnt FROM wd_db group by sex";
													$res = $conn->query(trim($sql));
													mysqli_close($conn);
													while ($row = $res->fetch_assoc()){
														if ($row['sex'] == 0)
														{
															$m_cnt = $row['cnt'];
														}
														if ($row['sex'] == 1)
														{
															$f_cnt = $row['cnt'];
														}
													}
													$total_cnt = $f_cnt + $m_cnt;
													$m_percentage = ($m_cnt / $total_cnt) * 100;
													$f_percentage = ($f_cnt / $total_cnt) * 100;
													echo '<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="'.$m_cnt.'" aria-valuemin="0" aria-valuemax="'.$total_cnt.'" style="width: '.$m_percentage.'%">ชาย '.$m_cnt.' คน</div>';
													echo '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$f_cnt.'" aria-valuemin="0" aria-valuemax="'.$total_cnt.'" style="width: '.$f_percentage.'%">หญิง '.$f_cnt.' คน</div>';
													?>
											</div>
										</li>
									</ul>
									<div class="col-md-12">
										<div class="chart-responsive">
												<canvas id="barchart" height="150"></canvas>
										</div>
									</div>
								</div>
								<!-- /.footer -->
							</div>
						</div>
						<div class="col-md-5">
							<div class="box box-default">
								<div class="box-header with-border">
									<h3 class="box-title">ข้อมูลหมาเฝ้าบ้าน</h3>
									<div class="box-tools pull-right">
										<a type="button" class="btn btn-box-tool" href="inc_index_hm.php" target="_blank"><i class="fa fa-cog"></i></a>
										<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div class="row">
										<div class="col-md-12">
											<div id="map" style="width:100%;height:600px"></div>
										</div>
										<!-- /.col -->
									</div>
									<!-- /.row -->
								</div>
								<!-- /.footer -->
							</div>
						</div>
					</div>
					<!--------------------------
						| Your Page Content Here |
						-------------------------->
				<div class="modal fade" id="modal_wd_hm">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">ข้อมูลหมาเฝ้าบ้าน Heatmap</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" if = "F_wd_hm">
									<div class="box-body">
										<div class="form-group">
												<div class="col-sm-4 offset-sm-4">
													  <label class="control-label">เพศ</label>
														<input type="checkbox" id="hms_0" checked>   ชาย
														<input type="checkbox" id="hms_1" checked>   หญิง
												</div>
										  <div class="col-sm-10">
													  <label class="control-label">สถานะ</label>
														<input type="checkbox" id="hmstatus_0" checked>   Active
														<input type="checkbox" id="hmstatus_1">   Non Active
														<input type="checkbox" id="hmstatus_2">   Baned
										</div>
											<div class="col-sm-8" id="test_result">
												<label class="control-label">ช่วงอายุ : </label>
												<input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
													 data-slider-step="1" data-slider-value="[10,80]" data-slider-orientation="horizontal"
													 data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red" id="hm_age_range">
											</div>
										</div>										
										<div class="form-group">
										   <div class="col-sm-8">
											<label>กลุ่มอาชีพ</label>
											  <select multiple class="form-control" id="hm_occ_select">
											  </select>
											</div>
										</div>
										<div class="form-group">
										   <div class="col-sm-8">
											<label>รุ่น</label>
											  <select multiple class="form-control" id="hm_gen_select">
											  </select>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn" id="btn_gethmwd">ตกลง</button>
									</div>
									<!-- /.box-body -->
								</form>
								
								
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
			<footer class="main-footer">
				<!-- To the right -->
				<div class="pull-right hidden-xs">
					<a href="https://www.facebook.com/Watchdog.ACT/"><i class="fa fa-facebook-square"> เพจปฎิบัติการหมาเฝ้าบ้าน</i> </a>
				</div>
				<!-- Default to the left -->
				<strong>Copyright &copy; 2017</strong> All rights reserved.
			</footer>
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
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
			$.ajax({
			       url: 'f_0_index.php?f=1',
			       success: function (response) {//response is value returned from php
			            //alert(response); //showing response is working
			            var datachart = JSON.parse(response);
						var config = {
							type: 'pie',
							data: {
								datasets: [{
									data: datachart['data'],
									backgroundColor: [
										window.chartColors.blue,
										window.chartColors.red,
										window.chartColors.sd,
										window.chartColors.orange,
										window.chartColors.yellow,
										window.chartColors.green,
										window.chartColors.black
									]
								}],
								labels: datachart['label']
							},
							options: {
								responsive: true,
								legend: {
									display: true,
									position : 'right'
								},
								animation: false
								
							}
							};
			            // Pie Chart
						var ctx = document.getElementById("pieChart_wd_geo").getContext("2d");
						window.myPie = new Chart(ctx, config);
			       }
			    });	
			$.ajax({
			       url: 'f_0_index.php?f=2',
			       success: function (response) {//response is value returned from php
			            //alert(response); //showing response is working
			            var datachart = JSON.parse(response);
						var color = Chart.helpers.color;
						var barChartData = {
							labels: datachart['label'],
							datasets: [{
								backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
								borderColor: window.chartColors.red,
								borderWidth: 1,
								data: datachart['data']
							}]
						};
						var bar_ctx = document.getElementById("barchart").getContext("2d");
						window.myBar = new Chart(bar_ctx, {
						type: 'horizontalBar',
						data: barChartData,
						options: {
							responsive: true,
							legend: {
								display: false,
							},
							title: {
								display: true,
								text: 'แยกตามอาชีพ'
							},
							animation: false
						}
						});	
						
			       }
			    });
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 6,
          center: {lat: 14, lng: 101},
          mapTypeId: 'roadmap',
		  mapTypeControl: false,
		 styles:[
				  {
					"featureType": "administrative.country",
					"elementType": "geometry.stroke",
					"stylers": [
					  {
						"weight": 2
					  }
					]
				  },
				  {
					"featureType": "administrative.country",
					"elementType": "labels",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "administrative.province",
					"elementType": "geometry.stroke",
					"stylers": [
					  {
						"weight": 1
					  }
					]
				  },
				  {
					"featureType": "administrative.province",
					"elementType": "labels.text.fill",
					"stylers": [
					  {
						"color": "#7c7c7c"
					  }
					]
				  },
				  {
					"featureType": "landscape.natural",
					"elementType": "geometry.fill",
					"stylers": [
					  {
						"color": "#ffffff"
					  }
					]
				  },
				  {
					"featureType": "landscape.natural.terrain",
					"elementType": "geometry",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "poi",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "poi.business",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "poi.park",
					"elementType": "labels.text",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "road",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  },
				  {
					"featureType": "transit",
					"stylers": [
					  {
						"visibility": "off"
					  }
					]
				  }
				]

        });
		var data_geo = [];
		
		heatmap = new google.maps.visualization.HeatmapLayer({
          data: data_geo,
          map: map
        });
      }
	  
	  $.ajax({
			       url: 'f_0_index.php?f=3',
			       success: function (response) {//response is value returned from php
			           //alert(response); //showing response is working
						var data = JSON.parse(response);
						var data_geo = [];
						jQuery.each( data['LAT'], function( i, val ) {
						  data_geo.push({location: new google.maps.LatLng(data['LAT'][i], data['LON'][i]), weight: data['CNT'][i]});
						});
						heatmap.set('data', heatmap.get('data') ? null : data_geo);
						heatmap = new google.maps.visualization.HeatmapLayer({
						  data: data_geo,
						  map: map
						});	
			       }
			    });

		
	</script>
	<!-- Bootstrap slider -->
	<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>
	<script>
	  $(function () {
		/* BOOTSTRAP SLIDER */
		$('.slider').slider({
			tooltip: 'always'
		});
	  });
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-qmWmKTeZYf9ohc7WqHP_8WUsK-DjIBI&libraries=visualization&callback=initMap&language=th&region=TH"></script>
	<script>
		$(document).ready(function(){
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
						url: 'f_0_index.php',
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
				
				// ============ Function =======================
				// btn_gethmwd
				$( "#btn_gethmwd" ).click(function() {
					var hm_data = {}
					hm_data['rang_age'] = ($("#hm_age_range").val());
					hm_data['wd_sex'] = "";
					if ($('#hms_0').is(':checked'))
					{
						hm_data['wd_sex'] = "0";			
					}
					if ($('#hms_1').is(':checked'))
					{
						if (hm_data['wd_sex'] != "")
						{
							hm_data['wd_sex'] += ", 1";
						}
						else 
						{
							hm_data['wd_sex'] = "1";
						}
					}
					
					
					hm_data['wd_status'] = "";
					if ($('#hmstatus_0').is(':checked'))
					{
						hm_data['wd_status'] = "1";			
					}
					if ($('#hmstatus_1').is(':checked'))
					{
						if (hm_data['wd_status'] != "")
						{
							hm_data['wd_status'] += ", 2";
						}
						else 
						{
							hm_data['wd_status'] = "2";
						}
					}
					if ($('#hmstatus_2').is(':checked'))
					{
						if (hm_data['wd_status'] != "")
						{
							hm_data['wd_status'] += ", 3";
						}
						else 
						{
							hm_data['wd_status'] = "3";
						}
					}
					hm_data['hm_occ_select'] = $("#hm_occ_select").val().join();
					hm_data['hm_gen_select'] = $("#hm_gen_select").val().join();
					hm_data['f'] = "6";
					//alert ($("#hm_occ_select option:selected").text());
					//alert (hm_data['hm_gen_select']);
					
						// Set Ajax
						$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_0_index.php',
							data: (hm_data)
						})
						.done(function(response){
								alert(response)
								var data = JSON.parse(response);
								var data_geo = [];
								jQuery.each( data['LAT'], function( i, val ) {
								  data_geo.push({location: new google.maps.LatLng(data['LAT'][i], data['LON'][i]), weight: data['CNT'][i]});
								});
								heatmap.set('data', heatmap.get('data') ? null : data_geo);
								heatmap = new google.maps.visualization.HeatmapLayer({
								  data: data_geo,
								  map: map
								});	
								$('#modal_wd_hm').modal('hide');
						})
						.fail(function() {
							// just in case posting your form failed
							alert( "Posting failed." );
						});
						return false;	
					
				});

				ajax_function(4, "#hm_occ_select");
				ajax_function(5, "#hm_gen_select");
		});
	</script>
	</body>
</html>
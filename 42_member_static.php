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
		<title>Watch_Dog | Member Sattic</title>
		
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
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins/iCheck/all.css">
		
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
						Member static
						<small>สถิติสมาชิก</small>
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="box box-primary">
								<div class="box-header with-border">
									<h3 class="box-title"><B>สมาชิกใหม่ในปีนี้</B></h3>
								</div>
								<div class="box-body" >
									<div id="chart_new_mem" style="height: 400px;"></div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="nav-tabs-custom">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_11" data-toggle="tab">ข้อมูลสมาชิกแยกตามอาชีพ</a></li>
									<li><a href="#tab_12" data-toggle="tab">ข้อมูลสมาชิกแยกตามภูมิภาค</a></li>
									<li><a href="#tab_13" data-toggle="tab">ข้อมูลสมาชิกแยกตามเพศ</a></li>
									<li><a href="#tab_14" data-toggle="tab">ข้อมูลสมาชิกแยกตามสถานะ</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_11">
										<b>ข้อมูลสมาชิกแยกตามลักษณะอาชีพ</b>
										<div id="chart_job" style="height: 400px;"></div>
									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="tab_12">
										<b>ข้อมูลสมาชิกแยกตามภูมิภาค</b>
										<div id="chart_geo" style="height: 400px;"></div>
									</div>
									<div class="tab-pane" id="tab_13">
										<b>ข้อมูลสมาชิกแยกตามเพศ</b>
										<div id="chart_sex" style="height: 400px;"></div>
									</div>
									<div class="tab-pane" id="tab_14">
										<b>ข้อมูลสมาชิกตามสถานะ</b>
										<div id="chart_status" style="height: 400px;"></div>
									</div>
									<!-- /.tab-pane -->
								</div>
								<!-- /.tab-content -->
							</div>
							<!-- nav-tabs-custom -->
						</div>
						
					</div>
					<div class="row">
						<div class="col-sm-12">
						  <div class="box  box-danger">
							<div class="box-header">
							  <h3 class="box-title" ><B>การกระจายตัวของสมาชิก</B></h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">
									<div class="col-sm-12">
										<label>
											<input type="checkbox" class="flat-green" name="check_member_map" id="check_active" checked>
												Active
										</label>
										<label>
											<input type="checkbox" class="flat-green check_member_map" id="check_idle" checked>
												Idle
										</label>
										<label>
											<input type="checkbox" class="flat-red check_member_map" id="check_other">
												แบน/คัดออกจากศูนย์
										</label>
									</div>
								</div>
								<div id="chart_div" style="height: 800px;"></div>
							</div>
							<!-- Loading (remove the following to stop the loading)-->
							<div class="overlay" id="load_active_map">
								<i class="fa fa-refresh fa-spin"></i>
							</div>
							<!-- end loading -->
							<!-- /.box-body -->
						  </div>
						  <!-- /.box -->
						</div>
						
						
						<div class="col-sm-12">
						  <div class="box  box-danger">
								<div class="box-header">
								  <h3 class="box-title">ค้นหาสมาชิกตามความสามารถ</h3>
								  <div class="box-tools col-sm-6">
									<div class="input-group input-group-sm" style="width: 100%;">
									
										<select class="form-control select2"  id="select_skill" style="width: 100%;">
										</select>
									</div>
								  </div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div id="chart_div_2" style="height: 800px;"></div>
								</div>
							</div>
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
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.min.js"></script>
		
		<!-- Amcharts  JS-->
		<script src="plugins/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="plugins/amcharts/pie.js" type="text/javascript"></script>
        <script src="plugins/amcharts/serial.js" type="text/javascript"></script>
		
		<!-- Select2 -->
		<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
			
		<!-- iCheck 1.0.1 -->
		<script src="plugins/iCheck/icheck.min.js"></script>
		<!-- Google Heatmap-->
		<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
		
		
<script>	
$(document).ready(function(){
// Initial Eliment  =========================================

//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
  checkboxClass: 'icheckbox_flat-green',
  radioClass   : 'iradio_flat-green'
})

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
  checkboxClass: 'icheckbox_flat-red',
  radioClass   : 'iradio_flat-red'
})


// Global var  =========================================





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


function get_sex_chart()
{
	var add_data = {};
	add_data['f'] = '22';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
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
                get_chart.titleField = "sex_desc";
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
                get_chart.write("chart_sex");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_job_chart()
{
	var add_data = {};
	add_data['f'] = '21';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
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
                get_chart.titleField = "occ_type";
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
                get_chart.write("chart_job");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_new_mem_chart()
{
	var add_data = {};
	add_data['f'] = '23';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
			var ojb = JSON.parse(data);
			var chart;
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = ojb;
                chart.categoryField = "gen_code";
                // the following two lines makes chart 3D
                chart.depth3D = 20;
                chart.angle = 30;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.labelRotation = 90;
                categoryAxis.dashLength = 5;
                categoryAxis.gridPosition = "start";

                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.title = "สมาชิกใหม่";
                valueAxis.dashLength = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.valueField = "cnt";
                graph.fillColors = "#04D215";
                graph.balloonText = "<span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>";
                graph.type = "column";
                graph.lineAlpha = 0;
                graph.fillAlphas = 0.6;
				graph.labelText = " รุ่น [[category]] : [[value]] คน";
                chart.addGraph(graph);

                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorAlpha = 0;
                chartCursor.zoomable = false;
                chartCursor.categoryBalloonEnabled = false;
                chart.addChartCursor(chartCursor);

                chart.creditsPosition = "top-left";


                // WRITE
                chart.write("chart_new_mem");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_status_chart()
{
	var add_data = {};
	add_data['f'] = '24';
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
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
                get_chart.titleField = "wd_status_dec";
                get_chart.valueField = "value";
				get_chart.colorField = "color";
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
                get_chart.write("chart_status");
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});	
}

function get_heatmap()
{
	var add_data = {}
		add_data['f'] = '25';
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_4_static.php',
			data: (add_data)
		})
		.done(function(data) {
			var data = JSON.parse(data);
			var data_geo = [];
			jQuery.each( data, function( i, val ) {
					data_geo.push({location: new google.maps.LatLng(data[i]['LAT'], data[i]['LON']), weight: Math.floor(data[i]['cnt'])});

			});
			//console.log(data_geo);
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


	google.charts.load('current', {
       'packages': ['geochart'],
       'mapsApiKey': 'AIzaSyC-qmWmKTeZYf9ohc7WqHP_8WUsK-DjIBI'
     });
    

 function drawMarkersMap_search() {
	 var target = $("#select_skill").val();
	 var add_data = {}
	add_data['f'] = '27';
	//add_data['search_text'] = 'งาน';
	add_data['search_text'] = target;
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		if (data != "[]")
		{
			var data = JSON.parse(data);
			var data_geo = [['LAT', 'LON', 'ชื่อ',  'รวม', ]];
			jQuery.each( data, function( i, val ) {
					var _temp = [];
					_temp.push(parseFloat(val.LAT), parseFloat(val.LON), val.name, parseInt(val.cnt));
					data_geo.push(_temp);
			});
		
			
		//console.log(data_geo);
		  var data_map = google.visualization.arrayToDataTable(data_geo);
		//var data_x = google.visualization.arrayToDataTable([
		//	['LAT', 'LON', 'CITY',  'Population'],
		//	[13, 101, 'กทม',      3]
		  //]);
		  var options = {
			region: 'TH',
			//displayMode: 'markers',
			displayMode: 'markers',
			colorAxis: {colors: ['#4B688B', '#143153']}
		  };

		  var chart = new google.visualization.GeoChart(document.getElementById('chart_div_2'));
		  chart.draw(data_map, options);
		}
		
	  
	  //$("#load_active_map").hide();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
  
};











function drawMarkersMap_Province() {
		// Read Select Type
		var check_value = "";
		var check_flg_comma = "";
		if($("#check_active").prop('checked') == true){
			check_value += check_flg_comma + "1";
			check_flg_comma = ", "
		}
		if($("#check_idle").prop('checked') == true){
			check_value += check_flg_comma + "2";
			check_flg_comma = ", "
		}
		
		if($("#check_other").prop('checked') == true){
			check_value += check_flg_comma + "3, 4";
			check_flg_comma = ", "
		}
		
	if (check_value == "")
	{
		check_value = "1";
		$('#check_active').iCheck('check'); 
	}
	//alert (check_value)
	var add_data = {}
	add_data['f'] = '26';
	add_data['check_value'] = check_value;
	
	
	
	
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_4_static.php',
		data: (add_data)
	})
	.done(function(data) {
		//alert (data)
		var data = JSON.parse(data);
		var data_geo = [['CITY',  'จำนวน']];
		jQuery.each( data, function( i, val ) {
				var _temp = [];
				_temp.push(val.PROVINCE_NAME, parseInt(val.cnt));
				data_geo.push(_temp);
		});
	//console.log(data_geo);
	var data_map = google.visualization.arrayToDataTable(data_geo);
	  var options = {
		 //showTooltip: true,
		//showInfoWindow: true,
		region: 'TH',
		//displayMode: 'markers',
		resolution: 'provinces',
		//displayMode: 'markers',
		colorAxis: {colors: ['#FFFFFF', '#AD1231']}
		//colorAxis: {colors: ['#FFFFFF', '#FFDC00']}
		//colorAxis: {colors: ['#ffffff', '#99E0BF', '#91DCB9', '#8AD7B3',  '#A57BCB']}
		//colorAxis: {colors: ['#ffffff', '#DBD98F', '#CECB69', '#C0BC44']}
	  };

	  var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
	  chart.draw(data_map, options);
	  
	  $("#load_active_map").hide();
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
};
//select_skill
$( "#select_skill" ).change(function() {
	//alert ($(this).val())
	google.charts.setOnLoadCallback(drawMarkersMap_search);
});



function load_skill_list()
{
	var add_data = {}
	add_data['f'] = '28';
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
		jQuery.each( data_arr, function( i, val ) {
			print_text +="<option>"+val.skill+"</option>";
		});
		//alert (print_text);
		$("#select_skill").html(print_text);
		$('#select_skill').select2({ width: 'resolve' });
		google.charts.setOnLoadCallback(drawMarkersMap_search);
	})
	.fail(function() {
		// just in case posting your form failed
		alert("Posting failed.");
	});
}

 //check_active
$('#check_active').on('ifChecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});
$('#check_active').on('ifUnchecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});
 //check_idle
$('#check_idle').on('ifChecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});
$('#check_idle').on('ifUnchecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});
 //check_other
$('#check_other').on('ifChecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});
$('#check_other').on('ifUnchecked', function(event) {
	google.charts.setOnLoadCallback(drawMarkersMap_Province);
});

// Initial Run ========================================= 
google.charts.setOnLoadCallback(drawMarkersMap_Province);
get_geo_chart();
get_job_chart();
get_sex_chart();
get_status_chart();
get_new_mem_chart();
load_skill_list();
//get_heatmap();

});

	</script>


    <script type='text/javascript'>
    
    </script>
	

	</body>
</html>
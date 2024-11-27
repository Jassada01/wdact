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
    <title>Watch_Dog | Case Analysis</title>

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


    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        #chartdiv {
            width: 100%;
            height: 800px
        }

        .chip {
            margin: .1em 0.1em;
            display: inline-block;
            padding: 0 15px;
            height: 35px;
            font-size: 17px;
            line-height: 35px;
            border-radius: 25px;
            background-color: #ccffdd;
        }

		.table_tr:hover
			{
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
        .table_tr_post:hover
			{
				cursor: pointer;
			}
			
	</style>


</head>

<body class="hold-transition skin-blue <?php echo $menu_collapse_text; ?>  sidebar-mini">
    <div class="wrapper">
        <?php
        $fn = basename($_SERVER['PHP_SELF']);
        include 'menu.php';
        $ran_str = $_GET['ran_str'];
        $year = $_GET['year'];
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Case Analysis
                    <small>วิเคราะห์ข้อมูล <span id="tag_hdr_panel"></span> </small>
                </h1>

                <div class="breadcrumb">
                    <select id="select_year_case">
                    </select>
                </div>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><B><i class="fa fa-map"></i> การกระจายตัวของเคส</B></h3>
                            </div>

                            <div class="box-body">
                                <div id="chartdiv"></div>
                            </div>
                            <div class="overlay" id="load_map_ovl" style="display: none;">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><B><i class="fa fa-folder-open"></i> รายละเอียดเคส (<span id="case_count_list">..</span> เคส) </B></h3>
                            </div>

                            <div class="box-body" style="overflow:auto;height:375px;">
                                <ul class="products-list product-list-in-box" id="case_list_panel"></ul>
                            </div>
                            <div class="overlay" id="load_list_ovl" style="display: none;">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary  box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-puzzle-piece"></i> สถานะเคส</h3>
                            </div>
                            <div class="box-body">
                                    <div id="main_chartdiv" style="height: 375px;"></div>
                            </div>
                            <div class="overlay" id="load_status_ovl" style="display: none;">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
						</div>
					</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title"><B><i class="fa fa-facebook-square"></i>  โพสในศูนย์</B></h3>
                            </div>
                            <div class="box-body">
                            <div id="Table_Data">
                                    <table class="table datatable-basic display " id="style-1" style="width:100%">
                                    
                                        <thead>
                                            <tr>
                                                <th style="max-width:20%"></th>
                                                <th style="width:40%" class="text_search">ข้อความ</th>
                                                <th style="width:10%" class="text_search">โพสเมื่อ</th>
                                                <th style="width:15%" class="text_search">ผูกกับเคส</th>
                                                <th style="width:15%" class="text_search">สถานะเคส</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="table_result">
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>

                            
                            <div class="overlay" id="load_group_list_ovl" style="display: none;">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><B><i class="fa fa-facebook-square"></i>  โพสในเพจ</B></h3>
                            </div>
                            <div class="box-body">
                            <div id="Table_Data">
                                    <table class="table datatable-basic-2 display " id="style-1" style="width:100%">
                                    
                                        <thead>
                                            <tr>
                                                <th style="max-width:20%"></th>
                                                <th style="width:40%" class="text_search">ข้อความ</th>
                                                <th style="width:10%" class="text_search">โพสเมื่อ</th>
                                                <th style="width:15%" class="text_search">ผูกกับเคส</th>
                                                <th style="width:15%" class="text_search">สถานะเคส</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="table_result_2">
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>

                            
                            <div class="overlay" id="load_post_list_ovl" style="display: none;">
                                <i class="fa fa-refresh fa-spin"></i>
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

    


    <!--Amchart MAP Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="bower_components/Amchart/Map/thailandLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<!-- number_format -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
	
	<!-- Date Sort -->
	<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-dd-MMM-yyyy.js"></script>

	<!-- Moment with Local -->
    <script src="bower_components/moment/min/moment.min.js"></script>



    <!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
    <script>
        $(document).ready(function() {
            // Global var  =========================================
            var global_random_no = "";
            var current_search_result = {};
            var max_print_case = 18;
            var __RAN_STR = "<?php echo $ran_str; ?>"
            //alert(__RAN_STR);
            // Moment Setting
            moment.locale('th');
            // Page function ========================================= 

            function makeid() {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

                for (var i = 0; i < 15; i++)
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                return text;
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

            // Global Var ========================================
            map_data = [];
            __status_data = [];
            __MIN_MAP_VALUE = 0;
            __MAX_MAP_VALUE = 0;
            __TARGET_YEAR = '<?php echo $year?>';


            //alert(__TARGET_YEAR);



            // Page Function ========================================
            function Load_data() {
                //alert($("#select_year_case").val());
                $("#load_map_ovl").show();
                var add_data = {}
                add_data['f'] = '92';
                add_data['__RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data);
                        if (data != "[]") {
                            var ojb = JSON.parse(data);
                            $.each(ojb, function(index, val) {
                                if (__MIN_MAP_VALUE > parseInt(val.value)) {
                                    __MIN_MAP_VALUE = parseInt(val.value)
                                }
                                if (__MAX_MAP_VALUE < parseInt(val.value)) {
                                    __MAX_MAP_VALUE = parseInt(val.value)
                                }


                            });
                            //$("#search_group_post_result").html(print_text);
                        }
                        //console.log(ojb);
                        map_data = ojb;
                        load_map();
                        $("#load_map_ovl").hide();
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }



            function load_map() {
                //am4core.useTheme(am4themes_moonrisekingdom);
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create map instance
                var chart = am4core.create("chartdiv", am4maps.MapChart);

                // Set map definition
                chart.geodata = am4geodata_thailandLow;
                chart.seriesContainer.draggable = false;
                chart.seriesContainer.resizable = false;
                chart.maxZoomLevel = 1;


                // Set projection
                chart.projection = new am4maps.projections.Mercator();

                // Create map polygon series
                var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

                //Set min/max fill color for each area
                polygonSeries.heatRules.push({
                    property: "fill",
                    target: polygonSeries.mapPolygons.template,
                    //min: chart.colors.getIndex(1).brighten(1),
                    min: chart.colors.getIndex(1).brighten(5),
                    max: chart.colors.getIndex(1).brighten(-0.3)
                });

                // Make map load polygon data (state shapes and names) from GeoJSON
                polygonSeries.useGeodata = true;

                // Set heatmap values for each state
                polygonSeries.data = map_data;

                // Set up heat legend
                let heatLegend = chart.createChild(am4maps.HeatLegend);
                heatLegend.series = polygonSeries;
                heatLegend.align = "right";
                heatLegend.valign = "bottom";
                heatLegend.width = am4core.percent(20);
                heatLegend.marginRight = am4core.percent(4);
                heatLegend.minValue = __MIN_MAP_VALUE;
                heatLegend.maxValue = __MAX_MAP_VALUE + 1;

                heatLegend.orientation = "horizontal";
                heatLegend.padding(20, 20, 20, 20);
                heatLegend.valueAxis.renderer.labels.template.fontSize = 20;
                heatLegend.valueAxis.renderer.minGridDistance = 10;


                // Set up custom heat map legend labels using axis ranges
                var minRange = heatLegend.valueAxis.axisRanges.create();
                minRange.value = heatLegend.minValue;
                minRange.label.text = __MIN_MAP_VALUE.toString();
                var maxRange = heatLegend.valueAxis.axisRanges.create();
                maxRange.value = heatLegend.maxValue;
                //maxRange.label.text = (__MAX_MAP_VALUE + 1).toString();
                maxRange.label.text = "Max";

                // Blank out internal heat legend value axis labels
                heatLegend.valueAxis.renderer.labels.template.adapter.add("text", function(labelText) {
                    return "";
                });

                // Configure series tooltip
                var polygonTemplate = polygonSeries.mapPolygons.template;
                polygonTemplate.tooltipText = "[bold]{PROVINCE_NAME}: {value} เคส[/] \n {TOPIC}";
                polygonTemplate.nonScalingStroke = true;
                polygonTemplate.strokeWidth = 0.2;
                polygonTemplate.stroke = "#000000";

                // Create hover state and set alternative fill color
                var hs = polygonTemplate.states.create("hover");
                hs.properties.fill = am4core.color("#444");


                polygonSeries.mapPolygons.template.events.on("over", event => {
                    handleHover(event.target);
                });

                function handleHover(mapPolygon) {
                    if (!isNaN(mapPolygon.dataItem.value)) {
                        heatLegend.valueAxis.showTooltipAt(mapPolygon.dataItem.value);
                    } else {
                        heatLegend.valueAxis.hideTooltip();
                    }
                }

                // Create Onclick 
                polygonTemplate.events.on("hit", function(ev) {
                    // zoom to an object
                    //ev.target.series.chart.zoomToMapObject(ev.target);

                    // get object info
                    console.log(ev.target.dataItem.dataContext.name);
                });

            };




            function create_monthly_Purpose() {
                date_now = moment()
                print_text = "";
                for (i = 0; i < 36; i++) {
                    //alert(date_now.format('YYYY-MM-DD'));
                    if (date_now.isBefore('2018-01-01')) {
                        break;
                    }
                    if (__TARGET_YEAR == date_now.format('YYYY'))
                    {
                        print_text += "<Option value='" + date_now.format('YYYY') + "' selected>" + date_now.format('YYYY') + "</Option>";
                    }
                    else
                    {
                        print_text += "<Option value='" + date_now.format('YYYY') + "'>" + date_now.format('YYYY') + "</Option>";
                    }
                    
                    date_now.subtract(1, 'Year');
                }
                $("#select_year_case").html(print_text);
                Load_data();
                load_case_list();
                Load_status_chart_data();
                load_group_post_list();
                load_page_post_list();
            }
            $("#select_year_case").change(function() {
                //$('.datatable-basic').DataTable().destroy();
                //Load_data();
                //load_case_list();
                //Load_status_chart_data();
                //load_group_post_list();
                //load_page_post_list();
                window.location.replace('16_case_analysis.php?ran_str='+__RAN_STR+'&year='+$("#select_year_case").val());
            });

            function load_header_tag() {
                var add_data = {};
                add_data['f'] = '94';
                add_data['RAN_STR'] = __RAN_STR;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert(data)
                        //<div class="chip">งานช่าง</div>
                        var data_arr = JSON.parse(data);
                        print_text = "";
                        jQuery.each(data_arr, function(i, val) {
                            print_text += '<div class="chip">' + val.text_data + '</div>';
                        });
                        $("#tag_hdr_panel").html(print_text);

                    });
            }

            function load_case_list() {
                $("#load_list_ovl").show();
                var add_data = {};
                add_data['f'] = '95';
                add_data['RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        // alert(data)
                        print_text = "";
                        total_case_list = 0;
                        if (data != "[]")
                        {
                        var data_arr = JSON.parse(data);
                        //alert (data)
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
                            print_text += '<img src="' + val.img + '" >';
                            print_text += '</div>';
                            print_text += ' <div class="product-info">';
                            print_text += '<a href="14_case_data.php?case_id=' + val.case_id + '" class="product-title" target="_blank">' + val.print_case_id + " " + val.topic;
                            print_text += '<span class="label ' + text_color + ' pull-right">' + text_status + '</span></a>';
                            print_text += '<span class="product-description">';
                            print_text += val.t_sum;
                            print_text += '</span>';
                            print_text += '</div>';
                            print_text += '</li>';
                            total_case_list += 1

                        });
                        
                        
                    }
                    else
                    {
                        print_text = "<i><FONT color='red'><B>ไม่พบข้อมูล</FONT></B></i>"
                    }
                    $("#case_list_panel").html(print_text);
                    $("#case_count_list").html(total_case_list);
                    $("#load_list_ovl").hide();
                    });
            }

            function load_status_case()
            {
                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("main_chartdiv", am4charts.PieChart);

                // Add data
                chart.data = __status_data;

                // Add and configure Series
                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "CNT";
                pieSeries.dataFields.category = "crp_status";
                pieSeries.slices.template.stroke = am4core.color("#fff");
                pieSeries.slices.template.strokeOpacity = 1;

                // This creates initial animation
                pieSeries.hiddenState.properties.opacity = 1;
                pieSeries.hiddenState.properties.endAngle = -90;
                pieSeries.hiddenState.properties.startAngle = -90;

                chart.hiddenState.properties.radius = am4core.percent(0);

                chart.legend = new am4charts.Legend();
            }

            function Load_data_status() {
                //alert($("#select_year_case").val());
                $("#load_map_ovl").show();
                var add_data = {}
                add_data['f'] = '92';
                add_data['__RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data);
                        if (data != "[]") {
                            var ojb = JSON.parse(data);
                            $.each(ojb, function(index, val) {
                                if (__MIN_MAP_VALUE > parseInt(val.value)) {
                                    __MIN_MAP_VALUE = parseInt(val.value)
                                }
                                if (__MAX_MAP_VALUE < parseInt(val.value)) {
                                    __MAX_MAP_VALUE = parseInt(val.value)
                                }


                            });
                            //$("#search_group_post_result").html(print_text);
                        }
                        //console.log(ojb);
                        map_data = ojb;
                        load_map();
                        $("#load_map_ovl").hide();
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }


            function Load_status_chart_data() {
                //load_status_ovl
                $("#load_status_ovl").show();
                var add_data = {}
                add_data['f'] = '98';
                add_data['RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data);
                        //status_data
                        var ojb = JSON.parse(data);
                        __status_data = ojb;
                        load_status_case();
                        $("#load_status_ovl").hide();
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }
        

            $('.datatable-basic thead th').each( function () {
			if ($(this).hasClass( "text_search" ))
			{
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder=" '+title+'"  style="width:100%"/>' );
            }} );

            $('.datatable-basic-2 thead th').each( function () {
			if ($(this).hasClass( "text_search" ))
			{
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder=" '+title+'"  style="width:100%"/>' );
			}} );
        



        function load_group_post_list()
		{
			$("#load_post_list_ovl").show()
			
			if ($.fn.dataTable.isDataTable('.datatable-basic')) {
				$('.datatable-basic').DataTable().destroy();
			}
            
			var add_data = {}
                add_data['f'] = '99';
                add_data['RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
				//alert(add_data['select_year'])
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data)
						
							//alert(data)
							var print_text = "";
							var data_arr = JSON.parse(data);

							//console.log(data_arr)
							

							jQuery.each(data_arr, function(i, val) {
								print_text += "<TR >"
								print_text += "<TD  class='table_tr' value='"+val.id+"'><img src='"+val.full_picture+"'  style='object-fit: cover;' class='zoom'></img> </TD>"
								print_text += "<TD><H6 class='msg_boxmsg_box'>"+val.MSG.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+"</H6></TD>"

								case_add_time = moment(val.created_time, "YYYY-MM-DD hh:mm:ss").format('DD-MMM-YYYY')
								print_text += "<TD>"+case_add_time+"</TD>"
								if (val.CASE_ID != '-')
								{
									print_text += "<TD><a href='14_case_data.php?case_id="+val.CASE_ID+"' target='_blank'>"+val.print_case_id+"</a></TD>"
								}
								else
								{
									print_text += "<TD>"+val.print_case_id+"</TD>"
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
											
								if (val.STATUS_CODE != '-')
								{
										print_text += "<TD><span class='label' style='background-color:"+case_status_bg+"; color:"+case_status_font+";'>"+case_status_icon + " " +val.STATUS_TEXT+"</span></TD>"
								}
								else
								{
									print_text += "<TD>ยังไม่ได้ผูกเคส</TD>"
								}
								
								
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
								columnDefs: [
									   { type: 'date-dd-mmm-yyyy', targets: 0 }
								],
								"pageLength": 10,
							}
							// End Table Option -------------------
						);
						
						
						table_data.columns().every( function () {
							var that = this;
							$( 'input', this.header() ).on( 'keyup change clear', function () {
								if ( that.search() !== this.value ) {
									that
										.search( this.value )
										.draw();
								}
							} );
						} );
						//($("#Table_Data")).toggle();
						$("#load_post_list_ovl").hide()
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
        }





        function load_page_post_list()
		{
			$("#load_page_list_ovl").show()
			
			if ($.fn.dataTable.isDataTable('.datatable-basic-2')) {
				$('.datatable-basic-2').DataTable().destroy();
			}
			var add_data = {}
                add_data['f'] = '100';
                add_data['RAN_STR'] = __RAN_STR;
                add_data['select_year'] = $("#select_year_case").val();
				//alert(add_data['select_year'])
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data)
						
							//alert(data)
							var print_text = "";
							var data_arr = JSON.parse(data);

							//console.log(data_arr)
							

							jQuery.each(data_arr, function(i, val) {
								print_text += "<TR >"
								print_text += "<TD  class='table_tr_post' value='"+val.id+"'><img src='"+val.full_picture+"'  style='object-fit: cover;' class='zoom'></img> </TD>"
								print_text += "<TD><H6 class='msg_boxmsg_box'>"+val.MSG.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+"</H6></TD>"

								case_add_time = moment(val.created_time, "YYYY-MM-DD hh:mm:ss").format('DD-MMM-YYYY')
								print_text += "<TD>"+case_add_time+"</TD>"
								if (val.CASE_ID != '-')
								{
									print_text += "<TD><a href='14_case_data.php?case_id="+val.CASE_ID+"' target='_blank'>"+val.print_case_id+"</a></TD>"
								}
								else
								{
									print_text += "<TD>"+val.print_case_id+"</TD>"
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
											
								if (val.STATUS_CODE != '-')
								{
										print_text += "<TD><span class='label' style='background-color:"+case_status_bg+"; color:"+case_status_font+";'>"+case_status_icon + " " +val.STATUS_TEXT+"</span></TD>"
								}
								else
								{
									print_text += "<TD>ยังไม่ได้ผูกเคส</TD>"
								}
								
								
								print_text += "</TR>"
							});
							
							$("#table_result_2").html(print_text)
							
							
							
							
							
							//$('.datatable-basic').DataTable().clear().destroy();

							// Initial Table 
						var table_data = $('.datatable-basic-2').DataTable(
							// Table Option -----------------------
							 {
								"language": {
									"decimal": ".",
									"thousands": ","
								},
								columnDefs: [
									   { type: 'date-dd-mmm-yyyy', targets: 0 }
								],
								"pageLength": 10,
							}
							// End Table Option -------------------
						);
						
						
						table_data.columns().every( function () {
							var that = this;
							$( 'input', this.header() ).on( 'keyup change clear', function () {
								if ( that.search() !== this.value ) {
									that
										.search( this.value )
										.draw();
								}
							} );
						} );
						//($("#Table_Data")).toggle();
						$("#load_post_list_ovl").hide()
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
        }


        
        //table_tr
		$('body').on('click', '.table_tr', function() {
			 var target = $(this).attr('value')
             //alert(target)
			 var post_link = "https://www.facebook.com/groups/Watchdog.TAC1/" + target;
			 var win = window.open(post_link, '_blank');
            win.focus();
        });
        
        //table_tr
		$('body').on('click', '.table_tr_post', function() {
			 var target = $(this).attr('value')
             //alert(target)
			 var post_link = "https://www.facebook.com/372488206116588_" + target;
			 var win = window.open(post_link, '_blank');
            win.focus();
		});


        //https://www.facebook.com/372488206116588_

            // Initial Run ========================================= 
            create_monthly_Purpose();
            load_header_tag();

            //load_page_post_list();
            
            

        });
    </script>
</body>

</html>
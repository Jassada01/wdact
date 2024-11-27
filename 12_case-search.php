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
    <title>Watch_Dog | Case Search</title>

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

    <style>
    .cards {
        width: 100%;
        display: block;
        display: -webkit-block;
        justify-content: left;
        -webkit-justify-content: left;
        max-width: 100%;
        height: 200px;
        max-height: 200px;
        cursor: pointer;

    }

    .card_div {
        padding: 10px 10px 25px 10px;
    }

    .card__like {
        width: 18px;
    }

    .card__clock {
        width: 15px;
        vertical-align: middle;
        fill: #AD7D52;
    }

    .card__time {
        font-size: 12px;
        color: black;
        vertical-align: middle;

        top: 5px;
    }

    .card__ofd_type{
        font-size: 14px;
        color: #000;
        vertical-align: middle;
        position: absolute;
        font-weight: 400;
        top: 150px;
    }

    .card__clock-info {
        float: right;
    }

    .card__img {
        visibility: hidden;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 200px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;

    }

    .card__info-hover {
        position: absolute;
        padding: 16px;
        width: 100%;
        opacity: 0;
        top: 0;
    }

    .card__img--hover {
        transition: 0.2s all ease-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        position: absolute;
        height: 200px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        top: 0;

    }

    .card {
        margin-right: 25px;
        transition: all .4s cubic-bezier(0.175, 0.885, 0, 1);
        background-color: #fff;
        width: 100%;
        height: 350px;
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 13px 10px -7px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        box-shadow: 0px 30px 18px -8px rgba(0, 0, 0, 0.1);
        transform: scale(1.10, 1.10);
    }

    .card__info {
        z-index: 2;
        background-color: #fff;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        padding: 10px 15px 15px 15px;

    }

    .card__category {
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 400;
        color: #868686;
    }

    .card__title {
        margin-top: 5px;
        margin-bottom: 10px;
        font-weight: 300;

    }

    .card__by {
        font-size: 12px;
        position: absolute;
        left: 10px;
        bottom: 5px;
    }

    .card__author {
        text-decoration: none;
        color: #AD7D52;
    }
    .card__crp_type {
        font-size: 12px;
        border-radius: 15px 15px 15px 15px;
        max-width: 80%;
        color: #f1f0f0;
        padding: 7px 7px 5px 5px;
        opacity: 0.95;
        font-weight: 300;
        border: 2px solid white;
    }


    .card__case_status {
        position: absolute;
        left: 10px;
        top: 5px;
        font-size: 12px;
        border-radius: 15px 15px 15px 15px;
        max-width: 80%;
        color: #f1f0f0;
        padding: 7px 7px 5px 5px;
        opacity: 0.95;
        font-weight: 500;
        border: 2px solid white;
    }

    .card:hover .card__img--hover {
        height: 100%;
        opacity: 0.6;
        -webkit-filter: blur(5px);
        filter: blur(5px);
    }

    .card:hover .card__info {
        background-color: transparent;
    }

    .card:hover .card__info-hover {
        opacity: 1;

    }

    .card:hover .card__case_status {
        opacity: 0;

    }
    .card__link {
        position: absolute;
        font-weight: 500;
        right: 10px;
        bottom: 5px;
        font-size: 18px;
        opacity: 0;
    }

    .card:hover .card__category {
        color: #000;
        position: absolute;
        left: 20px;
        top: 10px;
        font-size: 18px;
    }

    .card:hover .card__title {
        color: #000;
        position: absolute;
        left: 10px;
        top: 50px;
        font-size: 18px;
    }

    .card:hover .card__by {
        position: absolute;
        left: 10px;
        bottom: 5px;
    }
    .card:hover .card__link {
        position: absolute;
        color:#002966;
        font-weight: 500;
        right: 10px;
        bottom: 5px;
        font-size: 18px;
        opacity: 1;
    }






    .adminActions {
        position: fixed;
        bottom: 35px;
        right: 35px;
    }

    .adminButton {
        height: 50px;
        width: 50px;
        background-color: rgba(67, 83, 143, 1);
        border-radius: 50%;
        display: block;
        color: #fff;
        text-align: center;
        position: relative;
        z-index: 1;
        box-shadow: 0px 5px 11px -2px rgba(0, 0, 0, 0.18),
            0px 4px 12px -7px rgba(0, 0, 0, 0.15);
    }

    .adminButton i {
        font-size: 22px;
    }

    .adminButtons {
        position: absolute;
        width: 100%;
        bottom: 120%;
        text-align: center;
    }

    .adminButtons a {
        display: block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        text-decoration: none;
        margin: 10px auto 0;
        line-height: 1.15;
        color: #fff;
        opacity: 0;
        visibility: hidden;
        position: relative;
        border: none;
        outline: none;
        box-shadow: 0 0 5px 1px rgba(51, 51, 51, 0.3);
    }

    .adminButtons a:hover {
        transform: scale(1.05);
    }

    .adminButtons a:nth-child(1) {
        background-color: #ff5722;
        transition: opacity .2s ease-in-out .3s, transform .15s ease-in-out;
    }

    .adminButtons a:nth-child(2) {
        background-color: #03a9f4;
        transition: opacity .2s ease-in-out .25s, transform .15s ease-in-out;
    }

    .adminButtons a:nth-child(3) {
        background-color: #f44336;
        transition: opacity .2s ease-in-out .2s, transform .15s ease-in-out;
    }

    .adminButtons a:nth-child(4) {
        background-color: #4CAF50;
        transition: opacity .2s ease-in-out .15s, transform .15s ease-in-out;
    }

    .adminActions a i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .adminToggle {
        -webkit-appearance: none;
        position: absolute;
        border-radius: 50%;
        top: 0;
        left: 0;
        margin: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        background-color: transparent;
        border: none;
        outline: none;
        z-index: 2;
        transition: box-shadow 0.2s ease-in-out;
        box-shadow: 0 3px 5px 1px rgba(51, 51, 51, 0.3);
        opacity: 0;
    }

    .adminToggle:hover {
        box-shadow: 0 3px 6px 2px rgba(51, 51, 51, 0.3);
    }

    .adminToggle:checked~.adminButtons a {
        opacity: 1;
        visibility: visible;
    }



    .expand_task_detail:hover {
        cursor: pointer;
    }

    #case_data_table tr:hover {
        cursor: pointer;
    }

    .chip:hover {
        cursor: pointer;
    }

    .chip_selected:hover {
        cursor: pointer;
    }


    .chip {
        margin: .2em 0.2em;
        display: inline-block;
        padding: 0 25px;
        height: 35px;
        font-size: 14px;
        line-height: 35px;
        border-radius: 25px;
        background-color: #efefef;
    }

    .chip_selected {
        margin: .2em 0.2em;
        display: inline-block;
        padding: 0 25px;
        height: 35px;
        font-size: 14px;
        line-height: 35px;
        border-radius: 25px;
        font-weight: bold;
        background-color: #99d6ff;
    }

    #select_contact_list:hover {
        cursor: pointer;
    }

    .cover_case_img {
        object-fit: cover;
    }

    .break-word {
        width: 100%;
        overflow-wrap: break-word;
    }

    .chat_sticker {
        width: 100%;
        max-width: 35%;
    }

    .chat_sticker_img {
        width: 100%;
        max-width: 50%;
        border-radius: 10px;
        border: 1px solid #bbb;
        padding: 5px;

    }

    .case_img {
        zoom: 2; 

        display: block;
        margin: auto;

        height: auto;
        max-height: 50px;

        width: auto;
        max-width: 100%;
    }

    .chat_msg_send {
        border-radius: 15px 15px 15px 15px;
        max-width: 80%;
        color: #111111;
        background: #DFDFDF;
        padding: 5px 10px 5px 10px;
    }

    .chat_msg_page {
        border-radius: 15px 15px 15px 15px;
        max-width: 80%;
        color: #f1f0f0;
        background: #1a90ff;
        padding: 5px 10px 5px 10px;
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
                    Case
                    <small>ข้อมูลเคส
					    <a type="button" href="12_case-search_2.php" class="btn btn-box-tool" ><i class="fa fa-search"></i> ค้นหาละเอียด</a>
                        <button type="button" class="btn btn-box-tool" id="export_to_excel_btn"><i class="fa fa-cloud-upload"></i> Export Data</button>
					    <span id="download_export_file"></span>
                    </small>
                    <div class="input-group pull-right" style="margin: 0 auto; width:200px;">
                        <input type="text" id="search_text_case"
                            style="color:#333;background-color:#CDCDCD;border-color: transparent; border-top-left-radius: 5px;border-bottom-left-radius: 5px"
                            class="form-control" placeholder="ค้นหาเคส" autocomplete="off" />
                        <span class="input-group-addon"
                            style="color:#333;background-color:#CDCDCD;border-color: transparent;border-top-right-radius: 5px;border-bottom-right-radius: 5px;"
                            id="load_spin_search_case"> <i class="fa fa-search"></i> </span>
                        <input type="text" style="display: none;">
                    </div>




                </h1>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">



                <section class="cards">
                    <span id="sum_result"></span>
                    <div class="row" id="case_show_panel">
                        <div class="col-xs-12"><i class="fa fa-refresh fa-spin"></i> โหลดข้อมูล...</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12" id="continue_load">

                            <button type="button" class="btn btn-block btn-default btn-lg">โหลดต่อ +</button>

                        </div>
                    </div>
                </section>












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

    <!-- Moment with Local -->
    <script src="bower_components/moment/min/moment-with-locales.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
    <script>
    $(document).ready(function() {
        // Global var  =========================================
        var global_random_no = "";
        var current_search_result = {};
        var max_print_case = 18;


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
            add_data['staff_key_id'] = '<?php echo $staff_key_id;?>';
            $.ajax({
                type: 'POST',
                dataType: "text",
                url: 'f_0_index.php',
                data: (add_data)
            });
        });

        // Global Var ========================================






        // Page Function ========================================



        //search_text_case
        $("#search_text_case").keyup(function() {
            var search_target = $(this).val();
            //alert(search_target);
            if (search_target.trim() == "") {
                $("#load_spin_search_case").html(' <i class="fa fa-search"></i> ')
                load_case_from_search("");
            } else {
                //load_spin_search_case
                $("#load_spin_search_case").html("<i class='fa fa-times'></fa>")
                load_case_from_search(search_target);
            }
        });

        function load_case_from_search(search_target) {
            $("#continue_load").html("");
            if ($("#case_show_panel").html() !=
                '<div class="col-xs-12"><i class="fa fa-refresh fa-spin"></i> โหลดข้อมูล...</div>') {
                $("#case_show_panel").html(
                    '<div class="col-xs-12"><i class="fa fa-refresh fa-spin"></i> โหลดข้อมูล...</div>')
                $("#sum_result").html("")
            }
            max_print_case = 18;
            random_id_search = makeid();
            var _temp_random_id_search = random_id_search;
            var add_data = {}
            add_data['f'] = '80';
            add_data['search_target'] = search_target;
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    
                    if (_temp_random_id_search == random_id_search) {
                        if (data != "[]") {

                            var data_arr = JSON.parse(data);
                            console.log(data_arr);
                            current_search_result = data_arr;
                            print_result();
                            //$("#case_show_panel").show("fast")
                        } else {
                            $("#case_show_panel").html(
                                '<font color="red"><div class="col-xs-12"><i class="fa fa-times "></i> ไม่พบข้อมูล </div></font>'
                            );
                        }
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        function print_result() {
            $("#continue_load").html("")
            var case_add_time;
            var case_status_bg = "";
            var case_status_icon = ""
            var cnt_print = 0;
            print_text = "";
            jQuery.each(current_search_result, function(i, val) {
                // Cnt
                cnt_print += 1
                if (cnt_print <= max_print_case) {
                    // Adjust text

                    if (val.topic.length > 60) {
                        val.topic = val.topic.substring(0, 60) + "...";
                    }

                    // status BG

                    case_status_bg = "";
                    case_status_font = "#FFF";

                    switch (val.status) {
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


                    case_add_time = moment(val.add_date, "YYYY-MM-DD").format('D MMM') + " " +(((parseInt(moment(val.add_date, "YYYY-MM-DD").format('YYYY')) + 543) % 100 ).toString())


                    print_text +=
                        '<div class="col-xs-6  col-sm-4 col-md-3 col-lg-2 card_div" id="show_case_info_hover" value="' + val.case_id + '">';
                    print_text += '<article class="card">';
                    print_text += '<div class="card__info-hover">';

                    print_text += '<div class="card__clock-info">';
                    print_text += '<span class="card__time">  ' + case_add_time +
                        '  </span>';
                    print_text += '</div>';
                    print_text += '<div class="card__ofd_type" > <span id="show_ofd_name_'+val.case_id+'"></span><BR><span id="show_ofd_type_'+val.case_id+'"></span></div>';
                    
                    print_text += '</div>';
                    //card__ofd_type
                    print_text +=
                        '<div class="card__img" style="background-image: url(' + val
                        .IMG + ')">';
                    print_text += '</div>';
                    print_text +=
                        '<div class="card__img--hover" style="background-image: url(' +
                        val.IMG + ')">';
                    print_text += '</div>';
                    print_text += '<div class="card__info">';
                    print_text +=
                        '<span class="card__case_status" style="background-color:' +
                        case_status_bg + '; color:' + case_status_font + '">' +
                        case_status_icon + ' ' + val.crp_status + ' </span>';
                    print_text += '<span class="card__category"> ' + val
                        .print_case_id +
                        '</span>';
                    print_text += '<h5 class="card__title">' + val.topic;
                    print_text += '</h5>';
                    
                    print_text += '</div>';
                    print_text += '<span class="card__by">' + val.province_name +
                        '</span>';
                        print_text += '<span class="card__link" id="jump_to_case" value="' + val.case_id + '" ><i class="fa fa-share-alt"></i> ดูเคส</span>';
                    print_text += '</article>';
                    print_text += '</div>';

                }
            });
            // Create 
            $("#case_show_panel").html(print_text);

            //Continuload show
            if (current_search_result.length > max_print_case) {
                $("#continue_load").html(
                    '<button type="button" class="btn btn-block btn-default btn-lg">โหลดต่อ +</button>')
            }

            // Print result
            if ($("#search_text_case").val() != "") {
                $("#sum_result").html('พบ <font color="red">"' + $("#search_text_case").val() + '"</font> ' +
                    current_search_result.length + ' เคส')
            } else {
                $("#sum_result").html('ทั้งหมด ' + current_search_result.length + ' เคส')
            }

        }


        //jump_to_case
        $('body').on('click', '#jump_to_case', function() {
            var target = $(this).attr('value')
            //alert(target)
            var win = window.open('14_case_data.php?case_id=' + target, '_blank');
            win.focus();
        });

        // continue_load
        $('body').on('click', '#continue_load', function() {
            max_print_case += 18;
            print_result();
        });

        // load_spin_search_case

        $('body').on('click', '#load_spin_search_case', function() {
            $("#load_spin_search_case").html(' <i class="fa fa-search"></i> ')
            $("#search_text_case").val("") 
            load_case_from_search("");
        });

        //show_case_info_hover
        $('body').on('mouseover', '#show_case_info_hover', function() {
            var target = $(this).attr('value');
            load_case_crp_type(target);
            load_case_ofd_name(target);
            
        });

        $('body').on('click', '#show_case_info_hover', function() {
            var target = $(this).attr('value');
            load_case_crp_type(target);
            load_case_ofd_name(target);
            
        });

        function load_case_crp_type(target)
        {
            var add_data = {}
            add_data['f'] = '42';
            add_data['case_id'] = target;
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert("#card__ofd_type_"+target)
                    $("#show_ofd_type_"+target).html("")
                    if (data!="[]")
                    {
                        //alert(data)
                        var print_text = "";
                        var data_arr = JSON.parse(data);
                        jQuery.each(data_arr, function(i, val) {
                            print_text += "<i class='fa  fa-dot-circle-o'></i> " + val.crp_type+'<BR>';
                            //print_text += val.crp_type;
                        });
                        $("#show_ofd_type_"+target).html(print_text)
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        function load_case_ofd_name(target)
        {
            var add_data = {}
            add_data['f'] = '81';
            add_data['case_id'] = target;
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert("#card__ofd_type_"+target)
                    $("#show_ofd_name_"+target).html("")
                    if (data!="[]")
                    {
                        //alert(data)
                        var print_text = "";
                        var data_arr = JSON.parse(data);
                        jQuery.each(data_arr, function(i, val) {
                            print_text += "<i class='fa  fa-bank'></i> " + val.ofd_name+'<BR>';
                            //print_text += val.crp_type;
                        });
                        //var temp_text = $("#show_ofd_type_"+target).html();
                        $("#show_ofd_name_"+target).html(print_text)
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        $('body').on('click', '#export_to_excel_btn', function() {
			$(this).hide()
			$("#download_export_file").html("<i class='fa fa-refresh fa-spin'></i> Create File...")
			var add_data = {}
			add_data['f'] = '104';
			add_data['select_year'] = 2020;
			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_1_case.php',
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




        // Initial Run ========================================= 
        //load_case_initial();
        load_case_from_search("");

    });
    </script>
</body>

</html>
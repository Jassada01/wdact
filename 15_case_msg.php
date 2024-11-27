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
    <title>Watch_Dog | Page Inbox</title>

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

    <style>
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



        .hover_pointer:hover {
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
                    Page Inbox

                </h1>

                <div class="breadcrumb">
                    <button type="button" class="btn btn-primary" id="btn_mng_good_msg">จัดการข้อความที่เป็นประโยชน์</button>
                </div>
            </section>
            <br>
            <!-- Main content -->
            <section class="content container-fluid">


                <div class="row">
                    <div class="col-md-4" style="height:100%;">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Inbox</h3>
                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" id="search_text_case_msg" class="form-control pull-right" placeholder="ค้นหา">

                                        <div class="input-group-btn">
                                            <span class="btn btn-default" id="load_spin_contact_list"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="overflow:auto;height:500px;">
                                <ul class="products-list product-list-in-box" style="padding-left: 5px;" id="contact_list_panel">


                                    <!-- /.item -->
                                </ul>
                            </div>
                            <!-- /.box-body -->
                            <!-- /.box-footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="col-md-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title" id="contact_name"></h3>
                                <div class="box-tools">
                                    <span id="case_id_connect"><span>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="direct-chat-messages" style="overflow:auto;height:700px;" id="msg_result_box">
                                    <!-- Message. Default to the left -->
                                    <i class="fa fa-refresh fa-spin"></i> Loading...
                                </div>
                            </div>
                            <div id="box_msg">
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="select_benx_review">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">ลูกเพจที่เคยส่งเรื่องมาเป็นเคสก่อนเดือน </h4>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <select id="select_good_msg_YM">
                                        </select>

                                    </div>
                                </div>
                                <BR>
                                <div class="row" style="display: none;" id="Panel_show_msg">
                                    <div class="col-md-4" style="height:100%;">
                                        <div class="box box-primary box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Inbox</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body" style="overflow:auto;height:500px;">
                                                <ul class="products-list product-list-in-box" style="padding-left: 5px;" id="contact_list_panel_small">
                                                    <!-- /.item -->
                                                </ul>
                                            </div>
                                            <!-- /.box-body -->
                                            <!-- /.box-footer -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="box box-success  box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title" id="contact_name_small"></h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="direct-chat-messages_small" style="overflow:auto;height:700px;" id="msg_result_box_small">

                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
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

            function isUrlValid(url) {
                return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i
                    .test(url);
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






            // Page Function ========================================

            function get_msg_contact_list(target_search = "") {
                // load_spin_contact_list
                if ($("#load_spin_contact_list").html() == '<i class="fa fa-search"></i>') {
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
                        //alert(data)
                        if (_temp_random_id_search == random_id_search) {
                            if (data != "[]") {
                                var data_arr = JSON.parse(data);
                                //console.log(data_arr)
                                var print_text = "";
                                var is_link_case = ""
                                jQuery.each(data_arr, function(i, val) {

                                    is_link_case = ""
                                    if (val.case_id != null) {
                                        is_link_case = "<font color='red'><i class='fa fa-link'></i></font>"
                                    }
                                    var ms = moment().diff(moment(val.update_time,
                                        "YYYY-MM-DD hh:mm:ss"));
                                    var print_time = "";

                                    if (ms < 259200000) {
                                        print_time = '<small class="contacts-list-date pull-right">' +
                                            moment(val.update_time, "YYYY-MM-DD hh:mm:ss").fromNow(
                                                null, {
                                                    sameElse: 'D MMM YY'
                                                }) + '</small>';
                                    } else {
                                        print_time = '<small class="contacts-list-date pull-right">' +
                                            moment(val.update_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                                null, {
                                                    sameElse: 'D MMM YY'
                                                }) + '</small>';
                                    }
                                    print_text +=
                                        '<li class="item hover_pointer" id="select_contact_list" target_id="' +
                                        val.msg_id + '" msg_url = "' + val.msg_link + '" >';
                                    print_text += '<div>';
                                    print_text += '<span><B>' + val.sender_name.replace(target_search,
                                            "<font color='red'>" + target_search + "</font>") +
                                        '</B> ' + is_link_case + '  <span class="pull-right">' + print_time + '</span></span>';
                                    print_text += '<span class="product-description">';
                                    print_text += val.MSG.replace(target_search, "<font color='red'>" +
                                        target_search + "</font>");
                                    print_text += '</span>';
                                    print_text += '</div>';
                                    print_text += '</li>';



                                });

                                $("#contact_list_panel").html(print_text)
                            } else {
                                $("#contact_list_panel").html(
                                    "<li><font color='red'>**ไม่พบข้อมูล**</font></li>")
                            }
                            $("#load_spin_contact_list").html('<i class="fa fa-search"></i>')
                        }
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }

            function query_msg(msg_id = "max", msg_url = "#") {
                if (msg_id != "max") {
                    $("#btn_click_toggle_contact_list").click();
                }

                load_case_with_msg(msg_id)

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
                        //alert(data)
                        if (data != "[]") {
                            var current_contact_name = "";
                            var data_arr = JSON.parse(data);
                            print_text = "";
                            jQuery.each(data_arr, function(i, val) {
                                other_msg = "";
                                //is_sticker_text = "direct-chat-text"
                                //alert("0")
                                //CHECK IS URL
                                if (isUrlValid(val.MSG)) {
                                    val.MSG = "<a href='" + val.MSG + "' target='_blank'>" + val.MSG
                                        .substring(0, 30) + "...</a>";
                                }

                                //alert("1")
                                if (val.Attached_flg == 'Y') {
                                    is_sticker_text = "";
                                    //alert (val.file_type)
                                    switch (val.file_type) {
                                        case "application/pdf":
                                            //alert (val.file_type)
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            break;
                                        case "image/jpeg":
                                            //alert (val.file_type)
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            other_msg = "<img class='chat_sticker_img' src='" + val
                                                .File_URL + "'></img>";
                                            break;
                                        default:
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            break;
                                    }
                                }

                                var ms = moment().diff(moment(val.created_time, "YYYY-MM-DD hh:mm:ss"));

                                if (val.From_ID == '372488206116588') {
                                    is_sticker_text = "chat_msg_page"
                                    if (val.sticker != "") {
                                        other_msg = "<img class='chat_sticker' src='" + val.sticker +
                                            "'></img>"
                                        is_sticker_text = "";
                                    }
                                    if (val.Attached_flg == 'Y') {
                                        is_sticker_text = "";
                                    }
                                    print_text += '<div class="direct-chat-msg right">';
                                    print_text += '<div class="direct-chat-info clearfix">';
                                    //print_text += '<span class="direct-chat-name pull-right">'+val.from_name+'</span><BR>';
                                    if (ms < 259200000) {
                                        print_text +=
                                            '<span class="direct-chat-timestamp pull-right">' + moment(
                                                val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {
                                                sameElse: 'DD MMMM YYYY'
                                            }) + '</span>';
                                    } else {
                                        print_text +=
                                            '<span class="direct-chat-timestamp pull-right">' + moment(
                                                val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                                null, {
                                                    sameElse: 'DD MMMM YYYY'
                                                }) + '</span>';
                                    }
                                    //alert("2")
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
                                        other_msg = "<img class='chat_sticker' src='" + val.sticker +
                                            "'></img>"
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
                                        print_text += '<span class="direct-chat-timestamp pull-left">' +
                                            moment(val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(
                                                null, {
                                                    sameElse: 'DD MMMM YYYY'
                                                }) + '</span>';
                                    } else {
                                        print_text += '<span class="direct-chat-timestamp pull-left">' +
                                            moment(val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                                null, {
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

                            $("#contact_name").html("<a href='https://www.facebook.com/" + msg_url + "' target='_blank'>" + current_contact_name + "</a>");

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

            //select_contact_list
            $('body').on('click', '#select_contact_list', function() {
                //alert($(this).attr('target_id'));
                query_msg($(this).attr('target_id'));
            });


            function load_case_with_msg(msg_id) {
                var add_data = {}
                add_data['f'] = '32';
                add_data['msg_id'] = msg_id;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_0_index.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        if (data == "[]") {
                            $("#case_id_connect").html("");
                        } else {
                            var data_arr = JSON.parse(data);
                            $("#case_id_connect").html('<a class="badge bg-green hover_pointer" href="14_case_data.php?case_id=' + data_arr[0].case_id + '">' + data_arr[0].case_id_show + '</a>');
                        }
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }



            //search_text_case_msg
            $("#search_text_case_msg").keyup(function() {
                var search_target = $(this).val();
                //alert(search_target);
                if (search_target.trim() == "") {
                    get_msg_contact_list();
                } else {
                    get_msg_contact_list(search_target);
                }
            });

            //btn_mng_good_msg
            $('body').on('click', '#btn_mng_good_msg', function() {
                generate_YM_for_select_good_msg();
                $("#Panel_show_msg").hide();
                $("#contact_name_small").html("");
                $("#msg_result_box_small").html('');

                $('#select_benx_review').modal('show');
            });

            function generate_YM_for_select_good_msg() {
                var print_YM = moment().endOf('month');
                var print_text = "<Option selected disabled > เลือกปี/เดือน</Option>"
                var p_case_id = ""
                var p_case_YM = ""


                for (i = 0; i <= 48; i++) {
                    p_case_id = String((parseInt(print_YM.format("YYYY")) + 543) - 2500) + print_YM.format("MM")
                    p_case_YM = print_YM.format("YYYYMM");


                    print_text += "<Option p_case_id='" + p_case_id + "' p_case_YM='" + p_case_YM + "' >"
                    print_text += print_YM.format("MMMM") + "  " + String((parseInt(print_YM.format("YYYY")) + 543) - 2500)
                    print_text += "</Option>"
                    print_YM.subtract(1, 'months').endOf('month');
                }
                $("#select_good_msg_YM").html(print_text);

            }

            $("#select_good_msg_YM").change(function() {
                $("#Panel_show_msg").show();
                Load_msg_for_good_select();
            });

            function Load_msg_for_good_select() {
                var p_case_id = $('option:selected', "#select_good_msg_YM").attr('p_case_id');
                var p_case_YM = $('option:selected', "#select_good_msg_YM").attr('p_case_YM');

                var add_data = {}
                add_data['f'] = '33';
                add_data['p_case_id'] = p_case_id;
                add_data['p_case_YM'] = p_case_YM;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_0_index.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        if (data != "[]") {
                            var data_arr = JSON.parse(data);
                            var print_text = "";
                            var is_link_case = ""
                            jQuery.each(data_arr, function(i, val) {

                                var ms = moment().diff(moment(val.update_time,
                                    "YYYY-MM-DD hh:mm:ss"));
                                var print_time = "";

                                print_text += '<li class="item"  target_id="' + val.msg_id + '" >';
                                print_text += '<div>';
                                if (val.rnd_str == null) {
                                    print_text += '<input type="checkbox"  class="good_msg_cb" value="' + val.msg_id + '" is_selected=' + val.rnd_str + '>';
                                } else {
                                    print_text += '<input type="checkbox"  class="good_msg_cb" value="' + val.msg_id + '" is_selected=' + val.rnd_str + ' checked>';
                                }


                                print_text += '<span class="hover_pointer" id="name_select_good_box" value="' + val.msg_id + '" snd_name="'+val.sender_name+'">  <B>' + val.sender_name +
                                    '</B>    </span>';

                                print_text += '</div>';
                                print_text += '</li>';

                            });

                            $("#contact_list_panel_small").html(print_text)
                        } else {
                            $("#contact_list_panel_small").html(
                                "<li><font color='red'>**ไม่พบข้อมูล**</font></li>")
                        }
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
            }

            //name_select_good_box
            $('body').on('click', '#name_select_good_box', function() {
                var target_value = $(this).attr('value');
                //var snd_name = $(this).attr('snd_name');

                $("#contact_name_small").html($(this).attr('snd_name'));

                $("#msg_result_box_small").html('<i class="fa fa-refresh fa-spin"></i> Loading...')
                var add_data = {};
                add_data['f'] = '30';
                add_data['msg_id'] = target_value;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_0_index.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert(data)
                        if (data != "[]") {
                            var current_contact_name = "";
                            var data_arr = JSON.parse(data);
                            print_text = "";
                            jQuery.each(data_arr, function(i, val) {
                                other_msg = "";
                                //is_sticker_text = "direct-chat-text"
                                //alert("0")
                                //CHECK IS URL
                                if (isUrlValid(val.MSG)) {
                                    val.MSG = "<a href='" + val.MSG + "' target='_blank'>" + val.MSG
                                        .substring(0, 30) + "...</a>";
                                }

                                //alert("1")
                                if (val.Attached_flg == 'Y') {
                                    is_sticker_text = "";
                                    //alert (val.file_type)
                                    switch (val.file_type) {
                                        case "application/pdf":
                                            //alert (val.file_type)
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            break;
                                        case "image/jpeg":
                                            //alert (val.file_type)
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-pdf-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            other_msg = "<img class='chat_sticker_img' src='" + val
                                                .File_URL + "'></img>";
                                            break;
                                        default:
                                            other_msg = '<a href="' + val.File_URL +
                                                '" target="_blank"><H4><i class="fa fa-file-o"> </i> <small><font color="#444444">' +
                                                val.file_name + '</font></small></H4></a>';
                                            break;
                                    }
                                }

                                var ms = moment().diff(moment(val.created_time, "YYYY-MM-DD hh:mm:ss"));

                                if (val.From_ID == '372488206116588') {
                                    is_sticker_text = "chat_msg_page"
                                    if (val.sticker != "") {
                                        other_msg = "<img class='chat_sticker' src='" + val.sticker +
                                            "'></img>"
                                        is_sticker_text = "";
                                    }
                                    if (val.Attached_flg == 'Y') {
                                        is_sticker_text = "";
                                    }
                                    print_text += '<div class="direct-chat-msg right">';
                                    print_text += '<div class="direct-chat-info clearfix">';
                                    //print_text += '<span class="direct-chat-name pull-right">'+val.from_name+'</span><BR>';
                                    if (ms < 259200000) {
                                        print_text +=
                                            '<span class="direct-chat-timestamp pull-right">' + moment(
                                                val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(null, {
                                                sameElse: 'DD MMMM YYYY'
                                            }) + '</span>';
                                    } else {
                                        print_text +=
                                            '<span class="direct-chat-timestamp pull-right">' + moment(
                                                val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                                null, {
                                                    sameElse: 'DD MMMM YYYY'
                                                }) + '</span>';
                                    }
                                    //alert("2")
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
                                        other_msg = "<img class='chat_sticker' src='" + val.sticker +
                                            "'></img>"
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
                                        print_text += '<span class="direct-chat-timestamp pull-left">' +
                                            moment(val.created_time, "YYYY-MM-DD hh:mm:ss").fromNow(
                                                null, {
                                                    sameElse: 'DD MMMM YYYY'
                                                }) + '</span>';
                                    } else {
                                        print_text += '<span class="direct-chat-timestamp pull-left">' +
                                            moment(val.created_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                                null, {
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

                            //$("#contact_name").html("<a href='https://www.facebook.com/" + msg_url + "' target='_blank'>" + current_contact_name + "</a>");

                            $("#msg_result_box_small").html(print_text)
                            var objDiv = document.getElementById("msg_result_box_small");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });

            });

            //good_msg_cb
            $('body').on('change', '.good_msg_cb', function() {
                var is_selected = $(this).attr('is_selected');
                var target_value = $(this).attr('value');

                if (this.checked) { // Insert 
                    var add_data = {}
                    add_data['f'] = '34';
                    add_data['target_value'] = target_value;
                    add_data['p_case_YM'] = $('option:selected', "#select_good_msg_YM").attr('p_case_YM');
                    $.ajax({
                            type: 'POST',
                            dataType: "text",
                            url: 'f_0_index.php',
                            data: (add_data)
                        })
                        .done(function(data) {
                            Load_msg_for_good_select();
                        })
                        .fail(function() {
                            // just in case posting your form failed
                            alert("Posting failed.");
                        });
                } else {
                    var add_data = {}
                    add_data['f'] = '35';
                    add_data['target_value'] = is_selected;
                    $.ajax({
                            type: 'POST',
                            dataType: "text",
                            url: 'f_0_index.php',
                            data: (add_data)
                        })
                        .done(function(data) {
                            Load_msg_for_good_select();
                        })
                        .fail(function() {
                            // just in case posting your form failed
                            alert("Posting failed.");
                        });
                }
            });






            // Initial Run ========================================= 
            get_msg_contact_list();
            query_msg();



        });
    </script>
</body>

</html>
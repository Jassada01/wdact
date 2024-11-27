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

    <!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

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
                    Target
                    <small>ตั้งค่าเป้าหมาย</small>


                </h1>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-success">
                            <div class="box-header">
                                <i class="fa fa-rocket"></i>
                                <h3 class="box-title">กำหนดเป้าหมาย</h3>
                            </div>
                            <div class="box-body">
                                <form class="form-horizontal" id="tab_add_tr_wd">

                                    <div class="form-group">
                                        <label for="tr_year" class="col-sm-4 control-label">เป้าหมายประจำปี</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right" id="tr_year"
                                                value="<?php echo date("Y");?>" autocomplete="off" disabled />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">ยอด Follow </label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="Follow"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">จำนวนคนเห็นโพส (Reach)
                                            ต่อเดือน </label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="Reach"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">จำนวนคนที่มีส่วนร่วม
                                            (Engagements) ต่อเดือน </label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target"
                                                id="Engagements" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt"
                                            class="col-sm-4 control-label">สัดส่วนผู้มีส่วนร่วมต่อผู้เห็นโพส Engagements
                                            / Reach ต่อเดือน</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="R_E_Ratio"
                                                autocomplete="off" />
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">Inbox ต่อเดือน</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="Inbox"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">Inbox ที่เป็นเคสได้
                                            ต่อเดือน</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="Inbox_qly"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tr_like_cnt" class="col-sm-4 control-label">อัตราการตอบกลับ Inbox
                                            (นาที)</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control pull-right val_target" id="IB_res"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-info pull-right"
                                    id="tr_btn_save">บันทึกการเปลี่ยนแปลง</button>
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
        function load_targer_year_data() {
            var add_data = {}
            add_data['f'] = '56';
            add_data['tr_year'] = $("#tr_year").val().trim();
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_3_staff.php',
                    data: (add_data)
                })
                .done(function(data) {
                    var ojb = JSON.parse(data);
                    $.each(ojb, function(i, val) {
                        $("#" + val.target_type).val(val.target);
                    });

                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        //tr_btn_save
        $('body').on('click', '#tr_btn_save', function() {
            save_date();
        });

        function save_date() {
            var check = 0;
            $('body input').each(function(i, obj) {
                //var target = ($(this).attr('class'));
                if ($(this).hasClass('val_target')) {
                    var add_data = {}
                    add_data['f'] = '57';
                    add_data['tr_year'] = $("#tr_year").val().trim();
                    add_data['target_type'] = $(this).attr('id');
                    add_data['target_value'] = $(this).val();

                    if ($.isNumeric($(this).val())) {
                        $(this).css({
                            'background-color': '#ffffff'
                        });
                        $.ajax({
                            type: 'POST',
                            dataType: "text",
                            url: 'f_3_staff.php',
                            data: (add_data)
                        });
                    }
                    else
                    {
                        $(this).css({
                            'background-color': '#ffb3b3'
                        });
                        check = 1;
                    }
                }
                
               


            });

            if (check == 0)
                {
                    swal({
							position: 'top-end',
							type: 'success',
							title: 'บันทึกการแก้ไขข้อมูลสำเร็จ',
							showConfirmButton: false,
							timer: 1000
						});
                }
                else
                {
                    swal({
							position: 'top-end',
							type: 'error',
							title: 'ข้อมูลไม่ถูกต้อง',
							showConfirmButton: false,
							timer: 1000
						});
                }
        }



        // Initial Run ========================================= 
        //load_case_initial();
        load_targer_year_data();


    });
    </script>
</body>

</html>
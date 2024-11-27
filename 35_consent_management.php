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

    <!-- Sweet Alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




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
                    Consent Management
                    <small>ตั้งค่าและ Download ข้อมูลส่วนบุคคล</small>


                </h1>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="box box-success">
                                        <div class="box-header">
                                        <select id="select_consent_option">
                                            <option value=1>คำยินยอมที่ 1 </option>
                                            <option value=2>คำยินยอมที่ 2 </option>
                                            <option value=3>คำยินยอมที่ 3 </option>
                                            <option value=4>คำยินยอมที่ 4 </option>
                                            <option value=5>คำยินยอมที่ 5 </option>
                                        </select>
                                            <h3 class="box-title" id="consent_name" style="display: none;"></h3> 
                                            <button type="button" class="btn btn-box-tool pull-right" id="export_data"><i class="fa fa-file-excel-o"></i> สร้างไฟล์ข้อมูล</button> <span class="pull-right" id="export_to_excel_btn_best_case_result" style="display: none;"></span>
                                        </div>
                                        <div class="box-body">
                                        <form class="form-horizontal" id="frm_consent_setting">
                                            <div class="form-group">
                                                <label for="consent_active" class="col-sm-4 control-label">เปิดใช้งาน</label>
                                                <div class="col-sm-8">
                                                    <input type="checkbox" id="consent_active_cb" class="flat-red" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="consent_desc" class="col-sm-4 control-label">คำยินยอม</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" id="consent_desc" style="overflow:auto;resize:none" rows="5" cols="20"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="consent_desc" class="col-sm-4 control-label"></label>
                                                <div class="col-sm-8">
                                                    <button type="button" class="btn btn-info  pull-right" id="btn_save">บันทึก</button>
                                                    <button type="button" class="btn btn-danger" id="btn_initial">Initial Data</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                        
                                        
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

    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
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

        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
        })


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
        var current_consent_id = 1;





        // Page Function ========================================
        function load_consent_master_data()
        {
            $("#export_to_excel_btn_best_case_result").hide("fast")
            $("#export_data").show("fast")
            var add_data = {}
                add_data['f'] = '1';
                add_data['consent_id'] = current_consent_id;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_35_consent.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        var ojb = JSON.parse(data);
						$.each(ojb, function(index, val) {
                            $("#consent_name").html("คำยินยอมที่ " + current_consent_id)
                            $("#consent_desc").val(val.consent_desc)
                            if (val.consent_active == 1 )
                            {
                                $('#consent_active_cb').iCheck('check');
                            }
                            else
                            {
                                $('#consent_active_cb').iCheck('uncheck');
                            }
                        });
                    });
        }



        //select_consent_option
        $("#select_consent_option").change(function(){
            //var selectedCountry = 
            var target = $(this).children("option:selected").val();
            current_consent_id = target;
            load_consent_master_data();
        });

        //btn_save
        $('body').on('click', '#btn_save', function() {
            var active_check = 0;
            if ($('#consent_active_cb').is(':checked'))
            {
                active_check = 1
            }
            var add_data = {}
                add_data['f'] = '2';
                add_data['consent_id'] = current_consent_id;
                add_data['consent_active'] = active_check;
                add_data['consent_desc'] = $("#consent_desc").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_35_consent.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                            })

                        load_consent_master_data()
                    });
		});
        


        function initial_consent_data()
        {
            var add_data = {}
                add_data['f'] = '3';
                add_data['consent_id'] = current_consent_id;
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_35_consent.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'ดำเนินการสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                            })

                    });
        }

        //btn_initial
        $('body').on('click', '#btn_initial', function() {
            Swal.fire({
                title: 'ต้องการตั้งต้นคำยินยอมใช่หรือไม่',
                text: "คำยินยอมของสมาชิกทั้งหมดจะถูกตั้งค่าเป็น ไม่ยินยอม",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#282',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่'
                }).then((result) => {
                if (result.isConfirmed) {
                    initial_consent_data()
                    }
            })
        
		});

        //export_data
        //btn_initial
        $('body').on('click', '#export_data', function() {
            $("#export_to_excel_btn_best_case_result").html("<i class='fa fa-refresh fa-spin'></i>");
            $("#export_to_excel_btn_best_case_result").toggle("fast")
            $("#export_data").toggle("fast")
            var add_data = {}
                add_data['f'] = '4';
                add_data['consent_id'] = current_consent_id;
                add_data['consent_desc'] = $("#consent_desc").val();
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_35_consent.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert(data)
                        $("#export_to_excel_btn_best_case_result").html(data);

                        
                    });
		});


























        // Initial Running ========================================
       load_consent_master_data()

    });
    </script>
</body>

</html>
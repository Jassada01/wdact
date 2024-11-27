<!DOCTYPE html>
<html>

<head>
    <?php
    ob_start();
    include "f_check_cookie.php";
    ob_end_clean();
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Watch_Dog | การตรวจสอบทุจริต</title>

    <!-- Site icon -->
    <link rel="icon" href="img/system_icon.ico">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- J-ui css-->
    <link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">
    <!-- Bootstrap Tagsinput Css -->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" rel="stylesheet">


    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>



    <style>
    .ui-autocomplete-category {
        font-weight: bold;
        padding: .2em .4em;
        margin: .8em 0.2em;
        line-height: 1.5;
    }
    </style>


    <style>
    .chip {
        margin: .2em 0.2em;
        display: inline-block;
        padding: 0 25px;
        height: 35px;
        font-size: 15px;
        line-height: 35px;
        border-radius: 25px;
        background-color: #ccffdd;
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

    .chip_add:hover {
        background-color: #b5b5b5;
        cursor: pointer;
    }

    .chip img {
        float: left;
        margin: 0 10px 0 -25px;
        height: 35px;
        width: 35px;
        border-radius: 50%;
    }

    .closebtn {
        padding-left: 10px;
        color: #888;
        font-weight: bold;
        float: right;
        font-size: 20px;
        cursor: pointer;
    }

    .addbtn {
        padding-right: 10px;
        color: #888;
        font-weight: bold;
        float: left;
        font-size: 20px;
        cursor: pointer;
    }

    .closebtn:hover {
        color: #000;
    }

    .div_select_page:hover {
        background-color: #b5b5b5;
        cursor: pointer;
    }

    .hover_pointer:hover {
        cursor: pointer;
    }
    </style>

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
                    Case
                    <small>เพิ่มเคส</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">ข้อมูลเบื้องต้นเคส</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f1">
                                <div class="box-body">
                                    <!-- Case ID -->
                                    <div class="form-group" id="case_id_form">
                                        <label for="c_ID" class="col-sm-2 control-label">เคส ID<font color="red">*
                                            </font></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="c_ID" placeholder="เคส ID"
                                                maxlength="7" pattern="\d*">
                                            <span class="help-block" id="show_error_duplicate_id"
                                                style="display: none;"><i class="fa fa-times-circle"></i> ID ซ้ำ <button
                                                    type="button" class="btn btn-primary btn-xs"
                                                    id="btn_auto_id_for_case">Auto ID</button></span>
                                        </div>

                                    </div>
                                    <!-- Topic -->
                                    <div class="form-group">
                                        <label for="c_name" class="col-sm-2 control-label">หัวข้อ<font color="red">*
                                            </font></label>
                                        <div class="col-sm-8">
                                            <div class="input-group" >
                                                <input type="text" class="form-control"  id="c_name" placeholder="หัวข้อ การทุจริต" maxlength="490"/>
                                                <div class="input-group-addon" id="unlock_case_name_text">
                                                    <i class="fa fa-exchange"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_summary" class="col-sm-2 control-label">รายละเอียด</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="c_summary"
                                                placeholder="รายละเอียดคร่าวๆ" maxlength="490">
                                        </div>
                                    </div>
                                    <div class="form-group" id="select_job_type_group">
                                        <label for="c_case_job_type" class="col-sm-2 control-label">ประเภทงาน</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="c_case_job_type"
                                                placeholder="ประเภทงาน">
                                            <div class="col-sm-12" id="c_case_job_type_panel">
                                            </div>
                                            <div class="col-sm-12" id="c_case_job_type_panel_select"
                                                style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Priority and Status -->
                                    <div class="form-group">
                                        <label for="c_priority" class="col-sm-2 control-label">ความสำคัญ</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="c_priority">
                                                <option value="0">รอได้</option>
                                                <option value="1" selected>ปกติ</option>
                                                <option value="2">สำคัญ</option>
                                                <option value="3">เร่งด่วน</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_status" class="col-sm-2 control-label">สถานะ</label>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="c_status" disabled>
                                                <option value="0">เรื่องใหม่</option>
                                                <option value="1">ทำข้อมูล</option>
                                                <option value="2">รอข้อมูล</option>
                                                <option value="3">ชะลอ</option>
                                                <option value="4">ยุติ</option>
                                                <option value="5">ลงเพจ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_status" class="col-sm-2 control-label">วันที่ลงระบบ</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker"
                                                disabled="disabled" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_status" class="col-sm-2 control-label">กำหนดเสร็จ</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker3"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <span>
                                                <h5><B class="text-blue"><span id="date-operation">0</span>
                                                        วันทำข้อมูล</B>
                                                </h5>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Note  -->
                                    <div class="form-group">
                                        <label for="c_note" class="col-sm-2 control-label">Note</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="c_note" placeholder="Note">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_cnt_url" class="col-sm-2 control-label">ลิ้งในศูนย์</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="c_cnt_url" placeholder="URL"
                                                style="display: none;">
                                            <button type="button" class="btn bg-primary"
                                                id="btn_add_case_link">...</button>
                                            <button type="button" class="btn bg-danger" id="Delete_selected_group_case"
                                                style="display: none;">ลบ</button>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="show_selected_group_post" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8" id="show_selected_group_post">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="c_fld_url" class="col-sm-2 control-label">Folder งาน</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="c_fld_url" placeholder="URL">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">ผู้ให้ข้อมูล</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="c_cnt_url" class="col-sm-2 control-label">ข้อความในเพจ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inb_msg_value"
                                                style="display: none;">
                                            <button type="button" class="btn bg-primary"
                                                id="btn_add_inb_msg">...</button>
                                            <span id="inb_temp_name"></span>
                                            <button type="button" class="btn bg-danger" id="delete_inb_msg"
                                                style="display: none;">ลบ</button>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="snd_name" class="col-sm-2 col-xs-12 control-label">ผู้ให้ข้อมูล<font
                                                color="red">*</font></label>
                                        <div class="col-sm-6 col-xs-8">
                                            <input type="text" class="form-control" id="snd_name"
                                                placeholder="หมาเฝ้าบ้าน/ลิ้งบุคคลภายนอก">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-xs-12 control-label">วันที่ส่งข้อมูล<font
                                                color="red">*</font></label>
                                        <div class="col-sm-4 col-xs-8">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="datepicker2"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            <font color="red"></font>
                                        </label>
                                        <div class="col-sm-4 col-xs-8">
                                            <div class="input-group date">
                                                <button type="button" class="btn bg-primary" id="add_snd">เพิ่ม</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12">
                                                <ul class="todo-list" id="snd_show_list">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">ผู้ร่วมปฏิบัติงาน</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f4" onSubmit="return false;">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="m_join_a" class="col-sm-2 col-xs-12 control-label">ชื่อ</label>
                                        <div class="col-sm-6 col-xs-8">
                                            <input type="text" class="form-control" id="m_join_a"
                                                placeholder="หมาเฝ้าบ้าน">
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <button type="button" class="btn bg-primary"
                                                id="btn-select-join-wd">เพิ่ม</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12">
                                                <ul class="todo-list" id="wd_join_list">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="m_join_team" class="col-sm-2 col-xs-12 control-label">ทีม</label>
                                        <div class="col-sm-6 col-xs-8">
                                            <select class="form-control" id="m_join_team">
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">

                                            <button type="button" class="btn bg-primary"
                                                id="btn-select-join-team">เพิ่ม</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12">
                                                <ul class="todo-list" id="team_join_list">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">หน่วยงานและผู้กระทำผิด</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f5">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <ul class="todo-list" id="ofd_lo_name_list">
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sw0" style="display: none;">
                                        <label for="ofd_lo_name" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <button type="button" class="btn bg-maroon pull-right" id="add_more_ofd"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sw1">
                                        <label for="ofd_lo_name" class="col-sm-2 control-label">หน่วยงาน<font
                                                color="red">*</font></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ofd_lo_name"
                                                placeholder="ชื่อหน่วยงาน">
                                        </div>
                                    </div>
                                    <div class="form-group" id="sw3">
                                        <label for="ofd_type_2" class="col-sm-2 control-label">ประเภทหน่วยงาน</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ofd_type_2"
                                                placeholder="ประเภทหน่วยงาน">
                                        </div>
                                    </div>
                                    <div class="form-group" id="sw3-1" style="display: none;">
                                        <label for="ofd_type_2" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8" id="ofd_type_2_select">

                                        </div>
                                    </div>

                                    <div class="form-group" id="sw2">
                                        <label for="ofd_ump" class="col-sm-2 col-xs-12 control-label">อำเภอ/จังหวัด<font
                                                color="red">*</font></label>
                                        <div class="col-sm-4 col-xs-6">
                                            <select class="form-control" id="ofd_add_province">
                                            </select>
                                        </div>
                                        <div class="col-sm-4 col-xs-6">
                                            <select class="form-control" id="ofd_add_aumpher">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" id="sw5">
                                        <label for="ofd_geo" class="col-sm-2 control-label">ภาค</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ofd_geo" placeholder="ภาค"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-group" id="sw4">
                                        <label for="select_org_type"
                                            class="col-sm-2 col-xs-12 control-label">ประเภทองค์กร<font color="red">*
                                            </font></label>
                                        <div class="col-sm-6 col-xs-8">
                                            <select class="form-control" id="select_org_type">
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <button type="button" class="btn bg-primary"
                                                id="add_ofd_name">เพิ่ม</button>
                                        </div>
                                    </div>
                                    <HR>
                                    <div class="form-group">
                                        <label for="ofd_person_name"
                                            class="col-sm-2 col-xs-12 control-label">ผู้กระทำผิด</label>
                                        <div class="col-sm-6 col-xs-10">
                                            <input type="text" class="form-control" id="ofd_person_name"
                                                placeholder="ชื่อ">
                                        </div>

                                        <!--
											<div  class="col-xs-2" id="add_ofd_person_img_panel" style="display: none;">
												<button type="button" class="btn  btn-outline" id="add_ofd_person_img"><font color="#D81B60"><B><i class="fa fa-image"></i></B></font></button>
											</div>
											-->

                                    </div>
                                    <div style="display: none;" id="person_name_btn_form">
                                        <div class="form-group">
                                            <label for="ofd_person_position" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6 col-xs-10">
                                                <input type="text" class="form-control" id="ofd_person_position"
                                                    placeholder="ตำแหน่ง">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ofd_person_detail" class="col-sm-2 control-label"></label>
                                            <div class="col-sm-6 col-xs-10">
                                                <input type="text" class="form-control" id="ofd_person_detail"
                                                    placeholder="รายละเอียด">

                                            </div>
                                            <div class="col-sm-2 ">
                                                <button type="button" class="btn bg-primary"
                                                    id="add_ofd_person_name">เพิ่ม</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <ul class="todo-list" id="ofd_person_name_panel">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>

                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title">ประเภทการทุจริตและความเสียหาย</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f8">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="crp_type_x2" class="col-sm-2 control-label">ประเภทการทุจริต<font
                                                color="red">*</font></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="crp_type_x2"
                                                placeholder="ประเภทการทุจริต">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="case_type_real_panel" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8" id="case_type_real_panel">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="case_type_real_panel_select" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8" id="case_type_real_panel_select" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ofd_dmg" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" id="cannot_esiamate_dmg" class="flat-red">
                                                    ไม่สามารถประเมินความเสียหายได้
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ofd_dmg" class="col-sm-2 control-label">มูลค่าโครงการ</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="ofd_dmg"
                                                placeholder="มูลค่าโครงการ" value="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ofd_dmg2" class="col-sm-2 control-label">ความเสียหาย</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="ofd_dmg2"
                                                placeholder="ความเสียหาย(วงเงิน)" value="0">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">ผู้รับเรือง</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" id="f2">
                                <div class="box-body">
                                    <div class="form-group" id="start_person_pn1">
                                        <label for="case_start_person" class="col-sm-2 control-label">ผู้รับเรื่อง<font
                                                color="red">*</font></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="case_start_person">
                                        </div>
                                    </div>
                                    <div class="form-group" id="start_person_pn2" style="display: none;">
                                        <label for="show_start_chip_panel" class="col-sm-2 control-label">ผู้รับเรื่อง
                                            <font color="red">*</font></label>
                                        <div class="col-sm-7" id="show_start_chip_panel">

                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="stf_input"
                                            class="col-sm-2 col-xs-12 control-label">ผู้ปฎิบัติงาน</label>
                                        <div class="col-sm-6 col-xs-10">
                                            <select class="form-control" id="case_staff">
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-xs-2">
                                            <button type="button" class="btn bg-primary pull-right"
                                                id="add_staff">เพิ่ม</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-8">
                                            <div class="col-sm-12">
                                                <ul class="todo-list" id="staff_list">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-header with-border text-center">
                            <button type="button" class="btn bg-primary btn-lg" id="submit_data">บันทึกข้อมูล</button>
                            <button type="button" class="btn bg-danger btn-lg"
                                onClick="window.location.reload()">ล้างข้อมูล</button>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.box -->
        <!-- --------------------- Modal --------------------- -->
        <div class="modal modal-default fade" id="modal-get-member">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">เลือกสมาชิกหมาเฝ้าบ้าน</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="snd_m_gen" class="col-sm-2 control-label">รุ่น/ชื่อ</label>
                            <div class="col-sm-3">
                                <select class="form-control" id="snd_m_gen">
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control" id="snd_m_name">
                                </select>
                            </div>
                        </div>
                        <Br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal" id="btn-select-wd">เลือก</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal modal-danger fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วน</h4>
                    </div>
                    <div class="modal-body">
                        <p>กรอกข้อมูลที่จำเป็นในช่องที่ไฮไลท์สีแดง</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" data-dismiss="modal">ปิด</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-summary">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">บันทึกข้อมูลสำเร็จ</h4>
                    </div>
                    <div class="modal-body" id="modal-summary-data">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="modal_send_data_info_update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ข้อมูลเพิ่มเติมสำหรับ ผู้ส่งข้อมูลภายนอก(แก้ไข)</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="f_snder_edit">
                            <div class="form-group">
                                <label for="snd_info_facebook_id" class="col-sm-2 control-label">ข้อมูลเดิม</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_facebook_id"
                                        placeholder="Link facebook" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="snd_info_facebook_e" class="col-sm-2 control-label">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_facebook_e"
                                        placeholder="Link facebook">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_Line_e" class="col-sm-2 control-label">Line</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_Line_e" placeholder="Line ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_mail_e" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_mail_e"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_tel_e" class="col-sm-2 control-label">โทร</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_tel_e" placeholder="เบอร์โทร">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  bg-primary" id="btn_edit_oth_snd">ตกลง</button>
                        <button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal_send_data_info">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ข้อมูลเพิ่มเติมสำหรับ ผู้ส่งข้อมูลภายนอก</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="f_snder">
                            <div class="form-group">
                                <label for="snd_info_facebook" class="col-sm-4 control-label">Facebook</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_facebook"
                                        placeholder="Link facebook">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_Line" class="col-sm-4 control-label">Line</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_Line" placeholder="Line ID">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_mail" class="col-sm-4 control-label">E-Mail</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_mail"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="snd_info_tel" class="col-sm-4 control-label">โทร</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_tel" placeholder="เบอร์โทร">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="snd_info_tel" class="col-sm-4 control-label">ตำแหน่ง/อาชีพ</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_occ"
                                        placeholder="ตำแหน่ง/อาชีพ">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="snd_info_tel" class="col-sm-4 control-label">ความเกี่ยวข้อง</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_relate"
                                        placeholder="ความเกี่ยวข้อง">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="snd_info_tel" class="col-sm-4 control-label">Note</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="snd_info_note" placeholder="Note">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  bg-primary" id="btn_add_oth_snd">ตกลง</button>
                        <button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal_select_support_type">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ประเภทการช่วย</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" id="f_supporter_wd">
                                    <select class="form-control" id="select_support_type_for_wd">
                                    </select>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  bg-primary" id="bt_confirm_add_suppot_wd">ตกลง</button>
                        <button type="button" class="btn  btn-danger pull-left" data-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal_add_from_group">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">โพสในศูนย์</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="f9">
                            <div class="box-body">

                                <div class="form-group" id="case_search_post_panel_2">
                                    <label for="group_post_search" class="col-sm-3 control-label">ค้นหา<font
                                            color="red">*</font></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="group_post_search"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <input type="text" class="form-control" autocomplete="off" style="display: none;">
                                <div class="form-group" id="search_group_post_result_panel">
                                    <label for="search_post_result_2" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-8" id="search_group_post_result">
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </form>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="select_inbox_msg">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ข้อความในเพจ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Conversations are loaded here -->
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="search_text_case_msg"
                                            style="border-top-left-radius: 5px;border-bottom-left-radius: 5px"
                                            class="form-control" placeholder="ค้นหา" autocomplete="off" />
                                        <span class="input-group-addon"
                                            style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;"
                                            id="load_spin_contact_list"><i class="fa fa-search"></i></span>
                                        <input type="text" style="display: none;">
                                    </div>
                                    <ul class="contacts-list" id="contact_list_panel">

                                    </ul>
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
    <!-- Select2 -->
    <!-- J-ui tab -->
    <script src="bower_components/jquery-ui/jquery-ui_new.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="bower_components/moment/min/moment-with-locales.js"></script>
    <!--<script src="bower_components/moment/min/moment.min.js"></script> -->
    <script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- bootstrap datepicker -->
    <script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <!-- Typehead -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


    <script>
    // Initial eliment ===================================================================
    // Set Moment 
    moment.locale('th');

    // Function  ===================================================================
    $(function() {
        $.widget("custom.catcomplete", $.ui.autocomplete, {
            _create: function() {
                this._super();
                this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
            },
            _renderMenu: function(ul, items) {
                var that = this,
                    currentCategory = "";
                $.each(items, function(index, item) {
                    var li;
                    if (item.category != currentCategory) {
                        ul.append("<li class='ui-autocomplete-category'>" + item.category +
                            "</li>");
                        currentCategory = item.category;
                    }
                    li = that._renderItemData(ul, item);
                    if (item.category) {
                        li.attr("aria-label", item.category + " : " + item.label);
                    }
                });
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {

        //Date picker
        $('#datepicker').datepicker({
            //dayNames: regional[ "th" ].dayNames,
            
            autoclose: true,
            language: 'th',
            format: 'dd/mm/yyyy'
            
        })

        //Date picker2
        $('#datepicker2').datepicker({
            autoclose: true,
            language: 'th',
            format: 'dd/mm/yyyy'
        })

        //Date picker3
        $('#datepicker3').datepicker({
            autoclose: true,
            language: 'th',
            format: 'dd/mm/yyyy'
        })

        function isUrlValid(url) {
            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i
                .test(url);
        }


        // Standard Ajax Function 
        function ajax_function($f, $d_name, $p1, $p2, $p3) {
            // Check parameter has been set or not
            $f = $f || "0";
            $p1 = $p1 || "0";
            $p2 = $p2 || "0";
            $p3 = $p3 || "0";
            // Set Ajax
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: ({
                        f: $f,
                        p1: $p1,
                        p2: $p2,
                        p3: $p3
                    })
                })
                .done(function(data) {
                    if ($($d_name).is('input')) {
                        $($d_name).val(data);
                    } else {
                        $($d_name).html(data);
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
            return false;
        };

        // Custom_for send data Ajax Function 
        function ajax_snd_data_function($f, $d_name) {
            // Check parameter has been set or not
            //$f = $f || "0";
            // Get All Data
            var add_data = {}
            add_data['f'] = '9';
            $("input").each(function(index) {
                add_data[$(this).attr('id')] = $(this).val();
            });
            // Get Priority
            add_data['c_priority'] = $("#c_priority").val();

            // Get Case Status
            add_data['c_status'] = $('#c_status').val();

            // Get cannot Estimate cannot_esiamate_dmg
            add_data['cannot_esiamate_dmg'] = $('#cannot_esiamate_dmg').is(':checked');

            // Input_Staff
            add_data['Input_staff'] = start_person_id;

            // Caser ingroup ID
            add_data['case_ingroup_id'] = case_ingroup_id;

            // Get Data from array
            //staff_list_arr
            add_data['staff_list_arr'] = staff_list_arr.join("-,-");

            //ofd_list
            add_data['ofd_list'] = ofd_list.join("-,-");

            //ofd_type
            add_data['ofd_type'] = ofd_type.join("-,-");

            //ofd_address
            add_data['ofd_address'] = ofd_address.join("-,-");


            //ofd_type_2
            add_data['ofd_type_2'] = ofd_type_2_arr.join("-,-");

            //wd_join_arr
            add_data['wd_join_arr'] = wd_join_arr.join("-,-");

            //wd_join_type_arr
            add_data['wd_join_type_arr'] = wd_join_type_arr.join("-,-");
            //alert (add_data['wd_join_type_arr'] );
            //team_join_arr
            add_data['team_join_arr'] = team_join_arr.join("-,-");

            //snd_list
            add_data['snd_list'] = snd_list.join("-,-");

            //snd_date
            add_data['snd_date'] = snd_date.join("-,-");

            //snd_line
            add_data['snd_line'] = snd_line.join("-,-");

            //snd_mail
            add_data['snd_mail'] = snd_mail.join("-,-");

            //snd_tel
            add_data['snd_tel'] = snd_tel.join("-,-");

            // Add 2019-03-02
            //snd_occ
            add_data['snd_occ'] = snd_occ.join("-,-");
            
            //snd_occ
            add_data['snd_relate'] = snd_relate.join("-,-");

            //snd_occ
            add_data['snd_note'] = snd_note.join("-,-");


            //snd_type
            add_data['snd_type'] = snd_type.join("-,-");

            // Staff Key _daya ID
            add_data['staff_key_id'] = '<?php echo $staff_key_id; ?>';


            // Ofd name and detail
            add_data['ofd_name_'] = ofd_name_arr.join("-,-");
            add_data['ofd_position_'] = ofd_position_arr.join("-,-");
            add_data['ofd_name_detail_'] = ofd_name_detail_arr.join("-,-");


            // c_case_job_type_arr
            add_data['c_case_job_type_'] = c_case_job_type_arr.join("-,-");

            // Case crp real type
            add_data['case_ofd_real_id_'] = case_ofd_real_id.join("-,-");
            add_data['case_ofd_real_data_'] = case_ofd_real_data.join("-,-");


            console.log(add_data);
            // Set Ajax
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert(data)
                    window.location.replace('14_case_data.php?case_id=' + data.replace(/[^0-9.]/g,""));

                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
            return false;
        };

        // ++++++++++++++++++ Operation function ++++++++++++++++++
        //Global Var
        var staff_list_arr = [];
        var staff_print_list_arr = [];

        var ofd_list = [];
        var ofd_type = [];
        var ofd_type_name = [];
        var ofd_address = [];
        var ofd_address_name = [];
        var ofd_address_name_p = [];
        var ofd_type_2_arr = [];

        var wd_join_arr = [];
        var wd_join_name_arr = [];
        var wd_join_type_arr = [];

        var team_join_arr = [];
        var team_join_print = [];

        var snd_wd_id = "";
        var snd_list = [];
        var snd_print = [];
        var snd_date = [];
        var snd_line = [];
        var snd_mail = [];
        var snd_tel = [];
        var snd_occ = [];
        var snd_relate = [];
        var snd_note = [];
        var snd_type = [];


        var ofd_name_arr = [];
        var ofd_position_arr = [];
        var ofd_name_detail_arr = [];


        var c_case_job_type_arr = [];

        var case_ofd_type_data_label = [];
        var case_ofd_type_data_id = [];


        var case_ofd_real_data = [];
        var case_ofd_real_id = [];

        var start_person_id = "";

        var availableTags_c_case_job_type = [];

        // Global RAN No
        var global_random_no = ""

        // case in group ID
        var case_ingroup_id = ""

        // Page Function ============================================================
        function makeid() {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 15; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            return text;
        }


        // Add staff on click
        $("#add_staff").click(function() {
            //alert($("#case_staff").val());
            //traning_list.push($("#m_training").val())
            if (jQuery.inArray($("#case_staff").val(), staff_list_arr) == -1) {
                if ($("#case_staff").val() !== null) {
                    staff_list_arr.push($("#case_staff").val())
                    staff_print_list_arr.push($("#case_staff option:selected").text())
                }

            }
            print_staff_list();
        });

        // make staff list output
        function print_staff_list() {
            //alert(traning_list);
            var print_text = "";
            $.each(staff_print_list_arr, function(index, value) {
                print_text += '<li><span class="text">' + value +
                    '</span><div class="tools"><i class="fa fa-trash-o" id="delete_staff_list" value="' +
                    value + '"></i></div></li>';
            });

            // Print output
            $("#staff_list").html(print_text);
        }







        // make staff list output
        function print_wd_list() {
            //alert(traning_list);
            var print_text = "";
            $.each(wd_join_name_arr, function(index, value) {
                print_text += '<li class="success"><span class="text">' + value +
                    '   <small class="text-muted">' + wd_join_type_arr[index] +
                    '</small></span><div class="tools"><i class="fa fa-trash-o" id="delete_wd_list" value="' +
                    value + '"></i></div></li>';
            });

            // Print output
            $("#wd_join_list").html(print_text);
        }

        // Get Aumpher when select Province==================
        $("#ofd_add_province").change(function() {
            // Call Function std Ajax for get Aumpher name
            ajax_function(2, "#ofd_add_aumpher", $(this).val());
            // Call Function std Ajax for get GEO name
            ajax_function(4, "#ofd_geo", $(this).val());
        });

        $('body').on('click', '#delete_wd_list', function() {
            var target = ($(this).attr('value'));
            $.each(wd_join_name_arr, function(index, value) {
                if (value == target) {
                    wd_join_name_arr.splice(index, 1);
                    wd_join_arr.splice(index, 1);
                    wd_join_type_arr.splice(index, 1);
                }
            });
            print_wd_list();
        });

        $('body').on('click', '#delete_staff_list', function() {
            //alert ($(this).attr('value'));
            var target = ($(this).attr('value'));
            $.each(staff_print_list_arr, function(index, value) {
                if (value == target) {
                    staff_print_list_arr.splice(index, 1);
                    staff_list_arr.splice(index, 1);
                }
            });
            print_staff_list();
        });

        // Chk Ofd_dmg
        $("#ofd_dmg").keyup(function() {
            chk_str = $("#ofd_dmg").val($.trim($("#ofd_dmg").val().replace(",", "")));
            if (!$.isNumeric($("#ofd_dmg").val())) {
                $("#ofd_dmg").val("");
            }
        });

        // Chk Ofd_dmg2
        $("#ofd_dmg2").keyup(function() {
            chk_str = $("#ofd_dmg2").val($.trim($("#ofd_dmg2").val().replace(",", "")));
            if (!$.isNumeric($("#ofd_dmg2").val())) {
                $("#ofd_dmg2").val("");
            }
        });

        //============== Submit Click ============================


        $("#submit_data").click(function() {
            check_duplicate_case_id_on_submit();
        });

        function check_input_before_send_data() {




            // Check data
            var target_check_list = ['c_ID', 'c_name', 'datepicker', 'datepicker2', 'datepicker3'];
            var check_rest = 0;

            $("input").each(function(index) {
                if (jQuery.inArray($(this).attr('id'), target_check_list) != -1) {
                    $(this).css({
                        'background-color': '#ffffff'
                    });
                    if ($(this).val() == "") {
                        check_rest = 1;
                        $(this).css({
                            'background-color': '#ffb3b3'
                        });
                    }
                }
            });

            // Check case start ID
            $("#case_start_person").css({
                'background-color': '#ffffff'
            });

            //alert (start_person_id)
            if (start_person_id == "") {
                check_rest = 1;
                $("#case_start_person").css({
                    'background-color': '#ffb3b3'
                });
            }


            // Check Ofd_Name and Location
            $("#ofd_add_aumpher").css({
                'background-color': '#ffffff'
            });

            $("#ofd_lo_name").css({
                'background-color': '#ffffff'
            });

            $("#select_org_type").css({
                'background-color': '#ffffff'
            });

            if (ofd_list.length < 1) {
                check_rest = 1;
                $("#ofd_add_aumpher").css({
                    'background-color': '#ffb3b3'
                });

                $("#ofd_lo_name").css({
                    'background-color': '#ffb3b3'
                });

                $("#select_org_type").css({
                    'background-color': '#ffb3b3'
                });
            }

            // Check sender person
            $("#snd_name").css({
                'background-color': '#ffffff'
            });

            if (snd_list.length < 1) {
                check_rest = 1;
                $("#snd_name").css({
                    'background-color': '#ffb3b3'
                });
            }

            // Check sender person
            $("#crp_type_x2").css({
                'background-color': '#ffffff'
            });
            if (case_ofd_real_id.length < 1) {
                check_rest = 1;
                $("#crp_type_x2").css({
                    'background-color': '#ffb3b3'
                });
            }

            // Check sender name
            $("#snd_name").css({
                'background-color': '#ffffff'
            });
            if (!(typeof snd_list !== 'undefined' && snd_list.length > 0)) {
                check_rest = 1;
                $("#snd_name").css({
                    'background-color': '#ffb3b3'
                });
            }
            //alert (check_rest);
            if (check_rest == 0)
            //if (1)
            {
                swal({
                    type: 'success',
                    title: 'กำลังบันทึกข้อมูล',
                    text: "กรุณารอสักครู่",
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                //check_duplicate_case_id_on_submit();
                ajax_snd_data_function(8, "#result");
                //alert ("OK");
            } else {
                $('#modal-danger').modal('show');
            }
        }

        $('#modal-summary').on('hidden.bs.modal', function() {
            window.location.reload()
        })

        // When date line change
        $("#datepicker3").change(function() {
            dt = $("#datepicker").val().split('/');
            var start_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])

            dt = $("#datepicker3").val().split('/');
            var end_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])

            if (end_date < start_date) {
                $("#datepicker3").datepicker("setDate", new Date());
            }
            cal_operation_date();
        });

        // When date แhange
        $("#datepicker").change(function() {
            dt = $("#datepicker").val().split('/');
            var start_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])

            dt = $("#datepicker3").val().split('/');
            var end_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])

            if (end_date < start_date) {
                $("#datepicker3").datepicker("setDate", ($(this).val()));
            }
            generate_case_id();
            cal_operation_date();
        });

        function cal_operation_date() {
            dt = $("#datepicker").val().split('/');
            var start_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])

            dt = $("#datepicker3").val().split('/');
            var end_date = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])
            //var date_1 = new Date($("#datepicker").val());
            //var date_2 = new Date($("#datepicker3").val());
            diff = end_date - start_date;
            diff_date = (diff / 1000 / 60 / 60 / 24) + 1;
            $("#date-operation").text(diff_date);
        }

        // Make Ofd  print
        function ofd_print() {
            var print_text = "";
            $.each(ofd_list, function(index, value) {
                //alert (ofd_address[index]);
                print_data = "<H4><B>" + value + "</B>  <small>" + ofd_address_name[index] +
                    "</small></H4><BR><samll>" + ofd_type_2_arr[index] + " (" + ofd_type_name[index] +
                    ") </small>";
                print_text += '<li class="danger"><span class="text">' + print_data +
                    '</span><div class="tools"><i class="fa fa-trash-o" id="delete_ofd_list" value="' +
                    value + '"></i></div></li>';
            });
            // Print output

            if (ofd_list.length > 0) {
                $("#sw1").hide();
                $("#sw2").hide();
                $("#sw3").hide();
                $("#sw4").hide();
                $("#sw5").hide();
                $("#sw0").show();

            } else {
                $("#sw1").show();
                $("#sw2").show();
                $("#sw3").show();
                $("#sw4").show();
                $("#sw0").hide();
                $("#sw5").show();
            }



            $("#ofd_lo_name_list").html(print_text);
            generate_case_name();
        }

        //add_more_ofd click
        $("#add_more_ofd").click(function() {
            $("#sw1").show();
            $("#sw2").show();
            $("#sw3").show();
            $("#sw4").show();
            $("#sw5").show();
            $("#sw0").hide();
        });
        $("#add_ofd_name").click(function() {
            var ofd_name_data = $("#ofd_lo_name").val();
            //alert ($("#select_org_type").val());
            if ((ofd_name_data.trim() !== "") && ($("#select_org_type").val() !== null) && ($(
                    "#ofd_add_aumpher").val() !== null)) {
                if (jQuery.inArray($("#ofd_lo_name").val(), ofd_list) == -1) {

                    ofd_list.push($("#ofd_lo_name").val());

                    ofd_type.push($("#select_org_type").val());
                    ofd_type_name.push($("#select_org_type option:selected").text());
                    ofd_type_2_arr.push($("#ofd_type_2").val());

                    ofd_address.push($("#ofd_add_aumpher").val());
                    ofd_address_name.push($("#ofd_add_aumpher option:selected").text() + "  " + $(
                        "#ofd_add_province option:selected").text());
                    

                    
                    ofd_address_name_p.push($("#ofd_add_province option:selected").text());
                    $("#ofd_lo_name").val("");
                    $("#ofd_add_aumpher").html("");
                    $("#ofd_geo").val("");
                    $("#ofd_type_2").val("");
                    $("#sw3-1").hide("fast");
                    ajax_function(1, "#ofd_add_province");
                    ajax_function(16, "#select_org_type");
                    ofd_print();

                    

                }

            }
        });
        // Ofd_Delete
        $('body').on('click', '#delete_ofd_list', function() {
            var target = ($(this).attr('value'));
            $.each(ofd_list, function(index, value) {
                if (value == target) {
                    ofd_list.splice(index, 1);

                    ofd_address.splice(index, 1);
                    ofd_address_name.splice(index, 1);
                    ofd_address_name_p.splice(index, 1);

                    ofd_type.splice(index, 1);
                    ofd_type_name.splice(index, 1);

                    ofd_type_2_arr.splice(index, 1);
                }
            });
            ofd_print();
        });













        // Add snder Click
        $("#add_snd").click(function() {
            //alert($("#snd_name").val());
            $("#snd_name").css({
                'background-color': '#ffffff'
            });
            if ($.trim($("#snd_name").val()) != "") {
                add_text = $("#snd_name").val();
                _id = add_text.substring(0, 8);
                //alert (add_text.substring(11))
                if ($.isNumeric(_id)) {
                    if (jQuery.inArray(_id, snd_list) == -1) {

                        dt = $("#datepicker2").val().split('/');
                        //var snd_date_data = new Date(dt[2] + '-' + dt[1] + '-' + dt[0])
                        var snd_date_data = $("#datepicker2").val();
                        var snd_date_data_print = dt[0] + '/' + dt[1] + '/' + (parseInt(dt[2]) + 543)
                            .toString();

                        snd_list.push(_id);
                        snd_date.push(snd_date_data);
                        snd_line.push("");
                        snd_mail.push("");
                        snd_tel.push("");
                        snd_occ.push("");
                        snd_relate.push("");
                        snd_note.push("");
                        snd_type.push("0");
                        snd_print.push(
                            '<img src="img/wd_img/default.png" height="25" width="25"  class="img-circle" alt="User Image">' +
                            add_text.substring(11) + " : " + snd_date_data_print);

                        snd_print_fnc();
                    }
                } else {
                    if (jQuery.inArray($("#snd_name").val(), snd_list) == -1) {
                        $('#f_snder').trigger("reset");
                        $("#snd_info_facebook").css({
                            'background-color': '#ffffff'
                        });
                        $("#snd_info_facebook").val($("#snd_name").val());
                        $('#modal_send_data_info').modal('show');
                    }
                }

            }
            $("#snd_name").val("");
        });

        // Make snd_print
        function snd_print_fnc() {
            //alert(traning_list);
            var print_text = "";
            $.each(snd_print, function(index, value) {
                var _id = snd_list[index].substring(0, 8);
                //alert (add_text.substring(11))
                if ($.isNumeric(_id)) {
                    print_text += '<li class="info"><span class="text">' + value +
                        '</span><div class="tools"><i class="fa fa-trash-o" id="delete_snd_list" value="' +
                        snd_list[index] + '"></i></div></li>';
                } else {
                    //print_text += '<li class="info"><span class="text">' + value + '</span><div class="tools"><i class="fa fa-pencil" id="edit_snd_oth" value="' + snd_list[index] + '"></i><i class="fa fa-trash-o" id="delete_snd_list" value="' + snd_list[index] + '"></i></div></li>';
                    print_text += '<li class="info"><span class="text">' + value +
                        '</span><div class="tools"><i class="fa fa-trash-o" id="delete_snd_list" value="' +
                        snd_list[index] + '"></i></div></li>';
                }
            });
            $("#snd_show_list").html(print_text);
        }

        // snd_Delete
        $('body').on('click', '#delete_snd_list', function() {
            var target = ($(this).attr('value'));
            $.each(snd_list, function(index, value) {
                if (value == target) {
                    snd_list.splice(index, 1);
                    snd_print.splice(index, 1);
                    snd_date.splice(index, 1);
                    snd_line.splice(index, 1);
                    snd_mail.splice(index, 1);
                    snd_tel.splice(index, 1);
                    // Add 2019-03-02
                    snd_occ.splice(index, 1);
                    snd_relate.splice(index, 1);
                    snd_note.splice(index, 1);

                    snd_type.splice(index, 1);
                }
            });
            snd_print_fnc();
        });

        // add_send key up
        $('#snd_name').keyup(function(e) {
            if (e.keyCode == 13) {
                $("#add_snd").trigger("click");
            }
        });



        // add_support WD  key up
        $('#m_join_a').keyup(function(e) {
            if (e.keyCode == 13) {
                $("#btn-select-join-wd").trigger("click");
            }
        });

        // Add Join team=============================
        $("#btn-select-join-team").click(function() {
            var team_id = $("#m_join_team").val();
            //alert (team_id);
            if (jQuery.inArray(team_id, team_join_arr) == -1) {
                //alert (team_id);
                team_join_arr.push(team_id);
                team_join_print.push($("#m_join_team option:selected").text());
                print_team_join();
            }
        });

        // Print team join
        function print_team_join() {
            var print_text = "";
            $.each(team_join_print, function(index, value) {
                print_text += '<li class="info"><span class="text">' + value +
                    '</span><div class="tools"><i class="fa fa-trash-o" id="delete_team_join" value="' +
                    team_join_arr[index] + '"></i></div></li>';
            });
            $("#team_join_list").html(print_text);
        }
        // snd_Delete
        $('body').on('click', '#delete_team_join', function() {
            var target = ($(this).attr('value'));
            $.each(team_join_arr, function(index, value) {
                if (value == target) {
                    team_join_arr.splice(index, 1);
                    team_join_print.splice(index, 1);
                }
            });
            print_team_join();
        });
        // snd_edit =================================================================================
        $('body').on('click', '#edit_snd_oth', function() {
            var target = ($(this).attr('value'));
            $.each(snd_list, function(index, value) {
                if (value == target) {
                    $('#f_snder_edit').trigger("reset");
                    $("#snd_info_facebook_e").css({
                        'background-color': '#ffffff'
                    });
                    $("#snd_info_facebook_id").val(snd_list[index]);
                    $("#snd_info_facebook_e").val(snd_list[index]);
                    $("#snd_info_Line_e").val(snd_line[index]);
                    $("#snd_info_mail_e").val(snd_mail[index]);
                    $("#snd_info_tel_e").val(snd_tel[index]);
                }
            });
            $('#modal_send_data_info_update').modal('show');

        });

        // If cannot estimate damage check
        $('#cannot_esiamate_dmg').on('ifChecked', function(event) {
            $("#ofd_dmg").val("0");
            $("#ofd_dmg2").val("0");

            $("#ofd_dmg").prop('disabled', true);
            $("#ofd_dmg2").prop('disabled', true);

            $("#case_type_real_panel_select").hide("fast");
        });

        // If cannot estimate damage uncheck
        $('#cannot_esiamate_dmg').on('ifUnchecked', function(event) {
            $("#ofd_dmg").val("0");
            $("#ofd_dmg2").val("0");

            $("#ofd_dmg").prop('disabled', false);
            $("#ofd_dmg2").prop('disabled', false);

            $("#case_type_real_panel_select").hide("fast");
        });

        // Add oth_snd.click    btn_add_oth_snd
        $("#btn_add_oth_snd").click(function() {
            if ($("#snd_info_facebook").val().trim() == "") {
                $("#snd_info_facebook").css({
                    'background-color': '#ffb3b3'
                });
            } else {
                dt = $("#datepicker2").val().split('/');
                var snd_date_data = $("#datepicker2").val();
                var snd_date_data_print = dt[0] + '/' + dt[1] + '/' + (parseInt(dt[2]) + 543)
                    .toString();
                var print_value = $("#snd_info_facebook").val();
                if (print_value.length > 20) {
                    print_value = print_value.substring(0, 30) + "...";
                }
                snd_date.push(snd_date_data);
                snd_list.push($("#snd_info_facebook").val());
                snd_print.push('<a href="' + $("#snd_info_facebook").val() + '" target="_blank">' +
                    print_value + "</a> : " + snd_date_data_print);
                snd_line.push($("#snd_info_Line").val());
                snd_mail.push($("#snd_info_mail").val());
                snd_tel.push($("#snd_info_tel").val());

                // Add 2019-03-02
                snd_occ.push($("#snd_info_occ").val());
                snd_relate.push($("#snd_info_relate").val());
                snd_note.push($("#snd_info_note").val());

                snd_type.push("1");
                $('#modal_send_data_info').modal('hide');
                snd_print_fnc();
            }
        });

        // edit oth_snd.click    btn_add_oth_snd
        $("#btn_edit_oth_snd").click(function() {
            if ($("#snd_info_facebook_e").val().trim() == "") {
                $("#snd_info_facebook_e").css({
                    'background-color': '#ffb3b3'
                });
            } else {

                var target = $("#snd_info_facebook_id").val()
                $.each(snd_list, function(index, value) {
                    if (value == target) {

                        dt = snd_date[index].split('/');
                        var snd_date_data_print = dt[0] + '/' + dt[1] + '/' + (parseInt(dt[2]) +
                            543).toString();

                        print_value = $("#snd_info_facebook_e").val();
                        if (print_value.length > 20) {
                            print_value = print_value.substring(0, 30) + "...";
                        }
                        snd_list[index] = $("#snd_info_facebook_e").val();
                        snd_print[index] = '<a href="' + $("#snd_info_facebook_e").val() +
                            '" target="_blank">' + print_value + "</a> : " +
                            snd_date_data_print;
                        snd_line[index] = $("#snd_info_Line_e").val();
                        snd_mail[index] = $("#snd_info_mail_e").val();
                        snd_tel[index] = $("#snd_info_tel_e").val();
                    }
                });
                $('#modal_send_data_info_update').modal('hide');
                snd_print_fnc();
            }
        });

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


        function generate_case_id() {
            var add_data = {}
            add_data['f'] = '38';
            add_data['case_add_date'] = $("#datepicker").val();
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    $("#c_ID").val(data);
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }





        $("#c_ID").keyup(function() {
            $("#show_error_duplicate_id").hide("fast");
            $("#case_id_form").removeClass("has-error");
            $('#submit_data').prop('disabled', false);
            temp_case_id = $(this).val();
            if (temp_case_id.length == 7) {
                check_duplicate_case_id(temp_case_id)
            }
        });

        function check_duplicate_case_id(check_case_id) {
            var add_data = {}
            add_data['f'] = '39';
            add_data['check_case_id'] = check_case_id;
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    if (data != "0") {
                        $("#case_id_form").addClass("has-error");
                        $("#show_error_duplicate_id").show("fast");
                        $('#submit_data').prop('disabled', true);
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        function check_duplicate_case_id_on_submit() {
            //alert ("as;als;la;sl");
            var add_data = {}
            add_data['f'] = '39';
            add_data['check_case_id'] = $("#c_ID").val();
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {

                    if (data != "0") {
                        $("#case_id_form").addClass("has-error");
                        $("#show_error_duplicate_id").show("fast");
                        $('#submit_data').prop('disabled', true);
                    } else {
                        check_input_before_send_data();
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        // btn_auto_id_for_case
        $("#btn_auto_id_for_case").click(function() {
            generate_case_id();
            $("#show_error_duplicate_id").hide("fast");
            $("#case_id_form").removeClass("has-error");
            $('#submit_data').prop('disabled', false);
        });



        //ofd_person_name
        $("#ofd_person_name").keyup(function() {
            if ($("#ofd_person_name").val().trim() == "") {
                $("#person_name_btn_form").hide("fast");
                $("#add_ofd_person_img_panel").hide("fast");
            } else {
                $("#person_name_btn_form").show("fast");
                $("#add_ofd_person_img_panel").show("fast");
            }
        });


        //add_ofd_person_name
        $("#add_ofd_person_name").click(function() {
            ofd_name_arr.push($("#ofd_person_name").val().trim());
            ofd_position_arr.push($("#ofd_person_position").val().trim());
            ofd_name_detail_arr.push($("#ofd_person_detail").val().trim());

            $("#ofd_person_name").val("");
            $("#ofd_person_position").val("");
            $("#ofd_person_detail").val("");

            $("#person_name_btn_form").hide("fast");
            $("#add_ofd_person_img_panel").hide("fast");

            print_ofd_name();
        });



        function print_ofd_name() {
            var print_text = "";
            $.each(ofd_name_arr, function(index, value) {
                print_arr_detail = "";
                if (ofd_name_detail_arr[index] != "") {
                    print_arr_detail = "<BR><small>" + ofd_name_detail_arr[index] + "</small>";
                }

                if (ofd_position_arr[index] == "") {
                    print_text += '<li  class="danger"><span class="text">' + value + print_arr_detail +
                        '</span><div class="tools"><i class="fa fa-times-circle" id="del_ofd_person_name" value="' +
                        index + '"></i></div></li>';
                    //print_text += '<div class="chip">'+value+'<span class="closebtn" id="del_ofd_person_name" value="'+index+'"><i class="fa fa-times"></i></span></div>';
                } else {
                    print_text += '<li class="danger"><span class="text">' + value + " (" +
                        ofd_position_arr[index] + " )" + print_arr_detail +
                        ' </span><div class="tools"><i class="fa fa-times-circle" id="del_ofd_person_name" value="' +
                        index + '"></i></div></li>';
                    //print_text += '<div class="chip">'+value+' ('+ofd_position_arr[index]+')<span class="closebtn" id="del_ofd_person_name" value="'+index+'"><i class="fa fa-times"></i></span></div>';
                }
            });
            $("#ofd_person_name_panel").html(print_text);
        }

        $('body').on('click', '#del_ofd_person_name', function() {
            var target = ($(this).attr('value'));
            ofd_name_arr.splice(target, 1);
            ofd_position_arr.splice(target, 1);
            ofd_name_detail_arr.splice(target, 1);
            print_ofd_name();
        });



        //c_case_job_type
        $('#c_case_job_type').keyup(function(e) {
            if (e.keyCode == 13) {
                if ($(this).val().trim() != "") {
                    if (jQuery.inArray($(this).val().trim(), c_case_job_type_arr) == -1) {
                        c_case_job_type_arr.push($(this).val());
                    }

                }
                $(this).val("");
                print_c_case_job_type();
            }
        });

        // Print c_case_job_type
        function print_c_case_job_type() {
            var print_text = "";
            $.each(c_case_job_type_arr, function(index, value) {
                print_text += '<div class="chip">' + value +
                    '<span class="closebtn" id="delete_c_case_job_type" value="' + index +
                    '">&times;</span></div>';
            });
            $('#c_case_job_type_panel').html(print_text);
        }


        $('body').on('click', '#delete_c_case_job_type', function() {
            var target = ($(this).attr('value'));
            c_case_job_type_arr.splice(target, 1);
            print_c_case_job_type();
        });






        function get_crp_type_data() {
            var add_data = {}
            add_data['f'] = '41';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert (data)
                    var ojb_data = JSON.parse(data);

                    case_ofd_type_data_id = [];
                    case_ofd_type_data_label = []

                    $.each(ojb_data, function(index, value) {
                        case_ofd_type_data_label.push(ojb_data[index].label)
                        case_ofd_type_data_id.push(ojb_data[index].id)
                    });

                    $("#crp_type_x2").autocomplete({
                        minLength: 0,
                        source: ojb_data,
                        focus: function(event, ui) {
                            $("#crp_type_x2").val(ui.item.label);
                            return false;
                        },
                        select: function(event, ui) {
                            if (jQuery.inArray(ui.item.id, case_ofd_real_id) == -1) {
                                case_ofd_real_id.push(ui.item.id);
                                case_ofd_real_data.push(ui.item.label);
                            }
                            $("#crp_type_x2").val("");
                            print_ofd_type_real_data();
                            return false;
                        }
                    });


                    print_crp_type_select_panel();
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }


        // add_send key up
        $('#crp_type_x2').keyup(function(e) {
            if (e.keyCode == 13) {
                if ($(this).val().trim() != "") {
                    if (jQuery.inArray($(this).val().trim(), case_ofd_real_data) == -1) {
                        var check_value = jQuery.inArray($(this).val().trim(),
                            case_ofd_type_data_label);
                        //alert (check_value)
                        if (check_value >= 0) {
                            case_ofd_real_id.push(case_ofd_type_data_id[check_value]);
                            case_ofd_real_data.push(case_ofd_type_data_label[check_value]);
                        } else {
                            case_ofd_real_id.push("99999");
                            case_ofd_real_data.push($(this).val().trim());
                        }
                    }
                    print_ofd_type_real_data();
                }
                $("#crp_type_x2").val("");
            }
        });


        $('#crp_type_x2').focusout(function(e) {
            if ($(this).val().trim() != "") {
                if (jQuery.inArray($(this).val().trim(), case_ofd_real_data) == -1) {
                    var check_value = jQuery.inArray($(this).val().trim(), case_ofd_type_data_label);
                    //alert (check_value)
                    if (check_value >= 0) {
                        case_ofd_real_id.push(case_ofd_type_data_id[check_value]);
                        case_ofd_real_data.push(case_ofd_type_data_label[check_value]);
                    } else {
                        case_ofd_real_id.push("99999");
                        case_ofd_real_data.push($(this).val().trim());
                    }
                }
                print_ofd_type_real_data();
            }
            $("#crp_type_x2").val("");
        });

        function print_ofd_type_real_data() {
            var print_text = "";
            $.each(case_ofd_real_data, function(index, value) {
                print_text += '<div class="chip">' + value +
                    '<span class="closebtn" id="delete_case_type_real" value="' + index +
                    '">&times;</span></div>';
            });
            $('#case_type_real_panel').html(print_text);
            generate_case_name();
        }

        $('body').on('click', '#delete_case_type_real', function() {
            var target = ($(this).attr('value'));
            case_ofd_real_id.splice(target, 1);
            case_ofd_real_data.splice(target, 1);
            print_ofd_type_real_data();
        });





        //add_case_type_real
        $('body').on('click', '#add_case_type_real', function() {
            var target = ($(this).attr('value'));
            if (jQuery.inArray(target, c_case_job_type_arr) == -1) {
                c_case_job_type_arr.push(target);
            }
            print_c_case_job_type();
        });

        $("#c_case_job_type").focus(function() {
            $("#c_case_job_type_panel_select").show("fast");
        });

        $("#snd_name").focus(function() {
            $("#c_case_job_type_panel_select").hide("fast");
        });

        $("#c_priority").focus(function() {
            $("#c_case_job_type_panel_select").hide("fast");
        });

        $("#datepicker").focus(function() {
            $("#c_case_job_type_panel_select").hide("fast");
        });

        $("#datepicker3").focus(function() {
            $("#c_case_job_type_panel_select").hide("fast");
        });

        $("#c_cnt_url").focus(function() {
            $("#c_case_job_type_panel_select").hide("fast");
        });



        // Print label for each cry pype select
        function print_crp_type_select_panel() {
            var print_text = "";
            $.each(case_ofd_type_data_id, function(index, value) {
                print_text += '<div class="chip_add" id="add_crp_type_real" value="' + value +
                    '" value_2="' + case_ofd_type_data_label[index] + '"> + ' +
                    case_ofd_type_data_label[index] + '</div>';
            });
            $('#case_type_real_panel_select').html(print_text);
        }

        //add_case_type_real
        $('body').on('click', '#add_crp_type_real', function() {
            var target = ($(this).attr('value'));
            if (jQuery.inArray(target, case_ofd_real_id) == -1) {
                case_ofd_real_id.push(target);
                case_ofd_real_data.push($(this).attr('value_2'));
            }
            print_ofd_type_real_data();
        });

        //crp_type_x2
        $("#crp_type_x2").focus(function() {
            $("#case_type_real_panel_select").show("fast");
        });

        $("#ofd_dmg").focus(function() {
            $("#case_type_real_panel_select").hide("fast");
        });

        $("#ofd_dmg2").focus(function() {
            $("#case_type_real_panel_select").hide("fast");
        });



        //add_case_type_real
        $('body').on('click', '#btn_ofd_type_2_selected', function() {
            var target = ($(this).attr('value'));
            $("#ofd_type_2").val(target);
            $("#sw3-1").hide("fast");
        });

        $("#ofd_type_2").focus(function() {
            $("#sw3-1").show("fast");
        });


        function get_auto_complete_tag() {
            var add_data = {}
            add_data['f'] = '51';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    var availableTags = JSON.parse(data);
                    $("#snd_name").catcomplete({
                        source: availableTags
                    });

                    $("#m_join_a").catcomplete({
                        source: availableTags
                    });
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        function get_auto_complete_tag_with_staff() {
            var add_data = {}
            add_data['f'] = '52';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert(data)
                    var availableTags = JSON.parse(data);

                    $("#case_start_person").catcomplete({
                        source: availableTags,
                        select: function(event, ui) {
                            $("#show_start_chip_panel").html('<div class="chip">' + ui.item
                                .value2 +
                                '<span class="closebtn" id="delete_start_person_btn">&times;</span></div>'
                            );
                            start_person_id = ui.item.value;
                            $("#start_person_pn1").toggle("fast");
                            $("#start_person_pn2").toggle("fast");
                        }
                    });



                    
                    

                    
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });

                //alert("aa")
                $("#show_start_chip_panel").html('<div class="chip">' + '<?php echo $user_name; ?>' +'<span class="closebtn" id="delete_start_person_btn">&times;</span></div>');
                    start_person_id = '<?php echo $staff_key_id; ?>';;
                    $("#start_person_pn1").toggle("fast");
                    $("#start_person_pn2").toggle("fast");
                    //alert("ิิbb")


        }

        //add_case_type_real
        $('body').on('click', '#delete_start_person_btn', function() {
            start_person_id = "";
            $("#case_start_person").val("");
            $("#start_person_pn1").toggle("fast");
            $("#start_person_pn2").toggle("fast");

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

        // Update 2019-04-07 ======|START|==================================
        // Select Job Type ==================================
        function load_job_type_for_select() {
            var add_data = {}
            add_data['f'] = '66';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert (data);
                    var data_arr = JSON.parse(data);
                    jQuery.each(data_arr, function(i, val) {
                        availableTags_c_case_job_type.push(val.JOBTYPE)
                    });
                    // Auto complete Jobtype 
                    $("#c_case_job_type").autocomplete({
                        source: availableTags_c_case_job_type
                    });

                    // print select job type panal
                    print_job_type_select_panel();
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        function print_job_type_select_panel() {
            var print_text = "";
            $.each(availableTags_c_case_job_type, function(index, value) {
                print_text += '<div class="chip_add" id="add_case_type_real" value="' + value +
                    '"> + ' + value + '</div>';
            });
            $('#c_case_job_type_panel_select').html(print_text);
        }


        // ============================================

        // Select OFD Type  ==================================

        // available ofd_type_2 for initial
        var availableTags_ofd_type_2 = ['โรงเรียน', 'มหาวิทยาลัย', 'โรงพยาบาล', 'สารธารณสุข', 'ทางหลวง',
            'ทางหลวงชนบท'
        ];
        var availableTags_ofd_type_3 = [];

        function load_ofd_type_for_select() {
            var add_data = {}
            add_data['f'] = '67';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert (data);
                    var data_arr = JSON.parse(data);
                    jQuery.each(data_arr, function(i, val) {
                        availableTags_ofd_type_3.push(val.OFDTYPE)
                    });

                    // Auto complete Jobtype 
                    $("#ofd_type_2").autocomplete({
                        source: availableTags_ofd_type_3
                    });
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }



        // Print label for each cry pype select
        function print_ofd_type_2_select() {
            var print_text = "";
            $.each(availableTags_ofd_type_2, function(index, value) {
                print_text += '<div class="chip_add" id="btn_ofd_type_2_selected" value="' + value +
                    '"><span class="addbtn">+ </span>' + value + '</div>';
            });
            $('#ofd_type_2_select').html(print_text);
        }


        // ============================================
        // getselect_support_type_for_wd====================================
        function getselect_support_type_for_wd() {
            var add_data = {}
            add_data['f'] = '68';
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert (data);
                    //select_support_type_for_wd
                    var data_arr = JSON.parse(data);
                    print_text = "";
                    jQuery.each(data_arr, function(i, val) {
                        print_text += "<option value='" + val.support_type + "'>" + val
                            .support_type + "</option>";
                    });

                    $("#select_support_type_for_wd").html(print_text);


                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }

        // Add staff on click
        $("#btn-select-join-wd").click(function() {
            //alert($("#snd_name").val());
            if ($.trim($("#m_join_a").val()) != "") {
                add_text = $("#m_join_a").val();
                _id = add_text.substring(0, 8);
                //alert (add_text.substring(11))
                if ($.isNumeric(_id)) {
                    if (jQuery.inArray(_id, wd_join_arr) == -1) {
                        //modal_select_support_type
                        getselect_support_type_for_wd();
                        $('#modal_select_support_type').modal('show');
                    }
                }
            }
        });


        // bt_confirm_add_suppot_wd
        $("#bt_confirm_add_suppot_wd").click(function() {
            // Add data
            add_text = $("#m_join_a").val();
            _id = add_text.substring(0, 8);
            wd_join_arr.push(_id);
            wd_join_type_arr.push($("#select_support_type_for_wd").val());
            wd_join_name_arr.push(add_text.substring(11));
            $('#modal_select_support_type').modal('hide');
            $("#m_join_a").val("");
            print_wd_list();
        });



        //btn_add_case_link
        $("#btn_add_case_link").click(function() {
            // Add data
            $("#group_post_search").val("");
            load_group_post_data("");
            $('#modal_add_from_group').modal('show');

        });

        function load_group_post_data(search_text) {
            global_random_no = makeid();
            var temp_rnd_id = global_random_no;
            var add_data = {}
            add_data['f'] = '69';
            add_data['search_text'] = search_text;
            $.ajax({
                    type: 'POST',
                    dataType: "text",
                    url: 'f_1_case.php',
                    data: (add_data)
                })
                .done(function(data) {
                    //alert (data);
                    if (temp_rnd_id == global_random_no) {
                        if (data != "[]") {
                            var ojb = JSON.parse(data);
                            print_text = "";
                            $.each(ojb, function(index, value) {
                                message = ojb[index].message.substring(0, 50);
                                if (ojb[index].message.length > 50) {
                                    message += "...";
                                }
                                if (ojb[index].full_picture == "") {
                                    ojb[index].full_picture = "img/wd_img/default.png"
                                }
                                print_text += '<div class="col-md-10">';
                                print_text +=
                                    '<div class="info-box div_select_page" id="select_group_post" value="' +
                                    ojb[index].id + '">';
                                print_text += '<img class="info-box-icon img-circle" src="' + ojb[
                                    index].full_picture + '" height="85" width="85">';
                                print_text += '<div class="info-box-content">';
                                print_text += '<span class="info-box-number"><small>' + message +
                                    '</small></span>';
                                //print_text += '<span class="info-box-text">'+ojb[index].created_time+'</span>';
                                print_text += '<span class="info-box-text">' + moment(ojb[index]
                                    .created_time, "YYYY-MM-DD hh:mm:ss").calendar(null, {
                                    sameElse: 'DD MMMM YYYY'
                                }) + '</span>';
                                print_text += '</div>';
                                print_text += '</div>';
                                print_text += '</div>';
                            });
                            $("#search_group_post_result").html(print_text);
                        } else {
                            $("#search_group_post_result").html("<font color='red'>**ไม่พบข้อมูล**</font>");
                        }
                    }
                })
                .fail(function() {
                    // just in case posting your form failed
                    alert("Posting failed.");
                });
        }


        $("#group_post_search").keyup(function() {
            //alert ($(this).val());
            load_group_post_data($(this).val());
        });

        // select_group_post
        $('body').on('click', '.div_select_page', function() {
            //alert ($(this).html());
            var target = ($(this).attr('value'));

            $("#c_cnt_url").val("https://www.facebook.com/groups/Watchdog.TAC1/" + target)
            case_ingroup_id = target;

            $("#show_selected_group_post").html($(this).html());
            $('#modal_add_from_group').modal('hide');
            $("#btn_add_case_link").toggle("fast");
            $("#Delete_selected_group_case").toggle("fast");
        });

        $('body').on('click', '#Delete_selected_group_case', function() {
            $("#btn_add_case_link").toggle("fast");
            $("#Delete_selected_group_case").toggle("fast");
            $("#show_selected_group_post").html("");
            $("#c_cnt_url").val("")
            case_ingroup_id = "";
        });


        // Click case info edit btn_case_info_edit
        $("#btn_add_inb_msg").click(function() {
            //$('#f_add_ofd_person').trigger("reset");
            $("#contact_list_panel").html("");
            $("#search_text_case_msg").val("");
            $('#select_inbox_msg').modal('show');

        });

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
                    if (_temp_random_id_search == random_id_search) {
                        if (data != "[]") {
                            var data_arr = JSON.parse(data);
                            console.log(data_arr)
                            print_text = "";
                            jQuery.each(data_arr, function(i, val) {
                                var ms = moment().diff(moment(val.update_time,
                                    "YYYY-MM-DD hh:mm:ss"));

                                if (isUrlValid(val.MSG)) {
                                    val.MSG = val.MSG.substring(0, 30) + "...";
                                }

                                print_text += '<li id="select_contact_list" class="hover_pointer" value="' + val.msg_id +
                                    '" inb_name="' + val.sender_name + '">';
                                print_text += '<a>';
                                //print_text += '<img class="contacts-list-img" src="msg" alt="User Image">';
                                print_text += '<div>';
                                print_text +=
                                    '<span class="contacts-list-name" ><font color="#222222">';
                                print_text += val.sender_name.replace(target_search,
                                        "<font color='red'>" + target_search + "</font>") +
                                    "</font>";
                                if (ms < 259200000) {
                                    print_text += '<small class="contacts-list-date pull-right">' +
                                        moment(val.update_time, "YYYY-MM-DD hh:mm:ss").fromNow(
                                        null, {
                                            sameElse: 'DD MMMM YYYY'
                                        }) + '</small>';
                                } else {
                                    print_text += '<small class="contacts-list-date pull-right">' +
                                        moment(val.update_time, "YYYY-MM-DD hh:mm:ss").calendar(
                                            null, {
                                                sameElse: 'DD MMMM YYYY'
                                            }) + '</small>';
                                }

                                print_text += '</span>';
                                print_text += '<span class="contacts-list-msg">' + val.MSG.replace(
                                    target_search, "<font color='red'>" + target_search +
                                    "</font>") + '</span>';
                                print_text += '</div>';
                                print_text += '</a>';
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

        $('body').on('click', '#select_contact_list', function() {
            var target = ($(this).attr('value'));
            var sender_name = ($(this).attr('inb_name'));
            $('#select_inbox_msg').modal('hide');

            //inb_temp_name
            $("#inb_msg_value").val(target);
            //$("#inb_msg_value").attr('inb_temp_name', sender_name);
            //inb_temp_name
            $("#inb_temp_name").html(sender_name)



            // btn_add_inb_msg
            $("#btn_add_inb_msg").toggle();

            //delete_inb_msg
            $("#delete_inb_msg").toggle();
            // snd_name
            $("#snd_name").val(sender_name);
            //alert($("#inb_msg_value").val())
            //alert($("#inb_msg_value").attr('inb_temp_name'));

            //alert(sender_name);
        });

        // delete_inb_msg
        $('body').on('click', '#delete_inb_msg', function() {
            //inb_temp_name
            $("#inb_msg_value").val("");
            //$("#inb_msg_value").attr('inb_temp_name', "");
            $("#inb_temp_name").html("")


            // btn_add_inb_msg
            $("#btn_add_inb_msg").toggle();

            //delete_inb_msg
            $("#delete_inb_msg").toggle();
            // snd_name
            $("#snd_name").val("");
            //alert($("#inb_msg_value").val())
            //alert($("#inb_msg_value").attr('inb_temp_name'));

            //alert(sender_name);
        });






        // ============================================
        // Update 2019-04-07 ======|END|==================================



        function generate_case_name ()
        {
            //alert(ofd_list.length);
            if (ofd_list.length > 0)
            {
                //alert(ofd_list[0]);
                //alert(ofd_address_name_p[0]);
                //alert(case_ofd_real_data.join(", "));
                var case_name_text =  ofd_list[0] + " จ." + ofd_address_name_p[0].trim() + " ประเด็น " + case_ofd_real_data.join(", ");
                //alert(case_name_text);
                if ($("#c_name").val() == "")
                {
                    $("#c_name").val(case_name_text);
                }
                
            }
            
        }

        //unlock_case_name_text

        $('body').on('click', '#unlock_case_name_text', function() {
            $("#c_name").removeAttr("readonly")
            generate_case_name ();
        });


        // ----- Initial when start ----------
        $('#f1').trigger("reset");
        $('#f2').trigger("reset");
        $('#f3').trigger("reset");
        $('#f4').trigger("reset");
        $('#f5').trigger("reset");
        $('#f6').trigger("reset");
        $('#f7').trigger("reset");
        $('#f8').trigger("reset");
        $('#f_snder').trigger("reset");
        $('#f_snder_edit').trigger("reset");

        $("#sw0").hide();
        ajax_function(1, "#ofd_add_province");
        ajax_function(6, "#case_staff");
        ajax_function(6, "#case_start_staff");
        ajax_function(7, "#snd_m_gen");
        ajax_function(15, "#m_join_team");
        ajax_function(16, "#select_org_type");


        // Set Date to today
        var today = new Date();
        $("#datepicker").datepicker("setDate", new Date());

        // Update 2020 July 26 Disable to change start date
        $("#datepicker2").datepicker("setDate", new Date());
        $("#datepicker3").datepicker("setDate", new Date(today.getFullYear(), today.getMonth(), today
            .getDate() + 6));


        // Generate_case_ID
        generate_case_id();


        // Get crp type
        get_crp_type_data();




        // Print ofd type2 select
        print_ofd_type_2_select();


        // Get availableTags
        get_auto_complete_tag();


        // Get availableTags Incluide staff
        get_auto_complete_tag_with_staff();


        // Get initial job type for select 
        load_job_type_for_select();
        // Get initial ofd type for select 
        load_ofd_type_for_select()




    }); // End --------------------------



    $(function() {
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask();

        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        })

    });
    </script>
</body>

</html>
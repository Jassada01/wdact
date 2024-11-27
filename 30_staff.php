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
  <title>Watch_Dog | Staff Management</title>
  
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
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <!-- J-ui css-->
	<link rel="stylesheet" href="bower_components/jquery-ui/themes/base/jquery-ui.css">

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
			Staff Management
        <small>จัดการผู้ใช้งานระบบ</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content container-fluid">
	<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="box box-default">
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="row">
				  
					<div class="col-md-12">
					          <!-- Custom Tabs -->
					  <div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
						  <li class="active"><a href="#tab_1" data-toggle="tab">เพิ่มผู้ใช้ระบบ</a></li>
						  <li><a href="#tab_2" data-toggle="tab">จัดการผู้ใช้ระบบ</a></li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" id="tab_1">
							<!-- form start -->
							<form class="form-horizontal" id="frm_new_staff" >
							<div class="box-body">
								<div class="form-group">
									<label for="ns_id" class="col-sm-2 control-label">ID</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="ns_id" >
									</div>
									<div class="col-sm-2" id="check_uname_icon">
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_pass1" class="col-sm-2 control-label">รหัสผ่าน</label>
									<div class="col-sm-3">
										<input type="password" class="form-control" id="ns_pass1"  autocomplete="new-password">
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_pass2" class="col-sm-2 control-label">ยืนยันรหัสผ่าน</label>
									<div class="col-sm-3">
										<input type="password" class="form-control" id="ns_pass2"  autocomplete="confirm-password"> 
									</div>
									<div class="col-sm-2" id="check_password_icon" style="display: none;">
										<BIG><font color="#00a65a"><i class="fa fa-check"></i></font></BIG>
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_name" class="col-sm-2 control-label">ชื่อ</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ns_name" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_sname" class="col-sm-2 control-label">นามสกุล</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ns_sname" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_nickname" class="col-sm-2 control-label">ชื่อเล่น</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ns_nickname" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_position" class="col-sm-2 control-label">ตำแหน่ง</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ns_position" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ns_level" class="col-sm-2 control-label">ระดับการจัดการระบบ</label>
									<div class="col-sm-4">
										<select id="ns_level">
											<option value="0">ผู้จัดการระบบ</option>
											<option value="1">ผู้ใช้ทั่วไป</option>
											<option value="2">ทีมรับเรื่อง</option>
										</select>
									</div>
								</div>
								
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="button" class="btn btn-default" id="ns_btn_reset">Reset</button>
								<button type="button" class="btn btn-info pull-right" id="ns_btn_add">เพิ่มผู้ใช้งานระบบ</button>
							</div>
							<!-- /.box-footer -->
							</form>
						  </div>
						  <!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2">
									<label for="ed_user_list" class="col-sm-2 control-label"></label>
									<div class="col-sm-4">
										<select id="ed_user_list">
										</select>
									</div>
									<BR><HR>
							<!-- form start -->
							<form class="form-horizontal" id="frm_edit_staff">
							
							<div class="box-body">
								<div class="form-group">
									<label for="ed_id" class="col-sm-2 control-label" >ID</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" id="ed_id" disabled>
									</div>
									<div class="col-sm-2">
										<button type="button" class="btn btn-warning" id="ed_btn_reset_usr_passwd">รีเซตรหัสผ่าน</button>
									</div>
								</div>

								
								<div class="form-group">
									<label for="ed_name" class="col-sm-2 control-label">ชื่อ</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ed_name" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_sname" class="col-sm-2 control-label">นามสกุล</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ed_sname" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_nickname" class="col-sm-2 control-label">ชื่อเล่น</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ed_nickname" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_position" class="col-sm-2 control-label">ตำแหน่ง</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ed_position" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_mem" class="col-sm-2 control-label">สมาชิกหมาเฝ้าบ้าน</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="ed_mem" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_level" class="col-sm-2 control-label">ระดับการจัดการระบบ</label>
									<div class="col-sm-4">
										<select id="ed_level">
											<option value="0">ผู้จัดการระบบ</option>
											<option value="1">ผู้ใช้ทั่วไป</option>
											<option value="2">ทีมรับเรื่อง</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label for="ed_active" class="col-sm-2 control-label">Active</label>
									<div class="col-sm-4">
										<div class="checkbox">
										  <label>
											<input type="checkbox" id="ed_active">
										  </label>
										</div>
									</div>
								</div>
								
								
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="button" class="btn btn-info pull-right" id="ed_btn">แก้ไขข้อมูล</button>
							</div>
							<!-- /.box-footer -->
							</form>
						  </div>
						  <!-- /.tab-pane -->
						</div>
						<!-- /.tab-content -->
					  </div>
					  <!-- nav-tabs-custom -->
					  
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
		
		<!--------------------------
        |                MODAL               |
        -------------------------->
		<div class="modal modal-default fade" id="modal-change-Password">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เปลี่ยนรหัสผ่าน</h4>
              </div>
              <div class="modal-body">
					
					<form>
					<div class="row">
						<div class="form-group">
									<label for="nw_pass1" class="col-sm-4 control-label">รหัสผ่านใหม่</label>
									<div class="col-sm-6">
										<input type="password" class="form-control" id="nw_pass1" >
									</div>
							</div>
					</div>
					<br>
					<div class="row">
						<div class="form-group">
							<label for="nw_pass2" class="col-sm-4 control-label">ยืนยันรหัสผ่านใหม่</label>
							<div class="col-sm-6">
								<input type="password" class="form-control" id="nw_pass2" >
							</div>
							<div class="col-sm-2" id="check_chn_password_icon" style="display: none;">
										<BIG><font color="#00a65a"><i class="fa fa-check"></i></font></BIG>
							</div>
						</div>
					</div>
					</form>
				</div>

              <div class="modal-footer">
					<div class = "pull-left" id="change-password-result">
						
					</div>
                <button type="button" class="btn btn-warning" id="btn-change-Password" disabled>เปลี่ยนรหัสผ่าน</button>
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
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="dist/chartjs/Chart.js"></script>
<script src="dist/chartjs/utils.js"></script>

<!-- J-ui tab -->
	<script src="bower_components/jquery-ui/jquery-ui_new.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

<script>
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
					ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
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
$(document).ready(function(){

// Source for add team
var availableTags = [

	<?php
	// Connect to MySQL Database
	include "connectionDb.php";
	$sql = "Select a.wd_id, a.gen, a.name, a.s_name, a.n_name, a.soc_fb, a.soc_fb_2 from wd_db a WHERE a.status in (1, 2, 5) Order By a.wd_id";
	$res = $conn->query(trim($sql));
	mysqli_close($conn);
	$cl_check = "";
	while ($row = $res->fetch_assoc()) {
		if ($user_level == 2) {
			echo $cl_check . '{label:"' . '' . $row['n_name'] . ' : ' . $row['soc_fb'] . ' ' . $row['soc_fb_2'] . '", value : "' . $row['wd_id'] . $row['n_name'] . ' รุ่น ' . $row['gen'] . '", category: "รุ่น  ' . $row['gen'] . '"}';
		} else {
			echo $cl_check . '{label:"' . $row['name'] . ' ' . $row['s_name'] . '(' . $row['n_name'] . ') : ' . $row['soc_fb'] . ' ' . $row['soc_fb_2'] . '", value : "' . $row['wd_id'] . ' - ' . $row['name'] . ' (' . $row['n_name'] . ') รุ่น ' . $row['gen'] . '", category: "รุ่น  ' . $row['gen'] . '"}';
		}

		$cl_check = ",";
	}
	?>
];

$("#ed_mem").catcomplete({
	source: availableTags
});

			
			
// ++++++++++  Standard Ajax Function ++++++++++
function ajax_function($f, d_name, $p1, $p2, $p3) {
	// Check parameter has been set or not
	$f = $f || "0";
	$p1= $p1 || "0";
	$p2= $p2 || "0";
	$p3= $p3 || "0";
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: ({f : $f,
				p1 : $p1,
				p2 : $p2,
				p3 : $p3})
	})
	
	.done(function(data){
		//alert(data);
		document.getElementById(d_name).innerHTML = data;
	})
	.fail(function() {
		// just in case posting your form failed
		alert( "Posting failed." );
	});
	return false;	
};




// Load Staff Data
function ajax_load_function($f, d_name, $p1, $p2, $p3) {
	// Check parameter has been set or not
	$f = $f || "0";
	$p1= $p1 || "0";
	$p2= $p2 || "0";
	$p3= $p3 || "0";
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_3_staff.php',
		data: ({f : $f,
				p1 : $p1,
				p2 : $p2,
				p3 : $p3})
	})
	
	.done(function(data){
		//alert(data);
		//document.getElementById(d_name).innerHTML = data;
		// Input all data
		var obj = JSON.parse(data);
		$('#ed_id').val(obj.stf_ID);
		$('#ed_name').val(obj.Name);
		$('#ed_sname').val(obj.s_name);
		$('#ed_nickname').val(obj.nick_name);
		$('#ed_position').val(obj.Position);
		$('#ed_level').val(obj.admin_level);
		if (obj.active == "1")
		{
			$('#ed_active').prop('checked', true);
		}
		else
		{
			$('#ed_active').prop('checked', false);
		}
		
		// Show form
		$('#frm_edit_staff').show();
		
	})
	.fail(function() {
		// just in case posting your form failed
		alert( "Posting failed." );
	});
	return false;	
};
	
	
	
// Add new staff Ajax Function 
function ajax_add_function($f, $d_name, $p1, $p2, $p3) {
	// Check parameter has been set or not
	$f = $f || "0";
	$p1= $p1 || "0";
	$p2= $p2 || "0";
	$p3= $p3 || "0";
	// Set Ajax
	var add_data = {};
	
	// UID
	add_data['f'] = "1";
	add_data['ns_id'] = $('#ns_id').val();
	add_data['ns_pass'] = $('#ns_pass1').val();
	add_data['ns_name'] = $('#ns_name').val();
	add_data['ns_sname'] = $('#ns_sname').val();
	add_data['ns_nickname'] = $('#ns_nickname').val();
	add_data['ns_position'] = $('#ns_position').val();
	add_data['ns_level'] = $('#ns_level').val();
	
	var chk_val = 0;
	jQuery.each( add_data, function( i, val ) {
		if (val == "")
		{
			chk_val = 1;
		}
	});
	
	if ($('#ns_pass1').val() != $('#ns_pass2').val())
	{
		chk_val = 2;
		alert ("กรุณายืนยัน Password ให้ตรงกัน");
	}
	
	if (document.getElementById('check_uname_icon').innerHTML != "")
	{
		chk_val = 3;
		alert ("มีผู้ใช้ ID นี้แล้ว");
	}
	
	if (chk_val == 1)
	{
		alert ("กรุณากรอกข้อมูลให้ครบ");
	}
	
	if (chk_val == 0)
	{
			$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data){
			alert("เพิ่มผู้ใช้ระบบสำเร็จ");
			$('#frm_new_staff').trigger("reset");
			location.reload();
		})
		.fail(function() {
			// just in case posting your form failed
			alert( "Posting failed." );
		});
		return false;	
	}

};



// Update staff Ajax Function 
function ajax_update_function($f, $d_name, $p1, $p2, $p3) {
	// Check parameter has been set or not
	$f = $f || "0";
	$p1= $p1 || "0";
	$p2= $p2 || "0";
	$p3= $p3 || "0";
	// Set Ajax
	var add_data = {};
	
	// UID
	add_data['f'] = "6";
	add_data['ed_id'] = $('#ed_id').val();
	add_data['ed_name'] = $('#ed_name').val();
	add_data['ed_sname'] = $('#ed_sname').val();
	add_data['ed_nickname'] = $('#ed_nickname').val();
	add_data['ed_position'] = $('#ed_position').val();
	add_data['ed_level'] = $('#ed_level').val();
	if ($('#ed_active').is(':checked'))
	{
		add_data['ed_active'] = "1";
	}
	else 
	{
		add_data['ed_active'] = "0";
	}
	
	var chk_val = 0;
	jQuery.each( add_data, function( i, val ) {
		if (val == "")
		{
			chk_val = 1;
		}
	});
	if (chk_val == 1)
	{
		alert ("กรุณากรอกข้อมูลให้ครบ");
	}
	
	if (chk_val == 0)
	{  
			$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data){
			//alert (data);
			alert("บันทึกข้อมูลสำเร็จ");
			$('#frm_new_staff').trigger("reset");
			$('#frm_edit_staff').trigger("reset");
			location.reload();
		})
		.fail(function() {
			// just in case posting your form failed
			alert( "Posting failed." );
		});
		return false;	
	}

};

	

// +++++++++++ page Function +++++++++++++++++++
// Click_reset
$("#ns_btn_reset").click(function() {
	$('#check_password_icon').hide();
	$('#frm_new_staff').trigger("reset");
});

// Click_reset
$("#ns_btn_add").click(function() {
		ajax_add_function(1, "tab_2");
});

// Check ID available
$("#ns_id").keyup(function() {
		//alert($(this).val());
		ajax_function(2, "check_uname_icon", $(this).val());
});

// ================================
$("#ns_pass1").keyup(function() {
		check_password();
});

// ================================
$("#nw_pass2").keyup(function() {
		check_password2();
});

// ================================
$("#nw_pass1").keyup(function() {
		check_password2();
});

// ================================
$("#ns_pass2").keyup(function() {
		check_password();
});


// Load Data when Select changed ==========
$("#ed_user_list").change(function() {
		//alert ($(this).val());
		load_data_matchMember($(this).val());
		ajax_load_function(4, "", $(this).val());
});

// When Edit button click
$("#ed_btn_reset_usr_passwd").click(function() {
		//alert ($(this).val());
		$('#nw_pass1').val("");
		$('#nw_pass2').val("");
		$('#check_chn_password_icon').hide();
		$('#change-password-result').html("");
		$('#modal-change-Password').modal('show');
});

// Update Password 
$("#btn-change-Password").click(function() {
		ajax_function(5, "change-password-result", $("#ed_user_list").val(), $('#nw_pass1').val());	
});

// Update Data
$("#ed_btn").click(function() {
		ajax_update_function(6);
		 saveDatamatchMember();
		//ajax_function(5, "change-password-result", $("#ed_user_list").val(), $('#nw_pass1').val());	
});

	
// Check password is same or not
function check_password()
{
	if ($('#ns_pass1').val() != "")
	{
			if ($('#ns_pass1').val() == $('#ns_pass2').val())
			{
				$('#check_password_icon').show();
			}
			else
			{
				$('#check_password_icon').hide();
			}
	}

}

// Check password is same or not
function check_password2()
{
	if ($('#nw_pass1').val() != "")
	{
			if ($('#nw_pass1').val() == $('#nw_pass2').val())
			{
				$('#check_chn_password_icon').show();
				$("#btn-change-Password").removeAttr("disabled");
				$('#change-password-result').html("");
			}
			else
			{
				$('#check_chn_password_icon').hide();
				$("#btn-change-Password").attr("disabled", true);
				$('#change-password-result').html("");
			}
	}

}

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


function load_data_matchMember($staff_key_id)
{
	var add_data = {}
	add_data['f'] = '37';
	add_data['staff_key_id'] =$staff_key_id;
	$("#ed_mem").val("");
	//console.log(add_data);
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	}).done(function(data) {
			if (data != "[]") {
				var data_arr = JSON.parse(data);
				var print_html = "";
				jQuery.each(data_arr, function(i, val) {
					$("#ed_mem").val(val.wd_ID);

				});
			}
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}
function saveDatamatchMember()
{
	var add_data = {}
	add_data['f'] = '36';
	add_data['staff_key_id'] =$('#ed_id').val();
	add_data['wdID'] = $("#ed_mem").val().substring(0, 8).trim();
	//console.log(add_data);
	
	$.ajax({
		type: 'POST',
		dataType: "text",
		url: 'f_0_index.php',
		data: (add_data)
	});
	
}



// +++++++++++ initial when start +++++++++++++++++++
	document.getElementById('check_uname_icon').innerHTML = "";
	// Reset Data in form
	$('#frm_new_staff').trigger("reset");
	$('#frm_edit_staff').trigger("reset");
	
	// Hide form
	$('#frm_edit_staff').hide();
	

	
	// Get All Staff_list
	ajax_function(3, "ed_user_list");
});

</script>
	 
	 
	 
	 
	 
	 
	 
</body>
</html>

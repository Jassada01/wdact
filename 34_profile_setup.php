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
		<!-- crop style -->
		<link rel="stylesheet" href="dist/css/cropstyle.css">
		
		
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
						จัดการ Profile
					</h1>
				</section>
				<!-- Main content -->
				<section class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username" id="user_name_hd"></h3>
              <h5 class="widget-user-desc" id="user_pos"></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="img/wd_img/default.png" id="user_profile_img">
            </div>
            <div class="box-footer">
              <div class="row">
			  <div class="col-sm-4">
                  <div class="description-block">
						<button type="button" class="btn  btn-success " id="btn_qr_access">QR สำหรับเข้า APP</button>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
					<button type="button" class="btn bg-primary" id="chn_img">เปลี่ยนรูป</button>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
				
                <div class="col-sm-4">
                  <div class="description-block">
						<button type="button" class="btn  btn-danger " id="chn_pwd">เปลี่ยนรหัสผ่าน</button>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
						
	</div>

	<div class="modal fade" id="modal-add-img">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">เพิ่มรูปสมาชิก</h4>
						</div>
						<div class="modal-body">
							    <div class="imageBox">
									<div class="thumbBox"></div>
									<div class="spinner" style="display: none">Loading...</div>
								</div>
								<div class="action ">
									<span class="btn btn-file" id="btn_img">
										<font color="#D81B60"><i class="fa fa-image"></i> เลือกรูป</font> <input type="file" id="file" accept="image/*">
									</span>
									<input type="button" id="btnZoomIn" class="btn btn-primary pull-right" value="+">
									<input type="button" id="btnZoomOut" class="btn btn-primary pull-right" value="-">
									
									
								</div>
						</div>
						<div class="modal-footer">
							<input type="button" id="btnCrop" class="btn btn-success pull-right" value="ตกลง">
						</div>
					</div>
				<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->	
			
			
			
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
		
			<div class="modal fade" id="modal_access_qr">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Application Access QR Code</h4>
						</div>
						<div class="modal-body">
							<div id="access_qr_code" align="center"></div>
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
		
		<!--QRCode -->
		<script src="plugins/QRCode/jquery.qrcode.js"></script>
		<script src="plugins/QRCode/qrcode.js"></script>
		
		<!--  cropbox-->
		<script src="dist/js/cropbox.js"></script>
		
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
		<script>	
$(document).ready(function(){
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

function get_initial_data()
{
		var add_data = {}
		add_data['f'] = '40';
		add_data['staff_ID'] = <?php echo $staff_key_id;?>;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			//alert (data)
			var data_arr = JSON.parse(data);
			var user_data = data_arr[0];
			
			// Setup
			$("#user_name_hd").html(user_data.nick_name + " - " + user_data.Name + " " + user_data.s_name);
			$("#user_pos").html(user_data.Position);
			$("#user_profile_img").attr("src","img/wd_img/"+user_data.img);
			
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}

$( "#chn_img" ).click(function() {
	$('#modal-add-img').modal('show');
});
$( "#chn_pwd" ).click(function() {
	$('#modal-change-Password').modal('show');
});

// Random_code
function makeid() {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < 15; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));
	return text;
}

function update_img_data(img)
{
		var add_data = {}
		add_data['f'] = '41';
		add_data['staff_ID'] = <?php echo $staff_key_id;?>;
		add_data['img'] = img;
		
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			get_initial_data();
			
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});
}


// Change _assword Process ==============================


// Cropbox =================================
var options =
{
	thumbBox: '.thumbBox',
	spinner: '.spinner',
	imgSrc: 'avatar.png'
}
var cropper = $('.imageBox').cropbox(options);
$('#file').on('change', function(){
var reader = new FileReader();
reader.onload = function(e) {
	options.imgSrc = e.target.result;
	cropper = $('.imageBox').cropbox(options);
}
reader.readAsDataURL(this.files[0]);
this.files = [];
})
$('#btnCrop').on('click', function(){
var img = cropper.getDataURL();
file_name = makeid()+".png";
//alert (file_name)
var file = img;
var formData = new FormData();
formData.append("filUpload", file);
formData.append("file_name", file_name);

var xhr = new XMLHttpRequest();
xhr.open('POST', 'uploadfile.php', true);
xhr.send(formData);
update_img_data(file_name);
$('#modal-add-img').modal('hide');
 
 
 
});
$('#btnZoomIn').on('click', function(){
cropper.zoomIn();
});
$('#btnZoomOut').on('click', function(){
cropper.zoomOut();
});


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

// ================================
$("#nw_pass1").keyup(function() {
		check_password2();
		
});

// ================================
$("#nw_pass2").keyup(function() {
		check_password2();
});

// Update Password 
$("#btn-change-Password").click(function() {
		//ajax_function(5, "change-password-result", $("#ed_user_list").val(), $('#nw_pass1').val());	
		var add_data = {}
		add_data['f'] = '42';
		add_data['staff_ID'] = <?php echo $staff_key_id;?>;
		add_data['new_pw'] = $('#nw_pass1').val();
		
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			//get_initial_data();
			$("#change-password-result").html(data);
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});	
});

$('body').on('click', '#btn_qr_access', function() {
		//modal_access_qr
		var add_data = {}
		add_data['f'] = '58';
		add_data['staff_ID'] = <?php echo $staff_key_id;?>;
		$.ajax({
			type: 'POST',
			dataType: "text",
			url: 'f_3_staff.php',
			data: (add_data)
		})
		.done(function(data) {
			var ojb = JSON.parse(data);
			var val_QR = "?token=" + ojb[0]['token']
			//console.log(val_QR);
			$("#access_qr_code").html("");
			jQuery('#access_qr_code').qrcode({
					text : val_QR
			});	
		})
		.fail(function() {
			// just in case posting your form failed
			alert("Posting failed.");
		});	
	$('#modal_access_qr').modal('show');
	
});

// Initial Run ========================================= 
get_initial_data();


});

	</script>
	</body>
</html>
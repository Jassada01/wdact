<!DOCTYPE html>
<html>
	<?php
		ob_start();
		unset($_COOKIE['wds_hiskey']);
		setcookie('wds_hiskey', '', time() - 3600); // empty value and old timestamp
		ob_end_clean();
	?>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Log in</title>
		
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
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<body class="hold-transition login-page" >
		<div class="login-box">
			<div class="login-logo">
				<b></b>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p id="response" class="login-box-msg">กรุณาใส่ Username และ รหัสผ่าน</p>
				<form id="login_form">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Username" id="username">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="รหัสผ่าน" id="password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-block btn-flat bg-navy">เข้าสู่ระบบ</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
		<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
			    $('#login_form').submit(function(){
			        $.ajax({
			            type: 'POST',
						dataType: "text",
			            url: 'f_login.php',
			            data: ({username : $("#username").val(), 
								password : $("#password").val()})
			        })
			        .done(function(data){
						if (data == "1")
						{
							window.location.href = "index.php";
						}
						else
						{
							$('#response').html(data);
						}
			        })
			        .fail(function() {
			            // just in case posting your form failed
			            alert( "Posting failed." );
			        });
			        // to prevent refreshing the whole page page
			        return false;
			    });
			});
		</script>
	</body>
</html>


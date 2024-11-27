<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by Keenthemes</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:site_name" content="Keenthemes | Metronic" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=K2D" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Authentication - Password reset -->
		<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
			<!--begin::Content-->
			<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
				<!--begin::Logo-->
				<a href="../../demo1/dist/index.html" class="mb-12">
					<img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-40px" />
				</a>
				<!--end::Logo-->
				<!--begin::Wrapper-->
				<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
					<!--begin::Form-->
					<form class="form w-100" novalidate="novalidate" id="kt_password_reset_form">
						<!--begin::Heading-->
						<div class="text-center mb-10">
							<!--begin::Title-->
							<h1 class="text-dark mb-3">เข้าสู่ระบบด้วย Email</h1>
							<!--end::Title-->
							<!--begin::Link-->
							<div class="text-gray-400 fw-bold fs-4">กรุณากรอก Email เพื่อดำเนินการต่อ</div>
							<!--end::Link-->
						</div>
						<!--begin::Heading-->
						<!--begin::Input group-->
						<div class="fv-row mb-10">
							<label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
							<input class="form-control form-control-solid" type="email" placeholder="" name="email" id="input_email" autocomplete="off" />
						</div>
						<!--end::Input group-->
						<!--begin::Actions-->
						<div class="d-flex flex-wrap justify-content-center pb-lg-0">
							<button type="button" id="btn_start_access" class="btn btn-lg btn-primary fw-bolder me-4 my-1">
								<span>เข้าสู่ระบบ</span>
							</button>
							<span>

								<button type="button" id="btn_reset_passcode" class="btn btn-lg btn-light-danger fw-bolder me-2 my-1" style="display: none;">
									<span class="indicator-label">รีเซต รหัสเข้าสู่ระบบ</span>
								</button>
						</div>
						<!--end::Actions-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Content-->
			<!--begin::Footer-->
			<div class="d-flex flex-center flex-column-auto p-10">
				<!--begin::Links-->
				<div class="d-flex align-items-center fw-bold fs-6">
					<a href="https://keenthemes.com" class="text-muted text-hover-primary px-2">ติดต่อเจ้าหน้าที่</a>
				</div>
				<!--end::Links-->
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Authentication - Password reset-->
	</div>
	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>

	<script src="assets/js/moment.js"></script>
	<script src="//cdn.rawgit.com/placemarker/jQuery-MD5/master/jquery.md5.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Page Custom Javascript(used by this page)-->

	<script>
		$(document).ready(function() {

			$('body').on('click', '#btn_start_access', function() {
				var temp_btn_html = $(this).html()
				$(this).prop("disabled", true);
				$(this).html('<span><span class="spinner-border spinner-border-sm align-middle me-2"></span> กำลังดำเนินการ... </span>')
				var add_data = {};
				add_data['f'] = '1';
				add_data['request_check'] = $("#input_email").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: '../f_7_user_profile_update.php',
						data: (add_data)
					})
					.done(function(data) {
						$('#btn_start_access').prop("disabled", false);
						$('#btn_start_access').html(temp_btn_html)
						if (data == "[]") {
							Swal.fire({
								icon: 'error',
								title: 'ไม่พบข้อมูล',
								text: 'ไม่พบ ' + $("#input_email").val() + ' ในฐานข้อมูลกรุณาติดต่อเจ้าหน้าที่เพื่อทำการปรับข้อมูล Email ของคุณ'
							})
						} else {
							var ojb = JSON.parse(data);
							window.location.href = ojb[0]['url'];
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});

			$('body').on('click', '#btn_reset_passcode', function() {
				var temp_btn_html = $(this).html()
				$(this).prop("disabled", true);
				$(this).html('<span><span class="spinner-border spinner-border-sm align-middle me-2"></span> กำลังดำเนินการ... </span>')
				var add_data = {};
				add_data['f'] = '1';
				add_data['request_check'] = $("#input_email").val();
				$.ajax({
						type: 'POST',
						dataType: "text",
						url: '../f_7_user_profile_update.php',
						data: (add_data)
					})
					.done(function(data) {

						if (data == "[]") {
							$('#btn_reset_passcode').prop("disabled", false);
							$('#btn_reset_passcode').html(temp_btn_html)
							Swal.fire({
								icon: 'error',
								title: 'ไม่พบข้อมูล',
								text: 'ไม่พบ ' + $("#input_email").val() + ' ในฐานข้อมูลกรุณาติดต่อเจ้าหน้าที่เพื่อทำการปรับข้อมูล Email ของคุณ'
							})
						} else {
							var ojb = JSON.parse(data);
							var add_data_email = {};
							add_data_email['token'] = ojb[0]['token'];
							add_data_email['wd_id'] = ojb[0]['wd_id'];
							add_data_email['target_email'] = $("#input_email").val();;
							$.ajax({
									type: 'POST',
									dataType: "text",
									url: '../f_send_email.php',
									data: (add_data_email)
								})
								.done(function(data) {
									$('#btn_reset_passcode').prop("disabled", false);
									$('#btn_reset_passcode').html(temp_btn_html)
									if (data == "OK") {
										Swal.fire({
											icon: 'success',
											title: 'ส่ง Email สำเร็จ',
											text: 'กรุณาตรวจสอบ Email ที่ ' + $("#input_email").val() + '  หากไม่พบอีเมลในกล่องจดหมายเข้า กรุณาตรวจสอบโฟลเดอร์ต่างๆ ของคุณ หากตัวกรองสแปมหรือกฎการใช้อีเมลได้ทำการเคลื่อนย้ายอีเมล อีเมลก็อาจอยู่ในสแปม จดหมายขยะ ถังขยะ รายการที่ลบ หรือโฟลเดอร์จัดเก็บถาวร'
										})
									}
								})
								.fail(function() {
									// just in case posting your form failed
									alert("Posting failed.");
								});
						}
					})
					.fail(function() {
						// just in case posting your form failed
						alert("Posting failed.");
					});
			});


		});
	</script>
	<!--end::Page Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
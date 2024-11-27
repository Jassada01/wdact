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
    <title>Watch_Dog | Group Post</title>

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



    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

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
	
	<style>
		
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

		.edit_post_type:hover {
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
                    Group Post
                    <small>โพสในศูนย์ </small>
                </h1>
				<div class="breadcrumb">
					<select  id="select_year_case">
					</select>
					<button type="button" class="btn btn-box-tool" id="export_to_excel_btn"><i class="fa fa-cloud-upload"></i> Export Data</button>
					<span id="download_export_file"></span>
				</div>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <div class="box box-primary box-solid "  style="overflow:auto;"> 
                            <div class="box-body"  id="Table_Data">
                                <table class="table datatable-basic display " id="style-1" style="width:100%">
								
                                    <thead>
										<tr>
                                            <th style="max-width:20%"></th>
                                            <th style="width:40%" class="text_search">ข้อความ</th>
                                            <th style="width:10%" class="text_search">โพสเมื่อ</th>
											<th style="width:10%" class="text_search">ผูกกับเคส</th>
											<th style="width:10%" class="text_search">สถานะเคส</th>
											<th style="width:10%" class="text_search">ประเภทโพส</th>
                                        </tr>
                                    </thead>
									
                                    <tbody id="table_result">
                                        

                                    </tbody>
									
                                </table>
                            </div>
							<div class="overlay" id="overlay_load" style="display: none;">
							  <i class="fa fa-refresh fa-spin"></i>
							</div>
                        </div>
                    </div>





                </div>



				<div class="modal fade" id="modal_update_post_data">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">กำหนดประเภทของโพสในศูนย์</h4>
							</div>
							<div class="modal-body">
								<div class="row">
										<div class="col-sm-6">
											<div id='timeline_facebook_panel' align="center">
												<img id="post_modal_img" src="img/wd_img/default.png" class="img-circle" height="150" width="150">
											</div>
											<BR/>
											<div id="post_modal_msg" >
											</div>
										</div>
										<div class="col-sm-6">
											<div class="row">
												<div class="col-sm-12">
													<form class="form-horizontal">
														<div class="form-group">
															<label for="select_post_type" class="col-sm-2 control-label">ประเภท</label>

															<div class="col-sm-10">
																<select class="form-control" id="select_post_type">
																</select>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn bg-primary btn-lg" id="btn_save_type">บันทึกข้อมูล</button>
								<button type="button" class="btn bg-danger btn-lg" data-dismiss="modal">ยกเลิก</button>
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
	



    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

	<!-- number_format -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
	
	<!-- Date Sort -->
	<script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-dd-MMM-yyyy.js"></script>

		
	<!-- Moment with Local -->
	<script src="bower_components/moment/min/moment-with-locales.js"></script>
	
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
			Both of these plugins are recommended to enhance the
			user experience. -->
    <script>
    $(document).ready(function() {
        // Global var  =========================================

		// Moment Setting
        //moment.locale('th');
		var __TARGET_POST_ID = ""



        // Page function ========================================= 
		
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

		






        // Basic datatable
       

		 // Setup - add a text input to each footer cell
		$('.datatable-basic thead th').each( function () {
			if ($(this).hasClass( "text_search" ))
			{
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder=" '+title+'"  style="width:100%"/>' );
			}
			
		} );


		function load_table_data()
		{
			$("#export_to_excel_btn").show()
			$("#download_export_file").html("")
			$("#overlay_load").show()
			
			if ($.fn.dataTable.isDataTable('.datatable-basic')) {
				$('.datatable-basic').DataTable().destroy();
			}
			
			
			
			var add_data = {}
                add_data['f'] = '1';
                add_data['select_year'] = $("#select_year_case").val();
				//alert(add_data['select_year'])
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_5_group_post.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data)
						
							//alert(data)
							var print_text = "";
							var data_arr = JSON.parse(data);

							//console.log(data_arr)
							


							jQuery.each(data_arr, function(i, val) {
								if (val.full_picture == "")
								{
									val.full_picture = "img/wd_img/default.png"
								}
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
									print_text += "<TD> - </TD>"
								}

								if (val.Type_name != "-")
								{
									print_text += "<TD>"+val.Type_name+"</TD>"
								}
								else
								{
									if (val.STATUS_CODE != '-')
									{
										print_text += "<TD>โพสเคส</TD>"
									}
									else
									{
										print_text += "<TD>ยังไม่ได้กำหนดประเภท <span class='edit_post_type' value='"+val.id+"' id='edit_post_type' v_msg='"+val.FULL_MSG.replace("\n", "<Br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;")+"' v_img='"+val.full_picture+"' ><i class='fa fa-pencil'></i></span></TD>"

									}
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
								"pageLength": 50,
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
						$("#overlay_load").hide()
                    })
                    .fail(function() {
                        // just in case posting your form failed
                        alert("Posting failed.");
                    });
		}
		
		
			
			$( "#select_year_case" ).change(function() {
				load_table_data();
			});
			
			//export_to_excel_btn
		$('body').on('click', '#export_to_excel_btn', function() {
			$(this).hide()
			$("#download_export_file").html("<i class='fa fa-refresh fa-spin'></i> Create File...")
			var add_data = {}
			add_data['f'] = '2';
			add_data['select_year'] = $("#select_year_case").val();
			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_5_group_post.php',
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



		
		function create_monthly_Purpose()
		{
			date_now = moment()
			print_text = "";
			for (i = 0; i < 36; i++) {
						//alert(date_now.format('YYYY-MM-DD'));
						if (date_now.isBefore('2018-01-01'))
						{
									break;
						}
						print_text += "<Option value='"+date_now.format('YYYY')+"'>"+date_now.format('YYYY')+"</Option>";
						date_now.subtract(1, 'Year');
			}
			$("#select_year_case").html(print_text);
			load_table_data();
		}
		
		//table_tr
		$('body').on('click', '.table_tr', function() {
			 var target = $(this).attr('value')
             //alert(target)
			 var post_link = "https://www.facebook.com/groups/Watchdog.TAC1/" + target;
			 var win = window.open(post_link, '_blank');
            win.focus();
		});


		function load_page_post_status_for_select()
		{
			var add_data = {}
			add_data['f'] = '3';
			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_5_group_post.php',
				data: (add_data)
			}).done(function(data) {
				//alert (data)
				var data_arr = JSON.parse(data);
				print_text = "";
				jQuery.each(data_arr, function(i, val) {
					print_text += "<Option value='"+val.id+"'>"+val.type_name+"</Option>";
				});
				$("#select_post_type").html(print_text);
				
			})
			.fail(function() {
				// just in case posting your form failed
				alert("Posting failed.");
			});
		}

		//edit_post_type
		$('body').on('click', '#edit_post_type', function() {
			 var target = $(this).attr('value')
			 var v_msg = $(this).attr('v_msg')
			 var v_img = $(this).attr('v_img')
			
			 __TARGET_POST_ID = target;
			 load_page_post_status_for_select();
			 $('#post_modal_img').attr('src', v_img);
			 $('#post_modal_msg').html(v_msg);
			 $('#modal_update_post_data').modal('show');
		});

		//btn_save_type
		$('body').on('click', '#btn_save_type', function() {
			type_post = $('#select_post_type').val();
			//alert(type_post)
			var add_data = {}
			add_data['f'] = '4';
			add_data['POST_ID'] = __TARGET_POST_ID;
			add_data['POST_TYPE'] = type_post;
			$.ajax({
				type: 'POST',
				dataType: "text",
				url: 'f_5_group_post.php',
				data: (add_data)
			}).done(function(data) {
				//alert (data)
				window.location.reload();
			})
			.fail(function() {
				// just in case posting your form failed
				alert("Posting failed.");
			});
		});

		
        // Initial Run ========================================= 
		create_monthly_Purpose()
		


    });
    </script>
</body>

</html>
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
				height: 50px; 
				width: 100%; 
				
			}
		.zoom:hover {
			height: auto; 
			width: 200px; 
			display: block;
			margin-left: auto;
			margin-right: auto;
			overflow: hidden; 
			position:absolute;
		  -ms-transform: scale(1.2); /* IE 9 */
		  -webkit-transform: scale(1.2); /* Safari 3-8 */
		  transform: scale(1.2); 
		   
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
					<a type="button" href="12_case-search.php" class="btn btn-box-tool" ><i class="fa fa-search"></i> ค้นหาอย่างง่าย</a></small>
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
                                <table class="table datatable-basic display " id="style-1" style="width:2500px">
								
                                    <thead>
										<tr>
                                            <th style="max-width:5%"></th>
                                            <th style="width:5%" class="text_search">Case ID</th>
                                            <th style="width:13%" class="text_search">หัวข้อ</th>
                                            <th style="width:5%" class="text_search">เข้าสู่ระบบ</th>
											<th style="width:4%" class="text_search">สถานะ</th>
											<th style="width:5%" class="text_search">หน่วยงาน</th>
											<th style="width:5%" class="text_search">ประเภท</th>
											<th style="width:5%" class="text_search">จังหวัด</th>
											<th style="width:5%" class="text_search">ภาค</th>
											<th style="width:5%" class="text_search">ประเภทงาน</th>
											<th style="width:5%" class="text_search">การทุจริต</th>
											<th style="width:3%">มูลค่าโครงการ</th>
											<th style="width:3%">ความเสียหาย</th>
											<th style="width:5%" class="text_search">ลงเพจเมื่อ</th>
											<th style="width:4%">Engagement</th>
											<th style="width:4%">Reach</th>
											<th style="width:4%" >จำนวน EP</th>
											<th style="width:4%">จำนวนโพส</th>
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
                add_data['f'] = '83';
                add_data['select_year'] = $("#select_year_case").val();
				//alert(add_data['select_year'])
                $.ajax({
                        type: 'POST',
                        dataType: "text",
                        url: 'f_1_case.php',
                        data: (add_data)
                    })
                    .done(function(data) {
                        //alert (data)
						
							//alert(data)
							var print_text = "";
							var data_arr = JSON.parse(data);

							//console.log(data_arr)


							jQuery.each(data_arr, function(i, val) {
								print_text += "<TR class='table_tr' value='"+val.case_id+"'>"
								print_text += "<TD><img src='"+val.img+"'  style='object-fit: cover;' class='zoom'></img> </TD>"
								print_text += "<TD><B>"+val.print_case_id+"</B></TD>"
								print_text += "<TD>"+val.topic+"</TD>"

								case_add_time = moment(val.add_date, "YYYY-MM-DD").format('DD-MMM-YYYY')
								print_text += "<TD>"+case_add_time+"</TD>"
								// Status echo
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
											
								
								print_text += "<TD><span class='label' style='background-color:"+case_status_bg+"; color:"+case_status_font+";'>"+case_status_icon + " " +val.crp_status+"</span></TD>"
								print_text += "<TD>"+val.ofd_name+"</TD>"
								print_text += "<TD>"+val.ofd_type+"</TD>"
								print_text += "<TD>"+val.province_name+"</TD>"
								print_text += "<TD>"+val.geo_name+"</TD>"
								print_text += "<TD>"+val.Job_Type+"</TD>"
								print_text += "<TD>"+val.crp_type+"</TD>"
								
								print_crp_dmg_off = "-"
								if (val.crp_dmg_off != "0")
								{
									print_crp_dmg_off = numeral(val.crp_dmg_off).format('0,0')
								}
								
								print_text += "<TD>"+ print_crp_dmg_off +"</TD>"
								
								print_ofd_dmg = "-"
								if (val.ofd_dmg != "0")
								{
									print_ofd_dmg = numeral(val.ofd_dmg).format('0,0')
								}
								print_text += "<TD>"+print_ofd_dmg+"</TD>"

								//case_pub_time = moment(val.pubtime, "YYYY-MM-DD").format('DD/MM/') + " " +(((parseInt(moment(val.pubtime, "YYYY-MM-DD").format('YYYY')) + 543) % 100 ).toString())
								case_pub_time = "01-Jan-0000"
								if ( val.pubtime != null)
								{
									case_pub_time = moment(val.pubtime, "YYYY-MM-DD").format('DD-MMM-YYYY')
								}
								
								
								print_text += "<TD>"+case_pub_time+"</TD>"
								print_text += "<TD>"+numeral(val.engegement).format('0,0')+"</TD>"
								print_text += "<TD>"+numeral(val.REACH).format('0,0')+"</TD>"
								print_text += "<TD>"+numeral(val.count_ep).format('0,0')+"</TD>"
								print_text += "<TD>"+val.count_post+"</TD>"
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
		
		function get_year_data()
			{
				var add_data = {}
					add_data['f'] = '29';
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_4_static.php',
						data: (add_data)
					})
					.done(function(data) {
						//alert (data)
						var data_arr = JSON.parse(data);
						print_text = "";
						var _flg_year_select = 0;
						jQuery.each( data_arr, function( i, val ) {
							if (_flg_year_select == 0) 
							{
								print_text += "<option value ='"+val.YR+"' selected>"+val.YR+"</option>";
							}
							else
							{
								print_text += "<option value ='"+val.YR+"'>"+val.YR+"</option>";
							}
							_flg_year_select = 1;
						});
						//select_year_case
						$("#select_year_case").html(print_text);
						
						//load_page_data();
						load_table_data();
						 
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
			add_data['f'] = '84';
			add_data['select_year'] = $("#select_year_case").val();
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
		
		//table_tr
		$('body').on('click', '.table_tr', function() {
			 var target = $(this).attr('value')
            var win = window.open('14_case_data.php?case_id=' + target, '_blank');
            win.focus();
		});

		
        // Initial Run ========================================= 
		get_year_data()
		


    });
    </script>
</body>

</html>
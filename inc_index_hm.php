<!DOCTYPE html>
<html>
  <head>
  <?php
		ob_start();
		include "f_check_cookie.php";
		ob_end_clean();
	?>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Watch_Dog | Heat_Map</title>
	<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  #floating-panel {
        position: absolute;
        top: 15%;
        left: 10%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 2%;
        padding: 5px;
        position: absolute;
        top: 10%;
        z-index: 5;
      }
    </style>
  </head>
  <body>
	<div id="floating-panel">
		<div id="result"></div>
		<a href="#" id = "change_panel"><i class="fa fa-plus"></i></a>
		<a href="#" id = "remove_panel" hidden><i class="fa fa-minus"></i></a><Br>
		<table  align="left" id="table_option" hidden>
			<TR>
				<TD align="right">สถานะ</TD><TD align="left"><input type="checkbox" id="hmstatus_0" checked>Active<input type="checkbox" id="hmstatus_1" >Non-Active<input type="checkbox" id="hmstatus_2" >Baned</TD>
			</TR>
			<TR>
				<TD align="right">เพศ</TD><TD align="left"><input type="checkbox" id="hms_0" checked>ชาย<input type="checkbox" id="hms_1" checked>หญิง</TD>
			</TR>
			<TR>
				<TD align="right">ช่วงอายุ</TD><TD align="left"><input type="text" name="fname" maxlength="2" size="4" value="10" id="age_s"> ถึง <input type="text" name="fname" maxlength="2" size="4" value="80" id="age_e"></TD>
			</TR>
			<TR>
				<TD align="right">กลุ่มอาชีพ</TD><TD align="left"><select multiple class="form-control" id="hm_occ_select"></select></TD>
			</TR>
			<TR>
				<TD align="right">รุ่น</TD><TD align="left"><select multiple class="form-control" id="hm_gen_select"></select></TD>
			</TR>
			<TR>
				<TD></TD><TD><button type="button" class="btn" id="btn_gethmwd">ตกลง</button></TD>
			</TR>
			
		</table>
	</div>
  
    <div id="map"></div>
    <script>
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 15, lng: 103},
          mapTypeId: 'roadmap',
		  mapTypeControl: true,
		 styles:[
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "weight": 2
      }
    ]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "geometry.stroke",
    "stylers": [
      {
        "weight": 1
      }
    ]
  },
  {
    "featureType": "administrative.province",
    "elementType": "labels.text.fill",
    "stylers": [
      {
        "color": "#7c7c7c"
      }
    ]
  },
  {
    "featureType": "landscape.natural",
    "elementType": "geometry.fill",
    "stylers": [
      {
        "color": "#ffffff"
      }
    ]
  },
  {
    "featureType": "landscape.natural.terrain",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.business",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
]

        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
		
		 heatmap.set('radius', heatmap.get('radius') ? null : 20);
      }
	  
	 

      function getPoints() {
        return [
		<?php
			include "connectionDb.php";
			$get_data= "Select a.AMPHUR_CODE, a.cnt, TRUNCATE(AVG(b.lat), 4) AS LAT, TRUNCATE(AVG(b.lon), 4) AS LON From wd_add_cnt a INNER JOIN add_location b ON a.AMPHUR_CODE = b.AM_ID Group By a.AMPHUR_CODE";
			$res = $conn->query(trim($get_data));
			$cnt_chk = 0;
			while ($row = $res->fetch_assoc()){
				if ($cnt_chk == 1)
				{
					echo ",";
				}
				echo "{location: new google.maps.LatLng(".$row['LAT'].", ".$row['LON'].",), weight: ".$row['cnt']."}";
				$cnt_chk = 1;
			}
		?>
        ];
      }
    </script>
	
	<!-- jQuery 3 -->
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<script>
		$(document).ready(function(){
			
			// Standard Ajax Function 
				function ajax_function($f, $d_name, $p1, $p2, $p3) {
					// Check parameter has been set or not
					$f = $f || "0";
					$p1= $p1 || "0";
					$p2= $p2 || "0";
					$p3= $p3 || "0";
					// Set Ajax
					$.ajax({
						type: 'POST',
						dataType: "text",
						url: 'f_0_index.php',
						data: ({f : $f,
								p1 : $p1,
								p2 : $p2,
								p3 : $p3})
					})
					.done(function(data){
							if ($($d_name).is('input'))
							{
								$($d_name).val(data);
							}
							else
							{
								$($d_name).html(data);
							}
					})
					.fail(function() {
						// just in case posting your form failed
						alert( "Posting failed." );
					});
					return false;	
				};
			
			
			
			
			$( "#change_panel" ).click(function() {
				$('#table_option').show();
				$('#change_panel').hide();
				$('#remove_panel').show();
			});
			
			$( "#remove_panel" ).click(function() {
				$('#table_option').hide();
				$('#change_panel').show();
				$('#remove_panel').hide();
			});
			
			
			ajax_function(4, "#hm_occ_select");
			ajax_function(5, "#hm_gen_select");
			
		});
		
						// btn_gethmwd
				$( "#btn_gethmwd" ).click(function() {
					var hm_data = {}
					hm_data['rang_age'] = ($("#age_s").val() + "," + $("#age_e").val());
					hm_data['wd_sex'] = "";
					if ($('#hms_0').is(':checked'))
					{
						hm_data['wd_sex'] = "0";			
					}
					if ($('#hms_1').is(':checked'))
					{
						if (hm_data['wd_sex'] != "")
						{
							hm_data['wd_sex'] += ", 1";
						}
						else 
						{
							hm_data['wd_sex'] = "1";
						}
					}
					
					
					hm_data['wd_status'] = "";
					if ($('#hmstatus_0').is(':checked'))
					{
						hm_data['wd_status'] = "1";			
					}
					if ($('#hmstatus_1').is(':checked'))
					{
						if (hm_data['wd_status'] != "")
						{
							hm_data['wd_status'] += ", 2";
						}
						else 
						{
							hm_data['wd_status'] = "2";
						}
					}
					if ($('#hmstatus_2').is(':checked'))
					{
						if (hm_data['wd_status'] != "")
						{
							hm_data['wd_status'] += ", 3";
						}
						else 
						{
							hm_data['wd_status'] = "3";
						}
					}
					hm_data['hm_occ_select'] = $("#hm_occ_select").val().join();
					hm_data['hm_gen_select'] = $("#hm_gen_select").val().join();
					hm_data['f'] = "6";
					//alert ($("#hm_occ_select option:selected").text());
					//alert (hm_data['hm_gen_select']);
					
						// Set Ajax
						$.ajax({
							type: 'POST',
							dataType: "text",
							url: 'f_0_index.php',
							data: (hm_data)
						})
						.done(function(response){
							//alert(response); //showing response is working
							var data = JSON.parse(response);
							var data_geo = [];
							jQuery.each( data['LAT'], function( i, val ) {
							  data_geo.push({location: new google.maps.LatLng(data['LAT'][i], data['LON'][i]), weight: data['CNT'][i]});
							});
							heatmap.set('data', heatmap.get('data') ? null : data_geo);
							heatmap = new google.maps.visualization.HeatmapLayer({
							  data: data_geo,
							  map: map
							});	
								
								
								
								
						})
						.fail(function() {
							// just in case posting your form failed
							alert( "Posting failed." );
						});
						return false;	
					
				});
			
		</script>
	
	
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-qmWmKTeZYf9ohc7WqHP_8WUsK-DjIBI&libraries=visualization&callback=initMap&language=th&region=TH">
    </script>
  </body>
</html>
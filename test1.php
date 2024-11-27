<!doctype html>
<html>

<head>
	<title>Bar Chart</title>
	<!-- ChartJS -->
		<script src="bower_components/chart.js/src27/Chart.bundle.js"></script>
		<script src="bower_components/chart.js/src27/utils.js"></script>
		
	<style>
	canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	</style>
</head>

<body>
	<div id="container" style="width: 75%;">
		<canvas id="chart_member_occ"></canvas>
	</div>
	<script>
		var color = Chart.helpers.color;
		var barChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: [5,8,2,1,5,6,0]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('chart_member_occ').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Chart.js Bar Chart'
					}
				}
			});

		};
	</script>
</body>

</html>

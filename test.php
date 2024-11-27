
<!doctype html>
<html>

<head>
	<title>Pie Chart</title>
	<script src="bower_components/chart.js/src27/Chart.bundle.js"></script>
</head>

<body>
	<div id="canvas-holder" style="width:40%">
		<canvas id="chart_member_sex"></canvas>
	</div>
	<script>

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [32, 18],
					backgroundColor: ['rgb(54, 162, 235)', 'rgb(255, 99, 132)'],
					label: 'Dataset 1'
				}],
				labels: [
					'ชาย',
					'หญิง'
				]
			},
			options: {
				responsive: true
			}
		};
		window.onload = function() {
			var ctx = document.getElementById('chart_member_sex').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
	</script>
</body>

</html>

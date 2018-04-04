@extends('Admin.layouts.layout')
@section('css_bottom')
<style>
  	.widget svg text, .widget .nvd3 text {
    	fill: #000; 
	}
</style>
@endsection
@section('body')
<div class="col-lg-12">
	<h2 class="page-title">
		{{$title_page or '' }}
		<div class="pull-right">
			<button class="btn btn-success btn-add">
				+เพิ่ม{{$title_page or '' }}
			</button>
		</div>
	</h2>

	<section class="widget widhget-min-hight">
		<div class="body no-margin table-responsive">
			<div id="chart_div"></div>
		</div>
	</section>
</div>
@endsection
@section('js_bottom')
	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">

	// Load the Visualization API and the corechart package.
	google.charts.load('current', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);

	// Callback that creates and populates a data table,
	// instantiates the pie chart, passes in the data and
	// draws it.
	function drawChart() {
		// Create the data table.
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Topping');
		data.addColumn('number', 'Slices');
		data.addRows([
			['Mushrooms', 3],
			['Onions', 1],
			['Olives', 1],
			['Zucchini', 1],
			['Pepperoni', 2]
		]);

		// Set chart options
		var options = {
			'title':'Google Chart',
			'width':400,
            'height':300
		};
		// Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
	</script>
@endsection
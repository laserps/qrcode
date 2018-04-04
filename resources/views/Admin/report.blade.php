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
			<canvas id="myChart"></canvas>
		</div>
	</section>
</div>
@endsection
@section('js_bottom')
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [{
				label: "My First dataset",
				backgroundColor: 'rgb(255, 99, 132)',
				borderColor: 'rgb(255, 99, 132)',
				data: [0, 10, 5, 2, 20, 30, 45],
			}]
		},

		// Configuration options go here
		options: {}
	});
</script>
@endsection
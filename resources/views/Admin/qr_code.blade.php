<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<!-- {{$activity}} -->
	<form id="FormAdd">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="modal-body">
	    <div class="form-group">
	        <label for="add_phone">Phone</label>
	        <input type="text" class="form-control" name="phone" id="add_phone" required="" placeholder="phone">
	    </div>
		</div>
		<div class="modal-footer">
		    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
		    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
		</div>
		</form>
</body>
</html>
<script src="{{asset('assets/admin/lib/jquery/dist/jquery.min.js')}}"></script>
<script>
	$('body').on('submit','#FormAdd',function(e){
		e.preventDefault();
		$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
                method : "POST",
                url : "{{url('/admin/QRCODE')}}",
                dataType : 'json',
                data :$(this).serialize()
            }).done(function(rec){
                if (rec.status == 1) {
					@php $url = '/admin/Activities/'.$activity->code.'/getQuestion'; @endphp
                	window.location = "{{url($url)}}";
				}
                // }else{
                // 	alert('Error');
                // }
            }).error(function(){
                
            });
	});
</script>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" />
</head>
<body>
	<!-- {{$activity}} -->
<div class="row">
  <div class="col-md-6 col-md-offset-3">
  	<div class="panel panel-success" style="margin-top: 41px;">
		<div class="panel-heading">
			<h3 class="panel-title">กรอกข้อมูลเบอร์โทรศัพท์</h3>
		</div>
		<div class="panel-body">
			<form class="form-inline" id="FormAdd">
			  <div class="form-group">
			    <div class="form-group">
				    <label for="add_phone">เบอร์โทรศัพท์ : </label>
				    <input type="text" class="form-control" name="phone" id="add_phone" placeholder="กรอกข้อมูลเบอร์โทรศัพท์">
				</div>
			  <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
			</form>
		</div>
	</div>
  </div>
</div>
</body>
</html>
<script src="{{asset('assets/admin/lib/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.js')}}"></script>
<script>
	$('body').on('submit','#FormAdd',function(e){
		e.preventDefault();
		if ($('#add_phone').val()!= ' ') {
			$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method : "POST",
			url : "{{url('/admin/QRCODE')}}",
			dataType : 'json',
			data :$(this).serialize()
		}).done(function(rec){
			if(rec.status==1){
	              	var getUrl = '{{url("")}}/admin/Activities/{{$activity->code}}/'+rec.user_id+'/getQuestion';
	                window.location = getUrl;
                }else{
                	swal({
                        position: 'center',
                        type: 'error',
                        title: rec.title,
                        text:  rec.content,
                        showConfirmButton: true
                      },function(){
                        $('#add_phone').val('');
                      });
                }
			}).error(function(){

			});
		}else{
			swal({
                position: 'center',
                type: 'error',
                title: 'ไม่มีข้อมูล',
                text:  'กรุณากรอกเบอร์โทรก่อนบันทึก',
                showConfirmButton: true
              });
		}
		});
	</script>
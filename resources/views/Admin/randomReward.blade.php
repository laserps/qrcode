<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

    <div class="contianer">

        <br>
            <div class="offset-md-1 col-md-10">

            </div>
        <br>
        @php $i=1; @endphp
        <form id="answer_history">
            {!! csrf_field() !!}
            <input type="hidden" name="activity_id" value="">
            <input type="hidden" name="user_id" value="">


            <div class="offset-md-1 col-md-10">
                <div class="card border-dark mb-3">

                    <div class="card-body text-dark">
                        
                        <div class="card-text text-center">
                            <h5 class="card-title">ยินดีด้วยคุณได้รับของรางวัล</h5>
                            <h5 class="card-title">{{$reward->name}}</h5>
                            <img style="width:100%;" src="{{asset('uploads/temp/'.$reward->getRewardPicture->path_picture)}}" class="img-responsive" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-md-1 col-md-10">
            </div>
        </form>
        <br>
    </div>
</body>
<script src="{{asset('assets/admin/lib/jquery/dist/jquery.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    $('body').on('submit','#answer_history',function(e){
		e.preventDefault();
		$.ajax({
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
                method : "POST",
                url : "{{url('/admin/AnswerHistory')}}",
                dataType : 'json',
                data :$(this).serialize()
            }).done(function(rec){

            });
	});
</script>
</html>
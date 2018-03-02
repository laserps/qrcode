<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/custom.css')}}" />
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

</head>
<body>

    <div class="container override">

      <!-- <div class="row">
    		<div class="col-md-4 col-md-offset-4">

    			<img src="http://www.logisticleads.com/uploads/default-logo.png" class="img-responsive center-block" alt="Yout Logo Here">

    		</div>
    	</div> -->

      <div class="col-md-10 col-md-offset-1 padding-zero">


      <form id="answer_history_init">
          <input type="hidden" name="activity_id" value="{{$activity->activity_id}}">
          <input type="hidden" name="user_id" value="{{$userid}}">




                <div class="question-form">

                    <div class="question-title">
                      <h2>{{$activity->activity_name}} {{$userid}}</h2>
                    </div>

                    @foreach($SpecialQuestion as $key => $val)
                        <div class="question">
                          <input type="hidden" name="question_id" value="{{$val->id}}">
                            <label  class="question-top">
                              {{$id++}}.) {{$val->text}} &nbsp;&nbsp;&nbsp;&nbsp;
                            </label>
                            <br>
                            <label class="radio-inline">
                              <input type="radio" name="answer_status[{{$val->id}}]" id="answer{{$val->id}}" value="T"> ถูก
                            </label>
                            <br>
                            <label class="radio-inline">
                              <input type="radio" name="answer_status[{{$val->id}}]" id="answer{{$val->id}}" value="F"> ผิด
                            </label>
                        </div>
                    @endforeach

                    <center>
                        <button type="submit" class="btn btn-custom submit-margin">ส่งคำตอบ</button>
                    </center>

                </div>



            </form>

          </div>



        <br>
        <br>
    </div>



</body>
<script src="{{asset('assets/admin/lib/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.js')}}"></script>
<script>
    $('body').on('submit','#answer_history_init',function(e){
      e.preventDefault();
      $.ajax({
        headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     },
     method : "POST",
     url : "{{url('/admin/AnswerHistoryInit')}}",
     dataType : 'json',
     data :$(this).serialize()
 }).done(function(rec){
    if (rec.status == 1) {
        // alert('success');
            var getUrl = '{{url("")}}/admin/Activities/{{$activity->code}}/{{$userid}}/getQuestion';
            window.location = getUrl;
        }else{
            alert('Error');
        }
    });
});
</script>
</html>

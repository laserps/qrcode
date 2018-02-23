<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

    <div class="contianer">
        <br>
        @php $i=1; @endphp
        @foreach($question as $qt)
        
        <div class="offset-md-1 col-md-10">
            <div class="card border-dark mb-3">
                <div class="card-body text-dark">
                <h5 class="card-title">คำถามข้อที่ {{$i}}</h5>
                <p class="card-text">
                    {!!$qt->text!!}
                </p>
                
                @if($qt->answer) <hr> @endif
                
                @php $j=1; @endphp
                @foreach($qt->answer as $ans)
                    <div class="col-md-6">
                        <p>{{$j}} . {{$ans->text}}</p>
                    </div>
                    @php $j++; @endphp
                @endforeach

                </div>
            </div>
        </div>
        @php $i++; @endphp

        @endforeach
    </div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>
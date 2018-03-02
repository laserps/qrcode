<!DOCTYPE html>
<style>
    body {
      margin: 0 auto;
      padding: 0;
      background: #222 !important;
    }

    .left {
      left: 25px;
    }

    .right {
      right: 25px;
    }

    .center {
      text-align: center;
    }

    .bottom {
      position: absolute;
      bottom: 25px;
    }

    #gradient {
      background: #999955;
      background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.2, #DAB046), color-stop(0.2, #D73B25), color-stop(0.4, #D73B25), color-stop(0.4, #C71B25), color-stop(0.6, #C71B25), color-stop(0.6, #961A39), color-stop(0.8, #961A39), color-stop(0.8, #601035));
      background-image: -webkit-linear-gradient(#CCC 20%, #CCC 20%, #CCC 40%, #CCC 40%, #CCC 60%, #961A39 60%, #CCC 80%, #CCC 80%);
      background-image: -moz-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
      background-image: -o-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
      background-image: linear-gradient(#CCC 20%, #333 20%, #333 40%, #CCC 40%, #CCC 60%, #333 60%, #333 80%, #CCC 80%);
      margin: 0 auto;
      margin-top: 100px;
      width: 100%;
      height: 150px;
    }

    #gradient:after {
      content: "";
      position: absolute;
      background: #E9E2D0;
      left: 50%;
      margin-top: -67.5px;
      margin-left: -270px;
      padding-left: 20px;
      border-radius: 5px;
      width: 520px;
      height: 275px;
      z-index: -1;
    }

    #card {
      position: absolute;
      width: 450px;
      height: 225px;
      padding: 25px;
      padding-top: 0;
      padding-bottom: 0;
      left: 50%;
      top: 67.5px;
      margin-left: -250px;
      background: #E9E2D0;
      box-shadow: 0 0 5px black;
      box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
      z-index: 5;
    }

    #card img {
      width:125px;
      height:125px;
      /* border-radius: 0px; */
      border:solid 2px #ccc;
    }

    #card h2 {
      font-family: courier;
      color: #333;
      margin: 0 auto;
      padding: 0;
      font-size: 15pt;
    }

    #card p {
      font-family: courier;
      color: #555;
      font-size: 12px;
    }

    #card span {
      font-family: courier;
    }


    .class-logo{
      width:90% !important;
    }


    @media (max-width:1024px){

      #gradient {
          background: #999955;
          background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.2, #DAB046), color-stop(0.2, #D73B25), color-stop(0.4, #D73B25), color-stop(0.4, #C71B25), color-stop(0.6, #C71B25), color-stop(0.6, #961A39), color-stop(0.8, #961A39), color-stop(0.8, #601035));
          background-image: -webkit-linear-gradient(#CCC 20%, #CCC 20%, #CCC 40%, #CCC 40%, #CCC 60%, #961A39 60%, #CCC 80%, #CCC 80%);
          background-image: -moz-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
          background-image: -o-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
          background-image: linear-gradient(#CCC 20%, #333 20%, #333 40%, #CCC 40%, #CCC 60%, #333 60%, #333 80%, #CCC 80%);
          margin: 0 auto;
          margin-top: 100px;
          width: 100%;
          height: 282px;
      }

      #gradient:after{
          content: "";
          position: absolute;
          background: #E9E2D0;
          left: 50%;
          margin-top: -67.5px;
          margin-left: -270px;
          padding-left: 20px;
          border-radius: 5px;
          width: 520px;
          height: 440px;
          z-index: -1;
      }

      #card {
          position: absolute;
          width: 450px;
          height: 360px;
          padding: 25px;
          padding-top: 0;
          padding-bottom: 0;
          left: 50%;
          top: 67.5px;
          margin-left: -250px;
          background: #E9E2D0;
          box-shadow: 0 0 5px black;
          box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
          z-index: 5;
      }

      .class-logo {
        width: 90% !important;
        margin-bottom: 10px;
      }



    @media (max-width:768px){

      #gradient {
          background: #999955;
          background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.2, #DAB046), color-stop(0.2, #D73B25), color-stop(0.4, #D73B25), color-stop(0.4, #C71B25), color-stop(0.6, #C71B25), color-stop(0.6, #961A39), color-stop(0.8, #961A39), color-stop(0.8, #601035));
          background-image: -webkit-linear-gradient(#CCC 20%, #CCC 20%, #CCC 40%, #CCC 40%, #CCC 60%, #961A39 60%, #CCC 80%, #CCC 80%);
          background-image: -moz-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
          background-image: -o-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
          background-image: linear-gradient(#CCC 20%, #333 20%, #333 40%, #CCC 40%, #CCC 60%, #333 60%, #333 80%, #CCC 80%);
          margin: 0 auto;
          margin-top: 100px;
          width: 100%;
          height: 282px;
      }

      #gradient:after{
          content: "";
          position: absolute;
          background: #E9E2D0;
          left: 50%;
          margin-top: -67.5px;
          margin-left: -270px;
          padding-left: 20px;
          border-radius: 5px;
          width: 520px;
          height: 440px;
          z-index: -1;
      }

      #card {
          position: absolute;
          width: 450px;
          height: 360px;
          padding: 25px;
          padding-top: 0;
          padding-bottom: 0;
          left: 50%;
          top: 67.5px;
          margin-left: -250px;
          background: #E9E2D0;
          box-shadow: 0 0 5px black;
          box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
          z-index: 5;
      }

      .class-logo {
        width: 90% !important;
      }

      @media (max-width:375px){

        #gradient {
            background: #999955;
            background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.2, #DAB046), color-stop(0.2, #D73B25), color-stop(0.4, #D73B25), color-stop(0.4, #C71B25), color-stop(0.6, #C71B25), color-stop(0.6, #961A39), color-stop(0.8, #961A39), color-stop(0.8, #601035));
            background-image: -webkit-linear-gradient(#CCC 20%, #CCC 20%, #CCC 40%, #CCC 40%, #CCC 60%, #961A39 60%, #CCC 80%, #CCC 80%);
            background-image: -moz-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
            background-image: -o-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
            background-image: linear-gradient(#CCC 20%, #333 20%, #333 40%, #CCC 40%, #CCC 60%, #333 60%, #333 80%, #CCC 80%);
            margin: 0 auto;
            margin-top: 100px;
            width: 100%;
            height: 282px;
        }

        #gradient:after{
            content: "";
            position: absolute;
            background: #E9E2D0;
            left: 50%;
            margin-top: -67.5px;
            margin-left: -270px;
            padding-left: 20px;
            border-radius: 5px;
            width: 520px;
            height: 440px;
            z-index: -1;
        }

        #card {
            position: absolute;
            width: 450px;
            height: 360px;
            padding: 25px;
            padding-top: 0;
            padding-bottom: 0;
            left: 50%;
            top: 67.5px;
            margin-left: -250px;
            background: #E9E2D0;
            box-shadow: 0 0 5px black;
            box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
            z-index: 5;
        }

        .class-logo {
            margin-left: 80px;
            width: 80% !important;
            margin-bottom: 10px;
        }

    }

      @media (max-width:320px){

        #gradient {
            background: #999955;
            background-image: -webkit-gradient(linear, 0 0, 0 100%, color-stop(0.2, #DAB046), color-stop(0.2, #D73B25), color-stop(0.4, #D73B25), color-stop(0.4, #C71B25), color-stop(0.6, #C71B25), color-stop(0.6, #961A39), color-stop(0.8, #961A39), color-stop(0.8, #601035));
            background-image: -webkit-linear-gradient(#CCC 20%, #CCC 20%, #CCC 40%, #CCC 40%, #CCC 60%, #961A39 60%, #CCC 80%, #CCC 80%);
            background-image: -moz-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
            background-image: -o-linear-gradient(#DAB046 20%, #D73B25 20%, #D73B25 40%, #C71B25 40%, #C71B25 60%, #961A39 60%, #961A39 80%, #601035 80%);
            background-image: linear-gradient(#CCC 20%, #333 20%, #333 40%, #CCC 40%, #CCC 60%, #333 60%, #333 80%, #CCC 80%);
            margin: 0 auto;
            margin-top: 100px;
            width: 100%;
            height: 282px;
        }

        #gradient:after{
            content: "";
            position: absolute;
            background: #E9E2D0;
            left: 50%;
            margin-top: -67.5px;
            margin-left: -270px;
            padding-left: 20px;
            border-radius: 5px;
            width: 520px;
            height: 440px;
            z-index: -1;
        }

        #card {
            position: absolute;
            width: 450px;
            height: 360px;
            padding: 25px;
            padding-top: 0;
            padding-bottom: 0;
            left: 50%;
            top: 67.5px;
            margin-left: -250px;
            background: #E9E2D0;
            box-shadow: 0 0 5px black;
            box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
            z-index: 5;
        }

        .class-logo {
            margin-left: 65px;
            width: 80% !important;
            margin-bottom: 10px;
        }

    }
}
</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>

    <!-- <div class="contianer">

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
    </div> -->

    <div id="gradient"></div>
    <div id="card" style="text-align:center;">
    	<img src="/qrcode/public/uploads/logo original.JPG" class="img-responsive class-logo" alt="Yout Logo Here">
      <h2>ยินดีด้วยคุณได้รับของรางวัล</h2>
      <p style="font-size:20px;font-weight:700;">{{$reward->name}}</p>
      <div class="row">
        <div class="col-12">
          <img src="{{asset('uploads/temp/'.$reward->getRewardPicture->path_picture)}}" class="img-responsive" alt="Image" />
        </div>
      </div>
      <!-- <span class="left bottom">tel: 530 283 ****</span>
      <span class="right bottom">Adres:Türkiye/Şanlıurfa</span> -->

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

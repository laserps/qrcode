<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
</head>

<style>
body {
    margin: 0 auto;
    padding: 0;
    background: #fff !important;
    font-family: 'Kanit', sans-serif;
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
    background: #ef3e34;
    margin: 0 auto;
    margin-top: 100px;
    width: 100%;
    height: 195px;
}

#gradient:after {
    border-style: groove;
    border-width: 1px;
    border-color: #c3c3c3;
    content: "";
    position: absolute;
    background: #ffffff;
    left: 50%;
    margin-top: -67.5px;
    margin-left: -270px;
    padding-left: 20px;
    border-radius: 5px;
    width: 520px;
    height: 420px;
    z-index: -1;
}

#card {
    position: absolute;
    width: 450px;
    height: 355px;
    padding: 25px;
    padding-top: 0;
    padding-bottom: 0;
    left: 50%;
    top: 67.5px;
    margin-left: -250px;
    background: #ffffff;
    box-shadow: 0 0 5px black;
    box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
    z-index: 5;
}

#card img {
    margin-bottom: 4%;
    width:125px;
    height:125px;
}

#card h2 {
    font-family: 'Kanit', sans-serif;
    color: #333;
    margin: 0 auto;
    padding: 0;
    font-size: 15pt;
}

#card p {
    font-family: 'Kanit', sans-serif;
    color: #555;
    font-size: 12px;
}

#card span {
    font-family: 'Kanit', sans-serif;
}


.class-logo{
    width:90% !important;
}


@media (max-width:1024px){

    #gradient {
        margin-top: 100px;
        width: 100%;
        height: 282px;
    }

    #gradient:after{
        content: "";
        position: absolute;
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
        box-shadow: 0 0 5px black;
        box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
        z-index: 5;
    }

    .class-logo {
        width: 90% !important;
        margin-bottom: 10px;
    }


}

@media (max-width:768px){

    #gradient {
        margin: 0 auto;
        margin-top: 100px;
        width: 100%;
        height: 282px;
    }

    #gradient:after{
        content: "";
        position: absolute;
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
        box-shadow: 0 0 5px black;
        box-shadow: -20px 0 35px -25px black, 20px 0 35px -25px black;
        z-index: 5;
    }

    .class-logo {
        width: 90% !important;
    }

    @media (max-width:375px){

        #gradient {
            margin-top: 100px;
            width: 100%;
            height: 282px;
        }

        #gradient:after{
            content: "";
            position: absolute;
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

            margin-top: 100px;
            width: 100%;
            height: 282px;
        }

        #gradient:after{
            content: "";
            position: absolute;
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
.modal > .modal-dialog > .modal-content > form > .modal-body > .table > thead > tr > th {
	color : #555;
	vertical-align: middle;
}
html.modal_openoverflow {
	overflow: hidden;
}
.modal {
	overflow: hidden;
	-webkit-overflow-scrolling: touch;
}
.modal {
	padding: 0px!important;
}
.modal-dialog {
	padding: 0;
}
.modal-content {
	-webkit-transition: margin-top .2s;
	-moz-transition: margin-top .2s;
	transition: margin-top .2s;
}
.modal-body {
	max-height: -webkit-calc(100vh - 210px);
    max-height: -moz-calc(100vh - 210px);
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
.modal-footer {
	margin-top: 0px;
}
.form-on-table .form-group {
	text-align: left;
}
.form-on-table .form-group .chosen-container {
	min-width: 159px;
}
.modal-maximize .modal-dialog {
	width: 100%;
}
.modal-maximize .modal-body {
	max-height: -webkit-calc(100vh - 130px);
    max-height: -moz-calc(100vh - 130px);
    max-height: calc(100vh - 130px);
    overflow-y: auto;
    min-height: -webkit-calc(100vh - 130px);
    min-height: -moz-calc(100vh - 130px);
    min-height: calc(100vh - 130px);
}
@media only screen and (max-width: 767px) {
	.modal-body {
		max-height: -webkit-calc(100vh - 130px);
		max-height: -moz-calc(100vh - 130px);
		max-height: calc(100vh - 130px);
		overflow-y: auto;
	}
}

.modal-maximize{
    width : 100%;
}


@media only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	.modal-maximize .modal-body {
		padding: 12px;
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
    <img src="{{asset('uploads/logo original.JPG')}}" class="img-responsive class-logo" alt="Yout Logo Here">
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
<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-maximize" role="document">
        <div class="modal-content">
            <form id="FormAdd">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" style="vertical-align:middle;">
                    {!!$text!!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิด</button>
                </div>
            </form>
        </div>
    </div>
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
$(function() {
    $('#ModalAdd').modal('show');
});
</script>
</html>

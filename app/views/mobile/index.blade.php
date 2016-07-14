<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link href="{{asset('public/css/activity-style.css')}}" rel="stylesheet" type="text/css">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <style>
            body{
                background:  url("{{asset('public/img/01bg.jpg')}}"); 
                background-attachment:fixed;
                background-size: 100% 100%;
            }
            .logo-section{
                margin: 0 auto;
                position:relative;
                height:60px; 
            } 
            .top-section{
                margin: 0 auto;
                position:relative;
                height:220px; 
            } 
            .text-section{
                margin: 0 auto;
                position:relative;
                height:140px; 
            } 
            .phone-input{
                background:  url("{{asset('public/img/01input.png')}}") no-repeat center; 
                background-size: 100% 100%; 
                border: 0 none;
            }
        </style>
    </head>

</head>
<body data-role="page" class="activity-scratch-card-winning"> 
    <div class="wrap">
        <div class="logo-section"> 
            <img  src="{{asset('public/img/01logo.png')}}" width="50%" height="60px" style="position: absolute;top:10px;left:5%;">
        </div>
        <div class="top-section"> 
            <img  src="{{asset('public/img/02logo.png')}}" width="80%" height="200px" style="position: absolute;top:20px;left:10%;"> 
        </div> 
        <div class="text-section"> 
            <img  src="{{asset('public/img/01text.png')}}" width="100%" height="80px" style="position: absolute;top:20px;"> 
        </div>  
        <div class="row ">  
            <div class="col-xs-1"></div>
            {{ Form::open(['route' => 'mobile.egg', 'method' => 'post']) }}     
            <div class="col-xs-10">

                <div class="form-group"> 
                    {{ Form::text('phone',null,array('class' => 'form-control phone-input','id'=>'phone',  'placeholder'=>'请输入手机号' )) }}
                </div>
                <div class="form-group"> 
                    {{ Form::button('确定', array('class' => 'btn btn-primary btn-block','id'=>'jump')) }} 
                </div> 
            </div> 
            {{Form::close()}}  
        </div> 
    </div> 
</div> 
<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
    $('#jump').click(function(e){
        var phone=$('#phone').val();
        window.location.href=("{{URL::route('mobile.getEgg')}}?phone="+phone);
    });
</script>

</body>

</html> 
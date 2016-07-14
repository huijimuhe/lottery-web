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
                background-image: url("{{asset('public/img/02bg.png')}}");
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
                height:300px; 
            } 
            .text-section{
                margin: 0 auto;
                position:relative;
                height:140px; 
            } 
            .rule-section{
                margin: 0 auto;
                position:relative;
                height:120px; 
            } 
        </style> 
    </head>

    <body data-role="page" class="activity-scratch-card-winning"> 
        <div class="main">
            <div class="top-section"> 
                <img  src="{{asset('public/img/02logo.png')}}" width="80%" height="200px" style="position: absolute;top:20px;left:10%;"> 
            </div> 
            <div class="text-section"> 
                <img  src="{{asset('public/img/03text.png')}}" width="100%" height="80px" style="position: absolute;top:20px;"> 
            </div>  
            <div class="rule-section"> 
                @if($res==1)
                <img id="rule" src="{{asset('public/img/03notimes.png')}}" width="90%" height="120px" style="position: absolute;left:5%;">
                @else
                <img id="rule" src="{{asset('public/img/03rule.png')}}" width="90%" height="120px" style="position: absolute;left:5%;">
                @endif
            </div>
        </div> 
    </body>

</html> 
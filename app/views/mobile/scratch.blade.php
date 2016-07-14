<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link href="{{asset('public/css/activity-style.css')}}" rel="stylesheet" type="text/css"> 
        <style>
            body{
                background-image: url("{{asset('public/img/01bg.png')}}");
                background-attachment:fixed;
            }
            .top-section{
                margin: 0 auto;
                position:relative;
                height:190px; 
            }
            .rule-section{
                margin: 0 auto;
                position:relative;
                height:130px;  
            }
            h6{
                font-size:10px;
                font-family: "黑体";
            }
        </style>
    </head> 
    <body data-role="page" class="activity-scratch-card-winning"> 
        <div class="main">
            <div class="top-section"> 
                <img id="logo" src="{{asset('public/img/02logo.png')}}" width="75%" height="190px" style="position: absolute;top:20px;left:12%;">
            </div>
            <div class="cover">
                <img src="{{asset('public/img/scratch-bg.png')}}">
                <div id="win" style="display:none">      
                    <h6>恭喜您中奖<h6>
                            </div>
                            <div id="prize">   
                            </div> 
                            <div id="scratchpad">
                            </div>
                            </div> 
                            <div id="refresh" style="display:none;text-align:center;">      
                                <a href="javascript: window.location.reload()" style="text-transform:none;text-decoration:none;font-size:30px;text-align:center;line-height: 11px;margin-top:7px;color:#ff3767;">再试一次<a>
                                        </div>
                                        <div class="text-section"> 
                                            <h6 id="phone" style="font-size:30px;text-align:center;line-height: 11px;margin-top:7px;">{{$res['phone'] or 'phone'}}</h6>
                                            <h6 style="font-size:20px;text-align:center;">您还剩余<span style="font-size:40px;text-align:center;color:#ff3767;">{{$res['time'] or '0'}}</span>次抽奖机会</h6>
                                        </div>
                                        <div class="rule-section"> 
                                            <img id="rule" src="{{asset('public/img/02rule.png')}}" width="90%" height="110px" style="position: absolute;left:5%;">
                                        </div>
                                        </div>
                                        <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
                                        <script src="{{asset('public/js/wScratchPad.js')}}" type="text/javascript"></script>
                                        <script type="text/javascript">
var num = 0;
$("#scratchpad").wScratchPad({
    width: 210,
    height: 70,
    color: "#a9a9a7",
    scratchMove: function() {
        num++;
        if (num == 2) {
            document.getElementById('prize').innerHTML += "{{$res['prize'] or ''}}";
            if ("{{$res['win'] or '0'}}" == "1") {
                $('#win').fadeIn();
            }
            $('#refresh').fadeIn();
            $('#phone').fadeOut();
        }
    }
});
                                        </script> 
                                        </body>

                                        </html>
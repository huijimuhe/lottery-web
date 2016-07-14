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
            .egg{height:200px;width:100%;margin:0 auto;display: table;position:relative;}
            .egg ul li{z-index:999;}
            .eggList{position:relative;margin-left:60px;}
            .eggList li{list-style-type:none;float:left;background:url({{asset('public/img/egg_1.png')}}) no-repeat bottom;width:158px;height:187px;cursor:pointer;position:relative;margin-left:35px;}
            .eggList li span{position:absolute; width:30px; height:60px; left:68px; top:64px; color:#ff0; font-size:42px; font-weight:bold}
            .eggList li.curr{background:url({{asset('public/img/egg_2.png')}}) no-repeat bottom;cursor:default;z-index:300;}
            .eggList li.curr sup{position:absolute;background:url({{asset('public/img/img-4.png')}}) no-repeat;width:232px; height:181px;top:-36px;left:-34px;z-index:800;}
            .hammer{background:url({{asset('public/img/img-6.png')}}) no-repeat;width:74px;height:87px;position:absolute; text-indent:-9999px;z-index:150;left:168px;top:10px;}
            .resultTip{position:absolute;width:148px;padding:6px;z-index:500;top:200px; left:10px; color:#ff3767; text-align:center;overflow:hidden;display:none;z-index:500;}
            .resultTip b{font-size:44px;line-height:24px;}
            .top-section{
                margin: 0 auto;
                position:relative;
                height:220px; 
            }
            .rule-section{
                margin: 0 auto;
                position:relative;
                height:130px;  
            }
            h6{
                font-size:16px;
                font-family: "黑体";
            } 
        </style>
    </head> 
    <body data-role="page" class="activity-scratch-card-winning"> 
        <div class="main">
            <div class="top-section"> 
                <img id="logo" src="{{asset('public/img/02logo.png')}}" width="75%" height="190px" style="position: absolute;top:20px;left:12%;">
            </div>
            <div class="egg">
                <ul class="eggList">
                    <p class="hammer" id="hammer">锤子</p>
                    <p class="resultTip" id="resultTip"><b id="result"></b>
                    </p>
                    <li><span></span><sup></sup></li> 
                </ul> 
            </div> 
            <div id="win-img"  style="display:none;text-align:center;">
                <img src="{{asset('public/img/win_gift.jpg')}}"  width="80%" height="190px" style="margin-left: 20px;margin-bottom:10px;"/>
            </div>
            <div id="no-img"  style="display:none;text-align:center;">
                <img src="{{asset('public/img/no_gift.png')}}"  width="80%" height="190px" style="margin-left: 20px;margin-bottom:10px;"/>
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
                        <script type="text/javascript">

$(".eggList li").click(function() {
    var _this = $(this);
    $(this).children("span").hide();
    $(".hammer").css({"top": _this.position().top - 55, "left": _this.position().left + 185});
    $(".hammer").animate({
        "top": _this.position().top - 25,
        "left": _this.position().left + 125
    }, 30, function() {
        _this.addClass("curr"); //蛋碎效果
        _this.find("sup").show(); //金花四溅
        $(".hammer").hide();
        if ("{{$res['win'] or '0'}}" == "1") { 
            $('#win-img').fadeIn();
        } else {
            $('#no-img').fadeIn();
        }
        $('#refresh').fadeIn();
        $('.egg').hide();
        $('#phone').fadeOut();
    }
    ); 
});
$(".eggList li").hover(function() {
    var posL = $(this).position().left + $(this).width();
    $("#hammer").show().css('left', posL);
})
                        </script> 
                        </body>

                        </html>
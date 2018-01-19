<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/Public/home/css/personal-data.css" />
        <link rel="stylesheet" href="/Public/home/css/custom.css" />
        <script src="/Public/home/js/jquery-1.12.2.min.js"></script>
        <script src="/Public/js/jquery.js"></script>
        <script src="/Public/home/js/ajaxfileupload.js"></script>
        <title>我的优惠券</title>
    </head>
    <script type="text/javascript">
        var pageStartTime = +new Date;
        ~
        function(e) {
            function t() {
                var t = screen.width > 0 && (e.innerWidth >= screen.width || 0 == e.innerWidth) ? screen.width : e.innerWidth;
                a && (t = screen.width);
                var i = t > u ? w : t / (u / 100);
                i = i > h ? i : h, document.documentElement.style.fontSize = i + "px"
            }
            var i, n = e.navigator.userAgent,
                a = n.match(/iphone/i),
                o = n.match(/yixin/i),
                c = n.match(/Mb2345/i),
                r = n.match(/mso_app/i),
                s = n.match(/sogoumobilebrowser/gi),
                m = n.match(/liebaofast/i),
                d = n.match(/GNBR/i),
                u = document.documentElement.dataset.dw || 720
            h = 42,
                w = 100;
            e.addEventListener("resize", function() {
                clearTimeout(i), i = setTimeout(t, 300)
            }, !1), e.addEventListener("pageshow", function(e) {
                e.persisted && (clearTimeout(i), i = setTimeout(t, 300))
            }, !1), o || c || r || s || m || d ? setTimeout(function() {
                t()
            }, 500) : t()
        }(window);
    </script>
    <body>
        <form action="/index.php/Home/Index/xg_consumer" enctype="multipart/form-data" method="post" > 
            <div class="header pr">
                <a href="javascript:history.back(-1)" class="icon pa">
                    <img src="/Public/home/img/back1.png">
                </a>
                <span>优惠券</span>                
                <!-- <input style="background-color:#000;border:0"  class="pa over"  type="submit" value="完成" />  -->
                <!-- <div class="header pr">
                <a href="javascript:history.back(-1)" class="icon pa">
                    <img src="/Public/home/img/back1.png">
                </a>        
                </div> -->
            </div>
            <div class="main">
            <!--    <div class="main-one">
                    <p class="fl">优惠券名称</p>
                    <p class="fr">优惠价格</p>
                </div> -->

            </div>
        </form>
    </body>
    <script type="text/javascript">
        $(document).ready(function() {
            var data = <?php echo json_encode($data)?>;
            var flag = '<?=$flag?>';
            var appendMainTwo = "";
            if(flag == 'choose') {
                for(var i in data) {
                    if(data[i].type != '2') {
                        var val = data[i].value+'元抵用卷';
                    } else {
                        var val = '满'+data[i].reach+'减'+data[i].value;
                    }
                     appendMainTwo += "<div class='discount' coupon_id = '"+data[i].id+"'>"
                                    + "<div class='discount-top'>"
                                    + "<img src='/Public/home/img/zekou.png'>"
                                    + "<div class='discount-top-text'>"
                                    + "<div class=text1>"+val+"</div>"
                                    + "<div class=text2>立即使用</div>"
                                    + "</div></div>"
                                    + "<div class='fengge'>"
                                    + "<img src='/Public/home/img/fengexian.png'>"
                                    + "</div>"
                                    + "<div class='time'>有效期至" + data[i].deadline + "</div>"
                                    + "</div>";
                }
            } else {
                for(var i in data) {
                    if(data[i].type != '2') {
                        var val = data[i].value+'元抵用卷';
                    } else {
                        var val = '满'+data[i].reach+'减'+data[i].value;
                    }
                    appendMainTwo += "<div class='discount'>"
                                    + "<div class='discount-top'>"
                                    + "<img src='/Public/home/img/zekou.png'>"
                                    + "<div class='discount-top-text'>"
                                    + "<div class=text1>"+val+"</div>"
                                    + "<div class=text2>立即使用</div>"
                                    + "</div></div>"
                                    + "<div class='fengge'>"
                                    + "<img src='/Public/home/img/fengexian.png'>"
                                    + "</div>"
                                    + "<div class='time'>有效期至" + data[i].deadline + "</div>"
                                    + "</div>";
                }
            }
            if($('.main').append(appendMainTwo)) {
                $('.discount').click(function() {
                    var coupon_id = $(this).attr('coupon_id');
                    if(coupon_id != undefined){
                        window.location.href = "<?php echo U('home/index/submit_order');?>?coupon_id="+coupon_id;
                    }
                })
            }
        })  

    </script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/home/css/submit-order.css" />
    <script src="/Public/home/js/jquery-1.12.2.min.js"></script>
    <title>提交订单</title>
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


  <script type="text/javascript">
//调用微信JS api 支付
function jsApiCall(){
    WeixinJSBridge.invoke(
    'getBrandWCPayRequest',
    <?php echo $jsApiParameters; ?>,
    function(res){
        if (res.err_msg == 'get_brand_wcpay_request:ok') {
            //支付成功后跳转的地址
            window.location.href = "<?php echo U('home/index/main');?>";
        }else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
            alert('请尽快完成支付哦！');
            window.location.href = "<?php echo U('home/index/main');?>";
        }else if (res.err_msg == 'get_brand_wcpay_request:fail') {
            alert('支付失败');
            window.location.href = "<?php echo U('home/index/main');?>";
        }else {
            alert('意外错误');
            window.location.href = "<?php echo U('home/index/main');?>";
        }
    }
   );
}
   
    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
    }else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
    }
    }else{
        jsApiCall();
}
</script>


  <body>

    <div class="header pr">
      <a href="<?php echo U('index/product_details');?>" class="icon pa">
        <img src="/Public/home/img/back1.png">
      </a>    
      <span class="text-phone">提交订单</span>
    </div>
    <div class="add-site">
      <p class="fl"><span><img src="/Public/home/img/place.png"></span><span class="add-1"><?php echo ($addr['addr']); ?></span></p>
      <div class="add_address"><p class="fr"><img src="/Public/home/img/select.png"></p></div>
      <p class="clearfix"><span><?php echo ($addr['name']); ?></span><span class="text-right"><?php echo ($addr['tel']); ?></span></p>
    </div>
    <div class="line-1"></div>
    <!--<div class="add-site1">
      <p class="fl"><span><img src="/Public/home/img/icon-2.png"></span><span class="add-2">套餐</span></p>
    </div>-->
    <div class="take top-1">
      <div class="take-top take-top-1">
        <p><span><img src="/Public/home/img/icon-2.png"></span><span class="accept">套餐</span></p>
      </div>
      <div class="take-bottom-main-1">
        <div class="bottom-img fl">
          <div class="img-left fl">
            <img src="<?php echo ($goods['picture_url']); ?>">
          </div>
          <div class="img-right fl">
            <p><?php echo ($goods['abstract']); ?></p>
            <p class="red-text">剩余天数: <?php echo ($g_price['time']); ?></p>
          </div>  
        </div>
        <div class="bottom-img-right fr">
          <p class="tr" id="goods_price">¥ <?php echo ($g_price['price']); ?>元</p>
          <p class="tr small-number">X1</p>
        </div>
      </div>
      <!-- <p class="send-price"><span class="fl">押金</span><span class="fr" id="ps_price">¥<?php echo ($goods['ps_price']); ?>元</span></p> -->
      <p class="send-price"><span class="fl">配送费</span><span class="fr" id="delivery">¥<?php echo ($goods['delivery']); ?>元</span></p>
      <p class="send-price1"><span class="fl"><img src="/Public/home/img/减.png">&nbsp;&nbsp;&nbsp;优惠券</span><span class="red-text fr" id="youhuijuan">请选择您的优惠券</span></p>
      <p class="send-price">租用：<input type="radio" name="payFor" value="0">&nbsp;购买：<input type="radio" name="payFor" value="1"></p>
      <p class="send-price"><span class="fl">电梯房：</span><input type="radio" name="send-way" value="elec"></span>
      楼梯房：<input type="radio" name="send-way" value="orign"></p>
      <p class="send-price">
        <span class="fl">配送区域选择：</span>
            <select name="send-area">
                <option value="siming">思明</option>
                <option value="huli">湖里</option>
                <option value="jimei">集美</option>
                <option value="xiangan">翔安</option>
                <option value="haicang">海沧</option>
                <option value="tongan">同安</option>
            </select>
      </p>
       
      </div>
    <img src="/Public/home/img/虚线.png" class="fl">
    <div class="sum">
        <p class="fr"><span>小计&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="red-text" id="xiaoji"></span></p>
    </div>
    <!-- <input type="date" name = "start-date" /><input type="date" name = "end-date" /> -->
    <div class="line-1"></div>
    <div class="buy">
      <p><span class="fl">支付方式</span><span class="fr">微信支付</span></p>
    </div>
    <form action="<?php echo U('home/Wxjs/pay_ok');?>" method="post" id="search_form">
        <input type="hidden" name="pay_for" value="">
        <input type="hidden" name="addr" value="<?php echo ($addr['addr']); ?>">
        <input type="hidden" name="receiver" value="<?php echo ($addr['name']); ?>">
        <input type="hidden" name="tel" value="<?php echo ($addr['tel']); ?>">
        <input type="hidden" name="g_id" value="<?php echo ($goods['id']); ?>"> 
        <input type="hidden" name="relet" value=""> 
        <input type="hidden" name="o_price" value="1" id="o_price">
        <input type="hidden" name="deposit" value="<?php echo ($goods['ps_price']); ?>" id="deposit">
        <input type="hidden" name="express" value="<?php echo ($goods['delivery']); ?>" id="express">
        <input type="hidden" name="xd_time" value="">
        <input type="hidden" name="repay" value="<?php echo ($repay); ?>">
        <input type="hidden" name="price_id" value="<?php echo ($g_price['id']); ?>">
        <input type="hidden" name="order_id" value="<?php echo ($goods['order_id']); ?>">
        <input type="hidden" name="coupon_id" value="<?=empty($coupon) ? '' : $coupon['id'] ?>">
        <input type="hidden" name="exchange" value="<?=empty($exchange) ? '' : $exchange ?>">
        <input type="hidden" name="send_area" value="">
        <div class="footer">
        <div class="submit fr">
            <a id="aSubmit">提交订单</a>
        </div>
            <div class="price fr"><p><span>合计:&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="red-text" id="zongji"></span></p></div>     
        </div>
    </form>
  </body>
</html>
  <script type="text/javascript">
    $(document).ready(function() {
        var rest = '<?=$goods["rest"]?>';
        var relet = '<?=$relet?>';
        var area = '<?=json_encode($area)?>';
        var repay =  "<?php echo ($repay); ?>";
        var g_price = '<?=json_encode($g_price)?>';
        var coupon = '<?=json_encode($coupon)?>';
        coupon = JSON.parse(coupon);
        area = JSON.parse(area);
        var exchange = '<?=$exchange?>';
        var goods_price = $("#goods_price").text().replace(/[^0-9\.]/ig,"");
        // var ps_price = $("#ps_price").text().replace(/[^0-9\.]/ig,"");
        var delivery = $("#delivery").text().replace(/[^0-9\.]/ig,"");
        var youhuijuan = '';
        if(coupon != '') {
            if(coupon.type != '2') {
                youhuijuan = coupon.value;
                $('#youhuijuan').text('- ￥'+coupon.value);
            }else if( parseFloat(goods_price) >= parseFloat(coupon.reach)) {
                youhuijuan = coupon.value;
                $('#youhuijuan').text('满'+coupon.reach+'减'+coupon.value);
            }
        }
        if(g_price == 'null') {
            $('input[value="1"]').prop('checked',true);
        } else {
            $('input[value="0"]').prop('checked',true);
        }
        if(repay == 'repay') {
            var price = '<?=$goods["price"]?>';
            $('#goods_price').text(price);
        }
        if(relet == 'true') {
            // $('#ps_price').text('无需支付押金');
            $('#delivery').text('无需支付配送费');
            $('[name="relet"]').val('true');
            var a = goods_price * 1;
            var total = parseFloat(a * 1 - youhuijuan * 1).toFixed(2);
            var totalString = "￥:" + total + "元";
            var order_id = '<?=$order_state["order_id"]?>';
            var endDate = '<?=$order_state["xd_time"]?>'
            var usetime = "<?php echo $g_price['time'];?>";
            var date = new Date(endDate);
            var Dstring = date.valueOf() + usetime * 24 * 60 * 60 * 1000;
            date = new Date(Dstring);
            var year = date.getFullYear();
            var month =(date.getMonth() + 1).toString();
            var day = (date.getDate()).toString();
            if (month.length == 1)  month = "0" + month;
            if (day.length == 1) day = "0" + day;
            var NendDate = year +'-'+ month +'-'+ day;
            $('input[name="xd_time"]').val(NendDate);
            $('input[name="order_id"]').val(order_id);
            $('.header').find('a').attr('href', "<?php echo U('index/main');?>");
            // var confirmString = '是否续租';
        } else {
            // var a = goods_price * 1 + ps_price * 1 + delivery * 1;
            var a = goods_price * 1 + delivery * 1;
            var total = parseFloat(a * 1 - youhuijuan * 1).toFixed(2);
            var totalString = "￥:" + total + "元";
        }
        $("#zongji").text(totalString);
        $("#xiaoji").text(totalString);
        $("#o_price").val(total);
        // 提交验证
        $('#aSubmit').click(function() {
            var sendArea =  $('[name="send-area"]').val();
            var payFor = $('input[name="payFor"]:radio:checked').val();
            if(g_price == 'null' && payFor == '0') {
                alert('请选择购买!');
                return;
            }
            if(repay == 'repay') {
                var select_payfor = "<?php echo ($goods['pay_for']); ?>";
                if(payFor != select_payfor) {
                    alert('租用购买选项错误，不能完成支付！');
                    return;
                }
            }
            if(exchange == 'exchanged') {
                alert('该单已被转租，不能下单');
                return;
            }
            if(parseInt(rest) < 0) {
                alert('该器械已无库存，无法下单');
                return;
            }
            if(typeof(payFor) == 'undefined') {
                alert('请选择购买方式');
                return;
            } else {
                $('input[name="pay_for"]').val(payFor);
            }
            if($('input[name="send-way"]:radio:checked').val() == 'elec' || payFor == '1') {
                if(typeof(sendArea) != 'undefined') {
                    if (area[sendArea] == '1') {
                        $('[name="send_area"]').val(sendArea);
                        $('#search_form').submit();
                    } else {
                        alert('该区域不在配送范围内');
                    }
                } else {
                    alert('请选择配送区域');
                }
            } else {
                alert('楼梯房暂不配送');
            }
        })
        $('.add-site').click(function() {
            window.location.href = "<?php echo U('home/index/address_administration',array('flag' => 'submit_order'));?>";
        });
        $('.send-price1').on('click', function() {
            window.location.href = "<?php echo U('home/index/personal_coupon',array('flag' => 'choose'));?>";
        })
        $('[name="payFor"]').click(function() {
            var payFor = $('input[name="payFor"]:radio:checked').val();
            if(payFor == '1') {
                var price = '<?=$goods["price"]?>';
                var newTotal = price * 1 + delivery * 1;
                var newTotalString = "￥:" + newTotal.toFixed(2) + "元";
                $('#goods_price').text(price);
                // $('#ps_price').parent().hide();
            } else {
                var g_price = "<?php echo ($g_price['price']); ?>";
                var newTotal = total.toFixed(2);
                var newTotalString = totalString;
                $('#goods_price').text(g_price);
                // $('#ps_price').parent().show();
            }
            $("#zongji").text(newTotalString);
            $("#xiaoji").text(newTotalString);
            $("#o_price").val(newTotal);
        })
    })  

  </script>
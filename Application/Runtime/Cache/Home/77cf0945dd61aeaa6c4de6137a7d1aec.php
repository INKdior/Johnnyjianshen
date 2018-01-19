<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
            location.href = 'http://scxh.ichuangzhong.com/index.php/home/index/shengji_ok';
        }else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
            alert('请尽快完成支付哦！');
            location.href = 'http://scxh.ichuangzhong.com/index.php/home/view/information';
        }else if (res.err_msg == 'get_brand_wcpay_request:fail') {
            alert('支付失败');
            location.href = 'http://scxh.ichuangzhong.com/index.php/home/view/shengji';
        }else {
            alert('意外错误');
           location.href = 'http://scxh.ichuangzhong.com/index.php/home/view/shengji';
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
			<a href="javascript:history.back(-1)"class="icon pa">
			
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
						<img src="/Uploads/<?php echo ($goods['picture_url']); ?>">
					</div>
					<div class="img-right fl">
						<p><?php echo ($goods['abstract']); ?></p>
						<p class="red-text">剩余天数: 5天</p>
					</div>	
				</div>
				<div class="bottom-img-right fr">
					<p class="tr price">¥ <?php echo ($goods['price']); ?>元</p>
					<p class="tr small-number">X1</p>
				</div>
			</div>
			<p class="send-price"><span class="fl">配送费</span><span class="fr">¥<?php echo ($goods['ps_price']); ?>元</span></p>
			<p class="send-price1"><span class="fl"><img src="/Public/home/img/减.png">&nbsp;&nbsp;&nbsp;优惠券</span><span class="red-text fr">¥5元</span></p>
		</div>
		<img src="/Public/home/img/虚线.png" class="fl">
		<div class="sum">
			<p class="fr"><span>小计&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="red-text">-¥5元</span></p>
		</div>
		<div class="line-1"></div>
		<div class="buy">
			<p><span class="fl">支付方式</span><span class="fr">微信支付</span></p>
		</div>
		<div class="footer">
			<div class="submit fr"><a href="<?php echo U('Wxjs/jsApiCall');?>">提交订单</a></div>
			<div class="price fr"><p><span>合计:&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="red-text">¥0.01元</span></p></div>			
		</div>
	</body>
</html>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-site').click(function(){
				window.location.href="<?php echo U('home/index/address_administration');?>";
			});

		})	
	</script>
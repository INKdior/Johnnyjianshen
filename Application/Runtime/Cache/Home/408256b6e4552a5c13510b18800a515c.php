<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/Public/home/css/pay.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>交付押金</title>
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
		<div class="header pr">
			<a href="javascript:history.back(-1)" class="icon pa">
				<img src="/Public/home/img/back1.png">
			</a>		
			<span class="text-phone">交付押金</span>
		</div>
		<div class="main">
			<p class="return tr">押金缴纳后可全额退款</p>
			<p class="tc">充值余额 (元) </p>
			<p class="tc"><span class="money"><?php echo ($deposit); ?></span></p>
			<p class="tc">钱包余额：<?php echo ($rest); ?></p>
		</div>
		<div class="trik"></div>
		<div class="action">
			<p>支付方式</p>
			<p><span class="fl"><img src="/Public/home/img/weichat.png"><span>微信支付</span></span><img src="/Public/home/img/gou.png" class="fr"></p>
		</div>
		<p class="btn tc pay">去支付</p>
    <form action="<?php echo U('home/Wxjs/pay_deposit');?>" method="post">
		<input type="hidden" name="deposit" value="<?php echo ($deposit); ?>" />
    </form>
	</body>
	<script type="text/javascript">
	alert('钱包余额不足，请先支付押金！');
	$('.pay').on('click', function() {
		$('form').submit();
	})
	</script>
</html>
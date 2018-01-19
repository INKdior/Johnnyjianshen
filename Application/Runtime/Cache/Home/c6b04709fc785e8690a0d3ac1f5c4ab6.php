<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/bootstrap.css">
		<link rel="stylesheet" href="/Public/home/css/balance.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/home/js/bootstrap.min.js" type="text/jscript"></script>
		<title>个人中心</title>
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
		<div class="container-fluid header">
			<div class="return">
				<a href="<?php echo U('home/index/personal_center');?>" class="return-img">
					<img src="/Public/home/img/返回.png" />
				</a>
				<p class="person-center text-center">我的钱包</p>
			</div>
			<p class="balance">余额账户 (元)</p>
			<p class="number"><span><?php echo ($data['money']); ?></span></p>
		</div>	
		<div class="detail">
			<a href="<?php echo U('home/index/withdraw');?>"><p><span><img src="/Public/home/img/weixin2.png"></span>提现</p></a>
			<div class="long-line"></div>
			<a href="<?php echo U('home/index/particulars');?>"><p><span><img src="/Public/home/img/weixin3.png"></span>收支明细</p></a>
			<div class="long-line"></div>
		</div>
	</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/About-Us.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>关于我们</title>
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
			<span class="text-phone">关于我们</span>
		</div>
		<div class="main">
			<div class="icon-1">
				<p class="icon-text">
					<img src="<?php echo ($data['tupian']); ?>" />
				</p>
				<p class="text-word"><?php echo ($data['information']); ?></p>
			</div>
			<div class="trik"></div>
			<div class="main-two">
				<p class="fl">微信服务号</p>
				<p class="fr"><?php echo ($data['wx_number']); ?></p>
			</div>
			<div class="long-line"></div>
			<div class="main-two">
				<p class="fl">新浪微博</p>
				<p class="fr"><?php echo ($data['wb']); ?></p>
			</div>
			<div class="long-line"></div>
			<div class="main-two">
				<p class="fl">DK官网</p>
				<p class="fr"><?php echo ($data['dkweb']); ?></p>
			</div>
			<div class="long-line"></div>
		</div>
		<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<style>
		.ralation {
			height: 1rem;
			width: 100%;
			position: fixed;
			bottom: 0;
			left: 0;
			padding-top: .1rem;
			z-index: 999;
			background: #000;
			line-height: .5rem;
		}
		
		
		.ralation-box .text-center {
			color: #FFFFFF;
			font-size: .16rem;
		}
		
		.img-icon {
			width: 25%;
			margin: 0 auto;
		}
		
		.img-icon img {
			width: 100%;
			display: block;
			margin: 0 auto;
		}
	</style>

	<body>
		<div class="container ralation">
			<div class="row ralation-box">
				<div class="col-md-4 col-sm-4 col-xs-4">
					<a href="<?php echo U('index/main');?>">
						<p class="img-icon">
							<img src="/Public/home/img/<?=($flag=='main')? 'b1.png' : 'h1.png'?>">
						</p>
						<p class="text-center" id="main">首页</p>
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 my">
					<a href="<?php echo U('index/personal_center');?>">
						<p class="img-icon">
							<img src="/Public/home/img/<?=($flag=='personal')? 'h2.png' : 'b2.png'?>">
						</p>
						<p class="text-center">我的</p>
					</a>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 about-my">
					<a href="<?php echo U('index/about_us');?>">
						<p class="img-icon">
							<img src="/Public/home/img/<?=($flag=='about_us')? 'b4.png' : 'b3.png'?>">
						</p>
						<p class="text-center">关于我们</p>
					</a>
				</div>
			</div>
		</div>
	</body>

</html>
	</body>
</html>
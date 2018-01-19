<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/personal-center.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
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
		<div class="header pr">
			<a href="javascript:history.back(-1)" class="icon pa">
				<img src="/Public/home/img/back1.png">
			</a>				
		</div>
		<div class="show">
			<div class="show-img">
				<img src="<?php echo ($data['picture_url']); ?>">
			</div>
			<div class="show-text"><?php echo ($data['wxname']); ?></div>
			<div class="show-text">余额：<?php echo ($data['money']); ?></div>
		</div>
		<div class="meta">
			<p class='user-information' style="margin-top: 0"><span><img src="/Public/home/img/a-1.png"></span><span class="word-text">个人资料</span></p>
			<div class="long-line"></div>
			<p class="user-coupon"><span><img src="/Public/home/img/a-2.png"></span><span class="word-text">我的优惠券</span></p>
			<div class="long-line"></div>
			<p class='place-admin'><span><img src="/Public/home/img/a-3.png"></span><span class="word-text">地址管理</span></p>
			<div class="long-line"></div>
			<p class="indent-admin"><span class="img-last"><img src="/Public/home/img/a-4.png"></span><span class="word-text-last">订单管理</span></p>
			<div class="long-line"></div>
			<!-- <p class="myshow"><span><img src="/Public/home/img/a-5.png"></span><span class="word-text-last">我的钱包</span></p>
			<div class="long-line"></div> -->
			<!-- <p class="user-cashple"><span><img src="/Public/home/img/a-6.png"></span><span class="word-text-last">我的押金</span></p>
			<div class="long-line"></div> -->
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
	<script type="text/javascript">
		$(document).ready(function(){
			$('.place-admin').click(function(){
				window.location.href="<?php echo U('home/index/address_administration');?>";
			});
			$('.user-information').click(function(){
				window.location.href="<?php echo U('home/index/personal_data');?>";
			});
			$('.user-coupon').click(function(){
				window.location.href="<?php echo U('home/index/personal_coupon');?>"
			})
			$('.indent-admin').click(function(){
				window.location.href="<?php echo U('home/index/all_orders');?>";
			});
			$('.index').click(function(){
				window.location.href="<?php echo U('home/index/main');?>";
			});
			$('.about-my').click(function(){
				window.location.href="<?php echo U('home/index/About_Us');?>";
			})
			$('.myshow').click(function() {
				window.location.href = "<?php echo U('home/index/balance');?>";
			})
			$('.user-cashple').click(function() {
				window.location.href = "<?php echo U('home/index/cashpledge');?>";
			})
		})	
	</script>
</html>
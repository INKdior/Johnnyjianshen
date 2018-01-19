<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/product-details.css" />
		<link rel="stylesheet" href="/Public/home/css/swiper.min.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<title>产品详情</title>
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
			<a href="<?php echo U('index/main');?>" class="icon pa">
				<img src="/Public/home/img/back1.png">
			</a>		
			<span class="text-phone">产品详情</span>
		</div>
		<div class="indent">
			<div class="big-img">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					<!-- <video name="re" id="vo"> -->
						<div class="swiper-slide">
							<img src="<?php echo ($re['picture_url']); ?>">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo ($re['details_picture1']); ?>">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo ($re['details_picture2']); ?>">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo ($re['details_picture3']); ?>">
						</div>
						<div class="swiper-slide">
							<img src="<?php echo ($re['details_picture4']); ?>">
						</div>
					<!-- </video> -->
					</div>
				</div>
			</div>
		</div>
		<div class="main">
			<div class="main-first">
				<p>达康(DK)共享</p>
			</div>
			<div class="main-second">
				<p>简介 :</p>
				<?php echo ($re['abstract']); ?>
				<p>教学视频 :&nbsp;</p>
				<p id="video" url="<?php echo ($re['video']); ?>">
					<img style="" width="25px" height="25px" src="/Public/home/img/video.png">
				</p>
			</div>
			<div class="main-third">
				<p>配置信息 :</p>
				<?php echo ($re['conf_infor']); ?>
				<p>库存 : <?php echo ($re['rest']); ?></p>
			</div>
			<div class="main-fourth">
				<p>购买信息 :</p>
			</div>
		<form action="<?php echo U('index/submit_order');?>" method="post" id="search_form">
			<input type="hidden" name="g_id" value="<?php echo ($re['id']); ?>"> 
			<input type="hidden" name="purchase" value="<?php echo ($purchase); ?>"> 
				<div class="price-left">
				    <?php if(is_array($p_t)): $i = 0; $__LIST__ = $p_t;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p_t): $mod = ($i % 2 );++$i;?><p class="fl p-left tl">
				        	<?=isset($p_t['0']['price']) ? '<input type="radio" name="price" value="'.$p_t["0"]["id"].'" >'.$p_t['0']['price'].'元' : ''?>
				        		<?=isset($p_t['0']['time']) ? '('.$p_t['0']['time'].'天)'.$p_t['0']['stali'] : ''?>
				        </p>
						<p class="fl p-right tl">
							<?=isset($p_t['1']['price']) ? '<input type="radio" name="price" value="'.$p_t["1"]["id"].'" >'.$p_t['1']['price'].'元' : ''?>
				        		<?=isset($p_t['1']['time']) ? '('.$p_t['1']['time'].'天)'.$p_t['1']['stali'] : ''?>
						</p><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="footer">
				<a class="buy fr tc" href="javascript:document:search_form.submit();">下 单</a>
			</div>
		</form>
	</body>
	<script type="text/javascript">
		var purchase = '<?=$purchase?>';
		if(purchase == 'purchase') {
			$('form').hide();
			$('.main-fourth').after('<div class="main-fourth">价格&nbsp;&nbsp;<?php echo ($re["price"]); ?></div>');
		}
		$('#video').on('click',function() {
			var url = $(this).attr('url');
			if(url != '') {
				window.location.href = url;
			}
		})
		$("input[name='price']:eq(0)").attr("checked",'checked'); 
		var openid = "<?php echo $openid ?>";
		wx.config({
			debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
			appId: '<?php echo ($wx["appId"]); ?>', // 必填，公众号的唯一标识
			timestamp:'<?php echo ($wx["timestamp"]); ?>', // 必填，生成签名的时间戳
			nonceStr: '<?php echo ($wx["nonceStr"]); ?>', // 必填，生成签名的随机串
			signature: '<?php echo ($wx["signature"]); ?>',// 必填，签名，见附录1
			jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
	 	});
	 	wx.ready(function(){
		  //分享给朋友
			wx.onMenuShareAppMessage({
				title: '<?php echo ($coupon["coupon_name"]); ?>', // 分享标题 此处$title可在控制器端传递也可在页面传递 页面传递讲解在下面哦
				desc: '分享优惠券', //分享描述
				link: "<?php echo ($host); echo U('home/index/share_login',array('share_openid'=>$openid));?>", // 分享链接
				imgUrl: '<?php echo ($host); echo ($coupon["imgurl"]); ?>', // 分享图标
				type: 'link', // 分享类型,music、video或link，不填默认为link
				dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
				success: function () {
					alert('分享成功');
				},
				cancel: function () {
				// 用户取消分享后执行的回调函数
				// alert('取消分享');
				}
			});
			//分享到朋友圈
			wx.onMenuShareTimeline({
				title: '<?php echo ($coupon["coupon_name"]); ?>', // 分享标题 此处$title可在控制器端传递也可在页面传递 页面传递讲解在下面哦
				desc: '分享优惠券', //分享描述
				link: "<?php echo ($host); echo U('home/index/share_login',array('share_openid'=>$openid));?>", // 分享链接
				imgUrl: '<?php echo ($host); echo ($coupon["imgurl"]); ?>', // 分享图标
				success: function () {
				// 用户确认分享后执行的回调函数
				},
				cancel: function () {
				// 用户取消分享后执行的回调函数
				}
		});
	 });
	var mySwiper = new Swiper('.swiper-container', {
			direction: 'horizontal',
			autoplay: 2000, //可选选项，自动滑动
			loop: true,
			paginationClickable:true,
			autoplayDisableOnInteraction:false,
	});
	</script>
</html>
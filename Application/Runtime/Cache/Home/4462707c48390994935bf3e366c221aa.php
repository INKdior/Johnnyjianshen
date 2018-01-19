<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" type="text/css" href="/Public/home/css/bootstrap.css">
		<link rel="stylesheet" href="/Public/home/css/swiper.min.css" />
		<link rel="stylesheet" href="/Public/home/css/index.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/home/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<title>健身页面</title>
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
 
<script>

 
</script>
	<body>
		<div class="container-fluid header">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
							<img src="<?php echo ($vo['imgurl']); ?>">
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
			<div class="opcity" >
				<img src="/Public/home/img/组-2_01.png">
			</div>
			<div class="input-search">
				<form method="get">
					<input type="text" class="search" placeholder="达康(DK)共享健身器材" />
					<span class="search-icon">
						<img src="/Public/home/img/search.png">
					</span>
				</form>
			</div>	
		</div> 
		<div class="container footer">
			<div class="canrousel" style="position: relative;" id="crl">
			<button style="position:absolute;z-index:999999;right:.5rem;padding:0 .1rem;" id="btn1">下单</button>
				<div class="swiper-container1">
					<div class="swiper-wrapper" id="price">
						<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><div class="swiper-slide" onclick="window.location.href='<?php echo U('home/index/product_det',array('g_id' => $g['id']));?>'">
								<div class="swiper-slide comdity">
									<img src="<?php echo ($g['picture_url']); ?>" id="gid" value="<?php echo ($g['id']); ?>">	
								</div>
								<div style="text-align:center;font-size:.24rem;font-weight:bold"><?php echo ($g['name']); ?></div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="share">
						<img src="/Public/home/img/share.png">
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		<div class='row price price-first' id="div1">
		</div>
			<div class="second"></div>
			<div class="third"></div>
		</div>
		<form action="<?php echo U('index/submit_order');?>" method="post" >
			<input type="hidden" name="price" value="">
			<input type="hidden" name="g_id" value="">
		</form>
		<!-- <div class="container ralation">
			<div class="row ralation-box">
				<div class="col-md-4 col-sm-4 col-xs-4">
					<p class="img-icon">
						<img src="/Public/home/img/b1.png">
					</p>
					<p class="text-center" id="main">首页</p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 my">
					<p class="img-icon">
						<img src="/Public/home/img/b2.png">
					</p>
					<p class="text-center">我的</p>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4 about-my">
					<p class="img-icon">
						<img src="/Public/home/img/b3.png">
					</p>
					<p class="text-center">关于我们</p>
				</div>
			</div>
		</div> -->
		<div id="mask" style="display:none;background-color: #000;z-index: 1040;left: 0;opacity: 0.5; position: fixed;top: 0;right: 0; bottom: 0;"></div>
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
		$('.share').on('click',function() {
			$("#mask").show();
			$('.header').prepend('<img id="arrow" style="width:110px;height:90px;margin-left:75%;position: fixed;float:right;z-index: 1050;" src="/Public/home/img/share-arrow.png" />');
			$('.header').append('<img id="text" style="width:250px;height:250px;margin-left:15%;position: fixed;z-index: 1050;" src="/Public/home/img/share-text.png" />');
		})
		$('#mask').on('click',function() {
			$('#arrow').remove();
			$('#text').remove();
			$('#mask').hide();
		})
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
					alert('分享成功');
				// 用户确认分享后执行的回调函数
				},
				cancel: function () {
				// 用户取消分享后执行的回调函数
				}
			});
	 	});

		var mySwiper1 = new Swiper('.swiper-container', {
				autoplay: 2000, //可选选项，自动滑动
				loop: true,
				pagination : '.swiper-pagination',
				paginationClickable:true,
				autoplayDisableOnInteraction:false,
		});
		var para = $(".comdity").children().eq(0).attr("value");
	    //alert(para); //para 要与服务交互的数据
	    $.ajax({
	        url: "/index.php/Home/Index/ajax_price",
	        data: {product:para},
	        success: function(result) {
	        	$("#div1").html(result);
	        }
	    });
		var mySwiper = new Swiper(".swiper-container1" );
		mySwiper.on('onSlideChangeEnd', function(swiper) {
			var para = $(".comdity").children().eq(swiper.activeIndex).attr("value");
		    //alert(para); //para 要与服务交互的数据
		    $.ajax({
		        url: "/index.php/Home/Index/ajax_price",
		        data: {product:para},
		        success: function(result) {
		        	$("#div1").html(result);
		        }
		    });

		});		

		// var mySwiper = new Swiper('.swiper-container',{
		// 	preventLinksPropagation : false,
		// 	});
		$(document).ready(function(){
			$('.my').click(function(){
				window.location.href="<?php echo U('home/index/personal_center');?>";
			});
			$('.main').click(function(){
				window.location.href='/index.php/home/index/main.html';
			});
			$('.about-my').click(function(){
				window.location.href="<?php echo U('home/index/About_Us');?>";
			});
			$('#btn1').click(function() {
				var name = $('[name="p"]:radio:checked').val();
				var g_id = $('.comdity').eq(mySwiper.activeIndex).find('#gid').attr('value');
				$('[name="price"]').val(name);
				$('[name="g_id"]').val(g_id);
				$('form').submit();
			})
		})	
		$('.search-icon').on('click',function() {
			// mySwiper.slideTo(1);
			var content = $('.search').val();
			$.ajax({
				url: "<?php echo U('home/index/search_product');?>",
				type: 'post',
				datatype: 'json',
				data: {content},
				success: function(data) {
					if(data.length != '1') {
						var id = JSON.parse(data).id;
						var index = 0;
						$('.comdity').each(function() {
							if($(this).find('img').attr('name') == id) {
								mySwiper.slideTo(index);
							}
							index++;
						})
					}
				}
			})
		})
	</script>
</html>
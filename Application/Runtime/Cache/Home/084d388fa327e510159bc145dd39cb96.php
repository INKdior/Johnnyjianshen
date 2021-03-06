<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/cancellation-of-order.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
		<title>订单管理</title>
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
			<span class="text-phone">订单管理</span>
		</div>
		<div class="indent">
			<div class="big-img pr">
				<div class="indent-header clearfix">
					<span class="pa indent-img">
						<img src="/Public/home/img/健身-(1).png">
					</span>
					<p class="indent-meta"><span class="p-big"><?php echo ($show['title']); ?></span><br>
					<span class="p-smale">订单时间: <?php echo ($order['or_time']); ?></span></p>
				</div>
				<div class="indent-center pr">
					<p class="waiting"><span class="waiting-img pa"><img src="/Public/home/img/wait_03.png"></span><span>订单号: <?php echo ($order['order_id']); ?></span></p>
				</div>
				<div class="indent-footer">
					<center class="center">
					</center>
				</div>
			</div>
		</div>
		<div class="take">
			<div class="take-top">
				<p><span><img src="/Public/home/img/icon-1.png"></span><span class="accept">收货人信息</span></p>
			</div>
			<div class="take-bottom">
				<div class="take-bottom-main">
					<p class="take-main-top"><span class="main-left fl">收货人: <?php echo ($order['receiver']); ?></span><span class="main-right fr"><?php echo ($order['tel']); ?></span></p>
					<p>收货地址 : <?php echo ($order['addr']); ?></p>
				</div>
			</div>
		</div>
		<div class="main-center"></div>
		<div class="take top-1">
			<div class="take-top take-top-1">
				<p><span><img src="/Public/home/img/icon-2.png"></span><span class="accept">套餐</span></p>
			</div>
			<div class="take-bottom-main-1">
				<div class="bottom-img fl">
					<div class="img-left fl">
						<img src="<?php echo ($order['picture_url']); ?>">
					</div>
					<div class="img-right fl">
						<p><?php echo ($order['name']); ?> &nbsp;</p>
						<p>配送费：<?php echo ($order['delivery']); ?>元</p>
						<p class="red-text" id="rest"></p>
					</div>	
				</div>
				<div class="bottom-img-right fr">
					<p class="tr price">¥ <?php echo ($order['price']); ?>元</p>
					<p class="tr small-number">X1</p>
				</div>
			</div>
		</div>
		<div id="mask" style="display:none;background-color: #000;z-index: 1040;left: 0;opacity: 0.5; position: fixed;top: 0;right: 0; bottom: 0;"></div>
		<div class="alert pr a">
			<img src="/Public/home/img/close.png" class="pa close">
			<div class="alert-top">
				<center><p class="big-text">分享你的优惠券</p></center>
		<!-- 		<p class="small-text">*同一个小区:转租成功后系统将自动返还您的配送费</p>
				<p class="small-text">不同一个小区:系统不会返还您的配送费</p> -->
			</div>
			<div class="alert-bottom">
				<center><div class="fk">分享</div></center>
				<!-- <div class="fr no">否</div> -->
			</div>
		</div>

		<div class="alert pr b">
			<img src="/Public/home/img/close.png" class="pa close">
			<div class="alert-top">
				<p class="big-text">是否在同一个小区</p>
				<p class="small-text">*同一个小区:转租成功后系统将自动返还您的配送费</p>
				<p class="small-text">不同一个小区:系统不会返还您的配送费</p>
			</div>
			<div class="alert-bottom">
				<div class="fl yes">是</div>
				<div class="fr no">否</div>
			</div>
		</div>
		<div class="alert-number" style="position: fixed;top: 4.5rem;left:7%;width: 86%;height: 3.2rem;background: #fff;border-radius:.2rem;display:none;border: 1px solid #ccc;z-index:99999 ">
			<p style="font-size: .30rem;text-align: center;margin-top: 1.2rem;"><?php echo ($order['delivery_name']); ?><span style="color: #f00;">  电话：<?php echo ($order['delivery_phone']); ?></span></p>
			<img class="close-number" src="/Public/img/timg1.png" style="position: absolute;left: 5.5rem;top: .3rem;width: 5%;">
		</div>

	</body>
	<script type="text/javascript">
	$(document).ready(function() {
		var state = '<?php echo ($show["state"]); ?>';
		var paied = '<?php echo ($order["paied"]); ?>';
		var pay_for = '<?=$order["pay_for"]?>';
		var appendButton = '';
		if(paied == '1') {
			if(state == '2' || state == '3') {
				if(state == '2') {
					appendButton = '<input type="button" class="relet button-one fl" value="续租" style="margin-left:.4rem">&nbsp;&nbsp;'
							     + '<input type="button" class="sublet button-one" value="一键转租">&nbsp;&nbsp;'
								 + '<input type="button" class="back button-one" value="我要还货">'
								 + '<input type="button" class="purchase button-one fr" value="购买" style="margin-right:.4rem">&nbsp;&nbsp;';
				} else if(state == '3') {
					appendButton = '<input type="button" class="button-one fr" value="已续租" style="margin-right:.4rem">';
				}
				var endDate = '<?php echo ($order["xd_time"]); ?>';
				endDate = new Date(endDate);
				var curDate = new Date;
				var rest = endDate.valueOf() - curDate.valueOf();
				rest = Math.ceil(rest/24/60/60/1000);
				if(String(rest) != 'NaN') {
					$('#rest').text('剩余天数: '+ rest +'天');
				} else {
					$('#rest').text('剩余天数: 未设定');
				}
			} else {
				if(state == '0') {
					appendButton = '<input type="button" class="cancel button-one" value="取消订单">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				} else if(state == '1' || state == '61') {
					appendButton = '<input type="button" class="prompt button-one" value="催单">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				} else if(state == '4') {
					appendButton = '<input type="button" class="button-one" value="取消订单中">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				} else if(state == '5') {
					appendButton = '<input type="button" class="button-one" value="订单已取消">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				} else if(state == '6') {
					appendButton = '<input type="button" class="prompt button-one" value="还货催单">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				} else if(state == '8') {
					appendButton = '<input type="button" class="button-one" value="转租中">'
								 + '<input type="button" class="fr back button-one" value="我要还货">';
					$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
				}
			}
			var pay_for = '<?=$order["pay_for"]?>';
			if(pay_for == '1') {
				appendButton = '<input type="button" class="button-one" value="选择购买">';
				$('#rest').text('选择购买');
			}
			$('.close-number').click(function() {
				$(this).parent().hide();
			})
			$('.center').append(appendButton);
		} else {
			$('.p-big').text('未付款');
			if(state == '2' || state == '3') {
				var endDate = '<?php echo ($order["xd_time"]); ?>';
				endDate = new Date(endDate);
				var curDate = new Date;
				var rest = endDate.valueOf() - curDate.valueOf();
				rest = Math.ceil(rest/24/60/60/1000);
				if(String(rest) != 'NaN') {
					$('#rest').text('剩余天数: '+ rest +'天');
				} else {
					$('#rest').text('剩余天数: 未设定');
				}
			} else {
					if(state == '0') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					} else if(state == '1') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					} else if(state == '4') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					} else if(state == '5') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					} else if(state == '6') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					} else if(state == '8') {
						$('#rest').text('剩余天数: <?php echo ($g_price["time"]); ?>天');
					}
			}
			if(pay_for == '1') {
				appendButton = '<input type="button" class="button-one" value="选择购买">';
				$('#rest').text('选择购买');
			}
			$('.close-number').click(function() {
				$(this).parent().hide();
			})
			appendButton = '<input type="button" class="cancel button-one" value="取消订单">&nbsp;&nbsp;<input type="button" class="repay button-one" value="继续支付">';
			$('.center').append(appendButton);
		}
		if(state != '2' ) {
			if(state == '7' || state == '9' || state == '5' || state == '10')   $('.a').show();
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
		 } else {
			wx.config({
				debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
				appId: '<?php echo ($wx["appId"]); ?>', // 必填，公众号的唯一标识
				timestamp:'<?php echo ($wx["timestamp"]); ?>', // 必填，生成签名的时间戳
				nonceStr: '<?php echo ($wx["nonceStr"]); ?>', // 必填，生成签名的随机串
				signature: '<?php echo ($wx["signature"]); ?>',// 必填，签名，见附录1
				jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
		 	});
		 	wx.ready(function() {
			  //分享给朋友
				wx.onMenuShareAppMessage({
					title: "<?php echo ($order['name']); ?>", // 分享标题 此处$title可在控制器端传递也可在页面传递 页面传递讲解在下面哦
					desc: '产品详情页', //分享描述
					link: "<?php echo ($host); echo U('home/index/product_det?user='.$order['user'].'&g_id='.$goods_id.'&order_id='.$order['order_id']);?>", // 分享链接
					imgUrl: '<?php echo ($host); echo ($order["picture_url"]); ?>', // 分享图标
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
					title: "<?php echo ($order['name']); ?>", // 分享标题 此处$title可在控制器端传递也可在页面传递 页面传递讲解在下面哦
					desc: '产品详情页', //分享描述
					link: "<?php echo ($host); echo U('home/index/product_det?user='.$order['user'].'&g_id='.$goods_id.'&order_id='.$order['order_id']);?>", // 分享链接
					imgUrl: '<?php echo ($host); echo ($order["picture_url"]); ?>', // 分享图标
					success: function () {
					// 用户确认分享后执行的回调函数
					},
					cancel: function () {
					// 用户取消分享后执行的回调函数
					}
				});
		 	});
		 }
	 	$('.repay').click(function () {
	 		window.location.href = "<?php echo U('home/index/repay_order?order_id='.$order['order_id'].'');?>";
	 	})
		$('.relet').click(function() {
			window.location.href = "<?php echo U('home/index/product_det?g_id='.$goods_id.'&relet='.$order['order_id'].'');?>";
		})
		$('.cancel').click(function() {
			var con = confirm('是否取消订单');
			if(con) {
				window.location.href = "<?php echo U('home/index/change_state',array('order_id' => $order['order_id'], 'state' => '4', 'paied' => $order['paied']));?>";
			}
		})
		$('.purchase').click(function() {
			window.location.href = "<?php echo U('home/index/product_det?g_id='.$goods_id.'&purchase=purchase');?>";
		})
		$('.back').click(function() {
			window.location.href = "<?php echo U('home/index/change_state',array('order_id' => $order['order_id'], 'state' => '6'));?>";
		})
		$('.prompt').click(function() {
			$.ajax({
				url: "<?php echo U('home/index/prompt');?>",
				dataType: 'json',
				type: 'get',
				data: {order_id: "<?php echo ($order['order_id']); ?>"},
				complete: function() {
					$('.alert-number').show();
				}
			})
		})
	 	$('.yes, .no, .fk').click(function() {
			$("#mask").show();
			$('.header').prepend('<img id="arrow" style="width:110px;height:90px;margin-left:75%;position: fixed;float:right;z-index: 1050;" src="/Public/home/img/share-arrow.png" />');
			$('.header').append('<img id="text" style="width:250px;height:250px;margin-left:15%;position: fixed;z-index: 1050;" src="/Public/home/img/share-text.png" />');
		})
		$('#mask').on('click',function() {
			$('#arrow').remove();
			$('#text').remove();
			$('#mask').hide();
		})
		$('.close').click(function(){
			$(this).parent().hide();
		});
		$('.sublet').click(function(){
			$('.b').show();
		})
	})
	</script>
</html>
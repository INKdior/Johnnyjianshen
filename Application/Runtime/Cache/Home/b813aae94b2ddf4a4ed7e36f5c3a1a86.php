<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/red-packet.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
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
		<div class="container">
			<div class="img-show">
				<img src="<?php echo ($coupon_data['imgurl']); ?>">
			</div>
			<div class="main">
				<div class="main-top pr">
					<div class="main-top-text fl">
						<p id="type"></p>
						<p><?php echo ($coupon_data['coupon_info']); ?></p>
						<p>有效期至<?php echo ($coupon_data['deadline']); ?></p>
					</div>
					<img class="pa" src="/Public/home/img/border-01.png">
					<div class="price fr tc"><span class="money">¥</span><?php echo ($randValue); ?></div>
				</div>
				<div class="main-center tc">红包已放入账户 </div>
				<div class="main-bottom tc use">立即使用</div>
			</div>
			<div class="footer pr">
				<img class="pa first" src="/Public/home/img/border-02.png">
				<img class="pa second" src="/Public/home/img/border-02.png">
				<div class="footer-top tc">看看大家的手气</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		var listData = '<?php echo json_encode($list_data)?>';
		var data = '<?php echo json_encode($coupon_data)?>';
		data = JSON.parse(data);
		listData = JSON.parse(listData);
		var flag = '<?php echo $flag;?>';
		if(data.type != '2') {
			$('#type').text('金额抵扣');
		} else {
			$('#type').text('满'+data.reach+'减'+data.value);
		}
		if(flag == 1) alert('您已经领过该红包');
		// if(flag == 2) alert('您不能领取自己的红包');
		var append = '';
		for(var i in listData) {
			append += "<div class='footer-text'>"
					+ "<div class='pr fl'>"
				    + "<img src='"+listData[i].picture_url+"' class='pa'>"
				    + "<p class='big-text'>"+listData[i].wxname+"</p>"
					+ "<p class='small-text'>"+listData[i].date+"</p>"
					+ "</div>"
					+ "<div class='fr'>"+listData[i].value+"</div>"	
					+ "</div>"
					+ "<div class='line'></div>"
		}
		$('.footer').append(append);
		$('.use').click(function() {
			window.location.href="<?php echo U('home/index/main');?>"
		})
	</script>
</html>
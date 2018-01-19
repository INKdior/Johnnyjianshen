<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/bootstrap.css">
		<link rel="stylesheet" href="/Public/home/css/withdraw.css" />
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
				<a href="<?php echo U('home/index/balance');?>" class="return-img">
					<img src="/Public/home/img/返回.png" />
				</a>
				<p class="person-center text-center">提现</p>
			</div>		
		</div>
		<div class="account">
			<div class="account-img">
				<img src="/Public/home/img/WeChat.png">
			</div>
			<div class="account-text">
				<p>微信</p>
				<p>账号 : <span><?php echo ($data['wxname']); ?></span></p>
			</div>
		</div>
		<div class="money">
			<p>提现金额</p>
			<p><span class="price">¥</span><input type="text" placeholder="请输入提现金额"></p>
			<p class="usable">可用余额：<span><?php echo ($data['money']); ?></span></p>
		</div>
		<div class="button">确认提现</div>
	</body>
	<script type="text/javascript">
		$('.button').on('click',function() {
			var money = $('input').val();
			var rest_money = '<?php echo ($data["money"]); ?>';
			if(String(parseFloat(money)) == 'NaN') {
				alert('请输入正确金额');
				return;
			}
			if(parseFloat(money) > parseFloat(rest_money)) {
				alert('提取金额不能大于余额');
				return;
			}
			$.ajax({
				url: '<?php echo U("home/index/withdraw_deposit");?>',
				dataType: 'json',
				type: 'post',
				data: {'money': money},
				success: function(data) {
					if(data == 'success') {
						alert('提现成功');
					}
					window.location.href = "<?php echo U('home/index/personal_center');?>";
				},
				fail: function() {
					alert('提现失败');
				}
			})
		})
	</script>
</html>
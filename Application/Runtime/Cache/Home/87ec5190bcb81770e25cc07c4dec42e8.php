<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/The-user-id.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>绑定手机</title>
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
			<span class="text-phone">用户实名认证</span>
		</div>
		<form method="post" action="/index.php/Home/Index/autonym">
			<div class="phone">				
				<label for="phone">真实姓名</label>
				<input type="text" name="autonym" id="phone" class="username" placeholder="请输入你的真实姓名"/ value="<?php echo ($re['autonym']); ?>">
			</div>
			<div class="long-line pr"></div>
			<div class="verify">	
				<label for="person">身份证号码</label>
				<input type="text" id="person" name="id_number"  placeholder="请输入你的身份证" value="<?php echo ($re['id_number']); ?>" />				
			</div>		
			<div class="long-line pr"></div>
			<div class="text">
				<p><input id="box" type="checkbox" style="vertical-align:-.02rem;margin-right:.15rem">点击保存，表示您已经同意<span>《达康DK共享健身器材实名认证服务授权协议》</span></p>
			</div>
			<button type="submit" class="submit button-bottom">同意授权并保存</button>
		</form>
	</body>
	<script type="text/javascript">
		$('#box').click(function() {
			if($('#box').is(':checked')) {
				$('.submit')[0].removeAttribute('disabled');
			} else {
				$('.submit').attr('disabled','disabled');
			}
		});
	</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" href="/Public/home/css/cashpledge.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>我的押金</title>
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
			<a href="<?php echo U('home/index/personal_center');?>" class="icon pa">
				<img src="/Public/home/img/back1.png">
			</a>		
			<span class="text-phone">我的押金</span>
		</div>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="main">
				<div class="fl textleft">
					<p>器材名称: <span><?php echo ($vo[0]['name']); ?></span></p>
					<p>器材数量: <span><?=count($vo)?>件</span></p>
					<p>押金金额: <span><?php echo ($vo[0]['deposit']); ?>元</span></p>
				</div>
				<div class="fr imgright">交押金</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
<!-- 		<div class="main">
			<div class="fl textleft">
				<p>器材名称: <span>跑步机</span></p>
				<p>器材数量: <span>1件</span></p>
				<p>押金金额: <span>2999元</span></p>
			</div>
			<div class="fr imgright">交押金</div>
		</div>
		<div class="main">
			<div class="fl textleft">
				<p>器材名称: <span>跑步机</span></p>
				<p>器材数量: <span>1件</span></p>
				<p>押金金额: <span>2999元</span></p>
			</div>
			<div class="fr imgright">交押金</div>
		</div>
		<div class="main">
			<div class="fl textleft">
				<p>器材名称: <span>跑步机</span></p>
				<p>器材数量: <span>1件</span></p>
				<p>押金金额: <span>2999元</span></p>
			</div>
			<div class="fr imgright">交押金</div>
		</div> -->
	</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/add.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/home/js/layer/layer.js"></script>
		<title>添加地址</title>
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
		<form action="/index.php/Home/Index/add_addr" method="post" id="search_form">
			<div class="container">
				<div class="header pr">
					<p class="header-left fl tl">
						<a href="javascript:document.getElementById('search_form').submit();">
							<img src="/Public/home/img/back1.png">
						</a>	
					</p>
					<p class="header-center fl tc">添加地址</p>
					<p class="header-right fr tr" onclick="document.getElementById('search_form').submit();">完成</p>
				</div>
				<?php
 if(empty($data)) { ?>
					<p class="text1">联系人</p>
					<p class="input-group"><label for="username">姓名:</label><input id="username" name="name" type="text" placeholder="请输入姓名"/></p>
					<p class="text">联系方式</p>
					<p class="input-group"><label for="phone">电话:</label><input id="phone" name="tel" type="text" placeholder="请输入电话"/></p>
					<p class="text">收货地址</p>
					<p class="input-group"><label for="address">地址:</label><input id="address" name="addr" type="text" placeholder="请输入地址"/></p>
				<?php } else{ ?>
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="hidden" value="<?php echo ($vo['id']); ?>" name="id">
							<p class="text1">联系人</p>
							<p class="input-group"><label for="username">姓名:</label><input id="username" name="name" value="<?php echo ($vo['name']); ?>" type="text"/></p>
							<p class="text">联系方式</p>
							<p class="input-group"><label for="phone">电话:</label><input id="phone" name="tel" value="<?php echo ($vo['tel']); ?>" type="text"/></p>
							<p class="text">收货地址</p>
							<p class="input-group"><label for="address">地址:</label><input id="address" name="addr" value="<?php echo ($vo['addr']); ?>" type="text"/></p><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php } ?>
			</div>
		</form>
	</body>
</html>
<script type="text/javascript">
	var inpEle = document.getElementById('phone');
	var uname = document.getElementById('username');
	var address = document.getElementById('address');
	var reg = /\S/;
	var myreg = /^1[3458]\d{9}$/;
	uname.onblur = function() {
		var myname = this.value;
		if(!reg.exec(myname)) {
			layer.msg('姓名不能为空！',{
				icon: 5,
				time: 2000
			})
		}
	}
	address.onblur = function() {
		var myaddr = this.value;
		if(!reg.exec(myaddr)) {
			layer.msg('地址不能为空！',{
				icon: 5,
				time: 2000
			})
		}
	}
	inpEle.onblur = function(){
	    var inpVal = this.value;
	    if (!myreg.exec(inpVal)){
	        layer.msg('请输入正确的手机号!', {
	            icon: 5,
	            time: 2000 //2秒关闭（如果不配置，默认是3秒）
	        }, function(){
	            //do something
	            if($('#phone').val()==""){
	                layer.msg('手机号码不能为空!', {
	                    icon: 5,
	                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
	                }, function(){
	                    //do something
	                    $('#phone').html('');
	                });
	            }
	            $('#phone').html('');
	        });
	    }
	}
</script>
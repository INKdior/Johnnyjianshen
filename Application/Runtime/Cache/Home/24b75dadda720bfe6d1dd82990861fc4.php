<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/personal-data.css" />
		<link rel="stylesheet" href="/Public/home/css/custom.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/js/jquery.js"></script>
		<script src="/Public/home/js/ajaxfileupload.js"></script>
		<title>我的钱包</title>
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
		<form action="/index.php/Home/Index/xg_consumer" enctype="multipart/form-data" method="post" > 
			<div class="header pr">
				<a href="javascript:history.back(-1)" class="icon pa">
					<img src="/Public/home/img/back1.png">
				</a>
				<span>余额</span>
	            <!-- <input style="background-color:#000;border:0"  class="pa over"  type="submit" value="完成" />  -->
		  		<!-- <div class="header pr">
				<a href="javascript:history.back(-1)" class="icon pa">
					<img src="/Public/home/img/back1.png">
				</a>
				</div> -->
			</div>
			<div class="main">
				<div class="main-one">
					<p class="fl"></p>
					<!-- <p class="fr">优惠价格</p> -->
				</div>
			</div>
		</form>
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
			var data = '<?=json_encode($data)?>';
			if(data != 'null') {
				data = JSON.parse(data);
				var rest = data[0].money;
				$('.fl').text('当前余额为：'+rest);
				var html = '';
				for(var i in data) {
					refund_type = data[i].refund_type;
					if(refund_type == '0') {
						refund_type = '全额退款';
					} else if(refund_type == '1') {
						refund_type = '退还全额押金';
					} else if(refund_type == '2') {
						refund_type = '退还押金扣除配送费';
					}
					html += "<div class='main-two'>"
						 +  "<p class='fl'>订单：</p>"
						 +  "<p class='fr'>订单号："+data[i].order_id+"&nbsp;支付："+data[i].price+"&nbsp;下单时间："+data[i].or_time+"</p>"
						 +  "</div>"
						 +  "<div class='main-two'>"
						 +  "<p class='fl'>退款单：</p>"
						 +  "<p class='fr'>退款单号："+data[i].out_refund_no+"&nbsp;退款金额："+data[i].refund_money+"&nbsp;退款类型："+refund_type+"</p>"
						 +  "</div>";
				}
				$('.main').append(html);
			}
			console.log(data);
		})
	</script>
</html>
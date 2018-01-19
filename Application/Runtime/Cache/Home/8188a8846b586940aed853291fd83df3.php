<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/all-orders.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>全部订单</title>
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
			<a href="<?php echo U('index/personal_center');?>" class="icon pa">
			
				<img src="/Public/home/img/back1.png">
			</a>		
			<span class="text-phone">订单管理</span>
		</div>
		<div class="nav pr clearfix">
			<ul>
				<li class="fl list-first">配送</li>
				<li class="fl list-one list-second" id='no_ps'>使用中</li>
				<li class="fl list-one list-third">还货中</li>
				<li class="fl list-one list-fours">全部订单</li>				
			</ul>
			<div class="line pa"></div>
		</div>
		<div  id="div1" class="div1">
		<?php var_dump($data);?>
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="trik"></div>
				<div class="indent cancel order_id" id="" onclick="window.location.href='<?php echo U('home/index/cancellation_of_order');?>?o_id=<?php echo ($vo['id']); ?>'">
					<div class="indent-top">
						<p class="fl">订单ID: <?php echo ($vo['order_id']); ?></p>
						<p class="fr">
							<img src="/Public/home/img/<?php echo ($vo['img']); ?>">
						</p>
					</div>
					<div class="long-line"></div>
					<div class="indent-bottom">
						<p class="tl fl"><?php echo ($vo['name']); ?></p>
						<p class="gray"><?php echo ($vo['day']); ?></p>
						<p class="text gray"><span class="fl"><?php echo ($vo['or_time']); ?></span><span class="fr">1份</span></p>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		 </div>
		
	</body>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.list-first').click(function(){
				$('.line').css({'left':'4%'});
				var para='a';
				$.ajax({
			        url: "/index.php/Home/Index/ajax_orders",
			        data: {product:para},
			        success: function(result) {
			        	$("#div1").html(result);
			        }
			    });
			});
			$('.list-second').click(function(){
				$('.line').css({'left':'31%'});
				//$('.indent-top img').attr({'src':'/Public/home/img/sqqx.png'});
				var para=0;
				$.ajax({
			        url: "/index.php/Home/Index/ajax_orders",
			        data: {product:para},
			        success: function(result) {
			        	$("#div1").html(result);
			        }
			    });
			});
			$('.list-third').click(function(){
				$('.line').css({'left':'57%'});
				var para=1;
				$.ajax({
			        url: "/index.php/Home/Index/ajax_orders",
			        data: {product:para},
			        success: function(result) {
			        	$("#div1").html(result);
			        }
			    });
				
			});
			$('.list-fours').click(function(){
				$('.line').css({'left':'83%'});
				var para=2;
				$.ajax({
			        url: "/index.php/Home/Index/ajax_orders",
			        data: {product:para},
			        success: function(result) {
			        	$("#div1").html(result);
			        }
			    });
			});

			$('.order_id').click(function(){
				//var order_id=$(".order_id").attr("id");
				//alert(order_id);  
				//window.location.href='/index.php/Home/Index/cancellation_of_order.html';
			});
			$('.fast').click(function(){
				window.location.href='reminder.html';
			});
			$('.over').click(function(){
				window.location.href='Order-Management.html';
			})
		})
	</script>
</html>
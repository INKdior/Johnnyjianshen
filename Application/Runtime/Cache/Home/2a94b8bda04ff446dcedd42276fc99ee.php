<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/Public/home/css/bootstrap.css">
		<link rel="stylesheet" href="/Public/home/css/swiper.min.css" />
		<link rel="stylesheet" href="/Public/home/css/index.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/home/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/Public/home/js/swiper.min.js"></script>
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
	<body>
		<div class="container-fluid header">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
							<img src="/Uploads/<?php echo ($vo['imgurl']); ?>">
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
			<div class="canrousel">
				<div class="swiper-container1">
					<div class="swiper-wrapper" id="price">
						<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$g): $mod = ($i % 2 );++$i;?><div class="swiper-slide"  onclick="window.location.href='<?php echo U('home/index/product_details');?>?gid=<?php echo ($g['id']); ?>'">
								 
								<div class="swiper-slide comdity">
								
										<img src="/Uploads/<?php echo ($g['picture_url']); ?>" name="<?php echo ($g['id']); ?>">					
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<a href="/Public/home/javascript:" class="share">
						<img src="/Public/home/img/share.png">
					</a>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		<div class='row price price-first' id="div1">
		</div>
			<div class="second"></div>
			<div class="third"></div>
		</div>
		<div class="container ralation">
			<div class="row ralation-box">
				<div class="col-md-4 col-sm-4 col-xs-4">
					<p class="img-icon">
						<img src="/Public/home/img/b1.png">
					</p>
					<p class="text-center">首页</p>
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
		</div>
	</body> 
	<script>
	
		var mySwiper1 = new Swiper('.swiper-container', {
				autoplay: 2000, //可选选项，自动滑动
				loop: true,
				pagination : '.swiper-pagination',
				paginationClickable:true,
				autoplayDisableOnInteraction:false,
		});

		var mySwiper = new Swiper('.swiper-container1', );
		    // Add one more handler for this event

		mySwiper.on('onSlideChangeEnd', function(swiper) {
			var para = $(".comdity").children().eq(swiper.activeIndex).attr("name");
		    //alert(para); //para 要与服务交互的数据
		    $.ajax({
		        url: "/index.php/Home/Index/ajax_price",
		        data: {product:para},
		        success: function(result) {
		        $("#div1").html(result);
		        }
		    });

		});		

		var mySwiper = new Swiper('.swiper-container',{
			preventLinksPropagation : false,
			})
	</script>

	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.my').click(function(){
				window.location.href="<?php echo U('home/index/personal_center');?>";
			});

			
		/*	$('.about-my').click(function(){
				window.location.href='/index.php/home/index/About_Us.html';
			})*/
			$('.about-my').click(function(){
				window.location.href="<?php echo U('home/index/About_Us');?>";
			})
		})	
	</script>
</html>
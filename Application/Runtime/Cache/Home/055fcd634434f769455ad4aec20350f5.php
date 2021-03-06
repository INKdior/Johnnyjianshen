<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/address-administration.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<title>地址管理</title>	
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
			<!-- <span class="text-phone">地址管理</span> -->
		</div>
		<div class="add-site">
			<p class="fl add_address"><span>
				<img src="/Public/home/img/add.png"></span>
				<span class="add-1">添加新地址</span>
			</p>
			<p class="fr"><img src="/Public/home/img/select.png"></p>
		</div>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="line-1" id="456"></div>
		<div class="share pr">
			<div class="fl share-left">
				<div class="share-one">
					<p class="tl fl"><?php echo ($vo['name']); ?></p>
					<p class="tr fr"><?php echo ($vo['tel']); ?></p>
				</div>
				<div class="share-two pr">
					<?php echo ($vo['states']); ?>
					<p class="tl fr"><?php echo ($vo['addr']); ?></p>
				</div>
			</div>
			<p class="fr share-right pa" id="<?php echo ($vo['id']); ?>"><img src="/Public/home/img/close.png"></p>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>

	</body>
	<script>
		$(document).ready(function(){
			var choose_addr = '<?=$choose_addr?>';
			console.log(choose_addr);
			$('.share-right').click(function(){
				var myData = this.id;
				var _this=$(this);
				//alert(clickedID);
       			jQuery.ajax({ 
		            type: "POST", // HTTP method POST or GET  
		            url: "/index.php/Home/Index/del_addr", //Where to make Ajax calls  
		            dataType:"text", // Data type, HTML, json etc.  
		            data:{id:myData}, //Form variables  
		            success:function(result){  
		            	//alert("删除成功!"); 
		            	_this.parent().hide();
		            },  
		            error:function (xhr, ajaxOptions, thrownError){  
		                //On error, we alert user  
		                alert("删除失败");  
		            }  
	            }); 
       		});
			$('.share-left').on('click', function() {
				var addrId = $(this).next().attr('id');
				var obj = $(this);
				if(choose_addr == 'true') {
					window.location.href = "<?=WEB_HOST?>/index.php/home/index/submit_order?addr_id="+addrId;
				} else {
					var con = confirm('是否将该地址设为默认');
					jQuery.ajax({
						type: 'post',
						dataType: 'json',
						url: "<?php echo U('index/update_default');?>",
						data: {id: addrId,confirm: con},
						complete: function(e,data) {
							window.location.href="<?php echo U('home/index/add');?>";
						}
					})
				}
			})
			$('.add_address').click(function(){
				window.location.href="<?php echo U('home/index/add');?>";
			});
		});
	</script>
</html>
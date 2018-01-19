<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/Public/home/css/bind-phone.css" />
		<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
		<script src="/Public/home/js/layer/layer.js"></script>
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
			<span class="text-phone">绑定手机</span>
		</div>
		<form method="post" action="<?php echo U('home/index/bind');?>">
			<div class="phone">			
				<label for="phone">手机号码</label>
				<input type="text" name="phone" id="phone" placeholder="请输入你的手机号码"/>
			</div>
			<div class="long-line pr"></div>
			<div class="verify">
				<label for="verify">验证码</label>
				<input type="text" id="verify" placeholder="请输入验证码"/>
				<input type="button" class="submit fr" value="获取验证码" id='btn'>			
			</div>
			<div class="long-line pr"></div>
			<button type="button" class="submit button-bottom" id="sub" >提交</button>
		</form>
		<script type="text/javascript">
			var data = '<?=json_encode($data)?>';
			data = JSON.parse(data);
			var myreg = /^1[3458]\d{9}$/;
			var wait = 60;
			var verify = '';
			if(data.tel != '') {
				// alert('已绑定手机号'+data);
			}
			$('#sub').on('click', function() {
				if($('#verify').val() == verify && verify != '') {
					alert('手机绑定成功');
					$('form').submit();
				} else {
					alert('验证码输入错误');
				}
			})
			function time(o) {
				if (wait == 0) {
					o.removeAttribute("disabled");   
					o.value="获取验证码";
					wait = 60;
				} else { 
					o.setAttribute("disabled", true);
					o.value="重新发送(" + wait + ")";
					wait--;
					setTimeout(function() {
						time(o);
					},1000)
				}
			}
			$('.fr').click(function() {
				var phone = $('#phone').val();
	            if(phone == "") {
	                layer.msg('手机号码不能为空!', {
	                    icon: 5,
	                    time: 2000 //2秒关闭（如果不配置，默认是3秒）
	                }, function(){
	                    //do something
	                });
	            }else if (!myreg.exec(phone)) {
			            //do something
	                layer.msg('请输入正确的手机号!', {
			            icon: 5,
			            time: 2000 //2秒关闭（如果不配置，默认是3秒）
			        },function() {
	    				$('#phone').val('');
			        })
			    } else {
					$.ajax({
						url: '<?php echo U("home/index/get_code");?>',
						type: 'post',
						dataType: 'json',
						data: {phone:phone},
						success: function(data) {
							verify = data;
						},
						error: function(data) {
							if(data == '') {
								alert('验证码获取失败，请稍后再试');
							}
						}
					});
					time(document.getElementById("btn"));
			    }
			})
		</script>
	</body>
</html>
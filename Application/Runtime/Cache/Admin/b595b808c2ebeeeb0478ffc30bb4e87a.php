<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>达康健身器材管理后台</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /> 
<link href="/Public/admin/Wopop_files/style_log.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/Public/admin/Wopop_files/style.css">
<script src="/Public/home/js/jquery-1.12.2.min.js"></script>
<script src="/Public/js/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/admin/Wopop_files/userpanel.css">
<link rel="stylesheet" type="text/css" href="/Public/admin/Wopop_files/jquery.ui.all.css">
</head>

<body class="login" mycollectionplug="bind">
<div class="login_m">
<div class="login_boder">
<div class="login_padding" id="login_model">

<form action="<?php echo U('admin/index/login');?>" method="post">
  <h2>用户名：</h2>
  <label>
    <input type="text" id="username" name="name" class="txt_input txt_input2">
  </label>

  <h2>密码：</h2>
  <label>
    <input type="password" name="password" id="userpwd" class="txt_input">
  </label>

<!--   <h2>验证码：</h2>
  <label>
      <input type="text" name="code" placeholder="" class="txt_input" style="width:155px;height:35px;"/>
      <img id="code" src="/index.php/Admin/Index/verify" class="txt_input"  width="128" height="35"/>
  </label> -->

 
  <p class="forgot"><a id="iforget" href="javascript:void(0);">忘记密码?</a></p>
  <div class="rem_sub">
  <div class="rem_sub_l">
 
   <!-- <label for="checkbox">注册</label> -->

   </div>
    <label>
      <input type="submit" class="sub_button" name="button" id="button" value="登录" style="opacity: 0.7;">
    </label>
  </div>
</div>



<div id="forget_model" class="login_padding" style="display:none">
<br>

   <h1>Forgot password</h1>
   <br>
   <div class="forget_model_h2">(Please enter your registered email below and the system will automatically reset users’ password and send it to user’s registered email address.)</div>
    <label>
    <input type="text" id="usrmail" class="txt_input txt_input2">
   </label>

 
  <div class="rem_sub">
  <div class="rem_sub_l">
   </div>
    <label>
     <input type="submit" class="sub_buttons" name="button" id="Retrievenow" value="Retrieve now" style="opacity: 0.7;">
     　　　
     <input type="submit" class="sub_button" name="button" id="denglou" value="Return" style="opacity: 0.7;">　　
    
    </label>
  </div>
</div>
<!--login_padding  Sign up end-->
</div><!--login_boder end-->
</div><!--login_m end-->
 <br> <br>
</form>


</body>
<script type="text/javascript">
var captcha_img = $('#captcha-container').find('img'); 
var verifyimg = captcha_img.attr("src");  
captcha_img.attr('title', '点击刷新');  
captcha_img.click(function(){  
    if( verifyimg.indexOf('?')>0){  
        $(this).attr("src", verifyimg+'&random='+Math.random());  
    }else{  
        $(this).attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());  
    }  
});
</script>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>支付中</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
   <meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="telephone=no">

<script type="text/javascript">

//调用微信JS api 支付
function jsApiCall(){
    WeixinJSBridge.invoke(
    'getBrandWCPayRequest',
    <?php echo $jsApiParameters; ?>,
    function(res){
        if (res.err_msg == 'get_brand_wcpay_request:ok') {
            //支付成功后跳转的地址
            location.href = '<?php echo WEB_HOST;?>/index.php/home/wxjs/pay_success';
        }else if (res.err_msg == 'get_brand_wcpay_request:cancel') {
            alert('请尽快完成支付哦！');
            location.href = '<?php echo WEB_HOST;?>/index.php/home/wxjs/pay_fail';
            // location.href = '<?php echo WEB_HOST;?>/index.php/home/index/main';
        }else if (res.err_msg == 'get_brand_wcpay_request:fail') {
            location.href = '<?php echo WEB_HOST;?>/index.php/home/wxjs/pay_fail';
            // location.href = '<?php echo WEB_HOST;?>/index.php/home/index/main';
            alert('支付失败');
        }else {
            location.href = '<?php echo WEB_HOST;?>/index.php/home/wxjs/pay_fail';
            // location.href = '<?php echo WEB_HOST;?>/index.php/home/index/main';
            alert('意外错误');
        }
    }
   );
}
   
    if(typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
    } else if (document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
    }
    }else{
        jsApiCall();
}
</script>
</head>
<body>


  
</body>
</html>
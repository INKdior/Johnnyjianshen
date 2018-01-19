
<?php
return array(
    //'配置项'=>'配置值'
    'DB_TYPE' =>'mysql',
    'DB_HOST' =>'localhost',
    'DB_NAME' =>'dakang',
    'DB_USER' =>'root',
    'DB_PWD' =>'',
    'DB_CHARSET' =>'utf8',
    'DB_PORT' =>'3306',
    define('WEB_HOST', 'http://'.$_SERVER['HTTP_HOST']),
    /*微信支付配置*/
        'WxPayConf_pub' =>  array(
        'APPID'         => 'wx3d22a018adfade7f',
        'MCHID'         => '1488311052',
        'KEY'           => 'dakangfitnessshareibenhong2017aa',
        'APPSECRET'     => '1a1ab2892b77432d64cb96d03dac2fae',
        'JS_API_CALL_URL' => WEB_HOST.'/index.php/home/wxjs/jsApiCall',
        'SSLCERT_PATH'    => WEB_HOST.'/ThinkPHP/Library/Vendor/WxPayPubHelper/cacert/apiclient_cert.pem',
        'SSLKEY_PATH'     => WEB_HOST.'/ThinkPHP/Library/Vendor/WxPayPubHelper/cacert/apiclient_key.pem',
        'NOTIFY_URL'      => WEB_HOST.'/index.php/Home/Wxjs/notify',
        'CURL_TIMEOUT'    => 30
    )
);
<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class WxjsController extends Controller {
 /**
     * 初始化
     */
    public function _initialize()
    {
        //引入WxPayPubHelper
        vendor('WxPayPubHelper.WxPayPubHelper');
    }

    /*统一支付接口*/
    public function pay_ok()
    {
        $da=I('post.');
        session('save', $da);
        $data['addr']=$da['addr_id'];
        $addr_id=$data['addr_id'];
        if(!empty($da['exchange']) || (empty($da['relet']) && $da['pay_for'] == '0')) {
            $openid = session('openid');
            $rest_money = M('consumer')->where('openid = "'.$openid.'"')->field('money')->find();
            $deposit = M('goods')->where('id = '.$da['g_id'])->field('ps_price')->find();
            if(floatval($rest_money['money']) < floatval($deposit['ps_price'])) {
                $this->redirect('index/pay',array('deposit' => $deposit['ps_price'], 'rest' => $rest_money['money']));
            }
        }
        if (empty($da['addr'])) {
          //$this->redirect('index/address_administration', array('cate_id' => 2), 1, '请填写收货地址...');
           echo "<script> alert('请填写收货地址...');window.location.href='/index.php/home/index/address_administration';</script>";
        } else {
            session('g_id',null);
            $this->jsApiCall();
        }
    }

    public function pay_deposit()
    {
        $deposit = I('post.deposit');
        session('deposit',$deposit);
        $this->jsApiCall();
    }

    public function pay_success()
    {
        $deposit = session('deposit'); 
        if(!empty($deposit)) {
            $openid = session('openid');
            $rest = M('consumer')->where('openid = "'.$openid.'"')->field('money')->find()['money'];
            $money = floatval($deposit);
            // $money = floatval($rest) + floatval($deposit);
            M('consumer')->where('openid = "'.$openid.'"')->save(['money' => $money]);
            $data['user'] = $openid;
            $data['or_time'] = date('Y-m-d H:i:s');
            $data['out_trade_no'] = session('out_trade_no');
            $data['deposit'] = $deposit;
            $data['pay_for'] = 2;
            M('order')->add($data);
            session('deposit',null);
        } else {
            $this->save_array('1');
        }
        echo "<script>window.location.href='/index.php/home/index/main';</script>";
    }

    public function pay_fail()
    {
        $deposit = session('deposit'); 
        if(!empty($deposit)) {
            session('deposit',null);
        } else {
            $this->save_array('0');
        }
        echo "<script>window.location.href='/index.php/home/index/main';</script>";
    }

    public function save_array($paied) 
    {
        $save = session('save');
        session('save',null);
        if(!empty($save['repay'])) {
            if($paied == '1') {
                $data['paied'] = '1';
                $data['out_trade_no'] = session('out_trade_no');
                session('out_trade_no', null);
                M('order')->where('order_id = '.$save['order_id'])->save($data);
                $openid = session('openid');
                $rest = M('consumer')->where('openid = "'.$openid.'"')->field('money')->find()['money'];
                $money = floatval($rest) - floatval($save['deposit']);
                M('consumer')->where('openid = "'.$openid.'"')->save(['money' => $money]);
                echo "<script>window.location.href='/index.php/home/index/main';</script>";
                return;
            } 
        }
        if(!empty($save['order_id'])) {
            if($paied == '1') {
                $order_id = $save['order_id'];
                $state_data['xd_time'] = $save['xd_time'];
                M('order_state')->where('order_id = '.$order_id)->save($state_data);
            }
        } else {
            $payFor = $save['pay_for'];
            $order_id = time();
            $data['order_id'] = $order_id;
            $data['goods_id'] = $save['g_id'];
            $goods_id = $save['g_id'];
            $data['price'] = $save['o_price'];
            $openid = session('openid');
            $data['user'] = $openid;
            $data['addr'] = $save['addr'];
            $data['receiver']=  $save['receiver'];
            $data['tel'] = $save['tel'];
            $data['send_area'] = $save['send_area'];
            $data['pay_for'] = $save['pay_for'];
            $data['paied'] = $paied;
            $data['or_time'] = date("Y-m-d H:i:s",time());
            $data['out_trade_no'] = session('out_trade_no');
            $data['express'] = $save['express'];
            $data['state'] = '0';
            session('out_trade_no', null);
            if($payFor == 0) {
                if($paied == '1') {
                    $openid = session('openid');
                    $rest = M('consumer')->where('openid = "'.$openid.'"')->field('money')->find()['money'];
                    $money = floatval($rest) - floatval($save['deposit']);
                    M('consumer')->where('openid = "'.$openid.'"')->save(['money' => $money]);
                }
                $data['deposit'] = $save['deposit'];
                $data['express'] = $save['express'];
                $price_id = $save['price_id'];
                $data['g_price_id'] = $price_id;
                $data['exchange'] = $save['exchange'];

                if(!empty($data['exchange'])) {
                    $ex['state'] = '8';
                    $ex['exchangeTo'] = $order_id;
                    M('order')->where('order_id = "'.$data['exchange'].'"')->save($ex);
                }
                if($save['relet']) {
                    $data['state'] = '3';
                } else {
                    $data['state'] = '0';
                }
                $state_data['user'] = $openid;
                $state_data['order_id'] = $order_id;
                $state_data['goods'] = $save['g_id'];
                M('order_state')->data($state_data)->add();
            }
            $coupon_id = $save['coupon_id'];
            if(!empty($coupon_id)) {
                M('user_coupon')->where('id = '.$coupon_id)->save(array('status' => 'D'));
            }
            M('order')->data($data)->add();
        }
    }

    public function jsApiCall()
    {
        //使用jsapi接口
        $deposit = session('deposit');
        if(!empty($deposit)) {
            $price = floatval($deposit)*100;
        } else {
            $data = session('save');
            $price = $data['o_price'];
            $price = floatval($price)*100; 
        }
        $jsApi = new \JsApi_pub();
        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code']))
        { 
            //触发微信返回code码
            $url = $jsApi->createOauthUrlForCode(C('WxPayConf_pub.JS_API_CALL_URL'));
            //print_r($url);exit();
            Header("Location: $url");
        } else {
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
        }
        //print_r($openid);exit();
        //=========步骤2：使用统一支付接口，获取prepay_id============
        //使用统一支付接口
        $unifiedOrder = new \UnifiedOrder_pub();
        //状态查找
        //设置统一支付接口参数
        //设置必填参数
        //appid已填,商户无需重复填写
        //mch_id已填,商户无需重复填写
        //noncestr已填,商户无需重复填写
        //spbill_create_ip已填,商户无需重复填写
        //sign已填,商户无需重复填写
        
        $unifiedOrder->setParameter("openid",$openid);//商品描述
        $unifiedOrder->setParameter("body","达康健身器材共享");//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = C('WxPayConf_pub.APPID').$timeStamp;
        $unifiedOrder->setParameter("out_trade_no",$out_trade_no);// 商户订单号
        $unifiedOrder->setParameter("total_fee",$price);// 总金额
        $unifiedOrder->setParameter("notify_url",C('WxPayConf_pub.NOTIFY_URL'));//通知地址
        $unifiedOrder->setParameter("trade_type","JSAPI");//交易类型

        session('out_trade_no',$out_trade_no);

        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID
        
        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);
        
        $jsApiParameters = $jsApi->getParameters();
        //print_r($jsApiParameters);exit();

       // print_r($re['position']);exit();
        $this->assign('jsApiParameters',$jsApiParameters);
        $this->display('zhifu');
    }




    /*异步通知方法*/
    public function notify()
    {
        //使用通用通知接口
        $notify = new \Notify_pub();
        
        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);
        
        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;
        
        //==商户根据实际情况设置相应的处理流程，此处仅作举例=======
        
        //以log文件形式记录回调信息
//         $log_ = new Log_();
        $log_name= __ROOT__."/Public/notify_url.log";//log文件路径
        
        log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
        
        if($notify->checkSign() == TRUE)
        {
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【通信出错】:\n".$xml."\n");
            }
            elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【业务出错】:\n".$xml."\n");
            }
            else{
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【支付成功】:\n".$xml."\n");
            }
        
            //商户自行增加处理流程,
            //例如：更新订单状态
            //例如：数据库操作
            //例如：推送支付完成信息
        }
    }


}
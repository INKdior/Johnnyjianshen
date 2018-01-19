<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
	private $appId = 'wx3d22a018adfade7f';//打开微信公众平台-开发者中心 获取appId和appSecret
	private $appSecret = '1a1ab2892b77432d64cb96d03dac2fae';

    public function index()
    {
    	$back_url = WEB_HOST.'/index.php/home/index/get_unionid';
        $redirect_uri = urlencode($back_url);
    	$this->login($redirect_uri);;

    }


/*    public function get_openid(){
        $appid = "wx3d22a018adfade7f";
        $secret = "1a1ab2892b77432d64cb96d03dac2fae";
        $code = $_GET['code'];
        $state = $_GET['state'];
        $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $token = json_decode(file_get_contents($access_token_url));
        //var_dump($token);
        $openid = $token->openid;
        print_r($openid);
    }*/

    public function login($redirect_uri) 
    {
		//微信授权登录
    	$appid = $this->appId;
        $secret = $this->appSecret;
        $state = 'dakang';
        $scope = 'snsapi_userinfo';
        // $redirect_uri = 'http://jsgx.ibenhong.com/index.php/home/index/get_unionid';
        $oauth_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
        header("Location: $oauth_url");
        //$this->redirect('index/main');
    }

  	public function get_unionid()
  	{
		//微信用户信息
        $appid = $this->appId; 
        $secret = $this->appSecret; 
        $code = $_GET['code'];
        $state = $_GET['state'];
        $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $token = json_decode(file_get_contents($access_token_url));
        $openid = $token->openid;
        $access_token = $token->access_token;
        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $info = json_decode(file_get_contents($info_url));
        $data['wxname']   = $info->nickname;
        $data['picture_url'] = $info->headimgurl;
        $data['openid']     = $info->openid;
        $data['sex']        = $info->sex;
        $data['language']   = $info->language;
        $data['city']       = $info->city;
        $data['province']   = $info->province;
        $data['country']    = $info->country;
        $openid = $data['openid'];
        if ($openid == '') {
        	$this->redirect('index/index'); 
        }
        session('openid',$openid);
        $consumer = M('consumer');
        $res = $consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($data)) {
            $data['new_vip']="1";
            $re = $consumer->data($data)->add();
            $this->redirect('bind_phone');;
        } else if(!empty($res) && empty($res['tel'])) {
            $this->redirect('bind_phone');;
        } else if(empty($res) && empty($data)) {
        	$this->redirect('index/index'); 
        } else {
            $this->redirect('index/main');
        }
    }

	public function main()
	{
		vendor('Jssdk.Jssdk');
		$jssdk = new \Jssdk($this->appId, $this->appSecret);
		$wx = $jssdk->getSignPackage();	
		session('exchange', null);
		$host = 'http://'.$_SERVER['HTTP_HOST'];
    	$data = M('banner')->select();
    	$goods = M('goods')->select();
    	$coupon = M('coupon')->where('status = "N" AND stage = 1')->find();
		$this->assign('wx',$wx);
		$this->assign('coupon',$coupon);
    	$this->assign('openid',session('openid'));
    	$this->assign('host',$host);
    	$this->assign('goods',$goods);
    	$this->assign('data',$data);
    	$this->assign('flag','main');
        $this->display();
	}
	
	public function get_config()
	{
		vendor('Jssdk.Jssdk');
		$jssdk = new \Jssdk($this->appId, $this->appSecret);
		$wx = $jssdk->getSignPackage();	
		// echo json_encode($wx);
		return $wx;
	}

    public function get_org_token()
    {
    	$arr = [
    		'grant_type' => 'password',
    		'username' => 'dksharefitness@qq.com',
    		'password' => 'dkshare2017'
    	];
    	$json = json_encode($arr);
    	$url = 'https://a1.easemob.com/management/token';
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	// curl_setopt($ch, CURLOPT_HEADER, 1); 
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    	// curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	$output = curl_exec($ch);
    	$out = curl_multi_getcontent($ch);
    	// echo curl_getinfo($ch, CURLINFO_HEADER_OUT);
    	// echo  curl_error($ch);
    	curl_close($ch);
    	$Results = json_decode($out);
    	return $Results->access_token; 
    }

    public function get_sms_token($org_token)
    {
    	$url = "https://sms.easemob.com/1195170921178810/dk-share/token";
    	$header[] = 'username:dksharefitness@qq.com';
    	$header[] = 'token:'.$org_token;
    	$header[] = 'Content-Type: application/json;charset=UTF-8';
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	$output = curl_exec($ch);
    	$output = curl_multi_getcontent($ch);
    	curl_close($ch);
    	$Results = json_decode($output);
    	return $Results->data->token;
    }

    public function send_sms($sms_token,$phone)
    {
    	$url = "https://sms.easemob.com/1195170921178810/dk-share/sms_send";
    	$header[] = 'token:'.$sms_token;
    	$header[] = 'Accept:*/*';
    	$header[] = 'Content-Type: application/json;';
    	$rand = rand(1000000,9999999);
    	$json = '{"orderId":"110417092616000387","params":"number='.$rand.'","receiver":"'.$phone['phone'].'","sign":"健身器材共享",
    	"templateCode":"c0455a33-7784-477d-973b-08e221d5cd86"}';
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    	$output = curl_exec($ch);
    	curl_close($ch);
    	return $rand;
    }

    public function get_code()
    {
    	$phone = I('post.');
    	$org_token = $this->get_org_token();
    	$sms_token = $this->get_sms_token($org_token);
    	$rand = $this->send_sms($sms_token,$phone);
    	echo json_encode($rand);
    }

    public function bind()
    {
    	$openid = session('openid');
    	$phone = I('post.phone');
    	M('consumer')->where('openid = "'.$openid.'"')->save(array('tel' => $phone));
        $data = M('coupon')->field('id,type,value,up,down,reach')->where('stage = 1 AND status = "N"')->find();
        if($data['type'] == '1') {
            $value = rand($data['up'],$data['down']);
        } else {
            $value = $data['value'];
        }
        $arr = [
            'user_openid' => $openid, 
            'coupon_id' => $data['id'],
            'value' => $value,
            'type' => $data['type'],
            'up' => $data['up'],
            'down' => $data['down'],
            'reach' => $data['reach'],
            'date' => date('Y-m-d'),
            'status' => 'N'
        ];
        M('user_coupon')->add($arr);
        $this->assign('data',$data);
    	$this->redirect('personal_data');
    }

    public function bind_phone() 
    {
    	$openid = session('openid');
    	$data = M('consumer')->where('openid = "'.$openid.'"')->field('tel')->find();
    	$this->assign('data',$data);
    	$this->display();
    }

	public function product_det()
    {
		//$gid=15;
        $openid = session('openid');
		$g_id = I('get.g_id');
        session('purchase',NULL);
        $purchase = I('get.purchase');
        if($purchase == 'purchase') {
            session('purchase','purchase');
        }
		session('relet',I('get.relet'));
		session('exchange',I('get.order_id'));
		session('g_id',$g_id);
        $user = I('get.user');
        if($user == $openid) {
            $this->redirect('index/main');
        }
		if(empty(session('openid'))) {
			$redirect_uri = WEB_HOST.'/index.php/home/index/product_details';
			$this->login($redirect_uri);
		} else {
			$this->redirect('index/product_details');
		}
	}
	public function product_details() 
	{
		$openid = session('openid');
        $purchase = session('purchase');
        if(empty($openid)) {
            //微信用户信息
            $appid = $this->appId; 
            $secret = $this->appSecret; 
            $code = $_GET['code'];
            $state = $_GET['state'];
            if(empty($code)) {
                $uri = WEB_HOST.'/index.php/home/index/product_details';
                $this->login($uri);
            } else {
                $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
                $token = json_decode(file_get_contents($access_token_url));
                $openid = $token->openid;
                $access_token = $token->access_token;
                $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
                $info = json_decode(file_get_contents($info_url));
                $data['wxname']   = $info->nickname;
                $data['picture_url'] = $info->headimgurl;
                $data['openid']     = $info->openid;
                $data['sex']        = $info->sex;
                $data['language']   = $info->language;
                $data['city']       = $info->city;
                $data['province']   = $info->province;
                $data['country']    = $info->country;
                $openid = $data['openid'];
                session('openid',$openid);
            }
        }
        $consumer = M('consumer');
        $res = $consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($data)) {
            $data['new_vip']="1";
            $consumer->data($data)->add();
            $this->redirect('bind_phone');;
        } else if(empty($res['tel']) && !empty($res)) {
            $this->redirect('bind_phone');;
        } else if(empty($res) && empty($data)){
            $uri = WEB_HOST.'/index.php/home/index/product_details';
            $this->login($uri);
        }
		$g_id = session('g_id');
		if(empty($g_id)){
			$g_id = I('get.gid');
		}
		session('g_id', null);
		$re = M('goods')->where("id=$g_id")->find();
        $stock = $re['stock'];
        $num = M('order')->where('goods_id = '.$g_id)->field('id')->select();
        $count = count($num);
        $rest = $stock - $count;
        $re['rest'] = $rest;
		$i = 0;
		$data = M('g_price')->where("g_id=$g_id")->select();
		foreach ($data as $key => $value) {
			if ($value['stali']==1) {
				$data[$i]['stali']="(新用户)";
			} else {
				$data[$i]['stali']='';
			}
			$i++;
		}
		$p_t = array_chunk($data, 2);
		$host = WEB_HOST;
		$wx = $this->get_config();
		$coupon = M('coupon')->where('status = "N" AND stage = 1')->find();
        $this->assign('purchase',$purchase);
		$this->assign('coupon',$coupon);
		$this->assign('wx',$wx);
		$this->assign('openid',session('openid'));
		$this->assign('host',$host);
		$this->assign('p_t',$p_t);
		$this->assign('re',$re);
        $this->display();
	}

	public function About_Us()
	{
		$banner=M('about_us');
    	$data=$banner->where('id=1')->find();
    	$this->assign('data',$data);
    	$this->assign('flag','about_us');
        $this->display();
	}

    public function balance()
    {
        $openid = session('openid');
        $data = M('consumer')->where('consumer.openid = "'.$openid.'"')->find();
        $this->assign('data',$data);
        $this->display();
    }

    public function particulars()
    {
        $openid = session('openid');
        $data = M('refund')->join('`order` ON `order`.order_id = refund.order_id','LEFT')
        ->join('consumer ON `order`.user = consumer.openid')->where('`order`.user = "'.$openid.'"')
        ->field('refund.*,`order`.price,`order`.or_time,"refund" AS type')->order('time desc')->select();
        $withdraw = M('withdraw')->where('user = "'.$openid.'"')->order('time desc')->field('withdraw.*,"withdraw" AS type ')->select();
        foreach ($data as $key => $value) {
            foreach ($withdraw as $k => $val) {
                if($val['time'] > $value['time']) {
                    $temp[] = $val;
                    unset($withdraw[$k]);
                } else {
                    $tmp[$k] = $val;
                }
            }
            $temp[] = $value;
        }
        foreach ($tmp as $v) {
            $temp[] = $v;
        }
        $this->assign('data',$temp);
        $this->display();
    }

    public function withdraw()
    {
        $openid = session('openid');
        $data = M('consumer')->where('openid = "'.$openid.'"')->find();
        $this->assign('data', $data);
        $this->display();
    }

    public function withdraw_deposit()
    {
        $openid = session('openid');
        $data = M('consumer')->where('openid = "'.$openid.'"')->find();
        $money = I('post.money');
        $rest_money = floatval($data['money']) - floatval($money);
        $add = [
            'user' => $data['openid'],
            'apply_time' => date('Y-m-d H:i:s'),
            'state' => '0',
            'money' => $money,
            'rest_money' => $rest_money,
        ];
        M('consumer')->where('openid = "'.$openid.'"')->save(['money' => $rest_money]);
        $data = M('withdraw')->where('openid = "'.$openid.'"')->add($add);
        if(!empty($data)) echo json_encode('success');
    }

	public function personal_center()
	{
		$openid = session('openid');
		if(empty($openid)) {
			//微信用户信息
	        $appid = $this->appId; 
	        $secret = $this->appSecret; 
	        $code = $_GET['code'];
	        $state = $_GET['state'];
			if(empty($code)) {
				$uri = WEB_HOST.'/index.php/home/index/personal_center';
				$this->login($uri);
			} else {
		        $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
		        $token = json_decode(file_get_contents($access_token_url));
		        $openid = $token->openid;
		        $access_token = $token->access_token;
		        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
		        $info = json_decode(file_get_contents($info_url));
		        $data['wxname']   = $info->nickname;
		        $data['picture_url'] = $info->headimgurl;
		        $data['openid']     = $info->openid;
		        $data['sex']        = $info->sex;
		        $data['language']   = $info->language;
		        $data['city']       = $info->city;
		        $data['province']   = $info->province;
		        $data['country']    = $info->country;
		        $openid = $data['openid'];
		        session('openid',$openid);
            }
        }
        $consumer = M('consumer');
        $res = $consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($data)) {
            $data['new_vip']="1";
            $re = $consumer->data($data)->add();
            $this->redirect('bind_phone');;
        } else if(!empty($res) && empty($res['tel'])) {
            $this->redirect('bind_phone');;
        } else if(empty($res) && empty($data)){
            $uri = WEB_HOST.'/index.php/home/index/personal_center';
            $this->login($uri);
        }
    	session('g_id', null);
    	$data = M('consumer')->where("openid='$openid'")->find();
    	$this->assign('flag','personal');
    	$this->assign('data',$data);
        $this->display();
	}

	public function share_login($share_openid)
	{
		session('share_openid',$share_openid);
		$uri = WEB_HOST.'/index.php/home/index/share';
		$this->login($uri);
	}

    public function share()
    {
    	$appid = $this->appId;
        $secret = $this->appSecret; 
        $code = $_GET['code'];
        $state = $_GET['state'];
        $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $token = json_decode(file_get_contents($access_token_url));
    	$openid = $token->openid;
        $access_token = $token->access_token;
        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $info = json_decode(file_get_contents($info_url));
        $consumer=M('consumer');
        $res=$consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($info)) {
	        $info_data['wxname']   = $info->nickname;
	        $info_data['picture_url'] = $info->headimgurl;
	        $info_data['openid']     = $info->openid;
	        $info_data['sex']        = $info->sex;
	        $info_data['language']   = $info->language;
	        $info_data['city']       = $info->city;
	        $info_data['province']   = $info->province;
	        $info_data['country']    = $info->country;
        	$info_data['new_vip'] = "1";
        	$consumer->data($info_data)->add();	
            $this->redirect('bind_phone');
        } else if(empty($res['tel'])) {
            $this->redirect('bind_phone');;
        } else if(empty($res) && empty($data)){
            $this->share_login(session('share_openid'));
        }

    	$share_openid = session('share_openid');
        $coupon = M('coupon');
    	$coupon_data = $coupon->where('status = "N" AND stage = 1')->find();
    	$coupon_id = $coupon_data['id'];
    	$coupon_name = $coupon_data['coupon_name'];
        $coupon_type = $coupon_data['type'];
        $coupon_up = $coupon_data['up'];
        $coupon_down = $coupon_data['down'];
        $coupon_reach = $coupon_data['reach'];
    	$deadline = $coupon_data['deadline'];
        $user_coupon_list = M('user_coupon');
        $value = $coupon_data['value'];
        if(!empty($coupon_id)) {
            $list_data = $user_coupon_list->join('consumer ON consumer.openid = user_coupon.user_openid','LEFT')
            ->where('user_coupon.share_openid = "'.$share_openid.'" AND user_coupon.coupon_id = '.$coupon_id)->select();
        }
        if($coupon_data['type'] == '1') {
            $value = rand($coupon_up,$coupon_down);
        }
    	$share = M('user_coupon');
    	$exist = $share->where("user_openid ='".$openid."' AND share_openid ='".$share_openid."' AND coupon_id = ".$coupon_id)->find();
    	if(!empty($exist)) {
    		$this->assign('randValue',$exist['value']);
    		// if($openid == $share_openid) 
    		// 	$this->assign('flag','2');
    		// else 
			$this->assign('flag','1');
    		$this->assign('list_data',$list_data);
    	} else {
	        $data['wxname']   = $info->nickname;
	        $data['picture_url'] = $info->headimgurl;
	    	$date = date('Y-m-d');
			// $consumer = M('consumer');
	    	// $data = $consumer->where("openid='$openid'")->find();
	    	// $this->assign('data',$data);
	    	$this->assign('randValue',$value);
	    	$this->assign('value',$value);
	    	$user_coupon = M('user_coupon');
	    	$user_coupon->data(array(
	    		'user_openid' => $openid,
	    		'share_openid' => $share_openid,
	    		'coupon_id' => $coupon_id,
	    		'coupon_name' => $coupon_name,
                'type' => $coupon_type,
                'up' => $coupon_up,
                'down' => $coupon_down,
                'reach' => $coupon_reach,
	    		'deadline' => $deadline,
	    		'value' => $value,
	    		'date' => date('Y-m-d h:i:s')
			))->add();
			$list_data[] = [
				'picture_url' => $data['picture_url'],
				'wxname' => $data['wxname'],
				'date' => $date,
				'type' => $coupon_type,
                'up' => $coupon_up,
                'down' => $coupon_down,
                'reach' => $coupon_reach,
                'value' => $value,
			];
			$this->assign('list_data',$list_data);
    	}
    	$this->assign('coupon_data',$coupon_data);
    	// $this->assign('data',$data); 
    	$this->display();
    }

	public function search_product() 
	{
		$data = $_REQUEST['content'];
		$product = M('goods');
		$id = $product->where('name like "%'.$data.'%"')->field('id')->find();
		if(empty($id)) 
			echo '';
		else 
			echo json_encode($id);
	}

 	public function personal_data()
	{
		$openid=session('openid');
		$banner=M('consumer');
    	$data=$banner->where("openid='$openid'")->find();
    	$this->assign('data',$data);
        $this->display();
	}

	public function upload_pic()
	{
		$openid=session('openid');
		$data = ['picture_url' => $this->upload()];
		$upl=M('consumer');
		$re=$upl->where("openid='$openid'")->save($data); 
	}

	public function upload() 
	{
		$upload = new \Think\Upload();// 实例化上传类
	   	// $upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
		// 上传单个文件 
		$key = array_keys($_FILES)[0];
		$info   =   $upload->uploadOne($_FILES[$key]);
		if(!$info) {// 上传错误提示错误信息
		   $this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
		    echo $info['savepath'].$info['savename'];
		    return '/Uploads/'.$info['savepath'].$info['savename'];
		}
	}

    public function personal_coupon()
    {
    	$openid = session('openid');
    	$coupon = M('user_coupon');
    	$curDate = date('Y-m-d');
    	$data = $coupon->field('user_coupon.*,coupon.coupon_name,coupon.deadline')
    	->join('coupon ON coupon.id = user_coupon.coupon_id','LEFT')
    	->where("user_openid='{$openid}' AND coupon.status = 'N' AND user_coupon.status = 'N' AND coupon.deadline > '".$curDate."'")->select();
    	$host = $_SERVER['HTTP_HOST'];
    	$this->assign('data',$data);
    	$this->assign('host',$host);
		$this->assign('flag',I('get.flag'));
    	$this->display();
    }

	public function xg_consumer()
	{
		$data = I('post.');
		$openid=session('openid');
		$consumer=M('consumer')->where("openid='$openid'")->save($data);
		if ($consumer=='') {
			$this->redirect('index/personal_center'); 
		}else{
			$this->redirect('index/personal_data'); 
		}
	}

	public function autonym()
	{
		$openid=session('openid');
		$data=I('post.');
		$banner=M('consumer');
		$re=$banner->where("openid='$openid'")->save($data); 
		if ( false == $result ){   
        	$this->success('验证成功！','./personal_data',0);  
        }else{   
        	$this->error('删除失败！');     
        }
		
	}
	public function The_user_id()
	{
		$openid=session('openid');
		$banner=M('consumer');
		$re=$banner->where("openid='$openid'")->find(); 
		$this->assign('re',$re);
		$this->display();
	/*	if ($re['id_number']=='') {

			$this->redirect('./The_user_id', 0, '页面跳转中...');
		} else {
			$this->assign('data',$re);
			$this->redirect('./The_user_id_1', 0, '页面跳转中...');
		}*/
	}
	public function ajax_price (){
		$g_id=$_REQUEST["product"];
		$data=M('g_price')->where("g_id=$g_id")->select();
		//print_r($data);
		$i = 0;
		foreach ($data as $key => $value) {
			if ($value['stali']==1) {
				$value['stali']="(新用户)";
			} else {
				$value['stali']='';
			}
			if($i == 0) {
				echo "
					<div class='col-md-6 col-sm-6 col-xs-6'>
						<p class='text-left small-text'>
							<input type='radio' checked name='p' value='".$value['id']."'>
								".$value['price']."元 (".$value['time']."天)".$value['stali']."				
						</p>	
					</div>
				";
			} else {
				echo "
					<div class='col-md-6 col-sm-6 col-xs-6'>
						<p class='text-left small-text'>
							<input type='radio' name='p' value='".$value['id']."'>
								".$value['price']."元 (".$value['time']."天)".$value['stali']."				
						</p>	
					</div>
				";	
			}
			$i++;
		}
		
	}

	public function update_default() 
	{
		$data['id'] = $_REQUEST['id'];
		$openid = session('openid');
		$address = M('address');
		if($_REQUEST['confirm'] == 'true') {
			$data['state'] = '0';
			$data2['state'] = '1';
			$address->where('id = '.$data['id'])->save($data);
			$address->where('id != '.$data['id'].' AND openid = "'.$openid.'"')->save($data2);
		}
		session('addr_id',$data['id']);
		// $addr = $address->where('id = '.$data['id'])->find();
		// $this->assign('data',$addr);
	}

	public function address_administration() 
	{
		$openid = session('openid');
        if(empty($openid)) {
            //微信用户信息
            $appid = $this->appId; 
            $secret = $this->appSecret; 
            $code = $_GET['code'];
            $state = $_GET['state'];
            if(empty($code)) {
                $uri = WEB_HOST.'/index.php/home/index/address_administration';
                $this->login($uri);
            } else {
                $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
                $token = json_decode(file_get_contents($access_token_url));
                $openid = $token->openid;
                $access_token = $token->access_token;
                $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
                $info = json_decode(file_get_contents($info_url));
                $data['wxname']   = $info->nickname;
                $data['picture_url'] = $info->headimgurl;
                $data['openid']     = $info->openid;
                $data['sex']        = $info->sex;
                $data['language']   = $info->language;
                $data['city']       = $info->city;
                $data['province']   = $info->province;
                $data['country']    = $info->country;
                $openid = $data['openid'];
                session('openid',$openid);
            }
        }
        $consumer = M('consumer');
        $res = $consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($data)) {
            $data['new_vip']="1";
            $re = $consumer->data($data)->add();
            $this->redirect('bind_phone');;
        } else if(!empty($res) && empty($res['tel'])) {
            $this->redirect('bind_phone');;
        } else if(empty($res) && empty($data)){
            $uri = WEB_HOST.'/index.php/home/index/address_administration';
            $this->login($uri);
        }
		$flag = I('get.flag');
		if($flag == 'submit_order') {
			session('addr_id',$data['id']);
			$this->assign('choose_addr','true');
		}
		$data = M('address')->where("openid='$openid'")->select();
		foreach ($data as $key => $value) {
			if ($value['state'] == '0') {
				$data[$key]['states'] = "<p class='tl pa highlight'>[默认]</p>";
			}
		}
		// print_r($data);
		$this->assign('data',$data);
		$this->display();
	}

	public function add() 
	{
		$addr_id = session('addr_id');
		if(empty($addr_id)) {
			$this->display();
		} else {
			$addr = M('address');
			$data = $addr->where('id = "'.$addr_id.'"')->field('id,name,tel,addr')->find();
			$this->assign('data',array('0' => $data));
			session('addr_id',null);
			$this->display();
		}
	}
	
	public function add_addr() 
	{
		$data=I('post.');
		$openid=session('openid');
		$data['openid']=$openid;
		$g_id = session('g_id');
        $re = M('address');
        if(isset($data['id'])) {
        	$re->where('id = '.$data['id'])->save($data);
        } else {
			$se=M('address')->where("openid='$openid'")->select();
			if (!empty($se)) {
				$data['state'] = 1;
			} else {
				$data['state'] = 0;
			}
			if(!empty($data['name']) && !empty($data['tel']) && !empty($data['addr']))
        		$id = $re->data($data)->add();
        }
    	if(empty($g_id)) {
    	 	echo "<script>window.location.href='./personal_center';</script>";
    	} else {
    		echo "<script>window.location.href='./submit_order?addr_id=$id';</script>";
    	}
	}

	public function del_addr() 
	{
		$openid=session('openid');
		$id=I('post.id');
		$re=M('address')->where("id='$id'")->delete();
	}

    public function pay() 
    {
        $deposit = I('get.deposit');
        $rest = I('get.rest');
        $this->assign('rest',$rest);
        $this->assign('deposit',$deposit);
        $this->display();
    }

  	public function submit_order() 
  	{
  		$openid = session('openid');
        $purchase = I('post.purchase');
        $price_id = I('post.price');
        $g_id = I('post.g_id');
        $coupon_id = I('get.coupon_id');
  		$exchange = session('exchange');
        $relet = session('relet');
        $addr_id = I('get.addr_id');
        // if(empty($relet) && empty($purchase) && empty($exchange) && empty($addr_id)) {
        //     $rest_money = M('consumer')->where('openid = "'.$openid.'"')->field('money')->find();
        //     $deposit = M('goods')->where('id = '.$g_id)->field('ps_price')->find();
        //     if(floatval($rest_money['money']) < floatval($deposit['ps_price'])) {
        //         $this->redirect('index/pay',array('deposit' => $deposit['ps_price'], 'rest' => $rest_money['money']));
        //     }
        // }
        if(!empty($exchange)) {
            $ex = M('order')->where('exchange = "'.$exchange.'"')->field('id,state')->find();
            if(empty($ex)) {
                $this->assign('exchange', $exchange);
            } else {
                $this->assign('exchange','exchanged');
            }
        }
        if($relet) {
        	$order_state = M('order_state')->where('order_state.order_id = "'.$relet.'"')->find();
        	$this->assign('order_state', $order_state);
        	$this->assign('relet', 'true');
        	session('relet',null);
        }
        if(empty($g_id)) {
        	$g_id = session('g_id');
        } else {
        	session('g_id',$g_id);
        }
        if(empty($price_id)) {
        	$price_id = session('price_id');
        } else {
        	session('price_id',$price_id);
        }
        $goods = M('goods')->where("id=$g_id")->find();
        $g_price = M('g_price')->where('id = '.$price_id)->find();
        if(empty($coupon_id)) {
        	$coupon = '';
        } else {
        	$coupon = M('user_coupon')->where('id = '.$coupon_id)->find();
        }
        $goods['xiaoji'] = $g_price['price'] - $goods['ps_price'];
        $re = M('consumer')->where("id='$openid'")->find();
        if(!empty($addr_id)) {
	        $addr = M('address')->where("id=$addr_id")->find();
        } else {
	        $addr = M('address')->where("openid='$openid' AND state = '0'")->find();
        }
		$stock = M('goods')->where('id = '.$g_id)->field('stock')->find();
		$num = M('order')->where('goods_id = '.$g_id.' AND state != 5 AND state != 7')->field('count(id) AS num')->find();
        $area = M('area')->find();
        $rest = intval($stock['stock']) - intval($num['num']);
        $goods['rest'] = $rest;
        // $map['price'] = $price_id;
		// $map['_string'] = "g_id='$g_id'";
		// $g_id = M('g_price')->where($map)->find();
        // $goods['g_id'] = $g_id['id'];
        if($purchase != 'purchase') {
		  $this->assign('g_price', $g_price);
        }
        $this->assign('area',$area);
        $this->assign('coupon', $coupon);
        $this->assign('addr', $addr);
        $this->assign('goods', $goods);
        $this->display();
    }

    public function repay_order()
    {	
    	$order_id = I('get.order_id');
        $coupon_id = I('get.coupon_id');
        $goods = M('order')->join('goods ON order.goods_id = goods.id','LEFT')->where('order.order_id = "'.$order_id.'"')->find();
        $g_id = $goods['goods_id'];
        $price_id = $goods['g_price_id'];
        $pay_for = $goods['pay_for'];
    	$openid = session('openid');
    	$re = M('consumer')->where("id='$openid'")->find();
        if(!empty(I('get.addr_id'))) {
        	$addr_id = I('get.addr_id');
	        $addr = M('address')->where("id=$addr_id")->find();
        } else {
	        $addr = M('address')->where("openid='$openid' AND state = '0'")->find();
        }
    	if(empty($coupon_id)) {
        	$coupon = '';
        } else {
        	$coupon = M('user_coupon')->where('id = '.$coupon_id)->find();
        }
        if($pay_for == 0) {
            $g_price = M('g_price')->where('id = '.$price_id)->find();
        }
        $area = M('area')->find();
        $this->assign('area',$area);
        $this->assign('repay', 'repay');
    	$this->assign('coupon', $coupon);
		$this->assign('g_price', $g_price);
        $this->assign('addr', $addr);
        $this->assign('goods', $goods);
        $this->display('submit_order');
    }

 	// public function pay_ok()
 	// {
 	// 	$openid=session('openid');
 	// 	//print_r($openid);exit();
 	// 	$order=M('order');
 	// 	$re=$order->where("user='$openid'")->order(array('or_time'=>'desc'))->limit(1)->select(); 
 	// 	//print_r($re);
 	// 	$da['state']=1;
 	// 	$data=$order->where("user='$openid'")->save($da);
 	// }

 	public function all_orders($value='')
 	{
 		$openid=session('openid');
 		//print_r($openid);exit();
 		$order=M('order');
 		// if(empty($_REQUEST['product']) || $_REQUEST['product'] == 'all') {
 		// 	$where['state'] = array('EGT',0);
 		// } else {
 		// 	$where['state'] = array('EQ',$_REQUEST['product']);
 		// }
        if(empty($openid)) {
            //微信用户信息
            $appid = $this->appId; 
            $secret = $this->appSecret; 
            $code = $_GET['code'];
            $state = $_GET['state'];
            if(empty($code)) {
                $uri = WEB_HOST.'/index.php/home/index/all_orders';
                $this->login($uri);
            } else {
                $access_token_url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
                $token = json_decode(file_get_contents($access_token_url));
                $openid = $token->openid;
                $access_token = $token->access_token;
                $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
                $info = json_decode(file_get_contents($info_url));
                $data['wxname']   = $info->nickname;
                $data['picture_url'] = $info->headimgurl;
                $data['openid']     = $info->openid;
                $data['sex']        = $info->sex;
                $data['language']   = $info->language;
                $data['city']       = $info->city;
                $data['province']   = $info->province;
                $data['country']    = $info->country;
                $openid = $data['openid'];
                session('openid',$openid);
            }
        }
        $consumer = M('consumer');
        $res = $consumer->where("openid='$openid'")->find();
        if (empty($res) && !empty($data)) {
            $data['new_vip']="1";
            $re = $consumer->data($data)->add();
            $this->redirect('bind_phone');
        } else if(!empty($res) && empty($res['tel'])) {
            $this->redirect('bind_phone');
        } else if(empty($res) && empty($data)){
            $uri = WEB_HOST.'/index.php/home/index/all_orders';
            $this->login($uri);
        }
		$where['_string'] = "user='$openid' AND paied = 1 AND (state = 0 OR state = 1 OR (pay_for = 0 AND state = 2))";
 		$data=$order->where($where)->order('or_time desc')->select();
        $goods=M('goods');
        $g_price=M('g_price');
 		foreach ($data as $key => $value) {
			if($value['state'] == '0') {
				$data[$key]['img'] = "1x.png";
			} else if ($value['state'] == '1') {
				$data[$key]['img'] = "2ng.png";
			} else if($value['state'] == '2') {
				$data[$key]['img'] = '4.png';
			} else if($value['state'] == '3') {
				$data[$key]['img'] = '5.png';
			} else if($value['state'] == '4') {
				$data[$key]['img'] = '6.png';
			} else if($value['state'] == '5') {
				$data[$key]['img'] = '7.png';
			} else if($value['state'] == '61') {
                $data[$key]['img'] = '61.png';
            } else if($value['state'] == '6') {
				$data[$key]['img'] = '8.png';
			} else if($value['state'] == '7') {
				$data[$key]['img'] = '4.png';
			} else if($value['state'] == '8') {
				$data[$key]['img'] = '10.png';
			} else if($value['state'] == '9' OR $value['state'] == '10') {
				$data[$key]['img'] = '4.png';
			}
            if($value['paied'] == 0) {
                $data[$key]['img'] = '12.png';
            }
			$g_id = $value['goods_id'];
			$g_price_id=$value['g_price_id'];
			$re1 = $goods->where("id=".$g_id)->find();
            if($value['pay_for'] == '0') {
                $g_price_id = $value['g_price_id'];
                $re2 = $g_price->where("id=$g_price_id")->find();
                $string = $re2['time']."天套餐";
            } else {
                $string = '选择购买';
            }
			$data[$key]['name'] = $re1['name'];
			$data[$key]['day'] = $string;
		}
 		$this->assign('data',$data);
 		$this->display();
 	}

 	public function ajax_orders(){
 		//echo"123";
		$openid=session('openid');
 		//print_r($openid);exit();
 		$order=M('order');
 		$state=$_REQUEST["product"];
 		$goods=M('goods');
 		$g_price=M('g_price');
		switch($state) {
            // 配送
				case 'a': 
				$where['_string'] = "user='$openid' AND paied = 1 AND (state = 0 OR state = 1)";
				$data=$order->where($where)->order('or_time desc')->select();
				foreach ($data as $key => $value) {
					if($value['state'] == '0') {
						$pic = "1x.png";
					} else if ($value['state'] == '1') {
						$pic = "2ng.png";
					} else if($value['state'] == '2') {
						$pic = '4.png';
					} else if($value['state'] == '3') {
						$pic = '5.png';
					} else if($value['state'] == '4') {
						$pic = '6.png';
					} else if($value['state'] == '5') {
						$pic = '7.png';
					} else if($value['state'] == '6') {
						$pic = '8.png';
					} else if($value['state'] == '7') {
						$pic = '4.png';
					} else if($value['state'] == '8') {
						$pic = '10.png';
					} else if($value['state'] == '9' && $value['state'] == '10') {
						$pic = '4.png';
					}
					if($value['paied'] == 0) {
						$pic = '12.png';
					} 
					$g_id = $value['goods_id'];
					$re = $goods->where("id=$g_id")->find();
                    if($value['pay_for'] == '0') {
    					$g_price_id = $value['g_price_id'];
    					$re1 = $g_price->where("id=$g_price_id")->find();
                        $string = $re1['time']."天套餐";
                    } else {
                        $string = '选择购买';
                    }
					echo "<div class='trik'></div>
						<div class='indent cancel' onclick="
						."window.location.href='/index.php/home/index/cancellation_of_order.html?o_id="
						.$value['id']."'"
						.">
							<div class='indent-top'>
								<p class='fl'>订单ID: ".$value['order_id']."</p>
								<p class='fr'>
									<img src='/public/home/img/".$pic."'>
								</p>
							</div>
							<div class='long-line'></div>
							<div class='indent-bottom'>
								<p class='tl fl'>".$re['name']."</p>
								<p class='gray'>".$string."</p>
								<p class='text gray'><span class='fl'>".$value['or_time']."</span><span class='fr'>1份</span></p>
							</div>
						</div>";
		 		}
				break; 
                // 使用中
				case 0: 
				$where['_string'] = "user='$openid' AND paied = 1 AND ((pay_for = 0 AND state = 2) OR state = 3 OR state = 8 OR state = 6)";
				$data = $order->where($where)->order('or_time desc')->select();
				foreach ($data as $key => $value) {
					$g_id = $value['goods_id'];
					$re = $goods->where("id=$g_id")->find();
                    if($value['pay_for'] == '0') {
                        $g_price_id = $value['g_price_id'];
                        $re1 = $g_price->where("id=$g_price_id")->find();
                        $string = $re1['time']."天套餐";
                    } else {
                        $string = '选择购买';
                    }
                    if($value['state'] == '2') {
                        $pic = '4.png';
					} else if($value['state'] == '3') {
                        $pic = '5.png';
                    } else if($value['state'] == '6') {
                        $pic = '8.png';
                    } else if($value['state'] == '8') {
                        $pic = '10.png';
                    }
					echo "<div class='trik'></div>
						<div class='indent cancel' onclick="
						."window.location.href='/index.php/home/index/cancellation_of_order.html?o_id="
						.$value['id']."'"
						.">
							<div class='indent-top'>
								<p class='fl'>订单ID: ".$value['order_id']."</p>
								<p class='fr'>
									<img src='/public/home/img/".$pic."'>
								</p>
							</div>
							<div class='long-line'></div>
							<div class='indent-bottom'>
								<p class='tl fl'>".$re['name']."</p>
								<p class='gray'>".$string."</p>
								<p class='text gray'><span class='fl'>".$value['or_time']."</span><span class='fr'>1份</span></p>
							</div>
						</div>";
		 		}
				break;
                // 还货中
				case 1: 
				$where['_string'] = "user='$openid' AND (state = 6 OR state = 8 OR state = 61) ";
				$data=$order->where($where)->order('or_time desc')->select();
				foreach ($data as $key => $value) {
					$g_id=$value['goods_id'];
					$re=$goods->where("id=$g_id")->find();
                    if($value['pay_for'] == '0') {
                        $g_price_id = $value['g_price_id'];
                        $re1 = $g_price->where("id=$g_price_id")->find();
                        $string = $re1['time']."天套餐";
                    } else {
                        $string = '选择购买';
                    }
                     if($value['state'] == '6') {
                        $pic = '8.png';
                    } else if($value['state'] == '61') {
                        $pic = '61.png';
                    }  else if($value['state'] == '8') {
                        $pic = '10.png';
                    } 
                    if($value['paied'] == 0) {
                        $pic = '12.png';
                    } 
					echo "<div class='trik'></div>
						<div class='indent cancel' onclick="
						."window.location.href='/index.php/home/index/cancellation_of_order.html?o_id="
						.$value['id']."'"
						.">
							<div class='indent-top'>
								<p class='fl'>订单ID: ".$value['order_id']."</p>
								<p class='fr'>
									<img src='/public/home/img/".$pic."'>
								</p>
							</div>
							<div class='long-line'></div>
							<div class='indent-bottom'>
								<p class='tl fl'>".$re['name']."</p>
								<p class='gray'>".$string."</p>
								<p class='text gray'><span class='fl'>".$value['or_time']."</span><span class='fr'>1份</span></p>
							</div>
						</div>";
		 		}
				break; 
                // 全部
				case 2: 
				// $where['state'] = array('EGT',2);
				$where['_string'] = "pay_for!=2 AND user='$openid'";
				$data = $order->where($where)->order('or_time desc')->select();
				foreach ($data as $key => $value) {
                    if($value['pay_for'] == '0') {
                        $g_price_id = $value['g_price_id'];
                        $re1 = $g_price->where("id=$g_price_id")->find();
                        $string = $re1['time']."天套餐";
                    } else {
                        $string = '选择购买';
                    }
					if($value['state'] == '0') {
                        $pic = "1x.png";
                    } else if ($value['state'] == '1') {
                        $pic = "2ng.png";
                    } else if($value['state'] == '2') {
                        $pic = '4.png';
                    } else if($value['state'] == '3') {
                        $pic = '5.png';
                    } else if($value['state'] == '4') {
                        $pic = '6.png';
                    } else if($value['state'] == '5') {
                        $pic = '7.png';
                    } else if($value['state'] == '6') {
                        $pic = '8.png';
                    } else if($value['state'] == '61') {
                        $pic = '61.png';
                    } else if($value['state'] == '7') {
                        $pic = '9.png';
                    } else if($value['state'] == '8') {
                        $pic = '10.png';
                    } else if($value['state'] == '9' && $value['state'] == '10') {
                        $pic = '4.png';
                    }
                    if($value['paied'] == 0) {
                        $pic = '12.png';
                    } 
					echo "<div class='trik'></div>
						<div class='indent cancel' onclick="
						."window.location.href='/index.php/home/index/cancellation_of_order.html?o_id="
						.$value['id']."'"
						.">
							<div class='indent-top'>
								<p class='fl'>订单ID: "
								.$value['order_id']."</p>
								<p class='fr'>
									<img src='/public/home/img/".$pic."'>
								</p>
							</div>
							<div class='long-line'></div>
							<div class='indent-bottom'>
								<p class='tl fl'>".$re['name']."</p>
								<p class='gray'>".$string."</p>
								<p class='text gray'><span class='fl'>".$value['or_time']."</span><span class='fr'>1份</span></p>
							</div>
						</div>";
		 		}
				break; 
		}
 	}

    public function change_state() 
    {
    	$order_id = I('get.order_id');
    	$state = I('get.state');
        $paied = I('get.paied');
        $data = array('state' => $state);
        if($state == 4 && $paied == 0) {
            M('order')->where("order_id='$order_id'")->delete();
        }
        if($state == 6) {
            $data['delivery_id'] = '';
            M('order')->where("order_id='$order_id'")->save($data);    
        }
    	M('order')->where("order_id='$order_id'")->save($data);
    	$this->redirect('index/all_orders');
    }

    public function prompt()
    {
    	$order_id = I('get.order_id');
    	$data = array('prompt' => '1');
    	M('order')->where('order_id="'.$order_id.'"')->save($data);
    }

 	public function cancellation_of_order($value='')
 	{
 		vendor('Jssdk.Jssdk');
		$jssdk = new \Jssdk($this->appId, $this->appSecret);
		$wx = $jssdk->getSignPackage();
		$openid = session('openid');	
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		$coupon = M('coupon')->where('status = "N"')->find();
 		$order_id = I('get.o_id');
 		$order = M('order')->field('delivery.name AS delivery_name,delivery.phone AS delivery_phone,order.user,order.pay_for,order.paied,goods.delivery,order.express,order.goods_id,order.addr,order.receiver,order.tel,order.g_price_id,order.state,order.price,order.order_id,order.or_time,goods.name,goods.headline,goods.conf_infor,goods.abstract,os.freight,os.xd_time,goods.picture_url')
 		->join('goods ON goods.id = order.goods_id','LEFT')
        ->join('delivery ON delivery.id = order.delivery_id',"LEFT")
 		->join('order_state AS os ON os.order_id = order.order_id','LEFT')->where("order.id=$order_id")->find();
 		$goods_id = $order['goods_id'];
        $state = $order['state'];
        switch ($state) {
            case 0:
                $show['title'] = "未配送";
                break;
            case 1:
                $show['title'] = "配送中";
                break;
            case 2:
                $show['title'] = "已完成配送";
                break;
            case 3:
                $show['title'] = "已完成配送";
                break;
            case 4:
                $show['title'] = "申请取消订单中";
                break;
            case 5:
                $show['title'] = "订单已取消";
                break;
            case 6:
                $show['title'] = "申请还货";
                break;
            case 61:
                $show['title'] = "还货中";
                break;
            case 7:
                $show['title'] = "还货成功";
                break;
            case 8:
                $show['title'] = "申请转租";
                break;
            case 9:
                $show['title'] = "转租成功";
                break;
            case 10:
                $show['title'] = "转租成功";
                break;
        }
        if($order['pay_for'] == '0') {
     		$g_price_id = $order['g_price_id'];
     		$g_price = M('g_price')->where("id=$g_price_id")->find();
            $this->assign('g_price',$g_price);
        } else {
            $show['title'] = '选择购买';
        }
		$show['state'] = $state;
        $this->assign('openid',$openid);
		$this->assign('wx',$wx);
		$this->assign('coupon',$coupon);
		$this->assign('host',$host);
		$this->assign('show',$show);	
		$this->assign('order',$order);
		$this->assign('goods_id',$goods_id);
 		$this->display();
 	}

    public function cashpledge() 
    {
        $openid = session('openid');
        $data = M('order')->join('goods ON goods.id = `order`.goods_id','LEFT')->where('user = "'.$openid.'" AND paied = 1 AND pay_for = 0')->field('`order`.goods_id,`order`.deposit,goods.name')->select();
        foreach($data as $key => $value) {
            $temp[$value['goods_id']][] = $value;
        }
        $this->assign('data',$temp);
        $this->display();
    }

}
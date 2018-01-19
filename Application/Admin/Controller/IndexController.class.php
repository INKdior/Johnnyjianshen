<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    private $appId = 'wx3d22a018adfade7f';//打开微信公众平台-开发者中心 获取appId和appSecret
    private $appSecret = '1a1ab2892b77432d64cb96d03dac2fae';

    public function _initialize()
    {
        vendor('WxPayPubHelper.WxPayPubHelper');
        vendor('Jssdk.Jssdk');
    }

    public function index()
    {
        layout(false);
        $this->display();
    }

    public function login()
    {
        $data = I('post.');
        $name = $data['name'];
        $pwd  = md5($data['password']);
        $map['name&pwd'] =array($name,$pwd,'_multi'=>true);
        $admin = M('admin');
        $admin_data = $admin->where($map)->find();
        $power = $admin_data['level'];
        if(empty($admin_data)) {
            $where['account&password'] =array($name,$pwd,'_multi'=>true);
            $admin_data = M('delivery')->where($where)->find();
            $power = 2;
            if($admin_data['state'] == '1') {
                echo "<script> alert('您的账号已被禁用');</script>";
                echo "<script> window.location.href='./index';</script>";
            }
        }
        $admin_id = $admin_data['id'];
        if(!empty($admin_id)) {
            session('admin_id',$admin_id);  //设置session
            session('account',$name);
            session('power',$power);
            echo "<script> window.location.href='./main';</script>";
        }
        //$this->redirect('index/main', array('id' => $id), 0, '修改成功');alert('登录成功！')
        else {
            echo "<script> alert('用户名密码错误');</script>";
            echo "<script> window.location.href='./index';</script>";
        }
    }

    public function check_login_power()
    {
        $id = session('admin_id');
        $name = session('account');
        if(empty($id)) {
            echo "<script> alert('登录过期');</script>";
            echo "<script> window.location.href='./index';</script>";
        }
        $power = session('power');
        if ($power != 1) {
            echo "<script> alert('只有管理员能查看！'); window.location.href='./main';</script>";
        }
    }

    public function page($pagecount,$totalRows,$parameter,$p)
    {
        $Page = new \Think\Page('NULL',$pagecount);
        $Page->parameter = $parameter; //此处的row是数组，为了传递查询条件
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('last','尾页');
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.$p.' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $Page->totalRows = $totalRows;
        $arr = ['show' => $Page->show(), 'firstRow' => $Page->firstRow, 'listRows' => $Page->listRows];
        return $arr;
    }


    public function order()
    {  
        $order = M('order');
        $state = I('get.state');
        $start = I('get.start');
        $end = I('get.end');
        $prompt = I('get.prompt');
        $openid = I('get.openid');
        $p = I('get.p',1);
        $delivery_id = I('get.delivery_id');
        $order_state = I('get.state');
        $this->check_login_power();
        // var_dump(I('post.'));
        $where = 'order.paied = 1 AND order.pay_for != 2 AND ';
        if($state != '') {
            // if(empty(I('post.word'))) {
                if($state == '2') {
                    $where .= 'order.pay_for = 0 AND (order.state = "2" OR order.state = "3")';
                } else if($state == '10') {
                    $where .= 'order.pay_for = 1';
                } else if($state == '9') {
                    $where .= 'order.state = "9" OR order.state = "10"';
                } else if($state == 'all') {
                    $where .= '1';
                } else if($state == 'finish') {
                    $where .= '(order.state = 2 OR order.state = 5 OR order.state = 7 OR order.state = 9 OR order.state = 10) ';
                } else {
                    $where .= 'order.state = "'.$state.'"';
                }
                $this->assign('state',$state);
            // } else {
            //     if($state == '10') {
            //         $where = 'order.pay_for = 1 AND ';
            //     } else {
            //         $where = 'order.state = "'.$state.'" AND ';
            //     }
            //     $this->assign('state',$state);
            // }
            if(!empty($start) && !empty($end)) {
                $where .= ' AND order.or_time > "'.$start.'" AND order.or_time < "'.$end.'"';
                $parameter['start'] = $start;
                $parameter['end'] = $end;
            } else if(!empty($end) && empty($start) ) {
                $where .= ' AND order.or_time < "'.$end.'"';
                $parameter['end'] = $end;
            } else if(!empty($start) && empty($end) ) {
                $where .= ' AND order.or_time > "'.$start.'"';
                $parameter['start'] = $start;
            }
            $parameter['state'] = $state; 
        } else {
            $where .= 'order.state = 0 ';
            if(!empty($start) && !empty($end)) {
                $where .= ' AND order.or_time > "'.$start.'" AND order.or_time < "'.$end.'"';
                $parameter['start'] = $start;
                $parameter['end'] = $end;
            } else if(!empty($end) && empty($start) ) {
                $where .= ' AND order.or_time < "'.$end.'"';
                $parameter['end'] = $end;
            } else if(!empty($start) && empty($end) ) {
                $where .= ' AND order.or_time > "'.$start.'"';
                $parameter['start'] = $start;
            }
        }
        if(!empty($prompt)) {
            if(isset($where)) {
                $where .= ' AND order.prompt = 1 ';
            } else {
                $where .= 'order.prompt = 1 ';
            }
            $parameter['prompt'] = $start;
        }
        $date = ['start' => $start, 'end' => $end];
        $this->assign('date', $date);
        // $count = $order->count();
        $pagecount = 15;
        if($p != 1) {
            $total = session('total');
            $page = $this->page($pagecount,$total,$parameter,$p);
        } else {
            $page['firstRow'] = 0;
            $page['listRows'] = $pagecount;
        }
        if(!empty($delivery_id)) {
            $order->field('goods.name AS goods_name,order.delivery_id,delivery.name AS delivery_name,order.pay_for,order.paied,order.deposit,order.express,order.prompt,consumer.wxname,order.id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,order.exchange,order.exchangeTo,order_state.or_time AS start,order_state.xd_time AS end')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('delivery ON delivery.id = order.delivery_id','LEFT')
            ->join('goods ON goods.id = order.goods_id',"LEFT")
            ->join('order_state ON `order`.order_id = order_state.order_id','LEFT')
            ->order('or_time desc');
            if($order_state == 'done') {
                $data = $order->where('order.delivery_id = '.$delivery_id.' AND (state = 2 OR state = 7)')->select();
                $this->assign('search_show','false');
            } else {
                $data = $order->where('order.delivery_id = '.$delivery_id.' AND state = 1')->select();
                $this->assign('search_show','false');
            }
        } else if(!empty($openid)) {
            $where .= 'consumer.openid = "'.trim($openid).'"';
            $data = $order->field('goods.name AS goods_name,order.delivery_id,delivery.name AS delivery_name,order.pay_for,order.paied,order.deposit,order.express,order.prompt,consumer.wxname,order.id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,order.exchange,order.exchangeTo,order_state.or_time AS start,order_state.xd_time AS end')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('delivery ON delivery.id = order.delivery_id','LEFT')
            ->join('goods ON goods.id = order.goods_id',"LEFT")
            ->join('order_state ON `order`.order_id = order_state.order_id','LEFT')
            ->order('or_time desc')->where($where)->select();
        } else {
            $data = $order->field('goods.name AS goods_name,order.delivery_id,delivery.name AS delivery_name,order.pay_for,order.paied,order.deposit,order.express,order.prompt,consumer.wxname,order.id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,order.exchange,order.exchangeTo,order_state.or_time AS start,order_state.xd_time AS end')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('delivery ON delivery.id = order.delivery_id','LEFT')
            ->join('goods ON goods.id = order.goods_id',"LEFT")
            ->join('order_state ON `order`.order_id = order_state.order_id','LEFT')
            ->order('or_time desc')
            ->where($where)->limit($page['firstRow'].','.$page['listRows'])->select();
            // 总订单量查询
            $order->field('goods.name AS goods_name,order.delivery_id,delivery.name AS delivery_name,order.pay_for,order.paied,order.deposit,order.express,order.prompt,consumer.wxname,order.id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,order.exchange,order.exchangeTo,order_state.or_time AS start,order_state.xd_time AS end')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('delivery ON delivery.id = order.delivery_id','LEFT')
            ->join('goods ON goods.id = order.goods_id',"LEFT")
            ->join('order_state ON `order`.order_id = order_state.order_id','LEFT')
            ->order('or_time desc')
            ->where($where)->select();
        }
        if($p == 1) {
            $sql = M()->_Sql();
            $total = count($order->query($sql));
            session('total',$total);
            $page = $this->page($pagecount,$total,$parameter,$p);
        }
        $deposit = 0;
        $price = 0;
        $express = 0;
        if($state != '') {
            if($state == 'all') {
                $re = $order->field('order.deposit,order.price,order.express,order.state')->where('order.paied = 1 AND order.pay_for != 2')->select();
            } else if($state == 'finish') {
                $re = $order->field('order.deposit,order.price,order.express,order.state')
                ->where('order.paied = 1 AND order.pay_for != 2 AND (order.state = 2 OR order.state = 5 OR order.state = 7 OR order.state = 9 OR order.state = 10)')->select();
            } else {
                $re = $order->field('order.deposit,order.price,order.express,order.state')->where('order.paied = 1 AND order.pay_for != 2 AND order.state = "'.$state.'"')->select();
            }
        } else {
            $re = $order->field('order.deposit,order.price,order.express,order.state')->where('order.paied = 1 AND order.pay_for != 2 AND order.state = 0')->select();
        }
        foreach ($re as $key => $value) {
            if($value['state'] != 5 && $value['state'] != 7 && $value['state'] != 9 && $value['state'] != 10) {
                $deposit = $deposit + $value['deposit'];
                $price = $price + $value['price'];
                $express = $express + $value['express'];
            } else if($value['state'] == 7 OR $value['state'] == 10) {
                $price = $price + $value['price'];
                $express = $express + $value['express'];
            } else if($value['state'] == 9) {
                $price = $price + $value['price'];
            }
        }
        $money['deposit'] = $deposit;
        $money['price'] = $price;
        $money['express'] = $express;
        $show = $page['show'];
        foreach ($data as $key => $value) {
            switch($value['state']) {
                case 0:
                    $data[$key]['state'] = '未配送';
                    break;
                case 1:
                    $data[$key]['state'] = '配送中';
                    break;
                case 2:
                    $data[$key]['state'] = '配送完成';
                    break;
                case 3:
                    $data[$key]['state'] = '续租';
                    break;
                case 4:
                    $data[$key]['state'] = '申请取消订单';
                    break;
                case 5:
                    $data[$key]['state'] = '取消订单成功';
                    break;
                case 6:
                    $data[$key]['state'] = '申请还货';
                    break;
                case 61:
                    $data[$key]['state'] = '还货中';
                    break;
                case 7:
                    $data[$key]['state'] = '已还货';
                    break;
                case 8:
                    $data[$key]['state'] = '申请转租';
                    break;
                case 9:
                    $data[$key]['state'] = '转租成功';
                    break;
                case 10:
                    $data[$key]['state'] = '转租成功';
                    break;
            }
            $data[$key]['cur_state'] = $value['state'];
        }
        $this->assign('money', $money);
        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }

    public function order_details()
    {
        $this->check_login_power();
        $id = I("get.id");
        $order_id = I("get.order_id");
        if(empty($id)) {
            $order_data = M('order')->field('order.pay_for,goods.stock,order.exchange,order.exchangeTo,order.express,order.prompt,consumer.wxname,order.g_price_id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,goods.ps_price,goods.delivery,goods.name,goods.picture_url,goods.abstract')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('goods ON goods.id = order.goods_id','LEFT')
            ->where('order.order_id='.$order_id)->find();
        } else {
            $order_data = M('order')->field('order.pay_for,goods.stock,order.exchange,order.exchangeTo,order.express,order.prompt,consumer.wxname,order.g_price_id,order.order_id,order.price,order.or_time,order.addr,order.receiver,order.tel,order.state,goods.ps_price,goods.delivery,goods.name,goods.picture_url,goods.abstract')
            ->join('consumer ON consumer.openid = order.user','LEFT')
            ->join('goods ON goods.id = order.goods_id','LEFT')
            ->where('order.id='.$id)->find();
        }
        $order_id = $order_data['order_id'];
        $g_price_id = $order_data['g_price_id'];
        switch($order_data['state']) {
            case 0:
                $order_data['state_title'] = '未配送';
                break;
            case 1:
                $order_data['state_title'] = '配送中';
                break;
            case 2:
                $order_data['state_title'] = '配送完成';
                break;
            case 3:
                $order_data['state_title'] = '续租';
                break;
            case 4:
                $order_data['state_title'] = '申请取消订单';
                break;
            case 5:
                $order_data['state_title'] = '取消订单成功';
                break;
            case 6:
                $order_data['state_title'] = '申请还货';
                break;
            case 61:
                $order_data['state_title'] = '还货中';
                break;
            case 7:
                $order_data['state_title'] = '已还货';
                break;
            case 8:
                $order_data['state_title'] = '申请转租';
                break;
            case 9:
                $order_data['state_title'] = '转租成功';
                break;
            case 10:
                $order_data['state_title'] = '转租成功';
                break;
        }
        $order_state = M('order_state')->field('xd_time,or_time')->where('order_state.order_id = "'.$order_id.'"')->find();
        if($order_data['pay_for'] == '0') {
            $g_price = M('g_price')->field('g_price.time,g_price.price')->where('g_price.id='.$g_price_id)->find();
            $this->assign('g_price', $g_price);
        }
        $this->assign('order_state', $order_state);
        $this->assign('data', $order_data);
        $this->display();
    }

    public function warn_date()
    {
        $power = session('power');
        $id = session('admin_id');
        if($power == 2) {
            $data = M('order')->join('order_state ON `order`.order_id = order_state.order_id','LEFT')->where('receiver = '.$id.' AND DATEDIFF(order_state.xd_time,"'.date('Y-m-d').'") <= 2  AND order.state = 2')->count();
        } else {
            $data = M('order')->join('order_state ON `order`.order_id = order_state.order_id','LEFT')->where('DATEDIFF(order_state.xd_time,"'.date('Y-m-d').'") <= 2  AND order.state = 2')->count();
        }
        echo json_encode($data);
    }

    public function warning()
    {
        $this->check_login_power();
        $data = M('order')
        ->join('consumer ON consumer.openid = order.user','LEFT')
        ->join('delivery ON delivery.id = order.delivery_id','LEFT')
        ->join('goods ON goods.id = order.goods_id',"LEFT")
        ->join('order_state ON `order`.order_id = order_state.order_id','LEFT')
        ->field('DATEDIFF(order_state.xd_time,"'.date('Y-m-d').'") AS rest,goods.name AS goods_name,order.delivery_id,delivery.name AS delivery_name,order.pay_for,order.paied,order.deposit,order.express,order.prompt,consumer.wxname,order.id,order.order_id,order.price,
            order.or_time AS order_time,order.addr,order.receiver,order.tel,"配送完成" AS state ,order_state.xd_time,order_state.or_time')
        // ->order('order.or_time desc')
        ->order('DATEDIFF(order_state.xd_time,"'.date('Y-m-d').'")')
        ->where('order.state = 2 AND pay_for = 0')
        // ->where('DATEDIFF(order_state.xd_time,"'.date('Y-m-d').'") != "" ')
        ->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function add_delivery()
    {
        $this->check_login_power();
        $data = I('post.');
        $data['password'] = md5($data['password']);
        $exist = M('delivery')->where('account = "'.$data['account'].'"')->select();
        if(!empty($exist)) {
            echo '<script>alert("该账号已被注册")</script>';
            echo '<script>window.location.href="./deliverylist"</script>';
            return;
        }
        if($data['id']) {
            $id = M('delivery')->where('id = '.$data['id'])->save($data);
        } else {
            $id = M('delivery')->add($data);
        }
        $this->redirect('deliverylist');
    }

    public function delivery_details()
    {
        $this->check_login_power();
        $id = I('get.id');
        $check = I('get.check');
        $delivery = M('delivery');
        if(!empty($id)) {
            $data = $delivery->where('id = '.$id)->find();
        }
        $this->assign('data',$data);
        $this->assign('check',$check);
        $this->display();
    }

    public function call_delivery()
    {
        $this->check_login_power();
        $order_id = I('post.order_id');
        $delivery_id = I('post.delivery_id');
        $state = M('order')->where('order_id = "'.$order_id.'"')->field('state')->find();
        if($state['state'] == '6' || $state['state'] == '61' ) {
            M('order')->where('order_id = "'.$order_id.'"')->save(['state' => 61,'delivery_id' => $delivery_id]);    
        } else {
            M('order')->where('order_id = "'.$order_id.'"')->save(['state' => 1,'delivery_id' => $delivery_id]);
        }
    }

    public function deliverylist()
    {
        $this->check_login_power();
        $search = I('get.search');
        $order_id = I('get.order_id');
        $delivery = M('delivery');
        $p = I('get.p',1);
        $parameter = '';
        if(empty($search)) {
            $total = $delivery->count();// 查询满足要求的总记录数
            $pagecount = 25;
            $page = $this->page($pagecount,$total,$parameter,$p);
            $data = $delivery->join('`order` ON delivery.id = order.delivery_id','LEFT')
            ->field('delivery.name,delivery.phone,delivery.id,delivery.data_state,order.order_id,order.state')
            ->limit($page['firstRow'],$page['listRows'])->select();
            $this->assign('show',$page['show']);
        } else {
            $data = $delivery->join('`order` ON delivery.id = order.delivery_id','LEFT')
            ->where('name LIKE "%'.$search.'%" OR phone = "'.$search.'"')
            ->field('delivery.name,delivery.phone,delivery.id,delivery.data_state,order.order_id,order.state')
            ->select();
        }
        foreach ($data as $key => $value) {
            $state = $value['state'];
            unset($value['state']);
            $temp[$value['id']]['delivery'] = $value;
            if(!isset($temp[$value['id']]['undone'])) {
                $temp[$value['id']]['undone'] = '0';
                $temp[$value['id']]['done'] = '0';
            }
            if($state == '1') {
                $temp[$value['id']]['undone'] = ++$temp[$value['id']]['undone'];
            } else if($state == '2' || $state == '7') {
                $temp[$value['id']]['done'] = ++$temp[$value['id']]['done'];
            }
        } 
        $this->assign('order_id',$order_id);
        $this->assign('data',$temp);
        $this->display();
    }

    public function ban()
    {
        $this->check_login_power();
        $id = I('post.id');
        $data = M('delivery')->where('id = '.$id)->save(array('data_state'=>'1'));
        echo json_encode($data);
    }

    public function reuse()
    {
        $this->check_login_power();
        $id = I('post.id');
        $data = M('delivery')->where('id = '.$id)->save(array('data_state'=>'0'));
        echo json_encode($data);
    }

    public function delivery_admin()
    {
        $id = session('admin_id');
        $account = session('account');
        $delivery = M('delivery')->where('id = '.$id.' AND account = "'.$account.'"')->find();
        if(empty($delivery)) {
            echo "<script> alert('没有您的配送订单');</script>";
            echo "<script> window.location.href='./main';</script>";
        } else {
            $data = M('order')->join('delivery ON delivery.id = order.delivery_id','LEFT')
            ->field('`order`.*,delivery.name,delivery.phone')->where('delivery_id = '.$id.' AND (state = 1 OR state = 61)')->select();
            foreach ($data as $key => $value) {
                switch($value['state']) {
                    case 0:
                        $data[$key]['state'] = '未配送';
                        break;
                    case 1:
                        $data[$key]['state'] = '配送中';
                        break;
                    case 2:
                        $data[$key]['state'] = '配送完成';
                        break;
                    case 3:
                        $data[$key]['state'] = '续租';
                        break;
                    case 4:
                        $data[$key]['state'] = '申请取消订单';
                        break;
                    case 5:
                        $data[$key]['state'] = '取消订单成功';
                        break;
                    case 6:
                        $data[$key]['state'] = '申请还货';
                        break;
                    case 61:
                        $data[$key]['state'] = '还货中';
                        break;
                    case 7:
                        $data[$key]['state'] = '已还货';
                        break;
                    case 8:
                        $data[$key]['state'] = '申请转租';
                        break;
                    case 9:
                        $data[$key]['state'] = '转租成功';
                        break;
                    case 10:
                        $data[$key]['state'] = '转租成功';
                        break;
                }
                $data[$key]['cur_state'] = $value['state'];
            }
            $this->assign('data',$data);
        }

        $this->display();
    }

    public function admin_role()
    {
        $this->check_login_power();
       $this->display();
    }

    public function admin_details() 
    {
        $this->check_login_power();
        $id = I('post.id');
        if(empty($data)) {
            $data = M('admin')->where('id = '.$id)->find();
        }
        $this->assign('data',$data);
        $this->display();
    }

    public function add_admin()
    {
        $this->check_login_power();
        $data = I('post.');
        $data['pwd'] = md5($data['pwd']);
        $exist = M('admin')->where('name = "'.$data['name'].'"')->select();
        if(!empty($exist)) {
            echo '<script>alert("该账号已被注册")</script>';
            echo '<script>window.location.href="./deliverylist"</script>';
            return;
        } else {
            M('admin')->add($data);
        }
        $this->redirect('adminlist');
    }

    public function area()
    {
        $this->check_login_power();
        $data = M('area')->find();
        $this->assign('data',$data);
        $this->display();
    }

    public function update_area()
    {
        $this->check_login_power();
        $data = I('post.');
        if(empty(M('area')->select())) {
            M('area')->add(array('id' => '1'));
        }
        $arr = ['siming','huli','jimei','haicang','xiangan','tongan'];
        foreach ($arr as $value) {
            if(!isset($data[$value])) {
                $data[$value] = '0';
            }
        }
        M('area')->where('id = 1')->save($data);
        $this->redirect('area');
    }


    public function search_new()
    {
        $this->check_login_power();
        $sql = "SELECT count(id) AS prompt FROM `order` WHERE prompt = 1";
        $prompt = M('order')->field('count(id) AS prompt')->where('paied = 1 AND prompt = 1')->find();
        $paied = M('order')->field('count(id) AS paied')->where('paied = 1')->find();
        $prompt = $prompt['prompt'];
        $paied = $paied['paied'];
        $data = ['prompt' => $prompt, 'paied' => $paied];
        echo json_encode($data);
    }

    public function wx_order($order_id)
    {
        $this->check_login_power();
        $data = $this->check_wx_order($order_id,'true');
        $this->assign('data',$data);
        $this->display();
    }

    public function check_wx_order($order_id)
    {
        $conf = new \WxPayConf_pub;
        $helper = new \Common_util_pub;
        $order = M('order')->join('goods ON goods.id = order.goods_id','LEFT')
        ->where('order_id = "'.$order_id.'"')->field('user,deposit,out_trade_no,ps_price,`order`.price,delivery,`order`.pay_for,order.paied')->find();
        $deposit = $order['deposit'];
        $openid = $order['user'];
        $deposit_order = M('order')->where('deposit = '.$deposit.' AND pay_for = 2 AND user = "'.$openid.'"')->find();
        $out_trade_no = $deposit_order['out_trade_no'];
        $jssdk = new \Jssdk($conf::APPID, $conf::APPSECRET);
        $wx = $jssdk->getSignPackage();
        $xml = '
        <xml>
        <appid>'.$conf::APPID.'</appid>
        <mch_id>'.$conf::MCHID.'</mch_id>
        <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        <out_trade_no>'.trim($out_trade_no).'</out_trade_no>
        </xml>';
        $arr = $helper->xmlToArray($xml);
        $sign = $helper->getSign($arr);
        $xml = '
        <xml>
        <appid>'.$conf::APPID.'</appid>
        <mch_id>'.$conf::MCHID.'</mch_id>
        <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        <out_trade_no>'.trim($out_trade_no).'</out_trade_no>
        <sign>'.$sign.'</sign>
        </xml>';
        $data = $helper->postXmlCurl($xml,'https://api.mch.weixin.qq.com/pay/orderquery');
        $data = $helper->xmlToArray($data);
        if($data['trade_state'] == "REFUND") {
            $data = $helper->postXmlCurl($xml,'https://api.mch.weixin.qq.com/pay/refundquery');
            $data = $helper->xmlToArray($data);
        }
        $data['paied'] = $order['paied'];
        $data['pay_for'] = $order['pay_for'];
        $data['price'] = $order['price'];
        $data['ps_price'] = $order['ps_price'];
        $data['delivery'] = $order['delivery'];
        $data['out_trade_no'] = $out_trade_no;
        return $data;
    }

//直接退款到微信账户
    public function refund($order_id,$flag)
    {
        $conf = new \WxPayConf_pub;
        $helper = new \Common_util_pub;
        $data = $this->check_wx_order($order_id);
        $price = $data['price'];
        $ps_price = $data['ps_price'];
        $delivery = $data['delivery'];
        $pay_for = $data['pay_for'];
        $paied = $data['paied'];
        if($pay_for == '1' && $flag == 'back_goods' OR $paied == '0') {
            M('order')->where('order_id = "'.$order_id.'"')->delete();
            return 'success';
        }
        $out_trade_no = $data['out_trade_no'];
        $jssdk = new \Jssdk($conf::APPID, $conf::APPSECRET);
        $wx = $jssdk->getSignPackage();
        if($data['return_code'] == 'SUCCESS') {
            // if($flag == 'back_goods') {
            //     $back_money = (floatval($price))*100;
            // } else if($flag == 'back_deposit') {
            //     $back_money = (floatval($ps_price) - floatval($delivery))*100;
            // } else if($flag == 'same') {
            //     $back_money = (floatval($ps_price))*100;
            // } else if($flag == 'diff') {
            //     $back_money = (floatval($ps_price) - floatval($delivery))*100;
            // }
            $total_fee = $data['total_fee'];
            $openid = $data['openid'];
            $transaction_id = $data['transaction_id'];
            // if($total_fee == floatval($price)*100) {
                $out_refund_no = 'refu'.time().time().time().time().time().time();
                $xml = '
                <xml>
                <appid>'.$conf::APPID.'</appid>
                <mch_id>'.$conf::MCHID.'</mch_id>
                <nonce_str>'.$wx['nonceStr'].'</nonce_str>
                <out_trade_no>'.trim($out_trade_no).'</out_trade_no>
                <out_refund_no>'.trim($out_refund_no).'</out_refund_no>
                <total_fee>'.$total_fee.'</total_fee>
                <refund_fee>'.$total_fee.'</refund_fee>
                </xml>';
                $arr = $helper->xmlToArray($xml);
                $sign = $helper->getSign($arr);
                $xml = '
                <xml>
                <appid>'.$conf::APPID.'</appid>
                <mch_id>'.$conf::MCHID.'</mch_id>
                <nonce_str>'.$wx['nonceStr'].'</nonce_str>
                <out_trade_no>'.trim($out_trade_no).'</out_trade_no>
                <out_refund_no>'.trim($out_refund_no).'</out_refund_no>
                <total_fee>'.$total_fee.'</total_fee>
                <refund_fee>'.$total_fee.'</refund_fee>
                <sign>'.$sign.'</sign>
                </xml>';
                $data = $helper->postXmlSSLCurl($xml,'https://api.mch.weixin.qq.com/secapi/pay/refund');
                $data = $helper->xmlToArray($data);
                $save = array('out_refund_no' => $out_refund_no);
                M('order')->where('order.order_id = "'.$order_id.'"')->save($save);
                if($data['result_code'] == 'FAIL' || $data['return_code'] == 'FAIL') {
                    if(!empty($data['err_code_des'])) {
                        return $data['err_code_des'];
                    } else {
                        return $data['return_msg'];
                    }
                } else {
                    return 'success';
                }
            // }
        }
    }

    public function update_date()
    {
        $this->check_login_power();
        $content = I('post.');
        $data['order_id'] = $content['order_id'];
        if(!empty($content['xd_time'])) {
            $data['xd_time'] = $content['xd_time'];
        } else {
            $data['or_time'] = $content['or_time'];
        }
        M('order_state')->where('order_id = "'.$data['order_id'].'"')->save($data);
    }

    public function withdraw()
    {
        $this->check_login_power();
        $data = M('withdraw')->join('consumer ON withdraw.user = consumer.openid','LEFT')->field('withdraw.*,consumer.wxname,consumer.openid')->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function withdraw_deposit()
    {
        $this->check_login_power();
        $conf = new \WxPayConf_pub;
        $helper = new \Common_util_pub;
        $jssdk = new \Jssdk($conf::APPID, $conf::APPSECRET);
        $out_trade_no = C('WxPayConf_pub.APPID').$timeStamp;
        $wx = $jssdk->getSignPackage();
        $id = I('get.id');
        $withdraw = M('withdraw')->where('id = '.$id)->find();
        $openid = $withdraw['user'];
        $back_money = $withdraw['money']*100;
        $withdraw_money = $withdraw['money'];
        $consumer = M('consumer')->where('openid = "'.$openid.'"')->find();
        // $xml = '
        // <xml>
        // <appid>'.$conf::APPID.'</appid>
        // <mch_id>'.$conf::MCHID.'</mch_id>
        // <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        // <partner_trade_no>'.$out_trade_no.'</partner_trade_no>
        // </xml>';
        $xml = '
        <xml>
        <mch_appid>'.$conf::APPID.'</mch_appid>
        <mchid>'.$conf::MCHID.'</mchid>
        <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        <partner_trade_no>'.$out_trade_no.'</partner_trade_no>
        <openid>'.$openid.'</openid>
        <check_name>NO_CHECK</check_name>
        <amount>'.$back_money.'</amount>
        <desc>退款</desc>
        <spbill_create_ip>120.78.71.119</spbill_create_ip>
        </xml>';
        $arr = $helper->xmlToArray($xml);
        $sign = $helper->getSign($arr);
        // $xml = '
        // <xml>
        // <appid>'.$conf::APPID.'</appid>
        // <mch_id>'.$conf::MCHID.'</mch_id>
        // <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        // <partner_trade_no>'.$out_trade_no.'</partner_trade_no>
        // <sign>'.$sign.'</sign>
        // </xml>';
        $xml = '
        <xml>
        <mch_appid>'.$conf::APPID.'</mch_appid>
        <mchid>'.$conf::MCHID.'</mchid>
        <nonce_str>'.$wx['nonceStr'].'</nonce_str>
        <partner_trade_no>'.$out_trade_no.'</partner_trade_no>
        <openid>'.$openid.'</openid>
        <check_name>NO_CHECK</check_name>
        <amount>'.$back_money.'</amount>
        <desc>退款</desc>
        <spbill_create_ip>120.78.71.119</spbill_create_ip>
        <sign>'.$sign.'</sign>
        </xml>';
        // $data = $helper->postXmlSSLCurl($xml,'https://api.mch.weixin.qq.com/mmpaymkttransfers/gettransferinfo');
        $data = $helper->postXmlSSLCurl($xml,'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers');
        $data = $helper->xmlToArray($data);
        if($data['result_code'] == 'FAIL') {
            echo json_encode($data['return_msg']);
        } else {
            $cur_money = $consumer['money'];
            $rest_money = floatval($cur_money) - floatval($withdraw_money);
            M('consumer')->where('openid = "'.$openid.'"')->save(['money' => $rest_money]);
            $save = ['state' => '1','time' => date('Y-m-d H:i:s')];
            M('withdraw')->where('id = '.$id)->save($save);
            echo json_encode($data['return_msg']);
        }
    }

    public function withdraw_money()
    {
        $id = I('get.id');
        // $withdraw = M('withdraw')->where('id = '.$id)->find();
        $time = date('Y-m-d H:i:s');
        $arr = ['state' => 1,'time' => $time];
        M('withdraw')->where('id = '.$id)->save($arr);
        echo json_encode('success');
    }

    public function refund_purse($order_id,$mes)
    {
        $consumer = M('consumer');
        $data = M('order')->where('order_id = "'.$order_id.'"')->field('user,price,deposit,express')->find();
        $price = $data['price'];
        $deposit = $data['deposit'];
        $delivery = $data['express'];
        if($mes == 'back_goods') {
            $refund_type = '0';
            $refund_money = floatval($price);
        } else if($mes == 'back_deposit') {
            $refund_type = '1';
            $refund_money = floatval($deposit);
        } else if($mes == 'same') {
            $refund_type = '2';
            $refund_money = floatval($deposit) + floatval($delivery);
        } else if($mes == 'diff') {
            $refund_type = '2';
            $refund_money = floatval($deposit);
        }
        $time = date('Y-m-d H:i:s');
        $out_refund_no = time();
        $openid = $data['user'];
        $rest = $consumer->where('openid = "'.$openid.'"')->field('money')->find();
        $money = floatval($rest['money'] + $refund_money);
        $arr = ['order_id' => $order_id, 'out_refund_no' => $out_refund_no, 'refund_money' => $refund_money, 'refund_type' => $refund_type, 'time' => $time];
        M('refund')->add($arr);
        $consumer->where('openid = "'.$openid.'"')->save(['money' => $money]);
        return 'success';
    }


    public function change_state()
    {
        // $this->check_login_power();
        $content = I('post.');
        $data['state'] = $content['state'];
        $data['order_id'] = $content['order_id'];
        $order = M('order')->where('order_id ="'.$data['order_id'].'"')->find();
        if($data['state'] == '5') {
            $arr = $this->refund($data['order_id'],'back_goods');
            // $arr = $this->refund_purse($data['order_id'],'back_goods');
            if($arr == 'success' || $arr = '订单已全额退款') {
                M('order')->where('order_id = "'.$data['order_id'].'"')->save($data);    
            }
            echo json_encode($arr);
        }else if($data['state'] == '7') {
            $arr = $this->refund($data['order_id']);
            // $arr = $this->refund_purse($data['order_id'],'back_deposit');
            if($order['pay_for'] == '0') {
                $datast = M('order')->where('order_id = "'.$data['order_id'].'"')->field('user,g_price_id')->find();
                $g_data = M('g_price')->where('id = '.$datast['g_price_id'])->field('time')->find();
                $or_time = date("Y-m-d",strtotime("+".$g_data['time']." day"));
                $save = ['or_time' => date('Y-m-d'), 'xd_time' => $or_time];
                M('order_state')->where('order_id = "'.$data['order_id'].'"')->save($save);
            }
            if($arr == 'success') {
                M('order')->where('order_id = "'.$data['order_id'].'"')->save($data);    
            }
            echo json_encode($arr);
        } else if($data['state'] == '10') {
            $arr = $this->refund($data['order_id']);
            // $arr = $this->refund_purse($data['order_id'],'same');
            if($arr == 'success') {
                M('order')->where('order_id = "'.$data['order_id'].'"')->save($data);    
            }
            echo json_encode($arr);
        } else if($data['state'] == '9') {
            $arr = $this->refund($data['order_id']);
            // $arr = $this->refund_purse($data['order_id'],'diff');
            if($arr == 'success') {
                M('order')->where('order_id = "'.$data['order_id'].'"')->save($data);    
            }
            echo json_encode($arr);
        } else {
            if($data['state'] == 2) {
                if($order['pay_for'] == '0') {
                    $datast = M('order')->where('order_id = "'.$data['order_id'].'"')->field('user,g_price_id')->find();
                    $g_data = M('g_price')->where('id = '.$datast['g_price_id'])->field('time')->find();
                    $or_time = date("Y-m-d",strtotime("+".$g_data['time']." day"));
                    $arr = ['or_time' => date('Y-m-d'), 'xd_time' => $or_time];
                    M('order_state')->where('order_id = "'.$data['order_id'].'"')->save($arr);
                }
            }
            M('order')->where('order_id = "'.$data['order_id'].'"')->save($data);
            echo json_encode('success');
        }
    }


    public function viplist()
    {
        $this->check_login_power();
        $db = M("consumer");
        // $map['status']  = array('egt',4);
        //$count = count($db->where($map)->select());
        //print_r($count);exit();
        $count      = $db->count();// 查询满足要求的总记录数
        // $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        // $show       = $Page->show();// 分页显示输出
        $pagecount = 10;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        //$list = $db->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        //print_r($list);exit();
        $list = $db->order('id')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('data',$list);
        $this->assign('page',$show);
        $this->display();
/*
        //$User = M('User'); // 实例化User对象
        $count      = $User->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
*/
    }

    public function vipdetails() 
    {
        $this->check_login_power();
        $id=I('get.id');
        $information = M('consumer')->where("id='$id'")->find();
        $openid = $information['openid'];
        $coupon_data = M('user_coupon')->where("user_openid = '".$openid."'")->select();
        $address = M('address')->where('openid ="'.$openid.'"')->select();
        $this->assign('coupon_data',$coupon_data);
        $this->assign('address',$address);
        $this->assign('re',$information);
        $this->display();
    }

    public function search()
    {
        $this->check_login_power();
        $word = I('post.word');
        $word = "%".trim($word)."%";
        //print_r($word);exit();
        $map['wxname'] = array('like',$word);
        $db = M('consumer');
    
        $count = count($db->where($map)->select());
        //print_r($count);exit();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->where($map)->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        //print_r($list);exit();
        $this->assign('data',$list);
        $this->assign('page',$show);
        $this->display();
    }

    public function goodslist()
    {  
        $this->check_login_power();
        $db = M("goods");
        $map['status']  = array('egt',4);
        $count = count($db->where($map)->select());
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->where($map)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('data',$list);
        $this->assign('page',$show);
        $this->display();
    }

    public function add_goods() 
    {
        $this->check_login_power();
        $data = json_decode($_POST['data']);
        $price_way = json_decode($_POST['priceWay']);
        if(!empty($data)) {
            $goods_id = M('goods')->data($data)->add();
            foreach ($price_way as $key => $value) {
                if(!empty($value->time) && !empty($value->price)) {
                    $value->g_id = $goods_id;
                    M('g_price')->data($value)->add();
                }
            }
        } else {
            $this->display();
        }
    }

    public function g_price()
    {
        $this->check_login_power();
        $data = $_POST['data'];
        $goods_id = $_POST['goods_id'];
        $data = json_decode($data);
        M('g_price')->where('g_id = '.$goods_id)->delete();
        foreach ($data as $key => $value) {
            $insert['time'] = $value->time;
            $insert['price'] = $value->price;
            $insert['g_id'] = $goods_id; 
            M('g_price')->add($insert);
        }
    }

    public function about_us()
    {
        $this->check_login_power();
        $db=M('about_us');
        $data=$db->where('id=1')->find();
        $this->assign('data',$data);
        $this->display();
    }

    public function user_coupon()
    {
        $this->check_login_power();
        $db = M('user_coupon');
        $count = count($db->select());
        $search = I('post.'); 
        $person = I('get.');
        if(!empty($person['share'])) {
            $db->where('share_openid = "'.$person['share'].'"');
        } else if(!empty($person['user'])) {
            $db->where('user_openid = "'.$person['user'].'"');
        } else if(!empty($search)) {
            if(!empty($search['word'])) {
                $db->where('coupon.coupon_name LIKE "%'.trim($search['word']).'%" OR (share.wxname LIKE "%'.trim($search['word']).'%" OR user.wxname LIKE "%'.trim($search['word']).'%")');
            } 
        } else {
            $pagecount = 20;
            $page = new \Think\Page($count , $pagecount);
            $page->parameter = $row; //此处的row是数组，为了传递查询条件
            $page->setConfig('first','首页');
            $page->setConfig('prev','上一页');
            $page->setConfig('next','下一页');
            $page->setConfig('last','尾页');
            $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
            $show = $page->show();
            $db->limit($page->firstRow.','.$page->listRows);
            $this->assign('page',$show);
        }
        $list = $db->join('consumer AS user ON user_coupon.user_openid = user.openid','LEFT')
        ->join('consumer AS share ON user_coupon.share_openid = share.openid','LEFT')
        ->join('coupon ON coupon.id = user_coupon.coupon_id','LEFT')
        ->field('user_coupon.*,coupon_name,user.wxname AS user,share.wxname AS share,coupon.deadline')
        ->order('user_coupon.date desc')->select();
        $this->assign('data',$list);
        $this->display();
    }

    public function coupon()
    {
        $this->check_login_power();
        $db = M("coupon");
        $count = count($db->select());
        $pagecount = 10;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('data',$list);
        $this->assign('page',$show);
        $this->display();
    }

    public function coupon_details() 
    {
        $this->check_login_power();
        $id = I('get.id');
        if(!empty($id)) {
            $data = M('coupon')->where('id = '.$id)->find();
        } 
        $this->assign('data',$data);
        $this->display();
    }

    public function add_coupon($value='')
    {
        $this->check_login_power();
        $data = I('post.');
        $id = $data['id'];
        if(empty($id)) {
            $re = M('coupon')->add($data);
            if($data['status'] == 'N') {
                M('coupon')->where('id != '.$re.' AND stage = '.$data['stage'])->save(array('status' => 'D'));    
            }
        } else {
            if($data['status'] == 'N') {
                M('coupon')->where('id != '.$id.' AND stage = '.$data['stage'])->save(array('status' => 'D'));    
            }
            M('coupon')->where('id = '.$id)->save($data);
        }
        $this->redirect('index/coupon');
    }


    public function update_pwd()
    {
        $this->check_login_power();
        $id = I('post.id');
        $input = I('post.orign_input');
        $content = I('post.');
        $data = M('admin')->where("id=$id")->find();
        $orign = $data['pwd'];
        $input = md5($input);
        if($orign == $input) {
            if($content['pwd1'] != '' && $content['pwd2'] != '') {
                if($content['pwd1'] == $content['pwd2']) {
                    $new_pwd = md5($content['pwd1']);
                    $save = array('pwd' => $new_pwd);
                    M('admin')->where("id=$id")->save($save);
                    echo json_encode('success');
                } else {
                    echo json_encode('diff');
                }
            } else {
                echo json_encode('emp');
            }
        } else {
            echo json_encode('error');
        }
    }

    public function change_pwd()
    {
        $this->check_login_power();
        $id = I('get.id');
        $data = M('admin')->where("id=$id")->find();
        $this->assign('data',$data);
        $this->display();
    }

    public function adminlist()
    {
        $this->check_login_power();
        $user = M('admin');
        $data = $user->select();
        $this->assign('data',$data);
        $this->display();   
    }

    public function update_admin()
    {
        $this->check_login_power();
        $data = I('post.');
        M('admin')->where('id = '.$data['id'])->save($data);
        $this->redirect('index/adminlist');
    }

    public function ico()
    {   
        $this->check_login_power();
        $db=M('banner');                       
        $data=$db->select();   
        //$map['id']  = array('egt',1);
        $count = count($db->select());
        //print_r($count);exit();
        $pagecount = 5;
        $page = new \Think\Page($count , $pagecount);
        $page->parameter = $row; //此处的row是数组，为了传递查询条件
        $page->setConfig('first','首页');
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page->setConfig('last','尾页');
        $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
        $show = $page->show();
        $list = $db->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        //print_r($list);exit();
        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }

    public function add_banner()
    {
        $this->check_login_power();
        $data = I('post.');
        if(empty($data)) {
            $this->display();
        } else {
            M('banner')->add($data);
            $this->redirect('ico');
        }
    }

    public function upload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        // $upload->maxSize   =     314572800000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        // $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName = 'time';     //命名方式
        // $info   =   $upload->upload();
        $key = array_keys($_FILES)[0];
        $info = $upload->uploadOne($_FILES[$key]);
        $img_name = '/Uploads/'.$info['savepath'].$info['savename'];
        echo json_encode($img_name);
    }

    public function delbanner($value='')
    {
        $this->check_login_power();
        $id=I('get.');
        //print_r($id);exit();
        $id=$id['id'];
        $banner=M('banner');
        $result = $banner->where("id=$id")->delete();  
       // print_r($result); 
        if ( false !== $result ){   
        $this->success('删除成功！');   
        }else{   
        $this->error('删除失败！');   
        }
    }

    public function re_banner($value='')
    {
        $this->check_login_power();
        $data=I('POST.');
        $dba=M('about_us');
        //print_r($data);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     314572800000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     '/Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName  = 'time';     //命名方式
        //$data = $info['photo']['name'];
        $info   =   $upload->upload();

        $data['id']=1;
         if ($info=='') {
            $dba->save($data);  
        } else {
            $data['tupian']=$info ['photo']['savepath'].$info ['photo']['savename'];
            $dba->where("id=1")->save($data);
        }
        $this->redirect('about_us');
    }


    public function details_banner()
    {
        $this->check_login_power();
        $id=I('get.id');
        //print_r($id);
        $banner=M('banner');
        $data=$banner->where("id=$id")->find();
        //print_r($data);
        $this->assign('data',$data);
        //$this->assign('data',$data);
        $this->display();
    }

    public function xg_banner($value='')
    {
        $this->check_login_power();
        $data['name']=I('post.name');
        $id=I('post.id');
        $img_name = I('post.file_path');
        $db=M('banner');
        if (empty($img_name)) {
            $db->where("id='$id'")->save($data);  
        } else {
            $data['imgurl']=$img_name;
            $db->where("id='$id'")->save($data);
        }
        $this->redirect('ico');
    }


    public function goodstails()
    {
        $this->check_login_power();
        $id = I('get.id');
        $db = M('goods');
        $data = $db->where("id=$id")->find();
        $g_price = M('g_price')->where('g_price.g_id = "'.$id.'"')->select();
        $num = M('order')->where('goods_id = '.$id)->field('count(id) AS count')->find();
        $rest = intval($data['stock']) - intval($num['count']);
        $data['rest'] = $rest;
        $this->assign('g_price',$g_price);
        $this->assign('data',$data);
        $this->display();
    }


    public function del()
    {
        $this->check_login_power();
        $key = I('get.key');
        $id = I('get.id');
        $db = M($key);
        $db->where("id=$id")->delete();
        if($key == 'goods') {
            $this->redirect('index/goodslist');
        }
        if($key == 'coupon') {
            $this->redirect('index/coupon');
        }
        if($key == 'admin') {
            $this->redirect('index/adminlist');
        }
        // if ( false !== $result ){   
        // }else{   
        // $this->error('删除失败！');   
        // }
    }

    public function re_goods()
    {
        $this->check_login_power();
        $data=I('post.');
        $M = M('goods')->where('id='.$data["id"])->save($data);
        $this->redirect('index/goodslist');
    }




























}

?>

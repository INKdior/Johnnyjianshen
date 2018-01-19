<?php
namespace Admin\Controller;
use Think\Controller;
class AddController extends Controller {

    public function upload(){

        //$data['name']=I('post.name');
        //$db=M('banner');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     314572800000 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName = 'time';     //命名方式
        //$data = $info['photo']['name'];

        $info   =   $upload->upload();
        $img_name=$info ['photo']['savepath'].$info ['photo']['savename'];
        return $img_name;
    }

    public function add_coupon()
    {
       
      	$this->display();
    }

    public function addcoupon()
    {
        $data['price']='66';
        M('coupon')->data($data)->add();
    
    }
    public function add_goods($value='')
    {
    	$data = I('post.');
        $goods = M('goods');
        $re = $goods->data($data)->add();
        $this->redirect('index/goodslist');
        // $this->redirect('index/goodslist', array('cate_id' => 2), 0, '页面跳转中...');
    }

}
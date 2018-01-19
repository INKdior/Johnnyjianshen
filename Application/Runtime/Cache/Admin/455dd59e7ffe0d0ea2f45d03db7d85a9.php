<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>达康健身器材共享</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- basic styles -->
    <link rel="stylesheet" href="/Public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/font-awesome.min.css" />
    <script src="/Public/home/js/jquery-1.12.2.min.js"></script>
    <!--[if IE 7]>
      <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!-- page specific plugin styles -->
    <!-- fonts -->
     <script type="text/javascript">
    //   window.jQuery || document.write("<script src='/Public/assets/js/jquery-2.0.3.min.js'>"+"<"+"script>");
     </script>
    <script type="text/javascript">
      // if("ontouchend" in document) document.write("<script src='/Public/assets/js/jquery.mobile.custom.min.js'>"+"<"+"script>");
    </script>
    <script src="/Public/admin/laydate/laydate.js"></script> 
    <script src="/Public/home/js/jquery.ui.widget.js"></script>
    <script src="/Public/home/js/jquery.iframe-transport.js"></script>
    <script src="/Public/home/js/jquery.fileupload.js"></script>
    <script src="/Public/assets/js/bootstrap.min.js"></script>
    <script src="/Public/assets/js/typeahead-bs2.min.js"></script>
    <script src="/Public/assets/js/ace-elements.min.js"></script>
    <script src="/Public/assets/js/ace.min.js"></script>
    <!-- ace styles -->
    <link rel="stylesheet" href="/Public/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/ace-skins.min.css" />
    <script src="/Public/assets/js/ace-extra.min.js"></script>
    <link rel="stylesheet" href="/Public/css/Iframe.css" />
    <link rel="shortcut icon" href="/Public/bitbug_favicon.ico" />

  </head>

  <body>
    <!-- 头部DIV -->
    <div class="navbar navbar-default" id="navbar">
      <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
      </script>

      <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
          <a href="#" class="navbar-brand">
            <small>
              <i class=""></i>
         <!--       <img src="/Public/img/logo.png" > -->
            </small>
          </a><!-- /.brand -->
      </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">

            <li class="light-blue" height="70" width="458">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                
                <span class="user-info">
                  <small>欢迎光临,</small>
                  ADMIN
                </span>

                <i class=""></i>
              </a>

              <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                  <a href="<?php echo U('index/savepwd')?>">
                    <i class="icon-user"></i>
                    修改密码
                  </a>
                </li>

                <li class="divider"></li>

                <li>
                  <a href="<?php echo U('index/index')?>">
                    <i class="icon-off"></i>
                    退出
                  </a>
                </li>
              </ul>
            </li>
          </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
      </div><!-- /.container -->
    </div>
   <!--  左边菜单栏 -->
    <div class="main-container" id="main-container">
      <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
      </script>

      <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
          <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
          <script type="text/javascript">
            try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
          </script>

          <div class="sidebar-shortcuts" id="sidebar-shortcuts">

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
              <span class="btn btn-success"></span>

              <span class="btn btn-info"></span>

              <span class="btn btn-warning"></span>

              <span class="btn btn-danger"></span>
            </div>
          </div><!-- #sidebar-shortcuts -->

          <ul class="nav nav-list">

            <li class="active">
              <a href="">
                <i class=""></i>
                <span class="menu-text"> 达康健身器材共享 </span>
              </a>
            </li>

            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class="menu-text"> 用户管理 </span>

                <b class="">∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/viplist')?>">
                    <i class="icon-double-angle-right"></i>
                    微信人员管理
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class="menu-text"> 系统修改 </span>

                <b>∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/ico')?>">
                    <i class="icon-double-angle-right"></i>
                    轮播图修改
                  </a>
                </li>

                <li>
                  <a href="<?php echo U('index/about_us')?>">
                    <i class="icon-double-angle-right"></i>
                    关于我们
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class="menu-text"> 提现管理 </span>

                <b >∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/withdraw')?>">
                    <i class="icon-double-angle-right"></i>
                    客户提现
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class=""> 配送管理 </span>

                <b>∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('admin/index/delivery_admin');?>">
                    <i class="icon-double-angle-right"></i>
                    配送后台
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class=""> 订单管理 </span>
                <b>∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/order')?>">
                    <i class="icon-double-angle-right"></i>
                    订单列表
                  </a>
                </li>
                <li>
                  <a href="<?php echo U('index/area')?>">
                    <i class="icon-double-angle-right"></i>
                    配送区域
                  </a>
                </li>
                <li>
                  <a href="<?php echo U('index/warning')?>">
                    <i class="icon-double-angle-right"></i>
                    到期订单
                  </a>
                </li>
              </ul>
            </li>

            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class=""> 产品管理 </span>

                <b>∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/goodslist')?>">
                    <i class="icon-double-angle-right"></i>
                    产品列表
                  </a>
                </li>

              </ul>
            </li>
            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class=""> 优惠卷管理 </span>

                <b>∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/coupon')?>">
                    <i class="icon-double-angle-right"></i>
                    优惠卷列表
                  </a>
                </li>
                <li>
                  <a href="<?php echo U('index/user_coupon')?>">
                    <i class="icon-double-angle-right"></i>
                    客户优惠卷列表
                  </a>
                </li>

              </ul>
            </li>
            <li>
              <a href="#" class="dropdown-toggle">
                <i class=""></i>
                <span class="menu-text"> 管理员 </span>

                <b >∨</b>
              </a>

              <ul class="submenu">
                <li>
                  <a href="<?php echo U('index/adminlist')?>">
                    <i class="icon-double-angle-right"></i>
                    管理员列表
                  </a>
                </li>
                <li>
                  <a href="<?php echo U('index/deliverylist')?>">
                    <i class="icon-double-angle-right"></i>
                    配送员列表
                  </a>
                </li>
              </ul>
            </li>
          </ul><!-- /.nav-list -->

      
        </div>

    <!--   右边工具栏  -->
    <div class="ace-settings-container" id="ace-settings-container">
          <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
            <i class="icon-cog bigger-150"></i>
          </div>

          <div class="ace-settings-box" id="ace-settings-box">
              <div>
                <div class="pull-left">
                  <select id="skin-colorpicker" class="hide">
                    <option data-skin="default" value="#438EB9">#438EB9</option>
                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                  </select>
                </div>
                <span>&nbsp; 选择皮肤</span>
              </div>


              <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
                <label class="lbl" for="ace-settings-rtl">切换到左边</label>
              </div>

              <div>
                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
                <label class="lbl" for="ace-settings-add-container">
                  切换窄屏
                  <b></b>
                </label>
              </div>
          </div>
    </div>
    <!DOCTYPE html>
    <video id='video' src="/Public/admin/static/14.mp3" style="display: none;"></video>
<div id="frameBord" name="frameBord"><div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo U('admin/index/main');?>">首页</a>
            </li>
            <li class="active">订单表</li>
        </ul><!-- .breadcrumb -->
    </div>
    <br>
    <!-- <div class="add_cp"> -->
        <form method="get"  action="<?php echo U('index/order');?>" onsubmit="" id='subform'>
            <span style="margin:20px">
                <label>选择开始时间</label>
                <input type="text" name="start" id="start" value="">&nbsp;&nbsp;&nbsp;
                <label>选择结束时间</label>
                <input type="text" name="end" id="end" value="">
            </span>
            <span style="float:right;margin-right: 10%">总押金：<?php echo ($money['deposit']); ?>&nbsp;&nbsp;总租金：<?php echo ($money['price']); ?>&nbsp;&nbsp;总配送费：<?php echo ($money['express']); ?></span>
            <br><br>
            <span style="margin:20px">
                客户催单&nbsp;<input name="prompt" type="checkbox" value="1">
            </span>
            <br><br>
            <span style="margin:10px">
                <span style="margin:10px">
                    <input type="radio" name='state' checked value="0">新订单
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="1">配送中
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="2">使用中
                </span>
                <!--  <span style="margin:10px">
                    <input type="radio" name='state' value="3">申请续租
                </span> -->
                <span style="margin:10px">
                    <input type="radio" name='state' value="4">申请取消订单
                </span>
               <!--  <span style="margin:10px">
                    <input type="radio" name='state' value="5">取消订单成功
                </span> -->
                <span style="margin:10px">
                    <input type="radio" name='state' value="6">申请还货
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="61">还货中
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="7">已还货
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="8">申请转租
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="9">转租成功
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="10">购买订单
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="finish">已完成
                </span>
                <span style="margin:10px">
                    <input type="radio" name='state' value="all">全部
                </span>
                <span style="margin:10px">
                    <input class="btn btn-default btn-xs sub" type="button" value="搜索" />
                </span>
            </span>
        </form>
    <!-- </div> -->
    <div class="table_con">
        <table>
            <tr class="tb_title">
                <td>订单号</td>
                <td>品名</td>
                <td>状态</td>
                <td>催单</td>
                <td>支付方式</td>
                <td>租金</td>
                <td>押金</td>
                <td>配送费</td>
                <td>来自转租</td>
                <td>转租给</td>
                <td>下单时间</td>
<!--                 <td>开始日期</td>
                <td>到期日期</td>
 -->                <td>用户</td>
                <!-- <td>收货人</td> -->
                <!-- <td>送货地址</td> -->
                <td>操作</td>
                <td>详情</td>
            </tr>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>     
                    <td id="order_id" value="<?php echo ($vo['order_id']); ?>"><center><?php echo ($vo['order_id']); ?></center></td>
                    <td value="<?php echo ($vo['goods_name']); ?>"><center><?php echo ($vo['goods_name']); ?></center></td>
                    <td value="<?php echo ($vo['cur_state']); ?>" id="state"><center><?php echo ($vo['state']); ?></center></td>
                    <td value="<?php echo ($vo['prompt']); ?>" id="prompt"><center><?= $vo['prompt'] == '1' ? '客户催单' : '未催单' ?></center></td>
                    <td value="<?php echo ($vo['pay_for']); ?>" id="pay_for"><center><?= $vo['pay_for'] == '1' ? '购买' : '租用' ?></center></td>
                    <td value="<?php echo ($vo['price']); ?>" id="price"><center><?php echo ($vo['price'] - $vo['express']); ?></center></td>
                    <td value="<?php echo ($vo['deposit']); ?>" id="deposit"><center><?php echo ($vo['deposit']); ?></center></td>
                    <td value="<?php echo ($vo['express']); ?>" id="express"><center><?php echo ($vo['express']); ?></center></td>
                    <td value="<?php echo ($vo['exchange']); ?>" id="exchange"><center><a href="<?php echo U('admin/index/order_details',array('order_id' => $vo['exchange']));?>"><label><?php echo ($vo['exchange']); ?></label></a></center></td>
                    <td value="<?php echo ($vo['exchangeto']); ?>" id="exchangeto"><center><a href="<?php echo U('admin/index/order_details',array('order_id' => $vo['exchangeto']));?>"><label><?php echo ($vo['exchangeto']); ?></label></a></center></td>
                    <td value="<?php echo ($vo['or_time']); ?>" id="or_time"><center><?php echo ($vo['or_time']); ?></center></td>
<!--                     <td value="<?php echo ($vo['start']); ?>" id="start"><center><?php echo ($vo['start']); ?></center></td>
                    <td value="<?php echo ($vo['end']); ?>" id="end"><center><?php echo ($vo['end']); ?></center></td> -->
                    <td value="<?php echo ($vo['wxname']); ?>" id="wxname"><center><?php echo ($vo['wxname']); ?></center></td>
                    <!-- <td value="<?php echo ($vo['receiver']); ?>" id="receiver"><?php echo ($vo['receiver']); ?></td> -->
                    <!-- <td value="<?php echo ($vo['addr']); ?>" id="addr"><?php echo ($vo['addr']); ?></td> -->
                    <td class="opreate" id="<?php echo ($vo['delivery_id']); ?>">
                        <a href="javascript:">
                            <center><?= empty($vo['delivery_name']) ? ($vo['cur_state'] == '0' || $vo['cur_state'] == '1' || $vo['cur_state'] == '6' || $vo['cur_state'] == '61') ? '指派配送' : '' : $vo['delivery_name'] ?></center>
                        </a>
                    </td>
                    <td>
                        <a class="sj_btn" href="<?php echo U('admin/index/order_details',array('id' => $vo['id']));?>"><center>订单详情</center></a>  
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
       <div class="pagelist"><?php echo ($page); ?></div>
    </div>
</div><!-- /.main-content -->
<script type="text/javascript">
    var date = '<?=json_encode($date)?>';
    var search_show = '<?=$search_show?>';
    var state = '<?=$state?>';
    if(state != '') {
        $(':radio:checked').removeAttr('checked');
        $(':radio[value="'+state+'"]').prop('checked',true);
    }
    if(search_show == 'false') {
        $('form').hide();
    }
    date = JSON.parse(date);
    $('#start').val(date.start);
    $('#end').val(date.end);
    laydate.render({
        elem: '#start',
    });
    laydate.render({
        elem: '#end',
    });
    // var state = '<?=$state?>';
    // if(state != '') {
    //     $('[name="state"]').val(state);
    // }
    $('.sub').click(function() {
        $('#subform').submit();
    })
    $('.opreate').on('click', function() {
        var tr = $(this).parent();
        var delivery_id = $(this).attr('id');
        var order_id = tr.find('#order_id').attr('value');
        var state = tr.find('#state').attr('value');
        if(state == '0' || state == '1' || state == '6' || state == '61') {
        // if(delivery_id != '') {
            // window.open('<?php echo U("admin/index/delivery_details");?>?id='+delivery_id+'&check=check','','width=800,height=400');
        // } else {
            // if($(this).find('center').text() != '') {
                window.open('<?php echo U("admin/index/deliverylist");?>?order_id='+order_id,'','width=800,height=400');
            // }
        // }
        }
    })
    $('.opreate').parent().on('click', function() {
        var tr = $(this);
        var state_title = tr.find('#state').text();
        var state = tr.find("#state").attr('value');
        var html = "<tr id='change_state'><td colspan='14'><label>当前状态：</label>"
                 + "<label value='"+state+"' id='cur_state'><button value='2' class ='btn btn-default btn-xs'>"+state_title+"</button></label>";
        // if(state == '0') {
        //     html += "<label> ---> </label>"
        //          + '<label><button value="1" class ="CState btn btn-success btn-xs">配送中</button></label></td></tr>';
        // }
        //  else if(state == '1') {
        //     html += "<label> -----> </label>"
        //          + '<label><button value="2" class ="CState btn btn-primary btn-xs">配送完成</button></label></td></tr>';
        // } 
        // else 
        if(state == '3') {
            html += "<label> -----> </label>"
                 + '<label><button value="2" class ="CState btn btn-primary btn-xs">配送完成</button></label></td></tr>';
        } else if(state == '4') {
            html += "<label> -----> </label>"
                 + '<label><button value="5" class ="CState btn btn-danger btn-xs">取消订单成功</button></label></td></tr>';
        } 
        // else if(state == '6') {
        //     html += "<label> -----> </label>"
        //          + '<label><button value="61" class ="CState btn btn-success btn-xs">还货中</button></label></td></tr>';
        // } 
        // else if(state == '61') {
        //     html += "<label> -----> </label>"
        //          + '<label><button value="7" class ="CState btn btn-primary btn-xs">还货完成(返还扣除配送费押金)</button></label></td></tr>';
        // }
        else if(state == '8') {
            html += "<label> -----> </label>"
                 + '<label><button value="9" class ="CState btn btn-primary btn-xs">同一小区转租</button></label>'
                 + '<label><button value="10" class ="CState btn btn-primary btn-xs">不同小区转租'
                 + '</button></label></td></tr>';
        } 
        if(tr.next().attr('id') == 'change_state') {
            tr.next().remove();
        } else {
            tr.after(html);
        }
    })
        $('body').on('click','.CState', function() {
            var tr = $(this).parent().parent().parent();
            var prev_tr = tr.prev();
            var state = $(this).attr('value');
            var prev_state = tr.find('#cur_state').attr('value');
            var paied = prev_tr.find('#paied').attr('value');
            var express = prev_tr.find('#express').attr('value');
            var order_id = prev_tr.find('#order_id').attr('value');
            var text = $(this).text();
            console.log(text);
            if(state == '5') {
                if(prev_state != '4') {
                    alert('该用户未有取消订单操作');
                    return;
                } else {
                    if(!confirm('是否向该用户退款')) {
                        return;
                    }
                }
            } else if(state == '10') {
                if(prev_state != '8') {
                    alert('该用户未有申请转租操作');
                    return;
                } else {
                    if(!confirm('是否向该用户返回全额押金')) {
                        return;
                    }
                }
            } else if(state == '9') {
                if(prev_state != '8') {
                    alert('该用户未有申请转租操作');
                    return;
                } else {
                    if(!confirm('是否向该用户返回押金')) {
                        return;
                    }
                }
            } else if(state == '7') {
                if(prev_state != '61') {
                    alert('该用户未有申请还货操作');
                    return;
                } else {
                    if(!confirm('是否向该用户返回押金')) {
                        return;
                    }
                }
            } else if(paied == '0') {
                alert('不能对用户进行该操作');
                return;
            }
            if(prev_state > state) {
                alert('不能对用户进行该操作');
                return;
            }
            if(confirm('是否确定执行该操作')) {
                $.ajax({
                    url: "<?php echo U('index/change_state');?>",
                    type: 'post',
                    dataType: 'json',
                    data: {state: state,order_id :order_id},
                    success: function(data) {
                        if(data == 'success') {
                            alert('修改成功');
                            // console.log(data);
                            tr.find('#cur_state').text(text);
                            prev_tr.find('#state').text(text);
                        } else {
                            alert(data);
                            if(data.error == '0') {
                                alert(data.msg);
                            }
                        }
                    }
                })
            }
        })

</script></div>
</body>
<script type="text/javascript">
    $('#file').click(function() {
      $(this).next().click();
    })
    $('#uploadFile').fileupload({
        url: '<?php echo U("index/upload");?>',
        dataType: 'json',
        done: function(e,data) {
            $('img').attr('src',data.result);
            $('#filePath').val(data.result);
        }
    })
    var prompt = '';
    var paied = '';
    var power = '<?=session("power")?>';
    if(power == 1) {
      setInterval(function() {
        ajax();
      },60000)
    };
    function ajax() {
      $.ajax({
        'url' : '<?php echo U("admin/index/search_new");?>',
        'dataType': 'json',
        'type' : 'post',
        success : function(data) {
          if(prompt == '' && paied == '') {
            prompt = data.prompt;
            paied = data.paied;
          //   document.getElementById("video").play();
          //   alert('现有 '+prompt+' 位客户催单');
          } else {
            var newPrompt = parseInt(data.prompt) - parseInt(prompt);
            var newPaied = parseInt(data.paied) - parseInt(paied);
            prompt = data.prompt;
            paied = data.paied;
            // if(newPrompt != 0) {
            //   alert('新增'+newPrompt+'客户催单');
            //   document.getElementById("video").play();
            // }
            if(newPaied != 0) {
              alert('新增'+newPaied+'张订单');
              document.getElementById("video").play();
            }
          }
        }
      })
    }
</script>
</html>
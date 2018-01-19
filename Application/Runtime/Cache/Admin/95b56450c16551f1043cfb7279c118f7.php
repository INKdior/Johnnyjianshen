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
            // try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo U('admin/index/main');?>">首页</a>
            </li>
            <li class="active">关于我们</li>
        </ul>
    </div>
    <div class="table_con">
        <form method="post"  action="<?php echo U('index/xg_banner');?>" id='subform' enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
                <table>
                     <tr>
                        <td width="5%">用户：</td>
                        <td width="80%"><label><?php echo ($data['wxname']); ?></label></td>
                    </tr>       
                    <tr>
                        <td width="20%">订单号：</td> 
                        <td width="80%"><label id="order_id"><?php echo ($data['order_id']); ?></label></td>
                    </tr> 
                    <tr>
                        <td width="20%">图片：</td> 
                        <td width="80%"><img width="150px" height="100px" src="<?php echo ($data['picture_url']); ?>"></td> 
                    </tr> 
<!--                     <tr>
                        <td width="20%">开始日期：</td>
                        <td width="80%">
                            <input style="margin:5px;width:180px;" type="text" id="start_date" value="<?php echo ($order_state['or_time']); ?>">
                            <input style="margin:5px;width:60px;" class="update btn btn-primary btn-xs" type="button" value="更新" />
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">截止日期：</td>
                        <td width="80%">
                            <input style="margin:5px;width:180px;" type="text" id="end_date" value="<?php echo ($order_state['xd_time']); ?>">
                            <input style="margin:5px;width:60px;" class="update btn btn-primary btn-xs" type="button" value="更新" />
                        </td>
                    </tr> -->
    <!--                 <tr>
                        <td width="20%">设定天数</td>
                        <td width="80"><label id="days"></label></td>
                    </tr> -->
                    <tr>
                        <td width="20%">剩余天数：</td>
                        <td width="80"><label id="rest"></label></td>
                    </tr>
                    <tr>
                        <td width="20%">下单时间：</td>
                        <td width="80%"><label><?php echo ($data['or_time']); ?></label></td>
                    </tr>
                    <tr>
                        <td width="20%">收费方式</td>
                        <td width="80%"><label><?php echo isset($g_price) ? $g_price['time'].'天'.$g_price['price'].'元' : '选择购买' ?></label></td>
                    </tr>
                    <tr>
                        <td width="20%">是否催单：</td>
                        <td width="80%"><label><?= $data['prompt'] == '1' ? '客户催单' : '未催单' ?></label></td>
                    </tr>
         <!--            <tr>
                        <td width="20%">查看微信订单详情：</td>
                        <td width="80%"><label class="check_wx_order"><a href="javascript:;">查看</a></label></td>
                    </tr>  -->
                    <tr>
                        <td width="20%">来自转租：</td>
                        <td width="80"><a href="<?php echo U('admin/index/order_details',array('order_id' => $data['exchange']));?>"><label><?php echo ($data['exchange']); ?></label></a></td>
                    </tr>
                    <tr>
                        <td width="20%">转租给：</td>
                        <td width="80"><a href="<?php echo U('admin/index/order_details',array('order_id' => $data['exchangeto']));?>"><label><?php echo ($data['exchangeto']); ?></label></a></td>
                    </tr>
                    <tr>
                        <td width="20%">价格：</td> 
                        <td width="80%"><label><?php echo ($data['price']); ?></label></td>
                    </tr> 
                    <tr>
                        <td width="20%">收货人：</td> 
                        <td width="80%"><label><?php echo ($data['receiver']); ?></label></td>
                    </tr> 
                    <tr>
                        <td width="20%">押金：</td> 
                        <td width="80%"><label><?php echo ($data['ps_price']); ?></label></td>
                    </tr> 
                    <tr>
                        <td width="20%">配送费：</td> 
                        <td width="80%"><label><?php echo ($data['delivery']); ?></label></td>
                    </tr>
                    <tr>
                        <td width="20%">电话：</td> 
                        <td width="80%"><label><?php echo ($data['tel']); ?></label></td>
                    </tr> 
                    <tr>
                        <td width="20%">地址：</td>
                        <td width="80%"><label><?php echo ($data['addr']); ?></label></td>
                    </tr>
 <!--                    <tr>
                        <td width="20%">状态：</td> 
                        <td width="80%"><label value="<?php echo ($data['state']); ?>" id="cur_state"><?php echo ($data['state_title']); ?></label>
                            <label value="1" class="CState"><a href="javascript:;" >配送中</a></label>
                            <label value="2" class="CState"><a href="javascript:;">配送完成</a></label>
                            <label value="5" class="CState"><a href="javascript:;">取消订单并退款</a></label>
                            <label value="7" class="CState"><a href="javascript:;">还货成功(返还扣除配送费押金)</a></label>
                            <br>&nbsp;&nbsp;
                            <label value="same" class="CState"><a href="javascript:;">同一小区转租(返还全额押金)</a></label>
                            <label value="diff" class="CState"><a href="javascript:;">不同小区转租(返还扣除配送费押金)</a></label>
                        </td>
                    </tr>  -->
                    <tr>
                        <td width="20%">货物名称：</td> 
                        <td width="80%"><label><?php echo ($data['name']); ?></td>
                    </tr> 
                    <tr>
                        <td width="20%">货物描述：</td> 
                        <td width="80%"><label><?php echo ($data['abstract']); ?></td>
                    </tr> 
                        <td colspan="2" align="center" valign="middle">
                            <!-- <input class="btn btn-primary btn-sm" style="width:6%;" type="submit" value="提交" /> -->
                        </td>
                    </tr>
                </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    laydate.render({
        elem: '#start_date',
    });
    laydate.render({
        elem: '#end_date',
    });
    $('.check_wx_order').click(function() {
        window.location.href = "<?php echo U('Admin/index/wx_order/order_id/'.$data["order_id"]);?>";
    })
    function restDate() {
        var endDate = new Date($('#end_date').val());
        var startDate = new Date($('#start_date').val());
        var curDate = new Date();
        var rest = Math.ceil(endDate.valueOf() - curDate.valueOf());
        var days = Math.ceil(endDate.valueOf() - startDate.valueOf());
        days = days/24/60/60/1000;
        rest = rest/24/60/60/1000;
        rest = Math.ceil(rest);
        if(days < 0) {
            days = Math.abs(days);
            $('#days').text('超出'+days+'天');
        } else {
            if(String(days) != 'NaN') {
                $('#days').text(days+'天');
            }
        }
        if(rest < 0) {
            rest = Math.abs(rest);
            $('#rest').text('超出'+rest+'天');    
        } else {
            if(String(rest) != 'NaN') {
                $('#rest').text(rest+'天');
            }
        }
    }
    restDate();
    $('.update').click(function() {
        var date = $(this).prev().val();
        var key = $(this).prev().attr('id');
        if(key == 'start_date') {
            var data = {
                'or_time' :date,
                order_id: $('#order_id').text(),
            }
        } else {
            var data = {
                'xd_time' :date,
                order_id: $('#order_id').text(),
            }
        }
        $.ajax({
            url: "<?php echo U('index/update_date');?>",
            type: 'post',
            dataType: 'json',
            data: data,
            complete: function() {
                alert('更新成功');
                restDate();
            }
        })
    })
    $('.CState').on('click', function() {
        var state = $(this).attr('value');
        var prev_state = "<?=$data['state']?>";
        var text = $(this).text();
        var express = "<?=$data['express']?>";
        if(state == '5') {
            if(prev_state != '4') {
                alert('该用户未有取消订单操作');
                return;
            } else {
                if(!confirm('是否向该用户退款')) {
                    return;
                }
            }
        } else if(state == 'same') {
            if(prev_state != '8') {
                alert('该用户未有申请转租操作');
                return;
            } else {
                if(!confirm('是否向该用户返回全额押金')) {
                    return;
                }
            }
        } else if(state == 'diff') {
            if(prev_state != '8') {
                alert('该用户未有申请转租操作');
                return;
            } else {
                if(!confirm('是否向该用户返回扣除换货配送费押金')) {
                    return;
                }
            }
        } else if(state == '7') {
            if(prev_state != '6') {
                alert('该用户未有申请还货操作');
                return;
            } else {
                if(!confirm('是否向该用户返回押金')) {
                    return;
                }
            }
        }
        if(prev_state > state) {
            alert('不能对用户进行该操作');
            return;
        }
        $.ajax({
            url: "<?php echo U('index/change_state');?>",
            type: 'post',
            dataType: 'json',
            data: {state: state,order_id :$('#order_id').text()},
            success: function(data) {
                if(data == 'success') {
                    alert('修改成功');
                    // console.log(data);
                    $('#cur_state').text(text);
                } else {
                    if(data.error == '0') {
                        alert(data.msg);
                    }
                }
            }
        })
    })
</script>













</div>
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
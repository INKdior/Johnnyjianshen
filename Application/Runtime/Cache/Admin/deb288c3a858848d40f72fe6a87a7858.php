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
            <li class="active">个人信息</li>
        </ul>
</div>
    <div class="table_con">
        <form method="post"  action="<?php echo U('index/add_coupon');?>" onsubmit="" id='subform' enctype="multipart/form-data">
            <input  type="hidden" id="id" name="id"  value="">
            <table>
                <tr>
                    <td width="5%">优惠券名称：</td>  
                    <td width="5%"><input id="couponName" name="coupon_name" type="text" value=""></td>
                </tr>       
                <tr>
                    <td width="5%">优惠券描述：</td>
                    <td width="80%"><input id="details" name="details" type="text"></td> 
                </tr>
                <tr>
                    <td width="20%">图片：<br><label>(规格：337x232)</label></td>  
                    <td width="80%">  
                        <img width='150px' style="float:left;margin:10px;" height='100px' src="/Public/img/photo.gif">
                        <input type="button" style="width:10%;margin-top: 70px" class="btn btn-sm" id="file" value="选择文件"/>
                        <input id="uploadFile" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" name="imgurl" >
                    </td>
                </tr>
<!--                 <tr >
                    <td width="5%">价格上限：</td>  
                    <td width="5%"><input id="value" name="value" type="text" value=""></td>
                </tr>  -->
                <tr >
                    <td width="5%">优惠券描述：</td>  
                    <td width="5%"><input id="coupon_info" name="coupon_info" type="text" value=""></td>
                </tr> 
                <tr >
                    <td width="5%">优惠券分享方式：</td>  
                    <td width="80%">
                        <select id="stage" name="stage">
                            <option value="1">分享所有人</option>
                            <option value="0">新人立即领取</option>
                        </select> 
                    </td>
                </tr> 
                <tr >
                    <td width="5%">红包类型：</td>  
                    <td width="80%">
                        <select id="type" name="type">
                            <option value="0">固定金额</option>
                            <option value="1">随机金额</option>
                            <option value="2">满减</option>
                        </select> 
                    </td>
                </tr> 
                <tr>
                    <td width="20%">状态：</td>  
                    <td width="80%">
                        <select id="status" name="status">
                            <option value="N">使用中</option>
                            <option value="D">已作废</option>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td width="20%">截止期限：</td>  
                    <td width="80%"><input id="deadline" name="deadline" type="text" value=""></td>
                </tr>
                <td colspan="2" align="center" valign="middle" >
                    <input class="btn btn-primary btn-sm" id="sub" style="width:6%;" type="button" value="提交" />
                </td>
            </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    var data = '<?=json_encode($data)?>';
    data = JSON.parse(data);
    laydate.render({
        elem: '#deadline',
    })
    $('#type').on('change', function() {
        type($(this).val());
    })
    function type(flag) {
        $('#input').remove();
        if(flag == '0') {
            var append = '<div id="input"><label style="float:left">请输入金额</label><p style="float:left"><input style="width:80%" type="text" name="value"></p></div>';
        } else if(flag == '1') {
            var append = '<div id="input"><label style="float:left">下限</label><p style="float:left"><input style="width:80%" type="text" name="down"></p>'
                       + '<label style="float:left">上限</label><p style="float:left"><input style="width:80%" type="text" name="up"></p></div>';
        } else if(flag == '2') {
            var append = '<div id="input"><label style="float:left">满</label><p style="float:left"><input style="width:90%" type="text" name="reach"></p>'
                       + '<label style="float:left">减</label><p style="float:left"><input style="width:90%" type="text" name="value"></p></div>';
        }
        $('#type').after(append);
    }
    if(data != null) {
        var status = data.status;
        $('#id').val(data.id);
        $('#couponName').val(data.coupon_name);
        $('img').attr('src',data.imgurl);
        $('#filePath').val(data.imgurl);
        $('#details').val(data.details);
        $('#value').val(data.value);
        $('#deadline').val(data.deadline);
        $('#stage').val(data.stage);
        $('#coupon_info').val(data.coupon_info);
        $('#type').val(data.type);
        type(data.type);
        if(data.type == '0') {
            $('#input').find('[name="value"]').val(data.value);
        } else if(data.type == '1') {
            $('#input').find('[name="down"]').val(data.down);
            $('#input').find('[name="up"]').val(data.up);
        } else if(data.type == '2') {
            $('#input').find('[name="reach"]').val(data.reach);
            $('#input').find('[name="value"]').val(data.value);
        }
        if(status == 'N') {
            $('#status').val('N');
        } else {
            $('#status').val('D');
        }
    } else {
        var append = '<div id="input"><label style="float:left">请输入金额</label><p style="float:left"><input style="width:80%" type="text" name="value"></p></div>';
        $('#type').after(append);
    }
    function check() {
        var type = $('#input').val();
        if(type == '0') {
            var value = $('[name="value"]').val();
        } else if(type == '1') {
            var up = $('[name="up"]').val();
            var down = $('[name="down"]').val();
            if(up < down) {
                alert('下限金额不能大于上限金额！');
                return false;
            }
        } else if(type == '2') {
            var value = $('[name="value"]').val();
            var reach = $('[name="reach"]').val();
            if(value > reach) {
                alert('满减金额不符！');
                return false;
            }
        }
        return true;
    }
    $('#sub').click(function() {
        var deadline = $('#deadline').val();
        var value = $('#value').val();
        if(check()) {
            if(deadline == '') {
                alert('截止日期不能为空');
            } else if(value == "0") {
                alert('价格上限不能为空');
            } else {
                $('form').submit();
            }
        }
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
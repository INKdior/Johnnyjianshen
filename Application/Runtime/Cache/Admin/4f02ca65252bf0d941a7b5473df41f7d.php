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
        <form method="post"  action="<?php echo U('index/re_goods');?>" onsubmit="" id='subform' enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
            <table>
                <tr>
                    <td width="10%">商品名：</td>
                    <td ><input name="name" type="text" value="<?php echo ($data['name']); ?>"></td>
                </tr>
                <tr>
                    <td>图片：</td>
                     <td >
                        <img style="float:left;margin:10px" width='150px' height='100px' src="<?php echo ($data['picture_url']); ?>">
                        <input type="button" style="width:10%;margin-top: 70px" class="btn btn-sm" id="file" value="选择文件"/>
                        <input id="uploadFile" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" value="<?php echo ($data['picture_url']); ?>" name="picture_url" >
                        <label>(规格：338x184)</label>
                    </td>
                </tr>
                <tr>
                    <td>产品详情：<br><label>(规格：352x206)</label></td>
                    <td>
                        <img style="float:left;margin:10px" width='150px' height='100px' src="<?= empty($data['details_picture1']) ? '/Public/img/photo.gif' : $data['details_picture1'] ?>">
                        <input type="button" style="width:6%;margin-top: 70px" class="btn btn-sm file" id="file" value="选择文件"/>
                        <input id="uploadFile1" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" value="<?php echo ($data['picture_url']); ?>" name="details_picture1" >
                        <img style="float:left;margin:10px" width='150px' height='100px' src="<?= empty($data['details_picture2']) ? '/Public/img/photo.gif' : $data['details_picture2'] ?>">
                        <input type="button" style="width:6%;margin-top: 70px" class="btn btn-sm file" id="file" value="选择文件"/>
                        <input id="uploadFile2" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" value="<?php echo ($data['picture_url']); ?>" name="details_picture2" >
                        <img style="float:left;margin:10px" width='150px' height='100px' src="<?= empty($data['details_picture3']) ? '/Public/img/photo.gif' : $data['details_picture3'] ?>">
                        <input type="button" style="width:6%;margin-top: 70px" class="btn btn-sm file" id="file" value="选择文件"/>
                        <input id="uploadFile3" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" value="<?php echo ($data['picture_url']); ?>" name="details_picture3" >
                        <img style="float:left;margin:10px" width='150px' height='100px' src="<?= empty($data['details_picture4']) ? ' /Public/img/photo.gif' : $data['details_picture4'] ?>">
                        <input type="button" style="width:6%;margin-top: 70px" class="btn btn-sm file" id="file" value="选择文件"/>
                        <input id="uploadFile4" type="file" style="display: none;" name="photo" />
                        <input id="filePath" type="hidden" value="<?php echo ($data['picture_url']); ?>" name="details_picture4" >
                    </td>
                </tr>                
                <tr>
                    <td>标题：</td>
                    <td >
                        <input name="headline" type="text" value="<?php echo ($data['headline']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>存货：</td>
                    <td >
                        <input name="stock" type="text" value="<?php echo ($data['stock']); ?>">
                    </td>
                </tr>
                <tr>
                    <td>剩余：</td>
                    <td >
                        <label name="rest"><?php echo ($data['rest']); ?></label>
                    </td>
                </tr>
                <tr>
                    <td>配置信息：</td>
                    <td> 
                       <input name="conf_infor" type="text" value="<?php echo ($data['conf_infor']); ?>">
                     </td>
                </tr>
                <tr>
                    <td>收费方式：</td>
                    <td>
                        <div>
                            <div id="priceWay">
                                <?php if(is_array($g_price)): $i = 0; $__LIST__ = $g_price;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$da): $mod = ($i % 2 );++$i;?><div class="clearfix">
                                        <span style="float: left;">天数：</span>
                                        <input style="width:50px;height:25px;float: left;margin-top:7px;" name="time" type="text" value="<?php echo ($da['time']); ?>">
                                        <span style="float: left;">天</span>
                                        <span style="float: left;">价格：</span>
                                        <input style="width:50px;height:25px;float: left;margin-top:7px;" name="price" type="text" value="<?php echo ($da['price']); ?>">
                                        <span style="float: left;">元</span>
                                        <input id="del" style="float: left;width:18px;height:5px;margin-top: 17px" class="btn btn-xs btn-danger" type="button">
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <table>
                                <tr>
                                    <td>
                                        <input type="button" class="btn btn-primary btn-xs" value="增加一行" id="addColumn" style ="width:80px">
                                        <input type="button" class="btn btn-primary btn-xs" value="更改" id="charge" style="width:80px;">
                                    </td>
                                </tr>
                            </table>
                        </div>                                 
                    </td>
                </tr> 
                <tr>
                    <td>简介：</td> <td ><input name="abstract" type="text" value="<?php echo ($data['abstract']); ?>"></td>
                </tr> 
                <tr>
                    <td>购买价格：</td>
                    <td >
                        <input name="price" type="text" value="<?php echo ($data['price']); ?>">
                    </td>
                </tr> 
               <tr>
                    <td>视频地址：</td>
                    <td >
                        <input name="video" type="text" value="<?php echo ($data['video']); ?>">
                    </td>
                </tr> 
                <tr>
                    <td>押金：</td>
                    <td >
                        <input name="ps_price" type="text" value="<?php echo ($data['ps_price']); ?>">
                    </td>
                </tr> 
                <tr>
                    <td>配送费：</td>
                    <td >
                        <input name="delivery" type="text" value="<?php echo ($data['delivery']); ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" onclick="return check(this.form)" value="提交" 
                    style=" border:none;background-color:#0066FF; color:#ffffff; width:100px; text-align:center; height:40px; line-height:37px;" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('.file').click(function() {
      $(this).next().click();
    })
    $('#uploadFile1').fileupload({
        url: '<?php echo U("index/upload");?>',
        dataType: 'json',
        done: function(e,data) {
            $(this).prev().prev().attr('src',data.result);
            $(this).next().val(data.result);
        }
    })
    $('#uploadFile2').fileupload({
        url: '<?php echo U("index/upload");?>',
        dataType: 'json',
        done: function(e,data) {
            $(this).prev().prev().attr('src',data.result);
            $(this).next().val(data.result);
        }
    })
    $('#uploadFile3').fileupload({
        url: '<?php echo U("index/upload");?>',
        dataType: 'json',
        done: function(e,data) {
            $(this).prev().prev().attr('src',data.result);
            $(this).next().val(data.result);
        }
    })
    $('#uploadFile4').fileupload({
        url: '<?php echo U("index/upload");?>',
        dataType: 'json',
        done: function(e,data) {
            $(this).prev().prev().attr('src',data.result);
            $(this).next().val(data.result);
        }
    })
    function check(form) {
        if(form.name.value=='') {
            alert("请输入商品名!");
            form.name.focus();
            return false;
          }
        if(form.headline.value=='') {
            alert("请输入标题!");
            form.headline.focus();
            return false;
        }
        if(form.conf_infor.value=='') {
            alert("请输入配置信息!"); 
            form.conf_infor.focus();
            return false;
        }
        if(form.abstract.value=='') {
            alert("请输入简介!");
            form.abstract.focus();
            return false;
        }
        if(form.video.value != '') {
            var reg = /^http:\/\/[a-zA-Z0-9]+\.[a-zA-Z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
            if(reg.exec(form.video.value) == null) {
                alert('请输入正确的视频链接地址');
                return false;
            } 
        }
        return true;
    }
    $('#addColumn').on('click', function() {
        var append = "<div class='clearfix'>"
                   + "<span style='float: left;'>天数：</span>"
                   + "<input style='width:50px;height:25px;float: left;margin-top:7px;' name='time' type='text' value=''>"
                   + "<span style='float: left;'>天</span>"
                   + "<span style='float: left;'>价格：</span>"
                   + "<input style='width:50px;height:25px;float: left;margin-top:7px;' name='price' type='text' value=''>"
                   + "<span style='float: left;'>元</span>"
                   + "<input id='del' style='float: left;width:18px;height:5px;margin-top: 17px' class='btn btn-xs btn-danger' type='button'>"
                   + "</div>";
        $('#priceWay').append(append); 
    })
    $('body').on('click', '#del', function() {
        $(this).parents('.clearfix').remove();
    })
    $('#charge').on('click', function() {
        // var priceWay = $('#priceWay');
        var priceWay = new Array;
        $('.clearfix').each(function() {
            var time = $(this).find('[name="time"]').val();
            var price = $(this).find('[name="price"]').val();
            var data = {
                'time': time,
                'price': price
            }
            priceWay.push(data);
        });
        priceWay = JSON.stringify(priceWay);
        $.ajax({
            url: "<?php echo U('index/g_price');?>",
            type: "post",
            dataType: "json",
            data: {data:priceWay,goods_id:$('[name="id"]').val()},
            complete: function() {
                alert('更改成功');
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
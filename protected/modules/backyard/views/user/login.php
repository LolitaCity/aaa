<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GOD COOL SYSTEM MANAGER</title>
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>invalid.css" type="text/css" media="screen" />
<script src="<?php echo WEB_ADMIN_JS_URL;?>jquery.js" type="text/javascript"></script>
<style>
.boxOut{ width:100%; height:1000px; background:url(<?php echo WEB_ADMIN_IMG_URL;?>boxout.png); position:fixed; z-index:1000; left:0; top:0;}
.bookBox{ width:460px; height:auto; background:#fff; position:fixed; _position:absolute; padding-bottom:15px;}
.enterArea{width:263px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; border:none; background:url(<?php echo WEB_ADMIN_IMG_URL;?>inputbg.jpg) no-repeat;}
input.yzm{width:60px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; position:relative; left:25px; border:none; background:url(<?php echo WEB_ADMIN_IMG_URL;?>inputbgyzm.jpg) no-repeat;}
</style>

<?php

?>
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>Simpla Admin</h1>
  <a href="#"><img id="logo" src="<?php echo BACKYARD_IMG_URL;?>logo.png" alt="Simpla Admin logo" /></a> </div>
  <div id="login-content">
    <?php $form=$this->beginWidget('CActiveForm');?>
      <div class="notification information png_bg">
        <div> 用户名与密码必填</div>
      </div>
      <p>
        <label>用户名</label>
        <?php echo $form->textField($userLoginObj,'username',array("class"=>"text-input"));?>
      </p>
      <div class="clear"></div>
      <p>
        <label>密　码</label>
        <?php echo $form->passwordField($userLoginObj,'password',array("class"=>"text-input"));?>
      </p>
      <div class="clear"></div>

      <div class="clear"></div>
      <p>
        <input class="button" type="submit" value="登　录" style="position: relative; top: -65px;" />
      </p>
    <?php $this->endWidget();?>
    
      <div class="warningInfo" style=" position: relative; top:-155px; left:310px; line-height: 35px;">
        <div style=" margin-top:10px; height:35px; line-height: 35px;"><?php echo $form->error($userLoginObj,'username',array("class"=>"notification error png_bg","style"=>"height:35px; line-height:35px; text-indent:30px;"));?></div>
        <div style=" margin-top:12px; height:35px; line-height: 35px;"><?php echo $form->error($userLoginObj,'password',array("class"=>"notification error png_bg","style"=>"height:35px; line-height:35px; text-indent:30px;"));?></div>
  
      </div>
  </div>
</div>
</body>
</html>

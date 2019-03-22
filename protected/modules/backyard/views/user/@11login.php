
<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
';
$webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
$webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));
$webdes=System::model()->findByAttributes(array("varname"=>"webdes"));
$wzlogo1=System::model()->findByAttributes(array("varname"=>"wzlogo1"));
$wzkf1=System::model()->findByAttributes(array("varname"=>"wzkf1"));
$weikequn=System::model()->findByAttributes(array("varname"=>"weikequn"));
$shouquan=System::model()->findByAttributes(array("varname"=>"shouquan"));
$baidutongji=System::model()->findByAttributes(array("varname"=>"baidutongji"));
;echo '<title>后台管理</title>
<link rel="stylesheet" href="';echo BACKYARD_CSS_URL;;echo 'reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="';echo BACKYARD_CSS_URL;;echo 'style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="';echo BACKYARD_CSS_URL;;echo 'invalid.css" type="text/css" media="screen" />
<script src="';echo WEB_ADMIN_JS_URL;;echo 'jquery.js" type="text/javascript"></script>
<style>
.boxOut{ width:100%; height:1000px; background:url(';echo WEB_ADMIN_IMG_URL;;echo 'boxout.png); position:fixed; z-index:1000; left:0; top:0;}
.bookBox{ width:460px; height:auto; background:#fff; position:fixed; _position:absolute; padding-bottom:15px;}
.enterArea{width:263px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; border:none; background:url(';echo WEB_ADMIN_IMG_URL;;echo 'inputbg.jpg) no-repeat;}
input.yzm{width:60px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; position:relative; left:25px; border:none; background:url(';echo WEB_ADMIN_IMG_URL;;echo 'inputbgyzm.jpg) no-repeat;}
</style>
<script language="JavaScript">
function correctPNG()
{
    var arVersion = navigator.appVersion.split("MSIE")
    var version = parseFloat(arVersion[1])
    if ((version >= 5.5) && (document.body.filters)) 
    {
       for(var j=0; j<document.images.length; j++)
       {
          var img = document.images[j]
          var imgName = img.src.toUpperCase()
          if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
          {
             var imgID = (img.id) ? "id=\'" + img.id + "\' " : ""
             var imgClass = (img.className) ? "class=\'" + img.className + "\' " : ""
             var imgTitle = (img.title) ? "title=\'" + img.title + "\' " : "title=\'" + img.alt + "\' "
             var imgStyle = "display:inline-block;" + img.style.cssText 
             if (img.align == "left") imgStyle = "float:left;" + imgStyle
             if (img.align == "right") imgStyle = "float:right;" + imgStyle
             if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
             var strNewHTML = "<span " + imgID + imgClass + imgTitle
             + " style=\\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
             + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
             + "(src=\\\'" + img.src + "\\\', sizingMethod=\'scale\');\\"></span>" 
             img.outerHTML = strNewHTML
             j = j-1
          }
       }
    }    
}
window.attachEvent("onload", correctPNG);
</script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {

jQuery(document).on(\'click\', \'#yw1\', function(){
	jQuery.ajax({
		url: "/index.php/backyard\\/user\\/captcha\\/refresh\\/1",//验证码配置，域名为当前域名，如果不正确则无法刷新
		dataType: \'json\',
		cache: false,
		success: function(data) {
			jQuery(\'#yw1\').attr(\'src\', data[\'url\']);
			jQuery(\'body\').data(\'captcha.hash\', [data[\'hash1\'], data[\'hash2\']]);
		}
	});
	return false;
});

});
/*]]>*/
</script>
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>Simpla Admin</h1>
  <a href="#"><img src="';echo $wzlogo1->value;;echo '" alt="" /></a> </div>
  <div id="login-content">
    ';$form=$this->beginWidget('CActiveForm');;echo '    
      <p>
        <label>用户名</label>
        ';echo $form->textField($userLoginObj,'username',array("class"=>"text-input"));;echo '      </p>
      <div class="clear"></div>
      <p>
        <label>密　码</label>
        ';echo $form->passwordField($userLoginObj,'password',array("class"=>"text-input"));;echo '      </p>
      <div class="clear"></div>
      <p>
        <input class="button" type="submit" value="登　录" style="position: relative; top: -65px;" />
      </p>
    ';$this->endWidget();;echo '    
      <div class="warningInfo" style=" position: relative; top:-155px; left:310px; line-height: 35px;">
        <div style=" margin-top:10px; height:35px; line-height: 35px;">';echo $form->error($userLoginObj,'username',array("class"=>"notification error png_bg","style"=>"height:35px; line-height:35px; text-indent:30px;"));;echo '</div>
        <div style=" margin-top:12px; height:35px; line-height: 35px;">';echo $form->error($userLoginObj,'password',array("class"=>"notification error png_bg","style"=>"height:35px; line-height:35px; text-indent:30px;"));;echo '</div>
        <div style=" margin-top:12px; height:35px; line-height: 35px;">';echo $form->error($userLoginObj,'verifyCode',array("class"=>"notification error png_bg","style"=>"height:35px; line-height:35px; text-indent:30px;"));;echo '</div>
      </div>
  </div>
</div>
</body>
</html>';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
    $webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));
    $webdes=System::model()->findByAttributes(array("varname"=>"webdes"));
?>
<title><?php echo $webtitle->value;?></title>
<meta name="Keywords" content="<?php echo $webkeywords->value;?>" />
<meta name="description" content="<?php echo $webdes->value;?>" />
<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="正能量电商" content="http://www.znlds.com" />
<link rel="icon" href="<?php echo SITE_URL;?>favicon.ico" type="image/x-icon" />
<link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css" />
<link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
<link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css" />
<link href="<?php echo S_CSS;?>adapt.css" rel="stylesheet" type="text/css" />
<script src="<?php echo S_JS;?>jquery-1.8.3.min.js" type="text/javascript"></script>
<!--<script src="<?php echo S_JS;?>jquery.jslides.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo S_JS;?>open.win.js?v=4.1"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
<script>
	//获取浏览器版本号
	function getBrowserInfo()
	{
	var agent = navigator.userAgent.toLowerCase() ;
	var regStr_ie = /msie [\d.]+;/gi ;
	var regStr_ff = /firefox\/[\d.]+/gi
	var regStr_chrome = /chrome\/[\d.]+/gi ;
	var regStr_saf = /safari\/[\d.]+/gi ;
	//IE
	if(agent.indexOf("msie") > 0)
	{
	return agent.match(regStr_ie) ;
	}
	//firefox
	if(agent.indexOf("firefox") > 0)
	{
	return agent.match(regStr_ff) ;
	}
	//Chrome
	if(agent.indexOf("chrome") > 0)
	{
	return agent.match(regStr_chrome) ;
	}
	//Safari
	if(agent.indexOf("safari") > 0 && agent.indexOf("chrome") < 0)
	{
	return agent.match(regStr_saf) ;
	}
	}
window.onload=function(){
   var agent = navigator.userAgent.toLowerCase() ;
   if(agent.indexOf("chrome") <0)
    {
    $.openAlter("建议使用Google浏览器登录平台，其他浏览器可能有兼容性问题，无法进行某些操作。","友情提醒");
    }
}	
</script>
</head>

<body>

<script>
function ValiTest() {
	var code_visible=$("#txtCode").is(':visible');
	var code=code_visible==false?1:0;
	var code_val=0;
	$("#serviceValidation").remove();
	$("#clientValidationOL").html("");
	var uname=$.trim($("#txtLoginName").val());
	var pwd=$.trim($("#txtPwd").val());
	if (uname == '') {
        layer.msg('账户不能为空', {
            icon: 5,
            time:2000,
            shade: 0.01
        });
		return false;
	}
	if (pwd == '') {
        layer.msg('密码不能为空', {
            icon: 5,
            time:2000,
            shade: 0.01
        });
		return false;
	}
	if (code == '' && $.trim($("#txtCode").val()) == '') {
        layer.msg('验证码不能为空', {
            icon: 5,
            time:2000,
            shade: 0.01
        });
		return false;
	}else{
		code_val=$.trim($("#txtCode").val());
	}
	//$("#Password").val(hex_md5($("#txtPwd").val()));
	checkLogin(uname,pwd,code_val);
}
        //登录表单检测
    function checkLogin(u,p,c)
    {
        layer.msg('登陆中....', {
            icon: 16,
            time:2000,
            shade: 0.01
        });
		//setTimeout(location.reload(),5000)  
        $.ajax({
			type:"POST",
			url:"<?php echo $this->createUrl('passport/login');?>",
			data:{"username":u,"pwd":p,'code':c,'cid':"<?php echo Yii::app()->controller->id;?>"},
			//async:false,
			dataType:'json',
			success:function(r)
			{
				if(r.err_code>0){
					if(r.err_code>1){//显示验证码
						$('.codetag').show();
					}
                    layer.msg(r.msg, {
                        icon: 5,
                        time:2000,
                        shade: 0.01
                });
				}else{
					location.reload();
				}
        	}
        });
                
		     
    }
 $(document).ready(function () {
	$("#change").click(function () {
		document.getElementById("imge").src = "/Login/GetVidateCode?t="+new Date();
	})

	/*$("#zc").click(function(){

	 $.openAlter('网站全面升级，暂时停止新用户注册，预计在11月中旬恢复，多谢支持~', '提示', { width: 250, height: 250 },'',"关闭");
	});*/
})
</script>


<form action="" id="fm" method="post">        
	<div class="index_top">
		<div class="index_top_1">
			<p class="left">
			<img src="<?php echo S_IMAGES?>login.jpg"></p>
		</div>
    </div>
	<!-- banner-->
	<div class="banner">
		<!-- 代码 开始 -->
		<div id="full-screen-slider">
			<ul id="slides">
				<li style="background: url('<?php echo S_IMAGES?>banner.jpg') no-repeat center top">
				</li>
			</ul>
		</div>
		<!-- 代码 结束 -->
		<div class="banner_login">
			<h2>用户登录</h2>
			<ul>
				<li class="yhdl" style="margin-top: 0px;">
					<p>帐户：</p>
					<p>
						<input Class="input_216" Id="txtLoginName" data-val="true" data-val-length="用户名最大长度为50" data-val-length-max="50" data-val-required="Name 字段是必需的。" id="Name" maxlength="50" name="User[Username]" placeholder="请输入注册时的手机号码" type="text" value="" />
					</p>
				</li>
				<li class="yhdl_2">
					<p>密码：</p>
					<p>
						<input data-val="true" data-val-length="密码处最大长度为50" data-val-length-max="50" data-val-required="Password 字段是必需的。" id="Password" name="User[PassWord]" type="hidden" value="" />
						<input type="password" class="input_216" placeholder="请输入密码" id="txtPwd" maxlength="50" />
					</p>
				</li>
				
				<li class="yhdl_2 codetag" style="display:<?php if($err_code>3){echo 'block';}else{echo 'none';}?>">
                    <p>验证码：</p>
					
                    <p style="margin-left: 5px; margin-top: 2px;">
					<!--验证码开始-->
                    <?php $form=$this->beginWidget('CActiveForm');?>	        
          		
					<span style="float:left;"><?php echo $form->textField($sitelogin,'verifyCode',array("class"=>"input_164 yzm",'id'=>"txtCode",'placeholder'=>"验证码",'data-val'=>"true",'data-val-length'=>"请输入4位验证码")); ?></span>
					<span style="float:left;"><?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer; background:#fff; height:27px; border-radius:5px;'))); ?></span>						
					<!--验证码结束-->								
					</p>
                </li><?php $this->endWidget();?> 
				
				<li class="yhdl_2"><a href="javascript:void(0)" onclick="return ValiTest()" id="dengu">登 录</a></li>
                    <a style="margin-left:100px" target="_blank" href="<?php echo $this->createUrl('passport/forgetpassword');?>">
					忘记密码</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- banner-->
</form>
</body>
</html>
    <script>
        //忘记密码 没做
        $(".forgetPwd").click(function(){
            layer.open({
                type: 2,
                title:'找回密码',
                area: ['368px','220px'],
                skin: 'layui-layer-rim', //加上边框
                content: ['<?php echo $this->createUrl('passport/forgetPwd');?>', 'no']
            });
        });
    </script>


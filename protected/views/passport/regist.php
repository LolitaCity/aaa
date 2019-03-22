<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$webtitle = System::model ()->findByAttributes ( array (
		"varname" => "webtitle" 
) );
$webkeywords = System::model ()->findByAttributes ( array (
		"varname" => "webkeywords" 
) );
$webdes = System::model ()->findByAttributes ( array (
		"varname" => "webdes" 
) );
?>
<title><?php echo $webtitle->value;?>-会员注册</title>
<meta name="Keywords" content="<?php echo $webkeywords->value;?>" />
<meta name="description" content="<?php echo $webdes->value;?>" />
<link rel="icon" href="<?php echo SITE_URL;?>favicon.ico"
	type="image/x-icon" />
<link href="<?php echo S_CSS;?>common.css" rel="stylesheet"
	type="text/css" />
<link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet"
	type="text/css">
<link href="<?php echo S_CSS;?>index.css" rel="stylesheet"
	type="text/css" />
<script src="<?php echo S_JS;?>jquery-1.8.3.min.js"
	type="text/javascript"></script>
<script src="<?php echo S_JS;?>jquery.jslides.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo S_JS;?>open.win.js?v=4.1"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
<link href="<?php echo S_CSS;?>regist.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript">
	$(function(){
		layer.open({
			closeBtn: false,
			move: false,
			type: 1,
			title: '平台公告',
			shadeClose: true,
			shade: 0.8,
			shadeClose: false,
			offset: ['25%', '30%'],
			area: ['45%', '39%'],
			content: $('div#agreement_desc'),
		}); 
	});
</script>
<div id="agreement_desc" style="padding: 3% 5%; display: none;">
	<h1 style="font-size: 17px; text-align: center;">注册协议</h1>
	<div style="font-size: 15px; padding-top: 2%;">
		<p>亲爱的二师兄用户:</p>
		在正式合作开始之前，请仔细阅读合作协议，如果继续注册即代表您同意以下条款: <br />
		1.违规处罚: <br />
		       在开始接手任务之前，请仔细阅读平台规则公告和进行新手测试，如果在任务过程中出现违规操作，我们将按照平台规则进行处罚。<br />
		2.提交实名认证资料，地址身份证电话清晰，务必填写详细正确。切记：地址要精确到门牌号否则通过不了！！！<br />
		3.我已熟知二师兄规则，如违规愿接受信客圈处罚;如涉及诈骗，愿意接受信客圈进行人肉搜索，通知家人、朋友、亲戚、居委会（村委），私家侦探，报警立案等方式处理<br />
	</div>
	<p style="text-align: center; padding-top: 6%;">
		<input class="input-butto100-xhs" type="button" value="同意协议" onclick="layer.close(layer.index); sessionStorage.hasAgree = 1;">
	</p>
</div>
<body>
	<div class="index_top">
		<div class="index_top_1">
			<p class="left">
				<img src="<?php echo S_IMAGES?>login.jpg">
			</p>
		</div>
	</div>

	<div class="sjzc"
		style="width: 1000px; height: 600px; margin-top: 40px">
		<div class="sjzc_1">注册会员</div>
		<div class="sjzc_2">

			<div class="sjzc_5" style="width: 63%">
				<ul style="width: 120%">
					<li style="width: 120%">
						<p class="sjzc_6">手机号：</p>
						<p>
							<input class="input_215" placeholder="请输入11位手机号码" type="text"
								value="" name="phonenum" id="Phonenum">
						</p>
					</li>
					<li style="width: 120%">
						<p class="sjzc_6">密码：</p>
						<p>
							<input class="input_215" placeholder="请输入密码" type="password"
								value="" name="pwd" id="Pwd">
						</p>
					</li>
					<li style="width: 120%">
						<p class="sjzc_6">确认密码：</p>
						<p>
							<input class="input_215" placeholder="再一次输入密码" type="password"
								value="" name="pwd2" id="Pwd2">
						</p>
					</li>
					<li style="width: 120%">
						<p class="sjzc_6">QQ：</p>
						<p>
							<input class="input_215" placeholder="请输入QQ号" type="text"
								value="" name="qq" id="qq">
						</p>
					</li>
					<li style="width: 120%">
						<p class="sjzc_6">邮箱：</p>
						<p>
							<input class="input_215" placeholder="请输入邮箱" type="text" value=""
								name="Email" id="email">
						</p>
					</li>
					<li style="width: 120%">
						<p class="sjzc_6">验证码：</p>
						<p>
						
						<p><?php $form=$this->beginWidget('CActiveForm');?>
                        <span style="float: left;"><?php echo $form->textField($sitelogin,'verifyCode',array("class"=>"input_215 input100 yzm",'id'=>"txtCode",'placeholder'=>"验证码",'data-val'=>"true",'data-val-length'=>"请输入4位验证码")); ?></span>
							<span style="float: left;">
							<?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer; background:#fff; height:27px; border-radius:5px;'))); ?></span>
                        <?php $this->endWidget();?></p>
					</li>
					<li>
	                    <p class="sjzc_6"> 手机验证码：</p>
	                    <p>
	                        <input class="input_215" id="phoneCode" maxlength="6" name="Code" onkeyup="value=value.replace(/[^0-9]/g,'')" placeholder="请输入6位验证码" type="text" value="">
	                    </p>
	                    <p>
	                        <a href="javascript:void(0)">
	                        <input id="btnSendCode" class="input-butto111" type="button" value="获取验证码" onclick="sendMessage(this)"></a><span id="lig" style="font-size: 12px; color: Red"></span>
	                    </p>
	                    <label id="Code_error" class="cue" style="display: none;">
	                        验证码为6为数字
	                    </label>
	                    <p></p>
	                </li>
					<li class="sjzc_8" id="liMsg"></li>
					<li class="sjzc_7" style="margin-left: 150px"><a
						href="javascript:void(0)" id="subbtn"> 立即注册</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	function sendMessage($this)
	{
		if(checkInfo())
		{
			$.post('/passport/checkCode', {code: $("#txtCode").val(), phone: $("#Phonenum").val(), ppp: "<?=$_GET['ppp']?>"}, function(datas){
				if (datas.status)
				{
					layer.msg(datas.message, {icon: 1, time: 1500});
					$($this).removeAttr('onclick');
					var $time = 60,
						t = setInterval(function(){
								 $time--;
								 $($this).val($time + "秒后重新获取");
								 if ($time === 0) {
									 clearInterval(t);
									 $($this).attr('onClick', 'sendMessage(this)').val("重新获取");
								 }
							 },1000);
					console.log(datas);
				}
				else
					$.openAlter(datas.message, '提示');
			}, 'JSON');
		}
	}
	
	function checkInfo()
	{
		var msg = '';
        if (sessionStorage.hasAgree != 1)
        {
        	msg = "您未同意注册协议，无法完成注册", "提示";
        }
        else if ($("#Phonenum").val() == '') {
            msg = "手机号不能为空", "提示";
        }
        else if ($.trim($("#Phonenum").val()).length != 11) {
            msg = "新手机号只能输入11位纯数字";
        }
        else if (!(/^1[3|4|6|5|7|8|9]\d{9}$/.test($.trim($("#Phonenum").val())))) {
        msg = "新手机号格式不正确";
        }
        else if ($("#Pwd").val() == '') {
            msg = "密码不能为空", "提示";
        }else if ($("#Pwd2").val() == '') {
            msg = "确认密码不能为空", "提示";
        }else if($("#Pwd").val()!=$("#Pwd2").val()){
            msg='两次输入密码信息不一致';
        }
        else if ($("#txtCode").val() == '') {
            msg = "验证码不能为空", "提示";
        }else if ($("#qq").val() == '') {
            msg = "QQ号码不能为空", "提示";
        }else if ($("#email").val() == '') {
            msg = "邮箱不能为空", "提示";
        }
        return msg == '' ? true : $.openAlter(msg, "提示");
	}
	
    $(function () {
        $("#subbtn").click(function () {
            if (checkInfo())
            {
            	if ($("#phoneCode").val() == '')
            	{
		            msg = "确认手机验证码不能为空", "提示";
		            $.openAlter(msg, "提示");
		        }
		        else
		        {
		        	$.post('<?php echo $this->createUrl('passport/regist');?>', {phoneCode: $("#phoneCode").val(), code:$("#txtCode").val(),email:$("#email").val(),phonenum: $("#Phonenum").val(),pwd:$("#Pwd").val(), qq: $("#qq").val(),userid:"<?=$_GET['userid']?>",ppp:"<?=$_GET['ppp']?>" }, function (r) {
	                    if(r.err_code>1){
	                        $.openAlter(r.msg,"提示");
	                    }else{
	                        $.openAlter("注册成功", "提示",{ width: 250,height: 50 }, function () { window.parent.location = "<?php echo $this->createUrl('site/index');?>"; }, "关闭");
	                    }
	                },'json');
		        }
                
            }
        })
    })
</script>
<script>
    $(document).ready(function(){
        var img = new Image;
        img.onload=function(){
            $('#yw1').trigger('click');
        }
        img.src = $('#yw1').attr('src');
    });
</script>


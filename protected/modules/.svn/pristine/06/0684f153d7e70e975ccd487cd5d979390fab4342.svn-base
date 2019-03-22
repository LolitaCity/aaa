<!DOCTYPE html>
<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>verify.js" type="text/javascript"></script>

    <style>
  
        .weui_cell::before
        {
            border-top: 0px solid #d9d9d9;
            color: #d9d9d9;
            content: " ";
            height: 1px;
            left: 15px;
            position: absolute;
            top: 0;
            transform: scaleY(0.5);
            transform-origin: 0 0 0;
            width: 100%;
        }
        .w-sj-nav li a:hover
        {
            background: none;
        }
        .w-sj-nav li a:focus
        {
            background: none;
        }
        
        .sjzc_3
        {
            background: #eee none repeat scroll 0 0;
            font-family: "微软雅黑";
            font-size: 14px;
            height: 38px;
        }
        .sjzc_4
        {
            background: #ff9900 none repeat scroll 0 0;
            color: #fff;
        }
        .input-butto110
        {
            background: #4882f0 none repeat scroll 0 0;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            font-size: 12px;
            height: 30px;
            line-height: 30px;
            margin-left: 10px;
            margin-top: 3px;
            text-align: center;
            width: 80px;
        }
        .input-butto111
        {
            background: #f4f4f4 none repeat scroll 0 0;
            border-radius: 10px;
            color: #333;
            cursor: pointer;
            font-size: 12px;
            height: 30px;
            line-height: 30px;
            margin-left: 10px;
            margin-top: 3px;
            text-align: center;
            width: 80px;
        }
        .infobox
        {
            background-color: #fff9d7;
            border: 1px solid #e2c822;
            color: #333333;
            padding: 5px;
            padding-left: 30px;
            font-size: 13px;
            --font-weight: bold;
            margin: 0 auto;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 95%;
            text-align: left;
        }
        .errorbox
        {
            background-color: #ffebe8;
            border: 1px solid #dd3c10;
            margin: 0 auto;
            margin-top: 10px;
            margin-bottom: 10px;
            color: #333333;
            padding: 5px;
            padding-left: 30px;
            font-size: 13px;
            --font-weight: bold;
            width: 85%;
        }
    </style>

</head>
<body>
<form action="/Login/ForgetPwdTwo" enctype="multipart/form-data" id="fm" method="post">        
        <div style="padding-bottom: 50px;" class="cm">
            <div class="nav hauto">
                <p style="float: left" class="nav_1 hauto">
                    <img src="<?=M_IMG_URL;?>login.jpg"></p>
                <p style="margin-top: -36.45px; width: 100%; text-align: center" class="nav_3">
                    <a>重置密码</a>
                </p>
                <p style="margin-top: -32px" class="nav_2">
                </p>
            </div>
            <div style="margin-top: 10px;" class="w-nav">
                <div class="w-sj-nav">
                    <ul>
                        
                        <li style="width: 50%; background: #ff9900"><a>验证会员信息</a></li>
                        <li style="width: 50%; background: #f4f4f4"><a style="color: Black">重置登录密码</a></li>
                    </ul>
                </div>
            </div>
            
            <div style="width: 80%; background-color: white; margin-left: auto; margin-right: auto;
                margin-bottom: 1em;">
                <div id="platform_content" style="padding-top: 10px">
                    <ul>
                        <li style="line-height: 20px; font-size: 14px">
                           
                        
                    </li></ul>
                </div>
             
                <div class="weui_cell" style="margin-left: -5%;">
                    <ul style="width: 100%">
                        <li style="width: 100%">
                            <p>
                                <span style="text-align: right; margin-left: -17px">会员名：</span> 
								
								<input Class="xlrf_100" Id="txtTel" class="input-validation-error" data-val="true" data-val-required="登录名不能为空" id="LoginName" maxlength="11" name="LoginName" onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)" placeholder="注册时使用的手机号~" type="text" value="" style="width: 70%;" />
                            
                                </p>
                        </li>
						<li class="yhdl" style="margin-top: 20px;">
                            <p>
                                <span style="text-align: right; margin-left: -3px">邮箱：</span>
                                <input Class="xlrf_100" style="width:70%" Id="email" id="email"  name="email"  placeholder="请输入注册时的邮箱账号" type="text" value="" />

                            </p>
                        </li>
                        <li class="yhdl" style="margin-top: 20px;">
                            <div>
							<span style="text-align: right;margin-left: -17px;">验证码：</span>
							<input class="xlrf_100" id="txtImgeCode" maxlength="4" name="ImgeCode" placeholder="4位验证码" style="width: 36%" type="text" value="">
							<div id="v_container" style="width: 70px;height: 34px;display:inline-block;    position: absolute;
    margin-left: 10px;"></div>
							
                           </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div onclick="Ok()" class="w-nav" style="width: 100%; position: fixed; left: 0; bottom: 0;">
                <center style="margin-top: 10px">
                    <a style="text-align: center; color: White;">下一步</a></center>
            </div>
        </div>

</form>
    <script type="text/javascript">	

		var verifyCode = new GVerify("v_container");
        function Ok() {
            var msg = "";
            var msg2="";
            var msg3="";
            if ($.trim($("#txtTel").val()) == '') {
                msg = "登录会员名不能为空";
            }
            else if ($.trim($("#txtTel").val()).length != 11) {
                msg = "登录会员名格式不正确";
            }
            else if (!(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#txtTel").val())))) {
                msg = "登录会员名格式不正确";
            }
            if ($.trim($("#txtImgeCode").val()) == '') {
                msg2 = "验证码不能为空";
            }if ($.trim($("#email").val()) == '') {
                msg3 = "邮箱账号不能为空";
            }
            if (msg != "") {
                alert(msg);return false;
            }
            if (msg3 != "") {
                alert(msg3);return false;
            }
            if (msg2 != "") {
                alert(msg2);return false;
            }
			
			var res = verifyCode.validate(document.getElementById("txtImgeCode").value);			
			if(!res){
				alert("验证码错误");return false;
			}
            //向后台发送处理数据
            $.ajax({
                type: "post", //用POST方式传输
                dataType: "json", //数据格式:JSON
                async: true,
                url: '<?=$this->createUrl('user/forgetpassword')?>', //目标地址
                data: {code:$.trim($('#txtCode').val()),mobile:$.trim($("#txtTel").val()),email:$.trim($("#email").val())},
                success: function (r) {//alert(r);return false;
                   if (r.err_code>0){
                      alert(r.msg);
                   }else {
					   alert(r.msg);
                       /*$.openAlter(r.msg,'提示',{width:250,height:250},function () {
                           window.location.href='<?=$this->createUrl('site/index')?>';
                       })*/
                   }
                }
            });
        }
    
	
	</script>
</body></html>

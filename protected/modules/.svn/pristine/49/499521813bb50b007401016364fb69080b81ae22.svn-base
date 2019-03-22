<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>用户登录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>csslogin.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>fonts.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>md5.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        //判断是否在iframe中
        if (self != top) {
            parent.window.location.replace(window.location.href);
        }
        document.onkeypress = function (e) {
            if ($("#ow_alter001").length == 0) {
                var code;
                if (!e) {
                    var e = window.event;
                }
                if (e.keyCode) {
                    code = e.keyCode;
                }
                else if (e.which) {
                    code = e.which;
                }

                if (code == 13) {
                    ValiTest();
                }
            }
        }

        $(function() {
            $(".checklist .checkbox-select").click(
                function(event) {
                    event.preventDefault();
                    $(this).parent().addClass("selected");
                    $(this).parent().find(":checkbox").attr("checked","checked");

                }
            );
            $(".checklist .checkbox-deselect").click(
                function(event) {
                    event.preventDefault();
                    $(this).parent().removeClass("selected");
                    $(this).parent().find(":checkbox").removeAttr("checked");

                }
            );

            // 登陆显示logo
            $(".lg_1 img").animate({opacity:'1',width:'100%', height:'100%'} ,1000);
        });


        function ValiTest() {
            var code = 'display:none';

            $("#serviceValidation").remove();
            $("#clientValidationOL").html("");
            if ($.trim($("#txtLoginName").val()) == '') {
                $.openAlter('账户不能为空', '提示', { width: 250, height: 250 });
                return false;
            }
            if ($.trim($("#txtPwd").val()) == '') {
                $.openAlter('密码不能为空', '提示', { width: 250, height: 50 });
                return false;
            }
            if (code == '' && $.trim($("#txtCode").val()) == '') {
                $.openAlter('验证码不能为空', '提示', { width: 250, height: 50 });
                return false;
            }
            $("#Password").val(hex_md5($("#txtPwd").val()));
            $("#fm").submit();
        }

        $(document).ready(function () {
            var msg=$("#serviceValidation").text().trim();
            if(msg.indexOf('您的用户名或密码错误')>-1)
            {
                msg="用户名或密码错误!";
                $.openAlter(msg, "提示", { width: 250, height: 50 });
            }
            else  if ($("#serviceValidation").text().indexOf('会员注册失败!') > -1 && $("#serviceValidation").text().indexOf('身份信息审核不通过') > -1) {
                var message = "<div style='text-align:center'>" + $("#serviceValidation").text() + "</div>";
                var loginname = $("#txtLoginName").val()
                $.openAlter("<p>会员注册失败!</p>" + $("#serviceValidation").html().replace("会员注册失败!", "").replace("【身份信息审核不通过】",""), "提示", { width: 250, height: 50 }, function () { location.href = '/Login/BrushUploadImgAagin?loginname=' + loginname; }, "重新提交审核");
            }
        })

        function Create() {
            $.openAlter("<div style='text-align:left;'>不接受游客注册，请联系推荐人获取注册链接~</div>", "提示", { width: 250, height: 50 });
//            $.openAlter("<div style='text-align:left;'>网站全面升级，暂时停止新用户注册，预计在11月中旬恢复，多谢支持~</div>", "提示", { width: 250, height: 50 });
        }

        function ClearTxt()
        {
            $("#txtLoginName").val("");
        }

        function ShowPassword()
        {
            $("#password2").show();
            $("#password1").hide();
        }

        function hidePassword()
        {
            $("#password1").show();
            $("#password2").hide();
        }
        $(document).ready(function(){
            $("#txtPwd2").live("input",function(){
                $("#txtPwd").val($("#txtPwd2").val());
            })
            $("#txtPwd").live("input",function(){
                $("#txtPwd2").val($("#txtPwd").val());
            })
        })
    </script>
    <style type="text/css">
        .aPwd
        {
            color: #4882f0;
        }
        #aPwd:hover
        {
            color: #ff9900;
        }
    </style>
</head>
<body>
<form action="<?=$this->createUrl('user/login');?>" id="fm" method="post">
    <div class="login">
        <div style="display: none;">
            <style>
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
            <div class="errorbox" id="serviceValidation">
                <ol style="list-style-type:decimal"><li><?=@$res['msg'];?></li></ol>
            </div>
        </div>

        <h2> 欢迎来到二师兄威客圈</h2>
            <span class="lg_1"><img src="<?=M_IMG_URL?>logo.png" class="lg_1" style="display: inline-block; opacity: 1; width: 100%; height: 100%;"></span>
        <ul>
            <li><i class="icon-user  t_blue fl"></i>
                <input class="login_2" id="txtLoginName" data-val="true" data-val-length="用户名最大长度为50" data-val-length-max="50" data-val-required="Name 字段是必需的。" maxlength="50" name="Name" placeholder="请输入用户名" type="text" value="">
                <i class="icon-cross  t_888 fr close" onclick="ClearTxt()"></i> </li>
            <li id="password1"><i class="icon-lock t_blue fl"></i>
                <input data-val="true" data-val-length="密码处最大长度为50" data-val-length-max="50" data-val-required="Password 字段是必需的。" id="Password" name="Password" type="hidden" value="">
                <input type="password" class="login_2" placeholder="请输入密码" id="txtPwd" maxlength="50">
                <i onclick="ShowPassword()" class="icon-eye-blocked  t_888 fr" ></i> </li>
            <li id="password2" style="display: none;"><i class="icon-lock  t_blue fl"></i>
                <input type="text" class="login_2" placeholder="请输入密码" id="txtPwd2" maxlength="50">
                <i onclick="hidePassword()" class="icon-eye  t_888 fr"></i></li>
        </ul>
        <h3>
            <a href="javascript:void(0)" onclick="return ValiTest();" class="login_dl bg_blue">登录</a></h3>
        <p>
            <a href="<?=$this->createUrl('user/forgetPassword')?>" class="t_blue">忘记密码</a></p>
    </div>


</form>
</body></html>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit" />
    <title>重置密码</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script src="<?php echo S_JS;?>jquery.jBox-2.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js?v=4.1"></script>
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .cue
        {
            color: #e4393c;
            line-height: 35px;
            height: 35px;
            position: absolute;
            width: 260px;
            padding: 0 5px;
            background: #FFEBEB;
            border: 1px solid #ffbdbe;
            color: #666;
            width: 260px;
            line-height: 36px;
            background: #f7f7f7;
            border: 1px solid #dddddd;
            display: none;
        }
        .input_215
        {
            border: 1px solid #ddd;
            height: 35px;
            line-height: 35px;
            width: 322px;
        }
        .err
        {
            color: #f00;
            line-height: 35px;
            height: 35px;
            position: absolute;
            width: 260px;
            padding: 0 5px;
            background: #FFEBEB;
            border: 1px solid #ffbdbe;
            color: #e4393c;
            width: 260px;
            line-height: 36px;
            background: #FFEBEB;
            border: 1px solid #ffbdbe;
            display: none;
        }
    </style>
    <script type="text/javascript">
        $(function(){
            $("#imge").click(function(){
                $("#ImgeCode_error").hide();
            });
        });

        function Ok() {
            var msg = "";
            if ($.trim($("#txtTel").val()) == '') {
                msg = "登录会员名不能为空";
            }
            else if ($.trim($("#txtTel").val()).length != 11) {
                msg = "登录会员名格式不正确";
            }
            else if (!(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#txtTel").val())))) {
                msg = "登录会员名格式不正确";
            }else if ($.trim($('#pwd').val())==''||$.trim($('#pwd2').val())==''){
                msg='密码或确认密码不能为空';
            }else if($.trim($("#pwd").val()).length < 6){
                msg='密码长度太短';
            }else if($.trim($('#pwd').val())!=$.trim($('#pwd2').val())){
                msg='两次输入的密码不一致，请重新输入！';
            }
            if(msg!=''){
                $.openAlter(msg,'提示');return false
            }else {
                //向后台发送处理数据
                var pp='<?=$_GET['sss']?>';
                var mobile=$.trim($("#txtTel").val());
                var pwd=$.trim($('#pwd').val());
                var tt='<?=$_GET['ptl']?>';
                $.ajax({
                    type: "post", //用POST方式传输
                   dataType: "json", //数据格式:JSON
                    async: true,
                    url: '<?=$this->createUrl('passport/findpwd')?>', //目标地址
                    data: {pp:pp,mobile:mobile,pwd:pwd,tt:tt},
                    success: function (r) {
                        if (r.err_code>0){
                            $.openAlter(r.msg,'提示');
                        }else {
                            $.openAlter(r.msg,'提示',{width:250,height:250},function () {
                                window.location.href='<?=$this->createUrl('site/index')?>';
                            })
                        }
                    }
                 })
            }


        }


    </script>
</head>
<body>
<form action="<?php echo $this->createUrl('passport/findpwd')?>" enctype="multipart/form-data" id="fm" method="post">
    <div class="index_top">
        <div class="index_top_1">
            <p class="left">
                <img src="<?php echo S_IMAGES;?>login.jpg">
            </p>
            <!--<p class="right">11111</p>-->
        </div>
    </div>

    <!-- 商家注册-->
    <div class="sjzc" style="width: 1000px; height: 550px; margin-top: 40px">
        <div class="sjzc_1">
            重置密码</div>
        <div class="sjzc_2">
            <div class="sjzc_3">
                <ul>
                    <li style="width: 50%;border:none">验证会员信息</li>
                    <li class="sjzc_4" style="text-align: center; width: 50%">重置登录密码</li>
                </ul>
            </div>
            <div class="sjzc_5" style="width: 63%">
                <ul style="width: 120%">
                    <li style="width: 120%">
                        <p class="sjzc_6">
                            登录会员名：</p>
                        <p>
                            <input Class="input_215" Id="txtTel" class="input-validation-error" data-val="true" data-val-required="登录名不能为空" id="LoginName" maxlength="11" name="LoginName" onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)" placeholder="请输入注册时使用的手机号码~" type="text" value="" />
                            <label id="Tel_error" class="cue">
                                请输入注册时使用的手机号码~
                            </label>
                        </p>
                    </li>
                    <li>
                        <p class="sjzc_6">
                            新密码：</p>
                        <p>
                            <input Class="input_215" Id="pwd"  name="pwd"  placeholder="请输入新的密码" type="password" value="" />
                        </p>
                    </li>
                    <li>
                        <p class="sjzc_6">
                            确认新密码：</p>
                        <p>
                            <input Class="input_215" Id="pwd2"  name="pwd2"  placeholder="请确认新的密码" type="password" value="" />
                        </p>
                    </li>
                    <li class="sjzc_8" id="liMsg"></li>
                    <li class="sjzc_7" style="margin-left: 150px"><a href="javascript:void(0)" onclick="Ok()">
                            下一步</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- 商家注册-->
</form></body>
</html>

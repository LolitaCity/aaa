<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js"></script>
</head>
<style type="text/css">
    .textPhone
    {
        width: 185px;
        height: 35px;
        border: 1px solid #ddd;
        line-height: 35px;
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
        margin-left: 13px;
        margin-top: 3px;
        text-align: center;
        width: 110px;
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
        margin-left: 13px;
        margin-top: 3px;
        text-align: center;
        width: 110px;
    }
</style>
<script type="text/javascript">
    $(function(){
        $("#txtNewPhone").attr("value", "");
        $("#txtImgeCode").attr("value", "");
        $("#txtPhoneCode").attr("value", "");
        $("input[type='password']").attr("value", "");
    });
    $(function () {
        $("#btnPM").click(function () {
            var msg = '';
            if ($("#txtNewPhone").val() == '') {
                msg = "确认新绑定手机号不能为空", "提示";
            }
            else if ($("#txtCode").val() == '') {
                msg = "确认验证码不能为空", "提示";
            }
            /*else if ($("#txtPhoneCode").val() == '') {
                msg = "确认手机验证码不能为空", "提示";
            }*/
            else if ($("#txtTsPwd").val() == '') {
                msg = "安全确认码不能为空", "提示";
            }
            else if ($.trim($("#txtNewPhone").val()).length !=11) {
                msg = "新手机号只能输入11位纯数字";
            }
            else if (!(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#txtNewPhone").val())))) {
                msg = "新手机号格式不正确";
            }
            if (msg != '') {
                $.openAlter(msg, "提示");
            }
            else {
                var nPwd = $("#txtNewPhone").val();
                var sfpw = $("#txtTsPwd").val();
                $.post('<?php echo $this->createUrl('editPhoneNum');?>', { code:$("#txtImgeCode").val(),newPhone: nPwd,code:$("#txtCode").val(), safecode: sfpw }, function (r) {
                   if(r.err_code>1){
                       $.openAlter(r.msg,"提示");
                   }else{
                       $.openAlter("修改成功", "提示",{ width: 250,height: 50 }, function () { window.parent.location = "<?php echo $this->createUrl('user/index');?>"; }, "关闭");
                   }
                },'json');
            }
        });
    });

    var curCount=0; //当前剩余秒数
    $(function () {
        $("#txtNewPhone").focusin(function () {
        }).focusout(function () {
            if ($("#txtNewPhone").val() != '' && !(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#txtNewPhone").val())))) {
                $.openAlter("手机号码格式不正确,请输入正确的手机号码","提示")
            }
            else {
                if ($("#txtNewPhone").val() != '') {
                    if(curCount==0)
                    {
                        $("#btnSendCode").removeClass("input-butto111").addClass("input-butto110");
                        $("#btnSendCode").removeAttr("disabled");
                    }
                }
            }
        });
    });
    $(document).ready(function () {
        if ($("#serviceValidation").length > 0) {
            $.openAlter($("#serviceValidation").text(), "提示");

            if ($("#txtNewPhone").val() != '' && (/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#txtNewPhone").val())))) {
                $("#btnSendCode").removeClass("input-butto111").addClass("input-butto110");
                $("#btnSendCode").removeAttr("disabled");

            }
        }
    })
    var InterValObj; //timer变量，控制时间
    var count = 60; //间隔函数，1秒执行
    var code = ""; //验证码
    var codeLength = 6; //验证码长度
/*
    function sendMessage() {
        if(curCount>0)
        {
            return false;
        }
        var Tel = $.trim($("#txtNewPhone").val());
        var ImageCode=$.trim($("#txtImgeCode").val());
        if ($.trim($("#txtImgeCode").val()) == '') {
            $.openAlter("请输入图片验证码","提示");
            return false;
        }
        else{
            $("#ImgeCode_error").hide();
        }
        curCount = count;
        var dealType; //验证方式
        var uid = $("#uid").val(); //用户uid
        if ($("#phone").attr("checked") == true) {
            dealType = "phone";
        }
        else {
            dealType = "email";
        }
        //产生验证码
        for (var i = 0; i < codeLength; i++) {
            code += parseInt(Math.random() * 9).toString();
        }
        //设置button效果，开始计时
        $("#btnSendCode").removeClass("input-butto110").addClass("input-butto111");
        $("#btnSendCode").attr("disabled", "true");
        $("#btnSendCode").val(+curCount + "秒再获取");
        InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
        //向后台发送处理数据
        $.ajax({
            type: "POST", //用POST方式传输
            dataType: "json", //数据格式:JSON
            async: true,
            url: '/Finance/Member/GetTPValCode', //目标地址
            data: "tel=" + Tel+"&imageCode="+ImageCode+"&t="+new Date(),
            error: function (XMLHttpRequest, textStatus, errorThrown) { },
            success: function (msg) {
                if (msg.StatusCode == 300) {
                    if (msg.Message.indexOf('收集验证码') > -1) {
                        $("#btnSendCode").removeClass("input-butto110").addClass("input-butto111");
                        $("#btnSendCode").val("重新发送验证码");
                        $("#lig").text("兄弟,你是在收集验证码吗?");
                        window.clearInterval(InterValObj); //停止计时器
                        $("#btnSendCode").attr("disabled", "true");
                    }
                    else if (msg.Message.indexOf('验证码不正确或过期') > -1) {
                        $("#imge").click();
                        curCount=0;
                        $("#btnSendCode").val("发送验证码");
                        window.clearInterval(InterValObj); //停止计时器
                        $("#btnSendCode").removeAttr("disabled"); //启用按钮
                        $("#btnSendCode").removeClass("input-butto111").addClass("input-butto110");
                        $.openAlter(msg.Message,"提示");

                    }
                    else
                    {
                        curCount=0;
                        $("#btnSendCode").val("重新发送验证码");
                        window.clearInterval(InterValObj); //停止计时器
                        $("#btnSendCode").removeAttr("disabled"); //启用按钮
                        $("#btnSendCode").removeClass("input-butto111").addClass("input-butto110");
                        $.openAlter(msg.Message,"提示");
                    }
                }
            }
        });
    }*/
    //timer处理函数
    function SetRemainTime() {
        if (curCount == 0) {
            window.clearInterval(InterValObj); //停止计时器
            $("#btnSendCode").removeAttr("disabled"); //启用按钮
            $("#btnSendCode").val("重新发送验证码");
            $("#btnSendCode").removeClass("input-butto111").addClass("input-butto110");
            code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
        }
        else {
            curCount--;
            $("#btnSendCode").val(+curCount + "秒再获取");
        }
    }
    $("#txtCode").focusin(function () {
    }).focusout(function () {
        if ($("#txtCode").val() != '' && $.trim($("#txtCode").val()).length != 6) {
            $("#Code_error").text("验证码长度不正确,请输入6位验证码");
            $("#Code_error").removeClass("cue").addClass("err");
        }
        else {
            $("#Code_error").hide();
        }

    });

</script>
<body>
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            手机号修改
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?php echo  S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>
<!--列表 -->
<div class="yctc_458 ycgl_tc_1">
    <ul>
        <li>
            <p class="sk-hygl_8">
                原绑定手机：</p>
            <p>
                <input type="text" readonly="readonly" value="<?php echo $userInfo->Phon;?>" class="input_305" id="txtPhone" maxlength="11" ></p>
        </li>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_8">
                新绑定手机号：</p>
            <p>
                <input class="input_305" id="txtNewPhone" maxlength="11" name="NewTelPhone" onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)" onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)" onpaste="value=value.replace(/[^0-9]/g,&#39;&#39;)" placeholder="请输入新的手机号码" type="text" value="">
            </p>
        </li>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_8">
                验证码：</p>
            <p>
            <!--验证码开始-->
            <?php $form=$this->beginWidget('CActiveForm');?>
            <span style="float:left;"><?php echo $form->textField($sitelogin,'verifyCode',array("class"=>"textPhone yzm",'id'=>"txtCode",'placeholder'=>"验证码",'data-val'=>"true",'data-val-length'=>"请输入4位验证码")); ?></span>
            <span style="float:left;"><?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer; background:#fff; height:27px; border-radius:5px;'))); ?></span>
            <?php $this->endWidget();?>
            <!--验证码结束-->
            </p>
        </li>
        <!--<li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_8">
                手机验证码：</p>
            <p>
                <input id="txtPhoneCode" class="textPhone" maxlength="6" name="Code" placeholder="请输入手机验证码" type="text" value=""></p>
            <p>
                <a href="javascript:void(0)">
                    <input id="btnSendCode" class="input-butto111" type="button" disabled="disabled" value="获取验证码" onclick="sendMessage()"></a><span id="lig" style="font-size: 12px;
                                color: Red"></span>
            </p>
        </li>-->
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_8">
                身份验证：</p>
            <p><input type="password" maxlength="18" placeholder="请输入安全码" class="input_305" id="txtTsPwd" value="">
            </p>
        </li>
        <li class="fpgl-tc-qxjs_4">
            <p>
                <input class="input-butto100-hs" type="button" id="btnPM" value="确定提交">
            </p>
            <p>
                <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回修改"></p>
        </li>
    </ul>
</div>
</body></html>
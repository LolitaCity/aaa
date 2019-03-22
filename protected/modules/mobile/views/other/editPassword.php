<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js"></script>
</head>

<script type="text/javascript">
    $(function () {
        $("#btnPwd").click(function () {
            var msg = '';
            if ($("#txtPassword").val() == '') {
                msg = "新密码不能为空", "提示";
            }
            else if ($("#txtRePassword").val() == '') {
                msg = "确认新密码不能为空", "提示";
            }
            else if ($("#txtTsPwd").val() == '') {
                msg = "身份验证不能为空", "提示";
            }
            else if ($.trim($("#txtPassword").val()).length < 6 || $.trim($("#txtPassword").val()).length > 18) {
                msg = "登录密码长度为6-18";
            }
           /* else if (passwordLevel($.trim($("#txtPassword").val())) == 1) {
                msg = "登录密码必须由字母、数字和标点符号至少包含两种组成";
            }*/
            else if ($.trim($("#txtPassword").val()) != $.trim($("#txtRePassword").val())) {
                msg = " 登录密码和确认登录密码必须一致";
            }

            if (msg != '') {
                $.openAlter(msg, "提示");
            }
            else {
                var nPwd = $("#txtPassword").val();
                var sfpw = $("#txtTsPwd").val();
                $.post('<?php echo $this->createUrl('other/editPassword');?>', { newPwd: nPwd, safePwd: sfpw }, function (data) {
                    if (data.err_code == 1) {
                        $.openAlter("修改成功", "提示",{ width: 250,height: 50 }, function () { window.parent.location = "<?php echo $this->createUrl('user/index');?>"; }, "关闭");
                    }
                    else {
                        $.openAlter(data.msg, "提示");
                    }
                }, 'json');
            }
        });
    });
    function passwordLevel(password) {
        var Modes = 0;
        for (i = 0; i < password.length; i++) {
            Modes |= CharMode(password.charCodeAt(i));
        }
        return bitTotal(Modes);

        //CharMode函数
        function CharMode(iN) {
            if (iN >= 48 && iN <= 57)//数字
                return 1;
            if (iN >= 65 && iN <= 90) //大写字母
                return 2;
            if ((iN >= 97 && iN <= 122) || (iN >= 65 && iN <= 90)) //大小写
                return 4;
            else
                return 8; //特殊字符
        }

        //bitTotal函数
        function bitTotal(num) {
            modes = 0;
            for (i = 0; i < 4; i++) {
                if (num & 1) modes++;
                num >>>= 1;
            }
            return modes;
        }
    }
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
            <p class="sk-hygl_7">
                设置密码：</p>
            <p>
                <input type="password" maxlength="18" placeholder="请输入新密码" class="input_305" id="txtPassword" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"></p>
        </li>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_7">
                确认密码：</p>
            <p>
                <input type="password" maxlength="18" placeholder="请输入确认新密码" class="input_305" id="txtRePassword" onkeyup="this.value=this.value.replace(/^ +| +$/g,'')"></p>
        </li>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_7">
                身份验证：</p>
            <p>
                <input type="password" maxlength="18" placeholder="请输入安全码" class="input_305" id="txtTsPwd"></p>
        </li>
        <li class="fpgl-tc-qxjs_4">
            <p>
                <input class="input-butto100-hs" type="button" id="btnPwd" value="确定提交">
            </p>
            <p>
                <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回修改"></p>
        </li>
    </ul>
</div>
</body></html>
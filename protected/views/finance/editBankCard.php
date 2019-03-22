<html><head>
    <title></title>
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            设置默认提现银行卡
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?php echo S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">
    $(function () {
        $("#btnPwd").click(function () {
            var msg = '';
            if ($("#selBankList").val() == ''||$("#selBankList").val() == null) {
                msg="请选择银行卡";
            }
            else if ($("#txtTsPwd").val() == '') {
                msg = "身份验证不能为空", "提示";
            }
            if (msg != '') {
                $.openAlter(msg, "提示");
                return false;
            }
            else {
                var sfpw = $("#txtTsPwd").val();
                $.post('<?php echo $this->createUrl('finance/editbankcard');?>', { safePwd: sfpw,bankid:$("#selBankList").val()}, function (data) {
                    if (data.err_code == 0) {
                        $.openAlter("修改成功", "提示",{ width: 250,height: 50 }, function () { window.parent.location = "<?php echo $this->createUrl('finance/selleroutcash');?>"; }, "关闭");
                    }
                    else {
                        $.openAlter(data.msg, "提示");
                    }
                }, 'json');
            }
        });
    });
    $(function () {
        $('#selBankList option').each(function (i, o) {
            if (o.text.indexOf("验证失败") != -1)
            {
                var value = o.text.replace("(验证失败)", "");
                $(this).attr("disabled", "disabled").html(value);
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
<!--列表 -->
<div class="yctc_458 ycgl_tc_1">
    <ul style="margin-left: 50px">
        <?php if(@$curbank){
            $text=$curbank->bankName.'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($curbank->bankAccount,-4);
        ?>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_7" style="width: 100px; text-align: right">
                原提现银行卡：</p>
            <p style="text-align: center; line-height:32px">
                <em><b style="color:red"><?php echo $text;?></b></em>
            </p>
        </li>
        <?php }?>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_7" style="width: 100px; text-align: right">
                新提现银行卡：</p>
            <p>
                <select class="select_160" id="selBankList" name="BankName" style="width:210px;height:30px;">
                    <option selected="selected" value="">请选择银行卡号</option>
                    <?php foreach ($banklist as $v){?>
                    <option value="<?php echo $v->id;?>"><?php echo $v->bankName;?>       尾号 <?php echo substr($v->bankAccount,-4);?></option>
                    <?php }?>
                </select>
            </p>
        </li>
        <li class="fpgl-tc-qxjs_6">
            <p class="sk-hygl_7" style="width: 100px; text-align: right">
                身份验证：</p>
            <p>
                <input type="password" name="password1" style="display: none">
                <input style="width: 200px" type="password" maxlength="18" placeholder="请输入支付密码" class="input_305" id="txtTsPwd"></p>
        </li>
        <li class="fpgl-tc-qxjs_4" style="margin-left: 10%">
            <p>
                <input class="input-butto100-hs" type="button" id="btnPwd" value="确定提交">
            </p>
            <p>
                <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回修改"></p>
        </li>
    </ul>
</div>



</body></html>
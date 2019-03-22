<!DOCTYPE html>
<html><head>
    <title></title>
    <link href="<?= S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>weui.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            提交资料
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">

    function Submit() {
        //$("#Type").val("AddBuyNo");
        var reg1 = /^[\u4e00-\u9fa5]*$/;
        if ($("#UrgentName").val().trim() == "" || $("#UrgentName").val().trim() == null) {
            $.openAlter('紧急联系人姓名不能为空', '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        else if (!reg1.test($.trim($("#UrgentName").val()))) {
            $.openAlter("紧急联系人姓名必须为中文", '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        else if ($("#Tel").val() == "" || $("#Tel").val() == null) {
            $.openAlter('手机号码不能为空', '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        else if ($.trim($("#Tel").val()).length != 11) {
            $.openAlter('手机号码格式不正确', '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        else if (!(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#Tel").val())))) {
            $.openAlter('手机号码格式不正确', '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        /* else if ($("#TelCode").val() == "" || $("#TelCode").val() == null) {
             $.openAlter('手机验证码不能为空', '提示', { width: 250, top: 280, height: 50 });
             return false;
         }*/
        else if ($("#Relationship").val() == "" || $("#Relationship").val() == null) {
            $.openAlter('与联系人关系不能为空', '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        else if (!reg1.test($.trim($("#Relationship").val()))) {
            $.openAlter("与联系人关系必须输入中文", '提示', {width: 250, top: 280, height: 50});
            return false;
        }
        $('#fm').submit();
    }
</script>

<form action="<?php echo $this->createUrl('other/urgentcheck')?>" enctype="multipart/form-data" id="fm" method="post">        <div class="yctc_458 ycgl_tc_1" style="width: 580px; margin: 0px 0px 30px 30px;">

        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px; color: Gray;">请填写您的紧急联系人信息进行提交。</li>
            <li style="margin-top: 5px; font-size: 14px"><em style="color: Red">温馨提示：</em>请务必保证联系人的姓名与手机号码的真实性，平台将通过“申办信用卡”为理由，进行抽查核实。</li>
        </ul>

        <hr style="height: 1px; border: none; width: 76%; border-top: 1px dashed #CDC5BF;
                margin-top: 5px">
        <ul style="height: 500px;">
            <li class="fpgl-tc-qxjs_6" style="margin-top: 30px">
                <p class="sk-hygl_7" style="width: 140px">
                    紧急联系人姓名：</p>
                <p>
                    <input class="input_44"  id="UrgentName" maxlength="10" name="UrgentName" style="width: 200px" type="text" value="<?=@$urgentinfo['urgentname']?>">
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 140px">
                    紧急联系人手机号码：</p>
                <p>
                    <input class="input_44" id="Tel" maxlength="11" name="Tel" onkeyup="value=value.replace(/[^0-9]/g,'')" style="width: 200px" type="text" value="<?=@$urgentinfo['tel']?>">
                </p>
            </li>
            <!--<li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 140px">
                    手机验证码：</p>
                <p>
                    <input class="input_44" id="TelCode" maxlength="6" name="TelCode" onkeyup="value=value.replace(/[^0-9]/g,'')" placeholder="输入6位验证码" style="width:200px" type="text" value="">
                    <a href="javascript:void(0)">
                        <input style="width:100px; margin-left:1px" ;="" id="btnSendCode" class="input-butto111" type="button" disabled="disabled" value="获取验证码" onclick="sendMessage()"></a><span id="lig" style="font-size: 12px;
                                    color: Red"></span>
                </p>
            </li>-->
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 140px">
                    与联系人关系：</p>
                <p>
                    <input class="input_44" id="Relationship" maxlength="10" name="Relationship" style="width: 200px" type="text" value="<?=@$urgentinfo['relationship']?>">
                    <label style=" font-size:12px; color:Gray">如：父子、父女</label>
                </p>
            </li>
            <li class="sjzc_8" id="error" style="display: none; margin-top: 5px;"></li>
            <?php if (@$urgentinfo['status']!='已通过'):?>
            <li class="fpgl-tc-qxjs_4" style="margin-top: 20px">
                <p>
                    <input class="input-butto100-hs" type="button" value="提交审核" onclick="Submit()">
                </p>
                <p>
                    <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回修改"></p>
            </li>
            <?php endif;?>
        </ul>
    </div>

</form>

</body></html>
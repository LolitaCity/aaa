<!DOCTYPE html>
<html><head>
    <title></title>
    <link href="<?= S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>weui.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= S_JS;?>open.win.js"></script>
    <link rel="stylesheet" type="text/css" href="/myUpload/css/upimg.css">
    <script type="text/javascript" src="/myUpload/js/jquery.form.js"></script>
    <script type="text/javascript" src="/myUpload/js/myUpload.js"></script>
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
        var reg1 = /^[\u4e00-\u9fa5]*$/;
        var data = $("#PlatformNumber").val();
        if ($("#TaoBaoName").val().trim() == "" || $("#TaoBaoName").val().trim() == null) {
            $.openAlter('淘宝会员名不能为空', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($("#AlipayTel").val() == "" || $("#AlipayTel").val() == null) {
            $.openAlter('支付宝绑定手机号码不能为空', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        else if ($.trim($("#AlipayTel").val()).length != 11) {
            $.openAlter('支付宝绑定手机号码格式不正确', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        else if (!(/^1[3|4|5|7|8]\d{9}$/.test($.trim($("#AlipayTel").val())))) {
            $.openAlter('支付宝绑定手机号码格式不正确', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ( $(":input[name=img1]").val() == null) {
            $.openAlter('请上传支付宝截图', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        $("#fm").submit();
    }

</script>
<style type="text/css">
    .fpgl-tc-qxjs_6
    {
        margin-top: 10px;
    }
    .sk-hygl_7
    {
        width: 100px;
    }

</style>
<form action="<?php echo $this->createUrl('other/alipaycheck');?>" enctype="multipart/form-data" id="fm" method="post">        <div class="yctc_458 ycgl_tc_1" style="width: 580px; margin: 0px 0px 30px 30px;">
        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px; color: Gray;">请如实填写以下信息，并按要求上传截图。</li>
            <li style="margin-top: 5px; color: Red; font-size: 14px">温馨提示：</li>
            <li style="margin-top: 0px; font-size: 14px"><em style="color: Red">●</em> 淘宝会员名必须与平台账户绑定的一致；</li>
            <li style="margin-top: 0px; font-size: 14px"><em style="color: Red">●</em> 支付宝绑定手机号必须与平台账户（登录用的会员名）一致；</li>
            <li style="margin-top: 0px; font-size: 14px"><em style="color: Red">●</em> 若提交的资料不符合以上要求，资料将审核不通过。</li>
        </ul>

        <hr style="height: 1px; border: none; width: 76%; border-top: 1px dashed #CDC5BF;
                margin-top: 5px">
        <ul style="height: 500px;">
            <li style="margin-top: 5px">以下信息请打开：<span style="text-decoration: underline">支付宝APP--我的--设置--账户与安全</span>进行查看：</li>
            <li class="fpgl-tc-qxjs_6" style="margin-top: 30px">
                <p class="sk-hygl_7" style="width: 170px">
                    淘宝会员名：</p>
                <p>
                    <input class="input_44"  id="TaoBaoName" maxlength="25" name="TaoBaoName" style="width: 200px" type="text" value="<?=$taobaoinfo['taobaoname']?>">
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 170px">
                    支付宝绑定手机号码：</p>
                <p>
                    <input class="input_44" id="AlipayTel" maxlength="11" name="AlipayTel" onkeyup="value=value.replace(/[^0-9]/g,'')" style="width: 200px" type="text" value="<?=$taobaoinfo['alipaytel']?>">
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    上传支付宝截图：</p>
                <br>

                <p class="sjzc_6_tu" >
                <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=$taobaoinfo['img1']?>"});
                </script>
                </p>
                <p>
                    <a target="_blank" href="<?= S_IMAGES;?>alipaypc.png">
                    </a></p>
                <ul><a target="_blank" href="<?= S_IMAGES;?>alipaypc.png">
                        <li class="weui_uploader_file weui_uploader_status" style=" width: 100px;height:70px; background-image:url(<?= S_IMAGES;?>alipaypc.png)">
                            <div class="weui_uploader_status_content">
                                示例</div>
                        </li>
                    </a></ul>
            </li>
            <li class="sjzc_8" id="error" style="display: none; margin-top: 5px;"></li>
            <?php if (@$taobaoinfo['status']!='已通过'):?>
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
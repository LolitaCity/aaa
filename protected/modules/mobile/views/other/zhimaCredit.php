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
        if ($("#AlipayRealName").val() == "" || $("#AlipayRealName").val() == null) {
            $.openAlter('支付宝实名姓名不能为空', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if (!reg1.test($.trim($("#AlipayRealName").val()))) {

            $.openAlter("支付宝实名姓名必须为中文", '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($("#SesameCredit").val() == "" || $("#SesameCredit").val() == null) {
            $.openAlter('芝麻信用分不能为空', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($(":input[name=img1]").val() == null) {
            $.openAlter('请上传芝麻信用分截图', '提示', { width: 250, top: 280, height: 50 });
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
<form action="<?php echo $this->createUrl('other/zhimacredit');?>" enctype="multipart/form-data" id="fm" method="post">        <div class="yctc_458 ycgl_tc_1" style="width: 453px; margin: 0px 0px 30px 30px;">

        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px; color: Gray;">请如实填写以下信息，并按要求上传截图。</li>
            <li style="margin-top: 5px; color: Red">温馨提示：</li>
            <li style="margin-top: 5px;"><em style="color: Red">● </em>芝麻信用分必须<em style="color: Red">≥650</em>分；</li>
            <li style="margin-top: 5px;"><em style="color: Red">● </em>支付宝的实名姓名必须与威客圈实名姓名一样；</li>
            <li style="margin-top: 5px;"><em style="color: Red">● </em>若提交的资料不符合以上要求，资料将审核不通过；</li>
        </ul>

        <hr style="height: 1px; border: none; border-top: 1px dashed #CDC5BF; margin-top: 15px">
        <li style="margin-top: 5px;">以下信息请打开<span style="text-decoration: underline">支付宝APP--我的--个人中心--个人主页--点击“显示更多”</span>
            进行查看：</li>
        <ul style="height: 500px;">
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 170px">
                    支付宝实名姓名：</p>
                <p>
                    <input class="input_44" id="AlipayRealName" maxlength="10" name="AlipayRealName" style="width: 200px" type="text" value="<?=@$zhimainfo['alipayrealname']?>">
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 170px">
                    芝麻信用分：</p>
                <p>
                    <input class="input_44" data-val="true" data-val-number="字段 SesameCredit 必须是一个数字。" id="SesameCredit" maxlength="5" name="SesameCredit" onkeyup="value=value.replace(/[^0-9]/g,'')" style="width: 200px" type="text" value="<?=@$zhimainfo['sesamecredit'];?>">
                    分
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 100px">
                    上传截图：</p>
                <br>

                <p class="sjzc_6_tu" >
                <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$zhimainfo['img1'];?>"});
                </script>
                </p>
                <p>
                    <a target="_blank" href="<?= S_IMAGES;?>zhima.jpg">
                    </a></p>
                <ul><a target="_blank" href="<?= S_IMAGES;?>zhima.jpg">
                        <li class="weui_uploader_file weui_uploader_status" style=" width: 100px;height:70px; background-image:url(<?= S_IMAGES;?>zhima.jpg)">
                            <div class="weui_uploader_status_content">
                                示例</div>
                        </li>
                    </a></ul>
            </li>
            <li class="sjzc_8" id="error" style="display: none; margin-top: 5px;"></li>
            <?php if (@$zhimainfo['status']!='已通过'):?>
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
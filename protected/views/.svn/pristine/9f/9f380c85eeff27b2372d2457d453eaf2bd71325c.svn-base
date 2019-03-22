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
        if ($("#QQAge").val() == "" || $("#QQAge").val() == null) {
            $.openAlter('Q龄不能为空', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }

        if ( $(":input[name=img1]").val() == null) {
            $.openAlter('请上传QQ资料截图', '提示', { width: 250, top: 280, height: 50 });
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
<form action="<?php echo $this->createUrl('other/qqcheck')?>" enctype="multipart/form-data" id="fm" method="post">        <div class="yctc_458 ycgl_tc_1" style="width: 580px; margin: 0px 0px 30px 30px;">

        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px; color: Gray;">请如实填写以下信息，并按要求上传截图。</li>
            <li style="margin-top: 5px; color: Red;">温馨提示：</li>
            <li style="margin-top: 0px;"><em style="color: Red; font-weight: bold">
                    ● </em>请务必上传你在平台所绑定QQ对应的截图；</li>
            <li style="margin-top: 0px;"><em style="color: Red; font-weight: bold">
                    ● </em>绑定QQ的Q龄必须<em style="color: Red; font-weight: bold"> ≥3 </em>年；</li>
            <li style="margin-top: 0px;"><em style="color: Red; font-weight: bold">
                    ● </em>若提交的资料不符合要求，资料将审核不通过。</li>
        </ul>

        <hr style="height: 1px; border: none; width: 76%; border-top: 1px dashed #CDC5BF;
                margin-top: 5px">
        <ul style="height: 500px;">

            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7" style="width: 170px; text-align: center; margin-left: 16px">
                    Q龄：</p>
                <p>
                    <input class="input_44" data-val="true" data-val-number="字段 QQAge 必须是一个数字。" id="QQAge" maxlength="3" name="QQAge" onkeyup="value=value.replace(/[^0-9]/g,'')" style="width: 200px;margin-left: -60px" type="text" value="<?=@$qqinfo['qqage'];?>"> 年
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    上传资料截图：</p>
                <br>
                <p class="sjzc_6_tu" >
                <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$qqinfo['img1'];?>"});
                </script>
                </p>
                <p>
                    <a target="_blank" href="<?= S_IMAGES;?>showqq.jpg">
                    </a></p>
                <ul><a target="_blank" href="<?= S_IMAGES;?>showqq.jpg">
                        <li class="weui_uploader_file weui_uploader_status" style=" width: 100px;height:70px; background-image:url(<?= S_IMAGES;?>showqq.jpg)">
                            <div class="weui_uploader_status_content">
                                示例</div>
                        </li>
                    </a></ul>
            </li>
            <li class="sjzc_8" id="error" style="display: none; margin-top: 5px;"></li>
            <?php if (@$qqinfo['status']!='已通过'):?>
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
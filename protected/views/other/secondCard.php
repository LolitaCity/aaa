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
            上传第二证件照
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?= S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">

    function Submit() {

        if ($(":input[name=img1]").val() == null) {
            $.openAlter('上传手持证件照片截图', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($(":input[name=img2]").val() == null) {
            $.openAlter('请上传证件原照截图', '提示', { width: 250, top: 280, height: 50 });
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
<form action="<?php echo $this->createUrl('other/secondcard');?>" enctype="multipart/form-data" id="fm" method="post">        <div class="yctc_458 ycgl_tc_1" style="width: 580px; margin: 0px 0px 30px 30px;">

        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px; color: Gray;">请按要求上传第二证件照进行提交</li>
            <li style="margin-top: 5px;">第二证件包括：<span style="text-decoration: underline">户口簿、学生证、暂住证、驾驶证、社保卡、结婚证
                    。</span></li>
            <li style="margin-top: 5px;">你可以选择其中一种证件，拍照后进行上传。</li>
            <li style="margin-top: 5px;">上传第二证件照要求：</li>
            <li style="margin-top: 5px;"><em style="color: Red">●</em> 您需要按要求上传手持证件远照和证件原照。务必保证照片的清晰度；</li>
            <li style="margin-top: 5px;"><em style="color: Red">●</em> 手持证件远照必须保证持证人脸部无遮挡，完全露出手臂；</li>
            <li style="margin-top: 5px;"><em style="color: Red">●</em> 证件原照务必清楚展示你的个人信息和证件照片；</li>
            <li style="margin-top: 5px;"><em style="color: Red">●</em> 若不符合以上要求，照片将审核不通过；</li>
        </ul>

        <hr style="height: 1px; width: 78%; border: none; border-top: 1px dashed #CDC5BF;
                margin-top: 5px">
        <ul style="height: 500px;">
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    上传手持证件照：</p>
                <br>
                <p class="sjzc_6_tu" >
                    <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$seconcard['img1'];?>"});
                </script>
                </p>
                <p>
                    <a target="_blank" href="<?= S_IMAGES;?>seconcard.jpg">
                    </a></p>
                <ul><a target="_blank" href="<?= S_IMAGES;?>seconcard.jpg">
                        <li class="weui_uploader_file weui_uploader_status" style=" width: 100px;height:70px; background-image:url(<?= S_IMAGES;?>seconcard.jpg)">
                            <div class="weui_uploader_status_content">
                                示例</div>
                        </li>
                    </a></ul>

            </li><li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    上传证件原照：</p>
                <br>
                <p class="sjzc_6_tu" >
                    <div id="upimg2"></div>
                <script language="javascript">
                    $("#upimg2").upload({isMulti:true, pictureInputName:'img2',defaultimg:"<?=@$seconcard['img2'];?>"});
                </script>
                </p>
                <p>
                    <a target="_blank" href="<?= S_IMAGES;?>seconcard2.jpg">
                    </a></p>
                <ul><a target="_blank" href="<?= S_IMAGES;?>seconcard2.jpg">
                        <li class="weui_uploader_file weui_uploader_status" style=" width: 100px;height:70px; background-image:url(<?= S_IMAGES;?>seconcard2.jpg)">
                            <div class="weui_uploader_status_content">
                                示例</div>
                        </li>
                    </a></ul>

            </li>

            <li class="sjzc_8" id="error" style="display: none; margin-top: 5px;"></li>
            <?php if (@$seconcard['status']!='已通过'):?>
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
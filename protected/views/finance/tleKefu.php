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
            申请客服介入
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">

    function Submit() {
        if ($(":input[name=img1]").val() == null) {
            $.openAlter('请上传截图', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($("#contenttxt").val() == null) {
            $.openAlter('请填写文字说明', '提示', { width: 250, top: 280, height: 50 });
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
<form action="<?php echo $this->createUrl('/finance/telkefu');?>" enctype="multipart/form-data" id="fm" method="post">
    <input type="hidden" value="<?=$info->id?>" name="transferid">
    <div class="yctc_458 ycgl_tc_1" style="width: 580px; margin: 0px 0px 30px 30px;">
        <ul style="font-size: 14px; line-height: 20px; width: 450px">
            <li style="margin-top: 5px;">订单编号：</li>
            <li style="margin-top: 5px;"><?=$info->ordersn?></li>
        </ul>

        <hr style="height: 1px; width: 78%; border: none; border-top: 1px dashed #CDC5BF;
                margin-top: 5px">
        <ul style="height: 500px;">
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    上传截图：</p>
                <br>

                <p class="sjzc_6_tu" >
                <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$tfinfo['img']?>"});
                </script>
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7 myClass" style="width: 120px">
                    文字说明：</p>
                <br>
                <p class="sjzc_6_tu" >
                <textarea rows="4" cols="30"  name="content" id="contenttxt"><?=$tfinfo['content']?></textarea>
                </p>
            </li>
                <li class="fpgl-tc-qxjs_4"  style="margin-top: 20px">
                    <p>
                        <input class="input-butto100-hs" type="button" value="提交工单" onclick="Submit()">
                    </p>
                    <p>
                        <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回"></p>
                </li>
        </ul>
    </div>
</form>

</body></html>
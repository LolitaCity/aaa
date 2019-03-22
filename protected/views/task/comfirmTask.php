<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1" style="font-family: Microsoft YaHei;">
            获取佣金
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>
<?php $express=$usertask->expressnum;?>
<style>
    .sk-zjgl_5 {
        margin-top: 0px;
    }
</style>
<form action="<?=$this->createUrl('task/comfirmtask')?>" id="fm" method="post">
    <div class="errorbox" id="clientValidation" style="display: none;">
        <ol style="list-style-type: decimal" id="clientValidationOL">
        </ol>
    </div>
    <input id="TaskID" name="taskid" type="hidden" value="<?=$usertask->id;?>">
        <div class="yctc_458 ycgl_tc_1" style="margin-top: 10px; margin-left: 10px">
            <ul>
                <li>
                    <p class="sk-zjgl_4">
                        物流公司：</p>
                    <p style="margin-top: 6px">
                        <?=substr($express,0,strpos($express,'&'));?></p>
                </li>
                <li class="sk-zjgl_5">
                    <p class="sk-zjgl_4">
                        物流单号：</p>
                    <p style="margin-top: 10px">
                        <input id="ExpressNumber" name="ExpressNumber" type="hidden" value="808019801201">
                        <?=substr($express,strpos($express,'&')+1);?></p>
                </li>
                <li class="sk-zjgl_5">
                    <div class="d1" style="color: red; font-size: 12px; padding: 0 30px 0 20px;">
                        温馨提醒：商家确认后进行佣金发放！~
                    </div>
                </li>
                <li class="fpgl-tc-qxjs_4">
                    <p>
                        <input class="input-butto100-hs" type="button" value="确定提交" id="btnSubmit" onclick="ok()">
                        <input type="hidden" id="submitCnt" value="0">
                    </p>
                    <p>
                        <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回退出" id="bntColse"></p>
                </li>
            </ul>
        </div>

        <div class="d1" style="margin-top: 30px; padding-left: 30px; border-top: 1px dashed green">
           <!-- <b style="color: Red">注意事项：</b>
            <p style="font-size: small">
                1.请在淘宝确认收货后，再点击确认收货，商家确认后进行佣金发放<br>
                2.确认收货必须在提交任务之后3天才可确认收货<br>
            </p>-->
        </div>
    </div>
</form>
<script>
    function ok(){
        $('#fm').submit();
    }
</script>

</body></html>
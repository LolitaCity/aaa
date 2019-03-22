<html><head>
    <title></title>
     <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>index.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1" style="font-family: Microsoft YaHei;">
            确认收货
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
        <div class="ycgl_tc1 " style="margin-top: 10px; margin-left: 10px">
            <ul>
                <li>
                    <p style="margin-top: 6px">
                        物流公司：<?=substr($express,0,strpos($express,'&'));?></p>
                </li>
                <li class="sk-zjgl_5">
                    <p style="margin-top: 10px">
                       物流单号： <input id="ExpressNumber" name="ExpressNumber" type="hidden" value="808019801201">
                        <?=substr($express,strpos($express,'&')+1);?></p>
                </li>
                <li class="sk-zjgl_5">
                    <div class="d1" style="color: red; font-size: 12px; padding: 10px  10px 0 0px;">
                        温馨提醒：请根据物流单号确认好卖家是否发货~
                    </div>
                </li>
                <li style="margin-top:30px">
                    <p class="fl" style="margin-right:20px;margin-left:20px">
                        <input class="input-butto100-hs" style="width:100px" type="button" value="确定提交" id="btnSubmit" onclick="ok()">
                        <input type="hidden" id="submitCnt" value="0">
                    </p>
                    <p class="fl">
                        <input style="width:100px" onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="返回退出" id="bntColse"></p>
                </li>
            </ul>
        </div>

    </div>
</form>
<script>
    function ok(){
        $('#fm').submit();
    }
</script>

</body></html>
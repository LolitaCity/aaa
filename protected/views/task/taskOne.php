<!DOCTYPE html>
<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<?php $rukou=$this->liuliangrukou($taskinfo['intlet']);?>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            <label>
                <label>
                    任务编号: <?=$taskinfo['tasksn']?></label>(<?=$rukou['intletarr'][$taskinfo['intlet']]?>)
            </label>
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>


<script type="text/javascript">
    function Submit() {
        var taskId = $("#TaskID").val();
        $("#fm").submit();
    }
    function oCopy(obj) {
        obj.select();
        js = obj.createTextRange();
        js.execCommand("Copy")
    }

    function Timesa(second) {
        second--;
        if (second <= 0) {
            second = 0;
        }
        if (second == 0) {
            $("#btnNext").attr("disabled", false);
            $("#btnNext").attr("class", "input-butto100-ls");
            $("#btnNext").val("下一步");
        }
        else {
            $("#btnNext").val("信息确认 " + second + " 秒");
            setTimeout("Timesa('" + second + "')", 1000);
        }
    }

    function Timesb(minute, second) {
        second--;
        if (second <= -1 && minute > 0) {
            second = 59;
            minute--;
        }
        if (minute <= 0) {
            minute = 0;
        }
        if (minute <= 0 && second <= 0) {
            minute = 0;
            second = 0;
        }
        if (minute == 0 && second == 0) {
            $("#lblMinute").text("0");
            $("#lblSecond").text("0");
        }
        else {
            $("#lblMinute").text(minute);
            $("#lblSecond").text(second);
            setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }
</script>
<form action="<?php echo $this->createUrl('task/taskone');?>" enctype="multipart/form-data" id="fm" method="post">        <!--添加弹窗 开始接任务第一步 -->
    <div class="yctc_800 ycgl_tc_1" style="font-family: 微软雅黑">

        <div class="person-level">
            <ul>
                <li class="end">进入购物平台</li>
                <li>找到目标商品</li>
                <li>模拟购物过程</li>
                <li>下单付款</li>
            </ul>
        </div>
        <input id="TaskID" name="taskid" type="hidden" value="<?=$taskinfo['id']?>">
        <div class="fpgl-tc-drp" style="width: 100%; margin-left: 185px; margin-top: 25px; font-size: 16px">
            <ul>
                <script type="text/javascript">

                </script>
                <style type="text/css">
                    .fpgl-tc-drp3 a
                    {
                        color: #222;
                    }
                    .fpgl-tc-drp3 a em
                    {
                        color: Red;
                    }

                    .fpgl-tc-drp2
                    {
                        width: 200px;
                    }

                    .fpgl-tc-drp3
                    {
                        margin-bottom: 15px;
                    }
                    .t_fl a em:hover
                    {
                        color: #fff;
                        background: #4882f0;
                        margin-top: 3px;
                        height: 22px;
                    }
                    .t_fl
                    {
                        float: left;
                        width: 400px;
                        margin-top: -6px;
                    }
                </style>
                <ul style="line-height: 17px">
                    <li class="fpgl-tc-drp3" style="text-align: left; height: 22px;">
                        <p class="fpgl-tc-drp2">
                            任务类型<label onclick="window.open('" style="color: Red; cursor: pointer;">(点我查看)</label>：</p>
                        <label id="lblSearchKey"><?=$rukou['intletarr'][$taskinfo['intlet']]?></label>
                    </li>
                    <li class="fpgl-tc-drp3" style="text-align: left">
                        <p class="fpgl-tc-drp2">
                            下单终端：</p>
                        <span style="color: Red"><b><?=$rukou['terminal']?></b></span>
                    </li>
                    <li class="fpgl-tc-drp3" style="text-align: left; position: relative; padding-top: 31px;
        margin-top: -30px;">
                        <p class="fpgl-tc-drp2">
                            入口：</p>
                        <span style="color: Red"><b><?=$rukou['entrance']?></b></span>
                    </li>
                    <li class="fpgl-tc-drp3" style="text-align: left">
                        <p class="fpgl-tc-drp2">
                            进入商品页方式：</p>
                        <span><?=$rukou['searchtype']?></span>
                    </li>
                    <li class="fpgl-tc-drp3" style="width: 550px; text-align: left">
                        <p class="fpgl-tc-drp2">
                            任务说明：
                        </p>
                        <?php if ($taskinfo['remark']):?>
                            <span style="margin: 3px 0px 2px 120px;">
                            <textarea rows="2" cols="30" readonly="readonly" style="width: 350px;"><?=$taskinfo['remark']?></textarea>
                            </span>
                        <?php else:?>
                        <div style="word-break: break-all;">(无)</div>
                        <?php endif;?>


                    </li>
                    <li class="fpgl-tc-drp3" style="width: 400px; position: fixed; bottom: 50px; left: 235px;">
                        <p style="margin-left: 21px; font-size: 14px;">
                            <span style="float: none; color: red">温馨提示:</span> 若支付金额与担保金额的<span style="float: none;
                color: red">差额≥50元</span>，在平台将<span style="float: none; color: red">无法提交订单</span>。遇到这种情况时，请勿在淘宝进行下单操作。
                        </p>
                    </li>
                    <?php if ($rukou['entrance']=='淘宝App'):?>
                    <li style="margin-top: 0px; margin-left: 100px">
                        <img src="<?=S_IMAGES;?>tmapp.png" title="禁用天猫APP" width="70px" height="70px" style=" margin-left:70px">
                        <img src="<?=S_IMAGES;?>tbapp.png" title="使用淘宝APP" width="70px" height="70px">
                        <img src="<?=S_IMAGES;?>downloadtb.png" title="下载淘宝APP" width="70px" height="70px">
                    </li>
                    <?php endif;?>
                </ul>
                <li style="position: fixed; bottom: 10px; right: 340px;">
                    <p class="jsgl_4">
                        <input onclick="Submit()" class="input-butto100-xshs" disabled="true" style="width: 127px;
                                height: 35px;" type="button" id="btnNext" value="下一步"></p>
                </li>
                <li style="position: fixed; bottom: 20px; right: 30px; font-size: 14px;"><span>任务释放倒计时：<label id="lblMinute" style="color: Red;"></label>
                        分
                        <label id="lblSecond" style="color: Red;">34</label>
                        秒</span> </li>
            </ul>
            <script type="text/javascript">
               Timesa('<?=$time10;?>')
            </script>
            <script type="text/javascript">
                var m='<?=floor($setfreetime/60);?>';
                var s='<?=$setfreetime%60;?>';
                Timesb(m, s)</script>
        </div>
    </div>
    <!--添加弹窗 开始接任务第一步 -->
</form>


</body></html>
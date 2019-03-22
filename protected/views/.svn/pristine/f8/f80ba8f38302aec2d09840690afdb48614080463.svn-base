<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<?php
$task=Task::model()->findByPk($usertask->taskid);
$rukou=$this->liuliangrukou($task->intlet);?>
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            <label>
                <label>
                    任务编号: <?=$usertask->tasksn;?></label>(<?=$rukou['intletarr'][$task->intlet]?>)
            </label>
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.parent.$.closeWin();self.parent.$.closeWin()">
                <img src="<?=S_IMAGES?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var check = $("#ulCheck [type='checkbox']").length;
        $("#ulCheck [type='checkbox']").click(function () {
            var nowChecked = $("#ulCheck [type='checkbox']:checked").length;
            if (nowChecked == check) {
                var minute = $("#lblMinute").text();
                var second = $("#lblSecond").text();
                if (minute == "0" && second == "0") {
                    $("#btnSubmit").attr("disabled", false);
                    $("#btnSubmit").attr("class", "input-butto100-ls");
                }
                else {
                    $("#btnSubmit").attr("disabled", "disabled");
                    $("#btnSubmit").attr("class", "input-butto100-xshs");
                }
            }
            else {
                $("#btnSubmit").attr("disabled", "disabled");
                $("#btnSubmit").attr("class", "input-butto100-xshs");
            }
        });
    })
    function Submit(taskID) {
        var err = "";
        $("input[type='checkbox']").each(function () {
            if ($(this).is(":checked") == false || $(this).is(":checked") == "false") {
                err += $(this).val() + ";";
            }
        });
        if (err != "") {
            $.openAlter("请勾选 " + err, "提示");
            return;
        }
        $("#fm").submit();
    }

    function Timesa(minute, second) {
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
        var check = $("#ulCheck [type='checkbox']").length;
        var nowChecked = $("#ulCheck [type='checkbox']:checked").length;
        var valiProductPassTime = "<?=$stoptime;?>";
        if (valiProductPassTime != null) {
            if (minute == 0 && second == 0) {
                if (nowChecked == check) {
                    $("#lblMinute").text("0");
                    $("#lblSecond").text("0");
                    $("#btnSubmit").attr("disabled", false);
                    $("#btnSubmit").attr("class", "input-butto100-ls");
                }
                else {
                    $("#lblMinute").text(minute);
                    $("#lblSecond").text(second);
                }
            }
            else {
                $("#lblMinute").text(minute);
                $("#lblSecond").text(second);
                setTimeout("Timesa('" + minute + "','" + second + "')", 1000);
            }
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
            $("#lblMinute2").text("0");
            $("#lblSecond2").text("0");
        }
        else {
            $("#lblMinute2").text(minute);
            $("#lblSecond2").text(second);
            setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }

</script>
<style type="text/css">
    .fpgl-tc-drp_4
    {
        margin-top: 15px;
    }
</style>
<style type="text/css">
    #ulCheck li label
    {
        cursor: pointer;
    }
</style>
<form action="<?php echo $this->createUrl('task/taskthree')?>" enctype="multipart/form-data" id="fm" method="post">    <!--列表 -->
    <div class="yctc_800 ycgl_tc_1" style="font-family: 微软雅黑">
        <div class="person-level">
            <ul>
                <li class="m">进入购物平台</li>
                <li class="m">找到目标商品</li>
                <li class="end">模拟购物过程</li>
                <li>下单付款</li>
            </ul>
        </div>
        <input id="TaskID" name="usertaskid" type="hidden" value="<?=$usertaskid;?>">
        <ul class="fpgl-tc-drp_3" id="ulCheck">
            <li class="fpgl-tc-drp_4" style="width: 400px; margin-left: -50px;">
                <p>
                    请完成以下操作，并在完成后勾选对应按钮
                </p>
            </li>
            <?php if ($buytype->c_goods>=50){?>
            <li class="fpgl-tc-drp_4">
                <p class="jsgl_7">
                    <input type="checkbox" id="checkbox1" name="checkbox" style="width: 20px; height: 20px;" value="收藏商品"></p>
                <label for="checkbox2">
                    收藏商品
                </label>
            </li>
            <?php } if ($buytype->bookmark>=50){?>
            <li class="fpgl-tc-drp_4">
                <p class="jsgl_7">
                    <input type="checkbox" id="checkbox2" name="checkbox" style="width: 20px; height: 20px;" value="收藏店铺"></p>
                <label for="checkbox2">
                    收藏店铺
                </label>
            </li>
            <?php } if ($buytype->talk>=50){?>
            <li class="fpgl-tc-drp_4">
                <p class="jsgl_7">
                    <input type="checkbox" id="checkbox3" name="checkbox" style="width: 20px; height: 20px;" value="买前咨询聊天"></p>
                <label for="checkbox3">
                    <p>
                        买前咨询聊天 :</p>
                    <span style="float: left; width: 160px; margin-left: 4px;">与店铺旺旺对话几句，聊天内容<span style="color: Red;">严禁出现平台任务字眼</span></span></label>
            </li>
            <?php }
            $max=0; 
            $xhome=unserialize($buytype->x_home);
            if ($xhome && count($xhome) > 0 &&  $xhome['not']<40){
                array_shift($xhome);
                $max=array_search(max($xhome),$xhome);
               }
               if ($xhome && count($xhome) > 0 && $xhome[$max]>30){ 
               	$num=substr($max,-1);
                ?> <li class="fpgl-tc-drp_4">
                       <p class="jsgl_7">
                           <input type="checkbox" id="checkbox5" name="checkbox" style="width:20px;height:20px;" value="货比<?=@$num;?>家"></p>
                       <label for="checkbox5">
                           <span>浏览</span><?=@$num;?>家同类店铺的一款同类商品</label>
                   </li>

            <?php }
            $maxsame=0; 
            $deep=unserialize($buytype->deep);
            if ($deep && $deep['net']<40){
                array_shift($deep);
                $max2=array_search(max($deep),$deep);
            }
            if ($deep && $deep[$max]>30){ 
            	$numdeep=substr($max2,-1);
            	?>
                <li class="fpgl-tc-drp_4">
                    <p class="jsgl_7">
                        <input type="checkbox" id="checkbox4" name="checkbox" style="width:20px;height:20px;" value="浏览店内<?=@$numdeep;?>款其他商品"></p>
                    <label for="checkbox4">
                        浏览店内<?=@$numdeep;?>款其他商品</label>
                </li>
            <?php }?>
            <li class="fpgl-tc-drp_4" style="width: 400px; margin-left: -50px;">
                <p>
                    任务说明:
                </p>

                <?php if ($remark):?>
                    <div style="margin: 5px 0px;">
                    <textarea rows="3" cols="30" readonly="readonly" style="width: 350px; height:50px"><?=$remark;?></textarea>
                </div>
                <?php else:?>
                    <div style="word-break: break-all;">(无)</div>
                <?php endif;?>
            </li>
            <li class="fpgl-tc-drp_4" style="width: 570px; margin-left: -150px; margin-top:2px">
                <p class="jsgl_7">
                    <span style="color: red">温馨提示：</span>请勿在此步骤下单，需要在第四步对商品型号等信息进行确认后再下单付款。</p>
            </li>
            <li class="fpgl-tc-qxjs_4" style="position: fixed; bottom:55px; width: 264px; text-align: center;
                margin-left: 0px;">主产品停留倒计时：<label id="lblMinute" style="margin: 0px 5px; color: Red;">0</label>分<label id="lblSecond" style="margin: 0px 5px; color: Red;">0</label>秒 </li>
            <li class="fpgl-tc-qxjs_4" style="position: fixed; bottom: 10px; text-align: center;
                margin-left: 0px;">
                <p>
                    <input class="input-butto100-hs" type="button" value="上一步 " onclick="javascript:window.location.href='<?=$this->createUrl('task/taskTwo',array('taskid'=>$usertaskid))?>'">
                </p>
                <p>
                    <input title="亲,商品停留十分钟并且勾选以上对应按钮后方可激活该按钮" style="width:128px;height:35px;" 
                    onclick="Submit('<?=$usertaskid?>')" class="input-butto100-xshs" type="button" id="btnSubmit" disabled="disabled" value="下一步 ">
                </p>
            </li>
            <li style="position: fixed; bottom: 20px; right: 30px;"><span>任务释放倒计时：<label id="lblMinute2" style="color: Red;">50</label>
                分
                <label id="lblSecond2" style="color: Red;">32</label>
                秒</span> </li>
        </ul>
        <div>
            <script type="text/javascript">
                var m1='<?=floor($stopmin/60);?>';
                var s2='<?=($stopmin%60);?>';
                Timesa(m1, s2)</script>
            <script type="text/javascript">
                var m='<?=floor($setfreetime/60);?>';
                var s='<?=$setfreetime%60;?>';
                Timesb(m, s)</script>
        </div>
    </div>
</form>


</body></html>
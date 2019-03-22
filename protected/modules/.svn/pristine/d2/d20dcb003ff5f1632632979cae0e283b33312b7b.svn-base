<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>

</head>
<script>
	function Timesa(second) {
            second--;
            if (second <= 0) {
                second = 0;
            }
            if (second == 0) {
				$("#btnNext").css({background:'#bb0a0a'})
                $("#btnNext").attr("onclick", "Submit()");
                $("#btnNext").parent().attr("class", "login_4");
                $("#btnNext").text("下一步");
				
            }
            else {
				
				$("#btnNext").css({background:'#878787'})
                $("#btnNext").removeAttr("onclick");
                $("#btnNext").text("信息确认 " + second + " 秒");
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

	function Submit() {
		var taskId = $("#TaskID").val();
		$("#fm").submit();
	}	
	
	
</script>
<body>
    <!--[if lt IE 8]>

<script language="javascript" type="text/javascript">
$.openAlter('<div style="font-size:18px;text-align:left;line-height:30px;">hi,你当前的浏览器版本过低，可能存在安全风险，建议升级浏览器：<div><div style="margin-top:10px;color:red;font-weight:800;">谷歌Chrome&nbsp;&nbsp;,&nbsp;&nbsp;UC浏览器</div>', "提示", { width: 250, height: 50 });
$("#ow_alter002_close").remove();
</script>
<![endif]-->
<?php $rukou=$this->liuliangrukou($taskinfo['intlet']);?>
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="开始任务">
         <?php $this->renderPartial("/public/header");?>
        
<form action="<?php echo $this->createUrl('task/taskone');?>" enctype="multipart/form-data" id="fm" method="post">        
<div class="jsgl_pt hauto">
            <ul>
                
                <li class="jsgl_pt_2" style="width:100%;text-align:center">第一步</li>
                
            </ul>
        </div>
        <!--1 -->
        <div class="ksrf ksrf_hg hauto">
             <input id="TaskID" name="taskid" type="hidden" value="<?=$taskinfo['id']?>">
            <ul>
                <li>任务编号：<?=$taskinfo['tasksn']?><br>
                    任务类型：<?=$rukou['intletarr'][$taskinfo['intlet']]?><br>
                    下单终端：<em>
                            <span style="color: Red"><?=$rukou['terminal']?></span>
                    </em>
                    <br>
                    入口：<em>
                            <span style="color: Red"><?=$rukou['entrance']?></span>
                    </em>
                    <br>
                    进入商品页方式：
                        <span><?=$rukou['searchtype']?></span>
<br>
                    <em>此任务只能使用 <?=$rukou['entrance']?> 下单</em><br>
                    </li><li>任务说明：
					
					<?php if ($taskinfo['remark']):?>
					
						<br>
<textarea readonly="readonly" class="ksrf_7" name="textarea" id="textarea" cols="45" rows="5"><?=$taskinfo['remark']?></textarea>						
					
                        <?php else:?>
                         <span>(无)</span>
                        <?php endif;?>
                    </li>
                    <li>
                        <span style="float:none;color:red">温馨提示:</span>
                      若支付金额与担保金额的<span style="float:none;color:red">差额&gt;50元</span>，在平台将<span style="float:none;color:red">无法提交订单</span>。遇到这种情况时，请勿在淘宝进行下单操作。
                    </li>
                    任务释放倒计时：<span><label id="lblMinute" style="color: Red;">29</label>
                        分
                        <label id="lblSecond" style="color: Red;">49</label>
                        秒</span>
                
                <li class="login_4"><a id="btnNext" href="javascript:void(0);">下一步</a></li>
            </ul>
                <script type="text/javascript">
                    Timesa('<?=$time10;?>')</script>
                <script type="text/javascript">
                var m='<?=floor($setfreetime/60);?>';
                var s='<?=$setfreetime%60;?>';
                Timesb(m, s
				)</script>
        </div>
</form>
    </div>
    
	
	 <?php $this->renderPartial("/public/footer");?>  


</body></html>
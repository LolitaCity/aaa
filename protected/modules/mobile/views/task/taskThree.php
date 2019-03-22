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
    
    <script type="text/javascript">
        $(document).ready(function () {
            if ($("#serviceValidation").length > 0) {
                $.openAlter($("#serviceValidation").text(), "提示");
            }
            var check = $("#ulCheck [type='checkbox']").length;
            if (check > 0) {
                var isChecked = $("#ulCheck [type='checkbox']:checked").length;
                if (isChecked != check) {
                    $("#btnNext").removeAttr("onclick");
                }
            }
            $("#ulCheck [type='checkbox']").click(function () {
                var nowChecked = $("#ulCheck [type='checkbox']:checked").length;
                if (nowChecked == check) {
                    var minute = $("#lblMinute").text();
                    var second = $("#lblSecond").text();
                    if (minute == "0" && second == "0") {
                        $("#btnNext").attr("onclick", "Submit()");
                        $("#btnNext").parent().attr("class", "login_4");
                    }
                    else {
                        $("#btnNext").removeAttr("onclick");
                        $("#btnNext").parent().attr("class", "login_4G");
                    }
                }
                else {
                    $("#btnNext").removeAttr("onclick");
                    $("#btnNext").parent().attr("class", "login_4G");
                }
            });
        })
        function Submit() {
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
                        $("#btnNext").attr("onclick", "Submit()");
                        $("#btnNext").parent().attr("class", "login_4");
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

    
</head>
<body>
    <div class="cm" style="padding-bottom: 50px;">
 <?php $this->renderPartial("/public/header");?>
        
<form action="<?php echo $this->createUrl('task/taskthree')?>" enctype="multipart/form-data" id="fm" method="post">       
			<div class="jsgl_pt hauto">
            <ul>
                    <li class="jsgl_pt_1"><a href="<?=$this->createUrl('task/taskTwo',array('taskid'=>$usertaskid))?>">上一步</a></li>
                <li class="jsgl_pt_2" style="position: absolute; z-index: -999; left: 0; top: 89px;
                    width: 100%; text-align: center">第三步</li>
                
            </ul>
        </div>
        <!--1 -->
        <div class="ksrf ksrf_hg hauto">
             <input id="TaskID" name="usertaskid" type="hidden" value="<?=$usertaskid;?>">        
            <ul id="ulCheck">
                <li><b>请完成以下操作，并在完成后勾选对应按钮：<?=$usertaskid;?></b> </li>
                <div class="weui_cells weui_cells_checkbox" style="margin-top: 5px; font-size: 14px;">
                        <?php if ($buytype->c_goods>=50){?>
                        <label class="weui_cell weui_check_label" for="checkbox2">
                            <div class="weui_cell_hd">
                                <input type="checkbox" class="weui_check" name="checkbox" id="checkbox2">
                                <i class="weui_icon_checked"></i>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>
                                    收藏商品</p>
                            </div>
                        </label>
						<?php } if ($buytype->bookmark>=50){?>
						<label class="weui_cell weui_check_label" for="checkbox1">
                            <div class="weui_cell_hd">
                                <input type="checkbox" class="weui_check" name="checkbox" id="checkbox1">
                                <i class="weui_icon_checked"></i>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>
                                    收藏店铺</p>
                            </div>
                        </label>
						<?php } if ($buytype->talk>=50){?>
                        <label class="weui_cell weui_check_label" for="checkbox3">
                            <div class="weui_cell_hd">
                                <input type="checkbox" class="weui_check" name="checkbox" id="checkbox3">
                                <i class="weui_icon_checked"></i>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>
                                    买前咨询聊天</p>
                            </div>
                        </label>
						<?php }$maxsame=0; $deep=unserialize($buytype->deep);if ($deep['net']<40){
                array_shift($deep);$max2=array_search(max($deep),$deep);
            }
            if ($deep[$max]>30){ $numdeep=substr($max2,-1);?>
                        <label class="weui_cell weui_check_label" for="checkbox4">
                            <div class="weui_cell_hd">
                                <input type="checkbox" class="weui_check" name="checkbox" id="checkbox4">
                                <i class="weui_icon_checked"></i>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>浏览店内<?=@$numdeep;?>款其他商品</p>
                            </div>
                        </label>
						
			<?php }$max=0; $xhome=unserialize($buytype->x_home);if ($xhome['not']<40){
                array_shift($xhome);$max=array_search(max($xhome),$xhome);
               }
               if ($xhome[$max]>30){ $num=substr($max,-1);
                ?>			
                        <label class="weui_cell weui_check_label" for="checkbox6">
                            <div class="weui_cell_hd">
                                <input type="checkbox" class="weui_check" name="checkbox" id="checkbox6">
                                <i class="weui_icon_checked"></i>
                            </div>
                            <div class="weui_cell_bd weui_cell_primary">
                                <p>货比<?=@$num;?>家</p>
                            </div>
                        </label>
			   <?php }?>
                </div>
                <li>任务说明：
				 <?php if ($remark):?>
                    <br>
                    <textarea readonly="readonly" class="ksrf_7" name="textarea" id="textarea" cols="45" rows="5"><?=$remark;?></textarea>
                <?php else:?>
                    <span>(无)</span>
                <?php endif;?>			
				
                </li>
                <li style="line-height: 30px;"><span style="color: red">温馨提示：</span><span style="color: #888">请勿在此步骤下单，需要在第四步对商品型号等信息进行确认后再下单付款。</span></li>
				
				
                <li style="line-height: 30px;">任务释放倒计时：<span><label id="lblMinute2" style="color: Red;">59</label>
                    分
                    <label id="lblSecond2" style="color: Red;">8</label>
                    秒</span></li>
                <li style="line-height: 40px;">主产品停留倒计时：<label id="lblMinute" style="color: Red;
                    margin: 0px 5px;">9</label>分<label id="lblSecond" style="color: Red; margin: 0px 5px;">9</label>秒</li>
                
                <li class="login_4G"><a id="btnNext" href="javascript:void(0)">下一步</a></li>
            </ul>
                 <script type="text/javascript">
                var m1='<?=floor($stopmin/60);?>';
                var s2='<?=($stopmin%60);?>';
                Timesa(m1, s2)</script>
            <script type="text/javascript">
                var m='<?=floor($setfreetime/60);?>';
                var s='<?=$setfreetime%60;?>';
                Timesb(m, s)</script>
        </div>
</form>
    </div>
    
 <?php $this->renderPartial("/public/footer");?>
  	

</body></html>
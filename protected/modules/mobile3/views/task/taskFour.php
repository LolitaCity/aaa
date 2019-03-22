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
	<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>/myUpload/css/upimg.css">
    <script type="text/javascript" src="<?=SITE_URL;?>/myUpload/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>/myUpload/js/myUploadmobile.js"></script>	
    
    <script src="<?=M_JS_URL;?>CustomFunc.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            

            $("#txtPayPrice").live("keyup", function () {
                if (!isNaN(parseFloat($("#txtPayPrice").val()))) {
                    $("#sDifferencePrice").text((parseFloat($("#txtPayPrice").val()) - parseFloat($("#sTaskPrice").text())).toFixed(2));
                    $("#sPunishPrice").text((parseFloat($("#txtPayPrice").val()) * 0.01).toFixed(2));
                }
            });

            $("#ckList [type='checkbox']").click(function () {
                if($("#ckList input[type='checkbox']:checked").length==4) //表示已全选
                {
                    $("#btnCheck").attr("onclick", "CheckOrderNumber()");
                    $("#btnCheck").parent().attr("class", "jsgl_pt_1");                        
                         if($("#ulSubmitOrderInfo").css('display')!="none")
                         {
                            $("#lGetPoint1").hide();
                            $("#lGetPoint2").show();
                         }
                         
                 }
                 else
                 {
                    $("#btnCheck").removeAttr("onclick");
                    $("#btnCheck").parent().attr("class", "jsgl_pt_1g");
                          $("#lGetPoint1").show();
                          $("#lGetPoint2").hide();
                  }
                            
            });

        })
        function SubmitAudit(taskID) {
			
			if ($("#txtPayPrice").val() == "" || $("#txtPayPrice").val() == null) {
				$.openAlter("请输入付款金额", "提示");
				return;
			}
			if (parseFloat($("#txtPayPrice").val()) <= 0) {
				$.openAlter("付款金额必须大于0", "提示");
				return;
			}
			var platformType = "淘宝";
			if (platformType == "淘宝") {
				if ($("#selPayMethod").val() == "" || $("#selPayMethod").val() == null) {
					$.openAlter("请选择支付方式", "提示");
					return;
				}
			}
			if ($('input[name="orderimg"]').val() == ""||$('input[name="orderimg"]').val() == null) {
				$.openAlter("请上传订单截图", "提示");
				return;
			}
    
            $("#PlatformOrderNumber").val($("#sPlatformOrderNumber").text());
            $("#DoType").val("SubmitAudit");

            if($("#lGetPoint2").length>0)
            {
                $("#lGetPoint2 a").text("提交中...");
                $("#lGetPoint2").attr("class", "login_4G");
                $("#lGetPoint2 a").attr("onclick", "");
            }

            $("#fm").submit();
        }

        function ShowChange() {
            var selPayMethodValue = $("#selPayMethod").val();
            if (selPayMethodValue == "1") {
                $("#spanViolationsAmount1").text("刷卡费用：");
                $("#spanViolationsRemark1").text("信用卡付款");
                $("#liTaskPunish1").show();
            }else if(selPayMethodValue == "3"){
                $("#spanViolationsAmount1").text("花呗费用：");
                $("#spanViolationsRemark1").text("花呗付款");
                $("#liTaskPunish1").show();
            }
            else {
                $("#liTaskPunish1").hide();
            }
        }
        function SelPayMethod2L(){
            var selPayMethodValue = $("#selPayMethod2L").val();
            if (selPayMethodValue == "0") {
                $("#liTaskPunish").hide();
            }else if(selPayMethodValue == "3"){
                $("#spanViolationsAmount").text("花呗费用：");
                $("#spanViolationsRemark").text("花呗付款");
                $("#lblPunishPrice").text((parseFloat($("#lblPayPrice").text()) * 0.01).toFixed(2));
                $("#liTaskPunish").show();
            }
            else {
                $("#liTaskPunish").hide();
            }
        }
        function Submit() {
            $("#PlatformOrderNumber").val($("#lblPlatformOrderNumber").text());
            $("#fm").submit();
        }

        function CheckOrderNumber() {
            var orderNumber = $("#txtPlatformOrderNumber").val();
            var taskID = '<?=$taskinfo['id'];?>';
            if ($.trim(orderNumber) == "" || $.trim(orderNumber) == null) {
                $.openAlter("平台订单编号请输入", "提示");
                return;
            }
            var platformType="淘宝";
            if (orderNumber.indexOf(' ') > -1) {
                $("<li>订单编号不允许包含空格.</li>").appendTo($("#clientValidationOL"));
                $.openAlter("订单编号不允许包含空格", "提示");
                return false;
            }
            else if (!/^\d+$/.test(orderNumber)) {
                
                $.openAlter("订单编号必须为纯数字", "提示");
                return false;
            }

            if(platformType=="淘宝")
            {
                    if (orderNumber.length < 15) {
                $.openAlter("淘宝订单编号不正确,订单编号为15-20位的纯数字", "提示");
                return false;
						}
                  if (orderNumber.length == 15) {
                var value = orderNumber.substring(0, 1);
                if (value != "8" && value != "9") {
                    $.openAlter("订单编号出错，请仔细检查或联系客服", "提示");
                    return false;
                }
            }
            }
            orderNumber = $.trim(orderNumber);
            $("#checkNumber").show();
			$("#PlatformOrderNumber").val(orderNumber);
			$("#ulSubmitOrderInfo").show();
			$("#ulGetOrderInfo").hide();
			$("#ulButton").hide();
			$("#sPlatformOrderNumber").text(orderNumber);
				
			if($("#ckList input[type='checkbox']:checked").length==4) //表示已全选
			{
					
					 if($("#ulSubmitOrderInfo").css('display')!="none")
					 {
						$("#lGetPoint1").hide();
						$("#lGetPoint2").show();
					 }
			}
			else{
					$("#lGetPoint1").show();
					$("#lGetPoint2").hide();
			}
			                 
                
            
        }

        function clearNoNum(event, obj) {
            //响应鼠标事件，允许左右方向键移动 
            event = window.event || event;
            if (event.keyCode == 37 | event.keyCode == 39) {
                return;
            }
            //先把非数字的都替换掉，除了数字和. 
            obj.value = obj.value.replace(/[^\d.]/g, "");
            //必须保证第一个为数字而不是. 
            obj.value = obj.value.replace(/^\./g, "");
            //保证只有出现一个.而没有多个. 
            obj.value = obj.value.replace(/\.{2,}/g, ".");
            //保证.只出现一次，而不能出现两次以上 
            obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
            obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3'); //只能输入两个小数  
        }
        function checkNum(obj) {
            //为了去除最后一个. 
            obj.value = obj.value.replace(/\.$/g, "");
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
        function FinishUpload() {
            setTimeout("removeFinish()", 1000);
        }

        function removeFinish(){
            $("#sUpload1Success").hide();
        }

        var su= 0;
        //选择图片
        function showPic($url,$id,$sow,$lang){
            var pic = $(""+$id+"").get(0).files[0];
            su =$sow;
            if(pic){
                if(pic['size']>=2097152){
                    $(""+$sow+"").html("不能超过1M");
                }else{
                    $(""+$lang+"").prop("src" , window.URL.createObjectURL(pic) );
                    $(""+$sow+"").html( 0 +"%" );
                    uploadFile($url,$id,$sow);
                }
            }
        }
        //上传图片
        function uploadFile($url,$id,$sow){
            var pic = $(""+$id+"").get(0).files[0];
            var formData = new FormData();
            var u = $url;
            formData.append("file" , pic);
            /**
                * 必须false才会避开jQuery对 formdata 的默认处理
                * XMLHttpRequest会对 formdata 进行正确的处理
                */
            $.ajax({
                type: "POST",
                url: u,
                data: formData ,
                processData : false,
                //必须false才会自动加上正确的Content-Type
                contentType : false ,
                xhr: function(){
                    var xhr = $.ajaxSettings.xhr();
                    if(onprogress && xhr.upload) {
                        xhr.upload.addEventListener("progress" , onprogress, false);
                        return xhr;
                    }
                },success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.status==1){
                        alert(obj.content);
                        $("#tu").val("<?php echo SITE_URL ?>"+obj.url);
                    }else{
                        alert(obj.content);
                    }
                    $(""+$sow+"").html(obj.content);
                    $(""+$sow+"").css({"color":"#00FF00","border":"10px 10px 5px #888888"});
                },
                error:function(xhr){ //上传失败
                    alert("上传失败");
                    $(""+$sow+"").html("上传失败" );
                    $(""+$sow+"").css({"color":"red","border":"10px 10px 5px #888888"});
                }
            });
        }
        /**
           * 侦查附件上传情况 ,这个方法大概0.05-0.1秒执行一次
           */
        function onprogress(evt){
            var loaded = evt.loaded;     //已经上传大小情况
            var tot = evt.total;      //附件总大小
            var per = Math.floor(100*loaded/tot);  //已经上传的百分比
            $(""+su+"").html( per +"%" );
        }
    </script>
    <style>
    .icon_x1{width:20px; height:20px; float:left; margin-right:5px; }
    .icon_x1 img{width:100%;}
	.simg{width:100px!important;height:70px!important}
    </style>

</head>
<body>
    <div class="cm" style="padding-bottom: 50px;">
<?php $this->renderPartial("/public/header");?>
        
<form action="<?php $this->createUrl('task/taskfour')?>" enctype="multipart/form-data" id="fm" method="post">        
<div class="jsgl_pt hauto">
        <input id="TaskID" name="TaskID" type="hidden" value="<?=$taskinfo['id']?>">
        <input id="PlatformOrderNumber" name="ordernum" type="hidden" value="">
        <input id="DoType" name="DoType" type="hidden" value="">
        <input id="SubmitData" name="SubmitData" type="hidden" value=""/>

            <ul>
                    <li class="jsgl_pt_1"><a href="<?=$this->createUrl('task/taskthree',array('usertaskid'=>$taskinfo['id']))?>">上一步</a></li>
                    <li class="jsgl_pt_2" style="position: absolute; z-index: -999; left: 0; top: 89px;
                        width: 100%; text-align: center">第四步</li>
                
            </ul>
        </div>
        <!--1 -->
        <div class="ksrf ksrf_hg hauto">
            <ul id="ckList">
                    <li class="ksrf_1"><a href="<?=$taskinfo['image']?>" onclick="javascript:void(0)" title="点击查看原图">
                        <img src="<?=$taskinfo['image']?>">
                    </a></li>
                <div class="weui_cells_title" style="margin-top: 3px">
                    请核对以下信息，确认无误后下单付款:<?=$usertaskid;?></div>
                <div class="weui_cells weui_cells_checkbox" style="font-size: 14px;">
                    
                    <label class="weui_cell weui_check_label" for="checkbox1">
                        <div class="weui_cell_hd">
                            <input type="checkbox" class="weui_check" name="checkbox" id="checkbox1">
                            <i class="weui_icon_checked"></i>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>
                                店铺名：<label for="checkbox1"><?=$taskinfo['shopname']?></label>
                            </p>
                        </div>
                    </label>
                    <label class="weui_cell weui_check_label" for="checkbox2">
                        <div class="weui_cell_hd">
                            <input type="checkbox" class="weui_check" name="checkbox" id="checkbox2">
                            <i class="weui_icon_checked"></i>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>
                                型号：
                                    <label for="checkbox2"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认';?></label>
                            </p>
                        </div>
                    </label>
                    <label class="weui_cell weui_check_label" for="checkbox3">
                        <div class="weui_cell_hd">
                            <input type="checkbox" class="weui_check" name="checkbox" id="checkbox3">
                            <i class="weui_icon_checked"></i>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>
                                件数：<?=$taskinfo['auction']?></p>
                        </div>
                    </label>
                    <label class="weui_cell weui_check_label" for="checkbox4">
                        <div class="weui_cell_hd">
                            <input type="checkbox" class="weui_check" name="checkbox" id="checkbox4">
                            <i class="weui_icon_checked"></i>
                        </div>
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>
                                任务金额：<?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?>元</p>
                        </div>
                    </label>
                    <label class="weui_cell weui_check_label" for="checkbox4">
                        <div class="weui_cell_bd weui_cell_primary" style="color: #888">
                            <p style="float: left; width: 27%;">
                                友情提醒：</p>
                            <p style="float: left; width: 73%;">
                                如果实际付款金额超过<span style="color: red"><?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express']+50;?></span>元，<span style="color: red">请不要下单付款</span></p>
                        </div>
                    </label>
                    
                </div>
                <li class="ksrf_4">
                    <p class="ksrf_2" style="width: 60%;">
                        <input type="text" maxlength="20" name="textfield" class="txsq_100" id="txtPlatformOrderNumber" placeholder="请输入订单编号" style=""></p>
                    <p class="jsgl_pt_1g" style="float: right; margin-top: 5px;">
                        <a href="javascript:void(0)" id="btnCheck">验证</a>
					</p>
                </li>
            </ul>
            <ul id="ulSubmitOrderInfo" style="display: none;">
                <li style="margin-top: 10px;">
                    <div style="display: none;">
                        <p>
                            <span class="fpgl-tc-drp2">订单编号：</span><span id="sPlatformOrderNumber"></span>
                        </p>
                        <p>
                        </p>
                        <p>
                            <span class="fpgl-tc-drp2">任务金额：</span><span id="sTaskPrice"><?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?></span>元
                        </p>
                    </div>
                    <p class="ksrf_3" style="width: 70%;">
                        付款金额：
                        <input type="text" name="PayPrice" id="txtPayPrice" class="txsq_100" onkeyup="clearNoNum(event,this)" style="width: 45%;" onblur="checkNum(this)">
                        <label>
                            元</label>
                    </p>
                    <br>
                    <p class="ksrf_3">
                        差额：<span id="sDifferencePrice">0</span>元
                    </p>
                    <div class="ksrf_3" style="width:100%">
                        <font style="float:left">订单截图：</font>
                        <div id="upimg1">
                            <div class="myupload-container">
                                <div class="table" role="myupload-file-input-btn"><div class="content table-cell defalut" style="">
                                        <input type="file" id="pic02" name="pic02" onchange="showPic('<?php echo SITE_URL.'task/TasktestOne01';?>','#pic02','#son02','#lang02')" style="background：red;width:88px;height:60px;opacity: 0"/>

                                    </div>
                                </div>
                                <input type="file" name="file" role="myupload-file-input" accept="image/*" style="display:none;">
                                <div class="table" style="position:relative;"><div class="content table-cell" style="">
                                        <img class="simg" width="100" height="70" role="myupload-picture-show" id="lang02">
                                        <input type="hidden" name="orderimg" role="myupload-picture-input" value="" id="tu">
                                        <span id="son02" style="position:relative;bottom:40px;color:#00FF00;"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                        <p class="ksrf_3">
                            <span class="fpgl-tc-drp2" style="line-height: 28px;">支付方式：</span> <span>
                                <select name="PayMethod" class="input_170" id="selPayMethod" onchange="ShowChange()">
                                    <option value="">请选择支付方式</option>
									<option value="zhifubao">支付宝</option>
									<option value="xinyongka">信用卡</option>
									<option value="huabei">花呗支付</option>
									
                                </select>
                        </span></p>
                    <div id="liTaskPunish1" style="display: none;">
                        <p class="ksrf_3">
                            <span class="fpgl-tc-drp2" id="spanViolationsAmount1">刷卡费用：</span> <span id="sPunishPrice">
                                0</span>元
                        </p>
                        <p class="ksrf_3">
                            <span class="fpgl-tc-drp2">备注：</span><span id="spanViolationsRemark1">信用卡付款</span>
                        </p>
                    </div>
                </li>
            </ul>
     
                <ul>
                    <li>任务释放倒计时：<span><label id="lblMinute" style="color: Red;">42</label>
                        分
                        <label id="lblSecond" style="color: Red;">58</label>
                        秒</span></li>
                </ul>
            <ul>
                
                <li id="lGetPoint1" class="login_4G"><a href="javascript:void(0)">领取佣金/提交审核</a></li>
				<li id="lGetPoint2" style="display: none;" class="login_4"><a href="javascript:void(0)" onclick="SubmitAudit('<?=$taskinfo['id']?>')">
				提交审核</a></li>
            </ul><script type="text/javascript">
                    var m='<?=floor($setfreetime/60);?>';
                    var s='<?=$setfreetime%60;?>';
                    Timesb(m, s)
                </script>
        </div>
</form>
    </div>
    
<?php $this->renderPartial("/public/footer");?>


</body></html>
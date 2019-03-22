<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
<link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
<link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
<link rel="stylesheet" type="text/css"
	href="<?=SITE_URL;?>myUpload/css/upimg.css">
<script type="text/javascript"
	src="<?=SITE_URL;?>myUpload/js/jquery.form.js"></script>
<script type="text/javascript"
	src="<?=SITE_URL;?>myUpload/js/myUploadForOne.js"></script>
</head>
<?php $rukou=$this->liuliangrukou($taskinfo['intlet']);?>
<body style="background: #fff;">
	<!--列表 -->
	<div class="htyg_tc">
		<ul>
			<li class="htyg_tc_1"><label> <label>
                    任务编号: <?=$taskinfo['tasksn']?></label>(<?=$rukou['intletarr'][$taskinfo['intlet']]?>)
            </label></li>
			<li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse"
				onclick="javascript:self.parent.$.closeWin();self.parent.parent.$.closeWin();">
					<img src="<?=S_IMAGES;?>sj-tc.png">
			</a></li>
		</ul>
	</div>

	<script type="text/javascript">
    $(document).ready(function() {
        if ($("#serviceValidation").length > 0) {
            if ($.trim($("#serviceValidation").text()) == "提交审核资料失败:操作失败，商家余额不足") {
                $.openAlter("<div style='text-align:left'>商家余额不足，提交订单失败，请联系平台管理员。友情提醒：<label style='color:red'>请等待管理员处理，不要退出任务，不能申请退款！</label></div>", "提示");
            } else if ($.trim($("#serviceValidation").text()) == "未验证商品") {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, top: 500, height: 50 }, function() { window.location.href = 'BeginTaskTwo?taskID=V6955020050' });
            } else if ($.trim($("#serviceValidation").text()) == "主产品停留倒计时未超过10分钟") {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, top: 500, height: 50 }, function() { window.location.href = 'BeginTaskThree?taskID=V6955020050' });
            } else if ($.trim($("#serviceValidation").text()) == "商品搜索主图为空") {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, top: 500, height: 50 }, function() { window.location.href = 'BeginTaskTwo?taskID=V6955020050' });
            } else {
                $.openAlter($("#serviceValidation").text(), "提示");
            }
        }
        $("#txtPayPrice").live("keyup", function() {
            if (!isNaN(parseFloat($("#txtPayPrice").val()))) {
                $("#sDifferencePrice").text((parseFloat($("#txtPayPrice").val()) - parseFloat($("#sTaskPrice").text())).toFixed(2));
                $("#sPunishPrice").text((parseFloat($("#txtPayPrice").val()) * 0.01).toFixed(2));
            }
        });

        $("#ckList [type='checkbox']").click(function() {
            if ($("#ckList input[type='checkbox']:checked").length == 4) //表示已全选
            {
                $("#btnSubmit").attr("disabled", false);
                $("#btnSubmit").attr("class", "input-butto100-xls");
                if ($("#btnSubmitAudit1").length > 0) {
                    $("#btnSubmitAudit1").attr("class", "input-butto100-ls");
                    $("#btnSubmitAudit1").attr("onclick", "SubmitAudit('<?=$taskinfo['id']?>')");
                } else {
                    $("#btnSubmitAudit1").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit1").attr("onclick", "");
                }
                if ($("#btnSubmitAudit2").length > 0) {
                    $("#btnSubmitAudit2").attr("class", "input-butto100-ls");
                    $("#btnSubmitAudit2").attr("onclick", "SubmitAudit('<?=$taskinfo['id']?>')");
                } else {
                    $("#btnSubmitAudit2").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit2").attr("onclick", "");
                }
                if ($("#btnGetPoint").length > 0) {
                    $("#btnGetPoint").attr("class", "input-butto100-ls");
                    $("#btnGetPoint").attr("onclick", "ReceivePoint('<?=$taskinfo['id']?>')");
                } else {
                    $("#btnGetPoint").attr("class", "input-butto100-xshs");
                    $("#btnGetPoint").attr("onclick", "");
                }
            } else {
                $("#btnSubmit").attr("disabled", "disabled");
                $("#btnSubmit").attr("class", "input-butto100-xshs");
                if ($("#btnSubmitAudit1").length > 0) {
                    $("#btnSubmitAudit1").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit1").attr("onclick", "");
                }
                if ($("#btnSubmitAudit2").length > 0) {
                    $("#btnSubmitAudit2").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit2").attr("onclick", "");
                }
                if ($("#btnGetPoint").length > 0) {
                    $("#btnGetPoint").attr("class", "input-butto100-xshs");
                    $("#btnGetPoint").attr("onclick", "");
                }
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
        var orderprice=$.trim($('#txtPayPrice').val());
        var tureprice='<?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express']+50;?>'

        if (parseFloat(orderprice)>parseFloat(tureprice)) {
            $.openAlter("差价大于50不能提交", "提示");
            return false;
        }

        $("#PlatformOrderNumber").val($("#sPlatformOrderNumber").text());
        $("#DoType").val("SubmitAudit");
        if ($("#btnSubmitAudit1").length > 0) {
            $("#btnSubmitAudit1").val("提交中...");
            $("#btnSubmitAudit1").attr("class", "input-butto100-xshs");
            $("#btnSubmitAudit1").attr("onclick", "");
        }
        if ($("#btnSubmitAudit2").length > 0) {
            $("#btnSubmitAudit2").val("提交中...");
            $("#btnSubmitAudit2").attr("class", "input-butto100-xshs");
            $("#btnSubmitAudit2").attr("onclick", "");
        }
        $("#fm").submit();
    }

    //得到文件扩展名

    function GetFileName(file_name) {
        var point = file_name.lastIndexOf(".");
        var result = file_name.substr(point);
        if (result != "" && result != null)
            result = result.toLowerCase();
        return result;
    }

    function ShowChange() {
        var selPayMethodValue = $("#selPayMethod").val();
        if (selPayMethodValue == "1") {
            $("#spanViolationsAmount1").text("刷卡费用：");
            $("#spanViolationsRemark1").text("信用卡付款");
            $("#liTaskPunish1").show();
        } else if (selPayMethodValue == "3") {
            $("#spanViolationsAmount1").text("花呗费用：");
            $("#spanViolationsRemark1").text("花呗付款");
            $("#liTaskPunish1").show();
        } else {
            $("#liTaskPunish1").hide();
        }
    }

    function SelPayMethod2L() {
        var selPayMethodValue = $("#selPayMethod2L").val();
        if (selPayMethodValue == "0") {
            $("#liTaskPunish").hide();
        } else if (selPayMethodValue == "3") {
            $("#spanViolationsAmount").text("花呗费用：");
            $("#spanViolationsRemark").text("花呗付款");
            $("#lblPunishPrice").text((parseFloat($("#lblPayPrice").text()) * 0.01).toFixed(2));
            $("#liTaskPunish").show();
        } else {
            $("#liTaskPunish").hide();
        }
    }

    function Submit() {
        $("#PlatformOrderNumber").val($("#lblPlatformOrderNumber").text());
        $("#fm").submit();
    }

    function CheckOrderNumber() {
        var orderNumber = $("#txtPlatformOrderNumber").val();
        //var taskID = '<?=$taskinfo['id'];?>';
        if ($.trim(orderNumber) == "" || $.trim(orderNumber) == null) {
            $.openAlter("平台订单编号请输入", "提示");
            return;
        }
        var platformType = "淘宝";
        if (orderNumber.indexOf(' ') > -1) {
            $("<li>订单编号不允许包含空格.</li>").appendTo($("#clientValidationOL"));
            $.openAlter("订单编号不允许包含空格", "提示");
            return false;
        } else if (!/^\d+$/.test(orderNumber)) {

            $.openAlter("订单编号必须为纯数字", "提示");
            return false;
        }

        if (platformType == "淘宝") {
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

        var rsData =  null ;
        $.ajaxSettings.async = false; 
        var url = "<?=SITE_URL?>/Other/OrderSN_Count?OrderSN="+ orderNumber ;  
        $.getJSON( url , function(rs) {
        	rsData = rs ;
        }) ;
		$.ajaxSettings.async = true;

		if(rsData && rsData.IsOK==false){
			alert(rsData.Des) ; return ;
		} 

        
        orderNumber = $.trim(orderNumber);
        $("#checkNumber").hide();
        $("#PlatformOrderNumber").val(orderNumber);
       // $.openAlter(data.Message.replace("操作成功但", ""), "提示");
        $("#ulSubmitOrderInfo").show();
        $("#ulGetOrderInfo").hide();
        $("#ulButton").hide();
        $("#sPlatformOrderNumber").text(orderNumber);
        if ($("#ckList input[type='checkbox']:checked").length == 4) //表示已全选
        {
            if ($("#btnSubmitAudit1").length > 0) {
                $("#btnSubmitAudit1").attr("class", "input-butto100-ls");
                $("#btnSubmitAudit1").attr("onclick", "SubmitAudit('<?=$taskinfo['id']?>')");
            } else {
                $("#btnSubmitAudit1").attr("class", "input-butto100-xshs");
                $("#btnSubmitAudit1").attr("onclick", "");
            }
            if ($("#btnSubmitAudit2").length > 0) {
                $("#btnSubmitAudit2").attr("class", "input-butto100-ls");
                $("#btnSubmitAudit2").attr("onclick", "SubmitAudit('<?=$taskinfo['id']?>')");
            } else {
                $("#btnSubmitAudit2").attr("class", "input-butto100-xshs");
                $("#btnSubmitAudit2").attr("onclick", "");
            }
            } else {
                if ($("#btnSubmitAudit1").length > 0) {
                    $("#btnSubmitAudit1").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit1").attr("onclick", "");
                }
                if ($("#btnSubmitAudit2").length > 0) {
                    $("#btnSubmitAudit2").attr("class", "input-butto100-xshs");
                    $("#btnSubmitAudit2").attr("onclick", "");
                }
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
        } else {
            $("#lblMinute").text(minute);
            $("#lblSecond").text(second);
            setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }

</script>
	<style type="text/css">
.fpgl-tc-drp3 {
	margin-bottom: 10px;
}

#ckList input[type='checkbox'] {
	margin-right: 3px;
	position: relative;
	top: 2px;
}
</style>
	<style type="text/css">
#ulCheck li label {
	cursor: pointer;
}
</style>
	<form action="<?php $this->createUrl('task/taskfour')?>"
		enctype="multipart/form-data" id="fm" method="post">
		<!--列表 -->
		<div class="yctc_800 ycgl_tc_1" style="font-family: 微软雅黑">
			<input id="TaskID" name="TaskID" type="hidden"
				value="<?=$taskinfo['id']?>"> <input id="PlatformOrderNumber"
				name="ordernum" type="hidden" value=""> <input id="DoType"
				name="DoType" type="hidden" value=""> <input id="SubmitData"
				name="SubmitData" type="hidden" value="">
			<div class="person-level">
				<ul>
					<li class="m">进入购物平台</li>
					<li class="m">找到目标商品</li>
					<li class="m">模拟购物过程</li>
					<li class="end">下单付款</li>
				</ul>
			</div>
			<div class="fpgl-tc-drp_6" style="margin-left: 0px; float: left;">
				<ul id="ulCheck" style="width: 500px;">
					<li class="fpgl-tc-drp3" style="margin-top: 10px; width: 490px;">
						<p class="fpgl-tc-drp2" style="height: 40px; line-height: 25px;">
							选择对应商品：</p> <label style="width: 540px; line-height: 25px;">
							回到商品页面，核对以下信息，确认无误后方可下单付款： </label>
					</li>
					<li class="fpgl-tc-drp3" style="margin-top: -20px;" id="ckList">
						<div>
							<div style="width: 350px; margin-top: 10px; float: left;">
								<p class="jsgl_7">
									<input id="checkbox1" style="width: 20px; height: 20px;"
										type="checkbox">
								</p>
								<label for="checkbox1"> 店铺名：</label> <label for="checkbox1"
									title="<?=$taskinfo['shopname']?>"> <label for="checkbox1"><?=$taskinfo['shopname']?></label>
								</label>
							</div>
							<div style="float: left; margin-top: 10px; margin-left: -50px">
								<p class="jsgl_7">
									<input id="checkbox2" style="width: 20px; height: 20px;"
										type="checkbox">
								</p>
								<label for="checkbox2">
                                件数：<?=$taskinfo['auction']?></label>
							</div>
						</div>
						<div>
							<div style="width: 300px; margin-top: 10px; float: left;">
								<p class="jsgl_7">
									<input id="checkbox3" style="width: 20px; height: 20px;"
										type="checkbox">
								</p>
								<p class="sk-hygl_7_r" style="text-align: right">型号：</p>
								<p
									style="width: 200px; word-wrap: break-word; margin-left: 80px; margin-top: -22px">
									<label for="checkbox3"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认';?></label>
								</p>

							</div>
							<div style="float: left; margin-top: 10px; margin-left: 0px">
								<p class="jsgl_7">
									<input id="checkbox4"
										style="width: 20px; height: 20px; margin-top: -1px"
										type="checkbox">
								</p>
								<label for="checkbox4">
                                付款金额：<?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?></label>
							</div>
						</div>
					</li>
					<li class="fpgl-tc-drp3" style="line-height: 28px;">
						<p class="fpgl-tc-drp2">提交订单编号：</p>
						<p>
							<input type="text" name="textfield" maxlength="20"
								style="height: 27px;" class="input_180"
								id="txtPlatformOrderNumber">
						</p>
						<p style="margin-left: 10px;">
							<input class="input-butto100-xshs" id="btnSubmit" type="button"
								value="提交" onclick=" CheckOrderNumber() " disabled="disabled">
						</p>
					</li>
					<li style="display: none;">
						<p class="fpgl-tc-drp_8">
							<img src="fpgl-tc-drp_2.jpg">
						</p>
					</li>
				</ul>
				<ul id="ulSubmitOrderInfo" style="display: none; height: 260px;">

					<li class="fpgl-tc-drp_9"
						style="height: 100%; background-color: White;">
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2">店铺名：</span><span><?=$taskinfo['shopname']?></span>
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2">订单编号：</span><span
								id="sPlatformOrderNumber"></span>
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2">任务金额：</span><span id="sTaskPrice"><?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?></span>元
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2" style="line-height: 28px;">付款金额：</span>
							<span> <input type="text" id="txtPayPrice" name="PayPrice"
								class="input_170" onkeyup=" clearNoNum(event, this) "
								onblur=" checkNum(this) "></span> <span
								style="line-height: 28px;">元</span>
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2">差额：</span> <span id="sDifferencePrice">0</span>元
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2">上传截图：</span>
						
						<div id="upimg1"></div> <script language="javascript">
                        $("#upimg1").upload({isMulti:true, pictureInputName:'orderimg'});
                    </script>
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<a target="_blank"
								href="<?=$this->createUrl('other/newsinfo',array('id'=>213))?>"
								style="margin-left: 100px; color: Red;">查看示例图</a>
						</p>
						<p class="clear"></p>
						<p class="fpgl-tc-drpq">
							<span class="fpgl-tc-drp2" style="line-height: 28px;">支付方式：</span>
							<span> <select name="PayMethod" class="input_170"
								id="selPayMethod" onchange="ShowChange()">
									<option value="">请选择支付方式</option>
									<option value="zhifubao">支付宝</option>
									<option value="bank">银行卡</option>
									<option value="xinyongka">信用卡</option>
									<option value="huabei">花呗支付</option>
							</select>
							</span>
						</p>
						<p class="clear"></p>
						<div id="liTaskPunish1" style="display: none;">
							<p class="fpgl-tc-drpq">
								<span class="fpgl-tc-drp2" id="spanViolationsAmount1">刷卡费用：</span>
								<span id="sPunishPrice"> 0</span>元
							</p>
							<p class="clear"></p>
							<p class="fpgl-tc-drpq">
								<span class="fpgl-tc-drp2">备注：</span><span
									id="spanViolationsRemark1">银行卡付款</span>
							</p>
						</div>
					</li>
					<li class="fpgl-tc-qxjs_4"
						style="position: fixed; bottom: 10px; margin-left: 251px;">
						<p>
							<input class="input-butto100-hs" type="button"
								onclick=" javascript:window.location.href = '<?=$this->createUrl('task/taskthree',array('usertaskid'=>$taskinfo['id']))?>' "
								value="上一步 ">
						</p>
						<p>
							<input onclick="" id="btnSubmitAudit2"
								class="input-butto100-xshs" style="width: 128px; height: 35px;"
								type="button" value="提交审核">
						</p>
					</li>
				</ul>
				<ul id="ulButton">
					<li class="fpgl-tc-qxjs_4"
						style="position: fixed; bottom: 10px; margin-left: 251px;">
						<p>
							<input class="input-butto100-hs" type="button" value="上一步 "
								onclick=" javascript:window.location.href = '<?=$this->createUrl('task/taskthree',array('usertaskid'=>$taskinfo['id']))?>' ">
						</p>
						<p>
							<input class="input-butto100-xshs"
								style="width: 158px; height: 35px;" type="button"
								value="提交审核/领取佣金">
						</p>
					</li>
				</ul>
				<ul>
					<li style="position: fixed; bottom: 20px; right: 30px;"><span>任务释放倒计时：<label
							id="lblMinute" style="color: Red;"></label> 分 <label
							id="lblSecond" style="color: Red;"></label> 秒
					</span></li>
				</ul>
				<div>
					<script type="text/javascript">
                    var m='<?=floor($setfreetime/60);?>';
                    var s='<?=$setfreetime%60;?>';
                    Timesb(m, s)
                </script>
				</div>
			</div>
			<div class="fpgl-tc-drp_2" style="width: 300px; margin-top: 10px;">
				<span>友情提醒：如果实际付款金额超过<label style="color: Red; font-weight: bolder;"><?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express']+50;?></label>
					元，<label style="color: Red; font-weight: bolder;">请不要下单付款!</label>
				</span> <a href="<?=$taskinfo['image']?>"
					onclick=" javascript:void(0) " target="_blank" title="点击查看原图"> <img
					style="height: 350px;" src="<?=$taskinfo['image']?>">
				</a>
			</div>

		</div>
	</form>


</body>
</html>
<!DOCTYPE html>
<?php

    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $webtitle->value;?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">

	
	<link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
	<link href="<?=M_CSS_URL;?>select2.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?=M_JS_URL;?>md5.js"></script>
	<script type="text/javascript" src="<?=M_JS_URL;?>select2.min.js"></script>
	<script type="text/javascript">
        $(function () {
            $('#selBankList').select2({
                'width':'160px',});
           
          
        });
    


        $(document).ready(function () {
            if ($("#serviceValidation").length > 0) {
                if ($("#serviceValidation").text().indexOf('可以将货款本金和佣金提现了哦') > -1) {
                    $.openAlter($("#serviceValidation").text(), "提示", { width: 250, height: 50 }, function () { window.location.href = '/Member/Withdrawals' }, "确定");
                }
            };
        })
          function DoClick() {
            var BankName = $("#selBankList").val();
            var usualBank="招商银行,中国工商银行,中国农业银行,中国银行,中国建设银行,交通银行,中信银行,浦发银行,中国民生银行,中国光大银行,农村商业银行,兴业银行,上海浦东发展银行,华夏银行,广发银行,深圳发展银行,平安银行,恒丰银行,浙商银行,渤海银行";
			if (!(usualBank.indexOf(BankName) >-1)) {
               $("#warntext").show();
            }else{
               $("#warntext").hide();
            }
        }
        function ok() {
			var msg = "";
			var BankName = $("#selBankList").val();
			var CardNumber = $("#txtCardNumber").val();
			var Pwd = $("#txtPwd").val();
			var txtPwd=$("#txtPwd").val();
			var Province = $("#s1").find('option:selected').text();
			var City=$("#s2").find('option:selected').text();
			var Area=$("#s3").find('option:selected').text();
			var AccountName = $("#AccountName").val();
			var branch = $("#branch").val();
            if (BankName == '')
                msg = "银行名称不能为空";
            else if (CardNumber == '')
                msg = "银行卡号不能为空";
			else if (branch == '')
                msg = "支行名称不能为空";
            else if ($.trim($("#s3").val()) == '区域')
                msg = " 省市区不能为空";
            else if (CardNumber.length < 16)
                msg = "银行卡号长度不正确";
            else if (Pwd == '')
                msg = "支付密码不能为空";
            else if (BankName == "其他银行" && $("#txtOtherBank").val() == "")
                msg = "请输入其他银行名称";
            if (msg != "") {
                $.openAlter(msg, "提示");
                return false;
            }
            if (BankName == "其他银行" && $("#txtOtherBank").val() != "") {
                BankName = $("#txtOtherBank").val();
            }
        var provinceID=$("#s1").val();
        var cityID=$("#s2").val();
        var areaID=$("#s3").val();
        var BankAddress=Province+'  '+City+Area;
             $("#liOk").removeAttr("onclick");
             $("#liOk").text("提交中...");
             $.ajax({
                type: "POST", //用POST方式传输
                dataType: "json", //数据格式:JSON
                async: false,
                url: '<?php echo $this->createUrl('finance/addbank');?>', //目标地址
                data: "BankName=" + BankName +"&branch=" + branch + "&CardNumber=" + CardNumber + "&BankAddress=" + BankAddress + "&Pwd=" + Pwd + "&AccountName=" + AccountName,
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $("#liOk").attr("onclick","ok()");
                    $("#liOk").text("确定提交");
                 },
                success: function (msg) {
                    $("#liOk").attr("onclick","ok()");
                    $("#liOk").text("确定提交");
                    
                   if (msg.err_code == 0) {
                        $("#bntColse").click();
                        $.openAlter('添加成功', "提示",{ width: 250, height: 50 },function(){
								window.location.href="<?=$this->createUrl('finance/cardmanage');?>";
                        
							});
                    }
                    else {
                         $.openAlter(msg.msg, "提示");
                    }
                    
                }
            }
      );
        }
    </script>
</head>
<?php
$userinfo=User::model()->findByPk(Yii::app()->user->getId());
?>
<body>
<div class="cm" style="padding-bottom: 50px;" id="bigbox" title="新增银行卡">
        <?php $this->renderPartial("/public/header");?>
        
    <!--列表 -->
<form action="/Member/Withdrawals/AddBankCards" enctype="multipart/form-data" id="fm" method="post">
<input id="AccountName" name="AccountName" type="hidden" value="">       
        <div class="weui_cell" style="margin-left: -5%; margin-top: 5px">
            <ul style="width: 100%">
                <li style="width: 100%">
                    <p style="margin-left: 40px">
                        银行：
                        <select class="txsq_100 select2-hidden-accessible" id="selBankList" maxlength="50" name="BankName" onchange="DoClick()" style="width: 75%" tabindex="-1" aria-hidden="true">
						<option selected="selected" value="">请选择银行卡</option>
                        <option value="中国工商银行">中国工商银行</option>
                        <option value="中国农业银行">中国农业银行</option>
                        <option value="中国银行">中国银行</option>
                        <option value="中国建设银行">中国建设银行</option>
                        <option value="交通银行">交通银行</option>
						<option value="中信银行">中信银行</option>
                        <option value="中国光大银行">中国光大银行</option>
						<option value="华夏银行">华夏银行</option>
						<option value="中国民生银行">中国民生银行</option>
                        <option value="广发银行">广发银行</option>
                        <option value="深圳发展银行">深圳发展银行</option>
                        <option value="招商银行">招商银行</option>
                        <option value="上海浦东发展银行">上海浦东发展银行</option>
                        <option value="兴业银行">兴业银行</option>
						
                        <option value="恒丰银行">恒丰银行</option>
                        <option value="浙商银行">浙商银行</option>
                        <option value="渤海银行">渤海银行</option>
                        <option value="平安银行">平安银行</option>
</select>

					</p>
                </li>
                <li id="warntext" class="yhdl" style="margin-top: 5px; display: none">
                    <p style="margin-left: 85px">
                        <label style="font-size:13px;color:red">该银行转账速度较慢，不建议使用。</label>
                    </p>
                </li>
                <li class="yhdl" style="margin-top: 5px;">
                    <p style="margin-left: 12px">
                        银行卡号：
                        <input type="text" name="CardNumber" placeholder="请输入银行卡号" class="xlrf_100" style="width: 64%" id="txtCardNumber" 
                        onkeyup="value=value.replace(/[^0-9]/g,'')" onpaste="value=value.replace(/[^0-9]/g,'')" onblur="value=value.replace(/[^0-9]/g,'')" maxlength="25"></p>
                </li> 
				<li class="yhdl" style="margin-top: 5px;">
                    <p style="margin-left: 12px">
                        支行名称：
                        <input type="text" name="branch"  class="xlrf_100" style="width: 64%" id="branch"  placeholder="请输入支行名称" maxlength="19"  autocomplete="off"></p>
                </li>
                <li class="yhdl" style="margin-top: 5px;">
                    <p style="margin-left: 25px">
                        开户人： <?php echo $userinfo->TrueName;?>
                    </p>
                    <p style="margin-left: 39px;margin-top:5px">
                        <span style="color: Red">提示：</span> <span style="color: #888">只能提现到注册人名下的银行卡中。</span> 
                    </p>
                </li>
                <li class="yhdl" style="margin-top: 5px;">
                    <p style="margin-left: 25px">
                        开户地：
                        <select class="txsq_100" id="s1" maxlength="50" name="Province" style="width: 70%">
						</select>
                        <br>
                        <select class="txsq_100" id="s2" style="width: 70%; margin-top: 5px; margin-left: 60px">
                            <option>市</option>
                        </select>
                        <br>
                        <select class="txsq_100" id="s3" style="width: 70%; margin-top: 5px; margin-left: 60px">
                            <option>区/县 </option>
                        </select>
                    </p>
                </li>
                
                <li class="yhdl" style="margin-top: 5px;">
                    <p style="margin-left: 12px">
                        支付密码：
                        <input onauto type="password" name="Pwd" placeholder="若未设置支付密码，请输入登录密码" class="xlrf_100" style="font-size:12px;width: 63%" id="txtPwd" maxlength="18"  autocomplete="off"></p>
                </li>
                <li class="jsgl_pt_1" style="margin-top: 15px; float: none">
				<a id="liOk" href="javascript:void(0)" onclick="ok()" style="margin-left: 90px">确定提交</a> 
				<a href="<?=$this->createUrl('finance/cardmanage')?>" style="background: #457ee8;margin-left:200px; margin-top:-28px">返回退出</a> </li>
              
            </ul>
        </div>
</form>
    </div>
	<script src="<?php echo ASSET_URL;?>Auth/js/Area.js" type="text/javascript"></script>
<script type="text/javascript">
    //tab切换
    setup();preselect('北京市');
</script>
	
	
	<?php $this->renderPartial("/public/footer");?>
</body>
</html>	
	
	
	
	
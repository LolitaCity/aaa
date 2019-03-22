<?php
$webtitle = System::model ()->findByAttributes ( array (
		"varname" => "webtitle" 
) );
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $webtitle->value;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport"
	content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet"
	type="text/css">
<script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
<link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet"
	type="text/css">


<link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet"
	type="text/css">
<script src="<?=M_JS_URL;?>md5.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
<style type="text/css">
.anniu_80 {
	width: 103px;
	height: 30px;
	line-height: 30px;
	text-align: center;
	display: block;
	border-radius: 30px;
	margin-top: 10px;
	margin-right: 10px;
	font-size: 14px;
}

.weixin_div {
	border: 1px dashed #ddd;
	padding: 5px;
}
</style>
<script language="javascript">
        $(document).ready(function () {
        $("#serviceValidation").hide();
            if ($("#serviceValidation").length > 0) {
                if ($("#serviceValidation").text() != 1) {
                    $.openAlter($("#serviceValidation").text(), "提示");
                }
            }
        })
        $(function () {
            if ($("#selBankList").children().length <=1) {
                  $.openAlter('亲，你还没有绑定银行卡，请先绑定银行卡。', '提示', { width: 250,height: 50 },function () { location.href = "<?=$this->createUrl('finance/cardmanage')?>";},"绑定银行卡");   
            }
            $("#bntAllPoint").click(function () {
                $("#txtSpendPoint").val(parseFloat($("#spPoint").text()-50).toFixed(2));
            });
            $("#bntAllMoney").click(function () {
                $("#txtSpendMoney").val($("#spAmount").text());
            });

            $("#btnColseMoney,#btnColse,#imgeColse,#imgeColse1").click(function () {
                location.href = '/Member/Withdrawals/FinanceDefray';
            });

             
        });
        //提现
        function ExchangeMoney() {
            var money = $.trim($("#CashMoney").val());
			var usermoney='<?=$userinfo->Money;?>';
			usermoney=parseFloat(usermoney);
			var minmoney='<?=$systemset->value?>';
			minmoney=parseFloat(minmoney);
			var baozhengjin='<?=$danbaojin->value?>';
			baozhengjin=parseFloat(baozhengjin);
            var isExitWindow=false;
            var type=$("input:radio[name=tixianfanshi]:checked").val();         
        if (money == '') {
            $.openAlter("请输入提现金额", "提示");
            return false;
        }else if(money>usermoney){
            $.openAlter("提现金币超出，不能提现", "提示");
            return false;
        }
        else if(usermoney<baozhengjin){
            $.openAlter("当前金币低于担保金，不能提现", "提示");
            return false;
        }
        else if (type==1&&(money <= 0 || isNaN(money))) {
            $.openAlter("请输入正确的金额", "提示");
            return false;
        }
        else if (type==1&&money < minmoney) {
                $.openAlter("提现金额不能小于平台最低提现额度："+minmoney, "提示");
                return false;

        }
        else if (type==1&& (usermoney-money)<baozhengjin) {
                $.openAlter("保证金不能取出哦~", "提示");
                return false;

        }
        else if (type==1&&($("#selBankList").val() == ''||$("#selBankList").val() == null)) {
            $.openAlter("请选择银行卡", "提示");
            return false;
        }
        <?PHP foreach ($result as $key=>$val){ ?>
        	   if($("#selBankList").val() == <?PHP echo $val['bankAccount']?>){
        	   	$.openAlter("<?PHP echo $val['bankAccount']?>的银行卡支行不合法", "提示");
            return false;
        	   }
        <?PHP } ?>
        if(type==1) {
          var bankid=$("#selBankList").val();
          
	        $.ajax({
	      	  type: 'POST',
	      	  url: '<?=$this->createUrl('finance/takeoutcash')?>', async:false ,
	      	  data:  {money:money,bankaccount:bankid} ,
	      	  success: function (data) {
		      		$.openAlter(data.msg,'提示',{width:250,height:250},function () {
		                window.location.href='<?=$this->createUrl('finance/takeoutcash');?>';
		            });
	            },
	      	  dataType: 'json'
	      	});


              
                
            }
          
        }
 function Takeoutcashall(){
			
			var type=$("input:radio[name=tixianfanshi]:checked").val();
			if (type==1&&($("#selBankList").val() == ''||$("#selBankList").val() == null)) {
					$.openAlter("请选择银行卡", "提示");
					return false;
			}  
			 
			var bankid=$("#selBankList").val();

			layer.confirm('使用全额提现你的账号将会被冻结将无法进行任务等其他操作,视为你将退出平台！！', {
					btn: ['决定退出平台','未想退出平台'] //按钮
				}, function(){
					
					$.ajax({
							type: 'POST',
							dataType: 'json',
							url: '<?php echo SITE_URL?>/finance/Takeoutcashall',
							async:false ,
							data: {bankaccount:bankid},
							success: function (data) {
								console.log(data);
										layer.msg(data.msg, {icon: 1});
								},error: function (data) {
									  layer.msg('提现不成功', {icon: 1});
								}
						});	
				}, function(){
					layer.msg('加油', {icon: 1});
				});
			
		}


         
    </script>


</head>
<body>

	<div class="cm" style="padding-bottom: 50px;" id="bigbox" title="申请提现">
       <?php
							
							$this->renderPartial ( "/public/header" );
							$userinfo = User::model ()->findByPk ( Yii::app ()->user->getId () );
							?>
        
<style>
.infobox {
	background-color: #fff9d7;
	border: 1px solid #e2c822;
	color: #333333;
	padding: 5px;
	padding-left: 30px;
	font-size: 13px; -
	-font-weight: bold;
	margin: 0 auto;
	margin-top: 10px;
	margin-bottom: 10px;
	width: 95%;
	text-align: left;
}

.errorbox {
	background-color: #ffebe8;
	border: 1px solid #dd3c10;
	margin: 0 auto;
	margin-top: 10px;
	margin-bottom: 10px;
	color: #333333;
	padding: 5px;
	padding-left: 30px;
	font-size: 13px; -
	-font-weight: bold;
	width: 85%;
}
</style>
		<form action="<?php echo $this->createUrl('finance/takeoutcash');?>"
			id="fm" method="post">
			<input type="hidden" name="SpendPoint" value="0.00">
			<div class="cm">
				<!--1 -->
				<div class="jsgl hauto"
					style="border-bottom: none; margin-bottom: 20px;">
					<ul>
					<div id= "one_top" style="display: block;">
						<li class="jsgl_2 hauto" style="width: 100%">金币：<?=$userinfo->Money?>
                    </li>
						<li class="clear" style="line-height: 24px; color: #888">说明：其中<?=$danbaojin->value?>金币为账号担保金</li>
						<li><label> 提现方式：</label> <input type="radio" checked
							name="tixianfanshi" id="wx" value="1" style="margin-left: 5px"><label
							for="wx">银行卡</label></li>
						<li class="clear"></li>
						<!--微信-->
						<div class="weixin" id="weixin"
							style="margin-top: 5px; display: block;">

							<div class="weixin_div t_999" style="margin-top: 5px">
								<h4>提现须知：</h4>
								<p>
                                1、单笔提现金额<?=$systemset->value?>元起步；</p>
								<p>2、每日只允许提现1次。</p>
							</div>

						</div>
						<!--银行卡-->
						<div class="yinhangka" id="yinhangka">
							<li class="txsq"><input type="text" placeholder="请输入提现金额"
								class="xlrf_100" id="CashMoney"></li>
							<li class="txsq">
								<p class="nav_2" style="width: 100%">
									<select id="selBankList" class="txsq_100"
										name="MemberDuiHuanForm.BankName" style="width: 60%">
										<option selected="selected" value="">请选择银行卡号</option>
								<?php foreach ($banklist as $value):?>
                                        <option
											value="<?=$value->bankAccount?>"><?=$value->bankName.'  尾号  '.substr($value->bankAccount,-4);?></option>
                                 <?php endforeach;?>
								</select> <a href="<?=$this->createUrl('finance/cardmanage')?>"
										style="margin-left: 69%; margin-top: -30px; background: #1e9223">
										我的银行卡</a>
								</p>
							</li>

							
							<?PHP if($userinfo->alloutcash == 1){ ?>
								<li>
									<h4 style="color: red;margin-top: 9px;">
										使用全额体现你的账号将会被冻结将无法进行任务等其他操作
									</h4>
								</li>
								<li class="login_4">
									<p>
										<div style="border-radius:5px;background-color: crimson;width: 100%;height: 50px;text-align: center;line-height: 50px;font-size: 20px;" onclick="Takeoutcashall()">全额体现</div>
									</p>
								</li>
								<?PHP } else { ?>	
								<li class="login_4"><a href="javascript:void(0)" id="btnWxMoney"
								onclick="ExchangeMoney()"> 确认提现</a></li>
								<?PHP }?>
						</div>
						</div>
						<div id= "one_tow" style="display: none;">
						 <p>
							 <sqan style="color:red">尊敬的会员，你的全额提现清单：<br>提现到银行卡：<?PHP echo $outcashfull[0]['bankaccount'];?>，<BR>被提现的总金额为：<?PHP echo $outcashfull[0]['money'];?>，<BR>提现进度：<?PHP echo $outcashfull[0]['status'];?>,<BR>提交时间：<?PHP echo  date('Y-m-d',$outcashfull[0]['addtime'])?></sqan>
						 </p>
					 </div>
						<!--银行卡-->
					</ul>
				</div>
				<!--1 -->
				<div class="hxt"></div>
				<!--灰色条-->
				<div class="txsq_1 hauto">
					<div class="txsq_2">银行卡提现记录</div>

					<div class="tx_table pad_2_3">
						<table class="sz_table">
							<tbody>
								<tr>
									<th width="20%">提现金额</th>
									<th width="50%">申请时间</th>
									<th width="30%">提现状态</th>
								</tr>
                          <?php foreach (@$outcashList as $value):?>  
						   
                            <tr>
									<td style="color: Red">
                                   <?=$value->money?>
                                </td>
									<td>
                                    <?=date('Y-m-d',$value->addtime);?>
                                </td>
									<td><a class="t_999"><?=$value->status;?></a></td>
								</tr>
							<?php endforeach;?>
                    </tbody>
						</table>
					</div>
				</div>
			</div>
		</form>

	</div>
<?php $this->renderPartial("/public/footer");?>
</body>
<script>
	 $(document).ready(function () {
	   <?PHP if(empty($outcashfull) || $outcashfull ==""){ ?>
					<?PHP  if($ree =="有"){?>
							$.openAlter("请输入提现金额", "提示");
								return false;
					<?PHP }else{?>
	   	   					layer.alert('<?PHP echo $ree;?>', {icon: 6});
	   	   			return false;
	   	   <?PHP } ?>	 
				 <?PHP }else{?>
				 $("#one_top").css({"display":"none"});
				$("#one_tow").css({"display":"block"});
			  	layer.alert('<sqan style="color:red">尊敬的会员，你的全额提现清单：<br>提现到银行卡：<?PHP echo $outcashfull[0]['bankaccount'];?>，<BR>被提现的总金额为：<?PHP echo $outcashfull[0]['money'];?>，<BR>提现进度：<?PHP echo $outcashfull[0]['status'];?>,<BR>提交时间：<?PHP echo  date('Y-m-d',$outcashfull[0]['addtime'])?></sqan>', {icon: 6});
				 <?PHP }?> 
	 });
</script>
</html>



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
	<script type="text/javascript" src="<?=S_JS?>layui/layui.js"></script> 
    <script type="text/javascript" src="<?=M_JS_URL?>data.js"></script>
    <script type="text/javascript" src="<?=M_JS_URL?>province.js"></script>
	
</head>	
<style>
.ycgl_tc {
    width: 80%;
    margin-left: -40%;
    top: 35%;
    background: #fff;
    display: none;
    height: 200px;
}
</style>
<script>
 //删除银行卡
        function del(id,cardID) {
            $.post('<?php echo $this->createUrl('finance/checkcard');?>', { id: id }, function (data) {
                if (data==1) {
					$.openAlter('<div style="text-align:left">亲，您已设置该银行卡为卖家提现的默认提现银行卡，如需要删除，请先前往卖家提现页面对默认提现银行卡进行修改。</div>', '提示', { width: 250,height: 50 },function () { location.href = "<?php echo $this->createUrl('finance/selleroutcash')?>";},"立即修改");   
                }else if(data==2){
					$.openAlter('亲，您的提现记录里有使用该银行卡进行提现，无法进行删除！','提示');
				}else {
                document.getElementById('light1').style.display='block';
                document.getElementById('fade').style.display='block';
                document.getElementById('delid').value=id;
            }
                });

          
        }
		$("#delete").live('click',function () {
            var id=document.getElementById('delid').value;
            var Pwd=$('#safePwd').val();
            if(Pwd==null){
                $.openAlter('安全码不能为空', "提示");return false;
            }
            $.post('<?php echo $this->createUrl('finance/delbankcard');?>', { id: id,Pwd:Pwd }, function (data) {
                if (data.err_code == 0) {
                    location.href = location.href;
                }
                else {
                    $.openAlter(data.msg, "提示");
                }
            },'json');
        })
		function Xiu($id,$cardID){
		    	var  ur = '<?PHP echo SITE_URL;?>finance/XiugaiBankCard/id/'+$id+'/bankAccount/'+$cardID+'.html';
		        layer.open({
			        type: 2,
			        area: ['350px', '400px'],
			        fixed: false, //不固定
			        content: ur
			    });
		    }
</script>

<body>

<!--添加弹窗 确认删除 -->
<div id="light1" class="ycgl_tc">
	<!--列表 -->
	<h3 class="tc_close">
        <a href="javascript:void(0)" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'"">
		<img src="<?=M_IMG_URL;?>close2.png"></a>删除银行卡
	 </h3>
	<!--列表 -->
	<div class="tx_w_80 h_130">
		<ul style="min-height:80px">
			<li>
				<label>
				   安全码：</label>
				<p>
					<input type="password" id="safePwd" placeholder="请输入安全码" style="font-size: 12px;width:95%" class="in_select"  maxlength="18"></p>
					<input type="hidden" id="delid" value=""></p>
			</li>
			
		</ul>
		<div class="tixian_anniu">
                    <a href="javascript:void(0)" id="delete" class="bg_f90 anniu fl">确认提交</a> 
					<a href="javascript:void(0)" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'"" class="bg_blue anniu fr">返回修改</a>
                </div>
	</div>
	
</div>
<div id="fade" class="black_overlay"></div>

<div class="cm" style="padding-bottom: 50px;" title="我的银行卡" id="bigbox">
        <?php $this->renderPartial("/public/header");
			$banklistarr=Banklist::model()->findAll('userid='.Yii::app()->user->getId());
			$bankcount=count($banklistarr)>0?3-count($banklistarr):3;
		?>
        
    <!--列表 -->
    
    <!--系统提现管理-->
    <div class="Coupon" id="tabBox1">
        
        <h2 class="Return pad_2_3 jsgl_pt_1" style="background-color: White">
            <a href="<?=$this->createUrl('finance/takeoutcash')?>">返 回</a></h2>
        
    </div>
    <!--系统提现管理-->
    <div class="jsgl hauto" style="height: 20px; padding-top: 10px; padding-bottom: 15px">
        <ul>
            <li class="jsgl_2 " style="width:auto"><span style="margin-left: 22px">新增银行卡次数:<b style="color: Red"><?=$bankcount;?></b>次</span></li>
            <li class="jsgl_3 hauto" style="width: 100px">
                    <p class="jsgl_pt_1 jsgl_5" style="margin-top: 0px"> <a href="<?=$this->createUrl('finance/addbank');?>">新增</a></p>
            </li>
        </ul>
    </div>
    <div class="jsgl hauto" style="padding: 6px">
        <p class="left">
            <em style="color: Red">温馨提示：</em> 每位用户只允许进行<em style="color: Red">3</em>次新增银行卡操作，请务必保证绑定的银行卡为您本人所持有。</p>
    </div>
    <div class="jsgl hauto" style="height: 10px; padding-top: 5px">
        <ul>
            <li class="jsgl_2 hauto">银行卡信息</li>
            <li class="jsgl_3 hauto" style="margin-left: 5px; text-align: center">操作</li>
        </ul>
    </div>
    <div class="jsgl hauto" style="width: 100%">
        <ul>
		<?php foreach ($banklist as $v):?>
            <li class="jsgl_2 hauto" style="width: 72%">银行名称：<?php echo $v->bankName;?><br>
                卡号：<?php echo $v->bankAccount;?><br>
                开户地：<?php echo $v->bankAddress;?><br>
                支行：<?=$v->subbranch;?><br>
                短信通知：<?php echo $v->phone;?></li>
            <li class="jsgl_3 hauto" style="width: 120px; margin-left: -50px; margin-top: -22px">
                <p class="jsgl_pt_1 jsgl_5" style="width: 70px">
                    <a href="javascript:void(0)" onclick="del( <?php echo $v->id;?>,' <?php echo $v->bankAccount;?>')" style="background: #bb0a0a">
                        删除</a></p>
				<p class="jsgl_pt_1 jsgl_5" style="width: 70px">
                    <a href="javascript:void(0)" onclick="Xiu( <?php echo $v->id;?>,'<?php echo $v->bankAccount;?>')" style="background: #bb0a0a">
                        修改</a></p>
            </li>
			
		<?php endforeach;?>	
        </ul>
    </div>

    </div>
	<?php $this->renderPartial("/public/footer");?>
</body>
</html>	
	
	
	
	
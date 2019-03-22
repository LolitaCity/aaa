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
    
    <link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>CustomFunc.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>md5.js" type="text/javascript"></script>
    <script type="text/javascript">
     $(function () {
     
        $("#btnPwd").click(function () {
                var msg = '';
                 if ($("#selBankList").val() == ''||$("#selBankList").val() == null) {
                   msg="请选择银行卡";
                }
                else if ($("#txtTsPwd").val() == '') {
                    msg = "身份验证不能为空", "提示";
                }
                if (msg != '') {
                    $("#pMsg").show();
                    $("#pMsg").text(msg);
                    return false;
                }
                else {
                    var sfpw = hex_md5($("#txtTsPwd").val());
                    $.post('<?php echo $this->createUrl('finance/editbankcard');?>', { safePwd: sfpw,bankid:$("#selBankList").val()}, function (data) {
                        if (data.err_code == 0) {
                            $.openAlter("修改成功", "提示",{ width: 250,height: 50 }, function () { window.parent.location = "<?=$this->createUrl('finance/selleroutcash')?>"; }, "确定");
                        }
                        else {
                            $("#pMsg").show();
                            $("#pMsg").text(data.msg);
                        }
                    }, 'json');
                }
            });
        });
		function alltransfer(){
			$.ajax({
				url:'<?=$this->createUrl('finance/checkedall')?>',
				dataType:'json',
				success:function(r){
					if(r.err_code==0){
						$.openAlter(r.msg,'提示',{width:250,height:50},function(){
							window.location.href='<?=$this->createUrl('finance/selleroutcash')?>';
						});
						
					}else{
						$.openAlter(r.msg,'提示');
					}
				}
				
			})
		}
                //设置默认银行卡
        function SetBankCard() {
          var cardNum='1';
          if(cardNum<1)
          {
                $.openAlter('<div style="text-align:left">亲，您尚未绑定银行卡，请先到“平台提现--我的银行卡”页面新增银行卡。成功绑定后再设置系统默认提现银行卡吧~~</div>', '提示', { width: 250,height: 50 },function () { location.href = "/Member/Withdrawals/BankCardManage";},"立即绑定");  
            }
            else
            {
            $.openWin(300, 300, '/Member/Transfer/SetBankCrad');
            }
        }
           function closeOk()
           {
              $("#pMsg").text("");
               $("#pMsg").hide();
              document.getElementById('tixian_1').style.display='none';document.getElementById('fade').style.display='none'
           }
              function msg() {
            $.openAlter("<div style=\"text-align:left\">亲，平台已收到您的反馈。管理员会火速提醒商家进行转账，请耐心等待。</div>", "提示", null, null, "好的");
        }
        
	   function tjcg()
	{
		  document.getElementById('tixian_1').style.display='block';document.getElementById('fade').style.display='block'
	  }
 

        $(function(){
    $(".cashb_quest").click(function(){
        $(".display_show").css('display', 'block');
    });
    $(".display_bg,.close").click(function(){
         $('.display_show').css('display', 'none');
     });
})
    </script>
    <style type="text/css">
        .tianxian_sz a
        {
            margin-left: 8px;
        }
        .ycgl_tc
        {
            width: 80%;
            margin-left: -40%;
            top: 35%;
            background: #fff;
            display: none;
            height: 349px;
        }
        
        .ycgl_tc_1
        {
            margin: 9px auto 30px auto;
        }
        .errorbox
        {
            background-color: #ffebe8;
            border: 1px solid #dd3c10;
            margin: 0 auto;
            margin-top: 10px;
            margin-bottom: 10px;
            color: #333333;
            padding: 5px;
            padding-left: 30px;
            font-size: 13px;
            --font-weight: bold;
            width: 85%;
        }
        .ycgl_tc_1
        {
            margin: 0px auto 30px auto;
        }
        .tx_w_80
        {
            display: block;
            width: 90%;
            margin: 9px auto;
            position: relative;
        }
    </style>
    <style>
        /*买家提现*/
        .hxt_x
        {
            height: 6px;
            background: #f2f2f2;
        }
		.abtn{padding: 4px 10px;
    border-radius: 15px;    margin-top: -3px;
    margin-right: 5px;}
        .t_red
        {
            color: red;
        }
        .cashb_1
        {
            height: 70px;
            position: relative;
        }
        .cashb_1 span
        {
            margin: 15px 15px 0px 0px;
        }
        .cashb1_span
        {
            width: 40px;
            height: 40px;
            float: left;
        }
        .cashb1_span img
        {
            width: 100%;
            float: left;
        }
        .cashb_1 dl
        {
            width: 50%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            height: 70px;
        }
        .cashb_1 dt
        {
            color: #999;
        }
        .cashb_1 p
        {
            position: absolute;
            right: 0px;
            top: 28px;
            right: 3%;
        }
        .cashb_1 p a
        {
            width: 64px;
            height: 27px;
            line-height: 27px;
            text-align: center;
            float: right;
            background: #f90;
            border-radius: 16px;
            color: #fff;
        }
        .cashb_2
        {
            height: 40px;
        }
        .cashb_2 h3
        {
            height: 40px;
            line-height: 40px;
            float: left;
            width: 80%;
            margin-left: 15px;
        }
        .cashb_2 h3 em
        {
            float: right;
            width: 25px;
            height: 25px;
            margin-top: 8px;
        }
        .cashb_2 h3 em img
        {
            width: 100%;
        }
        .cashb_2 h3 a
        {
            font-family: "宋体";
            font-size: 18px;
            color: #457ee8;
            font-weight: bold;
        }
        .cashb_3
        {
            height: 43px;
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4
        {
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4 h3
        {
            color: #999;
        }
        .cashb4_ul
        {
            margin-top: 10px;
        }
        .cashb4_ul li
        {
            margin-bottom: 8px;
            display: inline-block;
            width: 100%;
        }
        .cashb4_ul dt
        {
            color: #457ee8;
        }
        .cashb4_ul em
        {
            width: 24px;
            margin-top: 5px;
            height: 24px;
            background: #ddd;
            text-align: center;
            line-height: 24px;
            color: #fff;
            float: left;
        }
        .cashb4_ul dl
        {
            float: right;
            width: 90%;
        }
        .cashb4_ul dt
        {
            margin-bottom: 5px;
        }
        .cashb4_ul dd
        {
            line-height: 15px;
        }
    </style>
    <style>
        .close img
        {
            width: 40px;
            position: absolute;
            right: 0px;
            top: 0px;
        }
        
        /*买家提现*/
        .hxt_x
        {
            height: 6px;
            background: #f2f2f2;
        }
        .t_red
        {
            color: red;
        }
        .cashb_1
        {
            height: 70px;
            position: relative;
        }
        .cashb_1 span
        {
            margin: 15px 15px 0px 0px;
        }
        .cashb1_span
        {
            width: 40px;
            height: 40px;
            float: left;
        }
        .cashb1_span img
        {
            width: 100%;
            float: left;
        }
        .cashb_1 dl
        {
            width: 50%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            height: 70px;
        }
        .cashb_1 dt
        {
            color: #999;
        }
        .cashb_1 p
        {
            position: absolute;
            right: 0px;
            top: 28px;
            right: 3%;
        }
        .cashb_1 p a
        {
            width: 64px;
            height: 27px;
            line-height: 27px;
            text-align: center;
            float: right;
            background: #f90;
            border-radius: 16px;
            color: #fff;
        }
        .cashb_2
        {
            height: 40px;
        }
        .cashb_2 h3
        {
            height: 40px;
            line-height: 40px;
            float: left;
            width: 80%;
            margin-left: 15px;
        }
        .cashb_2 h3 em
        {
            float: right;
            width: 25px;
            height: 25px;
            margin-top: 8px;
        }
        .cashb_2 h3 em img
        {
            width: 100%;
        }
        .cashb_2 h3 a
        {
            font-family: "宋体";
            font-size: 18px;
            color: #457ee8;
            font-weight: bold;
        }
        .cashb_3
        {
            height: 43px;
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4
        {
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4 h3
        {
            color: #999;
        }
        .cashb4_ul
        {
            margin-top: 10px;
        }
        .cashb4_ul li
        {
            margin-bottom: 8px;
            display: inline-block;
            width: 100%;
        }
        .cashb4_ul dt
        {
            color: #457ee8;
        }
        .cashb4_ul em
        {
            width: 20px;
            margin-top: 5px;
            height: 20px;
            background: #ddd;
            text-align: center;
            line-height: 20px;
            color: #fff;
            float: left;
        }
        .cashb4_ul dl
        {
            float: right;
            width: 90%;
        }
        .cashb4_ul dt
        {
            margin-bottom: 5px;
        }
        .cashb4_ul dd
        {
            line-height: 15px;
        }
        
        
        .cashb_quest
        {
            height: 20px;
        }
        .cashb_quest a
        {
            float: left;
            margin-right: 5px;
        }
        .pad_4_3
        {
            padding: 4% 3%;
        }
        .quest_icon
        {
            border: 1px solid red;
            border-radius: 100%;
            width: 15px;
            height: 15px;
            color: red;
            text-align: center;
            line-height: 15px;
            float: left;
        }
        .quest_icon a
        {
            float: left;
        }
        .tab_list_1
        {
            display: flex;
            flex-direction: row;
            height: 50px;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            word-break: break-all;
        }
        .tab_title
        {
            display: flex;
            flex-direction: row;
            width: 75%;
        }
        .span_icon img
        {
            width: 38px;
            height: 38px;
            margin-right: 10px;
        }
        .tab_title li b
        {
            font-size: 15px;
            font-weight: normal;
        }
        .tab_title li
        {
            color: #222;
        }
        .tab_title h3
        {
            color: #888;
            margin-bottom: 5px;
        }
        .tab_state
        {
            height: 43px;
            font-size: 12px;
            text-align: right;
            width: 27%;
        }
        .tab_state span
        {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            margin-bottom: 12px;
        }
        .tab_state em
        {
            width: 6px;
            height: 6px;
            display: block;
            margin-top: 6px;
            margin-right: 6px;
            border-radius: 100%;
        }
        .bder_f90
        {
            border-radius: 3px;
            border: 1px solid #f90;
            color: #f90;
            padding: 5px;
            font-size: 12px;
        }
        
        .t_33cc00
        {
            color: #33cc00;
        }
        
        .display_bg
        {
            background: #000;
            opacity: .1;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            display: none;
        }
        .dis_black_tc
        {
            display: none;
            position: absolute;
            z-index: 888;
            background: #fff;
            width: 90%;
            border-radius: 5px;
            left: 5%;
            margin-top: -10px;
            line-height: 25px;
            border: 1px solid #f90;
        }
        .dis_black_tc > em
        {
            background: url('/Content/images/pic/f90_jt_dowm.png') no-repeat;
            display: block;
            width: 12px;
            height: 7px;
            position: absolute;
            top: -7px;
            left: 85px;
        }
        .cash_all
        {
            border-left: 4px solid #447eea;
        }
        .bgfff
        {
            background: #fff;
        }
        .Withdrawals
        {
            border-top: 1px solid #f0f0f2;
            line-height: 23px;
        }
        .jsgl_pt_1 a
        {
            width: 90px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            background: #fea33a;
            display: block;
            color: #fff;
            border-radius: 15px;
        }
        .Withdrawals_1
        {
            margin-top: 5px;
        }
        
        .hxt
        {
            clear: both;
        }
        .invitingfr ul
        {
            border-bottom: 1px solid #eee;
            height: 36px;
        }
        .invitingfr li
        {
            width: 16.63%;
            float: left;
            text-align: center;
            font-size: 12px;
            height: 35px;
            line-height: 35px;
        }
        .invitingfr li.on
        {
            border-bottom: 2px solid #f90;
            color: #f90;
        }
        #changebox
        {
            clear: both;
        }
        .annh4 a
        {
            border-radius: 5px;
            width: 120px;
            height: 30px;
            line-height: 30px;
            display: block;
            text-align: center;
            margin: 10px 0px;
        }
        #totop
        {
            width: 1.28rem;
            height: 1.267rem;
            background: url(../images/totop.png) no-repeat;
            background-size: 100% 100%;
            display: none;
            position: fixed;
            right: 0.133rem;
            bottom: 1.5rem;
            cursor: pointer;
        }
        .not_date
        {
            text-align: center;
        }
        .not_date img
        {
            width: 35%;
            margin: 10% auto 0;
        }
        .more
        {
            padding: 2% 0;
            text-align: center;
        }
    </style>


</head>
<body>
    <div class="cm" style="padding-bottom: 50px;">
<?php $this->renderPartial("/public/header");
$banklist=Banklist::model()->findAll('userid='.Yii::app()->user->getId());
?>
       
<form action="" enctype="multipart/form-data" id="fm" method="post">        <!-- 弹窗设置 -->
        <div id="tixian_1" class="ycgl_tc">
            <h3 class="tc_close">
                <a href="javascript:void(0)" onclick="closeOk()">
                    <img src="<?=M_IMG_URL?>close2.png"></a>修改默认提现银行卡</h3>
            <div class="tx_w_80 h_240">
                <div class="errorbox" id="pMsg" style="width: 230px; height: 15px; margin-left: 0px;
                    display: none">
                    <ol style="list-style-type: decimal" id="clientValidationOL">
                        <li></li>
                    </ol>
                </div>
                <ul class="tixian_ul">
				<?php if(@$curbank){
					$text=$curbank->bankName.'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($curbank->bankAccount,-4);
				?>
                    <li>
                        <label>
                            原提现银行卡：</label>
                        <span><b style="color:red"><?php echo $text;?></b></span> </li>
				<?php }?>		
                    <li>
                        <label>
                            选择提现银行卡：</label>
                        <select class="in_select" id="selBankList" name="CardNumber" style="margin-left: 1px;width:260px;height:30px;">
						<option value="">请选择银行卡号</option>
					<?php foreach ($banklist as $v){?>
                    <option value="<?php echo $v->id;?>"><?php echo $v->bankName;?>       尾号 <?php echo substr($v->bankAccount,-4);?></option>
                    <?php }?>
						</select>
                         </li>
                    <li>
                        <label>
                            身份验证：</label>
                        <input style="width: 260px; margin-left: 1px;" type="password" maxlength="18" placeholder="请输入支付密码" name="password1" class="in_select" id="txtTsPwd">
                         </li>
                </ul>
                <div class="tixian_anniu">
                    <a href="javascript:void(0)" id="btnPwd" class="bg_f90 anniu fl">确认提交</a> <a href="javascript:void(0)" onclick="closeOk()" class="bg_blue anniu fr">返回修改</a>
                </div>
            </div>
        </div> 
        <div id="fade" class="black_overlay">
        </div>
        <!--买家提现-->
        <!--买家提现-->
        <div class="cashb_quest pad_4_3">
            <a>卖家提现须知</a><em class="quest_icon">?</em>
        </div>
        <div class="display_bg display_show">
        </div>
        <div class="dis_black_tc display_show">
            <em></em><span class="close">
                <img src="<?=M_IMG_URL?>close3.png"></span> <em class="Triangle">
                </em>
            <div class="cashb_4 pad_2_3">
                <h3>
                    具体如下：</h3>
                <ul class="cashb4_ul">
                    <li><em>1</em>
                        <dl>
                            <dt>货款提现：</dt>
                            <dd>                                完成任务后请第一时间点击（提现本金）按钮，否则卖家收不到买家银行信息无法返款，点击（提现本金）货款会由卖家在第二天12:00前返款给买家
                            </dd>
                        </dl>
                    </li>
                    <li><em>2</em>
                        <dl>
                            <dt>佣金提现：</dt>
                            <dd>
                                为确保任务更规范，需要做两步操作才能获取佣金，任务提交后，卖家审核任务合格通过，买家点击（获取佣金），卖家确认支付佣金，佣金才会到达买家账户，请严格按照任务要求完成，觉得任务麻烦，可以放弃任务！
                            </dd>
                        </dl>
                    </li>
                    <li><em>3</em>
                        <dl>
                            <dt>货款超时反馈：</dt>
                            <dd>
                               如在第二天12:00后仍然没有收到货款，请在下面表格对应订单处反馈
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="cashb_5 pad_2_3">
                <b class="t_red">备注：</b>请登录网银确认货款未到账后再向平台反馈。
            </div>
        </div>
        <div class="hxt_x">
        </div>
        <div class="cashb_1 pad_2_3">
            <span class="cashb1_span">
                <img src="<?=M_IMG_URL?>cash1.png"></span>
				<?php if(@$curbank){
                        $text=$curbank->bankName.'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($curbank->bankAccount,-4);
                        $btntext='修改';
                    }else{
                        $text='未设置'; $btntext='添加';
                }?>
                <dl>
                    <dt>默认提现银行卡：</dt>
                    <dd><b style="color:red"><?php echo $text;?></b>
                    </dd>
                </dl>
                <p>
                    <a href="javascript:void(0)" onclick="tjcg()"><?php echo $btntext;?></a></p>
        </div>
        <div class="hxt_x">
        </div>
        <div class="cash_all pad_2_3">
            卖家提现记录
			<a href="<?=$this->createUrl('finance/transferlist')?>" class="fr abtn bg_f90">查看全部 </a>
        </div>
        <div class="hxt_x">
        </div>
        <div class="con">
            <div class="With_tab">
			<?php foreach ($list as $v):?>
			<?php
				if ($v['arrivestatus']==0) {
					switch ($v['transferstatus']) {
						case 0:
							$status= '未转账';$imgsn=1;
							break;
						case 1:
							$status= '等待转账';$imgsn=4;
							break;
						case 2:
							$status= '已转账';$imgsn=2;
							break;
						case 3:
							$status= '转账失败';$imgsn=3;
							break;
						case 4:
							$status= '未到账';$imgsn=5;
							break;
					}
				}else{
					$status= '已到账';$imgsn=2;
				}
            ?>
			
                    <a href="<?=$this->createUrl('finance/lookinfo',array('utaskid'=>$v['utaskid']))?>">
                        <div class="tab_list_1 pad_4_3">
                            <div class="tab_title">
                                <span class="span_icon">
                                    <img src="<?=M_IMG_URL?>icon_z<?=$imgsn?>.png"></span>
                                <ul>
                                    <li>
                                        <h3 style="width: 210px;">
                                            订单编号：<?=$v['osn']?></h3>
                                    </li>
                                    <li>
                                        <p>
                                            ￥<b><?=$v['orderprice']?></b> 元</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab_state">
                                <span class="t_999"><?=$status;?></span>
                            </div>
                        </div>
                    </a>
			 <?php endforeach;?>		
            </div>
                <div class="more">
                    <a href="<?=$this->createUrl('finance/transferlist');?>" class="t_blue">查看更多</a>
                </div>
        </div>
</form>
    </div>
    
	<?php $this->renderPartial("/public/footer");?>


</body></html>
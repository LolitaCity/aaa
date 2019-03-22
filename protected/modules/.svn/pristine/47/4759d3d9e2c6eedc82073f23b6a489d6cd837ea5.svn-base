<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>

    <link href="/Content/css/css.css?t=4.7" rel="stylesheet" type="text/css">
    <style type="text/css">
        .Show img
        {
            width: 59px;
            height: 59px;
        }
    </style>


</head>
<body>
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="卖家提现">
       <?php $this->renderPartial("/public/header");
	   $transfercash=array();
	   if(!empty($info->id)){
		   $transfercash=Transfercash::model()->find('usertaskid='.$info->id);
	   }
	   
?>
        
    <!--系统提现管理-->
    <div class="Coupon1" id="tabBox1">
        <h2 class="Return pad_2_3 jsgl_pt_1">
            <a href="<?=$this->createUrl('finance/selleroutcash')?>">返回</a></h2>
            <div class="tixian pad_2_3">
                <p>
                    下面展示该笔订单的详细提现信息，请登录网银确认是否收到货款。若确实仍未到账，可点击【提现未到账】按钮在平台进行反馈。</p>
            </div>
        <div class="hxt">
        </div>
    </div>
    <div class="tx_zhuangtai pad_2_3">
        <h3 class="f_16">
            提现状态：</h3>
			
			
        <ul class="tx_zt_ul " style="height:30px;">
           
            <li class="fl " style="padding-top: 10px;color: green;font-weight: bold;">
			<?php 
			if (@$transfercash->arrivestatus==0) {
					switch ($transfercash->transferstatus) {
						case 0:
							echo '未转账';
							break;
						case 1:
							echo '等待转账';
							break;
						case 2:
							echo '已转账';
							break;
						case 3:
							echo '转账失败';
							break;
						case 4:
							echo '未到账';
							break;
					}
				}else{
					echo '已到账';
				}
			?>
			
			</li>
        </ul>
        <ul class="tx_ul_list">
            <li>
                <label>
                    订单编号：</label>
                <span><?=@$info->ordersn?></span> </li>
            <li>
                <label>
                    提现金额：</label>
                <span><?=@$info->orderprice?></span> </li>
            <li>
                <label>
                    提现银行卡：</label>
                <span><?php 
					if(@$transfercash->bankid){
						$bank1=Banklist::model()->findByPk($transfercash->bankid);
						if($bank1){
							echo $bank1->bankName.' 尾号  '.substr($bank1->bankAccount,-4);
						}else{
							echo '已删除或者未设置';
						}
					}else echo '未设置';
				?></span> </li>
            <li>
                <label>
                    转账银行卡：</label>
                <span><?php
				if(@$transfercash->transferbank){
					$bank2=Banklist::model()->find("bankAccount='$transfercash->transferbank'");
					if($bank2){
							echo $bank2->bankName.' 尾号  '.substr($bank2->bankAccount,-4);
						}else{
							echo '已删除或者未设置';
					}
				}else echo '未提交';
				?></span> </li>
            <li>
                <label>
                    申请时间：</label>
                <span><?php if (@$transfercash->addtime)echo date('Y-m-d H:i:s',$transfercash->addtime);?></span> </li>
            <li>
                <label>
                    到账时间：</label>
                <span> <?php if (@$transfercash->updatetime)echo date('Y-m-d H:i:s',@$transfercash->updatetime);?></span> </li>
        </ul>
		
		 <?php if ($info->status>0 && @$transfercash->transferstatus==0 && @$transfercash->arrivestatus==0){?>
			<a href="javascript:void(0)" onclick="Applicationtransfer('<?=$info->id?>', this)" class="bg_f90 anniu_100 mar_top_20">申请提现</a>
		<?php }elseif (@$transfercash->transferstatus==2 && @$transfercash->arrivestatus==0){?>
			<a href="javascript:void(0)" onclick="remindTranster1('<?=@$transfercash->id?>')" class="bg_blue anniu_100 mar_top_20">提现未到账</a>
			<a href="javascript:void(0)"  onclick="arrived(<?=@$transfercash->id?>)" class="bg_f90 anniu_100 mar_top_20">已到账</a>
		<?php }elseif (@$transfercash->transferstatus==4 && @$transfercash->arrivestatus==0){?>
			<a href="javascript:void(0)" alt="<?=$transfercash->transferimg?>" onclick="readtransferimg(this)" class="bg_f90 anniu_100 mar_top_20">查看凭证</a>
			<a href="javascript:void(0)"  onclick="arrived(<?=@$transfercash->id?>)" class="bg_f90 anniu_100 mar_top_20">原来已到账</a>
			<a href="<?=$this->createUrl('finance/telkefu',array('id'=>$transfercash->id));?>"class="bg_blue anniu_100 mar_top_20">客服介入</a>
		<?php }?>
    </div>
    <!--系统提现管理-->
    <script type="text/javascript">
	    function Applicationtransfer(usertaskid, $this) {
	        $this = $($this);
	    	$this.html('处理中...');
			$this.attr('disabled', true).css('pointer-events', 'none');
	    	var url='/finance/applicationtransfer/usertaskid/'+usertaskid;
	    	$.get(url, function(datas){
	    		if (datas.status)
	    		{
	    			$.openAlter(datas.message, "提示");
	    			location.href = '/mobile/finance/selleroutcash';
	    		}
	    		else
	    		{
	    			$this.html('申请提现');
	    			$this.attr('disabled', false).css('pointer-events', 'auto');
	    			$.openAlter(datas.message, "错误");
	    		}
	    	}, 'JSON'); 
    	}
	  
	function arrived(id) {
        openConfirm("<div style=\"text-align:left\">确认已到账？</div>","提示",{ width: 250,height: 50 }, function () {submitarriced(id)}, "确认到账",function () {  $.self.parent.$.closeAlert() }, "返回");

    }
	function submitarriced(id) {
        $.post('<?=$this->createUrl('finance/alreadyarrived')?>',{id:id},function(result){//alert(result);return false
            if(result.err_code=="0")
            {
                window.location.reload();
            }
            else{
                $.openAlter(result.msg,"提示");
            }
        },'json');
    }
	    function SubmitFeedback(id)
    {
        $.post('<?=$this->createUrl('finance/untransfer')?>',{id:id},function(result){

            if(result.err_code=="0")
            {
                window.location.reload();
            }
            else{
                $.openAlter(result.msg,"提示");
            }
        },'json');
    }
	function readtransferimg(o) {
       var img=$(o).attr('alt');
       if(img){
           window.open(img);
       }else {
           $.openAlter('商家未上传截图，如果点击提现未到账，一天后还未到账且商家不上传截图，就请申请客服介入','提示');
       }
    }
		function remindTranster1(id) {
			openConfirm("<div style=\"text-align:left\">请先登录网银进行确认，确认未到账后再提交反馈。反馈提交后，卖家会在24小时内上传转账凭证。若凭证无误，但仍未收到款项，平台客服会介入处理。请不要私自退款，多谢配合~</div>","提示",{ width: 250,height: 50 }, function () {SubmitFeedback(id)}, "确认提交",function () {  $.self.parent.$.closeAlert() }, "返回");
		}
        $(function () {
            jQuery.closeConfirm = function () {
                $("#ow_confirm002").remove(); //2.删除主内容层
                $("#ow_confirm001").remove(); //1.删除透明层
            }
        });

        function openConfirm(message, title, obj, fun1, buttonText1, fun2, buttonText2) {
            if ($("#ow_confirm002").length > 0) {
                return false;
            }
            if (obj == null) {
                obj = { width: 250, height: 50 };
            }
            if (buttonText1 == null || buttonText1 == "" || buttonText2 == null || buttonText2 == "") {
                return false;
            }
            //1.创建透明层
            //2.创建主内容层
            var height = obj.height < 210 ? 210 : obj.height;
            var width = obj.width < 350 ? 350 : obj.width;
            var scrollH = $(document).scrollTop();
            var scrollL = $(document).scrollLeft();
            var topVal = ($(window).height() - height) / 2 + scrollH;
            var leftVal = ($(window).width() - width) / 2 + scrollL;
            var aleft = width / 2 - 80/*关闭按钮宽度的一半-20px padding*/;
            if (topVal < 0) {
                topVal = 10;
            }
            var el = "<div class='sjzc_t' id='ow_confirm002'><div class='sjzc_1_t' style='color:Red; text-align:center;'>{title}</div><div class='sjzc_2_t'><div class='sjzc_5_t' style='margin-top: 10px; '><div style='overflow:auto'>{message}</div><div class='sjzc_5_t' style='margin-top: 20px;'><ul><li class='sjzc_7_t'><a href='javascript:void(0)' style='display:inline-block;background-color:#ff9900;' id='ow_confirm002_fun'></a><a href='javascript:void(0)' style='margin-left:10px; display:inline-block' class='ad' id='ow_confirm002_fun2'></a></li></ul></div></div></div></div>";
            el = el.replace(/{title}/, title);
            el = el.replace(/{message}/, message);
            //el = el.replace(/{aleft}/, aleft);
            //1.创建透明层
            $("<div id='ow_confirm001' class='ow_black_overlay' style='z-index: 1003'></div>")
                    .height($(document).height())
                    .width($(document).width())
                    .appendTo($("body"));
            //2.创建主内容层 
            $(el)
            //.height(height)
                    .width(width)
                    .css("left", leftVal)
                    .css("top", topVal)
                    .appendTo($("body"));

            $("#ow_confirm002_fun")
    .text(buttonText1)
    .click(function () {
        $.closeConfirm();
        if (typeof fun1 == 'function') {
            fun1(); //回调函数
        }
    });

            $("#ow_confirm002_fun2")
    .text(buttonText2)
    .click(function () {
        $.closeConfirm();
        if (typeof fun2 == 'function') {
            fun2(); //回调函数
        }
    });


        }
    </script>

    </div>
  <?php $this->renderPartial("/public/footer");?>  
</body>
</html>

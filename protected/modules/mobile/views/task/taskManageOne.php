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
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
    
    <link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        $(document).ready(function () {
            if ($("#serviceValidation").length > 0) {
                if ($("#serviceValidation").text().indexOf('可以将货款本金和佣金提现了哦') > -1) {
                    $.openAlter($("#serviceValidation").text(), "提示", { width: 250, height: 50 }, function () { window.location.href = '/Member/Withdrawals' }, "确定");
                }
                else if ($("#serviceValidation").text().indexOf('恭喜你已完成浏览操作') > -1) {
                    $.openAlter($("#serviceValidation").html(), "提示", { width: 250, height: 50 }, function () { }, "我知道了");
                }
                else {
                    $.openAlter($("#serviceValidation").text(), "提示");
                }
            };
        })
        //退出任务
        function ExitTask(taskId) {
            var url='/mobile/task/taskexit/taskid/'+taskId+'.html';
			$.openWin(260, 290, url);
        }
        function BeginTask02(taskId,shebei) {
            var url='/task/taskexit/taskid/'+taskId+'/shebei/'+shebei+'.html';
            layer.open({
                type: 2,
                area: ['260px', '290px'],
                fixed: false, //不固定
                content: url
            });
        }
        function PayAuditNot(taskID) {
            $.openWin(250, 300, '/Task/Task/PayAuditNot?type=1&taskID=' + taskID);
        }
        function PayAuditNot2(taskID) {
            $.openWin(250, 300, '/Task/Task/PayAuditNot?type=2&taskID=' + taskID);
        }
		function comfirmTask(taskId) {
            var url='/mobile/task/comfirmtask/usertaskid/'+taskId+'.html';
            $.openWin(260, 290, url);
        }
		function setfreetask(tvid) {
            var url='/mobile/task/SetfreeEvalTask/taskevalid/'+tvid+'.html';
            if(confirm('您确定要放弃任务吗？')) { window.location.href=url;}else{ return false};


        }
        //开始任务(预订单任务)
	    function BeginTask03(Id,shebei) {
	        var url='/task/Taskprelist/id/'+Id+'/shebei/'+shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	
	        layer.full(index);
	
	    }
	
		//开始任务(预约单任务)
	    function BeginTask04(Id,shebei) {
	        var url='/task/Taskpredel/taskid/'+Id+'/shebei/'+shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	
	        layer.full(index);
	
	    }
	    //开始下单（预约单）
	    function doResPay($pre_id, $shebei)
	    {
	        var url='/task/doReservationToPay/taskid/'+$pre_id+'/shebei/'+$shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	        layer.full(index);
	    }

	    //取消任务(预订/预约单任务)
	    function BeginTask05(Id,shebei) {
	        var url='/task/Taskpredel/id/'+Id+'/shebei/'+shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	
	        layer.full(index);
	
	    }
    </script>
    <style>
    .task_list_h2{padding:2% 3%; border-bottom:8px solid #eee; background:#fff;}
    .jsgl{padding:10px 15px !important; border-bottom:8px solid #eee; }
    .fr_btn{height:100px !important;display:flex; align-items: center;flex-direction:row-reverse;}
    .bg_f90{background:#f90 !important;}
    </style>

</head>
<body>
    <!--[if lt IE 8]>
<script language="javascript" type="text/javascript">
$.openAlter('<div style="font-size:18px;text-align:left;line-height:30px;">hi,你当前的浏览器版本过低，可能存在安全风险，建议升级浏览器：<div><div style="margin-top:10px;color:red;font-weight:800;">谷歌Chrome&nbsp;&nbsp;,&nbsp;&nbsp;UC浏览器</div>', "提示", { width: 250, height: 50 });
$("#ow_alter002_close").remove();
</script>
<![endif]-->
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="(预订/预约）">
         <?php $this->renderPartial("/public/header");?>
    <div class="task_list_h2">
        <h2>手机端只展示部分内容的任务数据（3天）</h2>
    </div>		
	<?php foreach ($task as $key=>$val):?>
        <div class="jsgl hauto" style="position:relative">
		<?php if($val['status']>0 && $val['ordersn']):?>
		<span class="ordersn" style="position:absolute;color:#888;right:10px;">订单编号：<?=$val['ordersn'];?></span>
		<br>
		<?php endif;?>
            <ul>
                <li class="jsgl_2 hauto;"><em style="color: #447ee9; font-weight: 800">
				 <?php $taskeval=Taskevaluate::model()->find('usertaskid='.$val['id']);?>
                                        <?php
                                        switch ($val['status']){
                                            case 0:echo '进行中';break;
                                            case 1:echo '确认订单';break;
                                            case 2:echo '完成';break;
                                            case 4:echo '<span style="color:red;">异常未完成被取消</span>';break;
                                        }
                                        ?>
				</em>
                    <br>
                    <?php if($val['tasktype'] == 4){?>
                    <p class="fpgl-td-rw" style="font-weight:bold;"> 预订单任务</p>
                    <?PHP } ?>
                    <?php if($val['tasktype'] == 5){?>
                    <p class="fpgl-td-rw"> 预约单任务</p>
                    <?PHP } ?>
                    任务：<?=$val['tasksn'];?>
                    <br>
                    价格：
                          <b style="font-size:13px"><?php if ($val['status']>0){$str=empty($val['express'])?($val['price']*$val['auction']).'元':($val['price']*$val['auction']).'元('.$val['express'].'元快递费)';echo $str;}else{echo '???';}?></b>
                    <br>
                    佣金：<?=$val['commission'];?> 元
                    <br/>
                    	<p class="fpgl-td-rw"> 接手时间： <?=date('Y-m-d H:i:s', $val['addtime'])?></p>
                    	
        				<p class="fpgl-td-rw"> 最后完成时间： <?=date('Y-m-d H:i:s', $val['beginPay'])?> 至 <?=date('Y-m-d H:i:s', $val['EndPay'])?></p>
        			
                     </li>
                    <?php if($val['tasktype'] == 4){?>
                    <li class="jsgl_3 hauto fr_btn" >
                        <p class="jsgl_4">	
						<?php if ($val['status']=='0'){?>
							<!--<a  onclick="BeginTask03(<?php echo $val['id'];?>,'TX')">开始任务</a>-->
							<a href="<?php echo SITE_URL.'/task/Taskprelist/id/'.$val['id'].'/shebei/TX';?>.html">开始任务</a>
							<br>
                            <a href="javascript:void(0)" onclick="BeginTask05(<?php echo $val['id'];?>,'TX')" class="bg_f90" style="margin-top:5px">退出任务</a>
						<?php }elseif ($val['status']==1){?>
							<br>
							<a style="pointer-events: none; background: gray;"  >已下订金</a><br>
							<a href="<?php echo SITE_URL.'/task/Taskprelist/id/'.$val['id'].'/shebei/TX';?>.html">支付尾款</a>
						<?php }elseif ($val['status']==4 ){?>
							<!--<a onclick="BeginTask03(<?php echo $val['id'];?>,'TX')">提交工单</a>-->
						<?php }?>                
                       </p>               
                    </li>
                    <?PHP } ?>
                    	
                    <?php if($val['tasktype'] == 5){?>
                    <li class="jsgl_3 hauto fr_btn">
                        <p class="jsgl_4">	
						<?php if ($val['status']=='0'){?>
							<!--<a onclick="BeginTask04(<?php echo $val['id'];?>,'TX')">开始任务</a>-->
							<a href="<?php echo SITE_URL.'/task/doReservationToBrowse/taskid/'.$val['id'].'/shebei/TX';?>.html">开始任务</a>
<!--                            <a href="/mobile/task/taskone/taskid/--><?//=$val['id']?><!--.html">开始任务(旧)</a>-->
                            <a href="javascript:void(0)" onclick="BeginTask05(<?php echo $val['id'];?>,'TX')" class="bg_f90" style="margin-top:5px">退出任务</a>
						<?php }elseif ($val['status']==1){?>
							<a href="<?php echo SITE_URL.'/task/doReservationToBrowse/taskid/'.$val['id'].'/shebei/TX';?>.html">浏览完毕</a>
							<a href="<?php echo SITE_URL.'/task/doReservationToPay/taskid/'.$val['id'].'/shebei/TX';?>.html">开始下单</a>
						<?php }elseif ($val['status']==4 ){?>
							<!--<a onclick="BeginTask03(<?php echo $val['id'];?>,'TX')">提交工单</a>-->
						<?php }?>                
                       </p>               
                    </li>
                    <?PHP } ?>
		
            </ul>
        </div>
			<?php endforeach;?>
   </div>
 <?php $this->renderPartial("/public/footer");?>

</body></html>
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
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="接手管理">
         <?php $this->renderPartial("/public/header");?>
    <div class="task_list_h2">
        <h2>手机端只展示近3天接手的任务数据</h2>
    </div>		
	<?php foreach ($task as $key=>$val):?>
        <div class="jsgl hauto" style="position:relative">
		<?php if($val['status']>0 && $val['ordersn']):?>
		<span class="ordersn" style="position:absolute;color:#888;right:10px;">订单编号：<?=$val['ordersn'];?></span>
		<?php endif;?>
            <ul>
                <li class="jsgl_2 hauto;"><em style="color: #447ee9; font-weight: 800">
				 <?php $taskeval=Taskevaluate::model()->find('usertaskid='.$val['id']);?>
                                        <?php
                                        switch ($val['status']){
                                            case 0:echo '进行中';break;
                                            case 1:echo '待审核';break;
                                            case 2:echo '获取佣金';break;
                                            case 3:echo '商家确认';break;
                                            case 4:echo '完成';break;
                                            case $val['status']==5 && $taskeval->doing!=3:echo '待评价';break;
                                            case $val['status']==5 && $taskeval->doing==3:echo '已放弃评价';break;
                                            case 6:echo '已评价';break;
                                            case 7:echo '已完成';break;
                                        }
                                        ?>
				</em>
                    <br>
                    任务：<?=$val['tasksn'];?>
                    <br>
                    价格：
                          <b style="font-size:13px"><?php if ($val['status']>0){$str=empty($val['express'])?($val['price']*$val['auction']).'元':($val['price']*$val['auction']).'元('.$val['express'].'元快递费)';echo $str;}else{echo '???';}?></b>

                    <br>
                    佣金：<?=$val['commission'];?> 元 </li>
                    <li class="jsgl_3 hauto fr_btn">
                        <p class="jsgl_4">	
						<?php if ($val['status']=='0'){?>
							<a href="<?php echo SITE_URL.'/task/Tasktestone/taskid/'.$val['taskid'].'/shebei/TX';?>.html">开始任务</a>
<!--                            <a href="/mobile/task/taskone/taskid/--><?//=$val['id']?><!--.html">开始任务(旧)</a>-->
                            <a href="javascript:void(0)" onclick="ExitTask(<?= $val['taskid']?>)" class="bg_f90" style="margin-top:5px">退出任务</a>
						<?php }elseif ($val['status']==2){?>
							<a href="javascript:void(0)" onclick="comfirmTask('<?= $val['id']?>')">获取佣金</a>
						<?php }elseif ($val['status']==5 && $taskeval->doing!=3){?>
							<a href="<?=$this->createUrl('task/evaltasktest',array('usertaskid'=>$val['id']))?>">立即评价</a>
							<a class="bg_f90"  href="javascript:void(0)" onclick="setfreetask(<?= $val['id']?>)" style="margin-top:5px">放弃评价</a>
						<?php }?>
						                                
                        </p>
                     
                    </li>
		
            </ul>
        </div>
			<?php endforeach;?>
   </div>
 <?php $this->renderPartial("/public/footer");?>

</body></html>
<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>数据分析中心</title>		
		
		

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo ASSET_URL;?>ico/favicon.ico" type="image/x-icon" />    

	    <!-- Css files -->
	    <link href="<?php echo ASSET_URL;?>css/bootstrap.min.css" rel="stylesheet">		
		<link href="<?php echo ASSET_URL;?>css/jquery.mmenu.css" rel="stylesheet">		
		<link href="<?php echo ASSET_URL;?>css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/climacons-font.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/xcharts/css/xcharts.min.css" rel=" stylesheet">		
		<link href="<?php echo ASSET_URL;?>plugins/fullcalendar/css/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/morris/css/morris.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jquery-ui/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">	    
	    <link href="<?php echo ASSET_URL;?>css/style.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/add-ons.min.css" rel="stylesheet">		

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
</head>

<body>
	<!-- start: Header -->
	<?php $this->renderPartial("/baseLayout/header");?>
	<!-- end: Header -->
	
	<div class="container-fluid content">
	
		<div class="row">
				
			<!-- start: Main Menu -->
			<?php $this->renderPartial("/baseLayout/mainmenu");?>
			<!-- end: Main Menu -->
		
		<!-- start: Content -->
		<div class="main">
            <div class="row">
            	<div class="col-lg-12">
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 投诉中心</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>投诉管理中心</li>						  	
            		</ol>
            	</div>
            </div>
            <form method="post" action="<?php echo $this->createUrl("compliancenter/compliantransfer")?>">
                <input type="text" name="keyword" placeholder="刷手手机号" style="text-indent: 5px; color: #666; font-size:14px; width:260px;" />　<button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit"><i class="fa fa-dot-circle-o"></i>&nbsp;搜索</button>
            </form>
            <br />
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>投诉总览</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <style>
                    .delbox{display:none;position: absolute;top: 20px;right: 0;width: 500px;border: solid 1px #eee;background: #fff;border-radius: 10px;padding: 10px;}
                    .delbox h1{    line-height: 30px;font-size: 18px;border-bottom: solid 1px #eee;margin: 0;}
                    .delbox .box{margin: 10px}
                    .delbox dl{width: 100%;padding: 5px 0;overflow: hidden}
                    .delbox dt{float: left;width: 80px;text-align: right;line-height: 30px;}
                    .delbox dd{float: left;margin-left: 10px;width: 350px}
                    .delbox dd select{width: 70px;border: solid 1px #eee;height: 30px;padding-left: 5px}
                </style>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><div align="center">投诉人信息</div></th>
                                <th><div align="center">被投诉人信息</div></th>
                                <th><div align="center">任务id</div></th>
                                <th><div align="center">投诉原因</div></th>
                                <th><div align="center">证据</div></th>
                                <th><div align="center">投诉时间</div></th>
                                <th><div align="center">开始处理时间</div></th>
                                <th><div align="center">处理状态</div></th>
                                <th><div align="center">仲裁</div></th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php

                            foreach($proInfo as $item){
                                $tousuren=User::model()->findByPk($item->buyerid);
                                $mechant=User::model()->findByPk($item->merchantid);
                                $transfer=Transfercash::model()->findByPk($item->transferid);
                                $usertask=Usertask::model()->findByPk($transfer->usertaskid);

                        ?>
                        <tr style="color:#666; <?php echo $taskInfo==false?"background:#f3bc82;":"";?>">
                            <td><?php echo $item->id;?></td>
                            <td>
                                <div align="center">
                                    ID:<?php echo @$item->buyerid;?><br />
                                    姓名：<?php echo @$tousuren->Username;?><br />
                                    QQ：<?php echo @$tousuren->QQToken;?><br />
                                    手机：<?php echo @$tousuren->Phon;?><br />
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    ID:<?php echo @$item->merchantid;?><br />
                                    姓名：<?php echo @$mechant->Username;?><br />
                                    QQ：<?php echo @$mechant->QQToken;?><br />
                                    手机：<?php echo @$mechant->Phon;?><br />
                                </div>
                            </td>
                            <td><div align="center"><?php echo @$usertask->tasksn;?></div></td>
                            <td><div align="center"><a href="javascript:;" class="lookupReason"onclick="showreason(this,'<?=$item->content?>')" >查看原因</a></div></td>
                            <td><div align="center"><a href="javascript:;" class="lookupReasonImg"   onclick="showzhengju(this,'<?=$item->img;?>')">查看证据</a></div></td>
                            <td><div align="center"><?php echo date('Y-m-d H:i:s',$item->addtime);?></div></td>
                            <td>
                                <div align="center">
                                   <?php if ($item->updatetime){
                                       echo date('Y-m-d',$item->updatetime);
                                   }?>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <?php
                                        switch ($item->status){
                                            case 0:echo '<font color="red">待处理</font>';break;
                                            case 1:echo '<font color="red">处理完成</font>';break;
                                        }
                                    ?>
                                </div>
                            </td>


                            <td style="position: relative">
                                <?php
                                    if(@$item->status==0){
                                ?>
                                    <div align="center"><a href="javascript:;" class="startHandle" lang="<?php echo @$item->id;?>">开始处理</a></div>
                                <?php }elseif ($item->status==1){?>
                                        处理完成
                                <?php }?>

                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    if(isset($pages)){
                ?>
                <div class="breakpage"><!--分页开始-->
                    <?php
                        $this->widget('CLinkPager', array(
                            'selectedPageCssClass'=>'active',
                            'pages' => $pages,
                            'lastPageLabel' => '最后一页',
                            'firstPageLabel' => '第一页',
                            'header' => false,
                            'nextPageLabel' => ">>",
                            'prevPageLabel' => "<<",
                        ));
                    ?>
                </div><!--分页结束-->
                <?php }?>
          </div><!--theBody end-->
            <div class="clear"></div>
		</div>
		<!-- end: Content -->
		<br><br><br>
		
		
		<!-- start: usage -->
		<?php $this->renderPartial("/baseLayout/usage");?>
		<!-- end: usage Menu -->	
		
	</div><!--/container-->
		
	
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Warning Title</h4>
				</div>
				<div class="modal-body">
					<p>Here settings can be configured...</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="clearfix"></div>
	
		
	<!-- start: JavaScript-->
	<!--[if !IE]>-->

			<script src="<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script src="<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js"></script>
	
	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js'>"+"<"+"/script>");
		</script>
		
	<![endif]-->
	<script src="<?php echo ASSET_URL;?>js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/bootstrap.min.js"></script>	
	
	
	<!-- page scripts -->
	<script src="<?php echo ASSET_URL;?>plugins/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/moment/moment.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/fullcalendar/js/fullcalendar.min.js"></script>
	<!--[if lte IE 8]>
		<script language="javascript" type="text/javascript" src="<?php echo ASSET_URL;?>plugins/excanvas/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.spline.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/xcharts/js/xcharts.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/autosize/jquery.autosize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/placeholder/jquery.placeholder.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/raphael/raphael.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/morris/js/morris.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/gdp-data.js"></script>	
	<script src="<?php echo ASSET_URL;?>plugins/gauge/gauge.min.js"></script>
	
	
	<!-- theme scripts -->
	<script src="<?php echo ASSET_URL;?>js/SmoothScroll.js"></script>
	<script src="<?php echo ASSET_URL;?>js/jquery.mmenu.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/core.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/d3/d3.min.js"></script>	
	
	<!-- inline scripts related to this page -->
	<script src="<?php echo ASSET_URL;?>js/pages/index.js"></script>	
	
	<!-- end: JavaScript-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        function showreason(o,msg) {
            layer.confirm('<div style="text-align:center; line-height:40px; font-size:18px; font-weight:bold;">《投诉原因》</div><div style="color:red;">'+msg+'</div>', {
                btn: ['知道了'] //按钮
            });
        }
        function showzhengju(o,imgsrc) {
            var imgArr=imgsrc;
            if(imgArr.length==1)
            {
                layer.tips('投诉方没有上传图片证据', '.lookupReasonImg', {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }else
            {
                var imgStr='<img src="'+imgArr+'" /><br/>';
                layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 1,
                    area: ['95%','80%'],
                    shadeClose: true,
                    content: '<div style="text-align:center;">'+imgStr+'</div>'
                });
            }
        }
        //进行仲裁
        $(".startHandle").click(function(){
                var transschedualid=$(this).attr('lang');
                //询问框
                layer.confirm('<div style="font-weight:bold; font-size:18px; text-align:center; line-height:45px;">《刷手发起转账投诉》</div><span style="color:red;">请查明投诉原因、证据等相关信息后谨慎操作，仲裁后将无法修改投诉结果!</span>', {
                    btn: ['处理完成','取消操作'] //按钮
                },function(){//威客胜诉
                    //威客胜诉处理结果
                    $.ajax({
                        type:"post",
                        url:"<?php echo $this->createUrl('compliancenter/dealtransfer');?>",
                        data:{"id":transschedualid},
                        success:function(msg)
                        {
                            if(msg=="succeess")//操作成功
                            {
                                //询问框
                                layer.confirm('仲裁完成', {
                                    btn: ['知道了'] //按钮
                                },function(){
                                    window.location.reload();
                                });
                            }
                            else//操作失败
                            {
                                //询问框
                                layer.confirm('操作失败，请联系相关技术人员', {
                                    btn: ['确定'] //按钮
                                });
                            }
                        }
                    });
                    //威客胜诉处理结果
                });

            });


    </script>
	<style>
        .layui-layer-setwin{ display: none;}
    </style>
</body>
</html>
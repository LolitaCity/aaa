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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 所有会员</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>会员管理中心</li>						  	
            		</ol>
            	</div>
            </div>
            <form method="post" action="<?php echo $this->createUrl("membercenter/authperson")?>">
                <input type="text" name="keyword" placeholder="请输入会员名" style="text-indent: 5px; color: #666; font-size:14px; width:260px;" />　<button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit"><i class="fa fa-dot-circle-o"></i>&nbsp;搜索</button>
            </form>
            <br />
            <style>
                #dialog{position: absolute;right:0;bottom: 40px;padding: 10px;border: solid 1px #eee;border-radius: 5px;background: #fff;display: none}
                .green{background: green;color: #fff}
            </style>
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>会员列表</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>会员名</th>
                                <th><div align="center">姓名</div></th>
                                <th><div align="center">身份证号</div></th>
                                <th><div align="center">财付通</div></th>
                                <th><div align="center">支付宝</div></th>
                                <th><div align="center">QQ号</div></th>
                                <th><div align="center">地址</div></th>
                                <th><div align="center">手机号</div></th>
                                <th><div align="center">身份证正面</div></th>
                                <th><div align="center">手持身份证</div></th>
                                <th><div align="center">身份证反面</div></th>
                                <th><div align="center">认证状态</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($proInfo as $item){
                                    $usermsg=User::model()->findByPk($item->uid);
                            ?>
                            <tr style="color:#666;">
                                <td><?php echo @$usermsg->Username;?></td>
                                <td><div align="center"><?php echo @$item->username;?></div></td>
                                <td><div align="center"><?php echo @$item->idcardnumber;?></div></td>
                                <td><div align="center"><?php echo @$item->cftaccount;?></div></td>
                                <td><div align="center"><?php echo @$item->zfbaccount;?></div></td>
                                <td><div align="center"><?php echo @$item->qq;?></div></td>
                                <td><div align="center"><?php echo @$item->address;?></div></td>
                                <td><div align="center"><?php echo @$item->telephone;?></div></td>
                                <td><div align="center"><a class="checkImg" href="javascript:;" alt="<?php echo @$item->zmidcard;?>">查看</a></div></td>
                                <td><div align="center"><a class="checkImg" href="javascript:;" alt="<?php echo @$item->handwithidcard;?>">查看</a></div></td>
                                <td><div align="center"><a class="checkImg" href="javascript:;" alt="<?php echo @$item->lifephoto;?>">查看</a></div></td>
                                <td>
                                    <div align="center" style="position: relative">
                                        <div id="dialog" class="dialog">
                                            <textarea placeholder="请输入未通过原因" name="msg" cols="50" rows="3"></textarea>
                                            <input type="hidden" name="id" value="<?php echo @$item->id;?>"/>
                                            <button id="btnSure" class="btn green">确定</button>
                                            <button id="btnCancel" class="btn">取消</button>
                                        </div>
                                        <?php if ($item->status==0 && $item->username){?>
                                            <a onclick="if(confirm('确定要通过认证？')) return true; else return false;" href="<?php echo $this->createUrl('membercenter/authperson',array('authid'=>$item->id,'uid'=>$item->uid));?>" style="color:red" title="认证通过" >通过</a>
                                            <a onclick="$(this).parent().find('#dialog').show()" style="cursor: pointer">不通过</a>
                                        <?php }elseif ($item->status==0 && $item->username==false){?>
                                            <a href="<?php echo $this->createUrl('membercenter/authperson',array('authid'=>$item->id,'uid'=>$item->uid));?>" style="color:red" title="认证通过">淘内幕认证通过</a>
                                        <?php }elseif($item->status==4 && $item->username){?>
                                            <a style='font-weight:bold; color:red;' title="错误原因：<?= $item->msg;?>">认证不通过</a><br/>
                                        <?php }else{?>
                                            <font style='font-weight:bold; color:green;'>认证通过</font><br/>
                                            <a onclick="if(confirm('您确定要删除吗？删除后将无法恢复！')) return true; else return false;" href="<?php echo $this->createUrl('membercenter/authperson',array('authid'=>$item->id,'nopass'=>"DOIT",'uid'=>$item->uid));?>" title='认证不通过'>删除认证</a>
                                        <?php }?>
                                    </div>
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
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
	<script>
        $("a.checkImg").click(function(){
            var imgUrl=$(this).attr("alt");
            layer.open({
                type: 1,
                title: false,
                closeBtn: 1,
                area: ['95%','80%'],
                shadeClose: true,
                content: '<div style="text-align:center;"><img src="'+imgUrl+'" style="max-width:100%;"></div>'
            });
        });
    </script>
    <script>
        $('#btnCancel  ').click(function () {
            $(this).parent().hide();
        });
        $('#btnSure').click(function () {
            var msg=$(this).parent().find('textarea').val();
            var id=$(this).parent().find(':input[name="id"]').val();
            $.post('<?php echo $this->createUrl('membercenter/authunpass')?>',{msg:msg,id:id},function (data) {
                    if(data.err_code==0){
                        location.reload();
                    }else {
                        layer.confirm(data.msg, {
                            btn: ['知道了'] //按钮
                        });
                    }
                },'json' );

        })
    </script>
</body>
</html>
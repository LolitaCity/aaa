<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>数据分析中心</title>		
		
		<!-- Import google fonts - Heading first/ text second -->
        <link rel='stylesheet' type='text/css' href='http://fonts.useso.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />
        <!--[if lt IE 9]>
<link href="http://fonts.useso.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
<![endif]-->

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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 店铺管理</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="/business/backyard/default/index.html">首页</a></li>
            			<li><i class="fa fa-laptop"></i>店铺管理系统</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>
                        店铺管理中心
                                                -审核店铺
                    </span>
                </div>
                <div class="panel-body">
                    <div class="clear"></div>
                    <div class="theBody"><!--theBody start-->
                    
                    <style>
.errorSummary{ border:1px solid #ccc; background:#f7dada;}
.errorSummary p{ width:98%; margin:0 auto;}
.errorSummary ul{ width:98%; margin:0 auto;}
.errorMessage{ display:inline; color:red;}
.required{ color:red;}
</style>
<!--商品描述文本编辑器-->
 

<form id="article-form" action="<?php echo $this->createUrl('shop/ShopDB')?>" method="post">
    <table id="articleoth" style="width:100%; line-height:35px; font-size:12px;" cellpadding="0" cellspacing="0" border="0">
    <tr>
		<td><label for="Article_goods_name">店铺类型<span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->type=='0'?'淘宝':'京东'?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr>
    <tr>
		<td><label for="Article_goods_name">掌柜号<span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->manager_num?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr>
    <tr>
		<td><label for="Article_goods_name">店铺名称 <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->shopname?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr>
    <tr>
		<td><label for="Article_goods_name">店铺性质 <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->nature=='0'?'个人':'公司'?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr>	
    <tr>
		<td><label for="Article_goods_name">发货人 <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->sendname?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">发货人 手机号<span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->sendphone?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">发货人地址 <span class="required">*</span></label></td>
		<td><input style="width:450px;" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->sendarea?>-<?=$info->sendaddress?>" readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">截图 <span class="required">*</span></label></td>
		<td><a href="<?=$info->images?>" target="_blank"><img src="<?=$info->images?>" width="200"/>查看大图</a></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">提交时间 <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=date('Y年m月d日 H:i:s',$info->addtime)?>"  readonly="readonly"  /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">提交IP <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->addIP?>" readonly="readonly" /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
    <tr>
		<td><label for="Article_goods_name">店铺状态 <span class="required">*</span></label></td>
		<td><input maxlength="120" name="Article[goods_name]" id="Article_goods_name" type="text" value="<?=$info->status=='0'?'不可使用':'可使用'?>" readonly="readonly" /> <div class="errorMessage" id="Article_goods_name_em_" style="display:none"></div></td>
	</tr> 
	
    <tr>
		<td><label for="Article_goods_name">审核状态<span class="required">*</span></label></td>
		<td style="line-height: 20px;">
		    <input name="Shop[auditing]" type="radio" value="-1" style="height:18px; vertical-align: middle;"/>驳回<br>
		    <input name="Shop[auditing]" type="radio" value="1" style="height:18px; vertical-align: middle;"/>通过<br>
		    <input name="Shop[auditing]" type="radio" value="0" style="height:18px; vertical-align: middle;"/>未审核<br>
		    <p style="color:blue;">审核通过后店铺为可使用状态</p>
		</td>
	</tr> 	
	<tr>
		<td><label for="Article_goods_desc">驳回原因</label></td>
		<td><textarea rows="6" cols="50" name="Shop[remark]" id="Article_goods_desc"></textarea></td>
		<td><div class="errorMessage" id="Article_goods_desc_em_" style="display:none"></div></td>
	</tr>
	<tr>
        <td></td>
        <td><input type="submit" name="yt0" value="确认" /><input maxlength="120" name="Shop[sid]" type="hidden" value="<?=$info->sid?>" readonly="readonly"  /></td>
        <td></td>
	</tr>
    </table>
</form>
</div><!-- form -->
<style>
    /*控制多图上传样式*/
    #J_imageView ul li{ width:auto; height:auto; float:left; display:inline; margin-right: 10px; border:4px solid #ccc; position:relative}
    .imgbox img{ width:120px; height:100px;}
    .close{ position: absolute; top: 0; right: 2px; cursor: pointer;opacity:10;}
    input{  border: 1px solid #d4d4d4;
        height:30px; line-height:30px;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        color: #484848;
        -webkit-box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
        -moz-box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 2px 1px -1px rgba(0, 0, 0, 0.1);
    }
    select{ height:30px; line-height: 25px; padding: 0 5px;}
    label{ font-weight:normal;}
</style>
            </div>
		</div>
		<!-- end: Content -->
<script>
var info="<?=$info->auditing?>";
$("input[name='Shop[auditing]'][value='"+info+"']").attr("checked",true); 
</script>		
		
		
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
	<style>
    .inbox .contacts ul li{color:#666;}
    .text1{
        text-indent: 5px;
    	width:207px;
    	height:28px;
    	border:2px dashed #57a0ff;
    	margin-left:44px;
    	margin-top:9px;
    }
    </style>
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        $(function(){
            
            //修改用户密码
            $(".changePwd").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('输入新密码：<input type="password" name="newpwd" class="text1 newpwd" style="margin-left:5px;" /><br/>请再次输入：<input type="password" name="newpwd" class="text1 newpwdagain" style="margin-left:5px;" /><br/>', {
                	btn: ['确定修改','取消修改'] //按钮
                },function(){
                    if($(".newpwd").val()=="")
                    {
                        layer.tips('新密码不能为空', '.newpwd');
                        exit;
                    }
                    if($(".newpwdagain").val()=="")
                    {
                        layer.tips('确认密码不能为空', '.newpwdagain');
                        exit;
                    }
                    if($(".newpwd").val()!=$(".newpwdagain").val())//两次输入的密码不相等
                    {
                        layer.tips('两次输入的密码不一致', '.newpwdagain');
                        exit;
                    }
                    
                    //检查通过修改密码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/changPassword');?>",
            			data:{"newpassword":$(".newpwd").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('密码修改成功', {
                                	btn: ['知道了'] //按钮
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">密码修改失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
                //修改用户密码
            });
            
            //修改真实姓名
            $(".changename").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('请输入用户姓名：<input type="text" name="changenameItem" class="text1 changenameItem" style="width:100px; margin-left:5px; text-align:center;" />', {
                	btn: ['确定修改','取消'] //按钮
                },function(){
                    if($(".changenameItem").val()=="")
                    {
                        layer.tips('用户姓名不能为空', '.Money');
                        exit;
                    }
                    
                    //检查通过修改密码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/changename');?>",
            			data:{"changename":$(".changenameItem").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('修改成功', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">修改失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
            });
			
            //修改qq
            $(".changeqq").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('请输入QQ：<input type="text" name="changeqqItem" class="text1 changeqqItem" style="width:100px; margin-left:5px; text-align:center;" />', {
                	btn: ['确定修改','取消'] //按钮
                },function(){
                    if($(".changeqqItem").val()=="")
                    {
                        layer.tips('QQ不能为空', '.Money');
                        exit;
                    }
                    
                    //检查通过修改密码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/changeqq');?>",
            			data:{"changeqq":$(".changeqqItem").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('修改成功', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">修改失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
            });
            
            //手动充值
            $(".giveMoney").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('请输入充值金额：<input type="text" name="Money" class="text1 Money" style="width:100px; margin-left:5px; text-align:center;" />&nbsp;&nbsp;元', {
                	btn: ['确定充值','取消充值'] //按钮
                },function(){
                    if($(".Money").val()=="")
                    {
                        layer.tips('充值金额不能为空', '.Money');
                        exit;
                    }
                    if(isNaN($(".Money").val()))
                    {
                        layer.tips('充值金额必须为数字', '.Money');
                        exit;
                    }
                    
                    //检查通过修改密码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/givePay');?>",
            			data:{"Money":$(".Money").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('充值成功', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">充值失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
            });
            
            //手动修改米粒
            $(".giveMinLi").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('请输入增加数量：<input type="text" name="changMinLi" class="text1 changMinLi" style="width:100px; margin-left:5px; text-align:center;" />&nbsp;&nbsp;个', {
                	btn: ['确定修改','取消修改'] //按钮
                },function(){
                    if($(".changMinLi").val()=="")
                    {
                        layer.tips('修改值不能为空', '.changMinLi');
                        exit;
                    }
                    if(isNaN($(".changMinLi").val()))
                    {
                        layer.tips('修改值必须为数字', '.changMinLi');
                        exit;
                    }
                    
                    //检查通过修改密码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/changMinLi');?>",
            			data:{"changMinLi":$(".changMinLi").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('修改成功', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">修改失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
            });
            
            
            //修改手机号码
            $(".changePhon").click(function(){
                var uid=$(this).attr("alt");//会员id
                //修改用户密码
                layer.confirm('修改手机号码：<input type="text" name="phone" class="text1 phone" style="width:100px; margin-left:5px; text-align:center;" />', {
                	btn: ['确定修改','取消修改'] //按钮
                },function(){
                    if($(".phone").val()=="")
                    {
                        layer.tips('手机号码不能为空', '.phone');
                        exit;
                    }
                    
                    //检查通过修改手机号码
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('membercenter/changePhone');?>",
            			data:{"phone":$(".phone").val(),"uid":uid},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
                				layer.confirm('修改成功', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }else
                            {
                                layer.confirm('<span style="color:red;">手机号码修改失败，您可以联系相关技术人员协助解决</span>', {
                                	btn: ['知道了'] //按钮
                                },function(){
                                    location.reload();
                                });
                            }
            			}
            		});
                    
                },function(){
                    location.reload();//重新加载当前页面
                });
            });
        })
    </script>
</body>
</html>
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
<style>
    .examItem{display: block;overflow: hidden}
</style>
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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 系统基本参数</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>系统基本参数设置</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="mainRightCon"><!--mainRightCon start-->
                <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>系统基本参数</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <style>
                    .answer{ position: relative; top:2px; left:10px;}
                </style>
                <?php
                    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
                    $webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));
                    $webdes=System::model()->findByAttributes(array("varname"=>"webdes"));
                    $registneedToKnow=System::model()->findByAttributes(array("varname"=>"registneedToKnow"));
                    
                    $jdfsMinLi=System::model()->findByAttributes(array("varname"=>"jdfsMinLi"));

                    $spreadPrice=System::model()->findByAttributes(array("varname"=>"spreadPrice"));
                    $copyright=System::model()->findByAttributes(array("varname"=>"copyright"));
                    $reglock=System::model()->findByAttributes(array("varname"=>"reglock"));
                    $authperson=System::model()->findByAttributes(array("varname"=>"authperson"));


					$buyerQQkefu=System::model()->findByAttributes(array("varname"=>"buyerQQkefu"));
                    $merchantQQkefu1=System::model()->findByAttributes(array("varname"=>"merchantQQkefu1"));
                    $merchantQQkefu2=System::model()->findByAttributes(array("varname"=>"merchantQQkefu2"));
					$monthAccount=System::model()->findByAttributes(array("varname"=>"monthAccount"));
                    $pingjiarenwuPicture=System::model()->findByAttributes(array("varname"=>"pingjiarenwuPicture"));
                    $buyerQQkefu=System::model()->findByAttributes(array("varname"=>"buyerQQkefu"));
					$pingjiarenwuWord=System::model()->findByAttributes(array("varname"=>"pingjiarenwuWord"));
					$shuashouPrice=System::model()->findByAttributes(array("varname"=>"shuashouPrice"));
					$buyerSet=System::model()->findByAttributes(array("varname"=>"buyerSet"));
					$taskScore=System::model()->findByAttributes(array("varname"=>"taskScore"));
                    $commission_buyer=System::model()->findByAttributes(array("varname"=>"commission_buyer"));
                    $commission_seller=System::model()->findByAttributes(array("varname"=>"commission_seller"));
					$buyerSetarr=unserialize($buyerSet->value);

                ?>
                <div class="panel-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo $this->createUrl('system/baseset');?>" class="form-horizontal">
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站名称　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="webtitle" id="input-small" name="input-small" class="form-control input-sm" value="<?php echo $webtitle->value;?>"/>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站关键词</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="webkeywords" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px;" value="<?php echo $webkeywords->value;?>"/>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站描述　</label>
                                <div class="col-sm-3" style="height: 100px;">
    		                        <textarea name="webdes" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px;"><?php echo $webdes->value;?></textarea>
    		                    </div>
                            </div><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">版权说明　</label>
                                <div class="col-sm-3" style="height: 100px;">
    		                        <textarea name="copyright" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px;"><?php echo $copyright->value;?></textarea>
    		                    </div>
                            </div><br />

                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">注册协议　</label>
                                <div class="col-sm-3">
    		                        <textarea name="registneedToKnow" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px"><?php echo $registneedToKnow->value;?></textarea>
    		                    </div>
                            </div><br />

                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">新会员冻结　　　</label>
                                <div class="col-sm-3" style="position: relative; left:-36px; top:5px;">
    		                        <select name="reglock">
                                        <?php
                                            if($reglock->value==0)
                                            {
                                        ?>
                                                <option value="0">否</option>
                                                <option value="1">是</option>
                                        <?php }else{?>
                                                <option value="1">是</option>
                                                <option value="0">否</option>
                                        <?php }?>
                                    </select><span style="padding-left: 10px; color:red;">新注册会员是否为冻结锁定状态</span>
    		                    </div>
                            </div><br /><br />

                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">威客实名认证　　　</label>
                                <div class="col-sm-3" style="position: relative; left:-48px; top:5px;">
    		                        <select name="authperson">
                                        <?php
                                            if($authperson->value==0)
                                            {
                                        ?>
                                                <option value="0">否</option>
                                                <option value="1">是</option>
                                        <?php }else{?>
                                                <option value="1">是</option>
                                                <option value="0">否</option>
                                        <?php }?>
                                    </select><span style="padding-left: 10px; color:red;">是否要求威客绑定买号前实名认证</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">接手可接单量　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="buyerSet[day]" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $buyerSetarr['day'];?>"/><span style="padding-left: 10px; color:red;">单/天</span>
    		                        <input type="text" name="buyerSet[week]" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $buyerSetarr['week'];?>" /><span style="padding-left: 10px; color:red;">单/周</span>
    		                        <input type="text" name="buyerSet[month]" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $buyerSetarr['month'];?>"/><span style="padding-left: 10px; color:red;">单/月</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">刷手最低接单信用　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskScore" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskScore->value;?>"/><span style="padding-left: 10px; color:red;">分</span>
    		                    </div>
                            </div>

                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">返还商家推荐人佣金　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="shangjiaPrice" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $shangjiaPrice->value;?>"/><span style="padding-left: 10px; color:red;">元/单</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">返还刷手推荐人佣金　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="shuashouPrice" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $shuashouPrice->value;?>"/><span style="padding-left: 10px; color:red;">元/单</span>
    		                    </div>
                            </div>
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">刷手月结日　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="monthAccount" id="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $monthAccount->value;?>"/><span style="padding-left: 10px; color:red;">日</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">纯文字评价任务佣金</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="pingjiarenwuWord" id="input-small"  class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $pingjiarenwuWord->value;?>"/><span style="padding-left: 10px; color:red;">元/单</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">带图片评价任务佣金　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="pingjiarenwuPicture" id="input-small"  class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $pingjiarenwuPicture->value;?>"/><span style="padding-left: 10px; color:red;">元/单</span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">刷手客服QQ　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="buyerQQkefu" id="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $buyerQQkefu->value;?>"/><span style="padding-left: 10px; color:red;"></span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">商家QQ客服1　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="merchantQQkefu1" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $merchantQQkefu1->value;?>"/><span style="padding-left: 10px; color:red;"></span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">商家QQ客服2　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="merchantQQkefu2" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $merchantQQkefu2->value;?>"/><span style="padding-left: 10px; color:red;"></span>
    		                    </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">刷手佣金梯度设置　</label>
                                <div class="col-sm-3" style="width: auto;">
                                    <textarea name="commission_buyer" rows="5" cols="50" ><?=$commission_buyer->value;?></textarea>
                                    <font color="red">请严格按照格式设置：比如: 200=5|500=8|，否则程序错误</font>
                                </div>
                            </div>
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">商家佣金梯度设置　</label>
                                <div class="col-sm-3" style="width: auto;">
                                    <textarea name="commission_seller" rows="5" cols="50" ><?=$commission_seller->value;?></textarea>
                                    <font color="red">请严格按照格式设置：比如: 200=5|500=8|，否则程序错误</font>
                                </div>
                            </div>
							

                            
                            <div class="examItem">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit" style=" margin-left:87px; margin-top: 10px;"><i class="fa fa-dot-circle-o"></i>&nbsp;确认修改</button>
                                    <span style="padding-left: 30px; color:green; position: relative; top:6px;"><?php echo @$addWarning;?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>
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
    <script src="<?php echo VERSION2;?>js/jquery.js"></script>
</body>
</html>
